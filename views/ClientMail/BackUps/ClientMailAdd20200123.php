<?php include "header.php"; ?>
<?php
$Id 		= \ClientMail\ClientMailClass::$Id;
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
        <li class="list-group-item"><a href="#"><i class="fa fa-envelope"></i> &nbsp; alex@duvalprivateoffice.com</a></li>
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
						<tr class="unread">	
						  <td class="view-message ">Ticket No</td>				  
						  <td class="view-message ">Subject</td>				  
						  <td class="view-message  text-left">Description</td>
						</tr>
						<?php
							\ClientMail\ClientMailClass::Init();
							$rows = \ClientMail\ClientMailClass::GetDetailList();
							$i = 1;
							foreach ($rows as $row) 
							{
							?>					
							  <tr class="unread">							  
								  <td class="view-message"><?php echo $row["CONTACT_AUTO_ID"]; ?></td>
								  <td class="view-message"><?php echo $row["SUBJECT"]; ?></td>
								  <td class="view-message"><?php echo $row["DESCRIPTION"]; ?></td>						  
							  </tr>
								
							<?php					
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
							  <form action="<?php echo SITE_BASE_URL;?>/ClientMail/saveContact.html" method="post" class="form-horizontal" name='form1' >
								  <div class="form-group">
									  <label class="control-label">To</label>
									  <input type="text" placeholder="" name="inputEmail1" id="inputEmail1" class="form-control">
								  </div>
								  <div class="form-group">
									  <label class="control-label">Cc / Bcc</label>
									  <input type="text" placeholder="" name="ccBcc" id="ccBcc" class="form-control">
								  </div>
								  <div class="form-group">
									  <label class="control-label">Subject</label>
									  <input type="text" placeholder="" name="inputSubject" id="inputSubject" class="form-control">
								  </div>
								  <div class="form-group">
									  <label class="control-label">Message</label>
									  <textarea rows="10" cols="30" class="form-control" id="Message" name="Message"></textarea>
								  </div>

								  <div class="form-group pull-right">
									  <div class="col-12 ">
										  <!--<button class="btn btn-warning" type="submit">Save as draft</button>-->
										  <button class="btn btn-send" type="submit">Send</button>
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
<!-- end main content -->
<?php include"footer.php"; ?>