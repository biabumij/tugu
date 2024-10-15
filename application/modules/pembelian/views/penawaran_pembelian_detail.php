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
                                <h3><b>DETAIL PENAWARAN PEMBELIAN <?php echo $this->pmm_model->GetStatus2($row['status']);?></b></h3>
                                <div class="text-left">
                                    <a href="<?php echo site_url('admin/pembelian');?>">
                                    <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                </div>
                            </div>    
                            <div class="panel-content">
                                <table class="table table-striped table-bordered" width="100%">
                                    <tr>
                                        <th width="15%" align="left">Rekanan</th>
                                        <th width="85%" align="left"><label class="label label-default" style="font-size:14px;"><?php echo $this->crud_global->GetField('penerima',array('id'=>$row['supplier_id']),'nama');?></label></th>
                                    </tr>
                                    <tr>
                                        <th>Alamat Rekanan</th>
                                        <th style="font-weight:normal;"><textarea class="form-control" name="alamat_supplier" id="alamat_supplier" rows="5" readonly=""><?= $row['client_address'];?></textarea></th>
                                    </tr>
                                </table>
                                <table class="table table-striped table-bordered" width="100%">
                                    <tr>
                                        <th width="15%" align="left">Nomor Penawaran</th>
                                        <th width="85%" align="left"><label class="label label-success" style="font-size:14px;font-weight:bold;"><?= $row['nomor_penawaran'];?></label></th>
                                    </tr>
                                    <tr>
                                        <th>Jenis Pembelian</th>
                                        <th style="font-weight:normal;"><?= $row['jenis_pembelian'];?></th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Penawaran</th>
                                        <th style="font-weight:normal;"><?= date('d/m/Y',strtotime($row['tanggal_penawaran']));?></th>
                                    </tr>
                                    <tr>
                                        <th>Berlaku Hingga</th>
                                        <th style="font-weight:normal;"><?= date('d/m/Y',strtotime($row['berlaku_hingga']));?></th>
                                    </tr>
                                    <tr>
                                        <th>Syarat Pembayaran</th>
                                        <th style="font-weight:normal;"><?= $row['syarat_pembayaran'];?> Hari</th>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran</th>
                                        <th style="font-weight:normal;"><?= $row['metode_pembayaran'];?></th>
                                    </tr>
                                    <tr>
                                        <th>Memo</th>
                                        <th style="font-weight:normal;"><?= $row["memo"]; ?></th>
                                    </tr>
                                    <tr>
                                        <th>Lampiran</th>
                                        <th style="font-weight:normal;"><?php
                                                $dataLampiran = $this->db->get_where('pmm_lampiran_penawaran_pembelian',array('penawaran_pembelian_id'=>$row['id']))->result_array();
                                                if(!empty($dataLampiran)){
                                                    foreach ($dataLampiran as $key => $lampiran) {
                                                        ?>
                                                        <div><a href="<?= base_url().'uploads/penawaran_pembelian/'.$lampiran['lampiran'];?>" target="_blank"><?= $lampiran['lampiran'];?></a></div>
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
                                <table id="table-product" class="table table-bordered table-striped table-condensed text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5%">No</th>
                                            <th class="text-center" width="25%">Produk</th>
                                            <th class="text-center" width="10%">Volume</th>
                                            <th class="text-center" width="10%">Satuan</th>
                                            <th class="text-center" width="10%">Harga Satuan</th>
                                            <th class="text-center" width="20%">Nilai</th>
                                            <th class="text-center" width="10%">Pajak</th>
                                            <th class="text-center" width="10%">Pajak (2)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $subtotal = 0;
                                    $tax_pph = 0;
                                    $tax_ppn = 0;
                                    $tax_0 = false;
                                    $tax_ppn11 = 0;
                                    $pajak_pph = 0;
                                    $pajak_ppn = 0;
                                    $pajak_0 = false;
                                    $pajak_ppn11 = 0;
                                    $total = 0;
									$details = $this->db->select('ppd.*, p.nama_produk')
                                    ->from('pmm_penawaran_pembelian pp')
                                    ->join('pmm_penawaran_pembelian_detail ppd','pp.id = ppd.penawaran_pembelian_id','left')
                                    ->join('produk p','ppd.material_id = p.id','left')
                                    ->where('pp.id',$row['id'])
                                    ->order_by('p.nama_produk','asc')
                                    ->get()->result_array();
									?>
									<?php foreach($details as $key => $dt) { ?>
									<?php 
										$produk = $this->crud_global->GetField('produk',array('id'=>$dt['material_id']),'nama_produk');
										$measure = $this->crud_global->GetField('pmm_measures',array('id'=>$dt['measure']),'measure_name');
										$tax = $this->crud_global->GetField('pmm_taxs',array('id'=>$dt['tax_id']),'tax_name');
                                        $pajak = $this->crud_global->GetField('pmm_taxs',array('id'=>$dt['pajak_id']),'tax_name');
									?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1;?></td>
                                            <td class="text-left"><?= $produk ?></td>
                                            <td class="text-center"><?= $dt["qty"]; ?></td>
                                            <td class="text-center"><?= $measure; ?></td>
                                            <td class="text-right"><?= number_format($dt['price'],0,',','.'); ?></td>
                                            <td class="text-right"><?= number_format($dt['total'],0,',','.'); ?></td>
											<td class="text-center"><?= $tax ?></td>
                                            <td class="text-center"><?= $pajak ?></td>
                                        </tr>

                                        <?php
                                        $subtotal += $dt['total'];
                                        if($dt['tax_id'] == 4){
                                            $tax_0 = true;
                                        }
                                        if($dt['tax_id'] == 3){
                                            $tax_ppn += $dt['tax'];
                                        }
                                        if($dt['tax_id'] == 5){
                                            $tax_pph += $dt['tax'];
                                        }
                                        if($dt['tax_id'] == 6){
                                            $tax_ppn11 += $dt['tax'];
                                        }
                                        if($dt['pajak_id'] == 4){
                                            $pajak_0 = true;
                                        }
                                        if($dt['pajak_id'] == 3){
                                            $pajak_ppn += $dt['tax'];
                                        }
                                        if($dt['pajak_id'] == 5){
                                            $pajak_pph += $dt['tax'];
                                        }
                                        if($dt['pajak_id'] == 6){
                                            $pajak_ppn11 += $dt['tax'];
                                        }
                                        }
                                        ?>
                                </tbody>
								</table>    
                                    
                                <div class="text-center">
                                    <br /><br /><br />
                                    <?php if($row["status"] === "DRAFT") : ?>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                        ?>
                                            <a href="<?= site_url('pembelian/approve_penawaran_pembelian/' . $row['id']); ?>" class="btn btn-success" style="width:15%; font-weight:bold; border-radius:10px;"> SETUJUI</a>
                                            <a href="<?= site_url('pembelian/reject_penawaran_pembelian/' . $row['id']); ?>" class="btn btn-danger" style="width:15%; font-weight:bold; border-radius:10px;"> TOLAK</a>
                                        <?php
                                        }
                                        ?>
                                    <?php endif; ?>

                                    <?php if($row["status"] === "OPEN") : ?>
                                    <?php
                                        if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                        ?>
                                            <a href="<?= site_url('pembelian/closed_penawaran_pembelian/' . $row['id']); ?>" class="btn btn-default" style="width:15%; font-weight:bold; border-radius:10px;"> CLOSED</a>
                                            <a href="<?= site_url('pembelian/reject_penawaran_pembelian/' . $row['id']); ?>" class="btn btn-default" style="width:15%; font-weight:bold; border-radius:10px;"> REJECT</a>
                                        <?php
                                        }
                                        ?>
                                    <?php endif; ?>

                                    <?php if($row["status"] === "CLOSED") : ?>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                        ?>
                                            <a href="<?= site_url('pembelian/open_penawaran_pembelian/' . $row['id']); ?>" class="btn btn-default" style="width:15%; font-weight:bold; border-radius:10px;"> OPEN</a>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1){
                                        ?>
                                            <a href="<?= site_url('pembelian/hapus_penawaran_pembelian/' . $row['id']); ?>" class="btn btn-default" style="width:15%; font-weight:bold; border-radius:10px;"> HAPUS</a>
                                        <?php
                                        }
                                        ?>
                                    <?php endif; ?>

                                    <?php if($row["status"] === "REJECT") : ?>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1){
                                        ?>
                                            <a href="<?= site_url('pembelian/hapus_penawaran_pembelian/' . $row['id']); ?>" class="btn btn-default" style="width:15%; font-weight:bold; border-radius:10px;"> HAPUS</a>
                                        <?php
                                        }
                                        ?>
                                    <?php endif; ?>

                                    <br /><br />
                                    <a href="<?php echo site_url('admin/pembelian');?>" class="btn btn-info" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;"> KEMBALI</a>
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