<!doctype html>
<html lang="en" class="fixed">

<?php include 'lib.php'; ?>

<head>
    <?php echo $this->Templates->Header();?>

    <style type="text/css">
        body{
			font-family: helvetica;
	  	}
        
        .form-approval {
            display: inline-block;
        }
		
		.mytable thead th {
		  background-color: #D3D3D3;
		  /*border: solid 1px #000000;*/
		  color: #000000;
		  text-align: center;
		  vertical-align: middle;
		  padding : 10px;
		}
		
		.mytable tbody td {
		  padding: 5px;
		}
		
		.mytable tfoot th {
		  padding: 5px;
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
                            <h3><b>DETAIL KOMPOSISI AGREGAT</b></h3>
                        </div>
                        <div class="panel-content">
                            <form method="POST" action="<?php echo site_url('rap/submit_sunting_agregat');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="id" value="<?= $agregat["id"] ?>">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th width="200px">Mutu Beton / Slump</th>
                                    <td>: <?= $agregat["mutu_beton"] = $this->crud_global->GetField('produk',array('id'=>$agregat['mutu_beton']),'nama_produk');?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Volume</th>
                                    <td>: <?= $agregat["volume"]; ?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Satuan</th>
                                    <td>: <?= $agregat["measure"] = $this->crud_global->GetField('pmm_measures',array('id'=>$agregat['measure']),'measure_name');?></td>
                                </tr>
                                <tr>
                                    <th width="200px">Judul</th>
                                    <td>: <?= $agregat["jobs_type"]; ?></td>
                                </tr>
								<tr>
                                    <th >Tanggal</th>
                                     <td>: <?= convertDateDBtoIndo($agregat["date_agregat"]); ?></td>								
                                </tr>
                                <tr>
                                    <th >Lamanya Tes</th>
                                    <td>: <?= $agregat["tes"]; ?> Hari</td>
                                </tr>
                                <tr>
                                    <th width="100px">Lampiran</th>
                                    <td>:  
                                        <?php foreach($lampiran as $l) : ?>                                    
                                        <a href="<?= base_url("uploads/agregat/".$l["lampiran"]) ?>" target="_blank">Lihat bukti  <?= $l["lampiran"] ?> <br></a></td>
                                        <?php endforeach; ?>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>: <?= $agregat["memo"] ?></td>
                                </tr>
                            </table>
                            
                            <table class="mytable table-bordered table-hover table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Uraian</th>
                                        <th>Satuan</th>
                                        <th>Komposisi</th>
                                        <th>Penawaran</th>
                                        <th>Harga Satuan</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
									$total_a = 0;
									$total_b = 0;
									$total_c = 0;
									$total_d = 0;
									$total_volume = 0;
                                    ?>
									<?php
									$total = $agregat['total_a'] + $agregat['total_b'] + $agregat['total_c'] + $agregat['total_d'];
									?>
                                        <tr>
                                            <td class="text-center">1.</td>
											<td class="text-left"><?= $agregat["produk_a"] = $this->crud_global->GetField('produk',array('id'=>$agregat['produk_a']),'nama_produk'); ?></td>
											<td class="text-center"><?= $agregat["measure_a"]  = $this->crud_global->GetField('pmm_measures',array('id'=>$agregat['measure_a']),'measure_name'); ?></td>
											<td class="text-center"><input type="text" id="presentase_a" name="presentase_a" class="form-control text-center" value="<?= $agregat['presentase_a'] ?>" onchange="changeData(1)" required="" autocomplete="off"></td>
                                            <td class="text-center">
                                                <select id="penawaran_semen" class="form-control">
                                                <option value="">Pilih Penawaran</option>
                                                <?php

                                                foreach ($semen as $key => $sm) {
                                                    ?>
                                                    <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-pajak_id="<?php echo $sm['pajak_id'];?>" data-pajak="<?php echo $sm['pajak'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>" data-id_penawaran="<?php echo $sm['id_penawaran'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <td class="text-right"><input type="text" id="price_a" name="price_a" class="form-control rupiahformat text-right" value="<?= $agregat['price_a'] ?>" onchange="changeData(1)" required="" readonly="" autocomplete="off"></td>
                                            <td class="text-right"><input type="text" id="total_a" name="total_a" class="form-control rupiahformat text-right" value="<?= $agregat['total_a'] ?>" onkeyup="sum();" required="" readonly="" autocomplete="off"></td>
                                        </tr>
										<tr>
                                            <td class="text-center">2.</td>
											<td class="text-left"><?= $agregat["produk_b"] = $this->crud_global->GetField('produk',array('id'=>$agregat['produk_b']),'nama_produk'); ?></td>
											<td class="text-center"><?= $agregat["measure_b"]  = $this->crud_global->GetField('pmm_measures',array('id'=>$agregat['measure_b']),'measure_name'); ?></td>
											<td class="text-center"><input type="text" id="presentase_b" name="presentase_b" class="form-control text-center" value="<?= $agregat['presentase_b'] ?>" onchange="changeData(1)" required="" autocomplete="off"></td>
                                            <td class="text-center">
                                                <select id="penawaran_pasir" name="penawaran_pasir" class="form-control" required="">
                                                <option value="">Pilih Penawaran</option>
                                                <?php

                                                foreach ($pasir as $key => $sm) {
                                                    ?>
                                                    <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-pajak_id="<?php echo $sm['pajak_id'];?>" data-pajak="<?php echo $sm['pajak'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>" data-id_penawaran="<?php echo $sm['id_penawaran'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
                                            </td>
                                            <td class="text-right"><input type="text" id="price_b" name="price_b" class="form-control rupiahformat text-right" value="<?= $agregat['price_b'] ?>" onchange="changeData(1)" required="" readonly="" autocomplete="off"></td>
                                            <td class="text-right"><input type="text" id="total_b" name="total_b" class="form-control rupiahformat text-right" value="<?= $agregat['total_b'] ?>" onkeyup="sum();" required="" readonly="" autocomplete="off"></td>
                                        </tr>
										<tr>
                                            <td class="text-center">3.</td>
											<td class="text-left"><?= $agregat["produk_c"] = $this->crud_global->GetField('produk',array('id'=>$agregat['produk_c']),'nama_produk'); ?></td>
											<td class="text-center"><?= $agregat["measure_c"]  = $this->crud_global->GetField('pmm_measures',array('id'=>$agregat['measure_c']),'measure_name'); ?></td>
											<td class="text-center"><input type="text" id="presentase_c" name="presentase_c" class="form-control text-center" value="<?= $agregat['presentase_c'] ?>" onchange="changeData(1)" required="" autocomplete="off"></td>
                                            <td class="text-center">
                                                <select id="penawaran_1020" name="penawaran_1020" class="form-control" required="">
                                                <option value="">Pilih Penawaran</option>
                                                <?php

                                                foreach ($split_1020 as $key => $sm) {
                                                    ?>
                                                    <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-pajak_id="<?php echo $sm['pajak_id'];?>" data-pajak="<?php echo $sm['pajak'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>" data-id_penawaran="<?php echo $sm['id_penawaran'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
                                            </td>
                                            <td class="text-right"><input type="text" id="price_c" name="price_c" class="form-control rupiahformat text-right" value="<?= $agregat['price_c'] ?>" onchange="changeData(1)" required="" readonly="" autocomplete="off"></td>
                                            <td class="text-right"><input type="text" id="total_c" name="total_c" class="form-control rupiahformat text-right" value="<?= $agregat['total_c'] ?>" onkeyup="sum();" required="" readonly="" autocomplete="off"></td>
                                        </tr>
										<tr>
                                            <td class="text-center">4.</td>
											<td class="text-left"><?= $agregat["produk_d"] = $this->crud_global->GetField('produk',array('id'=>$agregat['produk_d']),'nama_produk'); ?></td>
											<td class="text-center"><?= $agregat["measure_d"]  = $this->crud_global->GetField('pmm_measures',array('id'=>$agregat['measure_d']),'measure_name'); ?></td>
											<td class="text-center"><input type="text" id="presentase_d" name="presentase_d" class="form-control text-center" value="<?= $agregat['presentase_d'] ?>" onchange="changeData(1)" required="" autocomplete="off"></td>
                                            <td class="text-center">
                                                <select id="penawaran_2030" name="penawaran_2030" class="form-control" required="">
                                                <option value="">Pilih Penawaran</option>
                                                <?php

                                                foreach ($split_2030 as $key => $sm) {
                                                    ?>
                                                    <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-pajak_id="<?php echo $sm['pajak_id'];?>" data-pajak="<?php echo $sm['pajak'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>" data-id_penawaran="<?php echo $sm['id_penawaran'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
                                            </td>
                                            <td class="text-right"><input type="text" id="price_d" name="price_d" class="form-control rupiahformat text-right" value="<?= $agregat['price_d'] ?>" onchange="changeData(1)" required="" readonly="" autocomplete="off"></td>
                                            <td class="text-right"><input type="text" id="total_d" name="total_d" class="form-control rupiahformat text-right" value="<?= $agregat['total_d'] ?>" onkeyup="sum();" required="" readonly="" autocomplete="off"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5.</td>
											<td class="text-left"><?= $agregat["produk_e"] = $this->crud_global->GetField('produk',array('id'=>$agregat['produk_e']),'nama_produk'); ?></td>
											<td class="text-center"><?= $agregat["measure_e"]  = $this->crud_global->GetField('pmm_measures',array('id'=>$agregat['measure_e']),'measure_name'); ?></td>
											<td class="text-center"><input type="text" id="presentase_e" name="presentase_e" class="form-control text-center" value="<?= $agregat['presentase_e'] ?>" onchange="changeData(1)" required="" autocomplete="off"></td>
                                            <td class="text-center">
                                                <select id="penawaran_additive" name="penawaran_additive" class="form-control">
                                                <option value="">Pilih Penawaran</option>
                                                <?php

                                                foreach ($additive as $key => $sm) {
                                                    ?>
                                                    <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-pajak_id="<?php echo $sm['pajak_id'];?>" data-pajak="<?php echo $sm['pajak'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>" data-id_penawaran="<?php echo $sm['id_penawaran'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
                                            </td>
                                            <td class="text-right"><input type="text" id="price_e" name="price_e" class="form-control rupiahformat text-right" value="<?= $agregat['price_e'] ?>" onchange="changeData(1)" readonly="" autocomplete="off"></td>
                                            <td class="text-right"><input type="text" id="total_e" name="total_e" class="form-control rupiahformat text-right" value="<?= $agregat['total_e'] ?>" onkeyup="sum();" readonly="" autocomplete="off"></td>
                                        </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right">GRAND TOTAL&nbsp;</td>
                                        <td>
                                        <input type="text" id="sub-total-val" name="sub_total" value="" class="form-control rupiahformat tex-left text-right" readonly="">
                                        </td>
                                    </tr> 
                                </tfoot>
                            </table>
                            <br />
							<br />
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <a href="<?= base_url('admin/rap/') ?>" class="btn btn-danger" style="margin-bottom:0; font-weight:bold; border-radius:10px;">BATAL</a>
                                    <button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;">KIRIM</button>
                                </div>
                            </div>
                            <br />
							<br />
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
	

	<script src="<?php echo base_url();?>assets/back/theme/vendor/bootbox.min.js"></script>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/jquery.number.min.js"></script>
    
    <script src="<?php echo base_url();?>assets/back/theme/vendor/bootbox.min.js"></script>

    <script type="text/javascript">
        $('.form-select2').select2();

        $('input.numberformat').number( true, 4,',','.' );
		$('input.rupiahformat').number( true, 0,',','.' );

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
            $('#total').text($.number( total_total,',','.' ));
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

        $(document).ready(function(){
			$('#penawaran_semen').val(<?= $agregat['penawaran_semen'];?>).trigger('change');
			$('#penawaran_pasir').val(<?= $agregat['penawaran_pasir'];?>).trigger('change');
            $('#penawaran_1020').val(<?= $agregat['penawaran_1020'];?>).trigger('change');
            $('#penawaran_2030').val(<?= $agregat['penawaran_2030'];?>).trigger('change');
            $('#penawaran_additive').val(<?= $agregat['penawaran_additive'];?>).trigger('change');
		});

    </script>

</body>
</html>
