<?php 

  include 'core/init.php' ;
  
  include 'includes/overall/header.php' ;

  if(empty($_POST)==false)
  {
  	if(email_exist($_POST['email'])==false)
  		$errors[]='Email doesn\'t exist.Please Enter a valid email address';


  }
?>

		<h1>Forget Password</h1>
<?php
		if(empty($_POST)==false and empty($errors)==true)
		{
			$message= "To reset your password please use the link below:\n\nhttp://localhost/first_project/reset_password.php?email=".$_POST['email'];
				email($_POST['email'],'Reset Password',$message);
		}
		else {
			echo output_errors($errors);
		
?>
		<form action="" method="post">
			<input type="email" name="email" placeholder="Enter your email address"><br>
			<input type="submit" value="submit">
		</form>

<?php
} 
include 'includes/overall/footer.php' 
?>