<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Html\Elements;

use Html; 
use settings\constants; 
/**
 *
 * @author Yasir
 */
interface InputsInterface {
    //put your code here
    public static function plotCombo( $dropdownName , $SQL = NULL , $dropdownSelVal = null , $SelectOption = null, $OtherParam = null); 
    
    public static function plotAcGroupDp( $Name , $SelValue = null, $SelectOption = null, $OtherParam = null );
    public static function plotBankDp( $Name , $SelValue = null, $SelectOption = null, $OtherParam = null );
}

class InputsClass implements InputsInterface{
    private static $Result; 
    private static $SQL_Qry; 
    
    //private static $Recd_Field_Name; 
    //private static $Recd_Sel_Value; 
    //private static $Recd_Select_Option; 
    //private static $Recd_Other_Param; 
    //private static $Return_Combo_Str; 
    
    public static function ShowFinYrDropdown( $Name , $Filter_Array = array() , $SelValue = null, $SelectOption = null, $OtherParam = null, $PassOtherValue = null ){
        //self::$SQL_Qry              = "Select id, GroupName as description from acgroup";
        
        if ($SelValue == null or $SelValue == "")
            $SelValue               = intval(date("Y")); 
        
        if ($SelectOption == null)
            $SelectOption           = "-- Please select Ac Group --";
        
        //$CountryId                  = isset($Filter_Array["country_id"]) ? $Filter_Array["country_id"] : "1"; 
        $CountryId                  = isset($PassOtherValue) ? $PassOtherValue : "1"; 
        
        if ( $CountryId == "3" ){
            $dropdownType           = "GB_FINANCIAL_YR"; 
        }
        else if ( $CountryId == "2" ){
            $dropdownType           = "AU_FINANCIAL_YR"; 
        }
        else{
            $dropdownType           = "NZ_FINANCIAL_YR"; 
        }
        
        return self::plotArrayCombo( $Name, $dropdownType, $SelValue, $SelectOption, $OtherParam  );
    }
    
    
    public static function ProjectCategoryArrayData(){
        return array( "LettingFee"      => "Letting and Management Fee", 
                      "ServiceChg"      => "Service Charges", 
                      "GroundRent"      => "Ground Rent", 
                      "MaintenanceInv"  => "Maintenance Invoice", 
                      "Other"           => "Other",
                      "GeneralAccInfo"  => "General Accounting information"
                      );
    }
    
    public static function FinanceYearArrayData( $PassOtherValue = null ){
        $DpArr                  = array();
        $CurYr                  = intval(date("Y")); 
            
        if ($PassOtherValue == null or $PassOtherValue == "")
            $PassOtherValue     = "1"; 
            
        /*
        New Zealand: 1 April to 31st March 
        Australia: 1 July to 31st October
        UK: 6 April to 5 April
        */
        
        if ($PassOtherValue == "3"){
            for ( $i = $CurYr - 3; $i <= $CurYr + 1; $i++){
                $NextYr             = $i + 1; 
                $DpArr[$i]      = "{$PassOtherValue} (6 April {$i} - 5 April {$NextYr})"; 
            }
        }
        else if ($PassOtherValue == "2"){
            for ( $i = $CurYr - 3; $i <= $CurYr + 1; $i++){
                $NextYr             = $i + 1; 
                $DpArr[$i]      = "{$PassOtherValue} (1 July {$i} - 31 October {$NextYr})"; 
            }
        }
        else{
            for ( $i = $CurYr - 3; $i <= $CurYr + 1; $i++){
                $NextYr             = $i + 1; 
                $DpArr[$i]      = "{$PassOtherValue} (1 April {$i} - 31 March {$NextYr})"; 
            }
        }
        
        return $DpArr;
    }
    
    
    public static function GetFinYrValue($FnValue,  $PassOtherValue = null ){
        $Arr1           = self::FinanceYearArrayData( $PassOtherValue );
        return isset($Arr1[$FnValue]) ? $Arr1[$FnValue] : ""; 
    }
    
    public static function GetProjCategoryValue($FnValue ){
        $Arr1           = self::ProjectCategoryArrayData();
        return isset($Arr1[$FnValue]) ? $Arr1[$FnValue] : ""; 
    }
    
    
    
