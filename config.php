<?php


class Connect extends PDO
{
    public function __construct()
    {
        $dbhost = "localhost";
        $dbname = "api";
        $dbuser = "root";
        $dbpass = "";

        parent::__construct("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));

        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}

?>