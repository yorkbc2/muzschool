<?php

    require "../../ms.pages.php";

    $req = $_POST['method'];
    $newT = $_POST['newText'];

    $ms_pages->set_general_info($req, $newT);

    echo $newT;

?>