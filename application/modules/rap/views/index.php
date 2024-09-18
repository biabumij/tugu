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
                                <h3 class="section-subtitle">
                                    <b style="text-transform:uppercase;"><?php echo $row[0]->menu_name; ?></b>
                                </h3>
                                <div class="text-left">
                                    <a href="<?php echo site_url('admin');?>">
                                    <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                </div>
                            </div>
                            <div class="panel-content">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#bahan" aria-controls="bahan" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">BAHAN</a></li>
                                    <li role="presentation"><a href="#alat" aria-controls="alat" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">ALAT</a></li>
                                    <li role="presentation"><a href="#bua" aria-controls="bua" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">BUA</a></li>
                                </ul>
                                <div class="tab-content">
                                <br />
                                <!-- Table Bahan -->
                                    <div role="tabpanel" class="tab-pane active" id="bahan">
										<!--<div class="col-sm-3">
											<input type="text" id="filter_date_agregat" name="filter_date" class="form-control dtpickerange" autocomplete="off" placeholder="Filter By Date">
										</div>-->
                                        <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="<?php echo site_url('rap/form_bahan'); ?>"><b style="color:white;">BUAT BAHAN</b></a></button>
                                        <br />										
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="table_agregat" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
														<th>Mutu Beton</th>
                                                        <th>Judul</th>
														<th>Lampiran</th>
                                                        <th>Closed</th>
                                                        <th>Edit</th>
                                                        <th>Cetak</th>
                                                        <th>Hapus</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
									</div>
										
									<!-- Table Alat -->
                                    <div role="tabpanel" class="tab-pane" id="alat">
                                        <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="<?php echo site_url('rap/form_alat'); ?>"><b style="color:white;">BUAT ALAT</b></a></button>
                                        <br /><br />								
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="table_rap_alat" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
														<th>Tanggal</th>
														<th>Nomor</th>
                                                        <th>Masa Kontrak</th>
                                                        <th>Lampiran</th>
                                                        <th>Cetak</th>
														<th>Hapus</th>
													</tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
									</div>

                                    <!-- Table BUA -->
                                    <div role="tabpanel" class="tab-pane" id="bua">		
                                        <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="<?php echo site_url('rap/form_bua'); ?>"><b style="color:white;">BUAT BUA</b></a></button>
                                        <br /><br />							
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="table_rap_bua" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
														<th>Dibuat Tanggal</th>
														<th>Nomor</th>
                                                        <th>Masa Kontrak</th>
                                                        <th>Lampiran</th>
                                                        <th>Cetak</th>
														<th>Hapus</th>
													</tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
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

    <script type="text/javascript">
        $('.dtpickerange').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD-MM-YYYY'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            showDropdowns: true,
        });
		
		var table_agregat = $('#table_agregat').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('rap/table_agregat'); ?>',
                type: 'POST',
                data: function(d) {
                    d.filter_date = $('#filter_date_agregat').val();
                }
            },
            responsive: true,
            paging : false,
            "deferRender": true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            columns: [
				{
                    "data": "no"
                },
				{
                    "data": "mutu_beton"
                },
				{
                    "data": "jobs_type"
                },
				{
                    "data": "lampiran"
                },
                {
					"data": "closed"
				},
                {
					"data": "edit"
				},
                {
					"data": "print"
				},
                {
					"data": "actions"
				},
                {
                    "data": "status"
                }
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0, "className": 'text-center'},
            ],
        });

        $('#filter_date_agregat').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            table_agregat.ajax.reload();
        });

        function DeleteDataBahan(id) {
        bootbox.confirm("Apakah Anda yakin untuk menghapus data ini ?", function(result) {
                // console.log('This was logged in the callback: ' + result); 
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('rap/delete_rap_bahan'); ?>",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(result) {
                            if (result.output) {
                                table_agregat.ajax.reload();
                                bootbox.alert('<b>DELETED</b>');
                            } else if (result.err) {
                                bootbox.alert(result.err);
                            }
                        }
                    });
                }
            });
        }

        
	
    </script>

    <script type="text/javascript">
		
		var table_rap_alat = $('#table_rap_alat').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('rap/table_rap_alat'); ?>',
                type: 'POST',
                data: function(d) {
                }
            },
            responsive: true,
            paging : false,
            "deferRender": true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            columns: [
				{
                    "data": "no"
                },
				{
                    "data": "tanggal_rap_alat"
                },
				{
                    "data": "nomor_rap_alat"
                },
                {
                    "data": "masa_kontrak"
                },
                {
                    "data": "lampiran"
                },
                {
					"data": "print"
				},
				{
					"data": "actions"
				},
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0, "className": 'text-center'},
            ],
        });
	
		function DeleteDataAlat(id) {
        bootbox.confirm("Apakah Anda yakin untuk menghapus data ini ?", function(result) {
                // console.log('This was logged in the callback: ' + result); 
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('rap/delete_rap_alat'); ?>",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(result) {
                            if (result.output) {
                                table_rap_alat.ajax.reload();
                                bootbox.alert('<b>DELETED</b>');
                            } else if (result.err) {
                                bootbox.alert(result.err);
                            }
                        }
                    });
                }
            });
        }
    </script>

    <script type="text/javascript">
		
		var table_rap_bua = $('#table_rap_bua').DataTable( {"bAutoWidth": false,
            "displayLength":50,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('rap/table_rap_bua'); ?>',
                type: 'POST',
                data: function(d) {
                }
            },
            responsive: true,
            "deferRender": true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            columns: [
                {
                    "data": "no"
                },
                {
                    "data": "tanggal_rap_bua"
                },
                {
                    "data": "nomor_rap_bua"
                },
                {
                    "data": "masa_kontrak"
                },
                {
                    "data": "lampiran"
                },
                {
					"data": "print"
				},
                {
                    "data": "actions"
                },
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0, "className": 'text-center'},
            ],
        });
	
		function DeleteDataBUA(id) {
        bootbox.confirm("Apakah Anda yakin untuk menghapus data ini ?", function(result) {
                // console.log('This was logged in the callback: ' + result); 
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('rap/delete_rap_bua'); ?>",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(result) {
                            if (result.output) {
                                table_rap_bua.ajax.reload();
                                bootbox.alert('<b>DELETED</b>');
                            } else if (result.err) {
                                bootbox.alert(result.err);
                            }
                        }
                    });
                }
            });
        }
    </script>

</body>

</html>