<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//USERS

# ..................................................
# ..##.....##..######..########.########...######...
# ..##.....##.##....##.##.......##.....##.##....##..
# ..##.....##.##.......##.......##.....##.##........
# ..##.....##..######..######...########...######...
# ..##.....##.......##.##.......##...##.........##..
# ..##.....##.##....##.##.......##....##..##....##..
# ...#######...######..########.##.....##..######...
# ..................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require($conf["dir"]["libraries"]."phpmailer/src/Exception.php");
  require($conf["dir"]["libraries"]."phpmailer/src/PHPMailer.php");
  require($conf["dir"]["libraries"]."phpmailer/src/SMTP.php");

//require("vendor/autoload.php"); # Load composer's autoloader



class Users {

  private $conn;



  //object properties
  public $id;
  public $id_status;
  public $name;
  public $surname;
  public $username;
  public $email;
  public $ugender;
  public $uhierarchy;
  public $bio;
  public $hash_pass;
  public $password_change_hash;
  public $password_change_timestamp;
  public $password_strength;
  public $date_reg;
  public $date_upd;
  public $ip_upd;
  public $ref;
  public $loops_ref;
  public $wrongUsername;
  public $dupeUsername;
  public $wrongeMail;
  public $dupeeMail;

  public $query = "";
  public $query1 = "";
  public $query2 = "";
  public $xx = ["id_status","name","surname","username","email","ugender","uhierarchy","bio","date_upd","ip_upd","ref","loops_ref"];
  public $xx_updateOne = ["id_status","name","surname","username","email","ugender","uhierarchy","bio"];
  public $xx_notinsearch = ["id_status","ugender","uhierarchy","date_upd","ip_upd","ref","loops_ref"];


  public function __construct($db,$conf=null,$cconf=null,$lCommon=null,$lCustom=null) {

    $this->conn         = $db;
    $this->conf         = $conf;
    $this->cconf        = $cconf;
    $this->lCommon      = $lCommon;
    $this->lCustom      = $lCustom;
    $this->tablename    = explode("|",$this->conf["table"]["users"]);
    $this->tableletter  = $this->tablename[1];
    $this->tablename    = $this->tablename[0];
    $this->uhierarchy_tablename = explode("|",$this->conf["table"][$this->conf["dir"]["uhierarchy"]]);
    $this->uhierarchy_tableletter = $this->uhierarchy_tablename[1];
    $this->uhierarchy_tablename = $this->uhierarchy_tablename[0];

    }



# .....................................................................
# ..######.######.#####...####..######...######.######.##...##.######..
# ..##.......##...##..##.##.......##.......##.....##...###.###.##......
# ..####.....##...#####...####....##.......##.....##...##.#.##.####....
# ..##.......##...##..##.....##...##.......##.....##...##...##.##......
# ..##.....######.##..##..####....##.......##...######.##...##.######..
# .....................................................................

  function firstTime() {

    if(file_exists(dirname(__FILE__)."/tables.sql")) :

      $this->query = "SELECT 1 FROM `".$this->tablename."` LIMIT 1";
      $stmt = $this->conn->prepare($this->query);
      $stmt->execute();

      if($stmt->rowCount() == 0 ) :

        $this->query = "";
        $lines = file(dirname(__FILE__)."/tables.sql");
        foreach ($lines as $line) :
          $line = str_replace("inconceivable",ENTROPY,$line);
          if (substr($line,0,2)=="--"||$line=="") continue;
          $this->query.= $line;
            if(substr(trim($line),-1, 1)==";") :
              $stmt = $this->conn->prepare($this->query);
              $stmt->execute();
              $this->query = "";
            endif;
        endforeach;
        unlink(dirname(__FILE__)."/tables.sql");

        if(file_exists(dirname(__FILE__)."/triggers.sql")) :
          $this->query = "";
          $this->query = file_get_contents(dirname(__FILE__)."/triggers.sql");
          unlink(dirname(__FILE__)."/triggers.sql");
          $this->query = str_replace("inconceivable",ENTROPY,$this->query);
          $stmt = $this->conn->prepare($this->query);
          if($stmt->execute()) : return true; endif;
          return false;
        endif;

      endif;

      return false;

    endif;

    }



# ....................................................................
# ...####..#####..######..####..######.######....####..##..##.######..
# ..##..##.##..##.##.....##..##...##...##.......##..##.###.##.##......
# ..##.....#####..####...######...##...####.....##..##.##.###.####....
# ..##..##.##..##.##.....##..##...##...##.......##..##.##..##.##......
# ...####..##..##.######.##..##...##...######....####..##..##.######..
# ....................................................................

  function createOne() {

    $this->wrongeMail     = 0;
    $this->dupeeMail      = 0;

    if(isset($this->email)) :

      if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)) :

        $this->wrongeMail = 1;

      else :

        $this->query = "SELECT ".$this->tableletter.".`id` FROM `".$this->tablename."` ".$this->tableletter." WHERE ".$this->tableletter.".`email` = :email LIMIT 0,1";

        $stmt = $this->conn->prepare($this->query);
        $stmt->bindParam(":email",  $this->email);
        $stmt->execute();
        $this->dupeeMail = $stmt->rowCount();

      endif;

    endif;

    if($this->wrongeMail + $this->dupeeMail > 0) :

      return true;

    else :

      $this->randomizer("ref");
