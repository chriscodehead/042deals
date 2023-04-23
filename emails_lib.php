<?php
class email
{
    protected $siteName = 'Signal Earners';
    protected $siteDomain = 'signalearners.com';

    public function generalBody($message){
        $d = date('Y');
        $content = '<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="x-apple-disable-message-reformatting"><title></title><link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css"><style> html,body {margin: 0 auto !important;padding: 0 !important;height: 100% !important;width: 100% !important;font-family: \'Roboto\', sans-serif !important;font-size: 14px;margin-bottom: 10px;line-height: 24px;color:#8094ae;font-weight: 400;} * { -ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;} table,td {mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;} table {border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;} table table table {table-layout: auto;} a {text-decoration: none;} img {-ms-interpolation-mode:bicubic;}</style></head>
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f5f6fa;">
	<center style="width: 100%; background-color: #f5f6fa;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f6fa">
            <tr>
               <td style="padding: 40px 0;">
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: center; padding-bottom:25px">
                                    <a href="https://'.$this->siteDomain.'/"><img style="height: 40px" src="https://'.$this->siteDomain.'/img/logo.png" alt="logo"></a>
                                    <p style="font-size: 14px; color: #6576ff; padding-top: 12px;">Refer, Share and Earn</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
                        <tbody>
                            <tr>
                                <td style="padding: 30px 30px 20px">
                                    <p style="margin-bottom: 15px; color: #526484; font-size: 16px;">'.$message.'</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: center; padding:25px 20px 0;">
                                    <p style="font-size: 13px;">Copyright © '.$d.' '.$this->siteName.'. All rights reserved.</p>
                                    <ul style="margin: 10px -4px 0;padding: 0;">
                                        <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="https://facebook.com/"><img style="width: 30px" src="https://'.$this->siteDomain.'/mail_images/brand-b.png" alt="brand"></a></li>
                                        <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="https://twitter.com/"><img style="width: 30px" src="https://'.$this->siteDomain.'/mail_images/brand-e.png" alt="brand"></a></li>
                                        <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="https://youtube.com/"><img style="width: 30px" src="https://'.$this->siteDomain.'/mail_images/brand-d.png" alt="brand"></a></li>
                                    </ul>
                                    <p style="padding-top: 15px; font-size: 12px;">For more detail contact us: info@'.$this->siteDomain.', support@'.$this->siteDomain.'</p><p style="padding-top: 15px; font-size: 12px;">This email was sent to you as a registered user of <a style="color: #6576ff; text-decoration:none;" href="https://'.$this->siteDomain.'/">'.$this->siteName.'</a>.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               </td>
            </tr>
        </table>
    </center>
</body>
</html>';
        return $content;
    }


