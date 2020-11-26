<?php


class db_connection
{
    private $conn;

    public function __construct()
    {

        global $conn;
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db_name = "nerdygadgets";

        $this->conn = mysqli_connect($servername, $username, $password);

        mysqli_select_db($this->conn, $db_name);
    }

    public function call_db()
    {
        return $this->conn;
    }

    public function get_date()
    {
        return date('Y-m-d');
    }

    public function query($query)
    {
        return mysqli_query($this->call_db(), $query);

    }

}
