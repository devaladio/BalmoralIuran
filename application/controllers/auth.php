<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('UserModel');
    $this->load->library('form_validation');
  }
  public function index()
  {
    $this->form_validation->set_rules('username', 'Username', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == false) {
      $data['title'] = 'Login Page';
      $this->load->view('template/auth_header', $data);
      $this->load->view('template/login/index');
      $this->load->view('template/auth_footer');
    } else {
      $this->login();
    }
  }
  public function login()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->db->get_where('user', ['username' => $username])->row_array();
    // $user = $this->db->get_where('user', ['password' => $password]);
    if ($user) {
      if ($user['is_active'] == 1) {
        if (md5($password) == $user['password']) {
          $data = ['username' => $user['username'], 'role' => $user['role']];
          $this->session->set_userdata($data);
          redirect('index.php/user');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Wrong password! </div>');
          redirect('index.php/auth');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      This email has not been activated! </div>');
        redirect('index.php/auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Username is not registered! </div>');
      redirect('index.php/auth');
    }

    //$user = $this->db->get_where('user', ['password' => $password]);
  }

  public function registration()
  {
    $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
    $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', ['is_unique' => 'Username already in use']);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]');
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Registration';
      $this->load->view('template/auth_header', $data);
      $this->load->view('register/index');
      $this->load->view('template/auth_footer');
    } else {
      $data = [
        'name' => htmlspecialchars($this->input->post('name', true)),
        'username' => htmlspecialchars($this->input->post('username', true)),
        'password' => md5($this->input->post('password1')),
        'role' => 'warga',
        'is_active' => 1
      ];
      $this->db->insert('user', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      Congratulation! your account has been created. Please contact bendahara to activated </div>');
      redirect('index.php/auth');
    }
  }

  public function logout()
  {
    $this->session->sess_destroy(); // Hapus semua session
    redirect('index.php/auth'); // Redirect ke halaman login
  }
}
