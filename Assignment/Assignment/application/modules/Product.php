<?php
// error_reporting(1);
//   ini_set('display_errors', 1);
//   ini_set('display_startup_errors', 1);
//   error_reporting(E_ALL); 
class Product
{
	
	private $id='0';
	private $price='0';

	function __construct()
	{
		$this->db = ALPDO::getInstance('local', NULL); 
	}
	
	public  function setValues($row){
	     
		if(!empty($row['id'])){
			$this->id=$row['id'];
		}
		
		 if(!empty($row['title'])){
			$this->title=addslashes(trim($row['title']));
		} 
		if(!empty($row['price'])){
		   $this->price=$row['price'];
	   } 

		if(!empty($row['description'])){
			$this->description=$row['description'];
		}
		if(!empty($row['type_id'])){
			$this->type_id=$row['type_id'];
		}
		$this->action=$row['action'];

	}
	function setId($id){
		$this->id=$id;
	}
	
	function setOffset($offset){
		$this->offset=$offset;
	}
	function setRecordsPerPage($record_per_page){
		$this->record_per_page=$record_per_page;
	}
	public function fetchDetails(){
		if($this->action=='insert'){
			 return $this->insert();
		}
		if($this->action=='delete'){
			return $this->delete();
	   }
	}
public function insert()
{
	
try{
	


$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["cover"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file);
 $this->cover=$target_file;

	$sql="insert into product(title,description,price,type_id,cover) 
	values(:title,:description,:price,:type_id,:cover)";
	$this->db->prepare($sql)->doInsert(array(':title'=>$this->title,':description'=>$this->description,
	':price'=>$this->price,':type_id'=>$this->type_id,':cover'=>$this->cover));
	echo $this->id=$this->db->lastInsertId();

		} 
	 catch(Exception $e){
				  //echo $e->getMessage();
			return;
	}
}

public function getAllData()
{
	 $sql="select  p.*,t.title as ttile
                from product p LEFT JOIN type t On t.id=p.type_id
                where p.status =1 order by p.id desc  LIMIT $this->offset,$this->record_per_page";;
				$result=$this->db->prepare($sql)->getResults(array());
				return $result;
}
public function delete()
   {

try{
        $sql="UPDATE product set status='3' where id in ($this->id)";
       $this->db->prepare($sql)->doUpdate(array());
       echo 1;
       } 
	 catch(Exception $e){
				  //echo $e->getMessage();
			return;
	}
   }

}
$ajaxObj= new Product();
$ajaxObj->setValues($_POST);
echo $result=$ajaxObj->fetchDetails();