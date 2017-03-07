<?php
        header("Content-type:text/html:charset=utf-8");
        $con=mysqli_connect("23.105.215.113","guest","85168908","blog");
        $con->query("set names utf8");
        if($con->connect_error){
                die("失败".$con->connect_error);
        }
        $result=$con->query("select part from circle");
//		mysqli($result,"set names utf8");
        $data=array();
        while($row=$result->fetch_assoc()){
                echo $row['part']."/n";
        }
//      echo"<pre>";
        $con->close();
?>
<!Doctype html>
<html>
	<meta charset="UTF-8"/>
        <head>
               <title></title>
        </head>
        <body>
                <p>sdfsdfsd</p>
        </body>
</html>