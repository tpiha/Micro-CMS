<?php
	/*      config.php - this file is part of Micro CMS
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

	// System configuration data
	// =============================================================

		// Site URL (WITH TRAILING SLASH)
		$gconf['url'] = 'http://www.micro-cms.loc/';
		// Default system theme
		$gconf['theme'] = 'default';
		// Default system language
		$gconf['lang'] = 'en';
		// Use subdomains as uri
		$gconf['subdomains'] = false;
		// Install Micro CMS
		$gconf['install'] = false;

	// Database configuration data
	// =============================================================

		// Database type - 'my' for mysql, 'pg' for postgre
		$gconf['db_type'] = 'my';
		// Database name
		$gconf['db_name'] = 'micro-cms';
		// Database user
		$gconf['db_user'] = 'tpiha';
		// Database password
		$gconf['db_pass'] = 'K7EwXm2h2A';
		// Database hostname
		$gconf['db_host'] = 'localhost';
		// Database port (mysql = 3306, pgsql = 5432)
		$gconf['db_port'] = '3306';

	// Mail configuration data
	// =============================================================

		// Smtp server hostname
		$gconf['smtp_server'] = 'localhost';
		// Smtp server port
		$gconf['smtp_port'] = 25;
?>
