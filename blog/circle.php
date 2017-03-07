<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/header.css"/>
		<link rel="stylesheet" type="text/css" href="css/circle.css"/>
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
						<audio src="img/陈小春 - 独家记忆.mp3" controls="controls"  id="audio">
							Your browser does not support the audio element.
						</audio>
					</a>
				</div>
			</div>
			<!--中间内容部分-->
				<!--白色背景-->
				<div class="blog_content_bg" id="blog_content_bg"></div>
				<!--内容-->
				<div class="blog_content clearFixed" id="blog_content">
					<!--左侧文章内容-->
					<div class="blog_circle_left">
							<?php 
//							接收文章的数据库表，还有文章的id
								require "connect.php";
//								连接数据库	
								$table=$_GET['table'];
								$id=$_GET['id'];
								$sql="select * from {$table} where id={$id}";
								$result=$conn->query($sql);
								if($result!=null&&$result->num_rows>0){  //获取到的数据不为空
									$row=$result->fetch_assoc();
									echo <<<STR
											<h1>{$row['title']}</h1>
											<ul class="clearFixed">
												<li>编辑时间:<span>{$row['time']}</span></li>
												<li>浏览量:<span>1000</span></li>
												<li>作者:<span>{$row['author']}</span></li>
											</ul>
											<div id="blog_circle_content">{$row['text']}</div>
											
STR;
								}else{
									echo "很抱歉，该文章已删除";
								}
							?>
						
						<!--文章的赞和踩操作-->
						<div class="blog_circle_">
							<a href=""></a>							
						</div>
						<h2 class="clearFixed">
							<a href="" id="before">上一篇:如何建立个人博客</a>
							<a href="" id="after">下一篇:如何建立个人博客</a>
						</h2>
						<!--评论-->
						<div class="circle_comment">
							<!--发布留言框-->
							<h4>发表评论</h4>
							<div class="circle_comment_send clearFixed">
								<a href=""><img src="img/photo.jpg"/></a>
								<div>
									<textarea id="circle_comment" name="circle_comment" rows="4" cols="" placeholder="写下你的吐槽。。。"></textarea>
									<div class="clearFixed">
										<a id="comment_send">发布</a>
									</div>
								</div>
							</div>
							<div class="circle_comment_menu clearFixed">
								<a><span>210</span>条评论</a>
								<ul class="clearFixed">
									<li><a href="">最新</a></li>
									<li><a href="">最早</a></li>
									<li><a href="">最热</a></li>
								</ul>
							</div>
							<!--评论列表-->
							<div class="circle_comment_list">
								<ul id="comment_ul">
									<?php 
									
										require "connect.php";
										if(isset($_GET['table'])&&$_GET['table']=='circle'){
											$type_id=1;
										}else{
											$type_id=2;
										}
										
										$circle_id=$_GET['id'];
										echo "<script>var type_id={$type_id};var circle_id={$circle_id};</script>";
										$sql="select * from comment where type_id={$type_id} and circle_id={$circle_id}";
										$result=$conn->query($sql);
										if($result!=null&&$result->num_rows>0){
											while($row=$result->fetch_assoc()){
												$end=strpos($row['time'], ' ',0);
												$date=substr($row['time'],0,$end);
											echo <<<STR
												<li class="clearFixed">
													<a href=""><img src="img/photo.jpg"/></a>
													<div>
														<a href="">{$row['master']}</a>
														<p>{$row['text']}</p>
														<ul>
															<li>{$date}</li>
															<li><a href="">回复</a></li>
															<li><a href="">点赞</a></li>
															<li><a href="">转发</a></li>
														</ul>
													</div>
												</li>
												
STR;
											}
										}else{
											echo "<li>还没有评论</li>";
										}
										
									?>
								</ul>
							</div>
							<!--分页-->
							<div class="circle_comment_page">
								<ul class="clearFixed">
									<li><a href="">上一页</a></li>
									<li><a href="">1</a></li>
									<li><a href="">...</a></li>
									<li><a href="">2</a></li>
									<li><a href="">下一页</a></li>
								</ul>
							</div>
							
						</div>
					</div>
					<!--右侧最新推荐-->
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
				
			<!--登陆面板-->
			<div class="circle_login">
			</div>
				<div class="circle_login_panel">
					<form>
						<table border="0" cellspacing="0" cellpadding="0" id="table">
							<tr><th>登陆</th></tr>
							<tr id="tr_name"><td>
								<p>请输入你的网名</p>
								<input type="text" name="name" id="name" value="" placeholder="请输入名字"/>
								
							</td></tr>
							
							<tr id="tr_email"><td>
								<p>请输入你的email</p>
								<input type="email" name="email" id="email" value="" placeholder="请输入邮箱"/>
								<input type="button" id="sure" value="确定"></input>
							</td></tr>
						</table>
						<input type="button" value="临时登陆" id="submit"/>
					</form>
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
		</div>
	</body>
	<script type="text/javascript" src="js/comment.js"></script>
	<script type="text/javascript" src="js/circle.js"></script>
	<script type="text/javascript" src="js/ajax.js">
		
	</script>
	
</html>