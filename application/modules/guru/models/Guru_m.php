<?php

class Guru_m extends MY_Model
{
    public $table='guru';
    public $primary_key='id';
    public $protected=array('id');
    public $soft_deletes = FALSE;
    public $timestamps   = FALSE;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

}
