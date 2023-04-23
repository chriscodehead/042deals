<?php
$user_tb = "user_tb";
$deposit_tb = "deposit_td";
$tickect_tb = 'ticket_tb';
$withdraw_tb = 'withdraw_tb';
$referral_tb = 'referral_tb';
$capital_withdrawal = 'capital_withdrawal';
$news = 'news';
$admin_tb = 'admin_tb';
$agorithm = 'haval160,4';
$pay_set = 'pay_set';
$life_one_bonus = 'life_one_bonus';
$payout_manipulate = 'payout_manipulate';
$review = 'review';
$course_tb = 'course_tb';
$product = 'product';
$comments_tb = 'comments_tb';
$news_letter = 'news_letter';
$orders_tb = 'orders_tb';
class select extends DBConnection
{
    private      $_query,
        $_error = false,
        $_count = 0,
        $_errMsg,
        $_sucMsg,
        $_results;
    protected $sql;
    protected $user_tb = "user_tb";
    protected $deposit_tb = "deposit_td";
    protected $tickect_tb = 'ticket_tb';
    protected $withdraw_tb = 'withdraw_tb';
    protected $referral_tb = 'referral_tb';
    protected $capital_withdrawal = 'capital_withdrawal';
    protected $news = 'news';
    protected $admin_tb = 'admin_tb';
    protected $pay_set = 'pay_set';
    protected $life_one_bonus = 'life_one_bonus';
    protected $payout_manipulate = 'payout_manipulate';
    protected $review = 'review';
				protected $course_tb = 'course_tb';
				protected $product = 'product';
				protected $comments_tb = 'comments_tb';
				protected $news_letter = 'news_letter';
				protected $orders_tb = 'orders_tb';
    public function PendingInvestment($email){
        $sql = "SELECT * FROM $this->deposit_tb WHERE `email` = '".$email."'  and `deposit_status` = 'pending'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
          <div class="table-responsive">
           <table id="myTable" class="table table-striped">
			<thead>
				<tr style="color:#000;"  class="shad">
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Amount</th>
						<th >Type</th>
						<th >Plan</th>
						<th >Status</th>
						<th >Date Reg.</th>
						<th >Blockchain Status</th>
						<th >Terminate</th>
				</tr>
			</thead>
			<tbody>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['coin_type']=="BTC"){
                    if($row['btc_address']=="none"){
                        $addressy = 'Network Problem contact: support@signalearners.com';
                    }else{
                        $addressy = @$row['btc_address'];
                    }
                }else if($row['coin_type']=="ETH"){
                    if($row['ethereum_address']=="none"){
                        $addressy = 'Network Proble contact: support@signalearners.com';
                    }else{
                        $addressy = @$row['ethereum_address'];
                    }
                }
                if($row['deposit_status']=='pending'){
                    $add = ''/*'
								  <tr style="color:#000;">
								 	<td style="text-align: left; background-image: linear-gradient(#FFF,#D49999);" colspan="9">You have a pending payment to be made. Please pay into this <span style="font-size:18px; color:#06C;">'. $row['coin_type'].' wallet address </span> = <span style="font-size:18px; color:#06C;">( '.$addressy.' )</span> not later than 3hours the transaction was created. Please ignore if
you already made payment. Have any problem? Contact us @ support@signalearners.com</td>
								 </tr>'*/;
                }else{$add='';}


                if($row['deposit_status']=='canceled'){
                    $can = '<i class="btn btn-circle btn-danger">Canceled</i>';
                }else{
                    $can = '';
                }

                if($row['deposit_status']=='confirmed'){
                    $color = '#006600';
                }else if($row['deposit_status']=='done'){
                    $color = '#CCC';
                }else{ $color = '';}


                if($row['total_not_paid']>0){
                    $st = $row['deposit_status'];
                }else{
                    $st = 'Terminated';
                }
                echo '

	<tr style="color:'.$color.'">
			<td >'. $i.'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td >'.$row['coin_value'].''. $row['coin_type'].' ($'.$row['amount'].')</td>
			<td style="color:#06C;">'.$row['coin_type'].'</td>
			<td style="color:#06C;">'.$row['plan_type'].'</td>
			<td class="text-success">'. $row['deposit_status'].'</td>
			<td >'. $row['date_created'].'</td>
			<td ><a class="status-complete btn btn-success text-white" href="'.$row['status_url'].'">View</a></td>
			<td title="Cancel Transaction"><a data-toggle="modal" href="#myModalTT'.$row['id'].'"><i class="btn btn-circle btn-danger fa fa-trash-o text-white">X</i></a></td>
			
		
			
			                  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalTT'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Terminate transaction ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to terminate this transaction</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          
								  <span onClick="deleteTransaction('.$row['id'].');" class="btn btn-danger btn-theme">Terminate</span>
								  
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			</tr>
			'.$add.'
		';
                $i++;
            }

        }else{
            echo '<td colspan="9">No Record Found!</td>';
        }
        echo '
		 </tbody>
      </table>
     </div>';
        return $this;
    }

    public function getRecentDeposit(){
        $sql = "SELECT * FROM $this->deposit_tb WHERE `deposit_status`='confirmed' ORDER BY id DESC LIMIT 10";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
           <table class="statsTable" align="center" width="60%">
			<thead>
				<tr>
					<th>Username</th>
					<th>Payment system</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['coin_type']=='BTC'){
                    $te = '<img src="img/btc.png" >';
                }else if($row['coin_type']=='ETH'){
                    $te = '<img src="img/Ethereum.png" >';
                }else{
                    $te = '<img src="img/pm.png">';
                }
                echo '
				<tr align="center">
				 <td>'. self::selectFrmDB($this->user_tb,'client_username','email',$row['email']).'</td>
				 <td>'.@$te.'</td>
				 <td>$'.number_format($row['amount'],2).'</td>
				</tr>
		';
                $i++;
            }

        }else{
            '<td colspan="3">No Record Found!</td>';
        }
        echo '
		 </tbody>
      </table>';
        return $this;
    }

    public function getRecentWithdrawal(){
        $sql = "SELECT * FROM $this->withdraw_tb WHERE `status`='paid' ORDER BY id DESC LIMIT 10";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
           <table align="center" class="statsTable" align="center" width="100%">
			<thead>
				<tr>
					<th>Username</th>
					<th>Payment system</th>
					<th>Amount</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['coin_type']=='BTC'){
                    $te = '<img src="img/btc.png">';
                }else if($row['coin_type']=='ETH'){
                    $te = '<img src="img/Ethereum.png" >';
                }else{
                    $te = '<img src="img/pm.png">';
                }
                echo '
				<tr align="center">
				 <td>'. self::selectFrmDB($this->user_tb,'client_username','email',$row['email']).'</td>
				 <td>'.@$te.'</td>
				 <td>$'.number_format($row['amount'],2).'</td>
				 <td>'.$row['date_time'].'</td>
				</tr>
		';
                $i++;
            }

        }else{
            '<td colspan="3">No Record Found!</td>';
        }
        self::getR();
        echo '
		 </tbody>
      </table>';
        return $this;
    }

    public function getR(){
        $sql = "SELECT * FROM  $this->payout_manipulate  ORDER BY id DESC LIMIT 10";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['coin_type']=='BTC'){
                    $te = '<img src="img/btc.png" >';
                }else if($row['coin_type']=='ETH'){
                    $te = '<img src="img/Ethereum.png" >';
                }else{
                    $te = '<img src="img/pm.png">';
                }
                echo '
				<tr align="center">
				 <td>'.$row['username'].'</td>
				 <td>'.@$te.'</td>
				 <td>$'.number_format($row['amount'],2).'</td>
				 <td>'.$row['date_reg'].'</td>
				</tr>
		';
                $i++;
            }

        }
        return $this;

    }

    public function AllPayoutsHistory($email){
        $sql = "SELECT * FROM $this->withdraw_tb WHERE email = '".$email."' ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
	    <div class="table-responsive">
            <table id="myTable" class="table table-striped">
			<thead>
				<tr style="color:#000;" class="shad">
						<th >S/N</th>
						<th >Transactn ID</th>
						<th >Amount($)</th>
						<th >Status</th>
						<th >Type</th>
						<th >Coin Type</th>
					   <th >Date Created.</th>
				</tr>
					</thead>
					<tbody>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['status']=='paid'){
                    $color = '#006600';
                }else{ $color = '#333';}
                echo
                    '<tr style="color:'.$color.'">
			<td >'. $i.'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td style="color:#06C;">'. $row['amount'].'</td>
			<td style="color:#009900;">'.$row['status'].'...</td>
			<td >'.$row['type'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td >'. $row['date_time'].'</td>
	</tr>';
                $i++;
            } }else{
            echo '<td colspan="6">No Record Found!</td>';
        }
        echo '
						  </tbody>
						</table></div>';
        return $this;
    }


    public function Withdrawal2($email){
        $sql = "SELECT * FROM $this->withdraw_tb WHERE email = '".$email."'  ORDER BY id DESC LIMIT 2";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="table" style="font-size:11px;">
			<thead>
				<tr style="color:#000;" class="shad">
						<th>S/N</th>
						<th>Transactn ID</th>
						<th>Amount($)</th>
						<th>Status</th>
						<th>Type</th>
					   <th>Date</th>
				</tr>
					</thead>
					<tbody>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo
                    '<tr>
			<td >'. $i.'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td style="color:#06C;">'. $row['amount'].'</td>
			<td style="color:#009900;">'.$row['status'].'...</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td >'. $row['date_time'].'</td>
	</tr>';
                $i++;
            } }else{
            echo '<td colspan="6">No Record Found!</td>';
        }
        echo '
						  </tbody>
						</table>';
        return $this;
    }

    public function myInvestment($email){
        $sql = "SELECT * FROM $this->deposit_tb WHERE `email` = '".$email."'  and `deposit_status` = 'confirmed'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
		<div class="table-responsive">
          <table id="myTable" class="table table-striped">
			<thead>
				<tr style="color:#000;" class="shad">
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Amount</th>
						<th >Interest($)</th>
						<th >Status</th>
						<th >Day On</th>
						<th >Type</th>
						<th >Plan</th>
						<th >CashOut($)</th>
						<th >Date Reg.</th>
				</tr>
			</thead>
			<tbody>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                echo '

	<tr style="color:#333;">
			<td >'.$i.'</td>
			<td >'.$row['transaction_id'] .'</td>
			<td >'.$row['coin_value'].''.$row['coin_type'].' ($'.$row['amount'].')</td>
			<td style="color:#06C;">'.   self::round_out($row['intrest_growth'],4).'</td>
		    <td >'.$row['deposit_status'].'</td>
			<td style="color:#06C;">'.$row['day_counter'].'</td>
			<td style="color:#06C;">'.$row['coin_type'].'</td>
			<td style="color:#06C;">'.$row['plan_type'].'</td>
			<td style="color:#06C;">'.$row['total_paid'].'</td>
			<td >'. $row['date_created'].'</td>
			</tr>
		';
                $i++;
            }

        }else{
            echo '<td colspan="8">No Record Found!</td>';
        }
        echo '
		</tbody>
     </table>
    </div>
