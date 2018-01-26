<?php
function remove_profile_image($user_id)
{
	mysql_query("UPDATE users SET profile='' WHERE user_id='$user_id'");
}
function change_profile_image($user_id,$file_temp,$file_ext)
{
	$file_path='images/profile/'.substr(md5(microtime()), 0,10).'.'.$file_ext;
	move_uploaded_file($file_temp,$file_path);
	mysql_query("UPDATE users SET profile='$file_path' WHERE user_id='$user_id'");
} 
function reset_password($password,$email)
{
	$email=sanitize($email);
	$password=sanitize($password);
	$password=md5($password);
	if(mysql_query("UPDATE users SET password='$password' WHERE email='$email'")==1)
		return true;
	else
		return false;
}
function activate($email,$email_code)
{
	$email_code=sanitize($email_code);
	$email=sanitize($email);
	if(mysql_query("UPDATE users SET active=1 WHERE email='$email' AND email_code='$email_code' AND active=0")==1)
		return true;
	else
		return false;
}
function update_data($update_data,$user_id)
{	
	$update=array();
	array_walk($update_data, 'array_sanitize');
	foreach ($update_data as $fields=>$data) {
		$update[]= ''.$fields.'=\''.$data.'\'';
			}	
	$data= implode(',', $update);
 		mysql_query(" UPDATE users SET $data WHERE user_id = '$user_id'") ;
}
function change_password($user_id,$new_password)
{
	$new_password=md5($new_password);
	mysql_query("UPDATE users SET password='$new_password' WHERE user_id='$user_id'");
}
function register_data($register_data)
{
	array_walk($register_data, 'array_sanitize');
	$register_data['password']=md5($register_data['password']);
	$fields= ''.implode(',', array_keys($register_data)).'';
	$data='\''.implode('\',\'',$register_data).'\'';
	 mysql_query("INSERT INTO users($fields) VALUES($data)");
	 $message= "Hello ".$register_data['first_name'] .",\n\nYou need to activate your account, so use the link below:\n\nhttp://localhost/first_project/activate.php?email=".$register_data['email']."&email_code=".$register_data['email_code']."\n\n-SHIVAM AGRAWAL";
	 echo $message;
	 email($register_data['email'],'Activation Link',$message);
}
function user_data($user_id)
 {	
 	$data=array();
 	$func_num_args=func_num_args();
 	$func_get_args=func_get_args();
 	if($func_num_args>1)
 	{	
 		unset($func_get_args[0]);
 		
 		$feilds= ''. implode(',',$func_get_args).'';
 
 		$data=mysql_fetch_assoc(mysql_query("SELECT $feilds FROM users where user_id='$user_id'"));
 		
 			return($data);
 	}
} 		
 function logged_in()
 {
 		return (isset($_SESSION['user_id']))?true:false;
}
function email_exist($email)
{
	$email=sanitize($email);
	$result=mysql_query("SELECT * FROM users WHERE email='$email'");
	$num=mysql_num_rows($result);
	return ($num==0)?false:true;
}
function user_exist($username)
{
	$username=sanitize($username);
	$result=mysql_query("SELECT * FROM users WHERE username='$username'");
	$num=mysql_num_rows($result);
	return ($num==0)?false:true;
}

function user_active($username)
{
	$username=sanitize($username);
	$result=mysql_query("SELECT * FROM users WHERE username='$username' AND active=1");
	$num=mysql_num_rows($result);
	return ($num==0)?false:true;
	
}
function userid_from_username($username)
{
	$username=sanitize($username);
	return mysql_result(mysql_query("SELECT user_id FROM users WHERE username='$username'"), 0, 'user_id');
}
function login($username,$password)
{
	$username=sanitize($username);
	$user_id=userid_from_username($username);
	$result=mysql_query("SELECT * FROM users WHERE username='$username' AND active=1 AND password=md5('$password')");
	$num=mysql_num_rows($result);
	return ($num==0)?false:$user_id;
}