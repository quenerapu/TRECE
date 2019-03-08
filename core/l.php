<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php

class SignIn { # Ref: http://codereview.stackexchange.com/questions/58609/php-oop-login-class

  private $conn;
  private $tablename;
  private $tableletter;
  private $hierarchy_tablename;
  private $hierarchy_tableletter;
  private $log_tablename;
  private $log_tableletter;

  private $password = null;
  private $email_or_username = null;
  private $signed_in = false;



# -----------------------------------------------------------------------------------



  public function __construct($db,$tablename,$hierarchy_tablename,$log_tablename) {

    $this->conn = $db;
    $this->tablename = explode("|",$tablename);
    $this->tableletter = $this->tablename[1];
    $this->tablename = $this->tablename[0];
    $this->hierarchy_tablename = explode("|",$hierarchy_tablename);
    $this->hierarchy_tableletter = $this->hierarchy_tablename[1];
    $this->hierarchy_tablename = $this->hierarchy_tablename[0];
    $this->log_tablename = explode("|",$log_tablename);
    $this->log_tableletter = $this->log_tablename[1];
    $this->log_tablename = $this->log_tablename[0];
    $this->doStartSession();
    $this->performUserSignInAction();
    unset(
      $this->tablename,
      $this->tableletter,
      $this->tablename,
      $this->hierarchy_tablename,
      $this->hierarchy_tableletter,
      $this->hierarchy_tablename,
      $this->log_tablename,
      $this->log_tableletter,
      $this->log_tablename,
      $this->email_or_username,
      $this->password
    );

    }



# -----------------------------------------------------------------------------------



  private function doStartSession() {

    ini_set("session.cache_limiter","public");
    ini_set("session.cookie_httponly",1);
    ini_set("session.cookie_lifetime",0);
    ini_set("session.entropy_file","/dev/urandom");
    ini_set("session.hash_function","whirlpool"); //is whirlpool that necessary?
    ini_set("session.use_only_cookies",1);
    ini_set("session.entropy_length",512);
    ini_set("session.use_trans_sid",0);
    ini_set("session.hash_bits_per_character",6);
    ini_set("session.cookie_secure",1);
    session_cache_limiter(false);
    session_start();
//  session_regenerate_id(true);
      # Desactivado porque provoca caídas al hacer F5 si se está conectado vía wifi
      # WTF http://php.net/manual/en/function.session-regenerate-id.php
      # YES: THIS. PART. CAN. BE. DONE. BETTER. ;-)
      # Learn more at
      # - http://forums.devshed.com/php-faqs-stickies/953373-php-sessions-secure-post2921620.html
      # - https://www.tarlogic.com/blog/como-generar-sesiones-en-php-de-forma-segura/

    }



# -----------------------------------------------------------------------------------



  private function performUserSignInAction() {

    if(!empty($_SESSION["signed_in"])) :
      if(isset($_GET["signout"])) : $this->doSignOut();
      else : $this->doSignInWithSessionData();
      endif;
    elseif(isset($_POST["signin"])) : $this->doSignInWithPostData();
    else :
    endif;

    }



# -----------------------------------------------------------------------------------



  public function getUserSignInStatus() { return $this->signed_in; }
  public function getUserName()         { return $this->getUserSignInStatus()?$_SESSION["name"]:""; }
  public function getUserUsername()     { return $this->getUserSignInStatus()?$_SESSION["username"]:""; }
  public function getUserHierarchy()    { return $this->getUserSignInStatus()?$_SESSION["hierarchy"]:""; }
  public function getUserPrivileges()   { return $this->getUserSignInStatus()?$_SESSION["privileges"]:""; }
  public function getUserRef()          { return $this->getUserSignInStatus()?$_SESSION["ref"]:""; }
  public function getUserID()           { return $this->getUserSignInStatus()?$_SESSION["id"]:""; }
  public function getUserGender()       { return $this->getUserSignInStatus()?$_SESSION["gender"]:""; }



# -----------------------------------------------------------------------------------



  private function doSignInWithSessionData() {

    $this->signed_in = false;
    if(!$this->checkSignInStatus()) : $this->doSignOut(); die(); endif;
    $this->signed_in = true;

    }



# -----------------------------------------------------------------------------------



