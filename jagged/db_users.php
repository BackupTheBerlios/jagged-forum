<?php
require_once('db_funcs.php');
require_once('config.php');

/* Adds a user to the database.
   Returns TRUE if successful.
   Returns FALSE if unsuccessfu. */
function db_addUser($uname, $passwd, $email, $alias, $sid) {
	global $db_prefix;
	
	$db = db_connect();

	if ( $db != FALSE ) {
		$sql = "INSERT INTO {$db_prefix}users (uname, passwd, email, alias, sid1)";
		$sql .= " VALUES('$uname', '$passwd', '$email', '$alias', '$sid')";
		
		$result = $db->query($sql);

		if ( DB::isError($result) ) {
			// FIXME need an error message here.
			//return FALSE;
			die($result->getMessage());
		}

		return TRUE;
	} else {
		die("Could not connect to the database.<br />File db_users.php. Function db_addUser.");
		return $db;
	}
}

/* Retrieve the list of registered users.
   Returns a sorted array on success.
   Returns FALSE on failure.
	FIXME need more options. */
function db_userList($limit) {
	global $db_prefix;

	$db = db_connect();

	if ( $db != FALSE ) {
		$sql = "SELECT * FROM {$db_prefix}users ORDER BY alias";

		$result = $db->query($sql);

		if ( DB::isError($result) ) {
			// FIXME need an error message here.
			return FALSE;
		}

		for ( $i = 0; $row = $result->fetchRow(DB_FETCHMODE_ASSOC); $i++ ) {
			$data[$i]['alias'] = $row['alias'];
			$data[$i]['email'] = $row['email'];
		}

		return $data;
	} else {
		die("Could not connect to the database.<br />File db_users.php. Function db_userList.");
		return $db;
	}
}
?>
