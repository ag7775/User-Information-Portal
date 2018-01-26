<?php
include 'core/init.php';
already_logged_in();
 if(empty($_POST) === false)
{	
	$username= $_POST['username'];
	$password= $_POST['password'];

	if(empty($username) || empty($password))
	{
		$errors[]='username and password cant be empty';
	}
	else if(user_exist($username)===false)
	{	
		$errors[]='user doesnt exist';
	}
	else if(user_active($username)==false)
	{	
		$errors[]='You havent activated your account';
	}
	else if(strlen($password)>32)
		{	$errors[]='Password too long !!';
		}
}	
	if(empty($_POST)==false&& empty($errors)==true){	
		$login=login($username,$password);
		
		if($login==false)
		{
			$errors[]= 'Username and password combination is incorrect';
		}
		else
		{
			$_SESSION['user_id']=$login;
			header('Location: index.php');
		}

}

   include 'includes/overall/header.php';
if(empty($errors)===false)
?>
<h2>We tried log in you,But....</h2>
<?php
echo output_errors($errors);
include 'includes/overall/footer.php';
?>