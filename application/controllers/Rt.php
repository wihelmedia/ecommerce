<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rt extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Rt_model', 'rt');
  }

  public function index()
	{
    $data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('rt/index', $data);
    $this->load->view('templates/footer');
  }

  public function info()
	{
    $role = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $config['base_url'] = base_url('rt/info');
    $config['total_rows'] = $this->db->count_all('kegiatan');
    $config['per_page'] = 10;
    $config['num_links'] = 5;
    $this->pagination->initialize($config);
    $data['start'] = $this->uri->segment(3);
    $this->_ruleskeg();
    $data = array(
      'title' => 'Tambah Kegiatan', 
      'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'kegiatan' => $this->rt->getkegiatan($config['per_page'], $data['start']),
      'judul_kegiatan' => set_value('judul_kegiatan'),
      'isi_kegiatan' => set_value('isi_kegiatan'),
      'role_id' => set_value('role_id', $role['role_id']),
      'file' => set_value('file'),
      'gambar_penulis' => set_value('gambar_penulis')
    );

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top-bar', $data);
      $this->load->view('rt/info', $data);
      $this->load->view('templates/footer');
    } else {
        $config['upload_path']    = './assets/img/info/';
        $config['allowed_types']  = 'gif|jpg|png';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {
          $photo = $this->upload->data();
          $dataphoto = $photo['file_name'];	
          $kegiatan = array(
            'judul_kegiatan' => $this->input->post('judul_kegiatan', TRUE),
            'isi_kegiatan' => $this->input->post('isi_kegiatan', TRUE),
            'level' => $this->input->post('rol', TRUE),
            'gambar' => $dataphoto,
            'gambar_penulis' => $this->input->post('gambar_penulis', TRUE),
            'date_created' => time()
          );
          $this->db->insert('kegiatan', $kegiatan);
          $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">New kegiatan added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('rt/info');
        } else {
          $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">' . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('rt/info');
        }
    }
  }

  public function kartukeluarga()
  {
    $config['base_url'] = base_url('rt/kartukeluarga');
    $config['total_rows'] = $this->db->count_all('kk');
    $config['per_page'] = 10;
    $config['num_links'] = 5;
    $this->pagination->initialize($config);
    $data['start'] = $this->uri->segment(3);
    $this->_ruleskk();
    $data = array(
      'title' => 'Kartu Keluarga',
      'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'kartukeluarga' => $this->rt->getkk1($config['per_page'], $data['start']),
      'no_kk' => set_value('no_kk'),
      'kpl_keluarga' => set_value('kpl_keluarga'),
      'alamat' => set_value('alamat'),
      'rt' => set_value('rt'),
      'rw' => set_value('rw'),
      'desa_kel' => set_value('desa_kel'),
      'kecamatan' => set_value('kecamatan'),
      'kab_kota' => set_value('kab_kota'),
      'kd_pos' => set_value('kd_pos'),
      'provinsi' => set_value('provinsi')
    );
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top-bar', $data);
      $this->load->view('rt/kartu_keluarga', $data);
      $this->load->view('templates/footer');
    } else {
      $kar = array(
        'no_kk' => $this->input->post('no_kk', TRUE),
        'kpl_keluarga' => $this->input->post('kpl_keluarga', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'rt' => $this->input->post('rt', TRUE),
        'rw' => $this->input->post('rw', TRUE),
        'desa_kel' => $this->input->post('desa_kel', TRUE),
        'kecamatan' => $this->input->post('kecamatan', TRUE),
        'kab_kota' => $this->input->post('kab_kota', TRUE),
        'kd_pos' => $this->input->post('kd_pos', TRUE),
        'provinsi' => $this->input->post('provinsi', TRUE)
      );
      $this->db->insert('kk', $kar);
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">New kartu keluarga added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/kartukeluarga');
    }
  }

  public function identitas()
  {
    $this->_rulesid();
    $data = array(
      'title' => 'Identitas',
      'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'identitas' => $this->db->get('identitas')->result_array(),
      'provinsi' => set_value('provinsi'),
      'kab_kota' => set_value('kab_kota'),
      'kecamatan' => set_value('kecamatan'),
      'no_tlp' => set_value('no_tlp'),
      'desa_kel' => set_value('desa_kel'),
      'dusun' => set_value('dusun'),
      'alamat_kantor_desa' => set_value('alamat_kantor_desa'),
      'kd_pos' => set_value('kd_pos'),
      'rw' => set_value('rw'),
      'rt' => set_value('rt'),
      'nm_ketua_rt' => set_value('nm_ketua_rt'),
      'alamat_rumah_rt' => set_value('alamat_rumah_rt')
    );
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top-bar', $data);
      $this->load->view('rt/identitas', $data);
      $this->load->view('templates/footer');
    } else {
      $iden = array(
        'provinsi' => $this->input->post('provinsi', TRUE),
        'kab_kota' => $this->input->post('kab_kota', TRUE),
        'kecamatan' => $this->input->post('kecamatan', TRUE),
        'no_tlp' => $this->input->post('no_tlp', TRUE),
        'desa_kel' => $this->input->post('desa_kel', TRUE),
        'dusun' => $this->input->post('dusun', TRUE),
        'alamat_kantor_desa' => $this->input->post('alamat_kantor_desa', TRUE),
        'kd_pos' => $this->input->post('kd_pos', TRUE),
        'rw' => $this->input->post('rw', TRUE),
        'rt' => $this->input->post('rt', TRUE),
        'nm_ketua_rt' => $this->input->post('nm_ketua_rt', TRUE),
        'alamat_rumah_rt' => $this->input->post('alamat_rumah_rt', TRUE)
      );
      $this->db->insert('identitas', $iden);
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">New identitas added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/identitas');
    }
  }

  public function maps()
  {
    $data['title'] = 'Maps';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['kordinat'] = $this->db->get('warga')->result_array();
    $data['jumlah'] = $this->db->get('warga')->num_rows();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('rt/maps', $data);
    $this->load->view('templates/footer');
  }
  
  public function datawarga()
  {
    $config['base_url'] = base_url('rt/datawarga');
    $config['total_rows'] = $this->db->count_all('warga');
    $config['per_page'] = 3;
    $config['num_links'] = 5;
    $this->pagination->initialize($config);
    $data['start'] = $this->uri->segment(3);
    $this->_rules();
    $data = array(
      'title' => 'Data Warga', 
      'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'warga' => $this->rt->getUserWarga($config['per_page'], $data['start'], $this->session->userdata('role_id')),
      'no_ktp' => set_value('no_ktp'),
      'no_kk' => set_value('no_kk'),
      'nama' => set_value('nama'),
      'jk' => set_value('jk'),
      'tempat_lahir' => set_value('tempat_lahir'),
      'tgl_lahir' => set_value('tgl_lahir'),
      'golda' => set_value('golda'),
      'agama' => set_value('agama'),
      'status_kawin' => set_value('status_kawin'),
      'status_keluarga' => set_value('status_keluarga'),
      'status' => set_value('status'),
      'kewarganegaraan' => set_value('kewarganegaraan'),
      'pendidikan' => set_value('pendidikan'),
      'pekerjaan' => set_value('pekerjaan'),
      'no_hp' => set_value('no_hp'),
      'nm_ayah' => set_value('nm_ayah'),
      'nm_ibu' => set_value('nm_ibu'),
      'alamat' => set_value('alamat'),
      'no_rumah' => set_value('no_rumah')
    );

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/top-bar', $data);
      $this->load->view('rt/datawarga_list', $data);
      $this->load->view('templates/footer');
    } else {
        $config['upload_path']    = './assets/img/profile/';
        $config['allowed_types']  = 'gif|jpg|png';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
          $photo = $this->upload->data();
          $dataphoto = $photo['file_name'];	
          $warga = array(
            'no_ktp' => $this->input->post('no_ktp', TRUE),
            'no_kk' => $this->input->post('no_kk', TRUE),
            'nama' => $this->input->post('nama', TRUE),
            'jk' => $this->input->post('jk', TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
            'tgl_lahir' => $this->input->post('tgl_lahir', TRUE),
            'golda' => $this->input->post('golda', TRUE),
            'agama' => $this->input->post('agama', TRUE),
            'status_kawin' => $this->input->post('status_kawin', TRUE),
            'status_keluarga' => $this->input->post('status_keluarga', TRUE),
            'status' => $this->input->post('status', TRUE),
            'kewarganegaraan' => $this->input->post('kewarganegaraan', TRUE),
            'pendidikan' => $this->input->post('pendidikan', TRUE),
            'pekerjaan' => $this->input->post('pekerjaan', TRUE),
            'no_hp' => $this->input->post('no_hp', TRUE),
            'nm_ayah' => $this->input->post('nm_ayah', TRUE),
            'nm_ibu' => $this->input->post('nm_ibu', TRUE),
            'alamat' => $this->input->post('alamat', TRUE),
            'no_rumah' => $this->input->post('no_rumah', TRUE),
            'image' => $dataphoto
          );
          $this->db->insert('warga', $warga);
          $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">New warga added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('rt/datawarga');
        } else {
          $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">' . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('rt/datawarga');
        }
    }
  }

  public function delwarga($id)
  {
    $this->db->where('no_ktp', $id);
    if ($this->db->delete('warga')) { 
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success warga deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/datawarga');
    }
  }

  public function deletekegiatan($id)
  {
    $this->db->where('id', $id);
    if ($this->db->delete('kegiatan')) { 
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success kegiatan deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/info');
    }
  }

  public function delkar($id)
  {
    $this->db->where('id_kk', $id);
    if ($this->db->delete('kk')) {
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success kartu keluarga deleted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/kartukeluarga');
    }
  }

  public function editwarga()
  {
    echo json_encode($this->rt->wargashow($_POST['id']));
  }

  public function editekegiatan()
  {
    echo json_encode($this->rt->kegiatanshow($_POST['id']));
  }

  public function editeidentitas()
  {
    echo json_encode($this->rt->idenshow($_POST['id']));
  }

  public function editekartukeluarga()
  {
    echo json_encode($this->rt->kartushow($_POST['id']));
  }

  public function updatekartukeluarga()
  {
    $data = array(
      'no_kk' => $_POST['no_kkedit'],
      'kpl_keluarga' => $_POST['kpl_keluargaedit'],
      'alamat' => $_POST['alamatedit'],
      'rt' => $_POST['rtedit'],
      'rw' => $_POST['rwedit'],
      'desa_kel' => $_POST['desa_keledit'],
      'kecamatan' => $_POST['kecamatanedit'],
      'kab_kota' => $_POST['kab_kotaedit'],
      'kd_pos' => $_POST['kd_posedit'],
      'provinsi' => $_POST['provinsiedit']
    );
    $update = $this->db->update('kk', $data, array('id_kk' => $_POST['id']));
    if ($update) {
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success kartu keluarga updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/kartukeluarga');
    }
  }

  public function updateidentitas()
  {
    $data = array(
      'provinsi' => $_POST['provinsiedit'],
      'kab_kota' => $_POST['kab_kotaedit'],
      'kecamatan' => $_POST['kecamatanedit'],
      'no_tlp' => $_POST['no_tlpedit'],
      'desa_kel' => $_POST['desa_keledit'],
      'dusun' => $_POST['dusunedit'],
      'alamat_kantor_desa' => $_POST['alamat_kantor_desaedit'],
      'kd_pos' => $_POST['kd_posedit'],
      'rw' => $_POST['rwedit'],
      'rt' => $_POST['rtedit'],
      'nm_ketua_rt' => $_POST['nm_ketua_rtedit'],
      'alamat_rumah_rt' => $_POST['alamat_rumah_rtedit']
    );
    $update = $this->db->update('identitas', $data, array('id' => $_POST['id']));
    if ($update) {
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success identitas updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/identitas');
    }
  }

  public function updatekegiatan()
  {
    if($_FILES['file']['name'] != ''){
      if ($_FILES['file']['error'] === 0) {
        if ($_FILES['file']['size'] <= 5000000){
          $format = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
          if ($format === 'jpg' || $format === 'png' || $format === 'jpeg') {
            $old_img = $this->rt->kegiatanshow($_POST['id'])[0]['gambar'];
            if ($old_img != strtolower($_FILES['file']['name'])) {
              unlink(FCPATH . 'assets/img/info/' . $old_img);
              move_uploaded_file($_FILES['file']['tmp_name'], 'assets/img/info/' . $_FILES['file']['name']);
              $data = array(
                'judul_kegiatan' => $_POST['judul_kegiatanedit'],
                'isi_kegiatan' => $_POST['isi_kegiatanedit'],
                'gambar' => $_FILES['file']['name'],
                'date_created' => time()
              );
              $update = $this->db->update('kegiatan', $data, array('id' => $_POST['id']));
              if ($update) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success kegiatan updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('rt/info');
              }
            } else {
              unlink(FCPATH . 'assets/img/info/' . $old_img);
              move_uploaded_file($_FILES['file']['tmp_name'], 'assets/img/info/' . $_FILES['file']['name']);
              $data = array(
                'judul_kegiatan' => $_POST['judul_kegiatanedit'],
                'isi_kegiatan' => $_POST['isi_kegiatanedit'],
                'gambar' => $_FILES['file']['name'],
                'date_created' => time()
              );

              $update = $this->db->update('kegiatan', $data, array('id' => $_POST['id']));
              if ($update) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success kegiatan updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('rt/info');
              }
            }
          } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger col-sm-6 mx-auto" role="alert">Gambar yang dipilih harus extensi JPG, PNG, dan JPEG!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('rt/info');
          }
        } else {
          $this->session->set_flashdata('msg', '<div class="alert alert-danger col-sm-6 mx-auto" role="alert">Gambar yang dipilih terlalu besar!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('rt/info');
        }
      } else {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger col-sm-6 mx-auto" role="alert">Ada masalah saat upload gambar!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('rt/info');
      }
    } else {
      $data = array(
        'judul_kegiatan' => $_POST['judul_kegiatanedit'],
        'isi_kegiatan' => $_POST['isi_kegiatanedit'],
        'date_created' => time()
      );
      $update = $this->db->update('kegiatan', $data, array('id' => $_POST['id']));
      if ($update) {
        $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success kegiatan updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('rt/info');
      }
    }
  }

  public function updatewarga()
  {
    if($_FILES['file']['name'] != ''){
      if ($_FILES['file']['error'] === 0) {
        if ($_FILES['file']['size'] <= 5000000){
          $format = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
          if ($format === 'jpg' || $format === 'png' || $format === 'jpeg') {
            $old_img = $this->rt->wargashow($_POST['no_ktpedit'])[0]['image'];
            if ($old_img != strtolower($_FILES['file']['name'])) {
              unlink(FCPATH . 'assets/img/profile/' . $old_img);
              move_uploaded_file($_FILES['file']['tmp_name'], 'assets/img/profile/' . $_FILES['file']['name']);
              $data = array(
                'no_ktp' => $_POST['no_ktpedit'],
                'no_kk' => $_POST['no_kkedit'],
                'nama' => $_POST['namaedit'],
                'jk' => $_POST['jkedit'],
                'tempat_lahir' => $_POST['tempat_lahiredit'],
                'tgl_lahir' => $_POST['tgl_lahiredit'],
                'golda' => $_POST['goldaedit'],
                'agama' => $_POST['agamaedit'],
                'status_kawin' => $_POST['status_kawinedit'],
                'status_keluarga' => $_POST['status_keluargaedit'],
                'status' => $_POST['statusedit'],
                'kewarganegaraan' => $_POST['kewarganegaraanedit'],
                'pendidikan' => $_POST['pendidikanedit'],
                'pekerjaan' => $_POST['pekerjaanedit'],
                'no_hp' => $_POST['no_hpedit'],
                'nm_ayah' => $_POST['nm_ayahedit'],
                'nm_ibu' => $_POST['nm_ibuedit'],
                'alamat' => $_POST['alamatedit'],
                'no_rumah' => $_POST['no_rumahedit'],
                'image' => $_FILES['file']['name']
              );
              $update = $this->db->update('warga', $data, array('no_ktp' => $_POST['no_ktpedit']));
              if ($update) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success warga updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('rt/datawarga');
              }
            } else {
              unlink(FCPATH . 'assets/img/profile/' . $old_img);
              move_uploaded_file($_FILES['file']['tmp_name'], 'assets/img/profile/' . $_FILES['file']['name']);
              $data = array(
                'no_ktp' => $_POST['no_ktpedit'],
                'no_kk' => $_POST['no_kkedit'],
                'nama' => $_POST['namaedit'],
                'jk' => $_POST['jkedit'],
                'tempat_lahir' => $_POST['tempat_lahiredit'],
                'tgl_lahir' => $_POST['tgl_lahiredit'],
                'golda' => $_POST['goldaedit'],
                'agama' => $_POST['agamaedit'],
                'status_kawin' => $_POST['status_kawinedit'],
                'status_keluarga' => $_POST['status_keluargaedit'],
                'status' => $_POST['statusedit'],
                'kewarganegaraan' => $_POST['kewarganegaraanedit'],
                'pendidikan' => $_POST['pendidikanedit'],
                'pekerjaan' => $_POST['pekerjaanedit'],
                'no_hp' => $_POST['no_hpedit'],
                'nm_ayah' => $_POST['nm_ayahedit'],
                'nm_ibu' => $_POST['nm_ibuedit'],
                'alamat' => $_POST['alamatedit'],
                'no_rumah' => $_POST['no_rumahedit'],
                'image' => $_FILES['file']['name']
              );

              $update = $this->db->update('warga', $data, array('no_ktp' => $_POST['no_ktpedit']));
              if ($update) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success warga updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('rt/datawarga');
              }
            }
          } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger col-sm-6 mx-auto" role="alert">Gambar yang dipilih harus extensi JPG, PNG, dan JPEG!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('rt/datawarga');
          }
        } else {
          $this->session->set_flashdata('msg', '<div class="alert alert-danger col-sm-6 mx-auto" role="alert">Gambar yang dipilih terlalu besar!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          redirect('rt/datawarga');
        }
      } else {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger col-sm-6 mx-auto" role="alert">Ada masalah saat upload gambar!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('rt/datawarga');
      }
    } else {
      $data = array(
        'no_ktp' => $_POST['no_ktpedit'],
        'no_kk' => $_POST['no_kkedit'],
        'nama' => $_POST['namaedit'],
        'jk' => $_POST['jkedit'],
        'tempat_lahir' => $_POST['tempat_lahiredit'],
        'tgl_lahir' => $_POST['tgl_lahiredit'],
        'golda' => $_POST['goldaedit'],
        'agama' => $_POST['agamaedit'],
        'status_kawin' => $_POST['status_kawinedit'],
        'status_keluarga' => $_POST['status_keluargaedit'],
        'status' => $_POST['statusedit'],
        'kewarganegaraan' => $_POST['kewarganegaraanedit'],
        'pendidikan' => $_POST['pendidikanedit'],
        'pekerjaan' => $_POST['pekerjaanedit'],
        'no_hp' => $_POST['no_hpedit'],
        'nm_ayah' => $_POST['nm_ayahedit'],
        'nm_ibu' => $_POST['nm_ibuedit'],
        'alamat' => $_POST['alamatedit'],
        'no_rumah' => $_POST['no_rumahedit']
      );

      $update = $this->db->update('warga', $data, array('no_ktp' => $_POST['no_ktpedit']));
      if ($update) {
        $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success warga updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('rt/datawarga');
      }
    }
  }

  public function updatepesan()
  {
    $data = array(
      // 'id' => $_POST['id'],
      // 'nama' => $_POST['nama'],
      // 'jk' => $_POST['jk'],
      // 'tempat_lahir' => $_POST['tempat_lahir'],
      // 'tgl_lahir' => $_POST['tgl_lahir'],
      // 'golda' => $_POST['golda'],
      // 'agama' => $_POST['agama'],
      // 'status_kawin' => $_POST['status_kawin'],
      // 'status_keluarga' => $_POST['no_ktp'],
      // 'no_hp' => $_POST['no_hp'],
      'status' => $_POST['status']
      // 'kewarganegaraan' => $_POST['kewarganegaraan'],
      // 'pendidikan' => $_POST['pendidikan'],
      // 'pekerjaan' => $_POST['pekerjaan'],
      // 'nm_ayah' => $_POST['nm_ayah'],
      // 'nm_ibu' => $_POST['nm_ibu'],
      // 'alamat' => $_POST['alamat'],
      // 'no_rumah' => $_POST['no_rumah']
    );
    $update = $this->db->update('rt', $data, array('name' => $_POST['name']));
    $update = $this->db->update('surat_keluar', $data, array('name' => $_POST['name']));
    if ($update) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.thebigbox.id/sms-notification/1.0.0/messages",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "msisdn=".$_POST['no_hp']."&content=Sudah%20disetujui%20dan%20akan%20diproses",
      CURLOPT_HTTPHEADER => array(
              "Content-Type: application/x-www-form-urlencoded",
              "Postman-Token: bd649108-daf0-4508-9d52-d27d65344732",
              "cache-control: no-cache",
              "x-api-key: bqJFSbqVFL884oeSvIAJsarhXb63wLVr"
          ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
          echo "cURL Error #:" . $err;
      } else {
          echo $response;
      }
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success Approve!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/pengajuan');
    }
  }

  public function prosespesan($id)
  {
    $row = $this->rt->pesanshow($id)[0];
    $warga = $this->rt->wargashow($row['no_ktp'])[0];
    $identitas = $this->rt->identitas()[0];
    $nosurat = $this->rt->nosurat()[0];
    $data = array(
      'button' => 'Proses',
      'nama' => $row['name'],
      'jk' => $warga['jk'],
      'agama' => $warga['agama'],
      'status_kawin' => $warga['status_kawin'],
      'no_ktp' => $row['no_ktp'],
      'tempat_lahir' => $warga['tempat_lahir'],
      'tgl_lahir' => $warga['tgl_lahir'],
      'pekerjaan' => $warga['pekerjaan'],
      'keperluan' => $row['keperluan'],
      'kab_kota' => $identitas['kab_kota'],
      'kecamatan' => $identitas['kecamatan'],
      'desa_kel' => $identitas['desa_kel'],
      'rt' => $identitas['rt'],
      'rw' => $identitas['rw'],
      'dusun' => $identitas['dusun'],
      'nm_ketua_rt' => $identitas['nm_ketua_rt'],
      'alamat_kantor_desa' => $identitas['alamat_kantor_desa'],
      'kd_pos' => $identitas['kd_pos'],
      'no_tlp' => $row['no_hp'],
      'nosurat_rt' => $nosurat['nosurat_rt'],
      'title' => 'Cetak',
      'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array()
    );
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('rt/cetak', $data);
    $this->load->view('templates/footer');
  }

  public function selesai($name, $no_hp)
  {
    $data = array(
      // 'id' => $_POST['id'],
      // 'nama' => $_POST['nama'],
      // 'jk' => $_POST['jk'],
      // 'tempat_lahir' => $_POST['tempat_lahir'],
      // 'tgl_lahir' => $_POST['tgl_lahir'],
      // 'golda' => $_POST['golda'],
      // 'agama' => $_POST['agama'],
      // 'status_kawin' => $_POST['status_kawin'],
      // 'status_keluarga' => $_POST['no_ktp'],
      // 'no_hp' => $_POST['no_hp'],
      'status' => 'Y'
      // 'kewarganegaraan' => $_POST['kewarganegaraan'],
      // 'pendidikan' => $_POST['pendidikan'],
      // 'pekerjaan' => $_POST['pekerjaan'],
      // 'nm_ayah' => $_POST['nm_ayah'],
      // 'nm_ibu' => $_POST['nm_ibu'],
      // 'alamat' => $_POST['alamat'],
      // 'no_rumah' => $_POST['no_rumah']
    );
    $update = $this->db->update('rt', $data, array('name' => $name));
    $update = $this->db->update('surat_keluar', $data, array('name' => $name));
    if ($update) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.thebigbox.id/sms-notification/1.0.0/messages",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "msisdn=" . $no_hp . "&content=Sudah%20selesai",
        CURLOPT_HTTPHEADER => array(
          "Content-Type: application/x-www-form-urlencoded",
          "Postman-Token: bd649108-daf0-4508-9d52-d27d65344732",
          "cache-control: no-cache",
          "x-api-key: bqJFSbqVFL884oeSvIAJsarhXb63wLVr"
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        echo $response;
      }
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success status updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/pengajuan');
    }
  }

  public function carikk()
  {
    $this->form_validation->set_rules('carikk', 'cari kk', 'trim|required');
    $inputnokk = $this->input->post('carikk', TRUE);
    $data['kk'] = $this->rt->getkk($inputnokk);
    $data['wargakk'] = $this->rt->wargashowkk($inputnokk);
    if($this->form_validation->run() == FALSE) {
      $this->kartukeluarga();
    } else {
      $this->load->view('rt/kk', $data);
    }
  }

  public function print($id)
  {
    $row = $this->rt->pesanshow($id)[0];
    $warga = $this->rt->wargashow($row['no_ktp'])[0];
    $identitas = $this->rt->identitas()[0];
    $nosurat = $this->rt->nosurat()[0];
    if($warga['jk'] == 'L'){
      $result = 'Laki-Laki';
    } elseif ($warga['jk'] == 'P') {
      $result = 'Perempuan';
    }
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML('<head>
    <title>Surat Pengantar RT</title>
    <style type="text/css">
        body {
          font-size: 14px;
        }
        .upper {
            text-transform: uppercase;
        }

        .lower {
            text-transform: lowercase;
        }

        .cap {
            text-transform: capitalize;
        }

        .small {
            font-variant: small-caps;
        }

        @media print {
            body {
                display: block;
            }
        }
    </style>
</head>

<body bgcolor="white">
    <form>
        <table align="center" border="0">
            <tr>
                <td>
                    <font face="Times New Roman" size="5">
                        <center>PEMERINTAH KABUPATEN '.$identitas['kab_kota'].'</center>
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font face="Times New Roman" size="5">
                        <center>KECAMATAN '.$identitas['kecamatan'].'</center>
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font face="Times New Roman" size="5">
                        <center><b>DESA '.$identitas['desa_kel'].'</center>
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font face="Times New Roman" size="5.5">
                        <center><b>RT 0'.$identitas['rt'].' RW 0'.$identitas['rw'].' DUSUN '.$identitas['dusun'].'</b></center>
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font face="Times New Roman" size="3">
                        <center>Alamat : '.$identitas['alamat_kantor_desa'].' Pos : '.$identitas['kd_pos'].'</center>
                    </font>
                </td>
            </tr>
        </table>
    </form>
    <hr size="3" noshade="8">
    <font face="Arial" size="5">
        <p align="center"> <u> <b>SURAT KETERANGAN PENGANTAR</b></u>
    </font><br>
    <font face="Arial" size="4"> Nomor: '.$nosurat['nosurat_rt'].' </p>
    </font>
    <form>
        <table align="center" border="0">
            <tr>
                <td align="left" colspan="3">Yang bertanda tangan di bawah ini :</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" width="250">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                <td>:</td>
                <td align="left">'.$identitas['nm_ketua_rt'].'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan</td>
                <td>:</td>
                <td align="left">Kepala Desa '.$identitas['desa_kel'].'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat</td>
                <td>:</td>
                <td align="left">Desa '.$identitas['desa_kel'].' RT.0'.$identitas['rt'].'/0'.$identitas['rw'].' Kec. '.$identitas['kecamatan'].'</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" colspan="3">Dengan ini menerangkan bahwa :</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Lengkap</td>
                <td>:</td>
                <td align="left">'.$row['name'].'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jenis kelamin</td>
                <td>:</td>
                <td align="left">'.$result.'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Agama</td>
                <td>:</td>
                <td align="left">'.ucwords($warga['agama']).'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status</td>
                <td>:</td>
                <td align="left">'.$warga['status_kawin'].'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No NIK</td>
                <td>:</td>
                <td align="left">'.$row['no_ktp'].'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat/Tanggal lahir</td>
                <td>:</td>
                <td align="left">'.$warga['tempat_lahir'].', '.$warga['tgl_lahir'].'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pekerjaan</td>
                <td>:</td>
                <td align="left">'.$warga['pekerjaan'].'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat</td>
                <td>:</td>
                <td align="left">Desa '.$identitas['desa_kel'].' RT 0'.$identitas['rt'].'/0'.$identitas['rw'].' Kec. '.$identitas['kecamatan'].'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keperluan</td>
                <td>:</td>
                <td align="left">'.$row['keperluan'].'</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keterangan</td>
                <td>:</td>
                <td align="left">Orang tersebut benar-benar warga Desa '.$identitas['desa_kel'].' berkelakuan baik dan belum pernah terkena tindak pidana apapun.</td>
            </tr>
            <tr>
                <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berlaku tanggal</td>
                <td>:</td>
                <td align="left">Dimulai tanggal 25 sampai 30 Hari kedepan.</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" colspan="3">Orang tersebut di atas adalah benar penduduk Desa kami yang berdomisili <b>Status Tinggal</b>, Demikian surat keterangan ini di buat untuk digunakan seperlunya.</td>
            </tr>
        </table>
        <BR>
        <table align="center" border="0">
            <tr>
                <td>
                    Tanda tangan pemegang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala Desa '.$identitas['desa_kel'].'
                </td>
            </tr>
            <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <font class="upper"><b><i>'.$row['name'].'</i></b></font>
                </td>
                <td align="right">
                    <font class="upper"><b><i>'.$identitas['nm_ketua_rt'].'</i></b></font>
                </td>
            </tr>
            <tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    Mengetahui :
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    Camat '.$identitas['kecamatan'].'
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <font class="upper"><b><i>(Ahmad Hartono, S.IP.,MM)</i></b></font>
                </td>
            </tr>
        </table>
    </form>
</body>');
    $mpdf->Output();
  }

  
  public function pengajuan()
  {
    $config['base_url'] = base_url('rt/pengajuan');
    $config['total_rows'] = $this->db->count_all('rt');
    $config['per_page'] = 3;
    $config['num_links'] = 5;
    $this->pagination->initialize($config);
    $data['start'] = $this->uri->segment(3);
    $data['title'] = 'Pengajuan Surat';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['surat'] = $this->rt->getsuratrt($config['per_page'], $data['start']);
    $data['surat1'] = $this->rt->getsuratrt1();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/top-bar', $data);
    $this->load->view('rt/pengajuansurat', $data);
    $this->load->view('templates/footer');
  }

  public function delpesan($id)
  {
    $this->db->where('id', $id);
    $deleted = $this->db->delete('rt');
    if ($deleted) {
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success deleted message!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/pengajuan');
    }
  }

  public function delidentitas($id)
  {
    $this->db->where('id', $id);
    $deleted = $this->db->delete('identitas');
    if ($deleted) {
      $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success deleted identitas!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('rt/identitas');
    }
  }

  public function detailpesan()
  {
    echo json_encode($this->rt->pesanshow($_POST['id']));
  }

  public function _rules()
  {
    $this->form_validation->set_rules('no_ktp', 'no_ktp', 'trim|required');
    $this->form_validation->set_rules('no_kk', 'no_kk', 'trim|required');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required');
    $this->form_validation->set_rules('jk', 'jk', 'trim|required');
    $this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'trim|required');
    $this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'trim|required');
    $this->form_validation->set_rules('golda', 'golda', 'trim|required');
    $this->form_validation->set_rules('agama', 'agama', 'trim|required');
    $this->form_validation->set_rules('status_kawin', 'status_kawin', 'trim|required');
    $this->form_validation->set_rules('status_keluarga', 'status_keluarga', 'trim|required');
    $this->form_validation->set_rules('status', 'status', 'trim|required');
    $this->form_validation->set_rules('kewarganegaraan', 'kewarganegaraan', 'trim|required');
    $this->form_validation->set_rules('pendidikan', 'pendidikan', 'trim|required');
    $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
    $this->form_validation->set_rules('no_hp', 'no_hp', 'trim|required');
    $this->form_validation->set_rules('nm_ayah', 'nm_ayah', 'trim|required');
    $this->form_validation->set_rules('nm_ibu', 'nm_ibu', 'trim|required');
    $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
    $this->form_validation->set_rules('no_rumah', 'no_rumah', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  public function _rulesid()
  {
    $this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
    $this->form_validation->set_rules('no_kk', 'no kk', 'trim|required');
    $this->form_validation->set_rules('kpl_keluarga', 'kpl keluarga', 'trim|required');
    $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
    $this->form_validation->set_rules('kab_kota', 'kab kota', 'trim|required');
    $this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required');
    $this->form_validation->set_rules('no_tlp', 'no telp', 'trim|required');
    $this->form_validation->set_rules('desa_kel', 'desa kel', 'trim|required');
    $this->form_validation->set_rules('dusun', 'dusun', 'trim|required');
    $this->form_validation->set_rules('alamat_kantor_desa', 'alamat kantor desa', 'trim|required');
    $this->form_validation->set_rules('kd_pos', 'kode pos', 'trim|required');
    $this->form_validation->set_rules('rw', 'rw', 'trim|required');
    $this->form_validation->set_rules('rt', 'rt', 'trim|required');
    $this->form_validation->set_rules('nm_ketua_rt', 'nama ketua rt', 'trim|required');
    $this->form_validation->set_rules('alamat_rumah_rt', 'alamat rumah rt', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  public function _ruleskk()
  {
    $this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
    $this->form_validation->set_rules('no_kk', 'no kk', 'trim|required');
    $this->form_validation->set_rules('kpl_keluarga', 'kpl keluarga', 'trim|required');
    $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
    $this->form_validation->set_rules('kab_kota', 'kab kota', 'trim|required');
    $this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required');
    $this->form_validation->set_rules('desa_kel', 'desa kel', 'trim|required');
    $this->form_validation->set_rules('kd_pos', 'kode pos', 'trim|required');
    $this->form_validation->set_rules('rw', 'rw', 'trim|required');
    $this->form_validation->set_rules('rt', 'rt', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }

  public function _ruleskeg()
  {
    $this->form_validation->set_rules('judul_kegiatan', 'judul kegiatan', 'trim|required');
    $this->form_validation->set_rules('isi_kegiatan', 'isi kegiatan', 'trim|required');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }
}
