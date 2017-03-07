<?php
						//	连接数据库
						$servername = "localhost";
						$username = "root";
						$password ="";
						$table = "blog";
						$pageSize =4;   //每一页显示4条记录
						//创建连接
						$conn = new mysqli($servername,$username,$password,$table);
						mysqli_query($conn,"set names utf8");
						if($conn ->connect_error){
							die("连接失败".$conn->connect_error);
						}
?>
