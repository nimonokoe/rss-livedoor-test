<?php
    header("Cache-Control: private");
    session_cache_limiter('none');
    session_start();
    include_once(dirname(__FILE__).'/include.php');
    ChromePhp::log("session", $_SESSION);
    $_SESSION["update"]=true;

    $_SESSION["rss_feed"] = $_POST["rss_feed"];
    $_SESSION["rss_contents"] = file_get_contents(Constant::$RSS_URL[$_POST["rss_feed"]]);
    $_POST = array();
    while(!$_SESSION["update"]){}
    if($_SESSION["update"]){
        header("location: ../index.php");
    }
?>