/*
      $this->query = "INSERT INTO `".$this->tablename."` " .
                                                "(" .
                    (isset($this->name)          ? "`name`, "           : "") .
                    (isset($this->surname)       ? "`surname`, "        : "") .
                                                   "`username`, " .
                    (isset($this->email)         ? "`email`, "          : "") .
                    (isset($this->uhierarchy)    ? "`uhierarchy`, "     : "") .
                    (isset($this->ugender)       ? "`ugender`, "        : "") .
                                                   "`date_reg`, " .
                                                   "`date_upd`, " .
                                                   "`ip_upd`, " .
                                                   "`ref`, " .
                                                   "`loops_ref`, " .
                                                   ") VALUES (" .
                    (isset($this->name)          ? ":name, "            : "") .
                    (isset($this->surname)       ? ":surname, "         : "") .
                                                   ":username, " .
                    (isset($this->email)         ? ":email, "           : "") .
                    (isset($this->uhierarchy)    ? ":uhierarchy, "      : "") .
                    (isset($this->ugender)       ? ":ugender, "         : "") .
                                                   "now(), " .
                                                   "now(), " .
                                                   ":ip_upd, " .
                                                   ":ref, " .
                                                   ":loops_ref, " .
                                                   ")";
*/
      $this->query = "INSERT INTO `".$this->tablename."` " .
                                                "(" .
                    (isset($this->name)          ? "`name`, "           : "") .
                    (isset($this->surname)       ? "`surname`, "        : "") .
                    (isset($this->email)         ? "`email`, "          : "") .
                    (isset($this->uhierarchy)    ? "`uhierarchy`, "     : "") .
                    (isset($this->ugender)       ? "`ugender`, "        : "") .
                                                   "`username`, " .
                                                   "`date_reg`, " .
                                                   "`date_upd`, " .
                                                   "`ip_upd`, " .
                                                   "`ref`, " .
                                                   "`loops_ref`, " .
                                                   ") VALUES (" .
                    (isset($this->name)          ? "'".$this->name."', "            : "") .
                    (isset($this->surname)       ? "'".$this->surname."', "         : "") .
                    (isset($this->email)         ? "'".$this->email."', "           : "") .
                    (isset($this->uhierarchy)    ? "'".$this->uhierarchy."', "      : "") .
                    (isset($this->ugender)       ? "'".$this->ugender."', "         : "") .
                                                   "'".$this->ref."', " .
                                                   "now(), " .
                                                   "now(), " .
                                                   "'".($_SERVER["REMOTE_ADDR"])."', " .
                                                   "'".$this->ref."', " .
                                                   "'".$this->loops_ref."', " .
                                                   ")";

      $this->query = $this->queryBeautifier($this->query);
//    echo $this->query;

                                              $stmt = $this->conn->prepare($this->query);
      if(isset($this->name))                : $stmt->bindParam(":name",           $this->name);              endif;
      if(isset($this->surname))             : $stmt->bindParam(":surname",        $this->surname);           endif;
      if(isset($this->email))               : $stmt->bindParam(":email",          $this->email);             endif;
      if(isset($this->ugender))             : $stmt->bindParam(":ugender",        $this->ugender);           endif;
      if(isset($this->uhierarchy))          : $stmt->bindParam(":uhierarchy",     $this->uhierarchy);        endif;
                                              $stmt->bindParam(":ip_upd",         $_SERVER["REMOTE_ADDR"]);
                                              $stmt->bindParam(":username",       $this->ref);
                                              $stmt->bindParam(":ref",            $this->ref);
                                              $stmt->bindParam(":loops_ref",      $this->loops_rand);

      if($stmt->execute()) : $this->lastid = $this->conn->lastInsertId(); return true; endif;
      return false;

    endif;

  }

# .. END CREATE ONE
# ....................................................................



# ...............................................
# ...####..#####..#####.....####..##..##.######..
# ..##..##.##..##.##..##...##..##.###.##.##......
# ..######.##..##.##..##...##..##.##.###.####....
# ..##..##.##..##.##..##...##..##.##..##.##......
# ..##..##.#####..#####.....####..##..##.######..
# ...............................................

  function addOne() {

    $this->query1 = "";
    $this->query2 = "";

    $this->randomizer("ref");
    foreach ($this->xx as $x) :
      $this->query1.= isset($this->$x) ? "`".$x."`, " : "";
//    $this->query2.= isset($this->$x) ? ":".($x=="email"?"ref":"$x").", " : "";
      $this->query2.= isset($this->$x) ? ":$x, " : "";
    endforeach;
    $this->query = $this->queryBeautifier("INSERT INTO `".$this->tablename."` (".$this->query1."`date_reg`, `date_upd`, `ip_upd`) VALUES (".$this->query2."now(), now(), :ip_upd)");
    $this->query1 = "";
    $this->query2 = "";

    $stmt = $this->conn->prepare($this->query);

    foreach ($this->xx as $x) :
      if(isset($this->$x)) : $stmt->bindParam(":".$x, $this->$x); endif;
    endforeach;
    $stmt->bindParam(":ip_upd", $_SERVER["REMOTE_ADDR"]);

    if($stmt->execute()) : $this->lastid = $this->conn->lastInsertId(); return true; endif;
    return false;

    }

