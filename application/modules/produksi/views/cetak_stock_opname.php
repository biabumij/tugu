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
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">STOCK OPNAME BAHAN</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">PROYEK BENDUNGAN TUGU</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">PT. BIA BUMI JAYENDRA</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px; text-transform: uppercase;"><?php echo str_replace($search, $replace, $subject);?></div>
		<br /><br /><br />
		<table cellpadding="2" width="98%">
			<tr class="table-judul">
                <th width="15%" align="center" class="table-border-pojok-kiri">TANGGAL</th>
                <th width="20%" align="center" class="table-border-pojok-tengah">URAIAN</th>
				<th width="15%" align="center" class="table-border-pojok-tengah">SATUAN</th>
				<th width="15%" align="center" class="table-border-pojok-tengah">VOLUME</th>
				<th width="15%" align="center" class="table-border-pojok-tengah">HARGA SATUAN</th>
				<th width="20%" align="center" class="table-border-pojok-kanan">NILAI</th>
            </tr>
			<?php
			$awal = date('Y-m-d',strtotime($date1));
			$akhir = date('Y-m-d',strtotime($date2));
			
			$stock_opname_semen = $this->db->select('cat.*, sum(cat.total) as nilai')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 1")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->result_array();
			$nilai_semen = 0;
			foreach ($stock_opname_semen as $x){
				$nilai_semen += $x['nilai'];
			}

			$stock_opname_pasir = $this->db->select('cat.*, sum(cat.total) as nilai')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 2")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->result_array();
			$nilai_pasir = 0;
			foreach ($stock_opname_pasir as $x){
				$nilai_pasir += $x['nilai'];
			}

			$stock_opname_batu1020 = $this->db->select('cat.*, sum(cat.total) as nilai')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 3")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->result_array();
			$nilai_batu1020 = 0;
			foreach ($stock_opname_batu1020 as $x){
				$nilai_batu1020 += $x['nilai'];
			}

			$stock_opname_batu2030 = $this->db->select('cat.*, sum(cat.total) as nilai')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 4")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->result_array();
			$nilai_batu2030 = 0;
			foreach ($stock_opname_batu2030 as $x){
				$nilai_batu2030 += $x['nilai'];
			}

			$stock_opname_solar = $this->db->select('cat.*, sum(cat.total) as nilai')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 5")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->result_array();
			$nilai_solar = 0;
			foreach ($stock_opname_solar as $x){
				$nilai_solar += $x['nilai'];
			}

			$stock_opname_additive = $this->db->select('cat.*, sum(cat.total) as nilai')
			->from('pmm_remaining_materials_cat cat')
			->where("cat.date between '$awal' and '$akhir'")
			->where("cat.material_id = 19")
			->where("cat.status = 'PUBLISH'")
			->group_by('cat.id')
			->order_by('cat.date','desc')->limit(1)
			->get()->result_array();
			$nilai_additive = 0;
			foreach ($stock_opname_additive as $x){
				$nilai_additive += $x['nilai'];
			}

			?>
			<?php
			foreach ($stock_opname_semen as $row) : ?>  
			<tr class="table-baris2">
				<td align="center" class="table-border-pojok-kiri"><?php echo $row['date'] = date('d-m-Y',strtotime($row['date']));;?></td>
				<td align="left" class="table-border-pojok-tengah">Semen</td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$row['satuan']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['price'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($row['total'],0,',','.'); ?></td>
			</tr>
			<?php
			endforeach; ?>
			
			<?php
			foreach ($stock_opname_pasir as $row) : ?>  
			<tr class="table-baris2">
				<td align="center" class="table-border-pojok-kiri"><?php echo $row['date'] = date('d-m-Y',strtotime($row['date']));;?></td>
				<td align="left" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('produk',array('id'=>$row['material_id']),'nama_produk');?></td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$row['satuan']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['price'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($row['total'],0,',','.'); ?></td>
			</tr>
			<?php
			endforeach; ?>

			<?php
			foreach ($stock_opname_batu1020 as $row) : ?>  
			<tr class="table-baris2">
				<td align="center" class="table-border-pojok-kiri"><?php echo $row['date'] = date('d-m-Y',strtotime($row['date']));;?></td>
				<td align="left" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('produk',array('id'=>$row['material_id']),'nama_produk');?></td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$row['satuan']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['price'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($row['total'],0,',','.'); ?></td>
			</tr>
			<?php
			endforeach; ?>

			<?php
			foreach ($stock_opname_batu2030 as $row) : ?>  
			<tr class="table-baris2">
				<td align="center" class="table-border-pojok-kiri"><?php echo $row['date'] = date('d-m-Y',strtotime($row['date']));;?></td>
				<td align="left" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('produk',array('id'=>$row['material_id']),'nama_produk');?></td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$row['satuan']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['price'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($row['total'],0,',','.'); ?></td>
			</tr>
			<?php
			endforeach; ?>

			<?php
			foreach ($stock_opname_solar as $row) : ?>  
			<tr class="table-baris2">
				<td align="center" class="table-border-pojok-kiri"><?php echo $row['date'] = date('d-m-Y',strtotime($row['date']));;?></td>
				<td align="left" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('produk',array('id'=>$row['material_id']),'nama_produk');?></td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$row['satuan']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['price'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($row['total'],0,',','.'); ?></td>
			</tr>
			<?php
			endforeach; ?>

			<?php
			foreach ($stock_opname_additive as $row) : ?>  
			<tr class="table-baris2">
				<td align="center" class="table-border-pojok-kiri"><?php echo $row['date'] = date('d-m-Y',strtotime($row['date']));;?></td>
				<td align="left" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('produk',array('id'=>$row['material_id']),'nama_produk');?></td>
				<td align="center" class="table-border-pojok-tengah"><?php echo $this->crud_global->GetField('pmm_measures',array('id'=>$row['satuan']),'measure_name');?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['volume'],2,',','.'); ?></td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($row['price'],0,',','.'); ?></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($row['total'],0,',','.'); ?></td>
			</tr>
			<?php
			endforeach; ?>

			<tr class="table-total2">
				<td align="right" colspan="5" class="table-border-spesial-kiri">TOTAL</td>
				<td align="right" class="table-border-spesial-kanan"><?php echo number_format($nilai_semen + $nilai_pasir + $nilai_batu1020 + $nilai_batu2030 + $nilai_solar + $nilai_additive,0,',','.');?></td>
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