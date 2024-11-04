<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productions extends Secure_Controller {

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

	public function add()
	{	
		$check = $this->m_admin->check_login();
		if($check == true){
			$po_id =  $this->input->get('po_id');
			$data['po_id'] = $po_id;
			$client_id = $this->input->get('client_id');
			$data['client_id'] = $client_id;
			$data['clients'] = $this->db->select('id,nama')->order_by('nama','asc')->get_where('penerima',array('pelanggan'=>1))->result_array();
			$data['komposisi'] = $this->db->select('ag.id, ag.jobs_type, p.nama_produk')
			->from('pmm_agregat ag')
			->join('produk p', 'ag.mutu_beton = p.id','left')
			->where("ag.status = 'PUBLISH'")
			->order_by('p.nama_produk','asc')
			->get()->result_array();
			
			$get_data = $this->db->get_where('pmm_sales_po',array('id'=>$po_id,'status'=>'OPEN'))->row_array();
			$data['contract_number'] = $this->db->get_where('pmm_sales_po',array('client_id'=>$get_data['client_id'],'status'=>'OPEN'))->result_array();
			$data['data'] = $get_data;
			$this->load->view('pmm/productions_add',$data);
			
		}else {
			redirect('admin');
		}
	}

	public function table()
	{	
		$data = array();
		$client_id = $this->input->post('client_id');
		$product_id = $this->input->post('product_id');
		$sales_po_id = $this->input->post('salesPo_id');
		$w_date = $this->input->post('filter_date');

		$kunci_rakor = $this->db->select('date')->order_by('date','desc')->limit(1)->get_where('kunci_rakor')->row_array();
        $last_opname = date('d-m-Y', strtotime('+1 days', strtotime($kunci_rakor['date'])));

		$this->db->select('*');
		if (!empty($client_id)) {
			$this->db->where('client_id', $client_id);
		}
		if(!empty($product_id)){
			$this->db->where('product_id',$product_id);
		}
		if(!empty($sales_po_id)){
			$this->db->where('salesPo_id',$sales_po_id);
		}
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('date_production  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('date_production <=',date('Y-m-d',strtotime($end_date)));	
		}
		
		//$this->db->where("(date_production between '$awal_bulan' and '$akhir_bulan')");
		$this->db->where("date_production >= '$last_opname'");
		$this->db->where('status_payment','UNCREATED');
		$this->db->order_by('date_production','desc');
		$this->db->order_by('created_on','desc');
		$query = $this->db->get('pmm_productions');
		
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
				$row['no'] = $key+1;
				$row['status'] = $this->pmm_model->GetStatus($row['status']);
				$row['salesPo_id'] = $this->crud_global->GetField('pmm_sales_po',array('id'=>$row['salesPo_id']),'contract_number');
				$row['product_id'] = $this->crud_global->GetField('produk',array('id'=>$row['product_id']),'nama_produk');
				$row['client_id'] = $this->crud_global->GetField('penerima',array('id'=>$row['client_id']),'nama');
				$row['date_production'] =  date('d F Y',strtotime($row['date_production']));
				$row['volume'] = number_format($row['volume'],2,',','.');
				$row['measure'] = $row['measure'];
				$row['harga_satuan'] = number_format($row['harga_satuan'],0,',','.');
				$row['price'] = number_format($row['price'],0,',','.');
				$row['komposisi_id'] = $this->crud_global->GetField('pmm_agregat',array('id'=>$row['komposisi_id']),'jobs_type');
				$row['surat_jalan'] = '<a href="'.base_url().'uploads/surat_jalan_penjualan/'.$row['surat_jalan'].'" target="_blank">'.$row['surat_jalan'].'</a>';
				$row['edits'] = '<a href="'.site_url().'pmm/productions/sunting_komposisi/'.$row['id'].'" class="btn btn-warning" style="font-weight:bold; border-radius:10px;"><i class="fa fa-edit"></i> </a>';
				$edit = false;
				$edit = '<a href="javascript:void(0);" onclick="EditData('.$row['id'].')" class="btn btn-warning" style="font-weight:bold; border-radius:10px;"><i class="fa fa-edit"></i> </a>';	
				$edit_new = false;
				$edit_new = '<a href="javascript:void(0);" onclick="EditDataNew('.$row['id'].')" class="btn btn-primary" style="font-weight:bold; border-radius:10px;"><i class="fa fa-edit"></i> </a>';
				if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
					$row['delete'] = $edit_new.' <a href="javascript:void(0);" onclick="DeleteData('.$row['id'].')" class="btn btn-danger" style="font-weight:bold; border-radius:10px;"><i class="fa fa-close"></i> </a>';
					//$row['delete'] = '<a href="javascript:void(0);" onclick="DeleteData('.$row['id'].')" class="btn btn-danger" style="font-weight:bold; border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['delete'] = '-';
				}
				
				$data[] = $row;
			}

		}
		echo json_encode(array('data'=>$data));
	}

	public function edit_data_detail_new()
	{
		$id = $this->input->post('id');
		$this->db->select('pp.*');
		$data = $this->db->get_where('pmm_productions pp',array('pp.id'=>$id))->row_array();
		$data['date_production'] = date('d-m-Y',strtotime($data['date_production']));
		echo json_encode(array('data'=>$data));		
	}

	public function edit_process()
	{
		$output['output'] = false;

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

		$id = $this->input->post('id_edit');
		$date_production = $this->input->post('edit_date');
		$memo = $this->input->post('edit_memo');

		$data_p = array(
			'id' => $id,
			'date_production' => date('Y-m-d',strtotime($date_production)),
			'memo' => $memo,
		);

		$data_p['updated_on'] = date('Y-m-d H:i:s');
		$data_p['updated_by'] = $this->session->userdata('admin_id');
		
		$this->db->update('pmm_productions',$data_p,array('id'=>$id));
		

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

	public function sunting_komposisi($id)
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {

			$this->db->select('pp.*');
            $data['row'] = $this->db->get_where('pmm_productions pp', array('pp.id' => $id))->row_array();
			$data['komposisi'] = $this->db->select('id, jobs_type,date_agregat')->order_by('date_agregat','desc')->get_where('pmm_agregat',array('status'=>'PUBLISH'))->result_array();
			$this->load->view('penjualan/edit_komposisi', $data);
		} else {
			redirect('admin');
		}
	}

	public function total_pro()
	{	
		$data = array();
		$client_id = $this->input->post('client_id');
		$product_id = $this->input->post('product_id');
		$w_date = $this->input->post('filter_date');

		$this->db->select('SUM(volume) as total');
		$this->db->where('status !=','DELETED');
		if(!empty($client_id)){
			$this->db->where('client_id',$client_id);
		}
		if(!empty($product_id)){
			$this->db->where('product_id',$product_id);
		}
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('date_production  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('date_production <=',date('Y-m-d',strtotime($end_date)));	
		}
		$this->db->order_by('date_production','desc');
		$query = $this->db->get('pmm_productions');
		if($query->num_rows() > 0){
			$row = $query->row_array();
			$data =  number_format($row['total'],2,',','.');
		}
		echo json_encode(array('data'=>$data));
	}


	function process()
	{
		$output['output'] = false;

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 
		$production_id = 0;
		$id = $this->input->post('id');
		$sales_po_id = $this->input->post('po_penjualan');
		$komposisi_id = $this->input->post('komposisi_id');
		$product_id = $this->input->post('product_id');
		$volume = str_replace(',', '.', $this->input->post('volume'));
		$price = $this->pmm_model->GetPriceProductions($sales_po_id,$product_id,$volume);
		$no_production = $this->input->post('no_production');
		
		$surat_jalan = $this->input->post('surat_jalan_val');

		$config['upload_path']          = 'uploads/surat_jalan_penjualan/';
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG|pdf';
	   
		$production = $this->db->get_where("pmm_productions",["no_production" => $no_production])->num_rows();

		$this->load->library('upload', $config);
		

		if ($production > 0) {
			$output['output'] = false;
			$output['err'] = 'No. Surat Jalan Telah Terdaftar !!';
		}else{
			if(isset($_FILES["data_lab"])){
				if($_FILES["data_lab"]["error"] == 0) {
					$config['file_name'] = $no_production.'_'.$_FILES["data_lab"]['name'];
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('data_lab'))
					{
							$error = $this->upload->display_errors();
							$file = $error;
							$error_file = true;
					}else{
							$data_file = $this->upload->data();
							$file = $data_file['file_name'];
					}
				}
			}
			
			if($_FILES["surat_jalan"]["error"] == 0) {
				$config['file_name'] = $no_production.'_'.$_FILES["surat_jalan"]['name'];
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('surat_jalan'))
				{
						$error = $this->upload->display_errors();
						$file = $error;
						$error_file = true;
				}else{
						$data_file = $this->upload->data();
						$surat_jalan = $data_file['file_name'];
				}
			}

			$get_po = $this->db->select('measure,price,qty')->get_where('pmm_sales_po_detail',array('sales_po_id'=>$sales_po_id,'product_id'=>$product_id))->row_array();
			$productions = $this->db->select('SUM(volume) as volume')->get_where('pmm_productions',array('salesPo_id'=>$sales_po_id,'product_id'=>$product_id))->row_array();

			if($productions['volume'] + $volume > $get_po['qty']){
				$output['output'] = false;
				$output['err'] = '<b>Mohon maaf sudah melebihi volume sales order, Silahkan buat sales order baru.</b>';
				//$output['err'] = $this->session->set_flashdata('notif_error', '<b>Mohon maaf sudah melebihi volume sales order, Silahkan buat sales order baru.</b>');
				echo json_encode($output);
				exit();
			} 
	
			$data = array(
				'date_production' => date('Y-m-d',strtotime($this->input->post('date'))),
				'no_production' => $no_production,
				'product_id' => $product_id,
				'tax_id' => $this->input->post('tax_id'),
				'client_id' => $this->input->post('client_id'),
				'no_production' => $this->input->post('no_production'),
				'volume' => $volume,
				'convert_value' => 1,
				'display_volume' => $volume,
				'measure' => $this->input->post('measure'),
				'convert_measure' => $this->input->post('measure'),
				'komposisi_id' => $this->input->post('komposisi_id'),
				'nopol_truck' => $this->input->post('nopol_truck'),
				'driver' => $this->input->post('driver'),
				'lokasi' => $this->input->post('lokasi'),
				'price' => $price,
				'salesPo_id' => $this->input->post('po_penjualan'),
				'status' => 'PUBLISH',
				'status_payment' => 'UNCREATED',
				'surat_jalan' => $surat_jalan,
				'memo' => $this->input->post('memo'),
				'harga_satuan' => $price /  $volume,
				'display_price' => $price,
				'display_harga_satuan' => $price /  $volume,
			);
	
	
			if(empty($id)){
				$data['created_by'] = $this->session->userdata('admin_id');
				$data['created_on'] = date('Y-m-d H:i:s');
				if($this->db->insert('pmm_productions',$data)){
					$production_id = $this->db->insert_id();
					
					//Insert COA
					//$coa_description = 'Production Nomor '.$no_production;
					//$this->pmm_finance->InsertTransactions(4,$coa_description,$price,0);
				}
			}else {
				$data['updated_by'] = $this->session->userdata('admin_id');
				$data['updated_on'] = date('Y-m-d H:i:s');
				$this->db->update('pmm_productions',$data,array('id'=>$id));
	
				$check_pro = $this->db->get_where('pmm_productions',array('id'=>$id,'product_id'=>$product_id))->num_rows();
				if($check_pro == 0){
				}
				
			}
	
			if ($this->db->trans_status() === FALSE) {
				# Something went wrong.
				$this->db->trans_rollback();
				$output['output'] = false;
			} 
			else {
				# Everything is Perfect. 
				# Committing data to the database.
				$this->db->trans_commit();
				$output['id'] = $production_id;
				$output['output'] = true;	
				// $output['no_production'] = $this->pmm_model->ProductionsNo();
			}
		}
		echo json_encode($output);
	}

	public function approve_po()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){
			$data = array(
				'date_po' => date('Y-m-d',strtotime($this->input->post('date_po'))),
				'subject' => $this->input->post('subject'),
				'date_pkp' => date('Y-m-d',strtotime($this->input->post('date_pkp'))),
				'supplier_id' => $this->input->post('supplier_id'),
				'total' => $this->input->post('total'),
				'approved_by' => $this->session->userdata('admin_id'),
				'approved_on' => date('Y-m-d H:i:s'),
				'status' => 'PUBLISH'
			);
			if($this->db->update('pmm_productions',$data,array('id'=>$id))){
				$output['output'] = true;
				$output['url'] = site_url('admin/productions');
			}
		}
		echo json_encode($output);
	}

	public function get_composition()
	{
		$output['output'] = true;
		$product_id = $this->input->post('product_id');
		if(!empty($product_id)){
			$query = $this->db->select('id, product_id,composition_name as text')->get_where('pmm_composition',array('product_id'=>$product_id,'status'=>'PUBLISH'))->result_array();
			if(!empty($query)){
				$data = array();
				$data[0] = array('id'=>'','text'=>'Pilih Composition');
				foreach ($query as $key => $row) {

					$data[] = array('id'=>$row['id'],'text'=>$row['text']);
				}
				$output['output'] = true;
				$output['data'] = $data;
			}
		}
		echo json_encode($output);
	}

	public function get_po_products()
	{
		$output['output'] = true;
		$id = $this->input->post('id');
		if(!empty($id)){
			$client_id = $this->crud_global->GetField('pmm_sales_po',array('id'=>$id),'client_id');
			$query = $this->db->select('product_id')->get_where('pmm_sales_po_detail',array('sales_po_id'=>$id))->result_array();
			if(!empty($query)){
				$data = array();
				$data[0] = array('id'=>'','text'=>'Pilih Produk');
				foreach ($query as $key => $row) {
					$product_name = $this->crud_global->GetField('produk',array('id'=>$row['product_id']),'nama_produk');
					$data[] = array('id'=>$row['product_id'],'text'=>$product_name);
				}
				$output['products'] = $data;
			}
			$client = array();
			$client_name = $this->crud_global->GetField('penerima',array('id'=>$client_id),'nama');
			$client[0] = array('id'=>$client_id,'text'=>$client_name);
			$output['client'] = $client;
			$output['output'] = true;
		}
		echo json_encode($output);
	}

	public function get_po_penjualan(){

		$response = [
			'output' => true,
			'po' => null
		];

		try {

			$id = $this->input->post('id');

			$this->db->select('psp.id, psp.contract_number, psp.client_id');
			$this->db->from('pmm_sales_po psp');
			$this->db->where('psp.client_id = ' . intval($id));
			$this->db->where('psp.status','OPEN');
			$this->db->group_by('psp.id');
			$query = $this->db->get()->result_array();

			$data = [];
			//$data[0] = ['id'=>'','text'=>'Pilih No. Sales Order'];

			if (!empty($query)){
				foreach ($query as $row){
					$data[] = ['id' => $row['id'], 'text' => $row['contract_number']];
				}
			}

			$response['po'] = $data;

		} catch (Throwable $e){
			$response['output'] = false;
		} finally {
			echo json_encode($response);
		}
			
	}

	public function get_materials(){

		$response = [
			'output' => true,
			'po' => null
		];

		try {

			$id = $this->input->post('id');

			$this->db->select('p.id, p.nama_produk, pspd.measure, pspd.tax_id');
			$this->db->from('produk p ');
			$this->db->join('pmm_sales_po_detail pspd','p.id = pspd.product_id','left');
			$this->db->join('pmm_sales_po psp ','pspd.sales_po_id = psp.id','left');
			$this->db->where("psp.id = " . intval($id));
			$query = $this->db->get()->result_array();

			$data = [];
			//$data[0] = ['id'=>'','text'=>'Pilih Produk'];

			if (!empty($query)){
				foreach ($query as $row){
					$data[] = ['id' => $row['id'], 'text' => $row['nama_produk']];
					$tax_id[] = ['id' => $row['id'], 'text' => $row['tax_id']];
					$measure[] = ['id' => $row['id'], 'text' => $row['measure']];
				}
			}

			$response['products'] = $data;
			$response['measure'] = $measure;
			$response['tax_id'] = $tax_id;

		} catch (Throwable $e){
			$response['output'] = false;
		} finally {
			echo json_encode($response);
		}
			
	}

	public function get_pdf()
	{
		$this->load->library('pdf');
	

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        // $pdf->set_header_title('Laporan'
		// $pdf->set_nsi_header(FALSE);
        $pdf->setPrintHeader(false);
        $pdf->SetTopMargin(0);
        $pdf->SetFont('helvetica','',7); 
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
		$pdf->setHtmlVSpace($tagvs);
        $pdf->AddPage('P');

        $id = $this->uri->segment(4);

		$row = $this->db->get_where('pmm_productions',array('id'=>$id))->row_array();
		$row['product'] = $this->crud_global->GetField('pmm_product',array('id'=>$row['product_id']),'product');
		$row['client'] = $this->crud_global->GetField('pmm_client',array('id'=>$row['client_id']),'client_name');
		$data['row'] = $row;
		$data['id'] = $id;
        $html = $this->load->view('pmm/productions_pdf',$data,TRUE);

        
        $pdf->SetTitle($row['no_production']);
        $pdf->nsi_html($html);
        $pdf->Output($row['no_production'].'.pdf', 'I');
	
	}

	public function delete()
	{
		$output['output'] = false;
		$id = $this->input->post('id');

		$file = $this->db->select('pp.surat_jalan')
		->from('pmm_productions pp')
		->where("pp.id = $id")
		->get()->row_array();

		$path = './uploads/surat_jalan_penjualan/'.$file['surat_jalan'];
		chmod($path, 0777);
		unlink($path);
		
		$this->db->delete('pmm_productions',array('id'=>$id));
		$output['output'] = true;
			
		
		echo json_encode($output);
	}

	public function table_dashboard()
	{
		$data = $this->pmm_model->DashboardProductions();

		echo json_encode(array('data'=>$data));
	}

	
	public function table_dashboard_mu()
	{
		$data = array();
		$arr_date = explode(' - ', $this->input->post('date'));
		$material = $this->input->post('material');

		$this->db->select('pm.material_name,pms.measure_name,pm.id');
		$this->db->join('pmm_measures pms','pm.measure = pms.id','left');
		if(!empty($material)){
			$this->db->where('pm.id',$material);
		}	
		$this->db->group_by('pm.id');
		$query = $this->db->get('pmm_materials pm');
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {

				$this->db->select('SUM(pp.volume) as volume,ppm.koef');
				$this->db->join('pmm_productions pp','ppm.production_id = pp.id');
				if(!empty($arr_date)){
					$this->db->where('pp.date_production >=',date('Y-m-d',strtotime($arr_date[0])));
					$this->db->where('pp.date_production <=',date('Y-m-d',strtotime($arr_date[1])));
				}
				$this->db->where('pp.status','PUBLISH');
				$this->db->where('ppm.material_id',$row['id']);
				$get_volume = $this->db->get('pmm_production_material ppm')->row_array();

				$row['no'] = $key+1;
				$row['material_name'] = $row['material_name'].' <b>('.$row['measure_name'].')</b>';
				$total = $get_volume['volume'] * $get_volume['koef'];
				
				$total_pakai = $this->pmm_model->GetTotalSisa($row['id'],$arr_date[0]);
				$row['total'] = number_format($total_pakai - $total,2,',','.');
		  //       $pemakaian = $total_pakai * $row['koef'];
		        // $row['total'] = $pemakaian;
				$data[] = $row;
			}
		}

		echo json_encode(array('data'=>$data,'a'=>$arr_date));
	}


	function table_date()
	{
		$data = array();
		$client_id = $this->input->post('client_id');
		$filter_product = $this->input->post('filter_product');
		$start_date = false;
		$end_date = false;
		$date = $this->input->post('filter_date');
		$date_text = '';
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));

			$date_text = date('d F Y',strtotime($start_date)).' - '.date('d F Y',strtotime($end_date));
		}

		$arr_filter_prods = array();
		if(!empty($filter_product)){
			$query_mats = $this->db->select('id')->get_where('pmm_product',array('status'=>'PUBLISH','tag_id'=>$filter_product))->result_array();
			foreach ($query_mats as $key => $row) {
				$arr_filter_prods[] = $row['id'];
			}
		}

		// $products = $this->db->select('id,product')->get_where('pmm_product',array('status'=>'PUBLISH'))->result_array();
		$total_real = 0;
		$total_cost = 0;
		$no =1;


		$this->db->select('pc.client_name,pp.client_id, SUM(volume) as total, SUM(price) as cost');
		$this->db->join('pmm_client pc','pp.client_id = pc.id','left');
		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('pp.date_production >=',$start_date);
            $this->db->where('pp.date_production <=',$end_date);
        }
        if(!empty($client_id)){
        	$this->db->where('pp.client_id',$client_id);
        }
        if(!empty($arr_filter_prods)){
        	$this->db->where_in('pp.product_id',$arr_filter_prods);
        }
		$this->db->where('pc.status','PUBLISH');
		$this->db->where('pp.status','PUBLISH');
		$this->db->group_by('pp.client_id');
		$clients = $this->db->get('pmm_productions pp')->result_array();
		if(!empty($clients)){
			foreach ($clients as $key => $row) {

				$this->db->select('SUM(pp.volume) as total, SUM(pp.price) as cost, pc.product');
		        $this->db->join('pmm_product pc','pp.product_id = pc.id','left');
		        if(!empty($start_date) && !empty($end_date)){
		            $this->db->where('pp.date_production >=',$start_date);
		            $this->db->where('pp.date_production <=',$end_date);
		        }
		        if(!empty($client_id)){
		            $this->db->where('pp.client_id',$client_id);
		        }
		        if(!empty($arr_filter_prods)){
		        	$this->db->where_in('pp.product_id',$arr_filter_prods);
		        }
		        $this->db->where('pp.client_id',$row['client_id']);
		        $this->db->where('pp.status','PUBLISH');
		        $this->db->where('pc.status','PUBLISH');
		        $this->db->group_by('pp.product_id');
		        $arr_products = $this->db->get_where('pmm_productions pp')->result_array();


				$arr['no'] = $no;
				$arr['products'] = $arr_products;
				$arr['total'] = $row['total'];
				$arr['cost'] = $row['cost'];
				$arr['client'] = $row['client_name'];
				$total_real += $row['total'];
				$total_cost += $row['cost'];
				$data[] = $arr;
				$no++;
			}
		}

		// foreach ($products as $key => $row) {
		// 	$get_real = $this->pmm_model->GetRealProd($row['id'],$start_date,$end_date,$client_id);
		// 	if($get_real['total'] > 0){
		// 		$arr_clients = $this->pmm_model->GetRealProdByClient($row['id'],$start_date,$end_date,$client_id);
		// 		
		// 	}
			
		// }

		echo json_encode(array('data'=>$data,'date_text'=> $date_text,'total_real'=>$total_real,'total_cost'=>$total_cost));	
	}

	function table_date2()
	{
		$data = array();
		$client_id = $this->input->post('client_id');
		$filter_product = $this->input->post('filter_product');
		$start_date = false;
		$end_date = false;
		$date = $this->input->post('filter_date');
		$date_text = '';
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));

			$date_text = date('d F Y',strtotime($start_date)).' - '.date('d F Y',strtotime($end_date));
		}
		
		$total_real = 0;
		$total_cost = 0;
		$no =1;


		$this->db->select('pc.nama,pp.client_id, SUM(volume) as total, SUM(price) as cost');
		$this->db->join('penerima pc','pp.client_id = pc.id and pc.pelanggan = 1','left');
		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('pp.date_production >=',$start_date);
            $this->db->where('pp.date_production <=',$end_date);
        }
        if(!empty($client_id)){
        	$this->db->where('pp.client_id',$client_id);
        }
        if(!empty($filter_product)){
        	$this->db->where_in('pp.product_id',$filter_product);
        }
		$this->db->where('pc.status','PUBLISH');
		$this->db->where('pp.status','PUBLISH');
		$this->db->group_by('pp.client_id');
		$clients = $this->db->get('pmm_productions pp')->result_array();	
		
		if(!empty($clients)){
			foreach ($clients as $key => $row) {

				$this->db->select('SUM(pp.volume) as total, SUM(pp.price) / SUM(pp.volume) as price, SUM(pp.volume) * SUM(pp.price) / SUM(pp.volume) as cost, pc.nama_produk as product, pp.measure');
		        $this->db->join('produk pc','pp.product_id = pc.id','left');
				$this->db->join('pmm_sales_po po','pp.salesPo_id = po.id');
				//$this->db->join('pmm_sales_po_detail pod','po.id = pod.sales_po_id');
		        if(!empty($start_date) && !empty($end_date)){
		            $this->db->where('pp.date_production >=',$start_date);
		            $this->db->where('pp.date_production <=',$end_date);
		        }
		        if(!empty($client_id)){
		            $this->db->where('pp.client_id',$client_id);
		        }
		        if(!empty($filter_product)){
		        	$this->db->where_in('pp.product_id',$filter_product);
		        }
		        $this->db->where('pp.client_id',$row['client_id']);
		        $this->db->where('pp.status','PUBLISH');
		        $this->db->where('pc.status','PUBLISH');
		        $this->db->group_by('pp.product_id');
		        $arr_products = $this->db->get_where('pmm_productions pp')->result_array();
				

				$arr['no'] = $no;
				$arr['products'] = $arr_products;
				$arr['total'] = $row['total'];
				$arr['cost'] = $row['cost'];
				$arr['client'] = $row['nama'];
				$total_real += $row['total'];
				$total_cost += $row['cost'];
				$data[] = $arr;
				$no++;
			}
		}


		echo json_encode(array('data'=>$data,'date_text'=> $date_text,'total_real'=>$total_real,'total_cost'=>$total_cost));	
	}


	public function edit_data_detail()
	{
		$id = $this->input->post('id');

		$data = $this->db->get_where('pmm_productions prm',array('prm.id'=>$id))->row_array();
		$data['date_production'] = date('d-m-Y',strtotime($data['date_production']));
		echo json_encode(array('data'=>$data));		
	}

	public function print_pdf()
	{
		$this->load->library('pdf');
	

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        $pdf->SetTopMargin(5);
        $pdf->SetFont('helvetica','',7); 
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
		$product_id = $this->input->get('product_id');
		$client_id = $this->input->get('client_id');
		$salesPo_id = $this->input->get('salesPo_id');
		$filter_date = false;

		$this->db->select('pp.*,pc.nama');
		if(!empty($client_id)){
			$this->db->where('pp.client_id',$client_id);
		}
		if(!empty($product_id) || $product_id != 0){
			$this->db->where('pp.product_id',$product_id);
		}
		if(!empty($salesPo_id) || $salesPo_id != 0){
			$this->db->where('pp.salesPo_id',$salesPo_id);
		}
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('pp.date_production  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('pp.date_production <=',date('Y-m-d',strtotime($end_date)));	
			$filter_date = date('d F Y',strtotime($start_date)).' - '.date('d F Y',strtotime($end_date));
		}
		$this->db->join('penerima pc','pp.client_id = pc.id','left');
		$this->db->order_by('pp.date_production','asc');
		$this->db->order_by('pp.created_on','asc');
		$this->db->group_by('pp.id');
		$query = $this->db->get('pmm_productions pp');

		$data['data'] = $query->result_array();
		$data['filter_date'] = $filter_date;
        $html = $this->load->view('pmm/productions_print',$data,TRUE);

        
        $pdf->SetTitle('Rekap Pengiriman');
        $pdf->nsi_html($html);
        $pdf->Output('rekap_surat_jalan_penjualan.pdf', 'I');
	
	}

	function post_price()
	{
		$this->db->where('product_id !=',5);
		$arr = $this->db->get('pmm_productions');
		foreach ($arr->result_array() as $row) {
			$contract_price = $this->crud_global->GetField('pmm_product',array('id'=>$row['product_id']),'contract_price');
			$price = $row['volume'] * $contract_price;
			$this->db->update('pmm_productions',array('price'=>$price),array('id'=>$row['id']));
		}
	}
	
	//BATAS RUMUS LAMA//
	
	function pengiriman_penjualan()
	{
		$data = array();
		$filter_client_id = $this->input->post('filter_client_id');
		$purchase_order_no = $this->input->post('salesPo_id');
		$filter_product = $this->input->post('filter_product');
		$start_date = false;
		$end_date = false;
		$total_nilai = 0;
		$total_volume = 0;
		$date = $this->input->post('filter_date');
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));
		}

		$this->db->select('ppo.client_id, pp.convert_measure as convert_measure, ps.nama as name, SUM(pp.display_price) / SUM(pp.display_volume) as price, SUM(pp.display_volume) as total, SUM(pp.display_price) as total_price');
		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('pp.date_production >=',$start_date);
            $this->db->where('pp.date_production <=',$end_date);
        }
        if(!empty($filter_client_id)){
            $this->db->where('ppo.client_id',$filter_client_id);
        }
        if(!empty($filter_product)){
            $this->db->where_in('pp.product_id',$filter_product);
        }
        if(!empty($purchase_order_no)){
            $this->db->where('pp.salesPo_id',$purchase_order_no);
        }
		
		
		$this->db->join('penerima ps','ppo.client_id = ps.id','left');
		$this->db->join('pmm_productions pp','ppo.id = pp.salesPo_id','left');
		$this->db->where("ppo.status in ('OPEN','CLOSED')");
		$this->db->where('pp.status','PUBLISH');
		$this->db->group_by('ppo.client_id');
		$query = $this->db->get('pmm_sales_po ppo');
		
		$no = 1;
		if($query->num_rows() > 0){

			foreach ($query->result_array() as $key => $sups) {

				$mats = array();
				$materials = $this->pmm_model->GetPengirimanPenjualan($sups['client_id'],$purchase_order_no,$start_date,$end_date,$filter_product);
				if(!empty($materials)){
					foreach ($materials as $key => $row) {
						$arr['no'] = $key + 1;
						$arr['measure'] = $row['measure'];
						$arr['nama_produk'] = $row['nama_produk'];
						$arr['salesPo_id'] = '<a href="'.base_url().'penjualan/dataSalesPO/'.$row['salesPo_id'].'" target="_blank">'.$row['salesPo_id'] = $this->crud_global->GetField('pmm_sales_po',array('id'=>$row['salesPo_id']),'contract_number').'</a>';
						$arr['real'] = '<a href="'.base_url().'pmm/productions/detail_transaction/'.$start_date.'/'.$end_date.'/'.$row['client_id'].'/'.$row['product_id'].'" target="_blank">'.number_format($row['total'],2,',','.').'</a>';
						$arr['price'] = number_format($row['price'],0,',','.');
						$arr['total_price'] = number_format($row['total_price'],0,',','.');
						
						
						$arr['name'] = $sups['name'];
						$mats[] = $arr;
					}
					$sups['mats'] = $mats;
					$total_volume += $sups['total'];
					$total_nilai += $sups['total_price'];
					$sups['no'] = $no;
					$sups['real'] = number_format($sups['total'],2,',','.');
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

	function laporan_piutang()
	{
		$data = array();
		$client_id = $this->input->post('client_id');
		$start_date = false;
		$end_date = false;
		$total_penerimaan = 0;
		$total_tagihan = 0;
		$total_tagihan_bruto = 0;
		$total_pembayaran = 0;
		$total_sisa_piutang_penerimaan = 0;
		$total_sisa_piutang_tagihan = 0;
		$date = $this->input->post('filter_date');
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));
		}

		$this->db->select('po.id, po.client_id, ps.nama as name');
		$this->db->join('pmm_sales_po po','pp.salesPo_id = po.id','left');

		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('pp.date_production >=',$start_date);
            $this->db->where('pp.date_production <=',$end_date);
        }
        if(!empty($client_id)){
            $this->db->where('po.client_id',$client_id);
        }
		
		$this->db->join('penerima ps','po.client_id = ps.id','left');
		$this->db->where("po.status in ('OPEN','CLOSED')");
		$this->db->group_by('po.client_id');
		$this->db->order_by('ps.nama','asc');
		$query = $this->db->get('pmm_productions pp');
		
		$no = 1;
		if($query->num_rows() > 0){

			foreach ($query->result_array() as $key => $sups) {

				$mats = array();
				$materials = $this->pmm_model->GetLaporanPiutang($sups['client_id'],$start_date,$end_date);
				if(!empty($materials)){
					foreach ($materials as $key => $row) {
						$arr['no'] = $key + 1;
						$arr['nama_produk'] = $row['nama_produk'];
						$arr['salesPo_id'] = '<a href="'.base_url().'penjualan/dataSalesPO/'.$row['salesPo_id'].'" target="_blank">'.$row['salesPo_id'] = $this->crud_global->GetField('pmm_sales_po',array('id'=>$row['salesPo_id']),'contract_number').'</a>';
						$arr['penerimaan'] = number_format($row['penerimaan'],0,',','.');
						$arr['tagihan'] = number_format($row['tagihan'],0,',','.');
						$arr['tagihan_bruto'] = number_format($row['tagihan_bruto'],0,',','.');
						$arr['pembayaran'] = number_format($row['pembayaran'],0,',','.');
						$arr['sisa_piutang_penerimaan'] = number_format($row['sisa_piutang_penerimaan'],0,',','.');
						$arr['sisa_piutang_tagihan'] = number_format($row['sisa_piutang_tagihan'],0,',','.');

						$total_penerimaan += $row['penerimaan'];
						$total_tagihan += $row['tagihan'];
						$total_tagihan_bruto += $row['tagihan_bruto'];
						$total_pembayaran += $row['pembayaran'];
						$total_sisa_piutang_penerimaan += $row['sisa_piutang_penerimaan'];
						$total_sisa_piutang_tagihan += $row['sisa_piutang_tagihan'];
						
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
		'total_sisa_piutang_penerimaan'=>number_format($total_sisa_piutang_penerimaan,0,',','.'),
		'total_sisa_piutang_tagihan'=>number_format($total_sisa_piutang_tagihan,0,',','.')
	));	
	}

	function monitoring_piutang()
	{
		$data = array();
		$client_id = $this->input->post('client_id');
		$filter_kategori = $this->input->post('filter_kategori');
		$filter_status = $this->input->post('filter_status');
		$start_date = false;
		$end_date = false;
		$total_dpp_tagihan = 0;
		$total_ppn_tagihan = 0;
		$total_jumlah_tagihan = 0;
		$total_dpp_pembayaran = 0;
		$total_ppn_pembayaran = 0;
		$total_jumlah_pembayaran = 0;
		$total_dpp_sisa_piutang = 0;
		$total_ppn_sisa_piutang = 0;
		$total_jumlah_sisa_piutang = 0;
		$date = $this->input->post('filter_date');
		if(!empty($date)){
			$arr_date = explode(' - ',$date);
			$start_date = date('Y-m-d',strtotime($arr_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_date[1]));
		}

		$this->db->select('ppp.id, ppp.client_id, ps.nama as name');
		$this->db->join('penerima ps','ppp.client_id = ps.id','left');
		$this->db->join('pmm_sales_po po','ppp.sales_po_id = po.id','left');

		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('ppp.tanggal_invoice >=',$start_date);
            $this->db->where('ppp.tanggal_invoice <=',$end_date);
        }
        if(!empty($client_id) || $client_id != 0){
            $this->db->where('ppp.client_id',$client_id);
        }
		if(!empty($filter_status) || $filter_status != 0){
            $this->db->where('ppp.status_pembayaran',$filter_status);
        }
		
		$this->db->group_by('ppp.client_id');
		$this->db->order_by('ps.nama','asc');
		$query = $this->db->get('pmm_penagihan_penjualan ppp');
		
		$no = 1;
		if($query->num_rows() > 0){

			foreach ($query->result_array() as $key => $sups) {

				$mats = array();
				$materials = $this->pmm_model->GetLaporanMonitoringPiutang($sups['client_id'],$start_date,$end_date,$filter_kategori,$filter_status);
				if(!empty($materials)){
					foreach ($materials as $key => $row) {

						$awal  = date_create($row['status_umur_hutang']);
						$akhir = date_create($end_date);
						$diff  = date_diff($awal, $akhir);

						$arr['no'] = $key + 1;
						$arr['nama'] = $row['nama'];
						$arr['subject'] = $row['subject'];
						$arr['status_pembayaran'] = $row['status_pembayaran'];
						$arr['syarat_pembayaran'] = $diff->days . '';
						$arr['nomor_invoice'] = '<a href="'.base_url().'penjualan/detailPenagihan/'.$row['id'].'" target="_blank">'.$row['nomor_invoice'].'</a>';
						$arr['tanggal_invoice'] =  date('d-m-Y',strtotime($row['tanggal_invoice']));
						$arr['dpp_tagihan'] = number_format($row['dpp_tagihan'],0,',','.');
						$arr['ppn_tagihan'] = number_format($row['ppn_tagihan'],0,',','.');
						$arr['jumlah_tagihan'] = number_format($row['jumlah_tagihan'],0,',','.');
						$arr['dpp_pembayaran'] = number_format($row['dpp_pembayaran'],0,',','.');
						$arr['ppn_pembayaran'] = number_format($row['ppn_pembayaran'],0,',','.');
						$arr['jumlah_pembayaran'] = number_format($row['jumlah_pembayaran'],0,',','.');
						$arr['dpp_sisa_piutang'] = number_format($row['dpp_sisa_piutang'],0,',','.');
						$arr['ppn_sisa_piutang'] = number_format($row['ppn_sisa_piutang'],0,',','.');
						$arr['jumlah_sisa_piutang'] = number_format($row['jumlah_sisa_piutang'],0,',','.');

						$total_dpp_tagihan += $row['dpp_tagihan'];
						$total_ppn_tagihan += $row['ppn_tagihan'];
						$total_jumlah_tagihan += $row['jumlah_tagihan'];
						$total_dpp_pembayaran += $row['dpp_pembayaran'];
						$total_ppn_pembayaran += $row['ppn_pembayaran'];
						$total_jumlah_pembayaran += $row['jumlah_pembayaran'];
						$total_dpp_sisa_piutang += $row['dpp_sisa_piutang'];
						$total_ppn_sisa_piutang += $row['ppn_sisa_piutang'];
						$total_jumlah_sisa_piutang += $row['jumlah_sisa_piutang'];
						
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
		'total_jumlah_pembayaran'=>number_format($total_jumlah_pembayaran,0,',','.'),
		'total_dpp_sisa_piutang'=>number_format($total_dpp_sisa_piutang,0,',','.'),
		'total_ppn_sisa_piutang'=>number_format($total_ppn_sisa_piutang,0,',','.'),
		'total_jumlah_sisa_piutang'=>number_format($total_jumlah_sisa_piutang,0,',','.')
	));	
	}

	public function cetak_surat_jalan()
	{
		$this->load->library('pdf');

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
        $pdf->SetTopMargin(5);
        $pdf->SetFont('helvetica','',7); 
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
		$product_id = $this->input->get('product_id');
		$client_id = $this->input->get('supplier_id');
		$salesPo_id = $this->input->get('sales_po_id');
		$filter_date = false;

		$this->db->select('pp.*, pc.nama, p.nama_produk');
		if(!empty($client_id) || $client_id != 0){
			$this->db->where('pp.client_id',$client_id);
		}
		if(!empty($product_id) || $product_id != 0){
			$this->db->where('pp.product_id',$product_id);
		}
		if(!empty($salesPo_id) || $salesPo_id != 0){
			$this->db->where('pp.salesPo_id',$salesPo_id);
		}
		if(!empty($w_date)){
			$arr_date = explode(' - ', $w_date);
			$start_date = $arr_date[0];
			$end_date = $arr_date[1];
			$this->db->where('pp.date_production  >=',date('Y-m-d',strtotime($start_date)));	
			$this->db->where('pp.date_production <=',date('Y-m-d',strtotime($end_date)));	
			$filter_date = date('d F Y',strtotime($start_date)).' - '.date('d F Y',strtotime($end_date));
		}
		$this->db->join('penerima pc','pp.client_id = pc.id','left');
		$this->db->join('produk p','pp.product_id = p.id','left');
		$this->db->group_by('pp.id');
		$this->db->order_by('pp.date_production','asc');
		$this->db->order_by('p.nama_produk','asc');
		$this->db->order_by('pp.created_on','asc');
		$query = $this->db->get('pmm_productions pp');

		$data['data'] = $query->result_array();
		$data['filter_date'] = $filter_date;
		$data['salesPo_id'] = $salesPo_id;
        $html = $this->load->view('penjualan/cetak_surat_jalan',$data,TRUE);
        
        $pdf->SetTitle('Rekap Pengiriman');
        $pdf->nsi_html($html);
        $pdf->Output('rekap_surat_jalan_pengiriman.pdf', 'I');
	
	}

	function get_mat_penjualan()
	{
		$data = array();
		$sales_po_id = $this->input->post('sales_po_id');
		$this->db->select('pp.salesPo_id as po_id, pp.product_id as id_new, p.nama_produk');
		$this->db->from('pmm_productions pp');
		$this->db->join('produk p','pp.product_id = p.id','left');
		$this->db->where('pp.salesPo_id',$sales_po_id);
		$this->db->group_by('pp.product_id');
		$this->db->order_by('p.nama_produk','asc');
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

	function daftar_penerimaan()
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
		
		$this->db->select('pmp.client_id, pmp.nama_pelanggan as nama, SUM(pmp.total) AS total_bayar');
		if(!empty($start_date) && !empty($end_date)){
            $this->db->where('pmp.tanggal_pembayaran >=',$start_date);
            $this->db->where('pmp.tanggal_pembayaran <=',$end_date);
        }
        if(!empty($supplier_id)){
            $this->db->where('pmp.client_id',$supplier_id);
        }
        if(!empty($filter_material)){
            $this->db->where_in('ppd.material_id',$filter_material);
        }
        if(!empty($purchase_order_no)){
            $this->db->where('pmp.penagihan_id',$purchase_order_no);
        }
		
		$this->db->join('pmm_penagihan_penjualan ppp', 'pmp.penagihan_id = ppp.id','left');
		$this->db->join('pmm_sales_po ppo', 'ppp.sales_po_id = ppo.id','left');
		$this->db->where("ppo.status in ('OPEN','CLOSED')");
		$this->db->group_by('pmp.client_id');
		$this->db->order_by('pmp.nama_pelanggan','asc');
		$query = $this->db->get('pmm_pembayaran pmp');
		
		$no = 1;
		if($query->num_rows() > 0){

			foreach ($query->result_array() as $key => $sups) {

				$mats = array();
				$materials = $this->pmm_model->GetDaftarPenerimaan($sups['client_id'],$purchase_order_no,$start_date,$end_date,$filter_material);
				
				if(!empty($materials)){
					foreach ($materials as $key => $row) {
						$arr['no'] = $key + 1;
						$arr['tanggal_pembayaran'] =  date('d-m-Y',strtotime($row['tanggal_pembayaran']));
						$arr['nomor_transaksi'] = $row['nomor_transaksi'];
						$arr['tanggal_invoice'] = date('d-m-Y',strtotime($row['tanggal_invoice']));
						$arr['nomor_invoice'] = $row['nomor_invoice'];
						$arr['penerimaan'] = number_format($row['penerimaan'],0,',','.');								
						
						$arr['nama'] = $sups['nama'];
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

	public function detail_transaction($start_date,$end_date,$id,$material_id)
    {
        $check = $this->m_admin->check_login();
        if($check == true){

            $this->db->select('ppo.*, SUM(prm.volume) as volume');
			$this->db->join('pmm_productions prm','ppo.id = prm.salesPo_id');
			$this->db->where('prm.date_production >=',$start_date);
            $this->db->where('prm.date_production <=',$end_date);
            $this->db->where('ppo.client_id',$id);
			$this->db->where('prm.product_id',$material_id);
			$this->db->group_by('ppo.id');
            $query = $this->db->get('pmm_sales_po ppo');
            $data['row'] = $query->result_array();
            $this->load->view('laporan_penjualan/detail_transaction',$data);
            
        }else {
            redirect('admin');
        }
    }


}