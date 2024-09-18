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
                                    <li role="presentation" class="active"><a href="#perubahan_sistem" aria-controls="perubahan_sistem" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">PERUBAHAN SISTEM</a></li>
                                </ul>
                                <div class="tab-content">
                                <br />
                                    <div role="tabpanel" class="tab-pane active" id="perubahan_sistem">
								    <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="<?php echo site_url('form/form_perubahan_sistem'); ?>"><b style="color:white;">BUAT FORM PERUBAHAN SISTEM</b></a></button>					
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="table_perubahan_sistem" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
														<th>Tanggal</th>
                                                        <th>Nomor</th>
                                                        <th>Lampiran</th>
                                                        <th>Status Permintaan</th>
                                                        <th>Status Approval</th>
                                                        <th>Cetak</th>
                                                        <th>Upload</th>
														<th>Hapus</th>
													</tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <tfoot>
                                                   
                                                </tfoot>
                                            </table>
                                        </div>
									</div>
		           
                                </div>
                            </div>

                            <div class="modal fade bd-example-modal-lg" id="modalDoc" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <span class="modal-title">Upload Document Perubahan Sistem</span>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" enctype="multipart/form-data" method="POST" style="padding: 0 10px 0 20px;">
                                                <input type="hidden" name="id" id="id_doc">
                                                <div class="form-group">
                                                    <label>Upload Document</label>
                                                    <input type="file" id="file" name="file" class="form-control" required="" />
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success" id="btn-form-doc" style="font-weight:bold; width;10%; border-radius:10px;"><i class="fa fa-send"></i> Kirim</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-weight:bold; width;10%; border-radius:10px;">Close</button>
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
		
		var table_perubahan_sistem = $('#table_perubahan_sistem').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('form/table_perubahan_sistem'); ?>',
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
                    "data": "tanggal"
                },
                {
                    "data": "nomor"
                },
                {
					"data": "lampiran"
				},
                {
					"data": "status_permintaan"
				},
                {
					"data": "approve_ti_sistem"
				},
                {
					"data": "print"
				},
                {
                    "data": "document_perubahan_sistem"
                },
				{
					"data": "actions"
				},
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0, "className": 'text-center'},
            ],
        });

        function ApprovePerubahanSistem(id) {
        bootbox.confirm("Apakah anda yakin untuk proses data ini ?", function(result) {
            // console.log('This was logged in the callback: ' + result); 
            if (result) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('form/approve_ti_sistem'); ?>",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(result) {
                        if (result.output) {
                            table_perubahan_sistem.ajax.reload();
                            bootbox.alert('<b>APPROVED</b>');
                        } else if (result.err) {
                            bootbox.alert(result.err);
                        }
                    }
                });
            }
        });
        }

        function PerubahanSistemSelesai(id) {
        bootbox.confirm("Apakah anda yakin untuk proses data ini ?", function(result) {
            // console.log('This was logged in the callback: ' + result); 
            if (result) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('form/perubahan_sistem_selesai'); ?>",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(result) {
                        if (result.output) {
                            table_perubahan_sistem.ajax.reload();
                            bootbox.alert('Permintaan Selesai');
                        } else if (result.err) {
                            bootbox.alert(result.err);
                        }
                    }
                });
            }
        });
        }
	
		function DeleteData(id) {
        bootbox.confirm("Apakah Anda yakin untuk menghapus data ini ?", function(result) {
            // console.log('This was logged in the callback: ' + result); 
            if (result) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('form/delete_perubahan_sistem'); ?>",
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(result) {
                        if (result.output) {
                            table_perubahan_sistem.ajax.reload();
                            bootbox.alert('<b>DELETED</b>');
                        } else if (result.err) {
                            bootbox.alert(result.err);
                        }
                    }
                });
            }
        });
        }

        function UploadDoc(id) {

        $('#modalDoc').modal('show');
        $('#id_doc').val(id);
        }

        $('#modalDoc form').submit(function(event) {
            $('#btn-form-doc').button('loading');

            var form = $(this);
            var formdata = false;
            if (window.FormData) {
                formdata = new FormData(form[0]);
            }

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('form/form_document'); ?>/" + Math.random(),
                dataType: 'json',
                data: formdata ? formdata : form.serialize(),
                success: function(result) {
                    $('#btn-form-doc').button('reset');
                    if (result.output) {
                        $("#modalDoc form").trigger("reset");
                        table_perubahan_sistem.ajax.reload();

                        $('#modalDoc').modal('hide');
                    } else if (result.err) {
                        bootbox.alert(result.err);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });

            event.preventDefault();

        });

    </script>

</body>

</html>