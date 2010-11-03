<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<meta http-equiv="content-Type" content="text/html; charset=utf-8"></meta>
		<title></title>
		<link rel="stylesheet" type="text/css" href="<?=hanchor_shref('views/' . lconf_get('theme') . '/admin/css/style.css', false)?>" />
		<link rel="icon" href="<?=hanchor_shref('favicon.ico', false)?>">
		<script type="text/javascript" src="<?=hanchor_href('main/index/js/variables.js', false, false)?>"></script>
		<script type="text/javascript" src="<?=hanchor_shref('extern/jquery.js', false)?>"></script>
		<script type="text/javascript" src="<?=hanchor_shref('extern/jquery-ui/jquery-ui.js', false)?>"></script>
		<script type="text/javascript" src="<?=hanchor_shref('admin/javascript/admin.js', false)?>"></script>
		<style>
			body {
				background-color: #FAEBD7;
				margin: 0px;
				padding: 0xp;
			}
		</style>
	</head>

	<body name='iframe_uploader'>
		<form enctype="multipart/form-data" action="<?=hanchor_href('uploader/upload')?>" method="post" id="iframe_uploader_form">
			<?=hmessage_get()?>
			<input name="name" type="hidden" id="name" />
			<input name="link" type="hidden" id="link" />
			<input name="gallery_id" type="hidden" value="<?=$gal?>" />
			<label class="label" for="upload">* <?=l('Upload new image')?>:</label><br />
			<input class="input" type="file" name="upload" onchange="handle_iframe_upload();" />
		</form>
	</body>

</html>
