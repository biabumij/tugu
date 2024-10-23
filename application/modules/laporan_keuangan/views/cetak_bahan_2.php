<!DOCTYPE html>
<html>
	<head>
	  <title>BIAYA (BAHAN)</title>
	  
	  <style type="text/css">
		body {
			font-family: helvetica;
			font-size: 8px;
		}
		table tr.table-judul{
			background-color: #e69500;
			font-weight: bold;
			font-size: 8px;
		}
			
		table tr.table-baris1{
			background-color: #F0F0F0;
			font-size: 8px;
		}
			
		table tr.table-total{
			background-color: #cccccc;
			font-weight: bold;
			font-size: 8px;
		}
	  </style>

	</head>
	<body>
		<?php
		$data = array();
		
		$arr_date = $this->input->get('filter_date');
		$arr_filter_date = explode(' - ', $arr_date);
		$date1 = '';
		$date2 = '';
		$date3 = '';

		if(count($arr_filter_date) == 2){
			$date3 	= date('Y-m-d',strtotime($date3));
			$date1 	= date('Y-m-d',strtotime($arr_filter_date[0]));
			$date2 	= date('Y-m-d',strtotime($arr_filter_date[1]));
			$filter_date = date('d F Y',strtotime($arr_filter_date[0])).' - '.date('d F Y',strtotime($arr_filter_date[1]));
		}
		?>
		<br />
		<br />
		<table width="98%" cellpadding="3">
			<tr>
				<td align="center"  width="100%">
					<div style="display: block;font-weight: bold;font-size: 11px;">BIAYA BAHAN</div>
					<div style="display: block;font-weight: bold;font-size: 11px;">PROYEK BENDUNGAN TUGU</div>
					<div style="display: block;font-weight: bold;font-size: 11px;">PT. BIA BUMI JAYENDRA</div>
					<?php
					function tgl_indo($date2){
						$bulan = array (
							1 =>   'Januari',
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
						$pecahkan = explode('-', $date2);
						
						// variabel pecahkan 0 = tanggal
						// variabel pecahkan 1 = bulan
						// variabel pecahkan 2 = tahun
					
						return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
						
					}
					?>
					<div style="display: block;font-weight: bold;font-size: 11px; text-transform: uppercase;">PERIODE : SD. <?= tgl_indo(date($date2)); ?></div>
				</td>
			</tr>
		</table>
		<br />
		<br />
		<br />
		<table width="98%" cellpadding="5" border="1">

			<!-- TOTAL PEMAKAIAN KOMPOSISI -->
			<?php
			$komposisi = $this->db->select('pp.date_production, (pp.display_volume) * pk.presentase_a as volume_a, (pp.display_volume) * pk.presentase_b as volume_b, (pp.display_volume) * pk.presentase_c as volume_c, (pp.display_volume) * pk.presentase_d as volume_d, (pp.display_volume) * pk.presentase_e as volume_e, (pp.display_volume * pk.presentase_a) * pk.price_a as nilai_a, (pp.display_volume * pk.presentase_b) * pk.price_b as nilai_b, (pp.display_volume * pk.presentase_c) * pk.price_c as nilai_c, (pp.display_volume * pk.presentase_d) * pk.price_d as nilai_d, (pp.display_volume * pk.presentase_e) * pk.price_e as nilai_e')
			->from('pmm_productions pp')
			->join('pmm_agregat pk', 'pp.komposisi_id = pk.id','left')
			->where("pp.date_production between '$date1' and '$date2'")
			->get()->result_array();

			$total_volume_a = 0;
			$total_volume_b = 0;
			$total_volume_c = 0;
			$total_volume_d = 0;
			$total_volume_e = 0;

			$total_nilai_a = 0;
			$total_nilai_b = 0;
			$total_nilai_c = 0;
			$total_nilai_d = 0;
			$total_nilai_e = 0;

			foreach ($komposisi as $x){
				$total_volume_a += $x['volume_a'];
				$total_volume_b += $x['volume_b'];
				$total_volume_c += $x['volume_c'];
				$total_volume_d += $x['volume_d'];
				$total_volume_e += $x['volume_e'];
				$total_nilai_a += $x['nilai_a'];
				$total_nilai_b += $x['nilai_b'];
				$total_nilai_c += $x['nilai_c'];
				$total_nilai_d += $x['nilai_d'];
				$total_nilai_e += $x['nilai_e'];
				
			}

			$volume_a = $total_volume_a;
			$volume_b = $total_volume_b;
			$volume_c = $total_volume_c;
			$volume_d = $total_volume_d;
			$volume_e = $total_volume_e;

			$nilai_a = $total_nilai_a;
			$nilai_b = $total_nilai_b;
			$nilai_c = $total_nilai_c;
			$nilai_d = $total_nilai_d;
			$nilai_e = $total_nilai_e;

			$price_a = ($total_volume_a!=0)?$total_nilai_a / $total_volume_a * 1:0;
			$price_b = ($total_volume_b!=0)?$total_nilai_b / $total_volume_b * 1:0;
			$price_c = ($total_volume_c!=0)?$total_nilai_c / $total_volume_c * 1:0;
			$price_d = ($total_volume_d!=0)?$total_nilai_d / $total_volume_d * 1:0;
			$price_e = ($total_volume_e!=0)?$total_nilai_e / $total_volume_e * 1:0;

			$total_volume_komposisi = $volume_a + $volume_b + $volume_c + $volume_d + $volume_e;
			$total_nilai_komposisi = $nilai_a + $nilai_b + $nilai_c + $nilai_d + $nilai_e;
			
			$date1_ago = date('2020-01-01');
			$date2_ago = date('Y-m-d', strtotime('-1 days', strtotime($date1)));
			$date3_ago = date('Y-m-d', strtotime('-1 months', strtotime($date1)));
			$tanggal_opening_balance = date('Y-m-d', strtotime('-1 days', strtotime($date1)));

			$stock_opname_semen_ago = $this->db->select('cat.volume as volume, cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 1")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$stok_volume_semen_lalu = $stock_opname_semen_ago['volume'];
			$stok_nilai_semen_lalu = $stock_opname_semen_ago['nilai'];
			$stok_harsat_semen_lalu = (round($stok_volume_semen_lalu,2)!=0)?$stok_nilai_semen_lalu / round($stok_volume_semen_lalu,2) * 1:0;

			$pembelian_semen = $this->db->select('prm.display_measure as satuan, SUM(prm.display_volume) as volume, (prm.display_price / prm.display_volume) as harga, SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("prm.date_receipt between '$date1' and '$date2'")
			->where("p.kategori_bahan = 1")
			->get()->row_array();
		
			$pembelian_volume_semen = $pembelian_semen['volume'];
			$pembelian_nilai_semen = $pembelian_semen['nilai'];
			$pembelian_harga_semen = (round($pembelian_volume_semen,2)!=0)?$pembelian_nilai_semen / round($pembelian_volume_semen,2) * 1:0;

			$total_stok_volume_semen = $stok_volume_semen_lalu + $pembelian_volume_semen;
			$total_stok_nilai_semen = $stok_nilai_semen_lalu + $pembelian_nilai_semen;

			$stock_opname_semen_now = $this->db->select('cat.volume as volume, cat.total as nilai, cat.pemakaian_custom, cat.reset, cat.reset_pemakaian')
			->from('pmm_remaining_materials_cat cat')
			->where("(cat.date <= '$date2')")
			->where("cat.material_id = 1")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$volume_stock_opname_semen_now = $stock_opname_semen_now['volume'];
			$nilai_stock_opname_semen_now = $stock_opname_semen_now['nilai'];

			$vol_pemakaian_semen_now = ($stok_volume_semen_lalu + $pembelian_volume_semen) - $volume_stock_opname_semen_now;
			$nilai_pemakaian_semen_now = $stock_opname_semen_now['nilai'];

			$pemakaian_volume_semen_bulan_ini = $vol_pemakaian_semen_now;
			$pemakaian_nilai_semen_bulan_ini = (($total_stok_nilai_semen - $nilai_stock_opname_semen_now) * $stock_opname_semen_now['reset']) + ($stock_opname_semen_now['pemakaian_custom'] * $stock_opname_semen_now['reset_pemakaian']);
			$pemakaian_harsat_semen_bulan_ini = $pemakaian_nilai_semen / $pemakaian_volume_semen;
			
			$stock_opname_pasir_ago = $this->db->select('cat.volume as volume, cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 2")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$stok_volume_pasir_lalu = $stock_opname_pasir_ago['volume'];
			$stok_nilai_pasir_lalu = $stock_opname_pasir_ago['nilai'];
			$stok_harsat_pasir_lalu = (round($stok_volume_pasir_lalu,2)!=0)?$stok_nilai_pasir_lalu / round($stok_volume_pasir_lalu,2) * 1:0;

			$pembelian_pasir = $this->db->select('prm.display_measure as satuan, SUM(prm.display_volume) as volume, (prm.display_price / prm.display_volume) as harga, SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("prm.date_receipt between '$date1' and '$date2'")
			->where("p.kategori_bahan = 2")
			->get()->row_array();
		
			$pembelian_volume_pasir = $pembelian_pasir['volume'];
			$pembelian_nilai_pasir = $pembelian_pasir['nilai'];
			$pembelian_harga_pasir = (round($pembelian_volume_pasir,2)!=0)?$pembelian_nilai_pasir / round($pembelian_volume_pasir,2) * 1:0;

			$total_stok_volume_pasir = $stok_volume_pasir_lalu + $pembelian_volume_pasir;
			$total_stok_nilai_pasir = $stok_nilai_pasir_lalu + $pembelian_nilai_pasir;

			$stock_opname_pasir_now = $this->db->select('cat.volume as volume, cat.total as nilai, cat.pemakaian_custom, cat.reset, cat.reset_pemakaian')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$date2')")
			->where("cat.material_id = 2")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$volume_stock_opname_pasir_now = $stock_opname_pasir_now['volume'];
			$nilai_stock_opname_pasir_now = $stock_opname_pasir_now['nilai'];

			$vol_pemakaian_pasir_now = ($stok_volume_pasir_lalu + $pembelian_volume_pasir) - $volume_stock_opname_pasir_now;
			$nilai_pemakaian_pasir_now = $stock_opname_pasir_now['nilai'];

			$pemakaian_volume_pasir_bulan_ini = $vol_pemakaian_pasir_now;
			$pemakaian_nilai_pasir_bulan_ini = (($total_stok_nilai_pasir - $nilai_stock_opname_pasir_now) * $stock_opname_pasir_now['reset']) + ($stock_opname_pasir_now['pemakaian_custom'] * $stock_opname_pasir_now['reset_pemakaian']);
			$pemakaian_harsat_pasir_bulan_ini = $pemakaian_nilai_pasir / $pemakaian_volume_pasir;

			$stock_opname_1020_ago = $this->db->select('cat.volume as volume, cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 3")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$stok_volume_1020_lalu = $stock_opname_1020_ago['volume'];
			$stok_nilai_1020_lalu = $stock_opname_1020_ago['nilai'];
			$stok_harsat_1020_lalu = (round($stok_volume_1020_lalu,2)!=0)?$stok_nilai_1020_lalu / round($stok_volume_1020_lalu,2) * 1:0;

			$pembelian_1020 = $this->db->select('prm.display_measure as satuan, SUM(prm.display_volume) as volume, (prm.display_price / prm.display_volume) as harga, SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("prm.date_receipt between '$date1' and '$date2'")
			->where("p.kategori_bahan = 3")
			->get()->row_array();
		
			$pembelian_volume_1020 = $pembelian_1020['volume'];
			$pembelian_nilai_1020 = $pembelian_1020['nilai'];
			$pembelian_harga_1020 = (round($pembelian_volume_1020,2)!=0)?$pembelian_nilai_1020 / round($pembelian_volume_1020,2) * 1:0;

			$total_stok_volume_1020 = $stok_volume_1020_lalu + $pembelian_volume_1020;
			$total_stok_nilai_1020 = $stok_nilai_1020_lalu + $pembelian_nilai_1020;

			$stock_opname_1020_now = $this->db->select('cat.volume as volume, cat.total as nilai, cat.pemakaian_custom, cat.reset, cat.reset_pemakaian')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$date2')")
			->where("cat.material_id = 3")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$volume_stock_opname_1020_now = $stock_opname_1020_now['volume'];
			$nilai_stock_opname_1020_now = $stock_opname_1020_now['nilai'];

			$vol_pemakaian_1020_now = ($stok_volume_1020_lalu + $pembelian_volume_1020) - $volume_stock_opname_1020_now;
			$nilai_pemakaian_1020_now = $stock_opname_1020_now['nilai'];

			$pemakaian_volume_1020_bulan_ini = $vol_pemakaian_1020_now;
			$pemakaian_nilai_1020_bulan_ini = (($total_stok_nilai_1020 - $nilai_stock_opname_1020_now) * $stock_opname_1020_now['reset']) + ($stock_opname_1020_now['pemakaian_custom'] * $stock_opname_1020_now['reset_pemakaian']);
			$pemakaian_harsat_1020_bulan_ini = $pemakaian_nilai_1020 / $pemakaian_volume_1020;

			$stock_opname_2030_ago = $this->db->select('cat.volume as volume, cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 4")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$stok_volume_2030_lalu = $stock_opname_2030_ago['volume'];
			$stok_nilai_2030_lalu = $stock_opname_2030_ago['nilai'];
			$stok_harsat_2030_lalu = (round($stok_volume_2030_lalu,2)!=0)?$stok_nilai_2030_lalu / round($stok_volume_2030_lalu,2) * 1:0;

			$pembelian_2030 = $this->db->select('prm.display_measure as satuan, SUM(prm.display_volume) as volume, (prm.display_price / prm.display_volume) as harga, SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("prm.date_receipt between '$date1' and '$date2'")
			->where("p.kategori_bahan = 4")
			->get()->row_array();
		
			$pembelian_volume_2030 = $pembelian_2030['volume'];
			$pembelian_nilai_2030 = $pembelian_2030['nilai'];
			$pembelian_harga_2030 = (round($pembelian_volume_2030,2)!=0)?$pembelian_nilai_2030 / round($pembelian_volume_2030,2) * 1:0;

			$total_stok_volume_2030 = $stok_volume_2030_lalu + $pembelian_volume_2030;
			$total_stok_nilai_2030 = $stok_nilai_2030_lalu + $pembelian_nilai_2030;

			$stock_opname_2030_now = $this->db->select('cat.volume as volume, cat.total as nilai, cat.pemakaian_custom, cat.reset, cat.reset_pemakaian')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$date2')")
			->where("cat.material_id = 4")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$volume_stock_opname_2030_now = $stock_opname_2030_now['volume'];
			$nilai_stock_opname_2030_now = $stock_opname_2030_now['nilai'];

			$vol_pemakaian_2030_now = ($stok_volume_2030_lalu + $pembelian_volume_2030) - $volume_stock_opname_2030_now;
			$nilai_pemakaian_2030_now = $stock_opname_2030_now['nilai'];

			$pemakaian_volume_2030_bulan_ini = $vol_pemakaian_2030_now;
			$pemakaian_nilai_2030_bulan_ini = (($total_stok_nilai_2030 - $nilai_stock_opname_2030_now) * $stock_opname_2030_now['reset']) + ($stock_opname_2030_now['pemakaian_custom'] * $stock_opname_2030_now['reset_pemakaian']);
			$pemakaian_harsat_2030_bulan_ini = $pemakaian_nilai_2030 / $pemakaian_volume_2030;

			$stock_opname_additive_ago = $this->db->select('cat.volume as volume, cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 19")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$stok_volume_additive_lalu = $stock_opname_additive_ago['volume'];
			$stok_nilai_additive_lalu = $stock_opname_additive_ago['nilai'];
			$stok_harsat_additive_lalu = (round($stok_volume_additive_lalu,2)!=0)?$stok_nilai_additive_lalu / round($stok_volume_additive_lalu,2) * 1:0;

			$pembelian_additive = $this->db->select('prm.display_measure as satuan, SUM(prm.display_volume) as volume, (prm.display_price / prm.display_volume) as harga, SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("prm.date_receipt between '$date1' and '$date2'")
			->where("p.kategori_bahan = 6")
			->get()->row_array();
		
			$pembelian_volume_additive = $pembelian_additive['volume'];
			$pembelian_nilai_additive = $pembelian_additive['nilai'];
			$pembelian_harga_additive = (round($pembelian_volume_additive,2)!=0)?$pembelian_nilai_additive / round($pembelian_volume_additive,2) * 1:0;

			$total_stok_volume_additive = $stok_volume_additive_lalu + $pembelian_volume_additive;
			$total_stok_nilai_additive = $stok_nilai_additive_lalu + $pembelian_nilai_additive;

			$stock_opname_additive_now = $this->db->select('cat.volume as volume, cat.total as nilai, cat.pemakaian_custom, cat.reset, cat.reset_pemakaian')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$date2')")
			->where("cat.material_id = 19")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$volume_stock_opname_additive_now = $stock_opname_additive_now['volume'];
			$nilai_stock_opname_additive_now = $stock_opname_additive_now['nilai'];

			$vol_pemakaian_additive_now = ($stok_volume_additive_lalu + $pembelian_volume_additive) - $volume_stock_opname_additive_now;
			$nilai_pemakaian_additive_now = $stock_opname_additive_now['nilai'];

			$pemakaian_volume_additive_bulan_ini = $vol_pemakaian_additive_now;
			$pemakaian_nilai_additive_bulan_ini = (($total_stok_nilai_additive - $nilai_stock_opname_additive_now) * $stock_opname_additive_now['reset']) + ($stock_opname_additive_now['pemakaian_custom'] * $stock_opname_additive_now['reset_pemakaian']);
			$pemakaian_harsat_additive_bulan_ini = $pemakaian_nilai_additive / $pemakaian_volume_additive;

			$total_volume_realisasi = $pemakaian_volume_semen + $pemakaian_volume_pasir + $pemakaian_volume_1020 + $pemakaian_volume_2030 +  $pemakaian_volume_additive;
			$total_nilai_realisasi = $pemakaian_nilai_semen + $pemakaian_nilai_pasir + $pemakaian_nilai_1020 + $pemakaian_nilai_2030 + $pemakaian_nilai_additive;
			
			$evaluasi_volume_a = round($volume_a - $pemakaian_volume_semen,2);
			$evaluasi_volume_b = round($volume_b - $pemakaian_volume_pasir,2);
			$evaluasi_volume_c = round($volume_c - $pemakaian_volume_1020,2);
			$evaluasi_volume_d = round($volume_d - $pemakaian_volume_2030,2);
			$evaluasi_volume_e = round($volume_e - $pemakaian_volume_additive,2);

			$evaluasi_nilai_a = round($nilai_a - $pemakaian_nilai_semen,0);
			$evaluasi_nilai_b = round($nilai_b - $pemakaian_nilai_pasir,0);
			$evaluasi_nilai_c = round($nilai_c - $pemakaian_nilai_1020,0);
			$evaluasi_nilai_d = round($nilai_d - $pemakaian_nilai_2030,0);
			$evaluasi_nilai_e = round($nilai_e - $pemakaian_nilai_additive,0);

			$total_volume_evaluasi = round($total_volume_komposisi - $total_volume_realisasi,2);
			$total_nilai_evaluasi = round($evaluasi_nilai_a + $evaluasi_nilai_b + $evaluasi_nilai_c + $evaluasi_nilai_d + $evaluasi_nilai_e,0);
			?>

			<?php
			$date3 = date('2024-01-01',strtotime($date3));
			$date4 = date('Y-m-d', strtotime('-5 days', strtotime($date2)));
			$row = $this->db->select('date, sum(vol_semen) as vol_semen, sum(vol_pasir) as vol_pasir, sum(vol_1020) as vol_1020, sum(vol_2030) as vol_2030, sum(vol_additive) as vol_additive, sum(nilai_semen) as nilai_semen, sum(nilai_pasir) as nilai_pasir, sum(nilai_1020) as nilai_1020, sum(nilai_2030) as nilai_2030, sum(nilai_additive) as nilai_additive')
			->from('kunci_bahan_baku')
			->where("(date between '$date3' and '$date4')")
			->get()->row_array();

			$pemakaian_volume_semen = $pemakaian_volume_semen_bulan_ini + $row['vol_semen'];
			$pemakaian_nilai_semen = $pemakaian_nilai_semen_bulan_ini + $row['nilai_semen'];
			$pemakaian_harsat_semen = $pemakaian_nilai_semen / $pemakaian_volume_semen;

			$pemakaian_volume_pasir = $pemakaian_volume_pasir_bulan_ini + $row['vol_pasir'];
			$pemakaian_nilai_pasir = $pemakaian_nilai_pasir_bulan_ini + $row['nilai_pasir'];
			$pemakaian_harsat_pasir = $pemakaian_nilai_pasir / $pemakaian_volume_pasir;
			
			$pemakaian_volume_1020 = $pemakaian_volume_1020_bulan_ini + $row['vol_1020'];
			$pemakaian_nilai_1020 = $pemakaian_nilai_1020_bulan_ini + $row['nilai_1020'];
			$pemakaian_harsat_1020 = $pemakaian_nilai_1020 / $pemakaian_volume_1020;

			$pemakaian_volume_2030 = $pemakaian_volume_2030_bulan_ini + $row['vol_2030'];
			$pemakaian_nilai_2030 = $pemakaian_nilai_2030_bulan_ini + $row['nilai_2030'];
			$pemakaian_harsat_2030 = $pemakaian_nilai_2030 / $pemakaian_volume_2030;
			
			$pemakaian_volume_additive = $pemakaian_volume_additive_bulan_ini + $row['vol_additive'];
			$pemakaian_nilai_additive = $pemakaian_nilai_additive_bulan_ini + $row['nilai_additive'];
			$pemakaian_harsat_additive = $pemakaian_nilai_additive / $pemakaian_volume_additive;

			$total_bahan= $pemakaian_nilai_semen + $pemakaian_nilai_pasir + $pemakaian_nilai_1020 + $pemakaian_nilai_2030 + $pemakaian_nilai_additive;
			?>
			
			<tr class="table-judul">
				<th width="5%" align="center" rowspan="2">&nbsp;<br>NO.</th>
				<th width="30%" align="center" rowspan="2">&nbsp;<br>URAIAN</th>
				<th width="15%" align="center" rowspan="2">&nbsp;<br>SATUAN</th>
				<th width="50%" align="center" colspan="3">PEMAKAIAN</th>
	        </tr>
			<tr class="table-judul">
				<th align="center" width="15%">VOLUME</th>
				<th align="center" width="15%">HARGA</th>
				<th align="center" width="20%">NILAI</th>
	        </tr>
			<tr class="table-baris1">
				<th align="center">1.</th>	
				<th align="left">Semen</th>
				<th align="center">Ton</th>
				<th align="right"><?php echo number_format($pemakaian_volume_semen,2,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_semen / $pemakaian_volume_semen,0,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_semen,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center">2.</th>
				<th align="left">Pasir</th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($pemakaian_volume_pasir,2,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_pasir / $pemakaian_volume_pasir,0,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_pasir,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center">3.</th>
				<th align="left">Batu Split 10 - 20</th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($pemakaian_volume_1020,2,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_1020 / $pemakaian_volume_1020,0,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_1020,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center">4.</th>
				<th align="left">Batu Split 20 - 30</th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($pemakaian_volume_2030,2,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_2030 / $pemakaian_volume_2030,0,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_2030,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center">5.</th>
				<th align="left">Additive</th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($pemakaian_volume_additive,2,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_additive / $pemakaian_volume_additive,0,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_additive,0,',','.');?></th>
	        </tr>
			<tr class="table-total">
	            <th align="right" colspan="5">TOTAL</th>
				<th align="right"><?php echo number_format($total_bahan,0,',','.');?></th>
	        </tr>
	    </table>
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<table width="98%">
			<tr >
				<td width="5%"></td>
				<td width="90%">
					<table width="100%" border="0" cellpadding="2">
						<tr>
							<td align="center">
								Diperiksa Oleh & Disetujui Oleh
							</td>
							<td align="center" >
								Dibuat Oleh
							</td>	
						</tr>
						<tr>
							<td align="center" height="55px">
								
							</td>
							<td align="center">
								
							</td>
						</tr>
						<tr>
							<td align="center" >
								<b><u>Tri Wahyu Rahadi</u><br />
								Ka. Plant</b>
							</td>
							<td align="center" >
								<b><u>Vicky Irwana Yudha</u><br />
								Logistik</b>
							</td>
						</tr>
					</table>
				</td>
				<td width="5%"></td>
			</tr>
		</table>
	</body>
</html>