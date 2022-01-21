<?php 

function checkLoginStatus(){
	session_start(); 
	if(!isset($_SESSION['name'])){
  		header('location:index.php?msg=1');
	} 
}

function checkAdminUser($page){
	@session_start(); 
	if($_SESSION['role_name'] != 'Admin' ){ 
?>
<script type="text/javascript">
	window.location = 'dashboard.php?msg=2&page=<?php echo $page?>';
</script>
<?php
	} 
}

?>