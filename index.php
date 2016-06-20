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

// $user = DB::getInstance()->update('users', 2,array(	
// 	'password' => 'testpass'
// ));

if (Session::exists("home")) {
	echo Session::flash("home");
}
// echo Session::get(Config::get('session/session_name'));

$user = new User();
if ($user->isLoggedIn()) {?>
	<p> Welcome <a href="profile.php?username=<?php echo escape($user->data()->username) ?>"><?php echo escape($user->data()->username) ?></a> </p>
	<a href="logout.php">Logout</a>
	<a href="update.php">Update Info</a>
	<a href="changepassword.php">Change Password</a>

<?php 
if ($user->hasPermission('admin')) {
	echo "you are an admin";
}
}else{ ?>
	<p> Please <a href="login.php" >Login</a> or <a href="register.php"> Register </a> </p>
<?php }





