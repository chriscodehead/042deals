<?php
 $user_tb = "user_tb"; 
class sqli
{
	protected $user_tb = "user_tb";
	protected $deposit_tb = "deposit_td";
	protected $withdraw_tb = 'withdraw_tb';
	protected $referral_tb = 'referral_tb';
	protected $tickect_tb = 'ticket_tb';
	protected $news = 'news';
	protected $admin_tb = 'admin_tb';

	////////////////////adminrequire_once('../../con-cot/conn_sqli.php');
public function countmembers(){
	$sql = "SELECT * FROM $this->user_tb ";
	$stmt = query_sql($sql);
	 $cont = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						  $cont++;
						  }
						  return $cont;
	}
	
	function countDeposit(){
	$sql = "SELECT * FROM $this->deposit_tb ";
	$stmt = query_sql($sql);
	 $cont = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						 //$row['1'];
						  $cont++;
						  }
						  return $cont;
	}
		
		function countAllWallet(){
	$sql = "SELECT * FROM $this->deposit_tb ";
	$stmt = query_sql($sql);
	 $cont = 0;$amt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						 $amt  += $row['amount'];
						  $cont++;
						  }
						  return $amt;
	}	
	
			function countActiveWallet(){
	$sql = "SELECT * FROM $this->deposit_tb where (`deposit_status`='confirmed' || `deposit_status`='done')";
	$stmt = query_sql($sql);
	 $cont = 0;$amt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						 $amt  += $row['amount'];
						  $cont++;
						  }
						  return $amt;
	}	
	
	
				function countAllInterest(){
	$sql = "SELECT * FROM $this->deposit_tb";
	$stmt = query_sql($sql);
	 $cont = 0;$amt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						 $amt  += $row['intrest_growth'];
						  $cont++;
						  }
						  return $amt;
	}	
	
	
				function countConfirmedInterest(){
	$sql = "SELECT * FROM $this->deposit_tb where (`deposit_status`='confirmed' || `deposit_status`='done')";
	$stmt = query_sql($sql);
	 $cont = 0;$amt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						 $amt  += $row['intrest_growth'];
						  $cont++;
						  }
						  return $amt;
	}
	
	function countInterestPlsDeposit(){
	$sql = "SELECT * FROM $this->deposit_tb ";
	$stmt = query_sql($sql);
	 $cont = 0;$amt = 0;$inamt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						  $inamt  += $row['intrest_growth'];
						 $amt  += $row['amount'];
						  $cont++;
						  }
						  $sum = $amt+$inamt;
						  return $sum;
	}
	
	
		function countConfimInterestPlsDeposit(){
	$sql = "SELECT * FROM $this->deposit_tb where  (`deposit_status`='confirmed' || `deposit_status`='done')";
	$stmt = query_sql($sql);
	 $cont = 0;$amt = 0;$inamt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						  $inamt  += $row['intrest_growth'];
						 $amt  += $row['amount'];
						  $cont++;
						  }
						  $sum = $amt+$inamt;
						  return $sum;
	}
	
	
function countNotic(){
	$sql = "SELECT * FROM $this->news WHERE `top_massage`=1 ";
	$stmt = query_sql($sql);
	 $cont = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						 //$row['1'];
						  $cont++;
						  }
						  return $cont;
	}
	
	
	
	function countWithdra(){
	$sql = "SELECT * FROM $this->withdraw_tb";
	$stmt = query_sql($sql);
	 $cont = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						 //$row['1'];
						  $cont++;
						  }
						  return $cont;
	}
	
		function countCashOutWallet(){
	$sql = "SELECT * FROM $this->withdraw_tb ";
	$stmt = query_sql($sql);
	 $cont = 0;$amt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						 $amt  += $row['amount'];
						  $cont++;
						  }
						  return $amt;
	}
	
		function countCashOutpaid(){
	$sql = "SELECT * FROM $this->withdraw_tb where `status`='paid'";
	$stmt = query_sql($sql);
	 $cont = 0;$amt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						 $amt  += $row['amount'];
						  $cont++;
						  }
						  return $amt;
	}
	
	function countTicket(){
	$sql = "SELECT * FROM $this->tickect_tb where `category`='main' ";
	$stmt = query_sql($sql);
	 $cont = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						 //$row['1'];
						  $cont++;
						  }
						  return $cont;
	}




///////////////Users
public function countUserInvestment($email){
	$sql = "SELECT * FROM $this->deposit_tb  WHERE `email`='".$email."' and `deposit_status`='confirmed'";
	$stmt = query_sql($sql);
	 $cont = 0;
	 $amt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						   $amt += $row['amount'];
						  $cont++;
						  }
						  return $amt;
	}
	
public function countUserWithdrawal($email){
	$sql = "SELECT * FROM $this->withdraw_tb  WHERE `email`='".$email."' and `status`='paid'";
	$stmt = query_sql($sql);
	 $cont = 0;
	 $amt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						   $amt += $row['amount'];
						  $cont++;
						  }
						  return $amt;
	}
	
public function countUserReferrals($email){
	$sql = "SELECT * FROM $this->user_tb  WHERE  `referral_username`='".$email."'";
	$stmt = query_sql($sql);
	 $cont = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						  $cont++;
						  }
						  return $cont;
	}
	
public function countUserTransactions($email){
	$sql = "SELECT * FROM $this->deposit_tb  WHERE  `email`='".$email."'";
	$stmt = query_sql($sql);
	 $cont = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						  $cont++;
						  }
						  return $cont;
	}

public function countUserAvailableWithdrawable($email){
	$sql = "SELECT * FROM $this->deposit_tb  WHERE `email`='".$email."' and `deposit_status`='confirmed'";
	$stmt = query_sql($sql);
	 $cont = 0;
	 $amt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						   $amt += $row['intrest_growth'];
						  $cont++;
						  }
						  return self::round_out($amt, 4);
	}
	
public function countUserAvailableWithdrawable2($email){
	$sql = "SELECT * FROM $this->referral_tb  WHERE `referral_email`='".$email."' and `status`='confirmed'";
	$stmt = query_sql($sql);
	 $cont = 0;
	 $amt = 0;
						  while($row = mysqli_fetch_assoc($stmt)){
						   $amt += $row['balance'];
						  $cont++;
						  }
						  return self::round_out($amt, 4);
	}

public function getRow($session,$field){
	$sql = "SELECT * FROM $this->user_tb WHERE `email`='".$session."'";
	$stmt = query_sql($sql);
	$row = mysqli_fetch_assoc($stmt);
	return $row[$field];
	}
	
public function round_out ($value, $places=0) {
  if ($places < 0) { $places = 0; }
  $mult = pow(10, $places);
  return ($value >= 0 ? ceil($value * $mult):floor($value * $mult)) / $mult;
}
	
public function getEmail($session){
	$sql = "SELECT email FROM $this->user_tb WHERE `hashed_pot`='".$session."'";
	$stmt = query_sql($sql);
	$row = mysqli_fetch_assoc($stmt);
	return $row['email'];
}

}
$sqli = new sqli();
?>