# .. END ADD ONE
# ...............................................



# ...........................................................
# ...####..##..##.######..####..##..##.#####..######.######..
# ..##..##.##..##.##.....##..##.##.##..##..##.##.....##......
# ..##.....######.####...##.....####...#####..####...####....
# ..##..##.##..##.##.....##..##.##.##..##..##.##.....##......
# ...####..##..##.######..####..##..##.##..##.######.##......
# ...........................................................

  function checkRef() {

    #Intimacy 0 : For owner's eyes
    #Intimacy 1 : For admin's eyes
    #Intimacy 2 : Public

    $this->query = "SELECT ".$this->tableletter.".`id` FROM `".$this->tablename."` ".$this->tableletter." WHERE " .
                    ($this->intimacy == 2 ? $this->tableletter.".`id_status` = 1 AND " : "") .
                    $this->tableletter.".`".($this->intimacy == 2 ? $this->cconf["file"]["ref"] : "ref")."` = ? LIMIT 0,1";

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
    $stmt->bindParam(1,$this->ref);
    $stmt->execute();

    $this->rowcount = $stmt->rowCount();

    return true;

  }



# ......................................................
# ..#####..######..####..#####.....####..##..##.######..
# ..##..##.##.....##..##.##..##...##..##.###.##.##......
# ..#####..####...######.##..##...##..##.##.###.####....
# ..##..##.##.....##..##.##..##...##..##.##..##.##......
# ..##..##.######.##..##.#####.....####..##..##.######..
# ......................................................

  function readOne() {

    #Intimacy 0 : For owner's eyes
    #Intimacy 1 : For admin's eyes
    #Intimacy 2 : Public

    $this->wrongUsername  = 0;
    $this->dupeUsername   = 0;
    $this->wrongeMail     = 0;
    $this->dupeeMail      = 0;

    $this->query = "@id:=".$this->tableletter.".`id` as id, ";
    foreach ($this->xx as $x) :
      $this->query.= $this->tableletter.".`".$x."` as ".$x.", ";
    endforeach;

    $this->query.= "CONCAT((SELECT ".$this->uhierarchy_tableletter.".`color` FROM `".$this->uhierarchy_tablename."` ".$this->uhierarchy_tableletter." WHERE ".$this->uhierarchy_tableletter.".`id` = ".$this->tableletter.".`uhierarchy`)) AS hierarchy_color, ";

    $this->query = "SELECT " .$this->query."FROM `".$this->tablename."` ".$this->tableletter." WHERE " .
                  ($this->intimacy == 2 ? $this->tableletter.".`id_status` > 0 AND " : "") .
                   $this->tableletter.".`".($this->intimacy == 2 ? $this->cconf["file"]["ref"] : "ref")."` = ? " .
                   "LIMIT 0,1";

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
    $stmt->bindParam(1,$this->ref);
    $stmt->execute();

    $this->rowcount = $stmt->rowCount();

    if($this->rowcount > 0) :

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      foreach($row as $k=>$v) : $this->$k = $v; endforeach;

      $username_blacklst = explode("|",$this->conf["site"]["username_blacklst"]);

      if(in_array($this->username,$username_blacklst))    : $this->wrongUsername  = 1;  endif;
      if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)) : $this->wrongeMail     = 1;  endif;

      return true;

    endif;

    }

# .. END READ ONE
# ......................................................



# ....................................................................................................................................................
# ..##..##.#####..#####...####..######.######...####..##..##.######....####..######.##..##..####..##.....######...######.######.######.##.....#####...
# ..##..##.##..##.##..##.##..##...##...##......##..##.###.##.##.......##.......##...###.##.##.....##.....##.......##.......##...##.....##.....##..##..
# ..##..##.#####..##..##.######...##...####....##..##.##.###.####......####....##...##.###.##.###.##.....####.....####.....##...####...##.....##..##..
# ..##..##.##.....##..##.##..##...##...##......##..##.##..##.##...........##...##...##..##.##..##.##.....##.......##.......##...##.....##.....##..##..
# ...####..##.....#####..##..##...##...######...####..##..##.######....####..######.##..##..####..######.######...##.....######.######.######.#####...
# ....................................................................................................................................................

  function updateOneSingleField() {

    $this->query = "UPDATE `".$this->tablename."` ".
                              $this->tableletter." SET " .
                              $this->tableletter.".`".$this->field."` = :value, " .
                              "WHERE ".$this->tableletter.".`id` = :pk";

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
    $stmt->bindParam(":value", $this->value);
    $stmt->bindParam(":pk", $this->pk);

    $stmt->execute();

    if($stmt->execute()) : return true; endif;
    return false;

    }

# .. END UPDATE ONE SINGLE FIELD
# ....................................................................................................................................................



