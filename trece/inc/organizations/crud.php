<?php if(!defined("TRECE")):header("location:./");die();endif; ?>
<?php
//ORGANIZATIONS

# ......................................................................................................................
# ...#######..########...######......###....##....##.####.########....###....########.####..#######..##....##..######...
# ..##.....##.##.....##.##....##....##.##...###...##..##.......##....##.##......##.....##..##.....##.###...##.##....##..
# ..##.....##.##.....##.##.........##...##..####..##..##......##....##...##.....##.....##..##.....##.####..##.##........
# ..##.....##.########..##...####.##.....##.##.##.##..##.....##....##.....##....##.....##..##.....##.##.##.##..######...
# ..##.....##.##...##...##....##..#########.##..####..##....##.....#########....##.....##..##.....##.##..####.......##..
# ..##.....##.##....##..##....##..##.....##.##...###..##...##......##.....##....##.....##..##.....##.##...###.##....##..
# ...#######..##.....##..######...##.....##.##....##.####.########.##.....##....##....####..#######..##....##..######...
# ......................................................................................................................

// http://patorjk.com/software/taag/#p=display&f=Banner4&t=%20TRECE%20
// http://patorjk.com/software/taag/#p=display&f=Bright&t=Deprecated
// https://stackoverflow.com/questions/8154158/mysql-how-do-i-use-delimiters-in-triggers













class Organizations{

  private $conn;



  //object properties
  public $id;
  public $id_status;
  public $id_approver;
  public $id_delegate;
  public $name;
  public $url_name;
  public $contact_person_name;
  public $contact_person_surname;
  public $contact_person_email;
  public $intro;
  public $id_region;
  public $first_message;
  public $whatwedo;
  public $ids_labels;
  public $website;
  public $phones;
  public $date_reg;
  public $date_upd;
  public $ip_upd;
  public $ref;
  public $loops_ref;

  public $query = "";
  public $query1 = "";
  public $query2 = "";
  public $xx = ["id_status","id_approver","id_delegate","name","url_name","contact_person_name","contact_person_surname","contact_person_email","intro","id_region","first_message","whatwedo","ids_labels","website","phones","date_upd","ip_upd","ref","loops_ref"];
  public $xx_updateOne = ["id_status","id_approver","id_delegate","name","url_name","contact_person_name","contact_person_surname","contact_person_email","intro","id_region","first_message","whatwedo","ids_labels","website","phones"];
  public $xx_notinsearch = ["id_status","date","ref","loops_ref","date_upd","ip_upd"];



