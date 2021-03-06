<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php
//LABELS

# ...........................................................
# ..##..........###....########..########.##........######...
# ..##.........##.##...##.....##.##.......##.......##....##..
# ..##........##...##..##.....##.##.......##.......##........
# ..##.......##.....##.########..######...##........######...
# ..##.......#########.##.....##.##.......##.............##..
# ..##.......##.....##.##.....##.##.......##.......##....##..
# ..########.##.....##.########..########.########..######...
# ...........................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













class Labels{

  private $conn;



  //object properties
  public $id;
  public $id_status;
  public $name_en;
  public $url_name_en;
  public $name_gal;
  public $url_name_gal;
  public $name_es;
  public $url_name_es;
  public $date_reg;
  public $date_upd;
  public $ip_upd;
  public $ref;
  public $loops_ref;
  public $dupeName;

  public $query = "";
  public $query1 = "";
  public $query2 = "";
  public $xx = ["id_status","name_en","url_name_en","name_gal","url_name_gal","name_es","url_name_es","date_upd","ip_upd","ref","loops_ref"];
  public $xx_notinsearch = ["id_status","date_upd","ip_upd","ref","loops_ref"];



  public function __construct($db,$conf=null,$cconf=null,$lCommon=null,$lCustom=null) {

    $this->conn         = $db;
    $this->conf         = $conf;
    $this->cconf        = $cconf;
    $this->lCommon      = $lCommon;
    $this->lCustom      = $lCustom;
    $this->tablename    = explode("|",$this->conf["table"]["labels"]);
    $this->tableletter  = $this->tablename[1];
    $this->tablename    = $this->tablename[0];

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

      $query = "SELECT 1 FROM `".$this->tablename."` LIMIT 1";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      if($stmt->rowCount() == 0 ) :

        $query = "";
        $lines = file(dirname(__FILE__)."/tables.sql");
        foreach ($lines as $line) :
          $line = str_replace("inconceivable",ENTROPY,$line);
          if (substr($line,0,2)=="--"||$line=="") continue;
          $query.= $line;
            if(substr(trim($line),-1, 1)==";") :
              $stmt = $this->conn->prepare($query);
              $stmt->execute();
              $query = "";
            endif;
        endforeach;
        unlink(dirname(__FILE__)."/tables.sql");

        if(file_exists(dirname(__FILE__)."/triggers.sql")) :
          $query = "";
          $query = file_get_contents(dirname(__FILE__)."/triggers.sql");
          $query = str_replace("inconceivable",ENTROPY,$query);
          $stmt = $this->conn->prepare($query);
          if($stmt->execute()) : unlink(dirname(__FILE__)."/triggers.sql"); return true; endif;
          return false;
        endif;

      endif;

      return false;

    endif;

    }



# ...............................................
# ...####..#####..#####.....####..##..##.######..
# ..##..##.##..##.##..##...##..##.###.##.##......
# ..######.##..##.##..##...##..##.##.###.####....
# ..##..##.##..##.##..##...##..##.##..##.##......
# ..##..##.#####..#####.....####..##..##.######..
# ...............................................

  function addOne() {

    $query1 = "";
    $query2 = "";

    $this->randomizer("ref");
    foreach ($this->xx as $x) :
      $query1.= isset($this->$x) ? "`".$x."`, " : "";
      $query2.= isset($this->$x) ? ":".$x.", " : "";
    endforeach;
    $query = $this->queryBeautifier("INSERT INTO `".$this->tablename."` (".$query1."`date_reg`, `date_upd`, `ip_upd`) VALUES (".$query2."now(), now(), :ip_upd)");
    $query1 = "";
    $query2 = "";

    $stmt = $this->conn->prepare($query);

    foreach ($this->xx as $x) :
      if(isset($this->$x)) : $stmt->bindParam(":".$x, $this->$x); endif;
    endforeach;
    $stmt->bindParam(":ip_upd", $_SERVER["REMOTE_ADDR"]);

    if($stmt->execute()) : $this->lastid = $this->conn->lastInsertId(); return true; endif;
    return false;

    }

# .. END ADD ONE
# ...............................................


# ....................................................................................................................................................
# ..##..##.#####..#####...####..######.######...####..##..##.######....####..######.##..##..####..##.....######...######.######.######.##.....#####...
# ..##..##.##..##.##..##.##..##...##...##......##..##.###.##.##.......##.......##...###.##.##.....##.....##.......##.......##...##.....##.....##..##..
# ..##..##.#####..##..##.######...##...####....##..##.##.###.####......####....##...##.###.##.###.##.....####.....####.....##...####...##.....##..##..
# ..##..##.##.....##..##.##..##...##...##......##..##.##..##.##...........##...##...##..##.##..##.##.....##.......##.......##...##.....##.....##..##..
# ...####..##.....#####..##..##...##...######...####..##..##.######....####..######.##..##..####..######.######...##.....######.######.######.#####...
# ....................................................................................................................................................

