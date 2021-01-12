<?php


namespace Property;

interface PropertyInterface {
    //put your code here


}

class PropertyClass implements PropertyInterface{
    public static $SearchBtn, $LocationId, $Subrub, $Street, $StreetId, $stateId, $Zipcode, $ZipcodeId, $Suburb, $SubrubDp;
    public static $DocName, $DocRemarks, $UploadFile, $UploadedFiles, $Mode, $Id, $BrochureFile, $floor,$FolderId,$Propcountrycode,$PropertyIds;

    public static $IsPdf;


	public static function index(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/index.php" );
    }

    public static function AreaProfilePdf()
    {

        \Html\HtmlClass::init();

        if (self::$IsPdf != "Y"){
            \settings\session\sessionClass::CheckSession();
        }

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/AreaProfilePdf.php" );
    }

    public static function Init(){

         self::GetFormValues();
    }

    public static function Projects(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/Projects.php" );
    }
    public static function ProjectView(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/ProjectView.php" );
    }
    public static function PaypalSuccess(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/PaypalSuccess.php" );
    }

    public static function Project(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/Project.php" );
    }

    public static function FloorType(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/FloorType.php" );
    }

    public static function Properties(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/Properties.php" );
    }
    public static function PropertDtl(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/PropertDtl.php" );
    }
    public static function PropertyFullDtlOld(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/PropertyFullDtl.php" );
    }
    
    
    public static function PropertyFullDtl(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/PropertyFulDtlNew.php" );
    }

	 public static function PropertyInvestar(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/Propertyinvestar.php" );
    }
    
     public static function PropertyComparison(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/property-comprison.php" );
    }
    
    public static function PortfolioFulDtl(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/PortfolioFulDtl.php" );
    }

