<?php
    include_once(dirname(__FILE__).'/../lib/chromephp/ChromePhp.php');
    include_once(dirname(__FILE__).'/constant.php');
    ChromePhp::log("test");
    foreach (Constant::$RSS_URL as $key => $value) {
        ChromePhp::log($key, $value);
    }
?>