  function updateOneSingleField() {

    $query = "UPDATE `".$this->tablename."` ".
              $this->tableletter." SET " .
              $this->tableletter.".`".$this->field."` = :value, " .
              (isset($this->url_value) ? $this->tableletter.".`url_".$this->field."` = :url_value, " : "" ) . 
              $this->tableletter.".`ip_upd` = :ip_upd, " .
              $this->tableletter.".`date_upd` = now(), " .
             "WHERE ".$this->tableletter.".`id` = :pk";

    $query = $this->queryBeautifier($query);

    $stmt = $this->conn->prepare($query);
                                  $stmt->bindParam(":value",      $this->value);
    if(isset($this->url_value)) : $stmt->bindParam(":url_value",  $this->url_value); endif;
                                  $stmt->bindParam(":pk",         $this->pk);
                                  $stmt->bindParam(":ip_upd",     $_SERVER["REMOTE_ADDR"]);

    $stmt->execute();

    if($stmt->execute()) : return true; endif;
    return false;

    }

# .. END UPDATE ONE SINGLE FIELD
# ....................................................................................................................................................


# ....................................................................
# ..#####..######.##.....######.######.######....####..##..##.######..
# ..##..##.##.....##.....##.......##...##.......##..##.###.##.##......
# ..##..##.####...##.....####.....##...####.....##..##.##.###.####....
# ..##..##.##.....##.....##.......##...##.......##..##.##..##.##......
# ..#####..######.######.######...##...######....####..##..##.######..
# ....................................................................

  function deleteOne() {

    $query = "DELETE FROM `".$this->tablename."` WHERE `id` = ?";
    $stmt = $this->conn->prepare($query);
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

    $query1 = "";
    $query2 = "";

    $query1.= $this->tableletter.".`id`, ";
    foreach ($this->xx as $x) :
      $query1.= $x!="ref" ? $this->tableletter.".`".$x."`, " : "";
      $query2.= !in_array($x,$this->xx_notinsearch) ? $this->tableletter.".`".$x."`, " : "";
    endforeach;

    $query = "SELECT " .$query1." FROM `".$this->tablename."` ".$this->tableletter." " .
             "WHERE ".$this->tableletter.".`id_status` = 1 " .
             "AND ".$this->tableletter.".`name_en` COLLATE utf8mb4_unicode_ci NOT LIKE '".$this->cconf["default"]["name_en"]."%' " .
              (isset($this->search)?"AND CONCAT(".$query2.") LIKE '%".$this->search."%' ":"") .
             "ORDER BY ". $this->tableletter.".`name_en` ASC";

    $query = $this->queryBeautifier($query);

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $this->rowcount = $stmt->rowCount();

    $i=0;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
      foreach($row as $k=>$v) : 
//      $this->$k[$i] = preg_replace(array("/\s{2,}/","~[[:cntrl:]]~")," ",$v); # Buggy
        $this->$k[$i] = preg_replace("/ {2,}/","\s",trim($v));
      endforeach; $i++;
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

  function readAll($records_per_page=6,$page=0,$from_record_num=0,$where=null) {

    #Intimacy 0 : For owner's eyes
    #Intimacy 1 : For admin's eyes
    #Intimacy 2 : Public

    $query1 = "";
    $query2 = "";

    $query1.= "@id:=".$this->tableletter.".`id` as id, ";
    foreach ($this->xx as $x) :
      $query1.= $this->tableletter.".`".$x."`, ";
      $query2.= !in_array($x,$this->xx_notinsearch) ? $this->tableletter.".`".$x."`, " : "";
    endforeach;

    $qwhere = ((isset($this->intimacy) && $this->intimacy > 1 || $where) ? " WHERE " : " ") .
    (isset($this->intimacy) && $this->intimacy > 1  ? $this->tableletter.".`id_status` = 1 ".($where?"AND ":" ") : " ") .
    ($where ? "CONCAT(".$query2.") LIKE '%".$where."%' " : " ");

    $query = "SELECT ".$this->tableletter.".`id` "."FROM `".$this->tablename."` ".$this->tableletter.$qwhere;

    $query = $this->queryBeautifier($query);

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $this->rowcount_absolute = $stmt->rowCount();

    $query = "SELECT ".$query1."FROM `".$this->tablename."` ".$this->tableletter.$qwhere.
             "ORDER BY ". $this->tableletter.".`id_status` ASC, CASE WHEN ".$this->tableletter.".`name_en` COLLATE utf8mb4_unicode_ci LIKE '".$this->cconf["default"]["name_en"]."%' THEN 1 ELSE 2 END, ".$this->tableletter.".`name_en` COLLATE utf8mb4_unicode_ci ASC " .
             "LIMIT {$from_record_num}, {$records_per_page}";

    $query = $this->queryBeautifier($query);

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $this->rowcount = $stmt->rowCount();

    $i=0;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
      foreach($row as $k=>$v) : $this->$k[$i] = $v; endforeach; $i++;
    endwhile;

    }

# .. END READ ALL
# ......................................................



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

  private function randomizer($field,$max=8,$tableprefix="") {

    $this->loops_ref=0;
    do {
       $characters = "23456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ"; # removed 01lIO to make it less confusing
       $charactersLength = strlen($characters);
       $randomString = "";
       for ($i=0;$i<($max);$i++) :
         $randomString .= $characters[rand(0,$charactersLength-1)];
       endfor;
       $this->$field = $randomString;
       $query = "SELECT `".$field."` FROM `".$this->{$tableprefix."tablename"}."` WHERE BINARY `".$field."` = ? LIMIT 0,1";
       $stmt = $this->conn->prepare($query);
       $stmt->bindParam(1,$this->$field);
       $stmt->execute();
       $num = $stmt->rowCount();
       $this->loops_ref++;
       }
    while ($num>0);

    }

# .. END RANDOMIZER
# ..........................................................................


}

?>
