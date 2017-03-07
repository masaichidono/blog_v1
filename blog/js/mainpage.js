var blog_header = document.getElementsByClassName("blog_header")[0];
var header_height = blog_header.offsetTop;
//点击加载更多文章
var page =1;
var more = document.getElementById('more');
var time;
more.onclick =function(){
	page++;
	ajax("get","ckEditor.php","page="+page+"&a=getPageData&table=circle&pageSize=4",function(data){
		var data = JSON.parse(data);
		if(data.code==1){
			var dataList =data.dataList;
			for(var i =0;i<dataList.length;i++){
				addCircle(dataList[i]);
			}
			setBg();
		}else{
			more.innerHTML="没有更多了";
		}
	});
	
}
setInterval(function(){
	time=audio.currentTime;
},500);
//当滚动条滚动到一定地方，导航栏进行固定定位
window.onscroll = function(){
	if(scroll().top>=header_height){
		blog_header.className = "blog_header fixed"
		back.style.display = 'block';
	}else{
		blog_header.className = "blog_header"
		back.style.display = 'none';
	}
}
window.onresize = function(){
	setBg();
}
function addCircle(dataList){
	var circle = document.createElement('div');
	circle.className="blog_latest_circle clearFixed";
//	图片div
	var photo = document.createElement('div');
	photo.className = "blog_latest_circle_photo";
	
	var photo_a = document.createElement('a');
	photo_a.href = "";
	
	var img = document.createElement('img');
	img.src = "img/1-1406052123280-L.jpg";
	photo_a.appendChild(img);
	photo.appendChild(photo_a);
//	信息div
	var info = document.createElement('div');
	info.className = "blog_latest_circle_info";
	
	var info_a = document.createElement('a');
	info_a.href = 'circle.php?id='+dataList.id+"&table=circle";
	
	var info_h2 = document.createElement('h2');
	info_h2.innerHTML = dataList.title;
	info_a.appendChild(info_h2);
	
	var info_ul = document.createElement('ul');
	info_ul.className = "clearFixed";
	
	var info_ul_li_01 = document.createElement('li');
	info_ul_li_01.innerHTML = "作者:<a href=''>"+dataList.author+"</a>"
	info_ul.appendChild(info_ul_li_01);
	
	var info_ul_li_02 = document.createElement('li');
	info_ul_li_02.innerHTML = "发布时间:<span>"+dataList.time+"</span>"
	info_ul.appendChild(info_ul_li_02);
	
	var info_ul_li_03 = document.createElement('li');
	info_ul_li_03.innerHTML = "分类:<span>"+dataList.type+"</span>"
	info_ul.appendChild(info_ul_li_03);
	
	var info_p = document.createElement('p');
	var part = dataList.text.substring(0,300);
	info_p.innerHTML=part;
	
	info.appendChild(info_a);
	info.appendChild(info_ul);
	info.appendChild(info_p);	
	
	circle.appendChild(photo);
	circle.appendChild(info);
	
//	将circle加入最新文章后
	var content = document.getElementById('content');
	content.appendChild(circle);
}
