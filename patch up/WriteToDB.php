<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 13.11.11
 * Time: 17:00
 * To change this template use File | Settings | File Templates.
 */
namespace classes\Microblog\Db;
include_once("classes/Microblog/Config/ConfigDB.php");

class WriteToDB {

    //member vars
    private $db;
    private $query;
    private $stmt;

    //returned insert id
    private $insertId;

    //update ok
    private $updateOk;

    function __construct() {
        $this->db = new \mysqli(\classes\Microblog\Config\ConfigDB::DbAddress,
                                \classes\Microblog\Config\ConfigDB::DbUsername,
                                \classes\Microblog\Config\ConfigDB::DbPassword,
                                \classes\Microblog\Config\ConfigDB::DbDatabase,
                                \classes\Microblog\Config\ConfigDB::DbPort);

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

    function writeNewPassword($password, $userId) {

        $this->query = "UPDATE users SET `password`=? WHERE id=?";
        if ($this->stmt = $this->db->prepare($this->query)) {

            /* escape chars */
            $password = $this->db->real_escape_string($password);
            $userId = $this->db->real_escape_string($userId);

            /* bind sql stmnt params */
            $this->stmt -> bind_param("si", $password, $userId);

            /* execute query */
            $this->updateOk = $this->stmt->execute();
        }

        return $this->updateOk;
    }

    function addEntry($headline, $comment, $email, $website, $userId) {

         /* escape chars */
        $headline = $this->db->real_escape_string($headline);
        $comment = $this->db->real_escape_string($comment);
        $email = $this->db->real_escape_string($email);
        $website = $this->db->real_escape_string($website);
        //$userId is setted by db

        $this->query = "INSERT INTO `entries`(`headline`,`body`,`email`,`weburl`,`idUser`,`datestamp`) VALUES (?, ?, ?, ?, ?, now())";
        if ($this->stmt = $this->db->prepare($this->query)) {

            /* bind sql stmnt params */
            $this->stmt -> bind_param("ssssi",$headline, $comment, $email, $website, $userId);

            /* execute query */
            $this->stmt->execute();

            /* return new id */
            $this->insertId = $this->stmt->insert_id;
        }

        return $this->insertId;
    }

    function updateEntry($entryId, $headline, $comment, $email, $website) {

         /* escape chars */
        $headline = $this->db->real_escape_string($headline);
        $comment = $this->db->real_escape_string($comment);
        $email = $this->db->real_escape_string($email);
        $website = $this->db->real_escape_string($website);
        //entryId is setted by db

        $this->query = "UPDATE `entries`
                        SET `headline`=?, `body`=?, `email`=?, `weburl`=?
                        WHERE `idEntry`=?";
        if ($this->stmt = $this->db->prepare($this->query)) {

            /* bind sql stmnt params */
            $this->stmt -> bind_param("ssssi",$headline, $comment, $email, $website, $entryId);

            /* execute query */
            $this->stmt->execute();

        }
    }

    function deleteEntry($entryId) {
        /* escape chars */
        $entryId = $this->db->real_escape_string($entryId);

        $this->query = "UPDATE `entries` SET `deleted`=TRUE WHERE `idEntry`=?";
        if ($this->stmt = $this->db->prepare($this->query)) {

            /* bind sql stmnt params */
            $this->stmt -> bind_param("i", $entryId);

            /* execute query */
            $this->updateOk = $this->stmt->execute();
        }

        return $this->updateOk;
    }

    function addNewUser($userName, $password, $userLevelId) {

        /* escape chars */
        $userName = $this->db->real_escape_string($userName);
        $password = $this->db->real_escape_string($password);
        $userLevelId = $this->db->real_escape_string($userLevelId);

        $this->query = "INSERT INTO users (`username`, `password`, `userLevelId`)
                        VALUES (?, ?, ?)";
        if ($this->stmt = $this->db->prepare($this->query)) {

            /* bind sql stmnt params */
            $this->stmt -> bind_param("ssi", $userName, $password, $userLevelId);

            /* execute query */
            $this->stmt->execute();

            /* return new id */
            $this->insertId = $this->stmt->insert_id;
        }

        return $this->insertId;
    }

    function deleteUser($userId) {
        /* escape chars */
        $userId = $this->db->real_escape_string($userId);

        $this->query = "UPDATE users SET deleted=TRUE WHERE `id`=?";
        if ($this->stmt = $this->db->prepare($this->query)) {

            /* bind sql stmnt params */
            $this->stmt -> bind_param("i", $userId);

            /* execute query */
            $this->updateOk = $this->stmt->execute();
        }

        return $this->updateOk;
    }

    function insertEmail($email) {

        /* escape chars */
        $email = $this->db->real_escape_string($email);

        $this->query = "INSERT INTO emails (`email_address`)
                        VALUES (?)";
        if ($this->stmt = $this->db->prepare($this->query)) {

            /* bind sql stmnt params */
            $this->stmt -> bind_param("s", $email);

            /* execute query */
            $OK = $this->stmt->execute();
        }
        return $OK;
    }
}
?>