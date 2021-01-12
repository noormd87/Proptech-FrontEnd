<?php include "header.php"; ?>
<?php
$Id 		= \ClientMail\ClientMailClass::$Id;
$user_id    = \settings\session\sessionClass::GetSessionDisplayName();
$Msg        = $ReplyAction	= isset($_REQUEST["Msg"]) ? $_REQUEST["Msg"] : "";
?>
<!-- Breadcrumb area --->
<!-- <div class="breadcrumb-area">
   <nav aria-label="breadcrumb" role="navigation">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="index.php">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Contact Acc Manager</li>
      </ol>
   </nav>
</div> -->
<!-- end breadcrumb area-->

<!-- main content -->
<div class="content">
   <div class="row">
      <div class="col-12">       
      		<div class="card">
      			<div class="card-body">
      				<div class="row">
    <div class="col-md-2 img">
      <img src="<?php echo SITE_BASE_URL ?>assets/img/img_avatar.png"  alt="" class="img-rounded">
    </div>
    <div class="col-md-6 details">
      <h5>Alex</h5>
      <small>Hi.. am Alex your property advisor</small>
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><a href="#"><i class="fa fa-envelope"></i> &nbsp; alex@duvalprivateoffice.com//</a></li>
        <li class="list-group-item"><a href="#"><i class="fa fa-globe"></i> &nbsp; www.alex.com</a></li>
        <li class="list-group-item"><a href="#"><i class="fa fa-phone"></i> &nbsp; (999)-999-9999</a></li>
      </ul>
      <a href="#composeEmailModal" data-toggle="modal"  title="Compose"    class="btn btn-success mt-2"><i class="fa fa-plus"></i> CONTACT</a>
    </div>
  </div>
      			</div>
      		</div>


      		<div class="card">
      			<div class="card-body">
      			    <table class="table table-inbox table-hover">

    					<tbody>
    						<tr class="unread" style="background-color: yellow;" >	
    						  <td class="view-message ">S. No</td>				  
    						  <td class="view-message ">Ticket Id</td>				  
    						  <td class="view-message ">TO</td>				  
    						  <td class="view-message ">CC</td>				  
    						  <td class="view-message  text-left">Subject</td>
    						  <td class="view-message  text-left">&nbsp;</td>
    						</tr>
    						<?php
    							\ClientMail\ClientMailClass::Init();
    							$rows = \ClientMail\ClientMailClass::GetDetailList("","1",$user_id);
    							$i = 1;
    							foreach ($rows as $row) 
    							{
    							?>					
    							  <tr class="collapsible">							  
    								  <td class="view-message"><?php echo $i; ?></td>
    								  <td class="view-message"><?php echo $row["CONTACT_TICKET_ID"]; ?></td>
    								  <td class="view-message"><?php echo $row["CONTACT_TO"]; ?></td>
    								  <td class="view-message"><?php echo $row["CONTACT_CC_BCC"]; ?></td>	
    								  <td class="view-message"><?php echo $row["SUBJECT"]; ?></td>	
    								  <td class="view-message"><a class="nav-link" href="#" onclick="replyfn()" ><img class="img-fluid" src="../assets/img/arrears-icon.png" alt="download-icon"></a></td>	
    								  
    							  </tr>
    							  <?php								
    								$rowsnew = \ClientMail\ClientMailClass::GetDetailList($row["CONTACT_TICKET_ID"],"0",$user_id);
    								$j = 1;
    								foreach ($rowsnew as $rowall) 
    								{
    							  ?>	
    							  
    								  <tr class="content" style="background-color: skyblue;" >	
    									   <td class="view-message">&nbsp;</td>	
    									   <td class="view-message"><?php echo $j; ?></td>								 
    									   <td class="view-message" colspan=4><?php echo $rowall["DESCRIPTION"]; ?></td>									  
    								  </tr>
    								
    							  <?php
    								 $j++;
    								}
    								
    								?>
    								<tr class="content" style="background-color: skyblue;" >	
    								   <td class="view-message">&nbsp;</td>	
    								   <td class="view-message" colspan='4' >  <textarea rows="10" cols="30" class="form-control" id="ReplyMessage<?php echo $i; ?>" name="ReplyMessage<?php echo $i; ?>" ></textarea>
    									  <span id="ReplyMessageAlert"><span>
    									</td>
    					
    									<td class="view-message"><input type="button" onclick="UpdateFn('<?php echo $i; ?>')" value="Reply"></td>	
    									<input type="hidden" name="UserId<?php echo $i; ?>" id="UserId<?php echo $i; ?>" value="<?php echo $user_id; ?>" >
    									<input type="hidden" name="TicketId<?php echo $i; ?>" id="TicketId<?php echo $i; ?>" value="<?php echo $row["CONTACT_TICKET_ID"]; ?>" >
    							  </tr>
    							<?php
    							 $i++;
    							}
    							?>
    				</tbody>        
				</table>
      			</div>
      		</div>


			<div class="inbox-body">
			  <!-- <a href="#composeEmailModal" data-toggle="modal"  title="Compose"    class="btn btn-compose">
				  + Contact Us
			  </a> -->
			  <!-- Compose Mail Modal -->
			  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="composeEmailModal" class="modal fade" style="display: none;">
				  <div class="modal-dialog modal-lg">
					  <div class="modal-content">
					  	<div class="modal-header">
        <h5 class="modal-title" id="entityModalLabel">Compose New Mail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
						
						  <div class="modal-body">
							  <form action="<?php echo SITE_BASE_URL;?>/ClientMail/saveContact.html?ReplyAction=N" method="post" class="form-horizontal" name='form1' onsubmit="return AutoMailFn()" >
								  <div class="form-group">
									  <label class="control-label">To*//</label>
									  <input type="text" placeholder="" name="inputEmail1" id="inputEmail1" class="form-control" onblur="RemoveAlertFn('inputEmail1')" >
									  <span id="inputEmail1Alert"><span>
								  </div>
								  <div class="form-group">
									  <label class="control-label">Cc / Bcc*</label>
									  <input type="text" placeholder="" name="ccBcc" id="ccBcc" class="form-control" onblur="RemoveAlertFn('ccBcc')"  >
									  <span id="ccBccAlert"><span>
								  </div>
								  <div class="form-group">
									  <label class="control-label">Subject*</label>
									  <input type="text" placeholder="" name="inputSubject" id="inputSubject" class="form-control" onblur="RemoveAlertFn('inputSubject')"  >
									   <span id="inputSubjectAlert"><span>
								  </div>
								  <div class="form-group">
									  <label class="control-label">Message*</label>
    									  <textarea rows="10" cols="30" class="form-control" id="Message" name="Message" onblur="RemoveAlertFn('Message')"  ></textarea>
									  <span id="MessageAlert"><span>
									  
								  </div>

								  <div class="form-group pull-right">
									  <div class="col-12 ">
										  <!--<button class="btn btn-warning" type="submit">Save as draft</button>-->
										  <button class="btn btn-send" type="submit" name="send">Send</button>
										  <input type="hidden" name="UserId" id="UserId" value="<?php echo $user_id; ?>" >
									  </div>
								  </div>
								  <div class="clearfix"></div> 
							  </form>
						  </div>
					  </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
			  </div><!-- /.modal -->
				
		  </div>
      </div> 
   </div>
