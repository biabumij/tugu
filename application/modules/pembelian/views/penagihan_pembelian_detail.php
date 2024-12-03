<!doctype html>
<html lang="en" class="fixed">

<head>
    <?php echo $this->Templates->Header(); ?>

    <style type="text/css">
        body {
			font-family: helvetica;
		}

        button {
			border: none;
			border-radius: 5px;
			padding: 5px;
			font-size: 12px;
			text-transform: uppercase;
			cursor: pointer;
			color: white;
			background-color: #2196f3;
			box-shadow: 0 0 4px #999;
			outline: none;
		}

		.ripple {
			background-position: center;
			transition: background 0.8s;
		}
		.ripple:hover {
			background: #47a7f5 radial-gradient(circle, transparent 1%, #47a7f5 1%) center/15000%;
		}
		.ripple:active {
			background-color: #6eb9f7;
			background-size: 100%;
			transition: background 0s;
		}
    </style>
</head>

<body>
    <div class="wrap">
        <?php echo $this->Templates->PageHeader();?>
        <div class="page-body">
            <div class="content">
                <div class="row animated fadeInUp">
                    <div class="col-sm-12 col-lg-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div>
                                    <h3><b>DETAIL TAGIHAN PEMBELIAN <?php echo $this->pmm_model->GetStatus3($row['status']);?></b></h3>
                                    <div class="text-left">
                                        <a href="<?php echo site_url('admin/pembelian');?>">
                                        <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-content">
                                <table class="table table-striped table-bordered" width="100%">
                                    <tr>
                                        <th width="20%" align="left">Rekanan</th>
                                        <th width="80%" align="left"><label class="label label-default" style="font-size:14px;"><?= $row['supplier']; ?></label></th>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <th style="font-weight:normal;"><textarea class="form-control" name="alamat_supplier" id="alamat_supplier"  rows="5" readonly=""><?= $row['supplier_address']; ?></textarea></th>
                                    </tr>
                                    <tr>
                                        <th>No. Pesanan Pembelian</th>
                                        <th style="font-weight:normal;"><a target="_blank" href="<?= base_url("pmm/purchase_order/manage/".$row['purchase_order_id']) ?>"><?php echo $this->crud_global->GetField('pmm_purchase_order',array('id'=>$row['purchase_order_id']),'no_po');?></a></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pesanan Pembelian</th>
                                        <th style="font-weight:normal;"><?php echo date('d/m/Y',strtotime($row['tanggal_po']));?></th>
                                    </tr>
                                </table>
                                <table class="table table-striped table-bordered" width="100%">
                                    <tr>
                                        <th width="20%" align="left">Nomor Invoice</th>
                                        <th width="80%" align="left" style="font-weight:bold;"><label class="label label-success" style="font-size:14px;"><?= $row['nomor_invoice']; ?></label></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Invoice</th>
                                        <th style="font-weight:normal;"><?= date('d/m/Y', strtotime($row['tanggal_invoice'])); ?></th>
                                    </tr>
                                    <tr>
                                        <th>Syarat Pembayaran</th>
                                        <th style="font-weight:normal;"><?= $row['syarat_pembayaran']; ?> Hari</th>
                                    </tr>
                                    <!--<tr>
                                        <th>Tanggal Jatuh Tempo</th>
                                        <th style="font-weight:normal;"><?= date('d/m/Y', strtotime($row['tanggal_jatuh_tempo'])); ?></th>
                                    </tr>-->
                                    <tr>
                                        <th>Memo</th>
                                        <th style="font-weight:normal;"><?= $row["memo"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>Lampiran</th>
                                        <th style="font-weight:normal;">
                                        <?php
                                            $dataLampiran = $this->db->get_where('pmm_lampiran_penagihan_pembelian', array('penagihan_pembelian_id' => $row['id']))->result_array();
                                            if (!empty($dataLampiran)) {
                                                foreach ($dataLampiran as $key => $lampiran) {
                                            ?>
                                                    <div><a href="<?= base_url() . 'uploads/penagihan_pembelian/' . $lampiran['lampiran']; ?>" target="_blank"><?= $lampiran['lampiran']; ?></a></div>
                                            <?php
                                                }
                                            }
                                        ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Dibuat Oleh</th>
                                        <th style="font-weight:normal;"><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');?></th>
                                    </tr>
                                    <tr>
                                        <th>Dibuat Tanggal</th>
                                        <th style="font-weight:normal;"><?= date('d/m/Y H:i:s',strtotime($row['created_on']));?></th>
                                    </tr>
                                </table>
                                <br />
                                <div class="table-responsive">
                                    <table id="table-product" class="table table-bordered table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">No.</th>
                                                <th width="30%" class="text-left">Produk</th>
                                                <th class="text-right">Volume</th>
                                                <th class="text-center">Satuan</th>
                                                <th class="text-right">Harga Satuan</th>
                                                <th class="text-center">Pajak</th>
                                                <th class="text-center">Pajak (2)</th>
                                                <th class="text-right">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sub_total = 0;
                                            $tax_pph = 0;
                                            $tax_ppn = 0;
                                            $tax_ppn11 = 0;
                                            $tax_0 = false;
                                            $pajak_pph = 0;
                                            $pajak_ppn = 0;
                                            $pajak_ppn11 = 0;
                                            $pajak_0 = false;
                                            $total = 0;
                                            $details = $this->db->get_where('pmm_penagihan_pembelian_detail', array('penagihan_pembelian_id' => $row['id']))->result_array();
                                            ?>
                                            <?php foreach ($details as $key => $dt) { ?>
                                                <?php
                                                $material = $this->crud_global->GetField('produk', array('id' => $dt['material_id']), 'nama_produk');
                                                $tax = $this->crud_global->GetField('pmm_taxs', array('id' => $dt['tax_id']), 'tax_name');
                                                $pajak = $this->crud_global->GetField('pmm_taxs', array('id' => $dt['pajak_id']), 'tax_name');
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $key + 1 ?>.</td>
                                                    <td class="text-left"><?= $material; ?></td>
                                                    <td class="text-right"><?= number_format($dt['volume'],2,',','.'); ?></td>
                                                    <td class="text-center"><?= $dt['measure']; ?></td>
                                                    <td class="text-right"><?= number_format($dt['price'],0,',','.'); ?></td>
                                                    <td class="text-center"><?= $tax; ?></td>
													<input type="hidden" value="<?= $this->filter->Rupiah($dt['tax_id']); ?>">
                                                    <td class="text-center"><?= $pajak; ?></td>
                                                    <input type="hidden" value="<?= $this->filter->Rupiah($dt['pajak_id']); ?>">
                                                    <td class="text-right"><?= number_format($dt['total'],0,',','.'); ?></td>
                                                </tr>
                                            <?php
                                                $sub_total += $dt['total'];
                                                if ($dt['tax_id'] == 4) {
                                                    $tax_0 = true;
                                                }
                                                if ($dt['tax_id'] == 3) {
                                                    $tax_ppn += $dt['tax'];
                                                }
                                                if ($dt['tax_id'] == 5) {
                                                    $tax_pph += $dt['tax'];
                                                }
                                                if ($dt['tax_id'] == 6) {
                                                    $tax_ppn11 += $dt['tax'];
                                                }
                                                if ($dt['pajak_id'] == 4) {
                                                    $pajak_0 = true;
                                                }
                                                if ($dt['pajak_id'] == 3) {
                                                    $pajak_ppn += $dt['pajak'];
                                                }
                                                if ($dt['pajak_id'] == 5) {
                                                    $pajak_pph += $dt['pajak'];
                                                }
                                                if ($dt['pajak_id'] == 6) {
                                                    $pajak_ppn11 += $dt['pajak'];
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label></label>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label></label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-8 form-horizontal">
                                        <div class="row">
                                            <label class="col-sm-7 control-label">SUB TOTAL</label>
                                            <div class="col-sm-5 text-right">
                                                <label id="sub-total"><?= number_format($sub_total,0,',','.'); ?></label>
                                            </div>
                                        </div>
                                        <?php
                                        if ($tax_ppn > 0) {
                                        ?>
                                            <div class="row">
                                                <label class="col-sm-7 control-label">PAJAK (PPN 10%)</label>
                                                <div class="col-sm-5 text-right">
                                                    <label id="sub-total"><?= number_format($tax_ppn,0,',','.'); ?></label>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($tax_0) {
                                        ?>
                                            <div class="row">
                                                <label class="col-sm-7 control-label">PAJAK (PPN 0%)</label>
                                                <div class="col-sm-5 text-right">
                                                    <label id="sub-total"><?= number_format(0,0,',','.'); ?></label>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($tax_pph > 0) {
                                        ?>
                                            <div class="row">
                                                <label class="col-sm-7 control-label">PAJAK (PPh 23)</label>
                                                <div class="col-sm-5 text-right">
                                                    <label id="sub-total"><?= number_format($tax_pph,0,',','.'); ?></label>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($tax_ppn11 > 0) {
                                        ?>
                                            <div class="row">
                                                <label class="col-sm-7 control-label">PAJAK (PPN 11%)</label>
                                                <div class="col-sm-5 text-right">
                                                    <label id="sub-total"><?= number_format($tax_ppn11,0,',','.'); ?></label>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($pajak_ppn > 0) {
                                        ?>
                                            <div class="row">
                                                <label class="col-sm-7 control-label">PAJAK (PPN 10%)</label>
                                                <div class="col-sm-5 text-right">
                                                    <label id="sub-total"><?= number_format($pajak_ppn,0,',','.'); ?></label>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($pajak_0) {
                                        ?>
                                            <div class="row">
                                                <label class="col-sm-7 control-label">PAJAK (PPN 0%)</label>
                                                <div class="col-sm-5 text-right">
                                                    <label id="sub-total"><?= number_format(0,0,',','.'); ?></label>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($pajak_pph > 0) {
                                        ?>
                                            <div class="row">
                                                <label class="col-sm-7 control-label">PAJAK (PPh 23)</label>
                                                <div class="col-sm-5 text-right">
                                                    <label id="sub-total"><?= number_format($pajak_pph,0,',','.'); ?></label>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($pajak_ppn11 > 0) {
                                        ?>
                                            <div class="row">
                                                <label class="col-sm-7 control-label">PAJAK (PPN 11%)</label>
                                                <div class="col-sm-5 text-right">
                                                    <label id="sub-total"><?= number_format($pajak_ppn11,0,',','.'); ?></label>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        $total = $sub_total + ($tax_ppn - $tax_pph + $tax_ppn11) + ($pajak_ppn - $pajak_pph + $pajak_ppn11);
                                        $sisa_tagihan = $this->pmm_finance->getTotalPembayaranPenagihanPembelian($row['id']);
                                        ?>
                                        <div class="row">
                                        <label class="col-sm-7 control-label">TOTAL</label>
                                            <div class="col-sm-5 text-right">
                                                <label id="total"><?= number_format($total,0,',','.'); ?></label>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <label class="col-sm-7 control-label">UANG MUKA</label>
                                            <div class="col-sm-5 text-right">
                                                <label id="sub-total"><?= number_format($row['uang_muka'],0,',','.'); ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-7 control-label">PEMBAYARAN</label>
                                            <div class="col-sm-5 text-right">
                                                <label id="sub-total"><?= number_format($row['pembayaran'] - $row['uang_muka'],0,',','.'); ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <label class="col-sm-7 control-label">SISA TAGIHAN</label>
                                            <div class="col-sm-5 text-right">
                                            <label id="total"><?= number_format($total - $row['uang_muka'] - ($row['pembayaran'] - $row['uang_muka'])); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br />
                            <div class="text-center">
                                <?php
                                if ($row['verifikasi_dok'] == 'BELUM') { ?>
                                    <blink><p style='color:red; font-weight:bold;'>VERIFIKASI DOKUMEN TERLEBIH DAHULU !!</p></blink>
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6 || $this->session->userdata('admin_group_id') == 8 || $this->session->userdata('admin_group_id') == 9){
                                    ?>
                                    <a class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('pembelian/delete_penagihan_pembelian/' . $row['id']); ?>')"> HAPUS</a>
                                    <?php
                                    }
                                }
                                ?>
                                <br />
                                <?php if ($row["verifikasi_dok"] === "SUDAH") : ?>
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6 || $this->session->userdata('admin_group_id') == 8 || $this->session->userdata('admin_group_id') == 9){
                                    ?>
                                    <a href="<?= site_url('pembelian/pembayaran_panagihan/' . $row['id']); ?>" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> KIRIM PEMBAYARAN</a>
                                    <a href="<?= site_url('pembelian/closed_pembayaran_penagihan/' . $row['id']); ?>" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> PEMBAYARAN LUNAS</a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6 || $this->session->userdata('admin_group_id') == 8 || $this->session->userdata('admin_group_id') == 9){
                                    ?>
                                    <a href="<?= base_url('pembelian/sunting_tagihan/' . $row["id"]) ?>" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> EDIT TAGIHAN</a>
                                    <a href="<?= base_url('pembelian/sunting_verifikasi/' . $row["id"]) ?>" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> EDIT VERIFIKASI</a>
                                    <a class="btn btn-default" onclick="DeleteData('<?= site_url('pembelian/delete_penagihan_pembelian/' . $row['id']); ?>')"  style="width:150px; font-weight:bold; border-radius:10px;"> HAPUS</a>
                                    <?php
                                    }
                                    ?>
                                    <?php endif;
                                ?>

                                <?php if ($row["verifikasi_dok"] === "LENGKAP") : ?>
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6 || $this->session->userdata('admin_group_id') == 8 || $this->session->userdata('admin_group_id') == 9){
                                    ?>
                                    <a href="<?= site_url('pembelian/open_penagihan/' . $row['id']); ?>" class="btn btn-default" style="width:20%; font-weight:bold; border-radius:10px;"> PEMBAYARAN BELUM LUNAS</a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4){
                                    ?>
                                    <a class="btn btn-default" onclick="DeleteData('<?= site_url('pembelian/delete_penagihan_pembelian/' . $row['id']); ?>')" style="width:150px; font-weight:bold; border-radius:10px;"> HAPUS</a>
                                    <?php
                                    }
                                    ?>
                                    <?php endif;
                                ?>
                            </div>
                            <div class="text-center">
                                <a href="<?php echo site_url('admin/pembelian#settings'); ?>" class="btn btn-info" style="width:150px; font-weight:bold; border-radius:10px;"> KEMBALI</a>
                            </div>
                            <div class="container-fluid">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#menu1" aria-controls="menu2" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">DAFTAR SURAT JALAN</a></li>
                                    <li role="presentation"><a href="#menu2" aria-controls="menu2" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">DAFTAR PEMBAYARAN</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="menu1">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover text-center" id="table-surat-jalan" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Nomor</th>
                                                        <th>Produk</th>
                                                        <th>No. Kendaraan</th>
                                                        <th>Supir</th>
                                                        <th>Volume</th>
                                                        <th>Satuan</th>
                                                        <th>Surat Jalan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $surat_jalan = explode(',', $row['surat_jalan']);
                                                    $this->db->select('prm.*,ppo.no_po, p.nama_produk');
                                                    $this->db->join('pmm_purchase_order ppo', 'prm.purchase_order_id = ppo.id', 'left');
                                                    $this->db->join('produk p', 'prm.material_id = p.id', 'left');
                                                    $this->db->where_in('prm.id', $surat_jalan);
                                                    $table_surat_jalan = $this->db->get('pmm_receipt_material prm')->result_array();
                                                    if (!empty($table_surat_jalan)) {
                                                        foreach ($table_surat_jalan as $sj) {
                                                    ?>
                                                        <tr>
                                                            <td><?= date('d/m/Y', strtotime($sj['date_receipt'])); ?></td>
                                                            <td><?= $sj['surat_jalan']; ?></td>
                                                            <td><?= $sj['nama_produk']; ?></td>
                                                            <td style="text-align: left !important;"><?= $sj['no_kendaraan']; ?></td>
                                                            <td style="text-align: left !important;"><?= $sj['driver']; ?></td>
                                                            <td style="text-align: right !important;"><?= $this->filter->Rupiah($sj['volume']); ?></td>
                                                            <td><?= $sj['measure']; ?></td>
                                                            <td><?= $sj['surat_jalan_file'] = '<a href="'.base_url().'uploads/surat_jalan_penerimaan/'.$sj['surat_jalan_file'].'" target="_blank">'.$sj['surat_jalan_file'].'</a>'; ?></td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="menu2">
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover text-center" id="table-pembayaran" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Nomor</th>
                                                        <th>Bayar Dari</th>
                                                        <th>Jumlah</th>
                                                        <th>Status</th>
                                                        <th>Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-center">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>

    <script type="text/javascript">
        var form_control = '';
    </script>
    
    <?php echo $this->Templates->Footer();?>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/jquery.number.min.js"></script>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/daterangepicker.css">
    <script src="<?php echo base_url();?>assets/back/theme/vendor/bootbox.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $('.form-approval').submit(function(e) {
            e.preventDefault();
            var currentForm = this;
            bootbox.confirm({
                message: "Apakah anda yakin untuk proses data ini ?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function(result) {
                    if (result) {
                        currentForm.submit();
                    }

                }
            });

        });

        var table = $('#table-pembayaran').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('pembelian/table_pembayaran_penagihan_pembelian/' . $row["id"]); ?>',
                type: 'POST',
            },
            columns: [{
                    "data": "tanggal_pembayaran"
                },
                {
                    "data": "nomor_transaksi",
                    "render": function(data, type, row, meta) {
                        console.log(row);
                        if (type === 'display') {
                            data = '<a href="<?php echo base_url() . 'pembelian/view_pembayaran_pembelian/' ?>' + row.id + '">' + data + '</a>';
                        }

                        return data;
                    }
                },
                {
                    "data": "bayar_dari"
                },
                {
                    "data": "total_pembayaran"
                },
                {
                    "data": "status"
                },
                {
                    "data": "action"
                }
            ],
            "pageLength": 5,
            "columnDefs": [
                { "width": "5%", "targets": [0, 5], "className": 'text-center'},
                { "targets": 3, "className": 'text-right'},
            ],
            responsive: true,
        });

        var table_surat_jalan = $('#table-surat-jalan').DataTable( {"bAutoWidth": false,
            "pageLength": 5,
        });

        function ApprovePayment(id) {
            bootbox.confirm({
                message: "Apakah anda yakin untuk proses data ini ?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function(result) {
                    if (result) {
                        $.post('<?= base_url() ?>pembelian/approve_payment', {
                            id: id
                        }, function(response) {
                            console.log(response);
                            location.reload();
                        });
                    }

                }
            });
        }

        function DeleteData(href) {
            bootbox.confirm({
                message: "Apakah anda yakin untuk menghapus tagihan ini ? <br /> * Jika ada data pembayaran, maka akan terhapus.<br /> * Status surat jalan akan kembali 'UNCREATED'.",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function(result) {
                    if (result) {
                        window.location.href = href;
                    }

                }
            });
        }
    </script>


</body>

</html>