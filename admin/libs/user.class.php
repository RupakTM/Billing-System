<?php 
require_once "common.class.php";
class User extends Common{
	protected $id,$name,$email,$username,$password,$last_login,$image,$status,$role_id;

	public function login(){
		$this->connect();
		$sql = "SELECT u.*,r.name AS rname FROM tbl_users AS u JOIN tbl_roles AS r ON u.id = r.id WHERE u.email = '$this->email' and u.password = '$this->password' and u.status = 1";
		$result = $this->connection->query($sql); 
		// print_r($result);
		if($result->num_rows == 1){
			$data = $result->fetch_object();
			session_start();
			$_SESSION['id'] = $data->id;
			$_SESSION['name'] = $data->name;
			$_SESSION['email'] = $data->email;
			$_SESSION['image'] = $data->image;
			$_SESSION['role_id'] = $data->role_id;
			$_SESSION['role_name'] = $data->rname;

			if (isset($_POST['remember'])) {
				setcookie('id',$data->id,time()+60*60);
				setcookie('name',$data->name,time()+60*60);
				setcookie('email',$data->email,time()+60*60);
				setcookie('image',$data->image,time()+60*60);
				setcookie('role_id',$data->role_id,time()+60*60);
				setcookie('role_name',$data->rname,time()+60*60);
			}
			header('location:dashboard.php');
			
		} else{
			return false;
		}
	}

	public function fetchRole(){
		$sql = "SELECT * FROM tbl_roles";
		return $this->fetch($sql);
	}
	
	function create(){
		$sql = "INSERT INTO tbl_users (name,username,email,password,image,status,role_id) VALUES ('$this->name','$this->username','$this->email','$this->password','$this->image','$this->status','$this->role')";
		return $this->insert($sql);
	}

	function remove(){
		$sql = "DELETE FROM tbl_users WHERE id = '$this->id'";
		return $this->delete($sql);
	}

	function edit(){
		if (!empty($this->image)){
			$sql = "UPDATE tbl_users SET name = '$this->name', username = '$this->username', email = '$this->email', password = '$this->password', image = '$this->image', status = '$this->status', role_id = '$this->role' WHERE id = '$this->id'";
		} else {
			$sql = "UPDATE tbl_users SET name = '$this->name', username = '$this->username', email = '$this->email', password = '$this->password',status = '$this->status', role_id = '$this->role' WHERE id = '$this->id'";
		}
		return $this-> update($sql);
	}

	function list(){
		$sql = "SELECT u.id,u.name,u.email,u.username,u.password,u.status,u.role_id,r.name as rname FROM tbl_users AS u JOIN tbl_roles AS r ON u.role_id = r.id";
		return $this->select($sql);
	}

	function getUserById(){
		$sql = "SELECT u.*, r.name AS rname FROM tbl_users AS u JOIN tbl_roles AS r ON u.role_id = r.id WHERE u.id='$this->id'";
		return $this->select($sql);
	}

	function getUserCount(){
		$sql = "SELECT count(*) AS user_count FROM tbl_users";
		return $this->select($sql);
	}


}


?>