    public static function GetPorjectDatas($country,$ProjectId,$Cond="",$limit=false){
        if($country!="")
        {
            $Cond=" and pj.country = '{$country}'";
        }
        if($ProjectId!="")
        {
            $Cond=" and pj.PROJECT_ID = '{$ProjectId}'";
        }
        $IndexQry	= "    SELECT
                                distinct pj.PROJECT_ID,
                                pj.*,
                                short_description,
                                key_features,about_project,
                                cm.*
                            FROM
                                project pj
                            LEFT JOIN property_details pd ON
                                pj.PROJECT_ID = pd.project_id
                             LEFT JOIN  country_master cm ON
                             	UCASE(cm.COUNTRY_CODE)=UCASE(pj.COUNTRY)
                            WHERE
                                1=1 ".$Cond."
                            ORDER BY
                                pj.project_id " ;
        if($limit)
        {
            $IndexQry .= "Limit ".$limit."";
        }
        
        // echo $IndexQry;
        // die();
        
        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
	
	 public static function GetProjectLatlong($project_id){
        $Cond=" and PROJECT_ID = '{$project_id}'";
        $IndexQry	= "    SELECT
                                *
                            FROM
                                project
                            WHERE
                               1=1 ".$Cond."";
                                
        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
	
	public static function GetPropDtl($project_id){
		$Cond=" and PROJECT_ID = '{$project_id}'";
        $IndexQry	= "    SELECT
                                *
                            FROM
                                property_details
                            WHERE
                               1=1 ".$Cond."";
                                
        return \DBConn\DBConnection::getQuery( $IndexQry );
	}
    
    public static function GetReservedPreperties($project_id)
    {
        $IndexQry = "SELECT count(*) as count FROM property_details WHERE  reserved_by IS NOT NULL AND PROJECT_ID = '$project_id'";
        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
    
    public static function check_project_fav($projectID, $userID)
    {
        $IndexQry	= "SELECT COUNT(auto_id) as count FROM Add_favorite_project WHERE project_id = ".$projectID." AND user_id = ".$userID." ";
        // echo $IndexQry;
        // die();
        $data = \DBConn\DBConnection::getQuery( $IndexQry );
        $count = true;
        foreach($data as $rts)
        {
            // echo "<pre>";
            // print_r($rts);
            // die();
            if($rts['count'] > 0)
            {
                $count = true;
            }
            else
            {
                $count = false;
            }
        }
        return $count;
    }
    
    public static function check_property_fav($propertyID, $userID)
    {
        $IndexQry	= "SELECT COUNT(auto_id) as count FROM Add_favorite_property WHERE property_id = ".$propertyID." AND user_id = ".$userID." ";
        $data = \DBConn\DBConnection::getQuery( $IndexQry );
        $count = true;
        foreach($data as $rts)
        {
            if($rts['count'] > 0)
            {
                $count = true;
            }
            else
            {
                $count = false;
            }
        }
        return $count;
    }
    
    public static function delete_favourite_project()
    {
        if(isset($_GET['id']) && $_GET['id'] != null)
        {
            $id         = $_GET['id'];
            $user_id    = $_GET['user'];
            $queryStr	= "DELETE FROM Add_favorite_project WHERE project_id = '".$id."' AND user_id = '".$user_id."'";
            $res =  \DBConn\DBConnection::exe_me($queryStr);
            if($res)
            {
                header("Location: ".SITE_BASE_URL."dashboard/mydashboard.html");
            }
            else
            {
                header("Location: ".SITE_BASE_URL."dashboard/mydashboard.html");
            }
        }
        else
        {
            header("Location: ".SITE_BASE_URL."dashboard/mydashboard.html");
        }
    }
    
    public static function delete_favourite_property()
    {
        if(isset($_GET['id']) && $_GET['id'] != null)
        {
            $id         = $_GET['id'];
            $user_id    = $_GET['user'];
            
            
            $queryStr	= "DELETE FROM Add_favorite_property WHERE property_id = '".$id."' AND user_id = '".$user_id."'";
            $res =  \DBConn\DBConnection::exe_me($queryStr);
            // echo $id;
            // echo "<br>".$res;
            // die();
            if($res)
            {
                header("Location: ".SITE_BASE_URL."dashboard/mydashboard.html");
            }
            else
            {
                // header("Location: ".SITE_BASE_URL."dashboard/mydashboard.html");
            }
        }
        else
        {
            header("Location: ".SITE_BASE_URL."dashboard/mydashboard.html");
        }
    }
    
    public static function GetCurrExrate($curr="NZD",$Xcurr=""){
        if($curr!="")
        {
            $Cond=" and base_currency = '{$curr}'";
        }
        if($Xcurr!="")
        {
            $Cond.=" and currency = '{$Xcurr}'";
        }
        $IndexQry	= "    SELECT
                                distinct currency,RATE,updated_date
                            FROM
                                api_currency_exchange a
                            WHERE
                                1=1 ".$Cond." and updated_date=(SELECT updated_date FROM api_currency_exchange b where a.currency=b.currency and a.base_currency=b.base_currency )" ;
        //echo $IndexQry;

        return \DBConn\DBConnection::getQuery( $IndexQry );

    }
    public static function GetReminder($Cond=""){
        $IndexQry	=  "SELECT Distinct
		                        mail_id,pj.project_id,reminder_date-interval 1 day as reminder_date,is_sent,PROJECT_NAME,
		                        PROJECT_DESCRIPTION,COUNTRY,currency,DATE_FORMAT(effective_date, '%d-%b-%Y %r') as effective_date,expiry_date,image_file
		                   FROM mail_reminder mr,project pj
		                    WHERE pj.project_id=mr.project_id ".$Cond ;
        return \DBConn\DBConnection::getQuery( $IndexQry );

    }
    public static function GetProjectFloor($project,$Floor){
        if($project!="" && $project!=null)
        {
            $Cond=" and pj.project_id = '{$project}' ";
        }
        if($Floor!="" && $Floor!=null)
        {
            $Cond.=" and pd.floor_type = '{$Floor}' ";
        }
        $IndexQry	= "    SELECT
                                distinct pj.project_id,
                                pj.project_name,
                                pj.project_description,
                                pd.floor_type,
                                pj.country
                            FROM
                                project pj,project_floor_type pd
                            WHERE
                                pj.PROJECT_ID = pd.project_id
                            ".$Cond."
                            ORDER BY
                                pj.project_id,pd.floor_type " ;


        return \DBConn\DBConnection::getQuery( $IndexQry );

    }
    public static function GetProjectNew($project){
        if($project!="" || $project!=null)
        {
            $Cond=" and pj.project_id = '{$project}' ";
        }
        $IndexQry	= "    SELECT
                                distinct pj.project_id,
                                pj.project_name,
                                pj.project_description,
                                pj.image_file,
                                pj.country,
                                cm.COUNTRY_CODE_NEW,
                                cm.COUNTRY_NAME
                            FROM
                                project pj,
                                country_master cm
                            WHERE
                                1=1 and cm.COUNTRY_CODE = pj.country
                            ".$Cond."
                            ORDER BY
                                pj.project_id " ;

        return \DBConn\DBConnection::getQuery( $IndexQry );

    }
    public static function GetProjectFloorWithImage($project,$Floor){
        if($project!="" || $project!=null)
        {
            $Cond=" and pj.project_id = '{$project}' ";
        }
        if($Floor!="" || $Floor!=null)
        {
            $Cond=" and pd.floor_type = '{$Floor}' ";
        }
        $IndexQry	= "    SELECT
                                distinct pj.project_id,
                                pj.project_name,
                                pj.project_description,
                                pd.floor_type,
                                pj.country,
                                cm.COUNTRY_CODE_NEW,
                                cm.COUNTRY_NAME
                            FROM
                                project pj,
                                project_floor_type pd,
                                project_image pi,
                                country_master cm
                            WHERE
                                pj.PROJECT_ID = pd.project_id
                                AND pi.floor_type=pd.floor_type
                                and cm.COUNTRY_CODE = pj.country
                            ".$Cond."
                            ORDER BY
                                pj.project_id,pd.floor_type " ;

        return \DBConn\DBConnection::getQuery( $IndexQry );

    }

    public static function building($project){
        $IndexQry	= "    SELECT DISTINCT building FROM property_details WHERE PROJECT_ID=$project" ;
        return \DBConn\DBConnection::getQuery( $IndexQry );}
    public static function no_of_bedrooms($project){
        $IndexQry	= "    SELECT DISTINCT no_of_bedrooms FROM `property_details` WHERE PROJECT_ID=$project" ;
        return \DBConn\DBConnection::getQuery( $IndexQry );}
    public static function no_of_bathroom($project){
        $IndexQry	= "    SELECT DISTINCT no_of_bathroom FROM `property_details` WHERE PROJECT_ID=$project" ;
        return \DBConn\DBConnection::getQuery( $IndexQry );}
    public static function level($project){
        $IndexQry	= "    SELECT DISTINCT level FROM `property_details` WHERE PROJECT_ID=$project" ;
        return \DBConn\DBConnection::getQuery( $IndexQry );}
    public static function floor_type($project){
        $IndexQry	= "    SELECT DISTINCT floor_type FROM `property_details` WHERE PROJECT_ID=$project" ;
        return \DBConn\DBConnection::getQuery( $IndexQry );}
    public static function aspect($project){
        $IndexQry	= "    SELECT DISTINCT aspect FROM `property_details` WHERE PROJECT_ID=$project" ;
        return \DBConn\DBConnection::getQuery( $IndexQry );}
    public static function rate($project){
        $IndexQry	= "    SELECT DISTINCT rate FROM `property_details` WHERE PROJECT_ID=$project" ;
        return \DBConn\DBConnection::getQuery( $IndexQry );}

    public static function GetPropertyImages($Id,$floor){
        if ($floor!="")
        {
            $Cond=" and floor_type='".$floor."' ";
        }
            $IndexQry	= "SELECT
                        project_id, floor_type ,image, created_date
                    FROM
                        project_image Where project_id = '" .$Id. "' ".$Cond."  " ;

        return \DBConn\DBConnection::getQuery( $IndexQry );

    }
    public static function GettempImages(){
            $IndexQry	= "SELECT image_file FROM temp" ;

        return \DBConn\DBConnection::getQuery( $IndexQry );
    }

    public static function ProjectSellingDtl($ProjectId){
            $IndexQry	= "SELECT pj.project_id,count(reserved_by) as reserved_count,Count(sold_to) as sold_count,
            count(property_id) as total_count,
            min(rate-((rate-dpo_rate)*( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL )/IFNULL(p.no_of_property,1))) as Start_dynamin_price,
            SUM(CASE WHEN NO_OF_BEDROOMS = 1 THEN 1 ELSE 0 END) as one_bet,
            SUM(CASE WHEN NO_OF_BEDROOMS = 2 THEN 1 ELSE 0 END) as two_bet,
            SUM(CASE WHEN NO_OF_BEDROOMS = 3 THEN 1 ELSE 0 END) as three_bet,
            SUM(CASE WHEN NO_OF_BEDROOMS = 1 THEN weekly_rent ELSE 0 END)/( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID ) as Rent_one_bet,
            SUM(CASE WHEN NO_OF_BEDROOMS = 2 THEN weekly_rent ELSE 0 END)/( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID ) as Rent_two_bet,
            SUM(CASE WHEN NO_OF_BEDROOMS = 3 THEN weekly_rent ELSE 0 END)/( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID ) as Rent_three_bet,
            (SELECT COUNT(PROPERTY_ID) FROM property_details WHERE PROJECT_ID = '".$ProjectId."') as total_properties,
            max(WEEKLY_RENT) as Weekly_rent,
            SUM(((rate-(rate-((rate-dpo_rate)*( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = p.PROJECT_ID AND reserved_by is NOT NULL )/IFNULL(p.no_of_property,1))))/rate)*100)/( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID )  as AVG_Discount
            FROM property_details pj,project p where p.project_id='".$ProjectId."' and p.project_id=pj.project_id " ;

        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
    
    public static function get_lowest_property($ProjectId)
    {
        $IndexQry   = "SELECT 

            MIN(rate) as asking_price, 
            MIN(start_rate) as start_price, 
            MIN(dpo_rate) as strike_price, 
            MIN(dynamic_rate) as dynamic_price, 
            MIN(Est_Ground_Rent) as ground_rent, 
            MIN(Est_Service_Charge) as service_charges , 
            (SELECT (CASE WHEN gross_yield = '' THEN estimated_gross_yield WHEN gross_yield IS NULL THEN estimated_gross_yield ELSE gross_yield END ) FROM property_details WHERE property_details.reserved_by IS NULL AND PROJECT_ID = '". $ProjectId ."' ORDER BY property_details.RATE ASC LIMIT 1) as gross_yeild
            FROM property_details 
                WHERE reserved_by IS NULL 
                AND PROJECT_ID = '". $ProjectId ."'";
        
        // echo $IndexQry;
        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
    
    
    public static function OwnPropertyDtl(){
            $IndexQry	= "SELECT count(reserved_by) as reserved_count,Count(sold_to) as sold_count,count(property_id) as total_count FROM property_details where reserved_by='".\settings\session\sessionClass::GetSessionDisplayName()."' or sold_to='".\settings\session\sessionClass::GetSessionDisplayName()."'" ;

        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
    
    public static function GetPlanDtl(){
            $PlanQry	= "SELECT PLAN_CODE,PLAN_NAME,minimum_points,PRICE,Analyser_count,Reserve_start FROM plan_master WHERE STATUS='Y' order by order_no" ;

        return \DBConn\DBConnection::getQuery( $PlanQry );
    }
    
    public static function GetPropertiesDynamicFlow($ProjectId,$PropertyId){
        //echo $ProjectId."<br><++++++++++";
        //echo $PropertyId."<br><++++++++++";
        //exit;
        $IndexQry	= "select a.Date as updated_date, t2.dynamic_rate
                        from (
                            select curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a) + (1000 * d.a) ) DAY as Date
                            from (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a
                            cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b
                            cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c
                            cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as d
                        ) a left outer join ( select dynamic_rate, date(updated_date) as updated_date from (
                        SELECT 
                            version_no,
                            project_id,
                            property_id,
                            dynamic_rate,
                            (CASE
                            WHEN version_no=1 THEN (select effective_date from project pj1 where pj1.project_id=pf.project_id )
                                ELSE  updated_date
                            END) as updated_date
                        FROM 
                            property_dynamic_flow pf
                        WHERE property_id={$PropertyId} and project_id={$ProjectId}
                        UNION
                        SELECT (SELECT Ifnull(max(f.version_no),0)+1 from property_dynamic_flow f WHERE f.project_id=pj.PROJECT_ID and pd.PROPERTY_ID=f.property_id) as version_no,
                        pd.project_id,
                        pd.property_id,
                        ( rate - ( ( rate - dpo_rate ) * (SELECT Count(*) FROM property_details WHERE project_id = pj.project_id AND reserved_by IS NOT NULL) / Ifnull(pj.no_of_property, 1) ) ) AS dynamic_rate,
                        SYSDATE() as updated_date
                        FROM 
                            property_details pd, project pj 
                        WHERE pj.project_id = pd.project_id and property_id={$PropertyId} and pj.project_id={$ProjectId})t) t2
                            on a.date =t2.updated_date where a.Date between (select effective_date from project pj1 where pj1.project_id={$ProjectId} ) and SYSDATE() order by a.date" ;
        //echo $IndexQry;
        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
    public static function GetPropertiesDatas($Id,$country, $fn_proj,$cond=''){
        if ($Id!=""){
            $cond .= " and property_id in (". $Id .") ";
        }

        if ($country!=""){
            $cond .= " and pj.country='" . $country . "' ";
        }


        $IndexQry	= "SELECT 
                        property_id, building,apartment_no,pj.project_description,pj.expiry_date,pj.effective_date,pj.image_file,unit_no,level,aspect,floor_type,approx_patio_balcony,property_image,
						land_area,no_of_bedrooms,no_of_parkingspace, no_of_bathroom,created_user,lockin_rate,rate,start_rate,dpo_rate,
						/*( start_rate -( (start_rate - dpo_rate) *( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL ) /( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID ) ) ) AS dynamic_rate,*/
						(rate-((rate-dpo_rate)*( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL )/IFNULL(pj.no_of_property,1))) as dynamic_rate,
						(rate-((rate-dpo_rate)/2)) as strike_price,
						(CASE
                            WHEN (rate-((rate-dpo_rate)*( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL )/IFNULL(pj.no_of_property,1))) <= (rate-((rate-dpo_rate)/2)) THEN 'YES'
                            ELSE  'NO'
                        END) AS deal,
						reserved_by,sold_to,weekly_rent, pj.BROCHURE_FILE ,`property_purchase_value_price`, `loan_purchase_deposit`,
						`loan_purchase_market_value`, `loan_purchase_amount`, `other_exp_capital`, `other_exp_slicitor_cost`,
						`other_exp_stamping_cost`, `other_exp_other`, `arr_rental_type`, `arr_annual_rr`, `arr_weekly_rents`,
						`arr_total_annual_rent`, `ape_pricipal_interest`, `ape_rates`, `ape_body_corporate`, `ape_land_lease_fee`,
						`ape_insurance`, `ape_letting_fees`, `ape_management_fees`, `ape_repairs_maitenance`, `ape_gardening`, `ape_cleaning`,
						`ape_service_contract`, `ape_other`, `ae_property_belong`, `ae_entity_rows`, `ae_entity_selected`, `mf_customer_price_index`,
						`mf_capital_growth`, `de_calculate_depreciation`, `de_construction_year_completed`,
						`de_recent_renovations`, `de_estimate_land_value`,`loan_value_ratio_growth`, `last_updated_by`, `last_updated_date`, `mf_land_tax`,
						pd.project_id,pj.project_name,pj.country,pj.location_id,pj.subrub,pj.currency,pd.Block,pd.area_unit,pd.Est_Counci_Tax,pd.Est_Service_Charge,
						pd.Est_Ground_Rent,pd.Reservation_Fee,pd.Exchange_Deposit_Per,pd.Stage_Payment1,pd.timing1,pd.Stage_Payment2,pd.timing2, pd.*,
						( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID ) as No_of_property,
						( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NULL ) as No_of_Av_property,
						round(((rate-( start_rate -( (start_rate - dpo_rate) *( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL ) /
                        ( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID ) ) ))/rate)*100) as Discount ,DATE_FORMAT(pj.completion_date,'%d/%m/%Y') as completion_date,
                        cm.COUNTRY_CODE_NEW,cm. COUNTRY_NAME,cm. IMAGE
                    FROM
                        property_details pd,project pj,country_master cm Where 1=1 " . $cond .$fn_proj. " and pj.project_id=pd.project_id and cm.COUNTRY_CODE = pj.country
                    ORDER BY
                        pj.project_name " ;

// 		echo $IndexQry;
// 	exit();

        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
    public static function GetProjectDatas($cond=""){

        $IndexQry	= "SELECT
                        project_id,project_name,project_description,country,cm.country_name,pj.currency,effective_date,expiry_date,image_file,actual_price,start_price,dpo_price,subrub,location_id,NO_OF_PROPERTY
                    FROM
                        project pj,country_master cm
                    Where 1=1 ".$cond." and cm.COUNTRY_CODE = pj.country
                    ORDER BY
                        project_id " ;
                        
                       // ecyho $IndexQry;

        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
    
    public static function GetProjectDatasSearch(){
        extract($_POST);
        $currency = $_SESSION['BaseCurrency'];
        $country = $_REQUEST["country"];
        $cond = "";
        if($project_id=='' || $project_id==null)
            {   
                $project_id=$_REQUEST["project_id"];
            }
            $rowse = \Property\PropertyClass::GetProjectDatas($cond);
            $noOfProperties = 0;
            $noOfreserved = 0;
        foreach ($rowse as $row1)
        {
            // print_r($row1);
            // die;
            $noOfProperties = $row1['NO_OF_PROPERTY'];
        
        
            $PropCount = \Property\PropertyClass::GetReservedPreperties($project_id);
            foreach ($PropCount as $cnt) {
                $noOfreserved = $cnt['count'];
            }
            $Projectcurrency=$row1["currency"];
            if($Currency==$Projectcurrency)
            {
                $Xrate=1;
            }
            else
            {
                $Xraterows = \Property\PropertyClass::GetCurrExrate($Projectcurrency,$Currency);
                $j = 1;
                foreach ($Xraterows as $Xraterow)
                {
                    $Xrate=$Xraterow["RATE"];
                }
            }
            if($Xrate=="" || $Xrate==null)
            {
                $Xrate=1;
            }
            if($Currency=="NZD")
            {
                $Prefix="NZ$";
            }
            elseif($Currency=="AUD")
            {
                $Prefix="AU$";
            }
            elseif($Currency=="GBP")
            {
                $Prefix="£";
            }
            else
            {
                $Prefix=$currency." ";
                // $prefix = "<script> $('#currency').find(':selected').text();</script>";
            }
        }
         $html = '<div class="projects-panel"><div class="table-responsive">
            <table class="table table-bordered table-striped" id="available-properties">
                <thead>
                    <th class="Building'.$IsAvailable.$project_id.$IsReserved.'">Building</th>
                    <th class="APT_No'.$IsAvailable.$project_id.$IsReserved.'">APT No</th>
                    <th class="Level'.$IsAvailable.$project_id.$IsReserved.'">Level</th>
                    <th class="Aspect'.$IsAvailable.$project_id.$IsReserved.'">Aspect</th>
                    <th class="Floorplan'.$IsAvailable.$project_id.$IsReserved.'">Floorplan</th>
                    <th class="Size'.$IsAvailable.$project_id.$IsReserved.'">Area (Apartment) 
					<br> <span class="size'.$IsAvailable.$project_id.$IsReserved.'"><a class="active apt-size" href="#">m<sup>2</sup></a></span></th>
                    <th class="Balcony'.$IsAvailable.$project_id.$IsReserved.'">Area</th>
                    <th class="Bed'.$IsAvailable.$project_id.$IsReserved.'">Bed</th>
                    <th class="Bath'.$IsAvailable.$project_id.$IsReserved.'">Bath</th>
                    <th class="PRICE'.$IsAvailable.$project_id.$IsReserved.'">Retail Asking Price <br>('.$Prefix.')</th>
                    <th class="PRICE'.$IsAvailable.$project_id.$IsReserved.'">Strike Price</th>
                    <th class="PRICE'.$IsAvailable.$project_id.$IsReserved.'">Discount at Strike Price <br>(%)</th>
                    <th class="PRICE'.$IsAvailable.$project_id.$IsReserved.'">Current Dynamic Price<br>('.$Prefix.')</th>
                    <th class="PRICE'.$IsAvailable.$project_id.$IsReserved.'">Reservation Fee</th>
                    <!--<th class="PRICE'.$IsAvailable.$project_id.$IsReserved.'">Discount at Dynamic Discount</th>-->
                    ';
                    if($IsReserved!="Y")
                    {
                        if($IsAvailable!="Y"){
                    $html .= '<th class="CompareA'.$IsAvailable.$project_id.$IsReserved.'">Favourites</th><?php }?>
                        <th class="Reservation'.$IsAvailable.$project_id.$IsReserved.'">Reservation</th>
                        <th class="Action'. $IsAvailable.$project_id.$IsReserved.'">Action</th>';
                    }
                $html .= '</thead><tbody>';
                $list = array (
                    array('#', 'Building', 'APT No', 'Level','Aspect','Floorplan','APT Size(approx BOMA m2 ft2)','Approx Patio Balcony(m2 ft2)','Car park','Bed','Bath','Price GST Incl','status')
                );
                // $fp = fopen('CSV_Downloads/'.$Projectrow["PROJECT_NAME"].'.csv', 'w');
        	    if($IsAvailable=="Y")
    	        {
    	            $cond.=" AND pd.reserved_by is null ";
    	        }
    	        if($IsReserved=="Y")
    	        {
    	            $cond.=" AND pd.reserved_by is not null and pd.reserved_by not in ('".$LoginUserId."') ";
    	        }
                $cond.=" AND ( pj.project_id=$project_id";
                
                        $bedroomfrm = $bedroomfrom;
                        $bedroomtoo = $bedroomto;
                        $priceStart = $price;
                        $priceEnd   = $eprice;
                        
                        
                        if($bedroomfrm != "" && $bedroomtoo != "")
                        {
                            $cond .= " AND ( NO_OF_BEDROOMS >= '". $bedroomfrm ."' AND NO_OF_BEDROOMS <= '". $bedroomtoo ."' ) ";
                        }
                        
                        if($priceStart != "" && $priceEnd != "")
                        {
                            $cond .= " AND ( dynamic_rate > '". $priceStart ."' AND dynamic_rate < '". $priceEnd ."' ) ";
                        }
                $cond.=")";
                $rows = \Property\PropertyClass::GetPropertiesDatas('','',$cond);
                $j = 1;
                foreach ($rows as $row) 
                {
        	        if(strpos(",".$_SESSION["CompareProperties"].",",",".$row["property_id"].",")>-1)
                    {
                        $isChecked="checked";
                    }
                    else
                    {
                        $isChecked="";
                    }
                    if($row["sold_to"]!='' && $row["sold_to"]!=null)
                    {
                        $PropStatus="SOLD";
                    }
                    else if($row["reserved_by"]!='' && $row["reserved_by"]!=null)
                    {
                        $PropStatus="RESERVED";
                    }
                    else
                    {
                        $PropStatus="AVAILABLE";
                    }
                    array_push($list, array($j, $row["building"], $row["apartment_no"], $row["level"],$row["aspect"],$row["floor_type"],$row["land_area"],$row["approx_patio_balcony"],$row["no_of_parkingspace"],$row["no_of_bedrooms"],$row["no_of_bathroom"],round($row["dynamic_rate"],0),$PropStatus));
                    $html .='<tr>
                        <!--<td><input type="checkbox" name="CompareProperty" class="check1 CompareRow" value='.$row["property_id"].' style="width: 15px; height: 15px;" '.$isChecked.' ></td>-->
                        <td class="Building'.$IsAvailable.$project_id.$IsReserved.'">'.$row["building"].'</td>
            		    <td class="APT_No'.$IsAvailable.$project_id.$IsReserved.'">'.$row["UNIT_NO"].'</td>
            		    <td class="Level'.$IsAvailable.$project_id.$IsReserved.'">'.$row["level"].'</td>
            		    <td class="Aspect'.$IsAvailable.$project_id.$IsReserved.'">'.$row["aspect"].'</td>
            		    <td class="Floorplan'.$IsAvailable.$project_id.$IsReserved.'">.'.$row["floor_type"].'</td>
                        <td class="Size'.$IsAvailable.$project_id.$IsReserved.'">
                        <input type="hidden" value="'.$row["land_area"].'" class="Land"> <span class="spanLand'.$IsAvailable.$project_id.$IsReserved.'">
                        '.$row["land_area"].'</span></td>
            		    <td class="balcony_terrace'.$IsAvailable.$project_id.$IsReserved.'"><span class="spanbalcony'.$IsAvailable.$project_id.$IsReserved.'" >'.$row["balcony_terrace"].'</span></td>
            		    
            		    <td class="Bed'.$IsAvailable.$project_id.$IsReserved.'">'.$row["no_of_bedrooms"].'</td>
            		    <td class="Bath'.$IsAvailable.$project_id.$IsReserved.'">'.$row["no_of_bathroom"].'</td>
            		    <td class="PRICE'.$IsAvailable.$project_id.$IsReserved.'">
            		        <!--<img class="price-icon" src="<?php echo SITE_BASE_URL; ?>assets/img/icon/bars-profit.png" class="img-fluid"><br>-->
            			    <div class="price-wrap"><?php //echo $Prefix;?><span class="price-text text-primary">'.number_format(round($row["rate"])*$Xrate,0).'</span></div>
            		    </td>
            		    <td class="PRICE'. $IsAvailable.$project_id.$IsReserved.'">
            		        <!--<img class="price-icon" src="<?php echo SITE_BASE_URL; ?>assets/img/icon/bars-profit.png" class="img-fluid">-->
            			    <div class="price-wrap"><?php //echo $Prefix;?><span class="price-text text-primary">'.number_format(round($row["strike_price"])*$Xrate,0).'</span></div>
            		    </td>
            		    <td class="PRICE'.$IsAvailable.$project_id.$IsReserved.'">'.round((($row["rate"]-$row["strike_price"])/$row["rate"])*100,2).'%</td>
            		    <td class="PRICE'.$IsAvailable.$project_id.$IsReserved.'">
            			    <div class="price-wrap"><?php //echo $Prefix;?><img class="price-icon" src="'.SITE_BASE_URL.'assets/img/icon/bars-loss.png" class="img-fluid"><br><span class="price-text text-danger">'.
            			    number_format(round(($row['rate'] - (($row['rate'] - $row['start_rate']) * $noOfreserved / $noOfProperties)))*$Xrate,0).'</span></div>
            		    </td>
            		    <td class="PRICE'.$IsAvailable.$project_id.$IsReserved.'">'.number_format(round($row["Reservation_Fee"])*$Xrate,0).'</td>
            		    <!-- <td class="PRICE<?php // echo $IsAvailable.$project_id.$IsReserved;?>">
            			   <div class="price-wrap"><span class="price-text text-danger">%</span></div>
            			    <?php // echo round((($row["rate"]-$row["dynamic_rate"])/$row["rate"])*100,2);?>
            		    </td>-->';
                        $IsFavPro="";
                        $CondiPro="And property_id='".$row["property_id"]."' AND user_id='".$LoginUserId."'";
                        $rowProFavs = \Property\PropertyClass::GetFavoriteProperty($CondiPro);
                        foreach ($rowProFavs as $rowProFav) 
                        {
                            if($rowProFav["property_id"]!="" && $rowProFav["property_id"]!=null)
                            {
                                $IsFavPro="Y";
                            }
                            else
                            { 
                                $IsFavPro=""; 
                                
                            }
                        }
                        if($IsReserved!="Y")
                        {
                            if($IsAvailable!="Y"){
                            $html .= '<td class="CompareA'.$IsAvailable.$project_id.$IsReserved.'" align="center">
                                <span id="Prop'.$row["property_id"].'">';
                                    if($IsFavPro=="Y")
                                    {
                                        $html.= '<a class="text-success" href="javascript:CanfavouritePro("'.$postProid.'")" title="Remove Favorite" data-id="'.$postProid.'"><i class="fas fa-star"></i></a>';
                                    }
                                    else
                                    {
                                        $html.='<a class="text-danger" href="javascript:favouritePro("'.$postProid.'")" title="Add To Favorite" data-id="'.$postProid.'" ><i class="far fa-star"></i></a>';
                                    }
                               $html.='<span></td>';
                            }
                            $html.='<td  class="Reservation'.$IsAvailable.$project_id.$IsReserved.'">';
                            if($row["sold_to"]!='' && $row["sold_to"]!=null && '1'=='2')
                            {
            			        echo "<span style='color:green;background-color:yellow'><b><br>PURCHASED</b></span>";
            		        }
            		        elseif($row["reserved_by"]==\settings\session\sessionClass::GetSessionDisplayName() && '1'=='2')
            		        {
            		        $html.= '<a class="btn btn-danger btn-sm" href="'.SITE_BASE_URL.'Property/Cancel.html?id='.$row["property_id"].'&ProjectId='.$project_id.'">Cancel</a>';
                			    if($reservedCount==$totalCount)
                				{
                                $html.='<a class="btn btn-dark btn-sm" href="'.SITE_BASE_URL.'Property/Purchase.html?id='.$row["property_id"].'&ProjectId='.$project_id.'">Purchase</a>';
                				}
            		        }
            			    elseif($row["reserved_by"]!="" && $row["reserved_by"]!=null)
            			    {
                             $html.='<button  class="btn btn-danger btn-sm"  disabled> Reserved </button>
                                <!--<a  data-buildingname="<?php echo $row["building"];?>" data-propertyid="<?php echo $row["property_id"]; ?>" data-price="<?php echo number_format(round($row["dpo_rate"]*$Xrate,0));?>" class="btn btn-secondary btn-sm paypal" href="javascript:void(0)" nowrap>Pay now</a>-->';
            			    }
            		        else
            		        {
                            $html.='<a class="btn btn-success btn-sm" href="'.SITE_BASE_URL.'Property/ReserveWizardStart.html?id='. $row["property_id"].'&ProjectId='.$project_id.'">Reserve</a>';
                            }
                            $html.='</td>
                            <td class="Action'.$IsAvailable.$project_id.$IsReserved.'">
                                <a class="btn btn-dark btn-sm" href="'.SITE_BASE_URL.'Property/PropertyFullDtl.html?id='.$row["property_id"].'&ProjectId='.$project_id.'">ANALYSE</a></td>';
                        }
                    $html.='</tr>';
                    $j=$j+1;
                }
               $html.='</tbody></table></div></div>';
                echo $html;
    }}
    
    public static function get_amininties_data($project_id)
    {
        $IndexQry	= "SELECT * FROM project_amenities WHERE aminity_project = '".$project_id."'";
        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
    public static function savePapalOrder($txn_id,$item_number,$item_name='',$payment_amount,$payment_currency,$payment_status){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
         $UserIdVal=$_REQUEST["UserId"];
        $queryStr		= "insert into  payment  (txn_id,item_number,item_name,payment_amount,payment_currency,payment_status,create_at) values (:txn_id, :item_number,:item_name,:payment_amount,:payment_currency,:payment_status,:create_at)";
 	      $ColValarray			= array("txn_id" => $txn_id, "item_number" => $item_number,"item_name"=>$item_name,"payment_amount"=>$payment_amount,"payment_currency"=>$payment_currency,"payment_status"=>$payment_status,"create_at"=>date("Y-m-d H:i:s"));
 		    $Queryarray		= array($queryStr,$ColValarray);
 	    	$ArrQueries[]	= $Queryarray;
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries);
        //print_r($Queryarray); die;
        $Listpath =  SITE_BASE_URL. "Property/PaypalSuccess.html";
        \Html\HtmlClass::Init();
        include "header.php";

        echo '	<div id="content" class="show">';
        echo	'<div class="widget-title pl-4">
                       <h3>Order - Page</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';

        if ($Msg == "success"){
            $Msg    =   "Payment Successfully.  <a href='" .$Listpath. "'>back</a><br><br>";
        }
        else{
            $Msg.=    "<a href='" .$Listpath. "'>back</a><br><br>";
        }

        echo '                  <div class="">
                                     <h3 align="center"><br/>' . $Msg .'</h3>

                                </div>';

        echo '			</div>
                                </div>
                        </div>';
         include"footer.php";
        echo '</body></html>';
        header('location:' .$Listpath);
    }
    
    public static function ReserveWizardStart()
    {
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        
        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/wizard-start.php" );
    }
    
    public static function ReserveWizardsecond()
    {
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        
        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/wizard-second.php" );
    }
    
    public static function ReserveWizardthird()
    {
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        
        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/wizard-third.php" );
    }
    
    public static function ReserveWizardfourth()
    {
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        
        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/wizard-fourth.php" );
    }
     public static function ReserveWizardfifth()
    {
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        
        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/wizard-fifth.php" );
    }
     public static function ReserveEnd()
    {
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        
        self::Init();
        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/wizard-end.php" );
    }
    
    public static function Reserve(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        $ArrQueries         = array();
        $propertyid			= isset($_REQUEST["id"])? $_REQUEST["id"] : "";
        $ProjectId			= isset($_REQUEST["ProjectId"])? $_REQUEST["ProjectId"] : "";
        $lockin_rateArr		= \DBConn\DBConnection::getQueryFetchColumn("(SELECT (rate-((rate-dpo_rate)*( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL )/IFNULL(pj.no_of_property,1))) AS dynamic_rate FROM property_details pd,project pj Where pj.project_id=pd.project_id and pd.property_id = ".$propertyid.")");
        $lockin_rate		= $lockin_rateArr["0"];
        $UpdatedDate        = date("Y-m-d");
        //==================================Ghouse/24-08-2020=================================
        $FlowProjectRateRows               = \DBConn\DBConnection::getQuery("(SELECT ( rate - ( ( rate - dpo_rate ) * (SELECT Count(*) FROM property_details WHERE project_id = pj.project_id AND reserved_by IS NOT NULL) / Ifnull(pj.no_of_property, 1) ) ) AS dynamic_rate, 
        pd.property_id, pd.project_id, 
        (SELECT Ifnull(max(f.version_no),0)+1 from property_dynamic_flow f WHERE f.project_id=pj.PROJECT_ID and pd.PROPERTY_ID=f.property_id) as version_no 
        FROM property_details pd, project pj WHERE pj.project_id = pd.project_id and pj.project_id={$ProjectId}  )");
	    foreach($FlowProjectRateRows as $FlowProjectRateRow)
	    {
		   	$FlowDynamicRate= $FlowProjectRateRow["dynamic_rate"];
			$FlowPropertyId= $FlowProjectRateRow["property_id"];
			$FlowProjectId= $FlowProjectRateRow["project_id"];
			$FlowVersion= $FlowProjectRateRow["version_no"];
			
			$queryStr="insert into property_dynamic_flow(version_no,project_id,property_id,dynamic_rate,updated_date) values (:version_no,:project_id,:property_id,:dynamic_rate,:updated_date)";
			$ColValarray = array("version_no"=> $FlowVersion, "project_id"=> $FlowProjectId, "property_id" => $FlowPropertyId,"dynamic_rate"=>$FlowDynamicRate,"updated_date"=>$UpdatedDate) ;
			$Queryarray = array($queryStr,$ColValarray);
			$ArrQueries[]=$Queryarray;
	    }
        //====================================================================================
        $user_id            = \settings\session\sessionClass::GetSessionDisplayName();
        $queryStr				 = "UPDATE property_details SET reserved_by=:reserved_by,lockin_rate=:lockin_rate where property_id  = :property_id";

		$ColValarray			= array("reserved_by" => $user_id,"lockin_rate"=>$lockin_rate, "property_id" => $propertyid) ;

		$Queryarray				= array($queryStr,$ColValarray);

		$ArrQueries[]			=	$Queryarray;
		$ReserveArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT reserved_by FROM property_details where property_id  = ".$propertyid.")");
        $Reserve                  = $ReserveArr["0"];
        if($Reserve!="" && $Reserve!=null)
        {
             $Msg ="Already Reserved by someone.";
        }
        else
        {
		    $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
        }
        $Listpath =  SITE_BASE_URL. "Property/ProjectView.html?project_id=" .$ProjectId;
        \Html\HtmlClass::Init();
        include "header.php";
        
        if ($Msg == "success"){
            $Msg    =   '<p>The reservation process is very straightforward, just follow the steps as we take you through the process. If you’re unclear at any stage simply contact your portfolio advisor</p><button type="button" class="btn btn-blue" onClick=|javascript:history.go(-1)">Back</button>';
        }
        else{
            $Msg.=    '<a  href="' .$Listpath. '" class="btn btn-blue" >Back</a>';
        }
        $html = '	<div class="messages-container">
                		<div class="message-box">
                			<div class="row align-items-end">
                				<div class="col-lg-6">
                					<h2>Congratulations</h2>
                					<h3><span>on selecting your investment property.</span></h3>
                				    '.$Msg.'
                                </div>
                				<div class="col-lg-6">
                					<div class="img-holder">
                						<img src="'.SITE_BASE_URL.'dashboard/assets/images/congrats-vector.png" class="img-fluid" alt="">
                					</div>
                				</div>
                			</div>
                			<div class="wave">
                				<img src="'.SITE_BASE_URL.'dashboard/assets/images/wavy.png" class="img-fluid" alt="">
                			</div>
                		</div>
                	</div>';
                	echo $html;
         include"footer.php";
        echo '</body></html>';
    //     if ($Msg == "success"){
    //         $queryStr				 = "UPDATE property_details SET
    //         dynamic_rate=( start_rate -( (start_rate - dpo_rate) *( SELECT COUNT(*) FROM property_details
    //         WHERE PROJECT_ID = :project_id AND reserved_by is NOT NULL ) /( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = :project_id ) ) )  where project_id  = :project_id";

    // 		$ColValarray			= array("project_id" => $ProjectId) ;

    // 		$Queryarray				= array($queryStr,$ColValarray);

    // 		$ArrQueries[]			=	$Queryarray;
    // 		$Msg1 = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
    //     }
    }
    public static function Cancel(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        $ArrQueries             = array();
        $propertyid			=isset($_REQUEST["id"])? $_REQUEST["id"] : "";
        $ProjectId			=isset($_REQUEST["ProjectId"])? $_REQUEST["ProjectId"] : "";
        $user_id            = \settings\session\sessionClass::GetSessionDisplayName();
        $queryStr				 = "UPDATE property_details SET reserved_by=:reserved_by where property_id  = :property_id";

		$ColValarray			= array("reserved_by" => null, "property_id" => $propertyid) ;

		$Queryarray				= array($queryStr,$ColValarray);

		$ArrQueries[]			=	$Queryarray;
		//$Listpath =  SITE_BASE_URL. "Property/Projects.html?project_id=" .$ProjectId;
		$Listpath =  SITE_BASE_URL. "Property/index.html";
		$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);

        \Html\HtmlClass::Init();
        include "header.php";

        echo '	<div id="content" class="show">';
        echo	'<div class="widget-title pl-4">
                       <h3>Property - cancel Reservasion</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';

        if ($Msg == "success"){
            $Msg    =   "Reservasion cancelled Successfully.  <a href='javascript:void(0)' onClick='javascript:history.go(-1)'>back</a><br><br>";
        }
        else{
            $Msg    =   "There is a error while save.";
        }

        echo '                  <div class="">
                                     <h3 align="center"><br/>' . $Msg .'</h3>

                                </div>';

        echo '			</div>
                                </div>
                        </div>';
         include"footer.php";
        echo '</body></html>';

    }
    public static function Purchase(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();



		$ArrQueries             = array();
        $propertyid			=isset($_REQUEST["id"])? $_REQUEST["id"] : "";
        $ProjectId			=isset($_REQUEST["ProjectId"])? $_REQUEST["ProjectId"] : "";
        $user_id            = \settings\session\sessionClass::GetSessionDisplayName();

		$ReserveArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT sold_to FROM property_details where property_id  = ".$propertyid.")");
        $Reserve                  = $ReserveArr["0"];
        if($Reserve!="" && $Reserve!=null)
        {
             $Msg ="Already Purchased by someone.";
        }
        else
        {
            $queryStr				 = "UPDATE property_details SET sold_to=:sold_to where property_id  = :property_id";

    		$ColValarray			= array("sold_to" => $user_id, "property_id" => $propertyid) ;

    		$Queryarray				= array($queryStr,$ColValarray);

    		$ArrQueries[]			=	$Queryarray;

    		$referredByArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT referred_by FROM referral_code rc,user_master um WHERE rc.hash_key=um.referral_code and um.id='{$user_id}')");
    	    $referredBy                  = $referredByArr["0"];

    		$ReferredpointArr            = \DBConn\DBConnection::getQueryFetchColumn("(SELECT points FROM point_structure WHERE type='referred_purchase' )");
    	    $Referredpoint               = $ReferredpointArr["0"];

    	    $PurchasepointArr		     =\DBConn\DBConnection::getQueryFetchColumn("(SELECT ( rate -( (rate - dpo_rate) *( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID AND reserved_by is NOT NULL ) /( SELECT COUNT(*) FROM property_details WHERE PROJECT_ID = pj.PROJECT_ID ) ) ) AS dynamic_rate FROM property_details pd,project pj Where pj.project_id=pd.project_id and pd.property_id = ".$propertyid.")");
            $Purchasepoint               = $PurchasepointArr["0"];

            $IsRefferedArr		         =\DBConn\DBConnection::getQueryFetchColumn("(SELECT count(sold_to) FROM property_details WHERE sold_to='{$user_id}')");
            $IsRefferedCnt               = $IsRefferedArr["0"];

    		$ReferralCode='PURCHASE';
    		$date = date("Y-m-d");
    		$queryStr="insert into user_points(user_id,points,referral_code,updated_date) values (:user_id,:points,:referral_code,:updated_date)";

			$ColValarray = array("user_id"=> $user_id, "points"=> $Purchasepoint, "referral_code" => $ReferralCode, "updated_date" => $date) ;

			$Queryarray = array($queryStr,$ColValarray);
			$ArrQueries[]=$Queryarray;

			if($IsRefferedCnt<1 && $referredBy!='' && $referredBy!=null)
			{
			    $ReferralCode='REFERRED PURCHASE';
			    $queryStr="insert into user_points(user_id,points,referral_code,child_user,updated_date) values (:user_id,:points,:referral_code,:child_user,:updated_date)";
    			$ColValarray = array("user_id"=> $referredBy, "points"=> $Referredpoint, "referral_code" => $ReferralCode,"child_user"=>$user_id, "updated_date" => $date) ;
    			$Queryarray = array($queryStr,$ColValarray);
    			$ArrQueries[]=$Queryarray;
			}

		    $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
        }
        $Listpath =  SITE_BASE_URL. "Property/Projects.html?project_id=" .$ProjectId;
        \Html\HtmlClass::Init();
        include "header.php";

        echo '	<div id="content" class="show">';
        echo	'<div class="widget-title pl-4">
                       <h3>Property - Purchase</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';

        if ($Msg == "success"){
            $Msg    =   "Purchased Successfully.  <a href='" .$Listpath. "'>back</a><br><br>";
        }
        else{
            $Msg.=    "<a href='" .$Listpath. "'>back</a><br><br>";
        }

        echo '                  <div class="">
                                     <h3 align="center"><br/>' . $Msg .'</h3>

                                </div>';

        echo '			</div>
                                </div>
                        </div>';
         include"footer.php";
        echo '</body></html>';
    }

    public static function save(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        $ArrQueries             = array();
        $MaxIdArr               = \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(PROPERTY_ID), 0) + 1 PROPERTY_ID FROM property_details)");
        $MaxId                  = $MaxIdArr["0"];


        $PROPERTYExistRowCount   = $_REQUEST["PROPERTYExistRowCount"];
        $created_user   		 = $_REQUEST["user_id"];

        for ($i = 1; $i <= intval($PROPERTYExistRowCount); $i++){
			$propertyid			=isset($_REQUEST["propertyid" . $i])? $_REQUEST["propertyid" . $i] : "";
			$Delval			    =isset($_REQUEST["Delval"])? $_REQUEST["Delval"] : "";
			$PropertyDtlStatus	=$_REQUEST["PropertyDtlStatus".$i];
			$ProjectId       	=$_REQUEST["ProjectId".$i];
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
			$CreatedUser 		= $_REQUEST["CreatedUser".$i];
			$Rate        		= trim($_REQUEST["Rate".$i]);
			$StartRate    		= trim($_REQUEST["StartRate".$i]);
			$DpoRate       		= trim($_REQUEST["DpoRate".$i]);
			$WeeklyRent 		= trim($_REQUEST["WeeklyRent".$i]);
            $lockinRate         =0;
            // $ConvertDOB         = \OtherFn\OtherFnClass::convertDate($date1, "%Y-%m-%d");
            if($PropertyDtlStatus!="N")
            {

			   if ( $propertyid != "" && $Delval=="D")
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
			   elseif ( $propertyid != "" && $Delval!="D" ){

				$queryStr				 = "UPDATE property_details SET building=:building,
												apartment_no=:apartment_no,unit_no=:unit_no,level=:level,aspect=:aspect,floor_type=:floor_type,
												land_area=:land_area,approx_patio_balcony=:approx_patio_balcony,no_of_bedrooms=:no_of_bedrooms,no_of_bathroom=:no_of_bathroom,
												no_of_parkingspace=:no_of_parkingspace,rate=:rate,start_rate=:start_rate,dpo_rate=:dpo_rate,weekly_rent=:weekly_rent,
												project_id=:project_id  where property_id  = :property_id";

				$ColValarray			= array("building" => $building, "apartment_no" => $ApartmentNo, "unit_no" => $UnitNo,
												"level" => $level,"aspect" =>$aspect,"floor_type"=>$FloorType,"land_area" => $LandArea,"approx_patio_balcony" => $ApproxPatioBalcony,"no_of_bedrooms" => $NoOfBedrooms,
												"no_of_bathroom" =>$NoOfBathroom ,"no_of_parkingspace" => $NoOfParkingspace,"rate" => $Rate,"start_rate" => $StartRate,"dpo_rate" => $DpoRate,"weekly_rent" => $WeeklyRent,
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
			   else
			   {
                $MaxIdArr[$i] = $MaxId;
                $queryStr="insert into property_details(building, apartment_no, unit_no,
    			level, aspect,floor_type, land_area,approx_patio_balcony, no_of_bedrooms, no_of_bathroom, no_of_parkingspace, created_user,
    			rate,start_rate,dpo_rate,weekly_rent,project_id,mf_land_tax,BROCHURE_FILE,dynamic_rate,lockin_rate) values
    			(:building, :apartment_no, :unit_no,
    			:level, :aspect,:floor_type, :land_area,:approx_patio_balcony, :no_of_bedrooms, :no_of_bathroom, :no_of_parkingspace, :created_user,
    			:rate,:start_rate,:dpo_rate,:weekly_rent,:project_id,:mf_land_tax,:BROCHURE_FILE,:dynamic_rate,:lockin_rate)";

    			$ColValarray = array("building" => $building, "apartment_no" => $ApartmentNo, "unit_no" => $UnitNo,
												"level" => $level,"aspect" =>$aspect,"floor_type"=>$FloorType,"land_area" => $LandArea,"approx_patio_balcony" => $ApproxPatioBalcony,"no_of_bedrooms" => $NoOfBedrooms,
												"no_of_bathroom" =>$NoOfBathroom ,"no_of_parkingspace" => $NoOfParkingspace, "created_user"=>$created_user,"rate" => $Rate,"start_rate" => $StartRate,"dpo_rate" => $DpoRate,"weekly_rent" => $WeeklyRent
												,"project_id" => $ProjectId,"mf_land_tax"=>0,"BROCHURE_FILE"=>'',"dynamic_rate"=>$StartRate,"lockin_rate" => $lockinRate) ;
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

        $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);

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


		$Listpath =  SITE_BASE_URL. "Property/index.html?d=" .time();
		if($Delval=="D")
		{
		    $FromForm="Delete";
		}
		else
		{
		    $FromForm="Save";
		}
        \Html\HtmlClass::Init();
        include "header.php";

        echo '	<div id="content" class="show">';
        echo	'<div class="widget-title pl-4">
                       <h3>Property - '.$FromForm.'</h3>
                     </div>';
        echo '		<div class="container">
                            <div class="grid-24">';

        if ($Msg == "success"){
            $Msg    =   $FromForm."d Successfully.  <a href='" .$Listpath. "'>back</a><br><br>";
        }
        else{
            $Msg    =   "There is a error while ".$FromForm.".";
        }

        echo '                  <div class="">
                                     <h3 align="center"><br/>' . $Msg .'</h3>

                                </div>';

        echo '			</div>
                                </div>
                        </div>';

        //\Html\HtmlClass::TopNavBar();

        //\Html\HtmlClass::Footer();
    include"footer.php";
        echo '</body></html>';
    }

    public static function AreaProfile(){
        //AreaProfile.php
        self::Init();


        \Html\HtmlClass::init();
        //echo "In" . self::$IsPdf;
        //exit;
        if (self::$IsPdf == ""){
            \settings\session\sessionClass::CheckSession();
        }


        include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/AreaProfile.php" );
    }





	public static function propertysave(){
              
		 \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

		$user_id   							= \settings\session\sessionClass::GetSessionDisplayName();
        $property_id   						= $_REQUEST["property_id"];
        $property_purchase_value_price   	= $_REQUEST["property_purchase_value_price"];
        $loan_purchase_deposit   			= isset($_REQUEST["loan_purchase_deposit"]) ? $_REQUEST["loan_purchase_deposit"] : "";
        $loan_purchase_market_value   		= isset($_REQUEST["loan_purchase_market_value"]) ? $_REQUEST["loan_purchase_market_value"] : "";
        $loan_purchase_amount   			= isset($_REQUEST["loan_purchase_amount"]) ? $_REQUEST["loan_purchase_amount"] : "";
        $other_exp_capital   				= isset($_REQUEST["other_exp_capital"]) ? $_REQUEST["other_exp_capital"] : "";
        $other_exp_slicitor_cost   			= isset($_REQUEST["other_exp_slicitor_cost"]) ? $_REQUEST["other_exp_slicitor_cost"] : "";
        $other_exp_stamping_cost   			= isset($_REQUEST["other_exp_stamping_cost"]) ? $_REQUEST["other_exp_stamping_cost"] : "";
        $other_exp_other   					= isset($_REQUEST["other_exp_other"]) ? $_REQUEST["other_exp_other"] : "";
        $arr_rental_type   					= isset($_REQUEST["arr_rental_type"]) ? $_REQUEST["arr_rental_type"] : "";
        $arr_annual_rr   					= isset($_REQUEST["arr_annual_rr"]) ? $_REQUEST["arr_annual_rr"] : "";
        $arr_weekly_rents   				= isset($_REQUEST["arr_weekly_rents"]) ? $_REQUEST["arr_weekly_rents"] : "";
        $arr_total_annual_rent   			= isset($_REQUEST["arr_total_annual_rent"]) ? $_REQUEST["arr_total_annual_rent"] : "";
        $ape_rates   						= isset($_REQUEST["ape_rates"]) ? $_REQUEST["ape_rates"] : "";
        $ape_body_corporate   				= isset($_REQUEST["ape_body_corporate"]) ? $_REQUEST["ape_body_corporate"] : "";
        $ape_land_lease_fee   				= isset($_REQUEST["ape_land_lease_fee"]) ? $_REQUEST["ape_land_lease_fee"] : "";
        $ape_insurance   					= isset($_REQUEST["ape_insurance"]) ? $_REQUEST["ape_insurance"] : "";
        $ape_letting_fees   				= isset($_REQUEST["ape_letting_fees"]) ? $_REQUEST["ape_letting_fees"] : "";
        $ape_management_fees   				= isset($_REQUEST["ape_management_fees"]) ? $_REQUEST["ape_management_fees"] : "";
        $ape_repairs_maitenance   			= isset($_REQUEST["ape_repairs_maitenance"]) ? $_REQUEST["ape_repairs_maitenance"] : "";
        $ape_gardening   					= isset($_REQUEST["ape_gardening"]) ? $_REQUEST["ape_gardening"] : "";
        $ape_cleaning   					= isset($_REQUEST["ape_cleaning"]) ? $_REQUEST["ape_cleaning"] : "";
        $ape_service_contract   			= isset($_REQUEST["ape_service_contract"]) ? $_REQUEST["ape_service_contract"] : "";
        $ape_other   						= isset($_REQUEST["ape_other"]) ? $_REQUEST["ape_other"] : "";
        $ae_property_belong   				= isset($_REQUEST["ae_property_belong"]) ? $_REQUEST["ae_property_belong"] : "";
        $ae_entity_rows   					= isset($_REQUEST["ae_entity_rows"]) ? $_REQUEST["ae_entity_rows"] : "";
        $mf_customer_price_index   			= isset($_REQUEST["mf_customer_price_index"]) ? $_REQUEST["mf_customer_price_index"] : "";
        $mf_capital_growth   				= isset($_REQUEST["mf_capital_growth"]) ? $_REQUEST["mf_capital_growth"] : "";
        $mf_land_tax  						= isset($_REQUEST["mf_land_tax"]) ? $_REQUEST["mf_land_tax"] : "";
        $de_calculate_depreciation   		= isset($_REQUEST["de_calculate_depreciation"]) ? $_REQUEST["de_calculate_depreciation"] : "";
        $de_construction_year_completed   	= isset($_REQUEST["de_construction_year_completed"]) ? $_REQUEST["de_construction_year_completed"] : "";
        $de_recent_renovations   			= isset($_REQUEST["de_recent_renovations"]) ? $_REQUEST["de_recent_renovations"] : "";
        $de_estimate_land_value   			= isset($_REQUEST["de_estimate_land_value"]) ? $_REQUEST["de_estimate_land_value"] : "";
        $loan_value_ratio_growth   			= isset($_REQUEST["loan_value_ratio_growth"]) ? $_REQUEST["loan_value_ratio_growth"] : "";
        $ae_entity_selected   				= isset($_REQUEST["ae_entity_selected"]) ? $_REQUEST["ae_entity_selected"] : "";
        $ape_pricipal_interest   			= isset($_REQUEST["ape_pricipal_interest"]) ? $_REQUEST["ape_pricipal_interest"] : "";

		$loan_pricipal_interest   			= isset($_REQUEST["loan_pricipal_interest"]) ? $_REQUEST["loan_pricipal_interest"] : "";
		$loan_length_year   				= isset($_REQUEST["loan_length_year"]) ? $_REQUEST["loan_length_year"] : "";
		$loan_length_month   				= isset($_REQUEST["loan_length_month"]) ? $_REQUEST["loan_length_month"] : "";
		$loan_esatblishment_fee   			= isset($_REQUEST["loan_esatblishment_fee"]) ? $_REQUEST["loan_esatblishment_fee"] : "";
		$loan_amount_loan   				= isset($_REQUEST["loan_amount_loan"]) ? $_REQUEST["loan_amount_loan"] : "";
		$loan_interset_rate   				= isset($_REQUEST["loan_interset_rate"]) ? $_REQUEST["loan_interset_rate"] : "";
		$loan_other_loan_costs   			= isset($_REQUEST["loan_other_loan_costs"]) ? $_REQUEST["loan_other_loan_costs"] : "";
		$loan_valuation_fees   				= isset($_REQUEST["loan_valuation_fees"]) ? $_REQUEST["loan_valuation_fees"] : "";







        $SQLArr             				= array();

		$ChkCntArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT COUNT(property_master_auto_id) AS property_master_auto_id FROM property_details_master WHERE `user_id` ='" .$user_id. "' AND PROPERTY_ID='" .$property_id. "')");
        $ChkValue             				= $ChkCntArr["0"];




		if (  $ChkValue   == 0){

		$MaxIdArr               			= \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(property_master_auto_id), 0) + 1 property_master_auto_id FROM property_details_master)");
        $propertymasterauto_id              = $MaxIdArr["0"];

		$SQLQuery 						= "INSERT INTO `property_details_master`(`property_master_auto_id`, `user_id`, `property_id`, `property_purchase_value_price`,
												`loan_purchase_deposit`, `loan_purchase_market_value`, `loan_purchase_amount`, `other_exp_capital`,
												`other_exp_slicitor_cost`, `other_exp_stamping_cost`, `other_exp_other`, `arr_rental_type`, `arr_annual_rr`,
												`arr_weekly_rents`, `arr_total_annual_rent`, `ape_pricipal_interest`, `ape_rates`, `ape_body_corporate`,
												`ape_land_lease_fee`, `ape_insurance`, `ape_letting_fees`, `ape_management_fees`, `ape_repairs_maitenance`,
												`ape_gardening`, `ape_cleaning`, `ape_service_contract`, `ape_other`, `ae_property_belong`, `ae_entity_rows` ,
												`ae_entity_selected`, `mf_customer_price_index`, `mf_capital_growth` , `mf_land_tax`, `de_calculate_depreciation`,
												`de_construction_year_completed`, `de_recent_renovations`, `de_estimate_land_value`, `loan_value_ratio_growth`,
												`last_updated_by`, `last_updated_date`)
												VALUES ('" .$propertymasterauto_id. "','" .$user_id. "','" .$property_id. "','" .$property_purchase_value_price. "'
												,'" .$loan_purchase_deposit. "','" .$loan_purchase_market_value. "','" .$loan_purchase_amount. "','" .$other_exp_capital. "'
												,'" .$other_exp_slicitor_cost. "','" .$other_exp_stamping_cost. "','" .$other_exp_other. "','" .$arr_rental_type. "','" .$arr_annual_rr. "','" .$arr_weekly_rents. "','" .$arr_total_annual_rent. "','" .$ape_pricipal_interest. "'
												,'" .$ape_rates. "','" .$ape_body_corporate. "','" .$ape_land_lease_fee. "','" .$ape_insurance. "'
												,'" .$ape_letting_fees. "','" .$ape_management_fees. "','" .$ape_repairs_maitenance. "','" .$ape_gardening. "'
												,'" .$ape_cleaning. "','" .$ape_service_contract. "','" .$ape_other. "','" .$ae_property_belong. "'
												, '" .$ae_entity_rows. "','" .$ae_entity_selected. "','" .$mf_customer_price_index. "','" .$mf_capital_growth. "' ,'" .$mf_land_tax. "','" .$de_calculate_depreciation. "','" .$de_construction_year_completed. "','" .$de_recent_renovations. "','" .$de_estimate_land_value. "'
												,'" .$loan_value_ratio_growth. "'	,'" .$user_id. "',CURRENT_TIMESTAMP)";

		$SQLArr[]						 =  $SQLQuery;

		$MaxDtlIdArr               		= \DBConn\DBConnection::getQueryFetchColumn("(SELECT IFNULL(MAX(property_dtl_auto_id), 0) + 1 property_dtl_auto_id FROM property_master_dtl)");
        $propertydtlauto_id          	= $MaxDtlIdArr["0"];

		$SQLQuery 						= "INSERT INTO `property_master_dtl`(`property_dtl_auto_id`, `property_master_auto_id`, `loan_pricipal_interest`,
												`loan_length_year`, `loan_length_month`, `loan_esatblishment_fee`, `loan_amount_loan`,
												`loan_interset_rate`, `loan_other_loan_costs`, `loan_valuation_fees`
												) VALUES ('" .$propertydtlauto_id. "','" .$propertymasterauto_id. "','" .$loan_pricipal_interest. "','" .$loan_length_year. "',
												'" .$loan_length_month. "','" .$loan_esatblishment_fee. "','" .$loan_amount_loan. "','" .$loan_interset_rate. "',
												'" .$loan_other_loan_costs. "','" .$loan_valuation_fees. "')";


		$SQLArr[]						 =  $SQLQuery;





		}else{


		$SQLQuery   					= " UPDATE `property_details_master` SET `property_purchase_value_price`='" .$property_purchase_value_price. "',
												`loan_purchase_deposit`='" .$loan_purchase_deposit. "',`loan_purchase_market_value`='" .$loan_purchase_market_value. "',
												`loan_purchase_amount`='" .$loan_purchase_amount. "',`other_exp_capital`='" .$other_exp_capital. "',`other_exp_slicitor_cost`='" .$other_exp_slicitor_cost. "',
												`other_exp_stamping_cost`='" .$other_exp_stamping_cost. "',`other_exp_other`='" .$other_exp_other. "',`arr_rental_type`='" .$arr_rental_type. "',
												`arr_annual_rr`='" .$arr_annual_rr. "',`arr_weekly_rents`='" .$arr_weekly_rents. "',	`arr_total_annual_rent`='" .$arr_total_annual_rent. "',`ape_pricipal_interest`='" .$ape_pricipal_interest. "',`ape_rates`='" .$ape_rates. "',`ape_body_corporate`='" .$ape_body_corporate. "',
												`ape_land_lease_fee`='" .$ape_land_lease_fee. "',`ape_insurance`='" .$ape_insurance. "',`ape_letting_fees`='" .$ape_letting_fees. "',`ape_management_fees`='" .$ape_management_fees. "',`ape_repairs_maitenance`='" .$ape_repairs_maitenance. "',
												`ape_gardening`='" .$ape_gardening. "',`ape_cleaning`='" .$ape_cleaning. "',`ape_service_contract`='" .$ape_service_contract. "',`ape_other`='" .$ape_other. "',`ae_property_belong`='" .$ae_property_belong. "',
												`ae_entity_rows`='" .$ae_entity_rows. "',`ae_entity_selected`='" .$ae_entity_selected. "',	`mf_customer_price_index`='" .$mf_customer_price_index. "',`mf_capital_growth`='" .$mf_capital_growth. "',`de_calculate_depreciation`='" .$de_calculate_depreciation. "',
												`de_construction_year_completed`='" .$de_construction_year_completed. "',`de_recent_renovations`='" .$de_recent_renovations. "',`de_estimate_land_value`='" .$de_estimate_land_value. "',`loan_value_ratio_growth`='" .$loan_value_ratio_growth. "',
												`last_updated_by`='" .$user_id. "',`last_updated_date`=CURRENT_TIMESTAMP,`mf_land_tax`='" .$mf_land_tax. "' WHERE  `user_id` ='" .$user_id. "' AND PROPERTY_ID='" .$property_id. "' ";


	    $SQLArr[]						= $SQLQuery;

		$SQLQuery 						= "	UPDATE `property_master_dtl` SET `loan_pricipal_interest`='" .$loan_pricipal_interest. "',
											`loan_length_year`='" .$loan_length_year. "',`loan_length_month`='" .$loan_length_month. "',
											`loan_esatblishment_fee`='" .$loan_esatblishment_fee. "',	`loan_amount_loan`='" .$loan_amount_loan. "',
											`loan_interset_rate`='" .$loan_interset_rate. "', `loan_other_loan_costs`='" .$loan_other_loan_costs. "',
											`loan_valuation_fees`='" .$loan_valuation_fees. "' WHERE `property_dtl_auto_id`='" .$property_dtl_auto_id. "' and
											`property_master_auto_id`='" .$property_master_auto_id. "' ";

		 $SQLArr[]						= $SQLQuery;



		}

		$Msg = \DBConn\DBConnection::RunQuery($SQLArr);


		 $Listpath =  SITE_BASE_URL. "Property/PropertyFullDtl.html?id=" .$property_id;

		 header('location:' .$Listpath);

	}

