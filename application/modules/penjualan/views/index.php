<!doctype html>
<html lang="en" class="fixed">

<head>
    <?php echo $this->Templates->Header(); ?>
    <style>
        body {
            font-family: helvetica;
            font-size: 98%;
        }

		.tab-pane {
            padding-top: 10px;
        }

        .select2-container--default .select2-results__option[aria-disabled=true] {
            display: none;
        }
    </style>
</head>

<body>
    <div class="wrap">

        <?php echo $this->Templates->PageHeader(); ?>
        <?php include 'lib.php'; ?>

        <div class="page-body">
            <div class="content">
                <div class="row animated fadeInUp">
                    <div class="col-sm-12 col-lg-12">
                        <div class="panel">
                            <div class="panel-header">
                                <h3 class="section-subtitle">
                                    <b>PENJUALAN</b>
                                </h3>
                                <div class="text-left">
                                    <a href="<?php echo site_url('admin');?>">
                                    <button style="color:white; background-color:#5bc0de; border:1px solid black; border-radius:10px; line-height:30px;"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                </div>
                            </div>
                            <div class="panel-content">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">PENAWARAN</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">SALES ORDER</a></li>
                                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">PENGIRIMAN</a></li>
                                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">TAGIHAN</a></li>
                                </ul>

                                <div class="tab-content">

                                    <!-- Penawaran Penjualan -->
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <div class="table-responsive">
                                            <div class="col-sm-3">
                                                <input type="text" id="filter_date_penawaran" name="filter_date" class="form-control dtpicker input-sm" value="" placeholder="Filter by Date" autocomplete="off">
                                            </div>
                                            <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="<?php echo site_url('penjualan/penawaran_penjualan'); ?>"><b style="color:white;">BUAT PENAWARAN</b></a></button>
                                            <br />
                                            <br />
                                            <table class="table table-striped table-hover" id="table_penawaran" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Status</th>
														<th>Tanggal</th>
														<th>Nomor</th>
                                                        <th>Pelanggan</th>
                                                        <th>Perihal</th>        
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Sales Order -->
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        <div class="table-responsive">
                                            <div class="col-sm-3">
                                                <input type="text" id="filter_date_sales_order" name="filter_date" class="form-control dtpicker input-sm" value="" placeholder="Filter by Date" autocomplete="off">
                                            </div>
                                            <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="<?php echo site_url('penjualan/sales_po'); ?>"><b style="color:white;">BUAT SALES ORDER</b></a></button>
                                            <br />
                                            <br />
                                            <table class="table table-striped table-hover" id="guest-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Status</th>
                                                        <th>Tanggal</th>
                                                        <th>Nomor</th>
                                                        <th>Pelanggan</th>
                                                        <th>Jenis Pekerjaan</th>
														<th>Vol. Sales Order</th>
                                                        <th>Presentase Penerimaan</th>
                                                        <th>Kirim</th>
														<th>Total Sales Order</th>
														<th>Total Kirim</th>
                                                        <th>Upload Doc.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="modal fade bd-example-modal-lg" id="modalDocPO" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <span class="modal-title">Upload Sales Order</span>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" style="padding: 0 10px 0 20px;">
                                                        <input type="hidden" name="id" id="id_doc_po">
                                                        <div class="form-group">
                                                            <label>Upload Sales Order</label>
                                                            <input type="file" id="file" name="file" class="form-control" required="" />
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-success" id="btn-form-doc-po"><i class="fa fa-send"></i> Kirim</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pengiriman Penjualan -->
                                    <div role="tabpanel" class="tab-pane" id="messages">
                                        <?php
                                        $sales_po = $this->db->select('id,contract_number,client_id')->get_where('pmm_sales_po')->result_array();
                                        $suppliers = $this->db->order_by('id,nama')->select('*')->get_where('penerima', array('status' => 'PUBLISH', 'pelanggan' => 1))->result_array();
                                        ?>
                                        <div class="row">
                                            <form action="<?php echo site_url('pmm/productions/cetak_surat_jalan');?>" method="GET" target="_blank">
                                                <div class="col-sm-3">
                                                    <input type="text" id="filter_date" name="filter_date" class="form-control dtpicker input-sm" value="" placeholder="Filter by Date" autocomplete="off">
                                                </div>
                                                <div class="col-sm-3">
                                                    <select id="filter_supplier_id" name="supplier_id" class="form-control select2">
                                                        <option value="">Pilih Pelanggan</option>
                                                        <?php
                                                        foreach ($suppliers as $key => $supplier) {
                                                        ?>
                                                            <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['nama']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select id="sales_po_id" class="form-control select2" name="sales_po_id">
                                                        <option value="">Pilih PO</option>
                                                        <?php
                                                        if (!empty($sales_po)) {
                                                            foreach ($sales_po as $key => $po) {
                                                        ?>
                                                                <option value="<?= $po['id']; ?>" data-client-id="<?= $po['client_id'] ?>" disabled><?= $po['contract_number']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <select id="product_id" name="product_id" class="form-control select2">
                                                        <option value="">Pilih Produk</option>
                                                        
                                                    </select>
                                                </div>
                                                <br />
                                                <br />
                                                <div class="col-sm-6">
                                                    <div class="text-left">
                                                        <button type="submit" class="btn btn-default" style="width:100px; font-weight:bold; border-radius:10px;"> PRINT</button>
                                                        <button type="button" id="btn_production" class="btn btn-success" style="background-color:#88b93c; border:1px solid black; border-radius:10px;"> BUAT PENAGIHAN</button>
                                                    </div>
                                                </div>
                                                <br /><br />
                                            </form>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="table-production" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>No.</th>
                                                        <th>Status Tagihan</th>
                                                        <th>Tanggal</th>
                                                        <th>Pelanggan</th>
                                                        <th>No. Sales Order</th>
                                                        <th>No. Surat Jalan</th>
                                                        <th>Surat Jalan</th>
                                                        <th>Produk</th>
                                                        <th>Komposisi</th>
                                                        <th>Satuan</th>
                                                        <th>Volume</th>
                                                        <th>Upload Surat Jalan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="modal fade bd-example-modal-lg" id="modalDocSuratJalan" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <span class="modal-title">Upload Surat Jalan</span>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" style="padding: 0 10px 0 20px;">
                                                        <input type="hidden" name="id" id="id_doc_surat_jalan">
                                                        <div class="form-group">
                                                            <label>Upload Surat Jalan</label>
                                                            <input type="file" id="file" name="file" class="form-control" required="" />
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-success" id="btn-form-doc-surat-jalan"><i class="fa fa-send"></i> Kirim</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tagihan Penjualan -->

                                    <div role="tabpanel" class="tab-pane" id="settings">
                                        <form action="<?php echo site_url('laporan/cetak_daftar_tagihan_penjualan');?>" method="GET" target="_blank">
                                            <div class="col-sm-3">
                                                <input type="text" id="filter_date_tagihan" name="filter_date" class="form-control dtpicker input-sm" value="" placeholder="Filter by Date" autocomplete="off">
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="filter_supplier_tagihan" name="supplier_id" class="form-control select2">
                                                    <option value="">Pilih Pelanggan</option>
                                                    <?php
                                                    foreach ($suppliers as $key => $supplier) {
                                                    ?>
                                                        <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['nama']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="text-left">
                                                    <button type="submit" class="btn btn-default" style="width:100px; font-weight:bold; border-radius:10px;"> PRINT</button>
                                                </div>
                                            </div>
                                        </form>
										<br /><br />
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover" id="table-penagihan" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Status Tagihan</th>
                                                        <th>Status Pembayaran</th>
                                                        <th>Tgl. Invoice</th>
                                                        <th>No. Invoice</th>
                                                        <th>Pelanggan</th>
                                                        <th>Tgl. Sales Order</th>
                                                        <th>No. Sales Order</th>
                                                        <th>Total</th>
                                                        <th>Pembayaran</th>
                                                        <th>Sisa Tagihan</th>
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
            
        </div>
    </div>

    <?php echo $this->Templates->Footer(); ?>

    <script src="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/back/theme/vendor/daterangepicker/daterangepicker.css">
    <script src="<?php echo base_url(); ?>assets/back/theme/vendor/bootbox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/back/theme/vendor/jquery.number.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.css">
    <!--<link rel="stylesheet" type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css">-->
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/sl-1.2.5/datatables.min.js"></script>
    <script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
    <script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        var form_control = '';
    </script>
    
    <script type="text/javascript">
        $('input#contract').number(true, 2, ',', '.');

        var table_penawaran = $('#table_penawaran').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('penjualan/table_penawaran'); ?>',
                type: 'POST',
                data: function(d) {
                    d.filter_date = $('#filter_date_penawaran').val();
                }
            },
            columns: [{
                    "data": "no"
                },
                {
                    "data": "status"
                },
				{
                    "data": "tanggal"
                },
				{
                    "data": "nomor"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "perihal"
                },
                {
                    "data": "total"
                }
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0, "className": 'text-center'},
                { "targets": 6, "className": 'text-right'},
            ],
            responsive: true,
        });
        
        $('#filter_date_penawaran').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            table_penawaran.ajax.reload();
        });

        var table_po = $('#guest-table').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('penjualan/table_sales_po'); ?>',
                type: 'POST',
				data: function(d) {
                    d.filter_date = $('#filter_date_sales_order').val();
                }
            },
            columns: [{
                    "data": "no"
                },
                {
                    "data": "status"
                },
                {
                    "data": "contract_date"
                },
                {
                    "data": "nomor_link"
                },
                {
                    "data": "client_name"
                },
                {
                    "data": "jobs_type"
                },
				{
                    "data": "qty"
                },
                {
                    "data": "presentase"
                },
				{
                    "data": "receipt"
                },
				{
                    "data": "jumlah_total"
                },
				{
                    "data": "total_receipt"
                },
                {
                    "data": "uploads_po"
                },
            ],
            "columnDefs": [
                { "width": "5%", "targets": 0, "className": 'text-center'},
                { "targets": [7, 8, 9, 10], "className": 'text-right'},
            ],
            responsive: true,
        });

        $('#filter_date_sales_order').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            table_po.ajax.reload();
        });

        var tableProduction = $('#table-production').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('penjualan/table_productions'); ?>',
                type: 'POST',
                data: function(d) {
                    d.filter_date = $('#filter_date').val();
                    d.supplier_id = $('#filter_supplier_id').val();
                    d.sales_po_id = $('#sales_po_id').val();
                    d.product_id = $('#product_id').val();
                }
            },
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            columns: [{
                    "data": "checkbox"
                },
                {
                    "data": "no"
                },
                {
                    "data": "status_payment"
                },
                {
                    "data": "date_production"
                },
                {
                    "data": "client"
                },
                {
                    "data": "contract_number"
                },
                {
                    "data": "no_production"
                },
                {
                    "data": "surat_jalan"
                },
                {
                    "data": "product"
                },
                {
                    "data": "komposisi"
                },
                {
                    "data": "measure"
                },
				{
                    "data": "volume"
                },
                {
                    "data": "uploads_surat_jalan"
                }
            ],
            select: {
                style: 'multi'
            },
            responsive: true,
            "pageLength": 10,
            "columnDefs": [
				{
                    "targets": [0],
                    "orderable": false,
                    "checkboxes": {
                        "selectRow": true
                    }
                },
                { "width": "5%", "targets": [1,12], "className": 'text-center'},
                { "targets": 11, "className": 'text-right'},
            ],
        });

        $('#btn_production').click(function() {
            var data_receipt = tableProduction.rows({selected: true}).data();

            var send_data = '';
            if (data_receipt.length > 0) {
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
                            $.each(data_receipt, function(i, val) {
                            send_data += val.id + ',';
                        });

                        window.location.href = '<?php echo site_url('penjualan/penagihan_penjualan/'); ?>' + send_data;
                        }
                        
                    }
                });
            } else {
                bootbox.alert('Pilih Surat Jalan Terlebih Dahulu');
            }
        });

        $('#filter_supplier_id').on('select2:select', function(e) {
            var data = e.params.data;
            console.log(data);
            tableProduction.ajax.reload();

            $('#sales_po_id option[data-client-id]').prop('disabled', true);
            $('#sales_po_id option[data-client-id="' + data.id + '"]').prop('disabled', false);
            $('#sales_po_id').select2('destroy');
            $('#sales_po_id').select2();
        });

        $('.dtpicker').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            showDropdowns: true,
        });
        
        $('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            tableProduction.ajax.reload();
        });

        $('#sales_po_id').change(function() {
            tableProduction.ajax.reload();
        });

        function SelectMatByPo() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('pmm/productions/get_mat_penjualan'); ?>/" + Math.random(),
                dataType: 'json',
                data: {
                    sales_po_id: $('#sales_po_id').val(),
                    product_id: $('#product_id').val(),
                },
                success: function(result) {
                    if (result.data) {
                        $('#product_id').empty();
                        $('#product_id').select2({
                            data: result.data
                        });
                        $('#product_id').trigger('change');
                    } else if (result.err) {
                        bootbox.alert(result.err);
                    }
                }
            });
        }

        $('#sales_po_id').change(function(){
    
        $('#sales_po_id').val($(this).val());
            tableProduction.ajax.reload();
            SelectMatByPo();
        });

        $('#product_id').change(function() {
            tableProduction.ajax.reload();
        });

        $('#product_id').change(function() {
            tableProduction.ajax.reload();
        });

        var table = $('#table-penagihan').DataTable( {"bAutoWidth": false,
            ajax: {
                processing: true,
                serverSide: true,
                url: '<?php echo site_url('penjualan/table_penagihan'); ?>',
                type: 'POST',
				data: function(d) {
                    d.filter_date = $('#filter_date_tagihan').val();
                    d.supplier_id = $('#filter_supplier_tagihan').val();
                }
            },
            columns: [{
                    "data": "no"
                },
                {
                    "data": "status_tagihan"
                },
                {
                    "data": "status"
                },
                {
                    "data": "tanggal_invoice"
                },
                {
                    "data": "nomor_invoice"
                },
                {
                    "data": "nama_pelanggan"
                },
                {
                    "data": "tanggal_kontrak"
                },
                {
                    "data": "sales_po_id"
                },
                {
                    "data": "total_biaya"
                },
                {
                    "data": "pembayaran"
                },
                {
                    "data": "sisa_tagihan"
                }

            ],
            "columnDefs": [
                { "width": "5%", "targets": 0, "className": 'text-center'},
                { "targets": [8, 9, 10], "className": 'text-right'},
            ],
            responsive: true,
        });

		$('#filter_date_tagihan').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            showDropdowns: true,
        });

		$('#filter_date_tagihan').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            table.ajax.reload();
        });

        $('#filter_supplier_tagihan').change(function() {
            table.ajax.reload();
        });

        function UploadDocSuratJalan(id) {

        $('#modalDocSuratJalan').modal('show');
        $('#id_doc_surat_jalan').val(id);
        }

        $('#modalDocSuratJalan form').submit(function(event) {
            $('#btn-form-doc-surat-jalan').button('loading');

            var form = $(this);
            var formdata = false;
            if (window.FormData) {
                formdata = new FormData(form[0]);
            }

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('penjualan/form_document'); ?>/" + Math.random(),
                dataType: 'json',
                data: formdata ? formdata : form.serialize(),
                success: function(result) {
                    $('#btn-form-doc-surat-jalan').button('reset');
                    if (result.output) {
                        $("#modalDocSuratJalan form").trigger("reset");
                        tableProduction.ajax.reload();

                        $('#modalDocSuratJalan').modal('hide');
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

        function UploadDocPO(id) {

        $('#modalDocPO').modal('show');
        $('#id_doc_po').val(id);
        }

        $('#modalDocPO form').submit(function(event) {
            $('#btn-form-doc-po').button('loading');

            var form = $(this);
            var formdata = false;
            if (window.FormData) {
                formdata = new FormData(form[0]);
            }

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('penjualan/form_document_po'); ?>/" + Math.random(),
                dataType: 'json',
                data: formdata ? formdata : form.serialize(),
                success: function(result) {
                    $('#btn-form-doc-po').button('reset');
                    if (result.output) {
                        $("#modalDocPO form").trigger("reset");
                        table_po.ajax.reload();

                        $('#modalDocPO').modal('hide');
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
    </script>

</body>
</html>