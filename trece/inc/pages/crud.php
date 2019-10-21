<?php if(!defined("TRECE")):header("location:/");die();endif; ?>
<?php
//PAGES

# ...................................................
# ..########.....###.....######...########..######...
# ..##.....##...##.##...##....##..##.......##....##..
# ..##.....##..##...##..##........##.......##........
# ..########..##.....##.##...####.######....######...
# ..##........#########.##....##..##.............##..
# ..##........##.....##.##....##..##.......##....##..
# ..##........##.....##..######...########..######...
# ...................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













class Pages{

  private $conn;



  //object properties
  public $id;
  public $parent_id;
  public $ids_breadcrumb_trail;
  public $id_status;
  public $title_en;
  public $title_gal;
  public $title_es;
  public $url_title;
  public $path;
  public $intro_en;
  public $intro_gal;
  public $intro_es;
  public $post_en;
  public $post_gal;
  public $post_es;
  public $date_reg;
  public $date_upd;
  public $ip_upd;
  public $ref;
  public $loops_ref;
  public $dupeTitle;

  public $query = "";
  public $query1 = "";
  public $query2 = "";
  public $xx = ["id_status","parent_id","level","title_en","title_gal","title_es","url_title","intro_en","intro_gal","intro_es","path","post_en","post_gal","post_es","date_upd","ip_upd","ref","loops_ref"];
  public $xx_updateOne = ["id_status","parent_id","level","title_en","title_gal","title_es","url_title","intro_en","intro_gal","intro_es","path","post_en","post_gal","post_es"];
  public $xx_notinsearch = ["id_status","parent_id","level","url_title","ref","loops_ref","date_upd","ip_upd"];



  public function __construct($db,$conf=null,$cconf=null,$lCommon=null,$lCustom=null) {

    $this->conn                = $db;
    $this->conf                = $conf;
    $this->cconf               = $cconf;
    $this->lCommon             = $lCommon;
    $this->lCustom             = $lCustom;
    $this->tablename           = explode("|",$this->conf["table"]["pages"]);
    $this->tableletter         = $this->tablename[1];
    $this->tablename           = $this->tablename[0];

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
          $this->query = str_replace("inconceivable",ENTROPY,$this->query);
          $stmt = $this->conn->prepare($this->query);
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

    $this->query1 = "";
    $this->query2 = "";

    $this->randomizer("ref");
    foreach ($this->xx as $x) :
      $this->query1.= isset($this->$x) ? "`".$x."`, " : "";
      $this->query2.= isset($this->$x) ? ":".$x.", " : "";
    endforeach;
    $this->query = $this->queryBeautifier("INSERT INTO `".$this->tablename."` (".$this->query1."`date_reg`, `date_upd`, `ip_upd`) VALUES (".$this->query2."now(), now(), :ip_upd)");
    $this->query1 = "";
    $this->query2 = "";

    $stmt = $this->conn->prepare($this->query);

    foreach ($this->xx as $x) :
      if(isset($this->$x)) : $stmt->bindParam(":".$x, $this->$x); endif;
    endforeach;
    $stmt->bindParam(":ip_upd", $_SERVER["REMOTE_ADDR"]);

    if($stmt->execute()) : 

      $this->query = $this->queryBeautifier("UPDATE `".$this->tablename."` SET `ids_breadcrumb_trail` = `id` WHERE `ids_breadcrumb_trail` = ''");
      $stmt = $this->conn->prepare($this->query);
      if($stmt->execute()) : 
        $this->lastid = $this->conn->lastInsertId(); 
        return true; 
      endif;

    endif;

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

//  $this->rowcount = $stmt->rowCount();
    $this->rowcount = $stmt->rowCount();
    $this->id = $stmt->fetchColumn();

    return true;

  }



# ......................................................................................................................................
# ...####..######.######...#####..#####..######..####..#####...####..#####..##..##.##...##.#####....######.#####...####..######.##......
# ..##.....##.......##.....##..##.##..##.##.....##..##.##..##.##..##.##..##.##..##.###.###.##..##.....##...##..##.##..##...##...##......
# ..##.###.####.....##.....#####..#####..####...######.##..##.##.....#####..##..##.##.#.##.#####......##...#####..######...##...##......
# ..##..##.##.......##.....##..##.##..##.##.....##..##.##..##.##..##.##..##.##..##.##...##.##..##.....##...##..##.##..##...##...##......
# ...####..######...##.....#####..##..##.######.##..##.#####...####..##..##..####..##...##.#####......##...##..##.##..##.######.######..
# ......................................................................................................................................

