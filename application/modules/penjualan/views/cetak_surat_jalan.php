<!DOCTYPE html>
<html>
	<head>
	  <title>Pengiriman Penjualan</title>
	  <?= include 'lib.php'; ?>
	  
	  <style type="text/css">
	  	body{
			font-family: helvetica;
			font-size: 8px;
			color: #000000;
	  	}
	  	table.minimalistBlack {
		  border: 0px solid #000000;
		  text-align: left;
		}
		table.minimalistBlack td, table.minimalistBlack th {
		  border: 0px solid #000000;
		}
		table.minimalistBlack tr td {
		  text-align:center;

		}
		table.minimalistBlack tr th {
		  font-weight: bold;
		  background-color: #cccccc;
		  text-transform: uppercase;
		}
		hr{
			margin-top:0;
			margin-bottom:30px;
		}
		h3{
			margin-top:0;
		}
	  </style>

	</head>
	<body>
		<table width="98%" border="0" cellpadding="1">
			<tr>
				<td align="center">
					<div style="display: block;font-weight: bold;font-size: 12px;">REKAPAN PRODUKSI BETON READY MIX</div>
				</td>
			</tr>
			<?php
			function tglIndonesia($str){
				$tr   = trim($str);
				$str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
				return $str;
			}
			?>
			<?php
			if(!empty($filter_date)){
				?>
				<tr>
					<td align="center">
						<div style="display:block; font-weight:bold; font-size:12px; text-transform: uppercase">Periode : <?php echo tglIndonesia($filter_date);?></div>
						<!--<div style="display:block; font-weight:bold; font-size:12px; text-transform: uppercase">No. Sales Order : <?php echo $salesPo_id = $this->crud_global->GetField('pmm_sales_po',array('id'=>$salesPo_id),'contract_number');?></div>-->
					</td>
				</tr>
				<?php
			}
			?>
		</table>
		<br />
		<br />
		<table class="minimalistBlack" cellpadding="1" width="98%">
			<tr>
                <th align="center" width="5%">No</th>
				<th align="center" width="15%">Hari</th>
                <th align="center" width="15%">Tanggal</th>
				<th align="center" width="21%">Produk</th>
				<th align="center" width="15%">No. Kendaraan</th>
				<th align="center" width="15%">Volume</th>
				<th align="center" width="15%">Satuan</th>
            </tr>
            <?php
            $total = 0;
			$total_nilai = 0;
            if(!empty($data)){
            	$date = false;
            	$total_by_date = 0;
				$total_nilai_by_date = 0;
            	foreach ($data as $key => $row) {
            		if($date !== false && $row['date_production'] != $date){
            			?>
	            		<tr>
	            			<th colspan="5" style="text-align:right;">Jumlah</th>
              				<th style="text-align:center;"><?php echo number_format($total_by_date,2,',','.');?></th>
							<th style="text-align:center;">M3</th>
	            		</tr>
	            		<?php
	            		$total_by_date = 0;
						$total_nilai_by_date = 0;
            		}
            		$total_by_date += $row['volume'];
					$total_nilai_by_date += $row['price'];
            		?>
            		<tr>
            			<td><?php echo $key + 1 ;?></td>
            			<td><?php echo tglIndonesia(date('D',strtotime($row['date_production'])));?></td>
						<td><?php echo date('d-m-Y',strtotime($row['date_production']));?></td>
						<td><?php echo $row['product_id'] = $this->crud_global->GetField('produk',array('id'=>$row['product_id']),'nama_produk');?></td>
						<td><?php echo $row['nopol_truck'];?></td>
						<td><?php echo number_format($row['volume'],2,',','.');?></td>
						<td><?php echo $row['measure'];?></td>
            		</tr>
            		<?php
            		if($key == count($data) - 1){
            			?>
	            		<tr>
						<th colspan="5" style="text-align:right;">Jumlah</th>
              				<th style="text-align:center;"><?php echo number_format($total_by_date,2,',','.');?></th>
							<th style="text-align:center;">M3</th>
	            		</tr>
	            		<?php
	            		$total_by_date = 0;
						$total_nilai_by_date = 0;
            		}
            		
            		$date = $row['date_production'];
            		$total += $row['volume'];
					$total_nilai += $row['price'];
            	}
            }
            ?>	
           	<tr>
               <th colspan="5" style="text-align:right;">Total</th>
               <th style="text-align:center;"><?php echo number_format($total,2,',','.');?></th>
			   <th style="text-align:center;">M3</th>
           </tr>
		</table>
		<br /><br /><br /><br /><br />
		<table width="100%" border="0" cellpadding="0">
			<tr>
				<td>
					<table border="0">
						<tr>
							<td align="center" width="45%">
								
							</td>
							<td align="center" width="25%">
								
							</td>
							<td align="left" width="30%">
								Oku Selatan, <?php echo $date_now = tglIndonesia(date('d F Y'));?>
							</td>
						</tr>
						<tr>
							<td align="left" >
								Diperiksa Oleh,
							</td>
							<td align="center">
								
							</td>
							<td align="left">
								Dibuat Oleh,
							</td>
						</tr>
						<tr>
							<td align="left">
								<b>Nindya - TPP, Kso<br />
								Pembangunan Bendungan Tugu</b>
							</td>
							<td align="center">
								
							</td>
							<td align="left">
								<b>PT. BIA BUMI JAYENDRA</b>
							</td>
						</tr>
						<tr class="">
							<td align="center" height="30px">
							
							</td>
							<td align="center">
								
							</td>
							<td align="center">
								
							</td>
						</tr>
						<tr>
							<td align="left">
								<b><u></u></b><br />
								Logistik
							</td>
							<td align="center">
								
							</td>
							<td align="left">
								<b><u></u></b><br />
								Logistik
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>