<div class="widget">
			<h2>Hello,<?php 
				$name=strtoupper($user_data['first_name']);
				echo $name; 
				?>
					
			</h2>
	<div class="inner">
		<div class="profile">
					<?php
					if($_POST['remove']==true)
						remove_profile_image($session_user_id);
					if(isset($_FILES['profile'])==true && $_POST['remove']==false)
						{
					if(empty($_FILES['profile']['name'])==true)
							{
								echo 'Please choose a file!';
							}
					else
							{
								$allowed	= array('jpg','jpeg','png','gif');
								$file_name	= $_FILES['profile']['name'];
								$file_ext	= strtolower(end(explode('.', $file_name)));
								$file_temp	= $_FILES['profile']['tmp_name'];
								
					if(in_array($file_ext, $allowed))
								{
										change_profile_image($session_user_id,$file_temp,$file_ext);
										header('Location:'.$current_file);
								}	
					else
								{
									echo 'File Type not allowed.Allowed:';echo implode(',', $allowed);
								}						
						}
					}
				

						
					if(empty($user_data['profile'])==false)
								{	
					?>
						<div class="profile1">
							<div class="pic">
										<?php
											echo '<img src="', $user_data['profile'], '" alt=" ',$user_data['first_name'],'\'s Profile 	image ">';

								}

										?>
							</div>
						</div>
						<form class="form" action="" method="post" enctype="multipart/form-data">
							<input type="file" name="profile"><br>
							<?php
							if(empty($user_data['profile'])==true)
							{	?>
									<input type="submit" value="Submit">
						<?php	}
							else{
						?>
						<input type="submit" value="Update"> 		
					<?php		}?>
						</form>
						<form method="post" action="">
					<?php
					if(empty($user_data['profile'])==false){	?>	<input type="submit" name="remove" value="Remove profile picture">
					<?php }?>
						</form>
		</div>
						

					<ul>
						<li><button><a href="logout.php">Logout</a></button></li>
						<li><button><a href="profile.php">Profile</a></button></li>
						<li><button><a href="changeps.php">Change Password</a></button></li>
						<li><button><a href="setting.php">Settings</a></button></li>
					</ul>
							
						 
	</div> 
</div>