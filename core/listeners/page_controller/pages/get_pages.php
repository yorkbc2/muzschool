<?php

    require "../../../ms.pages.php";

    $pages = $ms_pages->get_pages();

    echo json_encode($pages, true);

?>