	public static function GetDBValues($Id,$user_id){


        $IndexQry	= " SELECT `property_master_auto_id`, `user_id`, `property_id`, `property_purchase_value_price`, `loan_purchase_deposit`,
		`loan_purchase_market_value`, `loan_purchase_amount`, `other_exp_capital`, `other_exp_slicitor_cost`,
		`other_exp_stamping_cost`, `other_exp_other`, `arr_rental_type`, `arr_annual_rr`, `arr_weekly_rents`,
		`arr_total_annual_rent`, `ape_pricipal_interest`, `ape_rates`, `ape_body_corporate`, `ape_land_lease_fee`,
		`ape_insurance`, `ape_letting_fees`, `ape_management_fees`, `ape_repairs_maitenance`, `ape_gardening`, `ape_cleaning`,
		`ape_service_contract`, `ape_other`, `ae_property_belong`, `ae_entity_rows`, `ae_entity_selected`, `mf_customer_price_index`,
		`mf_capital_growth`, `de_calculate_depreciation`, `de_construction_year_completed`,
		`de_recent_renovations`, `de_estimate_land_value`,`loan_value_ratio_growth`, `last_updated_by`, `last_updated_date`, `mf_land_tax`
		FROM `property_details_master` Where `user_id` ='" .$user_id. "' AND PROPERTY_ID='" .$Id. "'
		order by property_master_auto_id 	" ;


		 return \DBConn\DBConnection::getQuery($IndexQry);


	}

