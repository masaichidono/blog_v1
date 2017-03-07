<!DOCTYPE html>
<html>
	<meta charset="UTF-8"/>
	<head>
		<title></title>
		<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="css/samples.css">
	<link rel="stylesheet" href="css/neo.css">
		<link rel="stylesheet" type="text/css" href="ckeditor/contents.css"/>
	</head>
	<body>
		<textarea name="editor" rows="" cols="" id="editor">
			<h1>你好</h1>
		</textarea>
		<button id="btn">提交</button>
		<div id="">
			<?php 
						$servername ="localhost";
						$username = "root";
						$password ="";
						$table = "blog";
//						var_dump($id);
//						$editor = "<script>document.write(editor);</script>";
						$conn = new mysqli($servername,$username,$password,$table);
						mysqli_query($conn,"set names utf8");
						$sql="select text from circle where id=75";
						$result=$conn->query($sql);
						if($result->num_rows>0){
							$row=$result->fetch_assoc();
//							var_dump($row);
							echo $row['text'];
							
						}else{
							echo json_encode(array('code'=>0,'message'=>$result));
						}
						$conn->close();
						
			?>
		</div>
	</div>
	</body>
	<script type="text/javascript" src="js/ajax.js">
		
	</script>
	<script>
		CKEDITOR.replace("editor");
//		CKEDITOR.instances.editor.setData("你好");
		var editor = CKEDITOR.instances.editor.getData();
		
		ajax("get","ckEditor.php","editor="+editor+"&a=save",function(data){
			alert(data);
		});
		var btn = document.getElementById('btn');
		btn.onclick =function(){
			var editor = CKEDITOR.instances.editor.getData();
			alert(editor);
			ajax("get","ckEditor.php","&a=save&editor="+editor,function(data){
				alert(data);
			});
		}
	</script>
</html>