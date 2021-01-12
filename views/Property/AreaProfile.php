
<!DOCTYPE html>
<html>
<head>
	<title>Subrub Static Report></title>
	<link rel="stylesheet" href="<?php echo SITE_BASE_URL;?>assets/bootstrap/css/bootstrap.min.css">

	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;523;600;700;800&display=swap" rel="stylesheet">

	<style type="text/css">
		body{
			font-family: 'Manrope', sans-serif;
			font-weight: 400;
			font-size: 16px;
			line-height: 28px;
			color: #000;
		}
		.h-1{
			font-size: 38px;
			line-height: 56px;
		}
		.h-2{
			font-size: 32px;
			line-height: 44px;
		}
		.h-3{
			font-size: 24px;
			line-height: 36px;
		}
		.h-4{
			font-size: 22px;
			line-height: 34px;
		}

		/*-------------------
		------- table -------
		-------------------*/
		.table td, .table th {
    		padding: .15rem .5rem;
    		border: 1px solid transparent;
    	}
    	.table-striped tbody tr:nth-of-type(odd) {
    		background-color: #E9F7EF ;
		}

		/*--------color---*/
		.bgc-primary{
			background-color: #FDEBD0;
		}
		.bgc-secondary{
			background-color: #D6EAF8;
		}
		.bgc-info{
			background-color: #AEB6BF;
		}
		.chart-wrapper{
			margin: 50px 30px;
		}
		.address{
			font-size: 13px;
			line-height: 16px;
			margin: 0;
		}
		.echart-wrapper{
			min-height: 400px;
		}
	</style>
</head>
<body>
	<header class="mb-5">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="page-logo">
						<img src="<?php echo SITE_BASE_URL;?>assets/corelogic.jpg" class="img-fluid" alt="">
					</div>
				</div>
				<div class="col-md-8 align-self-center">
					<div class="text-wrapper float-right">
						<p class="text-left address">Real Estate Investar Ltd <br>
