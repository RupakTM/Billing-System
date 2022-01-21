<?php 
require_once "common.class.php";
class Page extends Common{
	protected $id,$title,$slug,$image,$short_description,$description,$status,$created_by,$updated_by,$created_at,$updated_at;

	function create(){
		 $sql = "INSERT INTO tbl_pages (title,slug,short_description,description,image,status,created_by,created_at) VALUES ('$this->title','$this->slug','$this->short_description','$this->description','$this->image','$this->status','$this->created_by','$this->created_at')";
		return $this->insert($sql);
	}

	function list(){
		$sql = "SELECT p.id,p.title,p.status,p.created_by,p.created_at,u.name AS uname FROM tbl_pages AS p JOIN tbl_users as u ON p.created_by = u.id";
		return $this->select($sql);
	}

	function remove(){
		$sql = "DELETE FROM tbl_pages WHERE id = '$this->id'";
		return $this->delete($sql);
	}

	function edit(){
		if (!empty($this->image)) {
			$sql = "UPDATE tbl_pages SET title = '$this->title', slug = '$this->slug', short_description = '$this->short_description', description = '$this->description', image = '$this->image',status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		} else{
			$sql = "UPDATE tbl_pages SET title = '$this->title', slug = '$this->slug', short_description = '$this->short_description', description = '$this->description', status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		}
		
		return $this->update($sql);
	}

	function getPagesById(){
		$sql = "SELECT p.*,u.name AS uname FROM tbl_pages AS p JOIN tbl_users AS u ON p.created_by = u.id WHERE p.id='$this->id'";
		return $this->select($sql);
	}

	function changeStatus(){
		$sql = "UPDATE tbl_pages SET status = '$this->status' WHERE id = '$this->id'";
		return $this->update($sql);
	}

	function getCurrentMonthNewsCount(){
		$sql = "SELECT count(*) AS news_count FROM tbl_news WHERE created_at > date_sub(now(),interval 1 month);";
		return $this->select($sql);
	}

	function getSiteTerms(){
		$sql = "SELECT description FROM tbl_pages WHERE status=1 AND title='site terms'";
		return $this->select($sql);
	}

	function getPrivacyPolicy(){
		$sql = "SELECT description FROM tbl_pages WHERE status=1 AND title='privacy policy'";
		return $this->select($sql);
	}

	function getCookiesPolicy(){
		$sql = "SELECT description FROM tbl_pages WHERE status=1 AND title='cookies'";
		return $this->select($sql);
	}

	function getContact(){
		$sql = "SELECT description FROM tbl_pages WHERE status=1 AND title='contact'";
		return $this->select($sql);
	}

	function getAdvertisement(){
		$sql = "SELECT description FROM tbl_pages WHERE status=1 AND title='advertisement'";
		return $this->select($sql);
	}

}


?>