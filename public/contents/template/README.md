Template Render
---

Genesis utilizes the **HTML_Template_ITX** class of the **PHP Extension and Application Repository (PEAR)** library as its main template engine. This allows for total separation of HTML and PHP codes.

By default, two (2) template files are loaded. The main HTML Template, and the current page HTML Template. These files contain purely HTML/CSS/Javascript codes and will be rendered by the `Lazy\TemplateRender` class and any default placeholders are rendered. *see article under "Application Defaults" for a list of default placeholders.*

The PHP file will also be loaded which contains all the PHP code that will control the data flow, and assign values to placeholder variables.

Main Template Object
---

The main template file is loaded (`theme/html/index.tpl`) and can be accessed by the global `$_theme` object.

This is the general layout template of the site and contains the &#123;CONTENTS} placeholder which will be rendered with the output of the contents files.

Contents Template Object
---

The current contents template file is loaded based on the current URL. *See "Routes and Files System.*

The contents template can be accessed by the global `$_contents` object.

Render Class
---

Additional HTML Template objects can be created using the Lazy\Render class.

* `$obj = new lazy\Render(<path>, <filename>)` - to instantiate a new Render Object
* `$obj->setBlank()` - to set the render object's layout to blank
* `$obj->setHTML(<path>, <filename>)` - to replace an existing render object's HTML
* `$obj->get()` - to get the rendered contents of the object, this can be assigned to a variable placeholder on other Render objects to nest templates
* `$obj->show()` - to dispaly the rendered contents of the object outside the main template (this is not advisable and should only be used if developing HTML based APIs


`<path>` should be a relative path to the public directory and `<filename>` should have a, and can have any, file extension

`->setBlank`, `->setHTML()`, `->get()` and `->show()` can also be invoked on the `$_theme` and `$_contents` objects.

Meta Tags
---
Meta tags for the current page can be assigned from the current page's HTML template, stored in content blocks at the beginning of the page. *See article under "Content Blocks" for description on Content Blocks.*

Meta Tag code blocks are structured as:
<pre>
	&lt;!-- BEGIN PAGE_TITLE -->
		&#123;PH_page_title} Title of the current page
	&lt;!-- END PAGE_TITLE -->
	&lt;!-- BEGIN META_DESCRIPTION -->
		&#123;PH_meta_description} META Description of the current page
	&lt;!-- END META_DESCRIPTION -->
	&lt;!-- BEGIN META_KEYWORDS -->
		&#123;PH_meta_keywords} META Keywords of the current page
	&lt;!-- END META_KEYWORDS -->
</pre>

The placeholder variable in each block are required since they will be assigned empty values and are prefixed with "PH_" as to have a unique name.

This is used in conjuction with putting the tag placeholders in you main theme's header.
<pre>
	&lt;meta name="description" content="&#123;META_DESCRIPTION}" />
	&lt;meta name="keywords" content="&#123;META_KEYWORDS}" />
	&lt;title>&#123;PAGE_TITLE}&lt;/title>
</pre>


*You can read more about **PEAR** over at http://pear.php.net/ and **ITX** at http://pear.php.net/package/HTML_Template_IT/docs/latest/HTML_Template_IT/HTML_Template_ITX.html*
