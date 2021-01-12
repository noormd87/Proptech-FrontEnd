<?php
/*
 * Class DBConnection
 * Create a database connection using PDO
 * @author jonahlyn@unm.edu
 *
 * Instructions for use:
 *
 * require_once('settings.config.php');          // Define db configuration arrays here
 * require_once('DBConnection.php');             // Include this file
 *
 * $database = new DBConnection($dbconfig);      // Create new connection by passing in your configuration array
 *
 * $sqlSelect = "select * from .....";           // Select Statements:
 * $rows = $database->getQuery($sqlSelect);      // Use this method to run select statements
 *
 * foreach($rows as $row){
 * 		echo $row["column"] . "<br/>";
 * }
 *
 * $sqlInsert = "insert into ....";              // Insert/Update/Delete Statements:
 * $count = $database->runQuery($sqlInsert);     // Use this method to run inserts/updates/deletes
 * echo "number of records inserted: " . $count;
 *
 * $name = "jonahlyn";                          // Prepared Statements:
 * $stmt = $database->dbc->prepare("insert into test (name) values (?)");
 * $stmt->execute(array($name));
 *
 */

namespace DBConn; 

use \settings\config; 

Class DBConnection {
    // Database Connection Configuration Parameters
    // array('driver' => 'mysql','host' => '','dbname' => '','username' => '','password' => '')
    protected static $_config;
    // Database Connection
    public static $dbc;
    
    private static $Result, $sth;
	public static $LastId; 
    
    /* function __construct
     * Opens the database connection
     * @param $config is an array of database connection parameters
     */
    public function __construct() {
        self::init(); 
    }
    
    /* Function __destruct
     * Closes the database connection
     */
    public function __destruct() {
	self::conn_colse();
    }
    
    public static function init(){
        global $localhost; 
        self::$_config      = $localhost;
		self::$LastId		= ""; 

        self::getPDOConnection();
    }
    
    public static function conn_colse(){
        self::$dbc = NULL;
    }
    
    
    /* Function getPDOConnection
     * Get a connection to the database using PDO.
     */
    private static function getPDOConnection() {
        // Check if the connection is already established
        if (self::$dbc == NULL) {
            // Create the connection
            $dsn = "" .
                self::$_config['driver'] .
                ":host=" . self::$_config['host'] .
                ";dbname=" . self::$_config['dbname'];
            try {
                self::$dbc = new \PDO( $dsn, self::$_config[ 'username' ], self::$_config[ 'password' ], 
									   array (\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION) 
									 );
				
				//$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
				//self::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
            } catch( \PDOException $e ) {
                echo __LINE__.$e->getMessage();
            }
        }
    }
    
    /* Function runQuery
     * Runs a insert, update or delete query
     * @param string sql insert update or delete statement
     * @return int count of records affected by running the sql statement.
     */
    public function runQuery( $sqlArray = array(), $GetLastInsertId = false ) {
        self::init();
        self::$dbc->beginTransaction(); // also helps speed up your inserts.
        //$insert_values = array();
        
        /*foreach($data as $d){
            $question_marks[] = '('  . placeholders('?', sizeof($d)) . ')';
            $insert_values = array_merge($insert_values, array_values($d));
        }*/
        
        $error_msg = ""; 
        
        foreach ($sqlArray as $sql){
            //$stmt = self::$dbc->prepare ($sql);
            try {
                self::$dbc->exec($sql);
            } 
            catch (\PDOException $e){
                //echo $sql . "<BR><BR>"; 
                $error_msg = $e->getMessage();
		break; 
            }
        }
        
        if ($error_msg == ""){
            if ($GetLastInsertId){
                self::$LastId = self::$dbc->lastInsertId(); 
            }

            self::$dbc->commit();

            return "success"; 
        }
        else{
            self::$dbc->rollBack();
            //ECHO $error_msg;
            return $error_msg; 
        }

        /*try {
            $count = $this->dbc->exec($sql) or print_r($this->dbc->errorInfo());
        } 
        catch(\PDOException $e) {
            echo __LINE__.$e->getMessage();
        }
        return $count;
         */
    }
    /* Function getQuery
     * Runs a select query
     * @param string sql insert update or delete statement
     * @returns associative array
     */
    public static function getQuery( $sql ) {
        try{
            self::init();
            
            self::$Result      = self::$dbc->query( $sql );
            self::$Result->setFetchMode(\PDO::FETCH_ASSOC);
            
            self::conn_colse(); 
            return self::$Result;
        }
        catch(\PDOException $ex){
            echo $ex->getMessage(); 
        }
    }
    
    public static function exe_me($sql)
    {
        try{
            self::init();
            
            self::$sth      = self::$dbc->prepare( $sql );
            return self::$sth->execute();
            
            self::conn_colse(); 
            
        }
        catch(\PDOException $ex){
            echo $ex->getMessage(); 
        }
    }
    
    public static function getQueryFetchAll( $sql ) {
        try{
            self::init();
            
            self::$sth      = self::$dbc->prepare( $sql );
            self::$sth->execute();
            
            self::$Result = self::$sth->fetchAll();
            
            
            self::conn_colse(); 
            return self::$Result;
        }
        catch(\PDOException $ex){
            echo $ex->getMessage(); 
        }
    }
    
    public static function getQueryFetchColumn( $sql ) {
        try{
            self::init();
            
            self::$sth      = self::$dbc->prepare( $sql );
            self::$sth->execute();
            
            self::$Result = self::$sth->fetchAll(\PDO::FETCH_COLUMN, 0);
            
            self::conn_colse(); 
            return self::$Result;
        }
        catch(\PDOException $ex){
            echo $ex->getMessage(); 
        }
    }
    public function getQueryFetchRow( $sql ) {
        try{
            self::init();
            
            self::$sth      = self::$dbc->prepare( $sql );
            self::$sth->execute();
            
            self::$Result = self::$sth->fetch();
            
            self::conn_colse(); 
            return self::$Result;
        }
        catch(\PDOException $ex){
            echo $ex->getMessage(); 
        }
    }

	/*==========================PDO insertion=======================*/

	public static function pdoRunQuery( $sqlArray = array(), $GetLastInsertId = false ) {
        self::init();
        self::$dbc->beginTransaction(); 
        $error_msg = ""; 
        foreach ($sqlArray as $sql){
            try {
                $Query  = $sql[0];
				$data	= $sql[1];
				if(empty($data)) {
					throw new InvalidArgumentException('Cannot insert an empty array.');
				}
				if(!is_string($Query)) {
					throw new InvalidArgumentException('Table name must be a string.');
				}
				$fields =  implode(', ', array_keys($data)) ;
				$placeholders = ':' . implode(', :', array_keys($data));

				$sql = $Query;
				$stmt = \DBConn\DBConnection::$dbc->prepare ($sql);
				foreach($data as $placeholder => &$value) {

					$placeholder = ':' . $placeholder;
					$stmt->bindParam($placeholder, $value);
				}

				if($stmt->execute())
				{
					//echo "<div class='alert alert-success'>Record was saved.</div>";
				}else{
					//echo "<div class='alert alert-danger'>Unable to save record.</div>";
				}
            } 
            catch (\PDOException $e){
                //echo $sql . "<BR><BR>"; 
                $error_msg = $e->getMessage();
		break; 
            }
        }
        
        if ($error_msg == ""){
            if ($GetLastInsertId){
                self::$LastId = self::$dbc->lastInsertId(); 
            }

            self::$dbc->commit();

            return "success"; 
        }
        else{
            self::$dbc->rollBack();
            //ECHO $error_msg;
            return $error_msg; 
        }
    }
	/*==============================================================*/
}

