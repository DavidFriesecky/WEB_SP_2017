<?php
session_start();

include("model/settings.inc.php");

if(isset($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<count($web_pages)){
    $pageId = $_GET["page"];
} else {
    $pageId = 0;
}

include($web_file . $web_pages[$pageId] . $web_pagesExtension);
$con = new $web_classes[$pageId];
echo $con->getResult();

?>