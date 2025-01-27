<!DOCTYPE html>
<html>
	<head>
	  <title>LAPORAN RENCANA KERJA PRODUKSI</title>
	  
	  <style type="text/css">
		body {
			font-family: helvetica;
			font-size: 5px;
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
			color: black;
		}
			
		table tr.table-baris1{
			background-color: none;
		}

		table tr.table-baris1-bold{
			background-color: none;
			font-weight: bold;
		}
			
		table tr.table-total{
			background-color: #FFFF00;
			font-weight: bold;
			color: black;
		}

		table tr.table-total2{
			background-color: #eeeeee;
			font-weight: bold;
			color: black;
		}
	  </style>

	</head>
	<body>
	<div align="center" style="display: block;font-weight: bold;font-size: 8px;">Laporan Rencana Kerja</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 8px;">Proyek Bendungan Tugu</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 8px;">PT. Bia Bumi Jayendra</div>
		<br /><br /><br /><br />
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
		
		<table width="98%" border="0" cellpadding="3" border="0">
		
		<?php
			$date_agustus24_awal = date('2024-08-01');
			$date_agustus24_akhir = date('2024-08-31');
			$date_september24_awal = date('2024-09-01');
			$date_september24_akhir = date('2024-09-30');
			$date_oktober24_awal = date('2024-10-01');
			$date_oktober24_akhir = date('2024-10-31');
			$date_november24_awal = date('2024-11-01');
			$date_november24_akhir = date('2024-11-30');
			$date_desember24_awal = date('2024-12-01');
			$date_desember24_akhir = date('2024-12-31');

			//BETON K-300 SLUMP 10
			$rak_1_K300 = $this->db->select('*, SUM(vol_produk_a) as vol_produk_a')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir'")
			->get()->row_array();
			$rak_1_vol_K300 = $rak_1_K300['vol_produk_a'];
			$rak_1_nilai_K300 = $rak_1_vol_K300 * $rak_1_K300['price_a'];

			$rak_2_K300 = $this->db->select('*, SUM(vol_produk_a) as vol_produk_a')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_september24_awal' and '$date_september24_akhir'")
			->get()->row_array();
			$rak_2_vol_K300 = $rak_2_K300['vol_produk_a'];
			$rak_2_nilai_K300 = $rak_2_vol_K300 * $rak_2_K300['price_a'];

			$rak_3_K300 = $this->db->select('*, SUM(vol_produk_a) as vol_produk_a')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_oktober24_awal' and '$date_oktober24_akhir'")
			->get()->row_array();
			$rak_3_vol_K300 = $rak_3_K300['vol_produk_a'];
			$rak_3_nilai_K300 = $rak_3_vol_K300 * $rak_3_K300['price_a'];

			$rak_4_K300 = $this->db->select('*, SUM(vol_produk_a) as vol_produk_a')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_november24_awal' and '$date_november24_akhir'")
			->get()->row_array();
			$rak_4_vol_K300 = $rak_4_K300['vol_produk_a'];
			$rak_4_nilai_K300 = $rak_4_vol_K300 * $rak_4_K300['price_a'];

			$rak_5_K300 = $this->db->select('*, SUM(vol_produk_a) as vol_produk_a')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_desember24_awal' and '$date_desember24_akhir'")
			->get()->row_array();
			$rak_5_vol_K300 = $rak_5_K300['vol_produk_a'];
			$rak_5_nilai_K300 = $rak_5_vol_K300 * $rak_5_K300['price_a'];

			$jumlah_vol_K300 = $rak_1_vol_K300 + $rak_2_vol_K300 + $rak_3_vol_K300 + $rak_4_vol_K300 + $rak_5_vol_K300;
			$jumlah_nilai_K300 = $rak_1_nilai_K300 + $rak_2_nilai_K300 + $rak_3_nilai_K300 + $rak_4_nilai_K300 + $rak_5_nilai_K300;
			
			//BETON K-300 SLUMP 18
			$rak_1_K300_18 = $this->db->select('*, SUM(vol_produk_b) as vol_produk_b')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir'")
			->get()->row_array();
			$rak_1_vol_K300_18 = $rak_1_K300_18['vol_produk_b'];
			$rak_1_nilai_K300_18 = $rak_1_vol_K300_18 * $rak_1_K300_18['price_b'];

			$rak_2_K300_18 = $this->db->select('*, SUM(vol_produk_b) as vol_produk_b')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_september24_awal' and '$date_september24_akhir'")
			->get()->row_array();
			$rak_2_vol_K300_18 = $rak_2_K300_18['vol_produk_b'];
			$rak_2_nilai_K300_18 = $rak_2_vol_K300_18 * $rak_2_K300_18['price_b'];

			$rak_3_K300_18 = $this->db->select('*, SUM(vol_produk_b) as vol_produk_b')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_oktober24_awal' and '$date_oktober24_akhir'")
			->get()->row_array();
			$rak_3_vol_K300_18 = $rak_3_K300_18['vol_produk_b'];
			$rak_3_nilai_K300_18 = $rak_3_vol_K300_18 * $rak_3_K300_18['price_b'];

			$rak_4_K300_18 = $this->db->select('*, SUM(vol_produk_b) as vol_produk_b')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_november24_awal' and '$date_november24_akhir'")
			->get()->row_array();
			$rak_4_vol_K300_18 = $rak_4_K300_18['vol_produk_b'];
			$rak_4_nilai_K300_18 = $rak_4_vol_K300_18 * $rak_4_K300_18['price_b'];

			$rak_5_K300_18 = $this->db->select('*, SUM(vol_produk_b) as vol_produk_b')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_desember24_awal' and '$date_desember24_akhir'")
			->get()->row_array();
			$rak_5_vol_K300_18 = $rak_5_K300_18['vol_produk_b'];
			$rak_5_nilai_K300_18 = $rak_5_vol_K300_18 * $rak_5_K300_18['price_b'];

			$jumlah_vol_K300_18 = $rak_1_vol_K300_18 + $rak_2_vol_K300_18 + $rak_3_vol_K300_18 + $rak_4_vol_K300_18 + $rak_5_vol_K300_18;
			$jumlah_nilai_K300_18 = $rak_1_nilai_K300_18 + $rak_2_nilai_K300_18 + $rak_3_nilai_K300_18 + $rak_4_nilai_K300_18 + $rak_5_nilai_K300_18;
			
			//KOMPOSISI BAHAN K-300 SLUMP 10
			$komposisi_300_1 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as vol_komposisi_semen, (r.vol_produk_a * pk.presentase_a) * pk.price_a as nilai_komposisi_semen, (r.vol_produk_a * pk.presentase_b) as vol_komposisi_pasir, (r.vol_produk_a * pk.presentase_b) * pk.price_b as nilai_komposisi_pasir, (r.vol_produk_a * pk.presentase_c) as vol_komposisi_batu1020, (r.vol_produk_a * pk.presentase_c) * pk.price_c as nilai_komposisi_batu1020, (r.vol_produk_a * pk.presentase_d) as vol_komposisi_batu2030, (r.vol_produk_a * pk.presentase_d) * pk.price_d as nilai_komposisi_batu2030, (r.vol_produk_a * pk.presentase_e) as vol_komposisi_additive, (r.vol_produk_a * pk.presentase_e) * pk.price_e as nilai_komposisi_additive')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300 = pk.id','left')
			->where("r.tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir'")
			->get()->result_array();

			$total_volume_semen_300_1 = 0;
			$total_nilai_semen_300_1 = 0;

			foreach ($komposisi_300_1 as $x){
				$total_volume_semen_300_1 = $x['vol_komposisi_semen'];
				$total_nilai_semen_300_1 = $x['nilai_komposisi_semen'];
				$total_volume_pasir_300_1 = $x['vol_komposisi_pasir'];
				$total_nilai_pasir_300_1 = $x['nilai_komposisi_pasir'];
				$total_volume_batu1020_300_1 = $x['vol_komposisi_batu1020'];
				$total_nilai_batu1020_300_1 = $x['nilai_komposisi_batu1020'];
				$total_volume_batu2030_300_1 = $x['vol_komposisi_batu2030'];
				$total_nilai_batu2030_300_1 = $x['nilai_komposisi_batu2030'];
				$total_volume_additive_300_1 = $x['vol_komposisi_additive'];
				$total_nilai_additive_300_1 = $x['nilai_komposisi_additive'];
			}

			$komposisi_300_2 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as vol_komposisi_semen, (r.vol_produk_a * pk.presentase_a) * pk.price_a as nilai_komposisi_semen, (r.vol_produk_a * pk.presentase_b) as vol_komposisi_pasir, (r.vol_produk_a * pk.presentase_b) * pk.price_b as nilai_komposisi_pasir, (r.vol_produk_a * pk.presentase_c) as vol_komposisi_batu1020, (r.vol_produk_a * pk.presentase_c) * pk.price_c as nilai_komposisi_batu1020, (r.vol_produk_a * pk.presentase_d) as vol_komposisi_batu2030, (r.vol_produk_a * pk.presentase_d) * pk.price_d as nilai_komposisi_batu2030, (r.vol_produk_a * pk.presentase_e) as vol_komposisi_additive, (r.vol_produk_a * pk.presentase_e) * pk.price_e as nilai_komposisi_additive')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300 = pk.id','left')
			->where("r.tanggal_rencana_kerja between '$date_september24_awal' and '$date_september24_akhir'")
			->get()->result_array();

			$total_volume_semen_300_2 = 0;
			$total_nilai_semen_300_2 = 0;

			foreach ($komposisi_300_2 as $x){
				$total_volume_semen_300_2 = $x['vol_komposisi_semen'];
				$total_nilai_semen_300_2 = $x['nilai_komposisi_semen'];
				$total_volume_pasir_300_2 = $x['vol_komposisi_pasir'];
				$total_nilai_pasir_300_2 = $x['nilai_komposisi_pasir'];
				$total_volume_batu1020_300_2 = $x['vol_komposisi_batu1020'];
				$total_nilai_batu1020_300_2 = $x['nilai_komposisi_batu1020'];
				$total_volume_batu2030_300_2 = $x['vol_komposisi_batu2030'];
				$total_nilai_batu2030_300_2 = $x['nilai_komposisi_batu2030'];
				$total_volume_additive_300_2 = $x['vol_komposisi_additive'];
				$total_nilai_additive_300_2 = $x['nilai_komposisi_additive'];
			}

			$komposisi_300_3 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as vol_komposisi_semen, (r.vol_produk_a * pk.presentase_a) * pk.price_a as nilai_komposisi_semen, (r.vol_produk_a * pk.presentase_b) as vol_komposisi_pasir, (r.vol_produk_a * pk.presentase_b) * pk.price_b as nilai_komposisi_pasir, (r.vol_produk_a * pk.presentase_c) as vol_komposisi_batu1020, (r.vol_produk_a * pk.presentase_c) * pk.price_c as nilai_komposisi_batu1020, (r.vol_produk_a * pk.presentase_d) as vol_komposisi_batu2030, (r.vol_produk_a * pk.presentase_d) * pk.price_d as nilai_komposisi_batu2030, (r.vol_produk_a * pk.presentase_e) as vol_komposisi_additive, (r.vol_produk_a * pk.presentase_e) * pk.price_e as nilai_komposisi_additive')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300 = pk.id','left')
			->where("r.tanggal_rencana_kerja between '$date_oktober24_awal' and '$date_oktober24_akhir'")
			->get()->result_array();

			$total_volume_semen_300_3 = 0;
			$total_nilai_semen_300_3 = 0;

			foreach ($komposisi_300_3 as $x){
				$total_volume_semen_300_3 = $x['vol_komposisi_semen'];
				$total_nilai_semen_300_3 = $x['nilai_komposisi_semen'];
				$total_volume_pasir_300_3 = $x['vol_komposisi_pasir'];
				$total_nilai_pasir_300_3 = $x['nilai_komposisi_pasir'];
				$total_volume_batu1020_300_3 = $x['vol_komposisi_batu1020'];
				$total_nilai_batu1020_300_3 = $x['nilai_komposisi_batu1020'];
				$total_volume_batu2030_300_3 = $x['vol_komposisi_batu2030'];
				$total_nilai_batu2030_300_3 = $x['nilai_komposisi_batu2030'];
				$total_volume_additive_300_3 = $x['vol_komposisi_additive'];
				$total_nilai_additive_300_3 = $x['nilai_komposisi_additive'];
			}

			$komposisi_300_4 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as vol_komposisi_semen, (r.vol_produk_a * pk.presentase_a) * pk.price_a as nilai_komposisi_semen, (r.vol_produk_a * pk.presentase_b) as vol_komposisi_pasir, (r.vol_produk_a * pk.presentase_b) * pk.price_b as nilai_komposisi_pasir, (r.vol_produk_a * pk.presentase_c) as vol_komposisi_batu1020, (r.vol_produk_a * pk.presentase_c) * pk.price_c as nilai_komposisi_batu1020, (r.vol_produk_a * pk.presentase_d) as vol_komposisi_batu2030, (r.vol_produk_a * pk.presentase_d) * pk.price_d as nilai_komposisi_batu2030, (r.vol_produk_a * pk.presentase_e) as vol_komposisi_additive, (r.vol_produk_a * pk.presentase_e) * pk.price_e as nilai_komposisi_additive')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300 = pk.id','left')
			->where("r.tanggal_rencana_kerja between '$date_november24_awal' and '$date_november24_akhir'")
			->get()->result_array();

			$total_volume_semen_300_4 = 0;
			$total_nilai_semen_300_4 = 0;

			foreach ($komposisi_300_4 as $x){
				$total_volume_semen_300_4 = $x['vol_komposisi_semen'];
				$total_nilai_semen_300_4 = $x['nilai_komposisi_semen'];
				$total_volume_pasir_300_4 = $x['vol_komposisi_pasir'];
				$total_nilai_pasir_300_4 = $x['nilai_komposisi_pasir'];
				$total_volume_batu1020_300_4 = $x['vol_komposisi_batu1020'];
				$total_nilai_batu1020_300_4 = $x['nilai_komposisi_batu1020'];
				$total_volume_batu2030_300_4 = $x['vol_komposisi_batu2030'];
				$total_nilai_batu2030_300_4 = $x['nilai_komposisi_batu2030'];
				$total_volume_additive_300_4 = $x['vol_komposisi_additive'];
				$total_nilai_additive_300_4 = $x['nilai_komposisi_additive'];
			}

			$komposisi_300_5 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as vol_komposisi_semen, (r.vol_produk_a * pk.presentase_a) * pk.price_a as nilai_komposisi_semen, (r.vol_produk_a * pk.presentase_b) as vol_komposisi_pasir, (r.vol_produk_a * pk.presentase_b) * pk.price_b as nilai_komposisi_pasir, (r.vol_produk_a * pk.presentase_c) as vol_komposisi_batu1020, (r.vol_produk_a * pk.presentase_c) * pk.price_c as nilai_komposisi_batu1020, (r.vol_produk_a * pk.presentase_d) as vol_komposisi_batu2030, (r.vol_produk_a * pk.presentase_d) * pk.price_d as nilai_komposisi_batu2030, (r.vol_produk_a * pk.presentase_e) as vol_komposisi_additive, (r.vol_produk_a * pk.presentase_e) * pk.price_e as nilai_komposisi_additive')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300 = pk.id','left')
			->where("r.tanggal_rencana_kerja between '$date_desember24_awal' and '$date_desember24_akhir'")
			->get()->result_array();

			$total_volume_semen_300_5 = 0;
			$total_nilai_semen_300_5 = 0;

			foreach ($komposisi_300_5 as $x){
				$total_volume_semen_300_5 = $x['vol_komposisi_semen'];
				$total_nilai_semen_300_5 = $x['nilai_komposisi_semen'];
				$total_volume_pasir_300_5 = $x['vol_komposisi_pasir'];
				$total_nilai_pasir_300_5 = $x['nilai_komposisi_pasir'];
				$total_volume_batu1020_300_5 = $x['vol_komposisi_batu1020'];
				$total_nilai_batu1020_300_5 = $x['nilai_komposisi_batu1020'];
				$total_volume_batu2030_300_5 = $x['vol_komposisi_batu2030'];
				$total_nilai_batu2030_300_5 = $x['nilai_komposisi_batu2030'];
				$total_volume_additive_300_5 = $x['vol_komposisi_additive'];
				$total_nilai_additive_300_5 = $x['nilai_komposisi_additive'];
			}

			//KOMPOSISI BAHAN K-300 SLUMP 18
			$komposisi_300_18_1 = $this->db->select('(r.vol_produk_b * pk.presentase_a) as vol_komposisi_semen, (r.vol_produk_b * pk.presentase_a) * pk.price_a as nilai_komposisi_semen, (r.vol_produk_b * pk.presentase_b) as vol_komposisi_pasir, (r.vol_produk_b * pk.presentase_b) * pk.price_b as nilai_komposisi_pasir, (r.vol_produk_b * pk.presentase_c) as vol_komposisi_batu1020, (r.vol_produk_b * pk.presentase_c) * pk.price_c as nilai_komposisi_batu1020, (r.vol_produk_b * pk.presentase_d) as vol_komposisi_batu2030, (r.vol_produk_b * pk.presentase_d) * pk.price_d as nilai_komposisi_batu2030, (r.vol_produk_b * pk.presentase_e) as vol_komposisi_additive, (r.vol_produk_b * pk.presentase_e) * pk.price_e as nilai_komposisi_additive')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300_18 = pk.id','left')
			->where("r.tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir'")
			->get()->result_array();

			$total_volume_semen_300_18_1 = 0;
			$total_nilai_semen_300_18_1 = 0;

			foreach ($komposisi_300_18_1 as $x){
				$total_volume_semen_300_18_1 = $x['vol_komposisi_semen'];
				$total_nilai_semen_300_18_1 = $x['nilai_komposisi_semen'];
				$total_volume_pasir_300_18_1 = $x['vol_komposisi_pasir'];
				$total_nilai_pasir_300_18_1 = $x['nilai_komposisi_pasir'];
				$total_volume_batu1020_300_18_1 = $x['vol_komposisi_batu1020'];
				$total_nilai_batu1020_300_18_1 = $x['nilai_komposisi_batu1020'];
				$total_volume_batu2030_300_18_1 = $x['vol_komposisi_batu2030'];
				$total_nilai_batu2030_300_18_1 = $x['nilai_komposisi_batu2030'];
				$total_volume_additive_300_18_1 = $x['vol_komposisi_additive'];
				$total_nilai_additive_300_18_1 = $x['nilai_komposisi_additive'];
			}

			$komposisi_300_18_2 = $this->db->select('(r.vol_produk_b * pk.presentase_a) as vol_komposisi_semen, (r.vol_produk_b * pk.presentase_a) * pk.price_a as nilai_komposisi_semen, (r.vol_produk_b * pk.presentase_b) as vol_komposisi_pasir, (r.vol_produk_b * pk.presentase_b) * pk.price_b as nilai_komposisi_pasir, (r.vol_produk_b * pk.presentase_c) as vol_komposisi_batu1020, (r.vol_produk_b * pk.presentase_c) * pk.price_c as nilai_komposisi_batu1020, (r.vol_produk_b * pk.presentase_d) as vol_komposisi_batu2030, (r.vol_produk_b * pk.presentase_d) * pk.price_d as nilai_komposisi_batu2030, (r.vol_produk_b * pk.presentase_e) as vol_komposisi_additive, (r.vol_produk_b * pk.presentase_e) * pk.price_e as nilai_komposisi_additive')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300_18 = pk.id','left')
			->where("r.tanggal_rencana_kerja between '$date_september24_awal' and '$date_september24_akhir'")
			->get()->result_array();

			$total_volume_semen_300_18_2 = 0;
			$total_nilai_semen_300_18_2 = 0;

			foreach ($komposisi_300_18_2 as $x){
				$total_volume_semen_300_18_2 = $x['vol_komposisi_semen'];
				$total_nilai_semen_300_18_2 = $x['nilai_komposisi_semen'];
				$total_volume_pasir_300_18_2 = $x['vol_komposisi_pasir'];
				$total_nilai_pasir_300_18_2 = $x['nilai_komposisi_pasir'];
				$total_volume_batu1020_300_18_2 = $x['vol_komposisi_batu1020'];
				$total_nilai_batu1020_300_18_2 = $x['nilai_komposisi_batu1020'];
				$total_volume_batu2030_300_18_2 = $x['vol_komposisi_batu2030'];
				$total_nilai_batu2030_300_18_2 = $x['nilai_komposisi_batu2030'];
				$total_volume_additive_300_18_2 = $x['vol_komposisi_additive'];
				$total_nilai_additive_300_18_2 = $x['nilai_komposisi_additive'];
			}

			$komposisi_300_18_3 = $this->db->select('(r.vol_produk_b * pk.presentase_a) as vol_komposisi_semen, (r.vol_produk_b * pk.presentase_a) * pk.price_a as nilai_komposisi_semen, (r.vol_produk_b * pk.presentase_b) as vol_komposisi_pasir, (r.vol_produk_b * pk.presentase_b) * pk.price_b as nilai_komposisi_pasir, (r.vol_produk_b * pk.presentase_c) as vol_komposisi_batu1020, (r.vol_produk_b * pk.presentase_c) * pk.price_c as nilai_komposisi_batu1020, (r.vol_produk_b * pk.presentase_d) as vol_komposisi_batu2030, (r.vol_produk_b * pk.presentase_d) * pk.price_d as nilai_komposisi_batu2030, (r.vol_produk_b * pk.presentase_e) as vol_komposisi_additive, (r.vol_produk_b * pk.presentase_e) * pk.price_e as nilai_komposisi_additive')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300_18 = pk.id','left')
			->where("r.tanggal_rencana_kerja between '$date_oktober24_awal' and '$date_oktober24_akhir'")
			->get()->result_array();

			$total_volume_semen_300_18_3 = 0;
			$total_nilai_semen_300_18_3 = 0;

			foreach ($komposisi_300_18_3 as $x){
				$total_volume_semen_300_18_3 = $x['vol_komposisi_semen'];
				$total_nilai_semen_300_18_3 = $x['nilai_komposisi_semen'];
				$total_volume_pasir_300_18_3 = $x['vol_komposisi_pasir'];
				$total_nilai_pasir_300_18_3 = $x['nilai_komposisi_pasir'];
				$total_volume_batu1020_300_18_3 = $x['vol_komposisi_batu1020'];
				$total_nilai_batu1020_300_18_3 = $x['nilai_komposisi_batu1020'];
				$total_volume_batu2030_300_18_3 = $x['vol_komposisi_batu2030'];
				$total_nilai_batu2030_300_18_3 = $x['nilai_komposisi_batu2030'];
				$total_volume_additive_300_18_3 = $x['vol_komposisi_additive'];
				$total_nilai_additive_300_18_3 = $x['nilai_komposisi_additive'];
			}

			$komposisi_300_18_4 = $this->db->select('(r.vol_produk_b * pk.presentase_a) as vol_komposisi_semen, (r.vol_produk_b * pk.presentase_a) * pk.price_a as nilai_komposisi_semen, (r.vol_produk_b * pk.presentase_b) as vol_komposisi_pasir, (r.vol_produk_b * pk.presentase_b) * pk.price_b as nilai_komposisi_pasir, (r.vol_produk_b * pk.presentase_c) as vol_komposisi_batu1020, (r.vol_produk_b * pk.presentase_c) * pk.price_c as nilai_komposisi_batu1020, (r.vol_produk_b * pk.presentase_d) as vol_komposisi_batu2030, (r.vol_produk_b * pk.presentase_d) * pk.price_d as nilai_komposisi_batu2030, (r.vol_produk_b * pk.presentase_e) as vol_komposisi_additive, (r.vol_produk_b * pk.presentase_e) * pk.price_e as nilai_komposisi_additive')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300_18 = pk.id','left')
			->where("r.tanggal_rencana_kerja between '$date_november24_awal' and '$date_november24_akhir'")
			->get()->result_array();

			$total_volume_semen_300_18_4 = 0;
			$total_nilai_semen_300_18_4 = 0;

			foreach ($komposisi_300_18_4 as $x){
				$total_volume_semen_300_18_4 = $x['vol_komposisi_semen'];
				$total_nilai_semen_300_18_4 = $x['nilai_komposisi_semen'];
				$total_volume_pasir_300_18_4 = $x['vol_komposisi_pasir'];
				$total_nilai_pasir_300_18_4 = $x['nilai_komposisi_pasir'];
				$total_volume_batu1020_300_18_4 = $x['vol_komposisi_batu1020'];
				$total_nilai_batu1020_300_18_4 = $x['nilai_komposisi_batu1020'];
				$total_volume_batu2030_300_18_4 = $x['vol_komposisi_batu2030'];
				$total_nilai_batu2030_300_18_4 = $x['nilai_komposisi_batu2030'];
				$total_volume_additive_300_18_4 = $x['vol_komposisi_additive'];
				$total_nilai_additive_300_18_4 = $x['nilai_komposisi_additive'];
			}

			$komposisi_300_18_5 = $this->db->select('(r.vol_produk_b * pk.presentase_a) as vol_komposisi_semen, (r.vol_produk_b * pk.presentase_a) * pk.price_a as nilai_komposisi_semen, (r.vol_produk_b * pk.presentase_b) as vol_komposisi_pasir, (r.vol_produk_b * pk.presentase_b) * pk.price_b as nilai_komposisi_pasir, (r.vol_produk_b * pk.presentase_c) as vol_komposisi_batu1020, (r.vol_produk_b * pk.presentase_c) * pk.price_c as nilai_komposisi_batu1020, (r.vol_produk_b * pk.presentase_d) as vol_komposisi_batu2030, (r.vol_produk_b * pk.presentase_d) * pk.price_d as nilai_komposisi_batu2030, (r.vol_produk_b * pk.presentase_e) as vol_komposisi_additive, (r.vol_produk_b * pk.presentase_e) * pk.price_e as nilai_komposisi_additive')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300_18 = pk.id','left')
			->where("r.tanggal_rencana_kerja between '$date_desember24_awal' and '$date_desember24_akhir'")
			->get()->result_array();

			$total_volume_semen_300_18_5 = 0;
			$total_nilai_semen_300_18_5 = 0;

			foreach ($komposisi_300_18_5 as $x){
				$total_volume_semen_300_18_5 = $x['vol_komposisi_semen'];
				$total_nilai_semen_300_18_5 = $x['nilai_komposisi_semen'];
				$total_volume_pasir_300_18_5 = $x['vol_komposisi_pasir'];
				$total_nilai_pasir_300_18_5 = $x['nilai_komposisi_pasir'];
				$total_volume_batu1020_300_18_5 = $x['vol_komposisi_batu1020'];
				$total_nilai_batu1020_300_18_5 = $x['nilai_komposisi_batu1020'];
				$total_volume_batu2030_300_18_5 = $x['vol_komposisi_batu2030'];
				$total_nilai_batu2030_300_18_5 = $x['nilai_komposisi_batu2030'];
				$total_volume_additive_300_18_5 = $x['vol_komposisi_additive'];
				$total_nilai_additive_300_18_5 = $x['nilai_komposisi_additive'];
			}
			?>

			<tr class="table-judul">
				<th width="5%" align="center" rowspan="2" style="vertical-align:middle;">NO.</th>
				<th align="center" rowspan="2" style="vertical-align:middle;">URAIAN</th>
				<th align="center" rowspan="2" style="vertical-align:middle;">HARSAT</th>
				<th align="center" rowspan="2" style="vertical-align:middle;">SATUAN</th>
				<th align="center" colspan="2" style="text-transform:uppercase;">AGUSTUS 2024</th>
				<th align="center" colspan="2" style="text-transform:uppercase;">SEPTEMBER 2024</th>
				<th align="center" colspan="2" style="text-transform:uppercase;">OKTOBER 2024</th>
				<th align="center" colspan="2" style="text-transform:uppercase;">NOVEMBER 2024</th>
				<th align="center" colspan="2" style="text-transform:uppercase;">DESEMBER 2024</th>
				<th align="center" colspan="2">JUMLAH</th>
	        </tr>
			<tr class="table-judul">
				<th align="center" ><b>VOL.</b></th>
				<th align="center" ><b>NILAI</b></th>
				<th align="center" ><b>VOL.</b></th>
				<th align="center" ><b>NILAI</b></th>
				<th align="center" ><b>VOL.</b></th>
				<th align="center" ><b>NILAI</b></th>
				<th align="center" ><b>VOL.</b></th>
				<th align="center" ><b>NILAI</b></th>
				<th align="center" ><b>VOL.</b></th>
				<th align="center" ><b>NILAI</b></th>
				<th align="center" ><b>VOL.</b></th>
				<th align="center" ><b>NILAI</b></th>
			</tr>
			<tr class="table-baris">
				<th align="left" colspan="16"><b>A. PENDAPATAN USAHA</b></th>
			</tr>
			<tr class="table-baris">
				<th align="center">1.</th>
				<th align="left">Beton K 300 (10±2)</th>
				<th align="right"><?php echo number_format(1065000,0,',','.');?></th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($rak_1_vol_K300,2,',','.');?></th>
				<th align="right"><?php echo number_format($rak_1_nilai_K300,0,',','.');?></th>
				<th align="right"><?php echo number_format($rak_2_vol_K300,2,',','.');?></th>
				<th align="right"><?php echo number_format($rak_2_nilai_K300,0,',','.');?></th>
				<th align="right"><?php echo number_format($rak_3_vol_K300,2,',','.');?></th>
				<th align="right"><?php echo number_format($rak_3_nilai_K300,0,',','.');?></th>
				<th align="right"><?php echo number_format($rak_4_vol_K300,2,',','.');?></th>
				<th align="right"><?php echo number_format($rak_4_nilai_K300,0,',','.');?></th>
				<th align="right"><?php echo number_format($rak_5_vol_K300,2,',','.');?></th>
				<th align="right"><?php echo number_format($rak_5_nilai_K300,0,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_vol_K300,2,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_nilai_K300,0,',','.');?></th>
			</tr>
			<tr class="table-baris">
				<th align="center">2.</th>
				<th align="left">Beton K 300 (18±2)</th>
				<th align="right"><?php echo number_format(1075000,0,',','.');?></th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($rak_1_vol_K300_18,2,',','.');?></th>
				<th align="right"><?php echo number_format($rak_1_nilai_K300_18,0,',','.');?></th>
				<th align="right"><?php echo number_format($rak_2_vol_K300_18,2,',','.');?></th>
				<th align="right"><?php echo number_format($rak_2_nilai_K300_18,0,',','.');?></th>
				<th align="right"><?php echo number_format($rak_3_vol_K300_18,2,',','.');?></th>
				<th align="right"><?php echo number_format($rak_3_nilai_K300_18,0,',','.');?></th>
				<th align="right"><?php echo number_format($rak_4_vol_K300_18,2,',','.');?></th>
				<th align="right"><?php echo number_format($rak_4_nilai_K300_18,0,',','.');?></th>
				<th align="right"><?php echo number_format($rak_5_vol_K300_18,2,',','.');?></th>
				<th align="right"><?php echo number_format($rak_5_nilai_K300_18,0,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_vol_K300_18,2,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_nilai_K300_18,0,',','.');?></th>
			</tr>
			<?php
			$jumlah_1 = $rak_1_vol_K300 + $rak_1_vol_K300_18;
			$jumlah_2 = $rak_1_nilai_K300 + $rak_1_nilai_K300_18;
			$jumlah_3 = $rak_2_vol_K300 + $rak_2_vol_K300_18;
			$jumlah_4 = $rak_2_nilai_K300 + $rak_2_nilai_K300_18;
			$jumlah_5 = $rak_3_vol_K300 + $rak_3_vol_K300_18;
			$jumlah_6 = $rak_3_nilai_K300 + $rak_3_nilai_K300_18;
			$jumlah_7 = $rak_4_vol_K300 + $rak_4_vol_K300_18;
			$jumlah_8 = $rak_4_nilai_K300 + $rak_4_nilai_K300_18;
			$jumlah_9 = $rak_5_vol_K300_18 + $rak_5_vol_K300_18;
			$jumlah_10 = $rak_5_nilai_K300 + $rak_5_nilai_K300_18;
			$jumlah_11 = $jumlah_vol_K300 + $jumlah_vol_K300_18;
			$jumlah_12 = $jumlah_nilai_K300 + $jumlah_nilai_K300_18;
			?>
			<tr class="table-total">
				<th align="right" colspan="4">JUMLAH</th>
				<th align="right"><?php echo number_format($jumlah_1,2,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_2,0,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_3,2,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_4,0,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_5,2,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_6,0,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_7,2,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_8,0,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_9,2,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_10,0,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_11,2,',','.');?></th>
				<th align="right"><?php echo number_format($jumlah_12,0,',','.');?></th>
			</tr>
			<?php
			$total_volume_semen_300 = $total_volume_semen_300_1 + $total_volume_semen_300_2 + $total_volume_semen_300_3 + $total_volume_semen_300_4 + $total_volume_semen_300_5;
			$total_nilai_semen_300 = $total_nilai_semen_300_1 + $total_nilai_semen_300_2 + $total_nilai_semen_300_3 + $total_nilai_semen_300_4 + $total_nilai_semen_300_5;
			
			//HARSAT RAP
			$harsat_rap_beton = $this->db->select('*')
			->from('pmm_agregat')
			->order_by('id','desc')->limit(1)
			->get()->row_array();
			$harsat_rap_beton_semen = $harsat_rap_beton['price_a'];
			$harsat_rap_beton_pasir = $harsat_rap_beton['price_b'];
			$harsat_rap_beton_batu1020 = $harsat_rap_beton['price_c'];
			$harsat_rap_beton_batu2030 = $harsat_rap_beton['price_d'];
			$harsat_rap_beton_additive = $harsat_rap_beton['price_e'];
				
			$total_volume_pasir_300 = $total_volume_pasir_300_1 + $total_volume_pasir_300_2 + $total_volume_pasir_300_3 + $total_volume_pasir_300_4 + $total_volume_pasir_300_5;
			$total_nilai_pasir_300 = $total_nilai_pasir_300_1 + $total_nilai_pasir_300_2 + $total_nilai_pasir_300_3 + $total_nilai_pasir_300_4 + $total_nilai_pasir_300_5;
			
			$total_volume_batu1020_300 = $total_volume_batu1020_300_1 + $total_volume_batu1020_300_2 + $total_volume_batu1020_300_3 + $total_volume_batu1020_300_4 + $total_volume_batu1020_300_5;
			$total_nilai_batu1020_300 = $total_nilai_batu1020_300_1 + $total_nilai_batu1020_300_2 + $total_nilai_batu1020_300_3 + $total_nilai_batu1020_300_4 + $total_nilai_batu1020_300_5;
			
			$total_volume_batu2030_300 = $total_volume_batu2030_300_1 + $total_volume_batu2030_300_2 + $total_volume_batu2030_300_3 + $total_volume_batu2030_300_4 + $total_volume_batu2030_300_5;
			$total_nilai_batu2030_300 = $total_nilai_batu2030_300_1 + $total_nilai_batu2030_300_2 + $total_nilai_batu2030_300_3 + $total_nilai_batu2030_300_4 + $total_nilai_batu2030_300_5;
			
			$total_volume_additive_300 = $total_volume_additive_300_1 + $total_volume_additive_300_2 + $total_volume_additive_300_3 + $total_volume_additive_300_4 + $total_volume_additive_300_5;
			$total_nilai_additive_300 = $total_nilai_additive_300_1 + $total_nilai_additive_300_2 + $total_nilai_additive_300_3 + $total_nilai_additive_300_4 + $total_nilai_additive_300_5;
			
			$jumlah_bahan_1 = $total_nilai_semen_300_1 + $total_nilai_pasir_300_1 + $total_nilai_batu1020_300_1 + $total_nilai_batu2030_300_1 + $total_nilai_additive_300_1;
			$jumlah_bahan_2 = $total_nilai_semen_300_2 + $total_nilai_pasir_300_2 + $total_nilai_batu1020_300_2 + $total_nilai_batu2030_300_2 + $total_nilai_additive_300_2;
			$jumlah_bahan_3 = $total_nilai_semen_300_3 + $total_nilai_pasir_300_3 + $total_nilai_batu1020_300_3 + $total_nilai_batu2030_300_3 + $total_nilai_additive_300_3;
			$jumlah_bahan_4 = $total_nilai_semen_300_4 + $total_nilai_pasir_300_4 + $total_nilai_batu1020_300_4 + $total_nilai_batu2030_300_4 + $total_nilai_additive_300_4;
			$jumlah_bahan_5 = $total_nilai_semen_300_5 + $total_nilai_pasir_300_5 + $total_nilai_batu1020_300_5 + $total_nilai_batu2030_300_5 + $total_nilai_additive_300_5;
			$jumlah_bahan_300 = $total_nilai_semen_300 + $total_nilai_pasir_300 + $total_nilai_batu1020_300 + $total_nilai_batu2030_300 + $total_nilai_additive_300;
			
			$total_volume_semen_300_18 = $total_volume_semen_300_18_1 + $total_volume_semen_300_18_2 + $total_volume_semen_300_18_3 + $total_volume_semen_300_18_4 + $total_volume_semen_300_18_5;
			$total_nilai_semen_300_18 = $total_nilai_semen_300_18_1 + $total_nilai_semen_300_18_2 + $total_nilai_semen_300_18_3 + $total_nilai_semen_300_18_4 + $total_nilai_semen_300_18_5;
			
			$total_volume_pasir_300_18 = $total_volume_pasir_300_18_1 + $total_volume_pasir_300_18_2 + $total_volume_pasir_300_18_3 + $total_volume_pasir_300_18_4 + $total_volume_pasir_300_18_5;
			$total_nilai_pasir_300_18 = $total_nilai_pasir_300_18_1 + $total_nilai_pasir_300_18_2 + $total_nilai_pasir_300_18_3 + $total_nilai_pasir_300_18_4 + $total_nilai_pasir_300_18_5;
			
			$total_volume_batu1020_300_18 = $total_volume_batu1020_300_18_1 + $total_volume_batu1020_300_18_2 + $total_volume_batu1020_300_18_3 + $total_volume_batu1020_300_18_4 + $total_volume_batu1020_300_18_5;
			$total_nilai_batu1020_300_18 = $total_nilai_batu1020_300_18_1 + $total_nilai_batu1020_300_18_2 + $total_nilai_batu1020_300_18_3 + $total_nilai_batu1020_300_18_4 + $total_nilai_batu1020_300_18_5;
			
			$total_volume_batu2030_300_18 = $total_volume_batu2030_300_18_1 + $total_volume_batu2030_300_18_2 + $total_volume_batu2030_300_18_3 + $total_volume_batu2030_300_18_4 + $total_volume_batu2030_300_18_5;
			$total_nilai_batu2030_300_18 = $total_nilai_batu2030_300_18_1 + $total_nilai_batu2030_300_18_2 + $total_nilai_batu2030_300_18_3 + $total_nilai_batu2030_300_18_4 + $total_nilai_batu2030_300_18_5;
			
			$total_volume_additive_300_18 = $total_volume_additive_300_18_1 + $total_volume_additive_300_18_2 + $total_volume_additive_300_18_3 + $total_volume_additive_300_18_4 + $total_volume_additive_300_18_5;
			$total_nilai_additive_300_18 = $total_nilai_additive_300_18_1 + $total_nilai_additive_300_18_2 + $total_nilai_additive_300_18_3 + $total_nilai_additive_300_18_4 + $total_nilai_additive_300_18_5;
			
			$jumlah_bahan2_1 = $total_nilai_semen_300_18_1 + $total_nilai_pasir_300_18_1 + $total_nilai_batu1020_300_18_1 + $total_nilai_batu2030_300_18_1 + $total_nilai_additive_300_18_1;
			$jumlah_bahan2_2 = $total_nilai_semen_300_18_2 + $total_nilai_pasir_300_18_2 + $total_nilai_batu1020_300_18_2 + $total_nilai_batu2030_300_18_2 + $total_nilai_additive_300_18_2;
			$jumlah_bahan2_3 = $total_nilai_semen_300_18_3 + $total_nilai_pasir_300_18_3 + $total_nilai_batu1020_300_18_3 + $total_nilai_batu2030_300_18_3 + $total_nilai_additive_300_18_3;
			$jumlah_bahan2_4 = $total_nilai_semen_300_18_4 + $total_nilai_pasir_300_18_4 + $total_nilai_batu1020_300_18_4 + $total_nilai_batu2030_300_18_4 + $total_nilai_additive_300_18_4;
			$jumlah_bahan2_5 = $total_nilai_semen_300_18_5 + $total_nilai_pasir_300_18_5 + $total_nilai_batu1020_300_18_5 + $total_nilai_batu2030_300_18_5 + $total_nilai_additive_300_18_5;
			$jumlah_bahan_300_18 = $total_nilai_semen_300_18 + $total_nilai_pasir_300_18 + $total_nilai_batu1020_300_18 + $total_nilai_batu2030_300_18 + $total_nilai_additive_300_18;
			?>
			<tr class="table-baris">
				<th align="left" colspan="16"><b>B. TOTAL KEBUTUHAN BAHAN</b></th>
			</tr>
			<tr class="table-baris">
				<?php
				$realisasi_1 = $this->db->select('*')
				->from('rak')
				->where("tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir'")
				->get()->row_array();
				$vol_realisasi_semen_1 = $realisasi_1['vol_realisasi_a'];
				$nilai_realisasi_semen_1 = $realisasi_1['nilai_realisasi_a'];
				$total_volume_semen_300_1_all = (($total_volume_semen_300_1 + $total_volume_semen_300_18_1) * $realisasi_1['realisasi']) + $vol_realisasi_semen_1;
				$total_nilai_semen_300_1_all = (($total_nilai_semen_300_1 + $total_nilai_semen_300_18_1) * $realisasi_1['realisasi']) + $nilai_realisasi_semen_1;
				
				$vol_realisasi_pasir_1 = $realisasi_1['vol_realisasi_b'];
				$nilai_realisasi_pasir_1 = $realisasi_1['nilai_realisasi_b'];
				$total_volume_pasir_300_1_all = (($total_volume_pasir_300_1 + $total_volume_pasir_300_18_1) * $realisasi_1['realisasi']) + $vol_realisasi_pasir_1;
				$total_nilai_pasir_300_1_all = (($total_nilai_pasir_300_1 + $total_nilai_pasir_300_18_1) * $realisasi_1['realisasi']) + $nilai_realisasi_pasir_1;

				$vol_realisasi_batu1020_1 = $realisasi_1['vol_realisasi_c'];
				$nilai_realisasi_batu1020_1 = $realisasi_1['nilai_realisasi_c'];
				$total_volume_batu1020_300_1_all = (($total_volume_batu1020_300_1 + $total_volume_batu1020_300_18_1) * $realisasi_1['realisasi']) + $vol_realisasi_batu1020_1;
				$total_nilai_batu1020_300_1_all = (($total_nilai_batu1020_300_1 + $total_nilai_batu1020_300_18_1) * $realisasi_1['realisasi']) + $nilai_realisasi_batu1020_1;

				$vol_realisasi_batu2030_1 = $realisasi_1['vol_realisasi_d'];
				$nilai_realisasi_batu2030_1 = $realisasi_1['nilai_realisasi_d'];
				$total_volume_batu2030_300_1_all = (($total_volume_batu2030_300_1 + $total_volume_batu2030_300_18_1) * $realisasi_1['realisasi']) + $vol_realisasi_batu2030_1;
				$total_nilai_batu2030_300_1_all = (($total_nilai_batu2030_300_1 + $total_nilai_batu2030_300_18_1) * $realisasi_1['realisasi']) + $nilai_realisasi_batu2030_1;

				$vol_realisasi_additive_1 = $realisasi_1['vol_realisasi_e'];
				$nilai_realisasi_additive_1 = $realisasi_1['nilai_realisasi_e'];
				$total_volume_additive_300_1_all = (($total_volume_additive_300_1 + $total_volume_additive_300_18_1) * $realisasi_1['realisasi']) + $vol_realisasi_additive_1;
				$total_nilai_additive_300_1_all = (($total_nilai_additive_300_1 + $total_nilai_additive_300_18_1) * $realisasi_1['realisasi']) + $nilai_realisasi_additive_1;

				$realisasi_2 = $this->db->select('*')
				->from('rak')
				->where("tanggal_rencana_kerja between '$date_september24_awal' and '$date_september24_akhir'")
				->get()->row_array();
				$vol_realisasi_semen_2 = $realisasi_2['vol_realisasi_a'];
				$nilai_realisasi_semen_2 = $realisasi_2['nilai_realisasi_a'];
				$total_volume_semen_300_2_all = (($total_volume_semen_300_2 + $total_volume_semen_300_18_2) * $realisasi_2['realisasi']) + $vol_realisasi_semen_2;
				$total_nilai_semen_300_2_all = (($total_nilai_semen_300_2 + $total_nilai_semen_300_18_2) * $realisasi_2['realisasi']) + $nilai_realisasi_semen_2;

				$vol_realisasi_pasir_2 = $realisasi_2['vol_realisasi_b'];
				$nilai_realisasi_pasir_2 = $realisasi_2['nilai_realisasi_b'];
				$total_volume_pasir_300_2_all = (($total_volume_pasir_300_2 + $total_volume_pasir_300_18_2) * $realisasi_2['realisasi']) + $vol_realisasi_pasir_2;
				$total_nilai_pasir_300_2_all = (($total_nilai_pasir_300_2 + $total_nilai_pasir_300_18_2) * $realisasi_2['realisasi']) + $nilai_realisasi_pasir_2;

				$vol_realisasi_batu1020_2 = $realisasi_2['vol_realisasi_c'];
				$nilai_realisasi_batu1020_2 = $realisasi_2['nilai_realisasi_c'];
				$total_volume_batu1020_300_2_all = (($total_volume_batu1020_300_2 + $total_volume_batu1020_300_18_2) * $realisasi_2['realisasi']) + $vol_realisasi_batu1020_2;
				$total_nilai_batu1020_300_2_all = (($total_nilai_batu1020_300_2 + $total_nilai_batu1020_300_18_2) * $realisasi_2['realisasi']) + $nilai_realisasi_batu1020_2;

				$vol_realisasi_batu2030_2 = $realisasi_2['vol_realisasi_d'];
				$nilai_realisasi_batu2030_2 = $realisasi_2['nilai_realisasi_d'];
				$total_volume_batu2030_300_2_all = (($total_volume_batu2030_300_2 + $total_volume_batu2030_300_18_2) * $realisasi_2['realisasi']) + $vol_realisasi_batu2030_2;
				$total_nilai_batu2030_300_2_all = (($total_nilai_batu2030_300_2 + $total_nilai_batu2030_300_18_2) * $realisasi_2['realisasi']) + $nilai_realisasi_batu2030_2;

				$vol_realisasi_additive_2 = $realisasi_2['vol_realisasi_e'];
				$nilai_realisasi_additive_2 = $realisasi_2['nilai_realisasi_e'];
				$total_volume_additive_300_2_all = (($total_volume_additive_300_2 + $total_volume_additive_300_18_2) * $realisasi_2['realisasi']) + $vol_realisasi_additive_2;
				$total_nilai_additive_300_2_all = (($total_nilai_additive_300_2 + $total_nilai_additive_300_18_2) * $realisasi_2['realisasi']) + $nilai_realisasi_additive_2;
		
				$realisasi_3 = $this->db->select('*')
				->from('rak')
				->where("tanggal_rencana_kerja between '$date_oktober24_awal' and '$date_oktober24_akhir'")
				->get()->row_array();
				$vol_realisasi_semen_3 = $realisasi_3['vol_realisasi_a'];
				$nilai_realisasi_semen_3 = $realisasi_3['nilai_realisasi_a'];
				$total_volume_semen_300_3_all = (($total_volume_semen_300_3 + $total_volume_semen_300_18_3) * $realisasi_3['realisasi']) + $vol_realisasi_semen_3;
				$total_nilai_semen_300_3_all = (($total_nilai_semen_300_3 + $total_nilai_semen_300_18_3) * $realisasi_3['realisasi'] + $nilai_realisasi_semen_3);

				$vol_realisasi_pasir_3 = $realisasi_3['vol_realisasi_b'];
				$nilai_realisasi_pasir_3 = $realisasi_3['nilai_realisasi_b'];
				$total_volume_pasir_300_3_all = (($total_volume_pasir_300_3 + $total_volume_pasir_300_18_3) * $realisasi_3['realisasi']) + $vol_realisasi_pasir_3;
				$total_nilai_pasir_300_3_all = (($total_nilai_pasir_300_3 + $total_nilai_pasir_300_18_3) * $realisasi_3['realisasi'] + $nilai_realisasi_pasir_3);

				$vol_realisasi_batu1020_3 = $realisasi_3['vol_realisasi_c'];
				$nilai_realisasi_batu1020_3 = $realisasi_3['nilai_realisasi_c'];
				$total_volume_batu1020_300_3_all = (($total_volume_batu1020_300_3 + $total_volume_batu1020_300_18_3) * $realisasi_3['realisasi']) + $vol_realisasi_batu1020_3;
				$total_nilai_batu1020_300_3_all = (($total_nilai_batu1020_300_3 + $total_nilai_batu1020_300_18_3) * $realisasi_3['realisasi'] + $nilai_realisasi_batu1020_3);

				$vol_realisasi_batu2030_3 = $realisasi_3['vol_realisasi_d'];
				$nilai_realisasi_batu2030_3 = $realisasi_3['nilai_realisasi_d'];
				$total_volume_batu2030_300_3_all = (($total_volume_batu2030_300_3 + $total_volume_batu2030_300_18_3) * $realisasi_3['realisasi']) + $vol_realisasi_batu2030_3;
				$total_nilai_batu2030_300_3_all = (($total_nilai_batu2030_300_3 + $total_nilai_batu2030_300_18_3) * $realisasi_3['realisasi'] + $nilai_realisasi_batu2030_3);

				$vol_realisasi_additive_3 = $realisasi_3['vol_realisasi_e'];
				$nilai_realisasi_additive_3 = $realisasi_3['nilai_realisasi_e'];
				$total_volume_additive_300_3_all = (($total_volume_additive_300_3 + $total_volume_additive_300_18_3) * $realisasi_3['realisasi']) + $vol_realisasi_additive_3;
				$total_nilai_additive_300_3_all = (($total_nilai_additive_300_3 + $total_nilai_additive_300_18_3) * $realisasi_3['realisasi'] + $nilai_realisasi_additive_3);

				$realisasi_4 = $this->db->select('*')
				->from('rak')
				->where("tanggal_rencana_kerja between '$date_november24_awal' and '$date_november24_akhir'")
				->get()->row_array();
				$vol_realisasi_semen_4 = $realisasi_4['vol_realisasi_a'];
				$nilai_realisasi_semen_4 = $realisasi_4['nilai_realisasi_a'];
				$total_volume_semen_300_4_all = (($total_volume_semen_300_4 + $total_volume_semen_300_18_4) * $realisasi_4['realisasi']) + $vol_realisasi_semen_4;
				$total_nilai_semen_300_4_all = (($total_nilai_semen_300_4 + $total_nilai_semen_300_18_4) * $realisasi_4['realisasi']) + $nilai_realisasi_semen_4;

				$vol_realisasi_pasir_4 = $realisasi_4['vol_realisasi_b'];
				$nilai_realisasi_pasir_4 = $realisasi_4['nilai_realisasi_b'];
				$total_volume_pasir_300_4_all = (($total_volume_pasir_300_4 + $total_volume_pasir_300_18_4) * $realisasi_4['realisasi']) + $vol_realisasi_pasir_4;
				$total_nilai_pasir_300_4_all = (($total_nilai_pasir_300_4 + $total_nilai_pasir_300_18_4) * $realisasi_4['realisasi']) + $nilai_realisasi_pasir_4;

				$vol_realisasi_batu1020_4 = $realisasi_4['vol_realisasi_c'];
				$nilai_realisasi_batu1020_4 = $realisasi_4['nilai_realisasi_c'];
				$total_volume_batu1020_300_4_all = (($total_volume_batu1020_300_4 + $total_volume_batu1020_300_18_4) * $realisasi_4['realisasi']) + $vol_realisasi_batu1020_4;
				$total_nilai_batu1020_300_4_all = (($total_nilai_batu1020_300_4 + $total_nilai_batu1020_300_18_4) * $realisasi_4['realisasi']) + $nilai_realisasi_batu1020_4;

				$vol_realisasi_batu2030_4 = $realisasi_4['vol_realisasi_d'];
				$nilai_realisasi_batu2030_4 = $realisasi_4['nilai_realisasi_d'];
				$total_volume_batu2030_300_4_all = (($total_volume_batu2030_300_4 + $total_volume_batu2030_300_18_4) * $realisasi_4['realisasi']) + $vol_realisasi_batu2030_4;
				$total_nilai_batu2030_300_4_all = (($total_nilai_batu2030_300_4 + $total_nilai_batu2030_300_18_4) * $realisasi_4['realisasi']) + $nilai_realisasi_batu2030_4;

				$vol_realisasi_additive_4 = $realisasi_4['vol_realisasi_e'];
				$nilai_realisasi_additive_4 = $realisasi_4['nilai_realisasi_e'];
				$total_volume_additive_300_4_all = (($total_volume_additive_300_4 + $total_volume_additive_300_18_4) * $realisasi_4['realisasi']) + $vol_realisasi_additive_4;
				$total_nilai_additive_300_4_all = (($total_nilai_additive_300_4 + $total_nilai_additive_300_18_4) * $realisasi_4['realisasi']) + $nilai_realisasi_additive_4;

				$realisasi_5 = $this->db->select('*')
				->from('rak')
				->where("tanggal_rencana_kerja between '$date_desember24_awal' and '$date_desember24_akhir'")
				->get()->row_array();
				$vol_realisasi_semen_5 = $realisasi_5['vol_realisasi_a'];
				$nilai_realisasi_semen_5 = $realisasi_5['nilai_realisasi_a'];
				$total_volume_semen_300_5_all = (($total_volume_semen_300_5 + $total_volume_semen_300_18_5) * $realisasi_5['realisasi']) + $vol_realisasi_semen_5;
				$total_nilai_semen_300_5_all = (($total_nilai_semen_300_5 + $total_nilai_semen_300_18_5) * $realisasi_5['realisasi']) + $nilai_realisasi_semen_5;

				$vol_realisasi_pasir_5 = $realisasi_5['vol_realisasi_b'];
				$nilai_realisasi_pasir_5 = $realisasi_5['nilai_realisasi_b'];
				$total_volume_pasir_300_5_all = (($total_volume_pasir_300_5 + $total_volume_pasir_300_18_5) * $realisasi_5['realisasi']) + $vol_realisasi_pasir_5;
				$total_nilai_pasir_300_5_all = (($total_nilai_pasir_300_5 + $total_nilai_pasir_300_18_5) * $realisasi_5['realisasi']) + $nilai_realisasi_pasir_5;
				
				$vol_realisasi_batu1020_5 = $realisasi_5['vol_realisasi_c'];
				$nilai_realisasi_batu1020_5 = $realisasi_5['nilai_realisasi_c'];
				$total_volume_batu1020_300_5_all = (($total_volume_batu1020_300_5 + $total_volume_batu1020_300_18_5) * $realisasi_5['realisasi']) + $vol_realisasi_batu1020_5;
				$total_nilai_batu1020_300_5_all = (($total_nilai_batu1020_300_5 + $total_nilai_batu1020_300_18_5) * $realisasi_5['realisasi']) + $nilai_realisasi_batu1020_5;

				$vol_realisasi_batu2030_5 = $realisasi_5['vol_realisasi_d'];
				$nilai_realisasi_batu2030_5 = $realisasi_5['nilai_realisasi_d'];
				$total_volume_batu2030_300_5_all = (($total_volume_batu2030_300_5 + $total_volume_batu2030_300_18_5) * $realisasi_5['realisasi']) + $vol_realisasi_batu2030_5;
				$total_nilai_batu2030_300_5_all = (($total_nilai_batu2030_300_5 + $total_nilai_batu2030_300_18_5) * $realisasi_5['realisasi']) + $nilai_realisasi_batu2030_5;

				$vol_realisasi_additive_5 = $realisasi_5['vol_realisasi_e'];
				$nilai_realisasi_additive_5 = $realisasi_5['nilai_realisasi_e'];
				$total_volume_additive_300_5_all = (($total_volume_additive_300_5 + $total_volume_additive_300_18_5) * $realisasi_5['realisasi']) + $vol_realisasi_additive_5;
				$total_nilai_additive_300_5_all = (($total_nilai_additive_300_5 + $total_nilai_additive_300_18_5) * $realisasi_5['realisasi']) + $nilai_realisasi_additive_5;
				?>
				<th align="center"></th>
				<th align="left">Semen</th>
				<th align="right"><?php echo number_format($harsat_rap_beton_semen,0,',','.');?></th>
				<th align="center">Ton</th>
				<th align="right"><?php echo number_format($total_volume_semen_300_1_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_semen_300_1_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_semen_300_2_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_semen_300_2_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_semen_300_3_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_semen_300_3_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_semen_300_4_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_semen_300_4_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_semen_300_5_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_semen_300_5_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_semen_300_1_all + $total_volume_semen_300_2_all + $total_volume_semen_300_3_all + $total_volume_semen_300_4_all + $total_volume_semen_300_5_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_semen_300_1_all + $total_nilai_semen_300_2_all + $total_nilai_semen_300_3_all + $total_nilai_semen_300_4_all + $total_volume_semen_300_5_all,0,',','.');?></th>
			</tr>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Pasir</th>
				<th align="right"><?php echo number_format($harsat_rap_beton_pasir,0,',','.');?></th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($total_volume_pasir_300_1_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_pasir_300_1_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_pasir_300_2_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_pasir_300_2_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_pasir_300_3_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_pasir_300_3_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_pasir_300_4_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_pasir_300_4_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_pasir_300_5_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_pasir_300_5_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_pasir_300_1_all + $total_volume_pasir_300_2_all + $total_volume_pasir_300_3_all + $total_volume_pasir_300_4_all + $total_volume_pasir_300_5_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_pasir_300_1_all + $total_nilai_pasir_300_2_all + $total_nilai_pasir_300_3_all + $total_nilai_pasir_300_4_all + $total_nilai_pasir_300_5_all,0,',','.');?></th>
			</tr>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Batu Split 10 - 20</th>
				<th align="right"><?php echo number_format($harsat_rap_beton_batu1020,0,',','.');?></th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($total_volume_batu1020_300_1_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu1020_300_1_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_batu1020_300_2_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu1020_300_2_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_batu1020_300_3_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu1020_300_3_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_batu1020_300_4_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu1020_300_4_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_batu1020_300_5_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu1020_300_5_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_batu1020_300_1_all + $total_volume_batu1020_300_2_all + $total_volume_batu1020_300_3_all + $total_volume_batu1020_300_4_all + $total_volume_batu1020_300_5_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu1020_300_1_all + $total_nilai_batu1020_300_2_all + $total_nilai_batu1020_300_3_all + $total_nilai_batu1020_300_4_all + $total_nilai_batu1020_300_5_all,0,',','.');?></th>
			</tr>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Batu Split 20 - 30</th>
				<th align="right"><?php echo number_format($harsat_rap_beton_batu2030,0,',','.');?></th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($total_volume_batu2030_300_1_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu2030_300_1_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_batu2030_300_2_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu2030_300_2_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_batu2030_300_3_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu2030_300_3_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_batu2030_300_4_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu2030_300_4_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_batu2030_300_5_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu2030_300_5_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_batu2030_300_1_all + $total_volume_batu2030_300_2_all + $total_volume_batu2030_300_3_all + $total_volume_batu2030_300_4_all + $total_volume_batu2030_300_5_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_batu2030_300_1_all + $total_nilai_batu2030_300_2_all + $total_nilai_batu2030_300_3_all + $total_nilai_batu2030_300_4_all + $total_nilai_batu2030_300_5_all,0,',','.');?></th>
			</tr>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Additive</th>
				<th align="right"><?php echo number_format($harsat_rap_beton_additive,0,',','.');?></th>
				<th align="center">Liter</th>
				<th align="right"><?php echo number_format($total_volume_additive_300_1_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_additive_300_1_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_additive_300_2_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_additive_300_2_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_additive_300_3_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_additive_300_3_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_additive_300_4_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_additive_300_4_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_additive_300_5_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_additive_300_5_all,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_additive_300_1_all + $total_volume_additive_300_2_all + $total_volume_additive_300_3_all + $total_volume_additive_300_4_all + $total_volume_additive_300_5_all,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_additive_300_1_all + $total_nilai_additive_300_2_all + $total_nilai_additive_300_3_all + $total_nilai_additive_300_4_all + $total_nilai_additive_300_5_all,0,',','.');?></th>
			</tr>
			<tr class="table-total">
				<?php
				$jumlah_kebutuhan_bahan_1 = $total_nilai_semen_300_1_all + $total_nilai_pasir_300_1_all + $total_nilai_batu1020_300_1_all +  $total_nilai_batu2030_300_1_all + $total_nilai_additive_300_1_all;
				$jumlah_kebutuhan_bahan_2 = $total_nilai_semen_300_2_all + $total_nilai_pasir_300_2_all + $total_nilai_batu1020_300_2_all +  $total_nilai_batu2030_300_2_all + $total_nilai_additive_300_2_all;
				$jumlah_kebutuhan_bahan_3 = $total_nilai_semen_300_3_all + $total_nilai_pasir_300_3_all + $total_nilai_batu1020_300_3_all +  $total_nilai_batu2030_300_3_all + $total_nilai_additive_300_3_all;
				$jumlah_kebutuhan_bahan_4 = $total_nilai_semen_300_4_all + $total_nilai_pasir_300_4_all + $total_nilai_batu1020_300_4_all +  $total_nilai_batu2030_300_4_all + $total_nilai_additive_300_4_all;
				$jumlah_kebutuhan_bahan_5 = $total_nilai_semen_300_5_all + $total_nilai_pasir_300_5_all + $total_nilai_batu1020_300_5_all +  $total_nilai_batu2030_300_5_all + $total_nilai_additive_300_5_all;
				?>
				<th align="right" colspan="4">JUMLAH</th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_kebutuhan_bahan_1,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_kebutuhan_bahan_2,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_kebutuhan_bahan_3,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_kebutuhan_bahan_4,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_kebutuhan_bahan_5,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_bahan_300 + $jumlah_bahan_300_18,0,',','.');?></th>
			</tr>
			<?php
			$volume_rak_1 = $this->db->select('*, sum(vol_produk_a + vol_produk_b) as volume')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir'")
			->get()->row_array();

			$volume_rak_2 = $this->db->select('*, sum(vol_produk_a + vol_produk_b) as volume')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_september24_awal' and '$date_september24_akhir'")
			->get()->row_array();

			$volume_rak_3 = $this->db->select('*, sum(vol_produk_a + vol_produk_b) as volume')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_oktober24_awal' and '$date_oktober24_akhir'")
			->get()->row_array();

			$volume_rak_4 = $this->db->select('*, sum(vol_produk_a + vol_produk_b) as volume')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_november24_awal' and '$date_november24_akhir'")
			->get()->row_array();

			$volume_rak_5 = $this->db->select('*, sum(vol_produk_a + vol_produk_b) as volume')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_desember24_awal' and '$date_desember24_akhir'")
			->get()->row_array();

			$harsat_rap_alat = $this->db->select('*')
			->from('rap_alat')
			->order_by('id','desc')->limit(1)
			->get()->row_array();
			$harsat_rap_alat_bp = $harsat_rap_alat['batching_plant'];
			$harsat_rap_alat_tm = $harsat_rap_alat['truck_mixer'];
			$harsat_rap_alat_wl = $harsat_rap_alat['wheel_loader'];
			$harsat_rap_alat_solar = $harsat_rap_alat['bbm_solar'];

			$total_volume_bp_1 = $volume_rak_1['volume'];
			$total_volume_bp_2 = $volume_rak_2['volume'];
			$total_volume_bp_3 = $volume_rak_3['volume'];
			$total_volume_bp_4 = $volume_rak_4['volume'];
			$total_volume_bp_5 = $volume_rak_5['volume'];
			
			$total_nilai_bp_1 = $volume_rak_1['volume'] * $harsat_rap_alat_bp;
			$total_nilai_bp_2 = $volume_rak_2['volume'] * $harsat_rap_alat_bp;
			$total_nilai_bp_3 = $volume_rak_3['volume'] * $harsat_rap_alat_bp;
			$total_nilai_bp_4 = $volume_rak_4['volume'] * $harsat_rap_alat_bp;
			$total_nilai_bp_5 = $volume_rak_5['volume'] * $harsat_rap_alat_bp;

			$total_volume_tm_1 = $volume_rak_1['volume'];
			$total_volume_tm_2 = $volume_rak_2['volume'];
			$total_volume_tm_3 = $volume_rak_3['volume'];
			$total_volume_tm_4 = $volume_rak_4['volume'];
			$total_volume_tm_5 = $volume_rak_5['volume'];

			$total_nilai_tm_1 = $volume_rak_1['volume'] * $harsat_rap_alat_tm;
			$total_nilai_tm_2 = $volume_rak_2['volume'] * $harsat_rap_alat_tm;
			$total_nilai_tm_3 = $volume_rak_3['volume'] * $harsat_rap_alat_tm;
			$total_nilai_tm_4 = $volume_rak_4['volume'] * $harsat_rap_alat_tm;
			$total_nilai_tm_5 = $volume_rak_5['volume'] * $harsat_rap_alat_tm;

			$total_volume_wl_1 = $volume_rak_1['volume'];
			$total_volume_wl_2 = $volume_rak_2['volume'];
			$total_volume_wl_3 = $volume_rak_3['volume'];
			$total_volume_wl_4 = $volume_rak_4['volume'];
			$total_volume_wl_5 = $volume_rak_5['volume'];

			$total_nilai_wl_1 = $volume_rak_1['volume'] * $harsat_rap_alat_wl;
			$total_nilai_wl_2 = $volume_rak_2['volume'] * $harsat_rap_alat_wl;
			$total_nilai_wl_3 = $volume_rak_3['volume'] * $harsat_rap_alat_wl;
			$total_nilai_wl_4 = $volume_rak_4['volume'] * $harsat_rap_alat_wl;
			$total_nilai_wl_5 = $volume_rak_5['volume'] * $harsat_rap_alat_wl;

			$total_volume_solar_1 = $volume_rak_1['volume'];
			$total_volume_solar_2 = $volume_rak_2['volume'];
			$total_volume_solar_3 = $volume_rak_3['volume'];
			$total_volume_solar_4 = $volume_rak_4['volume'];
			$total_volume_solar_5 = $volume_rak_5['volume'];

			$total_nilai_solar_1 = $volume_rak_1['volume'] * $harsat_rap_alat_solar;
			$total_nilai_solar_2 = $volume_rak_2['volume'] * $harsat_rap_alat_solar;
			$total_nilai_solar_3 = $volume_rak_3['volume'] * $harsat_rap_alat_solar;
			$total_nilai_solar_4 = $volume_rak_4['volume'] * $harsat_rap_alat_solar;
			$total_nilai_solar_5 = $volume_rak_5['volume'] * $harsat_rap_alat_solar;
			?>
			<tr class="table-baris">
				<th align="left" colspan="16"><b>C. TOTAL BIAYA PERALATAN</b></th>
			</tr>
			<?php
			$realisasi_1 = $this->db->select('*')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir'")
			->get()->row_array();
			$vol_realisasi_bp_1 = $realisasi_1['vol_realisasi_bp'];
			$nilai_realisasi_bp_1 = $realisasi_1['nilai_realisasi_bp'];
			$vol_realisasi_bp_1 = ($total_volume_bp_1 * $realisasi_1['realisasi']) + $vol_realisasi_bp_1;
			$nilai_realisasi_bp_1 = ($total_nilai_bp_1 * $realisasi_1['realisasi']) + $nilai_realisasi_bp_1;

			$vol_realisasi_tm_1 = $realisasi_1['vol_realisasi_tm'];
			$nilai_realisasi_tm_1 = $realisasi_1['nilai_realisasi_tm'];
			$vol_realisasi_tm_1 = ($total_volume_tm_1 * $realisasi_1['realisasi']) + $vol_realisasi_tm_1;
			$nilai_realisasi_tm_1 = ($total_nilai_tm_1 * $realisasi_1['realisasi']) + $nilai_realisasi_tm_1;

			$vol_realisasi_wl_1 = $realisasi_1['vol_realisasi_wl'];
			$nilai_realisasi_wl_1 = $realisasi_1['nilai_realisasi_wl'];
			$vol_realisasi_wl_1 = ($total_volume_wl_1 * $realisasi_1['realisasi']) + $vol_realisasi_wl_1;
			$nilai_realisasi_wl_1 = ($total_nilai_wl_1 * $realisasi_1['realisasi']) + $nilai_realisasi_wl_1;

			$vol_realisasi_solar_1 = $realisasi_1['vol_realisasi_solar'];
			$nilai_realisasi_solar_1 = $realisasi_1['nilai_realisasi_solar'];
			$vol_realisasi_solar_1 = ($total_volume_solar_1 * $realisasi_1['realisasi']) + $vol_realisasi_solar_1;
			$nilai_realisasi_solar_1 = ($total_nilai_solar_1 * $realisasi_1['realisasi']) + $nilai_realisasi_solar_1;

			$nilai_realisasi_jasa_1 = $realisasi_1['jasa'];

			$realisasi_2 = $this->db->select('*')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_september24_awal' and '$date_september24_akhir'")
			->get()->row_array();
			$vol_realisasi_bp_2 = $realisasi_2['vol_realisasi_bp'];
			$nilai_realisasi_bp_2 = $realisasi_2['nilai_realisasi_bp'];
			$vol_realisasi_bp_2 = ($total_volume_bp_2 * $realisasi_2['realisasi']) + $vol_realisasi_bp_2;
			$nilai_realisasi_bp_2 = ($total_nilai_bp_2 * $realisasi_2['realisasi']) + $nilai_realisasi_bp_2;

			$vol_realisasi_tm_2 = $realisasi_2['vol_realisasi_tm'];
			$nilai_realisasi_tm_2 = $realisasi_2['nilai_realisasi_tm'];
			$vol_realisasi_tm_2 = ($total_volume_tm_2 * $realisasi_2['realisasi']) + $vol_realisasi_tm_2;
			$nilai_realisasi_tm_2 = ($total_nilai_tm_2 * $realisasi_2['realisasi']) + $nilai_realisasi_tm_2;

			$vol_realisasi_wl_2 = $realisasi_2['vol_realisasi_wl'];
			$nilai_realisasi_wl_2 = $realisasi_2['nilai_realisasi_wl'];
			$vol_realisasi_wl_2 = ($total_volume_wl_2 * $realisasi_2['realisasi']) + $vol_realisasi_wl_2;
			$nilai_realisasi_wl_2 = ($total_nilai_wl_2 * $realisasi_2['realisasi']) + $nilai_realisasi_wl_2;

			$vol_realisasi_solar_2 = $realisasi_2['vol_realisasi_solar'];
			$nilai_realisasi_solar_2 = $realisasi_2['nilai_realisasi_solar'];
			$vol_realisasi_solar_2 = ($total_volume_solar_2 * $realisasi_2['realisasi']) + $vol_realisasi_solar_2;
			$nilai_realisasi_solar_2 = ($total_nilai_solar_2 * $realisasi_2['realisasi']) + $nilai_realisasi_solar_2;

			$nilai_realisasi_jasa_2 = $realisasi_2['jasa'];

			$realisasi_3 = $this->db->select('*')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_oktober24_awal' and '$date_oktober24_akhir'")
			->get()->row_array();
			$vol_realisasi_bp_3 = $realisasi_3['vol_realisasi_bp'];
			$nilai_realisasi_bp_3 = $realisasi_3['nilai_realisasi_bp'];
			$vol_realisasi_bp_3 = ($total_volume_bp_3 * $realisasi_3['realisasi']) + $vol_realisasi_bp_3;
			$nilai_realisasi_bp_3 = ($total_nilai_bp_3 * $realisasi_3['realisasi']) + $nilai_realisasi_bp_3;

			$vol_realisasi_tm_3 = $realisasi_3['vol_realisasi_tm'];
			$nilai_realisasi_tm_3 = $realisasi_3['nilai_realisasi_tm'];
			$vol_realisasi_tm_3 = ($total_volume_tm_3 * $realisasi_3['realisasi']) + $vol_realisasi_tm_3;
			$nilai_realisasi_tm_3 = ($total_nilai_tm_3 * $realisasi_3['realisasi']) + $nilai_realisasi_tm_3;

			$vol_realisasi_wl_3 = $realisasi_3['vol_realisasi_wl'];
			$nilai_realisasi_wl_3 = $realisasi_3['nilai_realisasi_wl'];
			$vol_realisasi_wl_3 = ($total_volume_wl_3 * $realisasi_3['realisasi']) + $vol_realisasi_wl_3;
			$nilai_realisasi_wl_3 = ($total_nilai_wl_3 * $realisasi_3['realisasi']) + $nilai_realisasi_wl_3;

			$vol_realisasi_solar_3 = $realisasi_3['vol_realisasi_solar'];
			$nilai_realisasi_solar_3 = $realisasi_3['nilai_realisasi_solar'];
			$vol_realisasi_solar_3 = ($total_volume_solar_3 * $realisasi_3['realisasi']) + $vol_realisasi_solar_3;
			$nilai_realisasi_solar_3 = ($total_nilai_solar_3 * $realisasi_3['realisasi']) + $nilai_realisasi_solar_3;

			$nilai_realisasi_jasa_3 = $realisasi_3['jasa'];

			$realisasi_4 = $this->db->select('*')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_november24_awal' and '$date_november24_akhir'")
			->get()->row_array();
			$vol_realisasi_bp_4 = $realisasi_4['vol_realisasi_bp'];
			$nilai_realisasi_bp_4 = $realisasi_4['nilai_realisasi_bp'];
			$vol_realisasi_bp_4 = ($total_volume_bp_4 * $realisasi_4['realisasi']) + $vol_realisasi_bp_4;
			$nilai_realisasi_bp_4 = ($total_nilai_bp_4 * $realisasi_4['realisasi']) + $nilai_realisasi_bp_4;

			$vol_realisasi_tm_4 = $realisasi_4['vol_realisasi_tm'];
			$nilai_realisasi_tm_4 = $realisasi_4['nilai_realisasi_tm'];
			$vol_realisasi_tm_4 = ($total_volume_tm_4 * $realisasi_4['realisasi']) + $vol_realisasi_tm_4;
			$nilai_realisasi_tm_4 = ($total_nilai_tm_4 * $realisasi_4['realisasi']) + $nilai_realisasi_tm_4;

			$vol_realisasi_wl_4 = $realisasi_4['vol_realisasi_wl'];
			$nilai_realisasi_wl_4 = $realisasi_4['nilai_realisasi_wl'];
			$vol_realisasi_wl_4 = ($total_volume_wl_4 * $realisasi_4['realisasi']) + $vol_realisasi_wl_4;
			$nilai_realisasi_wl_4 = ($total_nilai_wl_4 * $realisasi_4['realisasi']) + $nilai_realisasi_wl_4;

			$vol_realisasi_solar_4 = $realisasi_4['vol_realisasi_solar'];
			$nilai_realisasi_solar_4 = $realisasi_4['nilai_realisasi_solar'];
			$vol_realisasi_solar_4 = ($total_volume_solar_4 * $realisasi_4['realisasi']) + $vol_realisasi_solar_4;
			$nilai_realisasi_solar_4 = ($total_nilai_solar_4 * $realisasi_4['realisasi']) + $nilai_realisasi_solar_4;

			$nilai_realisasi_jasa_4 = $realisasi_4['jasa'];

			$realisasi_5 = $this->db->select('*')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_desember24_awal' and '$date_desember24_akhir'")
			->get()->row_array();
			$vol_realisasi_bp_5 = $realisasi_5['vol_realisasi_bp'];
			$nilai_realisasi_bp_5 = $realisasi_5['nilai_realisasi_bp'];
			$vol_realisasi_bp_5 = ($total_volume_bp_5 * $realisasi_5['realisasi']) + $vol_realisasi_bp_5;
			$nilai_realisasi_bp_5 = ($total_nilai_bp_5 * $realisasi_5['realisasi']) + $nilai_realisasi_bp_5;

			$vol_realisasi_tm_5 = $realisasi_5['vol_realisasi_tm'];
			$nilai_realisasi_tm_5 = $realisasi_5['nilai_realisasi_tm'];
			$vol_realisasi_tm_5 = ($total_volume_tm_5 * $realisasi_5['realisasi']) + $vol_realisasi_tm_5;
			$nilai_realisasi_tm_5 = ($total_nilai_tm_5 * $realisasi_5['realisasi']) + $nilai_realisasi_tm_5;

			$vol_realisasi_wl_5 = $realisasi_5['vol_realisasi_wl'];
			$nilai_realisasi_wl_5 = $realisasi_5['nilai_realisasi_wl'];
			$vol_realisasi_wl_5 = ($total_volume_wl_5 * $realisasi_5['realisasi']) + $vol_realisasi_wl_5;
			$nilai_realisasi_wl_5 = ($total_nilai_wl_5 * $realisasi_5['realisasi']) + $nilai_realisasi_wl_5;

			$vol_realisasi_solar_5 = $realisasi_5['vol_realisasi_solar'];
			$nilai_realisasi_solar_5 = $realisasi_5['nilai_realisasi_solar'];
			$vol_realisasi_solar_5 = ($total_volume_solar_5 * $realisasi_5['realisasi']) + $vol_realisasi_solar_5;
			$nilai_realisasi_solar_5 = ($total_nilai_solar_5 * $realisasi_5['realisasi']) + $nilai_realisasi_solar_5;

			$nilai_realisasi_jasa_5 = $realisasi_5['jasa'];
			?>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Batching Plant</th>
				<th align="right"><?php echo number_format($harsat_rap_alat_bp,0,',','.');?></th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($vol_realisasi_bp_1,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_bp_1,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_bp_2,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_bp_2,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_bp_3,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_bp_3,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_bp_4,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_bp_4,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_bp_5,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_bp_5,0,',','.');?></th>
				<?php
				$total_volume_bp = $vol_realisasi_bp_1 + $vol_realisasi_bp_2 + $vol_realisasi_bp_3 + $vol_realisasi_bp_4 + $vol_realisasi_bp_5;
				$total_nilai_bp = $nilai_realisasi_bp_1 + $nilai_realisasi_bp_2 + $nilai_realisasi_bp_3 + $nilai_realisasi_bp_4 + $nilai_realisasi_bp_5;
				?>
				<th align="right"><?php echo number_format($total_volume_bp,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_bp,0,',','.');?></th>
			</tr>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Truck Mixer</th>
				<th align="right"><?php echo number_format($harsat_rap_alat_tm,0,',','.');?></th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($vol_realisasi_tm_1,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_tm_1,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_tm_2,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_tm_2,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_tm_3,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_tm_3,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_tm_4,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_tm_4,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_tm_5,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_tm_5,0,',','.');?></th>
				<?php
				$total_volume_tm = $vol_realisasi_tm_1 + $vol_realisasi_tm_2 + $vol_realisasi_tm_3 + $vol_realisasi_tm_4 + $vol_realisasi_tm_5;
				$total_nilai_tm = $nilai_realisasi_tm_1 + $nilai_realisasi_tm_2 + $nilai_realisasi_tm_3+ $nilai_realisasi_tm_4 + $nilai_realisasi_tm_5;
				?>
				<th align="right"><?php echo number_format($total_volume_tm,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_tm,0,',','.');?></th>
			</tr>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Wheel Loader</th>
				<th align="right"><?php echo number_format($harsat_rap_alat_wl,0,',','.');?></th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($vol_realisasi_wl_1,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_wl_1,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_wl_2,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_wl_2,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_wl_3,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_wl_3,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_wl_4,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_wl_4,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_wl_5,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_wl_5,0,',','.');?></th>
				<?php
				$total_volume_wl = $vol_realisasi_wl_1 + $vol_realisasi_wl_2 + $vol_realisasi_wl_3 + $vol_realisasi_wl_4 + $vol_realisasi_wl_5;
				$total_nilai_wl = $nilai_realisasi_wl_1 + $nilai_realisasi_wl_2 + $nilai_realisasi_wl_3 + $nilai_realisasi_wl_4 + $nilai_realisasi_wl_5;
				?>
				<th align="right"><?php echo number_format($total_volume_wl,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_wl,0,',','.');?></th>
			</tr>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Solar</th>
				<th align="right"><?php echo number_format($harsat_rap_alat_solar,0,',','.');?></th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($vol_realisasi_solar_1,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_solar_1,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_solar_2,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_solar_2,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_solar_3,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_solar_3,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_solar_4,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_solar_4,0,',','.');?></th>
				<th align="right"><?php echo number_format($vol_realisasi_solar_5,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_solar_5,0,',','.');?></th>
				<?php
				$total_volume_solar = $vol_realisasi_solar_1 + $vol_realisasi_solar_2 + $vol_realisasi_solar_3 + $vol_realisasi_solar_4 + $vol_realisasi_solar_5;
				$total_nilai_solar = $nilai_realisasi_solar_1 + $nilai_realisasi_solar_2 + $nilai_realisasi_solar_3 + $nilai_realisasi_solar_4 + $nilai_realisasi_solar_5;
				?>
				<th align="right"><?php echo number_format($total_volume_solar,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_solar,0,',','.');?></th>
			</tr>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Jasa Angkut</th>
				<th align="right"><?php echo number_format(0,0,',','.');?></th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format(0,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_jasa_1,0,',','.');?></th>
				<th align="right"><?php echo number_format(0,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_jasa_2,0,',','.');?></th>
				<th align="right"><?php echo number_format(0,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_jasa_3,0,',','.');?></th>
				<th align="right"><?php echo number_format(0,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_jasa_4,0,',','.');?></th>
				<th align="right"><?php echo number_format(0,2,',','.');?></th>
				<th align="right"><?php echo number_format($nilai_realisasi_jasa_5,0,',','.');?></th>
				<?php
				$total_nilai_jasa = $nilai_realisasi_jasa_1 + $nilai_realisasi_jasa_2 + $nilai_realisasi_jasa_3 + $nilai_realisasi_jasa_4 + $nilai_realisasi_jasa_5;
				?>
				<th align="right"><?php echo number_format($total_volume_jasa,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_jasa,0,',','.');?></th>
			</tr>
			<?php
			$jumlah_alat_1 = $nilai_realisasi_bp_1 + $nilai_realisasi_tm_1 + $nilai_realisasi_wl_1 + $nilai_realisasi_solar_1 + $nilai_realisasi_jasa_1;
			$jumlah_alat_2 = $nilai_realisasi_bp_2 + $nilai_realisasi_tm_2 + $nilai_realisasi_wl_2 + $nilai_realisasi_solar_2 + $nilai_realisasi_jasa_2;
			$jumlah_alat_3 = $nilai_realisasi_bp_3 + $nilai_realisasi_tm_3 + $nilai_realisasi_wl_3 + $nilai_realisasi_solar_3 + $nilai_realisasi_jasa_3;
			$jumlah_alat_4 = $nilai_realisasi_bp_4 + $nilai_realisasi_tm_4 + $nilai_realisasi_wl_4 + $nilai_realisasi_solar_4 + $nilai_realisasi_jasa_4;
			$jumlah_alat_5 = $nilai_realisasi_bp_5 + $nilai_realisasi_tm_5 + $nilai_realisasi_wl_5 + $nilai_realisasi_solar_5 + $nilai_realisasi_jasa_5;
			$jumlah_alat = $total_nilai_bp + $total_nilai_tm + $total_nilai_wl + $total_nilai_solar + $total_nilai_jasa;
			?>
			<tr class="table-total">
				<th align="right" colspan="4">JUMLAH</th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_alat_1,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_alat_2,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_alat_3,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_alat_4,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_alat_5,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_alat,0,',','.');?></th>
			</tr>
			<?php
			$overhead_rak_1 = $this->db->select('sum(overhead) as nilai')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir'")
			->get()->row_array();

			$overhead_rak_2 = $this->db->select('sum(overhead) as nilai')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_september24_awal' and '$date_september24_akhir'")
			->get()->row_array();
			
			$overhead_rak_3 = $this->db->select('sum(overhead) as nilai')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_oktober24_awal' and '$date_oktober24_akhir'")
			->get()->row_array();

			$overhead_rak_4 = $this->db->select('sum(overhead) as nilai')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_november24_awal' and '$date_november24_akhir'")
			->get()->row_array();

			$overhead_rak_5 = $this->db->select('sum(overhead) as nilai')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_desember24_awal' and '$date_desember24_akhir'")
			->get()->row_array();

			$total_nilai_overhead_1 = $overhead_rak_1['nilai'];
			$total_nilai_overhead_2 = $overhead_rak_2['nilai'];
			$total_nilai_overhead_3 = $overhead_rak_3['nilai'];
			$total_nilai_overhead_4 = $overhead_rak_4['nilai'];
			$total_nilai_overhead_5 = $overhead_rak_5['nilai'];
			?>
			<tr class="table-baris">
				<th align="left" colspan="16"><b>D. OVERHEAD</b></th>
			</tr>
			<?php
			$total_nilai_overhead = $total_nilai_overhead_1 + $total_nilai_overhead_2 + $total_nilai_overhead_3 + $total_nilai_overhead_4 + $total_nilai_overhead_5;
			?>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Overhead</th>
				<th align="right"></th>
				<th align="center"></th>
				<th align="right"><?php echo number_format($total_volume_overhead_1,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_overhead_1,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_overhead_2,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_overhead_2,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_overhead_3,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_overhead_3,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_overhead_4,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_overhead_4,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_overhead_5,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_overhead_5,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_overhead,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_overhead,0,',','.');?></th>
			</tr>
			<?php
			$diskonto_rak_1 = $this->db->select('sum(diskonto) as nilai')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_agustus24_awal' and '$date_agustus24_akhir'")
			->get()->row_array();

			$diskonto_rak_2 = $this->db->select('sum(diskonto) as nilai')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_september24_awal' and '$date_september24_akhir'")
			->get()->row_array();
			
			$diskonto_rak_3 = $this->db->select('sum(diskonto) as nilai')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_oktober24_awal' and '$date_oktober24_akhir'")
			->get()->row_array();

			$diskonto_rak_4 = $this->db->select('sum(diskonto) as nilai')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_november24_awal' and '$date_november24_akhir'")
			->get()->row_array();

			$diskonto_rak_5 = $this->db->select('sum(diskonto) as nilai')
			->from('rak')
			->where("tanggal_rencana_kerja between '$date_desember24_awal' and '$date_desember24_akhir'")
			->get()->row_array();

			$total_nilai_diskonto_1 = $diskonto_rak_1['nilai'];
			$total_nilai_diskonto_2 = $diskonto_rak_2['nilai'];
			$total_nilai_diskonto_3 = $diskonto_rak_3['nilai'];
			$total_nilai_diskonto_4 = $diskonto_rak_4['nilai'];
			$total_nilai_diskonto_5 = $diskonto_rak_5['nilai'];
			?>
			<tr class="table-baris">
				<th align="left" colspan="16"><b>E. DISKONTO</b></th>
			</tr>
			<?php
			$total_nilai_diskonto = $total_nilai_diskonto_1 + $total_nilai_diskonto_2 + $total_nilai_diskonto_3 + $total_nilai_diskonto_4 + $total_nilai_diskonto_5;
			?>
			<tr class="table-baris">
				<th align="center"></th>
				<th align="left">Diskonto</th>
				<th align="right"></th>
				<th align="center"></th>
				<th align="right"><?php echo number_format($total_volume_diskonto_1,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_diskonto_1,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_diskonto_2,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_diskonto_2,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_diskonto_3,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_diskonto_3,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_diskonto_4,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_diskonto_4,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_diskonto_5,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_diskonto_5,0,',','.');?></th>
				<th align="right"><?php echo number_format($total_volume_diskonto,2,',','.');?></th>
				<th align="right"><?php echo number_format($total_nilai_diskonto,0,',','.');?></th>
			</tr>
			<?php
			$jumlah_biaya_1 = $jumlah_kebutuhan_bahan_1 + $jumlah_alat_1 + $total_nilai_overhead_1 + $total_nilai_diskonto_1;
			$jumlah_biaya_2 = $jumlah_kebutuhan_bahan_2 + $jumlah_alat_2 + $total_nilai_overhead_2 + $total_nilai_diskonto_2;
			$jumlah_biaya_3 = $jumlah_kebutuhan_bahan_3 + $jumlah_alat_3 + $total_nilai_overhead_3 + $total_nilai_diskonto_3;
			$jumlah_biaya_4 = $jumlah_kebutuhan_bahan_4 + $jumlah_alat_4 + $total_nilai_overhead_4 + $total_nilai_diskonto_4;
			$jumlah_biaya_5 = $jumlah_kebutuhan_bahan_5 + $jumlah_alat_5 + $total_nilai_overhead_5 + $total_nilai_diskonto_5;
			$jumlah_biaya = $jumlah_bahan_300 + $jumlah_bahan_300_18 + $jumlah_alat + $total_nilai_overhead + $total_nilai_diskonto;
			?>
			<tr class="table-total">
				<th align="right" colspan="4">JUMLAH BAHAN + ALAT + OVERHEAD + DISKONTO</th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_biaya_1,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_biaya_2,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_biaya_3,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_biaya_4,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_biaya_5,0,',','.');?></th>
				<th align="right"></th>
				<th align="right"><?php echo number_format($jumlah_biaya,0,',','.');?></th>
			</tr>
		</table>
		<table width="98%" border="0" cellpadding="30">
			<tr >
				<td width="5%"></td>
				<td width="90%">
					<table width="100%" border="0" cellpadding="2">
						<tr>
							<td align="center" >
								Dibuat Oleh
							</td>
							<td align="center" >
								Diperiksa Oleh
							</td>
							<td align="center">
								Diperiksa Oleh
							</td>
							<td align="center">
								Disetujui Oleh
							</td>
						</tr>
						<tr class="">
							<td align="center" height="50px">
								<img src="uploads/ttd_satria.png" width="50px">
							</td>
							<td align="center">
								<img src="uploads/ttd_tri.png" width="50px">
							</td>
							<td align="center">
								<img src="uploads/ttd_erika.png" width="50px">
							</td>
							<td align="center">
								<img src="uploads/ttd_deddy.png" width="50px">
							</td>
						</tr>
						<tr>
							<td align="center">
								<b><u>Satria Widura Drana Wisesa</u><br />
								Produksi</b>
							</td>
							<td align="center">
								<b><u>Tri Wahyu Rahadi</u><br />
								Ka. Plant</b>
							</td>
							<td align="center">
								<b><u>Erika Sinaga</u><br />
								Dir. Keuangan & SDM</b>
							</td>
							<td align="center">
								<b><u>Deddy Sarwobiso</u><br />
								Direktur Utama</b>
							</td>
						</tr>
					</table>
				</td>
				<td width="5%"></td>
			</tr>
		</table>
	</body>
</html>