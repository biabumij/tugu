<!doctype html>
<html lang="en" class="fixed">
    
<?php include 'lib.php'; ?>

<head>
    <?php echo $this->Templates->Header();?>
    
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
                                    <h3><b>DETAIL PENAWARAN PENJUALAN <?php echo $this->pmm_model->GetStatus2($penawaran['status']);?></b></h3>
                                    <div class="text-left">
                                        <a href="<?php echo site_url('admin/penjualan');?>">
                                        <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-content">
                                <table class="table table-striped table-bordered" width="100%">
                                    <tr>
                                        <th width="15%" align="left">Rekanan</th>
                                        <th width="85%" align="left"><label class="label label-default" style="font-size:14px;"><?= $penawaran["nama"] ?></label></th>
                                    </tr>
                                    <tr>
                                        <th>Alamat Rekanan</th>
                                        <th><textarea class="form-control" rows="5" readonly=""><?= $penawaran["client_address"] ?></textarea></th>
                                    </tr>
                                </table>
                                <table class="table table-striped table-bordered" width="100%">
                                    <tr>
                                        <th width="15%" align="left">Nomor Penawaran</th>
                                        <th width="85%" align="left"><label class="label label-success" style="font-size:14px;"><?= $penawaran["nomor"] ?></label></th>
                                    </tr>
                                    <tr>
                                        <th>Perihal</th>
                                        <th><?= $penawaran["perihal"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Penawaran</th>
                                        <th><?= date('d/m/Y',strtotime($penawaran["tanggal"]));?></th>
                                    </tr>
                                    <tr>
                                        <th>Syarat Pembayaran</th>
                                        <th><?= $penawaran['syarat_pembayaran'];?> Hari</th>
                                    </tr>
                                    <tr>
                                        <th>Persyaratan Harga</th>
                                        <th><?= $penawaran["persyaratan_harga"];?></th>
                                    </tr>
                                    <tr>
                                        <th>Lampiran</th>
                                        <th>
                                            <?php foreach($lampiran as $l) : ?>
                                            <a href="<?= base_url("uploads/penawaran_penjualan/".$l["lampiran"]) ?>" target="_blank">Lihat bukti  <?= $l["lampiran"] ?> <br></a></td>
                                            <?php endforeach; ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Dibuat Oleh</th>
                                        <th><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$penawaran['created_by']),'admin_name');?></th>
                                    </tr>
                                    <tr>
                                        <th>Dibuat Tanggal</th>
                                        <th><?= date('d/m/Y H:i:s',strtotime($penawaran['created_on']));?></th>
                                    </tr>
                                </table>

                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5%">No</th>
                                            <th class="text-center" width="20%">Produk</th>
                                            <th class="text-center" width="15%">Volume</th>
                                            <th class="text-center" width="10%">Satuan</th>
                                            <th class="text-center" width="20%">Harga Satuan</th>
                                            <th class="text-center" width="20%">Nilai</th>
                                            <th class="text-center" width="10%">Pajak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subtotal = 0;
                                        $tax_pph = 0;
                                        $tax_ppn = 0;
                                        $tax_0 = false;
                                        $total = 0;

                                        ?>
                                        <?php foreach($details as $no => $d) : ?>
                                            <?php
                                            $tax = $this->crud_global->GetField('pmm_taxs',array('id'=>$d['tax_id']),'tax_name');
                                            $measure = $this->crud_global->GetField('pmm_measures',array('id'=>$d['measure']),'measure_name');
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $no + 1;?></td>
                                                <td class="text-left"><?= $d["nama_produk"] ?></td>
                                                <td class="text-center"><?= $d["qty"]; ?></td>
                                                <td class="text-center"><?= $measure; ?></td>
                                                <td class="text-right"><?= number_format($d['price'],0,',','.'); ?></td>
                                                <td class="text-right"><?= number_format($d['total'],0,',','.'); ?></td>
                                                <td class="text-center"><?= $tax; ?></td>
                                            </tr>
                                            <?php
                                            $subtotal += $d['total'];
                                            if($d['tax_id'] == 4){
                                                $tax_0 = true;
                                            }
                                            if($d['tax_id'] == 3){
                                                $tax_ppn += $d['tax'];
                                            }
                                            if($d['tax_id'] == 5){
                                                $tax_pph += $d['tax'];
                                            }
                                            ?>
                                            <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>

                                <div class="text-center">
                                    <br /><br /><br />
                                    <?php if($penawaran["status"] === "DRAFT") : ?>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                            ?>
                                                <a href="<?= site_url('penjualan/approvalPenawaran/' . $penawaran['id']); ?>" class="btn btn-success" style="width:100px; font-weight:bold; border-radius:10px;"> SETUJUI</a>
                                                <a href="<?= site_url('penjualan/rejectedPenawaran/' . $penawaran['id']); ?>" class="btn btn-danger" style="width:100px; font-weight:bold; border-radius:10px;"> TOLAK</a>
                                            <?php
                                        }
                                        ?>
                                    <?php endif; ?>

                                    <?php if($penawaran["status"] === "OPEN") : ?>
                                        <a href="<?= base_url("penjualan/cetak_penawaran_penjualan/".$penawaran["id"]) ?>" target="_blank" class="btn btn-default" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;"> PRINT</a>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                            ?>
                                            <a href="<?= base_url("penjualan/closed_penawaran_penjualan/".$penawaran["id"]) ?>" class="btn btn-default" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;"> CLOSED</a>			
                                            <?php
                                        }
                                        ?>
                                        <form class="form-check" action="<?= base_url("penjualan/rejectedPenawaran/".$penawaran["id"]) ?>">
                                            <button type="submit" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> REJECT</button>        
                                        </form>
                                    <?php endif; ?>

                                    <?php if($penawaran["status"] === "CLOSED") : ?>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                        ?>
                                        <a href="<?= base_url("penjualan/open_penawaran_penjualan/".$penawaran["id"]) ?>" class="btn btn-default" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;"> OPEN</a>	
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1){
                                        ?>
                                        <a class="btn btn-default" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('penjualan/hapusPenawaranPenjualan/' . $penawaran['id']); ?>')"> HAPUS</a>	
                                        <?php
                                        }
                                        ?>
                                    <?php endif; ?>

                                    <?php if($penawaran["status"] === "REJECT") : ?>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1){
                                            ?>
                                            <a class="btn btn-danger" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('penjualan/hapusPenawaranPenjualan/' . $penawaran['id']); ?>')"> HAPUS</a>		
                                            <?php
                                        }
                                        ?>
                                    <?php endif; ?>

                                    <br /><br /><br />
                                    <a href="<?php echo site_url('admin/penjualan');?>" class="btn btn-info" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;"> KEMBALI</a>
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

        $('.form-check').click(function(e){
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
                callback: function (result) {
                    if(result){
                        currentForm.submit();
                    }

                }
            });

        });

        function DeleteData(href)
        {
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
                callback: function (result) {
                    if(result){
                        window.location.href = href;
                    }
                    
                }
            });
        }

    </script>

</body>
</html>