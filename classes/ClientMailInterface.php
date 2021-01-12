<?php


namespace ClientMail;

interface ClientMailInterface {
    //put your code here
    
    
}

class ClientMailClass implements ClientMailInterface{
    public static $Id;
	
	public static function Add(){
        \Html\HtmlClass::init();
		self::Init(); 
		
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/ClientMail/ClientMailAdd.php" );
    }
    public static function contact(){
        \Html\HtmlClass::init();
		self::Init(); 
		
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/ClientMail/contact.php" );
    }
    public static function mailread(){
        \Html\HtmlClass::init();
		self::Init(); 
		
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/ClientMail/mail-read.php" );
    }
    public static function compose(){
        \Html\HtmlClass::init();
		self::Init(); 
		
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/ClientMail/compose.php" );
    }
	public static function ClientMailView(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/ClientMail/ClientMailView.php" );
    }
	
	public static function GetFormValues(){
		self::$Id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
		
	}
	
    public static function Init(){
		self::GetFormValues();
         
         //self::$TotalAddRows    = 3;
    }
   

     public static function saveContact(){
		
		
      
	     \Html\HtmlClass::init();
		self::Init(); 
		
		$ReplyAction	= isset($_REQUEST["ReplyAction"]) ? $_REQUEST["ReplyAction"] : "";
		$inputEmail1   	= isset($_REQUEST["inputEmail1"]) ? $_REQUEST["inputEmail1"] : "";
        $ccBcc   		= isset($_REQUEST["ccBcc"]) ? $_REQUEST["ccBcc"] : "";
        $inputSubject   = isset($_REQUEST["inputSubject"]) ? $_REQUEST["inputSubject"] : "";
        $Message   		= isset($_REQUEST["Message"]) ? $_REQUEST["Message"] : "";
        $UserId   		= \settings\session\sessionClass::GetSessionDisplayName();
        $TicketId   	= isset($_REQUEST["TicketId"]) ? $_REQUEST["TicketId"] : "";
        
        /*
		$from				= "arzathnazeer@gmail.com";
		$to	                = "arzathnazeer@gmail.com";
		$subject 			= 'MailSent!';
		$message            = "Sucess";
	
		$headers = 'MIME-Version: 1.0' . '\r\n';
		$headers = 'Content-type: text/html; charset=UTF-8'  . '\r\n';
		$headers = 'From : <$from> \r\n';
			
		//mail($to_email_address,$subject,$message,[$headers],[$parameters]);
		
		if ( mail($to,$subject,$message,$headers) ){
			
			echo mail($to,$subject,$message,$headers);
			exit();
			
		}else{
			
			echo "ERRor Mail";
			exit();
			
		}
		*/



		$to = stripcslashes($inputEmail1);
        $subject = stripcslashes($inputSubject);

        $message = '
        <html>
        <head>
          <meta name="viewport" content="width=device-width" />
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
          <title>DPO ACCOUNT MANAGER</title>
          <style type="text/css">
            body {
                background-color: #f6f6f6;
                font-family: sans-serif;
                -webkit-font-smoothing: antialiased;
                font-size: 14px;
                line-height: 1.4;
                margin: 0;
                padding: 0;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
                width: 300px; 
              }
              table {
                border-collapse: collapse;
              }
              .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
              }
              .table th,
              .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
              }

              .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
              }

              .table tbody + tbody {
                border-top: 2px solid #dee2e6;
              }
          </style>
        </head>
        <body>
        <p>DPO ACCOUNT MANAGER</p>
          <table class="table">
            <tr>
              <td>Message</td>
              <td>'.$Message.'</td>
            </tr>
          </table>
        </body>
        </html>
        ';
         
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'Cc: '.$ccBcc.'' . "\r\n";
        $headers .= "From: <info@duvalknowledge.co.nz>" . "\r\n";
        $sent = mail($to,$subject,$message,$headers);
        if($sent){
         echo " Thank you for contacting us, we will get back to you shortly.";
        }
        else{
         echo "Sorry! Your form submission is failed.";
        }

		
        $SQLArr             	= array();
        $MaxIdArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(CONTACT_AUTO_ID), 0) + 1 CONTACT_AUTO_ID FROM CONTACT_MASTER)");
        $MaxId                  = $MaxIdArr["0"];

		if ( $TicketId == "" )
		{	
		
			$MaxTktArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(CONTACT_TICKET_ID), 0) + 1 CONTACT_TICKET_ID FROM CONTACT_MASTER)");
			$MaxTktId                = $MaxTktArr["0"];	
		}else{
			$MaxTktId				 = $TicketId;	
		}
		$MaxSeqArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(SEQ_NO), 0) + 1 SEQ_NO FROM CONTACT_MASTER WHERE CONTACT_TICKET_ID ='" .$MaxTktId. "' )");
		$MaxSeqId                = $MaxSeqArr["0"];

		//$MessageNew 	 		= mysqli_real_escape_string($Con,$Message );
		//$inputSubjectNew 	    = mysqli_real_escape_string($Con,$inputSubject);

		 
		$SQLArr[]   = "INSERT INTO `CONTACT_MASTER`(`CONTACT_AUTO_ID`, `CONTACT_TO`, `CONTACT_CC_BCC`, `SUBJECT` ,`DESCRIPTION`,`CONTACT_TICKET_ID`,`SEQ_NO`,
						`created_by`,`created_date`)	VALUES ('" .$MaxId. "','" .$inputEmail1. "','" .$ccBcc. "','" .$inputSubject. "',
									'" .$Message. "' ,'" .$MaxTktId. "','" .$MaxSeqId. "','" .$UserId. "',CURRENT_TIMESTAMP)";
        
        


		$Msg = \DBConn\DBConnection::RunQuery($SQLArr); 
		
	//	return \DBConn\DBConnection::getQuery( $IndexQry ); 
	
		// echo "<script>alert('Ticket Created SucessFully..')</script>";

		 
		 $Listpath =  SITE_BASE_URL. "ClientMail/contact.html?Msg=".$Msg;
		 
		 header('location:' .$Listpath);
    	
    }
	
	 public static function GetDetailList($ContactTicketId,$SeqNo,$userid){
        
		
		if ($ContactTicketId!="")
        {        
            $cond1=" and CONTACT_TICKET_ID='" . $ContactTicketId . "' ";     
        }
        else
        {
            $cond1=" and 1=1 ";
        }


		if ($SeqNo == 1  )
        {   
            $cond2=" and  SEQ_NO='1' ";        
        }
        else
        {
            $cond2=" and 1=1 ";
        }
		
       
        $IndexQry	= "SELECT CONTACT_AUTO_ID,CONTACT_TICKET_ID, CONTACT_TO, CONTACT_CC_BCC, SUBJECT ,DESCRIPTION,DATE_FORMAT(CREATED_DATE, '%d-%b') as CREATED_DATE
                    FROM
                        CONTACT_MASTER Where CREATED_BY = '" .$userid. "' " . $cond1 . " " . $cond2 . "
                    ORDER BY
                        CONTACT_AUTO_ID desc " ;
		//echo $IndexQry;

        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
	

    
}	