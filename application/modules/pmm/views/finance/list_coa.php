<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>
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
    
    <?php echo $this->Templates->PageHeader();?>
    
    <?php
    $coa_category = $this->db->get_where('pmm_coa_category',array('status'=>'PUBLISH'))->result_array();
    ?>

    <div class="page-body">
        <div class="content">
            <div class="row animated fadeInUp">
                <div class="col-sm-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-header">
                            <h3 class="section-subtitle"><b>DAFTAR AKUN</b></h3>
                            <div class="text-left">
                                <a href="<?php echo site_url('admin');?>">
                                <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                            </div>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <?php
                                if(in_array($this->session->userdata('admin_group_id'), array(1,2,3,7,8))){
                                ?>
                                <div class="col-sm-2">
                                <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="javascript:void(0);" onclick="OpenForm()" style="color:white; font-weight:bold;">BUAT DAFTAR AKUN</a></button>
                                </div>
                                <br /><br /><br />
                                <?php
                                }
                                ?>
                                <form method="GET" target="_blank" action="<?php echo site_url('laporan/list_coa_print');?>">
                                    <div class="col-sm-3">
                                        <select id="filter_category" name="filter_category" class="form-control select2">
                                            <option value="">Pilih Kategori</option>
                                            <?php
                                            if(!empty($coa_category)){
                                                foreach ($coa_category as $key => $coa_c) {
                                                    ?>
                                                    <option value="<?= $coa_c['id'];?>"><?= $coa_c['coa_category'];?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-default" style="border-radius:10px;"><i class="fa fa-print"></i> <b>Print</b></button>
                                    </div>
                                    <br /><br />
                                </form>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-center" id="guest-table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Kode Akun</th>
                                            <th>Kategori Akun</th>
                                            <th>Edit</th>
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
    

    
    <script type="text/javascript">
        var form_control = '';
    </script>
    
	<?php echo $this->Templates->Footer();?>

    

    <div class="modal fade bd-example-modal-lg" id="modalForm"  role="dialog">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title"><b>BUAT DAFTAR AKUN</b></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">
                    <form class="form-horizontal" style="padding: 0 10px 0 20px;" >
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Kategori *</label>
                            <select id="coa_category" name="coa_category" class="form-control select2" required="">
                                <option value="">Pilih Kategori</option>
                                <?php
                                if(!empty($coa_category)){
                                    foreach ($coa_category as $key => $coa_c) {
                                        ?>
                                        <option value="<?= $coa_c['id'];?>"><?= $coa_c['coa_category'];?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Akun *</label>
                            <input type="text" id="coa" name="coa" class="form-control" required="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Parent</label>
                            <select id="coa_parent" class="form-control select2" name="coa_parent">
                                <option value="">Pilih Parent</option>

                            </select>
                            <input type="hidden" id="coa_parent_val">
                        </div>
                        <div class="form-group">
                            <label>Kode Akun * </label>
                            <input type="text" id="coa_number" name="coa_number" class="form-control"  autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="btn-form" style="font-weight:bold; border-radius:10px;">KIRIM</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-weight:bold; border-radius:10px;">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

	<script src="<?php echo base_url();?>assets/back/theme/vendor/bootbox.min.js"></script>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/jquery.number.min.js"></script>
    <script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $('.select2').select2();
        $('input#contract').number( true, 2,',','.' );
        var table = $('#guest-table').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('pmm/finance/table_coa');?>',
                type : 'POST',
                data: function ( d ) {
                    d.filter_category = $('#filter_category').val();
                }
            },
            columns: [
                { "data": "no" },
                { "data": "coa" },
                { "data": "coa_number" },
                { "data": "coa_category" },
                { "data": "edit" },
                { "data": "delete" },
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0, "className": 'text-center'},
            ],
            responsive: true,
        });


        $('#coa_category').change(function(){
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('pmm/finance/get_parent_coa'); ?>/"+Math.random(),
                dataType : 'json',
                data: {id:$(this).val()},
                success : function(result){

                    if(result.output){
                        $('#coa_parent').empty();
                        $('#coa_parent').select2({data:result.output});


                        $('#coa_parent').val($('#coa_parent_val').val()).trigger('change');
                        table.ajax.reload();
                    }else if(result.err){

                    }
                }
            });
        });

        $('#filter_category').change(function(){
            table.ajax.reload();
        });


        function OpenForm(id='')
        {   
            
            $('#modalForm').modal('show');
            $('#id').val('');
            // table_detail.ajax.reload();
            if(id !== ''){
                $('#id').val(id);
                getData(id);
            }
        }

        $('#modalForm form').submit(function(event){
            $('#btn-form').button('loading');
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('pmm/finance/form_coa'); ?>/"+Math.random(),
                dataType : 'json',
                data: $(this).serialize(),
                success : function(result){
                    $('#btn-form').button('reset');
                    if(result.output){
                        $("#modalForm form").trigger("reset");
                        table.ajax.reload();
                        $('#modalForm').modal('hide');
                    }else if(result.err){
                        bootbox.alert(result.err);
                    }
                }
            });

            event.preventDefault();
            
        });

        function getData(id)
        {
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('pmm/finance/get_coa'); ?>",
                dataType : 'json',
                data: {id:id},
                success : function(result){
                    if(result.output){
                        $('#id').val(result.output.id);
                        $('#coa_category').val(result.output.coa_category).trigger('change');
                        $('#coa_parent_val').val(result.output.coa_parent);
                        $('#coa').val(result.output.coa);
                        $('#coa_number').val(result.output.coa_number);
                        
                    }else if(result.err){
                        bootbox.alert(result.err);
                    }
                }
            });
        }


        function DeleteData(id) {
            bootbox.confirm("Apakah Anda yakin untuk menghapus data ini ?", function(result) {
                // console.log('This was logged in the callback: ' + result); 
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('pmm/finance/delete_akun'); ?>",
                        dataType: 'json',
                        data: {
                            id: id
                        },
                        success: function(result) {
                            if (result.output) {
                                table.ajax.reload();
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
