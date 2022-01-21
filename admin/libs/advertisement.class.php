<?php 
require_once "common.class.php";
class Advertisement extends Common{
	protected $id,$title,$image,$expire_date,$link,$status,$created_by,$updated_by,$created_at,$updated_at;

	function create(){
		$sql = "INSERT INTO tbl_advertisements (title,image,expire_date,link,status,created_by,created_at) VALUES ('$this->title','$this->image','$this->expire_date','$this->link','$this->status','$this->created_by','$this->created_at')";
		return $this->insert($sql);
	}

	function list(){
		$sql = "SELECT a.id,a.title,a.expire_date,a.link,a.status,a.created_by,a.created_at,u.name as uname FROM tbl_advertisements AS a JOIN tbl_users as u ON a.created_by = u.id";
		return $this->select($sql);
	}

	function remove(){
		$sql = "DELETE FROM tbl_advertisements WHERE id = '$this->id'";
		return $this->delete($sql);
	}

	function edit(){
		if (!empty($this->image)){
			$sql = "UPDATE tbl_advertisements SET title = '$this->title',image = '$this->image', expire_date = '$this->expire_date', link = '$this->link', status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		} else {
			 $sql = "UPDATE tbl_advertisements SET title = '$this->title', expire_date = '$this->expire_date', link = '$this->link', status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		}
		return $this-> update($sql);
	}

	function getAdvertisementById(){
		$sql = "SELECT a.*,u.name as uname FROM tbl_advertisements AS a JOIN tbl_users as u ON a.created_by = u.id WHERE a.id='$this->id'";
		return $this->select($sql);
	}

	function getAdvertisementNameAndId(){
		$sql = "SELECT id,name FROM tbl_categories WHERE status=1 ORDER BY name ASC";
		return $this->select($sql);
	}

	function changeStatus(){
		$sql = "UPDATE tbl_advertisements SET status = '$this->status' WHERE id = '$this->id'";
		return $this->update($sql);
	}

	function getAdvertisement(){
		$validDate = date('Y-m-d H:i:s');
		$sql = "SELECT * FROM tbl_advertisements WHERE status=1 AND expire_date >= '$validDate' ORDER BY created_at DESC";
		return $this->select($sql);
	}

	

}


?>