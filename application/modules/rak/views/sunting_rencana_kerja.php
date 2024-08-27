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
                                <h3><b>RENCANA KERJA</b></h3>
                            </div>
                            <div class="panel-content">
                                <form method="POST" action="<?php echo site_url('rak/submit_sunting_rencana_kerja');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="id" value="<?= $rak["id"] ?>">
                                    <table class="table table-bordered table-striped">
                                        <?php
                                        $tanggal = $rak['tanggal_rencana_kerja'];
                                        $date = date('Y-m-d',strtotime($tanggal));
                                        ?>
                                        <?php
                                        function tgl_indo($date){
                                            $bulan = array (
                                                1 =>   'Januari',
                                                'Februari',
                                                'Maret',
                                                'April',
                                                'Mei',
                                                'Juni',
                                                'Juli',
                                                'Agustus',
                                                'September',
                                                'Oktober',
                                                'November',
                                                'Desember'
                                            );
                                            $pecahkan = explode('-', $date);
                                            
                                            // variabel pecahkan 0 = tanggal
                                            // variabel pecahkan 1 = bulan
                                            // variabel pecahkan 2 = tahun
                                        
                                            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                                            
                                        }
                                        ?>
                                        <tr>
                                            <th width="200px">Tanggal</th>
                                            <td><input type="text" class="form-control dtpicker" name="tanggal_rencana_kerja" value="<?= date('d/m/Y',strtotime($rak["tanggal_rencana_kerja"])) ?>"/></td>
                                        </tr>
                                        <tr>
                                            <th width="100px">Lampiran</th>
                                            <td>:  
                                                <?php foreach($lampiran as $l) : ?>                                    
                                                <a href="<?= base_url("uploads/rak_biaya/".$l["lampiran"]) ?>" target="_blank">Lihat bukti  <?= $l["lampiran"] ?> <br></a></td>
                                                <?php endforeach; ?>
                                        </tr>
                                    </table>
                                    <table id="table-product" class="table table-bordered table-striped table-condensed table-center">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">NO.</th>
                                                <th width="30%">URAIAN</th>
                                                <th width="10%">VOLUME</th>
                                                <th width="15%">HARGA SATUAN</th>
                                                <th width="10%">SATUAN</th>
                                                <th width="40%">KOMPOSISI</th>                                  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1.</td>
                                                <td class="text-left">Beton K-300 (10±2)</td>
                                                <td class="text-right"><input type="text" id="vol_produk_a" name="vol_produk_a" class="form-control numberformat text-right" value="<?php echo number_format($rak["vol_produk_a"],2,',','.');?>" onchange="changeData(1)"  autocomplete="off"></td>
                                                <td class="text-right"><input type="text" id="price_a" name="price_a" class="form-control rupiahformat text-right" value="<?= $rak['price_a'] ?>" autocomplete="off"></td>
                                                <td class="text-center">M3</td>
                                                <td class="text-center">
                                                    <select id="komposisi_300" name="komposisi_300" class="form-control input-sm">
                                                        <option value="">Pilih Komposisi</option>
                                                        <?php
                                                        if (!empty($komposisi)) {
                                                            foreach ($komposisi as $kom) {
                                                        ?>
                                                                <option value="<?php echo $kom['id']; ?>"><?php echo $kom['jobs_type']; ?></option>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2.</td>
                                                <td class="text-left">Beton K-300 (18±2)</td>
                                                <td class="text-right"><input type="text" id="vol_produk_b" name="vol_produk_b" class="form-control numberformat text-right" value="<?php echo number_format($rak["vol_produk_b"],2,',','.');?>" onchange="changeData(1)"  autocomplete="off"></td>
                                                <td class="text-right"><input type="text" id="price_b" name="price_b" class="form-control rupiahformat text-right" value="<?= $rak['price_b'] ?>" autocomplete="off"></td>
                                                <td class="text-center">M3</td>
                                                <td class="text-center">
                                                    <select id="komposisi_300_18" name="komposisi_300_18" class="form-control input-sm">
                                                        <option value="">Pilih Komposisi</option>
                                                        <?php
                                                        if (!empty($komposisi)) {
                                                            foreach ($komposisi as $kom) {
                                                        ?>
                                                                <option value="<?php echo $kom['id']; ?>"><?php echo $kom['jobs_type']; ?></option>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right">GRAND TOTAL</td>
                                                <td>
                                                <input type="text" id="sub-total-val" name="sub_total" value="0" class="form-control numberformat tex-left text-right" readonly="">
                                                </td>
                                                <td></td>
                                            </tr> 
                                        </tfoot>
                                    </table>

                                    <table id="table-product" class="table table-bordered table-striped table-condensed table-center">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">NO.</th>
                                                <th width="25%">KEBUTUHAN BAHAN</th>
                                                <th width="40%">PENAWARAN</th>
                                                <th width="30%">HARGA SATUAN</th>                                 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1.</td>
                                                <td>Semen</td>
                                                <td class="text-center"><select id="penawaran_id_semen" name="penawaran_id_semen" class="form-control">
                                                    <option value="">Pilih Penawaran</option>
                                                    <?php

                                                    foreach ($semen as $key => $sm) {
                                                        ?>
                                                        <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="price_semen" name="price_semen" class="form-control rupiahformat text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="measure_semen" name="measure_semen" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="tax_id_semen" name="tax_id_semen" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="pajak_id_semen" name="pajak_id_semen" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="supplier_id_semen" name="supplier_id_semen" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">2.</td>
                                                <td>Pasir</td>
                                                <td class="text-center"><select id="penawaran_id_pasir" name="penawaran_id_pasir" class="form-control">
                                                    <option value="">Pilih Penawaran</option>
                                                    <?php

                                                    foreach ($pasir as $key => $sm) {
                                                        ?>
                                                        <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="price_pasir" name="price_pasir" class="form-control rupiahformat text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="measure_pasir" name="measure_pasir" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="tax_id_pasir" name="tax_id_pasir" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="pajak_id_pasir" name="pajak_id_pasir" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="supplier_id_pasir" name="supplier_id_pasir" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">3.</td>
                                                <td>Batu Split 10-20</td>
                                                <td class="text-center"><select id="penawaran_id_batu1020" name="penawaran_id_batu1020" class="form-control">
                                                    <option value="">Pilih Penawaran</option>
                                                    <?php

                                                    foreach ($batu1020 as $key => $sm) {
                                                        ?>
                                                        <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="price_batu1020" name="price_batu1020" class="form-control rupiahformat text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="measure_batu1020" name="measure_batu1020" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="tax_id_batu1020" name="tax_id_batu1020" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="pajak_id_batu1020" name="pajak_id_batu1020" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="supplier_id_batu1020" name="supplier_id_batu1020" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">4.</td>
                                                <td>Batu Split 20-30</td>
                                                <td class="text-center"><select id="penawaran_id_batu2030" name="penawaran_id_batu2030" class="form-control">
                                                    <option value="">Pilih Penawaran</option>
                                                    <?php

                                                    foreach ($batu2030 as $key => $sm) {
                                                        ?>
                                                        <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="price_batu2030" name="price_batu2030" class="form-control rupiahformat text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="measure_batu2030" name="measure_batu2030" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="tax_id_batu2030" name="tax_id_batu2030" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="pajak_id_batu2030" name="pajak_id_batu2030" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="supplier_id_batu2030" name="supplier_id_batu2030" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-center">5.</td>
                                                <td>Additive</td>
                                                <td class="text-center"><select id="penawaran_id_additive" name="penawaran_id_additive" class="form-control">
                                                    <option value="">Pilih Penawaran</option>
                                                    <?php

                                                    foreach ($additive as $key => $sm) {
                                                        ?>
                                                        <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="price_additive" name="price_additive" class="form-control rupiahformat text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="measure_additive" name="measure_additive" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="tax_id_additive" name="tax_id_additive" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="pajak_id_additive" name="pajak_id_additive" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    <input type="hidden" id="supplier_id_additive" name="supplier_id_additive" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                </td>
                                            </tr>
                                               
                                        </tbody>
                                    </table>
                                    <br />
                                    <table id="table-product" class="table table-bordered table-striped table-condensed table-center">
                                            <thead>
                                            <tr class="text-center">
                                                <th width="5%">NO.</th>
                                                <th width="25%">KEBUTUHAN BAHAN</th>
                                                <th width="40%">PENAWARAN</th>
                                                <th width="30%">HARGA SATUAN</th>                                 
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1.</td>
                                                    <td>Batching Plant</td>
                                                    <td class="text-center"><select id="penawaran_id_bp" name="penawaran_id_bp" class="form-control">
                                                        <option value="">Pilih Penawaran</option>
                                                        <?php

                                                        foreach ($bp as $key => $sm) {
                                                            ?>
                                                            <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="price_bp" name="price_bp" class="form-control rupiahformat text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="measure_bp" name="measure_bp" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="tax_id_bp" name="tax_id_bp" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="pajak_id_bp" name="pajak_id_bp" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="supplier_id_bp" name="supplier_id_bp" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2.</td>
                                                    <td>Truck Mixer</td>
                                                    <td class="text-center"><select id="penawaran_id_tm" name="penawaran_id_tm" class="form-control">
                                                        <option value="">Pilih Penawaran</option>
                                                        <?php

                                                        foreach ($tm as $key => $sm) {
                                                            ?>
                                                            <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="price_tm" name="price_tm" class="form-control rupiahformat text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="measure_tm" name="measure_tm" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="tax_id_tm" name="tax_id_tm" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="pajak_id_tm" name="pajak_id_tm" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="supplier_id_tm" name="supplier_id_tm" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3.</td>
                                                    <td>Wheel Loader</td>
                                                    <td class="text-center"><select id="penawaran_id_wl" name="penawaran_id_wl" class="form-control">
                                                        <option value="">Pilih Penawaran</option>
                                                        <?php

                                                        foreach ($wl as $key => $sm) {
                                                            ?>
                                                            <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="price_wl" name="price_wl" class="form-control rupiahformat text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="measure_wl" name="measure_wl" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="tax_id_wl" name="tax_id_wl" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="pajak_id_wl" name="pajak_id_wl" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="supplier_id_wl" name="supplier_id_wl" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">4.</td>
                                                    <td>BBM Solar</td>
                                                    <td class="text-center"><select id="penawaran_id_solar" name="penawaran_id_solar" class="form-control">
                                                        <option value="">Pilih Penawaran</option>
                                                        <?php

                                                        foreach ($solar as $key => $sm) {
                                                            ?>
                                                            <option value="<?php echo $sm['penawaran_id'];?>" data-supplier_id="<?php echo $sm['supplier_id'];?>" data-measure="<?php echo $sm['measure'];?>" data-price="<?php echo $sm['price'];?>" data-tax_id="<?php echo $sm['tax_id'];?>" data-tax="<?php echo $sm['tax'];?>" data-penawaran_id="<?php echo $sm['penawaran_id'];?>"><?php echo $sm['nama'];?> - <?php echo $sm['nomor_penawaran'];?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="price_solar" name="price_solar" class="form-control rupiahformat text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="measure_solar" name="measure_solar" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="tax_id_solar" name="tax_id_solar" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="pajak_id_solar" name="pajak_id_solar" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                        <input type="hidden" id="supplier_id_solar" name="supplier_id_solar" class="form-control text-right" value=""  readonly="" autocomplete="off">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br />
                                        <table id="table-product" class="table table-bordered table-striped table-condensed table-center">
                                            <thead>
                                                <tr class="text-center">
                                                    <th width="5%">NO.</th>
                                                    <th width="45%">BUA</th>
                                                    <th width="50%">NILAI</th>                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1.</td>
                                                    <td>BUA</td>
                                                    <td colspan="2">
                                                        <input type="text" id="overhead" name="overhead" class="form-control rupiahformat text-right" value="<?php echo number_format($rak["overhead"],0,',','.');?>"  autocomplete="off">
                                                    </td>
                                                </tr>		
                                            </tbody>
                                        </table>   
									<br />
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <a href="<?= site_url('admin/rencana_kerja');?>" class="btn btn-danger" style="margin-bottom:0px; font-weight:bold; border-radius:10px;">BATAL</a>
                                            <button type="submit" class="btn btn-success" style="font-weight:bold; border-radius:10px;">KIRIM</button>
                                        </div>
                                    </div>
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

        $('input.numberformat').number(true, 2,',','.' );
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
			var vol_produk_a = $('#vol_produk_a').val();
            var vol_produk_b = $('#vol_produk_b').val();
            				
			vol_produk_a = ( vol_produk_a);
            $('#vol_produk_a').val(vol_produk_a);
            vol_produk_b = ( vol_produk_b);
            $('#vol_produk_b').val(vol_produk_b);
            getTotal();
        }

        function getTotal()
        {
            var sub_total = $('#sub-total-val').val();

            sub_total = parseFloat($('#vol_produk_a').val()) + parseFloat($('#vol_produk_b').val());
            
            $('#sub-total-val').val(sub_total);
            $('#sub-total').text($.number( sub_total, 2,',','.' ));

            total_total = parseFloat(sub_total);
            $('#total-val').val(total_total);
            $('#total').text($.number( total_total, 2,',','.' ));
        }

        $(document).ready(function(){
            $('#komposisi_300').val(<?= $rak['komposisi_300'];?>).trigger('change');
            $('#komposisi_300_18').val(<?= $rak['komposisi_300_18'];?>).trigger('change');
            $('#penawaran_id_semen').val(<?= $rak['penawaran_id_semen'];?>).trigger('change');
            $('#penawaran_id_pasir').val(<?= $rak['penawaran_id_pasir'];?>).trigger('change');
            $('#penawaran_id_batu1020').val(<?= $rak['penawaran_id_batu1020'];?>).trigger('change');
            $('#penawaran_id_batu2030').val(<?= $rak['penawaran_id_batu2030'];?>).trigger('change');
            $('#penawaran_id_additive').val(<?= $rak['penawaran_id_additive'];?>).trigger('change');
            $('#penawaran_id_bp').val(<?= $rak['penawaran_id_bp'];?>).trigger('change');
            $('#penawaran_id_tm').val(<?= $rak['penawaran_id_tm'];?>).trigger('change');
            $('#penawaran_id_wl').val(<?= $rak['penawaran_id_wl'];?>).trigger('change');
            $('#penawaran_id_solar').val(<?= $rak['penawaran_id_solar'];?>).trigger('change');
        });

        $('#penawaran_id_semen').change(function(){
            var penawaran_id = $(this).find(':selected').data('penawaran_id');
            $('#penawaran_id_semen').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
            $('#price_semen').val(price);
            var supplier_id = $(this).find(':selected').data('supplier_id');
            $('#supplier_id_semen').val(supplier_id);
            var measure = $(this).find(':selected').data('measure');
            $('#measure_semen').val(measure);
            var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id_semen').val(tax_id);
            var pajak_id = $(this).find(':selected').data('pajak_id');
            $('#pajak_id_semen').val(pajak_id);
        });

        $('#penawaran_id_pasir').change(function(){
            var penawaran_id = $(this).find(':selected').data('penawaran_id');
            $('#penawaran_id_pasir').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
            $('#price_pasir').val(price);
            var supplier_id = $(this).find(':selected').data('supplier_id');
            $('#supplier_id_pasir').val(supplier_id);
            var measure = $(this).find(':selected').data('measure');
            $('#measure_pasir').val(measure);
            var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id_pasir').val(tax_id);
            var pajak_id = $(this).find(':selected').data('pajak_id');
            $('#pajak_id_pasir').val(pajak_id);
        });

        $('#penawaran_id_batu1020').change(function(){
            var penawaran_id = $(this).find(':selected').data('penawaran_id');
            $('#penawaran_id_batu1020').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
            $('#price_batu1020').val(price);
            var supplier_id = $(this).find(':selected').data('supplier_id');
            $('#supplier_id_batu1020').val(supplier_id);
            var measure = $(this).find(':selected').data('measure');
            $('#measure_batu1020').val(measure);
            var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id_batu1020').val(tax_id);
            var pajak_id = $(this).find(':selected').data('pajak_id');
            $('#pajak_id_batu1020').val(pajak_id);
        });

        $('#penawaran_id_batu2030').change(function(){
            var penawaran_id = $(this).find(':selected').data('penawaran_id');
            $('#penawaran_id_batu2030').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
            $('#price_batu2030').val(price);
            var supplier_id = $(this).find(':selected').data('supplier_id');
            $('#supplier_id_batu2030').val(supplier_id);
            var measure = $(this).find(':selected').data('measure');
            $('#measure_batu2030').val(measure);
            var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id_batu2030').val(tax_id);
            var pajak_id = $(this).find(':selected').data('pajak_id');
            $('#pajak_id_batu2030').val(pajak_id);
        });

        $('#penawaran_id_additive').change(function(){
            var penawaran_id = $(this).find(':selected').data('penawaran_id');
            $('#penawaran_id_additive').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
            $('#price_additive').val(price);
            var supplier_id = $(this).find(':selected').data('supplier_id');
            $('#supplier_id_additive').val(supplier_id);
            var measure = $(this).find(':selected').data('measure');
            $('#measure_additive').val(measure);
            var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id_additive').val(tax_id);
            var pajak_id = $(this).find(':selected').data('pajak_id');
            $('#pajak_id_additive').val(pajak_id);
        });

        $('#penawaran_id_bp').change(function(){
            var penawaran_id = $(this).find(':selected').data('penawaran_id');
            $('#penawaran_id_bp').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
            $('#price_bp').val(price);
            var supplier_id = $(this).find(':selected').data('supplier_id');
            $('#supplier_id_bp').val(supplier_id);
            var measure = $(this).find(':selected').data('measure');
            $('#measure_bp').val(measure);
            var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id_bp').val(tax_id);
            var pajak_id = $(this).find(':selected').data('pajak_id');
            $('#pajak_id_bp').val(pajak_id);
        });

        $('#penawaran_id_tm').change(function(){
            var penawaran_id = $(this).find(':selected').data('penawaran_id');
            $('#penawaran_id_tm').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
            $('#price_tm').val(price);
            var supplier_id = $(this).find(':selected').data('supplier_id');
            $('#supplier_id_tm').val(supplier_id);
            var measure = $(this).find(':selected').data('measure');
            $('#measure_tm').val(measure);
            var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id_tm').val(tax_id);
            var pajak_id = $(this).find(':selected').data('pajak_id');
            $('#pajak_id_tm').val(pajak_id);
        });

        $('#penawaran_id_wl').change(function(){
            var penawaran_id = $(this).find(':selected').data('penawaran_id');
            $('#penawaran_id_wl').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
            $('#price_wl').val(price);
            var supplier_id = $(this).find(':selected').data('supplier_id');
            $('#supplier_id_wl').val(supplier_id);
            var measure = $(this).find(':selected').data('measure');
            $('#measure_wl').val(measure);
            var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id_wl').val(tax_id);
            var pajak_id = $(this).find(':selected').data('pajak_id');
            $('#pajak_id_wl').val(pajak_id);
        });

        $('#penawaran_id_solar').change(function(){
            var penawaran_id = $(this).find(':selected').data('penawaran_id');
            $('#penawaran_id_solar').val(penawaran_id);
			var price = $(this).find(':selected').data('price');
            $('#price_solar').val(price);
            var supplier_id = $(this).find(':selected').data('supplier_id');
            $('#supplier_id_solar').val(supplier_id);
            var measure = $(this).find(':selected').data('measure');
            $('#measure_solar').val(measure);
            var tax_id = $(this).find(':selected').data('tax_id');
            $('#tax_id_solar').val(tax_id);
            var pajak_id = $(this).find(':selected').data('pajak_id');
            $('#pajak_id_solar').val(pajak_id);
        });

        $(document).ready(function(){
            $('#overhead').val(<?= $rak['overhead'];?>).trigger('change');
        });

    </script>


</body>
</html>
