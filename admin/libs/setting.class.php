<?php 
require_once "common.class.php";
class Setting extends Common{
	protected $id,$name,$address,$pan,$reg_no,$listing_limit,$facebook,$youtube,$twitter,$gmail,$skype,$logo,$fav_icon,$created_by,$updated_by,$created_at,$updated_at;

	function create(){
		
	}

	function list(){
		$sql = "SELECT* FROM tbl_settings";
		return $this->select($sql);
	}

	function remove(){
		
	}

	function edit(){
		if (!empty($this->logo) && !empty($this->fav_icon)){
			$sql = "UPDATE tbl_settings SET name = '$this->name', address = '$this->address', pan = '$this->pan', reg_no = '$this->reg_no', listing_limit = '$this->listing_limit', facebook = '$this->facebook', youtube = '$this->youtube', twitter = '$this->twitter', gmail = '$this->gmail', skype = '$this->skype', logo = '$this->logo', fav_icon = '$this->fav_icon',updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		} else if(!empty($this->logo)){
			$sql = "UPDATE tbl_settings SET name = '$this->name', address = '$this->address', pan = '$this->pan', reg_no = '$this->reg_no', listing_limit = '$this->listing_limit', facebook = '$this->facebook', youtube = '$this->youtube', twitter = '$this->twitter', gmail = '$this->gmail', skype = '$this->skype', logo = '$this->logo',updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		} else if(!empty($this->fav_icon)){
			$sql = "UPDATE tbl_settings SET name = '$this->name', address = '$this->address', pan = '$this->pan', reg_no = '$this->reg_no', listing_limit = '$this->listing_limit', facebook = '$this->facebook', youtube = '$this->youtube', twitter = '$this->twitter', gmail = '$this->gmail', skype = '$this->skype', fav_icon = '$this->fav_icon',updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		}
		else {
			 $sql = "UPDATE tbl_settings SET name = '$this->name', address = '$this->address', pan = '$this->pan', reg_no = '$this->reg_no', listing_limit = '$this->listing_limit', facebook = '$this->facebook', youtube = '$this->youtube', twitter = '$this->twitter', gmail = '$this->gmail', skype = '$this->skype',updated_at = '$this->updated_at', updated_by = '$this->updated_by' WHERE id = '$this->id'";
		}
		return $this-> update($sql);

	}
}


?>