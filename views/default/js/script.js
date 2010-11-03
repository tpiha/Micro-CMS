function main()
{
	$("#content").fadeIn(1400);
	$("a[@rel*=lightbox]").lightBox();
}

function toggle_fade(element)
{
	var elm = document.getElementById(element);
	if (elm.style.display == "none") $('#' + element).fadeIn(1400);
	else $('#' + element).fadeOut(1400);
}

function delete_comment(comment_id)
{
	$.ajax({
		type: "GET",
		url: hanchor_href + 'comments/delete/' + comment_id + '/',
		success : on_delete_comment
	});
	//~ $('#comments1').load(hanchor_href + 'comments/delete/' + comment_id + '/', '');
}

function on_delete_comment(response)
{
	document.getElementById('comments1').innerHTML = response;
	var comments_link = document.getElementById('comments_link');
	var comments = parseInt(comments_link.innerHTML.split('(')[1].split(')')[0]) - 1;
	comments_link.innerHTML = comments_link.innerHTML.split('(')[0] + '(' + comments + ')';
}

$(document).ready(main);