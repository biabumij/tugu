<!DOCTYPE html>
<html>
	<head>
	  <title>LAPORAN EVALUASI BUA</title>
	  
	  <?php
		$search = array(
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
		);
		
		$replace = array(
		'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
		);
		
		$subject = "$filter_date";

		echo str_replace($search, $replace, $subject);

	  ?>
	  
	  <style type="text/css">
		 body {
			font-family: helvetica;
			font-size: 8px;
		}

		table.table-border-pojok-kiri, th.table-border-pojok-kiri, td.table-border-pojok-kiri {
			border-top: 1px solid black;
			border-bottom: 1px solid black;
			border-right: 1px solid #cccccc;
			border-left: 1px solid black;
		}

		table.table-border-pojok-tengah, th.table-border-pojok-tengah, td.table-border-pojok-tengah {
			border-top: 1px solid black;
			border-bottom: 1px solid black;
			border-right: 1px solid #cccccc;
		}

		table.table-border-pojok-kanan, th.table-border-pojok-kanan, td.table-border-pojok-kanan {
			border-top: 1px solid black;
			border-bottom: 1px solid black;
			border-right: 1px solid black;
		}

		table.table-border-spesial, th.table-border-spesial, td.table-border-spesial {
			border-left: 1px solid black;
			border-right: 1px solid black;
		}

		table.table-border-spesial-kiri, th.table-border-spesial-kiri, td.table-border-spesial-kiri {
			border-left: 1px solid black;
			border-top: 2px solid black;
			border-bottom: 2px solid black;
		}

		table.table-border-spesial-tengah, th.table-border-spesial-tengah, td.table-border-spesial-tengah {
			border-left: 1px solid #cccccc;
			border-right: 1px solid #cccccc;
			border-top: 2px solid black;
			border-bottom: 2px solid black;
		}

		table.table-border-spesial-kanan, th.table-border-spesial-kanan, td.table-border-spesial-kanan {
			border-left: 1px solid #cccccc;
			border-right: 1px solid black;
			border-top: 2px solid black;
			border-bottom: 2px solid black;
		}

		table tr.table-judul{
			border: 1px solid;
			background-color: #e69500;
			font-weight: bold;
			font-size: 8px;
			color: black;
		}
			
		table tr.table-baris1{
			background-color: none;
			font-size: 8px;
		}

		table tr.table-baris1-bold{
			background-color: none;
			font-size: 8px;
			font-weight: bold;
		}
			
		table tr.table-total{
			background-color: #FFFF00;
			font-weight: bold;
			font-size: 8px;
			color: black;
		}

		table tr.table-total2{
			background-color: #eeeeee;
			font-weight: bold;
			font-size: 8px;
			color: black;
		}
	  </style>

	</head>
	<body>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">EVALUASI BUA</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">PROYEK BENDUNGAN TUGU</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">PT. BIA BUMI JAYENDRA</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px; text-transform: uppercase;">PERIODE : <?php echo str_replace($search, $replace, $subject);?></div>	
		<br /><br /><br />
		<?php
		$data = array();
		
		$arr_date = $this->input->get('filter_date');
		$arr_filter_date = explode(' - ', $arr_date);
		$date1 = '';
		$date2 = '';

		if(count($arr_filter_date) == 2){
			$date1 	= date('Y-m-d',strtotime($arr_filter_date[0]));
			$date2 	= date('Y-m-d',strtotime($arr_filter_date[1]));
			$filter_date = date('d F Y',strtotime($arr_filter_date[0])).' - '.date('d F Y',strtotime($arr_filter_date[1]));
		}
		
		?>
		
		<table class="table table-bordered" width="98%"  cellpadding="3">
			
			<?php
			$rap_gaji_upah = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa in ('114','115')")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_konsumsi = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 116")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_biaya_sewa_mess = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 119")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_listrik_internet = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 118")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_pengujian_material_laboratorium = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 120")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_keamanan_kebersihan = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 97")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_pengobatan = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 70")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_donasi = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 76")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_bensin_tol_parkir = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 78")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_perjalanan_dinas_penjualan = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 62")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_pakaian_dinas = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 87")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_alat_tulis_kantor = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 96")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_perlengkapan_kantor = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 98")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_beban_kirim = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 93")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_beban_lain_lain = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 94")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_biaya_sewa_kendaraan = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 100")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_thr_bonus = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 117")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();

			$rap_biaya_admin_bank = $this->db->select('rap.*,sum(det.harga_satuan) as total')
			->from('rap_bua rap')
			->join('rap_bua_detail det','rap.id = det.rap_bua_id','left')
			->where("rap.status = 'PUBLISH'")
			->where("det.coa = 91")
			->where("rap.tanggal_rap_bua < '$date2'")
			->order_by('rap.tanggal_rap_bua','asc')->limit(1)
			->get()->row_array();
			
			//REALISASI
			$gaji_upah_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun in ('114','115')")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$gaji_upah_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun in ('114','115')")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$gaji_upah = $gaji_upah_biaya['total'] + $gaji_upah_jurnal['total'];

			$konsumsi_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 116")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$konsumsi_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 116")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$konsumsi = $konsumsi_biaya['total'] + $konsumsi_jurnal['total'];

			$biaya_sewa_mess_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 119")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$biaya_sewa_mess_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 119")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$biaya_sewa_mess = $biaya_sewa_mess_biaya['total'] + $biaya_sewa_mess_jurnal['total'];

			$listrik_internet_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 118")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$listrik_internet_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 118")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$listrik_internet = $listrik_internet_biaya['total'] + $listrik_internet_jurnal['total'];

			$pengujian_material_laboratorium_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 120")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$pengujian_material_laboratorium_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 120")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$pengujian_material_laboratorium = $pengujian_material_laboratorium_biaya['total'] + $pengujian_material_laboratorium_jurnal['total'];

			$keamanan_kebersihan_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 97")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$keamanan_kebersihan_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 97")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$keamanan_kebersihan = $keamanan_kebersihan_biaya['total'] + $keamanan_kebersihan_jurnal['total'];

			$pengobatan_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 70")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$pengobatan_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 70")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$pengobatan = $pengobatan_biaya['total'] + $pengobatan_jurnal['total'];

			$donasi_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 76")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$donasi_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 76")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$donasi = $donasi_biaya['total'] + $donasi_jurnal['total'];

			$bensin_tol_parkir_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 78")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$bensin_tol_parkir_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 78")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$bensin_tol_parkir = $bensin_tol_parkir_biaya['total'] + $bensin_tol_parkir_jurnal['total'];

			$perjalanan_dinas_penjualan_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 62")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$perjalanan_dinas_penjualan_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 62")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$perjalanan_dinas_penjualan = $perjalanan_dinas_penjualan_biaya['total'] + $perjalanan_dinas_penjualan_jurnal['total'];

			$pakaian_dinas_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 87")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$pakaian_dinas_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 87")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$pakaian_dinas = $pakaian_dinas_biaya['total'] + $pakaian_dinas_jurnal['total'];

			$alat_tulis_kantor_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 96")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$alat_tulis_kantor_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 96")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$alat_tulis_kantor = $alat_tulis_kantor_biaya['total'] + $alat_tulis_kantor_jurnal['total'];

			$perlengkapan_kantor_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 98")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$perlengkapan_kantor_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 98")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$perlengkapan_kantor = $perlengkapan_kantor_biaya['total'] + $perlengkapan_kantor_jurnal['total'];

			$beban_kirim_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 93")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$beban_kirim_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 93")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$beban_kirim = $beban_kirim_biaya['total'] + $beban_kirim_jurnal['total'];

			$beban_lain_lain_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 94")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$beban_lain_lain_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 94")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$beban_lain_lain = $beban_lain_lain_biaya['total'] + $beban_lain_lain_jurnal['total'];

			$biaya_sewa_kendaraan_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 100")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$biaya_sewa_kendaraan_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 100")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$biaya_sewa_kendaraan = $biaya_sewa_kendaraan_biaya['total'] + $biaya_sewa_kendaraan_jurnal['total'];

			$thr_bonus_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 117")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$thr_bonus_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 117")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$thr_bonus = $thr_bonus_biaya['total'] + $thr_bonus_jurnal['total'];

			$biaya_admin_bank_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 91")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$biaya_admin_bank_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 91")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$biaya_admin_bank = $biaya_admin_bank_biaya['total'] + $biaya_admin_bank_jurnal['total'];

			$biaya_persiapan_biaya = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 131")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$biaya_persiapan_jurnal = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 131")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();

			$biaya_persiapan = $biaya_persiapan_biaya['total'] + $biaya_persiapan_jurnal['total'];
			?>

			<?php
			$evaluasi_gaji_upah = $rap_gaji_upah['total'] - $gaji_upah;
			$evaluasi_konsumsi = $rap_konsumsi['total'] - $konsumsi;
			$evaluasi_biaya_sewa_mess = $rap_biaya_sewa_mess['total'] - $biaya_sewa_mess;
			$evaluasi_listrik_internet = $rap_listrik_internet['total'] - $listrik_internet;
			$evaluasi_pengujian_material_laboratorium = $rap_pengujian_material_laboratorium['total'] - $pengujian_material_laboratorium;
			$evaluasi_keamanan_kebersihan = $rap_keamanan_kebersihan['total'] - $keamanan_kebersihan;
			$evaluasi_pengobatan = $rap_pengobatan['total'] - $pengobatan;
			$evaluasi_donasi = $rap_donasi['total'] - $donasi;
			$evaluasi_bensin_tol_parkir = $rap_bensin_tol_parkir['total'] - $bensin_tol_parkir;
			$evaluasi_perjalanan_dinas_penjualan = $rap_perjalanan_dinas_penjualan['total'] - $perjalanan_dinas_penjualan;
			$evaluasi_pakaian_dinas = $rap_pakaian_dinas['total'] - $pakaian_dinas;
			$evaluasi_alat_tulis_kantor = $rap_alat_tulis_kantor['total'] -	$alat_tulis_kantor;
			$evaluasi_perlengkapan_kantor = $rap_perlengkapan_kantor['total'] - $perlengkapan_kantor;
			$evaluasi_beban_kirim = $rap_beban_kirim['total'] - $beban_kirim;
			$evaluasi_beban_lain_lain = $rap_beban_lain_lain['total'] - 	$beban_lain_lain;
			$evaluasi_biaya_sewa_kendaraan = $rap_biaya_sewa_kendaraan['total'] - $biaya_sewa_kendaraan;
			$evaluasi_thr_bonus = $rap_thr_bonus['total'] - $thr_bonus;
			$evaluasi_biaya_admin_bank = $rap_biaya_admin_bank['total'] - $biaya_admin_bank;
			$evaluasi_biaya_persiapan = $rap_biaya_persiapan['total'] - $biaya_persiapan;


			$total_rap = $rap_gaji_upah['total'] + $rap_konsumsi['total'] + $rap_biaya_sewa_mess['total'] + $rap_listrik_internet['total'] + $rap_pengujian_material_laboratorium['total'] + $rap_keamanan_kebersihan['total'] + $rap_pengobatan['total'] + $rap_donasi['total'] + $rap_bensin_tol_parkir['total'] + $rap_perjalanan_dinas_penjualan['total'] + $rap_pakaian_dinas['total'] + $rap_alat_tulis_kantor['total'] + $rap_perlengkapan_kantor['total'] + $rap_beban_kirim['total'] + $rap_beban_lain_lain['total'] + $rap_biaya_sewa_kendaraan['total'] + $rap_thr_bonus['total'] + $rap_biaya_admin_bank['total'] + $rap_biaya_persiapan['total'];
			$total_realisasi = $gaji_upah + $konsumsi + $biaya_sewa_mess + $listrik_internet + $pengujian_material_laboratorium + $keamanan_kebersihan + $pengobatan + $donasi + $bensin_tol_parkir + $perjalanan_dinas_penjualan + $pakaian_dinas + $alat_tulis_kantor + $perlengkapan_kantor + $beban_kirim + $beban_lain_lain + $biaya_sewa_kendaraan + $thr_bonus + $biaya_admin_bank + $biaya_persiapan;
			$total_evaluasi = $total_rap - $total_realisasi;
			?>
			
			<tr class="table-judul">
				<th width="5%" align="center" class="table-border-pojok-kiri">NO.</th>
				<th width="35%" align="center" class="table-border-pojok-tengah">URAIAN</th>
				<th width="20%" align="center" class="table-border-pojok-tengah">RAP</th>
				<th width="20%" align="center" class="table-border-pojok-tengah">REALISASI</th>
				<th width="20%" align="center" class="table-border-pojok-kanan">DEVIASI</th>
	        </tr>
			<?php
				$styleColorA = $evaluasi_gaji_upah < 0 ? 'color:red' : 'color:black';
				$styleColorB = $evaluasi_konsumsi < 0 ? 'color:red' : 'color:black';
				$styleColorC = $evaluasi_biaya_sewa_mess < 0 ? 'color:red' : 'color:black';
				$styleColorD = $evaluasi_listrik_internet < 0 ? 'color:red' : 'color:black';
				$styleColorE = $evaluasi_pengujian_material_laboratorium < 0 ? 'color:red' : 'color:black';
				$styleColorF = $evaluasi_keamanan_kebersihan < 0 ? 'color:red' : 'color:black';
				$styleColorG = $evaluasi_pengobatan < 0 ? 'color:red' : 'color:black';
				$styleColorH = $evaluasi_donasi < 0 ? 'color:red' : 'color:black';
				$styleColorI = $evaluasi_bensin_tol_parkir < 0 ? 'color:red' : 'color:black';
				$styleColorJ = $evaluasi_perjalanan_dinas_penjualan < 0 ? 'color:red' : 'color:black';
				$styleColorK = $evaluasi_pakaian_dinas < 0 ? 'color:red' : 'color:black';
				$styleColorL = $evaluasi_alat_tulis_kantor < 0 ? 'color:red' : 'color:black';
				$styleColorM = $evaluasi_perlengkapan_kantor < 0 ? 'color:red' : 'color:black';
				$styleColorN = $evaluasi_beban_kirim < 0 ? 'color:red' : 'color:black';
				$styleColorO = $evaluasi_beban_lain_lain < 0 ? 'color:red' : 'color:black';
				$styleColorP = $evaluasi_biaya_sewa_kendaraan < 0 ? 'color:red' : 'color:black';
				$styleColorQ = $evaluasi_thr_bonus < 0 ? 'color:red' : 'color:black';
				$styleColorR = $evaluasi_biaya_admin_bank < 0 ? 'color:red' : 'color:black';
				$styleColorS = $evaluasi_biaya_persiapan < 0 ? 'color:red' : 'color:black';
				$styleColorT = $total_evaluasi < 0 ? 'color:red' : 'color:black';
			?>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">1.</th>			
				<th align="left" class="table-border-pojok-tengah">Gaji / Upah</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_gaji_upah['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($gaji_upah,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorA ?>"><?php echo $evaluasi_gaji_upah < 0 ? "(".number_format(-$evaluasi_gaji_upah,0,',','.').")" : number_format($evaluasi_gaji_upah,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">2.</th>			
				<th align="left" class="table-border-pojok-tengah">Konsumsi</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_konsumsi['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($konsumsi,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorB ?>"><?php echo $evaluasi_konsumsi < 0 ? "(".number_format(-$evaluasi_konsumsi,0,',','.').")" : number_format($evaluasi_konsumsi,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">3.</th>			
				<th align="left" class="table-border-pojok-tengah">Biaya Sewa - Mess</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_biaya_sewa_mess['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($biaya_sewa_mess,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorC ?>"><?php echo $evaluasi_biaya_sewa_mess < 0 ? "(".number_format(-$evaluasi_biaya_sewa_mess,0,',','.').")" : number_format($evaluasi_biaya_sewa_mess,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">4.</th>			
				<th align="left" class="table-border-pojok-tengah">Listrik & Internet</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_listrik_internet['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($listrik_internet,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorD ?>"><?php echo $evaluasi_listrik_internet < 0 ? "(".number_format(-$evaluasi_listrik_internet,0,',','.').")" : number_format($evaluasi_listrik_internet,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">5.</th>			
				<th align="left" class="table-border-pojok-tengah">Pengujian Material & Laboratorium</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_pengujian_material_laboratorium['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($pengujian_material_laboratorium,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorE ?>"><?php echo $evaluasi_pengujian_material_laboratorium < 0 ? "(".number_format(-$evaluasi_pengujian_material_laboratorium,0,',','.').")" : number_format($evaluasi_pengujian_material_laboratorium,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">6.</th>			
				<th align="left" class="table-border-pojok-tengah">Keamanan & Kebersihan</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_keamanan_kebersihan['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($keamanan_kebersihan,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorF ?>"><?php echo $evaluasi_keamanan_kebersihan < 0 ? "(".number_format(-$evaluasi_keamanan_kebersihan,0,',','.').")" : number_format($evaluasi_keamanan_kebersihan,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">7.</th>			
				<th align="left" class="table-border-pojok-tengah">Pengobatan</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_pengobatan['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($pengobatan,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorG ?>"><?php echo $evaluasi_pengobatan < 0 ? "(".number_format(-$evaluasi_pengobatan,0,',','.').")" : number_format($evaluasi_pengobatan,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">8.</th>			
				<th align="left" class="table-border-pojok-tengah">Donasi</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_donasi['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($donasi,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorH ?>"><?php echo $evaluasi_donasi < 0 ? "(".number_format(-$evaluasi_donasi,0,',','.').")" : number_format($evaluasi_donasi,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">9.</th>			
				<th align="left" class="table-border-pojok-tengah">Bensin, Tol dan Parkir - Umum</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_bensin_tol_parkir['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($bensin_tol_parkir,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorI ?>"><?php echo $evaluasi_bensin_tol_parkir < 0 ? "(".number_format(-$evaluasi_bensin_tol_parkir,0,',','.').")" : number_format($evaluasi_bensin_tol_parkir,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">10.</th>			
				<th align="left" class="table-border-pojok-tengah">Perjalanan Dinas - Penjualan</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_perjalanan_dinas_penjualan['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($perjalanan_dinas_penjualan,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorJ ?>"><?php echo $evaluasi_perjalanan_dinas_penjualan < 0 ? "(".number_format(-$evaluasi_perjalanan_dinas_penjualan,0,',','.').")" : number_format($evaluasi_perjalanan_dinas_penjualan,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">11</th>			
				<th align="left" class="table-border-pojok-tengah">Pakaian Dinas & K3</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_pakaian_dinas['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($pakaian_dinas,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorK ?>"><?php echo $evaluasi_pakaian_dinas < 0 ? "(".number_format(-$evaluasi_pakaian_dinas,0,',','.').")" : number_format($evaluasi_pakaian_dinas,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">12.</th>			
				<th align="left" class="table-border-pojok-tengah">Alat Tulis Kantor & Printing</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_alat_tulis_kantor['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($alat_tulis_kantor,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorL ?>"><?php echo $evaluasi_alat_tulis_kantor < 0 ? "(".number_format(-$evaluasi_alat_tulis_kantor,0,',','.').")" : number_format($evaluasi_alat_tulis_kantor,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">13.</th>			
				<th align="left" class="table-border-pojok-tengah">Perlengkapan Kantor</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_perlengkapan_kantor['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($perlengkapan_kantor,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorM ?>"><?php echo $evaluasi_perlengkapan_kantor < 0 ? "(".number_format(-$evaluasi_perlengkapan_kantor,0,',','.').")" : number_format($evaluasi_perlengkapan_kantor,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">14.</th>			
				<th align="left" class="table-border-pojok-tengah">Beban Kirim</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_beban_kirim['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($beban_kirim,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorN ?>"><?php echo $evaluasi_beban_kirim < 0 ? "(".number_format(-$evaluasi_beban_kirim,0,',','.').")" : number_format($evaluasi_beban_kirim,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">15.</th>			
				<th align="left" class="table-border-pojok-tengah">Beban Lain-Lain</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_beban_lain_lain['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($beban_lain_lain,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorO ?>"><?php echo $evaluasi_beban_lain_lain < 0 ? "(".number_format(-$evaluasi_beban_lain_lain,0,',','.').")" : number_format($evaluasi_beban_lain_lain,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">16.</th>			
				<th align="left" class="table-border-pojok-tengah">Biaya Sewa - Kendaraan</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_biaya_sewa_kendaraan['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($biaya_sewa_kendaraan,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorP ?>"><?php echo $evaluasi_biaya_sewa_kendaraan < 0 ? "(".number_format(-$evaluasi_biaya_sewa_kendaraan,0,',','.').")" : number_format($evaluasi_biaya_sewa_kendaraan,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">17.</th>			
				<th align="left" class="table-border-pojok-tengah">THR & Bonus</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_thr_bonus['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($thr_bonus,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorQ ?>"><?php echo $evaluasi_thr_bonus < 0 ? "(".number_format(-$evaluasi_thr_bonus,0,',','.').")" : number_format($evaluasi_thr_bonus,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">18.</th>			
				<th align="left" class="table-border-pojok-tengah">Biaya Admin Bank</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_biaya_admin_bank['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($biaya_admin_bank,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorR ?>"><?php echo $evaluasi_biaya_admin_bank < 0 ? "(".number_format(-$evaluasi_biaya_admin_bank,0,',','.').")" : number_format($evaluasi_biaya_admin_bank,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">19.</th>			
				<th align="left" class="table-border-pojok-tengah">Biaya Persiapan</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rap_biaya_persiapan['total'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($biaya_persiapan,0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan" style="<?php echo $styleColorS ?>"><?php echo $evaluasi_biaya_persiapan < 0 ? "(".number_format(-$evaluasi_biaya_persiapan,0,',','.').")" : number_format($evaluasi_biaya_persiapan,0,',','.');?></th>
	        </tr>
			<tr class="table-total2">
				<th align="center" colspan="2" class="table-border-spesial-kiri">TOTAL</th>
				<th align="right" class="table-border-spesial-tengah"><?php echo number_format($total_rap,0,',','.');?></th>
				<th align="right" class="table-border-spesial-tengah"><?php echo number_format($total_realisasi,0,',','.');?></th>
				<th align="right" class="table-border-spesial-kanan" style="<?php echo $styleColorT ?>"><?php echo $total_evaluasi < 0 ? "(".number_format(-$total_evaluasi,0,',','.').")" : number_format($total_evaluasi,0,',','.');?></th>
	        </tr>
	    </table>
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<table width="98%" border="0" cellpadding="30">
			<tr >
				<td width="5%"></td>
				<td width="90%">
					<table width="100%" border="0" cellpadding="2">
						<tr>
							<td align="center" >
								Disetujui Oleh
							</td>
							<td align="center">
								Dibuat Oleh
							</td>
						</tr>
						<tr class="">
							<td align="center" height="55px">
							
							</td>
							<td align="center">
								
							</td>
						</tr>
						<tr>
							<td align="center">
								<b><u>Deddy Sarwobiso</u><br />
								Direktur Utama</b>
							</td>
							<td align="center">
								<b><u>Tri Wahyu Rahadi</u><br />
								Ka. Plant</b>
							</td>
						</tr>
					</table>
				</td>
				<td width="5%"></td>
			</tr>
		</table>
	</body>
</html>