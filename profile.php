<?php 

  include 'core/init.php' ;
  
  include 'includes/overall/header.php' ;
?>

		<h1><u>
			<?php
			echo $name; ?>
			PROFILE
		</h1></u>
		<p>
			<?php
				if(empty($user_data['profile'])==false)
				echo '<img class ="profile_image" src="', $user_data['profile'], '" alt=" ',$user_data['first_name'],'\'s Profile 	image ">';
					echo "<br><br>";
				foreach ($user_data as $print=>$value) {
					$print=strtoupper($print);
					$value=strtoupper($value);
					echo $print.'                    =                 '.$value.'.';
					echo '<br>';
				}

			?>
		</p>

<?php 

include 'includes/overall/footer.php' ;
?>