# ....................................................................
# ..##..##.#####..#####...####..######.######....####..##..##.######..
# ..##..##.##..##.##..##.##..##...##...##.......##..##.###.##.##......
# ..##..##.#####..##..##.######...##...####.....##..##.##.###.####....
# ..##..##.##.....##..##.##..##...##...##.......##..##.##..##.##......
# ...####..##.....#####..##..##...##...######....####..##..##.######..
# ....................................................................

  function updateOne() {

    $this->wrongUsername  = 0;
    $this->dupeUsername   = 0;
    $this->wrongeMail     = 0;
    $this->dupeeMail      = 0;

    if(isset($this->username)) :

      $username_blacklst = explode("|",$this->conf["site"]["username_blacklst"]);

      if(in_array($this->username,$username_blacklst)) :

        $this->wrongUsername = 1;

      else :

        $this->query = "SELECT " .
                 $this->tableletter.".`id` " .
                 "FROM `".$this->tablename."` ".$this->tableletter." " .
                 "WHERE ".$this->tableletter.".`username` = :username " .
                 "AND ".$this->tableletter.".`ref` <> :ref " .
                 "LIMIT 0,1";

        $this->query = $this->queryBeautifier($this->query);

        $stmt = $this->conn->prepare($this->query);
        $stmt->bindParam(":ref", $this->ref);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
        $this->dupeUsername = $stmt->rowCount();
        $this->query = "";

      endif;

    endif;

    if(isset($this->email)) :

      if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)) :

        $this->wrongeMail = 1;

      else :

        $this->query = "SELECT " .
                 $this->tableletter.".`id` " .
                 "FROM `".$this->tablename."` ".$this->tableletter." " .
                 "WHERE ".$this->tableletter.".`email` = :email " .
                 "AND ".$this->tableletter.".`ref` <> :ref " .
                 "LIMIT 0,1";

        $this->query = $this->queryBeautifier($this->query);

        $stmt = $this->conn->prepare($this->query);
        $stmt->bindParam(":ref", $this->ref);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        $this->dupeeMail = $stmt->rowCount();
        $this->query = "";

      endif;

    endif;

    if($this->wrongUsername + $this->dupeUsername + $this->wrongeMail + $this->dupeeMail > 0) :

      return true;

    else :

      foreach ($this->xx_updateOne as $x) :
        $this->query.= isset($this->$x) && $x!="ref" ? $this->tableletter.".`".$x."` = :".$x.", " : "";
      endforeach;

      $this->query = "UPDATE `".$this->tablename."` ".
                                $this->tableletter." SET " .$this->query.
                                $this->tableletter.".`date_upd` = now(), " .
                                $this->tableletter.".`ip_upd` = :ip_upd, " .
                                "WHERE ".$this->tableletter.".`ref` = :ref";

      $this->query = $this->queryBeautifier($this->query);

      $stmt = $this->conn->prepare($this->query);
      foreach ($this->xx_updateOne as $x) :
        if(isset($this->$x)) : $stmt->bindParam(":".$x , $this->$x); endif;
      endforeach;
      $stmt->bindParam(":ref" , $this->ref);
      $stmt->bindParam(":ip_upd" , $_SERVER["REMOTE_ADDR"]);

      if($stmt->execute()) : return true; endif;

      return false;

    endif;

    }

# .. END UPDATE ONE
# ....................................................................



# ............................................................................
# ..####..######..####..##..##....####..##..##.######....####..##..##.######..
# ..#.......##...##.....###.##...##..##.##..##...##.....##..##.###.##.##......
# ..####....##...##.###.##.###...##..##.##..##...##.....##..##.##.###.####....
# .....##...##...##..##.##..##...##..##.##..##...##.....##..##.##..##.##......
# ..####..######..####..##..##....####...####....##......####..##..##.######..
# ............................................................................

  function signoutOne() {

    $this->query = "UPDATE `".$this->tablename."` ".$this->tableletter." SET ".$this->tableletter.".`signed_in` = 0 WHERE ".$this->tableletter.".`id` = ?";
    $stmt = $this->conn->prepare($this->query);
    $stmt->bindParam(1,$this->who);
    if($result = $stmt->execute()) : return true; endif;
    return false;

    }

# .. END LOGOUT ONE
# ....................................................................



# ....................................................................
# ..#####..######.##.....######.######.######....####..##..##.######..
# ..##..##.##.....##.....##.......##...##.......##..##.###.##.##......
# ..##..##.####...##.....####.....##...####.....##..##.##.###.####....
# ..##..##.##.....##.....##.......##...##.......##..##.##..##.##......
# ..#####..######.######.######...##...######....####..##..##.######..
# ....................................................................

  function deleteOne() {

    $this->query = "DELETE FROM `".$this->tablename."` WHERE `id` = ?";
    $stmt = $this->conn->prepare($this->query);
    $stmt->bindParam(1,$this->id);
    if($result = $stmt->execute()) : return true; endif;
    return false;

    }

# .. END DELETE ONE
# ....................................................................