    public static function plotArrayCombo( $dropdownName, $dropdownType, $dropdownSelVal = null, $SelectOption = null, $OtherParam = null, $PassOtherValue = null  ){
        //echo $dropdownType;
        if ($dropdownType == "NZ_FINANCIAL_YR"){
            $DpArr                  = self::FinanceYearArrayData("1"); 
        }
        else if ($dropdownType == "GB_FINANCIAL_YR"){
            $DpArr                  = self::FinanceYearArrayData("3"); 
        }
        else if ($dropdownType == "AU_FINANCIAL_YR"){
            $DpArr                  = self::FinanceYearArrayData("2"); 
        }
        else if ($dropdownType == "CATEGORY"){
            $DpArr = self::ProjectCategoryArrayData(); 
            
            /*array( "LettingFee" => "Letting and Management Fee", "ServiceChg" => "Service Charges", "GroundRent" => "Ground Rent", "MaintenanceInv" => "Maintenance Invoice");*/
        }
        else if ($dropdownType == "prod_type"){
            $DpArr = array( "CREDIT" => "CREDIT", "DIESEL" => "DIESEL", "PETROL" => "PETROL", "OIL" => "OIL" , "ESTIMATION" => "ESTIMATION" );
        }
        else if ($dropdownType == "AU_LOCATIONS"){
            $DpArr = array( "ACT" => "ACT", "NSW" => "NSW", "NT" => "NT", "QLD" => "QLD" , "SA" => "SA" , "TAS" => "TAS" , "VIC" => "VIC" , "WA" => "WA" );
        }
        else if ($dropdownType == "bill_type"){
            $DpArr = array( "CASH" => "CASH", "CREDIT" => "CREDIT" );
        }
        else if ($dropdownType == "prod_type_dummy"){
            $DpArr = array( "DIESEL" => "DIESEL", "PETROL" => "PETROL" );
        }
        else if ($dropdownType == "GSTTaxType"){
            $DpArr = array( "SGST" => "SGST", "IGST" => "IGST" );
        }
        else if ($dropdownType == "payment_mode"){
            $DpArr = array( "BANK" => "BANK", "CASH" => "CASH" );
        }
        else if ($dropdownType == "bank_mode"){
            $DpArr = array( "CHEQUE" => "CHEQUE", "DD" => "DD", "RTGS" => "RTGS", "NEFT" => "NEFT" );
        }
        //
        else if ($dropdownType == "yes_no"){
            $DpArr = array( "NO" => "NO", "YES" => "YES" );
        }
        else if ($dropdownType == "sales_type"){
            $DpArr = array( "PACK" => "PACK", "LOOSE" => "LOOSE" );
        }
        //
        
        if ($OtherParam == null)
            $OtherParam       = " class='" . DEFAULT_INPUT_CLASS . "' "; 
        
        $DropdownStr    = "<select name='{$dropdownName}' id = '{$dropdownName}' {$OtherParam}>";
	
		if ($SelectOption != "" and $SelectOption != null ){
			$DropdownStr .= "<option value = ''>{$SelectOption}</option>";
		}
        
        foreach($DpArr as $id => $value){
            if($id == $dropdownSelVal){	
                $DropdownStr .= " <option selected = 'selected' value = '{$id}'>{$value}</option>";
            }
            else{
                $DropdownStr .=  " <option  value = '{$id}'>{$value}</option>";
            }
        }

	$DropdownStr .=  "</select>";
        
	return $DropdownStr;
    }
    
    public static function plotCombo( $dropdownName , $Filter_Array = array() , $SQL = null , $dropdownSelVal = null , $SelectOption = null, $OtherParam = null){
        //plotCombo( $dropdownName , $SQL , $dropdownSelVal = null , $styleStr = null , $SelectOption = "-- Please Select --", $JavascriptStr = null)
        if ( $SQL == null || $SQL == "")
            return "";
        
        //echo $SQL;
        
        if ( $dropdownName == null || $dropdownName == "")
            return "";
        
        if ($OtherParam == null)
            $OtherParam       = " class='" . DEFAULT_INPUT_CLASS . "' "; 
        
        $prodDropdownStr    = "<select name='{$dropdownName}' id = '{$dropdownName}' {$OtherParam}>";
	
    	if ($SelectOption != "" and $SelectOption != null ){
                $prodDropdownStr .= "<option value = ''>{$SelectOption}</option>";
    	}
    	
    	if ( $SQL != "" ){
    			//echo $SQL; 
                self::$Result   = \DBConn\DBConnection::getQuery( $SQL ); 
                
                foreach(self::$Result as $row){
                    if($row["id"] == $dropdownSelVal){	
                        $prodDropdownStr .= " <option selected = 'selected' value = '{$row["id"]}'>{$row["description"]}</option>";
                    }
                    else{
                        $prodDropdownStr .=  " <option  value = '{$row["id"]}'>{$row["description"]}</option>";
                    }
                }
    	}
    	$prodDropdownStr .=  "</select>";
            
    	return $prodDropdownStr;
    }
    
    
    
    
    public static function plotAcGroupDp( $Name , $Filter_Array = array() , $SelValue = null, $SelectOption = null, $OtherParam = null ){
        self::$SQL_Qry              = "Select id, GroupName as description from acgroup";
        
        if ($SelectOption == null)
            $SelectOption           = "-- Please select Ac Group --";
        
        return self::plotCombo( $Name , $Filter_Array , self::$SQL_Qry , $SelValue , $SelectOption, $OtherParam);
    }
    
    
    public static function plotShiftDp( $Name , $SelValue = null, $SelectOption = null, $OtherParam = null ){
        return self::plotArrayCombo( $Name, "shift", $SelValue, $SelectOption, $OtherParam );
    }
       
