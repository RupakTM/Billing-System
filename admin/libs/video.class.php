<?php 
require_once "common.class.php";
class Video extends Common{
	protected $id,$title,$video_link,$description,$thumnnail,$status,$created_by,$updated_by,$created_at,$updated_at;

	function create(){
		$sql = "INSERT INTO tbl_videos (title,video_link,description,thumbnail,status,created_by,created_at) VALUES ('$this->title','$this->video_link','$this->description','$this->thumbnail','$this->status','$this->created_by','$this->created_at')";
		return $this->insert($sql);
	}

	function list(){
		$sql = "SELECT v.id,v.title,v.video_link,v.status,v.created_by,v.created_at,u.name AS uname FROM tbl_videos AS v JOIN tbl_users AS u ON v.created_by = u.id";
		return $this->select($sql);
	}

	function remove(){
		$sql = "DELETE FROM tbl_videos WHERE id = '$this->id'";
		return $this->delete($sql);
	}

	function edit(){
		if (!empty($this->thumbnail)){
			$sql = "UPDATE tbl_videos SET title = '$this->title',video_link = '$this->video_link', description = '$this->description', thumbnail = '$this->thumbnail', status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		} else {
			$sql = "UPDATE tbl_videos SET title = '$this->title',video_link = '$this->video_link', description = '$this->description', status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		}
		return $this-> update($sql);
	}

	function getVideoById(){
		$sql = "SELECT v.*,u.name as uname FROM tbl_videos AS v JOIN tbl_users as u ON v.created_by = u.id WHERE v.id='$this->id'";
		return $this->select($sql);
	}

	function changeStatus(){
		$sql = "UPDATE tbl_videos SET status = '$this->status' WHERE id = '$this->id'";
		return $this->update($sql);
	}


	function getVideoList(){
		$sql = "SELECT * FROM tbl_videos WHERE status=1 ORDER BY created_at DESC LIMIT 3";
		return $this->select($sql);
	}

	

}


?>