<?php 

  include 'core/init.php' ;
  
  include 'includes/overall/header.php' ;
?>

		<h1>Home</h1>

		<p><?php if(logged_in()==true)
				echo "Successfully Logged in !!";
			?>
		</p>

<?php 

include 'includes/overall/footer.php' ;
?>