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
								<h3><b>PEMAKAIAN BAHAN</b></h3>                                
							</div>
						</div>
						<div class="panel-content">
							<form method="POST" action="<?php echo site_url('produksi/submit_pemakaian');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
								<div class="row">
									<div class="col-sm-2">
										<label>Tanggal</label>
									</div>
										<div class="col-sm-2">
										<input type="text" class="form-control dtpicker" name="date" required="" value="" />
									</div>                          
								</div>
								<br />
								<div class="table-responsive">
									<table id="table-product" class="table table-bordered table-striped table-condensed table-center">
										<thead>
											<tr>
												<th width="5%">No</th>
												<th width="15%">Uraian</th>
												<th>Volume</th>
												<th>Nilai</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1.</td>
												<td>Semen</td>
												<td><input type="text" id="vol_semen" name="vol_semen" class="form-control numberformat text-center" value="" required="" autocomplete="off"></td>
												<td><input type="text" id="nilai_semen" name="nilai_semen" class="form-control rupiahformat text-center" value="" required="" autocomplete="off"></td>
											</tr>
											<tr>
												<td>2.</td>
												<td>Pasir</td>
												<td><input type="text" id="vol_pasir" name="vol_pasir" class="form-control numberformat text-center" value="" required="" autocomplete="off"></td>
												<td><input type="text" id="nilai_pasir" name="nilai_pasir" class="form-control rupiahformat text-center" value="" required="" autocomplete="off"></td>
											</tr>
											<tr>
												<td>3.</td>
												<td>Batu Split 10-20</td>
												<td><input type="text" id="vol_1020" name="vol_1020" class="form-control numberformat text-center" value="" required="" autocomplete="off"></td>
												<td><input type="text" id="nilai_1020" name="nilai_1020" class="form-control rupiahformat text-center" value="" required="" autocomplete="off"></td>
											</tr>
											<tr>
												<td>4.</td>
												<td>Batu Split 20-30</td>
												<td><input type="text" id="vol_2030" name="vol_2030" class="form-control numberformat text-center" value="" required="" autocomplete="off"></td>
												<td><input type="text" id="nilai_2030" name="nilai_2030" class="form-control rupiahformat text-center" value="" required="" autocomplete="off"></td>
											</tr>
											<tr>
												<td>5.</td>
												<td>Additive</td>
												<td><input type="text" id="vol_additive" name="vol_additive" class="form-control numberformat text-center" value="" required="" autocomplete="off"></td>
												<td><input type="text" id="nilai_additive" name="nilai_additive" class="form-control rupiahformat text-center" value="" required="" autocomplete="off"></td>
											</tr>
											<tr>
												<td>6.</td>
												<td>Solar</td>
												<td><input type="text" id="vol_solar" name="vol_solar" class="form-control numberformat text-center" value="" required="" autocomplete="off"></td>
												<td><input type="text" id="nilai_solar" name="nilai_solar" class="form-control rupiahformat text-center" value="" required="" autocomplete="off"></td>
											</tr>
										</tbody>
										<tfoot>
										</tfoot>
									</table>
									<div class="text-center">
										<a href="<?= site_url('admin/stock_opname#pemakaian');?>" class="btn btn-danger" style="margin-bottom:0; font-weight:bold; border-radius:10px;">BATAL</a>
										<button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;">KIRIM</button>
									</div>
								</div>
							</form>
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

    

    <script type="text/javascript">
        
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
	
		$(document).ready(function() {
            setTimeout(function(){
                $('#produk_a').prop('selectedIndex', 1).trigger('change');
            }, 1000);
        });
		$(document).ready(function() {
            setTimeout(function(){
                $('#produk_b').prop('selectedIndex', 2).trigger('change');
            }, 1000);
        });
		$(document).ready(function() {
            setTimeout(function(){
                $('#produk_c').prop('selectedIndex', 3).trigger('change');
            }, 1000);
        });
		$(document).ready(function() {
            setTimeout(function(){
                $('#produk_d').prop('selectedIndex', 4).trigger('change');
            }, 1000);
        });
		$(document).ready(function() {
            setTimeout(function(){
                $('#produk_e').prop('selectedIndex', 7).trigger('change');
            }, 1000);
        });
		$(document).ready(function() {
            setTimeout(function(){
                $('#measure_a').prop('selectedIndex', 1).trigger('change');
            }, 1000);
        });
		$(document).ready(function() {
            setTimeout(function(){
                $('#measure_b').prop('selectedIndex', 4).trigger('change');
            }, 1000);
        });
		$(document).ready(function() {
            setTimeout(function(){
                $('#measure_c').prop('selectedIndex', 4).trigger('change');
            }, 1000);
        });
		$(document).ready(function() {
            setTimeout(function(){
                $('#measure_d').prop('selectedIndex', 4).trigger('change');
            }, 1000);
        });
		$(document).ready(function() {
            setTimeout(function(){
                $('#measure_e').prop('selectedIndex', 3).trigger('change');
            }, 1000);
        });

		function changeData(id)
        {
			var presentase_a = $('#presentase_a').val();
			var presentase_b = $('#presentase_b').val();
			var presentase_c = $('#presentase_c').val();
			var presentase_d = $('#presentase_d').val();
			var presentase_e = $('#presentase_e').val();

			var price_a = $('#price_a').val();
			var price_b = $('#price_b').val();
			var price_c = $('#price_c').val();
			var price_d = $('#price_d').val();
			var price_e = $('#price_e').val();
            				
			total_a = ( presentase_a * price_a );
			$('#total_a').val(total_a);
			total_b = ( presentase_b * price_b );
			$('#total_b').val(total_b);
			total_c = ( presentase_c * price_c );
			$('#total_c').val(total_c);
			total_d = ( presentase_d * price_d );
			$('#total_d').val(total_d);
			total_e = ( presentase_e * price_e );
			$('#total_e').val(total_e);
			getTotal();
        }

		function getTotal()
        {
            var sub_total = $('#sub-total-val').val();

            sub_total = parseInt($('#total_a').val()) + parseInt($('#total_b').val()) + parseInt($('#total_c').val()) + parseInt($('#total_d').val()) + parseInt($('#total_e').val());
            
            $('#sub-total-val').val(sub_total);
            $('#sub-total').text($.number( sub_total, 0,',','.' ));

            total_total = parseInt(sub_total);
            $('#total-val').val(total_total);
            $('#total').text($.number( total_total, total_e,',','.' ));
        }

		$('#penawaran_semen').change(function(){
			var penawaran_id = $(this).find(':selected').data('penawaran_id');
			$('#penawaran_semen').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
			$('#price_a').val(price);
			var supplier_id = $(this).find(':selected').data('supplier_id');
			$('#supplier_id_semen').val(supplier_id);
			var measure = $(this).find(':selected').data('measure');
			$('#measure_semen').val(measure);
			var tax_id = $(this).find(':selected').data('tax_id');
			$('#tax_id_semen').val(tax_id);
			var pajak_id = $(this).find(':selected').data('pajak_id');
			$('#pajak_id_semen').val(pajak_id);
			var id_penawaran = $(this).find(':selected').data('id_penawaran');
			$('#penawaran_id_semen').val(penawaran_id);
		});

		$('#penawaran_pasir').change(function(){
			var penawaran_id = $(this).find(':selected').data('penawaran_id');
			$('#penawaran_pasir').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
			$('#price_b').val(price);
			var supplier_id = $(this).find(':selected').data('supplier_id');
			$('#supplier_id_pasir').val(supplier_id);
			var measure = $(this).find(':selected').data('measure');
			$('#measure_pasir').val(measure);
			var tax_id = $(this).find(':selected').data('tax_id');
			$('#tax_id_pasir').val(tax_id);
			var pajak_id = $(this).find(':selected').data('pajak_id');
			$('#pajak_id_pasir').val(pajak_id);
			var id_penawaran = $(this).find(':selected').data('id_penawaran');
			$('#penawaran_id_pasir').val(penawaran_id);
		});

		$('#penawaran_1020').change(function(){
			var penawaran_id = $(this).find(':selected').data('penawaran_id');
			$('#penawaran_1020').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
			$('#price_c').val(price);
			var supplier_id = $(this).find(':selected').data('supplier_id');
			$('#supplier_id_1020').val(supplier_id);
			var measure = $(this).find(':selected').data('measure');
			$('#measure_1020').val(measure);
			var tax_id = $(this).find(':selected').data('tax_id');
			$('#tax_id_1020').val(tax_id);
			var pajak_id = $(this).find(':selected').data('pajak_id');
			$('#pajak_id_1020').val(pajak_id);
			var id_penawaran = $(this).find(':selected').data('id_penawaran');
			$('#penawaran_id_1020').val(penawaran_id);
		});

		$('#penawaran_2030').change(function(){
			var penawaran_id = $(this).find(':selected').data('penawaran_id');
			$('#penawaran_2030').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
			$('#price_d').val(price);
			var supplier_id = $(this).find(':selected').data('supplier_id');
			$('#supplier_id_2030').val(supplier_id);
			var measure = $(this).find(':selected').data('measure');
			$('#measure_2030').val(measure);
			var tax_id = $(this).find(':selected').data('tax_id');
			$('#tax_id_2030').val(tax_id);
			var pajak_id = $(this).find(':selected').data('pajak_id');
			$('#pajak_id_2030').val(pajak_id);
			var id_penawaran = $(this).find(':selected').data('id_penawaran');
			$('#penawaran_id_2030').val(penawaran_id);
		});

		$('#penawaran_additive').change(function(){
			var penawaran_id = $(this).find(':selected').data('penawaran_id');
			$('#penawaran_additive').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
			$('#price_e').val(price);
			var supplier_id = $(this).find(':selected').data('supplier_id');
			$('#supplier_id_additive').val(supplier_id);
			var measure = $(this).find(':selected').data('measure');
			$('#measure_additive').val(measure);
			var tax_id = $(this).find(':selected').data('tax_id');
			$('#tax_id_additive').val(tax_id);
			var pajak_id = $(this).find(':selected').data('pajak_id');
			$('#pajak_id_additive').val(pajak_id);
			var id_penawaran = $(this).find(':selected').data('id_penawaran');
			$('#penawaran_id_additive').val(penawaran_id);
		});
		
    </script>


</body>
</html>
