<?php include"header.php"; 
\login\loginClass::Init();
$rows = \login\loginClass::GetUserFullName();
$i = 1;
foreach ($rows as $row) 
{
    $LoginFirstName=$row["first_name"];
    $LoginLastName=$row["last_name"];
    $LoginUserName=$row["user_id"];
    $LoginUserId=$row["id"];
    $ProfilePic=$row["image_file"];
}
$key=hash("sha256", $LoginUserName, false);

?>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_BASE_URL;?>assets/plugins/flexslider/css/flexslider.min.css">
  
  <div class="title-wrapper row">
   <div class="col">
     <div class="">
       <h2 class="page-title">Refer a Friend</h2>
     </div>
   </div>
   <div class="col">
   </div>
 </div>
  <div class="card">
    <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="flexslider thumb-slider">
              <ul class="slides">
                <li data-thumb="<?php echo SITE_BASE_URL;?>assets/img/mve_001.png">
                   <a class="image-expand" href="<?php echo SITE_BASE_URL;?>assets/img/advisor-slider.png" >
                       <img src="<?php echo SITE_BASE_URL;?>assets/img/advisor-slider.png" />
                    </a>
                </li>
                <li data-thumb="<?php echo SITE_BASE_URL;?>assets/img/flex-thumb.png">
                  <a class="image-expand" href="<?php echo SITE_BASE_URL;?>assets/img/advisor-slider.png" >
                      <img src="<?php echo SITE_BASE_URL;?>assets/img/advisor-slider.png" />
                  </a>
                </li>
                <li data-thumb="<?php echo SITE_BASE_URL;?>assets/img/mve_001.png">
                    <a class="image-expand" href="<?php echo SITE_BASE_URL;?>assets/img/advisor-slider.png" >
                      <img src="<?php echo SITE_BASE_URL;?>assets/img/advisor-slider.png" />
                      </a>
                </li>
                <li data-thumb="<?php echo SITE_BASE_URL;?>assets/img/flex-thumb.png">
                    <a class="image-expand" href="<?php echo SITE_BASE_URL;?>assets/img/advisor-slider.png" >
                      <img src="<?php echo SITE_BASE_URL;?>assets/img/advisor-slider.png" />
                      </a>
                </li>
              </ul>
            </div>
          </div>
          <?php                 
         \login\loginClass::Init();
        $rows = \login\loginClass::GetReferredCount();
        $i = 1;
        foreach ($rows as $row) 
        {
            $ReferredCount=$row["Count"];
        }
        $rows1 = \login\loginClass::GetReferredEarn();
        $i = 1;
        foreach ($rows1 as $row1) 
        {
            $ReferredEarn=$row1["Count"];
        }
        
         ?>  
          <div class="col-md-8">
            <div class="row no-gutters h-100">
              <div class="col-12 mt-4">
                <div class="refer-progress">
                  <ul class="row">
                    <div class="col-lg-3">
                      <div class="progress-box">
                        <h3 class="text-lg-two"><?php echo $ReferredEarn;?></h3>
                      </div>
                      <p class="text-center text-two mt-3">Total Points</p>
                    </div>
                    <div class="col-lg-3 offset-lg-3">
                      <div class="progress-box">
                        <h3 class="text-lg-two"><?php echo $ReferredCount;?></h3>
                      </div>
                      <p class="text-center text-two mt-3">Total Referred</p>
                    </div>
                    <div class="col-lg-3">
                      <div class="progress-box">
                        <h3 class="text-lg-two"><?php echo $ReferredCount;?></h3>
                      </div>
                      <p class="text-center text-two mt-3">Total Joined</p>
                    </div>
                  </ul>
                </div>
              </div>
              <div class="col-12 align-self-end mt-4">
                <div class="row">
                    <div class="col-12">
                      <h5 class="mb-3">Our rewards programmerecognises that your network is your net worth. Each time you refer a friend who joins the platform, we’ll award you 1,000 Du Val Club points plus US$10 credit to use towards your annual subscription fees</h5>
                    </div>
                <div>
                <div class="row">
                    <div class="col-12">
                      <h4 class="mb-3">Copy link & Share</h4>
                    </div>
                    <div class="col-md-5 form-group">
                      <input type="text" id="referLink" class="form-control" placeholder="<?php echo SITE_BASE_URL;?>login/register.html?ReferralCode=<?php echo $key;?>" value="<?php echo SITE_BASE_URL;?>login/register.html?ReferralCode=<?php echo $key;?>">
                    </div>
                    <div class="col-md-3 form-group">
                      <input type='hidden' id='Hashkey1' value='<?php echo $key;?>'>
                      <button type="" class="btn btn-outline-primary" onclick="copyText()">Copy</button>
                    </div>
                    <div class="col-md-3 form-group">
                      <button type="" class="btn btn-outline-primary" data-toggle="modal" data-target="#referFriend">Refer a Friend</button>
                    </div>
                    <div class="col-12">
                      <a href="#"><img src="<?php echo SITE_BASE_URL;?>assets/img/facebook.png" alt=""></a>
                      <a href="#"><img src="<?php echo SITE_BASE_URL;?>assets/img/linkedin.png" alt=""></a>
                      <a href="#"><img src="<?php echo SITE_BASE_URL;?>assets/img/twitter.png" alt=""></a>
                      <a href="#"><img src="<?php echo SITE_BASE_URL;?>assets/img/instagram.png" alt=""></a>
                      
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>    
  </div>


  <!-- Refer History-->
  <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col align-self-center">
            <h4 class="card-title">Refer History</h4>
          </div>
        </div>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="refer-history table">
               <thead>
                 <tr>
                  <td></td>
                  <td>Point you received</td>
                  <td>Refer Date</td>
                  <td>Joined Date</td>
                  <td>Stats</td>
                </tr>
               </thead>
               <tbody>
                 <?php          
                 $id= \settings\session\sessionClass::GetSessionDisplayName();
                \login\loginClass::Init();
                $rows = \login\loginClass::GetReferredFriends($id);
                $i = 1;
                foreach ($rows as $row) 
                {
                    $Users=$row["first_name"]." ".$row["last_name"];
                    $points=$row["points"];
                    $Image=$row["image_file"];
                    $createdOn=$row["created_on"];
                    $ReferredOn=$row["referred_date"];
                    $Status=$row["active_status"];
                    if($Image==''||$Image==null)
                    {
                        $Image='NoProfile.jpg';
                    }
                 ?>   
                <tr>
                    <td>
                      <div class="">
                          <a class="image-expand" href="<?php echo SITE_BASE_URL;?>uploads/ProfilePic/<?php echo $Image;?>" >
                              <img src="<?php echo SITE_BASE_URL;?>uploads/ProfilePic/<?php echo $Image;?>" class="img-fluid rounded-circle" alt=""> <?php echo $Users;?>
                          </a>
                      </div>
                    </td>
                   <td><?php echo $points;?></td>
                   <td><?php echo $ReferredOn;?></td>
                   <td><?php echo $createdOn;?></td>
                   <td><?php echo $Status;?></td>
                </tr>
                <?php
                $i=$i+1;
                }
                ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
  <!-- end available property -->
        <div class="modal fade dpo-modal" id="referFriend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content dpo-form">
              <div class="modal-header">
                <h5 class="modal-title" id="entityModalLabel">REFER FRIEND</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form action="<?php echo SITE_BASE_URL;?>Masters/Refer.html" method="post" name='form12'>    
                  <!-- refer frien section -->
                  <div class="card-body">
                      <div class="widget-title">
                        <h3>Refer To Your Friends</h3>
                        <input type='hidden' Name='Hashkey' value='<?php echo $key;?>'>
                      </div>
                      <form class="dpo-form">
                        <div class="input_fields_wrap">
                        
                          <div class="form-group">
                            <label>Friend's Email</label>
                            <input class="form-control" type="text" name="friend_email[]" placeholder="Email Address">
                          </div>
    
                        </div>
                        <button class="btn btn-info add_field_button">Add More Freind</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </form>
                    </div>       
                  <!-- end refer friend section -->
                  </form>
    
                   
                </div>
              </div>
          </div>
        </div>

