<?php
	require_once("config.php");

	$gLink = null;

	// Database library init
	function db_init()
	{
		global $gLink, $gConf, $gLang;

		$connection_string = "host=".$gConf["db"]["host"]." port=".$gConf["db"]["port"]." dbname=".$gConf["db"]["dbname"]." user=".$gConf["db"]["user"]." password=".$gConf["db"]["pass"];

		$gLink = pg_connect($connection_string)
		or die($gLang["errors"][0].pg_last_error());

		pg_select_db($gConf["db"]["dbname"])
		or die($gLang["errors"][1].pg_last_error());

		pg_query("SET NAMES 'utf8' COLLATE 'utf8_slovenian_ci'")
		or die($gLang["errors"][2].pg_last_error());
	}

	// Close database connection
	function db_close($db_link = $gLink)
	{
		pg_close($db_link);
	}

	// Sends mysql query
	function db_query($query)
	{
		global $gLang;

		$result = pg_query($query)
		or die($gLang["errors"][2].pg_last_error());

		return $result;
	}

	// Fetches query result
	function db_fetch_array($query_result)
	{
		return pg_fetch_array($query_result);
	}

	// Returns 2D array from query
	function db_query_array($query)
	{
		return pg_fetch_all( db_query($query) );
	}
?>