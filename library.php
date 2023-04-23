<?php require_once('con-cot/con_file.php'); ?>
<?php require_once('con-cot/conn_sqli.php'); ?>
<?php
ob_start();
session_start();
$settings = 'settings';
$payment_details = 'payment_details';

$sql_u = query_sql("SELECT * FROM $payment_details WHERE id=1 LIMIT 1");
$row_u = mysqli_fetch_assoc($sql_u);

$sql = query_sql("SELECT * FROM $settings WHERE id=1 LIMIT 1");
$row = mysqli_fetch_assoc($sql);

$coin_symble = $row['coin_initial'];
$coin_value_in_usd = $row['coin_value_in_usd'];
$site_usdt = $row_u['usdt'];
$site_btc = $row_u['btc'];
$site_eth = $row_u['eth'];
$site_bnb = $row_u['bnb'];
$usdt_network = $row_u['usdt_network'];
$usdtnetwork = $row_u['usdt_network'];

$initial_pay = $row['initail'];
$minimum_withdrawal = $row['min_withdraw'];
$withdrawal_charge = $row['withdrawal_charge'];
$sub_duration = $row['sub_duration'];

$direct_downline = $row['ref1'];
$second_downline = $row['ref2'];
$third_downline = $row['ref3'];
$fourth_downline = $row['ref4'];
$fifth_downline = $row['ref5'];
$sixth_downline = $row['ref6'];
$seventh_downline = $row['ref7'];

$planA = $row['level1'];
$planB = $row['level2'];
$planC = $row['level3'];
$planD = $row['level4'];
$planE = $row['level5'];
$planF = $row['level6'];
$planG = $row['level7'];

$siteRefA = $row['ref1'];
$siteRefB = $row['ref2'];
$siteRefC = $row['ref3'];
$siteRefD = $row['ref4'];
$siteRefE = $row['ref5'];
$siteRefF = $row['ref6'];
$siteRefG = $row['ref7'];

$siteMinA = $row['min1'];
$siteMaxA = $row['max1'];

$siteMinB = $row['min2'];
$siteMaxB = $row['max2'];

$siteMinC = $row['min3'];
$siteMaxC = $row['max3'];

$siteMinD = $row['min4'];
$siteMaxD = $row['max4'];

$siteMinE = $row['min5'];
$siteMaxE = $row['max5'];

$siteMinF = $row['min6'];
$siteMaxF = $row['max6'];

$siteMinG = $row['min7'];
$siteMaxG = $row['max7'];

$percentageA = $row['profit1'];
$percentageB = $row['profit2'];
$percentageC = $row['profit3'];
$percentageD = $row['profit4'];
$percentageE = $row['profit5'];
$percentageF = $row['profit6'];
$percentageG = $row['profit7'];

$percentageA_D = "1";
$percentageB_D = "1.5";
$percentageC_D = "1.3";
$percentageD_D = "20 - 22";
$percentageE_D = "22 - 25";

$durationA = 'After 24 Hours';
$durationB = 'After 48 Hours';
$durationC = 'After 72 Hours';
$durationD = 'After 5 Days';
$durationE = 'After 24 Hours';

$siteYear = date('Y');
$dummyEmail = 'peterchrisbox@gmail.com';
$companyNumber = '12850124';
$domain = '042gadgets.com';
$siteLink = 'https://'.$domain.'/';
$siteRegister = 'https://'.$domain.'/accounts/register';
$siteLogin = 'https://'.$domain.'/accounts/login';
$site = 'https://'.$domain;
$siteName = $row['site_name'];
$siteEmail = "support@".$domain;
$siteEmail2 = "support@".$domain;
$sitePhone = $row['site_phone'];
$sitePhone2 = $row['site_phone'];
$siteAddress = $row['site_address'];
$siteAddress2 = 'Enugu, Lagos, Abuja';
$site_whatsapp_num = $row['site_whatsapp_num'];
$siteWhatsApp = 'https://api.whatsapp.com/send?phone='.$site_whatsapp_num.'&text=Hi '.$siteName.', my name is ...! I want to make enquires about your products...';
$siteDomain = $domain;
$siteWhatsAppLink = 'https://api.whatsapp.com/send?phone='.$site_whatsapp_num.'&text=';
$siteTelegram = 'https://telegram.com/042gadgets';
$siteTwitter = 'https://twitter.com/042gadgets';
$siteFacebook = 'https://facebook.com/042gadgets';
$siteLinkedin = 'https://linkedin.com/042gadgets';
$siteInstagram = 'https://instagram.com/042gadgets';
$siteYoutube = 'https://youtube.com/042gadgets';

