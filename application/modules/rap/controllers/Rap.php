<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rap extends Secure_Controller {

	public function __construct()
	{
        parent::__construct();
        // Your own constructor code
        $this->load->model(array('admin/m_admin','crud_global','m_themes','pages/m_pages','menu/m_menu','admin_access/m_admin_access','DB_model','member_back/m_member_back','m_member','pmm/pmm_model','admin/Templates','pmm/pmm_finance','produk/m_produk'));
        $this->load->library('enkrip');
		$this->load->library('filter');
		$this->load->library('waktu');
		$this->load->library('session');
    }

	public function form_bahan()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['products'] = $this->db->select('*')->get_where('produk', array('status' => 'PUBLISH', 'kategori_produk' => 1))->result_array();
			$data['mutu_beton'] = $this->db->select('*')->get_where('produk', array('status' => 'PUBLISH', 'kategori_produk' => 2))->result_array();
			$data['measures'] = $this->db->select('*')->get_where('pmm_measures', array('status' => 'PUBLISH'))->result_array();
			$data['slump'] = $this->db->select('*')->get_where('pmm_slump', array('status' => 'PUBLISH'))->result_array();
			$data['semen'] = $this->pmm_model->getMatByPenawaranSemen();
			$data['pasir'] = $this->pmm_model->getMatByPenawaranPasir();
			$data['split_1020'] = $this->pmm_model->getMatByPenawaran1020();
			$data['split_2030'] = $this->pmm_model->getMatByPenawaran2030();
			$data['additive'] = $this->pmm_model->getMatByPenawaranAdditive();
			$data['alat'] = $this->pmm_model->getRAPAlat();
			$data['bua'] = $this->pmm_model->getRAPBUA();
			$this->load->view('rap/form_bahan', $data);
		} else {
			redirect('admin');
		}
	}
	
	public function submit_agregat()
	{
		$mutu_beton = $this->input->post('mutu_beton');
		$volume = str_replace(',', '.', $this->input->post('volume'));
		$measure = $this->input->post('measure');
		$jobs_type = $this->input->post('jobs_type');
		$measure_a = $this->input->post('measure_a');
		$measure_b = $this->input->post('measure_b');
		$measure_c = $this->input->post('measure_c');
		$measure_d = $this->input->post('measure_d');
		$measure_e = $this->input->post('measure_e');
		$produk_a = $this->input->post('produk_a');
		$produk_b = $this->input->post('produk_b');
		$produk_c = $this->input->post('produk_c');
		$produk_d = $this->input->post('produk_d');
		$produk_e = $this->input->post('produk_e');
		$presentase_a = str_replace(',', '.', $this->input->post('presentase_a'));
		$presentase_b = str_replace(',', '.', $this->input->post('presentase_b'));
		$presentase_c = str_replace(',', '.', $this->input->post('presentase_c'));
		$presentase_d = str_replace(',', '.', $this->input->post('presentase_d'));
		$presentase_e = str_replace(',', '.', $this->input->post('presentase_e'));
		$penawaran_semen = $this->input->post('penawaran_semen');
		$penawaran_pasir = $this->input->post('penawaran_pasir');
		$penawaran_1020 = $this->input->post('penawaran_1020');
		$penawaran_2030 = $this->input->post('penawaran_2030');
		$penawaran_additive = $this->input->post('penawaran_additive');
		$price_a = str_replace('.', '', $this->input->post('price_a'));
		$price_b = str_replace('.', '', $this->input->post('price_b'));
		$price_c = str_replace('.', '', $this->input->post('price_c'));
		$price_d = str_replace('.', '', $this->input->post('price_d'));
		$price_e = str_replace('.', '', $this->input->post('price_e'));
		$total_a = str_replace('.', '', $this->input->post('total_a'));
		$total_b = str_replace('.', '', $this->input->post('total_b'));
		$total_c = str_replace('.', '', $this->input->post('total_c'));
		$total_d = str_replace('.', '', $this->input->post('total_d'));
		$total_e = str_replace('.', '', $this->input->post('total_e'));
		$rap_alat = $this->input->post('rap_alat');
		$rap_bua = $this->input->post('rap_bua');
		$memo = $this->input->post('memo');
		$attach = $this->input->post('files[]');

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

		$arr_insert = array(
			'mutu_beton' => $mutu_beton,
			'volume' => $volume,
			'measure' => $measure,
			'jobs_type' => $jobs_type,
			'measure_a' => $measure_a,
			'measure_b' => $measure_b,
			'measure_c' => $measure_c,
			'measure_d' => $measure_d,
			'measure_e' => $measure_e,			
			'produk_a' => $produk_a,
			'produk_b' => $produk_b,
			'produk_c' => $produk_c,
			'produk_d' => $produk_d,
			'produk_e' => $produk_e,
			'presentase_a' => $presentase_a,
			'presentase_b' => $presentase_b,
			'presentase_c' => $presentase_c,
			'presentase_d' => $presentase_d,
			'presentase_e' => $presentase_e,
			'penawaran_semen' => $penawaran_semen,
			'penawaran_pasir' => $penawaran_pasir,
			'penawaran_1020' => $penawaran_1020,
			'penawaran_2030' => $penawaran_2030,
			'penawaran_additive' => $penawaran_additive,
			'price_a' => $price_a,
			'price_b' => $price_b,
			'price_c' => $price_c,
			'price_d' => $price_d,
			'price_e' => $price_e,
			'total_a' => $total_a,
			'total_b' => $total_b,
			'total_c' => $total_c,
			'total_d' => $total_d,
			'total_e' => $total_e,
			'rap_alat' => $rap_alat,
			'rap_bua' => $rap_bua,
			'memo' => $memo,
			'attach' => $attach,
			'status' => 'PUBLISH',
			'created_by' => $this->session->userdata('admin_id'),
			'created_on' => date('Y-m-d H:i:s')
		);

		if ($this->db->insert('pmm_agregat', $arr_insert)) {
			$agregat_id = $this->db->insert_id();

			if (!file_exists('uploads/agregat')) {
			    mkdir('uploads/agregat', 0777, true);
			}

			$data = [];
			$count = count($_FILES['files']['name']);
			for ($i = 0; $i < $count; $i++) {

				if (!empty($_FILES['files']['name'][$i])) {

					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path'] = 'uploads/agregat';
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['file_name'] = $_FILES['files']['name'][$i];

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('file')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						$data['totalFiles'][] = $filename;


						$data[$i] = array(
							'agregat_id' => $agregat_id,
							'lampiran'  => $data['totalFiles'][$i]
						);

						$this->db->insert('pmm_lampiran_agregat', $data[$i]);
						
					} 
				}
			}
		}


		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>ERROR</b>');
			redirect('rap/rap');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>SAVED</b>');
			redirect('admin/rap');
		}
	}
	
	public function table_agregat()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
			$this->db->where('ag.created_on >=',date('Y-m-d',strtotime($arr_date[0])));
			$this->db->where('ag.created_on <=',date('Y-m-d',strtotime($arr_date[1])));
		}
        $this->db->select('ag.id, ag.jobs_type, p.nama_produk as mutu_beton, lk.agregat_id, lk.lampiran, ag.status, ag.created_by, ag.created_on');
		$this->db->join('pmm_lampiran_agregat lk', 'ag.id = lk.agregat_id','left');
		$this->db->join('produk p', 'ag.mutu_beton = p.id','left');
		$this->db->where("ag.status = 'PUBLISH'");
		$this->db->order_by('ag.created_on','desc');	
		$this->db->order_by('p.nama_produk','desc');	
		$query = $this->db->get('pmm_agregat ag');
		
       if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
				$row['jobs_type'] = $row['jobs_type'];
				$row['mutu_beton'] = $row['mutu_beton'];
				$row['lampiran'] = '<a href="' . base_url('uploads/agregat/' . $row['lampiran']) .'" target="_blank">' . $row['lampiran'] . '</a>';           
                $row['admin_name'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');
                $row['created_on'] = date('d/m/Y H:i:s',strtotime($row['created_on']));
				if($this->session->userdata('admin_group_id') == 1){
				$row['closed'] = '<a href="'.site_url().'rap/closed_komposisi/'.$row['id'].'" class="btn btn-danger" style="border-radius:10px;"><i class="fa fa-briefcase"></i> </a>';
				}else {
					$row['closed'] = '-';
				}
				$row['status'] = $this->pmm_model->GetStatus4($row['status']);
				if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4){
				$row['edit'] = '<a href="'.site_url().'rap/sunting_komposisi/'.$row['id'].'" class="btn btn-warning" style="border-radius:10px;"><i class="fa fa-edit"></i> </a>';
				}else {
					$row['edit'] = '-';
				}
				$row['print'] = '<a href="'.site_url().'rap/cetak_komposisi/'.$row['id'].'" target="_blank" class="btn btn-info" style="border-radius:10px;"><i class="fa fa-print"></i> </a>';
				if($this->session->userdata('admin_group_id') == 1){
				$row['actions'] = '<a href="javascript:void(0);" onclick="DeleteDataBahan('.$row['id'].')" class="btn btn-danger" style="border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['actions'] = '-';
				}
				$data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }
	
	public function delete_rap_bahan()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){

			$file = $this->db->select('ag.id as agregat_id, ag.lampiran')
			->from('pmm_lampiran_agregat ag')
			->where("ag.agregat_id = $id")
			->get()->row_array();

			$path = './uploads/agregat/'.$file['lampiran'];
			chmod($path, 0777);
			unlink($path);

			$this->db->delete('pmm_lampiran_agregat', array('agregat_id' => $id));
			$this->db->delete('pmm_agregat', array('id' => $id));
			{
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}
	
	public function data_komposisi($id)
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['tes'] = '';
			$data['agregat'] = $this->db->get_where("pmm_agregat", ["id" => $id])->row_array();
			$data['lampiran'] = $this->db->get_where("pmm_lampiran_agregat", ["agregat_id" => $id])->result_array();
			$this->load->view('rap/data_komposisi', $data);
		} else {
			redirect('admin');
		}
	}

	public function sunting_komposisi($id)
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['tes'] = '';
			$data['agregat'] = $this->db->get_where("pmm_agregat", ["id" => $id])->row_array();
			$data['lampiran'] = $this->db->get_where("pmm_lampiran_agregat", ["agregat_id" => $id])->result_array();
			$data['semen'] = $this->pmm_model->getMatByPenawaranSemen();
			$data['pasir'] = $this->pmm_model->getMatByPenawaranPasir();
			$data['split_1020'] = $this->pmm_model->getMatByPenawaran1020();
			$data['split_2030'] = $this->pmm_model->getMatByPenawaran2030();
			$data['additive'] = $this->pmm_model->getMatByPenawaranAdditive();
			$data['alat'] = $this->pmm_model->getRAPAlat();
			$data['bua'] = $this->pmm_model->getRAPBUA();
			$this->load->view('rap/sunting_komposisi', $data);
		} else {
			redirect('admin');
		}
	}

	public function submit_sunting_agregat()
	{

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); #

			$id = $this->input->post('id');

			$presentase_a = str_replace(',', '.', $this->input->post('presentase_a'));
			$presentase_b = str_replace(',', '.', $this->input->post('presentase_b'));
			$presentase_c = str_replace(',', '.', $this->input->post('presentase_c'));
			$presentase_d = str_replace(',', '.', $this->input->post('presentase_d'));
			$presentase_e = str_replace(',', '.', $this->input->post('presentase_e'));
			$price_a = str_replace('.', '', $this->input->post('price_a'));
			$price_b = str_replace('.', '', $this->input->post('price_b'));
			$price_c = str_replace('.', '', $this->input->post('price_c'));
			$price_d = str_replace('.', '', $this->input->post('price_d'));
			$price_e = str_replace('.', '', $this->input->post('price_e'));
			$total_a = str_replace('.', '', $this->input->post('total_a'));
			$total_b = str_replace('.', '', $this->input->post('total_b'));
			$total_c = str_replace('.', '', $this->input->post('total_c'));
			$total_d = str_replace('.', '', $this->input->post('total_d'));
			$total_e = str_replace('.', '', $this->input->post('total_e'));


			$arr_update = array(
				'presentase_a' => $presentase_a,
				'presentase_b' => $presentase_b,
				'presentase_c' => $presentase_c,
				'presentase_d' => $presentase_d,
				'presentase_e' => $presentase_e,
				'price_a' => $price_a,
				'price_b' => $price_b,
				'price_c' => $price_c,
				'price_d' => $price_d,
				'price_e' => $price_e,
				'total_a' => $total_a,
				'total_b' => $total_b,
				'total_c' => $total_c,
				'total_d' => $total_d,
				'total_e' => $total_e,
				'status' => 'PUBLISH',
				'updated_by' => $this->session->userdata('admin_id'),
				'updated_on' => date('Y-m-d H:i:s')
			);

			$this->db->where('id', $id);
			if ($this->db->update('pmm_agregat', $arr_update)) {
				
			}

			if ($this->db->trans_status() === FALSE) {
				# Something went wrong.
				$this->db->trans_rollback();
				$this->session->set_flashdata('notif_error', '<b>ERROR</b>');
				redirect('rap/komposisi_agregat/' . $this->input->post('id_penagihan'));
			} else {
				# Everything is Perfect. 
				# Committing data to the database.
				$this->db->trans_commit();
				$this->session->set_flashdata('notif_success', '<b>SAVED</b>');
				redirect('admin/rap/' . $this->input->post('id_penagihan'));
			}
	}
	
	public function cetak_komposisi($id){

		$this->load->library('pdf');
	

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(true);
        $pdf->SetFont('helvetica','',7); 
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
		$pdf->setHtmlVSpace($tagvs);
		$pdf->AddPage('P');

		$data['row'] = $this->db->get_where('pmm_agregat',array('id'=>$id))->row_array();
        $html = $this->load->view('rap/cetak_komposisi',$data,TRUE);
        $row = $this->db->get_where('pmm_agregat',array('id'=>$id))->row_array();


        
        $pdf->SetTitle($row['jobs_type']);
        $pdf->nsi_html($html);
        $pdf->Output($row['jobs_type'].'.pdf', 'I');
	}

	public function closed_komposisi($id)
    {
        $this->db->set("status", "CLOSED");
        $this->db->where("id", $id);
        $this->db->update("pmm_agregat");
        $this->session->set_flashdata('notif_success', '<b>CLOSED</b>');
        redirect("admin/rap");
    }
	
	public function form_alat()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['products'] =  $this->db->select('*')
			->from('produk p')
			->where("p.status = 'PUBLISH'")
			->where("p.kategori_produk = 5 ")
			->order_by('nama_produk','asc')
			->get()->result_array();
			$data['truck_mixer'] = $this->pmm_model->getMatByTrucMixer();
			$data['bbm_solar'] = $this->pmm_model->getMatByBBM();
			$this->load->view('rap/form_alat', $data);
		} else {
			redirect('admin');
		}
	}
	
	public function submit_rap_alat()
	{
		$tanggal_rap_alat = $this->input->post('tanggal_rap_alat');
		$nomor_rap_alat = $this->input->post('nomor_rap_alat');
		$masa_kontrak = $this->input->post('masa_kontrak');
		$vol_batching_plant =  str_replace(',', '.', $this->input->post('vol_batching_plant'));
		$vol_pemeliharaan_batching_plant =  str_replace(',', '.', $this->input->post('vol_pemeliharaan_batching_plant'));
		$vol_wheel_loader =  str_replace(',', '.', $this->input->post('vol_wheel_loader'));
		$vol_pemeliharaan_wheel_loader =  str_replace(',', '.', $this->input->post('vol_pemeliharaan_wheel_loader'));
		$vol_truck_mixer =  str_replace(',', '.', $this->input->post('vol_truck_mixer'));
		$vol_bbm_solar =  str_replace(',', '.', $this->input->post('vol_bbm_solar'));
		$harsat_batching_plant =  str_replace('.', '', $this->input->post('harsat_batching_plant'));
		$harsat_pemeliharaan_batching_plant =  str_replace('.', '', $this->input->post('harsat_pemeliharaan_batching_plant'));
		$harsat_wheel_loader =  str_replace('.', '', $this->input->post('harsat_wheel_loader'));
		$harsat_pemeliharaan_wheel_loader =  str_replace('.', '', $this->input->post('harsat_pemeliharaan_wheel_loader'));
		$harsat_truck_mixer =  str_replace('.', '', $this->input->post('harsat_truck_mixer'));
		$harsat_bbm_solar =  str_replace('.', '', $this->input->post('harsat_bbm_solar'));
		$batching_plant =  str_replace('.', '', $this->input->post('batching_plant'));
		$pemeliharaan_batching_plant =  str_replace('.', '', $this->input->post('pemeliharaan_batching_plant'));
		$truck_mixer =  str_replace('.', '', $this->input->post('truck_mixer'));
		$wheel_loader =  str_replace('.', '', $this->input->post('wheel_loader'));
		$pemeliharaan_wheel_loader =  str_replace('.', '', $this->input->post('pemeliharaan_wheel_loader'));
		$bbm_solar =  str_replace('.', '', $this->input->post('bbm_solar'));

		$penawaran_truck_mixer = $this->input->post('penawaran_truck_mixer');
		$penawaran_bbm_solar = $this->input->post('penawaran_bbm_solar');

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

		$arr_insert = array(
			'tanggal_rap_alat' =>  date('Y-m-d', strtotime($tanggal_rap_alat)),
			'nomor_rap_alat' => $nomor_rap_alat,
			'masa_kontrak' => $masa_kontrak,
			'vol_batching_plant' => $vol_batching_plant,
			'vol_pemeliharaan_batching_plant' => $vol_pemeliharaan_batching_plant,
			'vol_wheel_loader' => $vol_wheel_loader,
			'vol_pemeliharaan_wheel_loader' => $vol_pemeliharaan_wheel_loader,
			'vol_truck_mixer' => $vol_truck_mixer,
			'vol_bbm_solar' => $vol_bbm_solar,
			'harsat_batching_plant' => $harsat_batching_plant / 200,
			'harsat_pemeliharaan_batching_plant' => $harsat_pemeliharaan_batching_plant,
			'harsat_wheel_loader' => $harsat_wheel_loader / 200,
			'harsat_pemeliharaan_wheel_loader' => $harsat_pemeliharaan_wheel_loader,
			'harsat_truck_mixer' => $harsat_truck_mixer / 200,
			'harsat_bbm_solar' => $harsat_bbm_solar,
			'batching_plant' => $vol_batching_plant * ($harsat_batching_plant / 200),
			'pemeliharaan_batching_plant' => $pemeliharaan_batching_plant,
			'wheel_loader' => $vol_wheel_loader * ($harsat_wheel_loader / 200),
			'pemeliharaan_wheel_loader' => $pemeliharaan_wheel_loader,
			'truck_mixer' => $vol_truck_mixer * ($harsat_truck_mixer / 200),
			'bbm_solar' => $bbm_solar,

			'penawaran_truck_mixer' => $penawaran_truck_mixer,
			'penawaran_bbm_solar' => $penawaran_bbm_solar,
			
			'status' => 'PUBLISH',
			'created_by' => $this->session->userdata('admin_id'),
			'created_on' => date('Y-m-d H:i:s')
		);
		
		if ($this->db->insert('rap_alat', $arr_insert)) {
			$rap_alat_id = $this->db->insert_id();

			if (!file_exists('uploads/rap_alat')) {
			    mkdir('uploads/rap_alat', 0777, true);
			}

			$data = [];
			$count = count($_FILES['files']['name']);
			for ($i = 0; $i < $count; $i++) {

				if (!empty($_FILES['files']['name'][$i])) {

					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path'] = 'uploads/rap_alat';
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['file_name'] = $_FILES['files']['name'][$i];

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('file')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						$data['totalFiles'][] = $filename;


						$data[$i] = array(
							'rap_alat_id' => $rap_alat_id,
							'lampiran'  => $data['totalFiles'][$i]
						);

						$this->db->insert('lampiran_rap_alat', $data[$i]);
					}
				}
			}
		}


		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>ERROR</b>');
			redirect('admin/rap');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>SAVED</b>');
			redirect('admin/rap');
		}
	}
	
	public function table_rap_alat()
	{   
        $data = array();

        $this->db->select('rap.*, lk.lampiran, rap.status');		
		$this->db->join('lampiran_rap_alat lk', 'rap.id = lk.rap_alat_id','left');
		$this->db->where('rap.status','PUBLISH');
		$this->db->order_by('rap.tanggal_rap_alat','desc');			
		$query = $this->db->get('rap_alat rap');
		
       	if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
				$row['tanggal_rap_alat'] =  date('d F Y',strtotime($row['tanggal_rap_alat']));
				$row['nomor_rap_alat'] = $row["nomor_rap_alat"];
				$row['lampiran'] = '<a href="' . base_url('uploads/rap_alat/' . $row['lampiran']) .'" target="_blank">' . $row['lampiran'] . '</a>';
				$row['admin_name'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');
                $row['created_on'] = date('d/m/Y H:i:s',strtotime($row['created_on']));
				$row['print'] = '<a href="'.site_url().'rap/cetak_rap_alat/'.$row['id'].'" target="_blank" class="btn btn-info" style="border-radius:10px;"><i class="fa fa-print"></i> </a>';
				
				if($this->session->userdata('admin_group_id') == 1){
				$row['actions'] = '<a href="javascript:void(0);" onclick="DeleteDataAlat('.$row['id'].')" class="btn btn-danger" style="border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['actions'] = '-';
				}

                $data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }

	public function delete_rap_alat()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){

			$file = $this->db->select('ag.lampiran')
			->from('lampiran_rap_alat ag')
			->where("ag.rap_alat_id = $id")
			->get()->row_array();

			$path = './uploads/rap_alat/'.$file['lampiran'];
			chmod($path, 0777);
			unlink($path);

			$this->db->delete('lampiran_rap_alat',array('rap_alat_id'=>$id));
			$this->db->delete('rap_alat',array('id'=>$id));
			{
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}
	
	public function cetak_rap_alat($id){

		$this->load->library('pdf');
	

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(true);
		$pdf->setPrintFooter(true);
        $pdf->SetFont('helvetica','',7); 
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
		$pdf->setHtmlVSpace($tagvs);
		$pdf->AddPage('P');

		$data['rap_alat'] = $this->db->get_where('rap_alat',array('id'=>$id))->row_array();
        $html = $this->load->view('rap/cetak_rap_alat',$data,TRUE);
        $rap_alat = $this->db->get_where('rap_alat',array('id'=>$id))->row_array();


        
        $pdf->SetTitle($rap_alat['nomor_rap_alat']);
        $pdf->nsi_html($html);
        $pdf->Output($rap_alat['nomor_rap_alat'].'.pdf', 'I');
	}

	public function form_bua()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['coa'] =  $this->db->select('*')
			->from('pmm_coa c')
			->where("c.status = 'PUBLISH'")
			->where("c.coa_category = 15")
			->order_by('c.coa','asc')
			->get()->result_array();
			$data['satuan'] = $this->db->order_by('measure_name', 'asc')->select('*')->get_where('pmm_measures', array('status' => 'PUBLISH'))->result_array();
			$this->load->view('rap/form_bua', $data);
		} else {
			redirect('admin');
		}
	}

	public function add_coa()
    {
        $no = $this->input->post('no');
        $coa = $this->db->select('*')
		->from('pmm_coa c')
		->where("c.status = 'PUBLISH'")
		->where("c.coa_category = 15 ")
		->order_by('c.coa','asc')
		->get()->result_array();
		$satuan = $this->db->order_by('measure_name', 'asc')->select('*')->get_where('pmm_measures', array('status' => 'PUBLISH'))->result_array();
	?>
        <tr>
            <td><?php echo $no; ?>.</td>
            <td>
				<select id="coa-<?php echo $no; ?>" onchange="changeData(<?php echo $no; ?>)" class="form-control form-select2" name="coa_<?php echo $no; ?>">
					<option value="">Pilih Akun</option>
					<?php
					if(!empty($coa)){
						foreach ($coa as $row) {
							?>
							<option value="<?php echo $row['id'];?>">(<?php echo $row['coa_number'];?>) <?php echo $row['coa'];?></option>
							<?php
						}
					}
					?>
				</select>
			</td>
            <td>
				<input type="text" name="qty_<?php echo $no; ?>" id="qty-<?php echo $no; ?>" onchange="changeData(<?php echo $no; ?>)" class="form-control input-sm numberformat text-center" />
			</td>
			<td>
				<select id="satuan-<?php echo $no; ?>" class="form-control form-select2" name="satuan_<?php echo $no; ?>">
						<option value="">Pilih Satuan</option>
						<?php
						if(!empty($satuan)){
							foreach ($satuan as $sat) {
								?>
								<option value="<?php echo $sat['measure_name'];?>"><?php echo $sat['measure_name'];?></option>
								<?php
							}
						}
						?>
					</select>
				</td>
			<td>
				<input type="text" name="harga_satuan_<?php echo $no; ?>" id="harga_satuan-<?php echo $no; ?>" class="form-control rupiahformat tex-left input-sm text-right" onchange="changeData(<?php echo $no; ?>)" />
			</td>
			<td>
				<input type="text" name="jumlah_<?php echo $no; ?>" id="jumlah-<?php echo $no; ?>" class="form-control rupiahformat tex-left input-sm text-right"/>
			</td>
		</tr>

        <script type="text/javascript">
		$('.form-select2').select2();
		
		$('input.numberformat').number( true, 2,',','.' );
		$('input.rupiahformat').number( true, 0,',','.' );

		/*$(document).ready(function() {
        setTimeout(function(){
            $('#satuan-2').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-3').prop('selectedIndex', 2).trigger('change');
        }, 1000);
         });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-4').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-5').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });
        
        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-6').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-7').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-8').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-9').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-10').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-11').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-12').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-13').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-14').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-15').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-16').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

        $(document).ready(function() {
        setTimeout(function(){
            $('#satuan-17').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

		$(document).ready(function() {
        setTimeout(function(){
            $('#satuan-18').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

		$(document).ready(function() {
        setTimeout(function(){
            $('#satuan-19').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });

		$(document).ready(function() {
        setTimeout(function(){
            $('#satuan-20').prop('selectedIndex', 2).trigger('change');
        }, 1000);
        });*/
        </script>
    <?php
    }

	public function submit_rap_bua()
    {
		$tanggal_rap_bua = $this->input->post('tanggal_rap_bua');
		$nomor_rap_bua = $this->input->post('nomor_rap_bua');
		$masa_kontrak = $this->input->post('masa_kontrak');
        $total_product = $this->input->post('total_product');
        $total = $this->input->post('total');

        $arr_insert = array(
            'tanggal_rap_bua' => date('Y-m-d', strtotime($tanggal_rap_bua)),
			'nomor_rap_bua' => $nomor_rap_bua,
			'masa_kontrak' => $masa_kontrak,
            'total' => $total,
            'created_by' => $this->session->userdata('admin_id'),
            'created_on' => date('Y-m-d H:i:s'),
            'status' => 'PUBLISH'
        );


        if ($this->db->insert('rap_bua', $arr_insert)) {
            $rap_bua_id = $this->db->insert_id();

            for ($i = 1; $i <= $total_product; $i++) {
				$coa = $this->input->post('coa_' . $i);
				$qty = str_replace(',', '.', $this->input->post('qty_' . $i));
				$satuan = $this->input->post('satuan_' . $i);


				$harga_satuan = $this->input->post('harga_satuan_' . $i);
				$harga_satuan = str_replace('.', '', $harga_satuan);
				$harga_satuan = str_replace(',', '.', $harga_satuan);

				$jumlah_pro = $this->input->post('jumlah_' . $i);
				$jumlah_pro = str_replace('.', '', $jumlah_pro);
				$jumlah_pro = str_replace(',', '.', $jumlah_pro);

				if (!empty($coa)) {

                    $arr_detail = array(
                        'rap_bua_id' => $rap_bua_id,
                        'coa' => $coa,
                        'qty' => $qty,
                        'satuan' => $satuan,
                        'harga_satuan' => $harga_satuan,
                        'jumlah' => $jumlah_pro
                    );

                    $this->db->insert('rap_bua_detail', $arr_detail);
                } else {
                    redirect('rap/rap');
                    exit();
                }
            }

			if (!file_exists('uploads/rap_bua')) {
			    mkdir('uploads/rap_bua', 0777, true);
			}

			$data = [];
			$count = count($_FILES['files']['name']);
			for ($i = 0; $i < $count; $i++) {

				if (!empty($_FILES['files']['name'][$i])) {

					$_FILES['file']['name'] = $_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					$config['upload_path'] = 'uploads/rap_bua';
					$config['allowed_types'] = 'jpg|jpeg|png|pdf';
					$config['file_name'] = $_FILES['files']['name'][$i];

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('file')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						$data['totalFiles'][] = $filename;


						$data[$i] = array(
							'rap_bua_id' => $rap_bua_id,
							'lampiran'  => $data['totalFiles'][$i]
						);

						$this->db->insert('lampiran_rap_bua', $data[$i]);
					}
				}
			}


        }

        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            $this->session->set_flashdata('notif_error','<b>ERROR</b>');
            redirect('rap/rap');
        } else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            $this->session->set_flashdata('notif_success','<b>SAVED</b>');
            redirect('admin/rap');
        }
    }

	public function table_rap_bua()
	{   
        $data = array();

        $this->db->select('rap.*, lk.lampiran, rap.status');		
		$this->db->join('lampiran_rap_bua lk', 'rap.id = lk.rap_bua_id','left');
		$this->db->where('rap.status','PUBLISH');
		$this->db->group_by('rap.id');
		$this->db->order_by('rap.tanggal_rap_bua','desc');		
		$query = $this->db->get('rap_bua rap');
		
       if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
				$row['tanggal_rap_bua'] =  date('d F Y',strtotime($row['tanggal_rap_bua']));
				$row['nomor_rap_bua'] = $row["nomor_rap_bua"];
				$row['masa_kontrak'] = $row['masa_kontrak'];
				$row['total'] = number_format($row['total'],0,',','.');
				$row['lampiran'] = '<a href="' . base_url('uploads/rap_bua/' . $row['lampiran']) .'" target="_blank">' . $row['lampiran'] . '</a>';
				$row['admin_name'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');
                $row['created_on'] = date('d/m/Y H:i:s',strtotime($row['created_on']));
				$row['print'] = '<a href="'.site_url().'rap/cetak_rap_bua/'.$row['id'].'" target="_blank" class="btn btn-info" style="border-radius:10px;"><i class="fa fa-print"></i> </a>';
				
				if($this->session->userdata('admin_group_id') == 1){
				$row['actions'] = '<a href="javascript:void(0);" onclick="DeleteDataBUA('.$row['id'].')" class="btn btn-danger" style="border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['actions'] = '-';
				}

                $data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }

	public function delete_rap_bua()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){

			$file = $this->db->select('ag.lampiran')
			->from('lampiran_rap_bua ag')
			->where("ag.rap_bua_id = $id")
			->get()->row_array();

			$path = './uploads/rap_bua/'.$file['lampiran'];
			chmod($path, 0777);
			unlink($path);

			$this->db->delete('rap_bua',array('id'=>$id));
			$this->db->delete('rap_bua_detail',array('rap_bua_id'=>$id));
			$this->db->delete('lampiran_rap_bua',array('rap_bua_id'=>$id));
			{
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}

	public function cetak_rap_bua($id){

		$this->load->library('pdf');
	

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(true);
        $pdf->SetFont('helvetica','',7); 
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
		$pdf->setHtmlVSpace($tagvs);
		$pdf->AddPage('P');

		$data['id'] = $id;
        $html = $this->load->view('rap/cetak_rap_bua',$data,TRUE);
        
        $pdf->SetTitle('RAP BUA');
        $pdf->nsi_html($html);
		$pdf->Output('rap_bua.pdf', 'I');
	}
	

}
?>