<!doctype html>
<html lang="en" class="fixed">
    <head>
        <?php echo $this->Templates->Header(); ?>
        <style type="text/css">
            body {
                font-family: helvetica;
            }
            
            .mytable thead th {
            background-color:	#e69500;
            color: #ffffff;
            text-align: center;
            vertical-align: middle;
            padding: 5px;
            }
            
            .mytable tbody td {
            padding: 5px;
            }
            
            .mytable tfoot td {
            background-color:	#e69500;
            color: #FFFFFF;
            padding: 5px;
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
                                        <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                    </div>
                                </div>
                                <div class="panel-content">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#material_on_site" aria-controls="material_on_site" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">STOCK OPNAME</a></li>
                                        <?php
                                        if(in_array($this->session->userdata('admin_group_id'), array(1))){
                                        ?>
                                        <li role="presentation"><a href="#pemakaian" aria-controls="pemakaian" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">PEMAKAIAN MATERIAL</a></li>
                                        <li role="presentation"><a href="#rakor" aria-controls="rakor" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">KUNCI DATA RAKOR</a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                    <div class="tab-content">
                                        <br />
                                        <div role="tabpanel" class="tab-pane active" id="material_on_site">
                                            <?php include_once "material_on_site.php"; ?>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="pemakaian">
                                            <?php include_once "pemakaian.php"; ?>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="rakor">
                                            <?php include_once "rakor.php"; ?>
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
        <?php include_once("script_rakor.php"); ?>
        <script>
            <?php
            $kunci_rakor = $this->db->select('date')->order_by('date','desc')->limit(1)->get_where('kunci_rakor')->row_array();
            $last_opname = date('d-m-Y', strtotime('+1 days', strtotime($kunci_rakor['date'])));
            ?>
            $('.dtpicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns : false,
                locale: {
                    format: 'DD-MM-YYYY'
                },
                minDate: '<?php echo $last_opname;?>',
                //maxDate: moment().add(+0, 'd').toDate(),
                //minDate: moment().startOf('month').toDate(),
                maxDate: moment().endOf('month').toDate(),
            });
        </script>
    </body>
</html>