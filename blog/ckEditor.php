<?php
//判断调用哪个函数
if(isset($_GET['a'])){
	$a=$_GET['a'];
	if($a=='save'){
		var_dump($a);
		save();
	}else if($a=='get'){
		get();
	}else if($a=='getPageData'){
		getPageData();
	}else if($a=='getMoodData'){
		getMoodData();
	}else if($a=='getUsers'){
		getUsers();
	}else if($a=='addUsers'){
		addUsers();
	}else if($a=='addComment'){
		addComment();
	}
}
function save(){
						require_once "connect.php";
						$editor=$_GET['editor'];
						$sql ="INSERT INTO circle (title,text) values ('123','{$editor}')";
						if(mysqli_query($conn,$sql)){
							echo $editor;
						}else{
							echo "插入失败".$conn->error;
						}
						
						mysqli_close($conn);
}
function get(){
						require_once "connect.php";
						$sql="select * from circle where id=60";
						$result=$conn->query($sql);
						if($result->num_rows>0){
							echo json_encode(array('data'=>$result->fetch_assoc()));
						}else{
							echo json_encode(array('code'=>0,'message'=>$result));
						}
						$conn->close();
}
//获取每一页的数据
function getPageData(){
						require_once "connect.php";
						$table=$_GET['table'];
						if(isset($_GET['page'])){
							$page = $_GET['page'];
						}else{
							$page = 1;
						}
						
						$pageSize=$_GET['pageSize'];
						$begin =($page-1)*$pageSize;
						//读取数据
						$sql ="SELECT * FROM {$table} limit {$begin},{$pageSize}";
						$result = $conn->query($sql);
						$pageMaxNum = (int)$result->num_rows/$pageSize;
						if($result->num_rows>0){
							$datas =array();
							$i=0;
							while($row =$result->fetch_assoc()){
								$datas[$i]=$row;
								$i++;
							}
//							$row = $result->fetch_assoc();
							echo json_encode(array('dataList'=>$datas,'code'=>1));
						}else{
							echo json_encode(array('code'=>0));
						}
						//关闭数据库连接
						mysqli_close($conn);
}
function getMoodData(){
	require_once "connect.php";
						if(isset($_GET['front'])){
							$index=$_GET['front'];
						}
						$sql="select * from mood limit {$index},4";
						$result = $conn->query($sql);
						if($result->num_rows>0){
							$datas=array();
							$i=0;
							while($row=$result->fetch_assoc()){
								$datas[$i]=$row;
								$i++;
							}
							echo json_encode(array("dataList"=>$datas,'code'=>1));
						}else{
							echo json_encode(array('code'=>0));
						}
						$conn->close();
}
function getUsers(){
	require_once "connect.php";
	$email=$_GET['email'];
	$sql="select id from user where email='{$email}'";
	$result=$conn->query($sql);
	if($result!=null){
		$row=$result->fetch_assoc();
		echo json_encode(array("data"=>$row,"code"=>1));
	}else{
		echo json_encode(array("code"=>1));
	}
	$conn->close();
}

function addUsers(){
	require_once "connect.php";
	$email=$_GET['email'];
	$name=$_GET['name'];
	$sql="insert into user(name,email) values ('{$name}','{$email}')";
	$result=$conn->query($sql);
	if($result){
//		插入数据成功,返回id
		$sql="select id from user where email={$email}";
		$result=$conn->query($sql);
		if($result！=null){
//			$row=$result->fetch_assoc();
			echo json_encode(array("data"=>$result,"code"=>1));
		}else{
			echo json_encode(array("code"=>0));
		}
		
	}else{
		echo json_encode(array("code"=>0));
	}
	$conn->close();
}

//保存评论
	function addComment(){
		require_once "connect.php";
		$master=$_GET['master'];
		$comment=$_GET['comment'];
		if(isset($_GET['guest'])){
			$guest=$_GET['guest'];
		}else{
			$guest=-1;
		}
		$type_id=$_GET['type_id'];
		$circle_id=$_GET['circle_id'];
		$sql="insert into comment(master,guest,text,type_id,circle_id) values ({$master},{$guest},'{$comment}',{$type_id},{$circle_id})";
		$result=$conn->query($sql);
		if($result){
//			插入数据成功
			echo 1;
		}else{
			echo 0;
		}
	}
?>