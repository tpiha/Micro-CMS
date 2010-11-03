<?php
	/*
	 *      lfile.php - this file is part of Micro CMS
	 *      
	 *      Copyright 2008 Micro CMS
	 * 
	 * 	Authors:
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

	/* Saves content to the file
	 * <param> <string> file - path to the file
	 * <param> <string> content - content that should be saved into the file
	 * <return> <boolean> - true if saved, else false
	 */
	function lfile_write($file, $content)
	{
		if ($fp = fopen($file, 'w'))
		{
			return fwrite($fp, $content);		
		}
		else return false;
	}

	/* Reads content of the file
	 * <param> <string> file - path to the file
	 * <return> <string/boolean> - returns string if the file is readable, else false
	 */
	function lfile_read($file)
	{
		if (file_exists($file) && is_readable($file))
		{
			$fp = fopen($file, 'r');
			return fread($fp, filesize($file));	
		}
		else return false;
	}
	
	/* Adds content to the end of the file if the file exists, else creates the file
	 * <param> <string> file - path to file
	 * <param> <string> content - content that should be added at the end of the file
	 * <return> <boolean> - true if added or created, else false
	 */
	function lfile_append($file, $content)
	{
		if ($fp = fopen($file, 'a'))
		{
			return fwrite($fp, $content);		
		}
		else return false;
	}
	
	/* Deletes a file, and returns true if it exists and was deleted deleted, else false
	 * <param> <string> uri_string - path to the file
	 * <return> <boolean> - true if existing and deleted, else false
	 */
	function lfile_delete($path)
	{
		if (file_exists($path)) return unlink($path);
		else return false;
	}

	/* Deletes directory recursively
	 * <param> <string> path - path to directory
	 * <return> <boolean> - true on success, else false
	 */
	function lfile_delete_dir($path)
	{
		return lfile_empty_dir($path, true);
	}

	/* Empties directory
	 * <param> <string> path - path to directory
	 * <param> <boolean> delete_dir - delete parent dir
	 * <return> <boolean> - true on success, else false
	 */
	function lfile_empty_dir($path, $delete_dir = false)
	{
		if (is_dir($path)) $dir_handle = opendir($path);
		if (!$dir_handle) return false;

		while ($file = readdir($dir_handle))
		{
			if ($file != '.' && $file != '..' && $file != '.svn')
			{
				if (!is_dir($path . '/' . $file))
				{
					if (!@unlink($path . '/' . $file)) lerror_log(l('lfile_empty_dir on line 105 - couldn\'t delete file: ' . $path . '/' . $file));
				}
				else lfile_delete_dir($path . '/' . $file);          
			}
		}

		closedir($dir_handle);

		if ($delete_dir)
		{
			if (!@rmdir($path)) lerror_log(l('lfile_empty_dir on line 115 - couldn\'t delete directory: ' . $path));
		}

		return true;
	}

	/* Handles file upload (only images allowed at the time)
	 * <param> <string> inputname - name of the file input form
	 * <param> <string> filename - filename with extension
	 * <param> <string> path - path to directory where to file is being uploaded
	 * <return> <boolean> - true on success else false
	 */
	function lfile_upload($inputname, $filename, $path = false)
	{
		if (!$path) $path = 'data/files/';

		if ($_FILES[$inputname]['error'] > 0)
		{
			lerror_log($_FILES[$inputname]['error']);
			return false;
		}
		else if ((($_FILES[$inputname]['type'] == 'image/gif') || ($_FILES[$inputname]['type'] == 'image/jpeg') || ($_FILES[$inputname]['type'] == 'image/jpg') || ($_FILES[$inputname]['type'] == 'image/png') || ($_FILES[$inputname]['type'] == 'image/bmp')) && ($_FILES[$inputname]['size'] < 20000000))
		{
			move_uploaded_file($_FILES[$inputname]['tmp_name'], $path . $filename);
			return true;
		}
		else
		{
			lerror_log(l('File upload error: invalid file type of file size - ') . $_FILES[$inputname]['type']);
			return false;
		}
	}

	/* Copies file from one place to another if exists
	 * <param> <string> from - copy from
	 * <param> <string> to - copy to
	 * <return> <boolean> - true on success else false
	 */
	function lfile_copy($from, $to)
	{
		if (file_exists($from)) return copy($from, $to);
		else return false;
	}

	/* Moves file from one place to another if exists
	 * <param> <string> from - move from
	 * <param> <string> to - move to
	 * <return> <boolean> - true on success else false
	 */
	function lfile_move($from, $to)
	{
		if (file_exists($from)) return rename($from, $to);
		else return false;
	}

	function lfile_create_dir($path)
	{
		return mkdir($path);
	}
?>
