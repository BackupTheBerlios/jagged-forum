<?php
require_once('PEAR.php');
require_once('DB.php');
require_once('config.php');

/* Connect to the database.
   Returns FALSE if it could not connect.
   Returns a PEAR db object if successful. */
function db_connect() {
	global $db_type, $db_user, $db_passwd, $db_protocol, $db_host, $db_name;

	/* Connection string based on the user supplied variables in config.php */
	$dsn = "$db_type://$db_user:$db_passwd@$db_protocol($db_host)/$db_name";

	/* Connect to the database. */
	$db = DB::connect($dsn, TRUE);
	
	if ( DB::isError($db) ) {
		//die($db->getMessage());
		return FALSE;
	}

	return $db;
}
?>
