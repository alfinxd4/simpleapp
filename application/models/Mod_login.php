<?php

class Mod_login extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    // auth data to database 
    function auth($email, $password)
    {
        // get data from database 
        $query = $this->db->query("SELECT * FROM account WHERE email='$email' AND
        password=MD5('$password') ");
        return $query;
    }
}
