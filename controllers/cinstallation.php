<?php
	/*      cinstallation.php - this file is part of Micro CMS
	 *      
	 *      Copyright 2007-PRESENT Micro CMS
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

	lloader_load('input');
	lloader_load_helper('anchor');
	lloader_load_helper('message');
	lloader_load_helper('form');
	lloader_load_model('installation');

	function cinstallation_index()
	{
		$data_dir = minstallation_check_data();
		if ($data_dir)
		{
			$config = minstallation_check_config();
			if ($config)
			{
				$data['subview'] = 'admin/subs/installation';
				lloader_load_view('admin/html/installation', $data);
			}
			else
			{
				$data['subview'] = 'admin/subs/message';
				hmessage_set('Chmod \'conf/config.php\' file to 777.<br />Click <a href="javascript: void null;" onclick="window.location.reload()">here</a> when done.');
				lloader_load_view('admin/html/installation', $data);
			}
		}
		else
		{
			$data['subview'] = 'admin/subs/message';
			hmessage_set('Chmod \'data\' folder <strong style="font-weight: bold;">RECURSIVELY</strong> to 777.<br />Click <a href="javascript: void null;" onclick="window.location.reload()">here</a> when done.');
			lloader_load_view('admin/html/installation', $data);
		}
	}

	function cinstallation_submit()
	{
		if (hform_validate(array('db_name', 'db_user', 'db_pass', 'url')))
		{
			$config_file = lfile_read('tools/config.php');
			$post_data = linput_post();

			$config_file = lstring_replace($config_file, '***URL***', $post_data['url']);
			$config_file = lstring_replace($config_file, '***DB_NAME***', $post_data['db_name']);
			$config_file = lstring_replace($config_file, '***DB_PASS***', $post_data['db_pass']);
			$config_file = lstring_replace($config_file, '***DB_USER***', $post_data['db_user']);

			lfile_write('conf/config.php', $config_file);

			$sql_file = file('documents/install.sql');

			$_SESSION['skip_db'] = false;
			$templine = '';

			global $gconf;
			$gconf['db_name'] = $post_data['db_name'];
			$gconf['db_user'] = $post_data['db_user'];
			$gconf['db_pass'] = $post_data['db_pass'];

			foreach($sql_file as $line)
			{
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
				$templine .= $line;
				if (substr(trim($line), -1, 1) == ';')
				{
					ldb_query($templine);
					$templine = '';
				}
			}

			luri_redirect('installation/finish');
		}
		else
		{
			$data['subview'] = 'admin/subs/installation';
			hmessage_set(l('All fields marked with * are neccessary.'));
			lloader_load_view('admin/html/installation', $data);
		}
	}

	function cinstallation_finish()
	{
		$config = minstallation_check_config(true);
		if ($config)
		{
			$data['subview'] = 'admin/subs/message';
			hmessage_set('Installation successfully finished.<br />Click <a href="' . lconf_get('url') . '">here</a> to see your site.');
			lloader_load_view('admin/html/installation', $data);
		}
		else
		{
			$data['subview'] = 'admin/subs/message';
			hmessage_set('Chmod \'conf/config.php\' file back to 755.<br />Click <a href="javascript: void null;" onclick="window.location.reload()">here</a> when done.');
			lloader_load_view('admin/html/installation', $data);
		}
	}
?>