';
        return $this;
    }


    public function GetDeposit($email,$plan){
        $sql = "SELECT * FROM $this->deposit_tb WHERE `email` = '".$email."' and `plan_type`='".$plan."'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $i =1;
        if(count($stmt)>0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $samt = $row['intrest_growth']+$row['total_paid'];
                echo '
	     <tr align="center">
			<td style="font-size:11px;">'.$row['deposit_status'].'</td>
			<td style="font-size:11px;">'.$row['transaction_id'] .'</td>
			<td >$'.number_format($row['amount'],2).'</td>
			<td style="color:#06C;">'.$row['day_counter'].'</td>
			<td style="color:#06C;">'.$row['coin_type'].'</td>
			<td style="color:#06C;">$'.number_format($samt,2).'</td>
			<td style="font-size:11px;">'. $row['date_created'].'</td>
		 </tr>
		';
                $i++;
            }
        }else{
            echo '<td colspan="7">No Record Found!</td>';
        }
        return $this;
    }


    public function GetDepositALLs($email){
        $sql = "SELECT * FROM $this->deposit_tb WHERE `email` = '".$email."'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $i =1;
        if(count($stmt)>0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $samt = $row['intrest_growth'];
                echo '
	     <tr>
		 	<td >'.$i.'</td>
		 	<td style="font-size:11px;">'.$row['plan_type'].'</td>
			<td style="font-size:11px;">'.$row['coin_type'].'</td>
			<td >$'.number_format($row['total_paid']).'</td>
			<td >$'.number_format($row['amount']).'</td>
			<td style="color:#06C;">$'.number_format($samt).'</td>
			<td style="font-size:11px;">'. $row['date_created'].'</td>
		 </tr>
		';
                $i++;
            }
        }else{
            echo '<td colspan="7">You have no transactions yet.</td>';
        }
        return $this;
    }


    public function GetDepositNEWALL($email){
        $sql = "SELECT * FROM $this->deposit_tb WHERE `email` = '".$email."'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $i =1;
        if(count($stmt)>0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $samt = $row['intrest_growth']+$row['total_paid'];
                if($row['coin_type']=="BTC"){
                    $stu = '<a href="'.$row['status_url'].'"><i class="fa fa-eye"></i> Details</a>';
                }else{
                    $stu = 'Not available';
                }
                if($row['deposit_status']=="confirmed"){
                    $col = 'text-yellow';
                }else{
                    $col = '';
                }
                echo '
	     <tr class="'.$col.'">
		 	<td >'.$i.'</td>
		 	<td style="font-size:11px;">'.$row['transaction_id'].'</td>
			<td >$'.number_format($row['amount'],2).'</td>
			<td >'.$row['coin_type'].'</td>
			<td style="font-size:11px;">'. $row['date_created'].'</td>
			<td >'.$row['deposit_status'].'</td>
			<!--<td style="font-size:11px;">'.$stu.'</td>-->
		 </tr>
		';
                $i++;
            }
        }else{
            echo '<td colspan="7">You have no transactions yet.</td>';
        }
        return $this;
    }


    public function GetTransactions($email){
        $sql = "SELECT * FROM $this->deposit_tb WHERE `email` = '".$email."' and (`deposit_status`='confirmed' || `deposit_status`='done')  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $i =1;
        if(count($stmt)>0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['deposit_status']=='done'){
                    $st = 'Closed';
                    $co = 'red';
                    $am = 0;
                }else{
                    $st = 'Active';
                    $co = 'green';
                    $am = $row['amount'];
                }

                //$samt = $row['intrest_growth']+$row['total_paid'];
                $samt = $row['intrest_growth'];
                echo '
	     <tr>
		    <td style="color:'.$co.';">'.$i.'</td>
			<td >'.$row['transaction_id'].'</td>
			<td >$'.number_format($row['amount']).'</td>
			<td style="color:#06C;">'.$row['plan_type'].'</td>
			<td style="color:#06C;">$'.number_format($samt).'</td>
			<td style="font-size:11px;">'. $row['deposit_status'].'</td>
		 </tr>
		';
                $i++;
            }
        }else{
            echo '<td colspan="6">You have no portfolios yet. Create your first investment portfolio to start earning interests from our trading activities.</td>';
        }
        return $this;
    }


    public function PendingWithdrawal($email){
        $sql = "SELECT * FROM $this->withdraw_tb WHERE email = '".$email."' and `status`='processing' ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
          <div class="table-responsive">
           <table id="myTable" class="table table-striped">
			<thead>
				<tr style="color:#000;" class="shad">
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Amount($)</th>
						<th >Status</th>
						<th >Type</th>
						<th >Coin Type</th>
						<th >Plan</th>
					   <th >Date Created.</th>
				</tr>
					</thead>
					<tbody>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['status']=='paid'){
                    $color = '#006600';
                }else{ $color = '#333';}
                echo
                    '<tr style="color:'.$color.'">
			<td >'. $i.'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td style="color:#06C;">'. $row['amount'].'</td>
			<td style="color:#009900;">'.$row['status'].'...</td>
			<td >'.$row['type'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td style="color:#06C;">'. $row['plan_type'].'</td>
			<td >'. $row['date_time'].'</td>
	</tr>';
                $i++;
            } }else{
            echo '<td colspan="6">No Record Found!</td>';
        }
        echo '
						  </tbody>
						</table>
					</div>';
        return $this;
    }


    public function createWithdrawalALL($email,$cointype){
        $sql = "SELECT * FROM $this->deposit_tb WHERE email = '".$email."'  and `deposit_status`='confirmed' and `place_order`!='done' and `coin_type`='".$cointype."'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
         
					

					<form method="post" enctype="multipart/form-data" action="" id="formInt" >
					';
        $i =1; $sum=0; $expire = 6;

        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                if($cointype=='REAL-ESTATE'){
                    if($row['coin_type']=='REAL-ESTATE' && $row['plan_type']=='LEVEL1' && $row['day_counter']==48){
                        $check = '<input  type="checkbox" id="intrest" class="form-control" name="intrest" value="'.$row['transaction_id'].'" >
			<input class="tamt" id="transactionid" type="hidden" name="transactionid'.$row['id'].'" value="'.$row['intrest_growth'].'" >';'';
                    }else

                        if($row['coin_type']=='REAL-ESTATE' && $row['plan_type']=='LEVEL2' && $row['day_counter']==24){
                            $check = '<input  type="checkbox" id="intrest" class="form-control" name="intrest" value="'.$row['transaction_id'].'" >
			<input class="tamt" id="transactionid" type="hidden" name="transactionid'.$row['id'].'" value="'.$row['intrest_growth'].'" >';
                        }else

                            if($row['coin_type']=='REAL-ESTATE' && $row['plan_type']=='LEVEL3' && $row['day_counter']==16){
                                $check = '<input  type="checkbox" id="intrest" class="form-control" name="intrest" value="'.$row['transaction_id'].'" >
			<input class="tamt" id="transactionid" type="hidden" name="transactionid'.$row['id'].'" value="'.$row['intrest_growth'].'" >';
                            }else{$check ='';}

                }else

                    if($cointype=='CAR-INVEST'){
                        if($row['coin_type']=='CAR-INVEST' && $row['plan_type']=='LEVEL1' && $row['day_counter']==48){
                            $check = '<input  type="checkbox" id="intrest" class="form-control" name="intrest" value="'.$row['transaction_id'].'" >
			<input class="tamt" id="transactionid" type="hidden" name="transactionid'.$row['id'].'" value="'.$row['intrest_growth'].'" >';
                        }else

                            if($row['coin_type']=='CAR-INVEST' && $row['plan_type']=='LEVEL2' && $row['day_counter']==24){
                                $check = '<input  type="checkbox" id="intrest" class="form-control" name="intrest" value="'.$row['transaction_id'].'" >
			<input class="tamt" id="transactionid" type="hidden" name="transactionid'.$row['id'].'" value="'.$row['intrest_growth'].'" >';
                            }else

                                if($row['coin_type']=='CAR-INVEST' && $row['plan_type']=='LEVEL3' && $row['day_counter']==16){
                                    $check = '<input  type="checkbox" id="intrest" class="form-control" name="intrest" value="'.$row['transaction_id'].'" >
			<input class="tamt" id="transactionid" type="hidden" name="transactionid'.$row['id'].'" value="'.$row['intrest_growth'].'" >';
                                }else{$check ='';}
                    }else

                        if($cointype=='BTC'){
                            $check = '<input  type="checkbox" id="intrest" class="form-control" name="intrest" value="'.$row['transaction_id'].'" >
			<input class="tamt" id="transactionid" type="hidden" name="transactionid'.$row['id'].'" value="'.$row['intrest_growth'].'" >';
                        }


                if($this->selectFrmDB($this->capital_withdrawal,'status','id',1)=='YES'){
                    $cap = '<td ><a title="Take capital plus interest" href="capital_interest?id='.$row['id'].'">
			<i class="btn btn-default">Capital plus Interest</i></a></td>';
                }else{
                    $cap='';
                }/*<td>
			'.@$check.'
			</td>*/
                echo '
		<tr>
		   
			<td>'.$row['transaction_id'].'</td>
			<td >$'.number_format($row['amount']).'</td>
			<td style="color:#427B1E;">$'.self::round_out($row['intrest_growth'],3).'</td>
			<td >'. $row['date_created'].'</td>
			<td><a href="withdraw2.php?id='.$row['coin_type'].'&ip='.$row['transaction_id'].'" class="btn btn-success">CashOut</a></td>
			<!--'.$cap.'-->
	   </tr> 
	';
                $i++;
            }

        }else{
            echo '<td colspan="6">No Records Found!</td>';
        }
        echo '
						  <button type="submit" name="sub" style="display:none;"></button>
						        </form>
						 
						  ';
        return $this;
    }

    public function createWithdrawalALL22($email,$cointype,$id){
        $sql = "SELECT * FROM $this->deposit_tb WHERE email = '".$email."'  and `deposit_status`='confirmed' and `place_order`!='done' and `coin_type`='".$cointype."' and `transaction_id`='".$id."'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
         
					<form method="post" enctype="multipart/form-data" action="" id="formInt" >
					';
        $i =1; $sum=0; $expire = 6;

        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                $check = '<input checked disabled  type="checkbox" id="intrest" class="form-control" name="intrest" value="'.$row['transaction_id'].'" >
			<input class="tamt" id="transactionid" type="hidden" name="transactionid'.$row['id'].'" value="'.$row['intrest_growth'].'" >';


                if($this->selectFrmDB($this->capital_withdrawal,'status','id',1)=='YES'){
                    $cap = '<td ><a title="Take capital plus interest" href="capital_interest?id='.$row['id'].'">
			<i class="btn btn-default">Capital plus Interest</i></a></td>';
                }else{
                    $cap='';
                }
                echo '
		<tr>
		   <td>
			'.@$check.'
			</td>
			<td>'.$row['transaction_id'].'</td>
			<td >$'.number_format($row['amount']).'</td>
			<td style="color:#427B1E;">$'.number_format($row['intrest_growth']).'</td>
			<td >'. $row['date_created'].'</td>
			<!--'.$cap.'-->
	   </tr> 
	';
                $i++;
            }

        }else{
            echo '<td colspan="5">No Records Found!</td>';
        }
        echo '
						  <button type="submit" name="sub" style="display:none;"></button>
						        </form>
						 
						  ';
        return $this;
    }


    public function createReferralWithdrawalALL($email,$cointype){
        $sql = "SELECT * FROM $this->referral_tb WHERE referral_email = '".$email."' and `coin_type`='".$cointype."'  and (`status`='confirmed' || `status`='pending') and `balance` != 0 ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $i =1; $sum=0;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['status']=='pending'){
                    $checkboxx = '<input type="checkbox" id="none" class="" name="non" value="" >';
                }else if($row['status']=='confirmed'){
                    $checkboxx = '<input type="checkbox" id="intrestREF" class="" name="intrestREF" value="'.$row['transaction_id'].'" >
								   <input class="tamt" id="transactionid" type="hidden" name="transactionid'.$row['id'].'" value="'.$row['amount'].'" >
								   ';
                }

                echo '
		<tr>
			<td >'.$checkboxx.'</td>
			<td >'. $row['status'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td style="color:#06C;">'. $row['amount'].'</td>
			<td style="color:#06C;">'. $row['balance'].'</td>
			<td >'. $row['date_created'].'</td>
	</tr> ';
                $i++;
            }

        }else{
            echo '<td colspan="6">No Records Found!</td>';
        }
        return $this;
    }



    public function createWithdrawal($email){
        $sql = "SELECT * FROM $this->deposit_tb WHERE email = '".$email."'  and `deposit_status`='confirmed' and `place_order`!='done' and `coin_type`='BTC'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
         <div class="table-responsive">
			<table class="tablesaw table-hover table" data-tablesaw-mode="swipe" data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap data-tablesaw-mode-switch>
			<thead>
				<tr style="color:#000;" class="shad">
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Deposit Amount($)</th>
						<th >interest Growth($)</th>
						<th >Status</th>
						<th>Type</th>
						<th>Plan</th>
						<th>CashOut($)</th>
						<th >Date Created.</th>
						<th >Action</th>
					</tr>
			</thead>
					<tbody>

					<form method="post" enctype="multipart/form-data" action="" id="formInt" >
					';
        $i =1; $sum=0; $expire = 6;

        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $exp = $expire - $row['day_counter'];
                if($row['deposit_status']=='confirmed' && $row['day_counter']>23 && $row['intrest_growth']==0 && $row['place_order']!='done'){

                    $out_capital = '';

                }else if($row['deposit_status']=='confirmed' && $row['day_counter']>23 && $row['intrest_growth']>0 && $row['place_order']!='done'){

                    $out_capital = '';

                }else{
                    $out_capital = '';
                }
                echo '
		<tr>
			<td >'. $i.'</td>
			<td >'.$row['transaction_id'].'</td>
			<td >'. $row['amount'].'</td>
			<td style="color:#06C;">'. self::round_out($row['intrest_growth'],3).'</td>
			<td >'. $row['deposit_status'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['total_paid'].'</td>
			<td >'. $row['date_created'].'</td>
			<td>
			<input type="checkbox" id="intrest" class="form-control" name="intrest" value="'.$row['transaction_id'].'" >

			<input id="transactionid" type="hidden" name="'.$row['intrest_growth'].'" value="'.$row['intrest_growth'].'" >
			
			</td>
	</tr> 
	'.$out_capital.'
	';
                $i++;
            }

        }else{
            echo '<td colspan="11">No Records Found!</td>';
        }
        echo '
						  <button type="submit" name="sub" style="display:none;"></button>
						        </form>
						  </tbody>
				</table></div>
						  ';
        return $this;
    }


    public function createWithdrawalETH($email){
        $sql = "SELECT * FROM $this->deposit_tb WHERE email = '".$email."'  and `deposit_status`='confirmed' and `place_order`!='done' and `coin_type`='perfectmoney'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="table" style="font-size:11px;">
			<thead>
				<tr style="color:#000;" class="shad">
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Deposit Amount($)</th>
						<th >interest Growth($)</th>
						<th >Status</th>
						<!--<th>Week</th>
						<th>Expires</th>-->
						<th>Type</th>
						<th>Plan</th>
						<th>CashOut($)</th>
						<th >Date Created.</th>
						<th >Action</th>
					</tr>
			</thead>
					<tbody>
					<form method="post" enctype="multipart/form-data" action="" id="formInt" >
					';
        $i =1; $sum=0; $expire = 6;

        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $exp = $expire - $row['day_counter'];

                if($row['deposit_status']=='confirmed' && $row['day_counter']>23 && $row['intrest_growth']==0 && $row['place_order']!='done'){

                    $out_capital = '';

                }else if($row['deposit_status']=='confirmed' && $row['day_counter']>23 && $row['intrest_growth']>0 && $row['place_order']!='done'){

                    $out_capital = '';

                }else{
                    $out_capital = '';
                }
                echo '
		<tr>
			<td >'. $i.'</td>
			<td >'.$row['transaction_id'].'</td>
			<td >'. $row['amount'].'</td>
			<td style="color:#06C;">'. self::round_out($row['intrest_growth'],3).'</td>
			<td >'. $row['deposit_status'].'</td>
			<!--<td style="color:#06C;">'. $row['day_counter'].'</td>
			<td style="color:#06C;">In '.$exp.' Day</td>-->
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['total_paid'].'</td>
			<td >'. $row['date_created'].'</td>
			<td>
			<input type="checkbox" id="intrest2" class="form-control" name="intrest2" value="'.$row['transaction_id'].'" >

			<input id="transactionid" type="hidden" name="'.$row['intrest_growth'].'" value="'.$row['intrest_growth'].'" >
			
			</td>
	</tr> 
	'.$out_capital.'
	';
                $i++;
            }

        }else{
            echo '<td colspan="11">No Records Found!</td>';
        }
        echo '
						  <button type="submit" name="sub" style="display:none;"></button>
						        </form>
						  </tbody>
				</table>
						  ';
        return $this;
    }


    public function createWithdrawalETHME($email){
        $sql = "SELECT * FROM $this->deposit_tb WHERE email = '".$email."'  and `deposit_status`='confirmed' and `place_order`!='done' and `coin_type`='ETH'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="table" style="font-size:11px;">
			<thead>
				<tr style="color:#000;" class="shad">
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Deposit Amount($)</th>
						<th >interest Growth($)</th>
						<th >Status</th>
						<!--<th>Week</th>
						<th>Expires</th>-->
						<th>Type</th>
						<th>Plan</th>
						<th>CashOut($)</th>
						<th >Date Created.</th>
						<th >Action</th>
					</tr>
			</thead>
					<tbody>
					<form method="post" enctype="multipart/form-data" action="" id="formInt" >
					';
        $i =1; $sum=0; $expire = 6;

        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $exp = $expire - $row['day_counter'];

                if($row['deposit_status']=='confirmed' && $row['day_counter']>23 && $row['intrest_growth']==0 && $row['place_order']!='done'){

                    $out_capital = '';

                }else if($row['deposit_status']=='confirmed' && $row['day_counter']>23 && $row['intrest_growth']>0 && $row['place_order']!='done'){

                    $out_capital = '';

                }else{
                    $out_capital = '';
                }
                echo '
		<tr>
			<td >'. $i.'</td>
			<td >'.$row['transaction_id'].'</td>
			<td >'. $row['amount'].'</td>
			<td style="color:#06C;">'. self::round_out($row['intrest_growth'],3).'</td>
			<td >'. $row['deposit_status'].'</td>
			<!--<td style="color:#06C;">'. $row['day_counter'].'</td>
			<td style="color:#06C;">In '.$exp.' Day</td>-->
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['total_paid'].'</td>
			<td >'. $row['date_created'].'</td>
			<td>
			<input type="checkbox" id="intrest2" class="form-control" name="intrest2" value="'.$row['transaction_id'].'" >

			<input id="transactionid" type="hidden" name="'.$row['intrest_growth'].'" value="'.$row['intrest_growth'].'" >
			
			</td>
	</tr> 
	'.$out_capital.'
	';
                $i++;
            }

        }else{
            echo '<td colspan="11">No Records Found!</td>';
        }
        echo '
						  <button type="submit" name="sub" style="display:none;"></button>
						        </form>
						  </tbody>
				</table>
						  ';
        return $this;
    }

    public function PaymentHistory($email){
        $sql = "SELECT * FROM $this->withdraw_tb WHERE email = '".$email."' and `status`='paid' ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
          <div class="table-responsive">
            <table id="myTable" class="table table-striped">
			<thead>
				<tr style="color:#000;" class="shad">
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Paid Amount($)</th>
						<th >Status</th>
						<th >Type</th>
						<th >Plan</th>
						<th >Deposit Type</th>
					   <th >Date Created.</th>
				</tr>
					</thead>
					<tbody>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['status']=='paid'){
                    $color = '#006600';
                }else{ $color = '#333';}
                echo
                    '<tr style="color:'.$color.'">
			<td >'. $i.'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td style="color:#06C;">'. $row['amount'].'</td>
			<td style="color:#009900;">'.$row['status'].'...</td>
			<td >'.$row['type'].'</td>
			<td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td >'. $row['date_time'].'</td>
	</tr>';
                $i++;
            } }else{
            echo '<td colspan="6">No Record Found!</td>';
        }
        echo '
						  </tbody>
						</table>
				</div>';
        return $this;
    }


    public function GetWithdrawal($email){
        $sql = "SELECT * FROM $this->withdraw_tb WHERE email = '".$email."'  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['status']=='paid'){
                    $color = '#006600';
                }else{ $color = '#333';}
                echo
                    '<tr >
			<td style="font-size:11px;">'. $row['transaction_id'] .'</td>
			<td style="color:#06C;">$'. $row['amount'].'</td>
			<td style="color:#009900;">'.$row['status'].'...</td>
			<td style="font-size:11px;">'.$row['type'].'</td>
			<td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td style="font-size:11px;">'. $row['date_time'].'</td>
	</tr>';
                $i++;
            } }else{
            echo '<td colspan="6">No Record Found!</td>';
        }
        return $this;
    }

    public function SelectMyReferral($email){
        $sql = "SELECT * FROM $this->user_tb WHERE referral_username = '".$email."' ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
          <div class="table-responsive">
            <table id="myTable" class="table table-striped">
			<thead>
						<tr style="color:#000;" class="shad">
						<th >S/N</th>
						<th >Name</th>
						<th >UserName</th>
						<th >Country</th>
						<th >Date Reg.</th>
						</tr>
			</thead>
			<tbody>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '
		<tr>
			<td >'. $i.'</td>
			<td >'.$row['first_name'].' '.$row['first_name'].'</td>
			<td >'.$row['client_username'].'</td>
			<td >'. $row['country'].'</td>
			<td >'. $row['date_reg'].'</td>
			</tr>
			';
                $i++;
            }

        }else{
            echo '<td colspan="5">No Wallet Detail Found!</td>';
        }
        echo '
						  </tbody>
						</table>
					</div>
						  ';
        return $this;
    }


    public function GetReferral($email){
        $sql = "SELECT * FROM $this->user_tb WHERE referral_username = '".$email."' ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '
		<tr>
			<td >'.$row['first_name'].' '.$row['first_name'].'</td>
			<td >'.$row['client_username'].'</td>
			<td >'. $row['email'].'</td>
			<td >'. $row['date_reg'].'</td>
			</tr>
			';
                $i++;
            }

        }else{
            echo '<td colspan="4">No Wallet Detail Found!</td>';
        }
        return $this;
    }


    public function createReferralWithdrawal($email){
        $sql = "SELECT * FROM $this->referral_tb WHERE referral_email = '".$email."' and `coin_type`='BTC'  and (`status`='confirmed' || `status`='pending') and `balance` != 0 ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
		<table class="table" style="font-size:11px;"
			<thead>
				<tr style="color:#fff;" class="shad">
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Bonus($)</th>
						<th >Balance($)</th>
						<th >Username</th>
						<th >Status</th>
						<th>Category</th>
						<th>Plan</th>
						<th>Coin Type</th>
						<th >Date Created.</th>
						<th >Request</th>
					</tr>
			</thead>
					<tbody>
					<form method="post" enctype="multipart/form-data" action="" id="formInt" >
					';
        $i =1; $sum=0;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['status']=='pending'){
                    $checkboxx = '<input type="checkbox" id="none" class="form-control" name="non" value="" >';
                }else if($row['status']=='confirmed'){
                    $checkboxx = '<input type="checkbox" id="intrestREF" class="form-control" name="intrestREF" value="'.$row['transaction_id'].'" >';
                }
                echo '
		<tr>
			<td >'. $i.'</td>
			<td >'.$row['transaction_id'].'</td>
			<td style="color:#06C;">'. $row['amount'].'</td>
			<td style="color:#06C;">'. $row['balance'].'</td>
			<td >'. self::selectFrmDB($this->user_tb,'client_username','email',$row['referred_email']).'</td>
			<td >'. $row['status'].'</td>
			<td >'. $row['deposit_category'].'</td>
			<td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td >'. $row['date_created'].'</td>
			<td>
			'.$checkboxx.'
			</td>
	</tr> ';
                $i++;
            }

        }else{
            echo '<td colspan="11">No Records Found!</td>';
        }
        echo '
						  <button type="submit" name="sub" style="display:none;"></button>
						        </form>
						  </tbody>
				</table>
			
						  ';
        return $this;
    }


    public function createReferralWithdrawalETH($email){
        $sql = "SELECT * FROM $this->referral_tb WHERE referral_email = '".$email."' and `coin_type`='perfectmoney'  and (`status`='confirmed' || `status`='pending') and `balance` != 0 ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
		<table class="table" style="font-size:11px;">
			<thead>
				<tr style="color:#fff;" class="shad">
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Bonus($)</th>
						<th >Balance($)</th>
						<th >Username</th>
						<th >Status</th>
						<th>Category</th>
						<th>Plan</th>
						<th>Coin Type</th>
						<th >Date Created.</th>
						<th >Request</th>
					</tr>
			</thead>
					<tbody>
					<form method="post" enctype="multipart/form-data" action="" id="formInt" >
					';
        $i =1; $sum=0;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['status']=='pending'){
                    $checkboxx = '<input type="checkbox" id="none2" class="form-control" name="non2" value="" >';
                }else if($row['status']=='confirmed'){
                    $checkboxx = '<input type="checkbox" id="intrestREF2" class="form-control" name="intrestREF2" value="'.$row['transaction_id'].'" >';
                }
                echo '
		<tr>
			<td >'. $i.'</td>
			<td >'.$row['transaction_id'].'</td>
			<td style="color:#06C;">'. $row['amount'].'</td>
			<td style="color:#06C;">'. $row['balance'].'</td>
			<td >'.self::selectFrmDB($this->user_tb,'client_username','email',$row['referred_email']).'</td>
			<td >'. $row['status'].'</td>
			<td >'. $row['deposit_category'].'</td>
			<td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td >'. $row['date_created'].'</td>
			<td>
			'.$checkboxx.'
			</td>
	</tr> ';
                $i++;
            }

        }else{
            echo '<td colspan="11">No Records Found!</td>';
        }
        echo '
						  <button type="submit" name="sub" style="display:none;"></button>
						        </form>
						  </tbody>
				</table>
						  ';
        return $this;
    }


    public function createReferralWithdrawalETHME($email){
        $sql = "SELECT * FROM $this->referral_tb WHERE referral_email = '".$email."' and `coin_type`='ETH'  and (`status`='confirmed' || `status`='pending') and `balance` != 0 ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
		<table class="table" style="font-size:11px;">
			<thead>
				<tr style="color:#fff;" class="shad">
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Bonus($)</th>
						<th >Balance($)</th>
						<th >Username</th>
						<th >Status</th>
						<th>Category</th>
						<th>Plan</th>
						<th>Coin Type</th>
						<th >Date Created.</th>
						<th >Request</th>
					</tr>
			</thead>
					<tbody>
					<form method="post" enctype="multipart/form-data" action="" id="formInt" >
					';
        $i =1; $sum=0;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['status']=='pending'){
                    $checkboxx = '<input type="checkbox" id="none2" class="form-control" name="non2" value="" >';
                }else if($row['status']=='confirmed'){
                    $checkboxx = '<input type="checkbox" id="intrestREF2" class="form-control" name="intrestREF2" value="'.$row['transaction_id'].'" >';
                }
                echo '
		<tr>
			<td >'. $i.'</td>
			<td >'.$row['transaction_id'].'</td>
			<td style="color:#06C;">'. $row['amount'].'</td>
			<td style="color:#06C;">'. $row['balance'].'</td>
			<td >'.self::selectFrmDB($this->user_tb,'client_username','email',$row['referred_email']).'</td>
			<td >'. $row['status'].'</td>
			<td >'. $row['deposit_category'].'</td>
			<td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td >'. $row['date_created'].'</td>
			<td>
			'.$checkboxx.'
			</td>
	</tr> ';
                $i++;
            }

        }else{
            echo '<td colspan="11">No Records Found!</td>';
        }
        echo '
						  <button type="submit" name="sub" style="display:none;"></button>
						        </form>
						  </tbody>
				</table>
						  ';
        return $this;
    }


    public function ticketTitle($email){
        $sql = "SELECT * FROM $this->tickect_tb WHERE `reporter_email`='".$email."'  and `category`='main' ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '
                                    	
                                            <li style="border-bottom: 1px dotted #EBD9D9">
											<a href="support-team?ticket='.$row['ticket_id'].'&id='.$row['id'].'"><u>'.$row['ticket_title'].'</u></a>
											<small class="text-success pull-right">'.$row['report_time'].'</small></td>
                                           </li>
                    
	';
            }}
    }


    public function ticketMsg($ticket_id,$name,$email){
        $sql = "SELECT * FROM $this->tickect_tb WHERE  `ticket_id`='".$ticket_id."' ORDER BY id ASC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['replier']=='support'){
                    $msg = '
					<li>
                       <div class="chat-image"> <img alt="male" src="../img/avatar-ad.png"> </div>
                         <div class="chat-body">
                            <div class="chat-text"> 
							 <h4><span class="text-primary">Name: '.$row['replier_name'].' (support)</span></h4>
							 	<p>'.$row['replier_message'].' </p>
								<b class="text-success">'.$row['replied_time'].'</b>
						</div>
                      </div>
                    </li>
					';
                }else{
                    $msg = '
						 <li class="odd">
                            <div class="chat-image"> <img alt="Female" src="../img/avatar-u.png"> </div>
                              <div class="chat-body">
                                <div class="chat-text"> 
						 		  <h4><span class="text-primary">Name: '.$name.'</span></h4>
							       <p>'.$row['reporter_message'].'</p>
								   <b class="text-success">'.$row['report_time'].'</b>
								</div>
                             </div>
                          </li>
						';
                }
                echo $msg;
            }}
    }
    public function SelectAlladmin(){
        $sql = "SELECT * FROM $this->admin_tb WHERE email!='codex@admin.com' ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="tableclass table-responsive table-bordered table-striped table-condensed" style="font-size:11px;"  width="100%">
						<tr>
						<td >S/N</td>
						<td>Admin Name</td>
						<td >Email</td>
						<td >Password</td>
						<td >Role</td>
						<td >Date Reg.</td>
						<td >Blocked Status</td>
						<td >Block</td>
						<td >Update</td>
						<td >Delete</td>
						</tr>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['blocked_account']=='1'){
                    $lock = '<i style="background-color: !important;" class="btn btn-default fa fa-lock"></i>';
                }else{
                    $lock = '<a data-toggle="modal" href="#myModa'.$row['id'].'"><i style="background-color:#EC6 !important;" class="btn btn-default fa fa-unlock"></i></a>';
                }
                echo '<tr>
			<td >'. $i.'</td>
			<td >'. $row['name'] .'</td>
			<td >'. $row['email'].'</td>
			<td >'. $row['password'].'</td>
			<td >'. $row['role'].'</td>
			<td >'. $row['day_reg'].'</td>
			<td >'. $row['blocked_account'].'</td>
			<td align="center">'.$lock.'</td>
			<td ><a href="edit-admin?id='.$row['id'].'"><i class="btn btn-default fa fa-edit"></i></a></td>
			<td ><a data-toggle="modal" href="#myModal'.$row['id'].'"><i class="btn btn-default fa fa-trash-o"></i></a></td>
			
			                  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Delete User ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to delete this user</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="admin-acount?delete='.$row['id'].'">
								  <span class="btn btn-theme">Delete</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
				  
				  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModa'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Block Admin ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to block this admin</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="admin-acount?block='.$row['id'].'">
								  <span class="btn btn-theme">Block</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			
			</tr>';
                $i++;
            }

        }
        echo '</table>';
        return $this;
    }


    public function InvestmentHistory($email){
        $sql = "SELECT * FROM $this->deposit_tb WHERE `email`='".$email."' ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
	    <div class="table-responsive">
           <table id="myTable" class="table table-striped">
			<thead>
				<tr>
						<th >S/N</th>
						<th >Transaction ID</th>
						<th >Amount</th>
						<th >Interest($)</th>
						<th >Status</th>
						<th >Day On</th>
						<th >Type</th>
      <th>Plan</th>
						<th >Request($)</th>
						<th >Date Reg.</th>
						<th >Blochchain Status</th>
				</tr>
			</thead>
			<tbody>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                echo '

	    <tr>
			<td >'. $i.'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td >'.$row['coin_value'].''.$row['coin_type'].' ($'.$row['amount'].')</td>
			<td style="color:#06C;">'.   self::round_out($row['intrest_growth'],4).'</td>
		    <td >'. $row['deposit_status'].'</td>
			<td style="color:#06C;">'. $row['day_counter'].'</td>
			<td style="color:#06C;">'.$row['coin_type'].'</td>
                        <td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['total_paid'].'</td>
			<td >'. $row['date_created'].'</td>
			<td ><a class="btn btn-success" href="'.$row['status_url'].'">View</a></td>
			</tr>
		';
                $i++;
            }

        }else{
            echo '<td colspan="8">No Record Found!</td>';
        }
        echo '
		</tbody>
	</table>
