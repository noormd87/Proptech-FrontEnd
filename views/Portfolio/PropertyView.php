<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<base href="<?php echo SITE_BASE_URL;?>">
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="images/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    DU VAL PRIVATE OFFICE
  </title>
  <style>
  input.textbox {
        text-transform: uppercase;
    }
  </style>
  
  <!--     Fonts and icons     -->
</head>
<body>
<div class="breadcrumb-area">
   <nav aria-label="breadcrumb" role="navigation">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="#">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">My Property</li>
      </ol>
   </nav>
</div>
<div class="content">
  <div class="widget-title pl-4">
 
    <!-- Login Form -->
    <form action="<?php echo SITE_BASE_URL;?>Masters/save.html" method="post" class="login-form" name='form1'>
        <div class="col-12">
             <div class="table-box bs-none">
                <div class="card-nav" id="fullscreen">
                   <nav class="navbar navbar-expand-sm bg-b1">
                     <ul class="navbar-nav mr-auto">
                       <li class="nav-list">
                         <a class="nav-link" href="#">My Property</a>
                       </li>
                     </ul>
                     <ul class="navbar-nav ml-auto">
                       <li class="nav-list">
                         <a class="nav-link requestfullscreen" href="#">
                             <img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/maxmize-icon.png" alt="Maximize">
                         </a>
                         <a href="#" class="exitfullscreen" style="display: none">
                            <img class="img-fluid" src="<?php echo SITE_BASE_URL;?>assets/img/minimize-icon.png" alt="Maximize">
                         </a>
                       </li>
                     </ul>
                   </nav>
                   <div class="table">
                      <table class="table">
                         <thead>
                               <tr>
                                  <th>ID</th>
                                  <th>UNIT NO</th>
                                  <th>STREET NO</th>
                                  <th>CITY</th>
                                  <th>STATE</th>
                                  <th>PINCODE</th>
                                  <th>PROPERTY TYPE</th>
                                  <th>BEDROOM</th>
                                  <th>BATHROOM</th>
                                  <th>CARSPACE</th>
                               </tr>
                         </thead>
                         <tbody>
                             <?php
                            \Portfolio\PortfolioClass::Init();
                            $rows = \Portfolio\PortfolioClass::GetPropertyViewDatas();
                            $i = 1;
                            foreach ($rows as $row) 
                            {
                            ?>
                            <tr>
                               <td><?php echo $row["auto_id"];?></td>
                               <td><?php echo $row["unit_no"];?></td>
                               <td><?php echo $row["street_no"];?></td>
                               <td><?php echo $row["city"];?></td>
                               <td><?php echo $row["state"];?></td>
                               <td><?php echo $row["pincode"];?></td>
                               <td><?php echo $row["property_type"];?></td>
                               <td><?php echo $row["bedroom"];?></td>
                               <td><?php echo $row["bathroom"];?></td>
                               <td><?php echo $row["carspace"];?></td>
                            </tr>
                            <?php
                            }?>
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
	</form>
</div>

</body>
</html>
<?php include"footer.php"; ?>