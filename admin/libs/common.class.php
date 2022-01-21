<?php 

abstract class Common {
	protected $connection;
	function get($var){
		return $this->$var;
	}
	function set($var,$value){
		$this->$var = $value;
	}
	function connect(){
		$this->connection = new mysqli('localhost','root','','db_project');
		if ($this->connection->connect_errno!=0) {
			die('Database Connection Error'.$this->connection->connect_err);
		}
	}

	abstract function create();
	abstract function remove();
	abstract function edit();
	abstract function list();

	function insert($query){
		$this->connect();
		$this->connection->query($query);
		if ($this->connection->affected_rows == 1 && $this->connection->insert_id >0) {
			return true;
		} else{
			return $this->connection->error;
		}
	}

	function select($query){
		$this->connect();
		$result = $this->connection->query($query);
		$data = [];
		if($result->num_rows > 0){
			while ($d = $result->fetch_object()) {
				array_push($data, $d);
			}
		}
		return $data;
	}

	function fetch($query){
		$this->connect();
		$result = $this->connection->query($query);
		$data = [];
		if($result->num_rows > 0){
			while ($d = $result->fetch_object()) {
				array_push($data, $d);
			}
		}
		return $data;
	}

	function delete($query){
		$this->connect();
		$this->connection->query($query);
		if ($this->connection->affected_rows == 1) {
			return true;
		} else{
			return $this->connection->error;
		}
	} 

	function update($query){
		$this->connect();
		$this->connection->query($query);
		if ($this->connection->affected_rows == 1) {
			return true;
		} else{
			return $this->connection->error;
		}
	}

}

?>