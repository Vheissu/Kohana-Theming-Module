<?php defined('SYSPATH') or die('No direct script access.');

// Get all config options
Theme::$_config = Kohana::$config->load("theme");

// Create an instance of the Theme library
$theme = Theme::Factory();

// Load any themes
$theme->load();
