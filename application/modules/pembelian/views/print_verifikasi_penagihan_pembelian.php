<!DOCTYPE html>
<html>
	<head>
	  <title>Verifikasi Dokumen Penagihan Pembelian</title>
	  
	  <style type="text/css">
	  	body {
			font-family: helvetica;
		}
	  </style>

	</head>
	<body>
		<table width="98%" border="0" cellpadding="3">
			<tr>
				<td align="center">
					<div style="display: block;font-weight: bold;font-size: 12px;">BUKTI PENERIMAAN DAN VERIFIKASI DOKUMEN TAGIHAN</div>
				</td>
			</tr>
		</table>
		<br /><br />
		<table width="98%" border="1" cellpadding="2">
			<tr>
				<td>
					<table width="100%" border="0" cellpadding="3">
						<tr>
							<td colspan="2" width="24%">
								<div style="display: block;font-weight: bold;"><u>DIISI OLEH VEFIKATOR</u></div>
							</td>
							<td width="2%">:</td>
							<td width="74%"></td>
						</tr>
						<tr>
							<td width="4%">1.</td>
							<td width="20%">Nama Rekanan</td>
							<td width="2%">:</td>
							<td width="74%"><?= $row['supplier_name'];?></td>
						</tr>
						<tr>
							<td>2.</td>
							<td>Nomor Kontrak / PO</td>
							<td>:</td>
							<td ><?= $row['nomor_po'].' - '.$row['tanggal_po'];?></td>
						</tr>
						<tr>
							<td>3.</td>
							<td>Nama Barang / Jasa</td>
							<td>:</td>
							<td ><?= $row['nama_barang_jasa'];?></td>
						</tr>
						<tr>
							<td>4.</td>
							<td>Nilai Kontrak / PO</td>
							<td>:</td>
							<td ><?= $row['nilai_kontrak'];?></td>
						</tr>
						<tr>
							<td>5.</td>
							<td>Nilai Tagihan ini (DPP)</td>
							<td>:</td>
							<td ><?= $row['nilai_tagihan'];?></td>
						</tr>
						<tr>
							<td>6.</td>
							<td >PPN</td>
							<td>:</td>
							<td  ><?= $row['ppn'];?></td>
						</tr>
						<tr>
							<td>7.</td>
							<td >PPh 23</td>
							<td>:</td>
							<td  ><?= $row['pph'];?></td>
						</tr>
						<tr>
							<td>8.</td>
							<td >Total Tagihan</td>
							<td>:</td>
							<td  ><?= $row['total_tagihan'];?></td>
						</tr>
						<tr>
							<td>9.</td>
							<td >Tanggal Invoice</td>
							<td>:</td>
							<td ><?= $row['tanggal_invoice'];?></td>
						</tr>
						<tr>
							<td>10.</td>
							<td >Tanggal Diterima Proyek</td>
							<td>:</td>
							<td ><?= $row['tanggal_diterima_proyek'];?></td>
						</tr>
						<tr>
							<td>11.</td>
							<td >Tanggal Lolos Verifikasi</td>
							<td>:</td>
							<td ><?= $row['tanggal_lolos_verifikasi'];?></td>
						</tr>
						<tr>
							<td>12.</td>
							<td >Tanggal Diterima Pusat</td>
							<td>:</td>
							<td ></td>
						</tr>
						<tr>
							<td>13.</td>
							<td >Metode Pembayaran</td>
							<td>:</td>
							<td ><?= $row['metode_pembayaran'];?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br />
		<br />
		<table width="98%" border="1" cellpadding="3">
			<tr style="font-weight: bold">
				<th width="30%">
					<table width="100%" border="0">
						<tr>
							<td width="10%" style="vertical-align: middle;">A.</td>
							<td width="90%">KELENGKAPAN DATA <br />(LENGKAP DAN BENAR)</td>
						</tr>
					</table>
				</th>
				<th width="20%" style="text-align: center">ADA / TIDAK (V/X)</th>
				<th width="50%" style="text-align: center">KETERANGAN</th>
			</tr>
			<tr>
				<th width="30%">
					<table width="100%" border="0">
						<tr>
							<td width="10%" style="vertical-align: middle;">1.</td>
							<td width="90%">Invoice</td>
						</tr>
					</table>
				</th>
				<th width="20%" style="text-align: center"><?= $this->pmm_finance->CheckorNo($row['invoice']);?></th>
				<th width="50%" ><?= $row['invoice_keterangan'];?></th>
			</tr>
			<tr>
				<th width="30%">
					<table width="100%" border="0">
						<tr>
							<td width="10%" style="vertical-align: middle;">2.</td>
							<td width="90%">Kwitansi</td>
						</tr>
					</table>
				</th>
				<th width="20%" style="text-align: center"><?= $this->pmm_finance->CheckorNo($row['kwitansi']);?></th>
				<th width="50%" ><?= $row['kwitansi_keterangan'];?></th>
			</tr>
			<tr>
				<th width="30%">
					<table width="100%" border="0">
						<tr>
							<td width="10%" style="vertical-align: middle;">3.</td>
							<td width="90%">Faktur Pajak</td>
						</tr>
					</table>
				</th>
				<th width="20%" style="text-align: center"><?= $this->pmm_finance->CheckorNo($row['faktur']);?></th>
				<th width="50%" ><?= $row['faktur_keterangan'];?></th>
			</tr>
			<tr>
				<th width="30%">
					<table width="100%" border="0">
						<tr>
							<td width="10%" style="vertical-align: middle;">4.</td>
							<td width="90%">Berita Acara Pembayaran (BAP)</td>
						</tr>
					</table>
				</th>
				<th width="20%" style="text-align: center"><?= $this->pmm_finance->CheckorNo($row['bap']);?></th>
				<th width="50%" ><?= $row['bap_keterangan'];?></th>
			</tr>
			<tr>
				<th width="30%">
					<table width="100%" border="0">
						<tr>
							<td width="10%" style="vertical-align: middle;">5.</td>
							<td width="90%">Berita Acara Serah Terima (BAST)</td>
						</tr>
					</table>
				</th>
				<th width="20%" style="text-align: center"><?= $this->pmm_finance->CheckorNo($row['bast']);?></th>
				<th width="50%" ><?= $row['bast_keterangan'];?></th>
			</tr>
			<tr>
				<th width="30%">
					<table width="100%" border="0">
						<tr>
							<td width="10%" style="vertical-align: middle;">6.</td>
							<td width="90%">Surat Jalan</td>
						</tr>
					</table>
				</th>
				<th width="20%" style="text-align: center"><?= $this->pmm_finance->CheckorNo($row['surat_jalan']);?></th>
				<th width="50%" ><?= $row['surat_jalan_keterangan'];?></th>
			</tr>
			<tr>
				<th width="30%">
					<table width="100%" border="0">
						<tr>
							<td width="10%" style="vertical-align: middle;">7.</td>
							<td width="90%">Copy Kontrak (P0)</td>
						</tr>
					</table>
				</th>
				<th width="20%" style="text-align: center"><?= $this->pmm_finance->CheckorNo($row['copy_po']);?></th>
				<th width="50%" ><?= $row['copy_po_keterangan'];?></th>
			</tr>
		</table>
		<br />
		<br />
		<table width="98%" border="1" cellpadding="3">
			<tr >
				<th width="100%">
					<table width="100%" border="0">
						<tr>
							<td width="20%" style="vertical-align: middle;">Catatan</td>
							<td width="80%" style="height:80px"><?= $row['catatan'];?></td>
						</tr>
					</table>
				</th>
			</tr>
		</table>
		<br /><br />
        <!--<table width="98%" border="0" cellpadding="0">
			<?php
				$this->db->select('a.admin_name, g.admin_group_name, a.admin_ttd');
				$this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
				$this->db->where('a.admin_id',$row['created_by']);
				$verifikator = $this->db->get('tbl_admin a')->row_array();
				
				$ttd_proyek = $this->db->select('*')
				->from('pmm_verifikasi_penagihan_pembelian')
				->where('id', $row['id'])
				->get()->row_array();

				$this->db->select('a.admin_name, g.admin_group_name, a.admin_ttd');
				$this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
				$this->db->where('a.admin_id',$ttd_proyek['logistik']);
				$logistik = $this->db->get('tbl_admin a')->row_array();
				
				$this->db->select('a.admin_name, g.admin_group_name, a.admin_ttd');
				$this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
				$this->db->where('a.admin_id',$ttd_proyek['unit_head']);
				$unit_head = $this->db->get('tbl_admin a')->row_array();

				$ttd_pusat = $this->db->select('*')
				->from('pmm_verifikasi_penagihan_pembelian')
				->where('id', $row['id'])
				->where('approve_unit_head', 'SETUJUI')
				->get()->row_array();

				$this->db->select('a.admin_name, g.admin_group_name, a.admin_ttd');
				$this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
				$this->db->where('a.admin_id',$ttd_pusat['keu_pusat']);
				$keu_pusat = $this->db->get('tbl_admin a')->row_array();

				$this->db->select('a.admin_name, g.admin_group_name, a.admin_ttd');
				$this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
				$this->db->where('a.admin_id',$ttd_pusat['pusat']);
				$pusat = $this->db->get('tbl_admin a')->row_array();
			?>
            <tr border="1">
                <td width="100%">
				<table width="100%" border="1" cellpadding="2">
                        <tr>
                            <td align="center">
                                Dibuat Oleh
                            </td>
                            <td align="center" colspan="2">
                                Diperiksa 
                            </td>
							<td align="center">
								Disetujui
                            </td>
							<td align="center">
                                Mengetahui
                            </td>
                        </tr>
                        <tr>
                            <td align="center" height="75px">
								<img src="<?= $verifikator['admin_ttd']?>" width="75px">
                            </td>
                            <td align="center">
								<img src="<?= $logistik['admin_ttd']?>" width="75px">
                            </td>
							<td align="center">
								<img src="<?= $keu_pusat['admin_ttd']?>" width="75px">
                            </td>
                            <td align="center">
								<img src="<?= $unit_head['admin_ttd']?>" width="75px">
                            </td>
							<td align="center">
								<img src="<?= $pusat['admin_ttd']?>" width="75px">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
								<?= $verifikator['admin_name'];?>
                            </td>
                            <td align="center">
								<?= $logistik['admin_name'];?>
                            </td>
							<td align="center">
								<?= $keu_pusat['admin_name'];?>
                            </td>
                            <td align="center">
								<?= $unit_head['admin_name'];?>
                            </td>
							<td align="center">
								<?= $pusat['admin_name'];?>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
								<b><?= $verifikator['admin_group_name'];?></b> 
                            </td>
                            <td align="center">
								<b><?= $logistik['admin_group_name'];?></b> 
                            </td>
							<td align="center">
								<b><?= $keu_pusat['admin_group_name'];?></b> 
                            </td>
                            <td align="center">
								<b><?= $unit_head['admin_group_name'];?></b> 
                            </td>
							<td align="center">
								<b><?= $pusat['admin_group_name'];?></b> 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>-->

		<table width="98%" border="0" cellpadding="0">
			<?php
				$this->db->select('a.admin_name, g.admin_group_name, a.admin_ttd');
				$this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
				$this->db->where('a.admin_id',$row['created_by']);
				$verifikator = $this->db->get('tbl_admin a')->row_array();
				
				$ttd_proyek = $this->db->select('*')
				->from('pmm_verifikasi_penagihan_pembelian')
				->where('id', $row['id'])
				->get()->row_array();

				$this->db->select('a.admin_name, g.admin_group_name, a.admin_ttd');
				$this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
				$this->db->where('a.admin_id',$ttd_proyek['logistik']);
				$logistik = $this->db->get('tbl_admin a')->row_array();
				
				$this->db->select('a.admin_name, g.admin_group_name, a.admin_ttd');
				$this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
				$this->db->where('a.admin_id',$ttd_proyek['unit_head']);
				$unit_head = $this->db->get('tbl_admin a')->row_array();

				$ttd_pusat = $this->db->select('*')
				->from('pmm_verifikasi_penagihan_pembelian')
				->where('id', $row['id'])
				->where('approve_unit_head', 'SETUJUI')
				->get()->row_array();

				$this->db->select('a.admin_name, g.admin_group_name, a.admin_ttd');
				$this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
				$this->db->where('a.admin_id',$ttd_pusat['keu_pusat']);
				$keu_pusat = $this->db->get('tbl_admin a')->row_array();

				$this->db->select('a.admin_name, g.admin_group_name, a.admin_ttd');
				$this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
				$this->db->where('a.admin_id',$ttd_pusat['pusat']);
				$pusat = $this->db->get('tbl_admin a')->row_array();

				
			?>
            <tr border="1">
                <td width="100%">
				<table width="100%" border="1" cellpadding="2">
                        <tr>
                            <td align="center">
                                Dibuat Oleh
                            </td>
                            <td align="center" colspan="2">
                                Diperiksa 
                            </td>
							<td align="center">
								Disetujui
                            </td>
							<td align="center">
                                Mengetahui
                            </td>
                        </tr>
                        <tr>
                            <td align="center" height="75px">
								
                            </td>
                            <td align="center">
								
                            </td>
							<td align="center">
								
                            </td>
                            <td align="center">
								
                            </td>
							<td align="center">
								
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
								<?= $verifikator['admin_name'];?>
                            </td>
                            <td align="center">
								<?= $logistik['admin_name'];?>
                            </td>
							<td align="center">
								Debi Khania
                            </td>
                            <td align="center">
								<?= $unit_head['admin_name'];?>
                            </td>
							<td align="center">
								Erika Sinaga
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
								<b><?= $verifikator['admin_group_name'];?></b> 
                            </td>
                            <td align="center">
								<b><?= $logistik['admin_group_name'];?></b> 
                            </td>
							<td align="center">
								<b>Keuangan Pusat</b> 
                            </td>
                            <td align="center">
								<b><?= $unit_head['admin_group_name'];?></b> 
                            </td>
							<td align="center">
								<b>Dir. Keuangan & SDM</b> 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
	</body>
</html>