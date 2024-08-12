<!DOCTYPE html>
<html>
	<head>
	  <title>Laporan Biaya</title>
	  
	  <style type="text/css">
		body {
			font-family: helvetica;
			font-size: 6.5px;
		}
		
	  	table.minimalistBlack {
		  border: 0px solid #000000;
		  width: 100%;
		  text-align: left;
		}
		table.minimalistBlack td, table.minimalistBlack th {
		  border: 1px solid #000000;
		  /*padding: 10px 4px;*/
		}
		table.minimalistBlack tr th {
		  /*font-size: 14px;*/
		  font-weight: bold;
		  color: #000000;
		  text-align: center;
		}
		table tr.table-active{
            background-color: #e69500;
        }
        table tr.table-active2{
            background-color: #b5b5b5;
        }
        table tr.table-active3{
            background-color: #eee;
        }
		hr{
			margin-top:0;
			margin-bottom:30px;
		}
		h3{
			margin-top:0;
		}
		.table-lap tr td, .table-lap tr th{
			border-bottom: 1px solid #000;
		}
	  </style>

	</head>
	<body>
		<table width="98%" border="0" cellpadding="3">
			<tr>
				<td align="center">
					<div style="display: block;font-weight: bold;font-size: 12px;">RINCIAN BIAYA UMUM & ADMINISTRASI</div>
				</td>
			</tr>
		</table>
		<br />
		<br />
		<br />
		<table class="table-lap" width="98%" border="0" cellpadding="3">
			<tr class="table-active" style="">
				<td width="80%" colspan="5">
					<div style="display: block;font-weight: bold;font-size: 8px;">PERIODE</div>
				</td>
				<td align="right" width="20%">
					<div style="display: block;font-weight: bold;font-size: 8px;"><?php echo $filter_date;?></div>
				</td>
			</tr>
			<tr class="table-active3">
				<th align="left" width="10%"><b>TRANSAKSI</b></th>
				<th align="left" width="10%"><b>NO. AKUN</b></th>
				<th align="left" width="20%"><b>NAMA AKUN</b></th>
				<th align="left" width="8%"><b>TANGGAL</b></th>
				<th align="left" width="20%"><b>NO. TRANSAKSI</b></th>
				<th align="left" width="22%"><b>DESKRIPSI</b></th>
				<th align="center" width="10%" align="right"><b>JUMLAH</b></th>
			</tr>
			<tr class="table-active2">
				<th width="100%" align="left" colspan="8"><b>HARGA POKOK PENJUALAN</b></th>
			</tr>
			<?php
			$total_biaya_langsung  = 0;
			if(!empty($biaya_langsung)){
				foreach ($biaya_langsung as $key => $bl) {
					?>
					<tr>
						<td width="10%">BIAYA</td>
						<td width="10%"><?= $bl['coa_number'];?></td>
						<td width="20%"><?= $bl['coa'];?></td>
						<td width="8%"><?= $bl['tanggal_transaksi'];?></td>
						<td width="20%"><?= $bl['nomor_transaksi'];?></td>
						<td width="22%"><?= $bl['deskripsi'];?></td>
						<td width="10%" align="right"><?php echo number_format($bl['total'],0,',','.');?></td>
					</tr>
					<?php
					$total_biaya_langsung += $bl['total'];	
				}
			}
			$total_biaya_langsung_jurnal  = 0;
			$grand_total_biaya_langsung = $total_biaya_langsung;
				if(!empty($biaya_langsung_jurnal)){
					foreach ($biaya_langsung_jurnal as $key => $blj) {
						?>	
						<tr>
							<td width="10%">JURNAL</td>
							<td width="10%"><?= $blj['coa_number'];?></td>
							<td width="20%"><?= $blj['coa'];?></td>
							<td width="8%"><?= $blj['tanggal_transaksi'];?></td>
							<td width="20%"><?= $blj['nomor_transaksi'];?></td>
							<td width="22%"><?= $blj['deskripsi'];?></td>
							<td width="10%" align="right"><?php echo number_format($blj['total'],0,',','.');?></td>
						</tr>
						<?php
						$total_biaya_langsung_jurnal += $blj['total'];					
					}
			}
			$total_a = $grand_total_biaya_langsung + $total_biaya_langsung_jurnal;
			?>
			<tr class="active">
				<td width="90%" align="right" style="padding-right:5px;"><b>TOTAL HARGA POKOK PENJUALAN</b></td>
				<td width="10%" align="right"><b><?php echo number_format($total_a,0,',','.');?></b></td>
			</tr>
			<tr>
				<th width="100%" colspan="6"></th>
			</tr>
			<tr class="table-active2">
				<th width="100%" align="left" colspan="8"><b>BEBAN LAINNYA</b></th>
			</tr>
			<?php
			$total_biaya_lainnya = 0;
			if(!empty($biaya_lainnya)){
				foreach ($biaya_lainnya as $key => $row) {
					?>
					<tr>
						<td width="10%">BIAYA</td>
						<td width="10%"><?= $row['coa_number'];?></td>
						<td width="20%"><?= $row['coa'];?></td>
						<td width="8%"><?= $row['tanggal_transaksi'];?></td>
						<td width="20%"><?= $row['nomor_transaksi'];?></td>
						<td width="22%"><?= $row['deskripsi'];?></td>
						<td width="10%" align="right"><?php echo number_format($row['total'],0,',','.');?></td>
					</tr>
					<?php
					$total_biaya_lainnya += $row['total'];					
				}
			}
			$total_biaya_lainnya_jurnal = 0;
			$grand_total_biaya_lainnya = $total_biaya_lainnya;
			if(!empty($biaya_lainnya_jurnal)){
				foreach ($biaya_lainnya_jurnal as $key => $row2) {
					?>
					<tr>
						<td width="10%">JURNAL</td>
						<td width="10%"><?= $row2['coa_number'];?></td>
						<td width="20%"><?= $row2['coa'];?></td>
						<td width="8%"><?= $row2['tanggal_transaksi'];?></td>
						<td width="20%"><?= $row2['nomor_transaksi'];?></td>
						<td width="22%"><?= $row2['deskripsi'];?></td>
						<td width="10%" align="right"><?php echo number_format($row2['total'],0,',','.');?></td>
					</tr>
					<?php
					$total_biaya_lainnya_jurnal += $row2['total'];					
				}
			}
			$total_c = $grand_total_biaya_lainnya + $total_biaya_lainnya_jurnal;
			?>
			<tr class="active">
				<td width="90%" align="right" style="padding-right:5px;"><b>TOTAL BEBAN LAINNYA</b></td>
				<td width="10%" align="right"><b><?php echo number_format($total_c,0,',','.');?></b></td>
			</tr>
		</table>
		
	</body>
</html>