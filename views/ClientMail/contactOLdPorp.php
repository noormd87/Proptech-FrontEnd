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
                                <a href="<?php echo SITE_BASE_URL ?>ClientMail/compose.html" class="btn btn-primary btn-block">Compose</a>
                                <div class="mail-list mt-4">
                                    <a href="<?php echo SITE_BASE_URL ?>ClientMail/contact.html" class="list-group-item border-0 text-primary p-r-0">
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
                                        <img src="<?php echo SITE_BASE_URL ?>assets/img/avatar/1.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-success pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                    <div class="media p-t-15">
                                        <img src="<?php echo SITE_BASE_URL ?>assets/img/avatar/2.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-success pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                    <div class="media p-t-15">
                                        <img src="<?php echo SITE_BASE_URL ?>assets/img/avatar/3.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-warning pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                    <div class="media p-t-15">
                                        <img src="<?php echo SITE_BASE_URL ?>assets/img/avatar/4.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-warning pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                    <div class="media p-t-15">
                                        <img src="<?php echo SITE_BASE_URL ?>assets/img/avatar/5.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-danger pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                    <div class="media p-t-15">
                                        <img src="<?php echo SITE_BASE_URL ?>assets/img/avatar/6.jpg" class="mr-3 rounded-circle w-35px">
                                        <div class="media-body">
                                            <span class="fa fa-circle f-s-12 text-danger pull-right p-t-10"></span>
                                            <h6 class="m-b-0">John Tomas</h6>
                                            <p class="f-s-14 m-b-0">CEO</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="email-right-box">

                                <div role="toolbar" class="toolbar">
                                    <div class="btn-group m-b-20">
                                        <button class="btn btn-light" type="button">
                                            <div class="email-checkbox">
                                                <input type="checkbox" id="chk1">
                                                <label for="chk1" class="toggle"></label>
                                            </div>
                                        </button>
                                        <button class="btn btn-light" type="button">
                                            <i class="ti-reload text-muted f-s-14"></i>
                                        </button>
                                    </div>

                                    <div class="btn-group m-b-20">
                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-light dropdown-toggle" type="button">
                                            More
                                            <span class="caret m-l-5"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <span class="dropdown-header">More Option :</span>
                                            <a href="javascript: void(0);" class="dropdown-item">Mark as Unread</a>
                                            <a href="javascript: void(0);" class="dropdown-item">Add to Tasks</a>
                                            <a href="javascript: void(0);" class="dropdown-item">Add Star</a>
                                            <a href="javascript: void(0);" class="dropdown-item">Mute</a>
                                        </div>
                                    </div>
                                </div>
                                 <div class="email-list m-t-15">
                                 <?php
    							\ClientMail\ClientMailClass::Init();
    							$rows = \ClientMail\ClientMailClass::GetDetailList("","1",$user_id);
    							$i = 1;
    							foreach ($rows as $row) 
    							{
    							?>	  
                                    <div class="message">
                                        <a href="<?php echo $SITE_BASE_URL; ?>mailread.html?Id=<?php echo $row["CONTACT_TICKET_ID"]; ?>">
                                            <div class="col-mail col-mail-1">
                                                <div class="email-checkbox">
                                                    <input type="checkbox" id="chk1">
                                                    <label class="toggle" for="chk1"></label>
                                                </div>
                                                <span class="star-toggle ti-star"></span>
                                            </div>
                                            <div class="col-mail col-mail-2">
                                                <div class="subject"><b><?php echo $row["CONTACT_TO"]; ?>,</b>
                                                    <?php echo $row["SUBJECT"]; ?>
                                                </div>
                                                <div class="date"><?php echo $row["CREATED_DATE"]; ?></div>
                                            </div>
                                        </a>
                                    </div>
                                <?php
    							 $i++;
    							}
    							?>
                                </div>
                                <!-- panel -->

                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-left">1 - 20 of 568</div>
                                    </div>
                                    <div class="col-5">
                                        <div class="btn-group float-right">
                                            <button class="btn btn-gradient" type="button">
                                                <i class="fa fa-angle-left"></i>
                                            </button>
                                            <button class="btn btn-light" type="button">
                                                <i class="fa fa-angle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php include"footer.php"; ?>