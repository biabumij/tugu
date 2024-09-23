<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>

    <style type="text/css">
		body{
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
									<h3><b>KUNCI DATA RAKOR</b></h3>                                
								</div>
							</div>
							<div class="panel-content">
								<form method="POST" action="<?php echo site_url('produksi/submit_rakor');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
									<div class="row">
										<div class="col-sm-2">
											<label>Tanggal</label>
										</div>
											<div class="col-sm-2">
											<input type="text" class="form-control dtpicker" name="date" required="" value="" />
										</div>                          
									</div>
									<br /><br /><br />
									<div class="text-center">
										<a href="<?= site_url('admin/produksi#rakor');?>" class="btn btn-danger" style="margin-bottom:0; font-weight:bold; border-radius:10px;">BATAL</a>
										<button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;">KIRIM</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    
    <?php echo $this->Templates->Footer();?>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/jquery.number.min.js"></script>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/daterangepicker.css">
    <script src="<?php echo base_url();?>assets/back/theme/vendor/bootbox.min.js"></script>
	<script type="text/javascript">
        var form_control = '';
    </script>
    

    <script type="text/javascript">
        <?php
        $kunci_rakor = $this->db->select('date')->order_by('date','desc')->limit(1)->get_where('kunci_rakor')->row_array();
        $last_opname = date('d-m-Y', strtotime('+1 days', strtotime($kunci_rakor['date'])));
        ?>
        $('.form-select2').select2();
        $('input.numberformat').number( true, 2,',','.' );
		//$('input.rupiahformat').number( true, 0,',','.' );

        tinymce.init({
          selector: 'textarea#about_text',
          height: 200,
          menubar: false,
        });
        $('.dtpicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns : true,
            locale: {
              format: 'DD-MM-YYYY'
            }
        });

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

        $('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
              $(this).val(picker.startDate.format('DD-MM-YYYY'));
              // table.ajax.reload();
        });

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
