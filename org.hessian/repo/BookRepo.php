<?php
include 'org.hessian/model/Book.php';
class BookRepo
{

    public  static function getNextId()  {
        $connection = JDBC::getConnection();
        $query = "SELECT MAX(B.\"bookId\") as maxId FROM \"Book\" B";
        $result = pg_exec($connection, $query);
        return pg_fetch_result($result, 0, "maxId") + 1;

    }


    public static function getAllBooks()  {
        error_log(print_r("Getting all books", true));
        $connection = JDBC::getConnection();
        $query = "select \"bookId\" as bookId,title,description,year, \"authorId\" as authorId from \"Book\"";
        $result = pg_exec($connection, $query);
        $books = [];

        for ($row = 0; $row < pg_num_rows($result); $row++) {
            $id = intval(pg_fetch_result($result, $row, "bookId"));
            $title = pg_fetch_result($result, $row, "title");
            $description = pg_fetch_result($result, $row, "description");
            $year = intval(pg_fetch_result($result, $row, "year"));
            $authorId = intval(pg_fetch_result($result, $row, "authorId"));
            $book = new Book($id, $title, $description, $year, $authorId);
            $books[] = $book;
        }
        pg_close($connection);
        return $books;

    }
//
    public static function getBookById($id)  {
        $connection = JDBC::getConnection();
        $query = "select \"bookId\" as bookId,title,description,year, \"authorId\" as authorId from \"Book\" where \"bookId\" = ".$id;
        $result = pg_exec($connection, $query);

        $id = intval(pg_fetch_result($result, 0, "bookId"));
        $title = pg_fetch_result($result, 0, "title");
        $description = pg_fetch_result($result, 0, "description");
        $year = intval(pg_fetch_result($result, 0, "year"));
        $authorId = intval(pg_fetch_result($result, 0, "authorId"));
        return new Book($id, $title, $description, $year, $authorId);


    }

    public static function getBooksBySearch($keyword)  {
        error_log(print_r("Keyword is".$keyword, true));
        $connection = JDBC::getConnection();
        $like = "'%".$keyword."%'";
        $query = "select \"bookId\" as bookId,title,description,year, \"authorId\" as authorId from \"Book\" where title like ".$like;
        $result = pg_exec($connection, $query);
        $books = [];

        if (empty($keyword)) {

            return BookRepo::getAllBooks();
        }

        for ($row = 0; $row < pg_num_rows($result); $row++) {

            $id = intval(pg_fetch_result($result, $row, "bookId"));
            $title = pg_fetch_result($result, $row, "title");
            $description = pg_fetch_result($result, $row, "description");
            $year = intval(pg_fetch_result($result, $row, "year"));
            $authorId = intval(pg_fetch_result($result, $row, "authorId"));
            $book = new Book($id, $title, $description, $year, $authorId);
            $books[] = $book;
        }
        pg_close($connection);

        return $books;
    }

    public static function addBook($title, $description, $year, $authorId) {
        $connection = JDBC::getConnection();
        $id = BookRepo::getNextId();
        $values = "('".$id."','".$title."','".$description."','".$year."','".$authorId."')";
        error_log("Values".$values);
        $query = "insert into \"Book\" (\"bookId\",title,description,year,\"authorId\") values".$values;
        error_log(print_r($query, true));
        try{
            $result = pg_exec($connection, $query) or die("Could not add Book");
        }catch (Exception $e) {
            error_log(print_r($e->getMessage(), true));
        }


    }

    public static function deleteBook($id) {
        $connection = JDBC::getConnection();
        $query = "delete from \"Book\" where \"bookId\" = ".$id;
        $result = pg_exec($connection, $query) or die("Could not delete Book");
    }

    public static function editBook($id, $title, $description, $year, $authorId)  {
        $connection = JDBC::getConnection();
        $query = "UPDATE \"Book\" set \"title\"='".$title. "', \"description\"= '".$description. "', \"year\" = '".$year."', \"authorId\"='".$authorId."' where \"bookId\" =  ".$id;
        try{
            $result = pg_exec($connection, $query) or die("Could not add Book");
        }catch (Exception $e) {
            error_log(print_r($query, true));
            error_log(print_r($e->getMessage(), true));
        }

    }
}