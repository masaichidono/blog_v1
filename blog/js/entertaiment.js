var entertaiment_lunbo = document.getElementsByClassName("entertaiment_lunbo")[0];
var blog_header = document.getElementsByClassName("blog_header")[0];
var header_height = blog_header.offsetTop;
var left = document.getElementById('left');
var right = document.getElementById('right');
lunbo_adjust();
lunbo();


function lunbo_adjust(){
	//轮播图响应式
	
	var entertaiment_lunbo_li =document.getElementById("entertaiment_lunbo_ul").children;
	
	//将每个li的宽度与轮播展示div宽度一致
	for(var i =0;i<entertaiment_lunbo_li.length;i++){
		entertaiment_lunbo_li[i].style.width = entertaiment_lunbo.offsetWidth +"px";
	}
}

window.onresize = function(){
	lunbo_adjust();   //每当改变窗口大小进行缩放
	setBg();
}
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


    function lunbo(){
       // 获取元素
        var box = document.getElementById("entertaiment_lunbo");  // 大盒子
        var ul = document.getElementById("entertaiment_lunbo_ul");
        var ulLis = ul.children;
//      获取li的长度
		var ulLi_length= ulLis[0].offsetWidth;

       // 操作元素

       // 因为我们要做无缝滚动  ，所以要克隆第一张，放到最后一张后面去
        // 1. 克隆完毕
        ul.appendChild(ul.children[0].cloneNode(true));

        // 2. 创建 ol  和  小 li
        console.log(ulLis.length);
        var ol = document.createElement("ol");  // 生成的是ol
        box.appendChild(ol); // 把ol 追加到  box 里面
        for(var i=0;i<ulLis.length-1;i++)
        {
            var li = document.createElement("li");
            li.innerHTML = i + 1;  //  给里面小的li 文字  1 2 3 4 5
            ol.appendChild(li);  // 添加到 ol 里面
        }
        ol.children[0].className = "current";

        //3. 开始动画部分
        var olLis = ol.children;
         for(var i=0; i<olLis.length;i++)
         {
             olLis[i].index = i;  // 获得当前第几个小li 的索引号
             olLis[i].onmouseover = function() {
                 for(var j=0;j<olLis.length;j++)
                 {
                     olLis[j].className = "";  // 所有的都要清空
                 }
                 this.className = "current";
                 animate(ul,-this.index*ulLi_length)
                 // 调用动画函数  第一个参数  谁动画     第二个  走多少
                 square = key = this.index;  // 当前的索引号为主
             }
         }
         //  4. 添加定时器
        var timer = null;   // 轮播图的定时器
        var key = 0;  //控制播放张数
        var square = 0; // 控制小方块
        timer = setInterval(autoplay,3000);  // 开始轮播图定时器
//        自动播放函数
          function autoplay() {
              key++;  // 先 ++
              if(key>ulLis.length - 1)  // 后判断
              {
                  ul.style.left = 0;  // 迅速调回
                  key = 1;  // 因为第4张就是第一张  第4张播放 下次播放第2张
              }
              animate(ul,-key*ulLi_length);  // 再执行
              // 小方块
              square++;
              if(square > olLis.length -1)
              {
                  square = 0;
              }
              for(var i=0;i<olLis.length;i++)   // 先清除所有的
              {
                  olLis[i].className = "";
              }
              olLis[square].className = "current";  // 留下当前的
          }
          //last最后  鼠标经过大盒子要停止定时器
         box.onmouseover = function() {
             clearInterval(timer);
         }
         box.onmouseout = function() {
             timer = setInterval(autoplay,3000);  // 开始轮播图定时器
         }
}
    //动画函数
    function animate(obj,target){
        clearInterval(obj.timer);  // 先清除定时器
        var speed = obj.offsetLeft < target ? 15 : -15;  // 用来判断 应该 +  还是 -
        obj.timer = setInterval(function() {
            var result = target - obj.offsetLeft; // 因为他们的差值不会超过5
            obj.style.left = obj.offsetLeft + speed + "px";
            if(Math.abs(result)<=15)  // 如果差值不小于 5 说明到位置了
            {
                clearInterval(obj.timer);
                obj.style.left = target + "px";  // 有5像素差距   我们直接跳转目标位置
            }
        },10)
    }
 //点击加载更多文章
var page =1;
var more = document.getElementById('more');
more.onclick =function(){
	page++;
	ajax("get","ckEditor.php","page="+page+"&a=getPageData&table=mysql_sources&pageSize=4",function(data){
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

//		<li>
//			<h3><a href="">{$row['title']}</a></h3>
//			<div class="entertaiment_share_article clearFixed">
//				<img src="{$row['img']}"/>
//				<p>{$row['summary']}</p>
//				<h4><a href="">详细信息</a></h4>
//			</div>
//			<h5 class="clearFixed">
//				<span>发布时间:{$row['time']}</span>
//				<b>作者：{$row['author']}</b>
//				<i>分类:{$row['type']}</i>
//			</h5>
//		</li>
function addCircle(dataList){
	var enter_ul = document.getElementById('enter_ul');
	var enter_h3=document.createElement('h3');
	enter_h3.innerHTML="<a href='circle.php?table=mysql_sources&id="+dataList.id+"'>"+dataList.title+"</a>";
	
	var enter_div=document.createElement('div');
	enter_div.className="entertaiment_share_article clearFixed";
	var enter_img=document.createElement('img');
	enter_img.src=dataList.img;
	
	var enter_p=document.createElement('p');
	enter_p.innerHTML=dataList.summary;
	
	var enter_h4=document.createElement('h4');
	enter_h4.innerHTML="<a href='circle.php?table=mysql_sources&id="+dataList.id+"'>详细信息</a>";
	enter_div.appendChild(enter_img);
	enter_div.appendChild(enter_p);
	enter_div.appendChild(enter_h4);
	
	var enter_h5=document.createElement('h5');
	enter_h5.className="clearFixed"
	enter_h5.innerHTML="<span>发布时间:"+dataList.time+"</span><b>作者："+dataList.author+"</b><i>分类:"+dataList.type+"</i>"
	
	var enter_li=document.createElement('li');
	enter_li.appendChild(enter_h3)
	enter_li.appendChild(enter_div)
	enter_li.appendChild(enter_h5)
	
	enter_ul.appendChild(enter_li);
}