  private function doSignInWithPostData() {

    if ($this->checkSignInFormDataNotEmpty()) :
      if ($this->checkPasswordCorrectnessAndSignIn()) :
      endif;
    endif;

    }



# -----------------------------------------------------------------------------------



  private function checkSignInFormDataNotEmpty() {

    if (!empty($_POST["email_or_username"]) && !empty($_POST["password"])) :
      $this->email_or_username = htmlspecialchars(strtolower(preg_replace("/\s/","",$_POST["email_or_username"])));
      $this->password = $_POST["password"];
      return true;
    endif;

    return false;

    }



# -----------------------------------------------------------------------------------



  private function checkSignInStatus() {

    $query = "SELECT ".$this->tableletter.".`signed_in` FROM `".$this->tablename."` ".$this->tableletter." WHERE ".$this->tableletter.".`id`=:id AND ".$this->tableletter.".`signed_in`=1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $_SESSION["id"]);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num>0) : return true; endif;
    return false;

    }



# -----------------------------------------------------------------------------------



  private function checkPasswordCorrectnessAndSignIn() {

    $query = "SELECT " .
             $this->tableletter.".`id`, " .
             $this->tableletter.".`ref`, " .
             $this->tableletter.".`uhierarchy`, " .
             $this->tableletter.".`name`, " .
             $this->tableletter.".`username`, " .
             $this->tableletter.".`hash_pass`, " .
             $this->tableletter.".`ugender`, " .
             "CONCAT((SELECT ".$this->hierarchy_tableletter.".`ids_privileges` FROM ".$this->hierarchy_tablename." ".$this->hierarchy_tableletter." WHERE ".$this->hierarchy_tableletter.".`id` = ".$this->tableletter.".`uhierarchy`)) AS privileges " .
             "FROM `".$this->tablename."` ".$this->tableletter." " .
             "WHERE ".$this->tableletter.".`id_status` = 1 " .
             (!empty($_SESSION["signed_in"])?"AND ".$this->tableletter.".`signed_in` = 0 ":"") .
             "AND (BINARY ".$this->tableletter.".`email` = :email_or_username OR BINARY ".$this->tableletter.".`username` = :email_or_username) " .
             "LIMIT 0,1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":email_or_username", $this->email_or_username);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num>0) :


      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if(isset($row["hash_pass"]) && password_verify($this->password,$row["hash_pass"])) :

        $query = "UPDATE `".$this->tablename."` ".$this->tableletter." SET ".$this->tableletter.".`signed_in` = 1 WHERE ".$this->tableletter.".`id` = ".($row["id"])."";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $query = "INSERT INTO `".$this->log_tablename."` (`id_user`,`action`,`date`,`ip`) VALUES (:id_user,'sign in',now(),:ip)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_user", $row["id"]);
        $stmt->bindParam(":ip", $_SERVER["REMOTE_ADDR"]);
        $stmt->execute();

        $_SESSION["signed_in"]      =   1; $this->signed_in = true;
        $_SESSION["id"]             =   $row["id"];
        $_SESSION["ref"]            =   $row["ref"];
        $_SESSION["name"]           =   $row["name"];
        $_SESSION["username"]       =   $row["username"];
        $_SESSION["gender"]         =   $row["ugender"];
        $_SESSION["hierarchy"]      =   $row["uhierarchy"];
        $_SESSION["privileges"]     =   $row["privileges"];

        return true;

      endif;

      return false;

    endif;

    return false;

    }



# -----------------------------------------------------------------------------------



  public function doSignOut() {

    $query = "UPDATE `".$this->tablename."` ".$this->tableletter." SET ".$this->tableletter.".`signed_in` = 0 WHERE ".$this->tableletter.".`id` = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $_SESSION["id"]);
    $stmt->execute();

    $query = "INSERT INTO `".$this->log_tablename."` (`id_user`,`action`,`date`,`ip`) VALUES (:id_user,'sign out',now(),:ip)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id_user", $_SESSION["id"]);
    $stmt->bindParam(":ip", $_SERVER["REMOTE_ADDR"]);
    $stmt->execute();

    $url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    $url = preg_replace("/\?.*/","",$url);
    $_SESSION = array();
    session_destroy();
    $this->signed_in = false;
    header("refresh:0;url=".$url);
    die();

    }



  }
