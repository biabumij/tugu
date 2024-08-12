<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>

    <style type="text/css">
        body{
			font-family: helvetica;
	  	}
        .table-center th{
            text-align:center;
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
                                    <h3>RAP ALAT</h3>
                                    
                                </div>
                            </div>
                            <div class="panel-content">
                                <form method="POST" action="<?php echo site_url('rap/submit_rap_alat');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                                    <div class="row">
										<div class="col-sm-3">
                                            <label>Tanggal</label>
                                            <input type="text" class="form-control dtpicker" name="tanggal_rap_alat" required="" value="" />
                                        </div>
										<div class="col-sm-6">
                                            <label>Nomor RAP</label>
                                            <input type="text" class="form-control" name="nomor_rap_alat" required="" value="<?= $this->pmm_model->GetNoRapAlat();?>">
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Masa Kontrak</label>
                                            <input type="text" class="form-control" name="masa_kontrak" required="" value="">
                                        </div>
									</div>
                                    <br />
                                    <div class="table-responsive">
                                        <table id="table-product" class="table table-bordered table-striped table-condensed table-center">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">NO.</th>
                                                    <th width="25%">URAIAN</th>
                                                    <th>VOLUME</th>
                                                    <th>SATUAN</th>
                                                    <th>PENAWARAN</th>
                                                    <th>HARGA SATUAN</th>
													<th>TOTAL</th>                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1.</td>
                                                    <td>BATCHING PLANT + GENSET</td>
													<td>
                                                    <input type="text" id="vol_batching_plant" name="vol_batching_plant" class="form-control numberformat text-right" value="" onchange="changeData(1)" required="" autocomplete="off">
                                                    </td>
                                                    <td class="text-center">M3</td>
                                                    <td class="text-center"></td>
                                                    <td>
                                                    <input type="text" name="harsat_batching_plant" id="harsat_batching_plant" class="form-control rupiahformat text-right" onchange="changeData(1)"  required=""  autocomplete="off"/>
                                                    </td>
                                                    <td>
                                                    <input type="text" name="batching_plant" id="batching_plant" class="form-control rupiahformat text-right" readonly="" value="" required=""  autocomplete="off"/>
                                                    </td>
                                                </tr>
                                                <!--<tr>
                                                    <td class="text-center"></td>
                                                    <td>PEMELIHARAAN BATCHING PLANT + GENSET</td>
													<td>
                                                    <input type="text" id="vol_pemeliharaan_batching_plant" name="vol_pemeliharaan_batching_plant" class="form-control numberformat text-right" value="" onchange="changeData(1)" required="" autocomplete="off">
                                                    </td>
                                                    <td class="text-center">M3</td>
                                                    <td class="text-center"></td>
                                                    <td>
                                                    <input type="text" name="harsat_pemeliharaan_batching_plant" id="harsat_pemeliharaan_batching_plant" class="form-control rupiahformat text-right" onchange="changeData(1)"  required=""  autocomplete="off"/>
                                                    </td>
                                                    <td>
                                                    <input type="text" name="pemeliharaan_batching_plant" id="pemeliharaan_batching_plant" class="form-control rupiahformat text-right" readonly="" value="" required=""  autocomplete="off"/>
                                                    </td>
                                                </tr>-->
                                                <tr>
                                                    <td class="text-center">2.</td>
                                                    <td>WHEEL LOADER</td>
													<td>
                                                    <input type="text" id="vol_wheel_loader" name="vol_wheel_loader" class="form-control numberformat text-right" value="" onchange="changeData(1)" required="" autocomplete="off">
                                                    </td>
                                                    <td class="text-center">M3</td>
                                                    <td class="text-center"></td>
                                                    <td>
                                                    <input type="text" name="harsat_wheel_loader" id="harsat_wheel_loader" class="form-control rupiahformat text-right" onchange="changeData(1)"  required="" autocomplete="off"/>
                                                    </td>
                                                    <td>
                                                    <input type="text" name="wheel_loader" id="wheel_loader" class="form-control rupiahformat text-right" readonly="" value="" required="" autocomplete="off"/>
                                                    </td>
                                                </tr>
                                                <!--<tr>
                                                    <td class="text-center"></td>
                                                    <td>PEMELIHARAAN WHEEL LOADER</td>
													<td>
                                                    <input type="text" id="vol_pemeliharaan_wheel_loader" name="vol_pemeliharaan_wheel_loader" class="form-control numberformat text-right" value="" onchange="changeData(1)" required="" autocomplete="off">
                                                    </td>
                                                    <td class="text-center">M3</td>
                                                    <td class="text-center"></td>
                                                    <td>
                                                    <input type="text" name="harsat_pemeliharaan_wheel_loader" id="harsat_pemeliharaan_wheel_loader" class="form-control rupiahformat text-right" onchange="changeData(1)"  required=""  autocomplete="off"/>
                                                    </td>
                                                    <td>
                                                    <input type="text" name="pemeliharaan_wheel_loader" id="pemeliharaan_wheel_loader" class="form-control rupiahformat text-right" readonly="" value="" required=""  autocomplete="off"/>
                                                    </td>
                                                </tr>-->
                                                <tr>
                                                    <td class="text-center">3.</td>
                                                    <td>TRUCK MIXER</td>
													<td>
                                                    <input type="text" id="vol_truck_mixer" name="vol_truck_mixer" class="form-control numberformat text-right" value="" onchange="changeData(1)" required="" autocomplete="off">
                                                    </td>
                                                    <td class="text-center">M3</td>
                                                    <td class="text-center">
                                                        <select id="penawaran_truck_mixer" name="penawaran_truck_mixer" class="form-control" required="">
                                                            <option value="">Pilih Penawaran</option>
                                                            <?php

                                                            foreach ($truck_mixer as $key => $tm) {
                                                                ?>
                                                                <option value="<?php echo $tm['penawaran_id'];?>" data-supplier_id="<?php echo $tm['supplier_id'];?>" data-measure="<?php echo $tm['measure'];?>" data-price="<?php echo $tm['price'];?>" data-tax_id="<?php echo $tm['tax_id'];?>" data-tax="<?php echo $tm['tax'];?>" data-pajak_id="<?php echo $tm['pajak_id'];?>" data-pajak="<?php echo $tm['pajak'];?>" data-penawaran_id="<?php echo $tm['penawaran_id'];?>" data-id_penawaran="<?php echo $tm['id_penawaran'];?>"><?php echo $tm['nama'];?> - <?php echo $tm['nomor_penawaran'];?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                    <input type="text" name="harsat_truck_mixer" id="harsat_truck_mixer" class="form-control rupiahformat text-right" onchange="changeData(1)" required="" readonly="" autocomplete="off"/>
                                                    </td>
                                                    <td>
                                                    <input type="text" name="truck_mixer" id="truck_mixer" class="form-control rupiahformat text-right" readonly="" value="" required="" readonly="" autocomplete="off"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">4.</td>
                                                    <td>BBM SOLAR</td>
													<td>
                                                    <input type="text" id="vol_bbm_solar" name="vol_bbm_solar" class="form-control numberformat text-right" value="" onchange="changeData(1)" required="" autocomplete="off">
                                                    </td>
                                                    <td class="text-center">Liter</td>
                                                    <td class="text-center">
                                                        <select id="penawaran_bbm_solar" name="penawaran_bbm_solar" class="form-control" required="">
                                                            <option value="">Pilih Penawaran</option>
                                                            <?php

                                                            foreach ($bbm_solar as $key => $bbm) {
                                                                ?>
                                                                <option value="<?php echo $bbm['penawaran_id'];?>" data-supplier_id="<?php echo $bbm['supplier_id'];?>" data-measure="<?php echo $bbm['measure'];?>" data-price="<?php echo $bbm['price'];?>" data-tax_id="<?php echo $bbm['tax_id'];?>" data-tax="<?php echo $bbm['tax'];?>" data-pajak_id="<?php echo $bbm['pajak_id'];?>" data-pajak="<?php echo $bbm['pajak'];?>" data-penawaran_id="<?php echo $bbm['penawaran_id'];?>" data-id_penawaran="<?php echo $bbm['id_penawaran'];?>"><?php echo $bbm['nama'];?> - <?php echo $bbm['nomor_penawaran'];?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                    <input type="text" name="harsat_bbm_solar" id="harsat_bbm_solar" class="form-control rupiahformat text-right" onchange="changeData(1)" required="" readonly="" autocomplete="off"/>
                                                    </td>
                                                    <td>
                                                    <input type="text" name="bbm_solar" id="bbm_solar" class="form-control rupiahformat text-right" readonly="" value="" required="" readonly="" autocomplete="off"/>
                                                    </td>
                                                </tr>				
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" class="text-right">GRAND TOTAL</td>
                                                    <td>
                                                    <input type="text" id="sub-total-val" name="sub_total" value="0" class="form-control rupiahformat tex-left text-right" readonly="">
                                                    </td>
                                                </tr> 
                                            </tfoot>
                                        </table>    
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Lampiran</label>
                                                <input type="file" class="form-control" name="files[]"  multiple="" />
                                            </div>
                                        </div>
                                    </div>
                                    <br /><br />
                                    <div class="text-center">
                                        <a href="<?= site_url('admin/rap#alat');?>" class="btn btn-danger" style="margin-bottom:0; font-weight:bold; border-radius:10px;">BATAL</a>
                                        <button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;">KIRIM</button>
                                    </div>
                                    <br /><br />
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

        $('input.numberformat').number(true, 4,',','.' );
        $('input.rupiahformat').number(true, 0,',','.' );

        $('.dtpicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns : true,
            locale: {
              format: 'DD-MM-YYYY'
            }
        });
        $('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
              $(this).val(picker.startDate.format('DD-MM-YYYY'));
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

        function changeData(id)
        {
			var vol_batching_plant = $('#vol_batching_plant').val();
            var vol_pemeliharaan_batching_plant = $('#vol_pemeliharaan_batching_plant').val();
            var vol_wheel_loader = $('#vol_wheel_loader').val();
            var vol_pemeliharaan_wheel_loader = $('#vol_pemeliharaan_wheel_loader').val();
            var vol_truck_mixer = $('#vol_truck_mixer').val();
            var vol_bbm_solar = $('#vol_bbm_solar').val();

			var harsat_batching_plant = $('#harsat_batching_plant').val();
            var harsat_pemeliharaan_batching_plant = $('#harsat_pemeliharaan_batching_plant').val();
            var harsat_wheel_loader = $('#harsat_wheel_loader').val();
            var harsat_pemeliharaan_wheel_loader = $('#harsat_pemeliharaan_wheel_loader').val();
            var harsat_truck_mixer = $('#harsat_truck_mixer').val();
            var harsat_bbm_solar = $('#harsat_bbm_solar').val();
            				
			batching_plant = ( vol_batching_plant * harsat_batching_plant );
            $('#batching_plant').val(batching_plant);
            pemeliharaan_batching_plant = ( vol_pemeliharaan_batching_plant * harsat_pemeliharaan_batching_plant );
            $('#pemeliharaan_batching_plant').val(pemeliharaan_batching_plant);
            wheel_loader = ( vol_wheel_loader * harsat_wheel_loader );
            $('#wheel_loader').val(wheel_loader);
            pemeliharaan_wheel_loader = ( vol_pemeliharaan_wheel_loader * harsat_pemeliharaan_wheel_loader );
            $('#pemeliharaan_wheel_loader').val(pemeliharaan_wheel_loader);
            truck_mixer = ( vol_truck_mixer * harsat_truck_mixer );
            $('#truck_mixer').val(truck_mixer);
            bbm_solar = ( vol_bbm_solar * harsat_bbm_solar );
            $('#bbm_solar').val(bbm_solar);
            getTotal();
        }

        function getTotal()
        {
            var sub_total = $('#sub-total-val').val();

            sub_total = parseInt($('#batching_plant').val()) + parseInt($('#wheel_loader').val()) + parseInt($('#truck_mixer').val()) + parseInt($('#bbm_solar').val());
            
            $('#sub-total-val').val(sub_total);
            $('#sub-total').text($.number( sub_total, 0,',','.' ));

            total_total = parseInt(sub_total);
            $('#total-val').val(total_total);
            $('#total').text($.number( total_total, 0,',','.' ));
        }

        $('#penawaran_truck_mixer').change(function(){
			var penawaran_id = $(this).find(':selected').data('penawaran_id');
			$('#penawaran_truck_mixer').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
			$('#harsat_truck_mixer').val(price);
			var supplier_id = $(this).find(':selected').data('supplier_id');
			$('#supplier_id_truck_mixer').val(supplier_id);
			var measure = $(this).find(':selected').data('measure');
			$('#measure_truck_mixer').val(measure);
			var tax_id = $(this).find(':selected').data('tax_id');
			$('#tax_id_truck_mixer').val(tax_id);
			var pajak_id = $(this).find(':selected').data('pajak_id');
			$('#pajak_id_truck_mixer').val(pajak_id);
			var id_penawaran = $(this).find(':selected').data('id_penawaran');
			$('#penawaran_id_truck_mixer').val(penawaran_id);
		});

        $('#penawaran_bbm_solar').change(function(){
			var penawaran_id = $(this).find(':selected').data('penawaran_id');
			$('#penawaran_bbm_solar').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
			$('#harsat_bbm_solar').val(price);
			var supplier_id = $(this).find(':selected').data('supplier_id');
			$('#supplier_id_bbm_solar').val(supplier_id);
			var measure = $(this).find(':selected').data('measure');
			$('#measure_bbm_solar').val(measure);
			var tax_id = $(this).find(':selected').data('tax_id');
			$('#tax_id_bbm_solar').val(tax_id);
			var pajak_id = $(this).find(':selected').data('pajak_id');
			$('#pajak_id_bbm_solar').val(pajak_id);
			var id_penawaran = $(this).find(':selected').data('id_penawaran');
			$('#penawaran_id_bbm_solar').val(penawaran_id);
		});

    </script>


</body>
</html>
