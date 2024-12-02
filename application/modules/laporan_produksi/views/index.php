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
							<div class="panel-content">
								<div class="panel-header">
									<h3 class="section-subtitle" style="font-weight:bold; text-transform:uppercase;"><?php echo $row[0]->menu_name; ?></h3>
									<div class="text-left">
										<a href="<?php echo site_url('admin');?>">
										<button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
									</div>
								</div>
                                <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active">
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
												<div class="col-sm-5">
													<p><b><h5>Laporan Evaluasi Biaya Produksi (Pemakaian)</h5></b></p>
													<a href="#laporan_evaluasi_biaya_produksi_pemakaian" aria-controls="laporan_evaluasi_biaya_produksi_pemakaian" role="tab" data-toggle="tab" class="btn btn-primary" style="border-radius:10px; font-weight:bold;">Lihat Laporan</a>
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

									<!-- Laporan Evaluasi Biaya Produksi Pemakaian-->
									<div role="tabpanel" class="tab-pane" id="laporan_evaluasi_biaya_produksi_pemakaian">
                                        <div class="col-sm-15">
											<div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title"><b>Laporan Evaluasi Biaya Produksi (Pemakaian)</b></h3>
													<a href="laporan_ev._produksi">Kembali</a>
                                                </div>
												<div style="margin: 20px">
													<div class="row">
														<form action="<?php echo site_url('laporan/laporan_evaluasi_biaya_produksi_pemakaian_print');?>" target="_blank">
															<div class="col-sm-3">
																<input type="text" id="filter_date_evaluasi_biaya_produksi_pemakaian" name="filter_date" class="form-control dtpicker"  autocomplete="off" placeholder="Filter By Date">
															</div>
															<div class="col-sm-3">
																<button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;"><i class="fa fa-print"></i> Print</button>
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
													<div class="table-responsive" id="box-evaluasi-pemakaian">													
													
                    
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

		<!-- Script Laporan Evaluasi Biaya Produksi Pemakaian-->
		<script type="text/javascript">
			$('#filter_date_evaluasi_biaya_produksi_pemakaian').daterangepicker({
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

			$('#filter_date_evaluasi_biaya_produksi_pemakaian').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
				TableEvaluasiBiayaProduksiPemakaian();
			});

			function TableEvaluasiBiayaProduksiPemakaian()
			{
				$('#wait').fadeIn('fast');   
				$.ajax({
					type    : "POST",
					url     : "<?php echo site_url('pmm/reports/laporan_evaluasi_biaya_produksi_pemakaian'); ?>/"+Math.random(),
					dataType : 'html',
					data: {
						filter_date : $('#filter_date_evaluasi_biaya_produksi_pemakaian').val(),
					},
					success : function(result){
						$('#box-evaluasi-pemakaian').html(result);
						$('#wait').fadeOut('fast');
					}
				});
			}

			//TableEvaluasiBiayaProduksiPemakaian();
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