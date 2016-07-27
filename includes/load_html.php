<?php
	if (isset($_SERVER['HTTP_ORIGIN']) && $_SERVER['HTTP_ORIGIN'] == 'http://so.mprds.org') {
	    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	    header('Access-Control-Allow-Credentials: true');
	    header('Access-Control-Max-Age: 86400');    // cache for 1 day
	}
	if(!$_GET['page']) die("0");
	$page = (string)$_GET['page'];

	//sp.mprds.org domain
	if($_GET['host']){
		$host = $_GET['host'];
		if($host != 'sp.mprds.org') die("0");
		if($page[0] == "/"){
			$file_contents = file_get_contents('../spanish/index.html');
			$page = preg_replace('/^.*[\\/]/', '', $page);
			$file_contents = str_replace('data-html="home"', 'data-html="'.$page.'"', $file_contents);
			echo $file_contents;
			//echo file_get_contents('../index.html');
		}
		else if(file_exists('../spanish/static/html/'.$page.'.html'))
			echo file_get_contents('../spanish/static/html/'.$page.'.html');
		else echo file_get_contents('../spanish/static/html/under_construction.html');
	}

	//mprds.org domain
	if($page[0] == "/"){
		$file_contents = file_get_contents('../index.html');
		$page = preg_replace('/^.*[\\/]/', '', $page);
		$file_contents = str_replace('data-html="home"', 'data-html="'.$page.'"', $file_contents);
		echo $file_contents;
		//echo file_get_contents('../index.html');
	}
	else if(file_exists('../static/html/'.$page.'.html'))
		echo file_get_contents('../static/html/'.$page.'.html');
	else echo file_get_contents('../static/html/under_construction.html');
?>
