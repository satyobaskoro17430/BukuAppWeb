<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index() {
		$data['head'] = $this->db->get_where('setting',['id' => 1])->row_array();
		$this->form_validation->set_rules('email', 'email', 'required', [
					'required'	=>	'Kolom ini tidak boleh kosong']);
		$this->form_validation->set_rules('password', 'password', 'required', [
					'required'	=>	'Kolom ini tidak boleh kosong']);
		if($this->form_validation->run() == FALSE) {
			$this->load->view('login',$data);
		}else {
			$email  = $this->input->post('email');
			$password  = $this->input->post('password');
			$cek = $this->db->get_where('user',['email' => $email])->row_array();
			if($cek) {
				if($password == $cek['password']) {
					$sesi = array (
						'id'		=>	$cek['id'],
						'nama'		=>	$cek['nama'],
						'email'		=>	$cek['email'],
						'password'	=>	$cek['password'],
						'status'	=>	'sudah_login',
					);
					$this->session->set_userdata($sesi);
					redirect('');
				}else {
					$this->session->set_flashdata('error', 'Password anda salah');
					redirect('login');
				}
			}else {
				$this->session->set_flashdata('error', 'Email tidak terdaftar');
				redirect('login');
			}
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('');
	}
}