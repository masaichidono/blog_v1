var mood_content=document.getElementsByClassName("mood_content")[0];


//禁止页面滚动
document.documentElement.style.overflow='hidden';
//注意:每一次用ajax加载4条数据,但显示是一条一条
var front=4;  //用于标记最后一条说说在数据库中的位置，从0开始算起
var size=4;  //用于记录li的个数
var scroll=true;
var scrollFunc=function(e){
    e=e || window.event;
   
    if(e.wheelDelta){//IE/Opera/Chrome
        if(e.wheelDelta<0&&scroll==true){  //当鼠标向下滚动
        	down();
        	
        }else if(e.wheelDelta>0&&scroll==true){
			up();
        }
    }else if(e.detail){//Firefox
        if(e.detail<0&&scroll==true){  //当鼠标向下滚动
        	down();
        }else if(e.detail>0){
        	up();
        }
    }
}
/*注册事件*/
if(document.addEventListener){ //只是将事件绑定，而并没有添加运行
    document.addEventListener('DOMMouseScroll',scrollFunc,false);
}//W3C
document.onmousewheel=scrollFunc;//IE/Opera/Chrome/Safari


function mood_ajax(){
	ajax("get","ckEditor.php","front="+front+"&a=getMoodData",function(data){
        		var data=JSON.parse(data);
        		if(data.code==1){
//      			true是标记鼠标滚轮的方向,true为上,false为下
        			for(var i=0;i<data.dataList.length;i++){
        				mood(data.dataList[i]);
        				size++;
        			}
        			
        			//隐藏第一个li
        			var index=front-4;
        			var mood_li=document.getElementById('mood_ul').children[index];
        			mood_li.style.display='none';
        			//显示下一条
        			var mood_li_after=document.getElementById("mood_ul").children[front];
        			mood_li_after.style.display="block";
        			front++;
        			scroll=true;
        			
        		}else{
//      			当已经没有数据
//					alert("没数据")
					console.log("木有数据了");
					scroll=true;
        		}
        	})
}

//加载mood
function mood(dataList){
//	把数据库中的时间进行切割
var str=dataList.time;
	var index=str.indexOf(" ");
	var mood_date = dataList.time.substr(0,index);
	var mood_second = dataList.time.substr(index);
	var mood_div_first=document.createElement("div");
	mood_div_first.className="mood_content_first";
	mood_div_first.innerHTML=mood_date+"<span>"+mood_second+"</span>";
	
	var mood_div_second=document.createElement("div");
	mood_div_second.className="mood_content_second";
	mood_div_second.innerHTML="<b></b>";
	
	var mood_div_third=document.createElement("div");
	mood_div_third.className="mood_content_third";
	mood_div_third.innerHTML=dataList.mood;
	
	var mood_li=document.createElement('li');
	mood_li.appendChild(mood_div_first);
	mood_li.appendChild(mood_div_second);
	mood_li.appendChild(mood_div_third);
//	将加载的4条li进行隐藏
	mood_li.style.display="none";
	
	var mood_ul=document.getElementById('mood_ul');
	   //当鼠标往下滚
	mood_ul.appendChild(mood_li);
}
function down(){
			scroll=false;
        	if(front>=size){
//      		当鼠标滚动至最后一个li
        		mood_ajax();
        	}else{
	//隐藏第一个li
        		var index=front-4;
        		var mood_li=document.getElementById('mood_ul').children[index];
        		mood_li.style.display='none';
        		//显示下一条
        		var mood_li_after=document.getElementById("mood_ul").children[front];
        		mood_li_after.style.display="block";
        		front++;
        		scroll=true;
        	}
}
function up(){
			scroll=false;
	//      	鼠标向上滚时不需要进行ajax链接
        	if(front>4){
	        	var index=front-5;
	        	var mood_li_after=document.getElementById('mood_ul').children[front-1];
	        	mood_li_after.style.display="none";
	        	var mood_li_front=document.getElementById('mood_ul').children[index];
        		mood_li_front.style.display='block';
//      		因为第一个li的下标只能为0,即front-4==0
        		front--;
        	}
        	scroll=true;
}
setFooter();
//获取页面高度
function setFooter(){
	var hg=window.screen.height;
	var blog_footer = document.getElementsByClassName("blog_footer")[0];
	var footer_hg=blog_footer.offsetHeight;
	blog_footer.style.top=hg-footer_hg+"px";
}
