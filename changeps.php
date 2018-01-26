<?php 

  include 'core/init.php' ;
	protect_page();  
  include 'includes/overall/header.php' ;

 if(empty($_POST)==false)
 {
 			if(md5($_POST['current_password'])!==$user_data['password'])
 			{
 				$errors[]='Current password did not match';
 			}

 			if($_POST['new_password'] !== $_POST['new_password_again'])
 			{	
 				$errors[]='New Password did not match.';
 			}
 			if(strlen($_POST['new_password'])<7)
 			{
 				$errors[]= 'New Password too short!!Password should be atleast 8 characters';
 			}
 }
?>


		<h1>Change Password</h1>
<?php
		
if(isset($_GET['success']) && empty($_GET['success'])){
		echo 'Password successfully changed.';
	
	}
else{


		if(empty($_POST)==false && empty($errors)==true)
		{
				$new_password=$_POST['new_password'];
					change_password($session_user_id,$new_password);
				header('Location:changeps.php?success');
				exit();
		}
		else if(empty($errors)==false){
			echo output_errors($errors);
		}


?>
		<form action="" method="post">
			<ul>
				<li>
					Current Password<br>
					<input type="password" name="current_password" required>
				</li>
				<li>
					 New Password<br>
					<input type="password" name="new_password" required="">
				</li>
				<li>
					Confirm New Password<br>
					<input type="password" name="new_password_again" required="">
				</li>
				<li>
					<input type="submit" value="change">
				</li>
				
			</ul>
		</form>

<?php 
}
//include 'includes/overall/footer.php' 
?>