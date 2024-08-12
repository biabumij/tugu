<!doctype html>
<html lang="en" class="fixed">

<head>
    <?php echo $this->Templates->Header(); ?>

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
                                    <h3><b>EDIT TAGIHAN PEMBELIAN</b></h3>
                                </div>
                            </div>
                            <div class="panel-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered text-center" id="main-table" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Rekanan</th>
                                                <th>Tanggal Invoice</th>
                                                <th>Nomor Invoice</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        </tbody>
                                        
                                    </table>
                                </div>
                                <br /><br />
                                <div class="text-center">
                                    <a href="<?= site_url('pembelian/penagihan_pembelian_detail/'.$row['id']);?>" class="btn btn-info" style="width:15%; font-weight:bold; border-radius:10px;"> KEMBALI</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalFormMain" role="dialog">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title">Form Edit Tagihan</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" style="padding: 0 10px 0 20px;" >
                        <input type="hidden" id="id" value="<?= $row['id'] ?>">
                        <input type="hidden" id="penagihan_id" name="penagihan_id" class="form-control" required="" autocomplete="off" />
                        <div class="form-group">
                            <label>Rekanan</label>
                            <input type="text" id="nama" name="nama" class="form-control" required="" readonly="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Invoice</label>
                            <input type="text" id="tanggal_invoice" name="tanggal_invoice" class="form-control dtpicker" required="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Nomor Invoice</label>
                            <input type="text" id="nomor_invoice" name="nomor_invoice" class="form-control" required="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="btn-form" style="font-weight:bold; border-radius:10px;"><i class="fa fa-send"></i> Update Tagihan</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-weight:bold; border-radius:10px;">Close</button>
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

    var table = $('#main-table').DataTable( {
        ajax: {
            processing: true,
            serverSide: true,
            url: '<?php echo site_url('pembelian/main_table');?>',
            type : 'POST',
            data: function ( d ) {
                d.id = $('#id').val();
            }
        },
        columns: [
            { "data": "nama" },
            { "data": "tanggal_invoice" },
            { "data": "nomor_invoice" },
            { "data": "actions" },
        ],
        responsive: true,
        searching: false,
        lengthChange: false,
        "columnDefs": [
            {
                "targets": [0],
                "className": 'text-center',
            },
            {
                "targets": [1],
                "className": 'text-right',
            }
        ],
    });

    function OpenFormMain(id='')
        {   
            
            $('#modalFormMain').modal('show');
            $('#id').val('');
            // table_detail.ajax.reload();
            if(id !== ''){
                $('#id').val(id);
                getDataMain(id);
            }
        }

        function getDataMain(id)
        {
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('pembelian/get_tagihan_main'); ?>",
                dataType : 'json',
                data: {id:id},
                success : function(result){
                    if(result.output){
                        $('#penagihan_id').val(result.output.id).trigger('change');
                        $('#nama').val(result.output.nama);
                        $('#tanggal_invoice').val(result.output.tanggal_invoice);
                        $('#nomor_invoice').val(result.output.nomor_invoice);
                        
                    }else if(result.err){
                        bootbox.alert(result.err);
                    }
                }
            });
        }

        $('#modalFormMain form').submit(function(event){
            $('#btn-form').button('loading');
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('pembelian/update_tagihan_main'); ?>/"+Math.random(),
                dataType : 'json',
                data: $(this).serialize(),
                success : function(result){
                    $('#btn-form').button('reset');
                    if(result.output){
                        $("#modalFormMain form").trigger("reset");
                        $('#modalFormMain').modal('hide');
                        window.location.reload('');
                    }else if(result.err){
                        bootbox.alert(result.err);
                    }
                }
            });

            event.preventDefault();
            
        });

    </script>


</body>

</html>