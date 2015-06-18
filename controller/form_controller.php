<?php
    header("Cache-Control: private");
    session_cache_limiter('none');
    session_start();
    include_once(dirname(__FILE__).'/include.php');
    ChromePhp::log("session", $_SESSION);



    $_SESSION["rss_feed"] = $_POST["rss_feed"];
    $rssObj = new RSSParse($_POST["rss_feed"], $val, $max);
    $_SESSION["rss_contents"] = "";
    $_SESSION["rss_contents"] = $rssObj->getContents();
    $_POST = array();
    ChromePhp::log($max);
    $last_val = $val;
    while($val != $max){}
    header("location: ../index.php");
?>