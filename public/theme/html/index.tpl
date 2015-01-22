<html>
<head>
	<link rel="stylesheet" type="text/css" href="{SITEURL}theme/css/main.css">
	<link rel="stylesheet" type="text/css" href="{SITEURL}theme/css/jquery-ui-1.11.2/jquery-ui.min.css">
	<script type="text/javascript" src="{SITEURL}js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="{SITEURL}js/jquery-ui.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="{META_DESCRIPTION}" />
	<meta name="keywords" content="{META_KEYWORDS}" />
	<title>{PAGE_TITLE}</title>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="main-logo" class="float-left"><img src="{IMAGEPATH}genesis-logo.png" alt="logo"></div>
		<div id="header-right" class="float-right">
			<div id="login-info"></div>
			<div id="header-help"></div>
		</div> <!-- #header-right -->
		<div class="clear"></div>
	</div> <!-- #header -->
	<div id="subheader">
		<div class="sidebar float-left"></div>
		<div id="subheader-text">
			<div class="page-title">{PAGE_TITLE}</div>
			<div class="clear"></div>
		</div> <!-- #subheader-text -->
		<div class="clear"></div>
	</div> <!-- #subheader -->
	<div id="innerwrap">
		<div id="sidebar">
			<div id="nav">
				<ul>
					<li><a href="{SITEURL}" class="{URL-default}">Home</a></li>
					<li><a href="{SITEURL}about/" class="{URL-about}">About</a></li>
					<li><a href="{SITEURL}app-defaults/" class="{URL-app-defaults}">Application Defaults</a>
						<ul class="submenu">
							<li><a href="{SITEURL}app-defaults/default-config" class="{URL-app-defaults.default-config}">Default Configuration</a></li>
						</ul>
					</li>
					<li><a href="{SITEURL}app-controller/" class="{URL-app-controller}">Application Controller</a>
						<ul class="submenu">
							<li><a href="{SITEURL}app-controller/routes-files/" class="{URL-app-controller.routes-files}">Routes &amp; File System</a></li>
						</ul>
					</li>
					<li><a href="{SITEURL}template/"  class="{URL-template}">Template Render</a>
						<ul class="submenu">
							<li><a href="{SITEURL}template/variable-assignment/" class="{URL-template.variable-assignment}">Variable Assignment</a></li>
							<li><a href="{SITEURL}template/content-blocks/" class="{URL-template.content-blocks}">Content Blocks</a></li>
						</ul>
					</li>
					<li><a href="{SITEURL}data-controller/" class="{URL-data-controller}">Data Controller</a>
						<ul class="submenu">
							<li><a href="{SITEURL}data-controller/demonstration/" class="{URL-data-controller.demonstration}{URL-data-controller.demonstration.edit}{URL-data-controller.demonstration.add}{URL-data-controller.demonstration.update}">Demonstration</a></li>
						</ul>
					</li>
					<li><a href="{SITEURL}grid/" class="{URL-grid}">Data Grid</a></li>

					</li>
				</ul>
			</div> <!-- #nav -->
		</div> <!-- #sidebar -->

		<div id="contents">
			{CONTENTS}
			{readme}
		</div> <!-- #contents -->
		<div class="clear"></div>
	</div> <!-- #innerwrap -->
	<div id="footer">
		 Debug information: <span class="debug"> HTML file: ({CONTENTS_PATH}/{CONTENTS_FILENAME}.htm) | PHP file: ({php_file}) | Readme file: ({readme_file})</span>
	</div> <!-- #footer -->
</div> <!-- #wrapper -->
</body>
</html>
