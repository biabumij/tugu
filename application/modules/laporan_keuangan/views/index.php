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
                                <div class="panel-content">
                                    <div class="panel-header">
                                        <h3 class="section-subtitle" style="font-weight:bold; text-transform:uppercase;"><?php echo $row[0]->menu_name; ?></h3>
                                        <div class="text-left">
                                            <a href="<?php echo site_url('admin');?>">
                                            <button style="color:white; background-color:#5bc0de; border:1px solid black; border-radius:10px; line-height:30px;"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="laba_rugi">
                                            <br />
                                            <div class="row">
                                                <div width="100%">
                                                    <?php
                                                    if(in_array($this->session->userdata('admin_group_id'), array(1,2,3,4,7,8))){
                                                    ?>                             
                                                    <div class="col-sm-5">
                                                        <p><h5><b>Laporan Laba Rugi</b></h5></p>
                                                        <a href="#laporan-laba-rugi" aria-controls="laporan-laba-rugi" role="tab" data-toggle="tab" class="btn btn-primary" style="border-radius:10px; font-weight:bold;">Lihat Laporan</a>										
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    if(in_array($this->session->userdata('admin_group_id'), array(1,2,3,4,6,7,8))){
                                                    ?>
                                                    <div class="col-sm-5">
                                                        <p><h5><b>Neraca</b></h5></p>
                                                        <a href="#neraca" aria-controls="neraca" role="tab" data-toggle="tab" class="btn btn-primary" style="border-radius:10px; font-weight:bold;">Lihat Laporan</a>										
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <p><h5><b>Buku Besar</b></h5></p>
                                                        <a href="#buku_besar" aria-controls="buku_besar" role="tab" data-toggle="tab" class="btn btn-primary" style="border-radius:10px; font-weight:bold;">Lihat Laporan</a>										
                                                    </div>
                                                    <!--<div class="col-sm-5">
                                                        <p><h5><b>Cash Flow</b></h5></p>
                                                        <a href="#cash_flow" aria-controls="cash_flow" role="tab" data-toggle="tab" class="btn btn-primary" style="border-radius:10px; font-weight:bold;">Lihat Laporan</a>										
                                                    </div>-->
                                                    <?php
                                                    }
                                                    ?>	
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Laporan Laba Rugi -->
                                        <div role="tabpanel" class="tab-pane" id="laporan-laba-rugi">
                                            <div class="col-sm-15">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title"><b>Laporan Laba Rugi</b></h3>
                                                        <a href="laporan_keuangan">Kembali</a>
                                                    </div>
                                                    <div style="margin: 20px">
                                                        <div class="row">
                                                            <form action="<?php echo site_url('laporan/cetak_laporan_laba_rugi');?>" target="_blank">
                                                                <div class="col-sm-3">
                                                                    <input type="text" id="filter_date_laba_rugi" name="filter_date" class="form-control dtpicker"  autocomplete="off" placeholder="Filter By Date">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;">PRINT</button>
                                                                </div>
                                                            </form>	
                                                        </div>
                                                        <br />
                                                        <div id="wait-laba-rugi" style=" text-align: center; align-content: center; display: none;">	
                                                            <div>Mohon Tunggu</div>
                                                            <div class="fa-3x">
                                                            <i class="fa fa-spinner fa-spin"></i>
                                                            </div>
                                                        </div>				
                                                        <div class="table-responsive" id="laba-rugi">													
                                                        
                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Neraca -->
                                        <div role="tabpanel" class="tab-pane" id="neraca">
                                            <div class="col-sm-15">
                                            <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title"><b>Neraca</b></h3>
                                                        <a href="laporan_keuangan">Kembali</a>
                                                    </div>
                                                    <div style="margin: 20px">
                                                        <div class="row">
                                                            <form action="<?php echo site_url('laporan/neraca_print');?>" target="_blank">
                                                                <?php
                                                                $date_now = date('Y-m-d');
                                                                $date1 = date('2024-01-01');
                                                                $date2 = date('Y-m-d', strtotime($date_now));
                                                                $filter_date = date('d-m-Y',strtotime($date1)).' - '.date('d-m-Y',strtotime($date2));
                                                                ?>
                                                                <div class="col-sm-3">
                                                                    <input type="text" id="filter_date_neraca" name="filter_date" value="<?php echo $filter_date;?>" class="form-control dtpicker"  autocomplete="off" placeholder="Filter By Date">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;"><i class="fa fa-print"></i>  Print</button>
                                                                </div>
                                                            </form>
                                                            
                                                        </div>
                                                        <br />
                                                        <div id="wait-neraca" style=" text-align: center; align-content: center; display: none;">	
                                                            <div>Mohon Tunggu</div>
                                                            <div class="fa-3x">
                                                            <i class="fa fa-spinner fa-spin"></i>
                                                            </div>
                                                        </div>				
                                                        <div class="table-responsive" id="table-neraca">													
                                                        
                        
                                                        </div>
                                                    </div>
                                            </div>
                                            
                                            </div>
                                        </div>

                                        <!-- Buku Besar -->
                                        <div role="tabpanel" class="tab-pane" id="buku_besar">
                                            <div class="col-sm-15">
                                            <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title"><b>Buku Besar</b></h3>
                                                        <a href="laporan_keuangan">Kembali</a>
                                                    </div>
                                                    <div style="margin: 20px">
                                                        <div class="row">
                                                            <form action="<?php echo site_url('laporan/buku_besar_print');?>" target="_blank">
                                                                <div class="col-sm-3">
                                                                    <input type="text" id="filter_date_buku_besar" name="filter_date" class="form-control dtpicker" value="<?php echo $filter_date;?>" autocomplete="off" placeholder="Filter By Date">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;"><i class="fa fa-print"></i>  Print</button>
                                                                </div>
                                                            </form>
                                                            
                                                        </div>
                                                        <br />
                                                        <div id="wait-buku-besar" style=" text-align: center; align-content: center; display: none;">	
                                                            <div>Mohon Tunggu</div>
                                                            <div class="fa-3x">
                                                            <i class="fa fa-spinner fa-spin"></i>
                                                            </div>
                                                        </div>				
                                                        <div class="table-responsive" id="table-buku-besar">													
                                                        
                        
                                                        </div>
                                                    </div>
                                            </div>
                                            
                                            </div>
                                        </div>

                                        <!-- Cash Flow -->
                                        <div role="tabpanel" class="tab-pane" id="cash_flow">
                                            <div class="col-sm-15">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title"><b>Cash Flow</b></h3>
                                                        <a href="laporan_keuangan">Kembali</a>
                                                    </div>
                                                    <div style="margin: 20px">
                                                        <!--<div class="row">
                                                            <form action="<?php echo site_url('laporan/cetak_cash_flow');?>" target="_blank">
                                                                <div class="col-sm-3">
                                                                    <button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;">PRINT</button>
                                                                </div>
                                                            </form>
                                                        </div>-->
                                                        <br />
                                                        <div id="wait-cash-flow" style=" text-align: center; align-content: center; display: none;">	
                                                            <div>Mohon Tunggu</div>
                                                            <div class="fa-3x">
                                                            <i class="fa fa-spinner fa-spin"></i>
                                                            </div>
                                                        </div>				
                                                        <div class="table-responsive" id="cash-flow">
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
                </div>
            </div>
        </div>   
        <?php echo $this->Templates->Footer(); ?>
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/daterangepicker.css">
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/bootbox.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/back/theme/vendor/jquery.number.min.js"></script>
        <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
		<script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>
        
		<!-- Script Laba Rugi -->
		<script type="text/javascript">
            $('#filter_date_laba_rugi').daterangepicker({
                autoUpdateInput : false,
                showDropdowns: true,
                locale: {
                format: 'DD-MM-YYYY'
                },
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });

            $('#filter_date_laba_rugi').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
                LabaRugi();
            });


            function LabaRugi()
            {
                $('#wait-laba-rugi').fadeIn('fast');   
                $.ajax({
                    type    : "POST",
                    url     : "<?php echo site_url('pmm/reports/laba_rugi'); ?>/"+Math.random(),
                    dataType : 'html',
                    data: {
                        filter_date : $('#filter_date_laba_rugi').val(),
                    },
                    success : function(result){
                        $('#laba-rugi').html(result);
                        $('#wait-laba-rugi').fadeOut('fast');
                    }
                });
            }

            //LabaRugi();
		</script>

        <!-- Neraca -->
		<script type="text/javascript">
            $('#filter_date_neraca').daterangepicker({
                autoUpdateInput : false,
                showDropdowns: true,
                singleDatePicker: true,
                locale: {
                format: 'DD-MM-YYYY'
                },
                minDate: new Date(2024, 01, 01),	
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });

            $('#filter_date_neraca').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('01-01-2024') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
                TableNeraca();
            });


            function TableNeraca()
            {
                $('#wait-neraca').fadeIn('fast');   
                $.ajax({
                    type    : "POST",
                    url     : "<?php echo site_url('pmm/reports/neraca'); ?>/"+Math.random(),
                    dataType : 'html',
                    data: {
                        filter_date : $('#filter_date_neraca').val(),
                    },
                    success : function(result){
                        $('#table-neraca').html(result);
                        $('#wait-neraca').fadeOut('fast');
                    }
                });
            }

            TableNeraca();
		</script>

        <!-- Buku Besar -->
		<script type="text/javascript">
            $('#filter_date_buku_besar').daterangepicker({
                autoUpdateInput : false,
                showDropdowns: true,
                locale: {
                format: 'DD-MM-YYYY'
                },
                //minDate: new Date(2024, 01, 01),	
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });

            $('#filter_date_buku_besar').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
                TableBukuBesar();
            });


            function TableBukuBesar()
            {
                $('#wait-buku-besar').fadeIn('fast');   
                $.ajax({
                    type    : "POST",
                    url     : "<?php echo site_url('pmm/reports/buku_besar'); ?>/"+Math.random(),
                    dataType : 'html',
                    data: {
                        filter_date : $('#filter_date_buku_besar').val(),
                    },
                    success : function(result){
                        $('#table-buku-besar').html(result);
                        $('#wait-buku-besar').fadeOut('fast');
                    }
                });
            }

            TableBukuBesar();
		</script>

        <!-- Script Cash Flow -->
		<script type="text/javascript">
			$('#filter_date_cash_flow').daterangepicker({
            autoUpdateInput : false,
			showDropdowns: true,
            locale: {
              format: 'DD-MM-YYYY'
            },
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(30, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
			});

			$('#filter_date_cash_flow').on('apply.daterangepicker', function(ev, picker) {
				  $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
				  CashFlow();
			});


			function CashFlow()
			{
				$('#wait-cash-flow').fadeIn('fast');   
				$.ajax({
					type    : "POST",
					url     : "<?php echo site_url('pmm/reports/cash_flow'); ?>/"+Math.random(),
					dataType : 'html',
					data: {
						filter_date : $('#filter_date_cash_flow').val(),
					},
					success : function(result){
						$('#cash-flow').html(result);
						$('#wait-cash-flow').fadeOut('fast');
					}
				});
			}

			CashFlow();
        </script>
    </body>
</html>