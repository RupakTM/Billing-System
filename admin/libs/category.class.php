<?php 
require_once "common.class.php";
class Category extends Common{
	protected $id,$name,$slug,$rank,$status,$created_by,$updated_by,$created_at,$updated_at;

	function create(){
		$sql = "INSERT INTO tbl_categories (name,slug,rank,status,created_by,created_at) VALUES ('$this->name','$this->slug','$this->rank','$this->status','$this->created_by','$this->created_at')";
		return $this->insert($sql);
	}

	function list(){
		$sql = "SELECT c.id,c.name,c.rank,c.status,c.created_by,c.created_at,u.name as uname FROM tbl_categories AS c JOIN tbl_users as u ON c.created_by = u.id";
		return $this->select($sql);
	}

	function remove(){
		$sql = "DELETE FROM tbl_categories WHERE id = '$this->id'";
		return $this->delete($sql);
	}

	function edit(){
		$sql = "UPDATE tbl_categories SET name = '$this->name', slug = '$this->slug', rank = '$this->rank', status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		return $this->update($sql);
	}

	function getCategoryById(){
		$sql = "SELECT c.*,u.name as uname FROM tbl_categories AS c JOIN tbl_users as u ON c.created_by = u.id WHERE c.id='$this->id'";
		return $this->select($sql);
	}

	function getCategoryNameAndId(){
		$sql = "SELECT id,name FROM tbl_categories WHERE status=1 ORDER BY name ASC";
		return $this->select($sql);
	}

	function changeStatus(){
		$sql = "UPDATE tbl_categories SET status = '$this->status' WHERE id = '$this->id'";
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
		$sql = "SELECT id,name FROM tbl_categories WHERE status=1 ";
		return $this->select($sql);
	}
	
	function getCategoryForHotCategories(){
		$sql = "SELECT id,name FROM tbl_categories WHERE status=1";
		return $this->select($sql);
	}

}


?>