{* An error message will be set if the user was not able to be added. *}
{if $error}
<h1>{$error}</h1>
{/if}

{* The forum script expects the variables to be name as they are in this form.
   You are free to change the form as you see fit but be sure to include the
   variables used here. *}
<form action="index.php" method="post">
<input type="hidden" name="action" value="add_user" />
<table class="register">
	<tr>
		<td>Username:</td>
		<td><input name="uname" type="text" maxlength="255" value="{$uname}" /></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input name="passwd" type="password" /></td>
	</tr>
	<tr>
		<td>Confirm:</td>
		<td><input name="confirm" type="password" /></td>
	</tr>
	<tr>
		<td>E-Mail:</td>
		<td><input name="email" type="text" maxlength="255" value="{$email}" /></td>
		<td><input type="submit" value="Register" /></td>
	</tr>
</table>
</form>
