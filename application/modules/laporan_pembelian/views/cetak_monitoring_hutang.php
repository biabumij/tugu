<!DOCTYPE html>
<html>
	<head>
	  <title>MONITORING HUTANG</title>
	  
	  <style type="text/css">
		body {
			font-family: helvetica;
		}

		table.table-border-atas-full, th.table-border-atas-full, td.table-border-atas-full {
			border-top: 1px solid black;
			border-bottom: 1px solid black;
		}

		table.table-border-atas-only, th.table-border-atas-only, td.table-border-atas-only {
			border-top: 1px solid black;
		}

		table.table-border-bawah-only, th.table-border-bawah-only, td.table-border-bawah-only {
			border-bottom: 1px solid black;
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
		<table width="98%" border="0" cellpadding="15">
			<tr>
				<td width="100%" align="center">
					<div style="display: block;font-weight: bold;font-size: 11px;">Monitoring Hutang</div>
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
					<div style="display: block;font-weight: bold;font-size: 11px;">Per <?= tgl_indo(date($date2)); ?></div>
				</td>
			</tr>
		</table>	
		<table cellpadding="2" width="98%">
			<tr class="table-judul">
				<th width="3%" align="center" rowspan="2" class="table-border-atas-full">&nbsp; <br />NO.</th>
				<th width="12%" align="center" rowspan="2" class="table-border-atas-full">&nbsp; <br />REKANAN / NO. TAGIHAN</th>
				<th width="5%" align="center" rowspan="2" class="table-border-atas-full">&nbsp; <br />TGL. TAGIHAN</th>
				<th width="10%" align="center" rowspan="2" class="table-border-atas-full">&nbsp; <br />JENIS PEMBELIAN</th>
				<th width="5%" align="center" rowspan="2" class="table-border-atas-full">TGL. VERIFIKASI</th>
				<th width="5%" align="center" rowspan="2" class="table-border-atas-full">SYARAT PEMBAYARAN</th>
				<th width="15%" align="center" colspan="3" class="table-border-atas-only">TAGIHAN</th>
				<th width="20%" align="center" colspan="4" class="table-border-atas-only">PEMBAYARAN</th>
				<th width="15%" align="center" colspan="3" class="table-border-atas-only">SISA HUTANG</th>
				<th width="5%" align="center" rowspan="2" class="table-border-atas-full">&nbsp; <br />STATUS</th>
				<th width="5%" align="center" rowspan="2" class="table-border-atas-full">TGL. JATUH TEMPO</th>
			</tr>
			<tr class="table-judul">
				<th align="center" class="table-border-bawah-only">DPP</th>
				<th align="center" class="table-border-bawah-only">PPN</th>
				<th align="center" class="table-border-bawah-only">JUMLAH</th>
				<th align="center" class="table-border-bawah-only">DPP</th>
				<th align="center" class="table-border-bawah-only">PPN</th>
				<th align="center" class="table-border-bawah-only">PPH</th>
				<th align="center" class="table-border-bawah-only">JUMLAH</th>
				<th align="center" class="table-border-bawah-only">DPP</th>
				<th align="center" class="table-border-bawah-only">PPN</th>
				<th align="center" class="table-border-bawah-only">JUMLAH</th>
			</tr>		
            <?php   
            if(!empty($data)){
            	foreach ($data as $key => $row) {
            		?>
            		<tr class="table-baris1-bold">
            			<td align="center"><?php echo $key + 1;?></td>
            			<td align="left" colspan="17"><?php echo $row['name'];?></td>
            		</tr>
					<?php
					$jumlah_dpp_tagihan = 0;
					$jumlah_ppn_tagihan = 0;
					$jumlah_jumlah_tagihan = 0;
					$jumlah_dpp_pembayaran = 0;
					$jumlah_ppn_pembayaran = 0;
					$jumlah_pph_pembayaran = 0;
					$jumlah_jumlah_pembayaran = 0;
					$jumlah_dpp_sisa_hutang = 0;
					$jumlah_ppn_sisa_hutang = 0;
					$jumlah_jumlah_sisa_hutang = 0;
            		foreach ($row['mats'] as $mat) {
            			?>
					<tr class="table-baris1">
						<td align="center"></td>
						<td align="left"><?php echo $mat['nomor_invoice'];?></td>
						<td align="center"><?php echo $mat['tanggal_invoice'];?></td>
						<td align="left"><?php echo $mat['subject'];?></td>
            			<td align="left"><?php echo $mat['tanggal_lolos_verifikasi'];?></td>
						<td align="center"><?php echo $mat['syarat_pembayaran'];?></td>
            			<td align="right"><?php echo $mat['dpp_tagihan'];?></td>
						<td align="right"><?php echo $mat['ppn_tagihan'];?></td>
						<td align="right"><?php echo $mat['jumlah_tagihan'];?></td>
						<td align="right"><?php echo $mat['dpp_pembayaran'];?></td>
						<td align="right"><?php echo $mat['ppn_pembayaran'];?></td>
						<td align="right"><?php echo $mat['pph_pembayaran'];?></td>
						<td align="right"><?php echo $mat['jumlah_pembayaran'];?></td>
						<td align="right"><?php echo $mat['dpp_sisa_hutang'];?></td>
						<td align="right"><?php echo $mat['ppn_sisa_hutang'];?></td>
						<td align="right"><?php echo $mat['jumlah_sisa_hutang'];?></td>
						<td align="center"><?php echo $mat['status'];?></td>
						<td align="center"><?php echo $mat['jatuh_tempo'];?></td>
            		</tr>

					<?php
					$jumlah_dpp_tagihan += str_replace(['.', ','], ['', '.'], $mat['dpp_tagihan']);
					$jumlah_ppn_tagihan += str_replace(['.', ','], ['', '.'], $mat['ppn_tagihan']);
					$jumlah_jumlah_tagihan += str_replace(['.', ','], ['', '.'], $mat['jumlah_tagihan']);
					$jumlah_dpp_pembayaran += str_replace(['.', ','], ['', '.'], $mat['dpp_pembayaran']);
					$jumlah_ppn_pembayaran += str_replace(['.', ','], ['', '.'], $mat['ppn_pembayaran']);
					$jumlah_pph_pembayaran += str_replace(['.', ','], ['', '.'], $mat['pph_pembayaran']);
					$jumlah_jumlah_pembayaran += str_replace(['.', ','], ['', '.'], $mat['jumlah_pembayaran']);
					$jumlah_dpp_sisa_hutang += str_replace(['.', ','], ['', '.'], $mat['dpp_sisa_hutang']);
					$jumlah_ppn_sisa_hutang += str_replace(['.', ','], ['', '.'], $mat['ppn_sisa_hutang']);
					$jumlah_jumlah_sisa_hutang += str_replace(['.', ','], ['', '.'], $mat['jumlah_sisa_hutang']);
					}	
					?>
					<tr class="table-baris1-bold">
						<td align="right" colspan="6" class="table-border-atas-only">JUMLAH</td>
						<td align="right" class="table-border-atas-only"><?php echo number_format($jumlah_dpp_tagihan,0,',','.');?></td>
						<td align="right" class="table-border-atas-only"><?php echo number_format($jumlah_ppn_tagihan,0,',','.');?></td>
						<td align="right" class="table-border-atas-only"><?php echo number_format($jumlah_jumlah_tagihan,0,',','.');?></td>
						<td align="right" class="table-border-atas-only"><?php echo number_format($jumlah_dpp_pembayaran,0,',','.');?></td>
						<td align="right" class="table-border-atas-only"><?php echo number_format($jumlah_ppn_pembayaran,0,',','.');?></td>
						<td align="right" class="table-border-atas-only"><?php echo number_format($jumlah_pph_pembayaran,0,',','.');?></td>
						<td align="right" class="table-border-atas-only"><?php echo number_format($jumlah_jumlah_pembayaran,0,',','.');?></td>
						<td align="right" class="table-border-atas-only"><?php echo number_format($jumlah_dpp_sisa_hutang,0,',','.');?></td>
						<td align="right" class="table-border-atas-only"><?php echo number_format($jumlah_ppn_sisa_hutang,0,',','.');?></td>
						<td align="right" class="table-border-atas-only"><?php echo number_format($jumlah_jumlah_sisa_hutang,0,',','.');?></td>
						<td align="center" class="table-border-atas-only"></td>
						<td align="center" class="table-border-atas-only"></td>
            		</tr>
					<?php
            		}
            }else {
            	?>
            	<tr>
            		<td width="100%" colspan="18" align="center">Tidak Ada Data</td>
            	</tr>
            	<?php
            }
            ?>
            <tr class="table-judul">
				<th align="right" colspan="6" class="table-border-atas-full">TOTAL</th>
				<th align="right" class="table-border-atas-full"><?php echo number_format($total_dpp_tagihan,0,',','.');?></th>
				<th align="right" class="table-border-atas-full"><?php echo number_format($total_ppn_tagihan,0,',','.');?></th>
				<th align="right" class="table-border-atas-full"><?php echo number_format($total_jumlah_tagihan,0,',','.');?></th>
				<th align="right" class="table-border-atas-full"><?php echo number_format($total_dpp_pembayaran,0,',','.');?></th>
				<th align="right" class="table-border-atas-full"><?php echo number_format($total_ppn_pembayaran,0,',','.');?></th>
				<th align="right" class="table-border-atas-full"><?php echo number_format($total_pph_pembayaran,0,',','.');?></th>
				<th align="right" class="table-border-atas-full"><?php echo number_format($total_jumlah_pembayaran,0,',','.');?></th>
				<th align="right" class="table-border-atas-full"><?php echo number_format($total_dpp_sisa_hutang,0,',','.');?></th>
				<th align="right" class="table-border-atas-full"><?php echo number_format($total_ppn_sisa_hutang,0,',','.');?></th>
				<th align="right" class="table-border-atas-full"><?php echo number_format($total_jumlah_sisa_hutang,0,',','.');?></th>
				<td align="center" class="table-border-atas-full"></td>
				<td align="center" class="table-border-atas-full"></td>
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
							<td align="center">
								Diperiksa Oleh
							</td>
							<td align="center">
								Disetujui Oleh
							</td>
						</tr>
						<tr class="">
							<td align="center" height="55px">
								<img src="uploads/ttd_rifka.png" width="70px">
							</td>
							<td align="center">
								<img src="uploads/ttd_tri.png" width="70px">
							</td>
							<td align="center">
								<img src="uploads/ttd_tri.png" width="70px">
							</td>
						</tr>
						<tr>
						<td align="center">
								<b><u>Rifka Dian Bethary </u><br />
								Keuangan</b>
							</td>
							<td align="center">
								<b><u>Tri Wahyu Rahadi </u><br />
								Ka. Plant</b>
							</td>
							<td align="center">
								<b><u>Tri Wahyu Rahadi </u><br />
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