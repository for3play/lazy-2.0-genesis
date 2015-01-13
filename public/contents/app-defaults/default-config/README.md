Default Configuration (config.php)
---

Environment Specific Configuration
---

Configuration variables that can set depending on the deployment/production environment. Based on the SITEURL variable. This allows for multiple different configurations and will use the configuration based on the deployed environment:

* `DB_HOSTNAME` - Database hostname
* `DB_USERNAME` - Database username
* `DB_PASSWORD` - Database password
* `DB_DBNAME` - Database Name
* `INCLUDEPATH` - Relative path to the core Genesis Framework scripts

`$settings` array variables
---

Template specific variables that are automatically generated to the front end templates:

* `SITEURL` - Automatically generated variable for the absolute path of the application
* `IMAGEPATH` - Default image path, appended to the SITEURL to generate absolute paths
* `SITE_TITLE` - Default general Site Title, can be used in conjuction with PAGE_TITLE in the template
* `PAGE_TITLE` - Default general Page Title, is used in the absence of a page specific PAGE_TITLE tag in the current loaded HTML template
* `META_DESCRIPTION` - Default general Meta Description, is used in the absence of a page specific META_DESCRIPTION tag in the current loaded HTML template
* `META_KEYWORDS` - Default general Meta Keywords, is used in the absence of a page specific META_KEYWORDS tag in the current loaded HTML template

`$templateConfig` array variables
---

These configuration variables can be left as is and only modified on VERY SPECIAL cases:

* `templateDir` - default directory for main template. default: `'theme/html/'`
* `templateFile`- default file for the entire page template. default: `'index.tpl'`
* `contentsPath` - default path for the contents files. default: `'contents/'`
* `defaultContentsFile` - default contents file to load. default: `'default'`
* `defaultTemplateExtension` - default extension for HTML contents templates. default: `'.htm'`
* `defaultContentsFolder` - default contents folder. default: `'default'`
* `default404File` - file to be loaded if no files can be found to render the current URL. default: `'404'`
* `mode` - for future implementation
* `theme` - for future implementation

*All path-related variables are relative to the public index.php and config.php files*
