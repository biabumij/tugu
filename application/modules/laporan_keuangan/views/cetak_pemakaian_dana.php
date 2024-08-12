<!DOCTYPE html>
<html>
	<head>
	  <title>DISKONTO</title>
	  
	  <style type="text/css">
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
					<div style="display: block;font-weight: bold;font-size: 12px;">PEMAKAIAN DANA</div>
					<div style="display: block;font-weight: bold;font-size: 12px;"><?= $this->crud_global->GetField('pmm_setting_production',array('id'=>1),'nama_pt');?></div>
					<div style="display: block;font-weight: bold;font-size: 12px;text-transform: uppercase;">SD. <?php echo $date2 = date('F Y',strtotime($date2));;?></div>
				</td>
			</tr>
		</table>
		<br />
		<br />
		<br />
		<table class="table-lap" width="98%" border="0" cellpadding="3">
			<tr class="table-active">
				<th align="center" width="20%"><b>Kode Akun</b></th>
				<th align="center" width="15%"><b>Nama Akun</b></th>
				<th align="center" width="35%"><b>Memo</b></th>
				<th align="center" width="30%" align="right"><b>Jumlah</b></th>
			</tr>
			<?php
			if(!empty($pemakaian_dana_parent)){
				foreach ($pemakaian_dana_parent as $key => $row) {
					?>
					<tr class="table-active4">
						<td width="20%" align="center"><?= $row['coa_number'] = $this->crud_global->GetField('pmm_coa',array('id'=>$row['coa_parent']),'coa_number');?></td>
						<td width="30%"><?= $row['coa'] = $this->crud_global->GetField('pmm_coa',array('id'=>$row['coa_parent']),'coa');?></td>
						<td width="25%" align="right"></td>
						<td width="25%" align="right"></td>
					</tr>
					<?php				
				}
			}

			$total_pemakaian_dana = 0;
			if(!empty($pemakaian_dana)){
				foreach ($pemakaian_dana as $key => $row) {
					?>
					<tr>
						<td width="10%" align="right">BIAYA</td>
						<td width="10%" align="left"><?= $row['coa_number'];?></td>
						<td width="30%"><?= $row['coa'];?></td>
						<td width="20%"><?= $row['memo'];?></td>
						<td width="30%" align="right"><?= $this->filter->Rupiah($row['total']);?></td>
					</tr>
					<?php
					$total_pemakaian_dana += $row['total'];					
				}
			}

			if(!empty($pemakaian_dana_jurnal_parent)){
				foreach ($pemakaian_dana_jurnal_parent as $key => $row2) {
					?>
					<tr class="table-active4">
						<td width="20%" align="center"><?= $row2['coa_number'] = $this->crud_global->GetField('pmm_coa',array('id'=>$row2['coa_parent']),'coa_number');?></td>
						<td width="30%"><?= $row2['coa'] = $this->crud_global->GetField('pmm_coa',array('id'=>$row2['coa_parent']),'coa');?></td>
						<td width="25%" align="right"></td>
						<td width="25%" align="right"></td>
					</tr>
					<?php				
				}
			}

			$total_pemakaian_dana_jurnal = 0;
			$grand_total_pemakaian_dana = $total_pemakaian_dana;
			if(!empty($pemakaian_dana_jurnal)){
				foreach ($pemakaian_dana_jurnal as $key => $row2) {
					?>
					<tr>
						<td width="10%" align="right">JURNAL</td>
						<td width="10%" align="left"><?= $row2['coa_number'];?></td>
						<td width="2%"></td>
						<td width="28%"><?= $row2['coa'];?></td>
						<td width="30%"><?= $row2['memo'];?></td>
						<td width="20%" align="right"><?= $this->filter->Rupiah($row2['total']);?></td>
					</tr>
					<?php
					$total_pemakaian_dana_jurnal += $row2['total'];					
				}
			}
			$total_c = $grand_total_pemakaian_dana + $total_pemakaian_dana_jurnal;
			?>
			<tr class="table-active2">
				<td width="80%" style="padding-left:20px;"><b>Total Pemakaian Dana</b></td>
				<td width="20%" align="right"><b><?= $this->filter->Rupiah($total_c);?></b></td>
			</tr>
		</table>
	</body>
</html>