# ....................................................................................
# ..#####..######..####..#####.....####..##.....##.......######..####...####..##..##..
# ..##..##.##.....##..##.##..##...##..##.##.....##...........##.##.....##..##.###.##..
# ..#####..####...######.##..##...######.##.....##...........##..####..##..##.##.###..
# ..##..##.##.....##..##.##..##...##..##.##.....##.......##..##.....##.##..##.##..##..
# ..##..##.######.##..##.#####....##..##.######.######....####...####...####..##..##..
# ....................................................................................

  function readAllJSON() {

    $this->query1 = "";
    $this->query2 = "";

    $this->query1.= $this->tableletter.".`id`, ";
    foreach ($this->xx as $x) :
      $this->query1.= $x!="ref" ? $this->tableletter.".`".$x."`, " : "";
      $this->query2.= !in_array($x,$this->xx_notinsearch) ? $this->tableletter.".`".$x."`, " : "";
    endforeach;

    $this->query = "SELECT " .$this->query1." FROM `".$this->tablename."` ".$this->tableletter." " .
                    "WHERE ".$this->tableletter.".`id_status` = 1 " .
                    "AND ".$this->tableletter.".`name` COLLATE utf8_general_ci NOT LIKE '".$this->cconf["default"]["name"]."%' " .
                    (isset($this->search)?"AND CONCAT(".$this->query2.") LIKE '%".$this->search."%' ":"") .
                    "ORDER BY ". $this->tableletter.".`name` ASC";

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
    $stmt->execute();
    $this->rowcount = $stmt->rowCount();

    $i=0;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
      foreach($row as $k=>$v) : $this->$k[$i] = preg_replace(array("/\s{2,}/","~[[:cntrl:]]~")," ",$v); endforeach; $i++;
    endwhile;

    }

# .. END READ ALL JSON
# ....................................................................................



# ......................................................
# ..#####..######..####..#####.....####..##.....##......
# ..##..##.##.....##..##.##..##...##..##.##.....##......
# ..#####..####...######.##..##...######.##.....##......
# ..##..##.##.....##..##.##..##...##..##.##.....##......
# ..##..##.######.##..##.#####....##..##.######.######..
# ......................................................

  function readAll($records_per_page=6,$page=0,$from_record_num=0,$where=null,$searchLabel=null) {

    #Intimacy 0 : For owner's eyes
    #Intimacy 1 : For admin's eyes
    #Intimacy 2 : Public

    $this->query1 = "";
    $this->query2 = "";

    $this->query1.= "@id:=".$this->tableletter.".`id` as id, ";
    foreach ($this->xx as $x) :
      $this->query1.= $this->tableletter.".`".$x."`, ";
      $this->query2.= !in_array($x,$this->xx_notinsearch) ? $this->tableletter.".`".$x."`, " : "";
    endforeach;

    $this->query1.= "CONCAT((SELECT CONCAT(".$this->uhierarchy_tableletter.".`name`,'|',".$this->uhierarchy_tableletter.".`color`) FROM `".$this->uhierarchy_tablename."` ".$this->uhierarchy_tableletter." WHERE ".$this->uhierarchy_tableletter.".`id` = ".$this->tableletter.".`uhierarchy`)) AS hierarchy, ";

    $qwhere = ((isset($this->intimacy) && $this->intimacy > 1 || $where) ? " WHERE " : " ") .
    (isset($this->intimacy) && $this->intimacy > 1  ? $this->tableletter.".`id_status` = 1 ".($where?"AND ":" ") : " ") .
    ($where ? "CONCAT(".$this->query2.") LIKE '%".$where."%' " : " ");

    $this->query = "SELECT ".$this->tableletter.".`id` "."FROM `".$this->tablename."` ".$this->tableletter.$qwhere;

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
    $stmt->execute();
    $this->rowcount_absolute = $stmt->rowCount();

    $this->query = "SELECT ".$this->query1."FROM `".$this->tablename."` ".$this->tableletter.$qwhere.
                   "ORDER BY ". $this->tableletter.".`id_status` ASC, CASE WHEN ".$this->tableletter.".`name` COLLATE utf8_general_ci LIKE '".$this->cconf["default"]["name"]."%' THEN 1 ELSE 2 END, ".$this->tableletter.".`name` COLLATE utf8_general_ci ASC " .
                   "LIMIT {$from_record_num}, {$records_per_page}";

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
    $stmt->execute();
    $this->rowcount = $stmt->rowCount();

    $i=0;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
      foreach($row as $k=>$v) : $this->$k[$i] = $v; endforeach; $i++;
    endwhile;

    }

# .. END READ ALL
# ......................................................



