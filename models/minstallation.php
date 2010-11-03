<?php
	/*      minstallation.php - this file is part of Micro CMS
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

	function minstallation_check_data($finished = false)
	{
		if ($finished) $perms = '0755';
		else $perms = '0777';

		$permissions = substr(sprintf('%o', fileperms('data')), -4);
		if ($permissions != $perms) return false;

		$permissions = substr(sprintf('%o', fileperms('data/cache')), -4);
		if ($permissions != $perms) return false;

		$permissions = substr(sprintf('%o', fileperms('data/files')), -4);
		if ($permissions != $perms) return false;

		$permissions = substr(sprintf('%o', fileperms('data/galleries')), -4);
		if ($permissions != $perms) return false;

		$permissions = substr(sprintf('%o', fileperms('data/images')), -4);
		if ($permissions != $perms) return false;

		$permissions = substr(sprintf('%o', fileperms('data/scaffolding')), -4);
		if ($permissions != $perms) return false;

		else return true;
	}

	function minstallation_check_config($finished = false)
	{
		if ($finished) $perms = '0755';
		else $perms = '0777';
		$permissions = substr(sprintf('%o', fileperms('conf/config.php')), -4);
		if ($permissions != $perms) return false;
		else return true;
	}
?>