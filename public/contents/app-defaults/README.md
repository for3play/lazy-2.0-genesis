Application Instantiated Objects & Defaults
---

* $app - main app controller
* $_theme - main theme template object
* $_contents - main content template object
* $_session - main app session controller

Template Render Default Placeholders
---

* &#123;SITEURL} - absolute path of the project/site
* &#123;IMAGEPATH} - absolute path of the image directory
* &#123;PAGE_TITLE} - title of page. Can be set as meta tag parameter inside the template (.htm) file
* &#123;META_DESCRIPTION} - META Description of page. Can be set as meta tag parameter inside the template (.htm) file
* &#123;META_KEYWORDS} - META Keywords of page. Can be set as meta tag parameter inside the template (.htm) file
* &#123;CONTENTS_PATH} - folder path of the current page
* &#123;CONTENTS_FILENAME} - filename of the current page (without file extension)
* &#123;CONTENTS} - rendered contents of the current page
* &#123;NAV-[current URL]} - placeholder for current URL that will be replaced with "url-active" and can be used to highlight current page link via CSS.
	* Default or Home page should be set to &#123;NAV-default}
	* Slashes (/) are replaced with periods (.)
	* Value is URL less domain and main folder. (This page is "app-defaults" and is set as "NAV-app-defaults" in the link's class, see "theme/html/index.tpl")

Default Folder & File structure
---

* `theme/html/` - default template folder
* `theme/html/css/` - default css folder
* `theme/html/index.tpl` - default template
* `contents/` - default contents folder
* `contents/default/` - default top-level folder
* `contents/default/default.htm` - default template file for index and is loaded as the home page
* `contents/default/default.php` - default backend file for index and is parsed with the home page
* `contents/global.php` - site-wide backend script which will be parsed for all pages
* `contents/<section(s)>/global.php` - section/folder wide backend script which will be parsed ONLY within the specific folder/section
* `images/` - default images folder
* `src/` - suggested raw source folder (for SASS and raw JS for minifying)
* `src/css/` - suggested raw SASS folder
* `src/js/` - suggested raw JS folder
* `js/` - suggested JS folder for production (or for output of minifying)
* `logs/` - default log folder
* `libs/` - suggested project-specific PHP file folder
* `config.php` - default configuration file
