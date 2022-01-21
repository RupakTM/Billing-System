<?php 
require_once "common.class.php";
class News extends Common{
	protected $id,$category_id,$author_id,$title,$slug,$feature_image,$short_description,$description,$feature_key,$breaking_key,$slider_key,$trending_key,$status,$view_count,$created_by,$updated_by,$created_at,$updated_at;

	function create(){
		 $sql = "INSERT INTO tbl_news (category_id,author_id,title,slug,short_description,description,feature_image,feature_key,breaking_key,slider_key,trending_key,status,created_by,created_at) VALUES ('$this->category_id','$this->author_id','$this->title','$this->slug','$this->short_description','$this->description','$this->feature_image','$this->feature_key','$this->breaking_key','$this->slider_key','$this->breaking_key','$this->status','$this->created_by','$this->created_at')";
		return $this->insert($sql);
	}

	function list(){
		$sql = "SELECT n.id,n.category_id,n.title,n.status,n.created_by,n.created_at,u.name AS uname,c.name AS cname FROM tbl_news AS n JOIN tbl_users as u ON n.created_by = u.id JOIN tbl_categories as c ON n.category_id = c.id";
		return $this->select($sql);
	}

	function remove(){
		$sql = "DELETE FROM tbl_news WHERE id = '$this->id'";
		return $this->delete($sql);
	}

