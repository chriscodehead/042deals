 <?php
class DBConnection {
function getMessage(){
	return $msg = 'SQLError, Connection Failed';
	}
function DBConnections(){
  	$host_='localhost'; 
    $dbname_='042gadgets';
    $user_='root';
    $pass_='';
    try {  
      $DBH = new PDO("mysql:host=$host_;dbname=$dbname_", $user_, $pass_);  
      $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
	  //echo 'goooooood!';
        return $DBH;
    }
    catch(PDOException $e) {  
     //echo 'ERROR: ' . $e->getMessage();
		header("location:404.html");
    }   
}
}
$bd = new DBConnection();
?> 