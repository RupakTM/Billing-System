<?php 

require_once "common.class.php";
class Role extends Common{
	protected $id,$name,$status;

	function create(){
		// print_r($this);
		$sql = "INSERT INTO tbl_roles (name,status) VALUES ('$this->name','$this->status')";
		return $this->insert($sql);
	}

	function list(){
		$sql = "SELECT * FROM tbl_roles";
		return $this->select($sql);
	}

	function remove(){
		$sql = "DELETE FROM tbl_roles WHERE id = '$this->id'";
		return $this->delete($sql);
	}

	function edit(){
		$sql = "UPDATE tbl_roles SET name = '$this->name', status = '$this->status' WHERE id = '$this->id'";
		return $this->update($sql);
	}

	function getRoleById(){
		$sql = "SELECT * from tbl_roles WHERE id = '$this->id'";
		return $this->select($sql);
	}

	

}

?>