	function edit(){
		if (!empty($this->feature_image)) {
			$sql = "UPDATE tbl_news SET category_id = '$this->category_id', title = '$this->title', slug = '$this->slug', short_description = '$this->short_description', description = '$this->description', feature_image = '$this->feature_image', feature_key = '$this->feature_key', breaking_key = '$this->breaking_key', slider_key = '$this->slider_key', status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		} else{
			$sql = "UPDATE tbl_news SET category_id = '$this->category_id', title = '$this->title', slug = '$this->slug', short_description = '$this->short_description', description = '$this->description', feature_key = '$this->feature_key', breaking_key = '$this->breaking_key', slider_key = '$this->slider_key', status = '$this->status', updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		}
		
		return $this->update($sql);
	}

	function getNewsById(){
		$sql = "SELECT n.*,u.name AS uname,c.name AS cname FROM tbl_news AS n JOIN tbl_users AS u ON n.created_by = u.id JOIN tbl_categories AS c ON n.category_id = c.id WHERE n.id='$this->id'";
		return $this->select($sql);
	}

	function changeStatus(){
		$sql = "UPDATE tbl_news SET status = '$this->status' WHERE id = '$this->id'";
		return $this->update($sql);
	}

	function getCurrentMonthNewsCount(){
		$sql = "SELECT count(*) AS news_count FROM tbl_news WHERE created_at > date_sub(now(),interval 1 month);";
		return $this->select($sql);
	}

	function getTrendingNews(){
		$sql = "SELECT category_id,id,title,slug FROM tbl_news WHERE status=1 AND trending_key=1 ORDER BY created_at DESC";
		return $this->select($sql);
	}

	function getSliderForNews(){
		$sql = "SELECT c.name,n.category_id,n.id,n.title,n.slug,n.feature_image,n.short_description,n.created_at FROM tbl_news AS n JOIN tbl_categories AS c ON n.category_id = c.id WHERE n.status=1 AND n.slider_key=1 ORDER BY n.created_at DESC";
		return $this->select($sql);
	}

	function getFeatureNewsByCategoryId(){
		$sql = "SELECT c.name,n.category_id,n.id,n.title,n.slug,n.feature_image,n.short_description,n.created_at,u.name AS uname FROM tbl_news AS n JOIN tbl_categories AS c ON n.category_id = c.id JOIN tbl_users AS u ON n.created_by = u.id WHERE n.status=1 AND n.feature_key=1 AND n.category_id= $this->category_id ORDER BY n.created_at DESC LIMIT 5";
		return $this->select($sql);
	}

	function getLatestNews(){
		$sql = "SELECT c.name,n.category_id,n.id,n.title,n.slug,n.feature_image,n.short_description,n.created_at,u.name AS uname FROM tbl_news AS n JOIN tbl_categories AS c ON n.category_id = c.id JOIN tbl_users AS u ON n.created_by = u.id WHERE n.status=1 AND n.feature_key=1 ORDER BY n.created_at DESC LIMIT 8";
		return $this->select($sql);
	}

	function getNewsForList(){
		$sql = "SELECT c.name,n.category_id,n.id,n.title,n.slug,n.feature_image,n.short_description,n.created_at,u.name AS uname FROM tbl_news AS n JOIN tbl_categories AS c ON n.category_id = c.id JOIN tbl_users AS u ON n.created_by = u.id WHERE n.status=1 AND n.category_id= $this->category_id ORDER BY n.created_at DESC LIMIT 4";
		return $this->select($sql);
	}

	function getNewsForHotCategory(){
		$sql = "SELECT c.name,c.id AS cid,n.category_id,n.id FROM tbl_news AS n JOIN tbl_categories AS c ON n.category_id = c.id WHERE n.status=1 AND n.category_id= $this->category_id";
		return $this->select($sql);
	}

	function getTrendingNewsForFooter(){
		$sql = "SELECT category_id,id,title,feature_image,created_at FROM tbl_news WHERE status=1 AND trending_key = 1 LIMIT 3";
		return $this->select($sql);
	}

	function getImageForGallery(){
		$sql = "SELECT category_id,id,feature_image FROM tbl_news WHERE status=1 AND trending_key=1 LIMIT 12";
		return $this->select($sql);
	}

	function getNewsByCategoryId($limit,$offset){
		$sql = "SELECT c.name,n.category_id,n.id,n.title,n.slug,n.feature_image,n.short_description,n.created_at,u.name AS uname FROM tbl_news AS n JOIN tbl_categories AS c ON n.category_id = c.id JOIN tbl_users AS u ON n.created_by = u.id WHERE n.status=1 AND n.category_id= $this->category_id ORDER BY n.created_at DESC LIMIT $limit offset $offset";
		return $this->select($sql);
	}

	function getNewsCountByCategoryId(){
		$sql = "SELECT count(*) AS news_count FROM tbl_news WHERE status=1 AND category_id= $this->category_id ";
		return $this->select($sql);
	}

	function updateViewCount(){
		$sql = "UPDATE tbl_news SET view_count = $this->view_count WHERE id = $this->id";
		return $this->update($sql);
	}

	function getRelatedNews(){
		$sql = "SELECT c.name,n.category_id,n.id,n.title,n.slug,n.feature_image,n.short_description,n.created_at,u.name AS uname FROM tbl_news AS n JOIN tbl_categories AS c ON n.category_id = c.id JOIN tbl_users AS u ON n.created_by = u.id WHERE n.status=1 AND n.category_id= $this->category_id ORDER BY n.created_at DESC";
		return $this->select($sql);
	}

	function getNewsForMoreNews(){
		$sql = "SELECT c.name,n.category_id,n.id,n.title,n.feature_image,n.short_description,n.created_at,u.name AS uname FROM tbl_news AS n JOIN tbl_categories AS c ON n.category_id = c.id JOIN tbl_users AS u ON n.created_by = u.id WHERE n.status=1 ORDER BY n.created_at DESC LIMIT 6";
		return $this->select($sql);
	}

	function getPopularNews(){
		$sql = "SELECT c.name,n.category_id,n.id,n.title,n.feature_image,n.short_description,n.view_count,n.created_at FROM tbl_news AS n JOIN tbl_categories AS c ON n.category_id = c.id WHERE n.status=1 ORDER BY n.view_count DESC LIMIT 5";
		return $this->select($sql);
	}

	function getTrendingNewsForSidebar(){
		$sql = "SELECT * FROM tbl_news WHERE status=1 AND trending_key=1 ORDER BY created_at DESC LIMIT 4";
		return $this->select($sql);
	}

	function getAuthorByNewsId(){
		$sql = "SELECT a.id,a.name,a.photo,a.bio,a.facebook,a.twitter,a.instagram,n.id FROM tbl_news AS n JOIN tbl_authors AS a ON n.author_id = a.id WHERE n.id = $this->id";
		return $this->select($sql);
	}

}


?>