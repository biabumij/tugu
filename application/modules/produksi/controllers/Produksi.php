<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi extends Secure_Controller {

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

	public function sunting_stock_opname($id)
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['row'] = $this->db->get_where("pmm_remaining_materials_cat", ["id" => $id])->row_array();
			$cat = $this->db->get_where("pmm_remaining_materials_cat", ["id" => $id])->row_array();
			$data['tanggal'] = date('d-m-Y',strtotime($cat['date']));
			$this->load->view('produksi/sunting_stock_opname', $data);
		} else {
			redirect('admin');
		}
	}

	public function submit_sunting_stock_opname()
	{

		$id = $this->input->post('id');
		$date = date('Y-m-d',strtotime($this->input->post('date')));
		$material_id = $this->input->post('material_id');
		$volume =  str_replace('.', '', $this->input->post('volume'));
		$volume =  str_replace(',', '.', $volume);
		$total =  str_replace('.', '', $this->input->post('total'));
		$measure = $this->input->post('measure');
		$notes = $this->input->post('notes');

		$arr_update = array(
			'material_id' => $material_id,
			'date' => $date,
			'measure' => $measure,
			'volume' => $volume,
			'convert' => $convert,
			'display_volume' => $volume,
			'display_measure' => $measure,
			'notes' => $notes,
			'total' => $total,
			'price' => $total / $volume,
			'updated_by' => $this->session->userdata('admin_id'),
			'updated_on' => date('Y-m-d H:i:s')
		);

		$this->db->where('id', $id);
		if ($this->db->update('pmm_remaining_materials_cat', $arr_update)) {
			
		}

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error', '<b>ERROR</b>');
			redirect('admin/stock_opname');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success', '<b>SAVED</b>');
			redirect('admin/stock_opname');
		}
	}
	
	public function cetak_stock_opname()
	{
		$this->load->library('pdf');
	

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setPrintHeader(true);
        $pdf->SetPrintFooter(true);
        $pdf->SetFont('helvetica','',7); 
        $tagvs = array('div' => array(0 => array('h' => 0, 'n' => 0), 1 => array('h' => 0, 'n'=> 0)));
		$pdf->setHtmlVSpace($tagvs);
		$pdf->AddPage('P');

		$arr_date = $this->input->get('filter_date');
		if(empty($arr_date)){
			$filter_date = '-';
		}else {
			$arr_filter_date = explode(' - ', $arr_date);
			$start_date = date('Y-m-d',strtotime($arr_filter_date[0]));
			$end_date = date('Y-m-d',strtotime($arr_filter_date[1]));
			$filter_date = date('d F Y',strtotime($arr_filter_date[0])).' - '.date('d F Y',strtotime($arr_filter_date[1]));
		}
		$data['filter_date'] = $filter_date;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$data['date1'] = date('d F Y',strtotime($arr_filter_date[0]));
		$data['date2'] = date('d F Y',strtotime($arr_filter_date[1]));
		$filter_date = $this->input->get('filter_date');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
			$this->db->where('date >=',date('Y-m-d',strtotime($arr_date[0])));
			$this->db->where('date <=',date('Y-m-d',strtotime($arr_date[1])));
		}
		$query = $this->db->get('pmm_remaining_materials_cat');
		$data['data'] = $query->result_array();
		$data['custom_date'] = $this->input->get('custom_date');
        $html = $this->load->view('produksi/cetak_stock_opname',$data,TRUE);

        
        $pdf->SetTitle('Stock Opname');
        $pdf->nsi_html($html);
        $pdf->Output('Stock Opname.pdf', 'I');
	
	}

	public function table_pemakaian()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
			$this->db->where('date >=',date('Y-m-d',strtotime($arr_date[0])));
			$this->db->where('date <=',date('Y-m-d',strtotime($arr_date[1])));
		}
        $this->db->select('*');
		$this->db->order_by('date','desc');
		$query = $this->db->get('kunci_bahan_baku');
		
       if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
                $row['date'] = date('d F Y',strtotime($row['date']));
                $row['jumlah_bahan'] = number_format($row['nilai_semen'] + $row['nilai_pasir'] + $row['nilai_1020'] + $row['nilai_2030'] + $row['nilai_additive'],0,',','.');
				$row['jumlah_solar'] = number_format($row['nilai_solar'],0,',','.');
				$row['status'] = $row['status'];
				$row['admin_name'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');
                $row['created_on'] = date('d/m/Y H:i:s',strtotime($row['created_on']));

				if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4){
					$row['actions'] = '<a href="javascript:void(0);" onclick="DeleteDataPemakaian('.$row['id'].')" class="btn btn-danger" style="font-weight:bold; border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['actions'] = '-';
				}

                $data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }

	public function delete_pemakaian()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){
			$this->db->delete('kunci_bahan_baku',array('id'=>$id));
			{
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}

	public function form_pemakaian()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['products'] = $this->db->select('*')->get_where('produk', array('status' => 'PUBLISH', 'kategori_produk' => 1))->result_array();
			$this->load->view('produksi/form_pemakaian', $data);
		} else {
			redirect('admin');
		}
	}

	public function submit_pemakaian()
	{
		$date = $this->input->post('date');
		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

		$arr_insert = array(
			'date' => date('Y-m-d', strtotime($date)),
			'unit_head' => 6,
			'logistik' => 10,
			'admin' => 10,
			'keu' => 9,
			'status' => 'PUBLISH',
			'created_by' => $this->session->userdata('admin_id'),
			'created_on' => date('Y-m-d H:i:s')
		);

		$this->db->insert('kunci_bahan_baku', $arr_insert);

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>ERROR</b>');
			redirect('/stock_opname/pemakaian');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>SAVED</b>');
			redirect('admin/stock_opname');
		}
	}

	public function table_pemakaian_bahan()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
			$this->db->where('date >=',date('Y-m-d',strtotime($arr_date[0])));
			$this->db->where('date <=',date('Y-m-d',strtotime($arr_date[1])));
		}
        $this->db->select('*');
		$this->db->order_by('date','desc');
		$query = $this->db->get('pemakaian_bahan');
		
       if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
                $row['date'] = date('d F Y',strtotime($row['date']));
				$row['material_id'] = $this->crud_global->GetField('produk',array('id'=>$row['material_id']),'nama_produk');
                $row['volume'] = number_format($row['volume'],2,',','.');
				$row['nilai'] = number_format($row['nilai'],0,',','.');
				$row['status'] = $row['status'];
				$row['admin_name'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');
                $row['created_on'] = date('d/m/Y H:i:s',strtotime($row['created_on']));

				if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4){
					$row['actions'] = '<a href="javascript:void(0);" onclick="DeleteDataPemakaianBahan('.$row['id'].')" class="btn btn-danger" style="font-weight:bold; border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['actions'] = '-';
				}

                $data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }

	public function delete_pemakaian_bahan()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){
			$this->db->delete('pemakaian_bahan',array('id'=>$id));
			{
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}

	public function form_pemakaian_bahan()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['products'] = $this->db->select('*')->get_where('produk', array('status' => 'PUBLISH', 'kategori_produk' => 1))->result_array();
			$this->load->view('produksi/form_pemakaian_bahan', $data);
		} else {
			redirect('admin');
		}
	}

	public function submit_pemakaian_bahan()
	{
		$date = $this->input->post('date');
		$material_id = $this->input->post('material_id');
		$volume =  str_replace('.', '', $this->input->post('volume'));
		$volume =  str_replace(',', '.', $volume);
		$nilai = str_replace('.', '', $this->input->post('nilai'));

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

		$arr_insert = array(
			'date' => date('Y-m-d', strtotime($date)),
			'material_id' => $material_id,
			'volume' => $volume,
			'nilai' => $nilai,
			'status' => 'PUBLISH',
			'created_by' => $this->session->userdata('admin_id'),
			'created_on' => date('Y-m-d H:i:s')
		);

		$this->db->insert('pemakaian_bahan', $arr_insert);

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>ERROR</b>');
			redirect('/stock_opname/pemakaian_bahan');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>SAVED</b>');
			redirect('admin/stock_opname');
		}
	}

	public function table_rakor()
	{   
        $data = array();
		$filter_date = $this->input->post('filter_date');
		if(!empty($filter_date)){
			$arr_date = explode(' - ', $filter_date);
			$this->db->where('date >=',date('Y-m-d',strtotime($arr_date[0])));
			$this->db->where('date <=',date('Y-m-d',strtotime($arr_date[1])));
		}
        $this->db->select('*');
		$this->db->order_by('date','desc');
		$query = $this->db->get('kunci_rakor');
		
       if($query->num_rows() > 0){
			foreach ($query->result_array() as $key => $row) {
                $row['no'] = $key+1;
                $row['date'] = date('d F Y',strtotime($row['date']));
				$row['admin_name'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');
                $row['created_on'] = date('d/m/Y H:i:s',strtotime($row['created_on']));

				if($this->session->userdata('admin_group_id') == 1){
					$row['actions'] = '<a href="javascript:void(0);" onclick="DeleteDataRakor('.$row['id'].')" class="btn btn-danger" style="font-weight:bold; border-radius:10px;"><i class="fa fa-close"></i> </a>';
				}else {
					$row['actions'] = '-';
				}
				
                $data[] = $row;
            }

        }
        echo json_encode(array('data'=>$data));
    }

	public function delete_rakor()
	{
		$output['output'] = false;
		$id = $this->input->post('id');
		if(!empty($id)){
			$this->db->delete('kunci_rakor',array('id'=>$id));
			{
				$output['output'] = true;
			}
		}
		echo json_encode($output);
	}

	public function form_rakor()
	{
		$check = $this->m_admin->check_login();
		if ($check == true) {
			$data['products'] = $this->db->select('*')->get_where('produk', array('status' => 'PUBLISH', 'kategori_produk' => 1))->result_array();
			$this->load->view('produksi/form_rakor', $data);
		} else {
			redirect('admin');
		}
	}

	public function submit_rakor()
	{
		$date = $this->input->post('date');

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE); # See Note 01. If you wish can remove as well 

		$arr_insert = array(
			'date' => date('Y-m-d', strtotime($date)),
			'created_by' => $this->session->userdata('admin_id'),
			'created_on' => date('Y-m-d H:i:s'),
		);

		$this->db->insert('kunci_rakor', $arr_insert);

		if ($this->db->trans_status() === FALSE) {
			# Something went wrong.
			$this->db->trans_rollback();
			$this->session->set_flashdata('notif_error','<b>ERROR</b>');
			redirect('/stock_opname#rakor');
		} else {
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
			$this->session->set_flashdata('notif_success','<b>SAVED</b>');
			redirect('admin/stock_opname');
		}
	}

}
?>