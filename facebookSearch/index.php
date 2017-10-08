<?php
	$base_url = 'https://graph.facebook.com/v2.8/';
	$apikey = 'access_token=EAAGTWR16vgUBAEJLssIhZAsV3JaZB2qRmZC3iPUHZAPVMf6axyuSPTiJ6jWRmKvZBoW4BhTN83sm0RfHbEel1TkTPzgLmSJyYg6FpLZCoLV97EzFtDU2uUnJATWqEZC0xgwLCE4iuZCsYlTKenO0ruBX1pjK2NuqKOVyRWZCcmgkKvwZDZD';

	$ret = array();
	$ret2 = array();
	if(!empty($_GET)){
		if(isset($_GET['type'])){
			$type = $_GET['type'];
			if(isset($_GET['keyword'])) {
				$keyword = $_GET['keyword'];
				$url = $base_url;
				$url .= "search?q=";
				$url .= $keyword;
				$url .= "&type=";
				$url .= $type;
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
    				
    				if(count($ret) > 70){
    						break;
    				}
    			}
			}
		}


		if(isset($_GET['searchid'])){
			$sId = $_GET['searchid'];
			$url = $base_url;
			$url .= $sId;
			$url .= "?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name,picture}},posts.limit(5)&";
			$url .= $apikey;
			$json = file_get_contents($url);
			$res = json_decode($json, true);
    		$ret = $res["albums"]; 
    		$ret2 = $res["posts"];
    		foreach($ret2 as $element){
    			array_push($ret, $element);
    		}
    		
		}

	}
    header('Connection: keep-alive\r\n');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Origin:*');
    echo json_encode($ret);
?>