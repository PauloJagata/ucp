<?php
session_start();

$GLOBALS["config"] = array(
	"mysql" => array(
		"host" => "localhost",
		"username" => "root",
		"password" => "",
		"db" => "login"
	),
	"remember" => array(
		"cookie_name" => "hash",
		"cookie_expiry" => 2592000, #30 days
	),
	"session" => array(
		"session_name" => "user",
		"token_name" => "token"
	)
);

spl_autoload_register(function ($class) {
	require_once("classes/" . $class . ".php");
});

require_once("functions/sanitize.php");

if (Cookie::exists(Config::get("remember/cookie_name")) && !Session::exists(Config::get("session/session_name"))) {
	$hash = Cookie::get(Config::get("remember/cookie_name"));
	$hashCheck = DB::getInstance()->get("users_session", array("hash", "=", $hash));

	if ($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}
