<?php 
class Bobot_m extends MY_Model
{
    public $table        ="bobot";
    public $primary_key  = 'id';
    public $protected    = array('id');
    public $soft_deletes = FALSE;
    public $timestamps   = FALSE;
}
