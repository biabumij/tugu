<!DOCTYPE html>
<html>
	<head>

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
		<?php
		$tanggal = date('F Y', strtotime($rak['tanggal_rencana_kerja']));
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
		
		$subject = "$tanggal";
		?>
			
		<div align="center" style="display: block;font-weight: bold;font-size: 12px;text-transform:uppercase;">RENCANA KERJA<br/>
		PROYEK BENDUNGAN TUGU<br/>
		PT. BIA BUMI JAYENDRA<br/>
		BULAN <?php echo str_replace($search, $replace, $subject);?></div>
				
		<br />
		<br />

		<div align="left" style="display: block;font-weight: bold;font-size: 9px;text-transform:uppercase;">1. RENCANA PRODUKSI</div>
		<br />
		<table cellpadding="3" width="98%">
			<tr class="table-judul">
				<?php
					$total = 0;
					$total = $rak['vol_produk_a'] + $rak['vol_produk_b'];
				?>
                <th width="5%" align="center" class="table-border-pojok-kiri">NO.</th>
                <th width="20%" align="center" class="table-border-pojok-tengah">URAIAN</th>
				<th width="20%" align="center" class="table-border-pojok-tengah">VOLUME</th>
				<th width="15%" align="center" class="table-border-pojok-tengah">SATUAN</th>
				<th width="20%" align="center" class="table-border-pojok-tengah">HARGA SATUAN</th>
				<th width="20%" align="center" class="table-border-pojok-kanan">TOTAL</th>
            </tr>
			<tr class="table-baris1">
				<td align="center" class="table-border-pojok-kiri">1.</td>
				<td align="left" class="table-border-pojok-tengah">Beton K-300 (10±2)</td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($rak['vol_produk_a'],2,',','.'); ?></td>
				<td align="center" class="table-border-pojok-tengah">M3</td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($rak['price_a'],0,',','.'); ?></td>
				<?php
				$a1 = round($rak['vol_produk_a'],2);
				$a2 = round($rak['price_a'],0);
				$a3 = $a1 * $a2;
				?>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($a3,0,',','.'); ?></td>
			</tr>
			<tr class="table-baris1">
				<td align="center" class="table-border-pojok-kiri">2.</td>
				<td align="left" class="table-border-pojok-tengah">Beton K-300 (18±2)</td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($rak['vol_produk_b'],2,',','.'); ?></td>
				<td align="center" class="table-border-pojok-tengah">M3</td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($rak['price_b'],0,',','.'); ?></td>
				<?php
				$b1 = round($rak['vol_produk_b'],2);
				$b2 = round($rak['price_b'],0);
				$b3 = $b1 * $b2;
				?>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($b3,0,',','.'); ?></td>
			</tr>
			<?php
			$total_pendapatan = $a3 + $b3;
			?>
			<tr class="table-total">
				<td align="right" colspan="2" class="table-border-pojok-kiri">RENCANA PRODUKSI</td>
				<td align="right" class="table-border-pojok-tengah"><?= number_format($total,2,',','.'); ?></td>
				<td align="center" class="table-border-pojok-tengah">M3</td>
				<td align="center" class="table-border-pojok-tengah"></td>
				<td align="right" class="table-border-pojok-kanan"><?= number_format($total_pendapatan,0,',','.'); ?></td>
			</tr>
		</table>
		<br />
		<br />
		<br />
		<div align="left" style="display: block;font-weight: bold;font-size: 9px;text-transform:uppercase;">2. BIAYA</div>
		<br />
		<table cellpadding="3" width="98%">
			<tr class="table-judul">
				<th width="5%" align="center" class="table-border-pojok-kiri">NO.</th>
				<th width="25%" align="center" class="table-border-pojok-tengah">URAIAN</th>
				<th width="15%" align="center" class="table-border-pojok-tengah">VOLUME</th>
				<th width="15%" align="center" class="table-border-pojok-tengah">SATUAN</th>
				<th width="20%" align="center" class="table-border-pojok-tengah">HARGA SATUAN</th>
				<th width="20%" align="center" class="table-border-pojok-kanan">TOTAL</th>
			</tr>
			<?php

			$tanggal_rencana_kerja = date('Y-m-d', strtotime($rak['tanggal_rencana_kerja']));
	
			$komposisi_300 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as komposisi_semen_300, (vol_produk_a * pk.presentase_b) as komposisi_pasir_300, (vol_produk_a * pk.presentase_c) as komposisi_batu1020_300, (vol_produk_a * pk.presentase_d) as komposisi_batu2030_300, (vol_produk_a * pk.presentase_e) as komposisi_additive_300')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300 = pk.id','left')
			->where("r.tanggal_rencana_kerja = '$tanggal_rencana_kerja'")
			->get()->result_array();

			$total_volume_semen_300 = 0;
			$total_volume_pasir_300 = 0;
			$total_volume_batu1020_300 = 0;
			$total_volume_batu2030_300 = 0;
			$total_volume_additive_300 = 0;

			foreach ($komposisi_300 as $x){
				$total_volume_semen_300 = $x['komposisi_semen_300'];
				$total_volume_pasir_300 = $x['komposisi_pasir_300'];
				$total_volume_batu1020_300 = $x['komposisi_batu1020_300'];
				$total_volume_batu2030_300 = $x['komposisi_batu2030_300'];
				$total_volume_additive_300 = $x['komposisi_additive_300'];
			}

			$komposisi_300_18 = $this->db->select('(r.vol_produk_a * pk.presentase_a) as komposisi_semen_300_18, (vol_produk_a * pk.presentase_b) as komposisi_pasir_300_18, (vol_produk_a * pk.presentase_c) as komposisi_batu1020_300_18, (vol_produk_a * pk.presentase_d) as komposisi_batu2030_300_18, (vol_produk_a * pk.presentase_e) as komposisi_additive_300_18')
			->from('rak r')
			->join('pmm_agregat pk', 'r.komposisi_300_18 = pk.id','left')
			->where("r.tanggal_rencana_kerja = '$tanggal_rencana_kerja'")
			->get()->result_array();

			$total_volume_semen_300_18 = 0;
			$total_volume_pasir_300_18 = 0;
			$total_volume_batu1020_300_18 = 0;
			$total_volume_batu2030_300_18 = 0;
			$total_volume_additive_300_18 = 0;

			foreach ($komposisi_300_18 as $x){
				$total_volume_semen_300_18 = $x['komposisi_semen_300_18'];
				$total_volume_pasir_300_18 = $x['komposisi_pasir_300_18'];
				$total_volume_batu1020_300_18 = $x['komposisi_batu1020_300_18'];
				$total_volume_batu2030_300_18 = $x['komposisi_batu2030_300_18'];
				$total_volume_additive_300_18 = $x['komposisi_additive_300_18'];
			}

			$total_volume_semen = $total_volume_semen_300 + $total_volume_semen_300_18;
			$total_volume_pasir = $total_volume_pasir_300 + $total_volume_pasir_300_18;
			$total_volume_batu1020 = $total_volume_batu1020_300 + $total_volume_batu1020_300_18;
			$total_volume_batu2030 = $total_volume_batu2030_300 + $total_volume_batu2030_300_18;
			$total_volume_additive = $total_volume_additive_300 + $total_volume_additive_300_18;

			$volume_produksi = $this->db->select('r.*, SUM(r.vol_produk_a) as vol_produk_a')
			->from('rak r')
			->where("r.tanggal_rencana_kerja = '$tanggal_rencana_kerja'")
			->get()->row_array();

			$volume_produksi_produk_a = $volume_produksi['vol_produk_a'];
			$volume_produksi_produk_b = $volume_produksi['vol_produk_b'];
			
			$total_volume_solar = $volume_produksi['vol_bbm_solar'];

			?>
			<tr>
				<th align="center" class="table-border-spesial" colspan="6">
					<div align="left" style="display: block;font-weight: bold;font-size: 9px;text-transform:uppercase;">2.1. BAHAN</div>
				</th>	
			</tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">1</th>	
				<th align="left" class="table-border-pojok-tengah">Semen</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($total_volume_semen,2,',','.');?></th>
				<th align="center" class="table-border-pojok-tengah">Ton</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rak['harga_semen'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan"><?php echo number_format($total_volume_semen * $rak['harga_semen'],0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">2</th>	
				<th align="left" class="table-border-pojok-tengah">Pasir</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($total_volume_pasir,2,',','.');?></th>
				<th align="center" class="table-border-pojok-tengah">M3</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rak['harga_pasir'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan"><?php echo number_format($total_volume_pasir * $rak['harga_pasir'],0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">3</th>	
				<th align="left" class="table-border-pojok-tengah">Batu Split 10-20</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($total_volume_batu1020,2,',','.');?></th>
				<th align="center" class="table-border-pojok-tengah">M3</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rak['harga_batu1020'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan"><?php echo number_format($total_volume_batu1020 * $rak['harga_batu1020'],0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">4</th>	
				<th align="left" class="table-border-pojok-tengah">Batu Split 20-30</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($total_volume_batu2030,2,',','.');?></th>
				<th align="center" class="table-border-pojok-tengah">M3</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rak['harga_batu2030'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan"><?php echo number_format($total_volume_batu2030 * $rak['harga_batu2030'],0,',','.');?></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">5</th>	
				<th align="left" class="table-border-pojok-tengah">Additive</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($total_volume_additive,2,',','.');?></th>
				<th align="center" class="table-border-pojok-tengah">M3</th>
				<th align="right" class="table-border-pojok-tengah"><?php echo number_format($rak['harga_additive'],0,',','.');?></th>
				<th align="right" class="table-border-pojok-kanan"><?php echo number_format($total_volume_additive * $rak['harga_additive'],0,',','.');?></th>
	        </tr>
			<?php
			$total = ($total_volume_semen * $rak['harga_semen']) + ($total_volume_pasir * $rak['harga_pasir']) + ($total_volume_batu1020 * $rak['harga_batu1020']) + ($total_volume_batu2030 * $rak['harga_batu2030']) + ($total_volume_additive * $rak['harga_additive']);
			?>
			<tr class="table-total2">	
				<th align="right" colspan="5" class="table-border-spesial-kiri">TOTAL KEBUTUHAN BIAYA BAHAN</th>
				<th align="right" class="table-border-spesial-kanan"><?php echo number_format($total,0,',','.');?></th>
	        </tr>
			<tr>
				<th align="center" class="table-border-spesial" colspan="6">
				<div align="left" style="display: block;font-weight: bold;font-size: 9px;text-transform:uppercase;">2.2. ALAT</div>
				</th>	
			</tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">1</th>	
				<th align="left" class="table-border-pojok-tengah">Batching Plant</th>
				<th align="right" class="table-border-pojok-tengah"></th>
				<th align="center" class="table-border-pojok-tengah"></th>
				<th align="right" class="table-border-pojok-tengah"></th>
				<th align="right" class="table-border-pojok-kanan"></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">2</th>	
				<th align="left" class="table-border-pojok-tengah">Truck Mixer</th>
				<th align="right" class="table-border-pojok-tengah"></th>
				<th align="center" class="table-border-pojok-tengah"></th>
				<th align="right" class="table-border-pojok-tengah"></th>
				<th align="right" class="table-border-pojok-kanan"></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">3</th>	
				<th align="left" class="table-border-pojok-tengah">Wheel Loader</th>
				<th align="right" class="table-border-pojok-tengah"></th>
				<th align="center" class="table-border-pojok-tengah"></th>
				<th align="right" class="table-border-pojok-tengah"></th>
				<th align="right" class="table-border-pojok-kanan"></th>
	        </tr>
			<tr class="table-baris1">
				<th align="center" class="table-border-pojok-kiri">4</th>	
				<th align="left" class="table-border-pojok-tengah">BBM Solar</th>
				<th align="right" class="table-border-pojok-tengah"></th>
				<th align="center" class="table-border-pojok-tengah"></th>
				<th align="right" class="table-border-pojok-tengah"></th>
				<th align="right" class="table-border-pojok-kanan"></th>
	        </tr>
			<tr class="table-total2">	
				<th align="right" colspan="5" class="table-border-spesial-kiri">TOTAL KEBUTUHAN BIAYA ALAT</th>
				<th align="right" class="table-border-spesial-kanan"><?php echo number_format($total_rak_alat,0,',','.');?></th>
	        </tr>
			<tr>
				<th align="center" class="table-border-spesial" colspan="6">
					<div align="left" style="display: block;font-weight: bold;font-size: 9px;text-transform:uppercase;">2.3. BIAYA UMUM & ADMINISTRATIF</div>
				</th>	
			</tr>
			<tr class="table-total">	
				<th align="right" colspan="5" class="table-border-spesial-kiri">TOTAL BIAYA UMUM & ADMINISTRATIF</th>
				<th align="right" class="table-border-spesial-kanan"><?php echo number_format($rak_alat['overhead'],0,',','.');?></th>
	        </tr>
			<tr>
				<th class="table-border-spesial" colspan="6"></th>
			</tr>
			<tr class="table-total">	
				<th align="right" colspan="5" class="table-border-spesial-kiri">SUBTOTAL KEBUTUHAN BIAYA (2.1 + 2.2 + 2.3)</th>
				<th align="right" class="table-border-spesial-kanan"><?php echo number_format($total + $total_rak_alat + $rak_alat['overhead'],0,',','.');?></th>
	        </tr>
		</table>
	</body>
</html>