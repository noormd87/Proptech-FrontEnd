<?php
namespace Masters;

interface MastersInterface {
    //put your code here
    
    
}

class MastersClass implements MastersInterface{
    
    public static $DocName, $DocRemarks, $UploadFile, $UploadedFiles, $Mode, $Id, $BrochureFile, $FolderId, $ProjectId, $FinYr, $Category, $Amount, $SuccessMsg;
    
    public static $PropertyCountryId, $currencyId, $ProjectName, $UnitNo; 
    
    
    public static function GetFormValues(){
        //echo "<pre>"; print_r($_REQUEST); ECHO "</PRE>";
        self::$DocName        = isset($_REQUEST["DocName"]) ?  $_REQUEST["DocName"] : ""; 
        self::$DocRemarks     = isset($_REQUEST["DocRemarks"]) ?  $_REQUEST["DocRemarks"] : ""; 
        self::$UploadedFiles  = isset($_REQUEST["UploadedFiles"]) ?  $_REQUEST["UploadedFiles"] : ""; 
        self::$Mode           = isset($_REQUEST["mode"]) ?  $_REQUEST["mode"] : ""; 
        self::$Id             = isset($_REQUEST["id"]) ?  $_REQUEST["id"] : ""; 
        
        self::$BrochureFile   = isset($_REQUEST["filename"]) ?  $_REQUEST["filename"] : ""; 
        self::$FolderId       = isset($_REQUEST["FolderId"]) ?  $_REQUEST["FolderId"] : ""; 
        
        
        self::$ProjectId      = isset($_REQUEST["ProjectId"]) ?  $_REQUEST["ProjectId"] : ""; 
        self::$FinYr      = isset($_REQUEST["FinYr"]) ?  $_REQUEST["FinYr"] : ""; 
        self::$Category      = isset($_REQUEST["Category"]) ?  $_REQUEST["Category"] : ""; 
        
        self::$Amount       = isset($_REQUEST["Amount"]) ?  $_REQUEST["Amount"] : 0; 
        self::$PropertyCountryId = isset($_REQUEST["PropertyCountryId"]) ?  $_REQUEST["PropertyCountryId"] : ""; 
        self::$currencyId = isset($_REQUEST["currencyId"]) ?  $_REQUEST["currencyId"] : ""; 
        self::$ProjectName = isset($_REQUEST["ProjectName"]) ?  $_REQUEST["ProjectName"] : ""; 
        self::$UnitNo           = isset($_REQUEST["UnitNo"]) ?  $_REQUEST["UnitNo"] : ""; 
        //print_r($_REQUEST);
    }
    
    public static function GetMyFolderDbValues(){
        /*
        $IndexQry	= "SELECT
                        MF.MY_FOLDER_ID,
                        MF.DOC_NAME,
                        MF.DOC_REMARKS,
                        MF.FILES_LIST,
                        MF.CREATED_DT,
                        MF.AMOUNT,
                        MF.FINANCE_YR,
                        MF.PROJECT_ID,
                        MF.CATEGORY,
                        PROJ.COUNTRY COUNTRY_CODE,
                        PROJ.CURRENCY
                    FROM
                        my_folders MF
                    LEFT JOIN project PROJ ON
                        MF.PROJECT_ID = PROJ.PROJECT_ID
                    LEFT JOIN country_master CM ON
                        PROJ.COUNTRY = CM.COUNTRY_CODE
                    WHERE
                        MF.MY_FOLDER_ID = '" . self::$Id . "' " ;
        */
        
        $IndexQry	= "SELECT
                            MF.MY_FOLDER_ID,
                            MF.DOC_NAME,
                            MF.DOC_REMARKS,
                            MF.FILES_LIST,
                            MF.CREATED_DT,
                            MF.AMOUNT,
                            MF.FINANCE_YR,
                            MF.PROJECT_ID,
                            MF.CATEGORY,
                            MF.COUNTRY_CODE,
                            MF.CURRENCY_ID,
                            MF.PROJECT_NAME,
                            UNIT_NO
                        FROM
                            my_folders MF 
                        WHERE
                            MF.MY_FOLDER_ID = '" . self::$Id . "' ";
        
              
        $rows = \DBConn\DBConnection::getQuery( $IndexQry );
        $i = 1;
        foreach ($rows as $row){
            self::$BrochureFile         = isset($row["FILES_LIST"]) ?  $row["FILES_LIST"] : ""; 
            
            self::$ProjectId            = isset($row["PROJECT_ID"]) ?  $row["PROJECT_ID"] : ""; 
            self::$ProjectName          = isset($row["PROJECT_NAME"]) ?  $row["PROJECT_NAME"] : ""; 
            self::$FinYr                = isset($row["FINANCE_YR"]) ?  $row["FINANCE_YR"] : ""; 
            self::$Category             = isset($row["CATEGORY"]) ?  $row["CATEGORY"] : ""; 
            
            self::$Amount               = isset($row["AMOUNT"]) ?  $row["AMOUNT"] : 0; 
            
            self::$DocName              = $row["DOC_NAME"]; 
            self::$DocRemarks           = $row["DOC_REMARKS"]; 
            self::$UploadedFiles        = $row["FILES_LIST"]; 
            
            self::$PropertyCountryId    = isset($row["COUNTRY_CODE"]) ?  $row["COUNTRY_CODE"] : ""; 
            self::$currencyId           = isset($row["CURRENCY_ID"]) ?  $row["CURRENCY_ID"] : ""; 
            
            self::$UnitNo               = isset($row["UNIT_NO"]) ?  $row["UNIT_NO"] : "";
        }
    }
    
    
    public static function GetFinYrDtls(){
        self::GetFormValues();
        $DpStr = \Html\Elements\InputsClass::ShowFinYrDropdown( "FinYr" , array() , "", "Select Finance Year", "class='form-control input-default'", self::$PropertyCountryId );
        
        $CountryQry	        = " SELECT
                                        CURRENCY
                                    FROM
                                        country_master
                                    WHERE
                                        COUNTRY_CODE = '" . self::$PropertyCountryId . "'	" ;
		
        //$CurrId = ""; 
        
		$rows = \DBConn\DBConnection::getQuery( $CountryQry ); 
        $i = 1;
        foreach ($rows as $row){
            self::$currencyId = $row["CURRENCY"];
        }
        
        return json_encode( array("DpStr" => $DpStr, "currencyId" => self::$currencyId) );
        
    }
    
    public static function GetPropertyDtls(){
        self::GetFormValues();
        
        $PropertyQry	        = " SELECT
                                        PROJ.COUNTRY COUNTRY_CODE,
                                        PROJ.CURRENCY
                                    FROM
                                        project PROJ
                                    LEFT JOIN country_master CM on
                                        PROJ.COUNTRY = CM.COUNTRY_CODE
                                    WHERE
                                        PROJ.PROJECT_ID = '" . self::$Id . "'	" ;
		
      
		$rows = \DBConn\DBConnection::getQuery( $PropertyQry ); 
        $i = 1;
        foreach ($rows as $row){
            self::$PropertyCountryId = $row["COUNTRY_CODE"];
            self::$currencyId = $row["CURRENCY"];
        }
        
        return json_encode( array("CountryId" => self::$PropertyCountryId, "currencyId" => self::$currencyId) );
    }
    
    public static function AddToMyFolder(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        self::GetFormValues();
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/AddToMyFolder.php" );
        
        
        
        //echo "  <form name='form1' method='post' action='" . SITE_BASE_URL . "/Masters/AddToMyFolderSave'></form> ";
    }
    
    public static function AddToMyFolderSave(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        self::GetFormValues();
	    
	     $CurDt			= date('Y-m-d H:i:s');
	     
	     //echo "(SELECT FILES_LIST FROM my_folders where MY_FOLDER_ID='". self::$FolderId ."')";
	     
	     $check_count               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT FILES_LIST FROM my_folders where MY_FOLDER_ID='". self::$FolderId ."')");
	     
	     $prevfilename  = isset($check_count["0"]) ? $check_count["0"] : "";
	     
	     if ($prevfilename == ""){
	         $prevfilename = self::$BrochureFile;
	     }
	     else{
	         $prevfilename = $prevfilename . "," . self::$BrochureFile;
	     }
	     
	     
	     //echo "<pre>"; print_r($check_count); echo "</pre>";
	     //exit;
        
        $queryStr		= " UPDATE my_folders SET FILES_LIST = :BROCHUREFILENAME WHERE MY_FOLDER_ID=:MY_FOLDER_ID";

		$ColValarray	= array("MY_FOLDER_ID" => self::$FolderId, "BROCHUREFILENAME"=>self::$BrochureFile) ; 

		$Queryarray		= array($queryStr,$ColValarray);

		$ArrQueries[]	= $Queryarray;
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
                
