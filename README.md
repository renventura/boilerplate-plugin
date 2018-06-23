# Boilerplate Plugin


## Description

A starting point for WordPress plugin development.


## Usage

### Command Line :smiley:

This boilerplate plugin was intended to be used with a BASH script to automate the creation of custom WordPress plugins. The [wp-plugin](https://gist.github.com/renventura/1991c080e432ba86504183e8d313a38a) script will walk you through the bootstrapping by asking a series of questions, then spitting out a ready-to-go plugin!

### Manually :confounded:

This boilerplate can also be used manually by doing a find-and-replace for the boilerplate variables.

```
%PLUGIN_KEY% - Think of this as the directory name with hyphens (e.g. my-plugin)
%PLUGIN_PREFIX% - Same as %PLUGIN_KEY%, but with underscores
%PLUGIN_CONSTANT_PREFIX% - Same as %PLUGIN_KEY%, but with underscores and all capital letters (for constants)
%PLUGIN_DOMAIN% - Used in composer.json
%PLUGIN_NAMESPACE% - Used for namspace and main class name
%PLUGIN_NAME% - Name of the plugin; used in the plugin header
%PLUGIN_DESCRIPTION% - Description of the plugin; used in the plugin header
%PLUGIN_URI% - URI of the plugin (e.g. sales page); used in the plugin header
%PLUGIN_AUTHOR% - Name of the author; used in the plugin header
%AUTHOR_URI% - URI of the author; used in the plugin header
%AUTHOR_EMAIL% - Email of the author; used in copyright and license text
%AUTHOR_NAMESPACE% - Not currently used anywhere
%GIT_REPO_URI% - Used in package.json
%TEXT_DOMAIN% - Text domain for translations
%YEAR% - Current year; used in copyright and license text
```

### Special Thanks

[WPSwitzerland](https://github.com/WPSwitzerland/) for their [plugin-builder BASH script](https://github.com/WPSwitzerland/plugin-builder), and [plugin boilerplate](https://github.com/WPSwitzerland/plugin-boilerplate-wordpress). I used their concept of boilerplate variables, and customized the plugin-builder script to fit my personal plugin boilerplate.
