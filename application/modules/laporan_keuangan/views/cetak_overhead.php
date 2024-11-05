<!DOCTYPE html>
<html>
	<head>
	  <title>OVERHEAD</title>

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
		table tr.table-active4{
            font-weight: bold;
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
					<div style="display: block;font-weight: bold;font-size: 11px;">LAPORAN BIAYA UMUM & ADMINISTRATIF</div>
					<div align="center" style="display: block;font-weight:bold; font-size: 11px;">PROYEK BENDUNGAN TUGU</div>
					<div align="center" style="display: block;font-weight:bold; font-size: 11px;">PT. BIA BUMI JAYENDRA</div>
					<div align="center" style="display: block;font-weight:bold; font-size: 11px; text-transform: uppercase;">PERIODE : <?php echo str_replace($search, $replace, $subject);?></div>
				</td>
			</tr>
		</table>
		<br />
		<br />
		<br />
		<table class="table-lap" width="98%" border="0" cellpadding="3">
			<tr class="table-active">
				<th align="center" width="20%"><b>KODE AKUN</b></th>
				<th align="center" width="50%"><b>NAMA AKUN</b></th>
				<th align="center" width="30%" align="right"><b>JUMLAH</b></th>
			</tr>
			<tr class="table-active4">
				<td align="left" width="100%"><b>BIAYA</b></td>
			</tr>
			$total_biaya_langsung  = 0;
			if(!empty($biaya_langsung)){
				foreach ($biaya_langsung as $key => $bl) {
					?>
					<tr>
						<td width="20%" align="center"><?= $bl['coa_number'];?></td>
						<td width="2%"></td>
						<td width="48%"><?= $bl['coa'];?></td>
						<td width="30%" align="right"><?php echo number_format($bl['total'],0,',','.');?></td>
					</tr>
					<?php
					$total_biaya_langsung += $bl['total'];	
				}
			}

			if(!empty($biaya_langsung_jurnal_parent)){
				foreach ($biaya_langsung_jurnal_parent as $key => $blj) {
					?>	
					<tr>
						<td align="left" width="100%"><b>JURNAL</b></td>
					</tr>
					<?php				
				}
			}

			$total_biaya_langsung_jurnal  = 0;
			$grand_total_biaya_langsung = $total_biaya_langsung;
				if(!empty($biaya_langsung_jurnal)){
					foreach ($biaya_langsung_jurnal as $key => $blj) {
						?>	
						<tr>
							<td width="20%" align="center"><?= $blj['coa_number'];?></td>
							<td width="2%"></td>
							<td width="48%"><?= $blj['coa'];?></td>
							<td width="30%" align="right"><?php echo number_format($blj['total'],0,',','.');?></td>
						</tr>
						<?php
						$total_biaya_langsung_jurnal += $blj['total'];					
					}
			}
			$total_a = $grand_total_biaya_langsung + $total_biaya_langsung_jurnal;
			?>
			<tr class="table-active2">
				<td width="80%" style="padding-left:20px;"><b>Total Biaya Operasional Produksi</b></td>
				<td width="20%" align="right"><b><a target="_blank" href="<?= base_url("laporan/print_biaya?filter_date=".$filter_date = date('d-m-Y',strtotime($date1)).' - '.date('d-m-Y',strtotime($date2))) ?>"><?php echo number_format($total_a,0,',','.');?></a></b></td>
			</tr>
		</table>
		<br />
		<br />
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
								<b><u>Rifka Dian Bethary</u><br />
								Keuangan Proyek</b>
							</td>
						</tr>
					</table>
				</td>
				<td width="5%"></td>
			</tr>
		</table>
	</body>
</html>