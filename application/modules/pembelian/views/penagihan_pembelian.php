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
                                    <h3><b>TAGIHAN PEMBELIAN</b></h3>
                                </div>
                            </div>
                            <form id="form-po" action="<?= base_url("pembelian/submit_penagihan_pembelian") ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="surat_jalan" value="<?= $id;?>">
                            <div class="panel-content">
                            <table class="table table-striped table-bordered" width="100%">
                                        <tr>
                                            <th width="35%" align="left">Rekanan</th>
                                            <th width="65%" align="left"><label class="label label-default" style="font-size:14px;"><?= $po["supplier_name"] ?></label>
                                            <input type="hidden" name="supplier_name" value="<?= $po['supplier_name'];?>">
                                            <input type="hidden" name="supplier_id" value="<?= $po['supplier_id'];?>">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Alamat Rekanan</th>
                                            <th style="font-weight:normal;"><textarea class="form-control" name="alamat_pelanggan" rows="5" readonly=""><?= $po['supplier_address'];?></textarea></th>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pesanan Pembelian</th>
                                            <th style="font-weight:normal;"><input type="text" class="form-control" name="tanggal_po" required="" value="<?= date("d-m-Y", strtotime($po['date_po'])) ?>" required="" readonly=""/></th>
                                        </tr>
                                        <tr>
                                            <th>Nomor Pesanan Pembelian</th>
                                            <th style="font-weight:normal;"><input type="text" class="form-control" name="no_po" value="<?= $po['no_po'];?>" readonly="">
                                            <input type="hidden" name="purchase_order_id" value="<?= $po['id'];?>">
                                            </th>
                                        </tr>
                                    </table>

                                    <table class="table table-striped table-bordered" width="100%">
                                        <tr>
                                            <th width="35%" align="left">Tanggal Invoice<span class="required" aria-required="true">*</span></th>
                                            <th width="65%" align="left" style="font-weight:normal;"><input type="text" class="form-control dtpicker" name="tanggal_invoice" id="tanggal_invoice" required="" ></th>
                                        </tr>
                                        <tr>
                                            <th>Nomor Invoice<span class="required" aria-required="true">*</span></th>
                                            <th style="font-weight:normal;"><input type="text" class="form-control" name="nomor_invoice" required=""/></th>
                                        </tr>
                                        <tr>
                                            <th>Syarat Pembayaran<span class="required" aria-required="true">*</span><br>(Ketik Angka Saja, Tanpa Hari)</th>
                                            <th style="font-weight:normal;"><input type="text" class="form-control" name="syarat_pembayaran" id="syarat_pembayaran" value="<?= $po['syarat_pembayaran'];?>" required=""/></th>
                                        </tr>
                                        </tr>
                                    </table>
                                    <br /><br />
                                    <div class="table-responsive">
                                        <table id="table-product" class="table table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th width="5%" class="text-center">No.</th>
                                                    <th width="30%" class="text-left">Produk</th>
                                                    <th class="text-right">Volume</th>
                                                    <th class="text-center">Satuan</th>
                                                    <th class="text-right">Harga Satuan</th>
                                                    <th class="text-right">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
													$sub_total = 0;
													$tax_pph = 0;
													$tax_ppn = 0;
													$tax_0 = false;
                                                    $tax_ppn11 = 0;
                                                    $pajak_pph = 0;
													$pajak_ppn = 0;
													$pajak_0 = false;
                                                    $pajak_ppn11 = 0;
													$total = 0;
                                                    ?>
													<?php foreach($details as $key => $row) { ?>
                                                    <input type="hidden" name="receipt_material_id_<?= $key+1; ?>"   value="<?= $row['id'];?>" />

                                                    <input type="hidden" name="material_id_<?= $key+1; ?>" value="<?= $row['material_id'];?>"  />
                                                <tr>
                                                    <td class="text-center"><?= $key+1 ?>.</td>
                                                    <td class="text-left"><?= $row['material_name']; ?></td>
                                                    <td class="text-right">
                                                        <?= $this->filter->Rupiah($row['volume']); ?>
                                                        <input type="hidden" min="0" name="qty_<?= $key+1; ?>" id="qty-<?= $key; ?>" value="<?= $row['volume'];?>" class="form-control input-sm text-center" required="" readonly />
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $row['measure']; ?>
                                                        <input type="hidden" name="measure_<?= $key+1; ?>" id="measure-<?= $key; ?>" class="form-control input-sm text-center" value="<?= $row['measure'];?>" readonly=""  />
                                                    </td>
                                                    <td class="text-right">
                                                        <?= number_format($row['harga_satuan'],0,',','.'); ?>
                                                        <input type="hidden" name="price_<?= $key+1; ?>" id="price-<?= $key; ?>"  class="form-control input-sm text-center" value="<?= $this->filter->Rupiah($row['harga_satuan']); ?>" readonly="" />
                                                    </td>
                                                    <td class="text-right">
                                                        <?= number_format($row['harga_satuan'] * $row['volume'],0,',','.'); ?>
                                                        <input type="hidden" name="total_<?= $key+1; ?>" id="total-<?= $key; ?>" class="form-control input-sm text-right" value="<?= $this->filter->Rupiah($row["price"] * $row['volume']); ?>" readonly="" />
                                                    </td>
														<input type="hidden" name="tax_id_<?= $key+1; ?>" id="tax-id-<?= $key; ?>" class="form-control" value="<?= $row['tax_id'];?>" readonly =""/>
                                                        <input type="hidden" name="pajak_id_<?= $key+1; ?>" id="pajak-id-<?= $key; ?>" class="form-control" value="<?= $row['pajak_id'];?>" readonly =""/>

                                                </tr>
                                                <?php
                                                    $sub_total += ($row['harga_satuan'] * $row['volume']);
													
													if($row['tax_id'] == 4){
														$tax_0 = false;
													}
													if($row['tax_id'] == 3){
														$tax_ppn = $sub_total * 10 / 100;
													}
													if($row['tax_id'] == 5){
														$tax_pph = $sub_total * 2 / 100;
													}
                                                    if($row['tax_id'] == 6){
														$tax_ppn11 = $sub_total * 11 / 100;
													}
                                                    if($row['pajak_id'] == 4){
														$pajak_0 = false;
													}
													if($row['pajak_id'] == 3){
														$pajak_ppn = $sub_total * 10 / 100;
													}
													if($row['pajak_id'] == 5){
														$pajak_pph = $sub_total * 2 / 100;
													}
                                                    if($row['pajak_id'] == 6){
														$pajak_ppn11 = $sub_total * 11 / 100;
													}
													
													$total = $sub_total + ($tax_ppn - $tax_pph + $tax_ppn11) + ($pajak_ppn - $pajak_pph + $pajak_ppn11);
                                                }
                                                ?>
                                            </tbody>
                                        </table>    
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Memo</label>
                                                <textarea class="form-control" name="memo" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Lampiran</label>
                                                <input type="file" class="form-control" name="files[]"  multiple="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-8 form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-7 control-label">Sub Total</label>
													<div class="col-sm-5 text-right">
														<label><?= number_format($sub_total,0,',','.'); ?></label>													
															<input type="hidden" name="total_1" value="<?= $sub_total;?>">
													</div>
                                            </div>
                                            <?php
												if($tax_ppn > 0){
													?>
													<div class="form-group">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (PPN 10%)</label>
															<div class="col-sm-5 text-right">
																<label><?= number_format($tax_ppn,0,',','.'); ?></label>
																	<input type="hidden" id="tax_1" name="tax_1" value="<?= $tax_ppn;?>">
															</div>
													</div>
                                                    <?php
												}
											?>
											<?php
												if($tax_0 > 0){
													?>
													<div class="form-group">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (Pajak 0%)</label>
															<div class="col-sm-5 text-right">
																<label><?= number_format($tax_0,0,',','.'); ?></label>
																	<input type="hidden" id="tax_1" name="tax_1" value="<?= $tax_0;?>">
															</div>
													</div>                                                  
                                                    <?php
												}
											?>
											<?php
												if($tax_pph > 0){
													?>
													<div class="form-group">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (PPh 23)</label>
															<div class="col-sm-5 text-right">															
																<label><?= number_format($tax_pph,0,',','.'); ?></label>
																	<input type="hidden" id="tax_1" name="tax_1" value="<?= $tax_pph;?>">
															</div>
													</div>
                                                    <?php
												}
											?>
                                            <?php
												if($tax_ppn11 > 0){
													?>
													<div class="form-group">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (PPN 11%)</label>
															<div class="col-sm-5 text-right">
																<label><?= number_format($tax_ppn11,0,',','.'); ?></label>
																	<input type="hidden" id="tax_1" name="tax_1" value="<?= $tax_ppn11;?>">
															</div>
													</div>
                                                    <?php
												}
											?>
                                            <?php
												if($pajak_ppn > 0){
													?>
													<div class="form-group">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (2) - (PPN 10%)</label>
															<div class="col-sm-5 text-right">
																<label><?= number_format($pajak_ppn,0,',','.'); ?></label>
																	<input type="hidden" id="pajak_1" name="pajak_1" value="<?= $pajak_ppn;?>">
															</div>
													</div>
                                                    <?php
												}
											?>
											<?php
												if($pajak_0 > 0){
													?>
													<div class="form-group">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (2) - (Pajak 0%)</label>
															<div class="col-sm-5 text-right">
																<label><?= number_format($pajak_0,0,',','.'); ?></label>
																	<input type="hidden" id="pajak_1" name="pajak_1" value="<?= $pajak_0;?>">
															</div>
													</div>                                                  
                                                    <?php
												}
											?>
											<?php
												if($pajak_pph > 0){
													?>
													<div class="form-group">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (2) - (PPh 23)</label>
															<div class="col-sm-5 text-right">															
																<label><?= number_format($pajak_pph,0,',','.'); ?></label>
																	<input type="hidden" id="pajak_1" name="pajak_1" value="<?= $pajak_pph;?>">
															</div>
													</div>
                                                    <?php
												}
											?>
                                            <?php
												if($pajak_ppn11 > 0){
													?>
													<div class="form-group">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (2) - (PPN 11%)</label>
															<div class="col-sm-5 text-right">
																<label><?= number_format($pajak_ppn11,0,',','.'); ?></label>
																	<input type="hidden" id="pajak_1" name="pajak_1" value="<?= $pajak_ppn11;?>">
															</div>
													</div>
                                                    <?php
												}
											?>
                                            <div class="form-group">
                                                <label class="col-sm-7 control-label">Total</label>
													<div class="col-sm-5 text-right">
														<label id="total" ><?= number_format($total,0,',','.'); ?></label>
															<input type="hidden" id="total-val" name="total" value="<?= $total;?>">
													</div>
                                            </div>
                                            <input type="hidden" name="total_product" id="total-product" value="<?= $key+1 ?>">
											<div class="form-group">
                                                <label class="col-sm-7 control-label">DP/ Muka</label>
                                                <div class="col-sm-5 text-right">
                                                    <input type="text" id="uang-muka" class="form-control numberformat text-right" name="uang_muka" >
                                                    <div id="dp-form" style="margin-top:10px;display: none;">
                                                        <select id="bayar_dari_dp" name="bayar_dari_dp" class="form-control" style="margin-bottom: 10px" >
                                                            <option value="">Bayar Dari</option>
                                                            <?php
                                                            if(!empty($setor_bank)){
                                                                foreach ($setor_bank as  $sb) {
                                                                    ?>
                                                                    <option value="<?= $sb['id'];?>"><?= $sb['coa'];?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>  
                                                        </select>
                                                        <input type="text" id="nomor_transaksi_dp" class="form-control" name="nomor_transaksi_dp" placeholder="Nomor Transaksi" >
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-7 control-label">Sisa Tagihan</label>
                                                <div class="col-sm-5 text-right">
                                                    <input type="text" id="total-tagihan" class="form-control numberformat text-right" name="total_tagihan" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br /><br />
                                    <div class="text-center">
                                        <a href="<?= site_url('admin/pembelian');?>" class="btn btn-danger" style="margin-bottom:0px; font-weight:bold; border-radius:10px;"> BATAL</a>
                                        <button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;"> KIRIM</button>
                                    </div>
                                </form>
                            </div>
                            </form>
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

        $('input.numberformat').number( true, 0,',','.' );
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

        function changeData(id)
        {
            var product = $('#product-'+id).val();
            // var product_price = $('#product-'+id).attr('data-price');
            var qty = $('#qty-'+id).val();
            var price = $('#price-'+id).val();
            var tax = $('#tax-'+id).val();
            var pajak = $('#pajak-'+id).val();
            var total = $('#total-'+id).val();

            
            $('.tax-group').hide();
            
            if(product == ''){
                alert('Pilih Produk Terlebih dahulu');
            }else {

                if(qty == '' || qty == 0){
                    $('#qty-'+id).val(1);
                    qty = $('#qty-'+id).val();
                }

                // $('#price-'+id).val(price);
                total = ( qty * price);
                $('#total-'+id).val(total);
                getTotal();

            }
        }


        function getTotal()
        {
            // alert('áaaa');

            var total_product = $('#total-product').val();
            $('#sub-total-val').val(0);
            $('#tax-val-3').val(0);
            $('#tax-val-4').val(0);
            $('#tax-val-5').val(0);
            $('#tax-val-6').val(0);
            $('#pajak-val-3').val(0);
            $('#pajak-val-4').val(0);
            $('#pajak-val-5').val(0);
            $('#pajak-val-6').val(0);
            var sub_total = $('#sub-total-val').val();
            var tax_3 = $('#tax-val-3').val();
            var tax_4 = $('#tax-val-4').val();
            var tax_5 = $('#tax-val-5').val();
            var tax_6 = $('#tax-val-6').val();
            var pajak_3 = $('#pajak-val-3').val();
            var pajak_4 = $('#pajak-val-4').val();
            var pajak_5 = $('#pajak-val-5').val();
            var pajak_6 = $('#pajak-val-6').val();
            var total_total = $('#total-val').val();
            
            for (var i = 0; i <= total_product; i++) {
                // $('#measure-'+i).val('M3');
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
                    tax_5 = parseInt(tax_6) + (parseInt($('#total-'+i).val()) * 11) / 100 ;
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
                
            }
            $('#sub-total-val').val(sub_total);
            $('#sub-total').text($.number( sub_total, 2,',','.' ));


            $('#tax-val-3').val(tax_3);
            $('#tax-total-3  label.label-show').text($.number( tax_3, 2,',','.' ));

            $('#tax-val-4').val(tax_4);
            $('#tax-total-4 label.label-show').text($.number( tax_4, 2,',','.' ));

            $('#tax-val-5').val(tax_5);
            $('#tax-total-5 label.label-show').text($.number( tax_5, 2,',','.' ));

            $('#tax-val-6').val(tax_5);
            $('#tax-total-6 label.label-show').text($.number( tax_6, 2,',','.' ));

            $('#pajak-val-3').val(pajak_3);
            $('#pajak-total-3 h5').text($.number( pajak_3, 2,',','.' ));

            $('#pajak-val-4').val(pajak_4);
            $('#pajak-total-4 h5').text($.number( pajak_4, 2,',','.' ));

            $('#pajak-val-5').val(pajak_5);
            $('#pajak-total-5 h5').text($.number( pajak_5, 2,',','.' ));

            $('#pajak-val-6').val(pajak_6);
            $('#pajak-total-6 h5').text($.number( pajak_6, 2,',','.' ));

            total_total = parseInt(sub_total) + (parseInt(tax_3) - parseInt(tax_4) - parseInt(tax_5) + parseInt(tax_6)) + (parseInt(pajak_3) - parseInt(pajak_4) - parseInt(pajak_5) + parseInt(pajak_6));
            $('#total-val').val(total_total);
            $('#total').text($.number( total_total, 2,',','.' ));

            var uang_muka = $('#uang-muka').val();
            var total_tagihan = total_total - uang_muka;
            $("#total-tagihan").val(total_tagihan);
        }

        $('#uang-muka').keyup(function(){
            var val = $(this).val();
            var total = $('#total-val').val();

            var total_tagihan = total - val;

            $("#total-tagihan").val(total_tagihan);
            if(val > 0){
                $('#dp-form').show();
                $('#nomor_transaksi_dp').attr('required',true);
                $('#bayar_dari_dp').attr('required',true);
            }
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
         $(document).ready(function(e) {
            $('#syarat_pembayaran').change(function(e) {
                let hari = $(this).val();

                if (hari.trim().length == 0) {
                    $('#tanggal_jatuh_tempo').val('');
                } else {
                    let invoiceDate = $('#tanggal_invoice').val();
                    let temp = invoiceDate.split("-");

                    let d = new Date();
                    d.setDate(temp[0]);
                    d.setMonth(temp[1]);
                    d.setFullYear(temp[2]);
                    d.setDate(d.getDate() + parseInt(hari));

                    $('#tanggal_jatuh_tempo').val(d.getDate() + "-" + d.getMonth() + "-" + d.getFullYear());
                }
            });
        });
    </script>


</body>
</html>
