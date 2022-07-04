<?php

class JDBC
{
    public static function getConnection() {

        $host = "host=ec2-52-200-215-149.compute-1.amazonaws.com ";
        $db= "dbname=ds75uhlqkbe92 ";
        $user = "user=nbwavzyshzkuiy ";
        $password = "password=5ce75fe8818ecb2e397d77d0749ef05d630b38c732e7cbfb6eeaf7eba775a90f";

        return pg_connect($host . $db . $user . $password);
    }

}