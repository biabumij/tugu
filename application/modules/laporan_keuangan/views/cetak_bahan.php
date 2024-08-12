<!DOCTYPE html>
<html>
	<head>
	  <title>BIAYA BAHAN</title>
	  <?= include 'lib.php'; ?>
	  
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
		<br />
		<br />
		<table width="98%" cellpadding="3">
			<tr>
				<td align="center" width="100%">
					<div style="display: block;font-weight: bold;font-size: 11px;">BIAYA BAHAN</div>
					<div style="display: block;font-weight: bold;font-size: 11px;">PROYEK BENDUNGAN TUGU</div>
					<div style="display: block;font-weight: bold;font-size: 11px;">PT. BIA BUMI JAYENDRA</div>
					<div style="display: block;font-weight: bold;font-size: 11px; text-transform: uppercase;">PERIODE : <?php echo str_replace($search, $replace, $subject);?></div>
				</td>
			</tr>
		</table>
		<br />
		<br />
		<br />
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

		$pemakaian_volume_semen = $vol_pemakaian_semen_now;
		$pemakaian_nilai_semen = (($total_stok_nilai_semen - $nilai_stock_opname_semen_now) * $stock_opname_semen_now['reset']) + ($stock_opname_semen_now['pemakaian_custom'] * $stock_opname_semen_now['reset_pemakaian']);
		$pemakaian_harsat_semen = $pemakaian_nilai_semen / $pemakaian_volume_semen;
		
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

		$pemakaian_volume_pasir = $vol_pemakaian_pasir_now;
		$pemakaian_nilai_pasir = (($total_stok_nilai_pasir - $nilai_stock_opname_pasir_now) * $stock_opname_pasir_now['reset']) + ($stock_opname_pasir_now['pemakaian_custom'] * $stock_opname_pasir_now['reset_pemakaian']);
		$pemakaian_harsat_pasir = $pemakaian_nilai_pasir / $pemakaian_volume_pasir;

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

		$pemakaian_volume_1020 = $vol_pemakaian_1020_now;
		$pemakaian_nilai_1020 = (($total_stok_nilai_1020 - $nilai_stock_opname_1020_now) * $stock_opname_1020_now['reset']) + ($stock_opname_1020_now['pemakaian_custom'] * $stock_opname_1020_now['reset_pemakaian']);
		$pemakaian_harsat_1020 = $pemakaian_nilai_1020 / $pemakaian_volume_1020;

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

		$pemakaian_volume_2030 = $vol_pemakaian_2030_now;
		$pemakaian_nilai_2030 = (($total_stok_nilai_2030 - $nilai_stock_opname_2030_now) * $stock_opname_2030_now['reset']) + ($stock_opname_2030_now['pemakaian_custom'] * $stock_opname_2030_now['reset_pemakaian']);
		$pemakaian_harsat_2030 = $pemakaian_nilai_2030 / $pemakaian_volume_2030;

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

		$pemakaian_volume_additive = $vol_pemakaian_additive_now;
		$pemakaian_nilai_additive = (($total_stok_nilai_additive - $nilai_stock_opname_additive_now) * $stock_opname_additive_now['reset']) + ($stock_opname_additive_now['pemakaian_custom'] * $stock_opname_additive_now['reset_pemakaian']);
		$pemakaian_harsat_additive = $pemakaian_nilai_additive / $pemakaian_volume_additive;

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
				<th align="left">Batu Split 10-20</th>
				<th align="center">M3</th>
				<th align="right"><?php echo number_format($pemakaian_volume_1020,2,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_1020 / $pemakaian_volume_1020,0,',','.');?></th>
				<th align="right"><?php echo number_format($pemakaian_nilai_1020,0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center">4.</th>
				<th align="left">Batu Split 20-30</th>
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
				<th align="right"><?php echo number_format($total_nilai_realisasi,0,',','.');?></th>
	        </tr>
	    </table>
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<!--<table width="98%">
			<tr >
				<td width="5%"></td>
				<td width="90%">
					<table width="100%" border="0" cellpadding="2">
						<tr>
							<td align="center">
								Disetujui Oleh
							</td>
							<td align="center">
								Diperiksa Oleh
							</td>
							<td align="center" >
								Dibuat Oleh
							</td>	
						</tr>
						<tr class="">
							<?php
								$create = $this->db->select('id, unit_head, logistik, admin')
								->from('akumulasi')
								->where("(date_akumulasi between '$start_date' and '$end_date')")
								->order_by('id','desc')->limit(1)
								->get()->row_array();

                                $this->db->select('g.admin_group_name, a.admin_ttd');
                                $this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
                                $this->db->where('a.admin_id',$create['unit_head']);
                                $unit_head = $this->db->get('tbl_admin a')->row_array();

								$this->db->select('g.admin_group_name, a.admin_ttd');
                                $this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
                                $this->db->where('a.admin_id',$create['logistik']);
                                $logistik = $this->db->get('tbl_admin a')->row_array();

								$this->db->select('g.admin_group_name, a.admin_ttd');
                                $this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
                                $this->db->where('a.admin_id',$create['admin']);
                                $admin = $this->db->get('tbl_admin a')->row_array();
                            ?>
							<td align="center" height="55px">
								<img src="<?= $unit_head['admin_ttd']?>" width="70px">
							</td>
							<td align="center">
								<img src="<?= $unit_head['admin_ttd']?>" width="70px">
							</td>
							<td align="center">
								<img src="<?= $logistik['admin_ttd']?>" width="70px">
							</td>
						</tr>
						<tr>
							<td align="center" >
								<b><u><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$create['unit_head']),'admin_name');?></u><br />
								<?= $unit_head['admin_group_name']?></b>
							</td>
							<td align="center">
							<b><u><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$create['unit_head']),'admin_name');?></u><br />
								M. Teknik</b>
							</td>
							<td align="center" >
								<b><u><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$create['logistik']),'admin_name');?></u><br />
								<?= $logistik['admin_group_name']?></b>
							</td>
						</tr>
					</table>
				</td>
				<td width="5%"></td>
			</tr>
		</table>-->
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
								<b><u>Novel Joko Tri Laksono</u><br />
								Ka. Plant</b>
							</td>
							<td align="center" >
								<b><u>Rani Oktavia Rizal</u><br />
								Adm. Logistik</b>
							</td>
						</tr>
					</table>
				</td>
				<td width="5%"></td>
			</tr>
		</table>
	</body>
</html>