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
					<div style="display: block;font-weight: bold;font-size: 11px;">Biaya Bahan</div>
					<div style="display: block;font-weight: bold;font-size: 11px;">Proyek Bendungan Tugu</div>
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
					<div style="display: block;font-weight: bold;font-size: 11px;">Periode sd. <?= tgl_indo(date($date2)); ?></div>
				</td>
			</tr>
		</table>
		<br />
		<br />
		<br />
		<table width="98%" cellpadding="5" border="1">
			<?php
			$pemakaian_semen = $this->db->select('sum(volume) as volume, sum(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("(date <= '$date2')")
			->where("material_id = 1")
			->where("status = 'PUBLISH'")
			->get()->row_array();
	
			$pemakaian_volume_semen = $pemakaian_semen['volume'];
			$pemakaian_nilai_semen = $pemakaian_semen['nilai'];
			$pemakaian_harsat_semen = ($pemakaian_volume_semen!=0)?$pemakaian_nilai_semen / $pemakaian_volume_semen * 1:0;
			
			$pemakaian_pasir = $this->db->select('sum(volume) as volume, sum(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("(date <= '$date2')")
			->where("material_id = 2")
			->where("status = 'PUBLISH'")
			->get()->row_array();
	
			$pemakaian_volume_pasir = $pemakaian_pasir['volume'];
			$pemakaian_nilai_pasir = $pemakaian_pasir['nilai'];
			$pemakaian_harsat_pasir = ($pemakaian_volume_pasir!=0)?$pemakaian_nilai_pasir / $pemakaian_volume_pasir * 1:0;
	
			$pemakaian_1020 = $this->db->select('sum(volume) as volume, sum(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("(date <= '$date2')")
			->where("material_id = 3")
			->where("status = 'PUBLISH'")
			->get()->row_array();
	
			$pemakaian_volume_1020 = $pemakaian_1020['volume'];
			$pemakaian_nilai_1020 = $pemakaian_1020['nilai'];
			$pemakaian_harsat_1020 = ($pemakaian_volume_1020!=0)?$pemakaian_nilai_1020 / $pemakaian_volume_1020 * 1:0;
	
			$pemakaian_2030 = $this->db->select('sum(volume) as volume, sum(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("(date <= '$date2')")
			->where("material_id = 4")
			->where("status = 'PUBLISH'")
			->get()->row_array();
	
			$pemakaian_volume_2030 = $pemakaian_2030['volume'];
			$pemakaian_nilai_2030 = $pemakaian_2030['nilai'];
			$pemakaian_harsat_2030 = ($pemakaian_volume_2030!=0)?$pemakaian_nilai_2030 / $pemakaian_volume_2030 * 1:0;
	
			$pemakaian_additive = $this->db->select('sum(volume) as volume, sum(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("(date <= '$date2')")
			->where("material_id = 19")
			->where("status = 'PUBLISH'")
			->get()->row_array();
	
			$pemakaian_volume_additive = $pemakaian_additive['volume'];
			$pemakaian_nilai_additive = $pemakaian_additive['nilai'];
			$pemakaian_harsat_additive = ($pemakaian_volume_additive!=0)?$pemakaian_nilai_additive / $pemakaian_volume_additive * 1:0;
	
			$total_volume_realisasi = $pemakaian_volume_semen + $pemakaian_volume_pasir + $pemakaian_volume_1020 + $pemakaian_volume_2030 + $pemakaian_volume_additive;
			$total_nilai_realisasi = $pemakaian_nilai_semen + $pemakaian_nilai_pasir + $pemakaian_nilai_1020 + $pemakaian_nilai_2030 + $pemakaian_nilai_additive;
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
				<th align="right"><?php echo number_format($total_nilai_realisasi,0,',','.');?></th>
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