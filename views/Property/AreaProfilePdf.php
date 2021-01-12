<?php include "header.php"; 
\login\loginClass::Init();
$checkSession = \login\loginClass::CheckUserSessionIp();
?>
<?php
\Property\PropertyClass::Init();

?>
<!-- main content -->
<div class="content">
    
     <div class="row">
          <!-- property location  -->
          <div class="col-12 col-lg-12">
             <div  class="card">
               <div class="card-body">
                    <div class="widget-title mb-2">
                      <div class="d-inline-block card-title"><h4><?php echo $countryName; ?></h4></div>
                      
                      <div class="clearfix"></div>
                    </div>
                    
                    <?php
        
            
					//\Html\HtmlClass::Init();
					
					//echo \Html\HtmlClass::GetHeaderTemplate();
					//echo \Html\HtmlClass::GetSearchBar();
					//echo \Html\HtmlClass::GetSidebar();
					
					$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
					
					//$url = "https://www.duvaladvice.com/client/AreaProfile.html?d=1582696255&id=3&IsRoadMapPdf=Y"; 
					$url = "https://duvalknowledge.com/PropTech/Property/AreaProfile.html?IsPdf=Y";
					?>


					<?php
					
					try
					{
						// create the API client instance
						$client = new \Pdfcrowd\HtmlToPdfClient("demo", "ce544b6ea52a5621fb9d55f8b542d14d");
						
					   
						
						//echo $url; exit; 
					
						// run the conversion and write the result to a file
						$client->convertUrlToFile($url, "AreaProfile.pdf");
						
						echo "<a class='btn btn-sm btn-info' href='" . SITE_BASE_URL . "AreaProfile.pdf' target='_blank'>Download PDF</a>"; 
					}
					catch(\Pdfcrowd\Error $why)
					{
						// report the error
						error_log("Pdfcrowd Error: {$why}\n");
					
						// rethrow or handle the exception
						throw $why;
					}
					?>
                </div>
             </div>
          </div>
          <!-- end property location-->
          
       </div>
    
 

</div>
<!-- end main content -->
<?php include"footer.php"; ?>