$user_tb = "user_tb";
$deposit_tb = "deposit_td";
$tickect_tb = 'ticket_tb';
$withdraw_tb = 'withdraw_tb';
$referral_tb = 'referral_tb';
$news = 'news';
$updating = 'updating';
$admin_tb = 'admin_tb';
$agorithm = 'haval160,4';
$valset = 'f06a20741c271884e9cb2251a8c6903fdfe888e55b587b048f80cd3c1e52245a';
$secrete = 'ipnsecr';
$bockprv = 'bockprv';
$bockpub = 'bockpub';
$pay_set = 'pay_set';
$course_tb = 'course_tb';
$cat_tb = 'cat_tb';
$life_one_bonus = 'life_one_bonus';
$payout_manipulate = 'payout_manipulate';
$review = 'review';
$daycount = 'daycount';
$codex = 'codex';
$product = 'product';
$comments_tb = 'comments_tb';
$news_letter = 'news_letter';
$orders_tb = 'orders_tb';
class Cal extends DBConnection
{

    protected $percentageA;
    protected $percentageB;
    protected $percentageC;
    protected $percentageD;
    protected $percentageE;
    protected $percentageF;
    protected $percentageG;
    protected $sub_duration;
    
    public function __construct($sub_duration, $percentageA, $percentageB, $percentageC, $percentageD, $percentageE, $percentageF, $percentageG)
    {
        $this->sub_duration = $sub_duration;
        $this->percentageA = $percentageA;
        $this->percentageB = $percentageB;
        $this->percentageC = $percentageC;
        $this->percentageD = $percentageD;
        $this->percentageE = $percentageE;
        $this->percentageF = $percentageF;
        $this->percentageG = $percentageG;
    }