  public function __construct($db,$conf=null,$cconf=null,$lCommon=null,$lCustom=null) {

    $this->conn                = $db;
    $this->conf                = $conf;
    $this->cconf               = $cconf;
    $this->lCommon             = $lCommon;
    $this->lCustom             = $lCustom;
    $this->tablename           = explode("|",$this->conf["table"]["organizations"]);
    $this->tableletter         = $this->tablename[1];
    $this->tablename           = $this->tablename[0];
    $this->users_tablename     = explode("|",$this->conf["table"]["users"]);
    $this->users_tableletter   = $this->users_tablename[1];
    $this->users_tablename     = $this->users_tablename[0];

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

    $query = "SELECT ".$this->tableletter.".`id` FROM `".$this->tablename."` ".$this->tableletter." WHERE " .
              ($this->intimacy == 2 ? $this->tableletter.".`id_status` = 1 AND " : "") .
              $this->tableletter.".`".($this->intimacy == 2 ? $this->cconf["file"]["ref"] : "ref")."` = ? LIMIT 0,1";

    $query = $this->queryBeautifier($query);

    $stmt = $this->conn->prepare($query);
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

    $this->dupeTitle = 0;

    $query = "@id:=".$this->tableletter.".`id` as id, ";
    foreach ($this->xx as $x) :
      $query.= $this->tableletter.".`".$x."` as ".$x.", ";
    endforeach;

    $query = "SELECT " .$query."FROM `".$this->tablename."` ".$this->tableletter." WHERE " .
              ($this->intimacy == 2 ? $this->tableletter.".`id_status` > 0 AND " : "") .
               $this->tableletter.".`".($this->intimacy == 2 ? $this->cconf["file"]["ref"] : "ref")."` = ? " .
             "LIMIT 0,1";

    $query = $this->queryBeautifier($query);

    $stmt = $this->conn->prepare($query);
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



# ....................................................................................................................................................
# ..##..##.#####..#####...####..######.######...####..##..##.######....####..######.##..##..####..##.....######...######.######.######.##.....#####...
# ..##..##.##..##.##..##.##..##...##...##......##..##.###.##.##.......##.......##...###.##.##.....##.....##.......##.......##...##.....##.....##..##..
# ..##..##.#####..##..##.######...##...####....##..##.##.###.####......####....##...##.###.##.###.##.....####.....####.....##...####...##.....##..##..
# ..##..##.##.....##..##.##..##...##...##......##..##.##..##.##...........##...##...##..##.##..##.##.....##.......##.......##...##.....##.....##..##..
# ...####..##.....#####..##..##...##...######...####..##..##.######....####..######.##..##..####..######.######...##.....######.######.######.#####...
# ....................................................................................................................................................

  function updateOneSingleField() {} # PTE

  function approveOrganization() {

    $query = "UPDATE `".$this->tablename."` ".
              $this->tableletter." SET " .
              $this->tableletter.".`".$this->field."` = :value, " .
              (isset($this->url_value) ? $this->tableletter.".`url_".$this->field."` = :url_value, " : "" ) . 
              $this->tableletter.".`ip_upd` = :ip_upd, " .
              $this->tableletter.".`date_upd` = now(), " .
              (
                $this->value == 1 ? $this->tableletter.".`id_approver`    = :id_who, "
                                  : $this->tableletter.".`id_disapprover` = :id_who, "
              ) .
             "WHERE ".$this->tableletter.".`id` = :pk";

    $query = $this->queryBeautifier($query);

    $stmt = $this->conn->prepare($query);
                                  $stmt->bindParam(":value",      $this->value);
    if(isset($this->url_value)) : $stmt->bindParam(":url_value",  $this->url_value); endif;
                                  $stmt->bindParam(":pk",         $this->pk);
                                  $stmt->bindParam(":id_who",     $this->id_who);
                                  $stmt->bindParam(":ip_upd",     $_SERVER["REMOTE_ADDR"]);

//  $stmt->execute();

//  Esta parte anterior únicamente cambia el id_status
//  Realmente NO ES la parte en que aprueba la Organización.
//  La función approveOrganization tiene un mal nombre.
//  De hecho el id_approver = :id_who debería asignarse cuando se asigna id_approved!!!


    if($stmt->execute()) : 

      if($this->value == 1) : $this->approveOrganizationStuff(); else: $this->disapproveOrganizationStuff(); endif;
      return true; 

    endif;
    return false;

    }

# .. END UPDATE ONE SINGLE FIELD
# ....................................................................................................................................................




  function approveOrganizationStuff() {

    $newbie = false;

    $query = "SELECT ".
               $this->tableletter.".`id` AS id, ".
               $this->tableletter.".`id_approved` AS id_approved, ".
               $this->tableletter.".`contact_person_name` AS contact_person_name, ".
               $this->tableletter.".`contact_person_surname` AS contact_person_surname, ".
               $this->tableletter.".`contact_person_email` AS contact_person_email, ".
             "FROM `".$this->tablename."` ".$this->tableletter." WHERE " .
               $this->tableletter.".`id` = ? " .
             "LIMIT 0,1";

    $query = $this->queryBeautifier($query);

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1,$this->pk);

    if($stmt->execute()) : 

      $this->rowcount = $stmt->rowCount();

      if($this->rowcount > 0) :

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach($row as $k=>$v) : $this->$k = $v; endforeach;

        if($this->id_approved == 0) :

          $newbie = true;

//        APROBAMOS a la organización

          $query = "UPDATE `".$this->tablename."` SET `id_approved` = 1 WHERE `id` = ?";
          $stmt = $this->conn->prepare($query);
          $stmt->bindParam(1,$this->pk);

          if($stmt->execute()) : 

//          INSERTAMOS al usuario/a «delegate» de esta organización

            $this->randomizer("ref",8,"users_");
            $this->contact_person_username = getUrlFriendlyString($this->contact_person_name,"");

            $query = "INSERT INTO `".$this->users_tablename."` " .
                     "(`id_status`,`uhierarchy`,`ugender`,`name`,`surname`,`username`,`email`,`id_organization`,`date_reg`,`date_upd`,`ip_upd`,`ref`,`loops_ref`) VALUES " .
                     "(1,2,'w',:contact_person_name,:contact_person_surname,:contact_person_username,:contact_person_email,:id_organization,now(),now(),:ip_upd,:ref,:loops_ref)";

            $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(":contact_person_name",      $this->contact_person_name);
                    $stmt->bindParam(":contact_person_surname",   $this->contact_person_surname);
                    $stmt->bindParam(":contact_person_username",  $this->contact_person_username);
                    $stmt->bindParam(":contact_person_email",     $this->contact_person_email);
                    $stmt->bindParam(":id_organization",          $this->pk);
                    $stmt->bindParam(":ip_upd",                   $_SERVER["REMOTE_ADDR"]);
                    $stmt->bindParam(":ref",                      $this->ref);
                    $stmt->bindParam(":loops_ref",                $this->loops_ref);

//          PTE!! Texto email: organización aprobada, usuario/a delegado admitido

          endif;

        else :

//        REAPROBAMOS a todos los usuarios/as «delegate» de esta organización

          $query = "UPDATE `".$this->users_tablename."` ".$this->users_tableletter .
                   " SET ".$this->users_tableletter.".`id_status`=1, ".$this->users_tableletter.".`date_upd`=now(), ".$this->users_tableletter.".`ip_upd`=:ip_upd " .
                   " WHERE ".$this->users_tableletter.".`id_organization` = :id_organization";

          $stmt = $this->conn->prepare($query);
                  $stmt->bindParam(":ip_upd",           $_SERVER["REMOTE_ADDR"]);
                  $stmt->bindParam(":id_organization",  $this->pk);

//        PTE!! Texto email: organización reaprobada, usuarios/as delegados readmitidos

        endif;

        $query = $this->queryBeautifier($query);
//      $stmt->execute();
        if($stmt->execute()) : 

          if($newbie) :

            $this->lastid = $this->conn->lastInsertId(); 
            $query = "UPDATE `".$this->tablename."` SET `id_delegate` = ? WHERE `id` = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->lastid);
            $stmt->bindParam(2, $this->pk);

            $stmt->execute();

          endif;

        endif;

//      PTE!! ENVIAR EMAIL CORRESPONDINETE

      endif;

    endif;

    return true;

  }



