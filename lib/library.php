<?php require_once('../con-cot/con_file.php'); ?>
<?php  
ob_start();
session_start();
$user_tb = "user_tb";

//php class
class Cal extends DBConnection 
{
	private      $_query,
	           	      $_error = false,
					   $_count = 0,
					   $_errMsg,
					   $_sucMsg,
					   $_results;
	protected $sql;
	protected $user_tb = "user_tb";

	private static function generateQuestionMark($arr){
		$count = count($arr);
		$x = 0;
		$s = "";
		foreach($arr as $value){
			if($x === ($count - 1)){
				$s = $s."?";
			}else{
			   $s = $s."?,";
			}
			   $x++;
		}	
		return $s;
}

private static function generateUpdateQuery($table,$arr,$condition,$clause){
		$count = count($arr);
		$x = 0;
		$s = "UPDATE {$table} SET ";
		foreach($arr as $value){
			if($x === ($count - 1)){
				$s = $s."{$value} = ?";
			}else{
					$s = $s."{$value} = ?,";
			}
			$x++;
		}	
		return $s." WHERE {$condition} = '$clause'";
}

public function insertData($table,$fields = array(),$values = array()){
		if(is_array($fields) && is_array($values)){
			 if(count($fields)&& count($values)){
				 $dbs = new DBConnection();
		        $db = $dbs->DBConnections();
                         $queryFields =  implode(",",$fields);
						$s = self::generateQuestionMark($fields);
						$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
						      $dbs = new DBConnection();
		                       $db = $dbs->DBConnections();
						$sql = "INSERT INTO ".$table." (".$queryFields.") VALUES (".$s.");";
						if($stmt = $db->prepare($sql)){
								$x= 1;
								foreach($values as $val){
									  $stmt->bindValue($x,$val);
										  $x++;
								}
						if($stmt->execute()){
							                   //$this->_sucMsg = 'Data was inserted successful';
										   return 3;
				                }else{
									   //$this->_errMsg  = "Query could not be executed. Error!";
									   return 4;
									}}				
				 }else{//$this->_errMsg  =  'invalid parameters.Empty arrays';
					return 5;
					 }
		}else{
			//$this->_errMsg = 'Invalid parameter. Parameter must be array!';
			return 6;
			}
			echo  $this;
}


public function update($table,$fields = array(),$values = array(),$condition,$clause){
						if(is_array($fields) && is_array($values)){
							if(count($fields)&& count($values)){
							$dbs = new DBConnection();
							$db = $dbs->DBConnections();
							$queryFields =  implode(",",$fields);
							$query = self::generateUpdateQuery($table,$fields,$condition,$clause);
							$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
							if($stmt = $db->prepare($query)){
								$x= 1;
								foreach($values as $val){
									$stmt->bindValue($x,$val);
									$x++;
								}
								if($stmt->execute()){
									$this->_sucMsg = "Update was successful";
									return $this->_sucMsg;
								}else{
								$this->_errMsg = "An error occured,please try again";
								return $this->_errMsg;
							}
							}else{
								$this->_errMsg  = "Query could not be executed. Error!";
								 return $this->_errMsg;
							}
						}else{$this->_errMsg  =  'invalid parameters.Empty arrays';
									return $this->_errMsg;
									 }
						}else{
							$this->_errMsg = 'Invalid parameter. Parameter must be array!';
							return $this->_errMsg;
							}
						return $this;
}

public function insertDataB($table,$fields = array(),$values = array()){
		if(is_array($fields) && is_array($values)){
			 if(count($fields)&& count($values)){
				 $dbs = new DBConnection();
		        $db = $dbs->DBConnections();
                         $queryFields =  implode(",",$fields);
						$s = self::generateQuestionMark($fields);
						$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
						      $dbs = new DBConnection();
		                       $db = $dbs->DBConnections();
						$sql = "INSERT INTO ".$table." (".$queryFields.") VALUES (".$s.");";
						if($stmt = $db->prepare($sql)){
								$x= 1;
								foreach($values as $val){
									  $stmt->bindValue($x,$val);
										  $x++;
								}
						if($stmt->execute()){
							                   $this->_sucMsg = 'Registration was successful. Proceed to login!';
										   return $this->_sucMsg;
				                }else{
									   $this->_errMsg  = "Query could not be executed. Error!";
									   return $this->_errMsg;
									}}				
				 }else{$this->_errMsg  =  'invalid parameters.Empty arrays';
					return $this->_errMsg;
					 }
		}else{
			$this->_errMsg = 'Invalid parameter. Parameter must be array!';
			return $this->_errMsg;
			}
			echo  $this;
}

public function getLastID($table){
	$email = $_SESSION['user_id'];
     $sql = "SELECT `id` FROM $table ORDER BY id DESC";
	         $dbs = new DBConnection();
			 $db = $dbs->DBConnections();
			 $stmt = $db->prepare($sql);
			 $stmt->execute();
			  $row = $stmt->fetch(PDO::FETCH_ASSOC);
			   $data = $row['id'];
			   return $data;
	}

public function checkifdataExists($data,$fieldname,$tablename){
						 $sql = "select $fieldname from $tablename where $fieldname = :data";
						$dbs = new DBConnection();
						$db = $dbs->DBConnections();
						$stmt = $db->prepare($sql);
						$stmt->bindValue(':data', $data);
						$stmt->execute();
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						if($row == true){
							return  1;
						}else{
							return 0;
							}
}
																 
}
//instance of Call Class
$cal = new Cal();
?>