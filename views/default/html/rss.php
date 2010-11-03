<?='<?xml version="1.0" encoding="utf-8" ?>'?>
<rss version="2.0">

<channel>
  <title><?=$title?></title>
  <link><?=hanchor_shref()?></link>
  <description><?=$description?></description>
<?php foreach($content as $item): ?>
  <item>
    <title><?=$item["name"]?></title>
    <link><?=hanchor_href("main/index/content", $item["link"])?></link>
    <guid><?=hanchor_href("main/index/content", $item["link"])?></guid>
    <description><?=hstring_smart_shorten($item["body"], 200)?></description>
    <pubDate><?=date('D, j M Y H:i:s', strtotime($item["updated"])); ?></pubDate>
  </item>
<?php endforeach; ?>
</channel>

</rss>