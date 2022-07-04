<?php
include 'org.hessian/repo/JDBC.php';
include "org.hessian/model/Author.php";
class AuthorRepo
{

    public  static function getNextId()  {
        $connection = JDBC::getConnection();
        $query = "SELECT MAX(A.\"authorId\") as maxId FROM \"Author\" A";
        $result = pg_exec($connection, $query);
        return pg_fetch_result($result, 0, "maxId") + 1;

    }


    public static function getAllAuthors()  {
        error_log(print_r("Getting all authors", true));
        $connection = JDBC::getConnection();
        $query = "select \"authorId\" as authorId,name,age from \"Author\"";
        $result = pg_exec($connection, $query);
        $authors = [];

        for ($row = 0; $row < pg_num_rows($result); $row++) {
            $id = intval(pg_fetch_result($result, $row, "authorId"));
            $name = pg_fetch_result($result, $row, "name");
            $age = intval(pg_fetch_result($result, $row, "age"));
            $author = new Author($id, $name, $age);
            $authors[] = $author;
        }
        pg_close($connection);
        return $authors;

    }
//
    public static function getAuthorById($id)  {
        $connection = JDBC::getConnection();
        $query = "select \"authorId\" as authorId,name,age from \"Author\" where \"authorId\" = ".$id;
        $result = pg_exec($connection, $query);

        $id = intval(pg_fetch_result($result, 0, "authorId"));
        $name = pg_fetch_result($result, 0, "name");
        $age = intval(pg_fetch_result($result, 0, "age"));
        return new Author($id, $name, $age);


    }

    public static function getAuthorsBySearch($keyword)  {
        error_log(print_r("Keyword is".$keyword, true));
        $connection = JDBC::getConnection();
        $like = "'%".$keyword."%'";
        $query = "select \"authorId\" as authorId,name,age from \"Author\" where name like ".$like;
        $result = pg_exec($connection, $query);
        $authors = [];

        if (empty($keyword)) {

            return AuthorRepo::getAllAuthors();
        }

        for ($row = 0; $row < pg_num_rows($result); $row++) {

            $id = intval(pg_fetch_result($result, $row, "authorId"));
            $name = pg_fetch_result($result, $row, "name");
            $age = intval(pg_fetch_result($result, $row, "age"));
            $author = new Author($id, $name, $age);
            $authors[] = $author;
        }
        pg_close($connection);

        return $authors;
    }

    public static function addAuthor($name, $age) {
        $connection = JDBC::getConnection();
        $id = AuthorRepo::getNextId();
        $values = "('".$id."','".$name."','".$age."')";
        $query = "insert into \"Author\" (\"authorId\",name,age) values".$values;
        $result = pg_exec($connection, $query) or die("Could not add Author");

    }

    public static function deleteAuthor($id) {
        $connection = JDBC::getConnection();
        $query = "delete from \"Author\" where \"authorId\" = ".$id;
        $result = pg_exec($connection, $query) or die("Could not delete Author");
    }

    public static function editAuthor($id, $name, $age)  {
        $connection = JDBC::getConnection();
        $query = "UPDATE \"Author\" set \"name\"='".$name. "', \"age\" = ".$age." where \"authorId\" =  ".$id;
        $result = pg_exec($connection, $query) or die("Could not edit Author");

    }

}