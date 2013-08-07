<?php defined('SYSPATH') or die('No direct script access.');

class View extends Kohana_View {

    /**
     * Set Filename
     *
     * By default set_filename looks in the views directory
     * throughout the CFS. We want the function to
     * acknowledge we have a theme to search as well.
     *
     */
    public function set_filename($file)
    {
        $theme = Theme::factory();

        // A current theme exists
        if ( !empty($theme->current_theme()) )
        {
            // Get current theme info
            $current = $theme->current_theme();

            // A theme view file could not be found
            if ( ($path = Kohana::find_file($current['path'], $file) === FALSE || ($path = Kohana::find_file($current['path'] . DIRECTORY_SEPARATOR . 'views', $file)) === FALSE || ($path = Kohana::find_file('views', $file)) === FALSE )
            {
                throw new View_Exception('The requested view :file could not be found in theme directory or view directory.', array(
                    ':file' => $file,
                ));
            }
        }
        else
        {
            if ( ($path = Kohana::find_file('views', $file)) === FALSE )
            {
                throw new View_Exception('The requested view :file could not be found.', array(
                    ':file' => $file,
                ));
            }
        }

        // Store the file path locally
        $this->_file = $path;

        return $this;
    }

}
