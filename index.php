<?php
require_once("core/init.php");

if (Session::exists("home")) {
	echo "<p>";
	echo Session::flash("home");
	echo "</p>";
}

$user = new User();
if ($user->isLoggedIn()) {
	echo "<P><a href='profile.php?user=".escape($user->data()->username)."'>".escape($user->data()->username)."</a> is logged in</P>";
	echo "<ul>";
	echo "<li><a href='changepassword.php'>Change password</a></li>";
	echo "<li><a href='update.php'>Update profile</a></li>";
	echo "<li><a href='logout.php'>Log out</a></li>";
	echo "</ul>";

	if ($user->hasPermission('admin')) {
		echo "<p>You are an admin!</p>";
	}

	if ($user->hasPermission('moderator')) {
		echo "<p>You are a moderator!</p>";
	}
} else {
	echo "You need to <a href='login.php'>log in</a> or <a href='register.php'>register</a>";
}

?>