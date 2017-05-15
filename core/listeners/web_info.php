<?php

    require "../ms.php";

    $info = array(
        "title" => $ms->get_title(),
        "description" => $ms->get_title(),
        "keywords" => $ms->get_keywords()
    );

    echo json_encode($info, true);

?>