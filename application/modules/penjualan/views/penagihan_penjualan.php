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
                                    <h3><b>TAGIHAN PENJUALAN</b></h3>
                                </div>
                            </div>
                            <form id="form-po" action="<?= base_url('penjualan/submit_penagihan_penjualan') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="surat_jalan" value="<?= $id; ?>">
                                <input type="hidden" name="sales_po_id" value="<?= $sales['id']; ?>">
                                <div class="panel-content">
                                    <table class="table table-striped table-bordered" width="100%">
                                        <tr>
                                            <th width="35%" align="left">Pelanggan</th>
                                            <th width="65%" align="left"><label class="label label-default" style="font-size:14px;"><?= $clients['nama'] ?></label>
                                            <input type="hidden" name="client_id" value="<?= $query['client_id']; ?>">
                                            <input type="hidden" name="pelanggan" value="<?= $clients['nama'] ?>">
                                            <input type="hidden" name="jenis_pekerjaan" value="<?= $sales['jobs_type']; ?>">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Alamat Pelanggan</th>
                                            <th><textarea class="form-control" name="alamat_pelanggan" rows="5" readonly=""><?= $clients['alamat']; ?></textarea></th>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Sales Order</th>
                                            <th><input type="text" class="form-control dtpicker" name="tanggal_kontrak" required="" value="<?= date("d-m-Y", strtotime($sales['contract_date'])) ?>" readonly=""/></th>
                                        </tr>
                                        <tr>
                                            <th>Nomor Sales Order</th>
                                            <th>
                                                <a target="_blank" href="<?= base_url("penjualan/dataSalesPO/".$sales['id']) ?>"><?= $sales['contract_number']; ?></a>
                                                <input type="hidden" class="form-control" value="<?= $sales['contract_number']; ?>" name="nomor_kontrak" readonly=""/>
                                            </th>
                                        </tr>
                                    </table>
                                    <table class="table table-striped table-bordered" width="100%">
                                        <tr>
                                            <th width="35%" align="left">Tanggal Invoice<span class="required" aria-required="true">*</span></th>
                                            <th width="65%" align="left"><input type="text" class="form-control dtpicker" name="tanggal_invoice" id="tanggal_invoice" required="" ></th>
                                        </tr>
                                        <tr>
                                            <th>Nomor Invoice<span class="required" aria-required="true">*</span></th>
                                            <th> <input type="text" class="form-control" value="" name="nomor_invoice" required=""/></th>
                                        </tr>
                                        <tr>
                                            <th>Syarat Pembayaran<span class="required" aria-required="true">*</span><br>(Ketik Angka Saja, Tanpa Hari)</th>
                                            <th><input type="text" class="form-control" name="syarat_pembayaran" id="syarat_pembayaran" value="<?= $syarat_pembayaran['syarat_pembayaran'];?>" required=""/></th>
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
												$tax = 0;
												$tax_pph = 0;
												$tax_ppn = 0;
                                                $tax_ppn11 = 0;
                                                $tax_pph22new = 0;
                                                $tax_pph22 = 0;
												$tax_0 = false;
												$total = 0;
												?>
                                                <?php foreach ($cekHarga as $key => $row) { ?>
                                                    <input type="hidden" name="surat_jalan<?= $key + 1 ?>" value="<?= $row["no_production"] ?>">
                                                    <input type="hidden" name="production_id_<?= $key + 1 ?>" value="<?= $row["idProduction"] ?>">
                                                    <input type="hidden" name="product_id_<?= $key + 1 ?>" value="<?= $row["product_id"] ?>">
                                                    <tr>
                                                        <td class="text-center"><?= $key + 1 ?>.</td>
                                                        <td class="text-left"><?= $row['nameProduk'] ?></td>
                                                        <td class="text-right">
															<?= $this->filter->Rupiah($row['volume']); ?>
															<input type="hidden" min="0" name="qty_<?= $key+1; ?>" id="qty-<?= $key; ?>" value="<?= $row['volume'];?>" class="form-control input-sm text-center" required="" readonly />
														</td>
                                                        <td class="text-center">
															<?= $row['measure']; ?>
															<input type="hidden" name="measure_<?= $key+1; ?>" id="measure-<?= $key; ?>" class="form-control input-sm text-center" value="<?= $row['measure'];?>" readonly=""  />
														</td>
                                                        <td class="text-right">
                                                            <?= number_format($row['hargaProduk'],0,',','.'); ?>
															<input type="hidden" name="price_<?= $key+1; ?>" id="price-<?= $key; ?>"  class="form-control input-sm text-center" value="<?= $row['hargaProduk'];?>" readonly =""/>
														</td>                                                 
                                                        <td class="text-right">
                                                            <?= number_format($row['hargaProduk'] * $row['volume'],0,',','.'); ?>
                                                            <input type="hidden" name="total_<?= $key + 1; ?>" id="total-<?= $key; ?>" class="form-control numberformat text-right" readonly="" />
                                                        </td>
														<input type="hidden" name="tax_id_<?= $key + 1; ?>" id="tax-id-<?= $key; ?>" class="form-control" value="<?= $row['tax_id'];?>" readonly =""/>
                                                        <input type="hidden" name="pajak_id_<?= $key + 1; ?>" id="pajak-id-<?= $key; ?>" class="form-control" value="<?= $row['pajak_id'];?>" readonly =""/>
                                                    </tr>
                                                    <?php 
                                                        $sub_total += ($row['hargaProduk'] * $row['volume']);
                                                        
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
                                                        if($row['tax_id'] == 7){
                                                            $tax_pph22new = $sub_total * 1.5 / 100;
                                                        }
                                                        if($row['pajak_id'] == 7){
                                                            $tax_pph22 = $sub_total * 1.5 / 100;
                                                        }
                                                        
                                                        $total = $sub_total + $tax_ppn - $tax_pph + $tax_ppn11 - $tax_pph22new - $tax_pph22;
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
                                                <input type="file" class="form-control" name="files[]" multiple="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-8 form-horizontal">
                                            <div class="row">
                                                <label class="col-sm-7 control-label">Sub Total</label>
													<div class="col-sm-5 text-right">
														<label><?= number_format($sub_total,0,',','.'); ?></label>													
															<input type="hidden" name="total_1" value="<?= $sub_total;?>">
													</div>
                                            </div>
                                            <?php
												if($tax_ppn > 0){
													?>
													<div class="row">                                                   
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
													<div class="row">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (PPN 0%)</label>
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
													<div class="row">                                                   
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
													<div class="row">                                                   
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
												if($tax_pph22new > 0){
													?>
													<div class="row">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (PPh 22)</label>
															<div class="col-sm-5 text-right">															
																<label><?= number_format($tax_pph22new,0,',','.'); ?></label>
																	<input type="hidden" id="tax_1" name="tax_1" value="<?= $tax_pph22new;?>">
															</div>
													</div>
                                                    <?php
												}
											?>
                                            <?php
												if($tax_pph22 > 0){
													?>
													<div class="row">                                                   
                                                        <label class="col-sm-7 control-label">Pajak (PPh 22)</label>
															<div class="col-sm-5 text-right">															
																<label><?= number_format($tax_pph22,0,',','.'); ?></label>
																	<input type="hidden" id="pajak_1" name="pajak_1" value="<?= $tax_pph22;?>">
															</div>
													</div>
                                                    <?php
												}
											?>
                                            <div class="row">
                                                <label class="col-sm-7 control-label">Total</label>
													<div class="col-sm-5 text-right">
														<label id="total" ><?= number_format($total,0,',','.'); ?></label>
															<input type="hidden" id="total-val" name="total" value="<?= $total;?>">
													</div>
                                            </div>
                                            <input type="hidden" name="total_product" id="total-product" value="<?= $key + 1 ?>">
                                        </div>
                                    </div>
                                    <br /><br />
                                    <div class="text-center">
                                        <a href="<?= site_url('admin/penjualan');?>" class="btn btn-danger" style="margin-bottom:0px; font-weight:bold; border-radius:10px;">BATAL</a>
                                        <button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;">KIRIM</button>
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
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        };

        $('.form-select2').select2();

        $('input.numberformat').number(true, 2, ',', '.');
        $('.dtpicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY'
            }
        });
        $('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY'));
            // table.ajax.reload();
        });

        $('#form-po').submit(function(e) {
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
                callback: function(result) {
                    if (result) {
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