</div>
';
        return $this;
    }


    public function SelectDeposit($start,$end){
        $sql = "SELECT * FROM $this->deposit_tb ORDER BY id DESC LIMIT $start, $end ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="tableclass table-responsive table-bordered table-striped table-condensed" style="font-size:11px; color:#06C;"  width="100%">
						<tr style="color:#000;">
						<td >#</td>
						<td >S/N</td>
						<td >Transaction ID</td>
						<td >Email</td>
						<td >Deposit Amount($)</td>
						<!--<td >Interest($)</td>-->
						<!--<td >Description</td>-->
						<td >Status</td>
						<!--<td >Third party Status</td>
						<td >Category</td>-->
						<td >Day On</td>
                        <!--<td >Plan</td>-->
			            <td >Coin Type</td>
						<td >Date Reg.</td>
						<td >Confirm/Unconfirm</td>
						<td >End/Open</td>
						<td >Edit</td>
						<td >Remove</td>
						</tr>';
        $i =1;
        if($stmt ){//
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                if($row['deposit_status']=='confirmed'){
                    $state = '<a data-toggle="modal" href="#myModuUN'.$row['id'].'" title="Unconfirm Wallet"><i class="btn btn-default fa fa-unlock"></i></a>';
                    $ends = '<a data-toggle="modal" href="#myModull'.$row['id'].'" title="End Transaction"><i class="btn btn-default fa fa-trash-o"></i></a>';
                }else if($row['deposit_status']=='pending'){
                    $state = '<a data-toggle="modal" href="#myModu'.$row['id'].'" title="Confirm Wallet"><i class="btn btn-default fa fa-lock"></i></a>';
                    $ends = '<a data-toggle="modal" href="#myModull'.$row['id'].'" title="End Transaction"><i class="btn btn-default fa fa-trash-o"></i></a>';
                }else if($row['deposit_status']=='done'){
                    $state = '<a data-toggle="modal" href="#myModuUN'.$row['id'].'" title="Unconfirm Wallet"><i class="btn btn-default fa fa-unlock"></i></a>';
                    $ends = '<a data-toggle="modal" href="#myModullOP'.$row['id'].'" title="Open Transaction"><i class="btn btn-default fa fa-chain"></i></a>';
                }else{
                    $state = '<a data-toggle="modal" href="#myModu'.$row['id'].'" title="Confirm Wallet"><i class="btn btn-default fa fa-unlock"></i></a>';
                    $ends = '<a data-toggle="modal" href="#myModull'.$row['id'].'" title="End Transaction"><i class="btn btn-default fa fa-trash-o"></i></a>';
                }
                if($row['deposit_status']=='confirmed'){
                    $color = '#006600';
                }else{ $color = '';}

                if($row['received_status']=='Payment Confirmed'){
                    $colsa = '#00CC00';
                }else{$colsa = '';}
                echo '<tr style="color:'.$color.'">
			 <td >
			 <div class="checkbox checkbox-primary">
				  <label><input id="child" type="checkbox" name="moveP" value="'.$row['id'].'">
					<i></i></label>
				</div>
			</td>
			<td >'. $i.'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td >'. $row['email'] .'</td>
			<td >'. $row['amount'].'</td>
			<!--<td style="color:#06C;">'.self::round_out($row['intrest_growth'],4).'</td>-->
			<!--<td >'. $row['description'].'</td>-->
			<td >'. $row['deposit_status'].'<a target="_blank" style="color:red;" href="'.$row['status_url'].'">(check)</a></td>
			<!--<td style="color:'.$colsa.'" >'.$row['received_status'].'</td>
			<td >'. $row['deposit_category'].'</td>-->
			<td style="color:#06C;">'. $row['day_counter'].'</td>
            <!--<td style="color:#06C;">'. $row['plan_type'].'</td>-->
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			
			<td >'. $row['date_created'].'</td>
			<td align="center">'.$state.'</td>
			<td>'.$ends.'</td>
			<td><a href="edit-wallet?id='.$row['id'].'"> <i class="btn btn-default fa fa-edit"></i></a></td>
			<td><a data-toggle="modal" href="#myModullDEL'.$row['id'].'" title="End Transaction"><i class="btn btn-default fa fa-trash-o"></i></a></td>
			
			
			
			<!-- Modal -->
			 <div class="modal fade" id="AlldelPACKSTDATA" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 align="center" class="modal-title">Confrim all <span class="text-success">selected</span> transaction</h4>
                          </div>
                          <div class="modal-body">
                              <h4>Are you sure you want to confirm this transaction</h4>
                          </div>
                          <div class="modal-footer">
						  <!--onClick="confrimTRN();"-->
                              <button data-dismiss="modal" onClick="confrimTRN();" id="pushUPT" type="button" class="btn btn-lg btn-info m-b-5" >Confrim</button>
                              <button type="button" class="btn btn-lg btn-default m-b-5" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                  </div>
              </div>
		 <!-- modal -->
		 
		 
			
				                  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModullDEL'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Delete User ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to delete this user</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="wallet?del='.$row['id'].'">
								  <span class="btn btn-theme">Delete</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			
			<!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModu'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Confirm Users Deposit ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to confirm this user? (This mean you have check your bitcoin wallet and confirmed that the deposit the user claim to have made is true.)</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="wallet?confirm-deposit='.$row['id'].'">
								  <span class="btn btn-theme">Confirm</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
				  
				  		<!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModuUN'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Unconfirm Users Deposit ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to Unconfirm this user? (This mean you have mistakely confirmed this user in the past and found that you have not received the payment he claims to have made.)</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="wallet?unconfirm-deposit='.$row['id'].'">
								  <span class="btn btn-theme">Unconfirm</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
				  
				  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModull'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Terminate Transaction ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to end this transaction?  (This mean you have completely paid this user all interest due and wish to end the transaction for this deposit. By so doing the user will not see this wallet from their end.)</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="wallet?confirm-terminate='.$row['id'].'">
								  <span class="btn btn-theme">End</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
				  
				   <!-- Modal fa-chain-->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModullOP'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Open Transaction ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to open this transaction?  (This mean you have mistakely end the transaction with out if fully maturing.)</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="wallet?open-terminate='.$row['id'].'">
								  <span class="btn btn-theme">Open</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			</tr>';
                $i++;
            }

        }else{
            echo '<td colspan="11">No Detail Found!</td>';
        }
        echo '</table>';
        return $this;
    }

    public function payOutBTC($start,$end){
        $sql = "SELECT * FROM $this->withdraw_tb WHERE  (`status`='processing' || `status`='paid') and `remove`='no' ORDER BY id DESC LIMIT $start, $end ";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="tableclass table-responsive table-bordered table-striped table-condensed" style="font-size:11px; color:#06C;"  width="100%">
						<tr style="color:#000;">
						<td >#</td>
						<td >S/N</td>
						<td >Transaction ID</td>
						<td >Email</td>

						<td >Amount($)</td>
						<td >Status</td>
						<td >Type</td>
						<td >Plan Type</td>
			            <td >Coin Type</td>
						<td >Date Created</td>
						<!--<td >Make Payment</td>-->
						<td >Comfirm Payment</td>
						<td >Remove</td>
						</tr>
						
						';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                if($row['coin_type']=='perfectmoney'){
                    $payT = '<td colspan="13" >User Perfect Money Account <input style="font-size:20px;" type="text" value="'.self::selectFrmDB($this->user_tb,'perfectmoney','email',$row['email']).'" class="form-control" id="f-name" name="perfectmoney" placeholder=" "></td>';
                }else if($row['coin_type']=='BTC'){
                    $payT = '<td colspan="13" >User Wallet Address <input style="font-size:20px;" type="text" value="'.self::selectFrmDB($this->user_tb,'wallet_address','email',$row['email']).'" class="form-control" id="f-name" name="wallet" placeholder=" "></td>';
                }else if($row['coin_type']=='ETH'){
                    $payT = '<td colspan="13" >User Wallet Address <input style="font-size:20px;" type="text" value="'.self::selectFrmDB($this->user_tb,'ethereum_wallet_address','email',$row['email']).'" class="form-control" id="f-name" name="wallet" placeholder=" "></td>';
                }else if($row['coin_type']=='BNB'){
                    $payT = '<td colspan="13" >User Wallet Address <input style="font-size:20px;" type="text" value="'.self::selectFrmDB($this->user_tb,'bnb','email',$row['email']).'" class="form-control" id="f-name" name="wallet" placeholder=" "></td>';
                }else if($row['coin_type']=='USDT'){
                    $payT = '<td colspan="13" >User Wallet Address <input style="font-size:20px;" type="text" value="'.self::selectFrmDB($this->user_tb,'usdt','email',$row['email']).'" class="form-control" id="f-name" name="wallet" placeholder=" "></td>';
                }else{
                    $payT = '<td colspan="13" >User Wallet Address <input style="font-size:20px;" type="text" value="'.self::selectFrmDB($this->user_tb,'wallet_address','email',$row['email']).'" class="form-control" id="f-name" name="wallet" placeholder=" "></td>';
                }

                if($row['status']=='paid'){
                    $paida = '<i title="Payment Confirmed" style="color:green; background-color:yellow;" class="btn btn-default fa fa-check-circle-o"></i>';
                }else if($row['status']=='processing'){
                    $paida = '<a data-toggle="modal" href="#myModuaa'.$row['id'].'"><i class="btn btn-default fa fa-check-square"></i></a>';
                }else{
                    $paida = '<a data-toggle="modal" href="#myModuaa'.$row['id'].'"><i class="btn btn-default fa fa-check-square"></i></a>';
                }
                if($row['status']=='paid'){
                    $color = '#006600';
                    $pay = '<i class="btn btn-success">Paid</i>';
                }else if($row['coin_type']=='perfectmoney'){ $color = '';
                    $pay = '<span class="btn">Pay</span>';
                }else{
                    $color = '';
                    $pay = '<a class="btn btn-default" href="create-withdrawal?ref='. $row['id'].'">Pay</a>';
                }



                echo '<tr style="color:'.$color.'">
			<td >
			 <div class="checkbox checkbox-primary">
				  <label><input id="child" type="checkbox" name="movePP" value="'.$row['id'].'">
					<i></i></label>
				</div>
			</td>
			<td >'.($i+$start).'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td >'. $row['email'] .'</td>
			<td >'. $row['amount'].'</td>
			<td style="color:#009900;">'.$row['status'].'...</td>
			<td >'.$row['type'].'</td>
			<td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td >'. $row['date_time'].'</td>
			<!--<td >'.$pay.'</td>-->
			<td>'.$paida.'</td>
			<td><a data-toggle="modal" href="#myModuRR'.$row['id'].'"><i class="btn btn-default fa fa-trash-o"></i></a></td>
			
			
			<!-- Modal -->
			 <div class="modal fade" id="AlldelPACKSTDATA333" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 align="center" class="modal-title">Confrim all <span class="text-success">selected</span> transaction</h4>
                          </div>
                          <div class="modal-body">
                              <h4>Are you sure you want to confirm this payments</h4>
                          </div>
                          <div class="modal-footer">
						  <!--onClick="markPaid();"-->
                              <button data-dismiss="modal" onClick="markPaid();" id="pushUPT" type="button" class="btn btn-lg btn-info m-b-5" >Mark Paid</button>
                              <button type="button" class="btn btn-lg btn-default m-b-5" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                  </div>
              </div>
		 <!-- modal -->
			
			
			<!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModuRR'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Remove this paid record ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you waant to remove this payment record from this list? </p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="pay-bitcoin?remove-paid='.$row['id'].'">
								  <span class="btn btn-theme">Remove</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			
			
			
							
							  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModuaa'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">User has been paid ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you have paid user?  (By confirming this action it mean you have complete payment to this user that request to be paid. This user will see it on it end that you have consent to have made payment to his wallet on the said amount.)</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="pay-bitcoin?confirm-paid='.$row['id'].'">
								  <span class="btn btn-theme">Paid</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			</tr>
			<tr>
						<!--<td colspan="13" >User Wallet Address <input style="font-size:20px;" type="text" value="'.self::selectFrmDB($this->user_tb,'wallet_address','email',$row['email']).'" class="form-control" id="f-name" name="wallet" placeholder=" "></td>-->
						'.$payT.'
						</tr>
			';
                $i++;
            }

        }else{
            echo '<td colspan="11">No Wallet Detail Found!</td>';
        }
        echo '</table>';
        return $this;
    }



    public function DepositHistory(){
        $sql = "SELECT * FROM $this->deposit_tb ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="tableclass table-responsive table-bordered table-striped table-condensed" style="font-size:11px; color:#06C;"  width="100%">
						<tr style="color:#000;">
						<td >S/N</td>
						<td >Transaction ID</td>
						<td >Email</td>
						<td >Amount($)</td>
						<td >Interest Growth($)</td>
						<td >Description</td>
						<td >Status</td>
						<td >Category</td>
						<td >Day On</td>
                                                <td >Plan</td>
			                        <td >Type</td>
						<td >Date Created.</td>
						</tr>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                echo '<tr>
			<td >'. $i.'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td >'. $row['email'] .'</td>
			<td >'. $row['amount'].'</td>
			<td style="color:#06C;">'.self::round_out($row['intrest_growth'],4).'</td>
			<td >'. $row['description'].'</td>
			<td >'. $row['deposit_status'].'</td>
			<td >'. $row['deposit_category'].'</td>
			<td style="color:#06C;">'. $row['day_counter'].'</td>
                        <td style="color:#06C;">'. $row['plan_type'].'</td>
			<td style="color:#06C;">'. $row['coin_type'].'</td>
			<td >'. $row['date_created'].'</td>
			</tr>';
                $i++;
            }

        }else{
            echo '<td colspan="11">No Wallet Detail Found!</td>';
        }
        echo '</table>';
        return $this;
    }


    public function payment_History(){
        $sql = "SELECT * FROM $this->withdraw_tb WHERE `status`='paid' ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="tableclass table-responsive table-bordered table-striped table-condensed" style="font-size:11px; color:#06C;"  width="100%">
						<tr style="color:#000;">
						<td >S/N</td>
						<td >Transaction ID</td>
						<td >Email</td>
						<td >Amount($)</td>
						<td >Status</td>
						<td >Type</td>
						<td >Date Created.</td>
						</tr>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['status']=='paid'){
                    $color = '#006600';
                }else{ $color = '';}
                echo '<tr style="color:'.$color.'">
			<td >'. $i.'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td >'. $row['email'] .'</td>
			<td >'. $row['amount'].'</td>
			<td style="color:#009900;">'.$row['status'].'...</td>
			<td >'.$row['type'].'</td>
			<td >'. $row['date_time'].'</td>
			</tr>';
                $i++;
            }

        }else{
            echo '<td colspan="11">No Wallet Detail Found!</td>';
        }
        echo '</table>';
        return $this;
    }


    public function getALLemails(){
        $sql = "SELECT * FROM $this->user_tb  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '<textarea style="height:100px;" class="form-control">';
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo $row['email'].', ';
            }
        }
        echo '</textarea>';
    }


    public function SelectAlluser(){
        $sql = "SELECT * FROM $this->user_tb ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="tableclass table-responsive table-bordered table-striped table-condensed" style="font-size:11px;"  width="100%">
						<tr>
						<td >S/N</td>
						<td>Name</td>
						<td >Email</td>
						<!--<td >Country</td>-->
						<td>Status</td>
                        <td >Activation</td>
						<td >Referral Username</td>
						<!--<td>Account Type</td>-->
						<!--<td style="color:green;">ADD BONUS</td>-->
						<td >Date Reg.</td>
						<td >Block</td>
						<td >Edit</td>
						<td >Remove</td>
						</tr>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['blocked_account']=='0'){
                    $blocker = '<a data-toggle="modal" href="#myModalR'.$row['id'].'"><i class="btn btn-default fa fa-unlock"></i></a>';
                }else{
                    $blocker = '<a data-toggle="modal" href="#myModal1'.$row['id'].'"><i class="btn btn-default fa fa-lock"></i></a>';
                }

                if($row['email_activation']=='yes'){
                    $activation = 'YES';
                }else{
                    $activation = '<a target="_blank" href ="https://signalearners.com/ActivateMail/activate.php?id='.$row['email'].'&ip='.$row['password'].'">Activate</a>';
                }

                echo '<tr>
			<td >'. $i.'</td>
			<td >'. $row['first_name'] .'</td>
			<td >'. $row['email'] .'</td>
			<!--<td >'. $row['country'] .'</td>-->
			<td >'. $row['blocked_account'].'</td>
   <td >'.$activation.'</td>
			<td >'. $row['referral_username'].'</td>
			<!--<td >'. $row['account_type'].'</td>-->
			<!--<td style="color:green;"><a href="add-bonus?id='.$row['email'].'">
			<i class="btn btn-success btn-small fa fa-pencil"> Add</i></a></td>-->
			<td >'. $row['date_reg'].'</td>
			<td >'.$blocker.'</td>
			<td ><a href="user-profile?id-ter='.$row['email'].'"><i class="btn btn-default fa fa-edit"></i></a></td>
			<td><a data-toggle="modal" href="#myModullDEL'.$row['id'].'" title="Remove"><i class="btn btn-default fa fa-trash-o"></i></a></td>
			
			
				                  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModullDEL'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Delete User ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to delete this user</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="all-users?del='.$row['id'].'">
								  <span class="btn btn-theme">Delete</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			
			                  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalR'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Block User ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to block this user</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="all-users?block='.$row['id'].'">
								  <span class="btn btn-theme">Block</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
				  
				  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal1'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Unblock User ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to unblock this user</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="all-users?unblock='.$row['id'].'">
								  <span class="btn btn-theme">Unblock</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			
			</tr>';
                $i++;
            }

        }
        echo '</table>';
        return $this;
    }


    public function SelectAlltrader(){
        $sql = "SELECT * FROM $this->user_tb ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="tableclass table-responsive table-bordered table-striped table-condensed" style="font-size:11px;"  width="100%">
						<tr>
						<td >S/N</td>
						<td>Name</td>
						<td >Email</td>
						<td >Country</td>
						<td>Status</td>
						<td >Referral Username</td>
						<td>Account Type</td>
						<td>TaxID</td>
						<td>Utility</td>
						<td>ID Card</td>
						<td>Kin</td>
						<td >Date Reg.</td>
						<td >Block</td>
						<td >Edit</td>
						</tr>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['blocked_account']=='0'){
                    $blocker = '<a data-toggle="modal" href="#myModalR'.$row['id'].'"><i class="btn btn-default fa fa-unlock"></i></a>';
                }else{
                    $blocker = '<a data-toggle="modal" href="#myModal1'.$row['id'].'"><i class="btn btn-default fa fa-lock"></i></a>';
                }
                echo '<tr>
			<td >'. $i.'</td>
			<td >'. $row['first_name'] .'</td>
			<td >'. $row['email'] .'</td>
			<td >'. $row['country'] .'</td>
			<td >'. $row['blocked_account'].'</td>
			<td >'. $row['referral_username'].'</td>
			<td >'. $row['account_type'].'</td>
			<td >'. $row['tax_id'].'</td>
			<td ><img src="../../utilitybill/'. $row['utility_bill'].'" width="40" height="40" /></td>
			<td ><img src="../../govid/'. $row['gov_issued_id'].'" width="40" height="40" /></td>
			<td >'. $row['next_of_kin'].'</td>
			<td >'. $row['date_reg'].'</td>
			<td >'.$blocker.'</td>
			<td ><a href="user-profile?id-ter='.$row['email'].'"><i class="btn btn-default fa fa-edit"></i></a></td>
			
			                  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalR'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Block User ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to block this user</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="all-users?block='.$row['id'].'">
								  <span class="btn btn-theme">Block</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
				  
				  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal1'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Unblock User ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to unblock this user</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="all-users?unblock='.$row['id'].'">
								  <span class="btn btn-theme">Unblock</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
			
			</tr>';
                $i++;
            }

        }
        echo '</table>';
        return $this;
    }



    public function newsPost(){
        $sql = "SELECT * FROM $this->news ORDER BY id DESC LIMIT 20";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<div class="act-time">                                      
									  <div class="activity-body act-in">
										  <div class="text">
										    <h5 style="text-transform:uppercase"><span>'.$row['title'].'</span></h5>
											  <p class="attribution"><a href="#">'.$row['admin_name'].'</a> at '.$row['date_post'].'</p>
											  <p>'.$row['news'].'</p>
										  </div>
									  </div>
								  </div>';
            }}
    }


    public function allNews(){
        ///second
        $sql = "SELECT * FROM $this->news  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '  <table style="font-size:10px;" width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            		<thead>
                                          <tr class="odd gradeX">
                                            <th>ID </th>
                                            <th>Title</th>
                                            <th>Message</th>
											<th>By</th>
                                            <th>Date</th>
											<th>Status</th>
											<th>Top</th>
											<th>Less</th>
											<th>Edit</th>
											<th>Remove</th>
                                         </tr>
                                    </thead> ';

        if($stmt ){
            $i=1;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<tbody>
                                          <tr class="odd gradeX">
                                            <th>'.$i.'</th>
                                            <th>'.self::reduceTextLength($row['title'],40).'</th>
                                            <th>'.self::reduceTextLength($row['news'],40).'</th>
											<th>'.$row['admin_name'].'</th>
                                            <th>'.$row['date_post'].'</th>
											<th>'.$row['top_massage'].'</th>
											<th><a href="new-view?top='.$row['id'].'"><i class="btn btn-default fa fa-arrow-up"></i></a></th>
											<th><a href="new-view?less='.$row['id'].'"><i class="btn btn-default fa fa-arrow-down"></i></a></th>
											<th><a href="edit-news?id='.$row['id'].'"><i class="btn btn-default fa fa-edit"></i></a></th>
											<td ><a data-toggle="modal" href="#myModalWWW'.$row['id'].'"><i class="btn btn-default fa fa-trash-o"></i></a></td>
			
			                  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalWWW'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Delete News ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to delete this news</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="new-view?delete='.$row['id'].'">
								  <span class="btn btn-theme">Delete</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
                                         </tr>
                                    </tbody>';
                $i++;
            }
        }
        echo '</table>';
    }



