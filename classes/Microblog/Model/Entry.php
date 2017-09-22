<?php
/**
 * Created by JetBrains PhpStorm.
 * User: samir
 * Date: 12.11.11
 * Time: 0:30
 * To change this template use File | Settings | File Templates.
 */

class Entry {
    private $entryId;
    private $headline;
    private $body;
    private $email;
    private $weburl;
    private $userId;
    private $date;
    private $author;

    function __construct($entryId, $headline, $body, $email, $weburl, $userId, $date, $author) {
       $this->entryId = $entryId;
       $this->headline = $headline;
       $this->body = $body;
       $this->email = $email;
       $this->weburl = $weburl;
       $this->userId = $userId;
       $this->date = $date;
       $this->author = $author;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEntryId($entryId)
    {
        $this->entryId = $entryId;
    }

    public function getEntryId()
    {
        return $this->entryId;
    }

    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    public function getHeadline()
    {
        return $this->headline;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setWeburl($weburl)
    {
        $this->weburl = $weburl;
    }

    public function getWeburl()
    {
        return $this->weburl;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }
}
?>