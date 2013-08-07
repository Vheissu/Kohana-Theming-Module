Kohana Theming Module
=====================

A module for Kohana 3.3+ that allows you to implement theming functionality into your applications.

##Installation
Clone the contents into your modules directory located in the root directory of your Kohana application, edit application/bootstrap.php and load the module.

Please make sure you call your module "theme", if you decide on a different name, please update the configuration file to reflect this.

##Configuration
By default 3 different directories are specified in config/theme.php. The way the theming system works is by an order of priority, meaning the first location has higher priority over the second, third and so on. So if the requested view file is found in your particular location and theme directory, any other fallback location is ignored.

##Usage
You load your views like you would usually do so. View::factory("viewfile") and then work with the contents. Each theme must have a views folder inside of it for Kohana to find any requested views to load.
