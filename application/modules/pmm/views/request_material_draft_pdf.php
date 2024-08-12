<!DOCTYPE html>
<html>
	<head>
	  <title><?php echo $row['request_no'];?></title>
	  <?= include 'lib.php'; ?>
	  
	  <style type="text/css">
	  	body{
	  		font-family: helvetica;
	  	}
	  	table.minimalistBlack {
		  border: 0px solid #000000;
		  width: 98%;
		  text-align: left;
		}
		table.minimalistBlack td, table.minimalistBlack th {
		  border: 1px solid #000000;
		  padding: 5px 4px;
		}
		table.minimalistBlack tr td {
		  /*font-size: 13px;*/
		  text-align:center;
		}
		table.minimalistBlack tr th {
		  /*font-size: 14px;*/
		  font-weight: bold;
		  color: #000000;
		  text-align: center;
		  padding: 10px;
		}
		hr{
			margin-top:0;
			margin-bottom:30px;
		}
		h3{
			margin-top:0;
		}
		table tr.table-head{
            background-color: #e69500;
			color: #ffffff;
			font-size: 9px;
        }
	  </style>

	</head>
	<body>
		<table width="98%" border="0" cellpadding="3">
			<tr>
				<td align="center">
					<div style="display: block;font-weight: bold;font-size: 12px;">PERMINTAAN BAHAN & ALAT <br />
					PROYEK BENDUNGAN TUGU<br />PT BIA BUMI JAYENDRA</div>
					<div style="display:block; font-weight:bold; font-size:12px; color:red;">(DRAFT)</div>
				</td>
			</tr>
		</table>
		<br /><br />
		<table width="98%" border="0" cellpadding="3">
			<tr>
				<th width="20%">No. Permintaan</th>
				<th width="2%">:</th>
				<th width="78%" align="left"><?php echo $row['request_no'];?></th>
			</tr>
			<tr>
				<th width="20%">Tanggal Permintaan</th>
				<th width="2%">:</th>
				<th width="78%" align="left"><?= convertDateDBtoIndo($row["request_date"]); ?></th>
			</tr>
			<tr>
				<th width="20%">Rekanan</th>
				<th width="2%">:</th>
				<th width="78%" align="left"><?php echo $row['supplier_id'] = $this->crud_global->GetField('penerima',array('id'=>$row['supplier_id']),'nama');;?></th>
			</tr>
		</table>
		<br /><br />
		<table class="minimalistBlack" cellpadding="5" width="98%">
			<tr  class="table-head">
				<th width="5%">No</th>
                <th width="30%">Produk</th>
                <th width="10%">Satuan</th>
                <th width="15%">Volume</th>
				<th width="20%">Harga Satuan</th>
                <th width="20%">Nilai</th>
			</tr>
			<?php
			if(!empty($data)){
				$total =0;
				foreach ($data as $dw_key => $dw_val) {
					$total = $total + $dw_val['total'];
					?>
            		<tr>
            			<td><?php echo $dw_key + 1;?></td>
            			<td align="left"><?php echo $dw_val['material_name'];?></td>
            			<td><?php echo $dw_val['measure'];?></td>
						<td><?php echo $dw_val['volume'];?></td>
            			<td align="right"><?php echo $dw_val['price'];?></td>
            			<td align="right"><?php echo number_format($total,0,',','.');?></td>
            		</tr>
            		<?php
				}
			}
			?>

		</table>
		<br />
		<br />
		<br />
		<table width="98%" border="0" cellpadding="3">
			<tr>
				<th align="left"><?php echo $row['memo'];?></th>
			</tr>
		</table>
	</body>
</html>