<?php
    class Constant{
        public static $RSS_URL = [
            "主要" => "http://news.livedoor.com/topics/rss/top.xml",
            "国内" => "http://news.livedoor.com/topics/rss/dom.xml",
            "海外" => "http://news.livedoor.com/topics/rss/int.xml",
            "IT 経済" => "http://news.livedoor.com/topics/rss/eco.xml",
            "芸能" => "http://news.livedoor.com/topics/rss/ent.xml",
            "スポーツ" => "http://news.livedoor.com/topics/rss/spo.xml",
            "映画" => "http://news.livedoor.com/rss/summary/52.xml",
            "グルメ" => "http://news.livedoor.com/topics/rss/gourmet.xml",
            "女子" => "http://news.livedoor.com/topics/rss/love.xml",
            "トレンド" => "http://news.livedoor.com/topics/rss/trend.xml",
        ];
        public static $DATABASE_HOME = [
            'drivername'=> 'pgsql',
            'host'=> 'localhost',
            'port'=> '5432',
            'username'=> 'ryosoga',
            'password'=> '',
            'database'=> 'rss_db',
        ];
        public static $DATABASE = [
            'drivername'=> 'pgsql',
            'host'=>'ec2-54-204-20-209.compute-1.amazonaws.com';
            'port'=> '5432',
            'username'=> 'gpixdcxyqfcsaf',
            'password'=> 'z7lI3oCpJPTugtxmllUTfzRvzv',
            'database'=> 'd63tau1u4liabm',
        ];
        public static $TABLE = [
            'article' => [
                'article_id' => 'int primary key',
                'title' => 'character varying',
                'description' => 'character varying',
                'link' => 'character varying',
                'related_articles' => 'character varying',
            ],
        ];
    }
?>
