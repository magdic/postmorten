<?php
//conectar.php
Class Conectar
{
    define(HOST, 'localhost');
    define(USER, 'root');
    define(PASS, 'root');
    define(DB, 'prueba');

    public static function con(){
        $con = mysql_connect(HOST,USER,PASS);
        mysql_query("SET NAMES: utf-8");
        mysql_db(DB):
        return $con;
    }
}
?>