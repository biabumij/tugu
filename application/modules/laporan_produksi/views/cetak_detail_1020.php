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
		<div align="center" style="display: block;font-weight: bold;font-size: 11px;">Kartu Stock Batu Split 10-20</div>
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
		
		<table width="98%" cellpadding="3" style="float:center;">
			<?php
			$date1_ago = date('2020-01-01');
			$date2_ago = date('Y-m-d', strtotime('-1 days', strtotime($date1)));
			$date3_ago = date('Y-m-d', strtotime('-1 months', strtotime($date1)));
			$tanggal_opening_balance = date('Y-m-d', strtotime('-1 days', strtotime($date1)));

			$stock_opname_ago = $this->db->select('cat.notes as notes, cat.volume as volume, cat.total as nilai')
			->from('pmm_remaining_materials_cat cat ')
			->where("(cat.date <= '$tanggal_opening_balance')")
			->where("cat.material_id = 3")
			->where("cat.status = 'PUBLISH'")
			->order_by('date','desc')->limit(1)
			->get()->result_array();

			$stock_volume_lalu = 0;
			$stock_nilai_lalu = 0;
			foreach ($stock_opname_ago as $x){
				$stock_volume_lalu += $x['volume'];
				$stock_nilai_lalu += $x['nilai'];
			}
			?>
			<tr class="table-judul">
				<th align="center" rowspan="2" width="50%"></th>
				<th align="center" colspan="3" width="50%">PERSEDIAAN AWAL</th>
			</tr>
			<tr class="table-judul">
				<th align="right">VOLUME</th>
				<th align="right">HARSAT</th>
				<th align="right">NILAI</th>
			</tr>
			<?php foreach ($stock_opname_ago as $x): ?>
			<tr class="table-baris1">
				<td align="right"><?= $x['notes'] ?></td>
				<td align="right"><?php echo number_format($x['volume'],2,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($x['nilai'],0,',','.');?></td>
			</tr>
			<?php endforeach; ?>
			<tr class="table-total">
				<td align="right"></td>
				<td align="right"><?php echo number_format($stock_volume_lalu,2,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($stock_nilai_lalu,0,',','.');?></td>
			</tr>
		</table>
		<br /><br />
		<table width="98%" cellpadding="3">
			<?php
			$pembelian = $this->db->select('ps.nama as nama, SUM(prm.display_volume) as volume, SUM(prm.display_price) as nilai, SUM(prm.display_price) / SUM(prm.display_volume) as harsat')
			->from('pmm_receipt_material prm')
			->join('pmm_purchase_order po', 'prm.purchase_order_id = po.id','left')
			->join('produk p', 'prm.material_id = p.id','left')
			->join('penerima ps', 'po.supplier_id = ps.id','left')
			->where("(prm.date_receipt between '$date1' and '$date2')")
			->where("p.kategori_bahan = '3'")
			->where("po.status in ('PUBLISH','CLOSED')")
			->group_by("po.supplier_id")
			->order_by('po.date_po','asc')
			->get()->result_array();

			$pembelian_volume = 0;
			$pembelian_nilai = 0;
			foreach ($pembelian as $x){
				$pembelian_volume += $x['volume'];
				$pembelian_nilai += $x['nilai'];
			}
			?>
			<tr class="table-judul">
				<th align="center" rowspan="2" width="50%"></th>
				<th align="center" colspan="3" width="50%">PEMBELIAN</th>
			</tr>
			<tr class="table-judul">
				<th align="right">VOLUME</th>
				<th align="right">HARSAT</th>
				<th align="right">NILAI</th>
			</tr>
			<?php foreach ($pembelian as $x): ?>
			<tr class="table-baris1">
				<td align="right"><?= $x['nama'] ?></td>
				<td align="right"><?php echo number_format($x['volume'],2,',','.');?></td>
				<td align="right"><?php echo number_format($x['harsat'],0,',','.');?></td>
				<td align="right"><?php echo number_format($x['nilai'],0,',','.');?></td>
			</tr>
			<?php endforeach; ?>
			<tr class="table-total">
				<td align="right"></td>
				<td align="right"><?php echo number_format($pembelian_volume,2,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($pembelian_nilai,0,',','.');?></td>
			</tr>
		</table>
		<br /><br />
		<table width="98%" cellpadding="3">
			<?php
			$pemakaian = $this->db->select('notes as notes, sum(volume) as volume, sum(nilai) as nilai, sum(nilai) / sum(volume) as harsat')
			->from('pemakaian_bahan')
			->where("date between '$date1' and '$date2'")
			->where("material_id = 3")
			->where("status = 'PUBLISH'")
			->group_by("id")
			->get()->result_array();
			
			$pemakaian_volume = 0;
			$pemakaian_nilai = 0;
			foreach ($pemakaian as $x){
				$pemakaian_volume += $x['volume'];
				$pemakaian_nilai += $x['nilai'];
			}
			?>
			<tr class="table-judul">
				<th align="center" rowspan="2" width="50%"></th>
				<th align="center" colspan="3" width="50%">PEMAKAIAN</th>
			</tr>
			<tr class="table-judul">
				<th align="right">VOLUME</th>
				<th align="right">HARSAT</th>
				<th align="right">NILAI</th>
			</tr>
			<?php foreach ($pemakaian as $x): ?>
			<tr class="table-baris1">
				<td align="right"><?= $x['notes'] ?></td>
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