</div>


<script>

function AutoMailFn(){
	
		var inputEmail1 	= $("#inputEmail1").val();
		var ccBcc 			= $("#ccBcc").val();
		var inputSubject 	= $("#inputSubject").val();
		var Message 		= $("#Message").val();
		
		if ( inputEmail1 == ""){
			$("#inputEmail1Alert").html("Please Enter Email");
			return false;			
		}
		if ( ccBcc == ""){
			
			$("#ccBccAlert").html("Please Enter CC / BCC");
			return false;			
		}
		if ( inputSubject == ""){
			$("#inputSubjectAlert").html("Please Enter Subject");
			return false;			
		}
		if ( Message == ""){
			$("#MessageAlert").html("Please Enter Message");
			return false;			
		}
		
		if ( inputEmail1 != "" )
		{				
			if( !validateEmail(inputEmail1)) {				
				 $("#inputEmail1Alert").html("Please Enter Valid Email Id");
				 return false;			
			}		
		}		
		
		if ( ccBcc != "" )
		{				
			if( !validateEmail(ccBcc)) {				
				 $("#ccBccAlert").html("Please Enter Valid Email Id");
				 return false;			
			}		
		}
        
    
}

function UpdateFn(Rownum){
	
	var ReplyMessage 	= $("#ReplyMessage"+Rownum).val();
	var UserId 			= $("#UserId"+Rownum).val();
	var TicketId 		= $("#TicketId"+Rownum).val();	
	if ( ReplyMessage == ""){
		$("#ReplyMessageAlert").html("Please Enter Message");
		return false;			
	}
    
   // alert(ReplyMessage);
	window.location.href ="<?php echo SITE_BASE_URL;?>/ClientMail/saveContact.html?ReplyAction=Y&UserId="+UserId+"&TicketId="+TicketId+"&Message="+ReplyMessage;
}

function RemoveAlertFn(feildName){
	
	var feildNameVal 	= $("#"+feildName).val();
	
	if ( feildNameVal != ""){			
		$("#"+feildName+"Alert").html("");
		return false;			
	}
	
}

/* function validateEmails(emailVal) {
        var regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var result = string.replace(/\s/g, "").split(/,|;/);        
        for(var i = 0;i < result.length;i++) {			
			
			alert(regex.test(result[i]))
        }       
        return true;
    }
	 */
function validateEmail(emailVal) {
		  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		  return emailReg.test(emailVal);
		}

</script>
<!-- end main content -->
<?php include"footer.php"; ?>