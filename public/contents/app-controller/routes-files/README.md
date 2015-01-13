URL and Folder structure relationship
---

The URL and folder information are processed by the `Lazy\Routing` and `Lazy\BaseApp` classes.

Route information can be retrieved by getting the static variable in the $app object: `$app::$route` which returns the route information array with these variables:
* `$app::$route['path']`: current folder path
* `$app::$route['fileName']`: current filename without file extension
* `$app::$route['uri']`: full URI path (returns empty if the current page is the homepage)

Loaded files will be based on the URI. Browsing to the home directory will load both `contents/default/default.htm` as the template, and `contents/default/default.php` as the backend file.

Internal contents are be based on the depth of the URL and the structure of the folder, example: `http://hostname.com/about/` will check if either `contents/about/default.htm` and/or `contents/about/default.php` exists, if not, it will proceed to check `contents/about.htm` and `contents/about.php` exists, and if neither check succeeds, it will load `contents/404.htm` as the display template.

The framework does not limit the number of folders in the URL.

Example:
* `http://hostname.com/universe/solarsystem/milkyway/earth/`
  * will trigger a check for `contents/universe/solarsystem/milyway/earth/default.htm` and/or `contents/universe/solarsystem/milyway/earth/default.php`
  * if the first check fails it will then check `contents/universe/solarsystem/milyway/earth.htm` and/or `contents/universe/solarsystem/milyway/earth.php`
  * if the second check still fails, it will load the default 404 file (`contents/404.htm`)

Global files are also loaded along with the contents files. A single `global.php` file is loaded and executed on all pages found under `contents/global.php`.

Section specific which are loaded based on the current folder path are also loaded. They can be found in each respective section folder based on the location of the HTML and PHP files of the current URL.

Example:

* `http://hostname.com/universe/solarsystem/milkyway/earth/`
  * if `contents/universe/solarsystem/milyway/earth/default.htm` and/or `contents/universe/solarsystem/milyway/earth/default.php` loaded, `contents/universe/solarsystem/milyway/earth/global.php` will be loaded
  * if `contents/universe/solarsystem/milyway/earth.htm` and/or `contents/universe/solarsystem/milyway/earth.php` is used, `contents/universe/solarsystem/milyway/global.php` will be loaded

*The `contents/global.php` file in this documentation loads the 'README.md' information for the current page based on the URL and parses the debug information found at the footer.*
