<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Asset library to complement the theming module
 *
 * @package    Theme
 * @subpackage Asset
 * @author     Dwayne Charrington
 * @copyright  (c) 2013 Dwayne Charrington + Contributors
 * @license    http://opensource.org/licenses/BSD-3-Clause
 */

class Kohana_Asset {

    // Populated via init.php
    public static $_config = array();

    public function __construct($theme = FALSE)
    {
        // Load the config
        self::$_config = Kohana::$config->load("asset");
    }


    /**
     * Factory
     *
     * Create a new instance of this class for
     * medicinal purposes only, of course.
     *
     * @return class
     *
     */
    public static function factory()
    {
        return new Asset($theme);
    }

}
