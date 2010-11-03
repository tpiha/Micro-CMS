<?php
	/*      hpagination.php - this file is part of Micro CMS
	 *      
	 *      Copyright 2009 Micro CMS
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

	lloader_load_helper('anchor');

	/* Function that creates pagination html
	 * <param> <string> uri - uri string (right side of route)
	 * <param> <integer> count - number of all results
	 * <param> <integer> offset - number of results per page
	 * <param> <integer> offset - page number
	 * <return> <string> - pagination html
	 */
	function hpagination($uri, $count, $offset, $page)
	{
		$html = "";
		$pages_num = ceil($count / $offset);
		$pages_offset = 2;

		$page = luri_split($page);
		if (isset($page[1]))
		{
			$item = $page[0] . '/';
			$page = (int) $page[1];
		}
		else
		{
			$item = '';
			$page = $page[0];
		}

		// <<
		if ($page != 1) $html .= '<a href="' . hanchor_href($uri, $item . '1') . '">&lt;&lt;</a>&nbsp&nbsp';
		else $html .= '<span>&lt;&lt;</span>&nbsp;&nbsp;';

		// <
		if ($page != 1) $html .= '<a href="' . hanchor_href($uri, $item . ((string) ($page - 1))) . '">&lt;</a>&nbsp;&nbsp;';
		else $html .= '<span>&lt;</span>&nbsp;&nbsp;';

		// ...
		if ($page - 1 > $pages_offset) $html .= '<span>...</span>&nbsp;&nbsp;';

		// pages
		for ($i = 1; $i <= $pages_num; $i++)
		{
			if ($page - $i <= $pages_offset && $i - $page <= $pages_offset)
			{
				if ($page != $i) $html .= '<a href="' . hanchor_href($uri, $item . ((string) $i)) . '">'.$i.'</a>&nbsp;';
				else $html .= '<a class="active" href="' . hanchor_href($uri, $item . ((string) $i)) . '">'.$i.'</a>&nbsp;';
			}
		}

		// ...
		if ($pages_num - $page > $pages_offset) $html .= '<span>...</span>&nbsp;';

		// >
		if ($page != $pages_num) $html .= '&nbsp;<a href="' . hanchor_href($uri, $item . ((string) ($page + 1))) . '">&gt;</a>';
		else $html .= '&nbsp;<span>&gt;</span>';

		// >>
		if ($page != $pages_num) $html .= '&nbsp;&nbsp;<a href="' . hanchor_href($uri, $item . ((string) $pages_num)) . '">&gt;&gt;</a>';
		else $html .= '&nbsp;&nbsp;<span>&gt;&gt;</span>';

		return $html;
	}
?>
