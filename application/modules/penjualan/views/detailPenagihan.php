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
                                    <h3><b>DETAIL TAGIHAN PENJUALAN <?php echo $this->pmm_model->GetStatus2($penagihan['status']);?></b></h3>
                                    <div class="text-left">
                                        <a href="<?php echo site_url('admin/penjualan');?>">
                                        <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-content">
                            <table class="table table-striped table-bordered" width="100%">
                                    <tr>
                                        <th width="20%" align="left">Pelanggan</th>
                                        <th width="80%" align="left"><label class="label label-default" style="font-size:14px;"><?= $penagihan["nama_pelanggan"] ?></label></th>
                                    </tr>
                                    <tr>
                                        <th>Alamat Pelanggan</th>
                                        <th><textarea class="form-control" name="alamat_pelanggan" rows="5" readonly=""><?= $penagihan['alamat_pelanggan']; ?></textarea></th>
                                    </tr>
                                    <tr>
                                        <th>Nomor Sales Order</th>
                                        <th><a target="_blank" href="<?= base_url("penjualan/dataSalesPO/".$penagihan['sales_po_id']) ?>"><?php echo $this->crud_global->GetField('pmm_sales_po',array('id'=>$penagihan['sales_po_id']),'contract_number');?></a></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Sales Order</th>
                                        <th><?= date('d/m/Y', strtotime($penagihan["tanggal_kontrak"])) ?></th>
                                    </tr>
                                </table>
                                <br />
                                <table class="table table-striped table-bordered" width="100%">
                                    <tr>
                                        <th width="20%" align="left">Nomor Invoice</th>
                                        <th width="80%" align="left"><label class="label label-info" style="font-size:14px;"><?= $penagihan["nomor_invoice"]; ?></label></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Invoice</th>
                                        <th><?= date('d/m/Y', strtotime($penagihan['tanggal_invoice'])); ?></th>
                                    </tr>
                                    <tr>
                                        <th>Syarat Pembayaran</th>
                                        <th><?= $penagihan['syarat_pembayaran']; ?> Hari</th>
                                    </tr>
                                    <tr>
                                        <th>Memo</th>
                                        <th><?= $penagihan["memo"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>Lampiran</th>
                                        <th>
                                            <?php
                                            if (!empty($dataLampiran)) {
                                                foreach ($dataLampiran as $key => $lampiran) {
                                            ?>
                                                    <div><a href="<?= base_url() . 'uploads/penagihan/' . $lampiran['lampiran']; ?>" target="_blank"><?= $lampiran['lampiran']; ?></a></div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Dibuat Oleh</th>
                                        <th><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$penagihan['created_by']),'admin_name');?></th>
                                    </tr>
                                    <tr>
                                        <th>Dibuat Tanggal</th>
                                        <th><?= date('d/m/Y H:i:s',strtotime($penagihan['created_on']));?></th>
                                    </tr>
                                </table>
                                <br /><br />
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
                                                <th class="text-right">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sub_total = 0;
                                            $tax_pph = 0;
                                            $tax_ppn = 0;
                                            $tax_ppn11 = 0;
                                            $tax_0 = false;
                                            $total = 0;
                                            ?>
                                            <?php foreach ($cekHarga as $key => $row) { ?>
                                                <?php
                                                $product = $this->crud_global->GetField('produk', array('id' => $row['product_id']), 'nama_produk');
												$taxs = $this->crud_global->GetField('pmm_taxs', array('id' => $row['tax_id']), 'Tax_name');
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $key + 1 ?>.</td>
                                                    <td class="text-left"><?= $product; ?></td>
                                                    <td class="text-right"><?= $row['qty']; ?></td>
                                                    <td class="text-center"><?= $row['measure']; ?></td>
                                                    <td class="text-right"><?= number_format($row['price'],0,',','.'); ?></td>
                                                    <td class="text-center"><?= $taxs; ?></td>
                                                    <td class="text-right"><?= number_format($row['total'],0,',','.'); ?></td>
                                                </tr>
                                                <?php
													$sub_total += ($row['price'] * $row['qty']);
													$tax_id = $row['tax_id'];
													
													if($row['tax_id'] == 4){
														$tax_0 = true;
													}
													if($row['tax_id'] == 3){
														$tax_ppn = $sub_total * 10 / 100;
													}
													if($row['tax_id'] == 5){
														$tax_pph = $sub_total * 2 / 100;
													}
                                                    if($row['tax_id'] == 6){
														$tax_ppn11 = $sub_total * 11 / 100;
													}
													
													$total = $sub_total + $tax_ppn - $tax_pph + $tax_ppn11;
                                                }
												?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <label></label>
                                            
                                        </div>
                                        <div class="row">
                                            <label></label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-sm-8 form-horizontal">
                                        <div class="row">
                                            <label class="col-sm-7 control-label">SUB TOTAL</label>
                                                <div class="col-sm-5 text-right">
                                                    <label><?= number_format($sub_total,0,',','.'); ?></label>													
                                                        <input type="hidden" name="total_1" value="<?= $sub_total;?>">
                                                </div>
                                        </div>
                                        <?php
                                            if($tax_ppn > 0){
                                                ?>
                                                <div class="row">                                                   
                                                    <label class="col-sm-7 control-label">PAJAK (PPN 10%)</label>
                                                        <div class="col-sm-5 text-right">
                                                            <label><?= number_format($tax_ppn,0,',','.'); ?></label>
                                                                <input type="hidden" id="tax_1" name="tax_1" value="<?= $tax_ppn;?>">
                                                        </div>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                        <?php
                                            if($tax_0 > 0){
                                                ?>
                                                <div class="row">                                                   
                                                    <label class="col-sm-7 control-label">PAJAK (PPN 0%)</label>
                                                        <div class="col-sm-5 text-right">
                                                            <label><?= number_format(0,0,',','.'); ?></label>
                                                                <input type="hidden" id="tax_1" name="tax_1" value="<?= $tax_0;?>">
                                                        </div>
                                                </div>                                                  
                                                <?php
                                            }
                                        ?>
                                        <?php
                                            if($tax_pph > 0){
                                                ?>
                                                <div class="row">                                                   
                                                    <label class="col-sm-7 control-label">PAJAK (PPh 23)</label>
                                                        <div class="col-sm-5 text-right">															
                                                            <label><?= number_format($tax_pph,0,',','.'); ?></label>
                                                                <input type="hidden" id="tax_1" name="tax_1" value="<?= $tax_pph;?>">
                                                        </div>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                        <?php
                                            if($tax_ppn11 > 0){
                                                ?>
                                                <div class="row">                                                   
                                                    <label class="col-sm-7 control-label">PAJAK (PPN 11%)</label>
                                                        <div class="col-sm-5 text-right">															
                                                            <label><?= number_format($tax_ppn11,0,',','.'); ?></label>
                                                                <input type="hidden" id="tax_1" name="tax_1" value="<?= $tax_ppn11;?>">
                                                        </div>
                                                </div>
                                            
                                        <?php
                                        }
                                        $total = $sub_total + $tax_ppn - $tax_pph + $tax_ppn11;
                                        $sisa_tagihan = $this->pmm_finance->getTotalPembayaranPenagihanPenjualan($penagihan['id']);
                                        ?>

                                        <div class="row">
                                            <label class="col-sm-7 control-label">TOTAL</label>
                                            <div class="col-sm-5 text-right">
                                                <label id="total"><?= number_format($total,0,',','.'); ?></label>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <label class="col-sm-7 control-label">PEMBAYARAN</label>
                                            <div class="col-sm-5 text-right">
                                                <label id="sub-total"><?= number_format($penagihan['pembayaran'],0,',','.'); ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-7 control-label">SISA TAGIHAN</label>
                                            <div class="col-sm-5 text-right">
                                                <label id="total"><?= number_format($total - $penagihan['pembayaran']); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br /><br />
                                <div class="text-center">
                                    <div class="col-sm-12 text-center">
                                        <?php if ($penagihan["status"] === "DRAFT") : ?>
                                            <?php
                                            if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4){
                                            ?>
                                                <a href="<?= site_url('penjualan/approvePenagihan/' . $penagihan['id']); ?>" class="btn btn-success" style="width:150px; font-weight:bold; border-radius:10px;"> SETUJUI</a>
                                                <a href="<?= site_url('penjualan/rejectPenagihan/' . $penagihan['id']); ?>" class="btn btn-danger" style="width:150px; font-weight:bold; border-radius:10px;"> TOLAK</a>
                                            <?php
                                            }
                                            ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <?php if ($penagihan["status"] === "OPEN") : ?>
                                        <a href="<?= base_url("penjualan/cetak_penagihan_penjualan/".$penagihan["id"]) ?>" target="_blank" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;">PRINT</a>
                                            <?php
                                            if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6 || $this->session->userdata('admin_group_id') == 9){
                                            ?>
                                            <a class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;" href="<?= base_url("penjualan/halaman_pembayaran/" . $penagihan["id"]) ?>"> TERIMA PEMBAYARAN</a>
                                            <a class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;" href="<?= site_url('penjualan/closed_pembayaran_penagihan/' . $penagihan['id']); ?>"> PEMBAYARAN LUNAS</a>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4){
                                            ?>
                                            <a class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;" href="<?= base_url('penjualan/sunting_tagihan/' . $penagihan["id"]) ?>"> EDIT</a>
                                            <a class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('penjualan/delete_penagihan_penjualan/' . $penagihan['id']); ?>')"> HAPUS</a>	
                                            <?php
                                            }
                                            ?>
                                            <?php endif;
                                        ?>
                                </div>
                                <div class="text-center">
                                    <?php if ($penagihan["status"] === "CLOSED") : ?>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6 || $this->session->userdata('admin_group_id') == 9){
                                        ?>
                                        <a href="<?= site_url('penjualan/open_penagihan/' . $penagihan['id']); ?>" class="btn btn-success" style="width:20%; font-weight:bold; border-radius:10px;"><i class="fa fa-folder-open-o"></i> Pembayaran Belum Lunas</a>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6 || $this->session->userdata('admin_group_id') == 9){
                                        ?>
                                        <a class="btn btn-danger" style="width:150px; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('penjualan/delete_penagihan_penjualan/' . $penagihan['id']); ?>')"><i class="fa fa-close"></i> Hapus</a>
                                        <?php
                                        }
                                        ?>
                                        <?php endif; ?>
                                </div>
                                <div class="text-center">
                                    <?php if ($penagihan["status"] === "REJECT") : ?>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6 || $this->session->userdata('admin_group_id') == 9){
                                        ?>
                                        <a class="btn btn-danger" style="width:150px; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('penjualan/delete_penagihan_penjualan/' . $penagihan['id']); ?>')"><i class="fa fa-close"></i> Hapus</a>	
                                        <?php
                                        }
                                        ?>
                                        <?php endif; ?>
                                </div>
                                <br /><br /><br />
                                <div class="text-center">
                                    <a href="<?php echo site_url('admin/penjualan#settings'); ?>" class="btn btn-info" style="width:150px; font-weight:bold; border-radius:10px;"> KEMBALI</a>
                                </div>
                                <br />
                                <br />
                            </div>
                            <div class="container-fluid">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#menu1" aria-controls="menu2" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">DAFTAR SURAT JALAN</a></li>
                                    <li role="presentation"><a href="#menu2" aria-controls="menu2" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">DAFTAR PENERIMAAN</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="menu1">
                                        <br>
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $surat_jalan = explode(',', $penagihan['surat_jalan']);
                                                    $this->db->select('pp.*,p.nama_produk as product, c.nama as client_name, pp.measure as measure');
                                                    $this->db->join('produk p', 'pp.product_id = p.id', 'left');
                                                    $this->db->join('penerima c', 'pp.client_id = c.id', 'left');
                                                    $this->db->where_in('pp.id', $surat_jalan);
                                                    $table_surat_jalan = $this->db->get('pmm_productions pp')->result_array();
                                                    if (!empty($table_surat_jalan)) {
                                                        foreach ($table_surat_jalan as $sj) {
                                                    ?>
                                                            <tr>
                                                                <td><?= date('d/m/Y', strtotime($sj['date_production'])); ?></td>
                                                                <td><?= $sj['no_production']; ?></td>
                                                                <td><?= $sj['product']; ?></td>
                                                                <td><?= $sj['nopol_truck']; ?></td>
                                                                <td><?= $sj['driver']; ?></td>
                                                                <td style="text-align: right !important;"><?= number_format($sj['volume'],2,',','.'); ?></td>
                                                                <td><?= $sj['measure']; ?></td>
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
                                                        <th>Setor Ke</th>
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
    </script>

    <script type="text/javascript">
        $('.form-select2').select2();

        $('input.numberformat').number(true, 2, ',', '.');
        $('.dtpicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY'
            }
        });
        $('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY'));
        });

        var table = $('#table-pembayaran').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('penjualan/table_pembayaran/' . $penagihan["id"]); ?>',
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
                            data = '<a href="<?php echo base_url() . 'penjualan/view_pembayaran/' ?>' + row.id + '">' + data + '</a>';
                        }

                        return data;
                    }
                },
                {
                    "data": "setor_ke"
                },
                {
                    "data": "total"
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

        function ApprovePayment(href) {
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
                        window.location.href = href;
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