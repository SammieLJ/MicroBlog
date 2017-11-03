<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 13.11.11
 * Time: 18:29
 * To change this template use File | Settings | File Templates.
 */
include_once("classes/Microblog/Model/Entry.php");
include_once("classes/Microblog/Model/User.php");
include_once("classes/Microblog/Config/ConfigDB.php");

class ReadFromDB {

    //member vars
    private $db;
    private $query;
    private $stmt;

    //for Entry reading
    private $idEntry;
    private $headline;
    private $body;
    private $email;
    private $weburl;
    private $id_User;
    private $date;
    private $author;

    //for password reading
    private $password;

    //for user login
    //private $users_id;
    private $users_name;
    private $users_password;
    private $user_level;
    private $role_desc;

    //for user roles
    private $idRole;
    private $ShortDescription;
    private $LongDescription;

    //getEntry
    private $entryObj;

    function __construct() {
        $this->db = new mysqli(ConfigDB::DbAddress,
                                ConfigDB::DbUsername,
                                ConfigDB::DbPassword,
                                ConfigDB::DbDatabase,
                                ConfigDB::DbPort);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }

    function __destruct() {
        /* close connection */
        $this->stmt->close();
    }

    function getUserPassword($userId) {
        $this->query = "SELECT `password` FROM users WHERE id=? AND deleted=FALSE";

        if ($this->stmt = $this->db->prepare($this->query)) {

            /* escape chars */
            $userId = $this->db->real_escape_string($userId);

            /* bind sql stmnt params */
            $this->stmt -> bind_param("i", $userId);

            /* execute query */
            $this->stmt->execute();

            /* bind result variables */
            $this->stmt->bind_result($this->password);

            while ($this->stmt->fetch()) {
                $userPassword = $this->password;
            }

        }
        
        return $userPassword;
    }

    function getEntries() {
        $temp_entries = array();
        $this->query = "SELECT en.`idEntry`, en.`headline`, en.`body`, en.`email`, en.`weburl`, en.`idUser`, en.`datestamp`, u.`username`
                  FROM `entries` AS en
                  INNER JOIN `users` AS u
                  ON en.`idUser`=u.`id`
                  WHERE en.`deleted`=0";


        if ($this->stmt = $this->db->prepare($this->query)) {

            /* execute query */
            $this->stmt->execute();

            /* bind result variables */
            $this->stmt->bind_result($this->idEntry, $this->headline, $this->body, $this->email, $this->weburl, $this->id_User, $this->date, $this->author);

            /* fetch values */
            while ($this->stmt->fetch()) {
                $entryObj = new Entry($this->idEntry, $this->headline, $this->body, $this->email, $this->weburl, $this->id_User, $this->date, $this->author);
                $temp_entries[] = $entryObj;
            }
        }
        return $temp_entries;
    }

    function getEntry($entryId) {
        $this->query = "SELECT en.`idEntry`, en.`headline`, en.`body`, en.`email`, en.`weburl`, en.`idUser`, en.`datestamp`, u.`username`
                  FROM `entries` AS en
                  INNER JOIN `users` AS u
                  ON en.`idUser`=u.`id`
                  WHERE en.`deleted`=0 AND en.`idEntry`=?";

        if ($this->stmt = $this->db->prepare($this->query)) {

             /* escape chars */
            $entryId = $this->db->real_escape_string($entryId);

            /* bind sql stmnt params */
            $this->stmt -> bind_param("i",$entryId);

            /* execute query */
            $this->stmt->execute();

            /* bind result variables */
            $this->stmt->bind_result($this->idEntry, $this->headline, $this->body, $this->email, $this->weburl, $this->id_User, $this->date, $this->author);

            /* fetch values */
            while ($this->stmt->fetch()) {
                $this->entryObj = new Entry($this->idEntry, $this->headline, $this->body, $this->email, $this->weburl, $this->id_User, $this->date, $this->author);
            }
        }
        return $this->entryObj;
    }

    function getLoginUser($username, $password, &$dbUserId, &$dbusername, &$dbpassword, &$dbUserLevel, &$dbRoleDesc) {
        $numrows = 0;
        $this->query = "SELECT u.`id`, u.`username`, u.`password`, u.`userLevelId`, r.`ShortDesc`
                  FROM `users` AS u
                  INNER JOIN `roles` AS r
                  ON u.`userLevelId` = r.`idRole`
                  WHERE u.`username`=? AND u.`password`=? AND deleted=FALSE";

        if ($this->stmt = $this->db->prepare($this->query)) {

            /* escape chars */
            $username = $this->db->real_escape_string($username);
            $password = $this->db->real_escape_string($password);

            /* bind sql stmnt params */
            $this->stmt -> bind_param("ss",$username, $password);

            /* execute query */
            $this->stmt->execute();

            /* bind result variables */
            $this->stmt->bind_result($this->id_User, $this->users_name, $this->users_password, $this->user_level, $this->role_desc);

            /* fetch values */
            while ($this->stmt->fetch()) {
                $dbUserId = $this->id_User;
                $dbusername = $this->users_name;
                $dbpassword = $this->users_password;
                $dbUserLevel = $this->user_level;
                $dbRoleDesc = $this->role_desc;
                $numrows += 1;
            }
        }
        return $numrows;
    }

    function getUsersList() {
        $usersList = array();
        $this->query = "SELECT u.`id`, u.`username`, u.`password`, u.`userLevelId`, r.`ShortDesc`
                        FROM `users` AS u
                        INNER JOIN `roles` AS r
                        ON u.`userLevelId` = r.`idRole` AND deleted=FALSE";
       if ($this->stmt = $this->db->prepare($this->query)) {
            /* execute query */
            $this->stmt->execute();

            /* bind result variables */
            $this->stmt->bind_result($this->id_User, $this->users_name, $this->users_password, $this->user_level, $this->role_desc);

            /* fetch values */
            while ($this->stmt->fetch()) {
                $userObj = new User($this->id_User,
                           $this->users_name,
                           $this->users_password,
                           $this->user_level,
                           $this->role_desc);
                $usersList[] = $userObj;
            }
        }
        return $usersList;
    }

    function getUserRolesList() {
        $userRolesList = array();

        $this->query = "SELECT `idRole`, `ShortDesc`, `Description` FROM `roles`";
        if ($this->stmt = $this->db->prepare($this->query)) {
            /* execute query */
            $this->stmt->execute();

            /* bind result variables */
            $this->stmt->bind_result($this->idRole, $this->ShortDescription, $this->LongDescription);

            /* fetch values */
            while ($this->stmt->fetch()) {
                $userRolesList[$this->idRole] = $this->LongDescription;
            }
        }
        return $userRolesList;
    }

}
?>