# ..............................................................................................................................
# ...####..##..##..####..##..##..####..######...#####...####...####...####....#####..######..####..##..##.######..####..######..
# ..##..##.##..##.##..##.###.##.##.....##.......##..##.##..##.##.....##.......##..##.##.....##..##.##..##.##.....##.......##....
# ..##.....######.######.##.###.##.###.####.....#####..######..####...####....#####..####...##.###.##..##.####....####....##....
# ..##..##.##..##.##..##.##..##.##..##.##.......##.....##..##.....##.....##...##..##.##.....##..##.##..##.##.........##...##....
# ...####..##..##.##..##.##..##..####..######...##.....##..##..####...####....##..##.######..#####..####..######..####....##....
# ..............................................................................................................................

  function changePassRequest() {

    $this->done = false;

    $this->query = "SELECT " .
                   $this->tableletter.".`name`, " .
                   $this->tableletter.".`surname`, " .
                   $this->tableletter.".`email`, " .
                   "FROM `".$this->tablename."` ".$this->tableletter." " .
                   "WHERE ".$this->tableletter.".`id_status` = 1 AND " .
                   (isset($this->ref) ? $this->tableletter.".`ref` = :ref " : "") .
                   (isset($this->email_or_username) ? "(".$this->tableletter.".`email` = :email_or_username OR ".$this->tableletter.".`username` = :email_or_username) " : "") .
                   "LIMIT 0,1";

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);

    if(isset($this->ref))                 : $stmt->bindParam(":ref", $this->ref);                               endif;
    if(isset($this->email_or_username))   : $stmt->bindParam(":email_or_username", $this->email_or_username);   endif;

    $stmt->execute();
    $num = $stmt->rowCount();

    if($num>0) :

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->name = $row["name"];
      $this->surname = $row["surname"];
      $this->email = $row["email"];

      $this->randomizer("password_change_hash",40);

      $this->query = "UPDATE `".$this->tablename."` ".$this->tableletter." SET " .
                     $this->tableletter.".`password_change_hash` = :password_change_hash, " .
                     $this->tableletter.".`ip_upd`= :ip_upd, " .
                     "WHERE ".$this->tableletter.".`id_status` = 1 " .
                     "AND ".$this->tableletter.".`email` = :email";

      $this->query = $this->queryBeautifier($this->query);

      $stmt = $this->conn->prepare($this->query);
      $stmt->bindParam(":password_change_hash", $this->password_change_hash);
      $stmt->bindParam(":email", $this->email);
      $stmt->bindParam(":ip_upd", $_SERVER["REMOTE_ADDR"]);
      $stmt->execute();

      $this->done = true;

      $to = $this->email;
//    $from = $this->conf["mail"]["from"];
      $subject = $this->conf["meta"]["name"][$this->conf["site"]["lang"]].": ".$this->lCommon["messages"][$this->conf["site"]["lang"]]["forgot-password"]["title"];
      $emessage = sprintf(
        $this->lCommon["messages"][$this->conf["site"]["lang"]]["forgot-password"]["body"],
        $this->name,
        $this->conf["meta"]["name"][$this->conf["site"]["lang"]],
        "<a href=\"".$this->conf["site"]["realpathLang"].$this->conf["file"]["change-pass"]."/".$this->password_change_hash."\">".$this->conf["site"]["realpathLang"].$this->conf["file"]["change-pass"]."/".$this->password_change_hash."</a>"
        );

      $this->send_email($to,$subject,$emessage);

      return true;

    endif;

    return false;

    }

# .. END CHANGE PASSWORD REQUEST
# ..............................................................................................................................



# ....................................................................................
# ...####..##..##..####..##..##..####..######...#####...####...####...####......##....
# ..##..##.##..##.##..##.###.##.##.....##.......##..##.##..##.##.....##........###....
# ..##.....######.######.##.###.##.###.####.....#####..######..####...####......##....
# ..##..##.##..##.##..##.##..##.##..##.##.......##.....##..##.....##.....##.....##....
# ...####..##..##.##..##.##..##..####..######...##.....##..##..####...####....######..
# ....................................................................................

  function changePass1() {

    $this->query = "SELECT " .
                   $this->tableletter.".`id` " .
                   "FROM `".$this->tablename."` ".$this->tableletter." " .
                   "WHERE ".$this->tableletter.".`id_status` = 1 " .
                   "AND ".$this->tableletter.".`password_change_hash` = :password_change_hash " .
                   "LIMIT 0,1";

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
    $stmt->bindParam(":password_change_hash", $this->password_change_hash);
    $stmt->execute();

    $this->num = $stmt->rowCount();
    $this->done = false;

    }

# .. END CHANGE PASSWORD 1
# ....................................................................................



