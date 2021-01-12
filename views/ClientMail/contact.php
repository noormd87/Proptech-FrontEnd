<?php
if (isset($_REQUEST['submitmessage'])) {

    $queryStr = "Insert Into user_advisor_message(user_id,advisor_id,subject,body, sent_by, msg_read)  values(:user_id, :advisor_id, :subject, :body, :sent_by, :msg_read)";
    $ColValarray = array(
        "user_id" => $_REQUEST['userId'],
        "advisor_id" => $_REQUEST['Advisor'],
        "subject" => $_REQUEST['subject'],
        "body" => $_REQUEST['message'],
        "sent_by" => 0,
        "msg_read" => 0
        );

    $Queryarray = array($queryStr, $ColValarray);
    $ArrQueries[] = $Queryarray;
    $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
    
    if ($Msg == "success") {

        $advisor_data = \DBConn\DBConnection::getQuery("select user_id from user_master where ID ='" . $Advisor . "' ");
        foreach ($advisor_data as $ad_index => $ad_row) {


            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: <info@duvalknowledge.co.nz>" . "\r\n";

            mail($ad_row['user_id'], 'New Message from User', 'Subject: ' . $_REQUEST['subject'] . '<br>Message: <br>' . $_REQUEST['message'], $headers);
        }

        $res = array(
            "msg"       => "success",
            "subject"   => $_REQUEST['subject'],
            "Message"   => $_REQUEST['message'],
            "fname"     => $_REQUEST['fname'],
            "lname"     => $_REQUEST['lname'],
            "profile"   => $_REQUEST['image']
        );
        echo json_encode($res);
        die();
    }
    else
    {
        $res = array(
            "msg"       => "error",
            "subject"   => null,
            "Message"   => null
        );
        echo json_encode($res);
        die();
    }
    // echo "abc";
    // die();
}
include"header.php";
$advisor_data = \DBConn\DBConnection::getQuery("select * from user_master where ID ='" . $portifolioAdvisorId . "' ");
foreach ($advisor_data as $ad_index => $ad_row) {
    // echo "<pre>";
    // print_r($ad_row);
    $ad_name = $ad_row['FIRST_NAME'] . " " . $ad_row['LAST_NAME'];
    $ad_email = $ad_row['user_name'];
    $ad_phone = $ad_row['PHONE_NO'];
    $ad_HMIHY = $ad_row['HMIHY_TEXT'];
    $ad_image = $ad_row['image_file'];
    $Advisor = $ad_row['ID'];
}
?>
<div class="inner-wrapper">


    <div class="panel panel-black panel-advisor pa-updated">
        <div class="panel-title">
            <h2>My Portfolio Advisor</h2>
        </div>
        <div class="panel-body">
            <h1><?= $LoginFirstName ?> <?= $LoginLastName ?></h1>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="dl-data">
                                <span>Email</span>
                                <?= $ad_email; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="dl-data">
                                <span>Location</span>
                                Auckland, New Zealand
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="dl-data">
                                <span>Working Hours</span>
                                Mon - Friday (8am - 5pm)
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="dl-data">
                                <span>Contact Number</span>
                                +64 <?= $ad_phone; ?>
                            </div>
                        </div>
                    </div>
                    <div class="well">
                        <h5>How I can help you</h5>
                        <p>Your dedicated Portfolio Advisor is on hand to help you get the most out of Du Val PropTech. Whether you are searching for a new property or you would like to do more with an investment you own, they are here to provide the guidance you need</p>
                    </div>
                    <button class="btn btn-green" onclick="$('#messagebox').show();"><i class="fas fa-envelope"></i> Get in touch with me</button>
                </div>
                <div class="col-md-4" style="align-self:center">
                    <img src="<?= SITE_BASE_URL; ?>dashboard/assets/images/advisor-client.png" class="img-fluid d-block ml-auto"/>
                </div>
            </div>
            <hr class="big-hr"/>

            <div class="message-center" id="messagebox" >
                <div class="row">
                    <div class="col-xl-6">
                        <div class="contact-box">
                            <form class="profile-form" accept-charset="utf-8"  action="#" method="post" name=form1 id=form1>
                                <h2>Contact Alex</h2>
                                <div class="row gutters-5">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">First Name*</label>
                                            <input type="text" class="form-control" id="fname" name="fname" readonly="" value="<?= $LoginFirstName ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lname">Last Name*</label>
                                            <input type="text" class="form-control" id="lname" name="lname" readonly="" value="<?= $LoginLastName ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="subject">Subject*</label>
                                            <input type="text" class="form-control" id="subject" name="subject">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="fname">Message</label>
                                            <textarea rows="5" class="form-control" required="" name="message" id="message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <input type="hidden" value="submit" name="submitmessage" >
                                        <input type="hidden" value="<?= $LoginUserId; ?>" name="userId" >
                                        <input type="hidden" value="<?= $Advisor;?>" name="Advisor" >
                                        <input type="hidden" value="<?= $ProfilePic; ?>" name="image">
                                        <button class="btn btn-orange" type="button" id="submitmessage">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <ul class="list-unstyled messages-history">
                            
                            <?php
                            $advisor_data = \DBConn\DBConnection::getQuery("select * from user_advisor_message where user_id ='" . $LoginUserId . "' ");
                            $advisor_id = '';
                            $i = 0;
                            // echo "hello world";
                            // echo $i;
                            // die();
                            foreach ($advisor_data as $ad_index => $ad_row)
                            {
                                $i++;
                                if ($ad_row['sent_by'] == 0) {
                                    $idd = $ad_row['user_id'];
                                    // user
                                } else {
                                    $idd = $ad_row['advisor_id'];
                                    // advisor
                                }
                                $advisor_id = $ad_row['advisor_id'];
                                $advisor_data1 = \DBConn\DBConnection::getQuery("select image_file,FIRST_NAME,LAST_NAME from user_master where ID ='" . $idd . "' ");
                                foreach ($advisor_data1 as $ad_index2 => $ad_row2) {
                                    $image_file = $ad_row2['image_file'];
                                    if ($image_file == '') {
                                        $image_file = SITE_BASE_URL . 'assets/images/user-pic.png';
                                    } else {
                                        $image_file = SITE_BASE_URL . 'uploads/ProfilePic/' . $image_file;
                                    }
                                    ?> 
                                    <li class="media <?= ($ad_row['sent_by'] == 0) ? 'outgoing' : 'incoming'; ?>" >
                                        <div class="media-body">
                                            <img src="<?= $image_file; ?>" class="mr-3" alt="">
                                            <div class="message_text">
                                                <h5 class="mt-0"><?= $ad_row2['FIRST_NAME'] ?> <?= $ad_row2['LAST_NAME'] ?> <span><?= $ad_row['subject'] ?></span></h5>
                                                <p><?= $ad_row['body'] ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                $Msg = \DBConn\DBConnection::exe_me("UPDATE user_advisor_message SET msg_read = 1 WHERE user_id = '".$LoginUserId."' AND advisor_id = '".$advisor_id."' AND sent_by = 1 ");;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- Inner Content End-->
<?php include"footer.php"; ?>

<script src="<?php echo SITE_BASE_URL; ?>assets/plugins/chartjs/Chart.bundle.js"></script>
<script>
$(document).ready(function(){
    <?php
    if($i > 0)
    {
        ?>
        $('.messages-history').animate({
            scrollTop: $(".messages-history li:last-child").offset().top
        }, 900);
        <?php
    }
    ?>
    
    $("#messagebox").hide();
    $("#submitmessage").click(function(){
        var formData = $("#form1").serialize();
        $.ajax({
            data: formData,
            url: "<?php echo SITE_BASE_URL; ?>ClientMail/contact.html",
            type: "post",
            success:function(response)
            {
                var res = $.parseJSON(response);
                if(res.msg == "success")
                {
                    var div = '<li class="media outgoing" >'+
                                '<div class="media-body">'+
                                    '<img src="<?= SITE_BASE_URL;?>uploads/ProfilePic/'+res.profile+'" class="mr-3" alt="">'+
                                    '<div class="message_text">'+
                                        '<h5 class="mt-0"> '+res.fname+' '+res.lname+' <span>'+res.subject+'</span></h5>'+
                                        '<p>'+res.Message+'</p>'+
                                    '</div>'+
                                '</div>'+
                            '</li>';
                    $(".messages-history").append(div);
                    $('.messages-history').animate({ scrollTop: $(".messages-history li:last-child").offset().top}, 900);
                    
                    $('#subject').val('');
                    $('#message').val('');
                }
                else
                {
                    alert("error");
                }
            }
        });
    });
});
</script>