  function disapproveOrganizationStuff() {

    $query = "UPDATE `".$this->users_tablename."` ".$this->users_tableletter . 
             " SET ".$this->users_tableletter.".`id_status`=0, ".$this->users_tableletter.".`date_upd`=now(), ".$this->users_tableletter.".`ip_upd`=:ip_upd " .
             " WHERE ".$this->users_tableletter.".`id_organization` = :id_organization";

    $query = $this->queryBeautifier($query);

    $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id_organization",  $this->pk);
            $stmt->bindParam(":ip_upd",           $_SERVER["REMOTE_ADDR"]);

    $stmt->execute();

    return true;

  }





















# ....................................................................
# ..##..##.#####..#####...####..######.######....####..##..##.######..
# ..##..##.##..##.##..##.##..##...##...##.......##..##.###.##.##......
# ..##..##.#####..##..##.######...##...####.....##..##.##.###.####....
# ..##..##.##.....##..##.##..##...##...##.......##..##.##..##.##......
# ...####..##.....#####..##..##...##...######....####..##..##.######..
# ....................................................................

  function updateOne() {

    $this->dupeName = 0;

    if(isset($this->url_name)) :

      $query = "SELECT " .
                $this->tableletter.".`id` " .
               "FROM `".$this->tablename."` ".$this->tableletter." " .
               "WHERE ".$this->tableletter.".`url_name` = :url_name , " .
               "AND ".$this->tableletter.".`ref` <> :ref " .
               "LIMIT 0,1";

      $query = $this->queryBeautifier($query);

      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":ref", $this->ref);
      $stmt->bindParam(":url_name", $this->url_name);
      $stmt->execute();
      $this->dupeName = $stmt->rowCount();
      $query = "";

