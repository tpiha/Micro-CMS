<?php
	/*      ccontact.php - this file is part of Micro CMS
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

	lloader_load("mail");
	lloader_load("input");
	lloader_load_helper("message");
	lloader_load_helper("form");

	/* Handles sending contant mail
	 */
	function ccontact_send()
	{
		if (hform_validate(array("name", "mail", "message", "captcha")))
		{
			$post_data = linput_post();

			$to = lconf_dbget("contact_mail");
			$from_mail = $post_data["mail"];
			$from_name = $post_data["name"];
			$subject = lconf_dbget("contact_subject");
			$body = $post_data["message"];

			if (strlen($post_data["website"])) $body .= "\n\nMy website: " . $post_data["website"];
			if (lmail_send($to, $from_mail, $from_name, $subject, $body)) hmessage_set(l("Message sent."));
			else hmessage_set(l("Error sending message, please try later."));

			luri_redirect("main/index/contact");
		}
		else luri_redirect("main/index/contact", l("Error sending message. Fields marked with * are required."));
	}
?>