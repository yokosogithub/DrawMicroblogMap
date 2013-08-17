<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );


//从POST过来的signed_request中提取oauth2信息
if(!empty($_REQUEST["signed_request"])){
	$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY  );
	$data=$o->parseSignedRequest($_REQUEST["signed_request"]);
	if($data=='-2'){
		 die('签名错误!');
	}else{
		$_SESSION['oauth2']=$data;
	}
}  //判断用户是否授权
if (empty($_SESSION['oauth2']["user_id"])) {
		include "auth.php";
		exit;
} else {
          $c = new SaeTClientV2( WB_AKEY , WB_SKEY ,$_SESSION['oauth2']['oauth_token'] ,'' );
              
              
} 

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="all.css">
<style type="text/css">
body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;}
#l-map{height:100%;width:78%;float:left;border-right:2px solid #bcbcbc;}
#r-result{height:100%;width:20%;float:left;}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=00ff3b0d5343e0ed0e67af90dfa21a5c"> </script>
<title>图说微博</title>
</head>
<body>
 <?php include "weibo.php" ?>
<div id="allmap"> </div>
</body>
</html>
<script type="text/javascript">
var map = new BMap.Map("allmap");            // 创建Map实例
var point = new BMap.Point(105.404, 37.915);    // 创建点坐标
map.centerAndZoom(point,5);                     // 初始化地图,设置中心点坐标和地图级别。
map.enableScrollWheelZoom();                            //启用滚轮放大缩小
var i = 0;
var j = 0;
var namestr;  //姓名读取buffer
var latitude = new Array(); 
var longitude=new Array();
var address=new Array();
var locate=new Array();
var weibotext=new Array();
var weibo_id=new Array();
var name=new Array();
var create_at=new Array();
var gender=new Array();
var weibo_pic=new Array();
var person_image=new Array();
var point=new Array();
var infoWindow=new Array();
latitude=<?php echo json_encode($latitude);?>; 
longitude=<?php echo json_encode($longitude);?>;
address=<?php echo json_encode($address);?>;
weibotext=<?php echo json_encode($text);?>;
weibo_id=<?php echo json_encode($weibo_id);?>;
weibo_pic<?php echo json_encode($weibo_pic);?>;
create_at=<?php echo json_encode($create_at);?>;
gender=<?php echo json_encode($gender);?>;
weibo_pic=<?php echo json_encode($weibo_pic);?>;
person_image=<?php echo json_encode($person_image);?>;
namestr=<?php echo json_encode($name);?>;
var flag=0;
for(j=0;j<20;j++)   // 构造20个信息窗口及其对应地理位置，以供显示
{
   point[j]=new BMap.Point(longitude[j],latitude[j]);
   name=namestr[j];
   if(gender[j]=="m")
   {
    var sContent ="<h4 style='padding:0.2em 0;font-size:30px;font-family:微软雅黑;'class=\"btn btn-large btn-primary\">"+name+
"&nbsp"+
"<input type=\"image\"  name=\"male\" src=\"http://1.yokosoapp.sinaapp.com/male.png\" /> "+
"<p style='margin:0 0 0 2px;padding:0.2em 0;font-size:10px;'>"+address[j]+"</p>"+
"&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp "+
"<input type=\"image\"  name=\"comment\" src=\"http://1.yokosoapp.sinaapp.com/comment.png\" onclick=\"document.text.flag.value='1';document.text.submit()\"/> "+
"&nbsp "+
"<input type=\"image\"  name=\"zf\" src=\"http://1.yokosoapp.sinaapp.com/sign-out.png\" onclick=\"document.text.flag.value='2';document.text.submit()\"/>"+
"&nbsp "+
"<input type=\"image\"  name=\"sc\" src=\"http://1.yokosoapp.sinaapp.com/star.png\" onclick=\"document.text.flag.value='3';document.text.submit()\"/>"+
"&nbsp &nbsp &nbsp"+
"</h4>"+
"<div class=\"form-signin\">"+
"<img style='float:left;margin:22px 22px 22px 15px' id='imgDemo' class=\"btn \" src='"+person_image[j]+".jpg' width='80' height='80' title='头像'/>" + 
"&nbsp &nbsp"+
"<p style='font-size:14px;font-family:微软雅黑' >"+weibotext[j]+"</p>"+
"<p style='margin:15px'>"+
"<form name=\"text\" action=\"test.php\" method=\"post\">"+
"<textarea name=\"content\" id=\"content\" style=\"width: 330px;height: 50px\" > 你想说点什么？ </textarea>"+
"<input type=\"hidden\" name=\"weiboid\" value="+weibo_id[j]+"/>"+
"<input type=\"hidden\" name=\"flag\" value="+flag+"/>"+
"</form> "+
"</p>"+
"</div>";
   }
   
   else 
   {
   var sContent ="<h4 style='padding:0.2em 0;font-size:30px;font-family:微软雅黑;'class=\"btn btn-large btn-primary\">"+name+
"&nbsp"+
"<input type=\"image\"  name=\"male\" src=\"http://1.yokosoapp.sinaapp.com/female.png\" /> "+
"<p style='margin:0 0 0 2px;padding:0.2em 0;font-size:10px;'>"+address[j]+"</p>"+
"&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp "+
"<input type=\"image\"  name=\"comment\" src=\"http://1.yokosoapp.sinaapp.com/comment.png\" onclick=\"document.text.flag.value='1';document.text.submit()\"/> "+
"&nbsp "+
"<input type=\"image\"  name=\"zf\" src=\"http://1.yokosoapp.sinaapp.com/sign-out.png\" onclick=\"document.text.flag.value='2';document.text.submit()\"/>"+
"&nbsp "+
"<input type=\"image\"  name=\"sc\" src=\"http://1.yokosoapp.sinaapp.com/star.png\" onclick=\"document.text.flag.value='3';document.text.submit()\"/>"+
"&nbsp &nbsp &nbsp"+
"</h4>"+
"<div class=\"form-signin\">"+
"<img style='float:left;margin:22px 22px 22px 15px' id='imgDemo' class=\"btn \" src='"+person_image[j]+".jpg' width='80' height='80' title='头像'/>" + 
"&nbsp &nbsp"+
"<p style='font-size:14px;font-family:微软雅黑' >"+weibotext[j]+"</p>"+
"<p style='margin:15px'>"+
"<form name=\"text\" action=\"test.php\" method=\"post\">"+
"<textarea name=\"content\" id=\"content\" style=\"width: 330px;height: 50px\" > 你想说点什么？ </textarea>"+
"<input type=\"hidden\" name=\"weiboid\" value="+weibo_id[j]+"/>"+
"<input type=\"hidden\" name=\"flag\" value="+flag+" />"+
"</form> "+
"</p>"+
"</div>";
   }
   infoWindow[j]= new BMap.InfoWindow(sContent);
}

