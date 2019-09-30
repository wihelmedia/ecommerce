<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Warga_model', 'warga');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top-bar', $data);
        $this->load->view('warga/index', $data);
        $this->load->view('templates/footer');
    }

    public function layanan()
    {
        $data['title'] = 'Layanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $row = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $nohp = $this->db->get_where('warga', array('no_ktp' => $row['no_ktp']))->row_array();
        $datawarga = array(
            'no_ktp' => set_value('no_ktp', $row['no_ktp']),
            'name' => set_value('name', $row['name']),
            'no_hp' => set_value('no_hp', $nohp['no_hp'])
        );
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top-bar', $data);
        $this->load->view('warga/layanan', $datawarga);
        $this->load->view('templates/footer');
    }

    public function layanan_action()
    {
        $this->_rules();
        $nohp_rt = $this->db->get('identitas')->row_array()['no_tlp'];
        $nama = $this->input->post('name', TRUE);
        if($this->form_validation->run() == FALSE){
            $this->layanan();
        } else {
            $data = array(
                'name' => $this->input->post('name', TRUE),
                'no_ktp' => $this->input->post('no_ktp', TRUE),
                'keperluan' => $this->input->post('keperluan', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'status' => 'N',
                'date_created' => time(),
            );
            $this->db->insert('rt', $data);
            $this->db->insert('surat_keluar', $data);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.thebigbox.id/sms-notification/1.0.0/messages",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "msisdn=".$nohp_rt."&content=".$nama."%20ingin%20mengurus%20akan%20diproses",
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
            $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Pesan terkirim ke Ketua RT!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('warga');
        }
    }
    
    public function deliuran($id)
    {
        $this->db->where('id', $id);
        $deleted = $this->db->delete('iuran_warga');
        if ($deleted) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success deleted iuran!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('warga/iuranwarga');
        }
    }

    public function statussurat()
    {
        $config['base_url'] = base_url('warga/statussurat');
        $config['total_rows'] = $this->db->count_all('surat_keluar');
        $config['per_page'] = 10;
        $config['num_links'] = 5;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['title'] = 'Status Surat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['surat'] = $this->warga->getsurat($config['per_page'], $data['start']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top-bar', $data);
        $this->load->view('warga/statussurat', $data);
        $this->load->view('templates/footer');
    }

    public function delpesan($id)
    {
        $this->db->where('id', $id);
        $deleted = $this->db->delete('surat_keluar');
        if ($deleted) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success deleted message!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('warga/statussurat');
        }
    }

    public function editeiuran()
    {
        echo json_encode($this->warga->iuranshow($_POST['id']));
    }

    public function updateiuran()
    {
        $data = array(
            'thn_iuran' => $_POST['thn_iuranedit'],
            'bulan' => $_POST['bulanedit'],
            'ket' => $_POST['ketedit'],
            'nama_kk' => $_POST['nama_kkedit'],
            'alamat' => $_POST['alamatedit'],
            'no_rumah' => $_POST['no_rumahedit'],
            'iuran' => $_POST['iuranedit'],
            'tgl_pembukuan' => $_POST['tgl_pembukuanedit']
        );
        $update = $this->db->update('iuran_warga', $data, array('id' => $_POST['id']));
        $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">Success iuran updated!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('warga/iuranwarga');
    }

    public function iuranwarga()
    {
        $config['base_url'] = base_url('warga/iuranwarga');
        $config['total_rows'] = $this->db->count_all('iuran_warga');
        $config['per_page'] = 5;
        $config['num_links'] = 5;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $this->form_validation->set_rules('thn_iuran', 'thn_iuran', 'trim|required');
        $this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required');
        $this->form_validation->set_rules('nama_kk', 'nama_kk', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('no_rumah', 'no_rumah', 'trim|required');
        $this->form_validation->set_rules('iuran', 'iuran', 'trim|required');
        $this->form_validation->set_rules('tgl_pembukuan', 'tgl_pembukuan', 'trim|required');
        $detailwarga = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $detail =  $this->db->get_where('warga', array('no_ktp' => $detailwarga['no_ktp']))->row_array();
        $data = array(
            'title' => 'Iuran Warga',
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'iuran_warga' => $this->warga->getiuranwarga($config['per_page'], $data['start']),
            'thn_iuran' => set_value('thn_iuran'),
            'bulan' => set_value('bulan'),
            'tgl_pembukuan' => set_value('tgl_pembukuan'),
            'ket' => set_value('ket'),
            'iuran' => set_value('iuran'),
            'nama_kk' => set_value('nama_kk', $detail['nama']),
            'alamat' => set_value('alamat', $detail['alamat']),
            'no_rumah' => set_value('no_rumah', $detail['no_rumah'])
        );
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/top-bar', $data);
            $this->load->view('warga/iuranwarga', $data);
            $this->load->view('templates/footer');
        } else {
            $iuran = array(
                'thn_iuran' => $this->input->post('thn_iuran', TRUE),
                'bulan' => $this->input->post('bulan', TRUE),
                'tgl_pembukuan' => $this->input->post('tgl_pembukuan', TRUE),
                'ket' => $this->input->post('ket', TRUE),
                'iuran' => $this->input->post('iuran', TRUE),
                'nama_kk' => $this->input->post('nama_kk', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_rumah' => $this->input->post('no_rumah', TRUE)
            );
            $this->db->insert('iuran_warga', $iuran);
            $this->session->set_flashdata('msg', '<div class="alert alert-success col-sm-6 mx-auto" role="alert">New iuran added!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('warga/iuranwarga');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_ktp', 'no_ktp', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('keperluan', 'keperluan', 'trim|required');
        // $this->form_validation->set_rules('pendidikan', 'pendidikan', 'trim|required');
        // $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
        // $this->form_validation->set_rules('nm_ayah', 'nm_ayah', 'trim|required');
        // $this->form_validation->set_rules('nm_ibu', 'nm_ibu', 'trim|required');
        // $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        // $this->form_validation->set_rules('no_rumah', 'no_rumah', 'trim|required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
