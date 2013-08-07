<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Theming functionality for your Kohana application
 *
 * @package    Theme
 * @author     Dwayne Charrington
 * @copyright  (c) 2013 Dwayne Charrington + Contributors
 * @license    http://opensource.org/licenses/BSD-3-Clause
 */

return array(

    /**
     * Theme locations.
     *
     * There are 3 possible default locations to search from
     * you can add or remove as you see fit.
     *
     * Order each directory in importance. The first directory
     * if the requested theme is found will have priority over any
     * of the other folders which are fallbacks.
     *
     * If the requested theme for example 'default' does not exist
     * in the module folder 'themes' then the theme will be searched
     * for in the root directory and finally the application directory
     * before failing completely.
     *
     */
    "theme_dirs" => array(
        "module_dir" => MODPATH.'theme' . DIRECTORY_SEPARATOR . 'themes',
        "root_dir"      => DOCROOT.'themes',
        "app_dir"       => APPPATH.'themes',
    ),

);