var ind = 0;
var timer = null; 


function show(){
    timer = setInterval(function(){
        if(ind == infoWindow.length){
            ind = 0;        //当轮播到最后一个信息窗口时，把计数器至为0
        }
        map.openInfoWindow(infoWindow[ind],point[ind]);
        var marker = new BMap.Marker(point[ind]);  // 创建标注
        var url;
        if(address[ind].indexOf("北京")>0)
        {
          url="http://1.yokosoapp.sinaapp.com/ICON/1.png";
        }
        else
        {
          url="http://1.yokosoapp.sinaapp.com/ICON/0.png";
        }
        var myIcon=new BMap.Icon(url,new BMap.Size(32,32));
        marker.setIcon(myIcon);
        map.addOverlay(marker);              // 将标注添加到地图中
        marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
        ind++;
    },6000);
}

function stop(){
   clearTimeout(timer);
}
show();

</script>

<?php
 $idtemp=$_POST['weiboid'];
 $id=substr($idtemp,0,strlen($idtemp)-1);
 $text=$_POST['content'];
 $flag=$_POST['flag'];
 if($flag==1)
 {
  $c->send_comment($id,$text);
 }
 else if($flag==2)
 {
  $c->repost($id,$text);
 }
 else if($flag==3)
 {
  $c->add_to_favorites($id);
 }
?>