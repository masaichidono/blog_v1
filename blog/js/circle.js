var blog_content_rank = document.getElementsByClassName("blog_content_rank")[0];
var blog_content = document.getElementsByClassName("blog_content")[0];
var blog_header = document.getElementsByClassName("blog_header")[0];
//获取头部距离顶部的距离和头部的宽度
var header_top = blog_header.offsetTop;
var header_height=blog_header.offsetHeight;
//获取最新推荐的宽度,因为固定定位后会发生变化

var rank_width=parseInt(blog_content_rank.offsetWidth)-20;
var left = blog_content_rank.offsetLeft+blog_content.offsetLeft;
//当滚动条滚动到一定地方，导航栏进行固定定位
window.onscroll = function(){
	//头部固定
	if(scroll().top>=header_top){
		blog_header.className = "blog_header fixed"
		back.style.display = 'block';
	}else{
		blog_header.className = "blog_header"
		back.style.display = 'none';
	}
//	最新推荐固定
	if(scroll().top>=header_height){
		blog_content_rank.className ="blog_content_rank circle_rank";
		blog_content_rank.style.width = rank_width+"px";
		blog_content_rank.style.top=header_height+30+"px";
		blog_content_rank.style.left=left-10+"px";
		
	}else{
		blog_content_rank.className ="blog_content_rank";
//		blog_content_rank.style.width ="30%";
	}
}

//评论面板
var circle_comment=document.getElementById("circle_comment");
var comment_send=document.getElementById("comment_send");
var circle_login =document.getElementsByClassName("circle_login")[0];
var circle_login_panel =document.getElementsByClassName("circle_login_panel")[0];
var in_name=document.getElementById('name');
var email=document.getElementById('email');
var submitt = document.getElementById('submit');
var p=circle_login_panel.getElementsByTagName('p');
var tr_name=document.getElementById('tr_name');
var table=document.getElementById('table');
var sure=document.getElementById('sure');
var tr_email=document.getElementById("tr_email");

var flag=false;
//当点击评论框或者点击发布按钮时,获取cookie,如没有用户名则弹出注册对话框
comment_send.onclick=function(){
//	判断评论内容是否为空
	if(circle_comment.value==''){
		alert("评论内容不能为空");
		return;
	}
//	查看cookie中有没有数据
	var s=isCookie();
	if(!s){
		circle_login_panel.style.display="block";
		circle_login.style.display="block";
	}else{
		//获取cookie中的id值
		var id=getCookie('id');
		ajax("get","ckEditor.php","a=addComment&comment="+circle_comment.value+"&master="+id+"&type_id="+type_id+"&circle_id="+circle_id,function(data){
			if(data==1){  //插入留言成功
				addComment();
				setBg();
			}else{
				alert("留言失败");
			}
		})
	}
}
//检查用户输入的email是否重复
sure.onclick=function(e){
	var text=email.value;
	var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	 if (filter.test(text)){
	 	p[1].innerHTML="电子邮箱正确！";
	 	ajax("get","ckEditor.php","a=getUsers"+"&email="+text,function(data){
	 		var data=JSON.parse(data);
	 		if(data.code!=0){
//	 			表示用户已存在
				flag=false;
				submitt.style.display='block';
	 		}else{
	 			tr_name.style.display='block';
	 			tr_email.style.display="none"
	 			submitt.style.display="block";
	 			flag=true;
	 		}
	 	})
//	 	 return true;
	 }else {
	 p[1].innerHTML="你输入的电子邮箱格式有误！";
//	 return false;
	}
}
submit.onclick=function(){

		//进行注册
		if(flag){
			//添加用户
			ajax("get","ckEditor.php","a=addUsers&name="+in_name.value+"&email="+email.value,function(data){
				var data = JSON.parse(data);
				if(data.code!=0){
					checkCookie("id",data.data['id']);
				}else{
					alert("注册失败");
				}
			})
		}else{//检查cookie
			ajax("get","ckEditor.php","a=getUsers&email="+email.value,function(data){
				var data=JSON.parse(data);
				if(data.code!=0){
					alert("登陆成功");
	//				检查是否有cookie,如无则添加
					checkCookie('id',data.data['id']);
					circle_login.style.display="none";
					circle_login_panel.style.display='none';
				}else{
					alert("登陆失败");
				}
			})
		}
	}
//	cookie中有数据存在
	

//设置cookie
function setCookie(c_name,value,expiredays){
	var exdate=new Date()
	exdate.setDate(exdate.getDate()+expiredays)
	document.cookie=c_name+ "=" +escape(value)+";"+
	((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}
//获取cookie  获取cookie值
function getCookie(c_name){
	if(document.cookie.length>0){
		c_start=document.cookie.indexOf(c_name+'=');
		if(c_start!=-1){
			c_start=c_start+c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if(c_end==-1) c_end=document.cookie.length;  //当没有分号
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
}
function checkCookie(userid,value){
//	username=getCookie("")
	username=getCookie(userid);
	if (username!=null && username!="")
	  {alert('Welcome again !')}
	else 
	  {
	    setCookie(userid,value,365);
	  }
}
function isCookie(){
//	username=getCookie("")
	username=getCookie("id");
	if (username!=null && username!="")
	  {return true;}
	else 
	  {
	    return false;
	  }
}
//添加评论
function addComment(){
	var nDate=new Date();
	var comment_li=document.createElement('li');
	comment_li.className="clearFixed";
	comment_li.innerHTML="<a href=''><img src='img/photo.jpg'/></a><div><a href=''>"+getCookie('id')+"</a><p>"+circle_comment.value+"</p><ul><li>"+nDate.getFullYear()+"-"+nDate.getMonth()+"-"+nDate.getDay()+"</li><li><a href=''>回复</a></li><li><a href=''>点赞</a></li><li><a href=''>转发</a></li></ul></div>"
	var comment_ul=document.getElementById("comment_ul");
	comment_ul.appendChild(comment_li);
}
window.onresize = function(){
	setBg();
}
