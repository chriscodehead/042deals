<?php
$host_me = 'localhost';
$databasename_2 = '042gadgets';
$username_we = 'root';
$password_co = '';
$link = mysqli_connect($host_me,$username_we,$password_co) or header("location:404.html");
if(mysqli_select_db($link, $databasename_2)){}else {  header("location:404.html");}
 function dbpass()
	{
	$server_='localhost';    
	$database_='042gadgets';
	$user_='root';
	$pass_='';
	$con=@mysqli_connect($server_,$user_,$pass_,$database_);
	return $con; } 
$k['con']=dbpass();
function query_sql($query){
	global $k;
	$result=mysqli_query($k['con'],$query);
	return $result; }
?>