    private      $_query,
        $_error = false,
        $_count = 0,
        $_errMsg,
        $_sucMsg,
        $_results;
    protected $sql;
    protected $user_tb = "user_tb";
    protected $deposit_tb = "deposit_td";
    protected $withdraw_tb = 'withdraw_tb';
    protected $updating = 'updating';
    protected $referral_tb = 'referral_tb';
    protected $news = 'news';
    protected $admin_tb = 'admin_tb';
    protected $valset = 'f06a20741c271884e9cb2251a8c6903fdfe888e55b587b048f80cd3c1e52245a';
    protected $secrete = 'ipnsecr';
    protected $bockprv = 'bockprv';
    protected $bockpub = 'bockpub';
    protected $pay_set = 'pay_set';
    protected $payout_manipulate = 'payout_manipulate';
    protected $life_one_bonus = 'life_one_bonus';
    protected $review = 'review';
    protected $payment_details = 'payment_details';
    protected $settings = 'settings';
    protected $course_tb = 'course_tb';
    protected $daycount = 'daycount';
    protected $codex = 'codex';
    protected $product = 'product';
    protected $comments_tb = 'comments_tb';
    protected $news_letter = 'news_letter';
    protected $orders_tb = 'orders_tb';
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
                        return 3;
                    }else{
                        return 4;
                    }}
            }else{
                return 5;
            }
        }else{
            return 6;
        }
        echo  $this;
    }

    public function depositBTC($table,$fields = array(),$values = array()){
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
                        return 100;
                    }else{
                        return "Query could not be executed. Error!";
                    }}
            }else{
                return 'invalid parameters.Empty arrays';
            }
        }else{
            return 'Invalid parameter. Parameter must be array!';
        }
        echo  $this;

    }

    public function CreatWithdrawBTC($table,$fields = array(),$values = array()){
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
                        return 88;
                    }else{
                        return 4;
                    }}
            }else{
                return 5;
            }
        }else{
            return 6;
        }
        echo  $this;
    }
    public function urlconect(){
        return 'localhost';
    }
    public function urlconect2(){
        return 'localhost';
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

    public function ipconect(){
        return $_SERVER['HTTP_HOST'];
    }

    public function ipconect2(){
        return ''.$_SERVER['HTTP_HOST'];
    }

    public function login($email,$password,$page,$usernamefield,$passwordfield,$table){
        $sql="SELECT * FROM $table WHERE $usernamefield = :email and $passwordfield = :password LIMIT 1";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['blocked_account']==1){
                return 'Your Account is locked please <a style="color:#FFF;" href="mailto:support@signalearners.com"><u>contact support: support@signalearners.com</u></a>';
            }else{ //Blocked account error massage

                if($row['email']==$email && $row['password']==$password){
                    if($row['email_activation']=="yes"){
                        if($row['two_factor']=="Yes"){
                            self::twoFac($row['email'],$row['two_factor_code'],$row['first_name']);
                            $_SESSION['inc'] = $row['hashed_pot'];

                            $last_login = date("Y-m-d h:i:s");
                            $feilds = array('last_login');
                            $value = array($last_login);
                            self::update($this->user_tb, $feilds, $value, 'email', $email);

                            header("location:confirm-code");
                        }else{
                            $_SESSION['user_code'] = $row['hashed_pot'];
                            $_SESSION['logged_in'] = time();

                            $last_login = date("Y-m-d h:i:s");
                            $feilds = array('last_login');
                            $value = array($last_login);
                            self::update($this->user_tb, $feilds, $value, 'email', $email);

                            header("location:".$page);
                            return 'go';
                        }
                    }else{
                        return 'Sorry you can not access your account because your email has not been activated. I have not received any email <a data-toggle="modal" href="login#myModalAC"  style="color:#06C; font-size:16px;"> <u>Resend Activation Email?</u></a><br />';
                    }//activate email
                }else{
                    return 'Invalid email / password combination!';
                }
            } //Blocked account error massage
        }else{
            return 'Invalid email / password combination!';
        }
    }

    public function twoFac($email,$code,$name){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $to  = $email;
        $subject = "Envato Limited 2FA Auth Code";
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<h6><img src="https://www.signalearners.com/img/logo.png" /></h6>
<div style="font-size: 14px;">
<p>
Hello, '.$name.'
</p><p>
This email contains your 2 Factor Authentication code to complete your login at signalearners.com.
</p>
Email: '.$email.'<br />
Code: <strong>'.$code.'</strong><br />
This code is case sensitive!
</p>
<p>
Login request was made from '.$ip.'
<br />
-----BEGIN PGP SIGNATURE-----
Version: GbuPG v3
<br />
vcxzolPJirvcxzolPJiruLdy8L+gvVwH/0vvcxzolPJirNX5kXZzCjXAwFs
/HLlrClmKHKPHL8wdjUCM6GkgWV3lxaoTvcxzolPJirxUGpcRQVXY4mDCaBtH8g0
bs7AnNmlwF8vcxzolPJirrWcVqVUYDdbXS+F93mxubaYJNW0z4JHGEI84hMlnP5rg5l
VfnpGFTwNUObSZhltzjq+vcxzolPJir//ypRYhKCkzD1+LxnVP5nyDaglAaDe/YB
CRNKsnl48/DsIr0wvcxzolPJircN3otXUNBVSV9p22uFdeOixKNv5+b+dYUYSYtK7xpTml2
AibtcELUrGfO+hxdgxkuvevK/VvcxzolPJirJzrWKMFhzG3sg15wjTu5pm/pvcxzolPJirY=
=yGHS
-----END PGP SIGNATURE-----
</p>
<p>Best Regard<br />
Envato Limited Support Team<br />
Email: support@signalearners.com<br />
</p>
 </div>
</body>
</html>';
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: Envato Limited <support@signalearners.com>' . "\r\n";
        $retval = @mail($to,$subject,$message,$header);
        if($retval = true){
            return  'Mail sent successfully. Check '.$email.' email account for `Email Activation Link`!';
        }else{
            return  'Internal error. Mail fail to send';
        }
        return $this;
    }

    public function resetpassword($email,$get_resetcode,$newpassword,$tablename,$checkfield,$passfield,$resetcoldfield,$rawpass){
        $_SESSION['error'] = '';
        $Check = "SELECT * FROM $tablename WHERE   $checkfield = :dataadd limit 1";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmta = $db->prepare($Check);
        $stmta->bindValue(':dataadd',$email);
        $stmta->execute();
        $row = $stmta->fetch(PDO::FETCH_ASSOC);
        $reset_code = $row['forget_password_code'];
        if($reset_code == $get_resetcode){
            $rand = uniqid();
            $update = "UPDATE $tablename SET $passfield = '$newpassword', $resetcoldfield = '$rand', `rawpass`= '$rawpass' WHERE $checkfield = '$email'";
            $set = $db->prepare($update);
            if($set->execute()){
                header("location:success.php");
            }else{
                return 'Internal Error. Password failed to update!';
            }
        }else{
            return 'Internal Error. ID seem to be used earlier! OR Session has expired';
        }
    }

    public function getLastID($table){
        //$email = $_SESSION['user_code'];
        $sql = "SELECT `id` FROM $table ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $data = $row['id'];
        return $data;
    }

    public function valueSET($table){
        $sql = "SELECT * FROM $this->codex WHERE id=1";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $data = $row['status'];
        return $data;
    }

    public function checkValueSET(){
        if(self::valueSET('valset') == 'Yes'){
            die('<h3>Site Temporary Unavailable. Maintenance Currently On Going!!! Check Back Soon. Thanks</h3>');
        }else{

        }
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

    public function selectFrmDB($table,$field,$info,$clause){
        $sql = "SELECT $field FROM $table WHERE  $info = '".$clause."' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $data = $row[$field];
            return $data;
        }else{
            $this->_errMsg = 0;
            return $this->_errMsg;
        }
    }

    public function selectFrmDB2($table,$field,$info,$clause,$info2,$clause2){
        $sql = "SELECT $field FROM $table WHERE  $info = '".$clause."'  and $info2 = '".$clause2."'";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $data = $row[$field];
            return $data;
        }else{
            $this->_errMsg = 0;
            return $this->_errMsg;
        }
    }

    public function loginAdmin($email,$password,$page){
        $_SESSION['error'] = '';
        $sql="select * from $this->admin_tb where `email` = :email and `password` = :password limit 1";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['blocked_account']==1){
                return 'Your Account is locked!';
            }else{
                if($row['email']==$email){
                    $_SESSION['admin_id'] = $row['email'];
                    $_SESSION['logged_in'] = time();
                    header('location:'.$page);
                }else{
                    return 'Invalid email / password combination';
                }
            }
        }else{
            return 'Invalid email / password combination';
        }
    }

    public function add_interest_weeklyLA(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter = 24 and plan_type='LEVEL1'  ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $weekly_growth = $row['intrest_growth'];
                $amount = $row['amount'];
                $plan_type = $row['plan_type'];
                $coin_type = $row['coin_type'];
                if($plan_type=='LEVEL1'){
                    $weekly_interest = ($amount * ($this->percentageA/100))+$amount;
                }else{
                    $weekly_interest = 0;
                }
                $adder = $weekly_growth + $weekly_interest;
                $email = $row['email'];
                //and invest_week_day='".$day_on."'
                $update = "UPDATE $this->deposit_tb SET intrest_growth='".$adder."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter = 24  and plan_type='LEVEL1'  ";
                query_sql($update);
            }}
    }

    public function weekly_ConunterLA(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter < 25 and plan_type='LEVEL1' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $email = $row['email'];
                $count_value = $row['day_counter'];
                $new_count_value = $count_value + 1;
                $update = "UPDATE $this->deposit_tb SET day_counter='".$new_count_value."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter < 25  and plan_type='LEVEL1'  ";
                query_sql($update);
            }}
    }

    public function add_interest_weeklyLB(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter = 48 and plan_type='LEVEL2' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $weekly_growth = $row['intrest_growth'];
                $amount = $row['amount'];
                $plan_type = $row['plan_type'];
                $coin_type = $row['coin_type'];
                if($plan_type=='LEVEL2'){
                    $weekly_interest =  ($amount * ($this->percentageB/100))+$amount;
                }else{
                    $weekly_interest = 0;
                }
                $adder = $weekly_growth + $weekly_interest;
                $email = $row['email'];
                $update = "UPDATE $this->deposit_tb SET intrest_growth='".$adder."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter = 48  and plan_type='LEVEL2' ";
                query_sql($update);
            }}
    }

    public function weekly_ConunterLB(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter < 49 and plan_type='LEVEL2' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $email = $row['email'];
                $count_value = $row['day_counter'];
                $new_count_value = $count_value + 1;
                $update = "UPDATE $this->deposit_tb SET day_counter='".$new_count_value."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter < 49  and plan_type='LEVEL2' ";
                query_sql($update);
            }}
    }

    public function add_interest_weeklyLC(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter = 72 and plan_type='LEVEL3' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $weekly_growth = $row['intrest_growth'];
                $amount = $row['amount'];
                $plan_type = $row['plan_type'];
                $coin_type = $row['coin_type'];

                if($plan_type=='LEVEL3'){
                    $weekly_interest =  ($amount * ($this->percentageC/100))+$amount;
                }else{
                    $weekly_interest = 0;
                }

                $adder = $weekly_growth + $weekly_interest;
                $email = $row['email'];
                $update = "UPDATE $this->deposit_tb SET intrest_growth='".$adder."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter = 72  and plan_type='LEVEL3' ";
                query_sql($update);
            }}
    }

    public function weekly_ConunterLC(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter < 73 and plan_type='LEVEL3' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $email = $row['email'];
                $count_value = $row['day_counter'];
                $new_count_value = $count_value + 1;
                $update = "UPDATE $this->deposit_tb SET day_counter='".$new_count_value."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter < 73  and plan_type='LEVEL3' ";
                query_sql($update);
            }}
    }

    public function add_interest_weeklyLD(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter = 120 and plan_type='LEVEL4' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $weekly_growth = $row['intrest_growth'];
                $amount = $row['amount'];
                $plan_type = $row['plan_type'];
                $coin_type = $row['coin_type'];

                if($plan_type=='LEVEL4'){
                    $weekly_interest =  ($amount * ($this->percentageD/100))+$amount;
                }else{
                    $weekly_interest = 0;
                }

                $adder = $weekly_growth + $weekly_interest;
                $email = $row['email'];
                $update = "UPDATE $this->deposit_tb SET intrest_growth='".$adder."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter = 120  and plan_type='LEVEL4' ";
                query_sql($update);
            }}
    }

    public function weekly_ConunterLD(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter < 121 and plan_type='LEVEL4' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $email = $row['email'];
                $count_value = $row['day_counter'];
                $new_count_value = $count_value + 1;
                $update = "UPDATE $this->deposit_tb SET day_counter='".$new_count_value."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter < 121  and plan_type='LEVEL4' ";
                query_sql($update);
            }}
    }

    public function add_interest_weeklyLE(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter < 100 and plan_type='LEVEL5' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $weekly_growth = $row['intrest_growth'];
                $amount = $row['amount'];
                $plan_type = $row['plan_type'];
                $coin_type = $row['coin_type'];

                if($plan_type=='LEVEL5'){
                    $weekly_interest =  ($amount * ($this->percentageE/100));
                }else{
                    $weekly_interest = 0;
                }

                $adder = $weekly_growth + $weekly_interest;
                $email = $row['email'];
                $update = "UPDATE $this->deposit_tb SET intrest_growth='".$adder."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter < 101  and plan_type='LEVEL5' ";
                query_sql($update);
            }}
    }

    public function weekly_ConunterLE(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter < 100 and plan_type='LEVEL5' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $email = $row['email'];
                $count_value = $row['day_counter'];
                $new_count_value = $count_value + 1;
                $update = "UPDATE $this->deposit_tb SET day_counter='".$new_count_value."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter < 100  and plan_type='LEVEL5' ";
                query_sql($update);
            }}
    }

    public function yearly_Conunter(){
        $count_day = $this->sub_duration+2;
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter < '". $count_day."' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $day_on = date('D');
                $id = $row['id'];
                $email = $row['email'];
                $count_value = $row['day_counter'];
                $new_count_value = $count_value + 1;
                $update = "UPDATE $this->deposit_tb SET day_counter='".$new_count_value."' WHERE id='".$id."' 
			and deposit_status='confirmed' and day_counter < '". $count_day."'  ";
                query_sql($update);
            }}
    }

    public function yearly_Subscriber_Check()
    {
        $sql = "SELECT * FROM $this->deposit_tb WHERE deposit_status='confirmed' and day_counter >= '".$this->sub_duration."' ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if ($stmt->execute()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $day_on = date('D');
                $id = $row['id'];
                $weekly_growth = $row['intrest_growth'];
                $amount  = $row['amount'];
                $plan_type = $row['plan_type'];
                $coin_type = $row['coin_type'];
                $day_counter = $row['day_counter'];
                $email = $row['email'];
                $sta = 'expired';
                $payment_activation_status = 'no';

                $update = "UPDATE $this->deposit_tb SET deposit_status='".$sta."' WHERE id='" . $id . "' and deposit_status='confirmed' and nd day_counter >= '".$this->sub_duration."' ";
                query_sql($update);

                $update2 = "UPDATE $this->user_tb SET payment_activation_status='" . $payment_activation_status . "' WHERE email='" . $email . "'  ";
                query_sql($update2);
            }
        }
    }

    public function checkLogedIN($sendTopage){
        if(isset($_SESSION['user_code'])&&!empty($_SESSION['user_code'])){
            if(self::checkifdataExists($_SESSION['user_code'], 'hashed_pot',$this->user_tb)==1){
            }else{
                return header("location:".$sendTopage);
            }
        }else{
            return header("location:".$sendTopage);
        }
    }

    public function running_day(){
        $sql = "SELECT * FROM $this->daycount WHERE `id`=1 ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $id = $row['id'];
                $count_value = $row['counter'];
                $new_count_value = $count_value + 1;
                $update = "UPDATE $this->daycount SET counter='".$new_count_value."' WHERE `id`=1";
                query_sql($update);
            }}
    }

    public function checkLogedINSendOut($sendTopage){
        if(isset($_SESSION['user_code'])&&!empty($_SESSION['user_code'])){
            return header("location:".$sendTopage);
        }else{}
    }

    public function loginAdmino($ipconnect){
        if(self::ipconect()!=self::urlconect() || self::ipconect2()!=self::urlconect2()){
            die('<h2>Site currently undergoing maintenance! We will be back soon!</h2>');
        }else{}
    }

    public function checkLogedINAdmin($sendTopage){
        if(isset($_SESSION['admin_id'])&&!empty($_SESSION['admin_id'])){
            if(self::checkifdataExists($_SESSION['admin_id'], 'email',$this->admin_tb)==1){
            }else{
                return header("location:".$sendTopage);
            }
        }else{
            return header("location:".$sendTopage);
        }
    }

    public function puchChang($prv,$pub,$scret){
        $field1 = array('token'); $value1 = array($prv);
        $field2 = array('token'); $value2 = array($pub);
        $field3 = array('token'); $value3 = array($scret);
        $chec1  = self::update($this->bockprv,$field1,$value1,'id','1');
        $chec2  = self::update($this->bockpub,$field2,$value2,'id','1');
        $chec3  = self::update($this->secrete,$field3,$value3,'id','1');
        return $chec1.'/'.$chec2.'/'.$chec3;
    }

    public function checkLogedINSendOutAdmin($sendTopage){
        if(isset($_SESSION['admin_id'])&&!empty($_SESSION['admin_id'])){
            return header("location:".$sendTopage);
        }else{}
    }

}

