<?php
require_once('config.php');
require_once('db_funcs.php');

function open($save_path, $session_name) {
	global $db;
	$db = db_connect();

	if ( $db != FALSE ) {
		return TRUE;
	} else {
		return $db;
	}
}

function close() {
	return TRUE;
}

function read($sid) {
	global $db, $db_prefix;
	$lifetime = get_cfg_var("session.gc_maxlifetime");

	$sql = "SELECT value FROM {$db_prefix}sessions WHERE SID='$sid' AND expiration > '$lifetime'";

	$result = $db->getOne($sql);

	if ( $result ) {
		return $result;
	} else {
		return "";
	}
}

function write($sid, $data) {
	global $db, $db_prefix;
	$lifetime = get_cfg_var("session.gc_maxlifetime");

	$sql = "SELECT SID FROM {$db_prefix}sessions WHERE SID='$sid'";

	if ( $db->getOne($sql) ) {
		/* Update an existing session. */
		$expire = time() + $lifetime;
		$sql = "UPDATE {$db_prefix}sessions SET value='$data', expiration='$expire' WHERE SID='$sid'";
		$db->query($sql);
	} else {
		/* Create a new session. */
		$expire = time() + $lifetime;
		$query = "INSERT INTO {$db_prefix}sessions VALUES('$sid', '$expire', '$data')";
		$db->query($sql);
	}

	return TRUE;
}

function destroy($sid) {
	global $db, $db_prefix;

	$sql = "DELETE FROM {$db_prefix}sessions WHERE SID='$sid'";
	$db->query($sql);

	return TRUE;
}

function gc($maxlifetime) {
	global $db, $db_prefix;

	$expire = time() + $maxlifetime;
	$sql = "DELETE FROM {$db_prefix}sessions WHERE expiration < '$expire'";

	$db->query($sql);

	return TRUE;
}

function start_session() {
	global $session_name;

	ini_set("session.use_cookies", 0);
	ini_set("session.save_handler", "user");
	session_id(md5("{$_SERVER['SERVER_NAME']}:{$_SERVER['REMOTE_ADDR']}"));
	session_name($session_name);
	session_set_save_handler("open", "close", "read", "write", "destroy", "gc") or die("dammit");
	session_start();
}
?>
