<?php

class Rating_kecocokan_model extends MY_Model
{
    public $table = 'rating_kecocokan';
    public $protected = array('id');
    public $primary_key = 'id';
    public $soft_deletes = FALSE;
    public $timestamps = FALSE;

    public function __construct(){
        
        $this->has_many['guru'] = array(
            'foreign_model'=>'guru/models/guru_m',
            'foreign_table'=>'guru',
            'foreign_key'=>'id',
            'local_key'=>'id_guru');
            
        $this->has_many['kriteria'] = array(
            'foreign_model'=>'kriteria/model/kriteria_m',
            'foreign_table'=>'kriteria',
            'foreign_key'=>'id',
            'local_key'=>'id_kriteria');

        parent::__construct();
        $this->load->database();
    }

    public function rating($id_guru,$id_kriteria){
        $query = $this->db->query('SELECT id,nilai from rating_kecocokan WHERE id_guru='.$id_guru.' AND id_kriteria='.$id_kriteria);
        return $query;
    }

}