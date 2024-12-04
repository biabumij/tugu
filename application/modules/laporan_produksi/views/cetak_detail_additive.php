<!DOCTYPE html>
<html>
	<head>
	  <title>LAPORAN EVALUASI PEMAKAIAN BAHAN</title>
	  
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

		table, th, td {
			border: 0.5px solid white;
		}
		
		table tr.table-judul{
			background-color: #e69500;
			font-weight: bold;
			font-size: 8px;
			color: black;
		}
			
		table tr.table-baris1{
			background-color: #F0F0F0;
			font-size: 8px;
		}

		table tr.table-baris1-bold{
			background-color: #F0F0F0;
			font-size: 8px;
			font-weight: bold;
		}
			
		table tr.table-baris2{
			font-size: 8px;
			background-color: #E8E8E8;
		}
			
		table tr.table-total{
			background-color: #cccccc;
			font-weight: bold;
			font-size: 8px;
			color: black;
		}
	  </style>

	</head>
	<body>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">Kartu Stock Additive</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">Proyek Bendungan Tugu</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">Periode <?php echo str_replace($search, $replace, $subject);?></div>
		<br /><br /><br />
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
		
		<th align="right">HARSAT</th>
				<th align="right">NILAI</th>
			</tr>
			<?php foreach ($pemakaian as $x): ?>
			<tr class="table-baris1">
				<td align="right"></td>
				<td align="right"><?php echo number_format($x['volume'],2,',','.');?></td>
				<td align="right"><?php echo number_format($x['harsat'],0,',','.');?></td>
				<td align="right"><?php echo number_format($x['nilai'],0,',','.');?></td>
			</tr>
			<?php endforeach; ?>
			<tr class="table-total">
				<td align="right"></td>
				<td align="right"><?php echo number_format($pemakaian_volume,2,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($pemakaian_nilai,0,',','.');?></td>
			</tr>
		</table>
		<br /><br />
		<table width="98%" cellpadding="3">
			<?php
			$persediaan_akhir_volume = ($stock_volume_lalu + $pembelian_volume) - $pemakaian_volume;
			$persediaan_akhir_nilai = ($stock_nilai_lalu + $pembelian_nilai) - $pemakaian_nilai;
			?>
			<tr class="table-judul">
				<th align="center" rowspan="2" width="50%"></th>
				<th align="center" colspan="3" width="50%">PERSEDIAAN AKHIR</th>
			</tr>
			<tr class="table-judul">
				<th align="right">VOLUME</th>
				<th align="right">HARSAT</th>
				<th align="right">NILAI</th>
			</tr>
			<tr class="table-total">
				<td align="right"></td>
				<td align="right"><?php echo number_format($persediaan_akhir_volume,2,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($persediaan_akhir_nilai,0,',','.');?></td>
			</tr>
		</table>
	</body>
</html>