	public static function GetDBDtlValues($Id){


        $IndexQry	= " SELECT `property_dtl_auto_id`, `property_master_auto_id`, `loan_pricipal_interest`, `loan_length_year`,
						`loan_length_month`, `loan_esatblishment_fee`, `loan_amount_loan`, `loan_interset_rate`, `loan_other_loan_costs`,
						`loan_valuation_fees` FROM `property_master_dtl` Where `property_master_auto_id` ='" .$Id. "'
							order by property_master_auto_id 	" ;


		 return \DBConn\DBConnection::getQuery($IndexQry);


	}

	 public static function GetPropertiesNames($UserId){

		 $IndexQry	= " SELECT  pd.property_id, pd.property_name
							FROM property_details pd , property_details_master pdm
							WHERE
							pd.PROPERTY_ID = pdm.PROPERTY_ID
							AND pd.CREATED_USER ='" .$UserId."' ORDER BY pd.property_id  asc" ;
				//echo  $IndexQry;

        return \DBConn\DBConnection::getQuery($IndexQry);
	 }
	 //=====================================================Ghouse(29-01-2020)=====================================================================

    public static function GetFormValues(){

        //echo "<pre>"; print_r($_REQUEST); ECHO "</PRE>";
        self::$DocName        = isset($_REQUEST["DocName"]) ?  $_REQUEST["DocName"] : "";
        self::$DocRemarks     = isset($_REQUEST["DocRemarks"]) ?  $_REQUEST["DocRemarks"] : "";
        self::$UploadedFiles  = isset($_REQUEST["UploadedFiles"]) ?  $_REQUEST["UploadedFiles"] : "";
        self::$Mode           = isset($_REQUEST["mode"]) ?  $_REQUEST["mode"] : "";
        self::$Id             = isset($_REQUEST["id"]) ?  $_REQUEST["id"] : "";
        self::$BrochureFile   = isset($_REQUEST["filename"]) ?  $_REQUEST["filename"] : "";
        self::$floor          = isset($_REQUEST["floor"]) ?  $_REQUEST["floor"] : "";
        self::$FolderId       = isset($_REQUEST["FolderId"]) ?  $_REQUEST["FolderId"] : "";


        self::$SearchBtn     = isset($_REQUEST["SearchBtn"]) ?  $_REQUEST["SearchBtn"] : "";
        self::$LocationId    = isset($_REQUEST["LocationId"]) ?  $_REQUEST["LocationId"] : "";
        self::$Street        = isset($_REQUEST["Street"]) ?  $_REQUEST["Street"] : "";
        self::$StreetId      = isset($_REQUEST["StreetId"]) ?  $_REQUEST["StreetId"] : "";
        self::$stateId       = isset($_REQUEST["stateId"]) ?  $_REQUEST["stateId"] : "";
        self::$Zipcode       = isset($_REQUEST["Zipcode"]) ?  $_REQUEST["Zipcode"] : "";
        self::$ZipcodeId     = isset($_REQUEST["ZipcodeId"]) ?  $_REQUEST["ZipcodeId"] : "";
        self::$Subrub        = isset($_REQUEST["Subrub"]) ?  $_REQUEST["Subrub"] : "";
        self::$PropertyIds        = isset($_REQUEST["PropertyIds"]) ?  $_REQUEST["PropertyIds"] : "";
        self::$Propcountrycode  = strtolower(isset($_REQUEST["country"]) ? $_REQUEST["country"] : "1");
        self::$SubrubDp      = strtolower(isset($_REQUEST["SubrubDp"]) ? $_REQUEST["SubrubDp"] : "");

        self::$IsPdf         = strtolower(isset($_REQUEST["IsPdf"]) ? $_REQUEST["IsPdf"] : "");



       // echo "<pre>"; print_r($_REQUEST);

        /*

        Array
        (
            [Subrub] => Auckland Road, St Heliers, Auckland
            [LocationId] => 200718
            [Street] =>
            [StreetId] =>
            [stateId] =>
            [Zipcode] =>
            [ZipcodeId] =>
            [SearchBtn] => search
            [PHPSESSID] => ebf8583134faec4bfe83c914d28cc9a5
        )
        */
    }

