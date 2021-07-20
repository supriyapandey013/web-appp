<?php
/**
 * ALPDOStatement Class which extends the inbuilt PHP PDO Statement Class
 *
 * @author Abhijit Singh
 */
class ALPDOStatement extends PDOStatement{
    
    public $pdo;
    //this blank constructor is needed or else things will start to fall apart
    protected function __construct($pdo) {
        $this->pdo = $pdo;
    }
    /**
     * Returns the associative result array set of a Select query
     * @param Array $params Parameters expected by the prepared statement
     * @return Array Returns a multidimentional array of the result.
     */
    public function getResults($params = NULL){
        $this->execute($params);
        return $this->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Fetch maximum of 1 row for a select query
     * @param <type> Parameters expected by the prepared statement
     * @return Array Single row or null depending on the result size
     */
    public function getResult($params = NULL){
        $rows = $this->getResults($params);
        return sizeof($rows) > 0 ? $rows[0] : NULL;
    }
    public function doInsert($params = NULL){
        return $this->execute($params);
    }
    public function doUpdate($params = NULL){
         $this->execute($params);
		return $this->rowCount();
    }
    public function doDelete($params=NULL){
        return $this->execute($params);   
    }
    /**
     * Overwites the default execute function to have some Exception throwing.
     * @param Array $params Parameters expected by the prepared statement
     * @return Boolean
     */
    public function execute($params = NULL) {        
        $result = parent::execute($params);        
        if(!$result){
            $errors = $this->errorInfo();
            throw new PDOException($errors[2],$errors[1]);
        }
        return $result;
    }
}
?>