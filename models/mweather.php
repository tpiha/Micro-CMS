<?php
	/*      mweather.php - this file is part of Micro CMS
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

	function mweather_read($city)
	{
		$table = llang_table('weather');
		return lcrud_read_simple($table, $city);
	}

	function mweather_read_all()
	{
		$table = llang_table('weather');
		return lcrud_read($table);
	}

	function mweather_system_read($city)
	{
		$cities = array('zg' => 'LDZA', 'pu' => 'LDPL', 'ri' => 'LDRI', 'zd' => 'LDZD', 'st' => 'LDSP', 'du' => 'LDDU', 'si' => 'LDSB');
		$weather = array('temp' => '', 'rehu' => '', 'wind' => '');

		exec('weather-util -i ' . $cities[$city], $result);

		array_shift($result);
		array_shift($result);

		foreach ($result as $line)
		{
			$split = split(':', $line);
			if (trim($split[0]) == 'Temperature') $weather['temp'] = trim($line);
			else if (trim($split[0]) == 'Relative Humidity') $weather['rehu'] = trim($line);
			else if (trim($split[0]) == 'Wind') $weather['wind'] = trim($line);
		}

		return $weather;
	}

	function mweather_update()
	{
		$cities = array('zg', 'pu', 'ri', 'zd', 'st', 'du', 'si');
		$table = llang_table('weather');

		foreach ($cities as $city)
		{
			$city_data = mweather_system_read($city);
			lcrud_update_simple($table, $city, $city_data);
		}
	}
?>