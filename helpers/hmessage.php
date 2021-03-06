<?
	/*      hmessage.php - this file is part of Micro CMS
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

	@session_start();

	/* Sets flash message
	 * <param> <string> message - string containing flash message
	 * <param> <string> <name> - message name
	 */
	function hmessage_set($message, $name = "message")
	{
		$_SESSION[$name] = $message;
	}

	/* Gets flash message if set
	 * <param> <string> <name> - message name
	 * <return> <string/boolean> - flash message if set, else false
	 */
	function hmessage_get($name = "message", $clean = true)
	{
		if (isset($_SESSION[$name]))
		{
			$message = $_SESSION[$name];
			if ($clean) hmessage_unset($name);
			return $message;
		}
		else return false;
	}

	/* Unsets flash message if set
	 * <param> <string> <name> - message name
	 */
	function hmessage_unset($name = "message")
	{
		unset($_SESSION[$name]);
	}
?>
