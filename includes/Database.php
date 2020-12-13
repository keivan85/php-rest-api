<?php
define('HOST', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'restapi_tuts');

//Class Database starts

class Database
{
    //initiate the private variables
    private $connection;

    public function __construct()
    {
        $this->open_db_connection();
    }

    //Opening the connection
    public function open_db_connection()
    {
        $this->connection = mysqli_connect(HOST, USER_NAME, PASSWORD, DB_NAME);

        if (mysqli_connect_error()) {
            die('Connection error' . mysqli_connect_error());
        }
    }

    //Make sql query
    public function query($sql)
    {

        $result = $this->connection->query($sql);

        if (!$result) {
            die('query failed' . $sql);
        }

        return $result;
    }

    //Function to fetch array
    public function fetch_array($result)
    {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultarray[] = $row;
            }
            return $resultarray;
        }
    }

    //Ftech a row
    public function fetch_row($result)
    {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    //method for filtering input and output
    public function escape_value($value)
    {
        $value = $this->connection->real_escape_string($value);
        return $value;
    }

    //Close sql connection
    public function close_connection()
    {
        $this->connection->close();
    }
}
//Class Database ends


//Instantiate the Database Class
$database = new Database();
