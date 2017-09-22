<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 14.11.11
 * Time: 0:03
 * To change this template use File | Settings | File Templates.
 */

class User {

    //member vars
    private $idUser;
    private $usersName;
    private $usersPassword;
    private $usersLevel;
    private $roleDesc;


     function __construct($idUser, $usersName, $usersPassword, $usersLevel, $roleDesc) {
            $this->idUser = $idUser;
            $this->usersName = $usersName;
            $this->usersPassword = $usersPassword;
            $this->usersLevel = $usersLevel;
            $this->roleDesc = $roleDesc;
     }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setRoleDesc($roleDesc)
    {
        $this->roleDesc = $roleDesc;
    }

    public function getRoleDesc()
    {
        return $this->roleDesc;
    }

    public function setUsersLevel($usersLevel)
    {
        $this->usersLevel = $usersLevel;
    }

    public function getUsersLevel()
    {
        return $this->usersLevel;
    }

    public function setUsersName($usersName)
    {
        $this->usersName = $usersName;
    }

    public function getUsersName()
    {
        return $this->usersName;
    }

    public function setUsersPassword($usersPassword)
    {
        $this->usersPassword = $usersPassword;
    }

    public function getUsersPassword()
    {
        return $this->usersPassword;
    }
}
?>