$cal = new Cal($sub_duration, $percentageA, $percentageB, $percentageC, $percentageD, $percentageE, $percentageF, $percentageG);
?>
<?php
$object_address = array(
    '3GZ4rs8j8kME7FbWh3WX1SBFsisvQqg7em',
    '1CjnXKS8knEXfEaigit4BM4sDGDSGZgqyV',
    '18mxVc3ifMynyui22WUHXADDdtmAZeTD2p',
    '18sKaoTuewAUx4RvWyqdDCQFtGGH8ThuEQ',
    '18mxVc3ifMynyui22WUHXADDdtmAZeTD2p',
    '1CLFJrfGsDKP7FCmh9JSFcy7uVUGdCXowW',
    '1CtDbekwKoTiAkQrebX8htWkc1e2W9Wxkm',
    '1Gw9JTWZ3Mt6LWZ1nN4YwW79pU4gUNxNmf');
$rand_ad = rand(0,7);

$url = "https://blockchain.info/stats?format=json";
$stats = @json_decode(file_get_contents($url), true);
$btcValue = @$stats['market_price_usd'];
$_SESSION['btc_value'] = $btcValue;
?>
<?php
$time = date("H");
$timezone = date("e");
if ($time < "12") {
    $timewhen =  "Good morning";
} else if ($time >= "12" && $time < "17") {
    $timewhen =  "Good afternoon";
} else if ($time >= "17" && $time < "19") {
    $timewhen =  "Good evening";
}else{
    $timewhen =  "Greetings";
}
?>