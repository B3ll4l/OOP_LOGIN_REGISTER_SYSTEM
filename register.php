<?php 
require_once 'core/init.php';

if (Input::exists()) {
	if (Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST,array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' =>'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6
			),
			'password_again' => array(
				'required' => true,
				'matches' => 'password'
			),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			),
		));
		if ($validate->passed()) {
			$user = new User();
			$salt = Hash::salt(32);
			try{
				$user->create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt'     => $salt,
					'name'     => Input::get('name'),
					'joined'   => date("Y-m-d H:i:s") ,
					'group'    => 1
				));
				// echo "registered";
				Session::flash('home', 'You heve been registered successfuly');
				// header("Location: index.php");
				Redirect::to('index.php');	
				// Redirect::to(404);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}else{
			foreach ($validation->errors() as $error){
				echo "{$error} <br />";
			}
		}
	}
}

?>

<form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>">
	</div>
	<div class="field">
		<label for="password">Password</label>
		<input type="password" name="password" id="password">
	</div>
	<div class="field">
		<label for="password_again">Re-Enter your password</label>
		<input type="password" name="password_again" id="password_again">
	</div>
	<div class="field">
		<label for="name">Enter your name</label>
		<input type="name" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>">
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate();?>">

	<input type="submit" name="submit" value="Register">
</form>