    public static function plotProdTypeDp( $Name , $SelValue = null, $SelectOption = null, $OtherParam = null ){
        return self::plotArrayCombo( $Name, "prod_type", $SelValue, $SelectOption, $OtherParam );
    }
    
    public static function plotDummyProdTypeDp( $Name , $SelValue = null, $SelectOption = null, $OtherParam = null ){
        return self::plotArrayCombo( $Name, "prod_type_dummy", $SelValue, $SelectOption, $OtherParam );
    }
    
    
    
    public static function plotBankDp( $Name , $Filter_Array = array() , $SelValue = null, $SelectOption = null, $OtherParam = null ){
        self::$SQL_Qry              = "Select id, BankName as description from bank";
        
        if ($SelectOption == null)
            $SelectOption           = "-- Please select Bank --";
        
        return self::plotCombo( $Name , $Filter_Array , self::$SQL_Qry , $SelValue , $SelectOption, $OtherParam);
    }
    
    public static function plotCustomerDp( $Name , $Filter_Array = array() , $SelValue = null, $SelectOption = null, $OtherParam = null ){
        self::$SQL_Qry              = "Select id, CusName as description from customer";
        
        if ($SelectOption == null)
            $SelectOption           = "-- Please select Customer --";
        
        return self::plotCombo( $Name , $Filter_Array , self::$SQL_Qry , $SelValue , $SelectOption, $OtherParam);
    }
    
    public static function plotLedgerDp( $Name , $Filter_Array = array() , $SelValue = null, $SelectOption = null, $OtherParam = null ){
        self::$SQL_Qry              = "Select id, LedgerName as description from ledger";
        
        if ($SelectOption == null)
            $SelectOption           = "-- Please select Ledger --";
        
        return self::plotCombo( $Name , $Filter_Array , self::$SQL_Qry , $SelValue , $SelectOption, $OtherParam);
    }
    
    public static function plotProductDp( $Name , $Filter_Array = array() , $SelValue = null, $SelectOption = null, $OtherParam = null ){
        self::$SQL_Qry              = "Select ID as id, ProdName as description from products";
        
        if ($SelectOption == null)
            $SelectOption           = "-- Please select Product --";
        
        return self::plotCombo( $Name , $Filter_Array , self::$SQL_Qry , $SelValue , $SelectOption, $OtherParam);
    }

    public static function plotPumpDp( $Name , $Filter_Array = array() , $SelValue = null, $SelectOption = null, $OtherParam = null ){
        self::$SQL_Qry              = "Select ID as id, concat_ws('', PumpName, ' / ', Product) as description from pumps";
        
        if ($SelectOption == null)
            $SelectOption           = "-- Please select Pumps --";
        
        return self::plotCombo( $Name , $Filter_Array , self::$SQL_Qry , $SelValue , $SelectOption, $OtherParam);
    }

    public static function plotSupplierDp( $Name , $Filter_Array = array() , $SelValue = null, $SelectOption = null, $OtherParam = null ){
        self::$SQL_Qry              = "Select ID as id, SupName as description from supplier";
        
        if ($SelectOption == null)
            $SelectOption           = "-- Please select Suppliers --";
        
        return self::plotCombo( $Name , $Filter_Array , self::$SQL_Qry , $SelValue , $SelectOption, $OtherParam);
    }

    public static function plotVehiclesDp( $Name , $Filter_Array = array(), $SelValue = null, $SelectOption = null, $OtherParam = null ){
        self::$SQL_Qry              = "Select ID as id, VehNo as description from vehicles";
        
        if ($SelectOption == null)
            $SelectOption           = "-- Please select Vehicles --";
        
        return self::plotCombo( $Name , $Filter_Array , self::$SQL_Qry , $SelValue , $SelectOption, $OtherParam);
    }

    public static function plotPumpTypeDp( $Name , $Filter_Array = array(), $SelValue = null, $SelectOption = null, $OtherParam = null ){
        self::$SQL_Qry              = "Select Pump_Type_ID as id, Pump_Type_Name as description from tbl_pump_type where Is_Deleted='0' and Is_Activated='1'";
        
        if ($SelectOption == null)
            $SelectOption           = "-- Select Pump Type --";
        
        return self::plotCombo( $Name , $Filter_Array , self::$SQL_Qry , $SelValue , $SelectOption, $OtherParam);
    }
    
    public static function plotUnitsDp( $Name , $Filter_Array = array(), $SelValue = null, $SelectOption = null, $OtherParam = null ){
        self::$SQL_Qry              = "Select Unit_ID as id, Unit_Name as description from tbl_units where Is_Deleted='0' and Is_Activated='1'";
        
        if ($SelectOption == null)
            $SelectOption           = "-- Please select Units --";
        
        return self::plotCombo( $Name , $Filter_Array , self::$SQL_Qry , $SelValue , $SelectOption, $OtherParam);
    }
    
    
    
}