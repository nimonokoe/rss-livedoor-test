<?php
include_once(dirname(__FILE__).'/include.php');

class RSSParse{
    private $xml;
    private $up_flg;
    private $connection;
    function __construct($str, &$update){
        $this->xml = new SimpleXMLElement(json_decode(json_encode(file_get_contents(Constant::$RSS_URL[$str]))));
        ChromePhp::log($this->xml->channel->item[0]);
        $article_id = explode("/",(string)$this->xml->channel->item[0]->link);
        ChromePhp::log((int)$article_id[count($article_id)-2]);

        ChromePhp::log(BingSearch::searchKeyWord('Microsoft', 3));
        $dbm = new DBMapper();
        ChromePhp::log($dbm->resetTable('article'));
        $dbm->insertRecord('article', [(int)$article_id[count($article_id)-2], 'a', 'a', 'a']);

        $this->up_flg = &$update;
        $this->up_flg = false;

    }
    function getXML(){
        $this->up_flg = true;
        return $this->xml->channel->item;
    }
}
?>