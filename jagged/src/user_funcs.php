<?php
/***************************************************************************
	This file is used to manage user registration and authorization.
	If you wish to change the authentication method then this is the
	file you should be modifying.
****************************************************************************/

require_once('db_users.php');

/* This is the function used to add users.
   It requires that the smarty variable be passed to it. */
function add_user($jag) {
	/* Set up all the variables used by the function.
	   They are passed from the registration page. */
	$uname = strtolower(trim($_REQUEST['uname']));
	$alias = $uname;
	/* The passwords must match. */
	( $_REQUEST['passwd'] == $_REQUEST['confirm'] ) ? $passwd = md5($_REQUEST['passwd']) : $passwd = FALSE;
	$email = strtolower(trim($_REQUEST['email']));
	$sid = md5("{$_SERVER['SERVER_NAME']}:{$_SERVER['REMOTE_ADDR']}");

	if ( $passwd != FALSE ) {
		$result = db_addUser($uname, $passwd, $email, $alias, $sid);
		if ( $result == FALSE ) {
			/* Assign variables for the register form. */
			$jag->assign('uname', $uname);
			$jag->assign('email', $email);
			$jag->assign('error', 'Could not connect to the database. Please try again later.');
			$jag->assign('disp', 'register');
		} else {
			/* Registration was successful. */
			$jag->assign('disp', 'index');
		}
	} else {
		/* We didn't add the user because they missed typed their password. */
		$jag->assign('uname', $uname);
		$jag->assign('email', $email);
		$jag->assign('error', 'Passwords do not match.');
		$jag->assign('disp', 'register');
	}
}

/* Get a list of registerd members. */
function user_list($jag) {
	return db_userList(NULL);
}
?>
