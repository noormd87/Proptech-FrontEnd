<?php include"header.php"; ?>
<link rel="stylesheet" type="text/css" href="assets/plugins/customfileinputs/component.css">

<!-- My Folder Property Grid View -->
         <div class="title-wrapper row">
           <div class="col">
             <div class="">
               <h2 class="page-title">My Folder</h2>
             </div>
           </div>
         </div>
         

   <!-- start compare properties row -->
   <div class="card mb-3 h-90">
      <div class="card-header">
         <h4>Title Heading</h4>
      </div>
      <div class="card-body">
        <form class="form-style-one" action="" id="compare-form" class="" method="">
         <div class="row pt-4 pb-5 px-md-5 px-3">
            <div class="form-group col-md-6">
              <label for="">Property Name</label>
              <input type="" class="form-control" name="" placeholder="Property">
            </div>
            <div class="form-group col-md-6">
              <label for="">Unit Number</label>
              <input type="" class="form-control" name="" placeholder="Unit Number">
            </div>
            <div class="form-group col-md-6">
              <label for="">Country</label>
              <select name="" class="form-control">
                <option value=""></option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="">Currency</label>
              <select name="" class="form-control">
                <option value=""></option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="">Tax Year</label>
              <select name="" class="form-control">
                <option value=""></option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="">Category</label>
              <select name="" class="form-control">
                <option value="">---Select Category---</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="">Amount</label>
              <input type="" class="form-control" name="">
            </div>
            <div class="form-group col-md-6">
              <label for="">Upload Property Images</label>
              <div class="js">
                 <input type="file" name="name-proof[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                 <label for="file-1"><img src="assets/img/download-icon-sm.png" class="img-fluid" > <span>Choose Files&hellip;</span></label>
              </div>
            </div>

            <div class="col-md-12">
              <input type="submit" class="btn btn-primary" name="" value="Submit">
            </div>
         </div> 
         <div class="table-responsive">
           <table class="table table-hover table-striped table-bordered">
             <tbody>
               <tr class="bg-white">
                 <th class="t3">PROPERTY NAME</th>
                 <th class="t3">UNIT NO</th>
                 <th class="t3">TAX YEAR</th>
                 <th class="t3">CATEGORY</th>
                 <th class="t3">AMOUNT</th>
                 <th class="t3">ACTION</th>
               </tr>
               <tr>
                 <td>-</td>
                 <td>-</td>
                 <td>-</td>  
                 <td>-</td>  
                 <td>-</td>  
                 <td>-</td>   
               </tr>
               <tr>
                 <td>-</td>
                 <td>-</td>
                 <td>-</td>  
                 <td>-</td>  
                 <td>-</td>  
                 <td>-</td>   
               </tr>
             </tbody>
           </table>
         </div>
         </form>
      </div>
   </div>
   <!-- end row -->



<?php include"footer.php"; ?>
<script src="assets/plugins/customfileinputs/custom-file-input.js"></script>