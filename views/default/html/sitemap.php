<?='<?xml version="1.0" encoding="UTF-8"?>'."\r\n"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

<?foreach($cats as $cat):?>
	<url>
		<loc><?=hmenu_href("main/index/content", $cat["link"], @$cat["url"])?></loc>
		<lastmod><?=$cat["date"]?></lastmod>
		<changefreq>daily</changefreq>
		<priority><?=$cat["priority"]?></priority>
	</url>
<?endforeach;?>
</urlset>