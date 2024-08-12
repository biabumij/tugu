<!DOCTYPE html>
<html>
	<head>
	  <title>DISKONTO</title>

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
					<div style="display: block;font-weight: bold;font-size: 11px;">LAPORAN BIAYA DISKONTO</div>
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
				<th align="center" width="20%"><b>Kode Akun</b></th>
				<th align="center" width="50%"><b>Nama Akun</b></th>
				<th align="center" width="30%" align="right"><b>Jumlah</b></th>
			</tr>
			<?php
			if(!empty($biaya_lainnya_parent)){
				foreach ($biaya_lainnya_parent as $key => $row) {
					?>
					<tr class="table-active4">
						<td width="20%" align="center"><?= $row['coa_number'] = $this->crud_global->GetField('pmm_coa',array('id'=>$row['coa_parent']),'coa_number');?></td>
						<td width="50%"><?= $row['coa'] = $this->crud_global->GetField('pmm_coa',array('id'=>$row['coa_parent']),'coa');?></td>
						<td width="30%" align="right"></td>
					</tr>
					<?php				
				}
			}

			$total_biaya_lainnya = 0;
			if(!empty($biaya_lainnya)){
				foreach ($biaya_lainnya as $key => $row) {
					?>
					<tr>
						<td width="20%" align="center"><?= $row['coa_number'];?></td>
						<td width="2%"></td>
						<td width="48%"><?= $row['coa'];?></td>
						<td width="30%" align="right"><?php echo number_format($row['total'],0,',','.');?></td>
					</tr>
					<?php
					$total_biaya_lainnya += $row['total'];					
				}
			}

			if(!empty($biaya_lainnya_jurnal_parent)){
				foreach ($biaya_lainnya_jurnal_parent as $key => $row2) {
					?>
					<tr class="table-active4">
						<td width="20%" align="center"><?= $row2['coa_number'] = $this->crud_global->GetField('pmm_coa',array('id'=>$row2['coa_parent']),'coa_number');?></td>
						<td width="50%"><?= $row2['coa'] = $this->crud_global->GetField('pmm_coa',array('id'=>$row2['coa_parent']),'coa');?></td>
						<td width="30%" align="right"></td>
					</tr>
					<?php				
				}
			}

			$total_biaya_lainnya_jurnal = 0;
			$grand_total_biaya_lainnya = $total_biaya_lainnya;
			if(!empty($biaya_lainnya_jurnal)){
				foreach ($biaya_lainnya_jurnal as $key => $row2) {
					?>
					<tr>
						<td width="10%" align="center">JURNAL</td>
						<td width="10%" align="center"><?= $row2['coa_number'];?></td>
						<td width="2%"></td>
						<td width="48%"><?= $row2['coa'];?></td>
						<td width="30%" align="right"><?php echo number_format($row2['total'],0,',','.');?></td>
					</tr>
					<?php
					$total_biaya_lainnya_jurnal += $row2['total'];					
				}
			}
			$total_c = $grand_total_biaya_lainnya + $total_biaya_lainnya_jurnal;
			?>
			<tr class="table-active2">
				<td width="80%" style="padding-left:20px;"><b>Total Diskonto</b></td>
				<td width="20%" align="right"><b><?php echo number_format($total_c,0,',','.');?></b></td>
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
								<b><u>Novel Joko Tri Laksono</u><br />
								Ka. Plant</b>
							</td>
							<td align="center" >
								<b><u>Avriani Delia Ika Putri</u><br />
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