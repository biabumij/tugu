<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>

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
                                    <h3><b>EDIT PEMBAYARAN PEMBELIAN</b></h3>
                                </div>
                            </div>
                            <div class="panel-content">
                                <form method="POST" action="<?php echo site_url('pembelian/simpan_pembayaran_pembelian');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="id" value="<?= $bayar["id"] ?>">
                                    <input type="hidden" name="id_penagihan" value="<?= $bayar["penagihan_pembelian_id"] ?>">
                                    <div class="row">
                                        <div class="col-sm-2"><label>Pembayaran Melalui</label><span class="required" aria-required="true">*</span></div>
                                        <div class="col-sm-3">
                                        <select class="form-control" name="bayar_dari" required="">
                                                <option value="">Bayar Dari</option>
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
                                        <div class="col-sm-2"><label>Penerima</label><span class="required" aria-required="true">*</span></div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" value="<?= $bayar["supplier_name"] ?>" name="supplier_name" readonly=""/>
                                        </div>
                                        <div class="col-sm-2"><label>Nomor Transaksi</label><span class="required" aria-required="true">*</span></div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="nomor_transaksi" value="<?= $bayar['nomor_transaksi'] ?>"/>
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
                                            <input type="text" class="form-control" name="cek_nomor" value="<?= $bayar['cek_nomor'] ?>"/>
                                        </div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-sm-2"><label></label></div>
                                        <div class="col-sm-3">
                                            <label></label>
                                            
                                        </div>
                                        <div class="col-sm-2"><label>Tanggal Pembayaran</label><span class="required" aria-required="true">*</span></div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control dtpicker" name="tanggal_pembayaran" value="<?= date('d/m/Y',strtotime($bayar["tanggal_pembayaran"])) ?>"/>
                                        </div>
                                    </div>
                                    </br />
                                    <div class="row">
                                        <div class="col-sm-2"><label>Nomor Invoice</label><span class="required" aria-required="true">*</span></div>
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
                                                    <th>Pembayaran Saat Ini</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td style="text-align: right !important;"><input type="text" id="total_invoice" class="form-control numberformat text-center" value="<?= intval($total_invoice) ?>" readonly=""></td>
                                                    <td style="text-align: right !important;"><input type="text" name="pembayaran" id="pembayaran" class="form-control numberformat text-center" value="<?= intval($bayar['total']) ?>"></td>
                                                </tr>
                                            </tbody>
                                            <!--<tfoot style="font-size:15px;">
                                                <th colspan="4" style="text-align:right !important;">TOTAL</th>
                                                <th id="total-bayar" style="text-align:right !important;"></th>
                                            </tfoot>-->
                                        </table>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Memo</label>
                                                <input type="text" rows="3" class="form-control" name="memo" value="<?= $bayar['memo'] ?>" />
                                            </div>
                                            <div class="form-group">
                                                <label>Lampiran</label>
                                                <input type="file" class="form-control" name="files[]"  multiple="" />
                                            </div>
                                        </div>
                                    </div>
                                    <br /><br />
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <a href="<?= site_url('pembelian/penagihan_pembelian_detail/'.$pembayaran["id"]);?>" class="btn btn-danger" style="margin-bottom:0; font-weight:bold; border-radius:10px;"> BATAL</a>
                                            <button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;"> KIRIM</button>
                                        </div>
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
        
        $('.form-select2').select2();

        $('input.numberformat').number( true, 0,',','.' );
        $('.dtpicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns : true,
            locale: {
              format: 'DD-MM-YYYY'
            }
        });
		
        $('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
              $(this).val(picker.startDate.format('DD-MM-YYYY'));
        });

        //$('#pembayaran').keyup(function(){
            //console.log($(this).val());
            //$('#total-bayar').text($.number($(this).val(),0,',','.'));
        //});

        $('#form-po').submit(function(e){
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

    </script>


</body>
</html>
