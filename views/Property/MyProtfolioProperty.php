<?php include"header.php"; 
\login\loginClass::Init();
$checkSession = \login\loginClass::CheckUserSessionIp();
?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form class="dpo-form" method="" enctype="multipart/form-data">
	               <div id="saveProperty">
	               	  <!-- summary -->
	               	  <h3>Summary</h3>
	               	  <section>
	               	  	<div class="row">
	               	  		<div class="col-12">
	               	  			<div class="card">
	               	  				<div class="card-body">
		               	  				<div class="row">
				               	  			<div class="col-md-4">
				               	  				<div class="form-group">
				               	  					<label>Country</label>
					               	  				<select class="form-control">
					               	  					<option></option>
					               	  				</select>
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-md-8">
				               	  				<div class="form-group">
				               	  					<label>Property name or address</label>
				               	  					<input class="form-control" type="text" name="">
				               	  				</div>
				               	  				<p>Your address is not recognised as a property address, which may result in some statistics and data being unavailable for your analysis.</p>
				               	  			</div>
				               	  		</div>
				               	  		<div class="row">
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Proeprty Type</label>
				               	  					<input class="form-control" type="text" name="">
				               	  				</div>
				               	  			</div>
				               	  			<div class="col-3">
				               	  				<div class="form-group">
				               	  					<label>Land area (m²)</label>
				               	  					<input class="form-control" type="text" name="">
				               	  				</div>
				               	  			</div>
				               	  			<div class="col">
				               	  				<label>&nbsp;</label>
				               	  				<div class="input-group mb-3">
												    <div class="input-group-prepend">
												      <span class="input-group-text"><i class="fa fa-bed"></i></span>
												    </div>
												    <input type="number" class="form-control" name="" value="2">
												</div>
				               	  			</div>
				               	  			<div class="col">
				               	  				<label>&nbsp;</label>
				               	  				<div class="input-group mb-3">
												    <div class="input-group-prepend">
												      <span class="input-group-text"><i class="fa fa-bath"></i></span>
												    </div>
												    <input type="number" class="form-control" name="" value="1">
												</div>
				               	  			</div>
				               	  			<div class="col">
				               	  				<label>&nbsp;</label>
				               	  				<div class="input-group mb-3">
												    <div class="input-group-prepend">
												      <span class="input-group-text"><i class="fa fa-car"></i></span>
												    </div>
												    <input type="number" class="form-control" name="" value="1">
												</div>
				               	  			</div>
				               	  		</div>
		               	  			</div>
	               	  			</div>
	               	  			<div class="analyser-submit-section">
	                              <div class="btn-div text-right pt-4">
	                                 <a id="right" class="btn btn-outline-dark" href="#next">Loan & purchase Costs <i class="fa fa-chevron-right"></i></a>
	                              </div>
	                           </div>
	               	  		</div>
	               	  	</div>
	               	  </section>
	               	  <!-- end summary -->	
	                  <!--loan and purchase -->
	                  <h3>Loan & purchase Costs</h3>
	                  <section>
	                     <div class="row">
	                        <div class="col-12">
	                           <!-- purchase details-->
	                           <div class="card my-4">
	                              <div class="card-header">
	                                 <div class="card-title">
	                                    PURCHASE DETAILS
	                                 </div>
	                              </div>
	                              <div class="card-body">
	                                 <div class="row">
	                                    <div class="col-6 col-md-4 col-lg-4 mb-3">
	                                        <input type="radio" class="check" id="build_type_dollor" name="build_type" checked value="draft">
	                                        <label for="build_type_dollor">Enter as $ value</label>
	                                        
	                                    </div>
	                                    <div class="col-6 mb-3">
	                                        <input type="radio" class="check" id="build_type_percent" name="build_type" value="draft">
	                                        <label for="build_type_percent">Enter as % of property purchase price</label>
	                                    </div>
	                                 </div>
	                                 <div class="row">
	                                    <!-- deposit percentage-->
	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                       <div class="form-group">
	                                          <label>Deposit(%) *</label>
	                                          <div class="input-icon">
	                                             <input class="touchspin1" type="text" value="" name="deposit" id="deposit">
	                                          </div>
	                                          <div class="range-container">
	                                             <input type="range" min="1" max="100" step="1" value="15" id="depositRange">
	                                          </div>
	                                       </div>
	                                    </div>
	                                    <!-- end deposit percentage-->
	                                    <!-- market value-->
	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                       <div class="form-group">
	                                          <label>Market Value($)</label>
	                                          <input class="touchspin2" type="text" value="" name="market-value" id="mrktValue">
	                                          <div class="range-container">
	                                             <input type="range" min="1" max="20000" step="1" value="2000" id="mrktValRange">
	                                          </div>
	                                       </div>
	                                    </div>
	                                    <!-- end market value-->
	                                    <!-- purchase amount-->
	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                       <div class="form-group">
	                                          <label>Purchase amount($)</label>
	                                          <input class="touchspin2" type="text" value="" name="purchase-amount" id="prchsAmntVal">
	                                          <div class="range-container">
	                                             <input type="range" min="1" max="30000" step="1" value="4400" id="prchsAmntRange">
	                                          </div>
	                                       </div>
	                                    </div>
	                                    <!-- end purchase amount-->
	                                 </div>
	                              </div>
	                           </div>
	                           <!-- end purchase details-->
	                           <!-- other expense -->
	                           <div class="card mb-4">
	                              <div class="card-header">
	                                 <div class="card-title">
	                                    OTHER EXPENSES
	                                 </div>
	                              </div>
	                              <div class="card-body">
	                                 <div class="row">
	                                    <!-- capital improvement -->
	                                    <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                       <div class="form-group">
	                                          <label>Capital improvement at purchase($) *</label>
	                                          <input class="touchspin2" type="text" value="" name="demo3">
	                                          <div class="range-container">
	                                             <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                          </div>
	                                       </div>
	                                    </div>
	                                    <!-- end capital improvement-->
	                                    <!-- solicitor cost-->
	                                    <div class="col-12 col-md-4 col-lg-4 ">
	                                       <div class="form-group">
	                                          <label>Solicitor’s cost ($)*</label>
	                                          <input class="touchspin2" type="text" value="" name="demo3">
	                                          <div class="range-container">
	                                             <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                          </div>
	                                       </div>
	                                    </div>
	                                    <!-- end solicitor cost-->
	                                    <!-- stamping fee-->
	                                    <!-- <div class="col-4 range-form-group">
	                                       <div class="form-group">
	                                          <label>Stamping fee($)</label>
	                                          <input class="touchspin3" type="text" value="" name="demo3">
	                                          <div class="range-container">
	                                             <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                          </div>
	                                       </div>
	                                    </div> -->
	                                    <!-- end stamping fee-->
	                                    <!-- other -->
	                                    <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                       <div class="form-group">
	                                          <label>Other($) *</label>
	                                          <input class="touchspin2" type="text" value="" name="demo3">
	                                          <div class="range-container">
	                                             <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                          </div>
	                                       </div>
	                                    </div>
	                                    <!-- end other-->
	                                 </div>
	                              </div>
	                           </div>
	                           <!-- end other expense -->
	                           <!-- Dynamic loan tabs -->
	                           <div class="card dynamic-tabs">
	                              <div class="card-header">
	                                 <ul class="nav nav-tabs dynamic-tabs-list" role="tablist">
	                                    <li><a class="active" href="#contact_01" data-toggle="tab">Loan 1</a>
	                                    </li>
	                                    <li><a href="#" class="add-contact"><i class="fa fa-plus-circle fa-lg"></i></a>
	                                    </li>
	                                 </ul>
	                              </div>
	                              <div class="card-body">
	                                 <div class="tab-content">
	                                    <div class="tab-pane active" id="contact_01">
	                                       <div class="" id="anaBody">
	                                          <div class="row">
	                                             <div class="col-4 mb-3">
	                                                <input type="radio" class="check" id="" name="other_expenses" checked value="draft">
	                                                <label for="">Interest Only</label>
	                                             </div>
	                                             <div class="col-6 mb-3">
	                                                <input type="radio" class="check" id="" name="other_expenses" value="draft">
	                                                <label for="">Principal & interest</label>
	                                             </div>
	                                          </div>
	                                          <div class="row">
	                                             <!-- loan length -->
	                                             <div class="col-12 col-md-4 col=lg-4 range-form-group">
	                                                <div class="form-group">
	                                                   <label>Loan length*</label>
	                                                   <div class="row mb-4">
	                                                      <div class="col-9">
	                                                         <input class="touchspin4" type="text" value="" name="loan_length_year">
	                                                      </div>
	                                                      <label class="col-form-label col-3">years &</label>
	                                                   </div>
	                                                   <div class="row">
	                                                      <div class="col-9">
	                                                         <input class="touchspin4" type="text" value="" name="loan_length_month">
	                                                      </div>
	                                                      <label class="col-form-label col-3">month</label>
	                                                   </div>
	                                                </div>
	                                             </div>
	                                             <!-- end loan length-->
	                                             <!-- amount of loan -->
	                                             <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                                <div class="form-group">
	                                                   <label>Amount of loan ($)*</label>
	                                                   <input class="touchspin2" type="text" value="" name="demo3">
	                                                   <div class="range-container">
	                                                      <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                                   </div>
	                                                </div>
	                                             </div>
	                                             <!-- end amount of loan-->
	                                             <!-- Esatblishment fee -->
	                                             <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                                <div class="form-group">
	                                                   <label>Establishment fee ($)*</label>
	                                                   <input class="touchspin2" type="text" value="" name="demo3">
	                                                   <div class="range-container">
	                                                      <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                                   </div>
	                                                </div>
	                                             </div>
	                                             <!-- end Esatblishment fee-->
	                                             <!-- interest rate -->
	                                             <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                                <div class="form-group">
	                                                   <label>Interest rate (%)*</label>
	                                                   <input class="touchspin1" type="text" value="" name="demo3">
	                                                   <div class="range-container">
	                                                      <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                                   </div>
	                                                </div>
	                                             </div>
	                                             <!-- end intrerest rate-->
	                                             <!-- other -->
	                                             <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                                <div class="form-group">
	                                                   <label>Other loan costs ($)</label>
	                                                   <input class="touchspin2" type="text" value="" name="demo3">
	                                                   <div class="range-container">
	                                                      <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                                   </div>
	                                                </div>
	                                             </div>
	                                             <!-- end other-->
	                                             <!-- other -->
	                                             <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                                <div class="form-group">
	                                                   <label>Valuation fees ($)</label>
	                                                   <input class="touchspin2" type="text" value="" name="demo3">
	                                                   <div class="range-container">
	                                                      <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                                   </div>
	                                                </div>
	                                             </div>
	                                             <!-- end other-->
	                                          </div>
	                                       </div>
	                                    </div>
	                                 </div>
	                              </div>
	                              
	                           </div>
	                           <!-- end dunamic loan tabs-->
	                           <!-- final card-->
	                           <div class="card final-card">
	                              <div class="row ">
	                                 <div class="col text-left align-self-center">
	                                    <div class="text-wrapper">
	                                       <h2>Total Purchase</h2>
	                                    </div>
	                                 </div>
	                                 <div class="col text-center align-self-center">
	                                    <div class="text-wrapper">
	                                       <h2>Costs: $182,000</h2>
	                                    </div>
	                                 </div>
	                                 <div class="col text-right align-self-center">
	                                    <div class="text-wrapper">
	                                       <h2>Deposit & loans are $1,000 <br> less than purchase costs</h2>
	                                    </div>
	                                 </div>
	                              </div>
	                           </div>
	                           <!-- end final card-->
	                           <div class="analyser-submit-section">
	                              <div class="btn-div text-right pt-4">
	                                 <a id="right" class="btn btn-outline-dark" href="#next">Rent & Expense <i class="fa fa-chevron-right"></i></a>
	                              </div>
	                           </div>
	                        </div>
	                     </div>
	                  </section>
	                  <!-- end loan and purchase -->
	                  <!-- Rent & Expenses -->
	                  <h3>Rent & Expenses</h3>
	                  <section>
	                     <!-- purchase details-->
	                     <div class="card my-4">
	                        <div class="card-header">
	                           <div class="card-title">ANNUAL RENTAL RETURNS</div>
	                        </div> 
	                        <div class="card-body">
	                           <div class="row">
	                              <div class="col-2">
	                                 <label>Rental Type:</label>
	                              </div>
	                              <div class="col-4 mb-3">
	                                <input type="radio" checked class="check" id="" name="rental_type" value="draft">
	                                <label for="">Resident long term</label>
	                              </div>
	                              <div class="col-4 mb-3">
	                                <input type="radio" class="check" id="" name="rental_type" value="draft">
	                                <label for="">Holiday rental</label>
	                              </div>
	                           </div>
	                           <div class="row">
	                              <!-- deposit percentage-->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="form-group">
	                                    <label>Rate of occupancy (wks)</label>
	                                    <div class="input-icon">
	                                       <input class="touchspin4" type="text" value="" name="deposit" id="deposit">
	                                    </div>
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="depositRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end deposit percentage-->
	                              <!-- market value-->
	                              <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                 <div class="form-group">
	                                    <label>Weekly rents($)</label>
	                                    <input class="touchspin2" type="text" value="" name="market-value">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end market value-->
	                              <div class="col-12">
	                                 <label>Total annual rent: $34,320</label>
	                                 <div class="note">
	                                    <p>Please note:    You can only enter rental values for either residential or holiday rental, not both. Whichever screen you complete and keep as the selected (visible) option will be the rental type used for analysis.</p>
	                                 </div>
	                              </div>
	                           </div>
	                        </div>
	                     </div>
	                     <!-- end purchase details-->
	                     <!-- other expense -->
	                     <div class="card mb-4">
	                        <div class="card-header">
	                           <div class="card-title">ANNUAL PROPERTY EXPENSES</div>
	                        </div> 
	                        <div class="card-body">
	                           <div class="row">
	                              <!-- capital improvement -->
	                              <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                 <div class="form-group">
	                                    <label>Rates($) *</label>
	                                    <input class="touchspin2" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end capital improvement-->
	                              <!-- solicitor cost-->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="form-group">
	                                    <label>Body corporate($) *</label>
	                                    <input class="touchspin2" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end solicitor cost-->
	                              <!-- stamping fee-->
	                              <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                 <div class="form-group">
	                                    <label>Land lease fee($)*</label>
	                                    <input class="touchspin2" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end stamping fee-->
	                              <!-- other -->
	                              <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                 <div class="form-group">
	                                    <label>Insurance ($) *</label>
	                                    <input class="touchspin2" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end other-->
	                              <!-- Letting fees($)* -->
	                              <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                 <div class="form-group">
	                                    <label>Letting fees($)*</label>
	                                    <input class="touchspin2" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Letting fees($)*-->
	                              <!-- Management fees(%)* -->
	                              <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                 <div class="form-group">
	                                    <label>Management fees(%)*</label>
	                                    <input class="touchspin1" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Management fees(%)*-->
	                              <!-- Repairs/maintenance($)* -->
	                              <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                 <div class="form-group">
	                                    <label>Repairs/maintenance($)*</label>
	                                    <input class="touchspin2" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Repairs/maintenance($)*-->
	                              <!-- Gardening($)* -->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="form-group">
	                                    <label>Gardening($)*</label>
	                                    <input class="touchspin2" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Gardening($)*-->
	                              <!-- Cleaning($)* -->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="form-group">
	                                    <label>Cleaning($)*</label>
	                                    <input class="touchspin2" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Cleaning($)*-->
	                              <!-- Service contract($)* -->
	                              <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                 <div class="form-group">
	                                    <label>Service contract($)*</label>
	                                    <input class="touchspin2" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Service contract($)*-->
	                              <!-- Other($)* -->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="form-group">
	                                    <label>Other($)*</label>
	                                    <input class="touchspin2" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Other($)*-->
	                           </div>
	                        </div>
	                     </div>
	                     <!-- end other expense -->
	                     <div class="card final-card">
	                        <div class="row ">
	                           <div class="col text-left align-self-center">
	                              <div class="text-wrapper">
	                                 <h2>Total annual property expenses</h2>
	                              </div>
	                           </div>
	                           <div class="col text-center align-self-center">
	                              <div class="text-wrapper">
	                                 <!-- <h2>Costs: $182,000</h2> -->
	                              </div>
	                           </div>
	                           <div class="col text-right align-self-center">
	                              <div class="text-wrapper">
	                                 <h2>$1,000</h2>
	                              </div>
	                           </div>
	                        </div>
	                     </div>
	                     <div class="row">
	                        <div class="col-9">
	                           <div class="analyser-submit-section">
	                              <div class="btn-div text-left pt-4">
	                                 <ul class="list-inline">
	                                    <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Loan & Purchase costs</a></li>
	                                 </ul>
	                              </div>
	                           </div>
	                        </div>
	                        <div class="col-3">
	                           <div class="analyser-submit-section">
	                              <div class="btn-div text-right pt-4">
	                                 <ul class="list-inline">
	                                    <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Tax & Market <i class="fa fa-chevron-right"></i></a></li>
	                                 </ul>
	                              </div>
	                           </div>
	                        </div>
	                     </div>
	                  </section>
	                  <!-- End Rent & Expenses -->
	                  <!-- Tax & MArket -->
	                  <h3>Tax & Market</h3>
	                  <section>
	                     <!-- ASSIGN AN ENTITY -->
	                     <div class="card my-4">
	                        <div class="card-header">
	                           <div class="card-title">ASSIGN AN ENTITY</div>
	                        </div>
	                        <div class="card-body">
	                           <div class="row">
	                              <!-- his property belong to entity -->
	                              <div class="col-12 col-md-4 col-lg-4 ">
	                                 <div class="select-box">
	                                    <div class="form-group">
	                                       <label>This property belong to entity</label>
	                                       <div class="select-group">
	                                          <select class="form-control">
	                                             <option>Property Ownership</option>
	                                          </select>
	                                       </div>
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end his property belong to entity-->
	                              <!-- Entity rows-->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="form-group">
	                                    <label>Entity rows</label>
	                                    <input class="touchspin4" type="text" value="" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Entity rows-->
	                              <!-- Entity Selected-->
	                              <div class="col-12 col-md-4 col-lg-4 ">
	                                 <div class="entity-wrapper">
	                                    <h3>Entity Selected</h3>
	                                    <p>Personal Ownership <a href="#">(view)</a></p>
	                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createFolder">Create a new</button>
	                                 </div>
	                              </div>
	                              <!-- end Entity Selected-->
	                           </div>
	                        </div>
	                     </div>
	                     <!-- end ASSIGN AN ENTITY -->
	                     <!-- MARKET FACTORS -->
	                     <div class="card mb-4">
	                        <div class="card-header">
	                           <div class="card-title">MARKET FACTORS</div>
	                        </div>
	                        <div class="card-body">
	                           <div class="row">
	                              <!-- Entity rows-->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="form-group">
	                                    <label>Consumer price index (%)*</label>
	                                    <input class="touchspin1" type="text" value="3%" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Entity rows-->
	                              <!-- Entity rows-->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="form-group">
	                                    <label>Capital growth(%)*</label>
	                                    <input class="touchspin1" type="text" value="15%" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Entity rows-->
	                              <!-- Land Tax-->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="form-group">
	                                    <label>Land tax ($)</label>
	                                    <input class="touchspin2" type="text" value="15%" name="land_tax">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="0" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Land Tax-->
	                           </div>
	                        </div>
	                     </div>
	                     <!-- end MARKET FACTORS -->
	                     <!-- DEPRECIATION ESTIMATION -->
	                     <div class="card mb-4">
	                        <div class="card-header">
	                           <div class="card-title">DEPRECIATION ESTIMATION</div>
	                        </div>
	                        <div class="card-body">
	                           <div class="row">
	                              <div class="col-12">
	                                <input type="checkbox" class="check" id="" name="cal_depreciation" value="draft">
	                                <label for="">Calculate depreciation</label>
	                              </div>
	                              <!-- Construction year-->
	                              <div class="col-12 col-md-4 col-lg-4 range-form-group">
	                                 <div class="form-group">
	                                    <label>Construction year completed*</label>
	                                    <input class="touchspin2" type="text" value="3%" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Construction year-->
	                              <!-- Recent renovation-->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="select-box">
	                                    <div class="form-group">
	                                       <label>Recent renovations</label>
	                                       <div class="select-group">
	                                          <select class="form-control">
	                                             <option>View</option>
	                                          </select>
	                                       </div>
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Recent renovation-->
	                              <!-- Construction year-->
	                              <div class="col-12 col-md-4 col-lg-4  range-form-group">
	                                 <div class="form-group">
	                                    <label>Your estimate of land value($)</label>
	                                    <input class="touchspin2" type="text" value="3%" name="demo3">
	                                    <div class="range-container">
	                                       <input type="range" min="1" max="100" step="1" value="15" id="customRange">
	                                    </div>
	                                 </div>
	                              </div>
	                              <!-- end Construction year-->
	                              <div class="col-4">
	                                 <div class="seagars-logo">
	                                    <h4>Powered by</h4>
	                                    <img src="assets/img/seagars-logo.png" class="img-fluid">
	                                 </div>
	                              </div>
	                           </div>
	                        </div>
	                     </div>
	                     <!-- end DEPRECIATION ESTIMATION  -->
	                     <div class="card final-card">
	                        <div class="row ">
	                           <div class="col text-left align-self-center">
	                              <div class="text-wrapper">
	                                 <h2>Total annual property expenses</h2>
	                              </div>
	                           </div>
	                           <div class="col text-center align-self-center">
	                              <div class="text-wrapper">
	                                 <!-- <h2>Costs: $182,000</h2> -->
	                              </div>
	                           </div>
	                           <div class="col text-right align-self-center">
	                              <div class="text-wrapper">
	                                 <h2>$1,000</h2>
	                              </div>
	                           </div>
	                        </div>
	                     </div>
	                     <div class="row">
	                        <div class="col-9">
	                           <div class="analyser-submit-section">
	                              <div class="btn-div text-left pt-4">
	                                 <ul class="list-inline">
	                                    <li class="list-inline-item"><a id="left" class="btn btn-outline-dark" href="#previous"><i class="fa fa-chevron-left"></i> Rent & Expense</a></li>
	                                 </ul>
	                              </div>
	                           </div>
	                        </div>
	                        <div class="col-3">
	                           <div class="analyser-submit-section">
	                              <div class="btn-div text-right pt-4">
	                                 <ul class="list-inline">
	                                    <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next"> Result <i class="fa fa-chevron-right"></i></a></li>
	                                 </ul>
	                              </div>
	                           </div>
	                        </div>
	                     </div>
	                  </section>
	                  <!-- End Tax & MArket -->
	                  <!-- Results -->
	                  <h3>Results</h3>
	                  <section class="my-4">
	                     <div class="row mb-4">
	                        <div class="col-6">
	                           <div class="card h-100">
	                              <div class="card-body">
	                                <div class="card-title">VARIABLES</div>
	                                 <div class="range-form-group text-center">
	                                    <div class="form-group">
	                                       <label>Loan to value ratio target(%) *</label>
	                                       <div class="input-icon ml-auto mr-auto" style="max-width: 350px;">
	                                          <input class="touchspin2" type="text" value="">
	                                       </div>
	                                       <div class="range-container">
	                                          <input type="range" min="1" max="100" step="1" value="15" id="depositRange">
	                                       </div>
	                                    </div>
	                                 </div>
	                              </div>
	                           </div>
	                        </div>
	                        <div class="col-6">
	                           <div class="card h-100">
	                                 <div class="card-body">
	                                    <div class="card-title">SUMMARY INPUT</div>
	                                    <table class="table summary-table">
	                                       <tbody>
	                                          <tr>
	                                             <td>10yr internal rate of return</td>
	                                             <td>70.06%</td>
	                                          </tr>
	                                          <tr>
	                                             <td>Purchase costs </td>
	                                             <td>$62,000</td>
	                                          </tr>
	                                          <tr>
	                                             <td>Property purchase price </td>
	                                             <td>$800,000</td>
	                                          </tr>
	                                          <tr>
	                                             <td>Loan costs</td>
	                                             <td>$1,000</td>
	                                          </tr>
	                                          <tr>
	                                             <td>10yr total growth </td>
	                                             <td>88.04%</td>
	                                          </tr>
	                                          <tr>
	                                             <td>Deposit </td>
	                                             <td>$80,000</td>
	                                          </tr>
	                                       </tbody>
	                                    </table>
	                                 </div>
	                              </div>
	                        </div>
	                     </div>
	                     <div class="row">
	                        <div class="col-12">
	                           <div class="table-wrapper">
	                              <div class="card">
	                                 <div class="card-body">
	                                    <table class="table final-table">
	                                 <thead class="bg-dark">
	                                    <tr>
	                                       <td>Show all years (0-10) </td>
	                                       <td>Today</td>
	                                       <td>Year 1</td>
	                                       <td>Year 3</td>
	                                       <td>Year 5</td>
	                                       <td>Year 10</td>
	                                    </tr>
	                                 </thead>
	                                 <tr class="heading-seprator bg-light">
	                                    <td colspan="6">OVERVIEW</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Capital growth rate %</td>
	                                    <td>8.29</td>
	                                    <td>8.29</td>
	                                    <td>8.29</td>
	                                    <td>8.29</td>
	                                    <td>8.29</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Consumer price index %</td>
	                                    <td>2.00</td>
	                                    <td>2.00</td>
	                                    <td>2.00</td>
	                                    <td>2.00</td>
	                                    <td>2.00</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Property market value $</td>
	                                    <td>649,000</td>
	                                    <td>702,802</td>
	                                    <td>825,157</td>
	                                    <td>966,466</td>
	                                    <td>1,439,223</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Amount of loan $ </td>
	                                    <td>649,000</td>
	                                    <td>649,000</td>
	                                    <td>649,000</td>
	                                    <td>649,000</td>
	                                    <td>649,000</td>
	                                 </tr>
	                                 <tr class="heading-seprator bg-light">
	                                    <td>STATISTICS</td>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                 </tr>
	                                 <tr>
	                                    <td>Equity in property $</td>
	                                    <td>0</td>
	                                    <td>53,802</td>
	                                    <td>175,157</td>
	                                    <td>317,466</td>
	                                    <td>790,223</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Loan to value ratio %</td>
	                                    <td>100</td>
	                                    <td>92.34</td>
	                                    <td>78.75</td>
	                                    <td>67.15</td>
	                                    <td>45.09</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Surplus equity to reinvest $</td>
	                                    <td class="text-danger">(129,800)</td>
	                                    <td class="text-danger">(86,758)</td>
	                                    <td>10,325</td>
	                                    <td>124,173</td>
	                                    <td>502,379</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Buying power $</td>
	                                    <td class="text-danger">(649,000)</td>
	                                    <td class="text-danger">(433,792)</td>
	                                    <td>51,627</td>
	                                    <td>620,863</td>
	                                    <td>2,511,894</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Rental income $</td>
	                                    <td>645pw</td>
	                                    <td>32,250</td>
	                                    <td>33,553</td>
	                                    <td>34,908</td>
	                                    <td>38,542</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Gross yield %</td>
	                                    <td></td>
	                                    <td>4.97</td>
	                                    <td>5,17</td>
	                                    <td>5,38</td>
	                                    <td>5,94</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Net yield %</td>
	                                    <td></td>
	                                    <td>3.72</td>
	                                    <td>3.87</td>
	                                    <td>4.03</td>
	                                    <td>4.44</td>
	                                 </tr>
	                                 <tr class="heading-seprator bg-light">
	                                    <td colspan="6">CASH DEDUCTIONS</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Property expenses $</td>
	                                    <td>0.00%</td>
	                                    <td>8,515</td>
	                                    <td>8,443</td>
	                                    <td>8,784</td>
	                                    <td>9,698</td>
	                                 </tr>
	                                 <tr class="heading-seprator bg-light">
	                                    <td colspan="6">Loan 1</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Interest rate %</td>
	                                    <td>4.50</td>
	                                    <td>4.50</td>
	                                    <td>4.50</td>
	                                    <td>4.50</td>
	                                    <td>4.50</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Interest payments $</td>
	                                    <td>0</td>
	                                    <td>29,205</td>
	                                    <td>29,205</td>
	                                    <td>29,205</td>
	                                    <td>29,205</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Principal payments $</td>
	                                    <td>0</td>
	                                    <td>0</td>
	                                    <td>0</td>
	                                    <td>0</td>
	                                    <td>0</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Pre-tax cash flow p/a $</td>
	                                    <td></td>
	                                    <td class="text-danger">(50,070)</td>
	                                    <td class="text-danger">(4,095)</td>
	                                    <td class="text-danger">(3,080)</td>
	                                    <td class="text-danger">(361)</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Pre-tax cash flow p/w $</td>
	                                    <td></td>
	                                    <td class="text-danger">(97)</td>
	                                    <td class="text-danger">(79)</td>
	                                    <td class="text-danger">(59)</td>
	                                    <td class="text-danger">(7)</td>
	                                 </tr>
	                                 <tr class="heading-seprator bg-light">
	                                    <td>NON-CASH DEDUCTIONS</td>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                 </tr>
	                                 <tr>
	                                    <td>Depreciation $</td>
	                                    <td></td>
	                                    <td>10,088</td>
	                                    <td>5,674</td>
	                                    <td>3,152</td>
	                                    <td>757</td>
	                                 </tr>
	                                 <tr class="heading-seprator bg-light">
	                                    <td>SUMMARY</td>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                    <td></td>
	                                 </tr>
	                                 <tr>
	                                    <td>Total deductions $</td>
	                                    <td></td>
	                                    <td>47,408</td>
	                                    <td>43,332</td>
	                                    <td>41,181</td>
	                                    <td>39,660</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Net profit/loss $</td>
	                                    <td></td>
	                                    <td class="text-danger">(15,158)</td>
	                                    <td class="text-danger">(9,769)</td>
	                                    <td class="text-danger">(6,272)</td>
	                                    <td class="text-danger">(1,118)</td>
	                                 </tr>
	                                 <tr>
	                                    <td>Tax refund $</td>
	                                    <td></td>
	                                    <td>0</td>
	                                    <td>0</td>
	                                    <td>0</td>
	                                    <td>0</td>
	                                 </tr>
	                                 <tr>
	                                    <td>After tax cash flow p/a $ </td>
	                                    <td></td>
	                                    <td class="text-danger">(5,070)</td>
	                                    <td class="text-danger">(4,095)</td>
	                                    <td class="text-danger">(3,080)</td>
	                                    <td class="text-danger">(361)</td>
	                                 </tr>
	                                 <tr>
	                                    <td>After tax cash flow p/w $</td>
	                                    <td></td>
	                                    <td class="text-danger">(97)</td>
	                                    <td class="text-danger">(79)</td>
	                                    <td class="text-danger">(59)</td>
	                                    <td class="text-danger">(7)</td>
	                                 </tr>
	                              </table>
	                                 </div>
	                              </div>
	                           </div>
	                        </div>
	                     </div>
	                     <div class="row">
	                        <div class="col-9">
	                           <div class="analyser-submit-section">
	                              <div class="btn-div text-left pt-4">
	                                 <ul class="list-inline">
	                                    <li class="list-inline-item"><a class="btn btn-outline-dark" href="#">Add to saved</a></li>
	                                    <li class="list-inline-item"><a class="btn btn-outline-dark" href="#">Move to Portfolio Tracker</a></li>
	                                    <li class="list-inline-item"><a class="btn btn-outline-dark" href="#">Edit</a></li>
	                                 </ul>
	                              </div>
	                           </div>
	                        </div>
	                        <div class="col-3">
	                           <div class="analyser-submit-section">
	                              <div class="btn-div text-right pt-4">
	                                 <ul class="list-inline">
	                                    <li class="list-inline-item"><a id="right" class="btn btn-outline-dark" href="#next">Graph <i class="fa fa-chevron-right"></i></a></li>
	                                 </ul>
	                              </div>
	                           </div>
	                        </div>
	                     </div>
	                  </section>
	                  <!-- End Results -->
	               </div>
	            </form>
			</div>
		</div>
	</div>