        if ($Msg == "success"){
			echo "Saved to My Folder";
        }
		else{
			echo "Error on saving to folder : <br>{$Msg}" ; 
		}
		
    }
    
    public static function DeleteFolder(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        self::GetFormValues();
        $queryStr		= " DELETE from my_folders WHERE MY_FOLDER_ID=:MY_FOLDER_ID";
        
        //echo "folder id = " . self::$FolderId;

		$ColValarray	= array("MY_FOLDER_ID" => self::$Id) ; 

		$Queryarray		= array($queryStr,$ColValarray);

		$ArrQueries[]	= $Queryarray;
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
                
        //echo trim($Msg);
        
        if (trim($Msg) == "success"){
            //?msg=
            self::$SuccessMsg = "DeleteSuccess";
            //include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/myfoldersavesuccess.php" );
            include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/myfoldersavesuccess.php" );
        }
    }
    
    
    public static function DeleteFile(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        self::GetFormValues();
	    
	     $CurDt			= date('Y-m-d H:i:s');
	     
	     
	     $check_count               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT FILES_LIST FROM my_folders where MY_FOLDER_ID='". self::$FolderId ."')");
	     
	     $prevfilename  = isset($check_count["0"]) ? $check_count["0"] : "";
	     
	     //echo ("(SELECT FILES_LIST FROM my_folders where MY_FOLDER_ID='". self::$FolderId ."')");
	     
	     $tempfilename = "";
	     
	     if ($prevfilename != ""){
	         //$prevfilename = self::$BrochureFile;
	         
	         $FileArr = explode(",", $prevfilename);
	         
	         foreach ($FileArr as $FileName){
	             if (self::$BrochureFile != $FileName){
	                 if ($tempfilename == ""){
	                     $tempfilename = $FileName;
	                 }
	                 else{
	                     $tempfilename = $tempfilename . "," . $FileName;
	                 }
	             }
	         }
	     }
	     
	     
	     //echo "<pre>"; print_r($check_count); echo "</pre>";
	     //exit;
        
        $queryStr		= " UPDATE my_folders SET FILES_LIST = :BROCHUREFILENAME WHERE MY_FOLDER_ID=:MY_FOLDER_ID";

		$ColValarray	= array("MY_FOLDER_ID" => self::$FolderId, "BROCHUREFILENAME"=>$tempfilename) ; 

		$Queryarray		= array($queryStr,$ColValarray);

		$ArrQueries[]	= $Queryarray;
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
                
        echo $Msg;
        
    }

	public static function AddFolder(){
		\Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/MyFolderAdd.php" );
	}	
    
	public static function AddFiles(){
		\Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 

		self::GetFormValues();
		self::GetMyFolderDbValues();

		//echo "Id =" . self::$Id;

	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/MyFolderFilesAdd.php" );
	}	
    
    public static function SaveNewFolder(){
        self::GetFormValues();
        \Html\HtmlClass::init();
        
        $CurDt			= date('Y-m-d H:i:s');
        
        $queryStr		= "INSERT INTO my_folders(DOC_NAME, DOC_REMARKS, FILES_LIST, CREATED_DT) VALUES( :DOC_NAME, :DOC_REMARKS, :FILES_LIST, :CREATED_DT, :AMOUNT )";

		$ColValarray	= array("DOC_NAME" => self::$DocName, "DOC_REMARKS"=>self::$DocRemarks, "FILES_LIST"=>self::$UploadedFiles, "CREATED_DT"=> $CurDt, "AMOUNT" => self::$Amount) ; 

		$Queryarray		= array($queryStr,$ColValarray);

		$ArrQueries[]	= $Queryarray;
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
                
        if ($Msg == "success"){
			echo "Folder saved successfully";
        }
		else{
			echo "Error on saving folder : <br>{$Msg}" ; 
		}
    }
    
    public static function myfoldersave(){
        self::GetFormValues();
        \Html\HtmlClass::init();
        
        
        
        $CurDt = date('Y-m-d H:i:s');
        
        $queryStr = "INSERT INTO my_folders(DOC_NAME, DOC_REMARKS, FILES_LIST, CREATED_DT) VALUES( :DOC_NAME, :DOC_REMARKS, :FILES_LIST, :CREATED_DT )";
        
        //'" . self::$DocName . "', '" . self::$DocRemarks . "', '" . self::$UploadedFiles . "', CURRENT_DATE
        
        //="insert into country_master(country_code, country_name, currency, image) values (:country_code, :country_name, :currency, :image)";


		$ColValarray = array("DOC_NAME" => self::$DocName, "DOC_REMARKS"=>self::$DocRemarks, "FILES_LIST"=>self::$UploadedFiles, "CREATED_DT"=> $CurDt, "AMOUNT" => self::$Amount) ; 
		
		
		echo "<pre>"; print_r($ColValarray); echo "</pre>"; exit;
		$Queryarray = array($queryStr,$ColValarray);

		$ArrQueries[]=$Queryarray;
        $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
        
        echo "Msg => {$Msg}";
        exit;
        
        if ($Msg == "success"){
            
            include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/myfoldersavesuccess.php" );
        }
        
    }
    
	public static function myfolder(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        self::GetFormValues();
        
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/myfolderindex.php" );
    }
    
    
    public static function SaveNewFile(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        self::GetFormValues();
        
        //echo "mode=" . self::$Mode;
		//exit;
        
        
        if (self::$Mode == "upload"){
            self::myfolderfileupload();
        }
        else{
            include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/myfolder.php" );
        }
    }
    
    public static function myfolderadd(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        self::GetFormValues();
        
        //echo "mode={$Mode}";
        
        
        if (self::$Mode == "upload"){
            self::myfolderfileupload();
        }
        else{
            include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/myfolder.php" );
        }
    }
    
    
    public static function myfolderview(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        self::GetFormValues();
        
        //echo "mode={$Mode}";
        
        self::$Mode = "view";
        
        //if ($Mode == "view"){
            self::GetMyFolderDbValues();
       //}
        
        
        
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/myfolder.php" );
        
    }
    
    
    public static function myfolderfileupload(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        self::GetFormValues();
        
        //echo "<pre>"; print_r($_FILES); ECHO "</pre>"; 
        //exit; 
        
        /*$ProjectId, $FinYr, $Category*/
        
		$ArrQueries						= array();
		$CurDt = date('Y-m-d H:i:s');

        //echo "out";
        //echo "<pre>"; print_r($_FILES); echo "</pre>";

        if (isset($_FILES["UploadFile"]["tmp_name"])){
            //echo "in";
            //echo "<pre>"; print_r($_REQUEST); echo "</pre>";
            
            $tmpname = $_FILES["UploadFile"]["tmp_name"];
            $filename = $_FILES["UploadFile"]["name"];
            $actfilename = str_replace(",", "_", $filename); 
            $UplFilePath = "uploads/myfolder/" . $actfilename; 
            
            if (move_uploaded_file($tmpname, $UplFilePath) ){
                //PROJECT_ID, 
                $queryStr = "INSERT INTO my_folders(DOC_NAME, DOC_REMARKS, FILES_LIST, CREATED_DT, CATEGORY, FINANCE_YR, AMOUNT, PROJECT_NAME, UNIT_NO, COUNTRY_CODE, CURRENCY_ID, CREATED_BY) 
                             VALUES( :DOC_NAME, :DOC_REMARKS, :FILES_LIST, :CREATED_DT, :CATEGORY, :FINANCE_YR, :AMOUNT, :PROJECT_NAME, :UNIT_NO, :COUNTRY_CODE, :CURRENCY_ID, :CREATED_BY )";
                
                /*"PROJECT_ID" => self::$ProjectId,*/
                
                $CurSession = \settings\session\sessionClass::GetSessionDisplayName();
                
        		$ColValarray = array("DOC_NAME" => self::$DocName, "DOC_REMARKS"=>self::$DocRemarks, "FILES_LIST"=>$actfilename, "CREATED_DT"=> $CurDt,  "CATEGORY" => SELF::$Category, "FINANCE_YR" => self::$FinYr, "AMOUNT" => self::$Amount, 
        		    "PROJECT_NAME" => self::$ProjectName, 
        		    "UNIT_NO" => self::$UnitNo, 
        		    "COUNTRY_CODE" => self::$PropertyCountryId, 
        		    "CURRENCY_ID" => self::$currencyId, 
        		    "CREATED_BY" => $CurSession) ; 
        		
        		//echo "<pre>"; print_r($ColValarray); echo "</pre>";
        		//exit; 
        		
        		
        		$Queryarray = array($queryStr,$ColValarray);
        
        		$ArrQueries[]=$Queryarray;
                $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
                
                //echo "Msg => {$Msg}";
                
                if ($Msg == "success"){
                    
                    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/myfoldersavesuccess.php" );
                }
                else{
                    echo $Msg;
                }

            }
        }

    }

	
	
	public static function myfolderfileupdate(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        self::GetFormValues();
        
        //echo "<pre>"; print_r($_FILES); ECHO "</pre>"; 
        //exit; 
        
        /*$ProjectId, $FinYr, $Category*/
        
		$ArrQueries						= array();
		$CurDt = date('Y-m-d H:i:s');

        //echo "out";
        //echo "<pre>"; print_r($_FILES); echo "</pre>";
        //exit;
        
        
        $actfilename = ""; 

        if (isset($_FILES["UploadFile"]["tmp_name"])){
            //echo "in";
            //echo "<pre>"; print_r($_REQUEST); echo "</pre>";
            
            $tmpname = $_FILES["UploadFile"]["tmp_name"];
            $filename = $_FILES["UploadFile"]["name"];
            $actfilename = str_replace(",", "_", $filename); 
            $UplFilePath = "uploads/myfolder/" . $actfilename; 
            
            if (move_uploaded_file($tmpname, $UplFilePath) ){
                
                

            }
        }
        
        if ($actfilename == ""){
            $check_count = \DBConn\DBConnection::getQueryFetchColumn("(SELECT FILES_LIST FROM my_folders where MY_FOLDER_ID='".self::$Id."')");
            $actfilename = $check_count["0"];
        }
        
        /*PROJECT_ID = :PROJECT_ID,*/  
        
        $queryStr = "UPDATE my_folders SET DOC_NAME = :DOC_NAME, DOC_REMARKS = :DOC_REMARKS, FILES_LIST = :FILES_LIST, 
                     CATEGORY = :CATEGORY, FINANCE_YR = :FINANCE_YR, AMOUNT = :AMOUNT,
                     PROJECT_NAME = :PROJECT_NAME, UNIT_NO = :UNIT_NO,
                     COUNTRY_CODE = :COUNTRY_CODE, CURRENCY_ID = :CURRENCY_ID
                     where MY_FOLDER_ID = :MY_FOLDER_ID";

		$ColValarray = array("DOC_NAME" => self::$DocName, "DOC_REMARKS"=>self::$DocRemarks, 
		                     "FILES_LIST"=>$actfilename, /*"PROJECT_ID" => self::$ProjectId, */ 
		                     "CATEGORY" => SELF::$Category, "FINANCE_YR" => self::$FinYr, "AMOUNT" => self::$Amount,
		                     "MY_FOLDER_ID" => self::$Id,
		                     "PROJECT_NAME" => self::$ProjectName, 
		                     "UNIT_NO" => self::$UnitNo, 
		                     "COUNTRY_CODE" => self::$PropertyCountryId, 
		                     "CURRENCY_ID" => self::$currencyId
                     
                     ) ; 
		
		//echo "<pre>"; print_r($ColValarray); echo "</pre>";
		//exit; 
		
		
		$Queryarray = array($queryStr,$ColValarray);

		$ArrQueries[]=$Queryarray;
        $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
        
        //echo "Msg => {$Msg}";
        
        if ($Msg == "success"){
            
            include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/myfoldersavesuccess.php" );
        }
        else{
            echo $Msg;
        }

    }

		
		
		
    
    public static function GetUploadedFiles(){
        $Uploaded = self::$UploadedFiles;
        
        $UplStr = "<div class='card-body'>
               <div class='card-title'>FILES</div>
               <a href='javascript:void(0)' class='btn btn-primary btn-block' onclick=\"AddFilesFn('" . self::$Id . "')\" >Add files to folder/</a>     
               <table class='table'>
                   <thead>
                       <tr>
                           <th>File Name</th>
                            <th align='right'>Action</th>
                       </tr>
                   </thead>
                    <tbody>";
                        if ($Uploaded != ""){
                        $UploadedArr = explode(",", $Uploaded);
                        
                        foreach ($UploadedArr as $i => $tmpfilename){
                        $UplStr .= "<tr trrow='{$i}'>
                                          <td><a href='uploads/myfolder/{$tmpfilename}' target='blank' class='afullwidth'>{$tmpfilename}</a></td>";
                            
                            if (self::$Mode != "view"){             
                                $UplStr .= "	<td align='center'>
            										<a class='btn btn-danger' href='javascript:void(0)' onclick=\"DeleteFileFn('" . self::$Id . "', '{$tmpfilename}')\"><i class='fa fa-trash'></i></a>
            									</td>";
                            }
                            else{
                                $UplStr .= "  <td>&nbsp;</td>";
                            }
                            
                            $UplStr .= "</tr>"; 
                        }
                    }
        
        
        		$UplStr .= "
               
                    </tbody>
                </table>
            </div>";
            
        
        return $UplStr;
    }
    
    
    
    
    /*
	public static function GetUploadedFiles(){
        $Uploaded = self::$UploadedFiles;
        
        $UplStr = '';
        
        if ($Uploaded != ""){
        
            $UploadedArr = split(",", $Uploaded);
            
            $UplStr = '<table class="table filestable">
              <thead>
                <tr>
                    <th>FILE NAME</th> 
    				<th>ACTION</th>
                </tr>
              </thead>
              <tbody>'; 
            
            foreach ($UploadedArr as $i => $tmpfilename){
                
                $UplStr .= "<tr trrow='{$i}'>
                              <td><a href='uploads/myfolder/{$tmpfilename}' target='blank'>{$tmpfilename}</a></td>";
                
                if (self::$Mode != "view"){             
                    $UplStr .= "  <td><a href='javascript:void(0);' onclick=\"DeleteFile('{$i}', '{$tmpfilename}')\">Remove</a></td>";
                }
                else{
                    $UplStr .= "  <td>&nbsp;</td>";
                }
                
                $UplStr .= "</tr>";
              
            }
            
            $UplStr .= "</tbody>
            </table>";
        }
        
        return $UplStr;
    }
    */
    
    
    
	public static function Country(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/Country.php" );
    }
    public static function ProjectMaster(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/ProjectMaster.php" );
    }
    public static function UserMaster(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/UserMaster.php" );
    }
    public static function GetPorjectDatas($id){
        if($id!="" || $id !=null)
        { 
            $Cond=" where project_id='".$id."' ";
        }
        else
        {
            $Cond="";
        }
        $IndexQry	= "    SELECT
                                pj.PROJECT_ID,
                                pj.PROJECT_NAME,
                                pj.PROJECT_DESCRIPTION,
                                pj.COUNTRY,
                                pj.currency,
                                pj.image_file,
                                pj.image_file1,
                                pj.image_file2,
                                pj.image_file3,
                                pj.subrub,
                                pj.location_id,
                                pj.completion_date,
                                pj.key_features,
                                pj.about_project,
                                pj.short_description,
                                pj.country_state_code,
                                pj.no_of_property,
                                DATE_FORMAT(pj.expiry_date,'%Y-%m-%d') as expiry_date,
                                DATE_FORMAT(pj.effective_date,'%Y-%m-%d') as effective_date
                            FROM
                                project pj ".$Cond ;
          
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
                        
    }
    
    public static function GetUserData($Cond=""){
        $IndexQry	= "    SELECT
                                a.id,a.user_id,first_name,last_name,a.phone_no,a.user_type_id,b.user_type,referred_by,a.address,a.image_file,a.created_on,d.country_name,a.active_status,payment_type,DATE_FORMAT(login_date,'%d-%m-%Y %r') as login_date,(SELECT CONCAT_WS( ' ', first_name, last_name ) from user_master z where z.id=a.advisor) as advisor
                            FROM
                                user_master a,user_type_master b,user_account_details c,country_master d where a.user_type_id=b.user_type_id And c.user_id=a.id and c.country=d.country_code ".$Cond ;
          
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
                        
    }
    public static function GetExchangeRate($id){
        if($id!="" || $id !=null)
        { 
            $Cond=" and a.base_currency='".$id."' ";
        }
        else
        {
            $Cond="";
        }
        $IndexQry	= "    SELECT
                                base_currency,currency,RATE,updated_date,sort_order
                            FROM
                                api_currency_exchange a,currency_master cm
                            where cm.currency_id =a.currency and updated_date=(select MAX(updated_date) from api_currency_exchange b where a.base_currency=b.base_currency)  ".$Cond." order by sort_order" ;
          
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
                        
    }
    public static function GetCurrencyDtl($Cond=""){
        
        $IndexQry	= "SELECT `currency_id`,`description`,`symbol`,`active_status` FROM `currency_master` where active_status='Y' ".$Cond." ORDER BY ISNULL(sort_order),sort_order" ;
         //echo $IndexQry; 
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
                        
    }
    public static function Init(){
         //self::GetFormValues();
         
         //self::$TotalAddRows    = 3;
    }
    public static function Properties(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/Properties.php" );
    }
    public static function PropertDtl(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        
        self::Init(); 
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/PropertDtl.php" );
    }
    public static function GetPropertiesDatas($Id,$country){
        
        if ($Id!="")
        {
            
            $cond=" Where Masters_id='" . $Id . "' ";
            
        }
        else
        {
            $cond=" Where 1=1 ";
        }
        if ($country!="")
        {
            
            $cond=$cond." and country_code='" . $country . "' ";
            
        }
        else
        {
            $cond=$cond."";
        }
        $IndexQry	= "SELECT
                        property_id, property_name, property_address,property_image,
						description, property_type, land_area,no_of_bedrooms, 
						no_of_parkingspace, no_of_bathroom,created_user,
						rate_silver, rate_gold, rate_platinum, country_code
                    FROM
                        property_details " . $cond . "
                    ORDER BY
                        property_name " ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    
    public static function GetCountriesDatas($country=''){
        
        
        if ($country!="")
        {
            
            $cond=" and country_code='" . $country . "' ";
            
        }
        else
        {
            $cond="";
        }
        $IndexQry	= "SELECT
                        country_code,country_name,currency,image,COUNTRY_CODE_NEW
                    FROM
                        country_master where IS_ACTIVATE='Y' " . $cond . "
                    ORDER BY
                        country_name " ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    
    public static function GetCountriesStateDatas($country){
        
        
        if ($country!="")
        {
            
            $cond=" and country_code='" . $country . "' ";
            
        }
        else
        {
            $cond=" and country_code='nz' ";
        }
        $IndexQry	= "SELECT
                        country_code,country_state_code,country_state
                    FROM
                        country_sub_region where 1=1 " . $cond . "
                    ORDER BY
                        country_state " ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    public static function CountryState(){
        $CountryIds=$_REQUEST["CountryIdS"];
         $ContryStaterows=self::GetCountriesStateDatas($CountryIds);
         $str='<select name="CountryStateId" id="CountryStateId" class="form-control">
            <option value="">Select</option>';
            foreach ($ContryStaterows as $ContryStaterow) 
               
              {
                $CountrystateCode=$ContryStaterow["country_state_code"];
                $Countrystate=$ContryStaterow["country_state"];
                if($CountryStateId==$CountrystateCode){
                   $select='SELECTED';
                 }
                 else
                 {
                     $select='';
                 }
                $str= $str.'<option value="'.$CountrystateCode.'" '.$select.' >'.$Countrystate.'</option>';
            }
               
          $str= $str.'</select>';
          return $str;
        
    }
    public static function GetCountyDataByCode($country){
        if ($country!="")
        {    
            $cond=" Where country_code='" . $country . "' ";   
        }
        else
        {
            $cond="";
        }
        $IndexQry	= "SELECT
                        country_code,country_name,currency,image,is_activate
                    FROM
                        country_master " . $cond . "" ;
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }
    
    public static function GetMyFolderDatas(){ 
        $CurSession = \settings\session\sessionClass::GetSessionDisplayName();
        
        $IndexQry	= "SELECT
                            MF.MY_FOLDER_ID,
                            MF.DOC_NAME,
                            MF.DOC_REMARKS,
                            MF.FILES_LIST,
                            MF.CREATED_DT,
                            MF.AMOUNT,
                            MF.FINANCE_YR,
                            MF.PROJECT_ID,
                            MF.CATEGORY,
                            MF.COUNTRY_CODE,
                            MF.CURRENCY_ID,
                            MF.PROJECT_NAME,
                            UNIT_NO
                        FROM
                            my_folders MF 
                        WHERE
                            CREATED_BY = '{$CurSession}' " ;
        
                            
        return \DBConn\DBConnection::getQuery( $IndexQry ); 
    }


    public static function GetMyFolderFilesList( $MyFoldeId ){
        $IndexQry					= "SELECT `FILES_LIST` FROM `my_folders` where MY_FOLDER_ID='{$MyFoldeId}' " ;

		$rows						= \DBConn\DBConnection::getQuery( $IndexQry ); 
		
		foreach ($rows as $row){
			self::$UploadedFiles	= $row["FILES_LIST"];
		}
		
		return self::GetUploadedFiles();
    }
    
    
    public static function save(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        $from                   = $_REQUEST["from"];
        $CountryName1           = strtoupper($_REQUEST["CountryName"]);
        $CountryCode1            = strtoupper($_REQUEST["CountryCode"]);
        $Currency1               = strtoupper($_REQUEST["CurrencyCode"]);
        $FlagImg                = "";
        $IsActivate1             = $_REQUEST["IsActivate"];
        if ($IsActivate1!="Y")
        {
            $IsActivate1="N";
        }
        $ArrQueries             = array();
        //print_r($CountryName ); die;
        if($from=="Country")
        {
            
        $check_count               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(*) check_count FROM country_master where country_code='".$CountryCode1."')");
        
            if ($check_count["0"]>0)
            {
               
                $queryStr="Update country_master Set country_name=:country_name,currency=:currency,image=:image,is_activate=:is_activate where country_code=:country_code";
                $ColValarray = array("country_name"=>$CountryName1,"currency"=>$Currency1 ,"image"=>$FlagImg,"is_activate"=>$IsActivate1,"country_code"=>$CountryCode1 ) ; 
                $Queryarray = array($queryStr,$ColValarray);
                $ArrQueries[]=$Queryarray;
                $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
                 //$Msg="Updated Successfully. <br><br>";
                 $updata = true;
            }
            else
            {
                $queryStr="insert into country_master(country_code, country_name, currency, image,country_map_url,is_activate) values (:country_code, :country_name, :currency, :image,:country_map_url,:is_activate)";


				$ColValarray = array("country_code" => $CountryCode1, "country_name"=>$CountryName1, "currency"=>$Currency1, "image"=>$FlagImg,"country_map_url"=>"","is_activate"=>$IsActivate1) ; 
				$Queryarray = array($queryStr,$ColValarray);

				$ArrQueries[]=$Queryarray;
                $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
            }
        }
        
        
        
        
        
        
        
        \Html\HtmlClass::Init();
        include "header.php";

        echo '	<div id="content">';
        echo	'<div class="widget-title pl-4">
                       <h3>Property - save</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';
        $Listpath =  SITE_BASE_URL. "masters/Country.html?d=".time();
        if ($Msg == "success"){
            if($updata){
                $Msg    =   "Updated Successfully. <a href='" .$Listpath. "'>back</a><br><br>";
            }else{
                $Msg    =   "Saved Successfully. <a href='" .$Listpath. "'>back</a><br><br>";
            }
            
        }
        else{
            $Msg    =   "There is a error while save.(".$Msg.")";
        }
        
        echo '                  <div class="widget-title pl-4">
                                     <h3 align="center"><br/>' . $Msg .'</h3>
                                    
                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        echo '</body></html>';
        include "footer.php";
    }
    
    /**Delete country */
    public static function DeleteCountry()
    {
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        $projectId              = $_REQUEST["countryCode"];
        $ArrQueries             = array();
        $check_count               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(*) check_count FROM country_master where country_code='".$projectId."')");
        if($check_count["0"] > 0)
        {
            $queryStr="Delete from country_master where country_code=:country_code";
    		$ColValarray = array("country_code" => $projectId) ; 
    		$Queryarray = array($queryStr,$ColValarray);
    		$ArrQueries[]=$Queryarray;
            $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
        }
        else 
        {
            $Msg ="This Country having some error";
        }
        \Html\HtmlClass::Init();
        include "header.php";
        $Listpath =  SITE_BASE_URL. "masters/Country.html?d=".time();
        echo '	<div id="content">';
        echo	'<div class="widget-title pl-4">
                       <h3>Project - Delete</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';
        
        if ($Msg == "success"){
            $Msg    =   "Deleted Successfully.  <a href='" .$Listpath. "'>back</a><br><br>";
        }
        else{
            $Msg    =   "There is a error while save.(".$Msg.")";
        }
        
        echo '                  <div class="widget-title pl-4">
                                     <h3 align="center"><br/>' . $Msg .'</h3>
                                    
                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        echo '</body></html>';
        include "footer.php";    
    }
    //=====Projectsave===========
    public static function SaveProject(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        $ProjectName            = $_REQUEST["ProjectName"];
        $Description            = $_REQUEST["Description"];
        $CountryId              = strtoupper($_REQUEST["CountryId"]);
        $currency               = strtoupper($_REQUEST["currency"]);
        $imageFile              = $_REQUEST["imageFile"];
        $imageFile1             = $_REQUEST["imageFile1"];
        $imageFile2             = $_REQUEST["imageFile2"];
        $imageFile3             = $_REQUEST["imageFile3"];
        $Subrub                 = $_REQUEST["Suburb"];
        $LocationId             = $_REQUEST["LocationId"];
        $CompletionDate         = $_REQUEST["CompletionDate"];
        $StartDate              = $_REQUEST["StartDate"];
        $ExpiryDate             = $_REQUEST["ExpiryDate"];
        $KeyFeatures            = $_REQUEST["KeyFeatures"];
        $AoutProperty           = $_REQUEST["AoutProperty"];
        $ShortDescription       = $_REQUEST["ShortDescription"];
        $CountryStateId         = $_REQUEST["CountryStateId"];
        $NoOfProperty         = $_REQUEST["NoOfProperty"];
        $CompletionDate= self::convertDate($CompletionDate, "%Y-%m-%d");
        $StartDate= self::convertDate($StartDate, "%Y-%m-%d");
        $ExpiryDate= self::convertDate($ExpiryDate, "%Y-%m-%d");
        $ArrQueries             = array();
        if($currency=='' || $currency==null)
        {
            $currencyArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master where COUNTRY_CODE='".$CountryId."')");
            $currency   =$currencyArr["0"];
        }
        
        $check_count               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(*) check_count FROM project where PROJECT_NAME='".$ProjectName."')");
        
            if ($check_count["0"]>0)
            {
                $Msg="PROJECT NAME already exist";
                
            }
            else
            {
                $MaxIdArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(project_id), 0) + 1 property_master_auto_id FROM project)");
                $projectId              = $MaxIdArr["0"];
                $queryStr="insert into project(project_id,project_name,project_description,country,currency,image_file,image_file1,image_file2,image_file3,actual_price,start_price,dpo_price,subrub,location_id,completion_date,expiry_date,effective_date,key_features,about_project,short_description,country_state_code,no_of_property) 
                values (:project_id,:project_name,:project_description,:country,:currency,:image_file,:image_file1,:image_file2,:image_file3,:actual_price,:start_price,:dpo_price,:subrub,:location_id,:completion_date,:expiry_date,:effective_date,:key_features,:about_project,:short_description,:country_state_code,:no_of_property)";


				$ColValarray = array("project_id" => $projectId, "project_name"=>$ProjectName, "project_description"=>$Description,"country"=>$CountryId ,"currency"=>$currency, "image_file"=>$imageFile, "image_file1"=>$imageFile1, "image_file2"=>$imageFile2, "image_file3"=>$imageFile3,"actual_price"=>0,"start_price"=>0,"dpo_price"=>0,"subrub"=>$Subrub,
				"location_id"=>$LocationId,"completion_date"=>$CompletionDate,"expiry_date"=>$ExpiryDate,"effective_date"=>$StartDate,"key_features"=>$KeyFeatures,"about_project"=>$AoutProperty,"short_description"=>$ShortDescription,"country_state_code"=>$CountryStateId,"no_of_property"=>$NoOfProperty) ; 
				$Queryarray = array($queryStr,$ColValarray);

				$ArrQueries[]=$Queryarray;
				//=============================================================
				$MaxIdArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(PROPERTY_ID), 0) + 1 PROPERTY_ID FROM property_details)");
                $MaxId                  = $MaxIdArr["0"];
                
                                            
                $PROPERTYExistRowCount   = $_REQUEST["PROPERTYExistRowCount"]; 
                $created_user   		 = \settings\session\sessionClass::GetSessionDisplayName(); 
        
                for ($i = 1; $i <= intval($PROPERTYExistRowCount); $i++){
        			$propertyid			=isset($_REQUEST["propertyid" . $i])? $_REQUEST["propertyid" . $i] : ""; 
        			$Delval			    =isset($_REQUEST["Delval"])? $_REQUEST["Delval"] : ""; 
        			$PropertyDtlStatus	=$_REQUEST["PropertyDtlStatus".$i]; 
        			$ProjectId       	=$projectId;
        			$timeId   		    =$_REQUEST["timeId"].$i; 
                    $building    		= $_REQUEST["building".$i];
        			$ApartmentNo    	= $_REQUEST["ApartmentNo".$i];
        			$UnitNo     		= $_REQUEST["UnitNo".$i];
        			$level       		= $_REQUEST["level".$i];
        			$aspect      		= $_REQUEST["aspect".$i];
        			$FloorType    		= $_REQUEST["FloorType".$i];
        			$LandArea 			= $_REQUEST["LandArea".$i];
        			$ApproxPatioBalcony	= $_REQUEST["ApproxPatioBalcony".$i];
        			$NoOfBedrooms 		= $_REQUEST["NoOfBedrooms".$i];
        			$NoOfBathroom 		= $_REQUEST["NoOfBathroom".$i];
        			$NoOfParkingspace 	= $_REQUEST["NoOfParkingspace".$i];
        			$CreatedUser 		= \settings\session\sessionClass::GetSessionDisplayName();
        			$Rate        		= trim($_REQUEST["Rate".$i]);
        			$StartRate    		= trim($_REQUEST["StartRate".$i]);
        			$DpoRate       		= trim($_REQUEST["DpoRate".$i]);
        			$WeeklyRent 		= trim($_REQUEST["WeeklyRent".$i]);
                    $lockinRate         =0;
                    $Block              = $_REQUEST["Block".$i];
        			$Unit               = $_REQUEST["Unit".$i];
        			$EstCounciTax       = trim($_REQUEST["EstCounciTaxs".$i]);
        			$EstServiceCharge   = trim($_REQUEST["EstServiceCharge".$i]);
        			$EstGroundRent      = trim($_REQUEST["EstGroundRent".$i]);
        			$ReservationFee     = trim($_REQUEST["ReservationFee".$i]);
        			$ExchangeDepositPer = trim($_REQUEST["ExchangeDepositPer".$i]);
        			$StagePayment1      = trim($_REQUEST["StagePayment1".$i]);
        			$timing1            = trim($_REQUEST["timing1".$i]);
        			$StagePayment2      = trim($_REQUEST["StagePayment2".$i]);
        			$timing2            = trim($_REQUEST["timing2".$i]);
                    
        			$MaxIdArr[$i] = $MaxId;
        			$queryStr="insert into property_details(building, apartment_no, unit_no, 
        			level, aspect,floor_type, land_area,approx_patio_balcony, no_of_bedrooms, no_of_bathroom, no_of_parkingspace, created_user, 
        			rate,start_rate,dpo_rate,weekly_rent,project_id,mf_land_tax,BROCHURE_FILE,dynamic_rate,lockin_rate,Block,area_unit,
        			Est_Counci_Tax,Est_Service_Charge,Est_Ground_Rent,Reservation_Fee,Exchange_Deposit_Per,Stage_Payment1,timing1,Stage_Payment2,timing2) values
        			(:building, :apartment_no, :unit_no, 
        			:level, :aspect,:floor_type, :land_area,:approx_patio_balcony, :no_of_bedrooms, :no_of_bathroom, :no_of_parkingspace, :created_user, 
        			:rate,:start_rate,:dpo_rate,:weekly_rent,:project_id,:mf_land_tax,:BROCHURE_FILE,:dynamic_rate,:lockin_rate,:Block,:area_unit,
        			:Est_Counci_Tax,:Est_Service_Charge,:Est_Ground_Rent,:Reservation_Fee,:Exchange_Deposit_Per,:Stage_Payment1,:timing1,:Stage_Payment2,:timing2)";
        
        			$ColValarray = array("building" => $building, "apartment_no" => $ApartmentNo, "unit_no" => $UnitNo,
        											"level" => $level,"aspect" =>$aspect,"floor_type"=>$FloorType,"land_area" => $LandArea,"approx_patio_balcony" => $ApproxPatioBalcony,"no_of_bedrooms" => $NoOfBedrooms,
        											"no_of_bathroom" =>$NoOfBathroom ,"no_of_parkingspace" => $NoOfParkingspace, "created_user"=>$created_user,"rate" => $Rate,"start_rate" => $StartRate,"dpo_rate" => $DpoRate,"weekly_rent" => $WeeklyRent
        											,"project_id" => $ProjectId,"mf_land_tax"=>0,"BROCHURE_FILE"=>'',"dynamic_rate"=>$StartRate,"lockin_rate" => $lockinRate,"Block"=>$Block,"area_unit"=>$Unit,"Est_Counci_Tax"=>$EstCounciTax,"Est_Service_Charge"=>$EstServiceCharge,"Est_Ground_Rent"=>$EstGroundRent
                    ,"Reservation_Fee"=>$ReservationFee,"Exchange_Deposit_Per"=>$ExchangeDepositPer,"Stage_Payment1"=>$StagePayment1,"timing1"=>$timing1,"Stage_Payment2"=>$StagePayment2,"timing2"=>$timing2) ; 
        			$Queryarray = array($queryStr,$ColValarray);
        
        			$ArrQueries[]=$Queryarray;
        			
        			$FloorTypeArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT Count(*) as Count FROM project_floor_type where project_id='".$ProjectId."' and floor_type='".$FloorType."' )");
        			$FloorTypecount= $FloorTypeArr["0"];
        			if($FloorTypecount<1)
        			{
        				$queryStr				 = "insert into project_floor_type(project_id,floor_type)values(:project_id,:floor_type)";
        			
        				$ColValarray			= array("project_id" => $ProjectId, "floor_type" => $FloorType) ; 
        			
        				$Queryarray				= array($queryStr,$ColValarray);
        
        				$ArrQueries[]			=	$Queryarray;
        			}
        			
        			$MaxId++;	
                }
                
				//=============================================================
                $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
            }
        
            	
            if ($Msg == "success"){
                $ProjectRateRows               = \DBConn\DBConnection::getQuery("(select sum(rate) as rate,sum(start_rate) as start_rate,sum(dpo_rate) as pdo_rate from property_details where project_id ='".$ProjectId."')");
        	    foreach($ProjectRateRows as $ProjectRateRow)
        	    {
        		   	$ProjectActualRate= $ProjectRateRow["rate"];
        			$ProjectStartRate= $ProjectRateRow["start_rate"];
        			$ProjectDpoRate= $ProjectRateRow["pdo_rate"];
        			$queryStr				 = "update project set actual_price=:actual_price,start_price=:start_price,dpo_price=:dpo_price where project_id=:project_id";
        				
        			$ColValarray			= array("actual_price"=>$ProjectActualRate ,"start_price"=>$ProjectStartRate,"dpo_price"=>$ProjectDpoRate,"project_id" => $ProjectId) ; 
        		
        			$Queryarray1				= array($queryStr,$ColValarray);
        
        			$ArrQueries1[]			=	$Queryarray1;
        			$Msg1 = \DBConn\DBConnection::pdoRunQuery($ArrQueries1); 
        	    }
                
            }
        
        
        
        
        \Html\HtmlClass::Init();
        include "header.php";
        $Listpath =  SITE_BASE_URL. "masters/projectMaster.html";
        echo '	<div id="content">';
        echo	'<div class="widget-title pl-4">
                       <h3>Project - save</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';
        
        if ($Msg == "success"){
            $Msg    =   "Saved Successfully.  <a href='" .$Listpath. "'>back</a><br><br>";
        }
        else{
            $Msg    =   "There is a error while save.(".$Msg.")";
        }
        
        echo '                  <div class="widget-title pl-4">
                                     <h3 align="center"><br/>' . $Msg .'</h3>
                                    
                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        echo '</body></html>';
        include "footer.php";
    }
    
    public static function Update(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        $ProjectName            = $_REQUEST["ProjectName"];
        $Description            = $_REQUEST["Description"];
        $CountryId              = strtoupper($_REQUEST["CountryId"]);
        $currency               = strtoupper($_REQUEST["currency"]);
        $projectId              = $_REQUEST["ProjectId"];
        $imageFile              = $_REQUEST["imageFile"];
        $imageFile1             = $_REQUEST["imageFile1"];
        $imageFile2             = $_REQUEST["imageFile2"];
        $imageFile3             = $_REQUEST["imageFile3"];
        $Subrub                 = $_REQUEST["Suburb"];
        $LocationId             = $_REQUEST["LocationId"];
        $CompletionDate         = $_REQUEST["CompletionDate"];
        $StartDate              = $_REQUEST["StartDate"];
        $ExpiryDate             = $_REQUEST["ExpiryDate"];
        $KeyFeatures            = $_REQUEST["KeyFeatures"];
        $AoutProperty           = $_REQUEST["AoutProperty"];
        $ShortDescription       = $_REQUEST["ShortDescription"];
        $CountryStateId         = $_REQUEST["CountryStateId"];
        $NoOfProperty           = $_REQUEST["NoOfProperty"];
        $CompletionDate= self::convertDate($CompletionDate, "%Y-%m-%d");
        $StartDate= self::convertDate($StartDate, "%Y-%m-%d");
        $ExpiryDate= self::convertDate($ExpiryDate, "%Y-%m-%d");
        $ArrQueries             = array();
        if($currency=='' || $currency==null)
        {
            $currencyArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT CURRENCY FROM country_master where COUNTRY_CODE='".$CountryId."')");
            $currency   =$currencyArr["0"];
        }
        $queryStr="Update project Set project_name=:project_name,project_description=:project_description,country=:country,currency=:currency,image_file=:image_file,image_file1=:image_file1,image_file2=:image_file2,image_file3=:image_file3,subrub=:subrub,location_id=:location_id,completion_date=:completion_date,expiry_date=:expiry_date,effective_date=:effective_date,key_features=:key_features,about_project=:about_project,short_description=:short_description,country_state_code=:country_state_code,no_of_property=:no_of_property where project_id=:project_id";


		$ColValarray = array("project_name"=>$ProjectName, "project_description"=>$Description,"country"=>$CountryId ,"currency"=>$currency, "image_file"=>$imageFile, "image_file1"=>$imageFile1, "image_file2"=>$imageFile2, "image_file3"=>$imageFile3,"subrub"=>$Subrub,"location_id"=>$LocationId,"completion_date"=>$CompletionDate,"expiry_date"=>$ExpiryDate,"effective_date"=>$StartDate,"key_features"=>$KeyFeatures,"about_project"=>$AoutProperty,"short_description"=>$ShortDescription,"country_state_code"=>$CountryStateId,"no_of_property"=>$NoOfProperty,"project_id" => $projectId) ; 
		$Queryarray = array($queryStr,$ColValarray);

		$ArrQueries[]=$Queryarray;
		//=====================================================Property Update start================================================================
		$MaxIdArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(PROPERTY_ID), 0) + 1 PROPERTY_ID FROM property_details)");
        $MaxId                  = $MaxIdArr["0"];
        
                                    
        $PROPERTYExistRowCount   = $_REQUEST["PROPERTYExistRowCount"]; 
        $created_user   		 = \settings\session\sessionClass::GetSessionDisplayName();
        for ($i = 1; $i <= intval($PROPERTYExistRowCount); $i++){
			$propertyid			=isset($_REQUEST["propertyid" . $i])? $_REQUEST["propertyid" . $i] : ""; 
			$PropertyDtlStatus	=$_REQUEST["PropertyDtlStatus".$i]; 
			$ProjectId       	= $projectId;
			$timeId   		    = $_REQUEST["timeId"].$i; 
            $building    		= $_REQUEST["building".$i];
			$ApartmentNo    	= $_REQUEST["ApartmentNo".$i];
			$UnitNo     		= $_REQUEST["UnitNo".$i];
			$level       		= $_REQUEST["level".$i];
			$aspect      		= $_REQUEST["aspect".$i];
			$FloorType    		= $_REQUEST["FloorType".$i];
			$LandArea 			= $_REQUEST["LandArea".$i];
			$ApproxPatioBalcony	= $_REQUEST["ApproxPatioBalcony".$i];
			$NoOfBedrooms 		= $_REQUEST["NoOfBedrooms".$i];
			$NoOfBathroom 		= $_REQUEST["NoOfBathroom".$i];
			$NoOfParkingspace 	= $_REQUEST["NoOfParkingspace".$i];
			$CreatedUser 		= $_REQUEST["CreatedUser".$i];
			$Rate        		= trim($_REQUEST["Rate".$i]);
			$StartRate    		= trim($_REQUEST["StartRate".$i]);
			$DpoRate       		= trim($_REQUEST["DpoRate".$i]);
			$WeeklyRent 		= trim($_REQUEST["WeeklyRent".$i]);
            $Delval			    = isset($_REQUEST["Delval".$i])? $_REQUEST["Delval".$i] : ""; 
            $lockinRate         =0;
            $Block              = $_REQUEST["Block".$i];
			$Unit               = $_REQUEST["Unit".$i];
			$EstCounciTax       = trim($_REQUEST["EstCounciTaxs".$i]);
			$EstServiceCharge   = trim($_REQUEST["EstServiceCharge".$i]);
			$EstGroundRent      = trim($_REQUEST["EstGroundRent".$i]);
			$ReservationFee     = trim($_REQUEST["ReservationFee".$i]);
			$ExchangeDepositPer = trim($_REQUEST["ExchangeDepositPer".$i]);
			$StagePayment1      = trim($_REQUEST["StagePayment1".$i]);
			$timing1            = trim($_REQUEST["timing1".$i]);
			$StagePayment2      = trim($_REQUEST["StagePayment2".$i]);
			$timing2            = trim($_REQUEST["timing2".$i]);
            // $ConvertDOB         = \OtherFn\OtherFnClass::convertDate($date1, "%Y-%m-%d");
            if($PropertyDtlStatus!="N")
            {
			   
			   if ( $propertyid != "" && $Delval!="Y")
			   {
			       $queryStr				 = "Delete from property_details where property_id  = :property_id";
				
    				$ColValarray			= array("property_id" => $propertyid) ; 
    			
    				$Queryarray				= array($queryStr,$ColValarray);
    
    				$ArrQueries[]			=	$Queryarray;
    				
    				$queryStr				 = "Delete from property_image where property_id  = :property_id";
				
    				$ColValarray			= array("property_id" => $propertyid) ; 
    			
    				$Queryarray				= array($queryStr,$ColValarray);
    
    				$ArrQueries[]			=	$Queryarray;
			   }
			   elseif ( $propertyid != "" && $Delval=="Y" ){
				  
				$queryStr				 = "UPDATE property_details SET building=:building,
												apartment_no=:apartment_no,unit_no=:unit_no,level=:level,aspect=:aspect,floor_type=:floor_type,
												land_area=:land_area,approx_patio_balcony=:approx_patio_balcony,no_of_bedrooms=:no_of_bedrooms,no_of_bathroom=:no_of_bathroom,
												no_of_parkingspace=:no_of_parkingspace,rate=:rate,start_rate=:start_rate,dpo_rate=:dpo_rate,weekly_rent=:weekly_rent,Block=:Block,
												area_unit=:area_unit,Est_Counci_Tax=:Est_Counci_Tax,Est_Service_Charge=:Est_Service_Charge,Est_Ground_Rent=:Est_Ground_Rent,
												Reservation_Fee=:Reservation_Fee,Exchange_Deposit_Per=:Exchange_Deposit_Per,Stage_Payment1=:Stage_Payment1,timing1=:timing1,
												Stage_Payment2=:Stage_Payment2,timing2=:timing2,project_id=:project_id  where property_id  = :property_id";
				
				$ColValarray			= array("building" => $building, "apartment_no" => $ApartmentNo, "unit_no" => $UnitNo,
												"level" => $level,"aspect" =>$aspect,"floor_type"=>$FloorType,"land_area" => $LandArea,"approx_patio_balcony" => $ApproxPatioBalcony,"no_of_bedrooms" => $NoOfBedrooms,
												"no_of_bathroom" =>$NoOfBathroom ,"no_of_parkingspace" => $NoOfParkingspace,"rate" => $Rate,"start_rate" => $StartRate,"dpo_rate" => $DpoRate,"weekly_rent" => $WeeklyRent,
												"Block"=>$Block,"area_unit"=>$Unit,"Est_Counci_Tax"=>$EstCounciTax,"Est_Service_Charge"=>$EstServiceCharge,"Est_Ground_Rent"=>$EstGroundRent,"Reservation_Fee"=>$ReservationFee,
												"Exchange_Deposit_Per"=>$ExchangeDepositPer,"Stage_Payment1"=>$StagePayment1,"timing1"=>$timing1,"Stage_Payment2"=>$StagePayment2,"timing2"=>$timing2,
												"project_id" => $ProjectId,"property_id" => $propertyid) ; 
			
				$Queryarray				= array($queryStr,$ColValarray);
				$ArrQueries[]			=	$Queryarray;
				
				$FloorTypeArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT Count(*) as Count FROM project_floor_type where project_id='".$ProjectId."' and floor_type='".$FloorType."' )");
                $FloorTypecount= $FloorTypeArr["0"];
                if($FloorTypecount<1)
                {
                    $queryStr				 = "insert into project_floor_type(project_id,floor_type)values(:project_id,:floor_type)";
				
    				$ColValarray			= array("project_id" => $ProjectId, "floor_type" => $FloorType) ; 
    			
    				$Queryarray				= array($queryStr,$ColValarray);
    
    				$ArrQueries[]			=	$Queryarray;
                }
				
			   }
			   elseif($Delval=='Y')
			   {
                $MaxIdArr[$i] = $MaxId;
                $queryStr="insert into property_details(building, apartment_no, unit_no, 
    			level, aspect,floor_type, land_area,approx_patio_balcony, no_of_bedrooms, no_of_bathroom, no_of_parkingspace, created_user, 
    			rate,start_rate,dpo_rate,weekly_rent,project_id,mf_land_tax,BROCHURE_FILE,dynamic_rate,lockin_rate,Block,area_unit,
        			Est_Counci_Tax,Est_Service_Charge,Est_Ground_Rent,Reservation_Fee,Exchange_Deposit_Per,Stage_Payment1,timing1,Stage_Payment2,timing2) values
    			(:building, :apartment_no, :unit_no, 
    			:level, :aspect,:floor_type, :land_area,:approx_patio_balcony, :no_of_bedrooms, :no_of_bathroom, :no_of_parkingspace, :created_user, 
    			:rate,:start_rate,:dpo_rate,:weekly_rent,:project_id,:mf_land_tax,:BROCHURE_FILE,:dynamic_rate,:lockin_rate,:Block,:area_unit,
        		:Est_Counci_Tax,:Est_Service_Charge,:Est_Ground_Rent,:Reservation_Fee,:Exchange_Deposit_Per,:Stage_Payment1,:timing1,:Stage_Payment2,:timing2)";
    
    			$ColValarray = array("building" => $building, "apartment_no" => $ApartmentNo, "unit_no" => $UnitNo,
												"level" => $level,"aspect" =>$aspect,"floor_type"=>$FloorType,"land_area" => $LandArea,"approx_patio_balcony" => $ApproxPatioBalcony,"no_of_bedrooms" => $NoOfBedrooms,
												"no_of_bathroom" =>$NoOfBathroom ,"no_of_parkingspace" => $NoOfParkingspace, "created_user"=>$created_user,"rate" => $Rate,"start_rate" => $StartRate,"dpo_rate" => $DpoRate,"weekly_rent" => $WeeklyRent
												,"project_id" => $ProjectId,"mf_land_tax"=>0,"BROCHURE_FILE"=>'',"dynamic_rate"=>$StartRate,"lockin_rate" => $lockinRate,"Block"=>$Block,"area_unit"=>$Unit,"Est_Counci_Tax"=>$EstCounciTax,"Est_Service_Charge"=>$EstServiceCharge,"Est_Ground_Rent"=>$EstGroundRent
                    ,"Reservation_Fee"=>$ReservationFee,"Exchange_Deposit_Per"=>$ExchangeDepositPer,"Stage_Payment1"=>$StagePayment1,"timing1"=>$timing1,"Stage_Payment2"=>$StagePayment2,"timing2"=>$timing2) ; 
    			$Queryarray = array($queryStr,$ColValarray);
    
    			$ArrQueries[]=$Queryarray;
    			
    			$FloorTypeArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT Count(*) as Count FROM project_floor_type where project_id='".$ProjectId."' and floor_type='".$FloorType."' )");
                $FloorTypecount= $FloorTypeArr["0"];
                if($FloorTypecount<1)
                {
                    $queryStr				 = "insert into project_floor_type(project_id,floor_type)values(:project_id,:floor_type)";
				
    				$ColValarray			= array("project_id" => $ProjectId, "floor_type" => $FloorType) ; 
    			
    				$Queryarray				= array($queryStr,$ColValarray);
    
    				$ArrQueries[]			=	$Queryarray;
                }
    			
                $MaxId++;				
			   }
				
            }
        }
		//=====================================================Property Update end==================================================================
        $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
        //=====================================================Points Update========================================================================
        if ($Msg == "success"){
            $ProjectRateRows               = \DBConn\DBConnection::getQuery("(select sum(rate) as rate,sum(start_rate) as start_rate,sum(dpo_rate) as pdo_rate from property_details where project_id ='".$ProjectId."')");
    	    foreach($ProjectRateRows as $ProjectRateRow)
    	    {
    		   	$ProjectActualRate= $ProjectRateRow["rate"];
    			$ProjectStartRate= $ProjectRateRow["start_rate"];
    			$ProjectDpoRate= $ProjectRateRow["pdo_rate"];
    			$queryStr				 = "update project set actual_price=:actual_price,start_price=:start_price,dpo_price=:dpo_price where project_id=:project_id";
    				
    			$ColValarray			= array("actual_price"=>$ProjectActualRate ,"start_price"=>$ProjectStartRate,"dpo_price"=>$ProjectDpoRate,"project_id" => $ProjectId) ; 
    		
    			$Queryarray1				= array($queryStr,$ColValarray);
    
    			$ArrQueries1[]			=	$Queryarray1;
    			$Msg1 = \DBConn\DBConnection::pdoRunQuery($ArrQueries1); 
    	    }
            
        }
        //=====================================================Points Update end====================================================================
        \Html\HtmlClass::Init();
        include "header.php";
        $Listpath =  SITE_BASE_URL. "masters/projectMaster.html";
        echo '	<div id="content">';
        echo	'<div class="widget-title pl-4">
                       <h3>Project - save</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';
        
        if ($Msg == "success"){
            $Msg    =   "Updated Successfully.  <a href='" .$Listpath. "'>back</a><br><br>";
        }
        else{
            $Msg    =   "There is a error while save.(".$Msg.")";
        }
        
        echo '                  <div class="widget-title pl-4">
                                     <h3 align="center"><br/>' . $Msg .'</h3>
                                    
                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        echo '</body></html>';
        include "footer.php";
    }
    public static function DeleteProject()
    {
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession(); 
        $projectId              = $_REQUEST["ProjectId"];
        $ArrQueries             = array();
        $check_count               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(*) check_count FROM property_details where project_id='".$projectId."')");
        if($check_count["0"]==0)
        {
            $queryStr="Delete from project where project_id=:project_id";
    		$ColValarray = array("project_id" => $projectId) ; 
    		$Queryarray = array($queryStr,$ColValarray);
    		$ArrQueries[]=$Queryarray;
            $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
        }
        else 
        {
            $Msg ="This Project is linked with some properties";
        }
        \Html\HtmlClass::Init();
        include "header.php";
        $Listpath =  SITE_BASE_URL. "masters/projectMaster.html";
        echo '	<div id="content">';
        echo	'<div class="widget-title pl-4">
                       <h3>Project - Delete</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';
        
        if ($Msg == "success"){
            $Msg    =   "Deleted Successfully.  <a href='" .$Listpath. "'>back</a><br><br>";
        }
        else{
            $Msg    =   "There is a error while save.(".$Msg.")";
        }
        
        echo '                  <div class="widget-title pl-4">
                                     <h3 align="center"><br/>' . $Msg .'</h3>
                                    
                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        echo '</body></html>';
        include "footer.php";    
    }
    
    public static function CopyText(){
        $key=$_REQUEST["ReferralCode"];
        $ArrQueries             = array();
        $ReferredBy=\settings\session\sessionClass::GetSessionDisplayName();
        
        $check_count               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(*) check_count FROM referral_code where referred_by='".$ReferredBy."' and hash_key='".$key."' )");
        if($check_count["0"]==0)
        {
            $date = date("Y-m-d H:i:s");
            $queryStr="Insert into referral_code (mail_id,hash_key,update_time,is_used,referred_by) values(:mail_id,:hash_key,:update_time,:is_used,:referred_by)";
    		$ColValarray = array("mail_id"=>'XXXXX', "hash_key"=>$key,"update_time"=>$date ,"is_used" => 'P',"referred_by" => $ReferredBy) ; 
    		$Queryarray = array($queryStr,$ColValarray);
    		$ArrQueries[]=$Queryarray;
    		$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
    		return $Msg;
        }
        else
        {
            return "success";
        }
    }
    public static function Refer(){
        $MailArr=$_REQUEST["friend_email"];
        $key=$_REQUEST["Hashkey"];
        $ArrQueries             = array();
        $ReferredBy=\settings\session\sessionClass::GetSessionDisplayName();
        $FullnameArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT concat(first_name,' ',last_name) as Name FROM user_master where id='".$ReferredBy."' )");
        $Fullname=$FullnameArr["0"];
        $date = date("Y-m-d H:i:s");
        
        \Html\HtmlClass::Init();
        include "header.php";
        $Listpath =  SITE_BASE_URL. "login/register.html";
        echo '	<div id="content">';
        echo	    '<div class="widget-title pl-4">
                       <h3>Mail - Referral</h3>
                     </div>';
        echo '		<div class="container">
                        <div class="grid-24">';
                            
        $Flag="P";
        for ($x = 0; $x < count($MailArr); $x++) {
            $queryStr="Insert into referral_code (mail_id,hash_key,update_time,is_used,referred_by) values(:mail_id,:hash_key,:update_time,:is_used,:referred_by)";
    		$ColValarray = array("mail_id"=>$MailArr[$x], "hash_key"=>$key,"update_time"=>$date ,"is_used" => $Flag,"referred_by" => $ReferredBy) ; 
    		$Queryarray = array($queryStr,$ColValarray);
    		$ArrQueries[]=$Queryarray;
            
    		$inputSubject="Mr/Ms. ".$Fullname." Invites you to Join DuVal Proptech";
            $to = stripcslashes($MailArr[$x]);
            $subject = stripcslashes($inputSubject);
    
            $message = '
            <!DOCTYPE html>
            <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
               <style>
               h1.img-caption {
                position: absolute;
                top: 0%;
                left: 37%;
                transform: translate(-50%, -50%);
                font-size: 44px;
                font-weight: 900;
                color: #fff;
            }
               </style>
               <body bgcolor="#FFFFFF" text="#919191" alink="#cccccc" vlink="#cccccc" style="margin: 0; padding: 0; background-color: #3f3f3f; color: #919191;">
                  <center>
                     <table role="presentation" class="vb-outer" width="100%" cellpadding="0" border="0" cellspacing="0" bgcolor="#3f3f3f" style="background-color: #3f3f3f;" id="ko_sideArticleBlock_4">
                        <tbody>
                           <tr>
                              <td class="vb-outer" align="center" valign="top" style="padding-left: 9px; padding-right: 9px; font-size: 0;">
                                 <div style="margin: 0 auto; max-width: 570px; -mru-width: 0px;">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="9" bgcolor="#FFFF94" width="570" class="vb-row" style="border-collapse: separate; width: 100%; background-color: #FFFF94; mso-cellspacing: 9px; border-spacing: 9px; max-width: 570px; -mru-width: 0px;">
                                       <tbody>
                                          <tr>
                                             <td align="center" valign="top" style="font-size: 0;">
                                                <div style="width: 100%; max-width: 552px; -mru-width: 0px;">
                                                   <div class="mobile-full" style="display: inline-block; vertical-align: top; width: 100%; max-width: 184px; -mru-width: 0px; min-width: calc(33.333333333333336%); max-width: calc(100%); width: calc(304704px - 55200%);">
                                                      <table role="presentation" class="vb-content" border="0" cellspacing="9" cellpadding="0" width="184" align="left" style="border-collapse: separate; width: 100%; mso-cellspacing: 9px; border-spacing: 9px; -yandex-p: calc(2px - 3%);">
                                                         <tbody>
                                                            <tr>
                                                               <td width="100%" valign="top" align="center" class="links-color">
                                                                  
            													  <div class="img-wrapper gold-img">
            														<img border="0" hspace="0" align="center" vspace="0" width="166" style="border: 0px; display: block; vertical-align: top; height: auto; margin: 0 auto; color: #3f3f3f; font-size: 13px; font-family: Arial, Helvetica, sans-serif; width: 100%; max-width: 166px; height: auto;" src="https://duvalknowledge.com/dpo/assets/img/Layer-19.png" class="img-fluid">
            														<h1 class="img-caption">DPO</h1>
            													  </div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                   <div class="mobile-full" style="display: inline-block; vertical-align: top; width: 100%; max-width: 368px; -mru-width: 0px; min-width: calc(66.66666666666667%); max-width: calc(100%); width: calc(304704px - 55200%);">
                                                      <table role="presentation" class="vb-content" border="0" cellspacing="9" cellpadding="0" width="368" align="left" style="border-collapse: separate; width: 100%; mso-cellspacing: 9px; border-spacing: 9px; -yandex-p: calc(2px - 3%);">
                                                         <tbody>
                                                            <tr>
                                                               <td width="100%" valign="top" align="left" style="font-weight: normal; color: #3f3f3f; font-size: 18px; font-family: Arial, Helvetica, sans-serif; text-align: left;"><span style="font-weight: normal;">DU VAL PRIVATE OFFICE</span></td>
                                                            </tr>
                                                            <tr>
                                                               <td class="long-text links-color" width="100%" valign="top" align="left" style="font-weight: normal; color: #3f3f3f; font-size: 13px; font-family: Arial, Helvetica, sans-serif; text-align: left; line-height: normal;">
                                                                  <p style="margin: 1em 0px; margin-bottom: 0px; margin-top: 0px;">We provide everything people need to make successful property investing decisions and grow their portfolios.</p>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                               <td valign="top" align="left">
                                                                  <table role="presentation" cellpadding="6" border="0" align="left" cellspacing="0" style="border-spacing: 0; mso-padding-alt: 6px 6px 6px 6px; padding-top: 4px;">
                                                                     <tbody>
                                                                        <tr>
                                                                           <td width="auto" valign="middle" align="left" bgcolor="#444444" style="text-align: center; font-weight: normal;
                                                                           padding: 6px; padding-left: 18px; padding-right: 18px; background-color: #3f3f3f; color: #FFFFFF; font-size: 13px;
                                                                           font-family: Arial, Helvetica, sans-serif; border-radius: 4px;"><a style="text-decoration: none; font-weight: normal;
                                                                           color: #FFFFFF; font-size: 13px; font-family: Arial, Helvetica, sans-serif;" target="_new" 
                                                                           href="' .$Listpath.'?ReferralCode='.$key.'">REGISTERATION</a></td>
                                                                        </tr>
                                                                     </tbody>
                                                                  </table>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </center>
               </body>
            </html>
            ';
             $ccBcc="bathar.ghouse@gmail.com";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'Cc: '.$ccBcc.'' . "\r\n";
            $headers .= "From: <info@duvalknowledge.co.nz>" . "\r\n";
            $sent = mail($to,$subject,$message,$headers);
            $mailIds.=$to." ";
            if($sent){
             $ErrMsg= "Referred Successfully to";
            }
            else{
             $ErrMsg= "Sorry! Your submission is failed to .";
            }
                
        }
        echo '          <div class="widget-title pl-4">
                            <h3 align="center"><br/>'.$ErrMsg.' '.$mailIds.' <input type="hidden" value="' .$Listpath.'?ReferralCode='.$key.'" id="myInput">
                            <button onclick="myFunction()">Copy Referral</button><br><br></h3>  
                        </div>';
                            
            
		$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
       
        echo '			</div>
                    </div>
                </div>';

        echo '</body>
        </html>
        <script>
        function myFunction() {
          var copyText = document.getElementById("myInput");
          copyText.type="text";
          copyText.select();
          copyText.setSelectionRange(0, 99999)
          document.execCommand("copy");
          copyText.type="hidden";
        }
        </script>';
        include "footer.php";  
        
    }
    public static function SMS(){
        \Html\HtmlClass::Init();
        include "header.php";
        $Listpath =  SITE_BASE_URL. "login/register.html";
        echo '	<div id="content">';
        echo	    '<div class="widget-title pl-4">
                       <h3>Mail - Referral</h3>
                     </div>';
        echo '		<div class="container">
                        <div class="grid-24">';
        $apiKey = urlencode('WZGShhEtJgY-9UnH8rkr4Q6ErUtQCh3IswAGtYkGae');
        // Account details
       // Message details
        $numbers = urlencode(9677700789);
        $sender = urlencode('TXTLCL');
        $message = rawurlencode('This is your message');
         
        // Prepare data for POST request
        $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . '&sender=' . $sender . '&message=' . $message;
        // Send the GET request with cURL
        $ch = curl_init('https://api.textlocal.in/send/?' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        echo '          <div class="widget-title pl-4">
                            <h3 align="center"><br/>'.$response.'<br><br></h3>  
                        </div>';
                            
            
		$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries); 
       
        echo '			</div>
                    </div>
                </div>';

        echo '</body>
        </html>';
        include "footer.php";  
        
    }
    public static function convertDate($date , $dateFormat = '%d-%m-%Y %H:%M:%S'){
		$date       = str_replace("/" , "-" , $date);
		$timestamp  = strftime($date);
		return strftime($dateFormat , strtotime($timestamp));
    }
}	