<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * new \App\Add\Debug($db);
 * 
 */

namespace App\Add;

/**
 * Description of ВebugDB
 *
 * @author sv
 */
class Debug
{

    protected
            $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function db()
    {
        $err = $this->db->error();

        if ($err[1] != null || $err[2] != null)
        {
            var_dump($this->db->log());
            var_dump($err);
            die;
        }
        else
        {
            return true;
        }
    }

    public function error($db)
    {
        $err = $db->error();

        if ($err[1] != null || $err[2] != null)
        {
            return [
                'err' => $err,
                'log'   => $db->log()
            ];
        }
        else
        {
            return false;
        }
    }
    
    public function transaction($db)
    {
        $err = $db->error();

        if ($err[1] != null || $err[2] != null)
        {
            var_dump($db->log());
            var_dump($err);
            
            $db->query('ROLLBACK;');
            $db->query('SET AUTOCOMMIT=1;');
            die;
        }
        else
        {
            return true;
        }
    }

}