</div>

<!-- end row -->



<?php include"footer.php"; ?>


<!--  jquery steps -->
<script type="text/javascript" src="assets/plugins/jquery-steps/jquery-steps.min.js"></script>
<script src="assets/plugins/bootstrap-touchpin/jquery.bootstrap-touchspin.min.js"></script>
<script src="assets/plugins/bootstrap-touchpin/bootstrap-touchpin-init.js"></script>
<script type="text/javascript">
  // --------------------------------------
  //analyser section
  //---------------------------------------
  $("#saveProperty").steps({
    headerTag: "h3",
    bodyTag: "section",
    enableAllSteps: true,
    enablePagination: false,
    transitionEffect: 1,
    transitionEffectSpeed: 200,
    titleTemplate: '<span class="number">#index#</span> #title#',
    loadingTemplate: '<span class="spinner"></span> #text#',
  });

  $(document).delegate('#right', 'click', function () {
    var a = $(".wizard").steps("next");
    if (!a) {
      $(".wizard").steps("finish");
    }
  });
  $(document).delegate('#left', 'click', function () {
    var a = $(".wizard").steps("previous");
    if (!a) {
      $(".wizard").steps("finish");
    }
  });
  
  //dropdown input number spinner input
  $(".touchspin1").TouchSpin({
    min: 0,
        max: 100,
        boostat: 5,
        maxboostedstep: 10,
        // postfix: '%',
        buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
        buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
  });
  $(".touchspin2").TouchSpin({
        min: 0,
        max: 100,
        boostat: 5,
        maxboostedstep: 10,
        // prefix: '$',
        buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
        buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
  });
  $(".touchspin4").TouchSpin({
        min: 0,
        max: 100,
        boostat: 5,
        maxboostedstep: 10,
        buttondown_class: 'btn btn-light btn-spinner btn-spinner-down',
        buttonup_class: 'btn btn-light btn-spinner btn-spinner-up'
  });
  $(".bedroom-input").TouchSpin({
    min: 0,
    max: 2000000,
    verticalbuttons: true,
    prefix: '<img src="assets/img/bedroom-icon.png">',
    buttondown_class: 'btn-spinner btn-spinner-down',
    buttonup_class: 'btn-spinner btn-spinner-up'
  });
  $(".bathroom-input").TouchSpin({
    min: 0,
    max: 2000000,
    verticalbuttons: true,
    prefix: '<img src="assets/img/bathroom-icon.png">',
    buttondown_class: 'btn-spinner btn-spinner-down',
    buttonup_class: 'btn-spinner btn-spinner-up'
  });
  $(".carpark-input").TouchSpin({
    min: 0,
    max: 2000000,
    verticalbuttons: true,
    prefix: '<img src="assets/img/parking-icon.png">',
    buttondown_class: 'btn-spinner btn-spinner-down',
    buttonup_class: 'btn-spinner btn-spinner-up'
  });
  $(".touchspin3").TouchSpin({
    min: 0,
    max: 2000000,
    verticalbuttons: true,
    buttondown_class: 'btn-spinner btn-spinner-down',
    buttonup_class: 'btn-spinner btn-spinner-up'
  });

