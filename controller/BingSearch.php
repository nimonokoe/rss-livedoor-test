<?php
class BingSearch{
    private static $account_key = 'UabvFzk4ZzGrMIYq6JOlWVajuajnI7MRRHY1p8UagNg';

    private static function getQueryUrl($query, $size){
        return sprintf("https://api.datamarket.azure.com/Bing/Search/Web?Query='%s'&\$format=json&\$top=%d", urlencode(sprintf("'{%s}'", $query)), $size);
    }

    private static function getResult($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT,true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_USERPWD, self::$account_key . ":" . self::$account_key);
        $json = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($json);
        if(json_last_error() == JSON_ERROR_NONE)return $data->d->results;
        else return null;
    }

    public static function searchKeyWord($word, $size){
        return BingSearch::getResult(BingSearch::getQueryUrl($word, $size), $size);
    }

}
?>