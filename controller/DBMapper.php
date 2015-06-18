<?php
class DBMapper{
    private $connection;
    private $result;
    function __construct(){
        $link = 'dbname='.Constant::$DATABASE['database'].' host='.Constant::$DATABASE['host'].' port='.Constant::$DATABASE['port'].' user='.Constant::$DATABASE['username'].' password='.Constant::$DATABASE['password'];
        $this->connection = pg_connect($link);
        if (!$this->connection) {
           ChromePhp::log(pg_last_error());
           die();
        }
    }

    public function searchByField($dbname, $fname, $key){
        return pg_fetch_all(pg_query($this->connection, 'SELECT * FROM '.$dbname.' where '.$fname.' = '.$key.';'));
    }

    public function insertRecord($table_name, $data){
        $data_query='';
        foreach($data as $val){
            $v = $val;
            if(gettype($val) == 'string')$v="'".$v."'";
            $data_query .= $v.',';
        }
        $data_query = substr($data_query, 0, -1);
        try{
            $this->result = pg_query($this->connection, 'INSERT INTO '.$table_name.' values('.$data_query.');');
            if($this->result) throw new Exception (pg_last_error($this->connection));
        }catch(Exception $e){
            // ChromePhp::log("error", $e);
        }
    }

    public function resetTable($table_name){
        $this->dropTable($table_name);
        $this->createTable($table_name);
    }

    public function createTable($table_name){
        pg_query($this->connection, 'CREATE TABLE '.$this->getTableQuery($table_name).';');
    }

    public function dropTable($table_name){
        pg_query($this->connection, 'DROP TABLE '.$table_name);
    }

    private function getTableQuery($table_name){
        $res = $table_name.'(';
        foreach(Constant::$TABLE[$table_name] as $key => $val){
            $res .= $key.' '.$val.',';
        }
        $res = substr($res, 0, -1);
        $res .= ')';
        return $res;
    }

    public function getTableNames(){
        $row = pg_fetch_all(pg_query($this->connection, 'SELECT relname AS table_name FROM pg_stat_user_tables'));
        if(!$row){
           ChromePhp::log(pg_last_error());
        }else{
            ChromePhp::log("row", count($row));
            foreach($row as $d){
                ChromePhp::log($d);
            }
        }
    }
}
?>