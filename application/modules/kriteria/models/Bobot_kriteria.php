<?php 

class Bobot_kriteria extends MY_Model
{
    public $table='bobot_kriteria';
    public $primary_key='id';
    public $protected = array('id');
    public $soft_deletes = FALSE;
    public $timestamps = FALSE;

    public function __construct()
    {
        $this->has_one['kriteria'] = array('foreign_model'=>'kriteria_m','foreign_table'=>'kriteria','foreign_key'=>'id','local_key'=>'id_kriteria');
        $this->has_one['bobot'] = array('foreign_model'=>'bobot_m','foreign_table'=>'bobot','foreign_key'=>'id','local_key'=>'id_bobot');
        parent::__construct();
        $this->load->database();
    }
}
