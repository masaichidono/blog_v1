
//消除数组中重复的元素
//var arr1=[1,2,2,2,3,3,3,4,5,6];
//var arr2=[];
//for(var i=0,len=arr1.length;i<len;i++){
//	if(arr2.indexOf(arr1[i])<0){
//		arr2.push(arr1[i]);
//		
//	}else{
//		arr1.splice(i,1);
//		i--;
//		len--;
//	}
//}
//alert(arr1);
//alert(arr2)

//function callerDemo() {  
//  if (callerDemo.caller == null) {  
//      alert("在顶层执行");  
//      
//  }  
//  else  
//  { 
//  	alert(callerDemo.caller);
//      return "被函数使用";  
//  }  
//}  
//function handleCaller(){  
//  alert(callerDemo());  
//}
//handleCaller();
//callerDemo();

//统计字符串中字母个数
var str = "aaaabbbccccddfgh";
var obj  = {};
for(var i=0;i<str.length;i++){
    var v = str.charAt(i);
    if(obj[v] && obj[v].value == v){
        obj[v].count = ++ obj[v].count;
    }else{
        obj[v] = {};
        obj[v].count = 1;
        obj[v].value = v;
    }
}
for(key in obj){
    document.write(obj[key].value +'='+obj[key].count+'&nbsp;'); // a=4  b=3  c=4  d=2  f=1  g=1  h=1 
}   