# ....................................................................................
# ...####..##..##..####..##..##..####..######...#####...####...####...####.....####...
# ..##..##.##..##.##..##.###.##.##.....##.......##..##.##..##.##.....##...........##..
# ..##.....######.######.##.###.##.###.####.....#####..######..####...####.....####...
# ..##..##.##..##.##..##.##..##.##..##.##.......##.....##..##.....##.....##...##......
# ...####..##..##.##..##.##..##..####..######...##.....##..##..####...####....######..
# ....................................................................................

  function changePass2() {

    $this->wrongeMailorUsername  = false;
    $this->wrongPasswordStrength = false;
    $this->wrongCaptchaResponse  = false;

    # ..................................................................
    # ..#####..######..####...####..#####..######..####..##..##..####...
    # ..##..##.##.....##..##.##..##.##..##...##...##..##.##..##.##..##..
    # ..#####..####...##.....######.#####....##...##.....######.######..
    # ..##..##.##.....##..##.##..##.##.......##...##..##.##..##.##..##..
    # ..##..##.######..####..##..##.##.......##....####..##..##.##..##..
    # ..................................................................

    if(!isset($this->g_recaptcha_response) || empty($this->g_recaptcha_response)) :

      $this->wrongCaptchaResponse = true; return true;

    else :

      if(isset($this->g_recaptcha_response) && !empty($this->g_recaptcha_response)) :

        $this->secret = $this->conf["recaptcha"]["secret"];

        $data = array(
          "secret" => $this->secret,
          "response" => $this->g_recaptcha_response,
          "remoteip" => $_SERVER["REMOTE_ADDR"],
          );

        $verify = curl_init();
          curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
          curl_setopt($verify, CURLOPT_POST, true);
          curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
          curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($verify),true);

        if($response["success"]!=true) :

          $this->wrongCaptchaResponse = true; return true;
          die();

        endif;

      endif;

    endif;

    # .. END reCAPTCHA
    # ..................................................................

    if(isset($this->password_strength) && $this->password_strength < 4) :

      $this->wrongPasswordStrength = true; return true;

    endif;

    $this->query = "SELECT " .
                   $this->tableletter.".`name`, " .
                   $this->tableletter.".`surname`, " .
                   $this->tableletter.".`email` " .
                   "FROM `".$this->tablename."` ".$this->tableletter." " .
                   "WHERE ".$this->tableletter.".`id_status` = 1 " .
                   "AND ".$this->tableletter.".`password_change_hash` = :password_change_hash " .
                   "AND (".$this->tableletter.".`email` = :email_or_username OR ".$this->tableletter.".`username` = :email_or_username) " .
                   "LIMIT 0,1";

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
    $stmt->bindParam(":password_change_hash", $this->password_change_hash);
    $stmt->bindParam(":email_or_username", $this->email_or_username);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num == 0) :

      $this->wrongeMailorUsername = true; return true;

    else :

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->name = $row["name"];
      $this->surname = $row["surname"];
      $this->email = $row["email"];

      $this->query = "UPDATE `".$this->tablename."` ".$this->tableletter." SET " .
                     $this->tableletter.".`hash_pass` = :hash_pass, " .
                     $this->tableletter.".`password_change_hash` = NULL, " .
                     $this->tableletter.".`password_change_timestamp` = now(), " .
                     $this->tableletter.".`password_change_ip` = :password_change_ip, " .
                     $this->tableletter.".`password_strength` = :password_strength " .
                     "WHERE ".$this->tableletter.".`id_status` = 1 " .
                     "AND ".$this->tableletter.".`password_change_hash` = :password_change_hash " .
                     "AND ".$this->tableletter.".`email` = :email";

      $this->query = $this->queryBeautifier($this->query);

      $stmt = $this->conn->prepare($this->query);
      $stmt->bindParam(":email", $this->email);
      $stmt->bindParam(":password_change_hash", $this->password_change_hash);
      $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
      $stmt->bindParam(":hash_pass", $password_hash);
      $stmt->bindParam(":password_change_ip", $_SERVER["REMOTE_ADDR"]);
      $stmt->bindParam(":password_strength", $this->password_strength);
      $stmt->execute();

      $this->done = true;

      $to = $this->email;
//    $from = $this->conf["mail"]["from"];
      $subject = $this->conf["meta"]["name"][$this->conf["site"]["lang"]].": ".$this->lCommon["messages"][$this->conf["site"]["lang"]]["change-password"]["title"]; // " có" " qué"
      $emessage = sprintf(
        $this->lCommon["messages"][$this->conf["site"]["lang"]]["change-password"]["body"],
        $this->name,
        $this->conf["meta"]["name"][$this->conf["site"]["lang"]],
        "<a href=\"".$this->conf["site"]["realpathLang"].$this->conf["file"]["signin"]."\">".$this->conf["site"]["realpathLang"].$this->conf["file"]["signin"]."</a>"
        );

      $this->send_email($to,$subject,$emessage);

      return true;

    endif;

    return false;

    }

# .. END CHANGE PASSWORD 2
# ....................................................................................





# ==================================================================================
# ==================================================================================
# ==================================================================================
# ==================================================================================








# ..............................................................................................................
# ...####..##..##.######.#####..##..##...#####..######..####..##..##.######.######.######.######.######.#####...
# ..##..##.##..##.##.....##..##..####....##..##.##.....##..##.##..##...##.....##...##.......##...##.....##..##..
# ..##.###.##..##.####...#####....##.....#####..####...######.##..##...##.....##...####.....##...####...#####...
# ..##..##.##..##.##.....##..##...##.....##..##.##.....##..##.##..##...##.....##...##.......##...##.....##..##..
# ...#####..####..######.##..##...##.....#####..######.##..##..####....##...######.##.....######.######.##..##..
# ..............................................................................................................

  private function queryBeautifier($q) {
    $q = preg_replace(array("/\s{2,}/","/[\t\n]/")," ",$q);   # removes double spaces and newlines
    $q = preg_replace("/,+( \)| FROM| WHERE| AND)/",'$1',$q); # removes last comma before closing parenthesis, FROM, WHERE, AND and so on...
    return $q;
    }