    public static function GetMyFolderDbValues(){
        $IndexQry	= "SELECT `MY_FOLDER_ID`, `DOC_NAME`, `DOC_REMARKS`, `FILES_LIST`, `CREATED_DT` FROM `my_folders` where MY_FOLDER_ID='" . self::$Id . "' " ;

        $rows = \DBConn\DBConnection::getQuery( $IndexQry );
        $i = 1;
        foreach ($rows as $row){
            self::$DocName        = $row["DOC_NAME"];
            self::$DocRemarks     = $row["DOC_REMARKS"];
            self::$UploadedFiles  = $row["FILES_LIST"];
        }
    }
	 public static function GetUploadedFiles($CurrId,$floor){
	     self::$Id=$CurrId;
	     self::$floor=$floor;
	      $queryStr				 = "delete from temp; update temp set image_file=:image_file";
    		$ColValarray			= array( "image_file" => '') ;
    		$Queryarray				= array($queryStr,$ColValarray);
            $ArrQueries[]=$Queryarray;
    
            $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
                    
	     $UplStr = "<div class='card-header'><div class='widget-title row pb-3'>
                     <div class='col text-right'><input type='button' class='btn btn-primary' id='ViewBtn' value='ADD IMG' onclick=\"AddFilesFn('" .self::$Id. "','".self::$floor."')\"></div>
                  </div>
               </div>";
        if($floor!='NN')
        {
            $UplStr .= "<Span id='image11" .self::$Id.self::$floor. "'><table class='table'>
    						  <tbody>";
              $Proimagerows = self::GetPropertyImages(self::$Id,self::$floor);
    
    			foreach ($Proimagerows as $Proimagerow)
    			{
    			    $imageFileName=$Proimagerow["image"];
    			    $UplStr .= "<tr>
                      <td>
                          <a href='" .SITE_BASE_URL. "uploads/propertyimage/" .$imageFileName . "' target='blank' class='afullwidth'>" .$imageFileName. "</a></td>
                          <td align='center'>
    					    <a class='btn btn-danger' href='javascript:void(0)' onclick=\"DeleteFileFn('" .self::$Id. "', '" .$imageFileName. "', '" .$floor. "')\" >
    					    <i class='fa fa-trash'></i></a>
    					</td>
    				</tr>";
    			}
    		$UplStr .= "</tbody>
                </table></Span>";
        }

        return $UplStr;
    }
    /*public static function  CompareProperty(){
	     $properties=$_REQUEST["properties"];
	     $Remove=$_REQUEST["Remove"];
	     $UplStr = "";
         $Propertyrows = self::GetPropertiesDatas('','',' AND pd.property_id in ('.$properties.') ');
		foreach ($Propertyrows as $Propertyrow)
		{
		    if($Propertyrow["reserved_by"]=="" || $Propertyrow["reserved_by"]==null)
		    {
		        $Availability="Available";
		    }
		    else
		    {
		        $Availability="Not Available";
		    }
		    $UplStr .= "<tr>
                            <td>".$Propertyrow["project_name"]."</td>
                            <td>N/A</td>
                            <td>".$Propertyrow["building"]."</td>
                            <td>".$Propertyrow["apartment_no"]."</td>
                            <td>$".$Propertyrow["dpo_rate"]."</td>
                            <td>".$Availability."</td>
                            <td>".$Propertyrow["de_construction_year_completed"]."</td>
                            <td>".$Propertyrow["no_of_bedrooms"]."</td>
                            <td>";
                               if($Remove!='N')
                               {
                                $UplStr .="<a class='btn btn-danger' href='javascript:void(0)' onclick='DeleteFn(".$Propertyrow["property_id"].")'>
        							<i class='fa fa-trash'></i>
        						</a>";
                               }
        				    $UplStr .="</td>
                        </tr>";
		}
        return $UplStr;
    }*/
    
