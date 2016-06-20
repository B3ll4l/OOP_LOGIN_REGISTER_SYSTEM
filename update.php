<?php
require_once 'core/init.php';
if (!$user->isLoggedIn()) {
	Redirect::to('index.php');
}
$user = new User();
if (Input::exists()) {
	if (Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST,array(
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));
		if ($validation->passed()) {
			$user->update(array(
				'name' => Input::get('name')
			));
			Session::flash('home', "Name has been update Successfuly");
			Redirect::to('index.php');
		}else{
			foreach ($validation->errors() as $error) {
				echo $error . "<br />";
			}
		}
	}
}
?>

<form action="" method="POST">
	<div class="field">
		<label for="name"></label>
		<input type="text" name="name" id="name" value="<?php echo escape($user->data()->name); ?>">
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	<input type="submit" name="update" value="Update">
</form>