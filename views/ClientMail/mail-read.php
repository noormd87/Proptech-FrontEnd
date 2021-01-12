<?php include"header.php"; ?>
<?php
$Id 		= \ClientMail\ClientMailClass::$Id;
$user_id    = \settings\session\sessionClass::GetSessionDisplayName();
$TicketId= isset($_REQUEST["Id"]) ? $_REQUEST["Id"] : "";
$Msg        = $ReplyAction	= isset($_REQUEST["Msg"]) ? $_REQUEST["Msg"] : "";
?>
                <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="email-left-box">
                                <a href="<?php echo SITE_BASE_URL ?>ClientMail/compose.html" class="btn btn-primary btn-block">Compose</a>
                                <div class="mail-list mt-4">
                                    <a href="index.php" class="list-group-item border-0 text-primary p-r-0">
                                        <i class="fa fa-inbox font-18 align-middle mr-2"></i>
                                        <b>Inbox</b>
                                        <span class="badge badge-primary badge-sm float-right  m-t-5">198</span>
                                    </a>
                                    <a href="#" class="list-group-item border-0 p-r-0">
                                        <i class="fa fa-paper-plane font-18 align-middle mr-2"></i>Sent</a>
                                    <a href="#" class="list-group-item border-0 p-r-0">
                                        <i class="fa fa-star-o font-18 align-middle mr-2"></i>Important
                                        <span class="badge badge-danger badge-sm float-right  m-t-5">47</span>
                                    </a>
                                    <a href="#" class="list-group-item border-0 p-r-0">
                                        <i class="mdi mdi-file-document-box font-18 align-middle mr-2"></i>Draft
                                    </a>
                                    <a href="#" class="list-group-item border-0 p-r-0">
                                        <i class="fa fa-trash font-18 align-middle mr-2"></i>Trash</a>
                                </div>

                                <h5 class="mt-5 m-b-10">Categories</h5>

                                <div class="list-group mail-list">
                                    <a href="#" class="list-group-item border-0">
                                        <span class="fa fa-briefcase f-s-14  mr-2"></span>Work</a>
                                    <a href="#" class="list-group-item border-0">
                                        <span class="fa fa-sellsy f-s-14  mr-2"></span>Private</a>
                                    <a href="#" class="list-group-item border-0">
                                        <span class="fa fa-ticket f-s-14  mr-2"></span>Support</a>
                                    <a href="#" class="list-group-item border-0">
                                        <span class="fa fa-tags f-s-14 mr-2"></span>Social</a>
                                </div>

                                <h5 class="mt-5 m-b-10">Chat</h5>

                                <div class="chat-wrap">
                                    <div class="media p-t-15">
                                        <img src="assets/img/avatar/1.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-success pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                    <div class="media p-t-15">
                                        <img src="assets/img/avatar/2.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-success pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                    <div class="media p-t-15">
                                        <img src="assets/img/avatar/3.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-warning pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                    <div class="media p-t-15">
                                        <img src="assets/img/avatar/4.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-warning pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                    <div class="media p-t-15">
                                        <img src="assets/img/avatar/5.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-danger pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                    <div class="media p-t-15">
                                        <img src="assets/img/avatar/6.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-danger pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="email-right-box">

                                <div class="toolbar " role="toolbar">
                                    <div class="btn-group m-b-20">
                                        <button type="button" class="btn btn-light">
                                            <i class="fa fa-archive"></i>
                                        </button>
                                        <button type="button" class="btn btn-light">
                                            <i class="fa fa-exclamation-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-light">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="btn-group m-b-20">
                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-folder"></i>
                                            <b class="caret m-l-5"></b>
                                        </button>
                                        <div class="dropdown-menu">
                                            <span class="dropdown-header">Move to</span>
                                            <a class="dropdown-item" href="javascript: void(0);">Social</a>
                                            <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                                            <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                                            <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                        </div>
                                    </div>
                                    <div class="btn-group m-b-20">
                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-tag"></i>
                                            <b class="caret m-l-5"></b>
                                        </button>
                                        <div class="dropdown-menu">
                                            <span class="dropdown-header">Label as:</span>
                                            <a class="dropdown-item" href="javascript: void(0);">Updates</a>
                                            <a class="dropdown-item" href="javascript: void(0);">Social</a>
                                            <a class="dropdown-item" href="javascript: void(0);">Promotions</a>
                                            <a class="dropdown-item" href="javascript: void(0);">Forums</a>
                                        </div>
                                    </div>

                                    <div class="btn-group m-b-20">
                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                            More
                                            <span class="caret m-l-5"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <span class="dropdown-header">More Option :</span>
                                            <a class="dropdown-item" href="javascript: void(0);">Mark as Unread</a>
                                            <a class="dropdown-item" href="javascript: void(0);">Add to Tasks</a>
                                            <a class="dropdown-item" href="javascript: void(0);">Add Star</a>
                                            <a class="dropdown-item" href="javascript: void(0);">Mute</a>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="read-content">
                                    <?php
        							\ClientMail\ClientMailClass::Init();
        							$rows = \ClientMail\ClientMailClass::GetDetailList($TicketId,"",$user_id);
        							$i = 1;
        							foreach ($rows as $row) 
        							{
        							?>	
                                    <div class="media p-t-15">
                                        <img class="mr-3 rounded-circle" src="assets/img/avatar/1.jpg">
                                        <div class="media-body">
                                            <h5 class="m-b-3">Ingredia Nutrisha</h5>
                                            <p class="m-b-2"><?php echo $row["CREATED_DATE"];?> </p>
                                        </div>
                                        <a href="#" class="text-muted m-r-30">
                                            <i class="fa fa-reply"></i>
                                        </a>
                                        <a href="#" class="text-muted m-r-30">
                                            <i class="fa fa-reply"></i>
                                        </a>
                                        <a href="#" class="text-muted m-r-30">
                                            <i class="fa fa-long-arrow-right"></i>
                                        </a>
                                        <a href="#" class="text-muted">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>

                                    <hr>

                                    <div class="media mb-4 mt-1">
                                        <div class="media-body">
                                            <span class="pull-right">07:23 AM</span>
                                            <?php if($row["CONTACT_TO"]!="" &&$row["CONTACT_TO"]!=null) {?>
                                                <h4 class="m-0 text-primary"><?php echo $row["SUBJECT"]; ?></h4>
                                                <small class="text-muted">To:<?php echo $row["CONTACT_TO"]; ?>,<?php echo $row["CONTACT_CC_BCC"]; ?></small>
                                            <?php }?>
                                        </div>
                                    </div>

                                    <h5 class="m-b-15">Hi,Ingredia,</h5>
                                    <p>
                                        <strong><!--Ingredia Nutrisha,</strong>--><?php echo $row["DESCRIPTION"]; ?></p>

                                    <!--<h5 class="m-b-5 p-t-15">Kind Regards</h5>-->
                                    <!--<p>Mr Smith</p>-->

                                    <hr>

                                    <?php
        							 $i++;
        							}
        							?>
                                    <h6 class="p-t-15">
                                        <i class="fa fa-download mb-2"></i> Attachments
                                        <span>(3)</span>
                                    </h6>

                                    <div class="row m-b-30">
                                        <div class="col-auto">
                                            <a href="#" class="text-muted"> My-Photo.png </a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="text-muted"> My-File.docx </a>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="text-muted"> My-Resume.pdf </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group p-t-15">
                                        <textarea class="w-100 p-20 l-border-1" id="ReplyMessage" name="ReplyMessage" cols="30" rows="5" placeholder="It's really an amazing.I want to know more about it..!"  ></textarea>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primaryw-md m-b-30" type="button" onclick="UpdateFn('')">Send</button>
                                    <input type="hidden" name="UserId" id="UserId" value="<?php echo $user_id; ?>" >
    								<input type="hidden" name="TicketId" id="TicketId" value="<?php echo $TicketId; ?>" >
                                </div>
                            </div>
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
        <?php include"footer.php"; ?>