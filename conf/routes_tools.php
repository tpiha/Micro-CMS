<?php
	/*      routes_tools.php - this file is part of Micro CMS
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

	// Registered routes (controllers) data - TOOLS
	// -----------------------------------------------------------------

		$gconf["routes"]["scaffolding"] = "scaffolding";
		$gconf["routes"]["scaffolding/*"] = "scaffolding/run";
		$gconf["routes"]["scaffolding/create"] = "scaffolding/create";

		$gconf["routes"]["documentation/docs"] = "docs";
		$gconf["routes"]["documentation/docs/gen"] = "docs/generate";
		$gconf["routes"]["documentation/docs/*"] = "docs/cat";
?>