public function allCourse(){
        ///second
        $sql = "SELECT * FROM $this->course_tb  ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '  <table style="font-size:10px;" width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
									<tr class="odd gradeX">
											<th>ID </th>
											<th>Title</th>
											<th>Description</th>
											<th>Category</th>
											<th>Link</th>
           <th>Date</th>
											<th>Edit</th>
											<th>Remove</th>
										</tr>
					</thead> ';
        if($stmt ){
            $i=1;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '<tbody>
									<tr class="odd gradeX">
											<th>'.$i.'</th>
											<th>'.self::reduceTextLength($row['title'],40).'</th>
											<th>'.self::reduceTextLength($row['description'],40).'</th>
											<th>'.$row['course_cat'].'</th>
											<th><a href="'.$row['download_link'].'">Visit Link</a></th>
           <th>'.$row['date_add'].'</th>
											<th><a href="edit-course?id='.$row['id'].'"><i class="btn btn-default fa fa-edit"></i></a></th>
											<td ><a data-toggle="modal" href="#myModalWWW'.$row['id'].'"><i class="btn btn-default fa fa-trash-o"></i></a></td>
			
			                  <!-- Modal -->
		    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalWWW'.$row['id'].'" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Delete News ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Are you sure you want to delete this news</p>
		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <a href="course-view?delete='.$row['id'].'">
								  <span class="btn btn-theme">Delete</span>
								  </a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
                                         </tr>
                                    </tbody>';
                $i++;
            }
        }
        echo '</table>';
    }


    public function SelectReferralAdmin(){
        $sql = "SELECT * FROM $this->referral_tb ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        echo '
			<table class="tableclass table-responsive table-bordered table-striped table-condensed" style="font-size:11px; color:#06C;"  width="100%">
						<tr style="color:#000;">
						<td >S/N</td>
						<td >Transaction ID</td>
						<td >Referral Email</td>
						<td >Refered Email</td>
						<td >Amount($)</td>
						<td >CashedOut($)</td>
						<td >Balance($)</td>
						<td >Status</td>
						<td >Category</td>
						<td >Date Reg.</td>
	
						</tr>';
        $i =1;
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['balance']==0){
                    $casout = $row['amount'];
                    $color = '#00CC00';
                    /*  $taken = '<span style="margin-bottom:3px; margin-top:3px; padding:5px;" class="btn btn-success">Cash Out Completed</span>';*/
                }else{
                    $casout = 0;
                    $color='';
                    /*  $taken = '<a href="referral?cash-out='.$row['id'].'"><span style="margin-bottom:3px; margin-top:3px; padding:5px;" class="btn btn-primary">Cash Out</span></a>';*/
                }
                echo '
		<tr style="color:'.$color.'">
			<td >'. $i.'</td>
			<td >'. $row['transaction_id'] .'</td>
			<td >'. $row['referral_email'] .'</td>
			<td >'. $row['referred_email'] .'</td>
			<td style="color:#06C;">'. $row['amount'].'</td>
			<td >'. $casout.'</td>
			<td >'. $row['balance'].'</td>
			<td >'. $row['status'].'</td>
			<td >'. $row['deposit_category'].'</td>
			<td >'. $row['date_created'].'</td>
	
			</tr>
			';
                $i++;
            }

        }else{
            echo '<td colspan="12">No Wallet Detail Found!</td>';
        }
        echo '
						  </table>
						  ';
        return $this;
    }

    public function ticketTitle2(){
        $sql = "SELECT * FROM $this->tickect_tb WHERE `category`='main' ORDER BY id DESC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo '
                                    	<tr>
                                            <td><a href="respond-ticket?ticket='.$row['ticket_id'].'&id='.$row['id'].'"><u>'.$row['ticket_title'].'</u></a>
											<br /><span style="float:right;">'.$row['report_time'].'</span></td>
                                        </tr>
                    
	';
            }}
    }


    public function ticketMsg2($ticket_id){

        $sql = "SELECT * FROM $this->tickect_tb WHERE `ticket_id`='".$ticket_id."' ORDER BY id ASC";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        if($stmt ){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['replier']=='support'){
                    $msg = '
					<textarea readonly  class="form-control" style="height:120px; background-color: #0FC; margin-top:5px; box-shadow:inset 0px 10px 5px 2px #F5F5F9;"  >By: '.$row['replier_name'].' (support)
'.$row['replier_message'].' 
@ '.$row['replied_time'].'
					</textarea>
					';
                }else{
                    $msg = '
						 <textarea readonly  class="form-control" style="height:120px; color:#06C; background-color: #FFF;  margin-top:5px; box-shadow:inset 0px 10px 5px 2px #F5F5F9;"  >Email: '.$row['reporter_email'].'
'.$row['reporter_message'].'
@ '.$row['report_time'].'
						 </textarea>
						';
                }
                echo $msg;
            }}
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

    public function round_out ($value, $places=0) {
        if ($places < 0) { $places = 0; }
        $mult = pow(10, $places);
        return ($value >= 0 ? ceil($value * $mult):floor($value * $mult)) / $mult;
    }

    public function reduceTextLength($content,$length){
        if(strlen($content) < $length){
            return $content;
        }else if(strlen($content) > $length){
            return substr($content, 0, $length).'...';
        }
    }

}
$select = new select();
?>