<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ajax;

/**
 *
 * @author Farid
 */
interface ajaxInterface {
    //put your code here    
    //public static function GetVehicleList(); 
}

class ajaxClass implements ajaxInterface{
    private static $ProdId, $CustomerId, $BillBook, $FromDate, $ConvertFromDate, $Shift, $BillNo, $ProdName; 
    private static $Result; 
    private static $JsonResult, $ProdPriceId, $PurPrice, $SalesPrice, $TransId, $Salary, $Query; 
    
    //private static $SQL; 

    public static function Init(){
        self::GetFormValues(); 
    }
    
    public static function GetFormValues(){
        /*
		self::$Salary       = isset($_REQUEST["salary"]) ? $_REQUEST["salary"] : ""; 
        self::$ProdId       = $_REQUEST["prod_id"] ?? ""; 
        self::$CustomerId   = $_REQUEST["cus_id"] ?? ""; 
        self::$BillBook     = $_REQUEST["BillBook"] ?? "";
        self::$Shift        = $_REQUEST["Shift"] ?? "";
        self::$BillNo       = $_REQUEST["BillNo"] ?? "";
        self::$ProdName     = $_REQUEST["ProdName"] ?? "";
        self::$ProdPriceId	= $_REQUEST["ProdPriceId"] ?? "";
        self::$PurPrice		= $_REQUEST["pur_price"] ?? "";
        self::$SalesPrice	= $_REQUEST["sales_price"] ?? "";
        self::$TransId		= $_REQUEST["TransId"] ?? "";
		*/

        self::$Query		= isset($_REQUEST["passquery"]) ? $_REQUEST["passquery"] : "";
        
    }

	public static function menus(){
		self::Init();
        $SQL                = "SELECT PROPERTY_ID, PROPERTY_NAME ,'' as from_type FROM property_details 
                               WHERE PROPERTY_NAME like '%" . self::$Query . "%' LIMIT 20 
                               union 
                               SELECT path,menu_name,'MASTER' as from_type from menu
                               WHERE menu_name like '%" . self::$Query . "%' LIMIT 20"; //Ghouse-29-01-2020

		
        self::$Result       = \DBConn\DBConnection::getQuery( $SQL );
        
        self::$JsonResult   =   array(); 
        
        foreach(self::$Result as $row){
			//Property/PropertDtl.html?id=1
			if ($row["from_type"]=='MASTER')//Ghouse-29-01-2020
			{
			    self::$JsonResult[] = array("PAGE_LINK"   => SITE_BASE_URL . $row["PROPERTY_ID"] , "DESCRIPTION"   => $row["PROPERTY_NAME"]);
			}
            else
            {
                self::$JsonResult[] = array("PAGE_LINK"   => SITE_BASE_URL . "Property/PropertDtl.html?id={$row["PROPERTY_ID"]}", "DESCRIPTION"   => $row["PROPERTY_NAME"]); 
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode(self::$JsonResult); 
	}


	
    
    public static function GetLedgerOpenBalance(){
        self::Init();
        $SQL                = "SELECT CASE WHEN OPEN_DEBIT > OPEN_CREDIT THEN (OPEN_DEBIT - OPEN_CREDIT) * -1 ELSE OPEN_CREDIT - OPEN_DEBIT END AS OPEN_AMT FROM TBL_LEDGER 
                               WHERE LED_ID = '" . self::$CustomerId . "' ";

		
        self::$Result       = \DBConn\DBConnection::getQuery( $SQL );
        
        self::$JsonResult   =   array(); 
        
        foreach(self::$Result as $row){
			$OpenAmt		=	number_format( floatval($row["OPEN_AMT"]), 2);
            self::$JsonResult[] = array("open_balance"   => $OpenAmt); 
        }
        
        header('Content-Type: application/json');
        echo json_encode(self::$JsonResult); 
    }
    
    
    public static function GetUnpaidBill(){
        self::Init();
       
        self::$Result       = \receipt\receiptClass::GetUnpaidBillQry(self::$CustomerId);
        
        
        
        self::$JsonResult   =   array(); 
        
        foreach(self::$Result as $row){
            self::$JsonResult[] = array("bill_no"   => $row["BILLNO"], 
                                        "total_amt" => $row["TOTALAMT"],
                                        "paid_amt"  => $row["PAIDAMT"],
                                        "bal_amt"   => $row["BALAMT"],
                                        "id"        => $row["TRANS_ID"],
                                        "date1"      => $row["ACTIONDATE"]
                                       ); 
        }
        
        header('Content-Type: application/json');
        echo json_encode(self::$JsonResult);
    }
    
    public static function  GetProductInfo(){
        self::Init(); 
        $SQL                = "SELECT PROD.PROD_ID, PROD.ProdName, PROD.QtyUnit, PROD.PumpType, PROD.SalesType,
                                      PROD.OpenStock, PROD.ProdType, PROD.GST_HSN_CODE, PROD.UNITS_PER_QTY,
                                      GST.VALID_FROM, 
                                      IFNULL(GST.GST_PERCENT, 0) AS GST_PERCENT, 
                                      IFNULL(GST.IGST_PERCENT, 0) AS IGST_PERCENT, 
                                      IFNULL(GST.CGST_PERCENT, 0) AS CGST_PERCENT, 
                                      IFNULL(GST.SGST_PERCENT, 0) AS SGST_PERCENT, 
                                      IFNULL(FnGetPurPrice(PROD.PROD_ID, '" . self::$ConvertFromDate . "'), PROD.SalesPrice)
										  PurchasePrice,
									  IFNULL(FnGetSalesPrice(PROD.PROD_ID, '" . self::$ConvertFromDate . "'), PROD.SalesPrice)
										  SalesPrice
                                FROM PRODUCTS PROD
                                     LEFT JOIN PRODUCTS_GST_DETAILS GST
                                        ON     PROD.PROD_ID = GST.PRODUCT_ID
                                           AND GST.VALID_FROM =
                                               (SELECT MAX(GST1.VALID_FROM)
                                                FROM PRODUCTS_GST_DETAILS GST1
                                                WHERE     GST1.PRODUCT_ID = GST.PRODUCT_ID
                                                      AND GST1.VALID_FROM <= '" . self::$ConvertFromDate . "')
                                WHERE 1 = 1 AND PROD.PROD_ID = '" . self::$ProdId . "'";
                
        self::$Result       = \DBConn\DBConnection::getQuery( $SQL );
        
        self::$JsonResult   =   array(); 
        
        foreach(self::$Result as $row){
            self::$JsonResult[] = array("id"                => $row["PROD_ID"], 
                                        "prod_name"         => $row["ProdName"], 
                                        "qty_unit"          => $row["QtyUnit"], 
                                        "pump_type"         => $row["PumpType"], 
                                        "open_stock"        => $row["OpenStock"], 
                                        "prod_type"         => $row["ProdType"], 
                                        "hsn_code"          => $row["GST_HSN_CODE"], 
                                        "units_per_qty"     => $row["UNITS_PER_QTY"], 
                                        "valid_from"        => $row["VALID_FROM"], 
                                        "gst_per"           => $row["GST_PERCENT"], 
                                        "igst_per"          => $row["IGST_PERCENT"], 
                                        "cgst_per"          => $row["CGST_PERCENT"], 
                                        "sgst_per"          => $row["SGST_PERCENT"], 
                                        "pur_price"         => $row["PurchasePrice"], 
                                        "sales_price"       => $row["SalesPrice"]
                                       ); 
        }
        
        header('Content-Type: application/json');
        echo json_encode(self::$JsonResult); 
        
    }
}