  function getBreadcrumbTrail() {

    #Intimacy 0 : For owner's eyes
    #Intimacy 1 : For admin's eyes
    #Intimacy 2 : Public

//  echo $this->find_in_set_count; # 3 pedidos desde la URL
//  echo $this->find_in_set; # los 3 tal cual se pidieron desde la URL
//  echo "<hr>";

    $this->rowcount = 0;

//  if(count($this->find_in_set)>0) :
    if($this->find_in_set_count>0) :

      $this->query = "SELECT GROUP_CONCAT(".$this->tableletter.".`id` ORDER BY FIND_IN_SET(".$this->tableletter.".`url_title`,'".$this->find_in_set."')) AS ref FROM `".$this->tablename."` ".$this->tableletter." WHERE ".$this->tableletter.".`url_title` IN(".$this->in.") LIMIT 1 ";

      $this->query = $this->queryBeautifier($this->query);
//    echo $this->query;

      $stmt = $this->conn->prepare($this->query);
      $stmt->execute();
      $this->rowcount = $stmt->rowCount();

      $this->ids_breadcrumb_trail = $stmt->fetchColumn();

      $this->real_find_in_set = explode(",",$this->ids_breadcrumb_trail);
      $this->real_find_in_set_count = count($this->real_find_in_set);

/* Si no coincide el recuento de «elementos de ruta» entre lo que se pidió y lo que se encuentra, PARAMOS  */

//    echo "<hr>";
      if($this->find_in_set_count != $this->real_find_in_set_count) : return false; endif;

//    echo $this->find_in_set_count ."|". $this->real_find_in_set_count;
//    echo "seguimos!!";


      $this->last_id_breadcrumb_trail = explode(",",$this->ids_breadcrumb_trail);
      $this->last_id_breadcrumb_trail = end($this->last_id_breadcrumb_trail);

/*
      echo $this->ids_breadcrumb_trail; // el ids_breadcrumb_trail
      echo $this->last_id_breadcrumb_trail; // el last_id_breadcrumb_trail
*/


      $this->query = "

        SELECT  GROUP_CONCAT(REPEAT('',level-1), id) AS real_breadcrumb_trail
        FROM    (
                SELECT  
                        _id AS id,
                        parent_id,
                        @cl := @cl + 1 AS level
                FROM    (
                        SELECT  @r AS _id,
                                (
                                SELECT  @r := parent_id
                                FROM `".$this->tablename."`
                                WHERE   id = _id
                                ) AS parent_id,
                                @l := @l + 1 AS level
                        FROM    (
                                SELECT  @r := ".$this->last_id_breadcrumb_trail.",
                                        @l := 0,
                                        @cl := 0
                                ) vars,
                                `".$this->tablename."` h
                        WHERE   @r <> 0
                        ORDER BY
                                level DESC
                        ) qi
                ) qo
        ;

      ";

      $stmt = $this->conn->prepare($this->query);
      $stmt->execute();
      $this->real_rowcount = $stmt->rowCount();
      $this->real_breadcrumb_trail = $stmt->fetchColumn();

/*
      echo " |  ".$this->real_rowcount;
      echo "<hr>";
      echo ">>".$this->ids_breadcrumb_trail;
      echo "<hr>";
      echo ">>".$this->real_breadcrumb_trail;
      echo "<hr>";
      die();
*/



      $this->query = "SELECT GROUP_CONCAT(h.`url_title` ORDER BY FIND_IN_SET(h.`id`,'".$this->real_breadcrumb_trail."') SEPARATOR '/') AS thread FROM `".$this->tablename."` h WHERE h.`id` IN (".$this->real_breadcrumb_trail.") ORDER BY FIND_IN_SET(h.`id`,'".$this->real_breadcrumb_trail."');";
      $stmt = $this->conn->prepare($this->query);
      $stmt->execute();
      $this->real_thread_trail = $stmt->fetchColumn();


      if($this->ids_breadcrumb_trail == $this->real_breadcrumb_trail) : return true; endif;
      return false;
      die();


/*
SELECT  id, GROUP_CONCAT(REPEAT('',level-1), id) AS treeitem
FROM    (
        SELECT  
                _id AS id,
                parent_id,
                @cl := @cl + 1 AS level
        FROM    (
                SELECT  @r AS _id,
                        (
                        SELECT  @r := parent_id
                        FROM    ciugauesece2_pages
                        WHERE   id = _id
                        ) AS parent_id,
                        @l := @l + 1 AS level
                FROM    (
                        SELECT  @r := 2,
                                @l := 0,
                                @cl := 0
                        ) vars,
                        ciugauesece2_pages h
                WHERE   @r <> 0
                ORDER BY
                        level DESC
                ) qi
        ) qo
;
*/

//    die();

    endif;

    }

# .. END GET BREADCRUMB TRAIL
# ......................................................................................................................................



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

