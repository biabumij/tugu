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
									
									<!-- Laporan Laba Rugi -->
                                    <div role="tabpanel" class="tab-pane active" id="laba_rugi">
                                        <br />
                                        <div class="row">
                                            <div width="100%">
												<?php
												if(in_array($this->session->userdata('admin_group_id'), array(1,2,3,4,5,6,7,8))){
												?>  
												<div class="col-sm-5">
													<p><b><h5>Laporan Evaluasi Biaya Produksi</h5></b></p>
													<a href="#laporan_evaluasi_biaya_produksi" aria-controls="laporan_evaluasi_biaya_produksi" role="tab" data-toggle="tab" class="btn btn-primary" style="border-radius:10px; font-weight:bold;">Lihat Laporan</a>
												</div>
												<?php
												}
												?>
												<!--<?php
												if(in_array($this->session->userdata('admin_group_id'), array(1,2,3,4,5))){
												?>
												<div class="col-sm-5">
													<p><h5><b>Evaluasi Target Produksi</b></h5></p>
													<a href="#evaluasi_target_produksi" aria-controls="evaluasi_target_produksi" role="tab" data-toggle="tab" class="btn btn-primary" style="border-radius:10px; font-weight:bold;">Lihat Laporan</a>										
												</div>  
												<?php
												}
												?>-->      
                                            </div>
                                        </div>
                                    </div>

									<!-- Laporan Evaluasi Biaya Produksi -->
									<div role="tabpanel" class="tab-pane" id="laporan_evaluasi_biaya_produksi">
                                        <div class="col-sm-15">
										<div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><b>Laporan Evaluasi Biaya Produksi</b></h3>
													<a href="laporan_ev._produksi">Kembali</a>
                                                </div>
												<div style="margin: 20px">
													<div class="row">
														<form action="<?php echo site_url('laporan/laporan_evaluasi_biaya_produksi_print');?>" target="_blank">
															<div class="col-sm-3">
																<input type="text" id="filter_date_evaluasi_biaya_produksi" name="filter_date" class="form-control dtpicker"  autocomplete="off" placeholder="Filter By Date">
															</div>
															<div class="col-sm-3">
																<button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;"><i class="fa fa-print"></i>  Print</button>
															</div>
														</form>
														
													</div>
													<br />
													<div id="wait" style=" text-align: center; align-content: center; display: none;">	
														<div>Mohon Tunggu</div>
														<div class="fa-3x">
														  <i class="fa fa-spinner fa-spin"></i>
														</div>
													</div>				
													<div class="table-responsive" id="box-evaluasi">													
													
                    
													</div>
												</div>
										    </div>
										</div>
                                    </div>

									<!-- Laporan Evaluasi Target Produksi -->
                                    <div role="tabpanel" class="tab-pane" id="evaluasi_target_produksi">
                                        <div class="col-sm-15">
											<div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><b>Evaluasi Target Produksi</b></h3>
													<a href="laporan_ev._produksi">Kembali</a>
                                                </div>
												<div style="margin: 20px">
													<div class="row">
														<form action="<?php echo site_url('laporan/cetak_evaluasi_target_produksi');?>" target="_blank">
															<div class="col-sm-3">
																<input type="text" id="filter_date_evaluasi_target_produksi" name="filter_date" class="form-control dtpicker"  autocomplete="off" placeholder="Filter By Date">
															</div>
															<div class="col-sm-3">
																<button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;">PRINT</button>
															</div>
														</form>
														
													</div>
													<br />
													<div id="wait-evaluasi" style=" text-align: center; align-content: center; display: none;">	
														<div>Mohon Tunggu</div>
														<div class="fa-3x">
														  <i class="fa fa-spinner fa-spin"></i>
														</div>
													</div>				
													<div class="table-responsive" id="evaluasi-target-produksi">
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

		<!-- Script Laporan Evaluasi Biaya Produksi -->
		<script type="text/javascript">
			$('#filter_date_evaluasi_biaya_produksi').daterangepicker({
				autoUpdateInput : false,
				showDropdowns: true,
				locale: {
				format: 'DD-MM-YYYY'
				},
				minDate: new Date(2023, 07, 01),
				ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(30, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				}
			});

			$('#filter_date_evaluasi_biaya_produksi').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
				TableEvaluasiBiayaProduksi();
			});

			function TableEvaluasiBiayaProduksi()
			{
				$('#wait').fadeIn('fast');   
				$.ajax({
					type    : "POST",
					url     : "<?php echo site_url('pmm/reports/laporan_evaluasi_biaya_produksi'); ?>/"+Math.random(),
					dataType : 'html',
					data: {
						filter_date : $('#filter_date_evaluasi_biaya_produksi').val(),
					},
					success : function(result){
						$('#box-evaluasi').html(result);
						$('#wait').fadeOut('fast');
					}
				});
			}

			//TableEvaluasiBiayaProduksi();
		</script>

		<!-- Script Evaluasi Bahan -->
		<script type="text/javascript">
			$('#filter_date_evaluasi_bahan').daterangepicker({
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

			$('#filter_date_evaluasi_bahan').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
				EvaluasiBahan();
			});


			function EvaluasiBahan()
			{
				$('#wait-bahan').fadeIn('fast');   
				$.ajax({
					type    : "POST",
					url     : "<?php echo site_url('pmm/reports/evaluasi_bahan'); ?>/"+Math.random(),
					dataType : 'html',
					data: {
						filter_date : $('#filter_date_evaluasi_bahan').val(),
					},
					success : function(result){
						$('#evaluasi-bahan').html(result);
						$('#wait-bahan').fadeOut('fast');
					}
				});
			}

		//EvaluasiBahan();
        </script>
		
		<!-- Script Evaluasi Alat -->
		<script type="text/javascript">
			$('#filter_date_evaluasi_alat').daterangepicker({
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

			$('#filter_date_evaluasi_alat').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
				EvaluasiAlat();
			});

			function EvaluasiAlat()
			{
				$('#wait-alat').fadeIn('fast');   
				$.ajax({
					type    : "POST",
					url     : "<?php echo site_url('pmm/reports/evaluasi_alat'); ?>/"+Math.random(),
					dataType : 'html',
					data: {
						filter_date : $('#filter_date_evaluasi_alat').val(),
					},
					success : function(result){
						$('#evaluasi-alat').html(result);
						$('#wait-alat').fadeOut('fast');
					}
				});
			}

			//EvaluasiAlat();
        </script>

		<!-- Script Evaluasi BUA -->
		<script type="text/javascript">
			$('#filter_date_evaluasi_bua').daterangepicker({
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

			$('#filter_date_evaluasi_bua').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
				EvaluasiBUA();
			});

			function EvaluasiBUA()
			{
				$('#wait-bua').fadeIn('fast');   
				$.ajax({
					type    : "POST",
					url     : "<?php echo site_url('pmm/reports/evaluasi_bua'); ?>/"+Math.random(),
					dataType : 'html',
					data: {
						filter_date : $('#filter_date_evaluasi_bua').val(),
					},
					success : function(result){
						$('#evaluasi-bua').html(result);
						$('#wait-bua').fadeOut('fast');
					}
				});
			}

			//EvaluasiBUA();
		</script>

		<!-- Script Evaluasi Target Produksi -->
		<script type="text/javascript">
			$('#filter_date_evaluasi_target_produksi').daterangepicker({
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

			$('#filter_date_evaluasi_target_produksi').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
				EvaluasiTargetProduksi();
			});

			function EvaluasiTargetProduksi()
			{
				$('#wait-evaluasi').fadeIn('fast');   
				$.ajax({
					type    : "POST",
					url     : "<?php echo site_url('pmm/reports/evaluasi_target_produksi'); ?>/"+Math.random(),
					dataType : 'html',
					data: {
						filter_date : $('#filter_date_evaluasi_target_produksi').val(),
					},
					success : function(result){
						$('#evaluasi-target-produksi').html(result);
						$('#wait-evaluasi').fadeOut('fast');
					}
				});
			}

		//EvaluasiTargetProduksi();
		</script>
	</div>
</body>
</html>