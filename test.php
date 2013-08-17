
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title> Test </title>
</head>
<body>
<?php
 $idtemp=$_POST['weiboid'];
 $id=substr($idtemp,0,strlen($idtemp)-1);
 $text=$_POST['content'];
 $flag=$_POST['flag'];
 echo "id:".$id." ";
 echo "text:".$text." ";
 echo "flag:".$flag."";
 echo "error:".$ms['error'];
?>
</body>
</html>