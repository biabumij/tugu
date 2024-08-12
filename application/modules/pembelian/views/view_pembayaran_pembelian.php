<!doctype html>
<html lang="en" class="fixed">

<head>
    <?php echo $this->Templates->Header(); ?>

    <style type="text/css">
        body {
			font-family: helvetica;
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
                                    <h3>
                                        <b>DETAIL PENERIMAAN PEMBELIAN</b>
                                    </h3>
                                </div>
                            </div>
                            <br />
                            <br />
                            <div class="panel-content">
                                    <div class="row">
                                        <div class="col-sm-2"><label>Pembayaran Melalui</label></div>
                                        <div class="col-sm-3">
                                            <select disabled class="form-control" name="bayar_dari" readonly="">
                                                <option selected readonly value="">Bayar Dari</option>
                                                <?php
                                                if(!empty($setor_bank)){
                                                    foreach ($setor_bank as $key => $sb) {
                                                        ?>
                                                        <option value="<?= $sb['id']; ?>" <?= ($sb['id'] == $bayar['bayar_dari']) ? 'selected' : '' ?>><?= $sb['coa']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>    
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-sm-2"><label>Penerima</label></div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" value="<?= $bayar["supplier_name"] ?>" name="supplier_name" readonly=""/>
                                        </div>
                                        <div class="col-sm-2"><label>Nomor Transaksi</label></div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="nomor_transaksi" value="<?= $bayar['nomor_transaksi'] ?>" readonly=""/>
                                        </div>
                                        
                                    </div>
                                    <br />
                                    <div class="row">
                                     <div class="col-sm-2"><label></label></div>
                                        <div class="col-sm-3">
                                            <label></label>
                                            
                                        </div>
                                        <div class="col-sm-2"><label>Cek Nomor</label></div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="cek_nomor" value="<?= $bayar['cek_nomor'] ?>" readonly=""/>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-sm-2"><label></label></div>
                                        <div class="col-sm-3">
                                            <label></label>
                                            
                                        </div>
                                        <div class="col-sm-2"><label>Tanggal Pembayaran</label></div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control dtpicker" name="tanggal_pembayaran" value="<?= date('d/m/Y',strtotime($bayar["tanggal_pembayaran"])) ?>" readonly=""/>
                                        </div>
                                    </div>
                                    </br />
                                    <div class="row">
                                        <div class="col-sm-2"><label>Pembayaran</label></div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" value="<?= $pembayaran["nomor_invoice"] ?>" readonly=""/>
                                        </div>
                                    </div>
                                    </br />
                                    <div class="row">
                                        <div class="col-sm-2"><label></label></div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" value="<?= date('d/m/Y',strtotime($pembayaran["tanggal_invoice"])) ?>" readonly=""/>
                                        </div>
                                    </div>
                                    <br />
                                    <?php 
                                    $total_invoice = $dpp['total'] + $tax['total'];
                                    $sisa_tagihan = ($dpp['total'] + $tax['total']) - $total_bayar_all['total'] - $pembayaran['uang-muka'];
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-condensed text-center">
                                            <thead>
                                                <tr>
                                                    <th>Nilai Invoice</th>
                                                    <th>Pembayaran s/d. lalu</th>
                                                    <th>Pembayaran Saat Ini</th>
                                                    <th>Total Pembayaran</th>
                                                    <th>Sisa Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-right"><?= number_format($total_invoice,0,',','.'); ?></td>
                                                    <td class="text-center"><?= number_format($total_bayar_all['total'] - $bayar['total'],0,',','.'); ?></td>
                                                    <td class="text-right"><?= number_format($total_bayar['total'],0,',','.'); ?></td>
                                                    <td class="text-right"><?= number_format($total_bayar_all['total'],0,',','.'); ?></td>
                                                    <td class="text-right"><?= number_format($sisa_tagihan,0,',','.'); ?></td>
                                                </tr>
                                            </tbody>
                                            <tfoot style="font-size:15px;">
                                                
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Memo</label>
                                                <input type="text" class="form-control" readonly value="<?= $bayar['memo'] ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label>Lampiran</label>
                                                <?php
                                                if (!empty($dataLampiran)) {
                                                    foreach ($dataLampiran as $key => $lampiran) {
                                                ?>
                                                        <div><a href="<?= base_url() . 'uploads/pembayaran_penagihan_pembelian/' . $lampiran['lampiran']; ?>" target="_blank"><?= $lampiran['lampiran']; ?></a></div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <br /><br />
                                    <div class="text-center">
                                    <a href="<?= base_url('pembelian/penagihan_pembelian_detail/' . $bayar["penagihan_pembelian_id"]) ?>" class="btn btn-info" style="width:150px; font-weight:bold; border-radius:10px;"> KEMBALI</a>
                                    <a href="<?= base_url('pembelian/cetak_pembayaran_penagihan_pembelian/' . $bayar["id"]) ?>" target="_blank" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> PRINT</a>
                                    
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6){
                                    ?>
                                    <td width="10%"><a href="<?= base_url('pembelian/sunting_pembayaran_pembelian/' . $bayar["id"]) ?>" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> EDIT</a></td>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6){
                                    ?>
                                    <button type="button" id="tombol_hapus" class="btn btn-default"style="width:150px; font-weight:bold; border-radius:10px;"> HAPUS</button>
                                    <?php
                                    }
                                    ?>  
                                    </div>
                                </form>
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

    <script type="text/javascript">
    $('#tombol_hapus').click(function() {
            bootbox.confirm({
                message: "Apakah anda yakin untuk menghapus data ini?",
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
                        $.post('<?= base_url() . 'pembelian/hapus_pembayaran_pembelian/' . $bayar['id'] ?>', {}, function($response) {
                            top.location.href = '<?= base_url() . 'pembelian/penagihan_pembelian_detail/' . $bayar['penagihan_pembelian_id'] ?>';
                        });
                    }

                }
            });
        });
    </script>
</body>

</html>