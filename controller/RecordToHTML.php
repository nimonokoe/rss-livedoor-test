<?php
class RecordToHTML{
    public static function echoHTML($obj){
        $obj = $obj[0];

        $title = '<h2>'.$obj['title'].'</h2>';
        $desp = '<p>'.$obj['description'].'</p>';
        $related_articles = '<div class="row thumbnail">';
        foreach(json_decode($obj['related_articles'], true) as $art){
            $related_article = '<div class="col-md-4">';
            $related_article .= '<h4><a href="'.$art['url'].'">'.$art['title'].'</a></h4>';
            $related_article .= '<p>'.$art['description'].'</p>';
            $related_article .= '</div>';
            $related_articles .= $related_article;
        }
        $related_articles .= '</div><hr>';
        return $title.$desp.$related_articles;
    }
}
?>
