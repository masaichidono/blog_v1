<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="apple-mobile-web-app-capable" content="yes" />    
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<meta name="format-detection" content="telephone=yes"/>
		<meta name="msapplication-tap-highlight" content="no" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/header.css"/>
		<link rel="stylesheet" type="text/css" href="css/entertaiment.css"/>
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
						<li><a href="mainpage.php">首页</a></li>
						<li><a href="entertainment.php" class="active">娱乐</a></li>
						<li><a href="mood.php">说说</a></li>
						<li><a href="">成长树</a></li>
						<li><a href="">留言板</a></li>
						<li><a href="">照片墙</a></li>	
					</ul>
					
					<a href="javascript:" id="music">
						<audio src="img/陈小春 - 独家记忆.mp3" controls="controls"  id="audio">
							Your browser does not support the audio element.
						</audio>
					</a>
				</div>
			</div>
			<!--励志图片-->
			<div class="blog_photo">
				<img src="img/banner_top.jpg"/>
			</div>
			<!--内容背景遮罩-->
			<div class="blog_content_bg" id="blog_content_bg">
			</div>
			<!--内容部分-->
			<div class="blog_content clearFixed">
				<!--轮播图-->
				<div class="entertaiment_lunbo" id="entertaiment_lunbo">
					<ul class="clearFixed" id="entertaiment_lunbo_ul">
						<li><img src="img/轮播图1.jpg" alt="" /></li>
						<li><img src="img/轮播图2.jpg" alt="" /></li>
						<li><img src="img/轮播图3.jpg" alt="" /></li>
					</ul>
					<span id="left">
						<
					</span>
					<span id="right">
						>
					</span>
				</div>
				
				<!--微电影区-->
				<div class="entertaiment_movie clearFixed">
					<h1><span>微电影</span></h1>
					<ul class="clearFixed">
						
							<!--初次加载从数据库中获取数据-->
							<?php
								require "connect.php";
								$size=6;
								$sql ="select * from mysql_movie limit 0,{$size}";
								$result=$conn->query($sql);
								if($result->num_rows>0){
									//输出每一行的数据
									while($row=$result->fetch_assoc()){
										echo <<<STR
										<li>
											<div>
												<div><a href="{$row['url']}"><img src="{$row['img']}"/></a></div>
												<a href="{$row['url']}">{$row['title']}</a>
												<p class="clearFixed">
													<span>{$row['comment']}</span>
													<b>{$row['love']}</b>
													<span>{$row['score']}</span>
													<i></i>
												</p>
											</div>
										</li>
STR;
									}
								}
								$conn->close();
							 ?>
						
					</ul>
				</div>
				<!--书籍区-->
				<div class="entertaiment_book clearFixed">
					<h1><span>推荐文学</span></h1>
					<ul class="clearFixed">
						<!--初次加载从数据库中获取数据-->
							<?php
								require "connect.php";
								$size=6;
								$sql ="select * from mysql_book  limit 0,{$size}";
								$result=mysqli_query($conn,$sql);
								if($result->num_rows>0){
									//输出每一行的数据
									while($row=$result->fetch_assoc()){
										echo <<<STR
										<li>
											<div class="clearFixed">
												<a href="{$row['url']}"><img src="{$row['img']}"/></a>
												<div>
													<h2><a href="{$row['url']}">{$row['name']}</a></h2>
													<p>作者:<span>{$row['author']}</span></p>
													<p>{$row['property']}</p>
												</div>
											</div>
											<p>{$row['summary']}</p>
										</li>
STR;
									}
								}
								$conn->close();
							 ?>
					</ul>
				</div>
				<!--资源分享区-->
				<div class="entertaiment_share_content clearFixed">
					<h1><span>资源分享/交流区</span></h1>
					<div class="entertaiment_share clearFixed">
						<ul id="enter_ul">
							<!--初次加载从数据库中获取数据-->
							<?php
								require "connect.php";
								$size=4;
								$sql ="select * from mysql_sources  limit 0,{$size}";
								$result=mysqli_query($conn,$sql);
								if($result->num_rows>0){
									//输出每一行的数据
									while($row=$result->fetch_assoc()){
										echo <<<STR
										<li>
											<h3><a href="circle.php?table=mysql_sources&id={$row['id']}">{$row['title']}</a></h3>
											<div class="entertaiment_share_article clearFixed">
												<img src="{$row['img']}"/>
												<p>{$row['summary']}</p>
												<h4><a href="circle.php?table=mysql_sources&id={$row['id']}">详细信息</a></h4>
											</div>
											<h5 class="clearFixed">
												<span>发布时间:{$row['time']}</span>
												<b>作者：{$row['author']}</b>
												<i>分类:{$row['type']}</i>
											</h5>
										</li>
STR;
									}
								}
								$conn->close();
							 ?>
						</ul>
						<h6 id="more">
							点击加载更多
						</h6>
					</div>
					<!--热最新排行-->
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
		
			<!--返回顶部和播放音乐按钮-->
			<a id="back" href="#"></a>
		</div>
	</body>
	<script type="text/javascript" src="js/comment.js" ></script>
	<script type="text/javascript" src="js/entertaiment.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
		
	
		
	
</html>