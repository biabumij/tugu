<!DOCTYPE html>
<html>
	<head>
	  <title>CASH FLOW</title>
	  
	  <style type="text/css">
		 body {
			font-family: helvetica;
		}

		table.table-border-pojok-kiri, th.table-border-pojok-kiri, td.table-border-pojok-kiri {
			border-top: 1px solid black;
			border-bottom: 1px solid black;
			border-right: 1px solid black;
			border-left: 1px solid black;
		}

		table.table-border-pojok-tengah, th.table-border-pojok-tengah, td.table-border-pojok-tengah {
			border-top: 1px solid black;
			border-bottom: 1px solid black;
			border-right: 1px solid black;
		}

		table.table-border-pojok-kanan, th.table-border-pojok-kanan, td.table-border-pojok-kanan {
			border-top: 1px solid black;
			border-bottom: 1px solid black;
			border-right: 1px solid black;
		}

		table.table-border-noborder-kiri, th.table-border-noborder-kiri, td.table-border-noborder-kiri {
			border-right: 1px solid black;
			border-left: 1px solid black;
		}

		table.table-border-noborder-tengah, th.table-border-noborder-tengah, td.table-border-noborder-tengah {
			border-right: 1px solid black;
			border-left: 1px solid black;
		}

		table.table-border-noborder-kanan, th.table-border-noborder-kanan, td.table-border-noborder-kanan {
			border-right: 1px solid black;
			border-left: 1px solid black;
		}

		table.table-border-atas-kiri, th.table-border-atas-kiri, td.table-border-atas-kiri {
			border-top: 1px solid black;
			border-right: 1px solid black;
			border-left: 1px solid black;
		}

		table.table-border-atas-tengah, th.table-border-atas-tengah, td.table-border-atas-tengah {
			border-top: 1px solid black;
			border-right: 1px solid black;
			border-left: 1px solid black;
		}

		table.table-border-atas-kanan, th.table-border-atas-kanan, td.table-border-atas-kanan {
			border-top: 1px solid black;
			border-right: 1px solid black;
			border-left: 1px solid black;
		}

		table.table-border-bawah-kiri, th.table-border-bawah-kiri, td.table-border-bawah-kiri {
			border-bottom: 1px solid black;
			border-right: 1px solid black;
			border-left: 1px solid black;
		}

		table.table-border-bawah-tengah, th.table-border-bawah-tengah, td.table-border-bawah-tengah {
			border-bottom: 1px solid black;
			border-right: 1px solid black;
			border-left: 1px solid black;
		}

		table.table-border-bawah-kanan, th.table-border-bawah-kanan, td.table-border-bawah-kanan {
			border-bottom: 1px solid black;
			border-right: 1px solid black;
			border-left: 1px solid black;
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
			font-size: 5px;
			color: black;
		}
			
		table tr.table-baris1{
			background-color: none;
			font-size: 5px;
		}

		table tr.table-baris1-bold{
			background-color: none;
			font-size: 5px;
			font-weight: bold;
		}
			
		table tr.table-total{
			background-color: #FFFF00;
			font-weight: bold;
			font-size: 5px;
			color: black;
		}

		table tr.table-total2{
			background-color: #eeeeee;
			font-weight: bold;
			font-size: 5px;
			color: black;
		}
	  </style>

	</head>
	<body>
		<?php
		//NOW
		$stock_opname = $this->db->select('date')->order_by('date','desc')->limit(1)->get_where('pmm_remaining_materials_cat',array('status'=>'PUBLISH'))->row_array();
		$last_opname =  date('Y-m-d', strtotime($stock_opname['date']));
		?>
		<div align="center" style="display: block;font-weight: bold;font-size: 12px;">CASH FLOW</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">BENDUNGAN TUGU</div>
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
		
		<table width="98%" border="0" cellpadding="3" border="0">
		
			<?php
			//RAP
			$date_now = date('Y-m-d');
			$date_end = date('2022-12-31');

			$rencana_kerja_2022_1 = $this->db->select('r.*')
			->from('rak r')
			->where("r.tanggal_rencana_kerja between '2021-12-30' and '2021-12-30'")
			->get()->row_array();
			
			$rencana_kerja_2022_2 = $this->db->select('r.*')
			->from('rak r')
			->where("r.tanggal_rencana_kerja between '2021-12-31' and '2021-12-31'")
			->get()->row_array();
			

			$volume_rap_2022_produk_a = $rencana_kerja_2022_1['vol_produk_a'] + $rencana_kerja_2022_2['vol_produk_a'];
			$volume_rap_2022_produk_b = $rencana_kerja_2022_1['vol_produk_b'] + $rencana_kerja_2022_2['vol_produk_b'];
			$volume_rap_2022_produk_c = $rencana_kerja_2022_1['vol_produk_c'] + $rencana_kerja_2022_2['vol_produk_c'];
			$volume_rap_2022_produk_d = $rencana_kerja_2022_1['vol_produk_d'] + $rencana_kerja_2022_2['vol_produk_d'];

			$total_rap_volume_2022 = $rencana_kerja_2022_1['vol_produk_a'] + $rencana_kerja_2022_1['vol_produk_b'] + $rencana_kerja_2022_1['vol_produk_c'] + $rencana_kerja_2022_1['vol_produk_d'] + $rencana_kerja_2022_2['vol_produk_a'] + $rencana_kerja_2022_2['vol_produk_b'] + $rencana_kerja_2022_2['vol_produk_c'] + $rencana_kerja_2022_2['vol_produk_d'];
			
			$price_produk_a_1 = $rencana_kerja_2022_1['vol_produk_a'] * $rencana_kerja_2022_1['price_a'];
			$price_produk_b_1 = $rencana_kerja_2022_1['vol_produk_b'] * $rencana_kerja_2022_1['price_b'];
			$price_produk_c_1 = $rencana_kerja_2022_1['vol_produk_c'] * $rencana_kerja_2022_1['price_c'];
			$price_produk_d_1 = $rencana_kerja_2022_1['vol_produk_d'] * $rencana_kerja_2022_1['price_d'];

			$price_produk_a_2 = $rencana_kerja_2022_2['vol_produk_a'] * $rencana_kerja_2022_2['price_a'];
			$price_produk_b_2 = $rencana_kerja_2022_2['vol_produk_b'] * $rencana_kerja_2022_2['price_b'];
			$price_produk_c_2 = $rencana_kerja_2022_2['vol_produk_c'] * $rencana_kerja_2022_2['price_c'];
			$price_produk_d_2 = $rencana_kerja_2022_2['vol_produk_d'] * $rencana_kerja_2022_2['price_d'];

			$nilai_jual_all_2022 = $price_produk_a_1 + $price_produk_b_1 + $price_produk_c_1 + $price_produk_d_1 + $price_produk_a_2 + $price_produk_b_2 + $price_produk_c_2 + $price_produk_d_2;
			$total_rap_nilai_2022 = $nilai_jual_all_2022;

			//BIAYA RAP 2022
			$rencana_kerja_2022_biaya_1 = $this->db->select('r.*')
			->from('rak r')
			->where("r.tanggal_rencana_kerja between '2021-12-30' and '2021-12-30'")
			->get()->row_array();

			$rencana_kerja_2022_biaya_2 = $this->db->select('r.*')
			->from('rak r')
			->where("r.tanggal_rencana_kerja between '2021-12-31' and '2021-12-31'")
			->get()->row_array();
		
			$total_rap_2022_biaya_bahan = $rencana_kerja_2022_biaya_1['biaya_bahan'] + $rencana_kerja_2022_biaya_2['biaya_bahan'];
			$total_rap_2022_biaya_alat = $rencana_kerja_2022_biaya_1['biaya_alat'] + $rencana_kerja_2022_biaya_2['biaya_alat'];
			$total_rap_2022_biaya_bank = $rencana_kerja_2022_biaya_1['biaya_bank'] + $rencana_kerja_2022_biaya_2['biaya_bank'];
			$total_rap_2022_biaya_overhead = $rencana_kerja_2022_biaya_1['overhead'] + $rencana_kerja_2022_biaya_2['overhead'];
			$total_rap_2022_biaya_persiapan = 0;
			$total_rap_2022_pajak_keluaran = ($total_rap_nilai_2022 * 11) / 100;
			$total_rap_2022_pajak_masukan = (($total_rap_2022_biaya_bahan + $total_rap_2022_biaya_alat) * 11) / 100;
			$total_rap_2022_penerimaan_pinjaman = 1300000000;
			$total_rap_2022_pengembalian_pinjaman = 1300000000;
			$total_rap_2022_pinjaman_dana = 0;
			$total_rap_2022_piutang = 0;
			$total_rap_2022_hutang = 0;
			?>

			<?php
			//NOW
			//$last_opname_start = date('Y-m-01', (strtotime($date_now)));
			//$last_opname = date('Y-m-d', strtotime('-1 days', strtotime($last_opname_start)));

			$date_epproval = $this->db->select('date_approval')->order_by('date_approval','desc')->limit(1)->get_where('ttd_laporan',array('status'=>'PUBLISH'))->row_array();
			$last_opname = date('Y-m-d', strtotime('0 days', strtotime($date_epproval['date_approval'])));

			//PRODUKSI (PENJUALAN) NOW
			$penjualan_now = $this->db->select('SUM(pp.display_price) as total')
			->from('pmm_productions pp')
			->join('penerima p', 'pp.client_id = p.id','left')
			->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
			->where("pp.date_production < '$last_opname'")
			->where("pp.status = 'PUBLISH'")
			->where("ppo.status in ('OPEN','CLOSED')")
			->group_by("pp.client_id")
			->get()->row_array();

			$pembayaran_bahan_now = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran_penagihan_pembelian pm')
			->join('pmm_penagihan_pembelian ppp','pm.penagihan_pembelian_id = ppp.id','left')
			->join('pmm_purchase_order ppo','ppp.purchase_order_id = ppo.id','left')
			->where("(pm.tanggal_pembayaran <= '$last_opname')")
			->where("ppo.kategori_id = '1'")
			->where("pm.memo <> 'PPN'")
			->get()->row_array();
			$pembayaran_bahan_now = $pembayaran_bahan_now['total'];

			//ALAT NOW
			$pembayaran_alat_now = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran_penagihan_pembelian pm')
			->join('pmm_penagihan_pembelian ppp','pm.penagihan_pembelian_id = ppp.id','left')
			->join('pmm_purchase_order ppo','ppp.purchase_order_id = ppo.id','left')
			->where("(pm.tanggal_pembayaran <= '$last_opname')")
			->where("ppo.kategori_id = '5'")
			->where("pm.memo <> 'PPN'")
			->get()->row_array();
			$pembayaran_alat_now = $pembayaran_alat_now['total'];

			$insentif_tm_now = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->where("pdb.akun = 220")
			->where("status = 'PAID'")
			->where("(tanggal_transaksi <= '$last_opname')")
			->get()->row_array();
			$total_insentif_tm_now = $insentif_tm_now['total'];

			$insentif_wl_now = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->where("pdb.akun = 221")
			->where("status = 'PAID'")
			->where("(tanggal_transaksi <= '$last_opname')")
			->get()->row_array();
			$total_insentif_wl_now = $insentif_wl_now['total'];

			$alat_now = $pembayaran_alat_now + $total_insentif_tm_now + $total_insentif_wl_now;

			//DISKONTO NOW
			$diskonto_now = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 168")
			->where("pb.status = 'PAID'")
			->where("pb.tanggal_transaksi < '$last_opname'")
			->get()->row_array();
			$diskonto_now = $diskonto_now['total'];

			//OVERHEAD NOW
			$overhead_15_now = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where('c.coa_category',15)
			->where("c.id <> 168 ") //Biaya Diskonto Bank
			->where("c.id <> 219 ") //Biaya Alat Batching Plant 
			->where("c.id <> 220 ") //Biaya Alat Truck Mixer
			->where("c.id <> 221 ") //Biaya Alat Wheel Loader
			->where("c.id <> 228 ") //Biaya Persiapan
			->where("c.id <> 505 ") //Biaya Oli
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi <= '$last_opname')")
			->get()->row_array();

			$overhead_jurnal_15_now = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where('c.coa_category',15)
			->where("c.id <> 168 ") //Biaya Diskonto Bank
			->where("c.id <> 219 ") //Biaya Alat Batching Plant 
			->where("c.id <> 220 ") //Biaya Alat Truck Mixer
			->where("c.id <> 221 ") //Biaya Alat Wheel Loader
			->where("c.id <> 228 ") //Biaya Persiapan
			->where("c.id <> 505 ") //Biaya Oli
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi <= '$last_opname')")
			->get()->row_array();
			$overhead_now =  $overhead_15_now['total'] + $overhead_jurnal_15_now['total'];

			//TERMIN NOW
			$termin_now = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran pm')
			->where("(pm.tanggal_pembayaran <= '$last_opname')")
			->where("pm.status = 'DISETUJUI'")
			->where("pm.memo <> 'PPN'")
			->get()->row_array();

			//PPN KELUAR NOW
			$ppn_masuk_now = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran_penagihan_pembelian pm')
			->where("pm.memo = 'PPN'")
			->where("pm.tanggal_pembayaran < '$last_opname'")
			->get()->row_array();

			//PPN MASUK NOW
			$ppn_keluar_now = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran pm')
			->where("pm.memo = 'PPN'")
			->where("pm.tanggal_pembayaran < '$last_opname'")
			->get()->row_array();

			//BIAYA PERSIAPAN NOW
			$biaya_persiapan_now = $this->db->select('r.*, SUM(r.biaya_persiapan) as total')
			->from('rencana_cash_flow r')
			->where("r.tanggal_rencana_kerja < '$last_opname'")
			->get()->row_array();

			//PPN KELUARAN
			$ppn_keluaran_now = $this->db->select('SUM(ppd.tax) as total')
			->from('pmm_penagihan_penjualan ppp')
			->join('pmm_penagihan_penjualan_detail ppd','ppp.id = ppd.penagihan_id','left')
			->where("ppp.tanggal_invoice < '$last_opname'")
			->get()->row_array();

			//PPN MASUKAN
			$ppn_masukan_now = $this->db->select('SUM(v.ppn) as total')
			->from('pmm_verifikasi_penagihan_pembelian v')
			->join('pmm_penagihan_pembelian ppp','v.penagihan_pembelian_id = ppp.id','left')
			->where("ppp.tanggal_invoice < '$last_opname'")
			->get()->row_array();

			//PINJAMAN DANA NOW
			$pinjaman_dana_now = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 232")
			->where("pb.status = 'PAID'")
			->where("pb.tanggal_transaksi < '$last_opname'")
			->get()->row_array();

			//PIUTANG NOW
			$penerimaan_piutang_now = $this->db->select('SUM(pp.display_price) as total')
			->from('pmm_productions pp')
			->join('pmm_sales_po po','pp.salesPo_id = po.id','left')
			->where("po.status in ('OPEN','CLOSED')")
			->where("pp.date_production <= '$last_opname'")
			->get()->row_array();

			$pembayaran_piutang_now = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran pm')
			->where("pm.memo <> 'PPN'")
			->where("pm.tanggal_pembayaran <= '$last_opname'")
			->get()->row_array();
			$piutang_now = $penerimaan_piutang_now['total'] - $pembayaran_piutang_now['total'];

			$piutang_now_dpp = $penjualan_now['total'] - $termin_now['total'];
			$piutang_now_ppn = $ppn_keluaran_now['total'] - $ppn_keluar_now['total'];
			$piutang_now = $piutang_now_dpp + $piutang_now_ppn;

			//HUTANG NOW
			$penerimaan_hutang_now = $this->db->select('SUM(prm.display_price) as total')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left')
			->where("ppo.status in ('PUBLISH','CLOSED')")
			->where("prm.date_receipt <= '$last_opname'")
			->get()->row_array();

			$pembayaran_hutang_now = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran_penagihan_pembelian pm')
			->where("pm.memo <> 'PPN'")
			->where("pm.tanggal_pembayaran <= '$last_opname'")
			->get()->row_array();
			$hutang_now = $penerimaan_hutang_now['total'] - $pembayaran_hutang_now['total'];

			$akumulasi_penerimaan_bahan = $this->db->select('SUM(prm.display_price) as total')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left')
			->where("ppo.status in ('PUBLISH','CLOSED')")
			->where("prm.date_receipt <= '$last_opname'")
			->get()->row_array();

			$hutang_now_dpp = (($akumulasi_penerimaan_bahan['total'] + $total_insentif_tm_now + $total_insentif_wl_now) - ($pembayaran_bahan_now + $pembayaran_alat_now));
			$hutang_now_ppn = $ppn_masukan_now['total'] - $ppn_keluar_now['total'];
			$hutang_now = $hutang_now_dpp + $hutang_now_ppn;

			//MOS NOW
			$harga_hpp_bahan_baku_now = $this->db->select('pp.date_hpp, pp.semen, pp.pasir, pp.batu1020, pp.batu2030, pp.solar')
			->from('hpp_bahan_baku pp')
			->where("(pp.date_hpp <= '$last_opname')")
			->order_by('pp.date_hpp','desc')->limit(1)
			->get()->row_array();
			
			$stock_opname_semen_now = $this->db->select('cat.date, (cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$last_opname')")
			->where("cat.material_id = 4")
			->where("cat.status = 'PUBLISH'")
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();
			$nilai_semen = $stock_opname_semen_now['volume'] * $harga_hpp_bahan_baku_now['semen'];

			$stock_opname_pasir_now = $this->db->select('cat.date, (cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$last_opname')")
			->where("cat.material_id = 5")
			->where("cat.status = 'PUBLISH'")
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();
			$nilai_pasir = $stock_opname_pasir_now['volume'] * $harga_hpp_bahan_baku_now['pasir'];

			$stock_opname_batu1020_now = $this->db->select('cat.date, (cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$last_opname')")
			->where("cat.material_id = 6")
			->where("cat.status = 'PUBLISH'")
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();
			$nilai_batu1020 = $stock_opname_batu1020_now['volume'] * $harga_hpp_bahan_baku_now['batu1020'];

			$stock_opname_batu2030_now = $this->db->select('cat.date, (cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$last_opname')")
			->where("cat.material_id = 7")
			->where("cat.status = 'PUBLISH'")
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();
			$nilai_batu2030 = $stock_opname_batu2030_now['volume'] * $harga_hpp_bahan_baku_now['batu2030'];

			$stock_opname_solar_now = $this->db->select('cat.date, (cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$last_opname')")
			->where("cat.material_id = 8")
			->where("cat.status = 'PUBLISH'")
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();
			$nilai_solar = $stock_opname_solar_now['volume'] * $harga_hpp_bahan_baku_now['solar'];

			$mos_now = $nilai_semen + $nilai_pasir + $nilai_batu1020 + $nilai_batu2030 + $nilai_solar;

			?>

			<?php
			//BULAN 1
			//$date_1_awal = date('Y-m-01', (strtotime($last_opname)));
			//$date_1_akhir = date('Y-m-d', strtotime('-1 days +1 months', strtotime($date_1_awal)));

			$date_1_awal = date('Y-m-01', strtotime('+1 days +1 months', strtotime($last_opname)));
			$date_1_akhir = date('Y-m-d', strtotime('-1 days +1 months', strtotime($date_1_awal)));

			$rencana_kerja_1 = $this->db->select('r.*')
			->from('rak r')
			->where("r.tanggal_rencana_kerja between '$date_1_awal' and '$date_1_akhir'")
			->get()->row_array();

			$rencana_kerja_1_biaya_cash_flow = $this->db->select('r.*')
			->from('rencana_cash_flow r')
			->where("r.tanggal_rencana_kerja between '$date_1_awal' and '$date_1_akhir'")
			->get()->row_array();

			$volume_1_produk_a = $rencana_kerja_1['vol_produk_a'];
			$volume_1_produk_b = $rencana_kerja_1['vol_produk_b'];
			$volume_1_produk_c = $rencana_kerja_1['vol_produk_c'];
			$volume_1_produk_d = $rencana_kerja_1['vol_produk_d'];

			$total_1_volume = $volume_1_produk_a + $volume_1_produk_b + $volume_1_produk_c + $volume_1_produk_d;
		
			$nilai_jual_125_1 = $volume_1_produk_a * $rencana_kerja_1['price_a'];
			$nilai_jual_225_1 = $volume_1_produk_b * $rencana_kerja_1['price_b'];
			$nilai_jual_250_1 = $volume_1_produk_c * $rencana_kerja_1['price_c'];
			$nilai_jual_250_18_1 = $volume_1_produk_d * $rencana_kerja_1['price_d'];
			$nilai_jual_all_1 = $nilai_jual_125_1 + $nilai_jual_225_1 + $nilai_jual_250_1 + $nilai_jual_250_18_1;
			
			$total_1_nilai = $nilai_jual_all_1;;
			
			$volume_rencana_kerja_1_produk_a = $rencana_kerja_1['vol_produk_a'];
			$volume_rencana_kerja_1_produk_b = $rencana_kerja_1['vol_produk_b'];
			$volume_rencana_kerja_1_produk_c = $rencana_kerja_1['vol_produk_c'];
			$volume_rencana_kerja_1_produk_d = $rencana_kerja_1['vol_produk_d'];

			$total_1_biaya_bahan = $rencana_kerja_1_biaya_cash_flow['biaya_bahan'];
			$total_1_biaya_alat = $rencana_kerja_1_biaya_cash_flow['biaya_alat'];
			$total_1_biaya_bank = $rencana_kerja_1_biaya_cash_flow['biaya_bank'];
			$total_1_biaya_overhead = $rencana_kerja_1_biaya_cash_flow['overhead'];
			$total_1_biaya_termin = $rencana_kerja_1_biaya_cash_flow['termin'];
			$total_1_biaya_persiapan = $rencana_kerja_1_biaya_cash_flow['biaya_persiapan'];

			$pinjaman_dana_1 = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 232")
			->where("pb.status = 'PAID'")
			->where("pb.tanggal_transaksi between '$date_1_awal' and '$date_1_akhir'")
			->get()->row_array();

			$penerimaan_hutang_1 = $this->db->select('SUM(prm.display_price) as total')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left')
			->where("ppo.status in ('PUBLISH','CLOSED')")
			->where("prm.date_receipt between '$date_1_awal' and '$date_1_akhir'")
			->get()->row_array();


			$pembayaran_hutang_1 = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran_penagihan_pembelian pm')
			->where("pm.memo <> 'PPN'")
			->where("pm.tanggal_pembayaran between '$date_1_awal' and '$date_1_akhir'")
			->get()->row_array();
			$hutang_1 = $penerimaan_hutang_1['total'] - $pembayaran_hutang_1['total'];
			?>

			<?php
			//BULAN 2
			$date_2_awal = date('Y-m-d', strtotime('+1 days', strtotime($date_1_akhir)));
			$date_2_akhir = date('Y-m-d', strtotime('-1 days +1 months', strtotime($date_2_awal)));

			$rencana_kerja_2 = $this->db->select('r.*')
			->from('rak r')
			->where("r.tanggal_rencana_kerja between '$date_2_awal' and '$date_2_akhir'")
			->get()->row_array();

			$rencana_kerja_2_biaya_cash_flow = $this->db->select('r.*')
			->from('rencana_cash_flow r')
			->where("r.tanggal_rencana_kerja between '$date_2_awal' and '$date_2_akhir'")
			->get()->row_array();

			$volume_2_produk_a = $rencana_kerja_2['vol_produk_a'];
			$volume_2_produk_b = $rencana_kerja_2['vol_produk_b'];
			$volume_2_produk_c = $rencana_kerja_2['vol_produk_c'];
			$volume_2_produk_d = $rencana_kerja_2['vol_produk_d'];

			$total_2_volume = $volume_2_produk_a + $volume_2_produk_b + $volume_2_produk_c + $volume_2_produk_d;
		
			$nilai_jual_125_2 = $volume_2_produk_a * $rencana_kerja_2['price_a'];
			$nilai_jual_225_2 = $volume_2_produk_b * $rencana_kerja_2['price_b'];
			$nilai_jual_250_2 = $volume_2_produk_c * $rencana_kerja_2['price_c'];
			$nilai_jual_250_18_2 = $volume_2_produk_d * $rencana_kerja_2['price_d'];
			$nilai_jual_all_2 = $nilai_jual_125_2 + $nilai_jual_225_2 + $nilai_jual_250_2 + $nilai_jual_250_18_2;
			
			$total_2_nilai = $nilai_jual_all_2; 
			
			$volume_rencana_kerja_2_produk_a = $rencana_kerja_2['vol_produk_a'];
			$volume_rencana_kerja_2_produk_b = $rencana_kerja_2['vol_produk_b'];
			$volume_rencana_kerja_2_produk_c = $rencana_kerja_2['vol_produk_c'];
			$volume_rencana_kerja_2_produk_d = $rencana_kerja_2['vol_produk_d'];

			$total_2_biaya_bahan = $rencana_kerja_2_biaya_cash_flow['biaya_bahan'];
			$total_2_biaya_alat = $rencana_kerja_2_biaya_cash_flow['biaya_alat'];
			$total_2_biaya_bank = $rencana_kerja_2_biaya_cash_flow['biaya_bank'];
			$total_2_biaya_overhead = $rencana_kerja_2_biaya_cash_flow['overhead'];
			$total_2_biaya_termin = $rencana_kerja_2_biaya_cash_flow['termin'];
			$total_2_biaya_persiapan = $rencana_kerja_2_biaya_cash_flow['biaya_persiapan'];

			$pinjaman_dana_2 = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 232")
			->where("pb.status = 'PAID'")
			->where("pb.tanggal_transaksi between '$date_2_awal' and '$date_2_akhir'")
			->get()->row_array();

			$penerimaan_hutang_2 = $this->db->select('SUM(prm.display_price) as total')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left')
			->where("ppo.status in ('PUBLISH','CLOSED')")
			->where("prm.date_receipt between '$date_2_awal' and '$date_2_akhir'")
			->get()->row_array();

			$pembayaran_hutang_2 = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran_penagihan_pembelian pm')
			->where("pm.memo <> 'PPN'")
			->where("pm.tanggal_pembayaran between '$date_2_awal' and '$date_2_akhir'")
			->get()->row_array();
			$hutang_2 = $penerimaan_hutang_2['total'] - $pembayaran_hutang_2['total'];
			?>

			<?php
			//BULAN 3
			$date_3_awal = date('Y-m-d', strtotime('+1 days', strtotime($date_2_akhir)));
			$date_3_akhir = date('Y-m-d', strtotime('-1 days +1 months', strtotime($date_3_awal)));

			$rencana_kerja_3 = $this->db->select('r.*')
			->from('rak r')
			->where("r.tanggal_rencana_kerja between '$date_3_awal' and '$date_3_akhir'")
			->get()->row_array();

			$rencana_kerja_3_biaya_cash_flow = $this->db->select('r.*')
			->from('rencana_cash_flow r')
			->where("r.tanggal_rencana_kerja between '$date_3_awal' and '$date_3_akhir'")
			->get()->row_array();

			$volume_3_produk_a = $rencana_kerja_3['vol_produk_a'];
			$volume_3_produk_b = $rencana_kerja_3['vol_produk_b'];
			$volume_3_produk_c = $rencana_kerja_3['vol_produk_c'];
			$volume_3_produk_d = $rencana_kerja_3['vol_produk_d'];

			$total_3_volume = $volume_3_produk_a + $volume_3_produk_b + $volume_3_produk_c + $volume_3_produk_d;
		
			$nilai_jual_125_3 = $volume_3_produk_a * $rencana_kerja_3['price_a'];
			$nilai_jual_225_3 = $volume_3_produk_b * $rencana_kerja_3['price_b'];
			$nilai_jual_250_3 = $volume_3_produk_c * $rencana_kerja_3['price_c'];
			$nilai_jual_250_18_3 = $volume_3_produk_d * $rencana_kerja_3['price_d'];
			$nilai_jual_all_3 = $nilai_jual_125_3 + $nilai_jual_225_3 + $nilai_jual_250_3 + $nilai_jual_250_18_3;
			
			$total_3_nilai = $nilai_jual_all_3;
			
			$volume_rencana_kerja_3_produk_a = $rencana_kerja_3['vol_produk_a'];
			$volume_rencana_kerja_3_produk_b = $rencana_kerja_3['vol_produk_b'];
			$volume_rencana_kerja_3_produk_c = $rencana_kerja_3['vol_produk_c'];
			$volume_rencana_kerja_3_produk_d = $rencana_kerja_3['vol_produk_d'];

			$total_3_biaya_bahan = $rencana_kerja_3_biaya_cash_flow['biaya_bahan'];
			$total_3_biaya_alat = $rencana_kerja_3_biaya_cash_flow['biaya_alat'];
			$total_3_biaya_bank = $rencana_kerja_3_biaya_cash_flow['biaya_bank'];
			$total_3_biaya_overhead = $rencana_kerja_3_biaya_cash_flow['overhead'];
			$total_3_biaya_termin = $rencana_kerja_3_biaya_cash_flow['termin'];
			$total_3_biaya_persiapan = $rencana_kerja_3_biaya_cash_flow['biaya_persiapan'];

			$pinjaman_dana_3 = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 232")
			->where("pb.status = 'PAID'")
			->where("pb.tanggal_transaksi between '$date_3_awal' and '$date_3_akhir'")
			->get()->row_array();

			$penerimaan_hutang_3 = $this->db->select('SUM(prm.display_price) as total')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left')
			->where("ppo.status in ('PUBLISH','CLOSED')")
			->where("prm.date_receipt between '$date_3_awal' and '$date_3_akhir'")
			->get()->row_array();

			$pembayaran_hutang_3 = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran_penagihan_pembelian pm')
			->where("pm.memo <> 'PPN'")
			->where("pm.tanggal_pembayaran between '$date_3_awal' and '$date_3_akhir'")
			->get()->row_array();
			$hutang_3 = $penerimaan_hutang_3['total'] - $pembayaran_hutang_3['total'];
			?>

			<?php
			//BULAN 4
			$date_4_awal = date('Y-m-d', strtotime('+1 days', strtotime($date_3_akhir)));
			$date_4_akhir = date('Y-m-d', strtotime('-1 days +1 months', strtotime($date_4_awal)));

			$rencana_kerja_4 = $this->db->select('r.*')
			->from('rak r')
			->where("r.tanggal_rencana_kerja between '$date_4_awal' and '$date_4_akhir'")
			->get()->row_array();

			$rencana_kerja_4_biaya_cash_flow = $this->db->select('r.*')
			->from('rencana_cash_flow r')
			->where("r.tanggal_rencana_kerja between '$date_4_awal' and '$date_4_akhir'")
			->get()->row_array();

			$volume_4_produk_a = $rencana_kerja_4['vol_produk_a'];
			$volume_4_produk_b = $rencana_kerja_4['vol_produk_b'];
			$volume_4_produk_c = $rencana_kerja_4['vol_produk_c'];
			$volume_4_produk_d = $rencana_kerja_4['vol_produk_d'];

			$total_4_volume = $volume_4_produk_a + $volume_4_produk_b + $volume_4_produk_c + $volume_4_produk_d;
		
			$nilai_jual_125_4 = $volume_4_produk_a * $rencana_kerja_4['price_a'];
			$nilai_jual_225_4 = $volume_4_produk_b * $rencana_kerja_4['price_b'];
			$nilai_jual_250_4 = $volume_4_produk_c * $rencana_kerja_4['price_c'];
			$nilai_jual_250_18_4 = $volume_4_produk_d * $rencana_kerja_4['price_d'];
			$nilai_jual_all_4 = $nilai_jual_125_4 + $nilai_jual_225_4 + $nilai_jual_250_4 + $nilai_jual_250_18_4;
			
			$total_4_nilai = $nilai_jual_all_4;
			
			$volume_rencana_kerja_4_produk_a = $rencana_kerja_4['vol_produk_a'];
			$volume_rencana_kerja_4_produk_b = $rencana_kerja_4['vol_produk_b'];
			$volume_rencana_kerja_4_produk_c = $rencana_kerja_4['vol_produk_c'];
			$volume_rencana_kerja_4_produk_d = $rencana_kerja_4['vol_produk_d'];

			$total_4_biaya_bahan = $rencana_kerja_4_biaya_cash_flow['biaya_bahan'];
			$total_4_biaya_alat = $rencana_kerja_4_biaya_cash_flow['biaya_alat'];
			$total_4_biaya_bank = $rencana_kerja_4_biaya_cash_flow['biaya_bank'];
			$total_4_biaya_overhead = $rencana_kerja_4_biaya_cash_flow['overhead'];
			$total_4_biaya_termin = $rencana_kerja_4_biaya_cash_flow['termin'];
			$total_4_biaya_persiapan = $rencana_kerja_4_biaya_cash_flow['biaya_persiapan'];

			$pinjaman_dana_4 = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 232")
			->where("pb.status = 'PAID'")
			->where("pb.tanggal_transaksi between '$date_4_awal' and '$date_4_akhir'")
			->get()->row_array();

			$penerimaan_hutang_4 = $this->db->select('SUM(prm.display_price) as total')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left')
			->where("ppo.status in ('PUBLISH','CLOSED')")
			->where("prm.date_receipt between '$date_4_awal' and '$date_4_akhir'")
			->get()->row_array();

			$pembayaran_hutang_4 = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran_penagihan_pembelian pm')
			->where("pm.memo <> 'PPN'")
			->where("pm.tanggal_pembayaran between '$date_4_awal' and '$date_4_akhir'")
			->get()->row_array();
			$hutang_4 = $penerimaan_hutang_4['total'] - $pembayaran_hutang_4['total'];
			?>

			<?php
			//BULAN 5
			$date_5_awal = date('Y-m-d', strtotime('+1 days', strtotime($date_4_akhir)));
			$date_5_akhir = date('Y-m-d', strtotime('-1 days +1 months', strtotime($date_5_awal)));

			$rencana_kerja_5 = $this->db->select('r.*')
			->from('rak r')
			->where("r.tanggal_rencana_kerja between '$date_5_awal' and '$date_5_akhir'")
			->get()->row_array();

			$rencana_kerja_5_biaya_cash_flow = $this->db->select('r.*')
			->from('rencana_cash_flow r')
			->where("r.tanggal_rencana_kerja between '$date_5_awal' and '$date_5_akhir'")
			->get()->row_array();

			$volume_5_produk_a = $rencana_kerja_5['vol_produk_a'];
			$volume_5_produk_b = $rencana_kerja_5['vol_produk_b'];
			$volume_5_produk_c = $rencana_kerja_5['vol_produk_c'];
			$volume_5_produk_d = $rencana_kerja_5['vol_produk_d'];

			$total_5_volume = $volume_5_produk_a + $volume_5_produk_b + $volume_5_produk_c + $volume_5_produk_d;
		
			$nilai_jual_125_5 = $volume_5_produk_a * $rencana_kerja_5['price_a'];
			$nilai_jual_225_5 = $volume_5_produk_b * $rencana_kerja_5['price_b'];
			$nilai_jual_250_5 = $volume_5_produk_c * $rencana_kerja_5['price_c'];
			$nilai_jual_250_18_5 = $volume_5_produk_d * $rencana_kerja_5['price_d'];
			$nilai_jual_all_5 = $nilai_jual_125_5 + $nilai_jual_225_5 + $nilai_jual_250_5 + $nilai_jual_250_18_5;
			
			$total_5_nilai = $nilai_jual_all_5;
			
			$volume_rencana_kerja_5_produk_a = $rencana_kerja_5['vol_produk_a'];
			$volume_rencana_kerja_5_produk_b = $rencana_kerja_5['vol_produk_b'];
			$volume_rencana_kerja_5_produk_c = $rencana_kerja_5['vol_produk_c'];
			$volume_rencana_kerja_5_produk_d = $rencana_kerja_5['vol_produk_d'];

			$total_5_biaya_bahan = $rencana_kerja_5_biaya_cash_flow['biaya_bahan'];
			$total_5_biaya_alat = $rencana_kerja_5_biaya_cash_flow['biaya_alat'];
			$total_5_biaya_bank = $rencana_kerja_5_biaya_cash_flow['biaya_bank'];
			$total_5_biaya_overhead = $rencana_kerja_5_biaya_cash_flow['overhead'];
			$total_5_biaya_termin = $rencana_kerja_5_biaya_cash_flow['termin'];
			$total_5_biaya_persiapan = $rencana_kerja_5_biaya_cash_flow['biaya_persiapan'];

			$pinjaman_dana_5 = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 232")
			->where("pb.status = 'PAID'")
			->where("pb.tanggal_transaksi between '$date_5_awal' and '$date_5_akhir'")
			->get()->row_array();

			$penerimaan_hutang_5 = $this->db->select('SUM(prm.display_price) as total')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left')
			->where("ppo.status in ('PUBLISH','CLOSED')")
			->where("prm.date_receipt between '$date_5_awal' and '$date_5_akhir'")
			->get()->row_array();

			$pembayaran_hutang_5 = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran_penagihan_pembelian pm')
			->where("pm.memo <> 'PPN'")
			->where("pm.tanggal_pembayaran between '$date_5_awal' and '$date_5_akhir'")
			->get()->row_array();
			$hutang_5 = $penerimaan_hutang_5['total'] - $pembayaran_hutang_5['total'];
			?>

			<?php
			//BULAN 6
			$date_6_awal = date('Y-m-d', strtotime('+1 days', strtotime($date_5_akhir)));
			$date_6_akhir = date('Y-m-d', strtotime('-1 days +1 months', strtotime($date_6_awal)));

			$rencana_kerja_6 = $this->db->select('r.*')
			->from('rak r')
			->where("r.tanggal_rencana_kerja between '$date_6_awal' and '$date_6_akhir'")
			->get()->row_array();

			$rencana_kerja_6_biaya_cash_flow = $this->db->select('r.*')
			->from('rencana_cash_flow r')
			->where("r.tanggal_rencana_kerja between '$date_6_awal' and '$date_6_akhir'")
			->get()->row_array();

			$volume_6_produk_a = $rencana_kerja_6['vol_produk_a'];
			$volume_6_produk_b = $rencana_kerja_6['vol_produk_b'];
			$volume_6_produk_c = $rencana_kerja_6['vol_produk_c'];
			$volume_6_produk_d = $rencana_kerja_6['vol_produk_d'];

			$total_6_volume = $volume_6_produk_a + $volume_6_produk_b + $volume_6_produk_c + $volume_6_produk_d;
		
			$nilai_jual_125_6 = $volume_6_produk_a * $rencana_kerja_6['price_a'];
			$nilai_jual_225_6 = $volume_6_produk_b * $rencana_kerja_6['price_b'];
			$nilai_jual_250_6 = $volume_6_produk_c * $rencana_kerja_6['price_c'];
			$nilai_jual_250_18_6 = $volume_6_produk_d * $rencana_kerja_6['price_d'];
			$nilai_jual_all_6 = $nilai_jual_125_6 + $nilai_jual_225_6 + $nilai_jual_250_6 + $nilai_jual_250_18_6;
			
			$total_6_nilai = $nilai_jual_all_6;
			
			$volume_rencana_kerja_6_produk_a = $rencana_kerja_6['vol_produk_a'];
			$volume_rencana_kerja_6_produk_b = $rencana_kerja_6['vol_produk_b'];
			$volume_rencana_kerja_6_produk_c = $rencana_kerja_6['vol_produk_c'];
			$volume_rencana_kerja_6_produk_d = $rencana_kerja_6['vol_produk_d'];

			$total_6_biaya_bahan = $rencana_kerja_6_biaya_cash_flow['biaya_bahan'];
			$total_6_biaya_alat = $rencana_kerja_6_biaya_cash_flow['biaya_alat'];
			$total_6_biaya_bank = $rencana_kerja_6_biaya_cash_flow['biaya_bank'];
			$total_6_biaya_overhead = $rencana_kerja_6_biaya_cash_flow['overhead'];
			$total_6_biaya_termin = $rencana_kerja_6_biaya_cash_flow['termin'];
			$total_6_biaya_persiapan = $rencana_kerja_6_biaya_cash_flow['biaya_persiapan'];

			$pinjaman_dana_6 = $this->db->select('sum(pdb.debit) as total')
			->from('pmm_jurnal_umum pb ')
			->join('pmm_detail_jurnal pdb','pb.id = pdb.jurnal_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 232")
			->where("pb.status = 'PAID'")
			->where("pb.tanggal_transaksi between '$date_6_awal' and '$date_6_akhir'")
			->get()->row_array();

			$penerimaan_hutang_6 = $this->db->select('SUM(prm.display_price) as total')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order ppo','prm.purchase_order_id = ppo.id','left')
			->where("ppo.status in ('PUBLISH','CLOSED')")
			->where("prm.date_receipt between '$date_6_awal' and '$date_6_akhir'")
			->get()->row_array();

			$pembayaran_hutang_6 = $this->db->select('SUM(pm.total) as total')
			->from('pmm_pembayaran_penagihan_pembelian pm')
			->where("pm.memo <> 'PPN'")
			->where("pm.tanggal_pembayaran between '$date_6_awal' and '$date_6_akhir'")
			->get()->row_array();
			$hutang_6 = $penerimaan_hutang_6['total'] - $pembayaran_hutang_6['total'];
			?>

			<tr class="table-judul">
				<th width="2%" align="center" rowspan="2" class="table-border-pojok-kiri" style="background-color:#55ffff;">&nbsp; <br />NO.</th>
				<th width="10%" align="center" rowspan="2" class="table-border-pojok-tengah" style="background-color:#55ffff;">&nbsp; <br />URAIAN</th>
				<th width="6%" align="center" rowspan="2" class="table-border-pojok-tengah" style="background-color:#55ffff;">&nbsp; <br />RAP</th>
				<th width="6%" align="center" rowspan="2" class="table-border-pojok-tengah" style="background-color:#8fce00;"><div style="text-transform:uppercase;">REALISASI SD. <?php echo $last_opname=date('F Y', strtotime('0 days', strtotime($last_opname)));?></div></th>
				<!--<th width="6%" align="center"><div style="text-transform:uppercase;"><?php echo $date_1_awal=date("F");?></div></th>
				<th width="6%" align="center"><div style="text-transform:uppercase;">SD. <?php echo $date_1_awal=date("F");?></div></th>-->
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;"><?php echo $date_1_awal = date('F', strtotime('+1 days +1 months', strtotime($last_opname)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;">SD. <?php echo $date_1_awal = date('F', strtotime('+1 days +1 months', strtotime($last_opname)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;"><?php echo $date_2_awal=date('F', strtotime('+1 days', strtotime($date_1_akhir)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;">SD. <?php echo $date_2_awal=date('F', strtotime('+1 days', strtotime($date_1_akhir)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;"><?php echo $date_3_awal=date('F', strtotime('+1 days', strtotime($date_2_akhir)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;">SD. <?php echo $date_3_awal=date('F', strtotime('+1 days', strtotime($date_2_akhir)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;"><?php echo $date_4_awal=date('F', strtotime('+1 days', strtotime($date_3_akhir)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;">SD. <?php echo $date_4_awal=date('F', strtotime('+1 days', strtotime($date_3_akhir)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;"><?php echo $date_5_awal=date('F', strtotime('+1 days', strtotime($date_4_akhir)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;">SD. <?php echo $date_5_awal=date('F', strtotime('+1 days', strtotime($date_4_akhir)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;"><?php echo $date_6_awal=date('F', strtotime('+1 days', strtotime($date_5_akhir)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-tengah"><div style="text-transform:uppercase;">SD. <?php echo $date_6_awal=date('F', strtotime('+1 days', strtotime($date_5_akhir)));?></div></th>
				<th width="6%" align="center" class="table-border-pojok-kanan" style="background-color:#55ffff;">SISA</th>
	        </tr>
			<tr class="table-judul">
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_1_awal = date('Y');?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_1_awal = date('Y');?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_2_awal = date('Y', strtotime('+1 days', strtotime($date_1_akhir)));?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_2_awal = date('Y', strtotime('+1 days', strtotime($date_1_akhir)));?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_3_awal = date('Y', strtotime('+1 days', strtotime($date_2_akhir)));?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_3_awal = date('Y', strtotime('+1 days', strtotime($date_2_akhir)));?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_4_awal = date('Y', strtotime('+1 days', strtotime($date_3_akhir)));?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_4_awal = date('Y', strtotime('+1 days', strtotime($date_3_akhir)));?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_5_awal = date('Y', strtotime('+1 days', strtotime($date_4_akhir)));?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_5_awal = date('Y', strtotime('+1 days', strtotime($date_4_akhir)));?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_6_awal = date('Y', strtotime('+1 days', strtotime($date_5_akhir)));?></th>
				<th align="center" class="table-border-pojok-tengah"><?php echo $date_6_awal = date('Y', strtotime('+1 days', strtotime($date_5_akhir)));?></th>
				<th align="center" class="table-border-pojok-kanan" style="background-color:#55ffff;">KONTRAK</th>
	        </tr>
			<?php
			//PRESENTASE
			$presentase_now = ($penjualan_now['total'] / $total_rap_nilai_2022) * 100;
			$presentase_1 = ($total_1_nilai / $total_rap_nilai_2022) * 100;
			$presentase_2 = ($total_2_nilai / $total_rap_nilai_2022) * 100;
			$presentase_3 = ($total_3_nilai / $total_rap_nilai_2022) * 100;
			$presentase_4 = ($total_4_nilai / $total_rap_nilai_2022) * 100;
			$presentase_5 = ($total_5_nilai / $total_rap_nilai_2022) * 100;
			$presentase_6 = ($total_6_nilai / $total_rap_nilai_2022) * 100;
			$total_presentase = ($presentase_now + $presentase_1 + $presentase_2 + $presentase_3 + $presentase_4 + $presentase_5 + $presentase_6);

			//AKUMULASI PRESENTASE
			$presentase_akumulasi_1 = $presentase_now + $presentase_1;
			$presentase_akumulasi_2 = $presentase_akumulasi_1 + $presentase_2;
			$presentase_akumulasi_3 = $presentase_akumulasi_2 + $presentase_3;
			$presentase_akumulasi_4 = $presentase_akumulasi_3 + $presentase_4;
			$presentase_akumulasi_5 = $presentase_akumulasi_4 + $presentase_5;
			$presentase_akumulasi_6 = $presentase_akumulasi_5 + $presentase_6;
			
			//PRODUKSI
			$total_produksi = $penjualan_now['total'] + $total_1_nilai + $total_2_nilai + $total_3_nilai + $total_4_nilai + $total_5_nilai + $total_6_nilai;
			
			$akumulasi_penjualan_1 = $penjualan_now['total'] + $total_1_nilai;
			$akumulasi_penjualan_2 = $penjualan_now['total'] + $total_1_nilai + $total_2_nilai;
			$akumulasi_penjualan_3 = $penjualan_now['total'] + $total_1_nilai + $total_2_nilai + $total_3_nilai;
			$akumulasi_penjualan_4 = $penjualan_now['total'] + $total_1_nilai + $total_2_nilai + $total_3_nilai + $total_4_nilai;
			$akumulasi_penjualan_5 = $penjualan_now['total'] + $total_1_nilai + $total_2_nilai + $total_3_nilai + $total_4_nilai + $total_5_nilai;
			$akumulasi_penjualan_6 = $penjualan_now['total'] + $total_1_nilai + $total_2_nilai + $total_3_nilai + $total_4_nilai + $total_5_nilai + $total_6_nilai;
			$akumulasi_penjualan_total = $akumulasi_penjualan_6;
			
			//TERMIN
			$termin_1 = $rencana_kerja_1_biaya_cash_flow['termin'];
			$termin_2 = $rencana_kerja_2_biaya_cash_flow['termin'];
			$termin_3 = $rencana_kerja_3_biaya_cash_flow['termin'];
			$termin_4 = $rencana_kerja_4_biaya_cash_flow['termin'];
			$termin_5 = $rencana_kerja_5_biaya_cash_flow['termin'];
			$termin_6 = $rencana_kerja_6_biaya_cash_flow['termin'];
			$jumlah_termin = $termin_now['total'] + $termin_1 + $termin_2 + $termin_3 + $termin_4 + $termin_5 + $termin_6;

			$akumulasi_termin_1 = $termin_now['total'] + $termin_1;
			$akumulasi_termin_2 = $akumulasi_termin_1 + $termin_2;
			$akumulasi_termin_3 = $akumulasi_termin_2 + $termin_3;
			$akumulasi_termin_4 = $akumulasi_termin_3 + $termin_4;
			$akumulasi_termin_5 = $akumulasi_termin_4 + $termin_5;
			$akumulasi_termin_6 = $akumulasi_termin_5 + $termin_6;

			//PPN KELUARAN
			$ppn_keluaran_rap = ($total_rap_nilai_2022 * 11) / 100;
			$ppn_keluaran_1 = 0;
			$ppn_keluaran_2 = 0;
			$ppn_keluaran_3 = 0;
			$ppn_keluaran_4 = 0;
			$ppn_keluaran_5 = 0;
			$ppn_keluaran_6 = 0;
			$jumlah_ppn_keluaran = $ppn_keluar_now['total'] +$ppn_keluaran_1 + $ppn_keluaran_2 + $ppn_keluaran_3 + $ppn_keluaran_4 + $ppn_keluaran_5 + $ppn_keluaran_6;

			//AKUMULASI PPN KELUARAN
			$akumulasi_ppn_keluaran_1 = $ppn_keluar_now['total'] + $ppn_keluaran_1;
			$akumulasi_ppn_keluaran_2 = $akumulasi_ppn_keluaran_1 + $ppn_keluaran_2;
			$akumulasi_ppn_keluaran_3 = $akumulasi_ppn_keluaran_2 + $ppn_keluaran_3;
			$akumulasi_ppn_keluaran_4 = $akumulasi_ppn_keluaran_3 + $ppn_keluaran_4;
			$akumulasi_ppn_keluaran_5 = $akumulasi_ppn_keluaran_4 + $ppn_keluaran_5;
			$akumulasi_ppn_keluaran_6 = $akumulasi_ppn_keluaran_5 + $ppn_keluaran_6;
			
			//JUMLAH PENERIMAAN
			$jumlah_penerimaan_now = $termin_now['total'] + $ppn_keluar_now['total'];
			$jumlah_penerimaan_1 = $rencana_kerja_1_biaya_cash_flow['termin'];
			$jumlah_penerimaan_2 = $rencana_kerja_2_biaya_cash_flow['termin'];
			$jumlah_penerimaan_3 = $rencana_kerja_3_biaya_cash_flow['termin'];
			$jumlah_penerimaan_4 = $rencana_kerja_4_biaya_cash_flow['termin'];
			$jumlah_penerimaan_5 = $rencana_kerja_5_biaya_cash_flow['termin'];
			$jumlah_penerimaan_6 = $rencana_kerja_6_biaya_cash_flow['termin'];
			$jumlah_penerimaan_total = $jumlah_penerimaan_now + $jumlah_penerimaan_1 + $jumlah_penerimaan_2 + $jumlah_penerimaan_3 + $jumlah_penerimaan_4 + $jumlah_penerimaan_5 + $jumlah_penerimaan_6;
			
			//AKUMULASI PENERIMAAN
			$akumulasi_penerimaan_now =  $jumlah_penerimaan_now;
			$akumulasi_penerimaan_1 = $akumulasi_penerimaan_now + $jumlah_penerimaan_1;
			$akumulasi_penerimaan_2 = $akumulasi_penerimaan_now + $jumlah_penerimaan_1 + $jumlah_penerimaan_2;
			$akumulasi_penerimaan_3 = $akumulasi_penerimaan_now + $jumlah_penerimaan_1 + $jumlah_penerimaan_2 + $jumlah_penerimaan_3;
			$akumulasi_penerimaan_4 = $akumulasi_penerimaan_now + $jumlah_penerimaan_1 + $jumlah_penerimaan_2 + $jumlah_penerimaan_3 + $jumlah_penerimaan_4;
			$akumulasi_penerimaan_5 = $akumulasi_penerimaan_now + $jumlah_penerimaan_1 + $jumlah_penerimaan_2 + $jumlah_penerimaan_3 + $jumlah_penerimaan_4 + $jumlah_penerimaan_5;
			
			//BIAYA BAHAN
			$biaya_bahan_1 = $total_1_biaya_bahan;
			$biaya_bahan_2 = $total_2_biaya_bahan;
			$biaya_bahan_3 = $total_3_biaya_bahan;
			$biaya_bahan_4 = $total_4_biaya_bahan;
			$biaya_bahan_5 = $total_5_biaya_bahan;
			$jumlah_biaya_bahan = $pembayaran_bahan_now  + $biaya_bahan_1 + $biaya_bahan_2 + $biaya_bahan_3 + $biaya_bahan_4 + $biaya_bahan_5;

			$akumulasi_biaya_bahan_1 = $pembayaran_bahan_now + $biaya_bahan_1;
			$akumulasi_biaya_bahan_2 = $akumulasi_biaya_bahan_1 + $biaya_bahan_2;
			$akumulasi_biaya_bahan_3 = $akumulasi_biaya_bahan_2 + $biaya_bahan_3;
			$akumulasi_biaya_bahan_4 = $akumulasi_biaya_bahan_3 + $biaya_bahan_4;
			$akumulasi_biaya_bahan_5 = $akumulasi_biaya_bahan_4 + $biaya_bahan_5;
			
			//BIAYA ALAT
			$biaya_alat_1 = $total_1_biaya_alat;
			$biaya_alat_2 = $total_2_biaya_alat;
			$biaya_alat_3 = $total_3_biaya_alat;
			$biaya_alat_4 = $total_4_biaya_alat;
			$biaya_alat_5 = $total_5_biaya_alat;
			$biaya_alat_6 = $total_6_biaya_alat;
			$jumlah_biaya_alat = $alat_now + $biaya_alat_1 + $biaya_alat_2 + $biaya_alat_3 + $biaya_alat_4 + $biaya_alat_5 + $biaya_alat_6;
		
			//AKUMULASI BIAYA ALAT
			$akumulasi_biaya_alat_1 = $alat_now + $biaya_alat_1;
			$akumulasi_biaya_alat_2 = $akumulasi_biaya_alat_1 + $biaya_alat_2;
			$akumulasi_biaya_alat_3 = $akumulasi_biaya_alat_2 + $biaya_alat_3;
			$akumulasi_biaya_alat_4 = $akumulasi_biaya_alat_3 + $biaya_alat_4;
			$akumulasi_biaya_alat_5 = $akumulasi_biaya_alat_4 + $biaya_alat_5;
			$akumulasi_biaya_alat_6 = $akumulasi_biaya_alat_5 + $biaya_alat_6;
			
			//BIAYA BANK
			$biaya_bank_1 = $total_1_biaya_bank;
			$biaya_bank_2 = $total_2_biaya_bank;
			$biaya_bank_3 = $total_3_biaya_bank;
			$biaya_bank_4 = $total_4_biaya_bank;
			$biaya_bank_5 = $total_5_biaya_bank;
			$biaya_bank_6 = $total_6_biaya_bank;
			$jumlah_biaya_bank = $diskonto_now + $biaya_bank_1 + $biaya_bank_2 + $biaya_bank_3 + $biaya_bank_4 + $biaya_bank_5 + $biaya_bank_6;

			//AKUMULASI BIAYA BANK
			$akumulasi_biaya_bank_1 = $diskonto_now + $biaya_bank_1;
			$akumulasi_biaya_bank_2 = $akumulasi_biaya_bank_1 + $biaya_bank_2;
			$akumulasi_biaya_bank_3 = $akumulasi_biaya_bank_2 + $biaya_bank_3;
			$akumulasi_biaya_bank_4 = $akumulasi_biaya_bank_3 + $biaya_bank_4;
			$akumulasi_biaya_bank_5 = $akumulasi_biaya_bank_4 + $biaya_bank_5;
			$akumulasi_biaya_bank_6 = $akumulasi_biaya_bank_5 + $biaya_bank_6;
			
			//BUA
			$biaya_overhead_1 = $total_1_biaya_overhead;
			$biaya_overhead_2 = $total_2_biaya_overhead;
			$biaya_overhead_3 = $total_3_biaya_overhead;
			$biaya_overhead_4 = $total_4_biaya_overhead;
			$biaya_overhead_5 = $total_5_biaya_overhead;
			$biaya_overhead_6 = $total_6_biaya_overhead;
			$jumlah_biaya_overhead = $overhead_now + $biaya_overhead_1 + $biaya_overhead_2 + $biaya_overhead_3 + $biaya_overhead_4 + $biaya_overhead_5 + $biaya_overhead_6;

			//AKUMULASI BUA
			$akumulasi_biaya_overhead_1 = $overhead_now + $biaya_overhead_1;
			$akumulasi_biaya_overhead_2 = $akumulasi_overhead_1 + $biaya_overhead_2;
			$akumulasi_biaya_overhead_3 = $akumulasi_overhead_2 + $biaya_overhead_3;
			$akumulasi_biaya_overhead_4 = $akumulasi_overhead_3 + $biaya_overhead_4;
			$akumulasi_biaya_overhead_5 = $akumulasi_overhead_4 + $biaya_overhead_5;
			$akumulasi_biaya_overhead_6 = $akumulasi_overhead_5 + $biaya_overhead_6;

			//PPN KELUARAN
			$pajak_masukan = (($total_rap_2022_biaya_bahan + $total_rap_2022_biaya_alat) *11) / 100;
			$ppn_keluaran_1 = 0;
			$ppn_keluaran_2 = 0;
			$ppn_keluaran_3 = 0;
			$ppn_keluaran_4 = 0;
			$ppn_keluaran_5 = 0;
			$ppn_keluaran_6 = 0;
			$jumlah_ppn_keluaran = $ppn_masuk_now['total'] + $ppn_keluaran_1 + $ppn_keluaran_2 + $ppn_keluaran_3 + $ppn_keluaran_4 + $ppn_keluaran_5 + $ppn_keluaran_6;

			//AKUMULASI PPN KELUARAN
			$akumulasi_ppn_keluaran_1 = $ppn_masuk_now['total'] + $ppn_keluaran_1;
			$akumulasi_ppn_keluaran_2 = $akumulasi_ppn_keluaran_1 + $ppn_keluaran_2;
			$akumulasi_ppn_keluaran_3 = $akumulasi_ppn_keluaran_2 + $ppn_keluaran_3;
			$akumulasi_ppn_keluaran_4 = $akumulasi_ppn_keluaran_3 + $ppn_keluaran_5;
			$akumulasi_ppn_keluaran_5 = $akumulasi_ppn_keluaran_4 + $ppn_keluaran_5;
			$akumulasi_ppn_keluaran_6 = $akumulasi_ppn_keluaran_5 + $ppn_keluaran_6;

			//BIAYA PERSIAPAN
			$biaya_persiapan_1 = $total_1_biaya_persiapan;
			$biaya_persiapan_2 = $total_2_biaya_persiapan;
			$biaya_persiapan_3 = $total_3_biaya_persiapan;
			$biaya_persiapan_4 = $total_4_biaya_persiapan;
			$biaya_persiapan_5 = $total_5_biaya_persiapan;
			$biaya_persiapan_6 = $total_6_biaya_persiapan;
			$jumlah_biaya_persiapan = $biaya_persiapan_now['total'] + $biaya_persiapan_1 + $biaya_persiapan_2 + $biaya_persiapan_3 + $biaya_persiapan_4 + $biaya_persiapan_5 + $biaya_persiapan_6;

			//BIAYA PERSIAPAN
			$akumulasi_biaya_persiapan_1 = $biaya_persiapan_now['total'] + $ppn_keluaran_1;
			$akumulasi_biaya_persiapan_2 = $akumulasi_biaya_persiapan_1 + $biaya_persiapan_2;
			$akumulasi_biaya_persiapan_3 = $akumulasi_biaya_persiapan_2 + $biaya_persiapan_3;
			$akumulasi_biaya_persiapan_4 = $akumulasi_biaya_persiapan_3 + $biaya_persiapan_4;
			$akumulasi_biaya_persiapan_5 = $akumulasi_biaya_persiapan_4 + $biaya_persiapan_5;
			$akumulasi_biaya_persiapan_6 = $akumulasi_biaya_persiapan_5 + $biaya_persiapan_6;
			$sisa_biaya_persiapan = $total_rap_2022_biaya_persiapan - $jumlah_biaya_persiapan;

			//JUMLAH PENGELUARAN
			$jumlah_pengeluaran = $total_rap_2022_biaya_bahan + $total_rap_2022_biaya_alat + $total_rap_2022_biaya_bank + $total_rap_2022_biaya_overhead + $pajak_masukan + $total_rap_2022_biaya_persiapan;
			$jumlah_pengeluaran_now = $pembayaran_bahan_now + $alat_now + $diskonto_now + $overhead_now + $ppn_masuk_now['total']+ $biaya_persiapan_now['total'];
			$jumlah_pengeluaran_1 = $biaya_bahan_1 + $biaya_alat_1 + $biaya_bank_1 + $biaya_overhead_1 + $ppn_keluaran_1 + $ppn_persiapan_1;
			$jumlah_pengeluaran_2 = $biaya_bahan_2 + $biaya_alat_2 + $biaya_bank_2 + $biaya_overhead_2 + $ppn_keluaran_2 + $ppn_persiapan_2;
			$jumlah_pengeluaran_3 = $biaya_bahan_3 + $biaya_alat_3 + $biaya_bank_3 + $biaya_overhead_3 + $ppn_keluaran_3 + $ppn_persiapan_3;
			$jumlah_pengeluaran_4 = $biaya_bahan_4 + $biaya_alat_4 + $biaya_bank_4 + $biaya_overhead_4 + $ppn_keluaran_4 + $ppn_persiapan_4;
			$jumlah_pengeluaran_5 = $biaya_bahan_5 + $biaya_alat_5 + $biaya_bank_5 + $biaya_overhead_5 + $ppn_keluaran_5 + $ppn_persiapan_5;
			$jumlah_pengeluaran_6 = $biaya_bahan_6 + $biaya_alat_6 + $biaya_bank_6 + $biaya_overhead_6 + $ppn_keluaran_6 + $ppn_persiapan_6;
			$total_pengeluaran = $jumlah_pengeluaran_now + $jumlah_pengeluaran_1 + $jumlah_pengeluaran_2 + $jumlah_pengeluaran_3 + $jumlah_pengeluaran_4 + $jumlah_pengeluaran_5 + $jumlah_pengeluaran_6;
			
			//AKUMULASI PENGELUARAN
			$akumulasi_pengeluaran_1 = $jumlah_pengeluaran_now + $jumlah_pengeluaran_1;
			$akumulasi_pengeluaran_2 = $akumulasi_pengeluaran_1 + $jumlah_pengeluaran_2;
			$akumulasi_pengeluaran_3 = $akumulasi_pengeluaran_2 + $jumlah_pengeluaran_3;
			$akumulasi_pengeluaran_4 = $akumulasi_pengeluaran_3 + $jumlah_pengeluaran_4;
			$akumulasi_pengeluaran_5 = $akumulasi_pengeluaran_4 + $jumlah_pengeluaran_5;
			$akumulasi_pengeluaran_6 = $akumulasi_pengeluaran_5 + $jumlah_pengeluaran_6;

			//PAJAK KELUARAN
			$pajak_keluaran_now =  $ppn_keluaran_now['total'];
			$pajak_keluaran_1 = 0;
			$pajak_keluaran_2 = 0;
			$pajak_keluaran_3 = 0;
			$pajak_keluaran_4 = 0;
			$pajak_keluaran_5 = 0;
			$pajak_keluaran_6 = 0;
			$total_pajak_keluaran = $pajak_keluaran_now + $pajak_keluaran_1 + $pajak_keluaran_2 + $pajak_keluaran_3 + $pajak_keluaran_4 + $pajak_keluaran_5 + $pajak_keluaran_6;

			//AKUMULASI PAJAK KELUARAN
			$akumulasi_pajak_keluaran_1 = $pajak_keluaran_now + $pajak_keluaran_1;
			$akumulasi_pajak_keluaran_2 = $akumulasi_pajak_keluaran_1 + $pajak_keluaran_2;
			$akumulasi_pajak_keluaran_3 = $akumulasi_pajak_keluaran_2 + $pajak_keluaran_3;
			$akumulasi_pajak_keluaran_4 = $akumulasi_pajak_keluaran_3 + $pajak_keluaran_4;
			$akumulasi_pajak_keluaran_5 = $akumulasi_pajak_keluaran_4 + $pajak_keluaran_5;
			$akumulasi_pajak_keluaran_6 = $akumulasi_pajak_keluaran_5 + $pajak_keluaran_6;

			//PAJAK MASUKAN
			$pajak_masukan_now = $ppn_masukan_now['total'];
			$pajak_masukan_1 = 0;
			$pajak_masukan_2 = 0;
			$pajak_masukan_3 = 0;
			$pajak_masukan_4 = 0;
			$pajak_masukan_5 = 0;
			$pajak_masukan_6 = 0;
			$total_pajak_masukan = $pajak_masukan_now + $pajak_masukan_1 + $pajak_masukan_2 + $pajak_masukan_3 + $pajak_masukan_4 + $pajak_masukan_5 + $pajak_masukan_6;

			//AKUMULASI PAJAK MASUKAN
			$akumulasi_pajak_masukan_1 = $pajak_masukan_now + $pajak_masukan_1;
			$akumulasi_pajak_masukan_2 = $akumulasi_pajak_masukan_1 + $pajak_masukan_2;
			$akumulasi_pajak_masukan_3 = $akumulasi_pajak_masukan_2 + $pajak_masukan_3;
			$akumulasi_pajak_masukan_4 = $akumulasi_pajak_masukan_3 + $pajak_masukan_4;
			$akumulasi_pajak_masukan_5 = $akumulasi_pajak_masukan_4 + $pajak_masukan_5;
			$akumulasi_pajak_masukan_6 = $akumulasi_pajak_masukan_5 + $pajak_masukan_6;
			
			//PENERIMAAN PINJAMAN
			$penerimaan_pinjaman_now = 1300000000;
			$penerimaan_pinjaman_1 = 0;
			$penerimaan_pinjaman_2 = 0;
			$penerimaan_pinjaman_3 = 0;
			$penerimaan_pinjaman_4 = 0;
			$penerimaan_pinjaman_5 = 0;
			$penerimaan_pinjaman_6 = 0;
			$total_penerimaan_pinjaman = $penerimaan_pinjaman_now + $penerimaan_pinjaman_1 + $penerimaan_pinjaman_2 + $penerimaan_pinjaman_3 + $penerimaan_pinjaman_4 + $penerimaan_pinjaman_5 + $penerimaan_pinjaman_6;

			//AKUMULASI PENERIMAAN PINJAMAN
			$akumulasi_penerimaan_pinjaman_1 = $penerimaan_pinjaman_now + $penerimaan_pinjaman_1;
			$akumulasi_penerimaan_pinjaman_2 = $akumulasi_penerimaan_pinjaman_1 + $penerimaan_pinjaman_2;
			$akumulasi_penerimaan_pinjaman_3 = $akumulasi_penerimaan_pinjaman_2 + $penerimaan_pinjaman_3;
			$akumulasi_penerimaan_pinjaman_4 = $akumulasi_penerimaan_pinjaman_3 + $penerimaan_pinjaman_4;
			$akumulasi_penerimaan_pinjaman_5 = $akumulasi_penerimaan_pinjaman_4 + $penerimaan_pinjaman_5;
			$akumulasi_penerimaan_pinjaman_6 = $akumulasi_penerimaan_pinjaman_5 + $penerimaan_pinjaman_6;

			//PENGEMBALIAN PINJAMAN
			$pengembalian_pinjaman_now = 895000000;
			$pengembalian_pinjaman_1 = 0;
			$pengembalian_pinjaman_2 = 0;
			$pengembalian_pinjaman_3 = 0;
			$pengembalian_pinjaman_4 = 0;
			$pengembalian_pinjaman_5 = 0;
			$pengembalian_pinjaman_6 = 0;
			$total_pengembalian_pinjaman = $pengembalian_pinjaman_now + $pengembalian_pinjaman_1 + $pengembalian_pinjaman_2 + $pengembalian_pinjaman_3 + $pengembalian_pinjaman_4 + $pengembalian_pinjaman_5 + $pengembalian_pinjaman_6;

			//AKUMULASI PENGEMBALIAN PINJAMAN
			$akumulasi_pengembalian_pinjaman_1 = $pengembalian_pinjaman_now + $pengembalian_pinjaman_1;
			$akumulasi_pengembalian_pinjaman_2 = $akumulasi_pengembalian_pinjaman_1 + $pengembalian_pinjaman_2;
			$akumulasi_pengembalian_pinjaman_3 = $akumulasi_pengembalian_pinjaman_2 + $pengembalian_pinjaman_3;
			$akumulasi_pengembalian_pinjaman_4 = $akumulasi_pengembalian_pinjaman_3 + $pengembalian_pinjaman_4;
			$akumulasi_pengembalian_pinjaman_5 = $akumulasi_pengembalian_pinjaman_4 + $pengembalian_pinjaman_5;
			$akumulasi_pengembalian_pinjaman_6 = $akumulasi_pengembalian_pinjaman_5 + $pengembalian_pinjaman_6;

			//PINJAMAN DANA
			$pinjaman_dana_now = $pinjaman_dana_now['total'];
			$pinjaman_dana_1 = $pinjaman_dana_1['total'];
			$pinjaman_dana_2 = $pinjaman_dana_2['total'];
			$pinjaman_dana_3 = $pinjaman_dana_3['total'];
			$pinjaman_dana_4 = $pinjaman_dana_4['total'];
			$pinjaman_dana_5 = $pinjaman_dana_5['total'];
			$pinjaman_dana_6 = $pinjaman_dana_6['total'];
			$total_pinjaman_dana = $pinjaman_dana_now + $pinjaman_dana_1 + $pinjaman_dana_2 + $pinjaman_dana_3 + $pinjaman_dana_4 + $pinjaman_dana_5 + $pinjaman_dana_6;

			//AKUMULASI PINJAMAN DANA
			$akumulasi_pinjaman_dana_1 = $pinjaman_dana_now + $pinjaman_dana_1;
			$akumulasi_pinjaman_dana_2 = $akumulasi_pinjaman_dana_1 + $pinjaman_dana_2;
			$akumulasi_pinjaman_dana_3 = $akumulasi_pinjaman_dana_2 + $pinjaman_dana_3;
			$akumulasi_pinjaman_dana_4 = $akumulasi_pinjaman_dana_3 + $pinjaman_dana_4;
			$akumulasi_pinjaman_dana_5 = $akumulasi_pinjaman_dana_4 + $pinjaman_dana_5;
			$akumulasi_pinjaman_dana_6 = $akumulasi_pinjaman_dana_5 + $pinjaman_dana_6;

			//PIUTANG
			$piutang_now = $piutang_now;
			$piutang_1 = 0;
			$piutang_2 = 0;
			$piutang_3 = 0;
			$piutang_4 = 0;
			$piutang_5 = 0;
			$piutang_6 = 0;
			$total_piutang = $piutang_now + $piutang_1 + $piutang_2 + $piutang_3 + $piutang_4 + $piutang_5 + $piutang_6;

			//AKUMULASI PIUTANG
			$akumulasi_piutang_1 = $akumulasi_penjualan_1 - $akumulasi_termin_1;
			$akumulasi_piutang_2 = $akumulasi_penjualan_2 - $akumulasi_termin_2;
			$akumulasi_piutang_3 = $akumulasi_penjualan_3 - $akumulasi_termin_3;
			$akumulasi_piutang_4 = $akumulasi_penjualan_4 - $akumulasi_termin_4;
			$akumulasi_piutang_5 = $akumulasi_penjualan_5 - $akumulasi_termin_5;
			$akumulasi_piutang_6 = $akumulasi_penjualan_6 - $akumulasi_termin_6;

			//HUTANG
			$hutang_now = $hutang_now;
			$hutang_1 = 0;
			$hutang_2 = 0;
			$hutang_3 = 0;
			$hutang_4 = 0;
			$hutang_5 = 0;
			$hutang_6 = 0;
			$total_hutang = $hutang_now + $hutang_1 + $hutang_2 + $hutang_3 + $hutang_4 + $hutang_5 + $hutang_6;

			//AKUMULASI HUTANG
			$akumulasi_hutang_1 = $akumulasi_termin_1 - ($biaya_bahan_1 + $akumulasi_biaya_alat_1);
			$akumulasi_hutang_2 = $akumulasi_termin_2 - ($biaya_bahan_2 + $akumulasi_biaya_alat_2);
			$akumulasi_hutang_3 = $akumulasi_termin_3 - ($biaya_bahan_3 + $akumulasi_biaya_alat_3);
			$akumulasi_hutang_4 = $akumulasi_termin_4 - ($biaya_bahan_4 + $akumulasi_biaya_alat_4);
			$akumulasi_hutang_5 = $akumulasi_termin_5 - ($biaya_bahan_5 + $akumulasi_biaya_alat_5);
			$akumulasi_hutang_6 = $akumulasi_termin_6 - ($biaya_bahan_6 + $akumulasi_biaya_alat_6);

			//POSISI DANA
			$posisi_dana_rap = ($total_rap_nilai_2022 + $ppn_keluaran_rap) - $jumlah_pengeluaran - ($total_rap_2022_pajak_keluaran - $total_rap_2022_pajak_masukan) - ($total_rap_2022_penerimaan_pinjaman - $total_rap_2022_pengembalian_pinjaman);
			$posisi_dana_now = ($jumlah_penerimaan_now - $jumlah_pengeluaran_now - ($pajak_keluaran_now - $pajak_masukan_now) - $pengembalian_pinjaman_now - $pinjaman_dana_now - $hutang_now + ($mos_now + $piutang_now));
			$posisi_dana_1 = $jumlah_penerimaan_1 - $jumlah_pengeluaran_1 - ($pajak_keluaran_1 - $pajak_masukan_1) - ($penerimaan_pinjaman_1 - $pengembalian_pinjaman_1) - ($pinjaman_dana_1 - $pengembalian_pinjaman_dana_1);
			$posisi_dana_2 = $jumlah_penerimaan_2 - $jumlah_pengeluaran_2 - ($pajak_keluaran_2 - $pajak_masukan_2) - ($penerimaan_pinjaman_2 - $pengembalian_pinjaman_2) - ($pinjaman_dana_2 - $pengembalian_pinjaman_dana_2);
			$posisi_dana_3 = $jumlah_penerimaan_3 - $jumlah_pengeluaran_3 - ($pajak_keluaran_3 - $pajak_masukan_3) - ($penerimaan_pinjaman_3 - $pengembalian_pinjaman_3) - ($pinjaman_dana_3 - $pengembalian_pinjaman_dana_3);
			$posisi_dana_4 = $jumlah_penerimaan_4 - $jumlah_pengeluaran_4 - ($pajak_keluaran_4 - $pajak_masukan_4) - ($penerimaan_pinjaman_4 - $pengembalian_pinjaman_4) - ($pinjaman_dana_4 - $pengembalian_pinjaman_dana_4);
			$posisi_dana_5 = $jumlah_penerimaan_5 - $jumlah_pengeluaran_5 - ($pajak_keluaran_5 - $pajak_masukan_5) - ($penerimaan_pinjaman_5 - $pengembalian_pinjaman_5) - ($pinjaman_dana_5 - $pengembalian_pinjaman_dana_5);
			$posisi_dana_6 = $jumlah_penerimaan_6 - $jumlah_pengeluaran_6 - ($pajak_keluaran_6 - $pajak_masukan_6) - ($penerimaan_pinjaman_6 - $pengembalian_pinjaman_6) - ($pinjaman_dana_6 - $pengembalian_pinjaman_dana_6);
			$total_posisi_dana = $posisi_dana_now + $posisi_dana_1 + $posisi_dana_2 + $posisi_dana_3 + $posisi_dana_4 + $posisi_dana_5 + $posisi_dana_6;
			
			//AKUMULASI POSISI DANA
			$akumulasi_posisi_dana_1 = $akumulasi_penerimaan_pinjaman_1 + ($akumulasi_termin_1 + $akumulasi_ppn_keluaran_1) - $akumulasi_pengeluaran_1 - $akumulasi_pengembalian_pinjaman_1 - ($akumulasi_penerimaan_pinjaman_1 - $akumulasi_pengembalian_pinjaman_1) - ($akumulasi_pinjaman_dana_1 - $akumulasi_pengembalian_pinjaman_dana_1) + $akumulasi_piutang_1 - $akumulasi_hutang_1;
			$akumulasi_posisi_dana_2 = $akumulasi_penerimaan_pinjaman_2 + ($akumulasi_termin_2 + $akumulasi_ppn_keluaran_2) - $akumulasi_pengeluaran_2 - $akumulasi_pengembalian_pinjaman_2 - ($akumulasi_penerimaan_pinjaman_2 - $akumulasi_pengembalian_pinjaman_2) - ($akumulasi_pinjaman_dana_2 - $akumulasi_pengembalian_pinjaman_dana_2) + $akumulasi_piutang_2 - $akumulasi_hutang_2;
			$akumulasi_posisi_dana_3 = $akumulasi_penerimaan_pinjaman_3 + ($akumulasi_termin_3 + $akumulasi_ppn_keluaran_3) - $akumulasi_pengeluaran_3 - $akumulasi_pengembalian_pinjaman_3 - ($akumulasi_penerimaan_pinjaman_3 - $akumulasi_pengembalian_pinjaman_3) - ($akumulasi_pinjaman_dana_3 - $akumulasi_pengembalian_pinjaman_dana_3) + $akumulasi_piutang_3 - $akumulasi_hutang_3;
			$akumulasi_posisi_dana_4 = $akumulasi_penerimaan_pinjaman_4 + ($akumulasi_termin_4 + $akumulasi_ppn_keluaran_4) - $akumulasi_pengeluaran_4 - $akumulasi_pengembalian_pinjaman_4 - ($akumulasi_penerimaan_pinjaman_4 - $akumulasi_pengembalian_pinjaman_4) - ($akumulasi_pinjaman_dana_4 - $akumulasi_pengembalian_pinjaman_dana_4) + $akumulasi_piutang_4 - $akumulasi_hutang_4;
			$akumulasi_posisi_dana_5 = $akumulasi_penerimaan_pinjaman_5 + ($akumulasi_termin_5 + $akumulasi_ppn_keluaran_5) - $akumulasi_pengeluaran_5 - $akumulasi_pengembalian_pinjaman_5 - ($akumulasi_penerimaan_pinjaman_5 - $akumulasi_pengembalian_pinjaman_5) - ($akumulasi_pinjaman_dana_5 - $akumulasi_pengembalian_pinjaman_dana_5) + $akumulasi_piutang_5 - $akumulasi_hutang_5;
			$akumulasi_posisi_dana_6 = $akumulasi_penerimaan_pinjaman_6 + ($akumulasi_termin_6 + $akumulasi_ppn_keluaran_6) - $akumulasi_pengeluaran_6 - $akumulasi_pengembalian_pinjaman_6 - ($akumulasi_penerimaan_pinjaman_6 - $akumulasi_pengembalian_pinjaman_6) - ($akumulasi_pinjaman_dana_6 - $akumulasi_pengembalian_pinjaman_dana_6) + $akumulasi_piutang_6 - $akumulasi_hutang_6;
			?>
			<tr class="table-baris1">
				<th align="center" rowspan="3" style="vertical-align:middle" class="table-border-noborder-kiri"><b>1</b></th>
				<th align="left" class="table-border-noborder-tengah"><b><u>PRODUKSI (EXCL. PPN)</u></b></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-kanan"></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri"><u>AKUMULASI %</u></th>
				<th align="right" class="table-border-noborder-tengah">100%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_now,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_1,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_akumulasi_1,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_2,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_akumulasi_2,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_3,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_akumulasi_3,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_4,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_akumulasi_4,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_5,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_akumulasi_5,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_6,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($presentase_akumulasi_6,0,',','.');?>%</th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format(100 - $total_presentase,0,',','.');?>%</th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;1. Produksi / Penjualan</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_nilai_2022,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($penjualan_now['total'],0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_1_nilai,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penjualan_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_2_nilai,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penjualan_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_3_nilai,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penjualan_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_4_nilai,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penjualan_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_5_nilai,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penjualan_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_6_nilai,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penjualan_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_rap_nilai_2022 - $total_produksi,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" rowspan="4" style="vertical-align:middle" class="table-border-noborder-kiri"><b>2</b></th>
				<th align="left" class="table-border-noborder-tengah"><b><u>PENERIMAAN (EXCL. PPN)</u></b></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-kanan"></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;2.1 Tagihan (Realisasi)</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_nilai_2022,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($termin_now['total'],0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($termin_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_termin_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($termin_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_termin_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($termin_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_termin_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($termin_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_termin_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($termin_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_termin_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($termin_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_termin_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_rap_nilai_2022 - $jumlah_termin,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;2.2 PPN (Keluaran)</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_rap,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluar_now['total'],0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($ppn_keluaran_rap - $jumlah_ppn_keluaran,0,',','.');?></th>
			</tr>
			<tr class="table-baris1-bold">
				<th align="left" class="table-border-atas-kiri">JUMLAH PENERIMAAN</th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($total_rap_nilai_2022 + $ppn_keluaran_rap,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($termin_now['total'] + $ppn_keluar_now['total'],0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($termin_1 + $ppn_keluaran_1,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_termin_1 + $akumulasi_ppn_keluaran_1,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($termin_2 + $ppn_keluaran_2,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_termin_2 + $akumulasi_ppn_keluaran_2,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($termin_3 + $ppn_keluaran_3,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_termin_3 + $akumulasi_ppn_keluaran_3,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($termin_4 + $ppn_keluaran_4,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_termin_4 + $akumulasi_ppn_keluaran_4,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($termin_5 + $ppn_keluaran_5,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_termin_5 + $akumulasi_ppn_keluaran_5,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($termin_6 + $ppn_keluaran_6,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_termin_6 + $akumulasi_ppn_keluaran_6,0,',','.');?></th>
				<th align="right" class="table-border-atas-kanan"><?php echo number_format(($total_rap_nilai_2022 - $jumlah_termin) + ($ppn_keluaran_rap - $jumlah_ppn_keluaran),0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" rowspan="8" style="vertical-align:middle" class="table-border-noborder-kiri"><b>3</b></th>
				<th align="left" class="table-border-noborder-tengah"><b><u>PENGELUARAN (EXCL. PPN)</u></b></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-kanan"></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;3.1 Biaya Bahan</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_biaya_bahan,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pembayaran_bahan_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bahan_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bahan_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bahan_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bahan_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bahan_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bahan_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bahan_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bahan_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bahan_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bahan_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bahan_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bahan_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_rap_2022_biaya_bahan - $jumlah_biaya_bahan,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;3.2 Biaya Alat</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_biaya_alat,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($alat_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_alat_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_alat_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_alat_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_alat_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_alat_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_alat_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_alat_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_alat_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_alat_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_alat_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_alat_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_alat_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_rap_2022_biaya_alat - $jumlah_biaya_alat,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;3.3 Biaya Bank</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_biaya_bank,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($diskonto_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bank_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bank_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bank_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bank_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bank_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bank_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bank_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bank_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bank_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bank_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_bank_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_bank_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_rap_2022_biaya_bank - $jumlah_biaya_bank,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;3.4 BUA</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_biaya_overhead,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($overhead_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_overhead_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_overhead_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_overhead_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_overhead_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_overhead_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_overhead_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_overhead_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_overhead_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_overhead_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_overhead_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_overhead_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_overhead_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_rap_2022_biaya_overhead - $jumlah_biaya_overhead,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;3.5 PPN Rekanan</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_masukan,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_masuk_now['total'],0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($ppn_keluaran_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_ppn_keluaran_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($pajak_masukan - $jumlah_ppn_keluaran,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;3.6 Biaya Persiapan</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_biaya_persiapan,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_persiapan_now['total'],0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_persiapan_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_persiapan_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_persiapan_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_persiapan_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_persiapan_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_persiapan_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_persiapan_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_persiapan_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_persiapan_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_persiapan_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($biaya_persiapan_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_biaya_persiapan_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo $sisa_biaya_persiapan < 0 ? "(".number_format($sisa_biaya_persiapan,0,',','.').")" : number_format($sisa_biaya_persiapan,0,',','.');?></th>
			</tr>
			<tr class="table-baris1-bold">
				<th align="left" class="table-border-atas-kiri">JUMLAH PENGELUARAN</th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($jumlah_pengeluaran,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($jumlah_pengeluaran_now,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($jumlah_pengeluaran_1,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pengeluaran_1,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($jumlah_pengeluaran_2,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pengeluaran_2,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($jumlah_pengeluaran_3,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pengeluaran_3,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($jumlah_pengeluaran_4,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pengeluaran_4,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($jumlah_pengeluaran_5,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pengeluaran_5,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($jumlah_pengeluaran_6,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pengeluaran_6,0,',','.');?></th>
				<th align="right" class="table-border-atas-kanan"><?php echo number_format($jumlah_pengeluaran - $total_pengeluaran,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" rowspan="4" style="vertical-align:middle" class="table-border-noborder-kiri"><b>4</b></th>
				<th align="left" class="table-border-noborder-tengah"><b><u>PAJAK</u></b></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-kanan"></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;1. Pajak Keluaran</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_pajak_keluaran,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_keluaran_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_keluaran_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_keluaran_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_keluaran_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_keluaran_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_keluaran_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_keluaran_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_keluaran_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_keluaran_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_keluaran_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_keluaran_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_keluaran_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_keluaran_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_rap_2022_pajak_keluaran - $total_pajak_keluaran_6,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;2. Pajak Masukan</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_pajak_masukan,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_masukan_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_masukan_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_masukan_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_masukan_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_masukan_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_masukan_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_masukan_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_masukan_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_masukan_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_masukan_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_masukan_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pajak_masukan_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pajak_masukan_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_rap_2022_pajak_masukan - $total_pajak_masukan_6,0,',','.');?></th>
			</tr>
			<tr class="table-baris1-bold">
				<th align="left" class="table-border-atas-kiri">KURANG BAYAR PPN</th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($total_rap_2022_pajak_keluaran - $total_rap_2022_pajak_masukan,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pajak_keluaran_now - $pajak_masukan_now,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pajak_keluaran_1 - $pajak_masukan_1,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pajak_keluaran_1 - $akumulasi_pajak_masukan_1,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pajak_keluaran_2 - $pajak_masukan_2,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pajak_keluaran_2 - $akumulasi_pajak_masukan_2,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pajak_keluaran_3 - $pajak_masukan_3,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pajak_keluaran_3 - $akumulasi_pajak_masukan_3,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pajak_keluaran_4 - $pajak_masukan_4,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pajak_keluaran_4 - $akumulasi_pajak_masukan_4,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pajak_keluaran_5 - $pajak_masukan_5,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pajak_keluaran_5 - $akumulasi_pajak_masukan_5,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pajak_keluaran_6 - $pajak_masukan_6,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pajak_keluaran_6 - $akumulasi_pajak_masukan_6,0,',','.');?></th>
				<th align="right" class="table-border-atas-kanan"><?php echo number_format(($total_rap_2022_pajak_keluaran - $total_pajak_keluaran_6) - ($total_rap_2022_pajak_masukan - $total_pajak_masukan_6),0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" rowspan="8" style="vertical-align:middle" class="table-border-noborder-kiri"><b>5</b></th>
				<th align="left" class="table-border-noborder-tengah"><b><u>PINJAMAN</u></b></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-kanan"></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri"><b>MODAL PERSIAPAN</b></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-kanan"></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;1. Penerimaan Pinjaman</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_penerimaan_pinjaman,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($penerimaan_pinjaman_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($penerimaan_pinjaman_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($penerimaan_pinjaman_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($penerimaan_pinjaman_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($penerimaan_pinjaman_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($penerimaan_pinjaman_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($penerimaan_pinjaman_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_rap_2022_penerimaan_pinjaman - $total_penerimaan_pinjaman,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;2. Pengembalian Pinjaman</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_pengembalian_pinjaman,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pengembalian_pinjaman_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pengembalian_pinjaman_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pengembalian_pinjaman_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pengembalian_pinjaman_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pengembalian_pinjaman_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pengembalian_pinjaman_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pengembalian_pinjaman_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pengembalian_pinjaman_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pengembalian_pinjaman_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pengembalian_pinjaman_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pengembalian_pinjaman_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pengembalian_pinjaman_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pengembalian_pinjaman_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_rap_2022_pengembalian_pinjaman - $total_pengembalian_pinjaman,0,',','.');?></th>
			</tr>
			<tr class="table-baris1-bold">
				<th align="left" class="table-border-atas-kiri">SISA PINJAMAN DANA</th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($total_rap_2022_penerimaan_pinjaman - $total_rap_2022_pengembalian_pinjaman,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($penerimaan_pinjaman_now - $pengembalian_pinjaman_now,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($penerimaan_pinjaman_1 - $pengembalian_pinjaman_1,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_1 - $akumulasi_pengembalian_pinjaman_1,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($penerimaan_pinjaman_2 - $pengembalian_pinjaman_2,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_2 - $akumulasi_pengembalian_pinjaman_2,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($penerimaan_pinjaman_3 - $pengembalian_pinjaman_3,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_3 - $akumulasi_pengembalian_pinjaman_3,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($penerimaan_pinjaman_4 - $pengembalian_pinjaman_4,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_4 - $akumulasi_pengembalian_pinjaman_4,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($penerimaan_pinjaman_5 - $pengembalian_pinjaman_5,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_5 - $akumulasi_pengembalian_pinjaman_5,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($penerimaan_pinjaman_6 - $pengembalian_pinjaman_6,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_penerimaan_pinjaman_6 - $akumulasi_pengembalian_pinjaman_6,0,',','.');?></th>
				<th align="right" class="table-border-atas-kanan"><?php echo number_format(($total_rap_2022_penerimaan_pinjaman - $total_penerimaan_pinjaman_6) - ($total_rap_2022_pengembalian_pinjaman - $total_pengembalian_pinjaman_6),0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri"><b>PEMAKAIAN DANA</b></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-tengah"></th>
				<th align="center" class="table-border-noborder-kanan"></th>
			</tr>
			<tr class="table-baris1">
				<th align="left" class="table-border-noborder-kiri">&nbsp;&nbsp;1. Pinjaman Dana</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_pinjaman_dana,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pinjaman_dana_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pinjaman_dana_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pinjaman_dana_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pinjaman_dana_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pinjaman_dana_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pinjaman_dana_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pinjaman_dana_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pinjaman_dana_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pinjaman_dana_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pinjaman_dana_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pinjaman_dana_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($pinjaman_dana_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_pinjaman_dana_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format(0,0,',','.');?></th>
			</tr>
			<tr class="table-baris1-bold">
				<th align="left" class="table-border-atas-kiri">JUMLAH PEMAKAIAN DANA</th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($total_rap_2022_pinjaman_dana,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pinjaman_dana_now,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pinjaman_dana_1,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pinjaman_dana_1,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pinjaman_dana_2,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pinjaman_dana_2,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pinjaman_dana_3,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pinjaman_dana_3,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pinjaman_dana_4,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pinjaman_dana_4,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pinjaman_dana_5,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pinjaman_dana_5,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($pinjaman_dana_6,0,',','.');?></th>
				<th align="right" class="table-border-atas-tengah"><?php echo number_format($akumulasi_pinjaman_dana_6,0,',','.');?></th>
				<th align="right" class="table-border-atas-kanan"><?php echo number_format(0,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-noborder-kiri"><b>6</b></th>
				<th align="left" class="table-border-noborder-tengah"><b><u>PIUTANG</u></b></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_piutang,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($piutang_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($piutang_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_piutang_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($piutang_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_piutang_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($piutang_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_piutang_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($piutang_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_piutang_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($piutang_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_piutang_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($piutang_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_piutang_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format(0,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-noborder-kiri"></th>
				<th align="left" class="table-border-noborder-tengah">&nbsp;&nbsp;DPP</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($piutang_now_dpp,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format(0,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-noborder-kiri"></th>
				<th align="left" class="table-border-noborder-tengah">&nbsp;&nbsp;PPN</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($piutang_now_ppn,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format(0,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-noborder-kiri"><b>7</b></th>
				<th align="left" class="table-border-noborder-tengah"><b><u>HUTANG</u></b></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($total_rap_2022_hutang,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($hutang_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($hutang_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_hutang_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($hutang_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_hutang_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($hutang_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_hutang_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($hutang_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_hutang_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($hutang_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_hutang_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($hutang_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_hutang_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format(0,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-noborder-kiri"></th>
				<th align="left" class="table-border-noborder-tengah">&nbsp;&nbsp;DPP</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($hutang_now_dpp,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format(0,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-noborder-kiri"></th>
				<th align="left" class="table-border-noborder-tengah">&nbsp;&nbsp;PPN</th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($hutang_now_ppn,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format(0,0,',','.');?></th>
			</tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-noborder-kiri">8</th>
				<th align="left" class="table-border-noborder-tengah"><b><u>MOS</u></b></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format(0,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($mos_now,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($mos_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_mos_1,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($mos_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_mos_2,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($mos_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_mos_3,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($mos_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_mos_4,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($mos_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_mos_5,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($mos_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-tengah"><?php echo number_format($akumulasi_mos_6,0,',','.');?></th>
				<th align="right" class="table-border-noborder-kanan"><?php echo number_format($total_mos,0,',','.');?></th>
			</tr>
			<tr class="table-total">
				<th align="center" class="table-border-bawah-kiri"><b>9</b></th>
				<th align="left" class="table-border-bawah-tengah"><b><u>POSISI DANA</u></b></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $posisi_dana_rap < 0 ? "(".number_format(-$posisi_dana_rap,0,',','.').")" : number_format($posisi_dana_rap,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $posisi_dana_now < 0 ? "(".number_format(-$posisi_dana_now,0,',','.').")" : number_format($posisi_dana_now,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $posisi_dana_1 < 0 ? "(".number_format(-$posisi_dana_1,0,',','.').")" : number_format($posisi_dana_1,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $akumulasi_posisi_dana_1 < 0 ? "(".number_format(-$akumulasi_posisi_dana_1,0,',','.').")" : number_format($akumulasi_posisi_dana_1,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $posisi_dana_2 < 0 ? "(".number_format(-$posisi_dana_2,0,',','.').")" : number_format($posisi_dana_2,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $akumulasi_posisi_dana_2 < 0 ? "(".number_format(-$akumulasi_posisi_dana_2,0,',','.').")" : number_format($akumulasi_posisi_dana_2,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $posisi_dana_3 < 0 ? "(".number_format(-$posisi_dana_3,0,',','.').")" : number_format($posisi_dana_3,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $akumulasi_posisi_dana_3 < 0 ? "(".number_format(-$akumulasi_posisi_dana_3,0,',','.').")" : number_format($akumulasi_posisi_dana_3,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $posisi_dana_4 < 0 ? "(".number_format(-$posisi_dana_4,0,',','.').")" : number_format($posisi_dana_4,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $akumulasi_posisi_dana_4 < 0 ? "(".number_format(-$akumulasi_posisi_dana_4,0,',','.').")" : number_format($akumulasi_posisi_dana_4,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $posisi_dana_5 < 0 ? "(".number_format(-$posisi_dana_5,0,',','.').")" : number_format($posisi_dana_5,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $akumulasi_posisi_dana_5 < 0 ? "(".number_format(-$akumulasi_posisi_dana_5,0,',','.').")" : number_format($akumulasi_posisi_dana_5,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $posisi_dana_6 < 0 ? "(".number_format(-$posisi_dana_6,0,',','.').")" : number_format($posisi_dana_6,0,',','.');?></th>
				<th align="right" class="table-border-bawah-tengah"><?php echo $akumulasi_posisi_dana_6 < 0 ? "(".number_format(-$akumulasi_posisi_dana_6,0,',','.').")" : number_format($akumulasi_posisi_dana_6,0,',','.');?></th>
				<th align="right" class="table-border-bawah-kanan"><?php echo number_format(0,0,',','.');?></th>
			</tr>
	    </table>
		
	</body>
</html>