    endif;

    if($this->dupeName > 0) :

      return true;

    else :

      foreach ($this->xx_updateOne as $x) :
        $query.= isset($this->$x) && $x!="ref" ? $this->tableletter.".`".$x."` = :".$x.", " : "";
      endforeach;

      $query = "UPDATE `".$this->tablename."` ".
                $this->tableletter." SET " .$query.
                $this->tableletter.".`date_upd` = now(), " .
                $this->tableletter.".`ip_upd` = :ip_upd, " .
               "WHERE ".$this->tableletter.".`ref` = :ref";

      $query = $this->queryBeautifier($query);

      $stmt = $this->conn->prepare($query);
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

    $query = "DELETE ".$this->tableletter.".*, ".$this->users_tableletter.".* " . 
             "FROM `".$this->tablename."` ".$this->tableletter." LEFT JOIN `".$this->users_tablename."` ".$this->users_tableletter. " " .
             "ON ".$this->users_tableletter. ".id_organization = ".$this->tableletter. ".id " .
             "WHERE ".$this->tableletter. ".id = ?";
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
             "AND ".$this->tableletter.".`title_en` COLLATE utf8mb4_unicode_ci NOT LIKE '".$this->cconf["default"]["title_en"]."%' " .
              (isset($this->search)?"AND CONCAT(".$query2.") LIKE '%".$this->search."%' ":"") .
             "ORDER BY ". $this->tableletter.".`date` DESC";

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

  function readAll($records_per_page=6,$page=0,$from_record_num=0,$where=null,$searchLabel=null) {

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
    ($where ? "CONCAT(".$query2.") LIKE '%".$where."%' " : " ") .
    (!is_null($searchLabel) && !empty($searchLabel) ? ((isset($this->intimacy) && $this->intimacy > 1 || $where) ? " AND " : " WHERE ")." FIND_IN_SET(".$searchLabel.",".$this->tableletter.".`ids_labels`) " : " ");

    $query = "SELECT ".$this->tableletter.".`id` "."FROM `".$this->tablename."` ".$this->tableletter.$qwhere;

    $query = $this->queryBeautifier($query);

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $this->rowcount_absolute = $stmt->rowCount();

    $query = "SELECT ".$query1." FROM `".$this->tablename."` ".$this->tableletter.$qwhere.
             "ORDER BY ". $this->tableletter.".`id_status` ASC, CASE WHEN ".$this->tableletter.".`name` COLLATE utf8mb4_unicode_ci LIKE '".$this->cconf["default"]["name"]."%' THEN 1 ELSE 2 END, ".$this->tableletter.".`name` COLLATE utf8mb4_unicode_ci DESC " .
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
        $mail->setFrom($this->mail_from,html_entity_decode($this->conf["meta"]["name"][LANG],ENT_QUOTES | ENT_XML1,"UTF-8"));
        $mail->addAddress($this->mail_to);
        $mail->addReplyTo($this->mail_from,html_entity_decode($this->conf["meta"]["name"][LANG],ENT_QUOTES | ENT_XML1,"UTF-8"));
        $mail->isHTML(true);
        $mail->Subject = html_entity_decode($this->mail_subject, ENT_QUOTES | ENT_XML1,"UTF-8");
        $mail->Body = html_entity_decode($this->mail_message, ENT_QUOTES | ENT_XML1,"UTF-8");
        $mail->AltBody = strip_tags(str_replace(array("<br>","<br/>","<br />"),"\r\n",html_entity_decode($this->mail_message, ENT_QUOTES | ENT_XML1,"UTF-8")));
        $mail->send();
        return true;
        } catch (Exception $e) { echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo; }
    }

# .. END SEND_EMAIL
# ..........................................................................



}

?>
