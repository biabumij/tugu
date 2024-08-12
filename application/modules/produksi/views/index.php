<!doctype html>
<html lang="en" class="fixed">
    <head>
        <?php echo $this->Templates->Header(); ?>
        <style type="text/css">
            body {
                font-family: helvetica;
            }
            
            .tab-pane {
                padding-top: 20px;
            }

            .select2-container--default .select2-results__option[aria-disabled=true] {
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="wrap">
            <?php echo $this->Templates->PageHeader(); ?>
            <div class="page-body">
                <div class="content">
                    <div class="row animated fadeInUp">
                        <div class="col-sm-12 col-lg-12">
                            <div class="panel">
                                <div class="panel-header">
                                    <h3><b style="text-transform:uppercase;"><?php echo $row[0]->menu_name; ?></b></h3>
                                    <div class="text-left">
                                        <a href="<?php echo site_url('admin');?>">
                                        <button style="color:white; background-color:#5bc0de; border:1px solid black; border-radius:10px; line-height:30px;"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                    </div>
                                </div>
                                <div class="panel-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#material_on_site" aria-controls="material_on_site" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">STOCK OPNAME</a></li>
                                        <li role="presentation"><a href="#pemakaian" aria-controls="pemakaian" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">PEMAKAIAN MATERIAL</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="material_on_site">
                                            <?php include_once "material_on_site.php"; ?>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="pemakaian">
                                            <?php include_once "pemakaian.php"; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $this->Templates->Footer(); ?>
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/jquery.number.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/bootbox.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/daterangepicker.css">
        <script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>
        <?php include_once("script_material_on_site.php"); ?>
        <?php include_once("script_pemakaian.php"); ?>

    </body>
</html>