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
                                <div class="">
                                    <h3 class="">Edit Komposisi</h3>
                                </div>
                            </div>
                            <div class="panel-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered" id="main-table" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">Rekanan</th>
                                                <th>Sales Order</th>
                                                <th>Tanggal</th>
                                                <th>Surat Jalan</th>
                                                <th>Produk</th>
                                                <th>Komposisi</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        </tbody>
                                        
                                    </table>
                                </div>

                                <?php
                                $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
                                ?>
                                <div class="text-center">
                                    <a href="<?=$url?>" class="btn btn-info" style="font-weight:bold; border-radius:10px;"><i class="fa fa-arrow-left"></i> Kembali</a>
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
                    <span class="modal-title">Form Edit Komposisi</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" style="padding: 0 10px 0 20px;" >
                        <input type="hidden" id="id" value="<?= $row['id'] ?>">
                        <input type="hidden" id="production_id" name="production_id" class="form-control" required="" autocomplete="off" />
                        <div class="form-group">
                            <label>Rekanan</label>
                            <input type="text" id="rekanan" name="rekanan" class="form-control" required="" readonly="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Sales Order</label>
                            <input type="text" id="sales_order" name="sales_order" class="form-control" required="" readonly="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" id="tanggal" name="tanggal" class="form-control dtpicker" required="" readonly="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Surat Jalan</label>
                            <input type="text" id="surat_jalan" name="surat_jalan" class="form-control" required="" readonly="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Produk</label>
                            <input type="text" id="produk" name="produk" class="form-control" required="" readonly="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Komposisi</label>
                            <select id="komposisi" class="form-control input-sm" name="komposisi">
                                <option value="">Pilih Komposisi</option>
                                <?php
                                if (!empty($komposisi)) {
                                    foreach ($komposisi as $kom) {
                                ?>
                                        <option value="<?php echo $kom['id']; ?>"><?php echo $kom['jobs_type']; ?> - (<?= date('d/F/Y',strtotime($kom['date_agregat']));?>)</option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="btn-form" style="font-weight:bold; border-radius:10px;"><i class="fa fa-send"></i> Update Komposisi</button>
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
            url: '<?php echo site_url('penjualan/main_table');?>',
            type : 'POST',
            data: function ( d ) {
                d.id = $('#id').val();
            }
        },
        columns: [
            { "data": "rekanan" },
            { "data": "sales_order" },
            { "data": "tanggal" },
            { "data": "surat_jalan" },
            { "data": "produk" },
            { "data": "komposisi" },
            { "data": "actions" },
        ],
        responsive: true,
        searching: false,
        lengthChange: false,
        "columnDefs": [
            {
                "targets": [6],
                "className": 'text-center',
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
                url     : "<?php echo site_url('penjualan/get_komposisi_main'); ?>",
                dataType : 'json',
                data: {id:id},
                success : function(result){
                    if(result.output){
                        $('#production_id').val(result.output.id).trigger('change');
                        $('#rekanan').val(result.output.client_id);
                        $('#sales_order').val(result.output.salesPo_id);
                        $('#tanggal').val(result.output.date_production);
                        $('#surat_jalan').val(result.output.no_production);
                        $('#produk').val(result.output.product_id);
                        $('#komposisi').val(result.output.komposisi_id);
                        
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
                url     : "<?php echo site_url('penjualan/update_komposisi_main'); ?>/"+Math.random(),
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