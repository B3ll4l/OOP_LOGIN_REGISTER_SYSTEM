<?php
require_once 'core/init.php';

// $user = DB::getInstance()->query("SELECT * FROM users WHERE username = ?", array("Bellal"));
// $user = DB::getInstance()->action("SELECT *","users", array("id", "=", "1"));
// $user = DB::getInstance()->get("users", array("id", "=", "1"));

// $user = DB::getInstance()->insert('users', array(
// 	'username' => 'test user',
// 	'password' => 'password',
// 	'salt' => 'salt'
// ));

$user = DB::getInstance()->update('users', 2,array(
	'password' => 'testpass'
));
