<!DOCTYPE html>
<html>
	<head>
	  <?= include 'lib.php'; ?>
	  <title>RAP BAHAN</title>
	  
	  <style type="text/css">
	  	body{
		  font-family: helvetica;
		  font-size: 7.5px;
	  	}
	  	table.minimalistBlack {
		  border: 0px solid #000000;
		  width: 100%;
		  text-align: left;
		}
		table.minimalistBlack td, table.minimalistBlack th {
		  border: 1px solid #000000;
		  padding: 5px 4px;
		}
		table.minimalistBlack tr td {
		  text-align:center;
		}
		table.minimalistBlack tr th {
		  font-weight: bold;
		  color: #000000;
		  text-align: center;
		  padding: 10px;
		}
		table.head tr th {
		  font-weight: bold;
		  color: #000000;
		  text-align: left;
		  padding: 10px;
		}
		table tr.table-active{
            background-color: #9d7a10;
        }
        table tr.table-active2{
            background-color: #cac8c8;
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
	  </style>

	</head>
	<body>
		<table width="100%" border="0" cellpadding="3">
			<tr>
				<td align="center">
					<div style="display: block;font-weight: bold;font-size: 10px;">RAP BAHAN</div>
					<div style="display: block;font-weight: bold;font-size: 10px; text-transform:uppercase;">BETON READY MIX</div>
				</td>
			</tr>
		</table>
		<br /><br />
		<table class="head" width="100%" border="0" cellpadding="3">
			<tr>
				<th width="20%">JENIS PEKERJAAN</th>
				<th width="2%">:</th>
				<th align="left"><div style="text-transform:uppercase;"><?php echo $row['jobs_type'];?></div></th>
			</tr>
			<tr>
				<th width="20%">SATUAAN PEKERJAAN</th>
				<th width="2%">:</th>
				<th align="left"><?php echo $row['measure'] = $this->crud_global->GetField('pmm_measures',array('id'=>$row['measure']),'measure_name');?></th>
			</tr>
		</table>
		<br />
		<br />
		<table class="minimalistBlack" cellpadding="3" width="98%">
			<tr class="table-active">
				<th align="center" rowspan="2" width="5%">&nbsp; <br />NO.</th>
				<th align="center" rowspan="2" width="20%">&nbsp; <br />KOMPONEN</th>
				<th align="center" rowspan="2" width="15%">&nbsp; <br />SATUAN</th>
				<th align="center" rowspan="2" width="20%">&nbsp; <br />PERKIRAAN KUANTITAS</th>
				<th align="center" rowspan="2" width="20%">&nbsp; <br />HARGA SATUAN</th>
				<th align="center" width="20%" colspan="2">&nbsp; <br />JUMLAH HARGA</th>
            </tr>
			<tr class="table-active">
				<th align="center">(%)</th>
				<th align="center">(Rp.)</th>
			</tr>
			<tr>
				<td align="left" colspan="7"><i><b>BEBAN POKOK PRODUKSI</i></b></td>
			</tr>
			<tr>
				<td align="center"><b>A.</b></td>
				<td align="left" colspan="6"><b>BAHAN</b></td>
			</tr>
			<tr>
				<?php
				$total = 0;
				?>
				<?php
				$total_bahan = $row['total_a'] + $row['total_b'] + $row['total_c'] + $row['total_d'] + $row['total_e'];
				?>
				<td align="center">1.</td>
				<td align="left"><?= $row['produk_a'] = $this->crud_global->GetField('produk',array('id'=>$row['produk_a']),'nama_produk'); ?></td>
				<td align="center"><?= $row['measure_a']  = $this->crud_global->GetField('pmm_measures',array('id'=>$row['measure_a']),'measure_name'); ?></td>
				<td align="center"><?php echo number_format($row['presentase_a'],4,',','.');?></td>
				<td align="right"><?php echo number_format($row['price_a'],0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($row['total_a'],0,',','.');?></td>
			</tr>
			<tr>
				<td align="center">2.</td>
				<td align="left"><?= $row['produk_b'] = $this->crud_global->GetField('produk',array('id'=>$row['produk_b']),'nama_produk'); ?></td>
				<td align="center"><?= $row['measure_b']  = $this->crud_global->GetField('pmm_measures',array('id'=>$row['measure_b']),'measure_name'); ?></td>
				<td align="center"><?= $row['presentase_b']; ?></td>
				<td align="right"><?php echo number_format($row['price_b'],0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($row['total_b'],0,',','.');?></td>
			</tr>
			<tr>
				<td align="center">3.</td>
				<td align="left"><?= $row['produk_c'] = $this->crud_global->GetField('produk',array('id'=>$row['produk_c']),'nama_produk'); ?></td>
				<td align="center"><?= $row['measure_c']  = $this->crud_global->GetField('pmm_measures',array('id'=>$row['measure_c']),'measure_name'); ?></td>
				<td align="center"><?= $row['presentase_c']; ?></td>
				<td align="right"><?php echo number_format($row['price_c'],0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($row['total_c'],0,',','.');?></td>
			</tr>
			<tr>
				<td align="center">4.</td>
				<td align="left"><?= $row['produk_d'] = $this->crud_global->GetField('produk',array('id'=>$row['produk_d']),'nama_produk'); ?></td>
				<td align="center"><?= $row['measure_d']  = $this->crud_global->GetField('pmm_measures',array('id'=>$row['measure_d']),'measure_name'); ?></td>
				<td align="center"><?= $row['presentase_d']; ?></td>
				<td align="right"><?php echo number_format($row['price_d'],0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($row['total_d'],0,',','.');?></td>
			</tr>
			<tr>
				<td align="center">5.</td>
				<td align="left"><?= $row['produk_e'] = $this->crud_global->GetField('produk',array('id'=>$row['produk_e']),'nama_produk'); ?></td>
				<td align="center"><?= $row['measure_e']  = $this->crud_global->GetField('pmm_measures',array('id'=>$row['measure_e']),'measure_name'); ?></td>
				<td align="center"><?= $row['presentase_e']; ?></td>
				<td align="right"><?php echo number_format($row['price_e'],0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($row['total_e'],0,',','.');?></td>
			</tr>
				<?php
				$row = $this->db->select('*')
				->from('rap_alat')
				->where('id',$row['rap_alat'])
				->get()->row_array();

				$total_alat = $row['batching_plant'] + $row['truck_mixer'] + $row['wheel_loader'] + $row['bbm_solar'];
				$total_bua = (0.0700 * 800000) + (0.0700 * 250000);
				$total_bank = 15000;
				$total = $total_bahan + $total_alat + $total_bua + $total_bank;
				?>
			<tr>
				<td align="right" colspan="5"><b>JUMLAH HARGA BAHAN</b></td>
				<td align="right"><b><?php echo number_format(($total_bahan / $total) * 100,2,',','.');?>%</b></td>
				<td align="right"><b><?php echo number_format($total_bahan,0,',','.');?></b></td>
			</tr>
			<tr>
				<td align="center"><b>B.</b></td>
				<td align="left" colspan="6"><b>PERALATAN</b></td>
			</tr>
			<tr>
				<td align="center">1.</td>
				<td align="left">Batching Plant + Genset</td>
				<td align="center">Jam</td>
				<td align="center"><?php echo number_format($row['vol_batching_plant'],4,',','.');?></td>
				<td align="right"><?php echo number_format($row['harsat_batching_plant'],0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($row['batching_plant'],0,',','.');?></td>
			</tr>
			<tr>
				<td align="center">2.</td>
				<td align="left">Wheel Loader</td>
				<td align="center">Jam</td>
				<td align="center"><?php echo number_format($row['vol_wheel_loader'],4,',','.');?></td>
				<td align="right"><?php echo number_format($row['harsat_wheel_loader'],0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($row['wheel_loader'],0,',','.');?></td>
			</tr>
			
			<tr>
				<td align="center">3.</td>
				<td align="left">Truck Mixer</td>
				<td align="center">Jam</td>
				<td align="center"><?php echo number_format($row['vol_truck_mixer'],4,',','.');?></td>
				<td align="right"><?php echo number_format($row['harsat_truck_mixer'],0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($row['truck_mixer'],0,',','.');?></td>
			</tr>
			<tr>
				<td align="center">4.</td>
				<td align="left">BBM Solar</td>
				<td align="center">Jam</td>
				<td align="center"><?php echo number_format($row['vol_bbm_solar'],4,',','.');?></td>
				<td align="right"><?php echo number_format($row['harsat_bbm_solar'],0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format($row['bbm_solar'],0,',','.');?></td>
			</tr>
			<tr>
				<td align="right" colspan="5"><b>JUMLAH HARGA PERALATAN</b></td>
				<td align="right"></td>
				<td align="right"><b><?php echo number_format($total_alat,0,',','.');?></b></td>
			</tr>
			<tr>
				<td align="right" colspan="5"><b>JUMLAH HARGA POKOK PENJUALAN (A+B)</b></td>
				<td align="right"><b><?php echo number_format(($total_alat / $total) * 100,2,',','.');?>%</b></td>
				<td align="right"><b><?php echo number_format($total_bahan + $total_alat,0,',','.');?></b></td>
			</tr>
			<tr>
				<td align="center"><b>C.</b></td>
				<td align="left" colspan="6"><b>BUA</b></td>
			</tr>
			<tr>
				<td align="center">1.</td>
				<td align="left">Gaji Karyawan / Tenaga Kerja</td>
				<td align="center">Jam</td>
				<td align="center"><?php echo number_format(0.0700,4,',','.');?></td>
				<td align="right"><?php echo number_format(800000,0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format(0.0700 * 800000,0,',','.');?></td>
			</tr>
			<tr>
				<td align="center">2.</td>
				<td align="left">Operasional</td>
				<td align="center">Jam</td>
				<td align="center"><?php echo number_format(0.0700,4,',','.');?></td>
				<td align="right"><?php echo number_format(250000,0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format(0.0700 * 250000,0,',','.');?></td>
			</tr>
			<tr>
				<td align="right" colspan="5"><b>JUMLAH BUA</b></td>
				<td align="right"><b><?php echo number_format(($total_bua / $total) * 100,2,',','.');?>%</b></td>
				<td align="right"><b><?php echo number_format($total_bua,0,',','.');?></b></td>
			</tr>
			<tr>
				<td align="left" colspan="7"><i><b>BEBAN LAIN - LAIN</i></b></td>
			</tr>
			<tr>
				<td align="center"><b>D.</b></td>
				<td align="left" colspan="6"><b>PERSIAPAN</b></td>
			</tr>
			<tr>
				<td align="center">1.</td>
				<td align="left">Mobilisasi</td>
				<td align="center">Ls</td>
				<td align="center"></td>
				<td align="right"><?php echo number_format(400000000,0,',','.');?></td>
				<td align="right"></td>
				<td align="right"></td>
			</tr>
			<tr>
				<td align="center">2.</td>
				<td align="left">Erection BP</td>
				<td align="center">Ls</td>
				<td align="center"></td>
				<td align="right"><?php echo number_format(200000000,0,',','.');?></td>
				<td align="right"></td>
				<td align="right"></td>
			</tr>
			<tr>
				<td align="center">3.</td>
				<td align="left">Direksi Keet</td>
				<td align="center">Ls</td>
				<td align="center"></td>
				<td align="right"><?php echo number_format(250000000,0,',','.');?></td>
				<td align="right"></td>
				<td align="right"></td>
			</tr>
			<tr>
				<td align="right" colspan="5"><b>JUMLAH HARGA PERSIAPAN</b></td>
				<td align="right"><b><?php echo number_format(0.00,2,',','.');?>%</b></td>
				<td align="right"></td>
			</tr>
			<tr>
				<td align="center"><b>E.</b></td>
				<td align="left" colspan="6"><b>BIAYA BANK</b></td>
			</tr>
			<tr>
				<td align="center">1.</td>
				<td align="left">Diskonto</td>
				<td align="center">M3</td>
				<td align="center"><?php echo number_format(3.00,2,',','.');?>%</td>
				<td align="right"></td>
				<td align="right"></td>
				<td align="right"></td>
			</tr>
			<tr>
				<td align="center">1.</td>
				<td align="left">Diskonto</td>
				<td align="center">M3</td>
				<td align="center"></td>
				<td align="right"><?php echo number_format(15000,0,',','.');?></td>
				<td align="right"></td>
				<td align="right"><?php echo number_format(15000,0,',','.');?></td>
			</tr>
			<tr>
				<td align="right" colspan="5"><b>JUMLAH BIAYA BANK</b></td>
				<td align="right"><b><?php echo number_format(($total_bank / $total) * 100,2,',','.');?>%</b></td>
				<td align="right"></td>
			</tr>
			<tr>
				<td align="right" colspan="5"><b>JUMLAH HARGA POKOK PENJUALAN (A+B+C+D+E)</b></td>
				<td align="right"></td>
				<td align="right"><b><?php echo number_format($total,0,',','.');?></b></td>
			</tr>
			<tr>
				<td align="right" colspan="5"><b>LABA</b></td>
				<td align="right"><b><?php echo number_format(7.00,2,',','.');?>%</b></td>
				<td align="right"><b><?php echo number_format(($total * 7) / 100,0,',','.');?></b></td>
			</tr>
			<tr>
				<td align="right" colspan="5"><b>HARGA JUAL</b></td>
				<td align="right"></td>
				<td align="right"><b><?php echo number_format((($total * 7) / 100) + $total,0,',','.');?></b></td>
			</tr>
			<tr>
				<td align="right" colspan="5"><b>DISKONTO</b></td>
				<td align="right"><b><?php echo number_format(4.00,2,',','.');?>%</b></td>
				<td align="right"><b><?php echo number_format((((($total * 7) / 100) + $total) * 4) /100,0,',','.');?></b></td>
			</tr>
			<tr>
			<td align="right" colspan="5"><b>HARGA JUAL</b></td>
				<td align="right"></td>
				<td align="right"><b><?php echo number_format(((((($total * 7) / 100) + $total) * 4) /100) + (($total * 7) / 100) + $total,0,',','.');?></b></td>
			</tr>
		</table>
	</body>
</html>