<?php
    header("Cache-Control: private");
    session_cache_limiter('none');
    session_start();
    include_once(dirname(__FILE__).'/include.php');
    ChromePhp::log("session", $_SESSION);

    $_SESSION["rss_feed"] = $_POST["rss_feed"];
    $rssObj = new RSSParse($_POST["rss_feed"], $_SESSION["update"]);
    $_SESSION["rss_contents"] = "";
    $_SESSION["rss_contents"] = $rssObj->getXML();
    phpinfo();

    for($i=0; $i<count($rssObj->getXML()); $i++){
        ChromePhp::log($rssObj->getXML()[$i]);
    }
    ChromePhp::log(count($rssObj->getXML()));
    $_POST = array();
    // while(!$_SESSION["update"]){}
    // if($_SESSION["update"]){
    //     header("location: ../index.php");
    // }
?>