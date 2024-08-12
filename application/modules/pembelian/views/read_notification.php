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
                                <h3>Verifikasi Pembelian</h3>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <table class="table table-bordered table-striped table-condensed">
                                            <?php
                                            foreach ($row as $x) {
                                            ?> 
                                            <tr>
                                                <th width = "50%"><a href="<?= site_url('pembelian/closed_verifikasi/' . $x['id']); ?>" class="btn btn-success" style="border-radius:10px; font-weight:bold;"><i class="fa fa-check"></i> Setujui - (<?= $x['nomor_invoice'];?>)</a></th>
                                                <th width = "50%"><a target="_blank" a href="<?= site_url('pembelian/print_verifikasi_penagihan_pembelian/?id='.$x['id']); ?>" class="btn btn-default" style="border-radius:10px; font-weight:bold;"><i class="fa fa-print"></i> Print</a></th>
                                            </tr>
                                            <tr>
                                                <th>Lampiran - Invoice</th>
                                                <th><a href="<?= site_url($x['invoice_file']); ?>"><?= $x['invoice_file']; ?></a></th>
                                            </tr>
                                            <tr>
                                                <th>Lampiran - Kwitansi</th>
                                                <th><a href="<?= site_url($x['kwitansi_file']); ?>"><?= $x['kwitansi_file']; ?></a></th>
                                            </tr>
                                            <tr>
                                                <th>Lampiran - Faktur Pajak</th>
                                                <th><a href="<?= site_url($x['faktur_file']); ?>"><?= $x['faktur_file']; ?></a></th>
                                            </tr>
                                            <tr>
                                                <th>Lampiran - Berita Acara Pembayaran (BAP)</th>
                                                <th><a href="<?= site_url($x['bap_file']); ?>"><?= $x['bap_file']; ?></a></th>
                                            </tr>
                                            <tr>
                                                <th>Lampiran - Berita Acara Serah Terima (BAST)</th>
                                                <th><a href="<?= site_url($x['bast_file']); ?>"><?= $x['bast_file']; ?></a></th>
                                            </tr>
                                            <tr>
                                                <th>Lampiran - Surat Jalan</th>
                                                <th><a href="<?= site_url($x['surat_jalan_file']); ?>"><?= $x['surat_jalan_file']; ?></a></th>
                                            </tr>
                                            <tr>
                                                <th>Lampiran - Copy Kontrak/ PO</th>
                                                <th><a href="<?= site_url($x['copy_po_file']); ?>"><?= $x['copy_po_file']; ?></a></th>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>


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
    
</body>
</html>
