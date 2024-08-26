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
		  vertical-align: middle;
          color: black;
		}
		
		.mytable tbody td {
            vertical-align: middle;
            color: black;
		}
		
		.mytable tfoot td {
            vertical-align: middle;
            color: black;
		}

        blink {
        -webkit-animation: 2s linear infinite kedip; /* for Safari 4.0 - 8.0 */
        animation: 2s linear infinite kedip;
        }
        /* for Safari 4.0 - 8.0 */
        @-webkit-keyframes kedip { 
        0% {
            visibility: hidden;
        }
        50% {
            visibility: hidden;
        }
        100% {
            visibility: visible;
        }
        }
        @keyframes kedip {
        0% {
            visibility: hidden;
        }
        50% {
            visibility: hidden;
        }
        100% {
            visibility: visible;
        }
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
								<h3 class="section-subtitle" style="font-weight:bold; text-transform:uppercase;"><?php echo $row[0]->menu_name; ?></h3>
								<div class="text-left">
									<a href="<?php echo site_url('admin');?>">
									<button style="color:white; background-color:#5bc0de; border:1px solid black; border-radius:10px; line-height:30px;"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
								</div>
                                <div class="tab-content">
				
								
                                    <div role="tabpanel" class="tab-pane active" id="bisnis">
                                        
										<div role="tabpanel" class="tab-pane active" id="pembelian">
                                        <br />
											<div class="row">
												<div width="100%">
													<div class="col-sm-5">
														<p><h5><b>Rencana Kerja</b></h5></p>
														<a href="#rencana_kerja" aria-controls="rencana_kerja" role="tab" data-toggle="tab" class="btn btn-primary" style="border-radius:10px; font-weight:bold;">Lihat Laporan</a>
													</div>	                                       
													<!--<div class="col-sm-5">
														<p><h5><b>Prognosa Produksi</b></h5></p>
														<a href="#prognosa_produksi" aria-controls="prognosa_produksi" role="tab" data-toggle="tab" class="btn btn-primary" style="border-radius:10px; font-weight:bold;">Lihat Laporan</a>
													</div>-->
												</div>
											</div>
										</div>
                                    </div>

									<!-- Rencana Kerja -->
                                    <div role="tabpanel" class="tab-pane" id="rencana_kerja">
                                        <div class="col-sm-15">
											<div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><b>Rencana Kerja</b></h3>
													<a href="laporan_rencana_kerja">Kembali</a>
                                                </div>
												<div style="margin: 20px">
													<div class="row">
														<!--<form action="<?php echo site_url('laporan/cetak_rencana_kerja');?>" target="_blank">
															<div class="col-sm-3">
																<input type="text" id="filter_date_rencana_kerja" name="filter_date" class="form-control dtpicker"  autocomplete="off" placeholder="Filter By Date">
															</div>
															<div class="col-sm-3">
																<button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;">PRINT</button>
															</div>
														</form>-->
														
													</div>
													<br />
													<div id="wait-rencana-kerja" style=" text-align: center; align-content: center; display: none;">	
														<div>Mohon Tunggu</div>
														<div class="fa-3x">
														  <i class="fa fa-spinner fa-spin"></i>
														</div>
													</div>				
													<div class="table-responsive" id="rencana-kerja">
													</div>
												</div>
										</div>
										
										</div>
                                    </div>

                                    <!-- Prognosa Produksi -->
                                    <div role="tabpanel" class="tab-pane" id="prognosa_produksi">
                                        <div class="col-sm-15">
											<div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><b>Prognosa Produksi</b></h3>
													<a href="laporan_rencana_kerja">Kembali</a>
                                                </div>
												<div style="margin: 20px">
													<div class="row">
														<form action="<?php echo site_url('laporan/cetak_prognosa_produksi');?>" target="_blank">
															<!--<div class="col-sm-3">
																<input type="text" id="filter_date_prognosa_produksi" name="filter_date" class="form-control dtpicker"  autocomplete="off" placeholder="Filter By Date">
															</div>-->
															<div class="col-sm-3">
																<button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;">PRINT</button>
															</div>
														</form>
														
													</div>
													<br />
													<div id="wait-prognosa-produksi" style=" text-align: center; align-content: center; display: none;">	
														<div>Mohon Tunggu</div>
														<div class="fa-3x">
														  <i class="fa fa-spinner fa-spin"></i>
														</div>
													</div>				
													<div class="table-responsive" id="prognosa-produksi">
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

		<!-- Script Rencana Kerja -->
		<script type="text/javascript">
			$('#filter_date_rencana_kerja').daterangepicker({
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

			$('#filter_date_rencana_kerja').on('apply.daterangepicker', function(ev, picker) {
				  $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
				  RencanaKerja();
			});


			function RencanaKerja()
			{
				$('#wait-rencana-kerja').fadeIn('fast');   
				$.ajax({
					type    : "POST",
					url     : "<?php echo site_url('pmm/reports/rencana_kerja'); ?>/"+Math.random(),
					dataType : 'html',
					data: {
						filter_date : $('#filter_date_rencana_kerja').val(),
					},
					success : function(result){
						$('#rencana-kerja').html(result);
						$('#wait-rencana-kerja').fadeOut('fast');
					}
				});
			}

			RencanaKerja();
        </script>
		
		<!-- Script Prognosa Produksi -->
		<script type="text/javascript">
			$('#filter_date_prognosa_produksi').daterangepicker({
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

			$('#filter_date_prognosa_produksi').on('apply.daterangepicker', function(ev, picker) {
				  $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
				  PrognosaProduksi();
			});


			function PrognosaProduksi()
			{
				$('#wait-prognosa-produksi').fadeIn('fast');   
				$.ajax({
					type    : "POST",
					url     : "<?php echo site_url('pmm/reports/prognosa_produksi'); ?>/"+Math.random(),
					dataType : 'html',
					data: {
						filter_date : $('#filter_date_prognosa_produksi').val(),
					},
					success : function(result){
						$('#prognosa-produksi').html(result);
						$('#wait-prognosa-produksi').fadeOut('fast');
					}
				});
			}

			PrognosaProduksi();
        </script>
	</div>
</body>
</html>