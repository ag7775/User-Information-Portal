<?php 

  include 'core/init.php' ;
already_logged_in();
  include 'includes/overall/header.php' ;

  if(isset($_GET['email'],$_GET['email_code'])===true)
  {
  	$email=$_GET['email'];
  	$email_code=$_GET['email_code'];
  	if(email_exist($email)==false)
  		$errors[]="Sorry Email address not found.";
  	else if(activate($email,$email_code)==false)
  		$errors[]='We had a problem activating your account.Try again later.';
  }
  else
  	{
  		header('Location:index.php');
  	}

?>
<h2>
	<?php
		if(empty($errors) && activate($email,$email_code)==true)
			echo 'Congrats.Your Account has been activated.';
	?>
</h2>
<?php
	if(empty($errors)==false)
		echo output_errors($errors);?>
<?php 
include 'includes/overall/footer.php' 
?>