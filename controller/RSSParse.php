<?php
class RSSParse{
    private $xml;
    private $up_flg;
    function __construct($str, &$update){
        $this->xml = new SimpleXMLElement(json_decode(json_encode(file_get_contents(Constant::$RSS_URL[$str]))));
        ChromePhp::log(count($this->xml->channel->item));
        $this->up_flg = &$update;
        $this->up_flg = false;
    }
    function getXML(){
        $this->up_flg = true;
        return count($this->xml->channel->item);
    }
}
?>