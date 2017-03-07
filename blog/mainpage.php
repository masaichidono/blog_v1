<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="apple-mobile-web-app-capable" content="yes" />   
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<meta name="format-detection" content="telephone=yes"/>
		<meta name="msapplication-tap-highlight" content="no" />
		<title>Masaichi的博客</title>
		<link rel="stylesheet" type="text/css" href="css/header.css"/>
		<link rel="stylesheet" type="text/css" href="css/mainpage.css"/>
	</head>
	<body>
		<div id="blog">
			<div class="blog_logo">
				<h1>Masaichi的博客</h1>
			</div>
			<!--头部-->
			<div class="blog_header">
				<div class="blog_header_menu">
					<ul class="clearFixed">
						<li><a href="mainpage.php" class="active">首页</a></li>
						<li><a href="entertainment.php">娱乐</a></li>
						<li><a href="mood.php">说说</a></li>
						<li><a href="">成长树</a></li>
						<li><a href="">留言板</a></li>
						<li><a href="">照片墙</a></li>	
					</ul>
					
					<a href="javascript:" id="music">
						<audio src="img/陈小春 - 独家记忆.mp3" controls="controls" 	autoplay="auto" id="audio">
							Your browser does not support the audio element.
						</audio>
					</a>
				</div>
			</div>
			<!--励志图片-->
			<div class="blog_photo">
				<img src="img/banner_top.jpg"/>
				<h6>人生实如钟摆</h6>
				<h5>在痛苦与倦怠之间摆动</h5>
			</div>
			<!--内容-->
			<div class="blog_content_bg" id="blog_content_bg">
				</div>
			<div class="blog_content clearFixed" id="blog_content">
				<!--每日一句励志-->
				<div class="blog_content_blackboard">
					<p>一朵花坠落的速度，连时间都放慢了脚步。</p>
					<img src="img/下载.jpg"/>
				</div>
				<!--最新文章-->
				<div class="blog_latest" >
					<!--最新文章标题-->
					<h3>最新文章</h3>
					<div id="content">
					<?php
						require_once "connect.php";
						$pageSize =4;   //每一页显示4条记录
						if(isset($_GET['page'])){
							$page = $_GET['page'];
						}else{
							$page = 1;
						}
						$begin =($page-1)*$pageSize;
						
						echo "<script>console.log('连接成功')</script>";
						//读取数据
						$sql ="SELECT * FROM circle limit {$begin},{$pageSize}";
						$result = $conn->query($sql);
						$pageMaxNum = (int)$result->num_rows/$pageSize;
						if($result->num_rows>0){
							//输出每行数据
							while($row = $result->fetch_assoc()){
//								$text=substr($row['text'], 0,255);
								echo <<<STR
									<div class="blog_latest_circle clearFixed">
										<div class="blog_latest_circle_photo">
											<a href="circle.php?table=circle&id={$row['id']}"><img src="img/1-1406052123280-L.jpg"/></a>
										</div>
										<div class="blog_latest_circle_info">
											<a href="circle.php?table=circle&id={$row['id']}"><h2>{$row['title']}</h2></a>
											<ul class="clearFixed">
												<li>作者:<a href="">{$row['author']}</a></li>
												<li>发布时间:<span>{$row['time']}</span></li>
												<li>分类:<span>{$row['type']}</span></li>
											</ul>
											<p>{$row['part']}</p>
										</div>
									</div>
STR;
							}
						}
						//关闭数据库连接
						$conn->close();
					 ?>
					 </div>
					<!--分页-->
					<div class="blog_content_page">
						<!--<ul class="clearFixed">
							<li><a href="">上一页</a></li>
							<li><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">4</a></li>
							<li><a href="">5</a></li>
							<li><a>...</a></li>
							<li><a href="mainpage.php?page=2">下一页</a></li>
						</ul>-->
						<h5 id="more">点击加载更多</h5>
					</div>
				</div>
				
				<!--热点排行-->
				<div class="blog_content_rank">
					<h4>热点排行TOP5</h4>
					<ul class="clearFixed">
						<li><span>1</span><a href="">为什么要做自己的个人博客？</a></li>
						<li><span>2</span><a href="">海贼王里面最感动人的话语</a></li>
						<li><span>3</span><a href="">关于个人网站服务器的选择</a></li>
						<li><span>4</span><a href="">龙珠超56集内容以及57集预告，扎马</a></li>
						<li><span>5</span><a href="">通过xpath解析报文xml数据</a></li>
					</ul>
				</div>
			</div>
			<!--底部-->
			<div class="blog_footer">
				<div class="blog_footer_content clearFixed">
					<ul>
						<li><a href="">关于</a></li>
						<li><a href="">学习</a></li>
						<li><a href="">成长</a></li>
						<li><a href="">娱乐</a></li>
					</ul>
					<p>Copyright&copy;2016,Masaichi All Rights Reserved.</p>
				</div>
			</div>
		</div>
		<!--返回顶部和播放音乐按钮-->
		<a id="back" href="#"></a>
		
	</body>
	<script type="text/javascript" src="js/mainpage.js"></script>
	<script type="text/javascript" src="js/comment.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
</html>