    public static function  CompareProperty(){
        
	     $properties=$_REQUEST["properties"];
	     $Remove=$_REQUEST["Remove"];
	     $UplStr = "";
               //$properties= "2,5";
             $TempArr = array();
             \Property\PropertyClass::Init();
            $PropertyComparison = \Property\PropertyClass::GetPropertiesDatas($properties,"","");
            
           //echo "<pre>"; print_r($PropertyComparison); echo "</pre>";
          //exit;
            
            $J = 1;
            foreach($PropertyComparison as $PropCmp){
                  $PropertyId                               = $PropCmp["property_id"]           ? $PropCmp["property_id"] : "" ;
                  
                  $TempArr["UNIT_NO_".$J]                   = $PropCmp["unit_no"]           ? $PropCmp["unit_no"] : "" ;
                  $TempArr["property_name_".$J]             = $PropCmp["project_name"]     ? $PropCmp["project_name"] : "" ;
                  $TempArr["location_name_".$J]             = $PropCmp["subrub"]     ? $PropCmp["subrub"] : "" ;
                  $countryid                                = $PropCmp["country"]        ? $PropCmp["country"] : "" ;
                  $TempArr["country_id_".$J]                = $countryid;
                  $Purchaseprice			                = $PropCmp["dpo_rate"]          ? $PropCmp["dpo_rate"]         : "0";
        		  $DuvalDynamicPrice			            = $PropCmp["dynamic_rate"]          ? $PropCmp["dynamic_rate"]         : "0";
        		  $MarketPrice			                    = $PropCmp["start_rate"]          ? $PropCmp["start_rate"]     : "0";   
        		  //echo round($DuvalDynamicPrice,2) ."<br>";
        		 // echo $PropCmp["dynamic_rate"] ."<br>";
                  /*
                  $ProjectName					= $Propertyrow["project_name"]      ? $Propertyrow["project_name"]     : "";
        		   $ProprtyId					= $Propertyrow["property_id"]      ? $Propertyrow["property_id"]     : "";
        		   $building					= $Propertyrow["building"]          ? $Propertyrow["building"]         : "";
        		   $apartment_no				= $Propertyrow["apartment_no"]      ? $Propertyrow["apartment_no"]     : "";
        		   $UnitSize					= $Propertyrow["land_area"]         ? $Propertyrow["land_area"]        : "0";
        		   $UnitType					= $Propertyrow["no_of_bedrooms"]    ? $Propertyrow["no_of_bedrooms"]   : "0";
        		   
        		   $countryid			        = $Propertyrow["country"]           ? $Propertyrow["country"]          : "";
        		   $weeklyRent			        = $Propertyrow["weekly_rent"]      ? $Propertyrow["weekly_rent"]       : "";
        		   $location_id			        = $Propertyrow["location_id"]      ? $Propertyrow["location_id"]       : "";
        		   $subrub			            = $Propertyrow["subrub"]      ? $Propertyrow["subrub"]       : "";
        		   $project_description			= $Propertyrow["project_description"]      ? $Propertyrow["project_description"]       : "";
                  */
                    
                    $CurArr = \Property\PropertyClass::getCountryDatas($countryid);
                    foreach($CurArr as $cur){
                        $TempArr["country_name_".$J]                = $cur["COUNTRY_NAME"]      ? $cur["COUNTRY_NAME"] : "" ;
                        $CURRENCYTEMP                               = $cur["CURRENCY"]           ? $cur["CURRENCY"] : "" ;
                        $TempArr["baseCur_".$J]                     = $CURRENCYTEMP;
                    }
              
              
              
                    // echo "PropertyId=".$PropertyId;
                   //  echo "countryid=".$countryid;
 
          
          
                     \ajax\ajaxClass::Init();
                   $PropComp    =  \ajax\ajaxClass::GetAnalyzerValidation($PropertyId,$countryid);
                   
         // echo "<pre>"; print_r($PropComp); echo "</pre>";
        //exit;    
                   
                $TempArr["PropertyList_".$J]                = $J;
                    
                    
                  //$DuvalDynamicPrice                        = $PropComp["0"]["DuvalDynamicPrice"]; 
                  $stampdutyTemp                            = $PropComp["0"]["StampDuty"]; 
                  $mortgageregistrationTemp                 = $PropComp["0"]["MortgageRegistration"]; 
                  $transferfeesTemp                         = $PropComp["0"]["TransferFees"]; 
                                  
                $TempArr["cpi_".$J]                         =  $PropComp["0"]["CPI"];  
                $TempArr["rentalgrowth_".$J]                =  $PropComp["0"]["RentalGrowth"];
                $TempArr["capitalgrowth_".$J]               =  $PropComp["0"]["CapitalGrowth"]; 
               
                   //echo $DuvalDynamicPrice;

                  
                   $Prop        =  \ajax\ajaxClass::AnalyzerResult($PropertyId,"ARRAY","COMPARE");
                   
                                
                 
  
                  
                  $UsdExRateArr =  \Property\PropertyClass::GetCurrExrate("USD",$CURRENCYTEMP);
                  
                  
                  $UsdExRate = "";
                  foreach($UsdExRateArr as $cur){
                       $UsdExRate   = $cur["RATE"]      ? $cur["RATE"] : "" ;
                       
                    }
                   

                  
                  if ($UsdExRate == "")
                    $UsdExRate = 1;
                 

                  
                  if ( $countryid == "2"){
                      
                      $TempArr["PurhcasePrice_".$J]             = round(floatval(round($DuvalDynamicPrice,0)) / floatval($UsdExRate),0);
                      $TempArr["stampduty_".$J]                 = round(floatval($stampdutyTemp) / floatval($UsdExRate),0);
                      $TempArr["mortgageregistration_".$J]      = round(floatval($mortgageregistrationTemp) / floatval($UsdExRate),0);
                      $TempArr["transferfees_".$J]              = round(floatval($transferfeesTemp) / floatval($UsdExRate),0);
                      $TempArr["TotalCashRequirement_".$J]      = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                      
                      
                      
                  }elseif ( $countryid == "1"){
                      $TempArr["PurhcasePrice_".$J]            = round(floatval(round($DuvalDynamicPrice,0)) / floatval($UsdExRate),0);
                      $TempArr["stampduty_".$J]                = round(floatval($stampdutyTemp),0) ;
                      $TempArr["mortgageregistration_".$J]     = 0;
                      $TempArr["transferfees_".$J]             = round(floatval($transferfeesTemp) / floatval($UsdExRate),0);
                      $TempArr["TotalCashRequirement_".$J]     = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                      
                  }elseif ( $countryid == "3"){
                    
                      $TempArr["PurhcasePrice_".$J]              = round(floatval(round($DuvalDynamicPrice,0)) / floatval($UsdExRate),0);
                      $TempArr["stampduty_".$J]                 = round(floatval($stampdutyTemp) / floatval($UsdExRate),0);
                      $TempArr["mortgageregistration_".$J]      = round(floatval($mortgageregistrationTemp) / floatval($UsdExRate),0);
                      $TempArr["transferfees_".$J]              = "";
                      $TempArr["TotalCashRequirement_".$J]      = round(floatval($Prop[0]["TotalInitialCashCost"]) / floatval($UsdExRate),0);
                      
                      
                    //echo floatval($DuvalDynamicPrice) ;
                    //exit();
                    
                 }else{
                     
                       $TempArr["PurhcasePrice_".$J]            = 0;
                       $TempArr["stampduty_".$J]                = 0;
                       $TempArr["mortgageregistration_".$J]     = 0;
                       $TempArr["transferfees_".$J]             = 0;
                       $TempArr["TotalCashRequirement_".$J]     = 0;
                 }
                  

                     
                    $TempArr["IRR_".$J]                         =  $Prop[0]["IRR"];
                    $TempArr["IRRAfterTax_".$J]                 =  $Prop[0]["IRRAfterTax"];
                    
                    
                    
                    
                    /*
                    $input = array(
                      array(
                        'tag_name' => 'google'
                      ),
                      array(
                        'tag_name' => 'technology'
                      )
                    );
                    */
                    
                    //echo "Prop=><pre>"; print_r( $Prop); echo "</pre>";
                    
                    /*
                    echo str_replace("remove0,", "", implode(',', array_map(function ($entry) {
                      return  (intval($entry["key_id"]) == 0 ) ? "remove" . $entry["NetCashFlowAfterTax"] : $entry["NetCashFlowAfterTax"];
                    }, $Prop))) ;
                    */

                    
                    $TempArr["NetCashFlowAfterTax_".$J]          =   str_replace("remove0,", "", implode(',', array_map(function ($entry) {
                      return  (intval($entry["key_id"]) == 0 ) ? "remove" . $entry["NetCashFlowAfterTax"] : $entry["NetCashFlowAfterTax"];
                    }, $Prop))) ;

                                                                        
                                                                        
                    $TempArr["TotalAnnualReturnAfterTax_".$J]           =  str_replace("remove0,", "", implode(',', array_map(function ($entry) {
                      return  (intval($entry["key_id"]) == 0 ) ? "remove" . $entry["TotalAnnualReturnAfterTax"] : $entry["TotalAnnualReturnAfterTax"];
                    }, $Prop))) ; 
                    
                    
                   /* round($Prop[1]["TotalAnnualReturnAfterTax"],0).",".round($Prop[2]["TotalAnnualReturnAfterTax"],0).",".round($Prop[3]["TotalAnnualReturnAfterTax"],0).","
                                                                        .round($Prop[4]["TotalAnnualReturnAfterTax"],0).",".round($Prop[5]["TotalAnnualReturnAfterTax"],0).",".round($Prop[6]["TotalAnnualReturnAfterTax"],0).",".round($Prop[7]["TotalAnnualReturnAfterTax"],0)
                                                                        .",".round($Prop[8]["TotalAnnualReturnAfterTax"],0).",".round($Prop[9]["TotalAnnualReturnAfterTax"],0).",".round($Prop[10]["TotalAnnualReturnAfterTax"],0);
                   */
                    $TempArr["Equity_".$J]                              =   str_replace("remove0,", "", implode(',', array_map(function ($entry) {
                      return  (intval($entry["key_id"]) == 0 ) ? "remove" . $entry["Equity"] : $entry["Equity"];
                    }, $Prop))) ; 
                    
                   /* 
                    round($Prop[1]["Equity"],0).",".round($Prop[2]["Equity"],0).",".round($Prop[3]["Equity"],0).",".round($Prop[4]["Equity"],0).",".round($Prop[5]["Equity"],0).",".round($Prop[6]["Equity"],0).
                                                                            ",".round($Prop[7]["Equity"],0).",".round($Prop[8]["Equity"],0).",".round($Prop[9]["Equity"],0).",".round($Prop[10]["Equity"],0);*/
                   
                    


     
                  
                  
                  $J++;
            }
            
            
          
            $IndexQry = "select 
                        '' as Headers,
                        'Property List' as columns ,
                        'PropertyList_' as feildname
                        from dual
                        union all
                        select 
                        'Address' as Headers,
                        '' as columns ,
                        '' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'Unit No' as columns ,
                        'UNIT_NO_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'Property' as columns ,
                        'property_name_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'City' as columns  ,
                        'location_name_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'State/County' as columns ,
                        'country_name_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'Country' as columns ,
                        'country_name_' as feildname
                        from dual
                        union all
                        select 
                        'Purchase Information' as Headers,
                        '' as columns ,
                        '' as feildname
                        from dual
                         union all
                        select 
                        '' as Headers,
                        'Purhcase Price' as columns ,
                        'PurhcasePrice_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'Stamp Duty' as columns ,
                        'stampduty_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'Mortgage/Lease Registration' as columns ,
                        'mortgageregistration_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'Transfer Fees' as columns ,
                        'transferfees_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'Total Cash Requirement' as columns ,
                        'TotalCashRequirement_' as feildname
                        from dual
                        union all
                        select 
                        'Growth' as Headers,
                        '' as columns ,
                        '' as feildname
                        from dual
                         union all
                        select 
                        '' as Headers,
                        'CPI' as columns ,
                        'cpi_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'Rental Growth' as columns ,
                        'rentalgrowth_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'Capital Growth' as columns ,
                        'capitalgrowth_' as feildname
                        from dual
                        union all
                        select 
                        'IRR' as Headers,
                        '' as columns ,
                        '' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'IRR' as columns ,
                        'IRR_' as feildname
                        from dual
                        union all
                        select 
                        '' as Headers,
                        'IRR (after tax)' as columns ,
                        'IRRAfterTax_' as feildname
                        from dual";

          


            $Rows = \DBConn\DBConnection::getQuery( $IndexQry );
            
            foreach($Rows as $Row){
                
                
                if ( $Row["Headers"] !="" ){
                    
               
                    $UplStr .="<tr><td>". $Row["Headers"] ."</td></tr> ";
     
                }else{
               
                    $UplStr .= "<tr><td>".$Row["columns"] ."</td>";
                              
                           $feildname = $Row["feildname"]; 
                           for($k=1; $k < $J; $k++){
                            $UplStr .="<td>". $TempArr[$feildname.$k] ."</td>";
                     
                            }
                     
                    $UplStr .="</tr>";
                
              
                }
                
            }
         
           $AnnualArr = array();
           $TotalReturnArr = array();
           $RentalReturnArr = array();
           
           for($m=1; $m < $J; $m++)
           {
           
                if ($m==1){
                    $MyArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["NetCashFlowAfterTax_".$m]}"), "backgroundColor" => "rgba(138,155,240,0.0)",
                        "borderWidth" => 2,"borderColor" => "#8a9bf0","pointRadius" => 0 );
                    $TotalReturnArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["TotalAnnualReturnAfterTax_".$m]}"), "backgroundColor" => "rgba(138,155,240,0.0)",
                        "borderWidth" => 2,"borderColor" => "#8a9bf0","pointRadius" => 0 );
                    $RentalReturnArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["TotalAnnualReturnAfterTax_".$m]}"), "backgroundColor" => "rgba(138,155,240,1)",
                        "borderWidth" => 2,"borderColor" => "#8a9bf0","pointRadius" => 0 );
                }elseif ($m==2){
                    $MyArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["NetCashFlowAfterTax_".$m]}"), "backgroundColor" => "rgba(240,165,91,0.0)",
                        "borderWidth" => "2","borderColor" => "#F0A55B","pointRadius" => 0 );
                    $TotalReturnArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["TotalAnnualReturnAfterTax_".$m]}"), "backgroundColor" => "rgba(240,165,91,0.0)",
                        "borderWidth" => "2","borderColor" => "#F0A55B","pointRadius" => 0 );
                     $RentalReturnArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["TotalAnnualReturnAfterTax_".$m]}"), "backgroundColor" => "rgba(240,165,91,1)",
                        "borderWidth" => 2,"borderColor" => "#8a9bf0","pointRadius" => 0 );
                
                }elseif ($m==3){
                    $MyArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["NetCashFlowAfterTax_".$m]}"), "backgroundColor" => "rgba(43,212,54,0.0)",
                        "borderWidth" => "2","borderColor" => "#2AD436","pointRadius" => 0 );
                    $TotalReturnArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["TotalAnnualReturnAfterTax_".$m]}"), "backgroundColor" => "rgba(43,212,54,0.0)",
                        "borderWidth" => "2","borderColor" => "#2AD436","pointRadius" => 0 );
                     $RentalReturnArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["TotalAnnualReturnAfterTax_".$m]}"), "backgroundColor" => "rgba(43,212,54,1)",
                        "borderWidth" => 2,"borderColor" => "#8a9bf0","pointRadius" => 0 );
                    
                }elseif ($m==4){
                    $MyArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["NetCashFlowAfterTax_".$m]}"), "backgroundColor" => "rgba(138,155,240,0.0)",
                        "borderWidth" => "2","borderColor" => "#8a9bf0","pointRadius" => 0 );
                    $TotalReturnArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["TotalAnnualReturnAfterTax_".$m]}"), "backgroundColor" => "rgba(138,155,240,0.0)",
                        "borderWidth" => "2","borderColor" => "#8a9bf0","pointRadius" => 0 );
                     $RentalReturnArr[] = array("label" => "Propety {$m}" , "data" => array("{$TempArr["TotalAnnualReturnAfterTax_".$m]}"), "backgroundColor" => "rgba(138,155,240,1)",
                        "borderWidth" => 2,"borderColor" => "#8a9bf0","pointRadius" => 0 );
                    
                }
                               
                 
             
            }
            
            
            $UplStr .="<input type='hidden' name='TotalCount' id='TotalCount' value='". $m-1 ."' >";
            
            /*
            $MyArr = array();
            
            $MyArr[] = array("label" => "Propety 1" , "data" => array(1,2,3,4,5,5), "backgroundColor" => "(138,155,240,0.0)");
            $MyArr[] = array("label" => "Propety 2" , "data" => array(1,2,3,4,5,5), "backgroundColor" => "(138,155,240,0.0)");
            $MyArr[] = array("label" => "Propety 3" , "data" => array(1,2,3,4,5,5), "backgroundColor" => "(138,155,240,0.0)");
            
            */
            $MyJson = str_replace(array("\"label\":", "\"data\":" , "\"backgroundColor\":" , "\"borderWidth\":" , "\"borderColor\":" , "\"pointRadius\":" , "[\"" , "\"]"), 
                            array("label:", "data:", "backgroundColor:", "borderWidth:", "borderColor:", "pointRadius:", "[" , "]"), json_encode($MyArr)); 
                            
            $MyJsontotRet = str_replace(array("\"label\":", "\"data\":" , "\"backgroundColor\":" , "\"borderWidth\":" , "\"borderColor\":" , "\"pointRadius\":" , "[\"" , "\"]"), 
                            array("label:", "data:", "backgroundColor:", "borderWidth:", "borderColor:", "pointRadius:", "[" , "]"), json_encode($TotalReturnArr)); 
        
            $MyJsonReturn = str_replace(array("\"label\":", "\"data\":" , "\"backgroundColor\":" , "\"borderWidth\":" , "\"borderColor\":" , "\"pointRadius\":" , "[\"" , "\"]"), 
                            array("label:", "data:", "backgroundColor:", "borderWidth:", "borderColor:", "pointRadius:", "[" , "]"), json_encode($RentalReturnArr)); 
            
            $UplStr .= "<script type=\"text/javascript\">
			   // Cash Flow
			   var ctx = document.getElementById(\"annualCashFlow\");
			   ctx.height = 100;
			   var myChart = new Chart(ctx, {
				   type: 'line',
				   data: {
					   labels: [\"1\", \"2\", \"3\", \"4\", \"5\", \"6\", \"7\", \"8\", \"9\", \"10\"],
					   type: 'line',
			   
					   datasets: ".$MyJson."
				   },
				   options: {
					   responsive: true,
					   tooltips: {
						   enabled: false,
					   },
					   legend: {
						   display: true,
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
			   
			    //Estimate Equity
                   var ctx = document.getElementById(\"annualReturn\");
                   ctx.height = 100;
                   var myChart = new Chart(ctx, {
                       type: 'line',
                       data: {
                           labels: [\"1\", \"2\", \"3\", \"4\", \"5\", \"6\", \"7\", \"8\", \"9\", \"10\"],
                           type: 'line',
                   
                           datasets: ".$MyJsontotRet."
                       },
                       options: {
                           responsive: true,
                           tooltips: {
                               enabled: false,
                           },
                           legend: {
                               display: true,
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
                
                
                   // Rental Return
                   var ctx = document.getElementById(\"estimateEquity\");
                   ctx.height = 100;
                   var myChart = new Chart(ctx, {
                       type: 'bar',
                       data: {
                           labels: [\"1\", \"2\", \"3\", \"4\", \"5\", \"6\", \"7\", \"8\", \"9\", \"10\"],
                           type: 'line',
                   
                           datasets: ".$MyJsonReturn."
                       },
                       options: {
                           responsive: true,
                           tooltips: {
                               enabled: false,
                           },
                           legend: {
                               display: true,
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

			</script>";
  
                                
        return $UplStr;
    }
    public static function Refresh(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        self::GetFormValues();
        ECHO// self::$Id;
         $UplStr = "<table class='table'>
						  <tbody>";
          $Proimagerows = self::GetPropertyImages(self::$Id,self::$floor);

			foreach ($Proimagerows as $Proimagerow)
			{
			    $imageFileName=$Proimagerow["image"];
			    $UplStr .= "<tr>
                  <td>
                      <a href='" .SITE_BASE_URL. "uploads/propertyimage/" .$imageFileName . "' target='blank' class='afullwidth'>" .$imageFileName. "</a></td>
                      <td align='center'>
					    <a class='btn btn-danger' href='javascript:void(0)' onclick=\"DeleteFileFn('" .self::$Id. "', '" .$imageFileName. "', '" .$floor. "')\" >
					    <i class='fa fa-trash'></i></a>
					</td>
				</tr>";
			}
		$UplStr .= "</tbody>
            </table>";

        return $UplStr;
    }
    public static function Refresh1(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        self::GetFormValues();
        //ECHO// self::$Id;


         $Proimagerows = $Proimagerows = self::GettempImages();

			foreach ($Proimagerows as $Proimagerow)
			{
			    $imageFileName=$Proimagerow["image_file"];
			}

        return $imageFileName;
    }
    public static function DeleteFile(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        self::GetFormValues();
	    $queryStr		= " DELETE from project_image WHERE project_id=:project_id AND floor_type=:floor_type AND image=:image ";

		$ColValarray	= array("project_id" => self::$FolderId,"floor_type"=>self::$floor, "image"=>self::$BrochureFile) ;

		$Queryarray		= array($queryStr,$ColValarray);

		$ArrQueries[]	= $Queryarray;
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries);

        echo $Msg;

    }
    public static function AddToFavorite(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        $ProjectIdval=strval($_REQUEST["ProjectId"]);
        $UserIdVal=$_REQUEST["UserId"];
       
            $queryStr		= "insert into  Add_favorite_project  (project_id,user_id) values (:project_id, :user_id) ";
    	    $ColValarray	= array("project_id" => $ProjectIdval, "user_id" => $UserIdVal) ;
    
    		$Queryarray		= array($queryStr,$ColValarray);
    
    		$ArrQueries[]	= $Queryarray;
            $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries);
            // return $Msg;
            // print_r($Msg);
            if($Msg =="Success" || $Msg == "success"){
                echo json_encode(array('status'=>1,'message'=>"added to favourite successfully"));
            }
            else{
                echo json_encode(array('status'=>0,'message'=>"Something went wrong"));
            }
    }
    public static function RemoveFavorite(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        $ProjectIdval=strval($_REQUEST["ProjectId"]);

        $UserIdVal=$_REQUEST["UserId"];

	    $queryStr		= "Delete from  Add_favorite_project where project_id=:project_id and user_id=:user_id ";
	    $ColValarray			= array("project_id" => $ProjectIdval, "user_id" => $UserIdVal) ;

		$Queryarray		= array($queryStr,$ColValarray);

		$ArrQueries[]	= $Queryarray;
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries);

        // return $Msg;
      if($Msg == "success"){
            echo json_encode(array('status'=>1,'message'=>"removed from favorite successfully"));
        }
        else{
            echo json_encode(array('status'=>0,'message'=>"Something went wrong"));
        }

    }
    public static function AddToFavoritePro(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        $ProjectIdval=strval($_REQUEST["PropertyId"]);

        $UserIdVal=$_REQUEST["UserId"];

	    $queryStr		= "insert into  Add_favorite_property  (property_id,user_id) values (:property_id, :user_id) ";
	    $ColValarray			= array("property_id" => $ProjectIdval, "user_id" => $UserIdVal) ;

		$Queryarray		= array($queryStr,$ColValarray);

		$ArrQueries[]	= $Queryarray;
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries);

        echo "<script>window.history.go(-1);</script>";

    }
    public static function RemoveFavoritePro(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();
        $ProjectIdval=strval($_REQUEST["PropertyId"]);

        $UserIdVal=$_REQUEST["UserId"];

	    $queryStr		= "Delete from  Add_favorite_property where property_id=:property_id and user_id=:user_id ";
	    $ColValarray			= array("property_id" => $ProjectIdval, "user_id" => $UserIdVal) ;

		$Queryarray		= array($queryStr,$ColValarray);

		$ArrQueries[]	= $Queryarray;
        $Msg			= \DBConn\DBConnection::pdoRunQuery($ArrQueries);

        echo $Msg;

    }
    public static function AddFiles(){
		\Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

		self::GetFormValues();
		self::GetMyFolderDbValues();
        self::$Mode="Upload";
		//echo "Id =" . self::$Id;
//exit;
	    include_once ( \Html\HtmlClass::GetFolderName() . "/views/Property/MyFolderFilesAdd.php" );
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
        //else{
          //  include_once ( \Html\HtmlClass::GetFolderName() . "/views/Masters/myfolder.php" );
        //}
    }
    public static function myfolderfileupload(){
        \Html\HtmlClass::init();
        \settings\session\sessionClass::CheckSession();

        //echo "out";

		$ArrQueries						= array();


        if (isset($_FILES["UploadFile"]["tmp_name"])){
            //echo "in";
            $tmpname = $_FILES["UploadFile"]["tmp_name"];
            $filename = $_FILES["UploadFile"]["name"];
            $actfilename = str_replace(",", "_", $filename);
            if (self::$Id=='' || self::$Id==null)
            {
                $UplFilePath = "uploads/projectimage/" . $actfilename;
            }
            else
            {
                $UplFilePath = "uploads/propertyimage/" . $actfilename;
            }
            if (move_uploaded_file($tmpname, $UplFilePath) ){
                if (self::$UploadedFiles == ""){
                    self::$UploadedFiles = $actfilename;
                }
                else{
                    self::$UploadedFiles = self::$UploadedFiles . "," . $actfilename;
                }

				//echo self::$UploadedFiles;
                 if (self::$Id!='' && self::$Id!=null && self::$floor!='NN')
                 {

                    $queryStr				 = "insert into  project_image  (project_id,floor_type,image,created_date) values (:project_id, :floor_type,:image ,:created_date) ";
    				$created_on		 = date("Y-m-d");
    				$ColValarray			= array("project_id" => self::$Id, "floor_type" => self::$floor, "image" => self::$UploadedFiles,"created_date" =>$created_on) ;
    				$Queryarray				= array($queryStr,$ColValarray);
                    $ArrQueries[]=$Queryarray;

    				$queryStr				 = "update property_details set property_image=:property_image where project_id=:project_id and floor_type=:floor_type
    				and (property_image is null or property_image ='' or property_image =' ' )";
    				$ColValarray			= array("property_image" => self::$UploadedFiles,"project_id" => self::$Id, "floor_type" => self::$floor) ;
    				$Queryarray				= array($queryStr,$ColValarray);
                    $ArrQueries[]=$Queryarray;



    				$Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
                    if ($Msg == "success"){
					echo "	<script src='" . SITE_BASE_URL . "assets/js/core/jquery.min.js'></script>
    				<script src='" . SITE_BASE_URL . "assets/js/colorbox/jquery.colorbox.js'></script>
    				<script>parent.jQuery.colorbox.close();</script>";
    				}
    				else
    					echo "failed";
                 }
                 else
                 {
                    $queryStr				 = "delete from temp; insert into  temp  (image_file) values (:image_file) ";
    				$ColValarray			= array( "image_file" => self::$UploadedFiles) ;
    				$Queryarray				= array($queryStr,$ColValarray);
                    $ArrQueries[]=$Queryarray;

    				$ArrQueries[]=$Queryarray;

                    $Msg = \DBConn\DBConnection::pdoRunQuery($ArrQueries);
                    if ($Msg == "success"){
                    echo "	<script src='" . SITE_BASE_URL . "assets/js/core/jquery.min.js'></script>
    				<script src='" . SITE_BASE_URL . "assets/js/colorbox/jquery.colorbox.js'></script>
    				<script>parent.jQuery.colorbox.close();</script>";
                    }
    				else
    					echo "failed";

                 }




            }
        }
    }


    public static function getCountryDatas($CountryCode){

        $IndexQry	= " SELECT COUNTRY_CODE, COUNTRY_NAME,COUNTRY_CODE_NEW, CURRENCY, Currency_Symbol, IMAGE, country_map_url,Country_Lat,Country_Lng  FROM country_master WHERE  COUNTRY_CODE = '{$CountryCode}' 	" ;


		 return \DBConn\DBConnection::getQuery($IndexQry);


    }
    public static function GetFavoriteProject($Condi=""){

        $IndexQry	= " SELECT project_id,user_id FROM Add_favorite_project WHERE  1 =1  ".$Condi ;


		 return \DBConn\DBConnection::getQuery($IndexQry);


    }
    public static function GetFavoriteProperty($Condi=""){

        $IndexQry	= " SELECT property_id,user_id FROM Add_favorite_property WHERE  1 =1  ".$Condi ;


		 return \DBConn\DBConnection::getQuery($IndexQry);


    }

/*
    public static function GetPropertyComparison($UserId){
        $TempArr    = array();
        $IndexQry	= " SELECT * FROM property_analyzer WHERE userid ='".$UserId."'  ";

		 $RsProPertyComp             = \DBConn\DBConnection::getQuery($IndexQry);


        $i=1;
        foreach ($RsProPertyComp as $index => $row) {
            $TempArr["propertyid_".$i]  =  $row["propertyid"] ?  $row["propertyid"] : "";
            $TempArr["userid_".$i]  =  $row["userid"] ? $row["userid"] : "";
            $TempArr["PurchasePrice_".$i]  =  $row["PurchasePrice"] ? $row["PurchasePrice"] : "";
            $TempArr["TotalInitialCashCost_".$i]  =  $row["TotalInitialCashCost"] ? $row["TotalInitialCashCost"] : "";
            $TempArr["EffectiveStampDutyRate_".$i]  =  $row["EffectiveStampDutyRate"] ? $row["EffectiveStampDutyRate"] : "";
            $TempArr["CapitalGrowth_".$i]  =  $row["CapitalGrowth"] ? $row["CapitalGrowth"] : "";
            $TempArr["CPI_".$i]  =  $row["CPI"] ? $row["CPI"] : "";
            $TempArr["PropertyValue_".$i]  =  $row["PropertyValue"] ? $row["PropertyValue"] : "";
            $TempArr["OutstandingMortgage_".$i]  =  $row["OutstandingMortgage"] ? $row["OutstandingMortgage"] : "";
            $TempArr["GrossIncome_".$i]  =  $row["GrossIncome"] ? $row["GrossIncome"] : "";
            $TempArr["LoanToValue_".$i]  =  $row["LoanToValue"] ? $row["LoanToValue"] : "";
            $TempArr["Equity_".$i]  =  $row["Equity"] ? $row["Equity"] : "";
            $TempArr["SurplusEquityBasedLTV_".$i]  =  $row["SurplusEquityBasedLTV"] ? $row["SurplusEquityBasedLTV"] : "";
            $TempArr["OperatigExpTotal_".$i]  =  $row["OperatigExpTotal"] ? $row["OperatigExpTotal"] : "";
            $TempArr["NonCashExpenses_".$i]  =  $row["NonCashExpenses"] ? $row["NonCashExpenses"] : "";
            $TempArr["MortgagePayment_".$i]  =  $row["MortgagePayment"] ? $row["MortgagePayment"] : "";
            $TempArr["AnnualInterest_".$i]  =  $row["AnnualInterest"] ? $row["AnnualInterest"] : "";
            $TempArr["AnnualPrincipal_".$i]  =  $row["AnnualPrincipal"] ? $row["AnnualPrincipal"] : "";
            $TempArr["NetCashFlow_".$i]  =  $row["NetCashFlow"] ? $row["NetCashFlow"] : "";
            $TempArr["AnnualAppn_".$i]  =  $row["AnnualAppn"] ? $row["AnnualAppn"] : "";
            $TempArr["TotalAnnualReturn_".$i]  =  $row["TotalAnnualReturn"] ? $row["TotalAnnualReturn"] : "";
            $TempArr["EstimatedTax_".$i]  =  $row["EstimatedTax"] ? $row["EstimatedTax"] : "";
            $TempArr["EstCummulativeTaxCredit_".$i]  =  $row["EstCummulativeTaxCredit"] ? $row["EstCummulativeTaxCredit"] : "";
            $TempArr["NetCashFlowAfterTax_".$i]  =  $row["NetCashFlowAfterTax"] ? $row["NetCashFlowAfterTax"] : "";
            $TempArr["TotalAnnualReturnAfterTax_".$i]  =  $row["TotalAnnualReturnAfterTax"] ? $row["TotalAnnualReturnAfterTax"] : "";
            $TempArr["NetCashFlowMonth_".$i]  =  $row["NetCashFlowMonth"] ? $row["NetCashFlowMonth"] : "";
            $TempArr["TotalAnnualReturnMonth_".$i]  =  $row["TotalAnnualReturnMonth"] ? $row["TotalAnnualReturnMonth"] : "";
            $TempArr["EstimatedTaxMonth_".$i]  =  $row["EstimatedTaxMonth"] ? $row["EstimatedTaxMonth"] : "";
            $TempArr["EstCummulativeTaxCreditMonth_".$i]  =  $row["EstCummulativeTaxCreditMonth"] ? $row["EstCummulativeTaxCreditMonth"] : "";
            $TempArr["NetCashFlowAfterTaxMonth_".$i]  =  $row["NetCashFlowAfterTaxMonth"] ? $row["NetCashFlowAfterTaxMonth"] : "";
            $TempArr["TotalAnnualReturnAfterTaxMonth_".$i]  =  $row["TotalAnnualReturnAfterTaxMonth"] ? $row["TotalAnnualReturnAfterTaxMonth"] : "";
            $TempArr["createddate_".$i]  =  $row["createddate"] ? $row["createddate"] : "";
            $TempArr["lastupdateddate_".$i]  =  $row["lastupdateddate"] ? $row["lastupdateddate"] : "";
            

			 $i++;
        }
		 
		return $TempArr;


    }
    
    */
    
   public static function GetPropertyComparison($country="",$Id="",$autoid="",$DateVal="",$ViewCompare="",$IsPdf="N"){
       
        \Html\HtmlClass::init();
        if($IsPdf != "Y")
        {
            \settings\session\sessionClass::CheckSession();
        }
        $UserId            = \settings\session\sessionClass::GetSessionDisplayName();
        $cond = "";
        $condUnion = "";
    //     echo $autoid;
    //   die();
        if ($Id!="")
        {
            $cond .= " and pai.propertyid='" . $Id . "' ";    
        }
        if ($country!="")
        {
            $cond .=  " and pr.COUNTRY ='" . $country . "' ";
            $condUnion .= " and pai.country_id ='" . $country . "' ";
        }
	    if ( $DateVal == "CP")
	    {
	        $cond .= " and pai.completion_date <= NOW() ";
	        $condUnion .= " and pai.completion_date <= NOW()  ";
	    }
	    else if ( $DateVal == "NP")
	    {
	        $cond .= " and ( pai.completion_date > NOW() OR pai.completion_date ='' OR pai.completion_date is null) ";
	        $condUnion .= " and ( pai.completion_date > NOW()  OR pai.completion_date ='' OR pai.completion_date is null ) ";
	    }
        if($autoid != "")
        {
            $cond .= "  and pai.autoid in (". $autoid.")  ";
            $condUnion .= "  and pai.autoid in (". $autoid.")  ";
        }
        else
        {
            if($ViewCompare == "R")
            {
                $TodayDate = date('Y-m-d');
                $cond .= "  and pai.fromflag in ('R') and DATE_FORMAT(created_date, '%Y-%m-%d') ='{$TodayDate}' ";
                $condUnion .= "  and pai.fromflag in ('R') and DATE_FORMAT(created_date, '%Y-%m-%d') ='{$TodayDate}'  ";
                
            }
            else
            {
                $cond .= "  and ( pai.fromflag <> ('R') or pai.fromflag is null or pai.fromflag = '' )  "; 
                $condUnion .= " and ( pai.fromflag <> ('R') or pai.fromflag is null or pai.fromflag = '' )  ";
            }
        }
        $IndexQry	= "SELECT 
            cm.country_name,
            cm.country_code as country_id,
            cm.COUNTRY_CODE_NEW as CountryCodeNew,
            pd.property_id as propertyid, 
            pai.autoid, pai.userid, 
            pai.owneroccupier, 
            pai.secondhomeinvestment, 
            pai.audynamicprice, 
            pai.resident, 
            pai.residentinvestor,
            pai.income, 
            pai.marketprice, 
            pai.duvaldynamicprice, 
            pai.stampduty, 
            pai.leaseregistration, 
            pai.transferfees, 
            pai.mortgageregistration, 
            pai.landtransfer, 
            pai.legalfees,
            pai.totalpurchasecost, 
            pai.resetrvationfees, 
            pai.stagepay1per, 
            pai.stagepay1amt, 
            pai.stagepay2per, 
            pai.stagepay2amt, 
            pai.loanamountper, 
            pai.topup, 
            pai.weeklyrental,
            pai.vacancyrate, 
            pai.lettingfeerate, 
            pai.managementfees, 
            pai.councilpropertytax, 
            pai.codycorporateservicechg,
            pai.landleaserentpa, 
            pai.insurancepa, 
            pai.repairandmaintenance,
            pai.cleaningpermonth, 
            pai.gardeningpermonth, 
            pai.servicecontractspa, 
            pai.other, 
            pai.ltv, 
            pai.initialloanamt, 
            pai.interestrate, 
            pai.termyears, 
            pai.cpi, 
            pai.rentalgrowth, 
            pai.capitalgrowth, 
            pai.buildingvalue, 
            pai.buildinglife, 
            pai.fixturesvalue, 
            pai.fixtureslife, 
            pai.furniturevalue, 
            pai.furniturelife,
            pai.location_name as location_name,
            pd.BUILDING as property_name, 
            pai.property_desc as property_desc,
            pd.UNIT_NO,
            pr.subrub as location_name, 
            pr.currency as baseCur , 
            DATE_FORMAT(pai.purschase_date,'%d/%m/%Y') as purschase_date ,
            DATE_FORMAT(pai.completion_date,'%d/%m/%Y') as completion_date, 
            pai.IntOrPrincipalInt, 
            pai.ResidentStatus, 
            pai.HavePersonalAllowance, 
            pai.UkResidentStatus 
                FROM 
                property_analyzer_inputs pai,
                property_details pd, 
                project pr,
                country_master cm 
                    WHERE pai.propertyid = pd.property_id 
                        and pr.project_id = pd.project_id
                        and pr.COUNTRY =  cm.COUNTRY_code  
                        and  pai.propertyid is not null  
                        and pai.userid='".$UserId."' ".$cond." 
                    union SELECT 
                            cm.country_name, 
                            pai.country_id,
                            cm.COUNTRY_CODE_NEW as CountryCodeNew, 
                            pai.propertyid, 
                            pai.autoid, 
                            pai.userid, 
                            pai.owneroccupier, 
                            pai.secondhomeinvestment, 
                            pai.audynamicprice, 
                            pai.resident,
                            pai.residentinvestor, 
                            pai.income, 
                            pai.marketprice, 
                            pai.duvaldynamicprice, 
                            pai.stampduty, 
                            pai.leaseregistration, 
                            pai.transferfees, 
                            pai.mortgageregistration, 
                            pai.landtransfer, 
                            pai.legalfees, 
                            pai.totalpurchasecost, 
                            pai.resetrvationfees, 
                            pai.stagepay1per, 
                            pai.stagepay1amt, 
                            pai.stagepay2per, 
                            pai.stagepay2amt, 
                            pai.loanamountper, 
                            pai.topup, 
                            pai.weeklyrental, 
                            pai.vacancyrate, 
                            pai.lettingfeerate, 
                            pai.managementfees, 
                            pai.councilpropertytax, 
                            pai.codycorporateservicechg, 
                            pai.landleaserentpa, 
                            pai.insurancepa, 
                            pai.repairandmaintenance,
                            pai.cleaningpermonth, 
                            pai.gardeningpermonth, 
                            pai.servicecontractspa, 
                            pai.other, 
                            pai.ltv, 
                            pai.initialloanamt, 
                            pai.interestrate, 
                            pai.termyears, 
                            pai.cpi, 
                            pai.rentalgrowth,  
                            pai.capitalgrowth,
                            pai.buildingvalue, 
                            pai.buildinglife, 
                            pai.fixturesvalue, 
                            pai.fixtureslife, 
                            pai.furniturevalue, 
                            pai.furniturelife,
                            pai.location_name as location_name, 
                            pai.property_name as property_name, 
                            pai.property_desc as property_desc,
                            '' AS UNIT_NO , 
                            pai.location_name ,
                            cm.CURRENCY as baseCur, 
                            DATE_FORMAT(pai.purschase_date,'%d/%m/%Y') as purschase_date ,
                            DATE_FORMAT(pai.completion_date,'%d/%m/%Y') as completion_date,
                            pai.IntOrPrincipalInt , 
                            pai.ResidentStatus , 
                            pai.HavePersonalAllowance, 
                            pai.UkResidentStatus
                            FROM 
                                property_analyzer_inputs pai, 
                                country_master cm  
                            WHERE  
                                pai.country_id = cm.country_code 
                            and  
                                ( pai.propertyid IS NULL  or pai.propertyid ='' ) 
                                and pai.userid='".$UserId."' ".$condUnion;
		 return  \DBConn\DBConnection::getQuery($IndexQry);
    }

    public static function GetPropertiesAnayserData($country){


        $IndexQry	= "SELECT CW_Auto_id, Project_Id, Country_Id, Country_Fees_name, Country_Fees_id,
                            Ip_Glb_Client_Fee, Reservation_Deposit, Conveyancing_Fees, Landregistry_Fees,
                                Engrossment_Fees, Mortgage_Type, Mortgage_Lending_Val, Mortgage_Rate, Mortgage_Long_Term,
                                Final_Capital_Payment, Stamp_Duty, Liquid_Expatbroker_Costs, Lender_Arrangement_Fee,
                                Valuation_Fee, Furniture_Pack, Complete_Tenant_Fee, Complete_Tenantagreement_Fee,
                                Complete_Handover_Fee, Complete_Inventory_Fee, Complete_Reference_Check,
                                ClientFee_Rebate_Comp, Service_Charge, Tenant_Management_Fee,
                                Ground_Rent,vat_percentage  FROM Country_wise_fees_dtl WHERE  Country_Id='" . $country . "' " ;

		//echo $IndexQry;
       // exit();

        return \DBConn\DBConnection::getQuery( $IndexQry );
    }
    
    
    public static function Getproperty_analyzer_defaults($country){

		 $IndexQry	= " SELECT country_id, income, marketprice, duvaldynamicprice, stampduty, leaseregistration, transferfees, mortgageregistration, landtransfer, legalfees, totalpurchasecost,
		                    resetrvationfees, stagepay1per, stagepay1amt, stagepay2per, stagepay2amt, loanamountper, topup, weeklyrental, vacancyrate, lettingfeerate, managementfees, councilpropertytax,
		                    codycorporateservicechg, landleaserentpa, insurancepa, repairandmaintenance, cleaningpermonth, gardeningpermonth, servicecontractspa, other, ltv, initialloanamt, interestrate, 
		                    termyears, cpi, rentalgrowth, capitalgrowth, buildingvalue, buildinglife, fixturesvalue, fixtureslife, furniturevalue, furniturelife, OwnerOccupier, SecondHomeInvestment, 
		                    NonResidentInvestorAmt FROM property_analyzer_defaults WHERE country_id='" . $country . "'  " ;
				//echo  $IndexQry;

        return \DBConn\DBConnection::getQuery($IndexQry);
	 }
	 
    /***********************Express start */
    public static function validate($paymentID, $paymentToken, $payerID, $productID,$userId){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, PAYPAL_EXPRESS_URL.'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, PAYPAL_EXPRESS_CLIENTID.":".PAYPAL_EXPRESS_SECRATE_KEY);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
        curl_close($ch);
        
        if(empty($response)){
            return false;
        }else{
            $jsonData = json_decode($response);
            $curl = curl_init(PAYPAL_EXPRESS_URL.'payments/payment/'.$paymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            
            // Transaction data
            $result = json_decode($response);
            if($result && $result->state == 'approved'){
                $id = $result->id;
                $state = $result->state;
                $payerFirstName = $result->payer->payer_info->first_name;
                $payerLastName = $result->payer->payer_info->last_name;
                $payerName = $payerFirstName.' '.$payerLastName;
                $payerEmail = $result->payer->payer_info->email;
                $payerID = $result->payer->payer_info->payer_id;
                $payerCountryCode = $result->payer->payer_info->country_code;
                $paidAmount = $result->transactions[0]->amount->details->subtotal;
                $currency = $result->transactions[0]->amount->currency;
                $UserIdVal=$_REQUEST["UserId"];
                $queryStr = "insert into  payment  (txn_id,user_id,payer_email,product_id,payer_id,item_number,item_name,payment_amount,payment_currency,payment_status,create_at) values (:txn_id,:user_id,:payer_email,:product_id,:payer_id, :item_number,:item_name,:payment_amount,:payment_currency,:payment_status,:create_at)";
 	            $ColValarray = array("txn_id" => $id,"user_id"=>$userId,"payer_email"=>$payerEmail,"product_id"=>$productID,"payer_id"=>$payerID, "item_number" => '',"item_name"=>$payerName,"payment_amount"=>$paidAmount,"payment_currency"=>$currency,"payment_status"=>$state,"create_at"=>date("Y-m-d H:i:s"));
 		        $Queryarray	 = array($queryStr,$ColValarray);
 	    	    $ArrQueries[]= $Queryarray;
                $Msg		= \DBConn\DBConnection::pdoRunQuery($ArrQueries);
            }
            return $result;
        }
    
      }
      
      
      public static function ComparsionGraph(){
          
          
          $FinalArr='<script type="text/javascript">
               //Annual Cash Flow
               var ctx = document.getElementById("annualCashFlow");
               ctx.height = 100;
               var myChart = new Chart(ctx, {
                   type: "line",
                   data: {
                       labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"],
                       type: "line",
               
                       datasets: [{
                           label: "Property A",
                           data: [50, 2600, 4600, 4700, 5200, 5400, 6000, 6500, 7000, 7500],
                           backgroundColor: "rgba(138,155,240,0.0)",
                           borderWidth: 2,
                           borderColor: "#8a9bf0",
                           pointRadius: 0,
                       },{
                           label: "Property B",
                           data: [6000, 3600, 5600, 5000, 5600, 4800, 7000, 8000, 9000, 10000],
                           backgroundColor: "rgba(240,165,91,0.0)",
                           borderWidth: 2,
                           borderColor: "#F0A55B",
                           pointRadius: 0,
                       },{
                           label: "Property C",
                           data: [7000, 4600, 6600, 6000, 6600, 5800, 8000, 9000,10000,10500],
                           backgroundColor: "rgba(43,212,54,0.0)",
                           borderWidth: 2,
                           borderColor: "#2AD436",
                           pointRadius: 0,
                       }]
                   },
                   options: {
                       responsive: true,
                       tooltips: {
                           enabled: false,
                       },
                       legend: {
                           display: true,
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
                                   labelString: "Month"
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
                                   labelString: "Value"
                               }
                           }]
                       },
                       title: {
                           display: false,
                       }
                   }
               });
            
               //Estimate Equity
               var ctx = document.getElementById("annualReturn");
               ctx.height = 100;
               var myChart = new Chart(ctx, {
                   type: "line",
                   data: {
                       labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                       type: "line",
               
                       datasets: [{
                           label: "Property A",
                           data: [50, 26, 46, 40, 46, 38, 60],
                           backgroundColor: "rgba(138,155,240,0.0)",
                           borderWidth: 2,
                           borderColor: "#8a9bf0",
                           pointRadius: 0,
                       },{
                           label: "Property B",
                           data: [60, 36, 56, 50, 56, 48, 70],
                           backgroundColor: "rgba(240,165,91,0)",
                           borderWidth: 2,
                           borderColor: "#F0A55B",
                           pointRadius: 0,
                       },{
                           label: "Property C",
                           data: [70, 46, 66, 60, 66, 58, 80],
                           backgroundColor: "rgba(43,212,54,0)",
                           borderWidth: 2,
                           borderColor: "#2AD436",
                           pointRadius: 0,
                       }]
                   },
                   options: {
                       responsive: true,
                       tooltips: {
                           enabled: false,
                       },
                       legend: {
                           display: true,
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
                                   labelString: "Month"
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
                                   labelString: "Value"
                               }
                           }]
                       },
                       title: {
                           display: false,
                       }
                   }
               });
            
            
               // Rental Return
               var ctx = document.getElementById("estimateEquity");
               ctx.height = 100;
               var myChart = new Chart(ctx, {
                   type: "bar",
                   data: {
                       labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
                       type: "line",
               
                       datasets: [{
                           label: "Property A",
                           data: [50, 26, 46, 40, 46, 38, 60],
                           backgroundColor: "rgba(138,155,240,1)",
                           borderWidth: 2,
                           borderColor: "#8a9bf0",
                           pointRadius: 0,
                       },{
                           label: "Property B",
                           data: [60, 36, 56, 50, 56, 48, 70],
                           backgroundColor: "rgba(240,165,91,1)",
                           borderWidth: 2,
                           borderColor: "#F0A55B",
                           pointRadius: 0,
                       },{
                           label: "Property C",
                           data: [70, 46, 66, 60, 66, 58, 80],
                           backgroundColor: "rgba(43,212,54,1)",
                           borderWidth: 2,
                           borderColor: "#2AD436",
                           pointRadius: 0,
                       }]
                   },
                   options: {
                       responsive: true,
                       tooltips: {
                           enabled: false,
                       },
                       legend: {
                           display: true,
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
                                   labelString: "Month"
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
                                   labelString: "Value"
                               }
                           }]
                       },
                       title: {
                           display: false,
                       }
                   }
               });
            </script> ';

          
          
          return $FinalArr;
          
          
      }
    /******************End  */
    
      public static function PropertyDelete(){
          
          
            $autoid =   $_REQUEST["autoid"];
            $ViewCompare =   $_REQUEST["ViewCompare"] ? $_REQUEST["ViewCompare"] :"N" ;
            
            
            //echo 'autoid='.$autoid;
            
            $ArrQueries    = array();
      
             $queryStr				 = "Delete from property_analyzer_inputs where autoid  = :autoid";

			$ColValarray			= array("autoid" => $autoid) ;

			$Queryarray				= array($queryStr,$ColValarray);

			$ArrQueries[]			=	$Queryarray;
			
			$Msg		= \DBConn\DBConnection::pdoRunQuery($ArrQueries);
			
			if ($ViewCompare =='R'){
			    $Listpath =  SITE_BASE_URL."Portfolio/Portfolio.html?ViewCompare=R&IsEligible=Y&compareVal=Y";
			}else{
			    $Listpath =  SITE_BASE_URL."Portfolio/Portfolio.html";
			}
			
			//return $Listpath;

		    header('Location:' .$Listpath);
        }
    //========================================Ghouse/25-08-2020=============================
    public static function sendIcalEvent()
    {
        $from_name=$_REQUEST["from_name"];
        $from_address=$_REQUEST["from_address"];
        $to_name=$_REQUEST["to_name"];
        $to_address=$_REQUEST["to_address"];
        $startTime=$_REQUEST["startTime"];
        $endTime=$_REQUEST["endTime"];
        $subject=$_REQUEST["subject"];
        $description=$_REQUEST["description"];
        $location=$_REQUEST["location"];
        
        $domain = 'duvalknowledge.com';
    
        //Create Email Headers
        $mime_boundary = "----Meeting Booking----".MD5(TIME());
    
        $headers = "From: ".$from_name." <".$from_address.">\n";
        $headers .= "Reply-To: ".$from_name." <".$from_address.">\n";
        $headers .= "Bcc: noohuyasir@gmail.com,noormd87@gmail.com\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
        $headers .= "Content-class: urn:content-classes:calendarmessage\n";
    
        //Create Email Body (HTML)
        $message = "--$mime_boundary\r\n";
        $message .= "Content-Type: text/html; charset=UTF-8\n";
        $message .= "Content-Transfer-Encoding: 8bit\n\n";
        $message .= "<html>\n";
        $message .= "<body>\n";
        $message .= '<p>Dear '.$to_name.',</p>';
        $message .= '<p>'.$description.'</p>';
        $message .= "</body>\n";
        $message .= "</html>\n";
        $message .= "--$mime_boundary\r\n";
    
        $ical = 'BEGIN:VCALENDAR' . "\r\n" .
        'PRODID:-//Microsoft Corporation//Outlook 10.0 MIMEDIR//EN' . "\r\n" .
        'VERSION:2.0' . "\r\n" .
        'METHOD:REQUEST' . "\r\n" .
        'BEGIN:VTIMEZONE' . "\r\n" .
        'TZID:Eastern Time' . "\r\n" .
        'BEGIN:STANDARD' . "\r\n" .
        'DTSTART:20091101T020000' . "\r\n" .
        'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=11' . "\r\n" .
        'TZOFFSETFROM:-0400' . "\r\n" .
        'TZOFFSETTO:-0500' . "\r\n" .
        'TZNAME:EST' . "\r\n" .
        'END:STANDARD' . "\r\n" .
        'BEGIN:DAYLIGHT' . "\r\n" .
        'DTSTART:20090301T020000' . "\r\n" .
        'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=2SU;BYMONTH=3' . "\r\n" .
        'TZOFFSETFROM:-0500' . "\r\n" .
        'TZOFFSETTO:-0400' . "\r\n" .
        'TZNAME:EDST' . "\r\n" .
        'END:DAYLIGHT' . "\r\n" .
        'END:VTIMEZONE' . "\r\n" .  
        'BEGIN:VEVENT' . "\r\n" .
        'ORGANIZER;CN="'.$from_name.'":MAILTO:'.$from_address. "\r\n" .
        'ATTENDEE;CN="'.$to_name.'";ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_address. "\r\n" .
        'LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
        'UID:'.date("Ymd\TGis", strtotime($startTime)).rand()."@".$domain."\r\n" .
        'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
        'DTSTART;TZID="Eastern Time":'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
        'DTEND;TZID="Eastern Time":'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
        'TRANSP:OPAQUE'. "\r\n" .
        'SEQUENCE:1'. "\r\n" .
        'SUMMARY:' . $subject . "\r\n" .
        'LOCATION:' . $location . "\r\n" .
        'CLASS:PUBLIC'. "\r\n" .
        'PRIORITY:5'. "\r\n" .
        'BEGIN:VALARM' . "\r\n" .
        'TRIGGER:-PT15M' . "\r\n" .
        'ACTION:DISPLAY' . "\r\n" .
        'DESCRIPTION:Reminder' . "\r\n" .
        'END:VALARM' . "\r\n" .
        'END:VEVENT'. "\r\n" .
        'END:VCALENDAR'. "\r\n";
        $message .= 'Content-Type: text/calendar;name="meeting.ics";method=REQUEST'."\n";
        $message .= "Content-Transfer-Encoding: 8bit\n\n";
        $message .= $ical;
    
        $mailsent = mail($to_address, $subject, $message, $headers);
    
        return ($mailsent)?(true):(false);
    }
    //======================================================================================
}