<?php include"footer.php"; ?>

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/chartjs/Chart.bundle.js"></script>
<script>
//chart1
  new Chart(document.getElementById("doughnut-chart"), {
    type: 'doughnut',
    data: {
      labels: ["Available", "Not Available"],
      datasets: [
        {
          label: "Property Status)",
          backgroundColor: ["#85BE1A", "#C70000"],
          data: [30,70]
        }
      ]
    },
    responsive: true,
    options: {
      legend: {
        display: false
      },
      title: {
        display: false,
        text: 'Property Status'
      }
    }
});  
//linechart
var ctx = document.getElementById("lineChart");
   ctx.height = 100;
   var myChart = new Chart(ctx, {
       type: 'line',
       data: {
           labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
           type: 'line',
   
           datasets: [{
               label: "Property Status)",
                borderColor: "#ED6161",
                borderWidth: 1,
                pointBorderWidth: 5,
                pointHoverRadius: 5,
                borderDash: [5,0],
                backgroundColor: ["#85BE1A"],
                data: [80,70,50,90,50,20,40],
                fill: false,
           }]
       },
       options: {
           responsive: true,
           tooltips: {
               enabled: false,
           },
           legend: {
               display: false,
               labels: {
                   usePointStyle: false,
   
               },
   
   
           },
           scales: {
               xAxes: [{
                   display: true,
                   gridLines: {
                       display: true,
                       drawBorder: true
                   },
                   scaleLabel: {
                       display: false,
                       labelString: 'Month'
                   }
               }],
               yAxes: [{
                   display: true,
                   gridLines: {
                       display: true,
                       drawBorder: true
                   },
                   scaleLabel: {
                       display: true,
                       labelString: 'Value'
                   }
               }]
           },
           title: {
               display: false,
           }
       }
   });
   
  function copyText() {
  /* Get the text field */
  var copyText = document.getElementById("referLink");
  var Hashkey = document.getElementById("Hashkey1").value;
  //===================================================
  URL = "<?php echo SITE_BASE_URL;?>Masters/CopyText.html?ReferralCode=" + Hashkey;
  $.ajax({url: URL, success: function(result){
        if (result.trim() == "success"){
            //================================
        	    $.ajax({url: URL, success: function(result){
                    alert("copied Successfully");
                }});
        	 //===============================   
        }
        else{
            alert("Error while copy : \n" + result);
        }
    }});
  //=====================================================
  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  var btn = document.getElementById("copyBtn");

  btn.innerHTML = 'Copied';

  $("#copyBtn").addClass('newBtn');
}
</script>

