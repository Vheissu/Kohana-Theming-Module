<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Theming functionality for your Kohana application
 *
 * @package    Theme
 * @author     Dwayne Charrington
 * @copyright  (c) 2013 Dwayne Charrington + Contributors
 * @license    http://opensource.org/licenses/BSD-3-Clause
 */

class Kohana_Theme {

    // Populated via init.php
    public static $_config = array();

    protected $_default_theme = "default";

    protected $_current_theme          = "";
    protected $_current_theme_path = "";
    protected $_theme_paths            = array();

    public function __construct($theme = FALSE)
    {
        // Load the config
        self::$_config = Kohana::$config->load("theme");

        // Get all configured theme directories
        $this->_theme_paths = self::$_config->get("theme_dirs");

        // Our factory method has supplied a theme to load
        if ($theme !== FALSE)
        {
            $this->set_theme($theme);
        }
        else
        {
            // Default theme if no theme selected
            if ($this->_current_theme == '')
            {
                $this->_current_theme = $this->_default_theme;
            }
        }
    }


    /**
     * Factory
     *
     * Create a new instance of this class for
     * medicinal purposes only, of course.
     *
     * @param bool $theme
     * @return class
     *
     */
    public static function factory($theme = FALSE)
    {
        return new Theme($theme);
    }

    /**
     * Current Theme
     *
     * Return the current theme name and path
     *
     * @return array
     *
     */
    public function current_theme()
    {
        $arr = array();

        if ( $this->_current_theme_path !== '' && $this->_current_theme )
        {
            $arr['theme'] = $this->_current_theme;
            $arr['path']    = $this->_current_theme_path;
        }

        return $arr;
    }

    /**
     * Set Theme
     *
     * Sets the theme name to use
     *
     * @param str $theme - The theme name
     * @return void
     *
     */
    public function set_theme($theme)
    {
        if ($this->_current_theme !== $theme)
        {
            $this->_current_theme = trim($theme);
        }
    }


    /**
     * Load
     *
     * Look for our theme and set it's
     * location as a module so we can
     * play with it.
     *
     */
    public function load()
    {
        // Kohana current modules
        $modules = Kohana::modules();

        // Our themes are stored as modules
        $module_path = array();

        // Assume no directory was found
        $directory_found = FALSE;

        // Iterate over each config theme path
        foreach ($this->_theme_paths AS $name => $path)
        {
            // Create our path; theme_directory + theme_name
            $theme_dir = $path . DIRECTORY_SEPARATOR . $this->_current_theme;

            // The directory exists
            if ( is_dir($theme_dir) )
            {
                // Store this directory as a module
                $module_path[$this->_current_theme] = $theme_dir;

                // Save this for use elsewhere
                $this->_current_theme_path = $theme_dir;

                // Yep, we found a theme directory
                $directory_found = TRUE;

                // We've got what we wanted, halt looping
                break;
            }
        }

        // We found a theme directory
        if ($directory_found == TRUE)
        {
            // Append theme path to the module lists
            Kohana::modules($module_path + $modules);
        }
        else
        {
            $exception_arr = array( ":theme" => $this->_current_theme, );
            throw new Kohana_Exception("Your requested theme :theme, could not be found in any of the supplied theme directories.", $exception_arr);
        }

        // Empty the modules and path variables
        unset($modules, $module_path);

        // If we found a theme, this will be true
        return $directory_found;
    }

}
