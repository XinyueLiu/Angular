<?php
	$base_url = 'https://graph.facebook.com/v2.8/';
	$apikey = 'access_token=EAATMMqhZADYcBAIckCxYgG1nzjkN5WSKovkAo5CHSbqOQA8BHNhdKOU0XSjS02P4vYO2q1MxfUpw1a0VRvsL67dlMhS669iZAXI761IhdZAUAxmDEcyU7s7lIcBXrkyUFEGRRZCCxhZCINgGR7X5zCNHlPUr7ZBk0ZD';

	$ret = array();
	$ret2 = array();
	
			
				$url = $base_url;
				$url .= "search?q=";
				$url .= "spaceX";
				$url .= "&type=";
				$url .= "user";
				$url .= "&fields=id,name,picture.width(700).height(700)&";
				$url .= $apikey;
				$json = file_get_contents($url);
    			$res = json_decode($json, true);
    			$ret = $res["data"];
    			while($res["paging"] != null && $res["paging"]["next"] != null){
    				$json = file_get_contents($res["paging"]["next"]);
    				$res = json_decode($json, true);
    				$tmp = $res["data"];
    				foreach($tmp as $element){
    					array_push($ret, $element);
    				}
    			}

    			echo json_encode($ret);
			


		

	
    // header('Connection: keep-alive\r\n');
    // header('Content-Type:application/json');
    // header('Access-Control-Allow-Origin:*');
    //echo json_encode($ret);
?>