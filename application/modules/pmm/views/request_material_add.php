<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>

    <style type="text/css">
        body {
            font-family: helvetica;
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
    
    <?php echo $this->Templates->PageHeader();?>

    <div class="page-body">
        
        <div class="content">
            <div class="row animated fadeInUp">
                <div class="col-sm-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-header">
                            <div>
                                <h3><b>DETAIL PERMINTAAN BAHAN & ALAT <?php echo $this->pmm_model->GetStatus($data['status']);?></b></h3>
                                <div class="text-left">
                                    <a href="<?php echo site_url('admin/pembelian');?>">
                                    <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-content">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th width="15%" align="left">Rekanan</th>
                                    <td width="85% align="left"><label class="label label-default" style="font-size:14px;"><?php echo $this->crud_global->GetField('penerima',array('id'=>$data['supplier_id']),'nama');?></label></td>
                                </tr>
                                <tr>
                                    <th>No. Penawaran</th>
                                    <td><a target="_blank" href="<?= base_url("pembelian/penawaran_pembelian_detail/".$detail['penawaran_id'])?>"><?php echo $this->crud_global->GetField('pmm_penawaran_pembelian',array('id'=>$dt['penawaran_id']),'nomor_penawaran');?><?php echo $this->crud_global->GetField('pmm_penawaran_pembelian',array('id'=>$detail['penawaran_id']),'nomor_penawaran');?></a></td>
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th width="15%" align="left">No. Permintaan</th>
                                    <td width="85% align="left"><label class="label label-success" style="font-size:14px;font-weight:bold;"><?php echo $data['request_no'];?></label></td>
                                </tr>
                                <tr>
                                    <th>Subjek</th>
                                    <td><?php echo $data['subject'];?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Permintaan</th>
                                    <td><?php echo date('d/m/Y',strtotime($data['request_date']));?></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td><?php echo $this->crud_global->GetField('kategori_produk',array('id'=>$data['kategori_id']),'nama_kategori_produk');?></td>
                                </tr>
                                <tr>
                                    <th>Memo</th>
                                    <td><?php echo $data['memo'];?></td>
                                </tr>
                                <tr>
                                    <th>Dibuat Oleh</th>
                                    <td><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$data['created_by']),'admin_name');?></td>
                                </tr>
                                <tr>
                                    <th>Dibuat Tanggal</th>
                                    <td><?= date('d/m/Y H:i:s',strtotime($data['created_on']));?></td>
                                </tr>
                            </table>

                            <?php
                            if(!empty($materials_need)){
                                ?>
                                <h4>Materials Needed</h4>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Bahan</th>
                                            <th>Minggu 1</th>
                                            <th>Minggu 2</th>
                                            <th>Minggu 3</th>
                                            <th>Minggu 4</th>
                                            <th>Total</th>
                                            <th>Sisa</th>
                                            <th>Kebutuhan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($materials_need as $key => $val) {
                                            ?>
                                            <tr>
                                                <td><?php echo $key +1 ;?></td>
                                                <td><?php echo $val['material_name'];?></td>
                                                <td><?php echo $val['week_1'];?></td>
                                                <td><?php echo $val['week_2'];?></td>
                                                <td><?php echo $val['week_3'];?></td>
                                                <td><?php echo $val['week_4'];?></td>
                                                <td>
                                                    <b><?php echo $val['total'];?></b>
                                                </td>
                                                <td>
                                                    <b><?php echo $val['sisa'];?></b>
                                                </td>
                                                <td>
                                                    <b><?php echo $val['butuh'];?></b>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <hr />
                                <?php
                            }
                            ?>  
                            
                            <input type="hidden" name="request_material_id" value="<?php echo $id;?>" id="request_material_id">
                            
                            <?php
                            if($data['status'] == 'DRAFT'){
                                ?>
                                <form id="form-product" class="form-horizontal" action="<?php echo site_url('pmm/request_materials/product_process'); ?>" >
                                    <input type="hidden" name="request_material_id" value="<?php echo $id;?>">
                                    <input type="hidden" id="request_material_detail_id" name="request_material_detail_id" value="" id="request_material_id">
                                    <input type="hidden" name="supplier_id" value="<?php echo $data['supplier_id'];?>">
                                    <input type="hidden" name="penawaran_id" id="penawaran_id" value="">
									
									
									<input type="hidden" name="memo" value="">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <select id="material_id" name="material_id" class="form-control" >
                                                <option value="">Pilih Produk</option>
                                                <?php

                                                foreach ($materials as $key => $mt) {
                                                    ?>
                                                    <option value="<?php echo $mt['material_id'];?>" data-measure="<?php echo $mt['measure'];?>"data-price="<?php echo $mt['price'];?>" data-penawaran_id="<?php echo $mt['id'];?>" data-tax_id="<?php echo $mt['tax_id'];?>" data-tax="<?php echo $mt['tax'];?>" data-pajak_id="<?php echo $mt['pajak_id'];?>" data-pajak="<?php echo $mt['pajak'];?>" data-id="<?= $mt['id'];?>"><?php echo $mt['material_name'];?> (Penawaran : <?php echo $mt['nomor_penawaran'];?>)</option>?>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
										<div class="col-sm-2">
                                                <select id="price" name="price" class="form-control">
                                                <option value="">Pilih Harga</option>
                                                <?php

                                                foreach ($materials as $key => $mt) {
                                                    ?>
                                                    <option value="<?php echo $mt['price'];?>"><?php echo number_format($mt['price'],0,',','.');?></option>?>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <select id="measure_id" name="measure_id" class="form-control" required="">
                                                <option value="">Pilih Satuan</option>
                                                <?php
                                                $arr_mes = $this->db->get_where('pmm_measures',array('status'=>'PUBLISH'))->result_array();
                                                foreach ($arr_mes as $key => $mes) {
                                                    ?>
                                                    <option value="<?php echo $mes['id'];?>"><?php echo $mes['measure_name'];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>	
                                        <div class="col-sm-2">
                                            <input type="text" id="volume" name="volume" class="form-control numberformat" required="" autocomplete="off" placeholder="Volume" />
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="submit" class="btn btn-warning" id="btn-form" style="width:200px; font-weight:bold; border-radius:10px;"><i class="fa fa-plus"></i> TAMBAH PRODUK</button>
                                        </div>

                                        <input type="hidden" id="tax_id" name="tax_id" class="form-control" required="" autocomplete="off" placeholder="Tax ID" readonly=""/>
                                        <input type="hidden" id="tax" name="tax" class="form-control" required="" autocomplete="off" placeholder="Tax" readonly=""/>
                                        <input type="hidden" id="pajak_id" name="pajak_id" class="form-control" required="" autocomplete="off" placeholder="Pajak ID" readonly=""/>
                                        <input type="hidden" id="pajak" name="pajak" class="form-control" required="" autocomplete="off" placeholder="Pajak" readonly=""/>

                                    </div>
                                </form>
                                <?php
                            }
                            ?>
                            
                            <br />
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered text-center" id="guest-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="5%">No</th>
                                            <th class="text-center">Produk</th>
                                            <th class="text-center">Satuan</th>
											<th class="text-center">Harga Satuan</th>
                                            <th class="text-center">Volume</th>
                                            <th class="text-center">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                    <tfoot>
                                        <th colspan="4" style="text-align:right !important;">TOTAL : </th>
                                        <th></th>
										<th></th>
                                    </tfoot>
                                </table>
                            </div>
                            
                            <div class="text-center">
                                <br /><br /><br />
                                <?php
                                if($data['status'] == 'DRAFT'){
                                    ?>
                                    <a onclick="ProcessForm('<?php echo site_url('pmm/request_materials/process/'.$id.'/3');?>')" class="btn btn-success check-btn" style="width:200px; font-weight:bold; border-radius:10px;"> KIRIM PERMINTAAN</a>
                                    <?php
                                }else if($data['status'] == 'WAITING'){
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                        ?>
                                        <a onclick="ProcessForm('<?php echo site_url('pmm/request_materials/process/'.$id.'/1');?>')" class="btn btn-success" style="width:150px; font-weight:bold; border-radius:10px;"> SETUJUI</a>
                                        <a onclick="ProcessForm('<?php echo site_url('pmm/request_materials/process/'.$id.'/2');?>')" class="btn btn-danger check-btn" style="width:150px; font-weight:bold; border-radius:10px;"> TOLAK</a>
                                        <?php
                                    }
                                }
                                
                                ?>

                                <br /><br /><br />
                                <a href="<?php echo site_url('admin/pembelian#chart');?>" class="btn btn-info" style="width:150px; font-weight:bold; border-radius:10px;"> KEMBALI</a>
                            </div>
                            
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
    <script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
		
        $('input.numberformat').number( true, 2,',','.' );   

        var table = $('#guest-table').DataTable( {
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('pmm/request_materials/table_detail');?>',
                type : 'POST',
                data: function ( d ) {
                    d.request_material_id = $('#request_material_id').val();
                }
            },
            columns: [
                { "data": "no" },
                { "data": "material_name" },
                { "data": "measure" },
				{ "data": "price" },
                { "data": "volume" },
                { "data": "actions" },
            ],
            responsive: true,
            "columnDefs": [
                {
                    "targets": [0, 2, 3, 4, 5],
                    "className": 'text-center',
                },
                {
                    "targets": [1],
                    "className": 'text-left',
                }
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/\./g,'').replace(',', '.') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                // Total over all pages
                total = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Update footer
                $( api.column( 4 ).footer() ).html($.number( total, 2,',','.' ));
            }
        });

       
        // $('#material_id').change(function(){
        //     var koef = $('option:selected', this).attr('data-koef');
        //     $('#koef').val(koef);
        // });

        function ProcessForm(url){

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
                        window.location.href = url;
                    }
                    
                }
            });
        }
            

        $('#form-product').submit(function(event){
            $('#btn-form').button('loading');
            $.ajax({
                type    : "POST",
                url     : $(this).attr('action')+"/"+Math.random(),
                dataType : 'json',
                data: $(this).serialize(),
                success : function(result){
                    $('#btn-form').button('reset');
                    if(result.output){
                        // $("#form-product").trigger("reset");
                        // $('#product_id').val('');
                        $('#material_id').val('');
                        // $('#material_id').html('<option value="">.. Select Material ..</option>');
                        // $('#koef').val('');
                        $('#volume').val('');
                        table.ajax.reload();
                        $('#material_id').focus();
                        // bootbox.alert('Succesfully!!!');
                    }else if(result.err){
                        bootbox.alert(result.err);
                    }
                }
            });

            event.preventDefault();
            
        });

        

        function FormDetail(id,name)
        {   
            $('#schedule_product_id').val(id);
            $("#modalDetail form").trigger("reset");
            $('#modalDetail').modal('show');
            $('#title-detail').text(name);
            // table_detail.ajax.reload();  
            getDetail(id);
        }

        function DetailMaterial(id,name)
        {   
            $('#modalDetailMaterial').modal('show');
            $('#title-material').text(name);
            // table_detail.ajax.reload();  
            getMaterials(id);
        }

        function getDetail(id)
        {
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('pmm/request_materials/get_detail');?>/"+Math.random(),
                dataType : 'json',
                data: {id:id},
                success : function(result){

                    if(result.data){
                        $('#request_material_detail_id').val(result.data.id);
                        $('#material_id').val(result.data.material_id);
                        $('#price').val(result.data.price);
                        $('#measure_id').val(result.data.measure_id);
                        $('#volume').val(result.data.volume);
                    }else if(result.err){
                        bootbox.alert(result.err);
                    }
                }
            });
            $('#btn-unedit').show();
        }

        $('#btn-unedit').click(function(){
            $('#request_material_detail_id').val('');
            $('#material_id').val('');
            $('#price').val('');
            $('#measure_id').val('');
            $('#volume').val('');
            $(this).hide();
        });

        function DeleteData(id)
        {
            bootbox.confirm("Apakah Anda yakin untuk menghapus data ini ?", function(result){ 
                // console.log('This was logged in the callback: ' + result); 
                if(result){
                    $.ajax({
                        type    : "POST",
                        url     : "<?php echo site_url('pmm/request_materials/delete_detail'); ?>",
                        dataType : 'json',
                        data: {id:id},
                        success : function(result){
                            if(result.output){
                                table.ajax.reload();
                                // bootbox.alert('<b>DELETED</b>');
                            }else if(result.err){
                                bootbox.alert(result.err);
                            }
                        }
                    });
                }
            });
        }

        $('#material_id').change(function(){
            var measure = $(this).find(':selected').data('measure');
            $('#measure_id').val(measure);
			var price = $(this).find(':selected').data('price');
            $('#price').val(price);
            var penawaran_id = $(this).find(':selected').data('id');
            $('#penawaran_id').val(penawaran_id);
			var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id').val(tax_id);
			var tax = $(this).find(':selected').data('tax');
            $('#tax').val(tax);
            var pajak_id = $(this).find(':selected').data('pajak_id');
            $('#pajak_id').val(pajak_id);
			var pajak = $(this).find(':selected').data('pajak');
            $('#pajak').val(pajak);
        });

    </script>

</body>
</html>