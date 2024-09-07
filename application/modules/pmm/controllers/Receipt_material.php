<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipt_material extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        // Your own constructor code
        $this->load->model(array('admin/m_admin','crud_global','m_themes','pages/m_pages','menu/m_menu','admin_access/m_admin_access','DB_model','member_back/m_member_back','m_member','pmm_model','admin/Templates','pmm_finance'));
        $this->load->library('enkrip');
		$this->load->library('filter');
		$this->load->library('waktu');
		$this->load->library('session');
		$this->m_admin->check_login();
	}	

	public function manage()
	{	
		$check = $this->m_admin->check_login();
		if($check == true){		
			$id = $this->uri->segment(4);
			$get_data = $this->db->get_where('pmm_purchase_order',array('id'=>$id,'status !='=>'DELETED'))->row_array();
			$data['suppliers'] = $this->db->order_by('nama','asc')->get_where('penerima',array('status'=>'PUBLISH','rekanan'=>1))->result_array();
			$data['id'] = $id;
			$data['data'] = $get_data;
			$this->load->view('pmm/receipt_material_add',$data);
			
		}else {
			redirect('admin');
		}
	}

	
	public function get_mat_by_po()
	{
		$data = array();
		$purchase_order_id = $this->input->post('purchase_order_id');
		$supplier_id = $this->input->post('supplier_id');
		$materials = $this->pmm_model->GetPOMaterials($supplier_id,$purchase_order_id);
		$data[0]['id'] = '0';
		$data[0]['text'] = 'Pilih Produk';
		foreach ($materials as $key => $row) {
			$arr['id'] = $row['material_id'];
			$arr['text'] = $row['material_name'];
			$arr['measure'] = $row['measure'];
			$arr['tax_id'] = $row['tax_id'];
			$arr['tax'] = $row['tax'];
			$arr['pajak_id'] = $row['pajak_id'];
			$arr['pajak'] = $row['pajak'];
			$arr['harsat'] = $row['harsat'];
			$arr['display_measure'] = $this->crud_global->GetField('pmm_measures',array('id'=>$row['display_measure']),'measure_name');
			$arr['total_po'] = number_format($row['volume'],2,',','.');
			$receipt_material = $this->db->select('SUM(volume) as volume')->get_where('pmm_receipt_material',array('purchase_order_id'=>$purchase_order_id,'material_id'=>$row['material_id']))->row_array();

			$arr['receipt_material'] = number_format($receipt_material['volume'],2,',','.');
			$data[] = $arr;
		}
		echo json_encode(array('data'=>$data));
	}

	public function table()
	{	
		$data = array();
		$purchase_order_id = $this->input->post('purchase_order_id');
		$supplier_id = $this->input->post('supplier_id');
		$w_date = $this->input->post('filter_date');
		$this->db->select('no_po,id,supplier_id');
		$this->db->where('status','PUBLISH');
		if(!empty($supplier_id)){
			$this->db->where('supplier_id',$supplier_id);
		}
		if(!empty($purchase_order_id)){
			$this->db->where('id',$purchase_order_id);
		}
		$this->db->order_by('created_on','desc');
		$query = $this->db->get('pmm_purchase_order');
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
				$row['no'] = $key+1;
				$no_po = "'".$row['no_po']."'";
				$row['no_po'] = '<a href="'.site_url('pmm/purchase_order/get_pdf/'.$row['id']).'" target="_blank" >'.$row['no_po'].'</a>';
				$row['supplier'] = $this->crud_global->GetField('pmm_supplier',array('id'=>$row['supplier_id']),'name');

				$arr = $this->db->group_by('material_id')->select('material_id,id,measure')->get_where('pmm_purchase_order_detail',array('purchase_order_id'=>$row['id']))->result_array();
				$detail = '';
				foreach ($arr as $k => $v) {
					$total_po = $this->db->select('SUM(volume) as total')->get_where('pmm_purchase_order_detail',array('purchase_order_id'=>$row['id'],'material_id'=>$v['material_id']))->row_array();

					
    				$this->db->select('SUM(volume) as total');
    				if(!empty($w_date)){
						$arr_date = explode(' - ', $w_date);
						$start_date = $arr_date[0];
						$end_date = $arr_date[1];
						$this->db->where('date_receipt  >=',date('Y-m-d',strtotime($start_date)));	
						$this->db->where('date_receipt <=',date('Y-m-d',strtotime($end_date)));	
					}
    				$this->db->where(array('purchase_order_id'=>$row['id'],'material_id'=>$v['material_id']));
    				$total_rm = $this->db->get('pmm_receipt_material')->row_array();
					$material_name = $this->crud_global->GetField('pmm_materials',array('id'=>$v['material_id']),'material_name');
					$detail .= '<p>'.$material_name.' ('.$v['measure'].') = '.number_format($total_po['total'],4,',','.').' : <a href="javascript:void(0);" onclick="DetailData('.$row['id'].','.$v['material_id'].')">'.number_format($total_rm['total'],4,',','.').'</a></p>';
				}
				
				$row['persentase'] = $detail;

				$row['actions'] = '<a href="'.site_url('pmm/receipt_material/manage/'.$row['id']).'" class="btn btn-primary"><i class="fa fa-ambulance"></i> Add Receipt</a> <a href="javascript:void(0);" onclick="DetailData('.$row['id'].')" class="btn btn-info"><i class="fa fa-search"></i> View Receipt</a>';
				$data[] = $row;
			}

		}
		echo json_encode(array('data'=>$data));
	}

	public function table_detail()
	{	
		$data = array();
		$w_date = $this->input->post('filter_date');
		$single_date = $this->input->post('single_date');
		$purchase_order_id = $this->input->post('purchase_order_id');
		$supplier_id = $this->input->post('supplier_id');
		$material_id = $this->input->post('material_id');
		$this->db->select('prm.*,ppo.no_po,ps.nama as supplier_name');
		if(!empty($supplier_id)){
			$this->db->where('ppo.supplier_id',$supplier_id);
		}
		
		if(!empty($purchase_order_id)){
			$this->db->where('prm.purchase_order_id',$purchase_order_id);
		}
		if(!empty($material_id) || $material_id != 0){
			$this->db->where('prm.material_id',$material_id);
		}
		
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('prm.date_receipt  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('prm.date_receipt <=',date('Y-m-d',strtotime($end_date)));	
		}
		$this->db->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left');
		$this->db->join('penerima ps','ppo.supplier_id = ps.id','left');
		$this->db->order_by('prm.created_on','DESC');
		$query = $this->db->get('pmm_receipt_material prm');
	
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
				$row['checkbox'] ='';
				$row['no'] = $key+1;
				$row['date_receipt'] = date('d F Y',strtotime($row['date_receipt']));
				$row['supplier_name'] = $row['supplier_name'];
				$row['material_name'] = $this->crud_global->GetField('produk',array('id'=>$row['material_id']),'nama_produk');
				$row['volume'] = number_format($row['volume'],2,',','.');
				$row['display_volume'] = number_format($row['display_volume'],2,',','.');
				$row['harga_satuan'] = number_format($row['harga_satuan'],0,',','.');
				$row['price'] = number_format($row['price'],0,',','.');
				$row['display_price'] = number_format($row['display_price'],0,',','.');
				$row['surat_jalan_file'] = '<a href="'.base_url().'uploads/surat_jalan_penerimaan/'.$row['surat_jalan_file'].'" target="_blank">'.$row['surat_jalan_file'].'</a>';
				$row['memo'] = $row['memo'];
				$row['status_payment'] = $this->pmm_model->StatusPayment($row['status_payment']);
				$edit = false;
				if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 4){
					$edit = '<a href="javascript:void(0);" onclick="EditData('.$row['id'].')" class="btn btn-primary"><i class="fa fa-edit"></i> </a>';			
				}

				$row['actions'] = ' <a href="javascript:void(0);" onclick="DeleteData('.$row['id'].')" class="btn btn-danger"><i class="fa fa-close"></i> </a>';
				//$row['actions'] = $edit.' <a href="javascript:void(0);" onclick="DeleteData('.$row['id'].')" class="btn btn-danger"><i class="fa fa-close"></i> </a>';
				
				$row['admin_name'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');
                $row['created_on'] = date('d/m/Y H:i:s',strtotime($row['created_on']));
				
				$uploads_surat_jalan = '<a href="javascript:void(0);" onclick="UploadDocSuratJalan('.$row['id'].')" class="btn btn-primary" style="border-radius:10px;" title="Upload Surat Jalan" ><i class="fa fa-upload"></i> </a>';
				$row['uploads_surat_jalan'] = $uploads_surat_jalan.' ';
				
				$data[] = $row;
			}

		}
		echo json_encode(array('data'=>$data));
	}

	public function form_document()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){

			$file = '';
			$error_file = false;

			if (!file_exists('./uploads/surat_jalan_penerimaan/')) {
			    mkdir('./uploads/surat_jalan_penerimaan/', 0777, true);
			}
			// Upload email
			$config['upload_path']          = './uploads/surat_jalan_penerimaan/';
	        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG|pdf';

	        $this->load->library('upload', $config);

			if($_FILES["file"]["error"] == 0) {
				if (!$this->upload->do_upload('file'))
				{
						$error = $this->upload->display_errors();
						$file = $error;
						$error_file = true;
				}else{
						$data = $this->upload->data();
						$file = $data['file_name'];
				}
			}

			if($error_file){
				$output['output'] = false;
				$output['err'] = $file;
				echo json_encode($output);
				exit();
			}

			$arr_data['surat_jalan_file'] = $file;

			if($this->db->update('pmm_receipt_material',$arr_data,array('id'=>$id))){
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}

	public function form_document_verifikasi()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){

			$file = '';
			$error_file = false;

			if (!file_exists('./uploads/verifikasi_dokumen/')) {
			    mkdir('./uploads/verifikasi_dokumen/', 0777, true);
			}
			// Upload email
			$config['upload_path']          = './uploads/verifikasi_dokumen/';
	        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG|pdf';

	        $this->load->library('upload', $config);

			if($_FILES["file"]["error"] == 0) {
				if (!$this->upload->do_upload('file'))
				{
						$error = $this->upload->display_errors();
						$file = $error;
						$error_file = true;
				}else{
						$data = $this->upload->data();
						$file = $data['file_name'];
				}
			}

			if($error_file){
				$output['output'] = false;
				$output['err'] = $file;
				echo json_encode($output);
				exit();
			}

			$arr_data['verifikasi_file'] = $file;

			if($this->db->update('pmm_penagihan_pembelian',$arr_data,array('id'=>$id))){
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}

	public function table_receipt()
	{	
		$data = array();
		$w_date = $this->input->post('filter_date');
		$single_date = $this->input->post('single_date');
		$purchase_order_id = $this->input->post('purchase_order_id');
		$supplier_id = $this->input->post('supplier_id');
		$material_id = $this->input->post('material_id');
		
		$date_kunci = $this->db->select('date')->order_by('date','desc')->limit(1)->get_where('kunci_bahan_baku')->row_array();
        $last_opname = date('Y-m-d', strtotime('0 days', strtotime($date_kunci['date'])));

		$this->db->select('prm.*,ppo.no_po,ps.nama as supplier_name');
		if(!empty($supplier_id)){
			$this->db->where('ppo.supplier_id',$supplier_id);
		}
		
		if(!empty($purchase_order_id)){
			$this->db->where('prm.purchase_order_id',$purchase_order_id);
		}
		if(!empty($material_id) || $material_id != 0){
			$this->db->where('prm.material_id',$material_id);
		}
		
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('prm.date_receipt  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('prm.date_receipt <=',date('Y-m-d',strtotime($end_date)));	
		}

		$this->db->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left');
		$this->db->join('penerima ps','ppo.supplier_id = ps.id','left');
		//$this->db->where("(date_receipt between '$awal_bulan' and '$akhir_bulan')");
		$this->db->where("date_receipt >= '$last_opname'");
		$this->db->where('prm.status_payment','UNCREATED');
		$this->db->order_by('prm.date_receipt','DESC');
		$query = $this->db->get('pmm_receipt_material prm');
		
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
				$row['checkbox'] ='';
				$row['no'] = $key+1;
				$row['date_receipt'] = date('d F Y',strtotime($row['date_receipt']));
				$row['supplier_name'] = $row['supplier_name'];
				$row['material_name'] = $this->crud_global->GetField('produk',array('id'=>$row['material_id']),'nama_produk');
				$row['volume'] = number_format($row['volume'],2,',','.');
				$row['display_volume'] = number_format($row['display_volume'],2,',','.');
				$row['harga_satuan'] = number_format($row['harga_satuan'],0,',','.');
				$row['price'] = number_format($row['price'],0,',','.');
				$row['display_price'] = number_format($row['display_price'],0,',','.');
				$row['surat_jalan_file'] = '<a href="'.base_url().'uploads/surat_jalan_penerimaan/'.$row['surat_jalan_file'].'" target="_blank">'.$row['surat_jalan_file'].'</a>';
				$row['status_payment'] = $this->pmm_model->StatusPayment($row['status_payment']);
				$row['admin_name'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');
                $row['created_on'] = date('d/m/Y H:i:s',strtotime($row['created_on']));
				$edit = false;
				$edit = '<a href="javascript:void(0);" onclick="EditData('.$row['id'].')" class="btn btn-primary" style="font-weight:bold; border-radius:10px;"><i class="fa fa-edit"></i> </a>';

				/*if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
					$row['edits'] = '<a href="javascript:void(0);" onclick="EditData('.$row['id'].')" class="btn btn-primary" style="font-weight:bold; border-radius:10px;"><i class="fa fa-edit"></i> </a>';
				}else {
					$row['edits'] = '-';
				}*/

				if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
					$row['actions'] = $edit.' <a href="javascript:void(0);" onclick="DeleteData('.$row['id'].')" class="btn btn-danger" style="font-weight:bold; border-radius:10px;"><i class="fa fa-close"></i> </a>';
					$row['actions'] = '<a href="javascript:void(0);" onclick="DeleteData('.$row['id'].')" class="btn btn-danger" style="font-weight:bold; border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['actions'] = '-';
				}
				
				$data[] = $row;
			}

		}
		echo json_encode(array('data'=>$data));
	}

	public function table_detail2()
	{	
		$data = array();
		$w_date = $this->input->post('filter_date');
		$single_date = $this->input->post('single_date');
		$purchase_order_id = $this->input->post('purchase_order_id');
		$supplier_id = $this->input->post('supplier_id');
		$material_id = $this->input->post('material_id');
		$this->db->select('prm.*,ppo.no_po,ps.nama as supplier_name');
		if(!empty($supplier_id)){
			$this->db->where('ppo.supplier_id',$supplier_id);
		}
		
		if(!empty($purchase_order_id)){
			$this->db->where('prm.purchase_order_id',$purchase_order_id);
		}
		if(!empty($material_id) || $material_id != 0){
			$this->db->where('prm.material_id',$material_id);
		}
		
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('prm.date_receipt  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('prm.date_receipt <=',date('Y-m-d',strtotime($end_date)));	
		}
		$this->db->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left');
		$this->db->join('penerima ps','ppo.supplier_id = ps.id','left');
		$this->db->order_by('prm.date_receipt','desc');
		$this->db->order_by('prm.created_on','desc');
		$query = $this->db->get('pmm_receipt_material prm');
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
				$row['checkbox'] ='';
				$row['no'] = $key+1;
				$row['date_receipt'] = date('d F Y',strtotime($row['date_receipt']));
				$row['material_name'] = $this->crud_global->GetField('produk',array('id'=>$row['material_id']),'nama_produk');
				$row['volume_val'] = $row['volume'];
				$row['volume'] = number_format($row['volume'],2,',','.');

				$row['display_volume_val'] = $row['display_volume'];
				$row['display_volume'] = number_format($row['display_volume'],2,',','.');

				$row['display_cost'] = $row['volume_val'] * $row['price'];

				$row['display_cost_val'] = $row['display_cost'];
				$row['display_cost'] = number_format($row['display_cost'],2,',','.');

				$row['convert_value'] = number_format($row['convert_value'],2,',','.');
				
				$row['surat_jalan_file'] = '<a href="'.base_url().'uploads/surat_jalan_penerimaan/'.$row['surat_jalan_file'].'" target="_blank">'.$row['surat_jalan_file'].'</a>';

				$row['status_payment'] = $this->general->StatusPayment($row['status_payment']);
				$edit = false;
				if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 4){
					$edit = '<a href="javascript:void(0);" onclick="EditData('.$row['id'].')" class="btn btn-primary"><i class="fa fa-edit"></i> </a>';			
				}

				$row['actions'] = $edit.' <a href="javascript:void(0);" onclick="DeleteData('.$row['id'].')" class="btn btn-danger"><i class="fa fa-close"></i> </a>';
				$data[] = $row;
			}

		}
		echo json_encode(array('data'=>$data));
	}

	public function total_mat()
	{	
		$data = array();
		$w_date = $this->input->post('filter_date');
		$single_date = $this->input->post('single_date');
		$this->db->select('SUM(volume) as total, measure');
		$this->db->where('purchase_order_id',$this->input->post('purchase_order_id'));
		$material_id = $this->input->post('material_id');
		if(!empty($material_id)){
			$this->db->where('material_id',$material_id);
		}
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('date_receipt  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('date_receipt <=',date('Y-m-d',strtotime($end_date)));	
		}
		if(!empty($single_date)){
			$this->db->where('date_receipt',date('Y-m-d',strtotime($single_date)));
		}
		
		$this->db->order_by('created_on','desc');
		$query = $this->db->get('pmm_receipt_material');
		if($query->num_rows() > 0){
			$row = $query->row_array();
			$data =  number_format($row['total'],4,',','.').' '.$row['measure'];
		}
		echo json_encode(array('data'=>$data));
	}


	function process()
	{
		$output['output'] = false;

		$purchase_order_id = $this->input->post('purchase_order_id');
		$material_id = $this->input->post('material_id');
		$tax_id = $this->input->post('tax_id');
		$pajak_id = $this->input->post('pajak_id');
		$date_receipt = $this->input->post('date_receipt_val');
		$volume = str_replace('.', '', $this->input->post('volume'));
		$volume = str_replace(',', '.', $volume);
		$convert_value = str_replace('.', '', $this->input->post('convert_value'));
		$convert_value = str_replace(',', '.', $convert_value);
		$display_volume = str_replace('.', '', $this->input->post('display_volume'));
		$display_volume = str_replace(',', '.', $display_volume);
		$surat_jalan = $this->input->post('surat_jalan');
		$no_kendaraan = $this->input->post('no_kendaraan');
		$driver = $this->input->post('driver');
		$memo = $this->input->post('memo');
		$measure = $this->input->post('measure_id');
		$display_measure = $this->input->post('display_measure');
		$supplier_id = $this->input->post('supplier_id');
		$price = $this->input->post('harsat');
		$new_price = $this->input->post('new_price');

		$get_po = $this->db->select('measure,price,volume')->get_where('pmm_purchase_order_detail',array('purchase_order_id'=>$purchase_order_id,'material_id'=>$material_id))->row_array();
		//$price = $get_po['price'];

		$select_operation = $this->input->post('edit_select_operation');

		$convert_value = str_replace('.', '', $this->input->post('berat_isi'));
		$convert_value = str_replace(',', '.', $convert_value);
		$display_price = $price;

		$file = '';
		$error_file = false;
		
		if(!empty($surat_jalan)){
			$new_name = $surat_jalan;
		}else {
			$new_name = date('Y-m-d_H:i:s').'_'.strtolower(str_replace(' ', '_', $supplier_name));
		}

		$config['upload_path']          = './uploads/surat_jalan_penerimaan/';
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG|pdf';
 
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);

		if($_FILES["surat_jalan_file"]["error"] == 0) {
			if (!$this->upload->do_upload('surat_jalan_file'))
			{
					$error = $this->upload->display_errors();
					$file = $error;
					$error_file = true;
			}else{
					$data = $this->upload->data();
					$file = $data['file_name'];
			}
		}

		if($error_file){
			$output['output'] = false;
			$output['err'] = $file;
			echo json_encode($output);
			exit();
		}

		$receipt_material = $this->db->select('SUM(volume) as volume')->get_where('pmm_receipt_material',array('purchase_order_id'=>$purchase_order_id,'material_id'=>$material_id))->row_array();

		if($receipt_material['volume'] + $volume > $get_po['volume']){
			$output['output'] = false;
			$output['err'] = '<b>Mohon maaf sudah melebihi volume pesanan pembelian, Silahkan buat pesanan pembelian baru.</b>';
			//$output['err'] = $this->session->set_flashdata('notif_error', '<b>Mohon maaf sudah melebihi volume pesanan pembelian, Silahkan buat pesanan pembelian baru.</b>');
			echo json_encode($output);
			exit();
		}

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

		$data_p = array(
			'purchase_order_id' => $purchase_order_id,
			'date_receipt' => date('Y-m-d',strtotime($date_receipt)),
			'material_id' => $material_id,
			'tax_id' => $tax_id,
			'pajak_id' => $pajak_id,
			'measure' => $measure,
			'volume' => $volume,
			'convert_value' => $convert_value,
			'display_measure' => $display_measure,
			'display_volume' => $volume * $convert_value,
			'harga_satuan' => $new_price,
			'display_harga_satuan' => ($volume * $new_price) / $display_volume,
			'price'	=> ($volume * $new_price),
			'display_price' => ($volume * $new_price),
			'surat_jalan' => $surat_jalan,
			'surat_jalan_file' => $file,
			'no_kendaraan' => $no_kendaraan,
			'driver' => $driver,
			'memo' => $memo
		);

		$data_p['created_on'] = date('Y-m-d H:i:s');
		$data_p['created_by'] = $this->session->userdata('admin_id');
		$this->db->insert('pmm_receipt_material',$data_p);
		$no_production = $this->db->insert_id();

		//$coa_description = 'Penerimaan Nomor '.$no_production;
		//$this->pmm_finance->InsertTransactions(7,$coa_description,$price * $volume,0);
		//$this->pmm_finance->InsertTransactions(39,$coa_description,0,$price * $volume);
		
		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$output['output'] = false;
		} 
		else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$output['output'] = true;
		}
		echo json_encode($output);	
	}

	public function delete_detail()
	{
		$output['output'] = false;
		$id = $this->input->post('id');

		$file = $this->db->select('prm.surat_jalan_file')
		->from('pmm_receipt_material prm')
		->where("prm.id = $id")
		->get()->row_array();

		$path = './uploads/surat_jalan_penerimaan/'.$file['surat_jalan_file'];
		chmod($path, 0777);
		unlink($path);

		if(!empty($id)){
			
			if($this->db->delete('pmm_receipt_material',array('id'=>$id))){
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}


	public function table_dashboard()
	{
		$data = array();
		$arr_date = explode(' - ', $this->input->post('date'));
		$material = $this->input->post('material');

		$this->db->select('SUM(volume) as total,pm.material_name,prm.measure');
		$this->db->join('pmm_materials pm','prm.material_id = pm.id','left');
		if(!empty($arr_date)){
			$this->db->where('prm.date_receipt >=',date('Y-m-d',strtotime($arr_date[0])));
			$this->db->where('prm.date_receipt <=',date('Y-m-d',strtotime($arr_date[1])));
		}
		if(!empty($material)){
			$this->db->where('prm.material_id',$material);
		}
		$this->db->order_by('prm.date_receipt','desc');
		$this->db->group_by('prm.material_id');
		$query = $this->db->get('pmm_receipt_material prm');
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
				$row['no'] = $key+1;
				$row['material_name'] = $row['material_name'].' ('.$row['measure'].')';
				$row['total'] = number_format($row['total'],2,',','.');
				$data[] = $row;
			}

		}
		echo json_encode(array('data'=>$data));
	}
	
	function table_date_()
	{
		$data = array();
		$supplier_id = $this->input->post('supplier_id');
		$purchase_order_no = $this->input->post('purchase_order_no');
		$start_date = false;
		$end_date = false;
		$total = 0;
		$date = $this->input->post('filter_date');
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));
		}



		$this->db->select('id,name');
		if(!empty($supplier_id)){
			$this->db->where('id',$supplier_id);
		}
		$this->db->where('status','PUBLISH');
		$query = $this->db->get('pmm_supplier');
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $sups) {

				$materials = $this->pmm_model->GetReceiptMat($sups['id'],$purchase_order_no,$start_date,$end_date);
				foreach ($materials as $key => $row) {
					$get_real = $this->pmm_model->GetRealMat($row['material_id'],$start_date,$end_date,$sups['id'],$purchase_order_no);
					if($get_real['total'] > 0){
						$arr['no'] = $key + 1;
						$arr['measure'] = $row['measure'];
						$arr['material_name'] = $row['material_name'];
						
						$arr['real'] = number_format($get_real['total'],2,',','.');
						$arr['total_price'] = number_format($get_real['total_price'],2,',','.');
						
						$total += $get_real['total_price'];
						$arr['name'] = $sups['name'];
						$data[] = $arr;
					}
				}
				
			}
		}

		echo json_encode(array('data'=>$data,'total'=>number_format($total,2,',','.')));	
	}


	function get_po_by_supp()
	{
		$data = array();
		$supplier_id = $this->input->post('supplier_id');
		//$last_po = 0;
		//$check_last = false;
		$this->db->select('id,no_po,date_po');
		$this->db->from('pmm_purchase_order');
		$this->db->where('supplier_id',$supplier_id);
		//$this->db->where('status','PUBLISH');
		$this->db->order_by('date_po','desc');
		$query = $this->db->get()->result_array();
		$data = [];
		//$data[0] = ['id'=>'','text'=>'Pilih PO'];
		if (!empty($query)){
			foreach ($query as $row){
				$data[] = ['id' => $row['id'], 'text' => $row['no_po']];
			}
		}
		/*foreach ($query->result_array() as $key => $value) {
			$materials = $this->db->select('material_id,volume')->get_where('pmm_purchase_order_detail',array('purchase_order_id'=>$value['id']))->result_array();
			$count_mat = 0;
			$check_mat = 0;

			if(!empty($materials)){
				$count_mat = count($materials);
				foreach ($materials as $mat) {
					$receipt_material = $this->db->select('SUM(volume) as volume')->get_where('pmm_receipt_material',array('purchase_order_id'=>$value['id'],'material_id'=>$mat['material_id']))->row_array();
					if($receipt_material['volume'] >= $mat['volume']){
						$check_mat += 1;
					}
				}
			}

			if($check_mat < $count_mat){

				if($check_last == false){
					$last_po = $value['id'];
					$check_last = true;
				}
				$arr['id'] = $value['id'];
				$arr['text'] = $value['no_po'];
				$arr['date'] = $value['date_po'];
				$arr['check_mat'] = $check_mat;
				$data[]= $arr;
			}
			
		}*/
		//echo json_encode(array('data'=>$data,'last_po'=>$last_po));	
		echo json_encode(array('data'=>$data));
	}

	function get_mat_pembelian()
	{
		$data = array();
		$purchase_order_id = $this->input->post('purchase_order_id');
		$this->db->select('prm.material_id as id_new, p.nama_produk');
		$this->db->from('pmm_receipt_material prm');
		$this->db->join('produk p','prm.material_id = p.id','left');
		$this->db->where('prm.purchase_order_id',$purchase_order_id);
		$this->db->group_by('prm.material_id');
		$this->db->order_by('p.nama_produk','nama');
		$query = $this->db->get()->result_array();
		
		$data[0]['id'] = '0';
		$data[0]['text'] = 'Pilih Produk';
		if (!empty($query)){
			foreach ($query as $row){
				$data[] = ['id' => $row['id_new'], 'text' => $row['nama_produk']];
			}
		}
		
		echo json_encode(array('data'=>$data));
	}
	
	function get_po_by_supp_jasa()
	{
		$data = array();
		$supplier_id = $this->input->post('supplier_id');
		$last_po = 0;
		$check_last = false;
		$this->db->select('id,no_po,date_po');
		$this->db->where('supplier_id',$supplier_id);
		$this->db->where('status','PUBLISH');
		$this->db->order_by('date_po','desc');
		$query = $this->db->get('pmm_purchase_order');
		$data[0]['id'] = '0';
		$data[0]['text'] = 'Pilih PO';
		foreach ($query->result_array() as $key => $value) {
			$materials = $this->db->select('material_id,volume')->get_where('pmm_purchase_order_detail',array('purchase_order_id'=>$value['id']))->result_array();
			$count_mat = 0;
			$check_mat = 0;

			if(!empty($materials)){
				$count_mat = count($materials);
				foreach ($materials as $mat) {
					$receipt_material = $this->db->select('SUM(volume) as volume')->get_where('pmm_receipt_material',array('purchase_order_id'=>$value['id'],'material_id'=>$mat['material_id']))->row_array();
					if($receipt_material['volume'] >= $mat['volume']){
						$check_mat += 1;
					}
				}
			}

			if($check_mat < $count_mat){

				if($check_last == false){
					$last_po = $value['id'];
					$check_last = true;
				}
				$arr['id'] = $value['id'];
				$arr['text'] = $value['no_po'];
				$arr['date'] = $value['date_po'];
				$arr['check_mat'] = $check_mat;
				$data[]= $arr;
			}
			
		}
		echo json_encode(array('data'=>$data,'last_po'=>$last_po));		
	}
	
	function get_po_by_supp_alat()
	{
		$data = array();
		$supplier_id = $this->input->post('supplier_id');
		$last_po = 0;
		$check_last = false;
		$this->db->select('id,no_po,date_po');
		$this->db->where('supplier_id',$supplier_id);
		$this->db->where('status','PUBLISH');
		$this->db->order_by('date_po','desc');
		$query = $this->db->get('pmm_purchase_order');
		$data[0]['id'] = '0';
		$data[0]['text'] = 'Pilih PO';
		foreach ($query->result_array() as $key => $value) {
			$materials = $this->db->select('material_id,volume')->get_where('pmm_purchase_order_detail',array('purchase_order_id'=>$value['id']))->result_array();
			$count_mat = 0;
			$check_mat = 0;

			if(!empty($materials)){
				$count_mat = count($materials);
				foreach ($materials as $mat) {
					$receipt_material = $this->db->select('SUM(volume) as volume')->get_where('pmm_receipt_material',array('purchase_order_id'=>$value['id'],'material_id'=>$mat['material_id']))->row_array();
					if($receipt_material['volume'] >= $mat['volume']){
						$check_mat += 1;
					}
				}
			}

			if($check_mat < $count_mat){

				if($check_last == false){
					$last_po = $value['id'];
					$check_last = true;
				}
				$arr['id'] = $value['id'];
				$arr['text'] = $value['no_po'];
				$arr['date'] = $value['date_po'];
				$arr['check_mat'] = $check_mat;
				$data[]= $arr;
			}
			
		}
		echo json_encode(array('data'=>$data,'last_po'=>$last_po));		
	}

	public function edit_data_detail()
	{
		$id = $this->input->post('id');

		$this->db->select('prm.*, ppo.no_po, pm.nama_produk as material, ps.nama as rekanan');
		$this->db->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left');
		$this->db->join('produk pm','prm.material_id = pm.id','left');
		$this->db->join('penerima ps','ppo.supplier_id = ps.id','left');
		$data = $this->db->get_where('pmm_receipt_material prm',array('prm.id'=>$id))->row_array();
		$data['date_receipt'] = date('d-m-Y',strtotime($data['date_receipt']));
		$po = $this->db->select('id,no_po')->order_by('date_po','desc')->get_where('pmm_purchase_order',array('supplier_id'=>$data['rekanan']))->result_array();
		
		echo json_encode(array('data'=>$data,'po'=>$po));		
	}



	public function edit_process()
	{
		$output['output'] = false;

		$file = $this->input->post('edit_surat_jalan_file_val');
		$error_file = false;

		$config['upload_path']          = './uploads/surat_jalan_penerimaan/';
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG|pdf';

        $this->load->library('upload', $config);

        if(!empty($file)){
        	if($_FILES["edit_surat_jalan_file"]["error"] == 0) {
				if (!$this->upload->do_upload('edit_surat_jalan_file'))
				{
						$error = $this->upload->display_errors();
						$file = $error;
						$error_file = true;
				}else{
						$data = $this->upload->data();
						$file = $data['file_name'];
				}
			}
        }
		

		if($error_file){
			$output['output'] = false;
			$output['err'] = $file;
			echo json_encode($output);
			exit();
		}

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

		$id = $this->input->post('id_edit');
		$purchase_order_id = $this->input->post('edit_po_val');
		$material_id = $this->input->post('edit_material_val');
		$date_receipt = $this->input->post('edit_date');
		$volume = str_replace('.', '', $this->input->post('edit_volume'));
		$volume = str_replace(',', '.', $volume);
		$display_volume = str_replace('.', '', $this->input->post('edit_display_volume'));
		$display_volume = str_replace(',', '.', $display_volume);
		$measure = $this->input->post('edit_measure');
		$surat_jalan = $this->input->post('edit_surat_jalan');
		$no_kendaraan = $this->input->post('edit_no_kendaraan');
		$driver = $this->input->post('edit_driver');
		$memo = $this->input->post('edit_memo');

		$get_po = $this->db->select('measure,price,volume')->get_where('pmm_purchase_order_detail',array('purchase_order_id'=>$purchase_order_id,'material_id'=>$material_id))->row_array();
		$price = $get_po['price'];

		$select_operation = $this->input->post('edit_select_operation');
		
		$display_measure = 'Ton';
		$convert_value = str_replace('.', '', $this->input->post('edit_convert_value'));
		$convert_value = str_replace(',', '.', $convert_value);
		$display_price = $price;

		$data_p = array(
			'purchase_order_id' => $purchase_order_id,
			'date_receipt' => date('Y-m-d',strtotime($date_receipt)),
			'material_id' => $material_id,
			'measure' => $measure,
			'volume' => $volume,
			'price'	=> $volume * $price,
			'surat_jalan' => $surat_jalan,
			//'surat_jalan_file' => $file,
			'no_kendaraan' => $no_kendaraan,
			'driver' => $driver,
			'display_measure' => $display_measure,
			'convert_value' => $convert_value,
			'display_volume' => $display_volume,
			'display_price' => $volume * $price,
			'harga_satuan' => $price,
			'display_harga_satuan' => ($volume * $price) / $display_volume,
			'memo' => $memo,
		);

		$data_p['updated_on'] = date('Y-m-d H:i:s');
		$data_p['updated_by'] = $this->session->userdata('admin_id');
		
		$this->db->update('pmm_receipt_material',$data_p,array('id'=>$id));
		

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$output['output'] = false;
		} 
		else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$output['output'] = true;
		}
		echo json_encode($output);	
	}


	function table_acc()
	{
		$data = array();
		$w_date = $this->input->post('filter_date');
		$single_date = $this->input->post('single_date');
		$purchase_order_id = $this->input->post('purchase_order_id');
		$supplier_id = $this->input->post('supplier_id');
		$material_id = $this->input->post('material_id');

		$this->db->select('prm.material_id, SUM(prm.volume) as volume, prm.measure');
		if(!empty($supplier_id)){
			$this->db->where('ppo.supplier_id',$supplier_id);
		}
		
		if(!empty($purchase_order_id)){
			$this->db->where('prm.purchase_order_id',$purchase_order_id);
		}
		if(!empty($material_id) || $material_id != 0){
			$this->db->where('prm.material_id',$material_id);
		}
		
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('prm.date_receipt  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('prm.date_receipt <=',date('Y-m-d',strtotime($end_date)));	
		}
		$this->db->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left');
		$this->db->order_by('prm.date_receipt','desc');
		$this->db->order_by('prm.created_on','desc');
		$this->db->group_by('prm.material_id');
		$query = $this->db->get('pmm_receipt_material prm');
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
				$row['no'] = $key+1;
				$row['material_name'] = $this->crud_global->GetField('pmm_materials',array('id'=>$row['material_id']),'material_name');
				$row['volume'] = number_format($row['volume'],2,',','.');
				$data[] = $row;
			}

		}
		echo json_encode(array('data'=>$data));		
	}

	public function print_pdf()
	{
		$this->load->library('pdf');
	

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        $pdf->SetFont('helvetica','',1); 
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
		$pdf->setHtmlVSpace($tagvs);

		// add a page
		$pdf->AddPage('L');
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetY(5);
		$pdf->SetX(5);
		$pdf->SetMargins(10, 10);        

		$w_date = $this->input->get('filter_date');
		$purchase_order_id = $this->input->get('purchase_order_id');
		$supplier_id = $this->input->get('supplier_id');
		$material_id = $this->input->get('filter_material');
		
		$this->db->select('prm.*,ppo.no_po, (prm.price  * prm.volume) as biaya, ppo.supplier_id');
		$this->db->where('ppo.supplier_id',$supplier_id);
		if(!empty($purchase_order_id || $purchase_order_id != 0)){
			$this->db->where('prm.purchase_order_id',$purchase_order_id);
		}
		if(!empty($material_id) || $material_id != 0){
			$this->db->where('prm.material_id',$material_id);
		}
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('prm.date_receipt  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('prm.date_receipt <=',date('Y-m-d',strtotime($end_date)));	
		}
		$this->db->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left');
		$this->db->order_by('prm.date_receipt','asc');
		$this->db->order_by('prm.created_on','asc');
		$query = $this->db->get('pmm_receipt_material prm');

		$supplier_name = '';
		if(!empty($supplier_id)){
			$supplier_name = $this->crud_global->GetField('pmm_supplier',array('id'=>$supplier_id),'name');
		}
		$data['supplier_name'] = $supplier_name;
		$data['data'] = $query->result_array();
        $html = $this->load->view('pmm/receipt_material_print',$data,TRUE);

        $pdf->SetTitle($this->input->get('filter_date'));
        $pdf->SetTitle('Rekap Penerimaan');
        $pdf->nsi_html($html);
        $pdf->Output('rekap_surat_jalan_pembelian.pdf', 'I');
	
	}


	function table_matuse()
	{
		$data = array();
		$supplier_id = $this->input->post('supplier_id');
		$purchase_order_no = $this->input->post('purchase_order_no');
		$filter_material = $this->input->post('filter_material');
		$start_date = false;
		$end_date = false;
		$total = 0;
		$total_convert = 0;
		$date = $this->input->post('filter_date');
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));
		}

		$no = 1;


		$this->db->select('ppo.supplier_id,prm.measure,ps.name,SUM(prm.volume) as total, SUM((prm.cost / prm.convert_value) * prm.display_volume) as total_price, prm.convert_value, SUM(prm.volume * prm.convert_value) as total_convert');
		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('prm.date_receipt >=',$start_date);
            $this->db->where('prm.date_receipt <=',$end_date);
        }
        if(!empty($supplier_id)){
            $this->db->where('ppo.supplier_id',$supplier_id);
        }
        if(!empty($filter_material)){
            $this->db->where_in('prm.material_id',$filter_material);
        }
        if(!empty($purchase_order_no)){
            $this->db->where('prm.purchase_order_id',$purchase_order_no);
        }
        $this->db->where('ps.status','PUBLISH');
		$this->db->join('pmm_supplier ps','ppo.supplier_id = ps.id','left');
		$this->db->join('pmm_receipt_material prm','ppo.id = prm.purchase_order_id');
		$this->db->join('pmm_materials pm','prm.material_id = pm.id','left');
		$this->db->group_by('ppo.supplier_id');
		$this->db->order_by('ps.name','asc');
		$query = $this->db->get('pmm_purchase_order ppo');
		
		if($query->num_rows() > 0){

			foreach ($query->result_array() as $key => $sups) {

				$mats = array();
				$materials = $this->pmm_model->GetReceiptMatUse($sups['supplier_id'],$purchase_order_no,$start_date,$end_date,$filter_material);
				if(!empty($materials)){
					foreach ($materials as $key => $row) {
						$arr['no'] = $key + 1;
						$arr['measure'] = $row['measure'];
						$arr['material_name'] = $row['material_name'];
						
						$arr['real'] = number_format($row['total'],2,',','.');
						$arr['convert_value'] = number_format($row['convert_value'],2,',','.');
						$arr['total_convert'] = number_format($row['total_convert'],2,',','.');
						$arr['total_price'] = number_format($row['total_price'],0,',','.');
						$mats[] = $arr;
					}
					$sups['mats'] = $mats;
					$total += $sups['total_price'];
					$total_convert += $sups['total_convert'];
					$sups['no'] =$no;
					$sups['real'] = number_format($sups['total'],2,',','.');
					$sups['convert_value'] = number_format($sups['convert_value'],2,',','.');
					$sups['total_convert'] = number_format($sups['total_convert'],2,',','.');
					$sups['total_price'] = number_format($sups['total_price'],0,',','.');
					$sups['measure'] = '';
					$data[] = $sups;
					$no++;
				}
				
				
			}
		}
		if(!empty($filter_material)){
			$total_convert = number_format($total_convert,2,',','.');
		}else {
			$total_convert = '';
		}
		echo json_encode(array('data'=>$data,'total'=>number_format($total,0,',','.'),'total_convert'=>$total_convert));	
	}


	function post_cost()
	{
		
	}


	function edit_rm()
	{
		$total = 0;
	}

	//BATAS RUMUS LAMA//

	function penerimaan_pembelian()
	{
		$data = array();
		$supplier_id = $this->input->post('supplier_id');
		$purchase_order_no = $this->input->post('purchase_order_no');
		$filter_material = $this->input->post('filter_material');
		$filter_kategori = $this->input->post('filter_kategori');
		$filter_kategori_bahan = $this->input->post('filter_kategori_bahan');
		$start_date = false;
		$end_date = false;
		$total_volume = 0;
		$total_nilai = 0;
		$date = $this->input->post('filter_date');
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));
		}

		$this->db->select('ppo.supplier_id,prm.display_measure as measure,ps.nama as name, prm.harga_satuan as price,SUM(prm.display_volume) as volume, SUM(prm.display_price) as total_price, p.kategori_bahan');
		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('prm.date_receipt >=',$start_date);
            $this->db->where('prm.date_receipt <=',$end_date);
        }
        if(!empty($supplier_id)){
            $this->db->where('ppo.supplier_id',$supplier_id);
        }
        if(!empty($filter_material)){
            $this->db->where_in('prm.material_id',$filter_material);
        }
        if(!empty($purchase_order_no)){
            $this->db->where('prm.purchase_order_id',$purchase_order_no);
        }
		if(!empty($filter_kategori)){
            $this->db->where('ppo.kategori_id',$filter_kategori);
        }
		if(!empty($filter_kategori_bahan)){
            $this->db->where('p.kategori_bahan',$filter_kategori_bahan);
        }
		
		$this->db->join('penerima ps','ppo.supplier_id = ps.id','left');
		$this->db->join('pmm_receipt_material prm','ppo.id = prm.purchase_order_id','left');
		$this->db->join('produk p','prm.material_id = p.id','left');
		$this->db->where("ppo.status in ('PUBLISH','CLOSED')");
		$this->db->group_by('ppo.supplier_id');
		$this->db->order_by('ps.nama','asc');
		$query = $this->db->get('pmm_purchase_order ppo');
		
		$no = 1;
		if($query->num_rows() > 0){

			foreach ($query->result_array() as $key => $sups) {

				$mats = array();
				$materials = $this->pmm_model->GetPenerimaanPembelian($sups['supplier_id'],$purchase_order_no,$start_date,$end_date,$filter_material,$filter_kategori,$filter_kategori_bahan);
				if(!empty($materials)){
					foreach ($materials as $key => $row) {
						$arr['no'] = $key + 1;
						$arr['measure'] = $row['measure'];
						$arr['nama_produk'] = $row['nama_produk'];
						$arr['purchase_order_id'] = '<a href="'.base_url().'pmm/purchase_order/manage/'.$row['purchase_order_id'].'" target="_blank">'.$row['purchase_order_id'] = $this->crud_global->GetField('pmm_purchase_order',array('id'=>$row['purchase_order_id']),'no_po').'</a>';
						$arr['volume'] = '<a href="'.base_url().'pmm/receipt_material/detail_transaction/'.$start_date.'/'.$end_date.'/'.$row['supplier_id'].'/'.$row['material_id'].'" target="_blank">'.number_format($row['volume'],2,',','.').'</a>';
						$arr['price'] = number_format($row['price'],0,',','.');
						$arr['total_price'] = number_format($row['total_price'],0,',','.');
						
						
						$arr['name'] = $sups['name'];
						$mats[] = $arr;
					}
					$sups['mats'] = $mats;
					$total_volume += $sups['volume'];
					$total_nilai += $sups['total_price'];
					$sups['no'] =$no;
					$sups['volume'] = number_format($sups['volume'],2,',','.');
					$sups['price'] = number_format($sups['price'],0,',','.');
					$sups['total_price'] = number_format($sups['total_price'],0,',','.');

					$data[] = $sups;
					$no++;
				}
				
				
			}
		}

		echo json_encode(array('data'=>$data,
		'total_volume'=>number_format($total_volume,2,',','.'),
		'total_nilai'=>number_format($total_nilai,0,',','.')
	));	
	}

	public function detail_transaction($start_date,$end_date,$id,$material_id)
    {
        $check = $this->m_admin->check_login();
        if($check == true){

            $this->db->select('ppo.*, SUM(prm.volume) as volume');
			$this->db->join('pmm_receipt_material prm','ppo.id = prm.purchase_order_id');
			$this->db->where('prm.date_receipt >=',$start_date);
            $this->db->where('prm.date_receipt <=',$end_date);
            $this->db->where('ppo.supplier_id',$id);
			$this->db->where('prm.material_id',$material_id);
			$this->db->group_by('ppo.id');
            $query = $this->db->get('pmm_purchase_order ppo');
            $data['row'] = $query->result_array();
            $this->load->view('laporan_pembelian/detail_transaction',$data);
            
        }else {
            redirect('admin');
        }
    }

	function laporan_hutang()
	{
		$data = array();
		$supplier_id = $this->input->post('supplier_id');
		$filter_kategori = $this->input->post('filter_kategori');
		$start_date = false;
		$end_date = false;
		$total_penerimaan = 0;
		$total_tagihan = 0;
		$total_tagihan_bruto = 0;
		$total_pembayaran = 0;
		$total_sisa_hutang_penerimaan = 0;
		$total_sisa_hutang_tagihan = 0;
		$date = $this->input->post('filter_date');
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));
		}

		$this->db->select('ppo.id, ppo.supplier_id, ps.nama as name');
		$this->db->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left');

		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('prm.date_receipt >=',$start_date);
            $this->db->where('prm.date_receipt <=',$end_date);
        }
        if(!empty($supplier_id) || $supplier_id != 0){
            $this->db->where('ppo.supplier_id',$supplier_id);
        }
		if(!empty($filter_kategori) || $filter_kategori != 0){
            $this->db->where('ppo.kategori_id',$filter_kategori);
        }
		
		$this->db->join('penerima ps','ppo.supplier_id = ps.id','left');
		$this->db->where("ppo.status in ('PUBLISH','CLOSED')");
		$this->db->group_by('ppo.supplier_id');
		$this->db->order_by('ps.nama','asc');
		$query = $this->db->get('pmm_receipt_material prm');
		
		$no = 1;
		if($query->num_rows() > 0){

			foreach ($query->result_array() as $key => $sups) {

				$mats = array();
				$materials = $this->pmm_model->GetLaporanHutang($sups['supplier_id'],$start_date,$end_date,$filter_kategori);
				if(!empty($materials)){
					foreach ($materials as $key => $row) {
						$arr['no'] = $key + 1;
						$arr['nama_produk'] = $row['nama_produk'];
						$arr['purchase_order_id'] = '<a href="'.base_url().'pmm/purchase_order/manage/'.$row['purchase_order_id'].'" target="_blank">'.$row['purchase_order_id'] = $this->crud_global->GetField('pmm_purchase_order',array('id'=>$row['purchase_order_id']),'no_po').'</a>';
						$arr['penerimaan'] = number_format($row['penerimaan'],0,',','.');
						$arr['tagihan'] = number_format($row['tagihan'],0,',','.');
						$arr['tagihan_bruto'] = number_format($row['tagihan_bruto'],0,',','.');
						$arr['pembayaran'] = number_format($row['pembayaran'],0,',','.');
						$arr['sisa_hutang_penerimaan'] = number_format($row['sisa_hutang_penerimaan'],0,',','.');
						$arr['sisa_hutang_tagihan'] = number_format($row['sisa_hutang_tagihan'],0,',','.');

						$total_penerimaan += $row['penerimaan'];
						$total_tagihan += $row['tagihan'];
						$total_tagihan_bruto += $row['tagihan_bruto'];
						$total_pembayaran += $row['pembayaran'];
						$total_sisa_hutang_penerimaan += $row['sisa_hutang_penerimaan'];
						$total_sisa_hutang_tagihan += $row['sisa_hutang_tagihan'];
						
						$arr['name'] = $sups['name'];
						
						$mats[] = $arr;
					}
					$sups['mats'] = $mats;
					$sups['no'] =$no;

					$data[] = $sups;
					$no++;
				}
				
				
			}
		}

		echo json_encode(array('data'=>$data,
		'total_penerimaan'=>number_format($total_penerimaan,0,',','.'),
		'total_tagihan'=>number_format($total_tagihan,0,',','.'),
		'total_tagihan_bruto'=>number_format($total_tagihan_bruto,0,',','.'),
		'total_pembayaran'=>number_format($total_pembayaran,0,',','.'),
		'total_sisa_hutang_penerimaan'=>number_format($total_sisa_hutang_penerimaan,0,',','.'),
		'total_sisa_hutang_tagihan'=>number_format($total_sisa_hutang_tagihan,0,',','.')
	));	
	}

	function monitoring_hutang_bahan_alat()
	{
		$data = array();
		$supplier_id = $this->input->post('supplier_id');
		$filter_kategori = $this->input->post('filter_kategori');
		$filter_status = $this->input->post('filter_status');
		$start_date = false;
		$end_date = false;
		$total_dpp_tagihan = 0;
		$total_ppn_tagihan = 0;
		$total_jumlah_tagihan = 0;
		$total_dpp_pembayaran = 0;
		$total_ppn_pembayaran = 0;
		$total_pph_pembayaran = 0;
		$total_jumlah_pembayaran = 0;
		$total_dpp_sisa_hutang = 0;
		$total_ppn_sisa_hutang = 0;
		$total_jumlah_sisa_hutang = 0;
		$date = $this->input->post('filter_date');
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));
		}

		$this->db->select('ppp.id, ppp.supplier_id, ps.nama as name');
		$this->db->join('penerima ps','ppp.supplier_id = ps.id','left');
		$this->db->join('pmm_purchase_order ppo','ppp.purchase_order_id = ppo.id','left');
		$this->db->join('pmm_verifikasi_penagihan_pembelian pvp','ppp.id = pvp.penagihan_pembelian_id','left');
		$this->db->where("ppo.kategori_id in (1,5)");

		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('pvp.tanggal_lolos_verifikasi >=',$start_date.' 23:59:59');
            $this->db->where('pvp.tanggal_lolos_verifikasi <=',$end_date.' 23:59:59');
        }
        if(!empty($supplier_id)){
            $this->db->where('ppp.supplier_id',$supplier_id);
        }
		if(!empty($filter_status)){
            $this->db->where('ppp.status',$filter_status);
        }
		
		$this->db->where("ppp.verifikasi_dok in ('SUDAH','LENGKAP')");
		$this->db->group_by('ppp.supplier_id');
		$this->db->order_by('ps.nama','asc');
		$query = $this->db->get('pmm_penagihan_pembelian ppp');
		
		$no = 1;
		if($query->num_rows() > 0){

			foreach ($query->result_array() as $key => $sups) {

				$mats = array();
				$materials = $this->pmm_model->GetLaporanMonitoringHutangBahanAlat($sups['supplier_id'],$start_date,$end_date,$filter_kategori,$filter_status);
				if(!empty($materials)){
					foreach ($materials as $key => $row) {
						$awal  = date_create($row['status_umur_hutang']);
						$akhir = date_create($end_date);
						$diff  = date_diff( $awal, $akhir );

						$tanggal_tempo = date('Y-m-d', strtotime(+$row['syarat_pembayaran'].'days', strtotime($row['tanggal_lolos_verifikasi'])));

						$awal_tempo =date_create($tanggal_tempo);
						$akhir_tempo =date_create($end_date);
						$diff_tempo =date_diff($awal_tempo,$akhir_tempo);

						$arr['no'] = $key + 1;
						$arr['nama'] = $row['nama'];
						$arr['subject'] = $row['subject'];
						$arr['kategori_id'] = $row['kategori_id'];
						$arr['status'] = $row['status'];
						$arr['syarat_pembayaran'] = $row['syarat_pembayaran'];
						//$arr['syarat_pembayaran'] = $diff->days . ' Hari';
						//$arr['syarat_pembayaran'] = $diff->days . ' ';
						//$arr['jatuh_tempo'] =  $diff_tempo->format("%R%a");
						$arr['jatuh_tempo'] =  date('d-m-Y',strtotime($tanggal_tempo));
						$arr['nomor_invoice'] = '<a href="'.base_url().'pembelian/penagihan_pembelian_detail/'.$row['id'].'" target="_blank">'.$row['nomor_invoice'].'</a>';
						$arr['tanggal_invoice'] =  date('d-m-Y',strtotime($row['tanggal_invoice']));
						$arr['tanggal_lolos_verifikasi'] =  date('d-m-Y',strtotime($row['tanggal_lolos_verifikasi']));
						$arr['dpp_tagihan'] = number_format($row['dpp_tagihan'],0,',','.');
						$arr['ppn_tagihan'] = number_format($row['ppn_tagihan'],0,',','.');
						$arr['jumlah_tagihan'] = number_format($row['jumlah_tagihan'],0,',','.');
						$arr['dpp_pembayaran'] = number_format($row['dpp_pembayaran'],0,',','.');
						$arr['ppn_pembayaran'] = number_format($row['ppn_pembayaran'],0,',','.');
						$arr['pph_pembayaran'] = number_format($row['pph_pembayaran'],0,',','.');
						$arr['jumlah_pembayaran'] = number_format($row['jumlah_pembayaran'],0,',','.');
						$arr['dpp_sisa_hutang'] = number_format($row['dpp_sisa_hutang'],0,',','.');
						$arr['ppn_sisa_hutang'] = number_format($row['ppn_sisa_hutang'],0,',','.');
						$arr['jumlah_sisa_hutang'] = number_format($row['jumlah_sisa_hutang'],0,',','.');

						$total_dpp_tagihan += $row['dpp_tagihan'];
						$total_ppn_tagihan += $row['ppn_tagihan'];
						$total_jumlah_tagihan += $row['jumlah_tagihan'];
						$total_dpp_pembayaran += $row['dpp_pembayaran'];
						$total_ppn_pembayaran += $row['ppn_pembayaran'];
						$total_pph_pembayaran += $row['pph_pembayaran'];
						$total_jumlah_pembayaran += $row['jumlah_pembayaran'];
						$total_dpp_sisa_hutang += $row['dpp_sisa_hutang'];
						$total_ppn_sisa_hutang += $row['ppn_sisa_hutang'];
						$total_jumlah_sisa_hutang += $row['jumlah_sisa_hutang'];
						
						$arr['name'] = $sups['name'];
						
						$mats[] = $arr;
					}
					$sups['mats'] = $mats;
					$sups['no'] =$no;

					$data[] = $sups;
					$no++;
				}
				
				
			}
		}

		echo json_encode(array('data'=>$data,
		'total_dpp_tagihan'=>number_format($total_dpp_tagihan,0,',','.'),
		'total_ppn_tagihan'=>number_format($total_ppn_tagihan,0,',','.'),
		'total_jumlah_tagihan'=>number_format($total_jumlah_tagihan,0,',','.'),
		'total_dpp_pembayaran'=>number_format($total_dpp_pembayaran,0,',','.'),
		'total_ppn_pembayaran'=>number_format($total_ppn_pembayaran,0,',','.'),
		'total_pph_pembayaran'=>number_format($total_pph_pembayaran,0,',','.'),
		'total_jumlah_pembayaran'=>number_format($total_jumlah_pembayaran,0,',','.'),
		'total_dpp_sisa_hutang'=>number_format($total_dpp_sisa_hutang,0,',','.'),
		'total_ppn_sisa_hutang'=>number_format($total_ppn_sisa_hutang,0,',','.'),
		'total_jumlah_sisa_hutang'=>number_format($total_jumlah_sisa_hutang,0,',','.')
	));	
	}

	function monitoring_hutang()
	{
		$data = array();
		$supplier_id = $this->input->post('supplier_id');
		$filter_kategori = $this->input->post('filter_kategori');
		$filter_status = $this->input->post('filter_status');
		$start_date = false;
		$end_date = false;
		$total_dpp_tagihan = 0;
		$total_ppn_tagihan = 0;
		$total_jumlah_tagihan = 0;
		$total_dpp_pembayaran = 0;
		$total_ppn_pembayaran = 0;
		$total_pph_pembayaran = 0;
		$total_jumlah_pembayaran = 0;
		$total_dpp_sisa_hutang = 0;
		$total_ppn_sisa_hutang = 0;
		$total_jumlah_sisa_hutang = 0;
		$date = $this->input->post('filter_date');
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));
		}

		$this->db->select('ppp.id, ppp.supplier_id, ps.nama as name');
		$this->db->join('penerima ps','ppp.supplier_id = ps.id','left');
		$this->db->join('pmm_purchase_order ppo','ppp.purchase_order_id = ppo.id','left');
		$this->db->join('pmm_verifikasi_penagihan_pembelian pvp','ppp.id = pvp.penagihan_pembelian_id','left');

		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('pvp.tanggal_lolos_verifikasi >=',$start_date.' 23:59:59');
            $this->db->where('pvp.tanggal_lolos_verifikasi <=',$end_date.' 23:59:59');
        }
        if(!empty($supplier_id)){
            $this->db->where('ppp.supplier_id',$supplier_id);
        }
		if(!empty($filter_status)){
            $this->db->where('ppp.status',$filter_status);
        }
		
		$this->db->where("ppp.verifikasi_dok in ('SUDAH','LENGKAP')");
		$this->db->group_by('ppp.supplier_id');
		$this->db->order_by('ps.nama','asc');
		$query = $this->db->get('pmm_penagihan_pembelian ppp');
		
		$no = 1;
		if($query->num_rows() > 0){

			foreach ($query->result_array() as $key => $sups) {

				$mats = array();
				$materials = $this->pmm_model->GetLaporanMonitoringHutang($sups['supplier_id'],$start_date,$end_date,$filter_kategori,$filter_status);
				if(!empty($materials)){
					foreach ($materials as $key => $row) {
						$awal  = date_create($row['status_umur_hutang']);
						$akhir = date_create($end_date);
						$diff  = date_diff( $awal, $akhir );

						$tanggal_tempo = date('Y-m-d', strtotime(+$row['syarat_pembayaran'].'days', strtotime($row['tanggal_lolos_verifikasi'])));

						$awal_tempo =date_create($tanggal_tempo);
						$akhir_tempo =date_create($end_date);
						$diff_tempo =date_diff($awal_tempo,$akhir_tempo);

						$arr['no'] = $key + 1;
						$arr['nama'] = $row['nama'];
						$arr['subject'] = $row['subject'];
						$arr['status'] = $row['status'];
						$arr['syarat_pembayaran'] = $row['syarat_pembayaran'];
						//$arr['syarat_pembayaran'] = $diff->days . ' Hari';
						//$arr['syarat_pembayaran'] = $diff->days . ' ';
						//$arr['jatuh_tempo'] =  $diff_tempo->format("%R%a");
						$arr['jatuh_tempo'] =  date('d-m-Y',strtotime($tanggal_tempo));
						$arr['nomor_invoice'] = '<a href="'.base_url().'pembelian/penagihan_pembelian_detail/'.$row['id'].'" target="_blank">'.$row['nomor_invoice'].'</a>';
						$arr['tanggal_invoice'] =  date('d-m-Y',strtotime($row['tanggal_invoice']));
						$arr['tanggal_lolos_verifikasi'] =  date('d-m-Y',strtotime($row['tanggal_lolos_verifikasi']));
						$arr['dpp_tagihan'] = number_format($row['dpp_tagihan'],0,',','.');
						$arr['ppn_tagihan'] = number_format($row['ppn_tagihan'],0,',','.');
						$arr['jumlah_tagihan'] = number_format($row['jumlah_tagihan'],0,',','.');
						$arr['dpp_pembayaran'] = number_format($row['dpp_pembayaran'],0,',','.');
						$arr['ppn_pembayaran'] = number_format($row['ppn_pembayaran'],0,',','.');
						$arr['pph_pembayaran'] = number_format($row['pph_pembayaran'],0,',','.');
						$arr['jumlah_pembayaran'] = number_format($row['jumlah_pembayaran'],0,',','.');
						$arr['dpp_sisa_hutang'] = number_format($row['dpp_sisa_hutang'],0,',','.');
						$arr['ppn_sisa_hutang'] = number_format($row['ppn_sisa_hutang'],0,',','.');
						$arr['jumlah_sisa_hutang'] = number_format($row['jumlah_sisa_hutang'],0,',','.');

						$total_dpp_tagihan += $row['dpp_tagihan'];
						$total_ppn_tagihan += $row['ppn_tagihan'];
						$total_jumlah_tagihan += $row['jumlah_tagihan'];
						$total_dpp_pembayaran += $row['dpp_pembayaran'];
						$total_ppn_pembayaran += $row['ppn_pembayaran'];
						$total_pph_pembayaran += $row['pph_pembayaran'];
						$total_jumlah_pembayaran += $row['jumlah_pembayaran'];
						$total_dpp_sisa_hutang += $row['dpp_sisa_hutang'];
						$total_ppn_sisa_hutang += $row['ppn_sisa_hutang'];
						$total_jumlah_sisa_hutang += $row['jumlah_sisa_hutang'];
						
						$arr['name'] = $sups['name'];
						
						$mats[] = $arr;
					}
					$sups['mats'] = $mats;
					$sups['no'] =$no;

					$data[] = $sups;
					$no++;
				}
				
				
			}
		}

		echo json_encode(array('data'=>$data,
		'total_dpp_tagihan'=>number_format($total_dpp_tagihan,0,',','.'),
		'total_ppn_tagihan'=>number_format($total_ppn_tagihan,0,',','.'),
		'total_jumlah_tagihan'=>number_format($total_jumlah_tagihan,0,',','.'),
		'total_dpp_pembayaran'=>number_format($total_dpp_pembayaran,0,',','.'),
		'total_ppn_pembayaran'=>number_format($total_ppn_pembayaran,0,',','.'),
		'total_pph_pembayaran'=>number_format($total_pph_pembayaran,0,',','.'),
		'total_jumlah_pembayaran'=>number_format($total_jumlah_pembayaran,0,',','.'),
		'total_dpp_sisa_hutang'=>number_format($total_dpp_sisa_hutang,0,',','.'),
		'total_ppn_sisa_hutang'=>number_format($total_ppn_sisa_hutang,0,',','.'),
		'total_jumlah_sisa_hutang'=>number_format($total_jumlah_sisa_hutang,0,',','.')
	));	
	}

	public function cetak_surat_jalan()
	{
		$this->load->library('pdf');

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->SetFont('helvetica','',1); 
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
		$pdf->setHtmlVSpace($tagvs);

		// add a page
		$pdf->AddPage('P');
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetY(5);
		$pdf->SetX(5);
		$pdf->SetMargins(10, 10);        

		$w_date = $this->input->get('filter_date');
		$purchase_order_id = $this->input->get('purchase_order_id');
		$supplier_id = $this->input->get('supplier_id');
		$material_id = $this->input->get('material_id');
		$this->db->select('prm.*,ppo.no_po, (prm.price  * prm.volume) as biaya, ppo.supplier_id');

		if(!empty($supplier_id || $supplier_id != 0)){
			$this->db->where('ppo.supplier_id',$supplier_id);
		}
		if(!empty($purchase_order_id || $purchase_order_id != 0)){
			$this->db->where('prm.purchase_order_id',$purchase_order_id);
		}
		if(!empty($material_id) || $material_id != 0){
			$this->db->where('prm.material_id',$material_id);
		}
		
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('prm.date_receipt  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('prm.date_receipt <=',date('Y-m-d',strtotime($end_date)));	
		}
		$this->db->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left');
		$this->db->group_by('prm.id');
		$this->db->order_by('prm.date_receipt','asc');
		$this->db->order_by('prm.material_id','asc');
		$query = $this->db->get('pmm_receipt_material prm');

		$supplier_name = '';
		if(!empty($supplier_id)){
			$supplier_name = $this->crud_global->GetField('pmm_supplier',array('id'=>$supplier_id),'name');
		}
		$data['supplier_name'] = $supplier_name;
		$data['data'] = $query->result_array();
        $html = $this->load->view('pmm/receipt_material_print',$data,TRUE);

        
        $pdf->SetTitle($this->input->get('filter_date'));
        $pdf->SetTitle('Rekap Penerimaan');
        $pdf->nsi_html($html);
        $pdf->Output('rekap_surat_jalan_penerimaan.pdf', 'I');
	
	}

	function table_daftar_pembayaran()
	{
		$data = array();
		$supplier_id = $this->input->post('supplier_name');
		$purchase_order_no = $this->input->post('purchase_order_no');
		$filter_material = $this->input->post('filter_material');
		$start_date = false;
		$end_date = false;
		$total = 0;
		$date = $this->input->post('filter_date');
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));
		}
		
		$this->db->select('pmp.supplier_name, SUM(pmp.total) as total_bayar');
		
		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('pmp.tanggal_pembayaran >=',$start_date);
            $this->db->where('pmp.tanggal_pembayaran <=',$end_date);
        }
        if(!empty($supplier_id)){
            $this->db->where('ppp.supplier_id',$supplier_id);
        }
        if(!empty($filter_material)){
            $this->db->where_in('ppd.material_id',$filter_material);
        }
        if(!empty($purchase_order_no)){
            $this->db->where('pmp.penagihan_pembelian_id',$purchase_order_no);
        }
		
		$this->db->join('pmm_penagihan_pembelian ppp', 'pmp.penagihan_pembelian_id = ppp.id','left');
		$this->db->join('penerima p', 'ppp.supplier_id = p.id','left');
		$this->db->join('pmm_purchase_order ppo','ppp.purchase_order_id = ppo.id','left');
		$this->db->where("ppo.status in ('PUBLISH','CLOSED')");
		$this->db->group_by('ppp.supplier_id');
		$this->db->order_by('p.nama','asc');
		$query = $this->db->get('pmm_pembayaran_penagihan_pembelian pmp');
		
		$no = 1;
		if($query->num_rows() > 0){

			foreach ($query->result_array() as $key => $sups) {

				$mats = array();
				$materials = $this->pmm_model->GetDaftarPembayaran($sups['supplier_name'],$purchase_order_no,$start_date,$end_date,$filter_material);
				
				if(!empty($materials)){
					foreach ($materials as $key => $row) {
						$arr['no'] = $key + 1;
						$arr['tanggal_pembayaran'] = date('d-m-Y',strtotime($row['tanggal_pembayaran']));
						$arr['nomor_transaksi'] = '<a href="'.base_url().'pembelian/penagihan_pembelian_detail/'.$row['penagihan_id'].'" target="_blank">'.$row['nomor_transaksi'].'</a>';
						$arr['tanggal_invoice'] = date('d-m-Y',strtotime($row['tanggal_invoice']));
						$arr['nomor_invoice'] = $row['nomor_invoice'];
						$arr['pembayaran'] = number_format($row['pembayaran'],0,',','.');								
						
						$arr['supplier_name'] = $sups['supplier_name'];
						$mats[] = $arr;
					}
					
					
					$sups['mats'] = $mats;
					$total += $sups['total_bayar'];
					$sups['no'] =$no;
					$sups['total_bayar'] = number_format($sups['total_bayar'],0,',','.');
					

					$data[] = $sups;
					$no++;
					
				}		
				
			}
		}

		echo json_encode(array('data'=>$data,'total'=>number_format($total,0,',','.')));	
	}
	
}