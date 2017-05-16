<?php

    require "../ms.php";

    $info = array(
        "title" => $ms->get_title(),
        "description" => $ms->get_title(),
        "keywords" => $ms->get_keywords()
    );

    $content = array(
    	"quotes" => $ms->get_quotes(),
    	"fullDescription" => $ms->get_fullDescription()
    ); 

    $full_info = array(
        "website" => $info,
        "content" => $content
    );

    echo json_encode($full_info, true);

?>