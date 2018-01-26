<?php 

  include 'core/init.php' ;
  
  include 'includes/overall/header.php' ;
if(isset($_GET['email'])==true)
{	
	$email=$_GET['email'];
 	if(empty($_POST)==false)
  	{
  		
 		if($_POST['password'] !== $_POST['password_again'])
 		{
 			$errors[]='Password did not match.';
 		}
 		if(strlen($_POST['password'])<=8)
 		{
 			$errors[]='Password must be atleast 8 characters.';
 		}
	}
}	

?>

		<h1>Reset Password</h1>
<?php

		if (empty($_POST)==false && empty($errors)==true) {
			$Password=$_POST['password'];
			if(reset_password($Password,$email))
			{	echo "Password Succefully Reset";
			//header('Location: reset_password.php?success');
			}else
				echo "Try after sometime";
		}
		else {
			echo output_errors($errors);
		
?>
		<form action="" method="post">
			<ul>
				<li>
					<input type="password" name="password" placeholder="Enter New password" required=""><br>
				</li>
				<li>
					<input type="password" name="password_again" placeholder="Confirm New password" required=""><br>
				</li>
				<li>
					<input type="submit" value="Reset"><br>
				</li>
			</ul>
		</form>

<?php 
}
include 'includes/overall/footer.php' 
?>