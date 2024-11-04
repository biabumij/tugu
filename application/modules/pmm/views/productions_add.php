<!doctype html>
<html lang="en" class="fixed">

<head>
    <?php echo $this->Templates->Header(); ?>

    <style type="text/css">
        body {
			font-family: helvetica;
		}
        .table-center th,
        .table-center td {
            text-align: center;
        }

        #form-pro .form-group {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="wrap">

        <?php echo $this->Templates->PageHeader(); ?>

        <div class="page-body">
            <div class="content">
                <?php
                $measure = $this->db->get_where('pmm_measures', array('status' => 'PUBLISH'))->result_array();
                ?>
                <div class="row animated fadeInUp">
                    <div class="col-sm-12 col-lg-12">
                        <div class="panel">
                            <div class="panel-header">
                                <div>
                                    <h4><b>SURAT JALAN PENGIRIMAN PENJUALAN</b></h4>
                                </div>
                            </div>
                            <div class="panel-content">
                            <form id="form-pro" method="POST" class="form-pro" action="<?php echo site_url('pmm/productions/process'); ?>" enctype="multipart/form-data" onsubmit="setTimeout(function () { window.location.reload(); }, 3000)">
                                <table class="table">
                                        <tr>
                                            <th>Pelanggan<span class="required" aria-required="true">*</span></th>
                                            <th>:</th>
                                            <td>
                                                <select id="client_id" name="client_id" class="form-control form-select2" required="">
                                                    <option value=""></option>
                                                    <?php foreach ($clients as $client) : ?>
                                                        <option value="<?= $client['id'] ?>"><?= $client['nama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="200px">No. Sales Order<span class="required" aria-required="true">*</span></th>
                                            <th width="20px">:</th>
                                            <td >
                                                <select id="po_penjualan" name="po_penjualan" class="form-control form-select2" required="">
                                                <option value=""></option>
                                                    <?php foreach ($contract_number as $po) : ?>
                                                        <option value="<?= $po['id'] ?>"><?= $po['contract_number'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                    <div id="alert-receipt-material-total" class="row"></div>
                                    <input type="hidden" name="id" id="id">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">Tanggal<span class="required" aria-required="true">*</span></i></label>
                                                <input type="text" id="date" name="date" class="form-control dtpicker" value="<?php echo date('d-m-Y'); ?>" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">No. Surat Jalan<span class="required" aria-required="true">*</span></label>
                                                <input type="text" class="form-control" id="no_production" name="no_production" placeholder="No. Surat Jalan" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">No. Kendaraan<span class="required" aria-required="true">*</span></label>
                                                <input type="text" id="nopol_truck" name="nopol_truck" class="form-control" value="" placeholder="No. Kendaraan" required="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">Supir<span class="required" aria-required="true">*</span></label>
                                                <input type="text" id="driver" name="driver" class="form-control" value="" placeholder="Supir" required="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <br /><br />
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">Produk<span class="required" aria-required="true">*</span></label>
                                                <select id="product_id" name="product_id" class="form-control form-select2" required="">
                                                <option value="">Pilih Produk</option>
                                                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2" id="test">
                                            <div class="form-group">
                                                <input type="hidden" id="tax_id" name="tax_id" class="form-control" value="" required="" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">Komposisi<span class="required" aria-required="true">*</span></label>
                                                <select id="komposisi_id" class="form-control input-sm" name="komposisi_id" required="">
                                                    <option value="">Pilih Komposisi</option>
                                                    <?php
                                                    if (!empty($komposisi)) {
                                                        foreach ($komposisi as $kom) {
                                                    ?>
                                                            <option value="<?php echo $kom['id']; ?>"><?php echo $kom['jobs_type']; ?><!-- - (<?= date('d/F/Y',strtotime($kom['date_agregat']));?>)--></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">Lokasi Pengiriman<span class="required" aria-required="true">*</span></label>
                                                <input type="text" id="lokasi" name="lokasi" class="form-control" value="" placeholder="Lokasi Pengiriman" required="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">Volume<span class="required" aria-required="true">*</span></label>
                                                <input type="text" id="volume" name="volume" class="form-control numberformat" value="" placeholder="Volume" required="" autocomplete="off">
                                            </div>
                                        </div>
										<div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">Satuan<span class="required" aria-required="true">*</span></label>
                                                <select id="measure" class="form-control input-sm" name="measure" readonly="" required="">
                                                    <option value="">Pilih Satuan</option>
                                                    <?php
                                                    if (!empty($measure)) {
                                                        foreach ($measure as $meas) {
                                                    ?>
                                                            <option value="<?php echo $meas['measure_name']; ?>"><?php echo $meas['measure_name']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br /><br />
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">Upload Surat Jalan </label>
                                                <input type="file" id="surat_jalan" name="surat_jalan" class="form-control">
                                                <input type="hidden" name="surat_jalan_val" id="surat_jalan_val">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="control-label">Memo</label>
                                                <input type="text" id="memo" name="memo" class="form-control" value="" placeholder="Memo" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <a href="<?php echo site_url('admin/penjualan#profile'); ?>" class="btn btn-info" style="margin-top:10px; width:100px; font-weight:bold; border-radius:10px;"> KEMBALI</a>
                                            <button type="submit" name="submit" class="btn btn-default" style="width:100px; font-weight:bold; border-radius:10px;"> KIRIM</button>
                                        </div>
                                    </div>
                                </form>
                                <br />
                                <div class="text-right">
                                    <button class="btn btn-default" id="btn-view" style="width:250px; font-weight:bold; font-weight:bold; border-radius:10px;"> EDIT & HAPUS SURAT JALAN</button>
                                </div>
                                <div id="box-view" style="display:none;">
                                    <div style="color:red; font-weight:bold;"> * Data yang tampil adalah data surat jalan dengan status UNCREATED / belum ditagihkan.<br />
                                    * Data yang tampil adalah data surat jalan periode berjalan.<br />
                                    * Untuk melihat data surat jalan keseluruhan, bisa lihat di tab pengiriman penjualan.
                                    </div><br />
                                    <div class="row">
                                        <form action="<?php echo site_url('pmm/productions/print_pdf'); ?>" target="_blank">
                                            <?php
                                            $sales_po = $this->db->select('id,contract_number,client_id')->get_where('pmm_sales_po')->result_array();
                                            $product = $this->db->order_by('nama_produk', 'asc')->get_where('produk', array('status' => 'PUBLISH'))->result_array();
                                            $client = $this->db->order_by('nama', 'asc')->get_where('penerima', array('status' => 'PUBLISH', 'pelanggan' => 1))->result_array();
                                            ?>
                                            <div class="col-sm-3">
                                                <input type="text" name="filter_date" id="filter_date" class="form-control filterpicker" value="" autocomplete="off" placeholder="Filter By Date">
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="salesPo_id" class="form-control select2" name="salesPo_id">
                                                    
                                                    <?php
                                                    if (!empty($sales_po)) {
                                                        foreach ($sales_po as $key => $po) {
                                                    ?>
                                                            <option value="<?= $po['id']; ?>"><?= $po['contract_number']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
											<div class="col-sm-3">
                                            <select id="filter_product_id" name="product_id" class="form-control select2">
                                                <option value="">Pilih Produk</option>
                                                <?php
                                                foreach ($product as $key => $pd) {
                                                    ?>
                                                    <option value="<?php echo $pd['id'];?>"><?php echo $pd['nama_produk'];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-default" style="width:100px; font-weight:bold; border-radius:10px;"> PRINT</button>
                                            </div>
                                        </form>
                                    </div>
                                    <br />
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id="guest-table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Pelanggan</th>
                                                    <th>Sales Order</th>
                                                    <th>Tanggal</th>
                                                    <th>No. Surat Jalan</th>
                                                    <th>Surat Jalan</th>
                                                    <th>Produk</th>
                                                    <th>Komposisi</th>
                                                    <th >Volume</th>
                                                    <th>Satuan</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                               
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalComp" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title">Show Accumulated Material</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" id="filter_date_acc" class="form-control filterdate" placeholder="Filter By Date" autocomplete="off">
                        </div>
                    </div>
                    <br />
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-center table-bordered table-condensed" id="table-acc" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Satuan</th>
                                    <th>Volume</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalForm" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title">Edit Surat Jalan Pengiriman</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" style="padding: 0 20px 0 20px;" method="POST" action="<?php echo site_url('pmm/productions/edit_process');?>"  enctype="multipart/form-data" onsubmit="setTimeout(function () { window.location.reload(); }, 1000)">
                        <input type="hidden" name="id_edit" id="id_edit">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" id="edit_date" name="edit_date" class="form-control dtpicker" required="" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label>Memo</label>
                            <input type="text" id="edit_memo" name="edit_memo" class="form-control" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" id="btn-form" style="font-weight:bold; border-radius:10px"> Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-weight:bold; border-radius:10px">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var form_control = '';
    </script>
    <?php echo $this->Templates->Footer(); ?>
    <script src="<?php echo base_url(); ?>assets/back/theme/vendor/bootbox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/daterangepicker.css">

    <script src="<?php echo base_url(); ?>assets/back/theme/vendor/jquery.number.min.js"></script>
    <script type="text/javascript">
        <?php
       $kunci_rakor = $this->db->select('date')->order_by('date','desc')->limit(1)->get_where('kunci_rakor')->row_array();
       $last_opname = date('d-m-Y', strtotime('+1 days', strtotime($kunci_rakor['date'])));

       $date_po = $this->db->get_where('pmm_sales_po',array('id'=>$data['id']))->row_array();
       $last_date_po = date('d-m-Y', strtotime('+0 days', strtotime($date_po['contract_date'])));

        $date1 = date_create($last_opname);
        $date2 = date_create($last_date_po);
        $diff_ok = date_diff($date1,$date2);
        echo $diff_ok->format("%R%a");
        
        $selisih = $diff_ok->format("%R%a");
        if ($selisih <= 0) $selisih = 0;

        $test = date('Y-m-d', strtotime(+$selisih.'days', strtotime($last_opname)));
        $ok = date('d-m-Y', strtotime('+0 days', strtotime($test)));
        ?>

        $('.form-select2').select2();
        $('input.numberformat').number(true, 2, ',', '.');
        $('.dtpicker').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD-MM-YYYY'
            },
            minDate: '<?php echo $ok;?>',
			//maxDate: moment().add(+0, 'd').toDate(),
            //minDate: moment().startOf('month').toDate(),
			maxDate: moment().endOf('month').toDate(),
        });
        $('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY'));
            // table.ajax.reload();
        });
        $('#btn-view').click(function() {
            $('#box-view').show();
        });

        $(document).ready(function(){
            $('#client_id').val(<?= $data['client_id'];?>).trigger('change');
            $('#po_penjualan').val(<?= $data['id'];?>).trigger('change');
        });

        $('.filterpicker').daterangepicker({
            autoUpdateInput: false,
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY'
            },
            startDate: moment().startOf('month'),
            endDate: moment().endOf('month'),
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });
        $('.filterpicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            table.ajax.reload();
        });

        var table = $('#guest-table').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('pmm/productions/table'); ?>',
                type: 'POST',
                data: function(d) {
                    d.filter_date = $('#filter_date').val();
                    d.client_id = $('#filter_client').val();
                    d.product_id = $('#filter_product_id').val();
                    d.salesPo_id = $('#salesPo_id').val();
                }
            },
            responsive: true,
            "deferRender": true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            columns: [{
                    "data": "no"
                },
                {
                    "data": "client_id"
                },
                {
                    "data": "salesPo_id"
                },
                {
                    "data": "date_production"
                },
                {
                    "data": "no_production"
                },
                {
                    "data": "surat_jalan"
                },
                {
                    "data": "product_id"
                },
                {
                    "data": "komposisi_id"
                },
				{
                    "data": "volume"
                },
				{
                    "data": "measure"
                },
                {
                    "data": "delete"
                }
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0, "className": 'text-center'},
                { "width": "10%", "targets": 8, "className": 'text-right' }
            ],
        });


        $('#filter_client').change(function() {
            table.ajax.reload();
        });
        $('#filter_product_id').change(function() {
            table.ajax.reload();
        });
        $('#salesPo_id').change(function() {
            table.ajax.reload();
            getPoAlertTotal();
        });

        $('#form-pro').submit(function(event) {
            $('#btn-form').button('loading');
            var form = $(this);
            var formdata = false;
            if (window.FormData) {
                formdata = new FormData(form[0]);
            }

            $.ajax({
                type: "POST",
                url: $(this).attr('action') + "/" + Math.random(),
                dataType: 'json',
                data: formdata ? formdata : form.serialize(),
                success: function(result) {
                    $('#btn-form').button('reset');
                    if (result.output) {
                        // $("#form-product").trigger("reset");
                        $('#po_penjualan').val('').trigger('change');
                        $('#product_id').val('').trigger('change');
                        $('#client_id').val('').trigger('change');
                        $('#volume').val('');
                        $('#display_volume').val('');
                        $('#komposisi_id').val('');
                        $('#measure').val('');
                        $('#convert_measure').val('');
                        $('#nopol_truck').val('');
                        $('#driver').val('');
                        $('#lokasi').val('');
                        $('#no_production').focus();
                        $('#no_production').val(result.no_production);
                        // bootbox.alert('Succesfull !!');
                        $('#val_print').val(result.id);
                        $('#btn-print').show();
                        $('#btn-print').attr('href', '<?php echo site_url('pmm/productions/get_pdf/'); ?>' + result.id + '');
                        $('#surat_jalan').val('');
                        $('#date').val('');

                        table.ajax.reload();

                        $.toast({
                            heading: '<b>Sukses</b>',
                            text: '<b>SAVED</b>',
                            showHideTransition: 'fade',
                            icon: 'success',
                            position: 'top-right',
                        });
                    } else if (result.err) {
                        bootbox.alert(result.err);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });

            event.preventDefault();

        });

        function getPoAlertTotal() {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('penjualan/alert_sales_po_total'); ?>/" + Math.random(),
            dataType: 'json',
            data: {
                id: $('#salesPo_id').val(),
            },
            success: function(result) {
                if (result.data) {
                    $('#product_id').html('');
                    $('#alert-receipt-material-total').html('');
                    for (let i in result.data) {
                        $('#product_id').append('<option value="'+ result.data[i].id +'"  data-tax_id="'+ result.data[i].tax_id +'" data-measure="'+ result.data[i].measure +'">'+ result.data[i].text +'</option>');
                        $('#alert-receipt-material-total').append('<div class="col-sm-3">' +
                            '<div class="alert alert-danger text-center">' +
                            '<h5><strong>' + result.data2[i].nama_produk + '</strong></h5>' +
                            '<div class="text-right"><b>Total Order : ' + result.data2[i].volume +
                            '<br />Total Pengiriman : ' + result.data2[i].pengiriman +
                            '</div></div></b>' +
                            '</div>');
                    }

                } else if (result.err) {
                    bootbox.alert(result.err);
                }
            }
        });
        }

        function DeleteData(id) {
            bootbox.confirm("Apakah anda yakin untuk proses data ini ?", function(result) {
                // console.log('This was logged in the callback: ' + result); 
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('pmm/productions/delete'); ?>",
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

        $('#client_id').change(function() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('pmm/productions/get_po_penjualan'); ?>",
                dataType: 'json',
                data: {
                    id: $(this).val()
                },
                success: function(result) {
                    if (result.output) {
                        $('#po_penjualan').empty();
                        $('#po_penjualan').select2({
                            data: result.po
                        });

                        $('#po_penjualan').val(<?= $data['id'];?>).trigger('change');
                    } else if (result.err) {
                        bootbox.alert(result.err);
                    }
                }
            });
        });

        $('#product_id').change(function(){
            var measure = $(this).find(':selected').data('measure');
            $('#measure').val(measure);
            var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id').val(tax_id);
        });


        function EditData(id) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('pmm/productions/edit_data_detail'); ?>",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(result) {
                    $('html, body').animate({
                        scrollTop: $("#form-pro").offset().top - 200
                    }, 500);
                    // $('#product_id').prop('disabled', false);
                    if (result.data) {
                        var data = result.data;
                        $("#id").val(data.id);
                        //$('#po_penjualan').val(data.salesPo_id).trigger('change');
						//$("#client_id").select2('val', data.client_id);
                        //$("#slump_id").select2('val', data.slump_id);
						//$("#real_slump").val(data.real_slump);
                        $('#no_production').val(data.no_production);
                        $("#date").val(data.date_production);
                        $('#client_id').val(data.client_id);
                        $('#product_id').val(data.product_id);
                        $("#volume").val(data.volume);
                        $("#display_volume").val(data.display_volume);
						$('#komposisi_id').val(data.komposisi_id);
                        $('#measure').val(data.measure);
                        $('#convert_measure').val(data.convert_measure);
                        $("#nopol_truck").val(data.nopol_truck);
                        $("#driver").val(data.driver);
                        $("#lokasi").val(data.lokasi);
						$("#memo").val(data.memo);
                        $('#surat_jalan_val').val(data.surat_jalan);

                    } else if (result.err) {
                        bootbox.alert(result.err);
                    }
                }
            });

        }

        $('#po_penjualan').change(function() {
            $('#salesPo_id').val($('#po_penjualan').val()).trigger('change');
        });

        /*$(document).ready(function() {
            setTimeout(function(){
                $('#measure').prop('selectedIndex', 4).trigger('change');
            }, 1000);
        });*/
		
		$("#convert_value, #volume, #select_operation").change(function(){
            
            getTotalDisplay();
        });
		
		function getTotalDisplay()
        {
            var volume = $('#volume').val();
            var select_operation = $('#select_operation').val();
            var val = $('#convert_value').val();
            if(select_operation === '' && volume === ''){
                alert('Check Operation First or Volume');
            }else {
                
                if(select_operation == '*'){
                    var display_volume = volume * val;
                }else {
                    var display_volume = volume / val;
                }
                $('#display_volume').val($.number(display_volume,4,',','.'));
                // console.log(volume+'='+jumlah_berat_isi);
            }
        }

        document.getElementById("test").style.display = "none";

        $('#modalForm form').submit(function(event){
            $('#btn-form').button('loading');
            var form = $(this);
            var formdata = false;
            if (window.FormData){
                formdata = new FormData(form[0]);
            }
            $.ajax({
                type    : "POST",
                url     : $(this).attr('action')+"/"+Math.random(),
                dataType : 'json',
                data: formdata ? formdata : form.serialize(),
                success : function(result){
                    $('#btn-form').button('reset');
                    if(result.output){
                        table.ajax.reload();
                        $("#modalForm").modal('hide');
                    }else if(result.err){
                        bootbox.alert(result.err);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });

            event.preventDefault();
            
        });
        
        function EditDataNew(id)
        {
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('pmm/productions/edit_data_detail_new'); ?>",
                dataType : 'json',
                data: {id:id},
                success : function(result){
                    if(result.data){
                        $("#modalForm").modal('show');
                        var data = result.data;
                        $('#id_edit').val(data.id);
                        $('#edit_date').val(data.date_production);
                    }else if(result.err){
                        bootbox.alert(result.err);
                    }
                }
            });
            
        }
        
		
    </script>
</body>

</html>