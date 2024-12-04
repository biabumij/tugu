<!DOCTYPE html>
<html>
	<head>
	  <?= include 'lib.php'; ?>
	  <title>SISA BAHAN</title>

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
			font-size: 7px;
			color: black;
		}
			
		table tr.table-baris1{
			background-color: none;
			font-size: 7px;
		}

		table tr.table-baris1-bold{
			background-color: none;
			font-size: 7px;
			font-weight: bold;
		}
			
		table tr.table-total{
			background-color: #FFFF00;
			font-weight: bold;
			font-size: 7px;
			color: black;
		}

		table tr.table-total2{
			background-color: #eeeeee;
			font-weight: bold;
			font-size: 7px;
			color: black;
		}
	  </style>

	</head>
	<body>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">Stock Opname Bahan Baku</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">Proyek Bendungan Tugu</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">Periode <?php echo str_replace($search, $replace, $subject);?></div>
		<br /><br /><br />
		<table cellpadding="2" width="98%">
			<tr class="table-judul">
                <th width="35%" align="center" class="table-border-pojok-kiri">URAIAN</th>
				<th width="15%" align="center" class="table-border-pojok-tengah">SATUAN</th>
				<th width="15%" align="center" class="table-border-pojok-tengah">VOLUME</th>
				<th width="15%" align="center" class="table-border-pojok-tengah">HARGA SATUAN</th>
				<th width="20%" align="center" class="table-border-pojok-kanan">NILAI</th>
            </tr>
			<?php
			$awal = date('Y-m-d',strtotime($date1));
			$akhir = date('Y-m-d',strtotime($date2));
			
			$stock_opname_semen = $this->db->select('cat.*, sum(cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 1")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();

			$stock_opname_pasir = $this->db->select('cat.*, sum(cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 2")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();

			$stock_opname_1020 = $this->db->select('cat.*, sum(cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 3")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();

			$stock_opname_2030 = $this->db->select('cat.*, sum(cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 4")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();

			$stock_opname_solar = $this->db->select('cat.*, sum(cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 5")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();

			$stock_opname_additive = $this->db->select('cat.*, sum(cat.display_volume) as volume')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 19")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->row_array();

			$date1_ago = date('2020-01-01');
			$date2_ago = date('Y-m-d', strtotime('-1 days', strtotime($awal)));
			$date3_ago = date('Y-m-d', strtotime('-1 months', strtotime($awal)));
			$tanggal_opening_balance = date('Y-m-d', strtotime('-1 days', strtotime($awal)));

			$stock_opname_ago_semen = $this->db->select('cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 1")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$pembelian_semen = $this->db->select('SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("(prm.date_receipt between '$awal' and '$akhir')")
			->where("p.kategori_bahan = '1'")
			->where("po.status in ('PUBLISH','CLOSED')")
			->get()->row_array();

			$pemakaian_semen = $this->db->select('SUM(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("date between '$awal' and '$akhir'")
			->where("material_id = 1")
			->where("status = 'PUBLISH'")
			->get()->row_array();

			$persediaan_semen = ($stock_opname_ago_semen['nilai'] + $pembelian_semen['nilai'] - $pemakaian_semen['nilai']);

			$stock_opname_ago_pasir = $this->db->select('cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 2")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$pembelian_pasir = $this->db->select('SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("(prm.date_receipt between '$awal' and '$akhir')")
			->where("p.kategori_bahan = '2'")
			->where("po.status in ('PUBLISH','CLOSED')")
			->get()->row_array();

			$pemakaian_pasir = $this->db->select('SUM(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("date between '$awal' and '$akhir'")
			->where("material_id = 2")
			->where("status = 'PUBLISH'")
			->get()->row_array();

			$persediaan_pasir = ($stock_opname_ago_pasir['nilai'] + $pembelian_pasir['nilai'] - $pemakaian_pasir['nilai']);

			$stock_opname_ago_1020 = $this->db->select('cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 3")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$pembelian_1020 = $this->db->select('SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("(prm.date_receipt between '$awal' and '$akhir')")
			->where("p.kategori_bahan = '3'")
			->where("po.status in ('PUBLISH','CLOSED')")
			->get()->row_array();

			$pemakaian_1020 = $this->db->select('SUM(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("date between '$awal' and '$akhir'")
			->where("material_id = 3")
			->where("status = 'PUBLISH'")
			->get()->row_array();

			$persediaan_1020 = ($stock_opname_ago_1020['nilai'] + $pembelian_1020['nilai'] - $pemakaian_1020['nilai']);

			$stock_opname_ago_2030 = $this->db->select('cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 4")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$pembelian_2030 = $this->db->select('SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("(prm.date_receipt between '$awal' and '$akhir')")
			->where("p.kategori_bahan = '4'")
			->where("po.status in ('PUBLISH','CLOSED')")
			->get()->row_array();

			$pemakaian_2030 = $this->db->select('SUM(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("date between '$awal' and '$akhir'")
			->where("material_id = 4")
			->where("status = 'PUBLISH'")
			->get()->row_array();

			$persediaan_2030 = ($stock_opname_ago_2030['nilai'] + $pembelian_2030['nilai'] - $pemakaian_2030['nilai']);

			$stock_opname_ago_additive = $this->db->select('cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 19")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$pembelian_additive = $this->db->select('SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("(prm.date_receipt between '$awal' and '$akhir')")
			->where("p.kategori_bahan = '6'")
			->where("po.status in ('PUBLISH','CLOSED')")
			->get()->row_array();

			$pemakaian_additive = $this->db->select('SUM(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("date between '$awal' and '$akhir'")
			->where("material_id = 19")
			->where("status = 'PUBLISH'")
			->get()->row_array();

			$persediaan_additive = ($stock_opname_ago_additive['nilai'] + $pembelian_additive['nilai'] - $pemakaian_additive['nilai']);

			$stock_opname_ago_solar = $this->db->select('cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 5")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->row_array();

			$pembelian_solar = $this->db->select('SUM(prm.display_price) as nilai')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->where("(prm.date_receipt between '$awal' and '$akhir')")
			->where("p.kategori_bahan = '5'")
			->where("po.status in ('PUBLISH','CLOSED')")
			->get()->row_array();

			$pemakaian_solar = $this->db->select('SUM(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("date between '$awal' and '$akhir'")
			->where("material_id = 5")
			->where("status = 'PUBLISH'")
			->get()->row_array();

			$persediaan_solar = ($stock_opname_ago_solar['nilai'] + $pembelian_solar['nilai'] - $pemakaian_solar['nilai']);


			?>
			
			<tr class="table-baris2">
				<td align="left" class="table-border-pojok-kiri">Semen</td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$stock_opname_semen['display_measure']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($stock_opname_semen['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($persediaan_semen / $stock_opname_semen['volume'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($persediaan_semen,0,',','.'); ?></td>
			</tr>
			<tr class="table-baris2">
				<td align="left" class="table-border-pojok-kiri">Pasir</td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$stock_opname_pasir['display_measure']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($stock_opname_pasir['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($persediaan_pasir / $stock_opname_pasir['volume'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($persediaan_pasir,0,',','.'); ?></td>
			</tr>
			<tr class="table-baris2">
				<td align="left" class="table-border-pojok-kiri">Batu Split 10-20</td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$stock_opname_1020['display_measure']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($stock_opname_1020['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($persediaan_1020 / $stock_opname_1020['volume'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($persediaan_1020,0,',','.'); ?></td>
			</tr>
			<tr class="table-baris2">
				<td align="left" class="table-border-pojok-kiri">Batu Split 20-30</td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$stock_opname_2030['display_measure']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($stock_opname_2030['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($persediaan_2030 / $stock_opname_2030['volume'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($persediaan_2030,0,',','.'); ?></td>
			</tr>
			<tr class="table-baris2">
				<td align="left" class="table-border-pojok-kiri">Additive</td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$stock_opname_additive['display_measure']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($stock_opname_additive['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($persediaan_additive / $stock_opname_additive['volume'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($persediaan_additive,0,',','.'); ?></td>
			</tr>
			<tr class="table-baris2">
				<td align="left" class="table-border-pojok-kiri">Solar</td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$stock_opname_solar['display_measure']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($stock_opname_solar['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($persediaan_solar / $stock_opname_solar['volume'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($persediaan_solar,0,',','.'); ?></td>
			</tr>
			<tr class="table-total2">
				<td align="right" colspan="4" class="table-border-spesial-kiri">TOTAL</td>
				<td align="right" class="table-border-spesial-kanan"><?php echo number_format($persediaan_semen + $persediaan_pasir + $persediaan_1020 + $persediaan_2030 + $persediaan_additive + $persediaan_solar,0,',','.');?></td>
			</tr>
		</table>
		<br /><br />
		<table width="98%" border="0" cellpadding="30">
			<tr >
				<td width="5%"></td>
				<td width="90%">
					<table width="100%" border="0" cellpadding="2">
						<tr>
							<td align="center" >
								Diperiksa Oleh
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
								<b><u>Tri Wahyu Rahadi</u><br />
								Ka. Plant</b>
							</td>
							<td align="center">
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