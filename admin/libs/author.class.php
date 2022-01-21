<?php 
require_once "common.class.php";
class Author extends Common{
	protected $id,$name,$photo,$phone,$address,$bio,$facebook,$twitter,$instagram,$status,$created_by,$updated_by,$created_at,$updated_at;

	function create(){
		$sql = "INSERT INTO tbl_authors (name,photo,phone,address,bio,facebook,twitter,instagram,status,created_by,created_at) VALUES ('$this->name','$this->photo','$this->phone','$this->address','$this->bio','$this->facebook','$this->twitter','$this->instagram','$this->status','$this->created_by','$this->created_at')";
		return $this->insert($sql);
	}

	function list(){
		$sql = "SELECT a.id,a.name,a.phone,a.bio,a.status,a.created_by,a.created_at,u.name as uname FROM tbl_authors AS a JOIN tbl_users as u ON a.created_by = u.id";
		return $this->select($sql);
	}

	function remove(){
		$sql = "DELETE FROM tbl_authors WHERE id = '$this->id'";
		return $this->delete($sql);
	}

	function edit(){
		if (!empty($this->photo)){
			$sql = "UPDATE tbl_authors SET name = '$this->name', photo = '$this->photo', phone = '$this->phone', address = '$this->address', bio = '$this->bio', facebook = '$this->facebook', twitter = '$this->twitter', instagram = '$this->instagram', status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		} else {
			$sql = "UPDATE tbl_authors SET name = '$this->name',phone = '$this->phone', address = '$this->address', bio = '$this->bio', facebook = '$this->facebook', twitter = '$this->twitter', instagram = '$this->instagram', status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		}
		return $this-> update($sql);
	}

	function getAuthorById(){
		$sql = "SELECT a.*,u.name as uname FROM tbl_authors AS a JOIN tbl_users as u ON a.created_by = u.id WHERE a.id='$this->id'";
		return $this->select($sql);
	}

	function getAuthorNameAndId(){
		$sql = "SELECT id,name FROM tbl_authors WHERE status=1 ORDER BY name ASC";
		return $this->select($sql);
	}

	function changeStatus(){
		$sql = "UPDATE tbl_authors SET status = '$this->status' WHERE id = '$this->id'";
		return $this->update($sql);
	}

	function getCategoryCount(){
		$sql = "SELECT count(*) AS category_count FROM tbl_categories";
		return $this->select($sql);
	}

	function getCategoryForMenu(){
		$sql = "SELECT id,name,slug FROM tbl_categories WHERE status=1 ORDER BY rank";
		return $this->select($sql);
	}
	
	function getCategoryForFeatureNews(){
		$sql = "SELECT id,name FROM tbl_categories WHERE status=1 ORDER BY rank";
		return $this->select($sql);
	}

	function getCategoryForNewsList(){
		$sql = "SELECT id,name FROM tbl_categories WHERE status=1 ORDER BY rank";
		return $this->select($sql);
	}
	
	function getCategoryForHotCategories(){
		$sql = "SELECT id,name FROM tbl_categories WHERE status=1";
		return $this->select($sql);
	}

}


?>