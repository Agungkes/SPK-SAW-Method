<?php

class Hasil extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'hasil/rating_kecocokan_model'=> 'rk',
            'guru/Guru_m'           => 'guru',
            'kriteria/kriteria_m'   => 'kriteria',
            'kriteria/bobot_kriteria'=>'bk'
        ));
    }

    public function Ratingkecocokan(){ 
        $data['guru']     = $this->guru->get_all();
        $data['kriteria'] = $this->kriteria->get_all();
        $this->load->view('rating_kecocokan',$data);
    }

    public function addRating(){
        $id_guru = $this->input->post('id_guru');
        $id_krit = $this->input->post('id_krit');
        $nilai   = $this->input->post('nilai');

        $data = array(
            'id_guru'     => $id_guru,
            'id_kriteria' => $id_krit,
            'nilai'       => $nilai
        );

        $cek = $this->rk->rating($id_guru,$id_krit);
        if ($cek->num_rows()<1) {
            $this->rk->insert($data);
        }else{
            $id = array(
                'id_guru'       => $id_guru,
                'id_kriteria'   => $id_krit );
            $this->rk->update($data,$id);
        }
    }


    public function Normalisasi(){
        $data['guru']     = $this->guru->get_all();
        $data['kriteria'] = $this->kriteria->get_all();
        $this->load->view('matriks_normalisasi',$data);
    }

    public function Perangkingan()
    {
        $data['guru']     = $this->guru->get_all();
        $data['kriteria'] = $this->kriteria->get_all();
        $this->load->view('perangkingan',$data);
    }

    public function HasilPerangkingan()
    {
        $data['guru']     = $this->guru->get_all();
        $data['kriteria'] = $this->kriteria->get_all();
        $this->load->view('hasil_perangkingan',$data);
    }
}