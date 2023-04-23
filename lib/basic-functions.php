<?php
class basicFunction 
{
public function isMatched($val1,$val2){
			if($val1==$val2){ return 1; }else if($val1!=$val2){return 0;}
		}
public function errorMssg($info){
		switch($info){
			case $info == 0: return 'Error! Please fill all fields!.'; break;
			case $info == 1: return 'Error! Password does not match.'; break;
			case $info == 2: return 'Error! Wallet Address does not match.'; break;
			case $info == 3: return 'Error! Registration Fail.'; break;
			case $info == 4: return 'Error! Query could not be executed.'; break;
			case $info == 5: return 'Error! Invalid parameters.Empty arrays.'; break;
			case $info == 6: return 'Error! Invalid parameter. Parameter must be array.'; break;
			case $info == 7: return 'Error! Email already exists.'; break;
			case $info == 8: return 'Error! Referral email does not exists.'; break;
			case $info == 10: return 'Error! Bitcoin Wallet Address already exists.'; break;
			case $info == 11: return 'Error! Email does not exists.'; break;
			case $info == 12: return 'Error! please browse and image file.'; break;
			case $info == 13: return 'Error! Password lenght should be between 8 - 36 characters.'; break;
			}
		}
public function succMssg($info){
		switch($info){
			case $info == 1: return 'Registration was successful! Proceed to <a href="sign-in">LOG IN</a>.'; break;
			case $info == 2: return 'Update was successful!.'; break;
			case $info == 3: return 'CashOut was successful! Expect payment within 48hrs.'; break;
			}
		}
public function randGenerator(){
				$randnum = uniqid();
				$randpicker = rand(1,143);
				$pickerbox = array('RCA','RCB','RCC','RCD','RCE','RCF','RCG','RCH','RCI','RCJ','RCK','RCL','RCM','RCN','RCO','RCP','RCQ','RCR','RCS','RCT','RCU','RCV','RCW','RCX','RCY','RCZ','RTA','RTB','RT','RTC','RTD','RTE','RTF','RTG','RTH','RTI','RTJ','RTK','RTL','RTM','RTN','RTO','RTP','RTQ','RTR','RTS','RTT','RTU','RTV','RTW','RTX','RTY','RTZ','RPA','RPB','RPC','RPD','RPD','RPE','RPF','RPG','RPH','RPI','RPJ','RPK','RPL','RPM','RPN','RPO','RPP','RPQ','RPR','RPS','RPT','RPU','RPV','RPW','RPX','RPY','RPZ','RRR','REA','REB','REC','RED','REE','REF','REG','REH','REI','REJ','REK','REL','REM','REN','REO','REP','REQ','RER','RES','RET','REU','REV','REW','REX','REY','REZ','RDA','RDB','RDC','RDD','RDE',"RAA","RBH","RHJ","RKK","RWH","RBB","RFC","RGC","RHC","RJC","RKC","TLC","TZC","TXC","TCC","TVC","TBC","TNC","TDO","TDT","TTT","TAG","TAH","TAS","TAR","TAC","TAT","TAZ","TSY","TSB","TZX","TQO","TAP");
				$shuff = $pickerbox[$randpicker];
				$main = $shuff.$randnum;
				return $main; 
			}
	
public function picker(){
				$randpicker = rand(1,143);
				$pickerbox = array('RCA13','RCB12','RCC23','RCD43','RCE34','RCF56','RCG23','RCH34','RCI17','RCJ23','RCK34','RCL54','RCM56','RCN23','RCO34','RCP56','RCQ34','RCR32','RCS32','RCT34','RCU12','RCV43','RCW12','RCX34','RCY23','RCZ65','RTA76','RTB34','RTH45','RTC54','RTD65','RTE78','RTF67','RTG54','RTH34','RTI34','RTJ67','RTK12','RTL54','RTM76','RTN34','RTO87','RTP67','RTQ65','RTR34','RTS65','RTT67','RTU98','RTV78','RTW34','RTX64','RTY54','RTZ32','RPA43','RPB45','RPC34','RPD32','RPD56','RPE89','RPF87','RPG76','RPH23','RPI78','RPJ54','RPK45','RPL90','RPM43','RPN43','RPO56','RPP67','RPQ78','RPR43','RPS76','RPT34','RPU45','RPV67','RPW78','RPX56','RPY67','RPZ34','RRR09','REA90','REB56','REC54','RED67','REE78','REF54','REG','REH56','REI56','REJ34','REK87','REL56','REM54','REN45','REO43','REP78','REQ67','RER43','RES45','RET34','REU34','REV65','REW56','REX56','REY78','REZ43','RDA65','RDB67','RDC34','RDD23','RDE87',"RAA87","RBH54","RHJ65","RKK45","RWH43","RBB45","RFC67","RGC54","RHC90","RJC43","RKC67","TLC34","TZC54","TXC34","TCC34","TVC67","TBC54","TNC54","TDO56","TDT67","TTT45","TAG54","TAH34","TAS54","TAR45","TAC78","TAT67","TAZ34","TSY54","TSB54","TZX78","TQO65","TAP45");
				$shuff = $pickerbox[$randpicker];
				$main = $shuff;
				return $main; 
			}

public function getTimeZone(){
    $ip     = $_SERVER['REMOTE_ADDR'];
    $json   = file_get_contents( 'http://smart-ip.net/geoip-json/' . $ip);
    $ipData = json_decode( $json, true);
    if ($ipData['timezone']) {
        $tz = new DateTimeZone( $ipData['timezone']);
        $now = new DateTime( 'now', $tz); // DateTime object corellated to user's timezone
    } else {
        // we can't determine a timezone - do something else...
    }
}


public function getDate(){
				//self::getTimeZone();
				return date("F j, Y, g:i a");//date("Y-m-d h:i:s");//2017-08-02 00:00:00
			}
public function getDate2(){
				//self::getTimeZone();
				return date("F j, Y");//date("Y-m-d");//2017-08-02 00:00:00
			}
public function getUrl(){
		 return $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		 }	 
public  function passwordHash($algorithm,$password){
					  $md5_value = hash($algorithm, $password, FALSE);
					  return $md5_value;
          }
public function getField($fildname){
	                  $get  = $_POST[$fildname];
					  return $get;
	}
public function generateNumbers($start,$end){
		  $newname = rand($start, $end);
		  return $newname;
}
public function picVlidator($picname,$picsize){
		        $maxsiz = 2097152;
				if($picsize>2097152){
					  $this->_errMsg = 'Picture size to big use image lessthan 2MB';
									}else{
								$picextension = mb_strtolower(substr($picname, strpos($picname, '.') + 1));
								if($picextension =='jpg' || $picextension =='jpeg' || $picextension =='gif' || $picextension =='png'){
									
								}else{
													$this->_errMsg =  'please use images-eg..jpg,.jpeg,.gif,.png.';
													return $this->_errMsg;
										}
					}
}
public function extentionName($filename){
		    $extension = mb_strtolower(substr($filename, strpos($filename, '.') + 1));
			return '.'.$extension;
}
public function uploadImage($imageTempname,$imageNewLocation){
								if(move_uploaded_file($imageTempname,$imageNewLocation)){
									
									}else{
												$this->_errMsg = 'Error occured. Image failed to upload to folder.';
										}
}
public function unlinkFile($fileName,$filePath){
			    	@unlink($filePath.$fileName);
					return $this;
}	
public function reduceTextLength($content,$length){
	       					if(strlen($content) < $length){
                        			  return $content;  
                          		 }else if(strlen($content) > $length){
                               			return substr($content, 0, $length).'...';
						   		}
}
public function reduceLength($content,$length){
	       					if(strlen($content) < $length){
                        			  return $content;  
                          		 }else if(strlen($content) > $length){
                               			return substr($content, 0, $length).'[...]';
						   		}
}

public function checkLogedIN($sendTopage){
	if(isset($_SESSION['user_code'])&&!empty($_SESSION['user_code'])){
		}else{
			return header("location:".$sendTopage);
			}
}
public function checkLogedINSendOut($sendTopage){
	if(isset($_SESSION['user_code'])&&!empty($_SESSION['user_code'])){
		return header("location:".$sendTopage);
		}else{}
}
public function checkLogedINAdmin($sendTopage){
	if(isset($_SESSION['admin_id'])&&!empty($_SESSION['admin_id'])){
		}else{
			return header("location:".$sendTopage);
			}
}
public function checkLogedINSendOutAdmin($sendTopage){
	if(isset($_SESSION['admin_id'])&&!empty($_SESSION['admin_id'])){
		return header("location:".$sendTopage);
		}else{}
}
public function passwordlenght($password){
								$check = strlen($password);
								if($check<8 || $check>36){
									   $errMsg = 'Password should not be greater than 36 or less than 8 characters.';
									   return $errMsg;
									}else{}
}
public function round_out ($value, $places=0) {
  if ($places < 0) { $places = 0; }
  $mult = pow(10, $places);
  return ($value >= 0 ? ceil($value * $mult):floor($value * $mult)) / $mult;
}
	
}
$bassic = new basicFunction();
?>
