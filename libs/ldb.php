<?php
	lloader_load('conf');

	// Loads actual library
	function ldb_load_db_library()
	{
		switch (lconf_get('type'))
		{
			case 'pg':
				require_once('libs/db/ldbpg.php');
				break;
			default:
				require_once('libs/db/ldbmy.php');
		}
	}

	// Library init
	ldb_load_db_library();
?>
