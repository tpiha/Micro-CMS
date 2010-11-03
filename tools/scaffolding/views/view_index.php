		<ul>
<? foreach($***NAME*** as $item): ?>
			<li><a href="<?=hanchor_href(lroute_get_uri_complex("***NAME***/read") . $item["id"])?>"><?=(isset($item["name"])) ? $item["name"] : $item["id"]?></a> - <a href="<?=hanchor_href(lroute_get_uri_complex("***NAME***/update") . $item["id"])?>">edit</a></li>
<? endforeach; ?>
		</ul>
		<input class="button" type="button" value="add new" onclick="window.location.href='<?=hanchor_href(lroute_get_uri("***NAME***/create"))?>';" />