    if(isset($this->last_id_breadcrumb_trail)) : $this->ref = $this->id = $this->last_id_breadcrumb_trail; endif;

    $this->dupeTitle = 0;

    $this->query = "@id:=".$this->tableletter.".`id` AS id, ";
//  $this->query.= "@ids_breadcrumb_trail:=".$this->tableletter.".`ids_breadcrumb_trail` AS ids_breadcrumb_trail, ";
    foreach ($this->xx as $x) :
      $this->query.= $this->tableletter.".`".$x."` AS ".$x.", ";
    endforeach;

//  BREADCRUMB TRAIL IDs
    $this->query.=
    "@ids_breadcrumb_trail:= TRIM(LEADING '0,' FROM CONCAT((SELECT GROUP_CONCAT(_parent)
     FROM (
     SELECT @r AS _id,
            (SELECT @r:=".$this->tableletter.".parent_id FROM `".$this->tablename."` ".$this->tableletter." WHERE ".$this->tableletter.".id=_id) AS _parent,
            @l:= @l+1 AS _level
     FROM (SELECT @r:=".$this->id.",@l:=0,@cl:=0) AS _vars, `".$this->tablename."` ".$this->tableletter." WHERE @r <> 0
     ORDER BY _level DESC
     ) bt),',',@id)) AS ids_breadcrumb_trail, ";

//  BREADCRUMB TRAIL URLs
    $this->query.=
    "CONCAT((SELECT GROUP_CONCAT(".$this->tableletter.".`url_title` ORDER BY FIND_IN_SET(".$this->tableletter.".`id`,@ids_breadcrumb_trail) SEPARATOR '/') FROM `".$this->tablename."` ".$this->tableletter." WHERE FIND_IN_SET(".$this->tableletter.".`id`,@ids_breadcrumb_trail))) AS path, ";

    $this->query = "SELECT " .$this->query."FROM `".$this->tablename."` ".$this->tableletter." WHERE " .
                  ($this->intimacy == 2 ? $this->tableletter.".`id_status` > 0 AND " : "") .
                   $this->tableletter.".`".($this->intimacy == 2 ? $this->cconf["file"]["ref"] : "ref")."` = ? " .
                   "LIMIT 0,1";

    $this->query = $this->queryBeautifier($this->query);
