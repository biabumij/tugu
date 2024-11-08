<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>

    <style type="text/css">
        body {
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
                                    <h3><b>SALES ORDER</b></h3>
                                </div>
                            </div>
                            <div class="panel-content">
                                <form method="POST" action="<?php echo site_url('penjualan/submit_sales_po');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Pelanggan<span class="required" aria-required="true">*</span></label>
                                            <select id="client" class="form-control form-select2" name="client_id" required="">
                                                <option value="">Pilih Pelanggan</option>
                                                <?php
                                                if(!empty($clients)){
                                                    foreach ($clients as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['id'];?>"><?php echo $row['nama'];?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Tanggal Kontrak<span class="required" aria-required="true">*</span></label>
                                            <input type="date" class="form-control" name="contract_date" required="" value=""/>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Nomor Kontrak<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control" name="contract_number"  required="" value=""/>
                                        </div>
										<div class="col-sm-10" style="padding-top:10px">
											<label>Alamat Pelanggan<span class="required" aria-required="true">*</span></label>
											<textarea id="client_address" class="form-control" rows="4" name="client_address" readonly=""></textarea>
										</div>
										<div class="col-sm-10" style="padding-top:10px">
											<label>Jenis Pekerjaan<span class="required" aria-required="true">*</span></label>
											<input type="text" class="form-control" name="jobs_type" required="" value=""/>
										</div>									
                                    </div>
                                    <div class="table-responsive" style="padding-top:10px">
                                        <table id="table-product" class="table table-bordered table-striped table-condensed text-center">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
													<th width="25%">Penawaran</th>														
                                                    <th width="25%">Produk</th>
                                                    <th width="10%">Volume</th>
                                                    <th width="10%">Satuan</th>
                                                    <th width="10%">Harga Satuan</th>
                                                    <th width="15%">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>
                                                        <select name="penawaran_1" id="penawaran-1" class="form-control form-control form-select2" onchange="changeData(1)" required="">
                                                            <option value="">Pilih Penawaran</option>
                                                            <?php
                                                            if(!empty($penawaran)){
                                                                foreach ($penawaran as $row) {
                                                                    ?>
                                                                    <option value="<?php echo $row['penawaran_id'];?>" data-product="<?= $row['product_id'];?>" data-satuan="<?= $row['satuan'];?>" data-harga="<?php echo $row['harga'];?>" data-tax="<?php echo $row['tax'];?>" data-pajak="<?php echo $row['pajak'];?>" data-nama_produk="<?= $row['nama_produk'];?>" data-satuan="<?= $row['satuan'];?>"><?php echo $row['nomor'];?> (<?php echo number_format($row['harga'],0,',','.');?>)</option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
														<input type="hidden" name="product_1" id="product-1" class="form-control input-sm text-center" onchange="changeData(1)" required="" readonly=""/>
													<td>
                                                        <input type="text" name="nama_produk_1" id="nama_produk-1" class="form-control input-sm text-center" onchange="changeData(1)" readonly=""/>
                                                    </td> 
                                                    <td>
                                                        <input type="text" name="qty_1" id="qty-1" class="form-control numberformat input-sm text-center" onchange="changeData(1)" required=""/>
                                                    </td>                                                   
                                                    <td>
                                                        <input type="text" name="measure_1" id="measure-1" class="form-control input-sm text-center" onchange="changeData(1)" readonly=""/>
                                                    </td> 
													<td>
                                                        <input type="text" min="0" name="price_1" id="price-1" class="form-control numberformat tex-left input-sm text-right" onchange="changeData(1)" readonly=""/>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="total_1" id="total-1" class="form-control numberformat tex-left input-sm text-right" readonly=""/>
                                                    </td>	
													<input type="text" name="tax_1" id="tax-1" class="form-control tex-left input-sm text-right" onchange="changeData(1)"/>
                                                    <input type="text" name="pajak_1" id="pajak-1" class="form-control tex-left input-sm text-right" onchange="changeData(1)"/>   
												</tr>
                                            </tbody>
                                        </table>    
                                    </div>

                                    <div class="row">
										 <div class="col-sm-12">
                                            <button type="button" class="btn btn-primary" onclick="tambahData()" style="font-weight:bold; border-radius:10px;>
                                                <i class="fa fa-plus"></i> Tambah Data
                                            </button>
                                        </div>
										
										<div class="col-sm-12" style="padding-top:10px">
											<label>Memo</label>
											<textarea class="form-control" name="memo" data-required="false" id="about_text">

											</textarea>
										</div>                                      
										
                                        <div class="col-sm-4" style="padding-top:10px">
                                            <div class="form-group">
                                                <label>Lampiran</label>
                                                <input type="file" class="form-control" name="files[]"  multiple="" />
                                            </div>
                                        </div>
                                        
										<!-- TOTAL -->
										
										<input type="hidden" id="sub-total" value="0">
										<input type="hidden" id="sub-total-val" name="sub_total" value="0">
											
										<?php
										if(!empty($taxs)){
											foreach ($taxs as $row) {
												?>                                                   
												<input type="hidden" id="tax-total-<?php echo $row['id'];?>" value="0">
												<input type="hidden" id="tax-val-<?php echo $row['id'];?>" name="tax_val_<?php echo $row['id'];?>" value="0">
												<?php
											}
										}
										?>

                                        <?php
                                        if(!empty($taxs)){
                                            foreach ($taxs as $row) {
                                                ?>
                                                <input type="hidden" id="pajak-total-<?php echo $row['id'];?>" value="0">
                                                <input type="hidden" id="pajak-val-<?php echo $row['id'];?>" name="pajak_val_<?php echo $row['id'];?>" value="0">
                                                <?php
                                            }
                                        }
                                        ?>
										
										<input type="hidden" id="total" value="0">
										<input type="hidden" id="total-val" name="total" value="0">
										<input type="hidden" name="total_product" id="total-product" value="1">
										
                                    </div>
                                    <br /><br />
                                    <div class="text-center">
                                        <a href="<?php echo site_url('admin/penjualan');?>" class="btn btn-danger" style="margin-bottom:0px; font-weight:bold; border-radius:10px;">BATAL</a>
                                        <button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;"> KIRIM</button>
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
    <script src="https://momentjs.com/downloads/moment.js"></script>

    <script type="text/javascript">
        
        $('.form-select2').select2();


        $('input.numberformat').number( true, 2,',','.' );

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

        function tambahData()
        {
            var number = parseInt($('#total-product').val()) + 1;

            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('penjualan/add_product_po'); ?>/"+Math.random(),
                data: {no:number},
                success : function(result){
                    $('#table-product tbody').append(result);
                    $('#total-product').val(parseInt(number));
                }
            });
        }

        $('#client').change(function(){
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('penjualan/get_client_address'); ?>/"+Math.random(),
                data: {id:$(this).val()},
                success : function(result){
                    $('#client_address').val(result);
                }
            });
        });

        function changeData(id)
        {
            var penawaran = $('#penawaran-'+id).val();
            var product_price = $('#penawaran-'+id+' option:selected').attr('data-price');
			
			var product = $('#penawaran-'+id+' option:selected').attr('data-product');
			var nama_produk = $('#penawaran-'+id+' option:selected').attr('data-nama_produk');
            var satuan = $('#penawaran-'+id+' option:selected').attr('data-satuan');
			var price = $('#penawaran-'+id+' option:selected').attr('data-harga');
			var tax = $('#penawaran-'+id+' option:selected').attr('data-tax');
            var pajak = $('#penawaran-'+id+' option:selected').attr('data-pajak');
            var qty = $('#qty-'+id).val();
            var total = $('#total-'+id).val();
            
            $('.tax-group').hide();
			
			$('#product-'+id).val(product);
			$('#nama_produk-'+id).val(nama_produk);
            $('#measure-'+id).val(satuan);
			$('#price-'+id).val(price);
			$('#tax-'+id).val(tax);
            $('#pajak-'+id).val(pajak);
            
            if(penawaran == ''){
                alert('Pilih Penawaran Terlebih dahulu');
            }else {
                if(qty == '' || qty == 0){
                    $('#qty-'+id).val(1);
                    qty = $('#qty-'+id).val();
                }

                // $('#price-'+id).val(product_price);
                total = ( qty * price);
                $('#total-'+id).val(total);
                getTotal();

            }
        }

        function getTotal()
        {
            var total_product = $('#total-product').val();
            var tax_total = $('#tax-val').val();
            var pajak_total = $('#pajak-val').val();

            $('#sub-total-val').val(0);
            $('#tax-val-3').val(0);
            $('#tax-val-4').val(0);
            $('#tax-val-5').val(0);
            $('#tax-val-6').val(0);
            $('#tax-val-7').val(0);
            $('#pajak-val-3').val(0);
            $('#pajak-val-4').val(0);
            $('#pajak-val-5').val(0);
            $('#pajak-val-6').val(0);
            $('#pajak-val-7').val(0);

            var sub_total = $('#sub-total-val').val();
            var tax_3 = $('#tax-val-3').val();
            var tax_4 = $('#tax-val-4').val();
            var tax_5 = $('#tax-val-5').val();
            var tax_6 = $('#tax-val-6').val();
            var tax_7 = $('#tax-val-7').val();
            var pajak_3 = $('#pajak-val-3').val();
            var pajak_4 = $('#pajak-val-4').val();
            var pajak_5 = $('#pajak-val-5').val();
            var pajak_6 = $('#pajak-val-6').val();
            var pajak_7 = $('#pajak-val-7').val();
            var total_total = $('#total-val').val();

            for (var i = 1; i <= total_product; i++) {

                // console.log()
                // console.log($('#total-'+i).val());
                var tax = $('#tax-'+i).val();
                var pajak = $('#pajak-'+i).val();
                if($('#total-'+i).val() > 0){
                    sub_total = parseInt(sub_total) + parseInt($('#total-'+i).val());
                }

                if(tax == 3){
                    $('#tax-total-3').show();
                    tax_3 = parseInt(tax_3) + (parseInt($('#total-'+i).val()) * 10) / 100 ;
                }
                if(tax == 4){
                    $('#tax-total-4').show();
                    tax_4 = parseInt(tax_4) + (parseInt($('#total-'+i).val()) * 0) / 100 ;
                }
                if(tax == 5){
                    $('#tax-total-5').show();
                    tax_5 = parseInt(tax_5) + (parseInt($('#total-'+i).val()) * 2) / 100 ;
                }
                if(tax == 6){
                    $('#tax-total-6').show();
                    tax_6 = parseInt(tax_6) + (parseInt($('#total-'+i).val()) * 11) / 100 ;
                }
                if(tax == 7){
                    $('#tax-total-7').show();
                    tax_7 = parseInt(tax_7) + (parseInt($('#total-'+i).val()) * 1.5) / 100 ;
                }
                if(pajak == 3){
                    $('#pajak-total-3').show();
                    pajak_3 = parseInt(pajak_3) + (parseInt($('#total-'+i).val()) * 10) / 100 ;
                }
                if(pajak == 4){
                    $('#pajak-total-4').show();
                    pajak_4 = parseInt(pajak_4) + (parseInt($('#total-'+i).val()) * 0) / 100 ;
                }
                if(pajak == 5){
                    $('#pajak-total-5').show();
                    pajak_5 = parseInt(pajak_5) + (parseInt($('#total-'+i).val()) * 2) / 100 ;
                }
                if(pajak == 6){
                    $('#pajak-total-6').show();
                    pajak_6 = parseInt(pajak_6) + (parseInt($('#total-'+i).val()) * 11) / 100 ;
                }
                if(pajak == 7){
                    $('#pajak-total-7').show();
                    pajak_7 = parseInt(pajak_7) + (parseInt($('#total-'+i).val()) * 1.5) / 100 ;
                }

            }
            $('#sub-total-val').val(sub_total);
            $('#sub-total').text($.number( sub_total, 0,',','.' ));


            $('#tax-val-3').val(tax_3);
            $('#tax-total-3 h5').text($.number( tax_3, 2,',','.' ));

            $('#tax-val-4').val(tax_4);
            $('#tax-total-4 h5').text($.number( tax_4, 2,',','.' ));

            $('#tax-val-5').val(tax_5);
            $('#tax-total-5 h5').text($.number( tax_5, 2,',','.' ));

            $('#tax-val-6').val(tax_6);
            $('#tax-total-6 h5').text($.number( tax_6, 2,',','.' ));

            $('#tax-val-7').val(tax_7);
            $('#tax-total-7 h5').text($.number( tax_7, 2,',','.' ));

            $('#pajak-val-3').val(pajak_3);
            $('#pajak-total-3 h5').text($.number( pajak_3, 2,',','.' ));

            $('#pajak-val-4').val(pajak_4);
            $('#pajak-total-4 h5').text($.number( pajak_4, 2,',','.' ));

            $('#pajak-val-5').val(pajak_5);
            $('#pajak-total-5 h5').text($.number( pajak_5, 2,',','.' ));

            $('#pajak-val-6').val(pajak_6);
            $('#pajak-total-6 h5').text($.number( pajak_6, 2,',','.' ));

            $('#pajak-val-7').val(pajak_7);
            $('#pajak-total-7 h5').text($.number( pajak_7, 2,',','.' ));

            total_total = parseInt(sub_total) + parseInt(tax_3) - parseInt(tax_4) - parseInt(tax_5) - parseInt(tax_7) + parseInt(tax_6) + parseInt(pajak_3) - parseInt(pajak_4) - parseInt(pajak_5) - parseInt(pajak_7) + parseInt(pajak_6);
            $('#total-val').val(total_total);
            $('#total').text($.number( total_total, 0,',','.' ));
        }

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
