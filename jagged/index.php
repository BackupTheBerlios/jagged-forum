<?php
require_once('Smarty.class.php');
require_once('src/sessions.php');
require_once('src/user_funcs.php');

/* Start the session using our custom session support. */
start_session();

/* Configure Smarty. */
$jag = new Smarty;
$jag->compile_dir = "./compile";
$jag->cache_dir = "./cache";

/* Set up the theme for the user. FIXME should read from the database. */
$template_dir = "themes/default";
$jag->template_dir = $template_dir;
$jag->assign('template_dir', $template_dir);

/* Manage navigation. */
if ( isset($_REQUEST['action']) ) {
	switch ($_REQUEST['action']) {
		case 'add_user':
			add_user($jag);
			break;
		case 'register':
			$jag->assign('disp', $_REQUEST['action']);
			break;
		case 'user_list':
			$jag->assign('users', user_list($jag));
			$jag->assign('disp', $_REQUEST['action']);
			break;
		default:
			$jag->assign('disp', 'index');
	}
} else {
	$jag->assign('disp', 'index');
}

$jag->display('index.tpl');
?>
