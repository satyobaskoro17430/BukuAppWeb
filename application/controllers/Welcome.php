<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		$data['head'] = $this->db->get_where('setting',['id' => 1])->row_array();
		$data['listbuku'] = $this->db->get('buku')->result_array();
		$this->load->view('index', $data);
	}

	public function cari_buku() {
		$data['head'] = $this->db->get_where('setting',['id' => 1])->row_array();
		$data['listbuku'] = $this->query_cari_buku();
		$this->load->view('index', $data);
	}

	private function query_cari_buku() {
		$this->db->like('judul', $this->input->post('cari'));
		return $this->db->get('buku')->result_array();
	}

	public function add_buku() {
		if(!$this->session->userdata('id')) {
			redirect('');
		}
		$data['head'] = $this->db->get_where('setting',['id' => 1])->row_array();
		$this->form_validation->set_rules('judul', 'judul', 'required', [
					'required'	=>	'Kolom ini tidak boleh kosong']);
		$this->form_validation->set_rules('pengarang', 'pengarang', 'required', [
					'required'	=>	'Kolom ini tidak boleh kosong']);
		$this->form_validation->set_rules('penerbit', 'penerbit', 'required', [
					'required'	=>	'Kolom ini tidak boleh kosong']);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('add_buku', $data);
		}else {
			// get foto
		    $config['upload_path'] = './assets/';
		    $config['allowed_types'] = 'jpg|png|jpeg|gif';
		
		    $this->upload->initialize($config);
		    if (!empty($_FILES['gambar']['name'])) {
		        if ( $this->upload->do_upload('gambar') ) {
		            $gambar = $this->upload->data();
		                
		            $datas = array(
	                    'judul'			=>	ucwords($this->input->post('judul')),
	                    'pengarang'		=>	ucwords($this->input->post('pengarang')),
	                    'penerbit'		=>	ucwords($this->input->post('penerbit')),
						'gambar'		=>	$gambar['file_name'],
						'created_at'	=>	date('Y-m-d H:i:s'),
	                );

	                $this->db->insert('buku', $datas);
			$this->session->set_flashdata('flash', 'Data buku berhasil ditambahkan');
			redirect('');
	           }
		    }else {
		    	$this->session->set_flashdata('error', 'Anda belum memilih gambar buku');
				redirect('welcome/add_buku');
		    }
		
			
		}
	}

	public function edit_buku($id) {
		if(!$this->session->userdata('id')) {
			redirect('');
		}
		$data['head'] = $this->db->get_where('setting',['id' => 1])->row_array();
		$data['bukuid'] = $this->db->get_where('buku',['id_buku' => $id])->row_array();
		$this->form_validation->set_rules('judul', 'judul', 'required', [
					'required'	=>	'Kolom ini tidak boleh kosong']);
		$this->form_validation->set_rules('pengarang', 'pengarang', 'required', [
					'required'	=>	'Kolom ini tidak boleh kosong']);
		$this->form_validation->set_rules('penerbit', 'penerbit', 'required', [
					'required'	=>	'Kolom ini tidak boleh kosong']);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('edit_buku', $data);
		}else {
			// get foto
		    $config['upload_path'] = './assets/';
		    $config['allowed_types'] = 'jpg|png|jpeg|gif';
		
		    $this->upload->initialize($config);
		    if (!empty($_FILES['gambar']['name'])) {
		        if ( $this->upload->do_upload('gambar') ) {
		            $gambar = $this->upload->data();
		                
		            $data = array(
	                    'judul'			=>	ucwords($this->input->post('judul')),
	                    'pengarang'		=>	ucwords($this->input->post('pengarang')),
	                    'penerbit'		=>	ucwords($this->input->post('penerbit')),
						'gambar'		=>	$gambar['file_name'],
						'update_at'		=>	date('Y-m-d H:i:s'),
	                );
	           }
		    }else {
		    	$data = array(
                    'judul'			=>	ucwords($this->input->post('judul')),
                    'pengarang'		=>	ucwords($this->input->post('pengarang')),
                    'penerbit'		=>	ucwords($this->input->post('penerbit')),
					'gambar'		=>	$this->input->post('gambar_old'),
					'update_at'		=>	date('Y-m-d H:i:s'),
                );
		    }
		
			$this->db->where('id_buku', $id);
			$this->db->update('buku', $data);
			$this->session->set_flashdata('flash', 'Data buku berhasil diperbaharui');
			redirect('');
		}
	}

	public function delete_buku($id) {
		if(!$this->session->userdata('id')) {
			redirect('');
		}
		$this->db->where('id_buku', $id);
		$this->db->delete('buku');
		$this->session->set_flashdata('flash', 'Data buku berhasil dihapus');
		redirect('');
	}
}
