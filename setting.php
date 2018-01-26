<?php 
  include 'core/init.php' ;
  protect_page();
  include 'includes/overall/header.php' ;
  if(empty($_POST)==false && logged_in())
   {
  		if(email_exist($_POST['email'])==true && $user_data['email']!==$_POST['email'])
  		{
  			$errors[]='Email already in use';
  		}
  		if(preg_match('/\\s/', $_POST['first_name'])==true)
  		{
  			$errors[]='First name should not contain any white spaces';
  		}
  		
  }
  
?>
		<h1>Settings</h1>
<?php 
if(isset($_GET['success']) ==true && empty($_GET['success']))
{
	echo "Profile Updated";
}
else
{
		if(empty($errors)==true && empty($_POST)==false && logged_in())
		{
			$update_data = array(
			'first_name'	=> $_POST['first_name'],
			'last_name'		=> $_POST['last_name'],
			'email'			=> $_POST['email']
			);	
				update_data($update_data,$session_user_id);		
header('Location:setting.php?success'); 			
}
 			else if(empty($errors)==false){
  			  				echo outpur_errors($errors);
  			}

?>


				<form action="" method="post" enctype="multipart/form-data">
		
			<ul>
				<li>
					First Name :<br>
				<input type="text" name="first_name" value="<?php echo $user_data['first_name'];?>">
			</li>
			<li>
				Last Name :<br>
				<input type="text" name="last_name" value="<?php echo $user_data['last_name'];?>">
			</li>
			<li>
				Email :<br>
				<input type="email" name="email" value="<?php echo $user_data['email'];?>">
			</li>
			<li>
				Change Profile Picture :
				<input type="file" name="profile">
			</li>
			<li>
				<input type="submit" value= "Update">
			</li>
		</ul>
		</form> 
	<?php
	}
	?>