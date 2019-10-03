<?php 

    $url =$_POST['url'];
    $curl = curl_init();    
    for($is=0;$is<10;$is++){
    curl_setopt_array($curl, array(    
      CURLOPT_URL => "https://tool.instagrampanel.co.id/instagram-service.php",    
      CURLOPT_HEADER => 0,    
      CURLOPT_VERBOSE => 1,    
      CURLOPT_AUTOREFERER => false,    
      CURLOPT_RETURNTRANSFER => true,    
      CURLOPT_MAXREDIRS => 10,    
      CURLOPT_TIMEOUT => 30,    
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,    
      CURLOPT_CUSTOMREQUEST => "POST",    
      CURLOPT_POSTFIELDS => "url=".$url   
    ));    
    }
    $response = curl_exec($curl);    
    $err = curl_error($curl);    
    curl_close($curl);    
    if ($err) {    
      echo "cURL Error #:" . $err;    
    } else {    
      echo $response;    
    }

?>