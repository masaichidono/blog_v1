window.onload=function(){
	

var blog_header = document.getElementsByClassName("blog_header")[0];
var header_height = blog_header.offsetTop;
var back = document.getElementById('back');
var music = document.getElementById("music");
var audio =document.getElementById('audio');


setBg();

//显示音乐控制条
music.onmouseover = function(){
	audio.style.display = "block";
	music.style.height="60px";
}
music.onmouseout= function(){
	audio.style.display = "none";
	music.style.height="34px";
}


//点击播放按钮停止播放,再次点击播放音乐
var music_flag=0;
music.onclick = function(){
	if(music_flag==0){
		audio.pause();
		music_flag=1;
	}else{
		audio.play();
		music_flag=0;
	}
	
}


}
//scroll兼容性函数
function scroll(){
	//当是主流浏览器
	if(window.pageXOffset !=null){
		return {
			left:window.pageXOffset,
			top:window.pageYOffset
		}
	}else if(document.compatMode =='CSS1Compat'){   //如果浏览器使用兼容模式
		return{
			left:document.documentElement.scrollLeft,
			top:document.documentElement.scrollTop
		}
	}
	return{
		left:document.body.scrollLeft,
		top:document.body.scrollTop
	}
}
//模糊白色背景层得高度调整
function setBg(){
	var blog_content = document.getElementById('blog_content');
	var blog_content_bg = document.getElementsByClassName("blog_content_bg")[0];
	var blog_footer = document.getElementsByClassName("blog_footer")[0];
	blog_content_bg.style.height =(blog_footer.offsetTop-blog_content_bg.offsetTop)+'px'; 
}
