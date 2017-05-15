<?php


    $id = $_POST['id'];
    $link = $_POST['link'];

    require "../../../ms.pages.php";

    $res = $ms_pages->remove_page($id, $link);

    if($res == true) {
        echo true;
    }
    else {
        echo false;
    }

?>