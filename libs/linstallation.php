<?php
	/*      linstallation.php - this file is part of Micro CMS
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

	function linstallation_install()
	{
		$uri_string = luri_get(true);
		if ($uri_string != lroute_get_uri('installation') && $uri_string != lroute_get_uri('installation/submit') && $uri_string != lroute_get_uri('installation/finish')) luri_redirect('installation');
		else if (!lconf_get('install') && ldb_check() && $uri_string != lroute_get_uri('installation/finish')) luri_redirect('installation/finish');

		lloader_load_controller('installation');

		$controller = lroute_get_controller();
		$function = lroute_get_function();
		$function();

		die();
	}

	function linstallation_check()
	{
		$install = false;

		if (lconf_get('install')) $install = true;
		if (!ldb_check()) $install = true;
		if (substr(sprintf('%o', fileperms('conf/config.php')), -4) == '0777') $install = true;

		return $install;
	}
?>
