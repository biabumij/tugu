<!DOCTYPE html>
<html>
	<head>
	  <title>LAPORAN LABA RUGI</title>
	  
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
		}
		
	  	table tr.table-active{
            background-color: #e69500;
			font-size: 9px;
		}
			
		table tr.table-active2{
			font-size: 9px;
		}
			
		table tr.table-active3{
			font-size: 9px;
		}
			
		table tr.table-active4{
			background-color: #D0D0D0;
			font-size: 9px;
		}

		tr.border-bottom td {
        border-bottom: 1pt solid #ff000d;
      }
	  </style>

	</head>
	<body>
		<br />
		<br />
		<table width="98%" cellpadding="3">
			<tr>
				<td align="center"  width="100%">
					<div style="display: block;font-weight: bold;font-size: 12px;">LAPORAN LABA RUGI<br/>
					PROYEK BENDUNGAN TUGU<br/>
					PT. BIA BUMI JAYENDRA<br/>
					<div style="text-transform: uppercase;">PERIODE <?php echo str_replace($search, $replace, $subject);?></div></div>
				</td>
			</tr>
		</table>
		<br />
		<br />
		<br />
		<?php
		$data = array();
		
		$arr_date = $this->input->get('filter_date');
		$arr_filter_date = explode(' - ', $arr_date);
		$date3 = '';
		$date1 = '';
		$date2 = '';

		if(count($arr_filter_date) == 2){
			$date3 	= date('2024-01-01',strtotime($date3));
			$date1 	= date('Y-m-d',strtotime($arr_filter_date[0]));
			$date2 	= date('Y-m-d',strtotime($arr_filter_date[1]));
			$filter_date = date('d/m/Y',strtotime($arr_filter_date[0])).' - '.date('d/m/Y',strtotime($arr_filter_date[1]));
			$filter_date_2 = date('d/m/Y',strtotime($date3)).' - '.date('d/m/Y',strtotime($arr_filter_date[1]));
		}
		
		?>
		
		<table width="98%" border="0" cellpadding="3">
		
			<?php
			//PENJUALAN
			$penjualan = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
			->from('pmm_productions pp')
			->join('penerima p', 'pp.client_id = p.id','left')
			->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
			->where("pp.date_production between '$date1' and '$date2'")
			->where("pp.status = 'PUBLISH'")
			->where("ppo.status in ('OPEN','CLOSED')")
			->group_by("pp.client_id")
			->get()->result_array();
			
			$total_penjualan = 0;
			$total_volume = 0;

			foreach ($penjualan as $x){
				$total_penjualan += $x['price'];
				$total_volume += $x['volume'];
				$satuan = $x['measure'];
			}

			$total_penjualan_all = 0;
			$total_penjualan_all = $total_penjualan;

			//PENJUALAN_2
			$penjualan_2 = $this->db->select('p.nama, pp.client_id, SUM(pp.display_price) as price, SUM(pp.display_volume) as volume, pp.convert_measure as measure')
			->from('pmm_productions pp')
			->join('penerima p', 'pp.client_id = p.id','left')
			->join('pmm_sales_po ppo', 'pp.salesPo_id = ppo.id','left')
			->where("pp.date_production between '$date3' and '$date2'")
			->where("pp.status = 'PUBLISH'")
			->where("ppo.status in ('OPEN','CLOSED')")
			->group_by("pp.client_id")
			->get()->result_array();

			$total_penjualan_2 = 0;
			$total_volume_2 = 0;

			foreach ($penjualan_2 as $x){
				$total_penjualan_2 += $x['price'];
				$total_volume_2 += $x['volume'];
				$satuan_2 = $x['measure'];
			}

			$total_penjualan_all_2 = 0;
			$total_penjualan_all_2 = $total_penjualan_2;

			//BAHAN
			$bahan = $this->pmm_model->getBahan($date1,$date2);
			$total_nilai = $bahan;

			//BAHAN_2
			$bahan_2 = $this->pmm_model->getBahan2($date3,$date2);
			$total_nilai_2 = 0;
			$total_nilai_2= $bahan_2;

			//ALAT
			$alat = $this->pmm_model->getAlat($date1,$date2);
			$alat = $alat;

			//ALAT_2
			$alat_2 = $this->pmm_model->getAkumulasiAlat($date3,$date2);
			$alat_2 = $alat_2;

			//OVERHEAD
			$overhead = $this->pmm_model->getOverheadLabaRugi($date1,$date2);
			$overhead = $overhead;

			//OVERHEAD
			$overhead_2 = $this->pmm_model->getOverheadAkumulasiLabaRugi($date3,$date2);
			$overhead_2 = $overhead_2;

			//DISKONTO
			$diskonto = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 110")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date1' and '$date2')")
			->get()->row_array();
			$diskonto = $diskonto['total'];

			//DISKONTO_2
			$diskonto_2 = $this->db->select('sum(pdb.jumlah) as total')
			->from('pmm_biaya pb ')
			->join('pmm_detail_biaya pdb','pb.id = pdb.biaya_id','left')
			->join('pmm_coa c','pdb.akun = c.id','left')
			->where("pdb.akun = 110")
			->where("pb.status = 'PAID'")
			->where("(pb.tanggal_transaksi between '$date3' and '$date2')")
			->get()->row_array();
			$diskonto_2 = $diskonto_2['total'];

			$bahan = $total_nilai;
			$alat = $alat;
			$overhead = $overhead;
			$diskonto = $diskonto;
			$total_biaya_operasional = $bahan + $alat + $overhead + $diskonto;
			$laba_kotor = $total_penjualan_all - $total_biaya_operasional;
			$laba_usaha = $laba_kotor;
			$persentase_laba_sebelum_pajak = ($total_penjualan_all!=0)?($laba_usaha / $total_penjualan_all) * 100:0;

			$bahan_2 = $total_nilai_2;
			$alat_2 = $alat_2;
			$overhead_2 = $overhead_2;
			$diskonto_2 = $diskonto_2;
			$total_biaya_operasional_2 = $bahan_2 + $alat_2 + $overhead_2 + $diskonto_2;
			$laba_kotor_2 = $total_penjualan_all_2 - $total_biaya_operasional_2;
			$laba_usaha_2 = $laba_kotor_2;
			$persentase_laba_sebelum_pajak_2 = ($total_penjualan_all_2!=0)?($laba_usaha_2 / $total_penjualan_all_2) * 100:0;
	        ?>

			<table width="98%" border="0" cellpadding="3">
				<tr class="table-active" style="">
					<td width="50%">
						<div style="display: block;font-weight: bold;font-size: 10px;">Periode</div>
					</td>
					<td align="right" width="25%">
						<div align="center" style="display: block;font-weight: bold;font-size: 10px;"><?php echo $filter_date;?></div>
					</td>
					<td align="right" width="25%">
						<div align="center" style="display: block;font-weight: bold;font-size: 10px;">SD. <?php echo date('d/m/Y',strtotime($arr_filter_date[1]));?></div>
					</td>
				</tr>
			</table>
			<hr width="98%">
			<tr class="table-active4">
				<th width="100%" align="left"><b>Pendapatan Penjualan</b></th>
	        </tr>
			<tr class="table-active2">
				<th width="10%" align="center"></th>
				<th width="40%" align="left">Pendapatan</th>
	            <th width="25%" align="center">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span>Rp.</span>
								</th>
								<th align="right" width="80%">
									<span><?php echo number_format($total_penjualan_all,0,',','.');?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
				<th width="25%" align="center">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span>Rp.</span>
								</th>
								<th align="right" width="80%">
									<span><?php echo number_format($total_penjualan_all_2,0,',','.');?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
	        </tr>
			<hr width="98%">
			<tr class="table-active2">
				<th width="50%" align="left"><b>Total Pendapatan</b></th>
	            <th width="25%" align="right">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span><b>Rp.</b></span>
								</th>
								<th align="right" width="80%">
									<span><b><?php echo number_format($total_penjualan_all,0,',','.');?></b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
				<th width="25%" align="right">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span><b>Rp.</b></span>
								</th>
								<th align="right" width="80%">
									<span><b><?php echo number_format($total_penjualan_all_2,0,',','.');?></b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
	        </tr>
			<tr class="table-active3">
				<th width="100%" align="left"></th>
	        </tr>
			<tr class="table-active4">
				<th width="100%" align="left"><b>Beban Pokok Penjualan</b></th>
	        </tr>
			<tr class="table-active2">
				<th width="10%" align="center"></th>
				<th width="40%" align="left">Bahan</th>
	            <th width="25%" align="center">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span>Rp.</span>
								</th>
								<th align="right" width="80%">
									<span><?php echo number_format($total_nilai,0,',','.');?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
				<th width="25%" align="center">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span>Rp.</span>
								</th>
								<th align="right" width="80%">
									<span><?php echo number_format($total_nilai_2,0,',','.');?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
	        </tr>
			<tr class="table-active2">
				<th width="10%" align="center"></th>
				<th width="40%" align="left">Alat</th>
	            <th width="25%" align="center">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span>Rp.</span>
								</th>
								<th align="right" width="80%">
									<span><?php echo number_format($alat,0,',','.');?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
				<th width="25%" align="center">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span>Rp.</span>
								</th>
								<th align="right" width="80%">
									<span><?php echo number_format($alat_2,0,',','.');?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
	        </tr>
			<tr class="table-active2">
				<th width="10%" align="center"></th>
				<th width="40%" align="left">Overhead</th>
	            <th width="25%" align="center">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span>Rp.</span>
								</th>
								<th align="right" width="80%">
									<span><?php echo number_format($overhead,0,',','.');?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
				<th width="25%" align="center">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span>Rp.</span>
								</th>
								<th align="right" width="80%">
									<span><?php echo number_format($overhead_2,0,',','.');?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
	        </tr>
			<tr class="table-active2">
				<th width="10%" align="center"></th>
				<th width="40%" align="left">Diskonto</th>
	            <th width="25%" align="center">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span>Rp.</span>
								</th>
								<th align="right" width="80%">
									<span><?php echo number_format($diskonto,0,',','.');?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
				<th width="25%" align="center">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span>Rp.</span>
								</th>
								<th align="right" width="80%">
									<span><?php echo number_format($diskonto_2,0,',','.');?>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
	        </tr>
			<tr class="table-active2">
				<th width="50%" align="left"><b>Total Beban Pokok Penjualan</b></th>
	            <th width="25%" align="right">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span><b>Rp.</b></span>
								</th>
								<th align="right" width="80%">
									<span><b><?php echo number_format($total_biaya_operasional,0,',','.');?></b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
				<th width="25%" align="right">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span><b>Rp.</b></span>
								</th>
								<th align="right" width="80%">
									<span><b><?php echo number_format($total_biaya_operasional_2,0,',','.');?></b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
	        </tr>
			<tr class="table-active3">
				<th width="100%" align="left"></th>
	        </tr>
			<?php
				$styleColorLabaKotor = $laba_kotor < 0 ? 'color:red' : 'color:black';
				$styleColorLabaKotor2 = $laba_kotor_2 < 0 ? 'color:red' : 'color:black';
				$styleColorSebelumPajak = $laba_usaha < 0 ? 'color:red' : 'color:black';
				$styleColorSebelumPajak2 = $laba_usaha_2 < 0 ? 'color:red' : 'color:black';
			?>	
			<tr class="table-active2">
	            <th width="50%" align="left"><b>Laba / Rugi Kotor</b></th>
	            <th width="25%" align="right" style="<?php echo $styleColorLabaKotor ?>">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span><b>Rp.</b></span>
								</th>
								<th align="right" width="80%">
									<span><b><?php echo $laba_kotor < 0 ? "(".number_format(-$laba_kotor,0,',','.').")" : number_format($laba_kotor,0,',','.');?></b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
				<th width="25%" align="right" style="<?php echo $styleColorLabaKotor2 ?>">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span><b>Rp.</b></span>
								</th>
								<th align="right" width="80%">
									<span><b><?php echo $laba_kotor_2 < 0 ? "(".number_format(-$laba_kotor_2,0,',','.').")" : number_format($laba_kotor_2,0,',','.');?></b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
	        </tr>
			<tr class="table-active3">
				<th width="100%" align="left"></th>
	        </tr>
			<tr class="table-active4">
	            <th width="50%" align="left"><b>Biaya Umum & Administratif</b></th>
	            <th width="25%" align="right">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span><b>Rp.</b></span>
								</th>
								<th align="right" width="80%">
									<span><b>-</b></span>
								</th>
							</tr>
					</table>
				</th>
				<th width="25%" align="right">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span><b>Rp.</b></span>
								</th>
								<th align="right" width="80%">
									<span><b>-</b></span>
								</th>
							</tr>
					</table>
				</th>
	        </tr>
			<tr class="table-active3">
				<th width="100%" align="left"></th>
	        </tr>
			<tr class="table-active3">
	            <th width="50%" align="left"><b>Laba / Rugi Usaha</b></th>
	            <th width="25%" align="right" style="<?php echo $styleColorSebelumPajak ?>">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span><b>Rp.</b></span>
								</th>
								<th align="right" width="80%">
									<span><b><?php echo $laba_usaha < 0 ? "(".number_format(-$laba_usaha,0,',','.').")" : number_format($laba_usaha,0,',','.');?></b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
				<th width="25%" align="right" style="<?php echo $styleColorSebelumPajak2 ?>">
					<table width="100%" border="0" cellpadding="0">
						<tr>
								<th align="left" width="20%">
									<span><b>Rp.</b></span>
								</th>
								<th align="right" width="80%">
									<span><b><?php echo $laba_usaha_2 < 0 ? "(".number_format(-$laba_usaha_2,0,',','.').")" : number_format($laba_usaha_2,0,',','.');?></b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
								</th>
							</tr>
					</table>
				</th>
	        </tr>
	    </table>
		<table width="98%" border="0" cellpadding="30">
			<tr >
				<td width="5%"></td>
				<td width="90%">
					<table width="100%" border="0" cellpadding="2">
						<tr>
							<td align="center" >
								Dibuat Oleh
							</td>
							<td align="center">
								Diperiksa Oleh
							</td>
							<td align="center">
								Disetujui Oleh
							</td>
						</tr>
						<tr class="">
							<td align="center" height="50px">
								<img src="uploads/ttd_tri.png" width="50px">
							</td>
							<td align="center">
								<img src="uploads/ttd_erika.png" width="50px">
							</td>
							<td align="center">
								<img src="uploads/ttd_deddy.png" width="50px">
							</td>
						</tr>
						<tr>
							<td align="center">
								<b><u>Tri Wahyu Rahadi</u><br />
								Ka. Plant</b>
							</td>
							<td align="center">
								<b><u>Erika Sinaga</u><br />
								Dir. Keuangan & SDM</b>
							</td>
							<td align="center">
								<b><u>Deddy Sarwobiso</u><br />
								Direktur Utama</b>
							</td>
						</tr>
					</table>
				</td>
				<td width="5%"></td>
			</tr>
		</table>
	</body>
</html>