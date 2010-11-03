<?php
	/*      routes.php - this file is part of Micro CMS
	 *      
	 *      Copyright 2008 Micro CMS
	 * 
	 * 	Authors:
	 * 		- Tihomir Piha <tpiha@kset.org>
	 *      
	 *      This program is free software; you can redistribute it and/or modify
	 *      it under the terms of the GNU Lesser General Public License as published by
	 *      the Free Software Foundation; either version 2 of the License, or
	 *      (at your option) any later version.
	 *      
	 *      This program is distributed in the hope that it will be useful,
	 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *      GNU Lesser General Public License for more details.
	 *      
	 *      You should have received a copy of the GNU Lesser General Public License
	 *      along with this program; if not, write to the Free Software
	 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
	 *      MA 02110-1301, USA.
	 *
	 *      Original license: http://www.gnu.org/licenses/lgpl.html
	 */

	// Registered routes (controllers) data - FRONTEND
	// -----------------------------------------------------------------

		// Articles and categories
		$gconf['routes']['/'] = 'main/item/content';
		$gconf['routes']['/*'] = 'main/item/content';

		// Search
		$gconf['routes']['search'] = 'content/search';

		// Contact
		$gconf['routes']['contact'] = 'main/index/contact';
		$gconf['routes']['contact/send'] = 'contact/send';

		// Comments
		$gconf['routes']['comments/send'] = 'comments/send';
		$gconf['routes']['comments/delete/*'] = 'comments/delete';

		// Sitemap
		$gconf['routes']['sitemap'] = 'main/index/sitemap';

		// Galleries
		$gconf['routes']['galleries'] = 'main/index/galleries';
		$gconf['routes']['galleries/*'] = 'main/item/galleries_show';

		// Files
		$gconf['routes']['js/variables.js'] = 'main/index/js/variables.js';
		$gconf['routes']['rss.xml'] = 'main/index/rss';
		$gconf['routes']['sitemap.xml'] = 'main/index/sitemapxml';

		// Test
		$gconf['routes']['test'] = 'test';

	// Registered routes (controllers) data - BACKEND
	// -----------------------------------------------------------------

		// Installation
		$gconf['routes']['installation'] = 'installation';
		$gconf['routes']['installation/submit'] = 'installation/submit';
		$gconf['routes']['installation/finish'] = 'installation/finish';

		// Admin stuff
		$gconf['routes']['admin'] = 'main/user/admin/admin';
		$gconf['routes']['admin/langs/*'] = 'langs/change_admin';
		$gconf['routes']['admin/login'] = 'main/index/admin/login';
		$gconf['routes']['admin/login/submit'] = 'users/submit';
		$gconf['routes']['admin/logout'] = 'users/logout';
		$gconf['routes']['admin/configuration'] = 'main/user/admin/configuration';
		$gconf['routes']['admin/publishing'] = 'main/user/admin/publishing';
		$gconf['routes']['admin/javascript/admin.js'] = 'main/index/admin/js/admin.js';

		// Configuration
		$gconf['routes']['admin/configuration/settings'] = 'main/user/admin/settings';
		$gconf['routes']['admin/configuration/settings/update'] = 'settings/update';

		// User profile
		$gconf['routes']['admin/configuration/profile'] = 'main/user/admin/profile';
		$gconf['routes']['admin/configuration/profile/update'] = 'users/update';

		// Content
		$gconf['routes']['admin/publishing/content'] = 'main/user/admin/content';
		$gconf['routes']['admin/publishing/content/create'] = 'main/user/admin/content_create';
		$gconf['routes']['admin/publishing/content/create_submit'] = 'content/create';
		$gconf['routes']['admin/publishing/content/update/*'] = 'main/user_item/admin/content_update';
		$gconf['routes']['admin/publishing/content/update_submit'] = 'content/update';
		$gconf['routes']['admin/publishing/content/delete/*'] = 'content/delete';
		$gconf['routes']['admin/publishing/content/images_detele/*'] = 'content/images_delete';

		// Categories
		$gconf['routes']['admin/publishing/categories'] = 'main/user/admin/categories';
		$gconf['routes']['admin/publishing/categories/create'] = 'main/user/admin/categories_create';
		$gconf['routes']['admin/publishing/categories/create_submit'] = 'categories/create';
		$gconf['routes']['admin/publishing/categories/update/*'] = 'main/user_item/admin/categories_update';
		$gconf['routes']['admin/publishing/categories/update_submit'] = 'categories/update';
		$gconf['routes']['admin/publishing/categories/delete/*'] = 'categories/delete';
		$gconf['routes']['admin/publishing/categories/order'] = 'categories/order';

		// Galleries
		$gconf['routes']['admin/publishing/galleries'] = 'main/user/admin/galleries';
		$gconf['routes']['admin/publishing/galleries/create'] = 'main/user/admin/galleries_create';
		$gconf['routes']['admin/publishing/galleries/create_submit'] = 'galleries/create';
		$gconf['routes']['admin/publishing/galleries/update/*'] = 'main/user_item/admin/galleries_update';
		$gconf['routes']['admin/publishing/galleries/image_update/*'] = 'main/user_item/admin/galleries_image_update';
		$gconf['routes']['admin/publishing/galleries/image_update_submit'] = 'galleries/image_update';
		$gconf['routes']['admin/publishing/galleries/image_delete/*'] = 'galleries/image_delete';
		$gconf['routes']['admin/publishing/galleries/update_submit'] = 'galleries/update';
		$gconf['routes']['admin/publishing/galleries/delete/*'] = 'galleries/delete';
		$gconf['routes']['admin/publishing/galleries/iframe_upload'] = 'uploader/upload';
		$gconf['routes']['admin/publishing/galleries/images/*'] = 'galleries/images';
		$gconf['routes']['admin/publishing/galleries/order'] = 'galleries/order';
		$gconf['routes']['admin/publishing/galleries/iframe_uploader/*'] = 'uploader';
?>