//  echo $this->query;
//  die();

    $stmt = $this->conn->prepare($this->query);
    $stmt->bindParam(1,$this->ref);
    $stmt->execute();

    $this->rowcount = $stmt->rowCount();

    if($this->rowcount > 0) :

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      foreach($row as $k=>$v) : $this->$k = $v; endforeach;

    endif;

    }

# .. END READ ONE
# ......................................................
/*


  function readOne() {

    #Intimacy 0 : For owner's eyes
    #Intimacy 1 : For admin's eyes
    #Intimacy 2 : Public

    $this->dupeTitle = 0;

    $this->query = "@id:=".$this->tableletter.".`id` as id, ";
    foreach ($this->xx as $x) :
      $this->query.= $this->tableletter.".`".$x."` as ".$x.", ";
    endforeach;

/*
//  JSONLABELS
    $this->query.=
    "CONCAT(\"'\",".$this->tableletter.".`ids_labels`,\"'\") AS ids_labels, " .
    "CONCAT((SELECT GROUP_CONCAT('{\"value\":',".$this->labels_tableletter.".`id`,',\"name_".LANG."\":',CONCAT('\"',REPLACE(REPLACE(".$this->labels_tableletter.".`name_".LANG."`,'\"','&#8243;'),'\\'','&#8242;'),'\"'),'}' ORDER BY FIND_IN_SET(".$this->labels_tableletter.".`id`, REPLACE(".$this->tableletter.".`ids_labels`,' ',''))) FROM `".$this->labels_tablename."` ".$this->labels_tableletter.", `".$this->tablename."` ".$this->tableletter." WHERE ".$this->tableletter.".`id` = @id AND FIND_IN_SET(".$this->labels_tableletter.".`id`, REPLACE(".$this->tableletter.".`ids_labels`,' ','')))) AS jsonlabels, ";
    $this->query.=
    "CONCAT(\"'\",".$this->tableletter.".`ids_labels`,\"'\") AS ids_labels, " .
    "CONCAT((SELECT GROUP_CONCAT('{\"value\":',".$this->labels_tableletter.".`id`,',\"name\":',CONCAT('\"',REPLACE(REPLACE(".$this->labels_tableletter.".`name`,'\"','&#8243;'),'\\'','&#8242;'),'\"'),'}' ORDER BY FIND_IN_SET(".$this->labels_tableletter.".`id`, REPLACE(".$this->tableletter.".`ids_labels`,' ',''))) FROM `".$this->labels_tablename."` ".$this->labels_tableletter.", `".$this->tablename."` ".$this->tableletter." WHERE ".$this->tableletter.".`id` = @id AND FIND_IN_SET(".$this->labels_tableletter.".`id`, REPLACE(".$this->tableletter.".`ids_labels`,' ','')))) AS jsonlabels, ";
    $this->query = "SELECT " .$this->query."FROM `".$this->tablename."` ".$this->tableletter." WHERE " .
                  ($this->intimacy == 2 ? $this->tableletter.".`id_status` > 0 AND " : "") .
                   $this->tableletter.".`".($this->intimacy == 2 ? $this->cconf["file"]["ref"] : "ref")."` = ? " .
                   "LIMIT 0,1";

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
//  $stmt->bindParam(1,$this->ref);
    $stmt->bindParam(1,$this->last_id_breadcrumb_trail);
    $stmt->execute();

    $this->rowcount = $stmt->rowCount();

    if($this->rowcount > 0) :

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      foreach($row as $k=>$v) : $this->$k = $v; endforeach;

    endif;

    }

# .. END READ ONE
# ......................................................

*/























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
                              (isset($this->url_value) ? $this->tableletter.".`url_".$this->field."` = :url_value, " : "" ) . 
                              $this->tableletter.".`ip_upd` = :ip_upd, " .
                              $this->tableletter.".`date_upd` = now(), " .
                              "WHERE ".$this->tableletter.".`id` = :pk";

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
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
# ..##..##.#####..#####...####..######.######....####..##..##.######..
# ..##..##.##..##.##..##.##..##...##...##.......##..##.###.##.##......
# ..##..##.#####..##..##.######...##...####.....##..##.##.###.####....
# ..##..##.##.....##..##.##..##...##...##.......##..##.##..##.##......
# ...####..##.....#####..##..##...##...######....####..##..##.######..
# ....................................................................

  function updateOne() {

    $this->dupeTitle = 0;

    if(isset($this->title_en)) :

      $this->query = "SELECT " .
               $this->tableletter.".`id` " .
               "FROM `".$this->tablename."` ".$this->tableletter." " .
               "WHERE ".$this->tableletter.".`title_en` = :title_en , " .
               "AND ".$this->tableletter.".`ref` <> :ref " .
               "LIMIT 0,1";

      $this->query = $this->queryBeautifier($this->query);

      $stmt = $this->conn->prepare($this->query);
      $stmt->bindParam(":ref", $this->ref);
      $stmt->bindParam(":title_en", $this->title_en);
      $stmt->execute();
      $this->dupeTitle = $stmt->rowCount();
      $this->query = "";

    endif;

    if($this->dupeTitle > 0) :

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
                    (isset($this->ref)?" AND ".$this->tableletter.".`ref` <> '".$this->ref."' ":"") .
                    (isset($this->search)?" AND ".$this->tableletter.".`parent_id` = ".$this->search." ":"") .
                    "AND ".$this->tableletter.".`title_en` COLLATE utf8mb4_unicode_ci NOT LIKE '".$this->cconf["default"]["title_en"]."%' " .
                    "ORDER BY ". $this->tableletter.".`id_status` ASC, CASE WHEN ".$this->tableletter.".`title_en` COLLATE utf8mb4_unicode_ci LIKE '".$this->cconf["default"]["title_en"]."%' THEN 1 ELSE 2 END, ".$this->tableletter.".`title_en` COLLATE utf8mb4_unicode_ci ASC ";

/*
SELECT *
FROM `ciugauesece_pages`
WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(ids_breadcrumb_trail,',',-2),',',1) = "2"
*/

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
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

    $this->query1 = "";
    $this->query2 = "";

    $this->query1.= "@id:=".$this->tableletter.".`id` as id, ";
    foreach ($this->xx as $x) :
      $this->query1.= $this->tableletter.".`".$x."`, ";
      $this->query2.= !in_array($x,$this->xx_notinsearch) ? $this->tableletter.".`".$x."`, " : "";
    endforeach;

    $qwhere = ((isset($this->intimacy) && $this->intimacy > 1 || $where) ? " WHERE " : " ") .
    (isset($this->intimacy) && $this->intimacy > 1  ? $this->tableletter.".`id_status` = 1 ".($where?"AND ":" ") : " ") .
    ($where ? "CONCAT(".$this->query2.") LIKE '%".$where."%' " : " ");

    $this->query = "SELECT ".$this->tableletter.".`id` "."FROM `".$this->tablename."` ".$this->tableletter.$qwhere;

    $this->query = $this->queryBeautifier($this->query);

    $stmt = $this->conn->prepare($this->query);
    $stmt->execute();
    $this->rowcount_absolute = $stmt->rowCount();

    $this->query = "SELECT ".$this->query1." FROM `".$this->tablename."` ".$this->tableletter.$qwhere.
                   "ORDER BY ". $this->tableletter.".`id_status` ASC, CASE WHEN ".$this->tableletter.".`title_en` COLLATE utf8mb4_unicode_ci LIKE '".$this->cconf["default"]["title_en"]."%' THEN 1 ELSE 2 END, ".$this->tableletter.".`title_en` COLLATE utf8mb4_unicode_ci ASC " .
//                 "ORDER BY ". $this->tableletter.".`id_status` ASC, `date` DESC " .
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


}

?>