# .. END QUERY BEAUTIFIER
# ..............................................................................................................



# ..........................................................................
# ..#####...####..##..##.#####...####..##...##.######.######.######.#####...
# ..##..##.##..##.###.##.##..##.##..##.###.###...##......##..##.....##..##..
# ..#####..######.##.###.##..##.##..##.##.#.##...##.....##...####...#####...
# ..##..##.##..##.##..##.##..##.##..##.##...##...##....##....##.....##..##..
# ..##..##.##..##.##..##.#####...####..##...##.######.######.######.##..##..
# ..........................................................................

  private function randomizer($field,$max=8) {

    $this->loops_ref=0;
    do {
       $characters = "23456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ"; # removed 01lIO to make it less confusing
       $charactersLength = strlen($characters);
       $randomString = "";
       for ($i=0;$i<($max);$i++) :
         $randomString .= $characters[rand(0,$charactersLength-1)];
       endfor;
       $this->$field = $randomString;
       $this->query = "SELECT `".$field."` FROM `".$this->tablename."` WHERE BINARY `".$field."` = ? LIMIT 0,1";
       $stmt = $this->conn->prepare($this->query);
       $stmt->bindParam(1,$this->$field);
       $stmt->execute();
       $num = $stmt->rowCount();
       $this->loops_ref++;
       }
    while ($num>0);

    }

# .. END RANDOMIZER
# ..........................................................................



  public function getPic($i,$alt,$size="icon") {

    return REALPATH;

/*
    $getPic =(
          file_exists(
          $this->conf["dir"]["images"].
          $this->conf["css"][$size."_prefix"].
          $this->cconf["img"]["prefix"].
          (is_null($i) ?
            $this->{$this->cconf["img"]["ref"]}:
            $this->{$this->cconf["img"]["ref"]}[$i]
          ).
          ".jpg")?
          REALPATH.
          $this->conf["dir"]["images"].
          $this->conf["css"][$size."_prefix"].
          $this->cconf["img"]["prefix"].
          (is_null($i) ?
            $this->{$this->cconf["img"]["ref"]}:
            $this->{$this->cconf["img"]["ref"]}[$i]
          ).
          ".jpg?".time():
          (file_exists(
            $this->conf["dir"]["images"].
            $this->conf["css"][$size."_prefix"].
            $this->cconf["img"]["prefix"].
            "0.jpg")?
            REALPATH.
            $this->conf["dir"]["images"].
            $this->conf["css"][$size."_prefix"].
            $this->cconf["img"]["prefix"].
            "0.jpg?".
            time():
            "https://fakeimg.pl/".
            $this->cconf["img"][$size."_w"].
            "x".
            $this->cconf["img"][$size."_h"].
            "/?text=".
            (is_null($i) ?
              $this->$alt:
              $this->$alt[$i]
            )
          )
          );
    return $getPic;
*/
  }



# ..........................................................................
# ...####..######.##..##.#####.........######.##...##..####..######.##......
# ..##.....##.....###.##.##..##........##.....###.###.##..##...##...##......
# ...####..####...##.###.##..##........####...##.#.##.######...##...##......
# ......##.##.....##..##.##..##........##.....##...##.##..##...##...##......
# ...####..######.##..##.#####..######.######.##...##.##..##.######.######..
# ..........................................................................

  public function send_email($mail_to,$mail_subject,$mail_message) {

    $this->mail_to          = $mail_to;
    $this->mail_subject     = $mail_subject;
    $this->mail_message     = $mail_message;
    $this->mail_from        = $this->conf["mail"]["from"];
    $this->mail_host        = $this->conf["mail"]["host"];
    $this->mail_username    = $this->conf["mail"]["username"];
    $this->mail_password    = $this->conf["mail"]["password"];
    $this->mail_tls_or_ssl  = $this->conf["mail"]["tls_or_ssl"];
    $this->mail_port        = $this->conf["mail"]["port"];

    $mail = new PHPMailer(true);
    try {
        $mail->CharSet = "utf-8";
        $mail->setLanguage("es");
        $mail->ContentType = "text/html; charset=utf-8\r\n";
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $this->mail_host;
        $mail->SMTPAuth = true;
        $mail->Username = $this->mail_username;
        $mail->Password = $this->mail_password;
        $mail->SMTPSecure = $this->mail_tls_or_ssl;
        $mail->Port = $this->mail_port;
        $mail->setFrom($this->mail_from,$this->conf["meta"]["name"][$this->conf["site"]["lang"]]);
        $mail->addAddress($this->mail_to);
        $mail->addReplyTo($this->mail_from,$this->conf["meta"]["name"][$this->conf["site"]["lang"]]);
        $mail->isHTML(true);
        $mail->Subject = $this->mail_subject;
        $mail->Body = $this->mail_message;
        $mail->AltBody = strip_tags(str_replace(array("<br>","<br/>","<br />"),"\r\n",$this->mail_message));
        $mail->CharSet = "utf-8";
        $mail->send();
        return true;
        } catch (Exception $e) { echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo; }
    }

# .. END SEND_EMAIL
# ..........................................................................



}

?>
