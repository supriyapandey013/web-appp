<?php
/**
 * ELITEPDO Class which extends the inbuilt PHP PDO Class
 *
 * @author Abhijit Singh
 */
require_once dirname(__FILE__).'/ALPDOStatement.php';

class ALPDO extends PDO{
    
    public function __construct($dsn, $username, $passwd, $options = array(1002 => "SET NAMES 'UTF8'")) {
        parent::__construct($dsn, $username, $passwd, $options);
        $this->setStatementClass();
    }
    /**
     * Fixes the statement class which has to be used to instantiate new prepared statements
     * @param String $className
     */
    public function setStatementClass($className = 'ALPDOStatement'){
        $this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array(
            $className,
            array($this)
        ));
    }
    /**
     * Sets timezone offset for the time related to
     * @param String $offset Timezone offset in the format similar to "+5:30"
     * @return Boolean
     */
    public function setTimezoneOffset($offset = "+3:00"){
        return $this->query("SET time_zone = ".$this->quote($offset));
    }
    /**
     *
     * @param String $timeZone One of the default timezone strings as understood by PHP
     * @param String $time Time in a PHP reconizable format in the timezone specified
     * @return Boolean
     */
    public function setTimezone($timeZone = "Asia/Riyadh", $time = "now"){
        $tz = new DateTimeZone($timeZone);
        $offset = $tz->getOffset(new DateTime($time, $tz));
        $offsetString = array();
        $offsetString[] = $offset < 0 ? "-" : "+";
        $offsetString[] = (int)(abs($offset)/3600);
        $offsetString[] = ":";
        $offsetString[] = (abs($offset)%3600)/60;
        return $this->setTimezoneOffset(implode($offsetString));
    }
    /**
     *
     * @param string $identifier the string identifier which will have sub properties defined in the connection.properties
     * @param string $file filename if it has to be something other than connection.properties
     * @return PDO object
     */
    public static function getInstance($identifier, $file = NULL){
		
		
        if(is_null($file)){
            $file = dirname(__FILE__)."/db.properties";
        }
        $properties = parse_ini_file($file);
		
		
        $connection = new static("mysql:host=".$properties[$identifier.".host"].":".$properties[$identifier.".port"].";dbname=".$properties[$identifier.".db"], $properties[$identifier.".user"], $properties[$identifier.".password"]);
        return $connection;
    }
	

}
	
$db = ALPDO::getInstance('local', NULL); 
?>