<script src="<?php echo SITE_BASE_URL;?>assets/plugins/flexslider/js/flexslider.js"></script>
<script>
  $(document).ready(function() {
    $('.flexslider').flexslider({
      animation: "slide",
      controlNav: "thumbnails"
    });
  });
</script>



<!-- dataTables -->
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/datatables.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/cdn.datatables.net/buttons/1.2.2/js/vfs_fonts.js"></script>
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/datatables/datatables-init.js"></script>
<link rel="stylesheet" href="<?php echo SITE_BASE_URL;?>assets/plugins/magnific-popup/magnific-popup.css">
<script src="<?php echo SITE_BASE_URL;?>assets/plugins/magnific-popup/jquery.magnific-popup.js"></script>
<script>
   $('.data-table').dataTable({
       "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
       // dom: 'Bfrtip',
       // buttons: [
       //     'excelHtml5',
       //     'csvHtml5',
       //     'pdfHtml5'
       // ]
   });
   
   $('.data-table2').dataTable({
       "lengthMenu": [[5, 15, 50, -1], [5, 15, 50, "All"]],
       // dom: 'Bfrtip',
       // buttons: [
       //     'excelHtml5',
       //     'csvHtml5',
       //     'pdfHtml5'
       // ]
   });
</script>
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "567873720598282", // Facebook page ID
            call_to_action: "Message us", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "111194417371856", // Facebook page ID
            instagram: "web.duval", // Instagram username
            company_logo_url: "//static.getbutton.io/img/flag.png", // URL of company logo (png, jpg, gif)
            greeting_message: "Hello, how may we help you? Just send us a message now to get assistance.", // Text of greeting message
            call_to_action: "Message us", // Call to action
            button_color: "#FF6550", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "facebook,instagram", // Order of buttons
            ga: true, // Google Analytics enabled
            branding: false, // Show branding string
            mobile: true, // Mobile version enabled
            desktop: true, // Desktop version enabled
            greeting: false, // Greeting message enabled
            shift_vertical: 0, // Vertical position, px
            shift_horizontal: 0, // Horizontal position, px
            domain: "duvalportfolio.com", // site domain
            key: "pvMMPmkDSQOZE1auJh1mqg", // pro-widget key
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
    $('.image-expand').magnificPopup({
      type: 'image'
      // other options
    });

</script>
<!-- /GetButton.io widget -->