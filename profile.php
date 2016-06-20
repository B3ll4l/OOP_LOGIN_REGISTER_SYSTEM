<?php
require_once 'core/init.php';
if (!$username = Input::get('username')) {
	Redirect::to('index.php');
}else{
	$user = new User($username);
	if (!$user->exists()) {
		Redirect::to(404);
	}else{ 
		$data = $user->data();
		?>	
		<p> <?php echo ($data->username); ?> </p>
		<p> Name : <?php echo escape($data->name); ?> </p>
	

		<?php
	}
}
?>
