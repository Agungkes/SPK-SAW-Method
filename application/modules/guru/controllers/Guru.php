<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends MY_Controller
{
    public function __construct()
	{
		parent::__construct();
		/*  
        *   Melakukan Load Model di construct agar tidak perlu memanggil load berulang kali
        *   Lakukan hal ini jika memang sangat diperlukan.
        */
		$this->load->model(array(
			'guru_m'    => 'guru',
			));
    }
    
    public function index(){
        $data['guru']=$this->guru->order_by('id','DESC')->get_all();
        $this->load->view('guru_v',$data);
    }

    public function editGuru(){
        $id      = $this->input->post('id');
        $nama    = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $alamat  = $this->input->post('alamat');

        $data = array(
            'nama' => $nama,
            'jabatan'=> $jabatan,
            'alamat'=>$alamat
        );
        $this->guru->update($data,$id);
    }

    public function deleteGuru(){
        $id = $this->input->post('id');
        $this->guru->delete($id);
    }

    public function addGuru(){
        $nama    = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $alamat  = $this->input->post('alamat');

        $data = array(
            'nama'      => $nama,
            'jabatan'   => $jabatan,
            'alamat'    => $alamat
        );

        if($this->guru->insert($data)){
            $data = array(
                'id'        => $this->db->insert_id(),
                'nama'      => $nama,
                'jabatan'   => $jabatan,
                'alamat'    => $alamat
            );
            echo json_encode($data);        
        }
    }
}