    public function generalMessage($subjt,$message,$email,$siteName,$siteDomain){
        $d = date('Y');
        $to  = $email;
        $subject = $subjt;
        $content = self::generalBody($message);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function updatewalletAddress($name,$email){
        $to  = $email;
        $subject ='Update Wallet Address ';
        $info = 'Hi '.$name.', you have successfully updated your wallet address. <br>Please if you are not the one who carry out this action we suggest you change your password and update your wallet back cause someone might be trying to hack your account.<br /><br />Thank you.';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function commissionWithdrawalNotice($name,$email,$amount,$level){
        $to  = $email;
        $subject ='Level '.$level.' Referral Commission Withdrawal ';
        $info = 'Hi '.$name.', you have successfully move '.$amount.' from your Level '.$level.' wallet to your main account. <br>You can now withdraw it from your main account to your USDT wallet.<br /><br />Thank you.';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function DownlineInvestmentNotice($nameM,$nameR,$email,$amount,$level){
        $to  = $email;
        $subject ='Level '.$level.' Referral Bonus from '.$nameR;
        $info = 'Hi '.$nameR.', you just received a referral bonus of $'.$amount.' from your '.$level.' down-line '.$nameM.' investment. <br>Bonus will be available for withdrawal ones payment has been confirmed.<br /><br />Thank you.';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function referalBonus($nameM,$nameR,$email,$amount){
        $to  = $email;
        $subject ='Referral Bonus from '.$nameR;
        $info = 'Hi '.$nameR.', you just received a bonus of $'.$amount.' from your down-line '.$nameM.' investment. <br>Bonus will be available for withdrawal ones payment has been confirmed.<br /><br />Thank you.';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function referalNew($nameM,$emailM,$nameR,$emailR,$usernameM,$usernameR){
        $to  = $emailR;
        $subject ='You have a new direct sign-up on '.$this->siteDomain;
        $info = 'Dear '.$nameR.'('.$usernameR.'), <br><br /> You have a new direct referral sign-up on <br />'.$this->siteDomain.'<br />User: '.$usernameM.'<br />Name: '.$nameM.'<br>E-mail: '.$emailM.'<br><br >Thank You.';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function clientReviews($name,$email,$review){
        $to  ='webdav75@gmail.com';
        $subject ='Review From '.$name;
        $info = 'Hi Admin, '.$name.' sent you a review. Visit your dashboard to approve or disapprove this review. <br />Details:  <br> Review: '.$review.'.<br> Email: '.$email;
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function adminwithdrawsNoticeA($amount,$plan,$coin,$id,$name,$email){
        $to  ='webdav75@gmail.com';
        $subject ='Referral Withdrawal Notification by '.$name;
        $info = 'Hi Admin, client with name '.$name.' requested to withdraw his referral commission <br />Amount: $'.$amount.' <br />Plan: '.$plan.', <br />Coin: '.$coin.', <br />Email: '.$email.', <br />Transaction ID: '.$id.'.';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function adminDepositNotice($amount,$plan,$coin,$id,$name,$email){
        $to  ='webdav75@gmail.com';
        $subject ='Sucessful Deposite by '.$name;
        $info = 'Hi Admin client '.$name.' just successfully deposited <br />Amount: $'.$amount.' <br />Plan: '.$plan.', <br />Coin: '.$coin.', <br />Email: '.$email.', <br />Transaction ID: '.$id.'.';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function adminDepositNoticeNotsuccessf($amount,$plan,$coin,$id,$name,$email){
        $to  ='webdav75@gmail.com';
        $subject ='Deposite Notification by '.$name;
        $info = 'Hi Admin, client with name '.$name.' just successfully initiated a deposited of <br />Amount: $'.$amount.', <br />Plan: '.$plan.', <br />Coin: '.$coin.', <br />Email: '.$email.', <br />Transaction ID: '.$id.'. <br />You will be also notified when he finally makes payments.';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function adminWithdrawalNotice($amount,$plan,$coin,$id,$name,$email,$wallet){
        $to  ='webdav75@gmail.com';
        $subject ='Withdrawal request by '.$name;
        $info = 'Hi Admin, client with '.$name.' request to withdraw <br />Amount: $'.$amount.', <br />Wallet: '.$wallet.', <br />Plan: '.$plan.', <br />Coin: '.$coin.', <br />Email: '.$email.', <br />Transaction ID: '.$id;
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function salesrep($name,$email){
        $to  = $email;
        $subject ='Sales Rep. Application Center';
        $info = 'Hi '.$name.', you have successfully applied to be our Sales Rep. Agent you are required to refer up to 12 persons within the said period or your account will be down-graded.';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }

    public function contactUsMail($name,$email,$subject,$message){
        $to  ='support@'.$this->siteDomain;
        $subject =$subject;
        $info = $message.'<br /></br><strong>Name: '.$name.',<br />Email: '.$email.'</strong>';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            self::autoReplyMail($name,$email,$subject);
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
    }


    public function paymentNotification($amount,$plan,$coin,$id,$name,$email){
        $to  = $email;
        $d = date("Y");
        $subject = "(".date("F j, Y").") Deposit Notification";
        $info = 'Hi '.$name.', <br>You have successfully created a deposit of $'.$amount.'. You can now proceed to make payments.<br /><strong>Amount: </strong> $'.$amount.',<strong>Transaction ID: </strong>'.$id.', <br /><strong>Coin:</strong> '.$coin;
        $content = self::generalBody($info);
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$header);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
        return $this;
    }




    public function ConfirmPaymentNotify($amount,$plan,$coin,$id,$name,$email){
        $to  = $email;
        $d = date('F j, Y');
        $subject = "Deposit Success Confirmation";
        $info = 'Hi '.$name.',<br /> Your investment deposit was successfully confirmed.<br /><strong>Amount: </strong> $'.$amount.',<br /><strong>Transaction ID: </strong>'.$id.',<br /> <strong>Coin: </strong>'.$coin;
        $content = self::generalBody($info);
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From:'.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$header);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
        return $this;
    }



    public function unconfirmPaymentNotify($amount,$plan,$coin,$id,$name,$email){
        $to  = $email;
        $d = date('F j, Y');
        $subject = "Deposit Cancellation (".date("Y-F-d").")";
        $info = 'Hi '.$name.', <br /> Your investment deposit was canceled till further notice. Thanks<br /><strong>Amount: </strong> $'.$amount.',<br /><strong>Transaction ID: </strong>'.$id.', <br /><strong>Coin: </strong>'.$coin;
        $content = self::generalBody($info);
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From:'.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$header);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
        return $this;
    }


    public function transactionTerminationNotify($amount,$plan,$coin,$id,$name,$email){
        $to  = $email;
        $d = date('F j, Y');
        $subject = "Investment Termination (".date("Y-F-d").")";
        $info = 'Hi '.$name.', <br /> Your investment contract was terminated because it has reached the maximum period allowed for returns. Thanks<br /><strong>Amount: </strong> $'.$amount.',<br /><strong>Transaction ID: </strong>'.$id.', <br /><strong>Coin: </strong>'.$coin;
        $content = self::generalBody($info);
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$header);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
        return $this;
    }


    public function transactionUNTerminationNotify($amount,$plan,$coin,$id,$name,$email){
        $to  = $email;
        $d = date('F j, Y');
        $subject = "Investment Reversal  (".date("F j, Y").")";
        $info = 'Hi '.$name.', <br /> Your investment has been reversed. We sincerely apologize for any inconveniency this might have caused you. Thanks<br /><strong>Amount: </strong> $'.$amount.',<br /><strong>Transaction ID: </strong>'.$id.', <br /><strong>Coin: </strong>'.$coin;
        $content = self::generalBody($info);
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$header);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
        return $this;
    }


    public function payOutNotification($amount,$plan,$coin,$id,$name,$email,$wallet){
        $to  = $email;
        $d = date('F j, Y');
        $subject = "'.$this->siteName.' Payment Approval";
        $info = 'Hello '.$name.',<br /> We wish to notify you that your wallet has been credited with the said amount you created withdrawal for. Find details below:<br /><br /><strong>Wallet Address:</strong> '.$wallet.', <br /><strong>Amount: </strong> $'.$amount.',<br /><strong>Transaction ID: </strong>'.$id.', <br /><strong>Coin: </strong>'.$coin;
        $content = self::generalBody($info);
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$header);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
        return $this;
    }




    public function withdrwalNotification($amount,$plan,$coin,$id,$name,$email,$wallet){
        $to  = $email;
        $d = date('F j, Y');
        $subject = "'.$this->siteName.' Withdrawal Notification";
        $info = 'Hello '.$name.',<br /> We Write to inform you that your request to withdraw your earnings was successfully processed. Find details below:<br /><br /><strong>Wallet Address:</strong> '.$wallet.', <br /><strong>Amount: </strong> $'.$amount.',<br /><strong>Transaction ID: </strong>'.$id.', <br /><strong>Coin: </strong>'.$coin;
        $content = self::generalBody($info);
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$header);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
        return $this;
    }


    public function withdrwalNotificationNOT($amount,$plan,$coin,$id,$name,$email,$wallet){
        $to  = $email;
        $d = date('F j, Y');
        $subject = "Withdrawal Notification";
        $info = 'Hello '.$name.',<br /> Your request to withdraw $'.$amount.' was successfully created. Payment will be made soon. Find details below:<br /><br /><strong>Wallet Address:</strong> '.$wallet.', <br /><strong>Amount: </strong> $'.$amount.',<br /><strong>Transaction ID: </strong>'.$id.', <br /><strong>Coin: </strong>'.$coin;
        $content = self::generalBody($info);
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$header);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
        return $this;
    }


    public function withdrwalREFNotification($amount,$plan,$coin,$id,$name,$email,$wallet){
        $to  = $email;
        $d = date('F j, Y');
        $subject = "Your Referral Withdrawal";
        $info = 'Hello '.$name.',<br /> Your Referral Withdrawal was successfully. Find details below:<br /><br /><strong>Wallet Address:</strong> '.$wallet.', <br /><strong>Amount: </strong> $'.$amount.',<br /><strong>Transaction ID: </strong>'.$id.', <br /><strong>Coin: </strong>'.$coin;
        $content = self::generalBody($info);
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$header);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
        return $this;
    }


    public function autoReplyMail($name,$email,$subj){
        $to  = $email;
        $d = date('F j, Y');
        $subject = 'Auto-Reply';
        $info = 'Hi '.$name.', Your message has been received. Thank you for contacting us. We will get back to you as soon as possible.';
        $content = self::generalBody($info);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$headers);
        if($retval){
            return   'Mail sent successfully';
        }else{
            return  'Internal error. Mail fail to send';
        }
    }

    public function MailDispatcha($email,$message,$title,$file){
        $to  = $email;
        $d = date('F j, Y');
        $subject = "News Update ".$this->siteName." (".date("F j, Y").")";
        if(!empty($file)){
           $f = '<p><b>Find Link to attached file if any.</b><br>
                    <u><a href="'.$file.'">View Attached File</a></u>
                </p>';
        }else{
            $f='';
        }
        $info = '<h1>'.$title.'</h1>'.$message.$f;
        $content = self::generalBody($info);
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$content,$header);
        if($retval){
            return  'Mail sent successfully';
        }else{
            return 'Internal error. Mail fail to send';
        }
        return $this;
    }

    public function forgetpassword($email,$tablename,$fieldname){
        $d = date('F j, Y');
        $credentialCheck = "SELECT * FROM $tablename WHERE $fieldname = :adddata limit 1";
        $dbs = new DBConnection();
        $db = $dbs->DBConnections();
        $stmt  = $db->prepare($credentialCheck);
        $stmt->bindValue(':adddata', $email);
        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $password = $row['password'];
            $name = $row['first_name'];
            $resetpassword_id = $row['forget_password_code'];
            $to  = $email;
            $subject = "Forgot Password  Recovery Centre";
            $content = '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="x-apple-disable-message-reformatting"><title></title><link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    <!--[if mso]>
        <style>
            * {
                font-family: \'Roboto\', sans-serif !important;
            }
        </style>
    <![endif]-->
    <!--[if !mso]>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    <![endif]--><style>
        html,body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: \'Roboto\', sans-serif !important;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 24px;
            color:#8094ae;
            font-weight: 400;
        }
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }
        a {
            text-decoration: none;
        }
        img {
            -ms-interpolation-mode:bicubic;
        }</style>
        </head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f5f6fa;">
	<center style="width: 100%; background-color: #f5f6fa;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f6fa">
            <tr>
               <td style="padding: 40px 0;">
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: center; padding-bottom:25px">
                                    <a href="https://'.$this->siteDomain.'/"><img style="height: 40px" src="https://'.$this->siteDomain.'/img/logo.png" alt="logo"></a>
                                    <p style="font-size: 14px; color: #6576ff; padding-top: 12px;">Refer, Share and Earn</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
                        <tbody>
                            <tr>
                                <td style="text-align:center;padding: 30px 30px 15px 30px;">
                                    <h2 style="font-size: 18px; color: #6576ff; font-weight: 600; margin: 0;">Reset Password</h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;padding: 0 30px 20px">
                                    <p style="margin-bottom: 10px;">Hi '.$name.',</p>
                                    <p style="margin-bottom: 25px;">Click On The link blow to reset tour password.</p>
                                    <a href="https://'.$this->siteDomain.'/fogetpassword/recover.php?id='.$email.'&ip='.$password.'&it='.$resetpassword_id.'" style="background-color:#6576ff;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 25px">Reset Password</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:center;padding: 20px 30px 40px">
                                    <p>If you did not make this request, please contact us or ignore this message.</p>
                                    <p style="margin: 0; font-size: 13px; line-height: 22px; color:#9ea8bb;">This is an automatically generated email please do not reply to this email. If you face any issues, please contact us at  support@'.$this->siteDomain.'</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align: center; padding:25px 20px 0;">
                                    <p style="font-size: 13px;">Copyright © '.$d.' '.$this->siteName.'. All rights reserved.</p>
                                    <ul style="margin: 10px -4px 0;padding: 0;">
                                        <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="https://facebook.com/"><img style="width: 30px" src="https://'.$this->siteDomain.'/mail_images/brand-b.png" alt="brand"></a></li>
                                        <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="https://twitter.com/"><img style="width: 30px" src="https://'.$this->siteDomain.'/mail_images/brand-e.png" alt="brand"></a></li>
                                        <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="https://youtube.com/"><img style="width: 30px" src="https://'.$this->siteDomain.'/mail_images/brand-d.png" alt="brand"></a></li>
                                    </ul>
                                    <p style="padding-top: 15px; font-size: 12px;">For more detail contact us: info@'.$this->siteDomain.', support@'.$this->siteDomain.'</p><p style="padding-top: 15px; font-size: 12px;">This email was sent to you as a registered user of <a style="color: #6576ff; text-decoration:none;" href="https://'.$this->siteDomain.'/">'.$this->siteName.'</a>.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               </td>
            </tr>
        </table>
    </center>
</body>
</html>';
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
            $retval = @mail($to,$subject,$content,$header);
            if($retval){
                return  'Mail sent successfully. Check your Mail for Activation Link';
            }else{
                return  'Internal error. Mail fail to send';
            }
        }else{
            return 'Invalid Email. Please ensure you typed it correctly';
        }
    }

    public function ActivateMail($email,$password){
        $to  = $email;
        $d = date('F j, Y');
        $subject = $this->siteName." Successful Registration";
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="format-detection" content="date=no" />
	<meta name="format-detection" content="address=no" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="x-apple-disable-message-reformatting" />
    
	<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,700,700i" rel="stylesheet" />
	<style type="text/css" media="screen">
		
		body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#fff; -webkit-text-size-adjust:none }
		a { color:#66c7ff; text-decoration:none }
		p { padding:0 !important; margin:0 !important } 
		img { -ms-interpolation-mode: bicubic;  }
		.mcnPreviewText { display: none !important; }	
		
		@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
			.mobile-shell { width: 100% !important; min-width: 100% !important; }
			.bg { background-size: 100% auto !important; -webkit-background-size: 100% auto !important; }
			
			.text-header,
			.m-center { text-align: center !important; }
			
			.center { margin: 0 auto !important; }
			.container { padding: 20px 10px !important }
			
			.td { width: 100% !important; min-width: 100% !important; }

			.m-br-15 { height: 15px !important; }
			.p30-15 { padding: 30px 15px !important; }

			.m-td,
			.m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

			.m-block { display: block !important; }

			.fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

			.column,
			.column-top,
			.column-empty,
			.column-empty2,
			.column-dir-top { float: left !important; width: 100% !important; display: block !important; }

			.column-empty { padding-bottom: 10px !important; }
			.column-empty2 { padding-bottom: 30px !important; }

			.content-spacing { width: 15px !important; }
		}
	</style>
</head>
<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#fff; -webkit-text-size-adjust:none;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCC">
		<tr>
			<td align="center" valign="top">
				<table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
					<tr>
						<td class="td container" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; margin:0; font-weight:normal; padding:55px 0px;">
							<!-- Header -->
							
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="p30-15" style="padding: 0px 30px 30px 30px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th class="column-top" width="145" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="img m-center" style="font-size:0pt; line-height:0pt; text-align:left;"><img src="https://'.$this->siteDomain.'/img/logo.png" width="131" height="38" border="0" alt="Logo" /></td>
														</tr>
													</table>
												</th>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							
							<table width="100%" border="0" cellspacing="0" cellpadding="0" >
								<tr>
									<td style="padding-bottom: 10px;">
										<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
											<tr>
												<td class="p30-15" style="padding: 50px 30px;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="h3 pb20" style="color:#000000; font-family: Arial,sans-serif; font-size:25px; line-height:32px; text-align:left; padding-bottom:20px;"> </td>
														</tr>
														<tr>
															<td class="text pb20" style="color:#000000; font-family:Arial,sans-serif; font-size:14px; line-height:26px; text-align:left; padding-bottom:20px;">
										
										Welcome to the fastest affiliate signal platform. Your registration was successfull.<br />
										
										Login to get started. Thank you <br />
										Email: '.$email.'<br />
										Password: ******** <br />
														
										<p>You can also follow this link to confirm your account email. 
		                                
		                                <a href="https://'.$this->siteDomain.'/ActivateMail/activate.php?id='.$email.'&ip='.$password.'">Activate Mail</a></p>
														
														
												 	
														
														<br />
														<a href="https://'.$this->siteDomain.'/dashboard/deposit">Get Started </a>
														
															
															</td>
														</tr>
														
											
														
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							
								<tr>
									<td class="p30-15 bbrr" style="padding: 50px 30px; border-radius:0px 0px 26px 26px;" bgcolor="#ffffff">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											 <tr>
												<td align="center" style="padding-bottom: 30px;">
													<table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="https://'.$this->siteDomain.'/mail_images/ico_facebook.jpg" width="38" height="38" border="0" alt="" /></a></td>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="https://'.$this->siteDomain.'/mail_images/ico_twitter.jpg" width="38" height="38" border="0" alt="" /></a></td>
															<td class="img" width="55" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="https://'.$this->siteDomain.'/mail_images/ico_instagram.jpg" width="38" height="38" border="0" alt="" /></a></td>
															<td class="img" width="38" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="https://'.$this->siteDomain.'/mail_images/ico_linkedin.jpg" width="38" height="38" border="0" alt="" /></a></td>
														</tr>
													</table>
												</td>
											</tr> 
											<tr>
												<td class="text-footer1 pb10" style="color:#CCC; font-family: Arial,sans-serif; font-size:16px; line-height:20px; text-align:center; padding-bottom:10px;">
												&copy; <?php $d=date("Y"); print @$d;?> '.$this->siteName.'
												<br>
												support Team '.$this->siteName.'
												<br />
												For more detail contact us:<br />
												Email:info@'.$this->siteDomain.', support@'.$this->siteDomain.'
												
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td class="text-footer3 p30-15" style="padding: 40px 30px 0px 30px; color:#475c77; font-family: Arial,sans-serif; font-size:12px; line-height:18px; text-align:center;">
										<a href="#" target="_blank" class="link2-u" style="color:#475c77; text-decoration:underline;"><span class="link2-u" style="color:#475c77; text-decoration:underline;">Unsubscribe</span></a> from this mailing list.
									</td>
								</tr> 
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>';
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: '.$this->siteName.' <support@'.$this->siteDomain.'>' . "\r\n";
        $retval = @mail($to,$subject,$message,$header);
        if($retval = true){
            return  'Mail sent successfully. Check '.$email.' email account for `Email Activation Link`!';
        }else{
            return  'Internal error. Mail fail to send';
        }
        return $this;
    }
}
$email_call = new email();
?>

