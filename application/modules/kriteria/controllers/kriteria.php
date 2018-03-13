<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model(array(
            'kriteria_m'    =>'kriteria',
            'bobot_m'       =>'bobot',
            'bobot_kriteria'=>'bk'
        ));
    }
    public function index(){
        $data['main']= $this->bk->with_kriteria()->with_bobot()->order_by('id','DESC')->get_all();
        $data['bobot']= $this->bobot->get_all();
    
        $this->load->view('kriteria_v2',$data);
    }

    public function editKriteria(){
        if ($this->input->post()):
            $id     = $this->input->post('id');
            $nama   = $this->input->post('nama');
            $bobot  = $this->input->post('bobot');
    
            $data = array(
                'nama'=>$nama
            );
            $this->kriteria->update($data,$id);
    
            $bk = array(
                'id_bobot'=>$bobot
            );
            $this->bk->where('id_kriteria',$id)->update($bk);
        else:
            return show_404();
        endif;
    }

    public function delKriteria(){
        if ($this->input->post()):
            $id = $this->input->post('id');
            $this->kriteria->delete($id);
        else:
            return show_404();
        endif;
    }

    public function addKriteria(){
        if ($this->input->post()):
           $nama  = $this->input->post('nama');
           $bobot = $this->input->post('bobot');
           $this->kriteria->insert(array('nama'=>$nama));
           $this->bk->insert(array(
               'id_bobot'=>$bobot,
               'id_kriteria'=>$this->kriteria->where('nama',$nama)->get()->id
            ));
            
            $nilai = $this->bk->with_bobot()->get_all();
            $abc=0;

            foreach ($nilai as $n) {
                $abc = $abc+$n->bobot->nilai;
            }
            echo json_encode(array(
                    'status'=>'success',
                    'id'=>$this->kriteria->where('nama',$nama)->get()->id,
                    'nama'=>$nama,
                    'bobot'=>$bobot/10
                    ));
        else:
            return show_404();
        endif;
    }

}
