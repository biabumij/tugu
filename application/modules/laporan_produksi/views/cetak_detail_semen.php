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
			font-size: 10px;
		}
		
		table tr.table-judul{
			background-color: #e69500;
			font-weight: bold;
			font-size: 10px;
			color: black;
		}
			
		table tr.table-baris1{
			background-color: #F0F0F0;
			font-size: 10px;
		}

		table tr.table-baris1-bold{
			background-color: #F0F0F0;
			font-size: 10px;
			font-weight: bold;
		}
			
		table tr.table-baris2{
			font-size: 10px;
			background-color: #E8E8E8;
		}
			
		table tr.table-total{
			background-color: #cccccc;
			font-weight: bold;
			font-size: 10px;
			color: black;
		}
	  </style>

	</head>
	<body>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">RINCIAN PEMAKAIAN SEMEN</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">PROYEK BENDUNGAN TUGU</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">PT. BIA BUMI JAYENDRA</div>
		<div align="center" style="display: block;font-weight: bold;font-size: 11px; text-transform: uppercase;">PERIODE : <?php echo str_replace($search, $replace, $subject);?></div>
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
		
		<table width="98%" cellpadding="5">
			<?php
			$pemakaian = $this->db->select('sum(volume) as volume, sum(nilai) as nilai')
			->from('pemakaian_bahan')
			->where("date between '$date1' and '$date2'")
			->where("material_id = 1")
			->where("status = 'PUBLISH'")
			->group_by("id")
			->get()->result_array();
			?>
		<table cellpadding="3" width="98%">
			<tr>
				<th align="right" width="30%" style="background-color:grey; color:white;">VOLUME</th>
				<th align="right" width="35%" style="background-color:grey; color:white;">HARSAT</th>
				<th align="right" width="35%" style="background-color:grey; color:white;">NILAI</th>
			</tr>
			<?php foreach ($pemakaian as $x): ?>
			<tr>
				<th align="right" width="30%" style="background-color:grey; color:white;"><?php echo number_format($x['volume'],2,',','.');?></th>
				<th align="right" width="35%" style="background-color:grey; color:white;"><?php echo number_format($x['nilai'] / $x['volume'],0,',','.');?></th>
				<th align="right" width="35%" style="background-color:grey; color:white;"><?php echo number_format($x['nilai'],0,',','.');?></th>
			</tr>
			<?php endforeach; ?>
		</table>
	</body>
</html>