PO Box 449, WHANGAPARAOA <br>
NTH 0930 NZL <br>
Ph: +64 27 283 6300 <br>
Email: sarahcorner77@yahoo.com.au</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</header>
	<!-- start main-->
	<!-- start container-->
	<div class="main">
		<div class="container">
			<!-- start wrapper -->
			<!-- area profile -->
			<!-- recent Median sales price -->
			<div class="wrapper">
				<div class="title-wrapper">
					<h2 class="h-2">Area Profile</h2>
				</div>
				<div class="text-wrapper mt-5">
					<p>The size of Mangere Bridge is approximately 6 square kilometres. <br>The population of Mangere Bridge in 2006 was 9,213 people. <br>
					By 2013 the population was 10,131 showing a population growth of 10.0% in the area during that time. <br>
					The predominant age group in Mangere Bridge is 0-9 years. <br>
					In general, people in Mangere Bridge work in a legislators, admin and managers occupation. <br>
					Currently the median sales price of houses in the area is $888,000.</p>
				</div>
				<div class="table-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Recent Median Sale Prices</h3>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead class="bgc-primary">
								<tr>
									<td></td>
									<td>MANGERE BRIDGE</td>
									<td>Auckland - Manukau</td>
								</tr>
								<tr>
									<th>Period </th>
									<th>Median Price </th>
									<th>Median Price</th>
								</tr>
							</thead>
							<tbody>
							    <?php //include_once("corelogic-json-test.php"); 
                                $LocationId = isset($_REQUEST["LocationId"]) ?  $_REQUEST["LocationId"] : ""; 
                                $StreetId = isset($_REQUEST["StreetId"]) ?  $_REQUEST["StreetId"] : ""; 
                                $ZipcodeId = isset($_REQUEST["ZipcodeId"]) ?  $_REQUEST["ZipcodeId"] : ""; 
                                
                                $MedianTablArr  =  \api\apiClass::ShowMedianTableValueApi($LocationId,$StreetId,$ZipcodeId); 
                                $OtherTablArr  =  \api\apiClass::ShowMedianTableValueApi("202972",$StreetId,$ZipcodeId); 
                                
                                // - Manukau
                                
                                //$OtherTablArr   = array("844,000", "850,000", "850,000", "845,000", "828,650", "817,000", "850,000", "827,000", "834,000", "837,000", "842,000", "832,000", "824,000");
                                
                                //print_r($MedianTablArr);
                                
                                $k = 0;
                                
                                $RecentMedialSalesArr1  = array();
                                $RecentMedialSalesArr2  = array();
                                $RecentMedialCatArr2    = array();
                                
                                 foreach($MedianTablArr as $MedianTabl){
                                        
                                    $Datas       = $MedianTabl["date"];
                                    $Datas2      = $MedianTabl["value"];
                                    $Datas3      = isset($OtherTablArr[$k]["value"]) ? $OtherTablArr[$k]["value"] : ""; 
                                    
                                    $RecentMedialSalesArr1[] = $Datas2;
                                    $RecentMedialSalesArr2[] = $Datas3;
                                    $RecentMedialCatArr2[]   = $Datas;
                                    
                                    $k++; 
                                ?>
                                    <tr>
                                       <td><?php echo $Datas; ?></td>
                                       <td>$ <?php echo $Datas2; ?></td>
                                       <td>$ <?php echo $Datas3; ?></td>
                                    </tr>
                                <?php
                                 }
                                ?>
                                
								<!--
								<tr>
									<td>January 2020</td>
									<td>$940,000</td>
									<td>$844,000</td>
								</tr>
								<tr>
									<td>December 2019 </td>
									<td>$885,000</td>
									<td>$850,000</td>
								</tr>
								<tr>
									<td>November 2019 </td>
									<td>$864,500</td>
									<td>$845,000</td>
								</tr>
								<tr>
									<td>October 2019 </td>
									<td>$850,000 </td>
									<td>$828,650</td>
								</tr>
								<tr>
									<td>September 2019 </td>
									<td>$885,000</td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>August 2019 </td>
									<td>$895,000 </td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>July 2019</td>
									<td>$825,500 </td>
									<td>$827,000</td>
								</tr>
								<tr>
									<td>June 2019</td>
									<td>$787,000</td>
									<td>$834,000</td>
								</tr>
								<tr>
									<td>May 2019</td>
									<td>$780,000</td>
									<td>$837,000</td>
								</tr>
								<tr>
									<td>April 2019</td>
									<td>$830,000</td>
									<td>$842,000</td>
								</tr>
								<tr>
									<td>March 2019</td>
									<td>$938,000 </td>
									<td>$832,000</td>
								</tr>
								<tr>
									<td>February 2019</td>
									<td>$879,000</td>
									<td>$824,000</td>
								</tr>
								-->
								
							</tbody>
						</table>
					</div>
				</div>
				<div class="chart-wrapper">
					<div id="recentMedianSales"></div>
				</div>
			</div><!-- end wrapper-->


			<!-- start wrapper -->
			<!-- Median Days on Market -->
			<div class="wrapper mt-5">
				<div class="title-wrapper">
					<h2 class="h-2">Median Days on Market</h2>
				</div>
				<div class="table-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Median Days On Market</h3>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead class="bgc-primary">
								<tr>
									<td></td>
									<td>MANGERE BRIDGE</td>
									<td>Auckland - Manukau</td>
								</tr>
								<tr>
									<th>Period </th>
									<th>Median Price </th>
									<th>Median Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>March 2020</td>
									<td>24</td>
									<td>23</td>
								</tr>
								<tr>
									<td>February 2020 </td>
									<td>24</td>
									<td>23</td>
								</tr>
								<tr>
									<td>January 2020 </td>
									<td>23</td>
									<td>24</td>
								</tr>
								<tr>
									<td>December 2019</td>
									<td>23</td>
									<td>24</td>
								</tr>
								<tr>
									<td>November 2019</td>
									<td>23</td>
									<td>24</td>
								</tr>
								<tr>
									<td>October 2019 </td>
									<td>23</td>
									<td>25</td>
								</tr>
								<tr>
									<td>September 2019</td>
									<td>23</td>
									<td>26</td>
								</tr>
								<tr>
									<td>August 2019</td>
									<td>23</td>
									<td>26</td>
								</tr>
								<tr>
									<td>July 2019</td>
									<td>23</td>
									<td>27</td>
								</tr>
								<tr>
									<td>June 2019</td>
									<td>23</td>
									<td>28</td>
								</tr>
								<tr>
									<td>May 2019</td>
									<td>23</td>
									<td>28</td>
								</tr>
								<tr>
									<td>April 2019</td>
									<td>23</td>
									<td>29</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="chart-wrapper">
					<div id="medianDays"></div>
				</div>
			</div><!-- end wrapper-->



			<!-- start wrapper -->
			<!-- Median Days on Market Land -->
			<div class="wrapper mt-5">
				<div class="table-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Median Days On Market (Land)</h3>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead class="bgc-primary">
								<tr>
									<td></td>
									<td>MANGERE BRIDGE</td>
									<td>Auckland - Manukau</td>
								</tr>
								<tr>
									<th>Period </th>
									<th>Median Price </th>
									<th>Median Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>January 2020</td>
									<td>$940,000</td>
									<td>$844,000</td>
								</tr>
								<tr>
									<td>December 2019 </td>
									<td>$885,000</td>
									<td>$850,000</td>
								</tr>
								<tr>
									<td>November 2019 </td>
									<td>$864,500</td>
									<td>$845,000</td>
								</tr>
								<tr>
									<td>October 2019 </td>
									<td>$850,000 </td>
									<td>$828,650</td>
								</tr>
								<tr>
									<td>September 2019 </td>
									<td>$885,000</td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>August 2019 </td>
									<td>$895,000 </td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>July 2019</td>
									<td>$825,500 </td>
									<td>$827,000</td>
								</tr>
								<tr>
									<td>June 2019</td>
									<td>$787,000</td>
									<td>$834,000</td>
								</tr>
								<tr>
									<td>May 2019</td>
									<td>$780,000</td>
									<td>$837,000</td>
								</tr>
								<tr>
									<td>April 2019</td>
									<td>$830,000</td>
									<td>$842,000</td>
								</tr>
								<tr>
									<td>March 2019</td>
									<td>$938,000 </td>
									<td>$832,000</td>
								</tr>
								<tr>
									<td>February 2019</td>
									<td>$879,000</td>
									<td>$824,000</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="chart-wrapper">
					<div id="medianDaysLand"></div>
				</div>
			</div><!-- end wrapper-->


			<!-- start wrapper -->
			<!-- Sales Per Annum -->
			<div class="wrapper mt-5">
				<div class="title-wrapper">
					<h2 class="h-2">Sales Per Annum</h2>
				</div>
				<div class="table-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Sales Per Annum</h3>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead class="bgc-primary">
								<tr>
									<td></td>
									<td>MANGERE BRIDGE</td>
									<td>Auckland - Manukau</td>
								</tr>
								<tr>
									<th>Period </th>
									<th>Median Price </th>
									<th>Median Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>January 2020</td>
									<td>$940,000</td>
									<td>$844,000</td>
								</tr>
								<tr>
									<td>December 2019 </td>
									<td>$885,000</td>
									<td>$850,000</td>
								</tr>
								<tr>
									<td>November 2019 </td>
									<td>$864,500</td>
									<td>$845,000</td>
								</tr>
								<tr>
									<td>October 2019 </td>
									<td>$850,000 </td>
									<td>$828,650</td>
								</tr>
								<tr>
									<td>September 2019 </td>
									<td>$885,000</td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>August 2019 </td>
									<td>$895,000 </td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>July 2019</td>
									<td>$825,500 </td>
									<td>$827,000</td>
								</tr>
								<tr>
									<td>June 2019</td>
									<td>$787,000</td>
									<td>$834,000</td>
								</tr>
								<tr>
									<td>May 2019</td>
									<td>$780,000</td>
									<td>$837,000</td>
								</tr>
								<tr>
									<td>April 2019</td>
									<td>$830,000</td>
									<td>$842,000</td>
								</tr>
								<tr>
									<td>March 2019</td>
									<td>$938,000 </td>
									<td>$832,000</td>
								</tr>
								<tr>
									<td>February 2019</td>
									<td>$879,000</td>
									<td>$824,000</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="chart-wrapper">
					<div id="salesAnnum"></div>
				</div>
			</div><!-- end wrapper-->


			<!-- start wrapper -->
			<!-- Sales Per Annum Land -->
			<div class="wrapper mt-5">
				<div class="table-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Sales Per Annum (Land)</h3>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead class="bgc-primary">
								<tr>
									<td></td>
									<td>MANGERE BRIDGE</td>
									<td>Auckland - Manukau</td>
								</tr>
								<tr>
									<th>Period </th>
									<th>Median Price </th>
									<th>Median Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>January 2020</td>
									<td>$940,000</td>
									<td>$844,000</td>
								</tr>
								<tr>
									<td>December 2019 </td>
									<td>$885,000</td>
									<td>$850,000</td>
								</tr>
								<tr>
									<td>November 2019 </td>
									<td>$864,500</td>
									<td>$845,000</td>
								</tr>
								<tr>
									<td>October 2019 </td>
									<td>$850,000 </td>
									<td>$828,650</td>
								</tr>
								<tr>
									<td>September 2019 </td>
									<td>$885,000</td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>August 2019 </td>
									<td>$895,000 </td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>July 2019</td>
									<td>$825,500 </td>
									<td>$827,000</td>
								</tr>
								<tr>
									<td>June 2019</td>
									<td>$787,000</td>
									<td>$834,000</td>
								</tr>
								<tr>
									<td>May 2019</td>
									<td>$780,000</td>
									<td>$837,000</td>
								</tr>
								<tr>
									<td>April 2019</td>
									<td>$830,000</td>
									<td>$842,000</td>
								</tr>
								<tr>
									<td>March 2019</td>
									<td>$938,000 </td>
									<td>$832,000</td>
								</tr>
								<tr>
									<td>February 2019</td>
									<td>$879,000</td>
									<td>$824,000</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="chart-wrapper">
					<div id="salesAnnumLand"></div>
				</div>
			</div><!-- end wrapper-->


			<!-- start wrapper -->
			<!-- Sales Price / CV Ratio -->
			<div class="wrapper mt-5">
				<div class="title-wrapper">
					<h2 class="h-2">Sales Price / CV Ratio</h2>
				</div>
				<div class="table-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Sales Price / CV Ratio</h3>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead class="bgc-primary">
								<tr>
									<td></td>
									<td>MANGERE BRIDGE</td>
									<td>Auckland - Manukau</td>
								</tr>
								<tr>
									<th>Period </th>
									<th>Median Price </th>
									<th>Median Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>January 2020</td>
									<td>$940,000</td>
									<td>$844,000</td>
								</tr>
								<tr>
									<td>December 2019 </td>
									<td>$885,000</td>
									<td>$850,000</td>
								</tr>
								<tr>
									<td>November 2019 </td>
									<td>$864,500</td>
									<td>$845,000</td>
								</tr>
								<tr>
									<td>October 2019 </td>
									<td>$850,000 </td>
									<td>$828,650</td>
								</tr>
								<tr>
									<td>September 2019 </td>
									<td>$885,000</td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>August 2019 </td>
									<td>$895,000 </td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>July 2019</td>
									<td>$825,500 </td>
									<td>$827,000</td>
								</tr>
								<tr>
									<td>June 2019</td>
									<td>$787,000</td>
									<td>$834,000</td>
								</tr>
								<tr>
									<td>May 2019</td>
									<td>$780,000</td>
									<td>$837,000</td>
								</tr>
								<tr>
									<td>April 2019</td>
									<td>$830,000</td>
									<td>$842,000</td>
								</tr>
								<tr>
									<td>March 2019</td>
									<td>$938,000 </td>
									<td>$832,000</td>
								</tr>
								<tr>
									<td>February 2019</td>
									<td>$879,000</td>
									<td>$824,000</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="chart-wrapper">
					<div id="salesPriceCV"></div>
				</div>
			</div><!-- end wrapper-->


			<!-- start wrapper -->
			<!-- Sales Price / CV Ratio Land -->
			<div class="wrapper mt-5">
				<div class="table-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Sales Price / CV Ratio (Land)</h3>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead class="bgc-primary">
								<tr>
									<td></td>
									<td>MANGERE BRIDGE</td>
									<td>Auckland - Manukau</td>
								</tr>
								<tr>
									<th>Period </th>
									<th>Median Price </th>
									<th>Median Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>January 2020</td>
									<td>$940,000</td>
									<td>$844,000</td>
								</tr>
								<tr>
									<td>December 2019 </td>
									<td>$885,000</td>
									<td>$850,000</td>
								</tr>
								<tr>
									<td>November 2019 </td>
									<td>$864,500</td>
									<td>$845,000</td>
								</tr>
								<tr>
									<td>October 2019 </td>
									<td>$850,000 </td>
									<td>$828,650</td>
								</tr>
								<tr>
									<td>September 2019 </td>
									<td>$885,000</td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>August 2019 </td>
									<td>$895,000 </td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>July 2019</td>
									<td>$825,500 </td>
									<td>$827,000</td>
								</tr>
								<tr>
									<td>June 2019</td>
									<td>$787,000</td>
									<td>$834,000</td>
								</tr>
								<tr>
									<td>May 2019</td>
									<td>$780,000</td>
									<td>$837,000</td>
								</tr>
								<tr>
									<td>April 2019</td>
									<td>$830,000</td>
									<td>$842,000</td>
								</tr>
								<tr>
									<td>March 2019</td>
									<td>$938,000 </td>
									<td>$832,000</td>
								</tr>
								<tr>
									<td>February 2019</td>
									<td>$879,000</td>
									<td>$824,000</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="chart-wrapper">
					<div id="salesPriceCVLand"></div>
				</div>
			</div><!-- end wrapper-->


			<!-- start wrapper -->
			<!-- Change in Median Price -->
			<div class="wrapper mt-5">
				<div class="title-wrapper">
					<h2 class="h-2">Change in Median Price</h2>
				</div>
				<div class="table-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Change in Median Price</h3>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead class="bgc-primary">
								<tr>
									<td></td>
									<td>MANGERE BRIDGE</td>
									<td>Auckland - Manukau</td>
								</tr>
								<tr>
									<th>Period </th>
									<th>Median Price </th>
									<th>Median Price</th>
								</tr>
							</thead>
							<tbody>
							    <?php 
							    /*
							    $MedianTablArr  =  \api\apiClass::ShowMedianTableValueApi($LocationId,$StreetId,$ZipcodeId); 
                                $OtherTablArr  =  \api\apiClass::ShowMedianTableValueApi("202972",$StreetId,$ZipcodeId); 
                                
                                // - Manukau
                                
                                //$OtherTablArr   = array("844,000", "850,000", "850,000", "845,000", "828,650", "817,000", "850,000", "827,000", "834,000", "837,000", "842,000", "832,000", "824,000");
                                
                                //print_r($MedianTablArr);
                                
                                $k = 0;
                                
                                $RecentMedialSalesArr1  = array();
                                $RecentMedialSalesArr2  = array();
                                $RecentMedialCatArr2    = array();
                                
                                 foreach($MedianTablArr as $MedianTabl){
                                        
                                    $Datas       = $MedianTabl["date"];
                                    $Datas2      = $MedianTabl["value"];
                                    $Datas3      = isset($OtherTablArr[$k]["value"]) ? $OtherTablArr[$k]["value"] : ""; 
                                    
                                    $RecentMedialSalesArr1[] = $Datas2;
                                    $RecentMedialSalesArr2[] = $Datas3;
                                    $RecentMedialCatArr2[]   = $Datas;
							    */
                                $MedianTablArr  =  \api\apiClass::ChangeMedianPriceTableVal($LocationId,$StreetId,$ZipcodeId); 
                                $OtherTablArr   =  \api\apiClass::ChangeMedianPriceTableVal("202972",$StreetId,$ZipcodeId); 
                                
                                $ChangeMeidanPriceArr1  = array(); 
                                $ChangeMeidanPriceArr2  = array(); 
                                $ChangeMeidanCatArr2    = array(); 
                                
                                 foreach($MedianTablArr as $MedianTabl){
                                        
                                        $Datas       = $MedianTabl["date"];
                                        $Datas2      = $MedianTabl["value"];
                                        $Datas3      = isset($OtherTablArr[$k]["value"]) ? $OtherTablArr[$k]["value"] : ""; 
                                        
                                        $ChangeMeidanPriceArr1[] = $Datas2;
                                        $ChangeMeidanPriceArr2[] = $Datas3;
                                        $ChangeMeidanCatArr2[]   = $Datas;
                                ?>
                                    <tr>
                                       <td><?php echo $Datas; ?></td>
                                       <td><?php echo $Datas2; ?> %</td>
                                       <td><?php echo $Datas3; ?> %</td>
                                    </tr>
                                <?php
                                 }
                                ?>
                                
                                <!--
								<tr>
									<td>January 2020</td>
									<td>$940,000</td>
									<td>$844,000</td>
								</tr>
								<tr>
									<td>December 2019 </td>
									<td>$885,000</td>
									<td>$850,000</td>
								</tr>
								<tr>
									<td>November 2019 </td>
									<td>$864,500</td>
									<td>$845,000</td>
								</tr>
								<tr>
									<td>October 2019 </td>
									<td>$850,000 </td>
									<td>$828,650</td>
								</tr>
								<tr>
									<td>September 2019 </td>
									<td>$885,000</td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>August 2019 </td>
									<td>$895,000 </td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>July 2019</td>
									<td>$825,500 </td>
									<td>$827,000</td>
								</tr>
								<tr>
									<td>June 2019</td>
									<td>$787,000</td>
									<td>$834,000</td>
								</tr>
								<tr>
									<td>May 2019</td>
									<td>$780,000</td>
									<td>$837,000</td>
								</tr>
								<tr>
									<td>April 2019</td>
									<td>$830,000</td>
									<td>$842,000</td>
								</tr>
								<tr>
									<td>March 2019</td>
									<td>$938,000 </td>
									<td>$832,000</td>
								</tr>
								<tr>
									<td>February 2019</td>
									<td>$879,000</td>
									<td>$824,000</td>
								</tr>
								-->
							</tbody>
						</table>
					</div>
				</div>
				<div class="chart-wrapper">
					<div id="changeMedianPrice"></div>
				</div>
			</div><!-- end wrapper-->


			<!-- start wrapper -->
			<!-- Change in Median Price (Land) -->
			<div class="wrapper mt-5">
				<div class="table-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Change in Median Price (Land)</h3>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead class="bgc-primary">
								<tr>
									<td></td>
									<td>MANGERE BRIDGE</td>
									<td>Auckland - Manukau</td>
								</tr>
								<tr>
									<th>Period </th>
									<th>Median Price </th>
									<th>Median Price</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>January 2020</td>
									<td>$940,000</td>
									<td>$844,000</td>
								</tr>
								<tr>
									<td>December 2019 </td>
									<td>$885,000</td>
									<td>$850,000</td>
								</tr>
								<tr>
									<td>November 2019 </td>
									<td>$864,500</td>
									<td>$845,000</td>
								</tr>
								<tr>
									<td>October 2019 </td>
									<td>$850,000 </td>
									<td>$828,650</td>
								</tr>
								<tr>
									<td>September 2019 </td>
									<td>$885,000</td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>August 2019 </td>
									<td>$895,000 </td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>July 2019</td>
									<td>$825,500 </td>
									<td>$827,000</td>
								</tr>
								<tr>
									<td>June 2019</td>
									<td>$787,000</td>
									<td>$834,000</td>
								</tr>
								<tr>
									<td>May 2019</td>
									<td>$780,000</td>
									<td>$837,000</td>
								</tr>
								<tr>
									<td>April 2019</td>
									<td>$830,000</td>
									<td>$842,000</td>
								</tr>
								<tr>
									<td>March 2019</td>
									<td>$938,000 </td>
									<td>$832,000</td>
								</tr>
								<tr>
									<td>February 2019</td>
									<td>$879,000</td>
									<td>$824,000</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="chart-wrapper">
					<div id="changeMedianPriceLand"></div>
				</div>
			</div><!-- end wrapper-->

			<!-- start wrapper -->
			<!-- Household  -->
			<div class="wrapper mt-5">
				<div class="title-wrapper">
					<h2 class="h-2">Household</h2>
					<h3 class="h-3 text-center mt-5 mb-4">Household Structure</h3>
				</div>
				<div class="chart-wrapper">
					<div id="housholdChart" class="echart-wrapper"></div>
					
				    <?php
				    /*
				    data:['Direct','Mail','Affiliate','AD','Search']
            		 },
            		 calculable : true,
            		 series : [
            		     {
            		         name:'Source',
            		         type:'pie',
            		         radius : '55%',
            		         center: ['50%', '60%'],
            		         data:[
            		             {value:335, name:'Direct'},
            		             {value:310, name:'Mail'},
            		             {value:234, name:'Affiliate'},
            		             {value:135, name:'AD'},
            		             {value:1548, name:'Search'}
            		         ]
				    */
				    $TempMedianData = \api\apiClass::GetCensusHouseholdApiDatas("formap", $LocationId, "8", "118");
				    
				    
            
            		$houseHoldArr1       = $TempMedianData["dateTime"];
            		$houseHoldArr2       = $TempMedianData["values"];
            		$houseHoldArr3       = $TempMedianData["values2"];
            		
            		//echo "<pre>"; print_r($TempMedianData); echo "</pre>";
            
            		//echo json_encode($FinalArr);  
            		
            		//exit();
            
            		$houseHoldDatas = implode(",", $houseHoldArr2) ; 
            		$houseHoldDatas2 = implode(",", $houseHoldArr3) ; 
            		
            		/*[
		             {value:335, name:'Direct'},
		             {value:310, name:'Mail'},
		             {value:234, name:'Affiliate'},
		             {value:135, name:'AD'},
		             {value:1548, name:'Search'}
		         ]*/
		         
		            //$HouseholdJsonArr   = array(); 
		            $HouseholdJsonStr = "";
		            $k = 0;
		            
		            foreach($houseHoldArr1 as $name){
		                $value = $houseHoldArr2[$k];
		                $k++;
		                
		                //$HouseholdJsonArr[] = array("value" => $value, "name" => $name);
		                $TempStr            = "{value:{$value}, name:'{$name}'}";
		                
		                if ($HouseholdJsonStr != "")
		                    $HouseholdJsonStr   .= ",";
		                    
		                $HouseholdJsonStr .= $TempStr; 
		            }
		            
		            //$HouseholdJsonStr   = json_encode($HouseholdJsonArr); 
		            
		            //echo $HouseholdJsonStr;
		            
            		$houseHoldCategories = "'" . implode("','", $houseHoldArr1) . "'"; 
				    ?>
		            <?php //echo \api\apiClass::ShowCensusHouseholdMapApi("formap", $LocationId, "8", "118"); ?>
				</div>
			</div><!-- end wrapper-->


			<!-- start wrapper -->
			<!-- Age Ratio  -->
			<div class="wrapper mt-5">
				<div class="title-wrapper">
					<h2 class="h-2">Age Ratio</h2>
					<h3 class="h-3 text-center mt-5 mb-4">Age Ratio</h3>
				</div>
				<div class="chart-wrapper">
					<div id="ageRatioChart"></div>
				</div>
			</div><!-- end wrapper-->


			<!-- start wrapper -->
			<!-- Household Income -->
			<div class="wrapper mt-5">
				<div class="title-wrapper">
					<h2 class="h-2">Household Income</h2>
				</div>
				<div class="table-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Household Income</h3>
					<div class="table-responsive">
						<table class="table table-striped">
							<thead class="bgc-primary">
								<tr>
									<th>Income Range</th>
									<th>MANGERE BRIDGE %</th>
									<th>Auckland - Manukau %</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>January 2020</td>
									<td>$940,000</td>
									<td>$844,000</td>
								</tr>
								<tr>
									<td>December 2019 </td>
									<td>$885,000</td>
									<td>$850,000</td>
								</tr>
								<tr>
									<td>November 2019 </td>
									<td>$864,500</td>
									<td>$845,000</td>
								</tr>
								<tr>
									<td>October 2019 </td>
									<td>$850,000 </td>
									<td>$828,650</td>
								</tr>
								<tr>
									<td>September 2019 </td>
									<td>$885,000</td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>August 2019 </td>
									<td>$895,000 </td>
									<td>$817,000</td>
								</tr>
								<tr>
									<td>July 2019</td>
									<td>$825,500 </td>
									<td>$827,000</td>
								</tr>
								<tr>
									<td>June 2019</td>
									<td>$787,000</td>
									<td>$834,000</td>
								</tr>
								<tr>
									<td>May 2019</td>
									<td>$780,000</td>
									<td>$837,000</td>
								</tr>
								<tr>
									<td>April 2019</td>
									<td>$830,000</td>
									<td>$842,000</td>
								</tr>
								<tr>
									<td>March 2019</td>
									<td>$938,000 </td>
									<td>$832,000</td>
								</tr>
								<tr>
									<td>February 2019</td>
									<td>$879,000</td>
									<td>$824,000</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="chart-wrapper">
					<div id="householdIncome"></div>
				</div>
			</div><!-- end wrapper-->


			<!-- start wrapper -->
			<!-- Suburb Occupation  -->
			<div class="wrapper mt-5">
				<div class="title-wrapper">
					<h2 class="h-2">Suburb Occupation</h2>
					<h3 class="h-3 text-center mt-5 mb-4">Education By Qualification</h3>
				</div>
				<div class="chart-wrapper">
					<div id="educationQualifucation" class="echart-wrapper"></div>
				</div>
				<div class="title-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Employment Occupation</h3>
				</div>
				<div class="chart-wrapper">
					<div id="employmentOccupation" class="echart-wrapper"></div>
				</div>
				<div class="title-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Employment Level</h3>
				</div>
				<div class="chart-wrapper">
					<div id="employmentLevel" class="echart-wrapper"></div>
				</div>
			</div><!-- end wrapper-->



			<!-- start wrapper -->
			<!-- Rental Statistics -->
			<div class="wrapper mt-5">
				<div class="title-wrapper">
					<h2 class="h-2">Rental Statistics</h2>
					<h3 class="h-3 text-center mt-5 mb-4">Median Rent</h3>
				</div>
				<div class="chart-wrapper">
					<div id="medianrent"></div>
				</div>
				<div class="title-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Rental Rate Observations</h3>
				</div>
				<div class="chart-wrapper">
					<div id="rentalRate"></div>
				</div>

				<div class="title-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Change in Rental Rate</h3>
				</div>
				<div class="chart-wrapper">
					<div id="changeRentalRate"></div>
				</div>

				<div class="title-wrapper">
					<h3 class="h-3 text-center mt-5 mb-4">Value Based Gross Rental Yield</h3>
				</div>
				<div class="chart-wrapper">
					<div id="rentalYield"></div>
				</div>
			</div><!-- end wrapper-->

		</div><!-- end container-->
	</div><!-- end main-->
	<footer></footer>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->


	<!-- apexchart -->
	<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/apexchart/apexchart.js"></script>

	<!-- e-chart -->
	<script type="text/javascript" src="<?php echo SITE_BASE_URL;?>assets/echart/echarts.js"></script>

	<script type="text/javascript">
	/*
	$RecentMedialSalesArr1[] = $Datas2;
    $RecentMedialSalesArr2[] = $Datas3;
    $RecentMedialCatArr2[]   = $Datas;
	*/
		//Recent Median Sales Price
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [<?php echo implode(",", $RecentMedialSalesArr1); ?>]
		        /*data: [844000, 850000, 845000, 828650, 817000, 817000, 827000, 834000, 837000, 842000, 832000, 824000]*/
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [<?php echo implode(",", $RecentMedialSalesArr2); ?>]
		        /*data: [940000, 885000, 864500, 850000, 885000, 895000, 825500, 787000, 780000, 830000, 938000, 879000]*/

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#5DADE2', '#E74C3C'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: [<?php echo "\"" . implode("\", \"", $RecentMedialCatArr2) . "\""; ?>],
		        /*categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],*/
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Recent Median Sale Prices",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Sale Prices',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#recentMedianSales"), options);
		chart.render();


		//Median Days On Market
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#7C1212', '#DDB85E'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#medianDays"), options);
		chart.render();



		//Median Days On Market (Land)
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#FAEB01', '#FA0101'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#medianDaysLand"), options);
		chart.render();


		//Sales Per Annum
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#1B4F72', '#7FB3D5'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#salesAnnum"), options);
		chart.render();


		//Sales Per Annum (Land)
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#0B5345', '#73C6B6'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#salesAnnumLand"), options);
		chart.render();
	


		//Sales Price / CV Ratio
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#7D6608', '#F5B041'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#salesPriceCV"), options);
		chart.render();


		//Sales Price / CV Ratio (Land)
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#229954', '#E74C3C'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#salesPriceCVLand"), options);
		chart.render();

		//Change in Median Price
		//$ChangeMeidanPriceArr1
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [<?php echo implode(",", $RecentMedialSalesArr1); ?>]
		        /*data: [23, 23,23,23,23,23,23,23,23,23,24,24]*/
		        
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [<?php echo implode(",", $RecentMedialSalesArr2); ?>]
		        /*data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]*/

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#2E86C1', '#E74C3C'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: [<?php echo "\"" . implode("\", \"", $RecentMedialCatArr2) . "\""; ?>],
		        /*categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],*/
		        
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#changeMedianPrice"), options);
		chart.render();


		//Change in Median Price (Land)
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#641E16', '#C39BD3'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#changeMedianPriceLand"), options);
		chart.render();



		//Household Structure
		var dom = document.getElementById("housholdChart");
		var bpChart = echarts.init(dom);
		
		/*
		//echo $HouseholdJsonStr;
		            
            		$houseHoldCategories = "'" . implode("','", $houseHoldArr1) . "'"; 
		*/

		var app = {};
		option = null;
		option = {
		 color: ['#62549a','#4aa9e9', '#ff6c60','#eac459', '#25c3b2' ],
		 tooltip : {
		     trigger: 'item',
		     formatter: '{a} <br/>{b} : {c} ({d}%)'
		 },
		 legend: {
		     orient : 'vertical',
		     x : 'left',
		     data:[<?php echo $houseHoldCategories; ?>]
		     /*data:['Direct','Mail','Affiliate','AD','Search']*/
		     
		 },
		 calculable : true,
		 series : [
		     {
		         name:'Source',
		         type:'pie',
		         radius : '55%',
		         center: ['50%', '60%'],
		         data: [<?php echo $HouseholdJsonStr; ?>]
		         /*
		         data:[
		             {value:335, name:'Direct'},
		             {value:310, name:'Mail'},
		             {value:234, name:'Affiliate'},
		             {value:135, name:'AD'},
		             {value:1548, name:'Search'}
		         ]
		         */
		         
		     }
		 ]
		};

		if (option && typeof option === "object") {
		 bpChart.setOption(option, false);
		}
		
		
		

		//Age Ratio
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#5DADE2', '#E74C3C'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#ageRatioChart"), options);
		chart.render();


		//Household Income
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#3498DB', '#E74C3C'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#householdIncome"), options);
		chart.render();


		//Education By Qualification
		var dom = document.getElementById("educationQualifucation");
		var bpChart = echarts.init(dom);

		var app = {};
		option = null;
		option = {
		 color: ['#62549a','#4aa9e9', '#ff6c60','#eac459', '#25c3b2' ],
		 tooltip : {
		     trigger: 'item',
		     formatter: '{a} <br/>{b} : {c} ({d}%)'
		 },
		 legend: {
		     orient : 'vertical',
		     x : 'left',
		     data:['Direct','Mail','Affiliate','AD','Search']
		 },
		 calculable : true,
		 series : [
		     {
		         name:'Source',
		         type:'pie',
		         radius : '55%',
		         center: ['50%', '60%'],
		         data:[
		             {value:335, name:'Direct'},
		             {value:310, name:'Mail'},
		             {value:234, name:'Affiliate'},
		             {value:135, name:'AD'},
		             {value:1548, name:'Search'}
		         ]
		     }
		 ]
		};

		if (option && typeof option === "object") {
		 bpChart.setOption(option, false);
		}


		//Employment Occupation
		var dom = document.getElementById("employmentOccupation");
		var bpChart = echarts.init(dom);

		var app = {};
		option = null;
		option = {
		 color: ['#62549a','#4aa9e9', '#ff6c60','#eac459', '#25c3b2' ],
		 tooltip : {
		     trigger: 'item',
		     formatter: '{a} <br/>{b} : {c} ({d}%)'
		 },
		 legend: {
		     orient : 'vertical',
		     x : 'left',
		     data:['Direct','Mail','Affiliate','AD','Search']
		 },
		 calculable : true,
		 series : [
		     {
		         name:'Source',
		         type:'pie',
		         radius : '55%',
		         center: ['50%', '60%'],
		         data:[
		             {value:335, name:'Direct'},
		             {value:310, name:'Mail'},
		             {value:234, name:'Affiliate'},
		             {value:135, name:'AD'},
		             {value:1548, name:'Search'}
		         ]
		     }
		 ]
		};

		if (option && typeof option === "object") {
		 bpChart.setOption(option, false);
		}


		//Employment Level
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }, {
		        name: 'Auckland - Manukau',
		        type: 'line',
		        data: [29, 28, 28, 27, 26, 26, 25, 24, 24, 24, 24,23]

		    }],
		    chart: {
		        height: 450,
		        type: 'line',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#F1C40F', '#E74C3C'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#employmentLevel"), options);
		chart.render();


		//Median Rent
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }],
		    chart: {
		        height: 450,
		        type: 'bar',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#34495E', '#E74C3C'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#medianrent"), options);
		chart.render();

		//Rental Rate Observations
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }],
		    chart: {
		        height: 450,
		        type: 'bar',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#DC7633', '#E74C3C'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#rentalRate"), options);
		chart.render();


		//Change in Rental Rate
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }],
		    chart: {
		        height: 450,
		        type: 'bar',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#F1C40F', '#E74C3C'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#changeRentalRate"), options);
		chart.render();

		//Value Based Gross Rental Yield
		var options = {
		    series: [{
		        name: 'MANGERE BRIDGE ',
		        type: 'column',
		        data: [23, 23,23,23,23,23,23,23,23,23,24,24]
		    }],
		    chart: {
		        height: 450,
		        type: 'bar',
		        stacked: false,
		        fontFamily: 'Manrope'
		    },
		    colors: ['#E74C3C','#5DADE2'],
		    dataLabels: {
		        enabled: false
		    },
		    stroke: {
		        width: [1, 3],
		    },
		    xaxis: {
		        categories: ['February 2019', 'March 2019', 'April 2019', 'May 2019', 'June 2019', 'July 2019', 'August 2019', 'September 2019', 'October 2019', 'November 2019', 'December 2019', 'January 2020'],
		    },
		    yaxis: [{
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#008FFB'
		            },
		            labels: {
		                style: {
		                    colors: '#008FFB',
		                }
		            },
		            title: {
		                text: "Median Days On Market",
		                style: {
		                    color: '#000',
		                }
		            },
		            tooltip: {
		                enabled: true
		            }
		        },
		        {
		            seriesName: 'Median Days On Market',
		            opposite: true,
		            axisTicks: {
		                show: true,
		            },
		            axisBorder: {
		                show: true,
		                color: '#00E396'
		            },
		            labels: {
		                style: {
		                    colors: '#00E396',
		                }
		            },
		        },
		    ],
		    tooltip: {
		        fixed: {
		            enabled: true,
		            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
		            offsetY: 30,
		            offsetX: 60
		        },
		    },
		    legend: {
		        horizontalAlign: 'center',
		        offsetX: 40
		    }
		};

		var chart = new ApexCharts(document.querySelector("#rentalYield"), options);
		chart.render();

	</script>
</body>
</html>