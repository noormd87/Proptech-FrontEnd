<?php include"header.php"; ?>
<?php
$Id 		= \ClientMail\ClientMailClass::$Id;
$user_id    = \settings\session\sessionClass::GetSessionDisplayName();
$Msg        = $ReplyAction	= isset($_REQUEST["Msg"]) ? $_REQUEST["Msg"] : "";
?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="email-left-box">
                                    <a href="compose.php" class="btn btn-primary btn-block">Compose</a>
                                    <div class="mail-list mt-4">
                                        <a href="contact.php" class="list-group-item border-0 text-primary p-r-0">
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

                                    <div class="toolbar" role="toolbar">
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



                                    <div class="compose-content">
                                        <form action="<?php echo SITE_BASE_URL;?>/ClientMail/saveContact.html?ReplyAction=N" method="post" class="form-horizontal" name='form1' onsubmit="return AutoMailFn()" >
                                            <div class="form-group">
                                                <input type="text" class="form-control bg-transparent" placeholder=" To" name="inputEmail1" id="inputEmail1" onblur="RemoveAlertFn('inputEmail1')">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control bg-transparent" placeholder=" Subject" name="inputSubject" id="inputSubject" onblur="RemoveAlertFn('inputSubject')" >
                                            </div>
                                            <div class="form-group">
                                                <ul class="wysihtml5-toolbar" style="">
                                                    <li class="dropdown">
                                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                                            <i class="fa fa-font"></i>&nbsp;<span class="current-font">Normal text</span>&nbsp;<b class="caret"></b></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="div" href="javascript:;" unselectable="on">Normal text</a></li>
                                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" href="javascript:;" unselectable="on">Heading 1</a></li>
                                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" href="javascript:;" unselectable="on">Heading 2</a></li>
                                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" href="javascript:;" unselectable="on">Heading 3</a></li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="btn-group">
                                                            <a class="btn" data-wysihtml5-command="bold" title="CTRL+B" href="javascript:;" unselectable="on">Bold</a>
                                                            <a class="btn" data-wysihtml5-command="italic" title="CTRL+I" href="javascript:;" unselectable="on">Italic</a>
                                                            <a class="btn" data-wysihtml5-command="underline" title="CTRL+U" href="javascript:;" unselectable="on">Underline</a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="btn-group">
                                                            <a class="btn" data-wysihtml5-command="insertUnorderedList" title="Unordered list" href="javascript:;" unselectable="on">
                                                                <i class="fa fa-list"></i>
                                                            </a>
                                                            <a class="btn" data-wysihtml5-command="insertOrderedList" title="Ordered list" href="javascript:;" unselectable="on">
                                                                <i class="fa fa-th-list"></i>
                                                            </a>
                                                            <a class="btn" data-wysihtml5-command="Outdent" title="Outdent" href="javascript:;" unselectable="on">
                                                                <i class="fa fa-outdent"></i>
                                                            </a>
                                                            <a class="btn" data-wysihtml5-command="Indent" title="Indent" href="javascript:;" unselectable="on">
                                                                <i class="fa fa-indent"></i></a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="bootstrap-wysihtml5-insert-link-modal modal fade bs-example-modal-lg">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <a class="close" data-dismiss="modal">
                                                                        </a>
                                                                        <h3>Insert link</h3>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <input value="http://" class="bootstrap-wysihtml5-insert-link-url form-control" type="text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer"><a href="#" class="btn btn-inverse" data-dismiss="modal">Cancel</a><a href="#" class="btn btn-primary" data-dismiss="modal">Insert link</a></div>
                                                                </div>
                                                            </div>
                                                        </div><a class="btn" data-wysihtml5-command="createLink" title="Insert link" href="javascript:;" unselectable="on"><i class="fa fa-link"></i></a></li>
                                                    <li>
                                                        <div class="bootstrap-wysihtml5-insert-image-modal modal fade bs-example-modal-lg">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <a class="close" data-dismiss="modal"></a>
                                                                        <h3>Insert image</h3></div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <input value="http://" class="bootstrap-wysihtml5-insert-image-url  m-wrap large form-control" type="text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer"><a href="#" class="btn" data-dismiss="modal">Cancel</a><a href="#" class="btn  green btn-primary" data-dismiss="modal">Insert image</a></div>
                                                                </div>
                                                            </div>
                                                        </div><a class="btn" data-wysihtml5-command="insertImage" title="Insert image" href="javascript:;" unselectable="on"><i class="fa fa-image "></i></a></li>
                                                </ul>
                                                <textarea class="textarea_editor form-control bg-light" rows="15" placeholder="Enter text ..." id="Message" name="Message" onblur="RemoveAlertFn('Message')"></textarea>
                                                <input type="hidden" name="_wysihtml5_mode" value="1">
                                            </div>
                                             <h5 class="m-b-20">
                                            <i class="fa fa-paperclip m-r-5 f-s-18"></i> Attatchment</h5>
                                                <!--<form action="#" class="dropzone dz-clickable">-->
                                                    <div class="form-group ">
                                                        
                                                    </div>
                                                    <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                                                <!--</form>-->
        
                                            </div>
                                            <div class="text-left m-t-15">
                                                <button class="btn btn-primary m-b-30 m-t-15 f-s-14 p-l-20 p-r-20 m-r-10" type="submit" onclick="AutoMailFn()">
                                                    <i class="fa fa-paper-plane m-r-5"></i> Send</button>
                                                <button class="btn btn-dark m-b-30 m-t-15 f-s-14 p-l-20 p-r-20" type="button">
                                                    <i class="ti-close m-r-5 f-s-12"></i> Discard</button>
                                                    <input type="hidden" name="UserId" id="UserId" value="<?php echo $user_id; ?>" >
                                            </div>
                                        </form>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                function AutoMailFn(){
        	        var inputEmail1 	= $("#inputEmail1").val();
            		//var ccBcc 			= $("#ccBcc").val();
            		var inputSubject 	= $("#inputSubject").val();
            		var Message 		= $("#Message").val();
            		
            		if ( inputEmail1 == ""){
            			alert("Please Enter Email");
            			return false;			
            		}
            		//if ( ccBcc == ""){
            			
            			//alert("Please Enter CC / BCC");
            			//return false;			
            		//}
            		if ( inputSubject == ""){
            			alert("Please Enter Subject");
            			return false;			
            		}
            		if ( Message == ""){
            			alert("Please Enter Message");
            			return false;			
            		}
            		
            		if ( inputEmail1 != "" )
            		{				
            			if( !validateEmail(inputEmail1)) {				
            				 alert("Please Enter Valid Email Id");
            				 return false;			
            			}		
            		}		
            		
            		if ( ccBcc != "" )
            		{				
            			if( !validateEmail(ccBcc)) {				
            				 alert("Please Enter Valid Email Id");
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