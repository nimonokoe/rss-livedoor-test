<?php
include_once(dirname(__FILE__).'/include.php');

class RSSParse{
    private $xml;
    private $prog;
    private $max;
    private $dbm;
    private $item;
    function __construct($str, &$progress, &$max){
        $this->xml = new SimpleXMLElement(json_decode(json_encode(file_get_contents(Constant::$RSS_URL[$str]))));
        $this->item = $this->xml->channel->item;

        $this->dbm = new DBMapper();
        // $this->dbm->resetTable('article');
        $contents = [];
        $this->prog = &$progress;
        $this->max = &$max;
        $this->prog = 0;
        $this->max = count($this->item);
    }
    public function getContents(){
        foreach($this->item as $val){
            $this->getArticle($val);
            $contents[$this->parseLinkToId((string)$val->link)] = true;
            $this->prog++;
        }
        $this->up_flg = true;
        return json_encode($contents);
    }

    private function getArticle($item){
        $data = $this->dbm->searchByField('article', 'article_id', $this->parseLinkToId((string)$item->link));
        if(!$data){
            ChromePhp::log("data not existed.");
            return $this->addArticleRecord($item);
        }
    }

    private function addArticleRecord($item){
        $this->dbm->insertRecord('article', [$this->parseLinkToId((string)$item->link),
            (string)$item->title,
            (string)$item->description,
            (string)$item->link,
            $this->getRelatedArticles($item)]);
        return $this->dbm->searchByField('article', 'article_id', $this->parseLinkToId((string)$item->link));
    }

    private function parseLinkToId($url){
        $article_id = explode("/",$url);
        return (int)$article_id[count($article_id)-2];
    }

    private function getRelatedArticles($item){
        preg_match_all('/[一-龠]+/u', (string)$item->title, $key_kanji);
        preg_match_all('/[ァ-ヴー]+/u', (string)$item->title, $key_katakana);
        $search_key = ((count($key_kanji[0])!=0)?$key_kanji[0][0]:'').' '.((count($key_katakana[0])!=0)?$key_katakana[0][0]:'');
        $res = BingSearch::searchKeyWord((string)$item->title, 3);
        $json_res = array();
        $i=0;
        foreach($res as $val){
            $json_res[$i] = [
                'title' => $val->Title,
                'url' => $val->Url,
                'description' => $val->Description,
            ];
            $i++;
        }
        return json_encode($json_res);
    }
}
?>