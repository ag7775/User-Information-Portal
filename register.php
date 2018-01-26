<?php 
  
  include 'core/init.php';
  already_logged_in();
  include 'includes/overall/header.php' ;
  if(empty($_POST)===false)
  {
  		

 		if(user_exist($_POST['username'])===true)
 		{
 			$errors[]='Sorry!! Username already taken.';
 		}
 		if($_POST['password'] !== $_POST['password_again'])
 		{
 			$errors[]='Password did not match.';
 		}
 		if(strlen($_POST['password'])<=6)
 		{
 			$errors[]='Password must be atleast 8 characters.';
 		}
 		if(preg_match("/\\s/", $_POST['username'])==true){
 			$errors[]='Username should not conatin any blank spaces';
 		}
 		if(email_exist($_POST['email'])===true)
 		{
 			$errors[]='Email already in use';
 		}
 		if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)==false)
 		{
 			$errors[]='Please Enter a valid email address'; 
 		}

 }
?>

		<h1>Registration</h1>
<?php 
if(isset($_GET['success']) && empty($_GET['success'])){

		echo 'You have been successfully registered.Please check your mail and activate your account';
	}
else{

		if(empty($_POST)==false && empty($errors)==true)
		{    
    	$register_data = array(
		'username'		=> $_POST['username'],
		'password'		=> $_POST['password'],
		'first_name'	=> $_POST['first_name'],
		'last_name'		=> $_POST['last_name'],
		'email'			=> $_POST['email'],
		'email_code'	=> md5($_POST['username'] + microtime())
			);	
			register_data($register_data);
		header('Location:register.php?success');
			exit();
		}
		else if(empty($errors)==false)
			echo output_errors($errors);
?>
	<form action="" method="post">
		<ul>
			<li>
				Username* :<br>
				<input type="text" name="username" required>
			</li>
			<li>
				Password* :<br>
				<input type="password" name="password" required>
			</li>
			<li>
				Confirm Password* :<br>
				<input type="password" name="password_again" required>
			</li>
			<li>
				First Name* :<br>
				<input type="text" name="first_name" required>
			</li>
			<li>
				Last Name :<br>
				<input type="text" name="last_name" >
			</li>
			<li>
				Email* :<br>
				<input type="email" name="email" required>
			</li>
			<li>
				<input type="submit" value="Register" required>
			</li>
		</ul>
	</form>		
<?php
}
?>