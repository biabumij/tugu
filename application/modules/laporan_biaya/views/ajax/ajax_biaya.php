<style>
	body{
		font-family: helvetica;
		font-size: 11px;
	}
</style>
<table class="table">
	<tr style="color:black; background: linear-gradient(90deg, #fdcd3b 20%, #fdcd3b 40%, #e69500 80%);">
		<th width="10%">PERIODE</th>
		<th width="90%" colspan="7" class="text-right"><?= $filter_date;?></th>
	</tr>
	<tr style="color:white; background-color: #e69500;">
		<th class="text-left" width="5%">Tanggal</th>
		<th class="text-left" width="5%">Transaksi</th>
		<th class="text-left" width="8%">COA</th>
		<th class="text-left" width="15%">Kategori</th>
		<th class="text-left" width="20%">Nomor Transaksi</th>
		<th class="text-left" width="32%">Keterangan</th>
		<th class="text-right" width="15%">Jumlah</th>
	</tr>
	<tr class="active">
		<th class="text-left" colspan="7">Overhead</th>
	</tr>
	<?php
	$total_biaya_langsung = 0;
	if(!empty($biaya_langsung)){
		foreach ($biaya_langsung as $key => $bl) {
			?>
			<tr>
				<td><?= $bl['tanggal_transaksi'] = date('d-m-Y',strtotime($bl['tanggal_transaksi']));?></td>
				<td>BIAYA</td>
				<td class="text-center"><?= $bl['coa_number'];?></td>
				<td><?= $bl['coa'];?></td>
				<td><?= "<a href=" . base_url('pmm/biaya/detail_biaya/' . $bl["id"]) .'" target="_blank">'. $bl["nomor_transaksi"] . "</a>";?></td>
				<td><?= $bl['deskripsi'];?></td>
				<td class="text-right"><?= $this->filter->Rupiah($bl['total']);?></td>
			</tr>
			<?php
			$total_biaya_langsung += $bl['total'];
			
		}
	}
	$total_biaya_langsung_jurnal = 0;
	$grand_total_biaya_langsung = $total_biaya_langsung;
	if(!empty($biaya_langsung_jurnal)){
		foreach ($biaya_langsung_jurnal as $key => $blj) {
			?>	
			<tr>
				<td><?= $blj['tanggal_transaksi'] = date('d-m-Y',strtotime($blj['tanggal_transaksi']));?></td>
				<td>JURNAL</td>
				<td class="text-center"><?= $blj['coa_number'];?></td>
				<td><?= $blj['coa'];?></td>
				<td><?= "<a href=" . base_url('pmm/jurnal_umum/detailJurnal/' . $blj["id"]) .'" target="_blank">'. $blj["nomor_transaksi"] . "</a>";?></td>
				<td><?= $blj['deskripsi'];?></td>
				<td class="text-right"><?= $this->filter->Rupiah($blj['total']);?></td>
			</tr>
			<?php
			$total_biaya_langsung_jurnal += $blj['total'];		
		}
	}
	$total_a = $grand_total_biaya_langsung + $total_biaya_langsung_jurnal;
	?>
	<tr class="active">
		<td width="80%" class="text-right" style="padding-right:20px;" colspan="6"><b>TOTAL OVERHEAD</b></td>
		<td width="20%" class="text-right"><b><?= $this->filter->Rupiah($total_a);?></b></td>
	</tr>
</table>