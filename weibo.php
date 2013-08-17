<?php 
$ms  = $c->home_timeline(1,50,0,0,0,1); 
$item=$ms['statuses'];

for($i=0;$i<20;$i++)
  {
     $address[$i]=$item[$i]['user']['location'];
     $locate=$c->located_users($address[$i]);
     if($locate['error_code']==21903)
     {
        if(preg_match ("/日本/i",$address[$i]))
        {
          $longitude[$i]=139.49;
          $latitude[$i]=35.39;
        }
        else if(preg_match ("/美国/i",$address[$i]))
        {
          $longitude[$i]=274.00;
          $latitude[$i]=40.43;
        }
        else if(preg_match ("/香港/i",$address[$i]))
        {
          $longitude[$i]=114.10000;
          $latitude[$i]=22.20000;
        }
        else if(preg_match ("/英国/i",$address[$i]))
        {
          $longitude[$i]=0.741;
          $latitude[$i]=51.3028;
        }
        else if(preg_match ("/其他/i",$address[$i]))
        {
          $longitude[$i]=116.3;
          $latitude[$i]=39.9;
        }
        else if(preg_match ("/澳门/i",$address[$i]))
        {
          $longitude[$i]=113.35;
          $latitude[$i]=22.14;
        }
        else if(preg_match ("/泰国/i",$address[$i]))
        {
          $longitude[$i]=100.31;
          $latitude[$i]=13.45;
        }
     }
     else
     {
      $longitude[$i]=$locate['geos']['0']['longitude'];
      $latitude[$i]=$locate['geos']['0']['latitude'];
     }
     $text[$i]=$item[$i]['text'];
     $weibo_id[$i]=$item[$i]['id'];
     $name[$i]=$item[$i]['user']['name'];
     $create_at[$i]=$item[$i]['user']['created_at'];
     $gender[$i]=$item[$i]['user']['gender'];
     $weibo_pic[$i]=$item[$i]['bmiddle_pic'];
     $person_image[$i]=$item[$i]['user']['profile_image_url'];
     
  }
?>



