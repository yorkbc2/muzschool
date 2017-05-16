<?php

    require "../../ms.pages.php";

    $method = $_POST['req'];

    if($method == "change_website_info") {
    	$req = $_POST['method'];
	    $newT = $_POST['newText'];

	    $ms_pages->set_general_info($req, $newT);

	    echo $newT;
    }
    else if($method == "change_content_quotes") {

    	$quote = $_POST['quotes'];

    }

    else if ($method == "change_content_fulldesc") {

    	$desc = $_POST['fullDescription'];

    	$ms_pages->set_fullDescription($desc);

    	return $desc;

    }

    

?>