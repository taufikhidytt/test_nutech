<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model', 'barang');
    }

    public function index()
    {
        $data['title'] = 'Data Barang | Test Nutech Integrasi';
        $data['judul'] = 'Data Barang';
        $data['data'] = $this->barang->getData();
        $this->template->load('template', 'barang/index', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama barang', 'required|is_unique[barang.nama_barang]');
        $this->form_validation->set_rules('harga_beli', 'Harga beli', 'required|numeric');
        $this->form_validation->set_rules('harga_jual', 'Harga jual', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Stock', 'required');

        $this->form_validation->set_message('required', '{field} tidak boleh kosong');
        $this->form_validation->set_message('is_unique', '{field} sudah ada, Silahkan cari nama barang lain');
        $this->form_validation->set_message('numeric', '{field} wajib angka');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Add Barang | Test Nutech Integrasi';
            $data['judul'] = 'Add Barang';
            $this->template->load('template', 'barang/add', $data);
        } else {
            $data = $this->input->post(null, true);
            if($_FILES)
            {
                date_default_timezone_set("Asia/Jakarta");
                $config['upload_path']      = './assets/upload/';
                $config['allowed_types']    = 'jpg|png';
                $config['max_size']         = '120';
                $config['file_name']        = 'photoBarang-'.date('Y-m-d,H-i-s');
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if($_FILES['photo_barang']['name'])
                {
                    if($this->upload->do_upload('photo_barang'))
                    {
                        $data['photo_barang'] = $this->upload->data('file_name');
                        $this->barang->add($data);
                        if($this->db->affected_rows() > 0){
                            $this->session->set_flashdata('success', 'Selamat Anda Berhasil Menambahkan Data Baru');
                            redirect('barang');
                        }else{
                            $this->session->set_flashdata('error', 'Anda Gagal Menambahkan Data Baru');
                            redirect('barang');
                        }
                    }else{
                        $this->session->set_flashdata('error', 'Photo Gagal Di Upload, Pastikan Format Dan Size Yang Di Upload Benar');
                        redirect('barang');
                    }
                }else{
                    $this->session->set_flashdata('warning', 'Anda Belum Mengupload Photo Barang');
                    redirect('barang');
                }
            }
        }
    }

    public function update($id)
    {
        $this->form_validation->CI =& $this;

        $this->form_validation->set_rules('nama_barang', 'Nama barang', 'required|callback_username_check');
        $this->form_validation->set_rules('harga_beli', 'Harga beli', 'required|numeric');
        $this->form_validation->set_rules('harga_jual', 'Harga jual', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Stock', 'required');

        $this->form_validation->set_message('required', '{field} tidak boleh kosong');
        $this->form_validation->set_message('numeric', '{field} wajib angka');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->barang->getData($id);
            if($query->num_rows() > 0){
                $data['title'] = 'Update Invoice | Invoice App';
                $data['judul'] = 'Update Invoice';
                $data['data'] = $query->row();
                $this->template->load('template', 'barang/update', $data);
            }else{
                $this->session->set_flashdata('warning', 'Data Yang Anda Cari Tidak Tersedia, Silahkan Cari Data Yang Tersedia');
                redirect('barang');
            }
        } else {
            $data = $this->input->post(null, true);
            if($_FILES)
            {
                date_default_timezone_set("Asia/Jakarta");
                $config['upload_path']      = './assets/upload/';
                $config['allowed_types']    = 'jpg|png';
                $config['max_size']         = '120';
                $config['file_name']        = 'photoBarang-'.date('Y-m-d,H-i-s');
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if($_FILES['photo_barang']['name'])
                {
                    if($this->upload->do_upload('photo_barang'))
                    {
                        $data['photo_barang'] = $this->upload->data('file_name');
                        $this->barang->update($data);
                        if($this->db->affected_rows() > 0){
                            $this->session->set_flashdata('success', 'Selamat Anda Berhasil Mengupdate Data');
                            redirect('barang');
                        }else{
                            $this->session->set_flashdata('error', 'Anda Gagal Mengupdate Data');
                            redirect('barang');
                        }
                    }else{
                        $this->session->set_flashdata('error', 'Photo Gagal Di Upload, Pastikan Format Dan Size Yang Di Upload Benar');
                        redirect('barang');
                    }
                }else{
                    $data['photo_barang'] = null;
                    $this->barang->update($data);
                    if($this->db->affected_rows() > 0){
                        $this->session->set_flashdata('success', 'Selamat Anda Berhasil Mengupdate Data');
                        redirect('barang');
                    }else{
                        $this->session->set_flashdata('error', 'Anda Gagal Mengupdate Data');
                        redirect('barang');
                    }
                }
            }
        }
    }

    public function del()
    {
        $data = $this->input->post(null, true);
        $this->barang->del($data);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success', 'Selamat Anda Berhasil Menghapus Data');
            redirect('barang');
        }else{
            $this->session->set_flashdata('error', 'Anda Gagal Menghapus Data');
            redirect('barang');
        }
    }

    function username_check()
	{
		$pos = $this->input->post(null, true);
		$query = $this->db->query("SELECT * FROM BARANG WHERE nama_barang = '$pos[nama_barang]' AND id_barang != '$pos[id]'");
		if($query->num_rows() > 0){
			$this->form_validation->set_message('username_check', '{field} sudah ada, silahkan cari nama barang lain');
			return false;
		}else{
			return true;
		}
	}
}
?>