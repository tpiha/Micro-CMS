<?lloader_load_helper("anchor")?>

function admin()
{
	$("#submenu_ul").sortable({stop : update_sortable, axis : "y"});
	$('#date').datepicker({firstDay : 1, dateFormat: 'yy-mm-dd', nextText: '', prevText: ''});
	$('#content').fadeIn(1400);
}

function handle_iframe_upload()
{
	var name = prompt('Image name:', '');
	document.getElementById('name').value = name;
	var link = prompt('Image link:', '');
	document.getElementById('link').value = link;
	document.getElementById('iframe_uploader_form').submit();
}

function handle_iframe_onload(gallery_id)
{
	$('#images').load(hanchor_href + 'admin/publishing/galleries/images/' + gallery_id + '/', '', function(){ $("#images_ul").sortable({stop : update_sortable_images });});
}

function iframe_check()
{
	if (iframe_name != document.body.name)
	{
		iframe_name = document.body.name;
		alert('fdasfsda');
	}
}

function make_link(name)
{
	var link = name.toLowerCase();
	link = link.replace(/ /g, "-");
	link = link.replace(/š/gi, "s");
	link = link.replace(/đ/gi, "dj");
	link = link.replace(/ž/gi, "z");
	link = link.replace(/č/gi, "c");
	link = link.replace(/ć/gi, "c");
	document.getElementById("link").value = link;
}

function make_keywords(name)
{
	var link = name.toLowerCase();
	link = link.replace(/ /g, ", ");
	document.getElementById("keywords").value = link;
}

function make_description(name)
{
	document.getElementById("description").value = name;
}

function update_sortable()
{
	var serialized = $("#submenu_ul").sortable("serialize");
	serialized = serialized.replace(/\[\]/g, "");
	serialized = serialized.replace(/item=/g, "");
	var order = serialized.replace(/&/g, "|");

	$.ajax({
		type: "POST",
		url: '<?=hanchor_href("categories/order")?>',
		data: "order=" + order
	});
}

function update_sortable_images()
{
	var serialized = $("#images_ul").sortable("serialize");
	serialized = serialized.replace(/\[\]/g, "");
	serialized = serialized.replace(/image=/g, "");
	var order = serialized.replace(/&/g, "|");

	$.ajax({
		type: "POST",
		url: '<?=hanchor_href("galleries/order")?>',
		data: "order=" + order
	});
}

$(document).ready(admin);