</script>

<script type="text/javascript" src="assets/plugins/progressbar/progressbar.js"></script>
<!--progress bar script-->
<script type="text/javascript">
    window.onload = function onLoad() {
    var semicircle = new ProgressBar.SemiCircle('#progress1', {
        color: '#DEA46C',
        duration: 3000,
        strokeWidth: 5,
        trailColor: '#2b2d49',
        trailWidth: 0.8,
        easing: 'easeInOut',
        svgStyle: null,
      text: {
        value: '',
        alignToBottom: false
      },
      from: {color: '#ffedcd'},
      to: {color: '#DEA46C'},
      // Set default step function for all animate calls
      step: (state, bar) => {
        bar.path.setAttribute('stroke', state.color);
        var value = Math.round(bar.value() * 100);
        if (value===0) {
          bar.setText('sold value');
        } else {
          bar.setText(value);
        }
        bar.text.style.color = '#000';
        bar.text.style.fontSize = '18px';
        bar.text.style.fontWeight = '600';
        bar.text.style.fontFamily = '"Oswald", sans-serif';
        bar.text.style.top = '10px';
      }
    });
    semicircle.animate(300/100);


    var semicircle = new ProgressBar.SemiCircle('#progress2', {
        color: '#DEA46C',
        duration: 3000,
        strokeWidth: 5,
        trailColor: '#2b2d49',
        trailWidth: 0.8,
        easing: 'easeInOut',
        svgStyle: null,
      text: {
        value: '',
        alignToBottom: false
      },
      from: {color: '#ffedcd'},
      to: {color: '#DEA46C'},
      // Set default step function for all animate calls
      step: (state, bar) => {
        bar.path.setAttribute('stroke', state.color);
        var value = Math.round(bar.value() * 100);
        if (value===0) {
          bar.setText('conditonal value');
        } else {
          bar.setText(value);
        }
        bar.text.style.color = '#000';
        bar.text.style.fontSize = '18px';
        bar.text.style.fontWeight = '600';
        bar.text.style.fontFamily = '"Oswald", sans-serif';
        bar.text.style.top = '10px';
      }
    });
    semicircle.animate(100/100);

    var semicircle = new ProgressBar.SemiCircle('#progress3', {
        color: '#DEA46C',
        duration: 3000,
        strokeWidth: 5,
        trailColor: '#2b2d49',
        trailWidth: 0.8,
        easing: 'easeInOut',
        svgStyle: null,
      text: {
        value: '',
        alignToBottom: false
      },
      from: {color: '#ffedcd'},
      to: {color: '#DEA46C'},
      // Set default step function for all animate calls
      step: (state, bar) => {
        bar.path.setAttribute('stroke', state.color);
        var value = Math.round(bar.value() * 100);
        if (value===0) {
          bar.setText('rsvd Value');
        } else {
          bar.setText(value);
        }
        bar.text.style.color = '#000';
        bar.text.style.fontSize = '18px';
        bar.text.style.fontWeight = '600';
        bar.text.style.fontFamily = '"Oswald", sans-serif';
        bar.text.style.top = '10px';
      }
    });
    semicircle.animate(10/100);

    var semicircle = new ProgressBar.SemiCircle('#progress4', {
        color: '#DEA46C',
        duration: 3000,
        strokeWidth: 5,
        trailColor: '#2b2d49',
        trailWidth: 0.8,
        easing: 'easeInOut',
        svgStyle: null,
      text: {
        value: '',
        alignToBottom: false
      },
      from: {color: '#ffedcd'},
      to: {color: '#DEA46C'},
      // Set default step function for all animate calls
      step: (state, bar) => {
        bar.path.setAttribute('stroke', state.color);
        var value = Math.round(bar.value() * 100);
        if (value===0) {
          bar.setText('total value');
        } else {
          bar.setText(value);
        }
        bar.text.style.color = '#000';
        bar.text.style.fontSize = '18px';
        bar.text.style.fontWeight = '600';
        bar.text.style.fontFamily = '"Oswald", sans-serif';
        bar.text.style.top = '10px';
      }
    });
    semicircle.animate(1000/100);
};
</script>