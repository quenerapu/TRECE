<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

  $database = new Database();
  $db = $database->getConnection();

  class Database {

    public function __construct() {
    }

    private $host     = "localhost";
    private $db_name  = "db_name";
    private $username = "db_username";
    private $password = "1234";

    public $conn;

    public function getConnection() {

      $this->conn = null;

      try {
        $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name.";charset=utf8",$this->username,$this->password
          , array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET SESSION group_concat_max_len=100000")
          );
        }

      catch(PDOException $exception) {
//      echo "<h3>Database error: ".$exception->getMessage().". Bye.</h3>"; die();
        echo "<h3>Database error. Bye.</h3>"; die();
        }

      unset($this->host,$this->db_name,$this->username,$this->password);
      return $this->conn;

      }

    }

?>
