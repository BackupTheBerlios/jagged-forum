<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Jagged Edge Forum</title>
	<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
	<meta name="Author" lang="en" content="James Sumners" />
	<meta name="copyright" content="&copy; 2003 itcouldbe9 Productions" />
	<link rel="stylesheet" type="text/css" href="{$template_dir}/styles/style.css" />
</head>
<body>
	<div class="control_panel">
		<a href="index.php?action=index">Home</a> <a href="index.php?action=user_list">User List</a> <a href="index.php?action=register">Register</a>
	</div>

	<div class="forums">
		{* By default we should show the main page with the list of forums. *}
		{if $disp == 'index'}
			{include file='front.tpl'}
		{/if}
		
		{* If the user is trying to register then show the registration page. *}
		{if $disp == 'register'}
			{include file='register.tpl'}
		{/if}

		{* If the user is trying to view the list of registered members. *}
		{if $disp == 'user_list'}
			{include file='userlist.tpl'}
		{/if}

		<div class="date">
			{$smarty.now|date_format:"%I:%M %A, %d %B %Y"}
		</div>
	</div>

	<div class="footer">
		<p>&copy; 2003 itcouldbe9 Productions</p>
	</div>
</body>
</html>
