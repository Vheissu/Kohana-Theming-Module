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

    protected $_current_theme = "";
    protected $_theme_paths   = array();

    protected $_action      = "";
    protected $_controller = "";
    protected $_directory  = "";

    // Instance from the factory
    protected static $_instance = NULL;

    public function __construct()
    {
        $this->_action      = Request::current()->action();
        $this->_controller = Request::current()->controller();
        $this->_directory  = Request::current()->directory();
    }

    public function factory()
    {
        // Store our instance if we don't already have one
        if (self::$_instance == NULL)
        {
            $class = get_class($this);
            self::$_instance = new $class();
        }

        // Return the instance of this class
        return self::$_instance;
    }

    public function set_theme($theme)
    {
        if ($this->_current_theme !== $theme)
        {
            $this->_current_theme = trim($theme);
        }
    }

    public function load()
    {
        // Kohana current modules
        $modules = Kohana::modules();

        // Get all stored theme locations
        $theme_paths = self::$_config->get("theme_dirs");

        // Our themes are stored as modules
        $module_path = array();

        // Assume no directory was found
        $directory_found = FALSE;

        // Default theme if no theme selected
        if ($this->_current_theme == '')
        {
            $this->_current_theme = $this->_default_theme;
        }

        // Iterate over each config theme path
        foreach ($theme_paths AS $name => $path)
        {
            // Create our path; theme_directory + theme_name
            $theme_dir = $path . DIRECTORY_SEPARATOR . $this->_current_theme;

            // The directory exists
            if ( is_dir($theme_dir) )
            {
                // Store this directory as a module
                $module_path[$this->_current_theme] = $theme_dir;

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
    }

}
