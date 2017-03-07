<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="apple-mobile-web-app-capable" content="yes" />    
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<meta name="format-detection" content="telephone=yes"/>
		<meta name="msapplication-tap-highlight" content="no" />
		<title>说说</title>
		<link rel="stylesheet" type="text/css" href="css/header.css"/>
		<link rel="stylesheet" type="text/css" href="css/mood.css"/>
		<!--<link href="css/index_style.css" rel="stylesheet" type="text/css">-->
	</head>
	<body>
		<div id="blog" class="header">
			
			<!--<div class="blog_logo">
				<h1>Masaichi的博客</h1>
			</div>-->
			<!--头部-->
			<div class="blog_header topcn">
				<div class="blog_header_menu">
					<ul class="clearFixed">
						<li><a href="mainpage.php">首页</a></li>
						<li><a href="entertainment.php">娱乐</a></li>
						<li><a href="mood.php" class="active">说说</a></li>
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
			<!--内容背景遮罩-->
			<div class="blog_content_bg" id="blog_content_bg">
			</div>
			<!--内容部分-->
			<div class="blog_content clearFixed topcn">
				
				<div class="title">
					<div class="title_content">
						<span>2016</span>
						<p>YEAR</p>
					</div>
				</div>
				<div class="mood_content">
					<ul id="mood_ul">
						
							<?php 
								require_once "connect.php";
								$sql="select * from mood limit 0,4";
								$result=$conn->query($sql);
								if($result->num_rows>0){
									while($row=$result->fetch_assoc()){
										$index=strpos($row['time']," ");
										$date=substr($row['time'], 0,$index);
										$second=substr($row['time'], $index);
	//									echo "<script>alert('{$index}')</script>";
										echo <<<STR
											<li>
												<div class="mood_content_first">
													{$date}
													<span>{$second}</span>
												</div>
												<div class="mood_content_second">
													<b></b>
												</div>
												<div class="mood_content_third">
													{$row['mood']}
												</div>
											</li>
STR;
									}
								}
							?>
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
		
			<!--返回顶部和播放音乐按钮-->
			<a id="back" href="#"></a>
			<canvas id="canvas"></canvas>
		</div>
		
	</body>
	<script type="text/javascript" src="js/comment.js"></script>
	<script type="text/javascript" src="js/animation_special.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/mood.js"></script>
</html>