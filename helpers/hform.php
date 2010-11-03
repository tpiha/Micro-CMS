<?php
	/*      hform.php - this file is part of Micro CMS
	 *      
	 *      Copyright 2008 Micro CMS
	 * 
	 * 	Authors:
	 * 		- Tihomir Piha <tpiha@kset.org>
	 * 		- Nikola Dušak <vampyr@kset.org>
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
	
	lloader_load_helper("anchor");
	lloader_load_model("cats");
	
	/* Returns an open form tag
	 * <param> <string> action - string containing form action
	 * <param> <array> attributes - array containing HTML attributes name/value
	 * <return> <string> - returns an open HTML form string
	 */
	function hform_open($action, $attributes = false)
	{
		$attributes_string = "";
		
		if ($attributes) foreach ($attributes as $name => $value) $attributes_string .= ' ' . $name . '="' . $value . '"';

		$action = hanchor_href($action);

		$form_string = '<form enctype="multipart/form-data" action="' . $action . '" method="post"' . $attributes_string . 'onsubmit="on_submit();">' . "\n";
		$form_string .= '<p id="captcha">' . "\n";
		$form_string .= '	<label for="captcha">Captcha:</label><br />' . "\n";
		$form_string .= '	<input type="text" value="captcha" name="captcha" id="captcha_input" />' . "\n";
		$form_string .= '</p>' . "\n";
		$form_string .= '<script type="text/javascript">' . "\n";
		$form_string .= '	var _0x43b4=["\x6D\x69\x63\x72\x6F\x5F\x63\x61\x70\x74\x63\x68\x61\x31","\x63\x61\x70\x74\x63\x68\x61\x5F\x69\x6E\x70\x75\x74","\x67\x65\x74\x45\x6C\x65\x6D\x65\x6E\x74\x42\x79\x49\x64","\x76\x61\x6C\x75\x65"];function on_submit(){var _0xc123x2=_0x43b4[0];var _0xc123x3=document[_0x43b4[2]](_0x43b4[1]);_0xc123x3[_0x43b4[3]]=_0xc123x2;} ;' . "\n";
		$form_string .= '	var par = document.getElementById("captcha");' . "\n";
		$form_string .= '	par.style.position = "absolute";' . "\n";
		$form_string .= '	par.style.left = "-1000px";' . "\n";
		$form_string .= '</script>' . "\n";
		return $form_string;
	}
	
	/* Returns a closed form tag
	 * <return> <string> - returns closed html form tag string
	 */
	function hform_close()
	{
		return "</form>";
	}

	/* Validates some form
	 * <param> <array> validate_array - array containing names of variables that should be validated
	 * <return> <boolean> - returns true if form provides data for every variable name from validate array, else false
	 */
	function hform_validate($validate_array, $post_data = false)
	{
		if ($post_data) $data = $post_data;
		else $data = $_POST;
		unset($_POST['captcha']);
		foreach($validate_array as $name)
		{
			if (!isset($data[$name]) || (is_string($data[$name]) && !strlen($data[$name]))) return false;
			if ($name == 'captcha')
			{
				unset($_POST['captcha']);
				if ($data[$name] != 'micro_captcha1') return false;
			}
		}
		return true;
	}

	/* Returns rte (rich text editor or wysiwyg editor control)
	 * <param> <string> name - rte's name
	 * <param> <string> content - initial content
	 * <return> <string> - html for rte
	 */
	function hform_rte($name = "content", $content = "", $width = "600px", $height = "400px")
	{
		$content = str_replace("\r", ' ', $content);
		$content = str_replace("\n", ' ', $content);

		$rte_html = 	'<script type="text/javascript" src="'.hanchor_shref().'extern/rte/richtext.js"></script>
				<script language="JavaScript" type="text/javascript">
				<!--
					function submitForm()
					{
						//make sure hidden and iframe values are in sync before submitting form
						updateRTE("'.$name.'");
						return true;
					}
					initRTE("'.hanchor_shref().'extern/rte/images/", "'.hanchor_shref().'extern/rte/", "'.hanchor_shref().'extern/rte/rte.css");
				//-->
				</script>
				<script language="JavaScript" type="text/javascript">
					<!--
					writeRichText("'.$name.'", "'.addslashes($content).'", "'.$width.'", "'.$height.'", true, false);
					var frame = document.getElementById("'.$name.'").parentNode.parentNode.parentNode;
					if (frame) frame.onsubmit = submitForm;
					//-->
				</script>'."\n";

		return $rte_html;
	}

	/* Returns ' checked ' if postdata is 1 or '' if 0
	 * <param> <integer> postdata - input ckeckbox data (checked or not)
	 * <return> <string> - html for input checkbox ckecked attribute
	 */
	function hform_checked($postdata)
	{
		return $postdata?" checked ":"";
	}
?>
