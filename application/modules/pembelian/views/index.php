<!doctype html>
<html lang="en" class="fixed">

<head>
    <?php echo $this->Templates->Header(); ?>
    <style type="text/css">
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

        #table-receipt_wrappertable.dataTable tbody>tr.selected,
        #table-receipt_wrapper table.dataTable tbody>tr>.selected {
            background-color: #c3c3c3;
        }

        #form-verif-dok label {
            font-size: 12px;
            text-align: left;
        }

        #form-verif-dok hr {
            margin: 5px 0px;
            margin-bottom: 10px;
            border-top: 1px solid #9c9c9c;
        }

        .custom-file-input {
            width: 0;
            height: 0;
            visibility: hidden !important;
        }
        blink {
        -webkit-animation: 2s linear infinite kedip; /* for Safari 4.0 - 8.0 */
        animation: 2s linear infinite kedip;
        }
        /* for Safari 4.0 - 8.0 */
        @-webkit-keyframes kedip { 
        0% {
            visibility: hidden;
        }
        50% {
            visibility: hidden;
        }
        100% {
            visibility: visible;
        }
        }
        @keyframes kedip {
        0% {
            visibility: hidden;
        }
        50% {
            visibility: hidden;
        }
        100% {
            visibility: visible;
        }
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
        <?php echo $this->Templates->PageHeader(); ?>
        <div class="page-body">
            
            <div class="content">
                <div class="row animated fadeInUp">
                    <div class="col-sm-12 col-lg-12">
                        <div class="panel">
                            <div class="panel-header">
                                <h3 class="section-subtitle">
                                    <b>PEMBELIAN</b>
                                </h3>
                                <div class="text-left">
                                    <a href="<?php echo site_url('admin');?>">
                                    <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                </div>
                            </div>
                            <div class="panel-content">
                                <?php
                                $arr_po = $this->db->order_by('date_po', 'desc')->get_where('pmm_purchase_order')->result_array();
                                $arr_produk = $this->db->order_by('nama_produk', 'asc')->get_where('produk', array('status' => 'PUBLISH'))->result_array();
                                $suppliers  = $this->db->order_by('nama', 'asc')->select('*')->get_where('penerima', array('status' => 'PUBLISH', 'rekanan' => 1))->result_array();
                                $kategori  = $this->db->order_by('nama_kategori_produk', 'asc')->select('*')->get_where('kategori_produk', array('status' => 'PUBLISH'))->result_array();
                                ?>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">PENAWARAN</a></li>
									<li role="presentation"><a href="#chart" aria-controls="chart" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">PERMINTAAN BAHAN & ALAT</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">PESANAN</a></li>
                                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">PENERIMAAN</a></li>
                                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" style="border-radius:10px; font-weight:bold;">TAGIHAN</a></li>
                                </ul>

                                <div class="tab-content">

                                    <!-- Penawaran Pembelian -->
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <div class="table-responsive">
                                            <div class="col-sm-3">
                                                <input type="text" id="filter_date_2" name="filter_date" class="form-control dtpicker input-sm " value="" placeholder="Filter by Date" autocomplete="off">
                                            </div>
                                            <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="<?php echo site_url('pembelian/penawaran_pembelian'); ?>"><b style="color:white;">BUAT PENAWARAN</b></a></button>
                                            <br />
                                            <br />
                                            <table class="table table-striped table-hover" id="guest-table" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Status</th>
                                                        <th>Tanggal</th>
                                                        <th>Nomor</th>
                                                        <th>Rekanan</th>
                                                        <th>Jenis Pembelian</th>
														<th>Nilai</th>                                                
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
									
									<!-- Permintaan Bahan & Alat -->
									<div role="tabpanel" class="tab-pane" id="chart">
									<?php
										$suppliers= $this->db->order_by('nama','asc')->get_where('penerima',array('status'=>'PUBLISH','rekanan'=>1))->result_array();
									?>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <input type="text" id="filter_date_b" class="form-control filter_date_b input-sm"  autocomplete="off" placeholder="Filter By Date">
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="filter_supplier_id_b" class="form-control select2">
                                                <option value="">Pilih Rekanan</option>
                                                <?php
                                                foreach ($suppliers as $key => $supplier) {
                                                    ?>
                                                    <option value="<?php echo $supplier['id'];?>"><?php echo $supplier['nama'];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="javascript:void(0);" onclick="OpenFormRequest()"><b style="color:white;">BUAT PERMINTAAN BAHAN & ALAT</b></a></button>
                                    </div>
                                    <br />
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="table-request" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Status</th>
													<th>Tanggal</th>
                                                    <th>Nomor</th>
                                                    <th>Subyek</th>
                                                    <th>Rekanan</th>                               
                                                    <th>Volume</th>
                                                    <th>Lihat</th>
                                                    <th>Hapus</th>    
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
								
								<!-- Form Permintaan Bahan & Alat -->
								<div class="modal fade bd-example-modal-lg" id="modalRequest" role="dialog">
									<div class="modal-dialog" role="document" >
										<div class="modal-content">
											<div class="modal-header">
												<span class="modal-title"><b>PERMINTAAN BAHAN & ALAT</b></span>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form class="form-horizontal" style="padding: 0 10px 0 20px;" >
													<input type="hidden" name="id" id="id_Request">
													<div class="form-group">
														<label>Tanggal Permintaan<span class="required" aria-required="true">*</span></label>
														<input type="text" id="request_date" name="request_date" class="form-control dtpicker-single" required="" autocomplete="off" value="<?php echo date('d-m-Y');?>" />
													</div>
													<div class="form-group">
														<label>Subjek<span class="required" aria-required="true">*</span></label>
														<input type="text" id="subject" name="subject" class="form-control" required="" autocomplete="off"/>
													</div>
													<div class="form-group">
														<label>Rekanan<span class="required" aria-required="true">*</span></label>
														<select id="supplier_id" name="supplier_id" class="form-control select2" required="" autocomplete="off">
															<option value="">Pilih Rekanan</option>
															<?php
															foreach ($suppliers as $key => $supplier) {
																?>
																<option value="<?php echo $supplier['id'];?>"><?php echo $supplier['nama'];?></option>
																<?php
															}
															?>
														</select>
													</div>
                                                    <div class="form-group">
														<label>Kategori<span class="required" aria-required="true">*</span></label>
														<select id="kategori_id" name="kategori_id" class="form-control select2" required="" autocomplete="off">
															<option value="">Pilih Kategori</option>
															<?php
															foreach ($kategori as $key => $kat) {
																?>
																<option value="<?php echo $kat['id'];?>"><?php echo $kat['nama_kategori_produk'];?></option>
																<?php
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<label>Memo<span class="required" aria-required="true">*</span></label>
                                                        <textarea id="about_text" name="memo" class="form-control" data-required="false" rows="20">
<p style="font-size:6;"><b>Syarat &amp; Ketentuan :</b></p>
<p style="font-size:6;">1.&nbsp;Waktu Penyerahan : 1 Agustus 2024 s/d 31 Agustus 2024</p>
<p style="font-size:6;">2.&nbsp;Tempat Penyerahan : Batching Plant, Bia Bumi Jayendra, Desa Karangan, Kecamatan Karangan, Kabupaten Trenggalek.</p>
<p style="font-size:6;">3.&nbsp;Cara Pembayaran : 30 (tiga puluh) hari kerja setelah berkas tagihan dinyatakan lolos verifikasi keuangan PT. Bia Bumi Jayendra, dengan melampirkan</p>
<p style="font-size:6;">&nbsp;&nbsp;&nbsp; dokumen sebagai berikut :</p>
<p style="font-size:6;">&nbsp;&nbsp;&nbsp;3.1 Tagihan Bermaterai</p>
<p style="font-size:6;">&nbsp;&nbsp;&nbsp;3.2 Kwitansi</p>
<p style="font-size:6;">&nbsp;&nbsp;&nbsp;3.3 BAP (Berita Acara Pembayaran)</p>
<p style="font-size:6;">&nbsp;&nbsp;&nbsp;3.4 BAST (Berita Acara Serah Terima) &amp; rekap surat jalan yang ditandatangani oleh pihak pemberi order dan penerima order</p>
<p style="font-size:6;">&nbsp;&nbsp;&nbsp;3.5 Surat Jalan Asli (Nomor PO harus tercantum pada setiap surat jalan)</p>
<p style="font-size:6;">&nbsp;&nbsp;&nbsp;3.6 PO</p>
<p style="font-size:6;">&nbsp;&nbsp;&nbsp;3.7 Faktur Pajak</p>
<p style="font-size:6;">4. Lain-lain :</p>
<p style="font-size:6;">&nbsp;&nbsp;&nbsp;4.1 Barang harus dalam kondisi 100% baik</p>
<p style="font-size:6;">&nbsp;&nbsp;&nbsp;4.2 Barang dikembalikan apabila tidak sesuai dengan spesifikasi pesanan</p></textarea>
														
													</div>
													
													<div class="form-group">
														<button type="submit" onclick="tinyMCE.triggerSave(true,true);" class="btn btn-success" id="btn-form" style="font-weight:bold; width;10%; border-radius:10px;"> KIRIM</button>
													</div>
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-weight:bold; width;10%; border-radius:10px;">CLOSE</button>
											</div>
										</div>
									</div>
								</div>

                                <!-- Pesanan Pembelian -->
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <div class="table-responsive">
                                        <div class="col-sm-3">
                                            <input type="text" id="filter_date_3" name="filter_date" class="form-control dtpicker input-sm" value="" placeholder="Filter by Date" autocomplete="off">
                                        </div>
                                        <br />
                                        <br />
                                        <table class="table table-striped table-hover" id="table-po" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Status</th>
                                                    <th>Tanggal</th>
                                                    <th>Rekanan</th>
                                                    <th>Nomor</th>
                                                    <th>Subyek</th>
                                                    <th>Vol. PO</th>
                                                    <th>Presentase Penerimaan</th>
                                                    <th>Terima</th>
                                                    <th>Total Pesanan Pembelian</th>
                                                    <th>Total Terima</th>
                                                    <th>Upload</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="modal fade bd-example-modal-lg" id="modalDoc" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <span class="modal-title">Upload Document PO</span>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" enctype="multipart/form-data" method="POST" style="padding: 0 10px 0 20px;">
                                                    <input type="hidden" name="id" id="id_doc">
                                                    <div class="form-group">
                                                        <label>Upload Document</label>
                                                        <input type="file" id="file" name="file" class="form-control" required="" />
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success" id="btn-form-doc" style="font-weight:bold; width;10%; border-radius:10px;"> KIRIM</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-weight:bold; width;10%; border-radius:10px;">CLOSE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade bd-example-modal-lg" id="modalEditPo" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <span class="modal-title"><b>Edit Pesanan Pembelian</b></span>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" method="POST" style="padding: 0 10px 0 20px;">
                                                    <input type="hidden" name="id" id="id_po">
                                                    <div class="form-group">
                                                        <label>Subject</label>
                                                        <input type="text" id="subject_po_edit" name="subject" class="form-control" required="" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tgl. Pesanan Pembelian</label>
                                                        <input type="text" id="date_po_edit" name="date_po" class="form-control dtpicker-single" required="" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No. Pesanan Pembelian</label>
                                                        <input type="text" id="no_po_edit" name="no_po" class="form-control" required="" />
                                                        <input type="text" name="status" id="change_status"  required="">
                                                    </div>
                                                    
                                                    <!--<?php
                                                    if($this->session->userdata('admin_group_id') == 1){
                                                    ?>
                                                        <div class="form-group">
                                                            <label>Status Pesanan Pembelian</label>
                                                            <select id="change_status" name="status" class="form-control">
                                                                <option value="WAITING">WAITING</option>
                                                                <option value="PUBLISH">PUBLISH</option>
                                                                <option value="UNPUBLISH">UNPUBLISH</option>
                                                                <option value="REJECTED">REJECTED</option>
                                                                <option value="DRAFT">DRAFT</option>
                                                                <option value="CLOSED">CLOSED</option>
                                                            </select>
                                                        </div>
                                                    <?php
                                                    }   
                                                    ?>-->

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success" id="btn-no_po"> SIMPAN</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color:black; border-radius:10px;"><b>CLOSE</b></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pengiriman Pembelian -->
                                <div role="tabpanel" class="tab-pane" id="messages">
                                    <div class="row">
                                        <form action="<?php echo site_url('pmm/receipt_material/cetak_surat_jalan');?>" method="GET" target="_blank">
                                            <div class="col-sm-3">
                                                <input type="text" id="filter_date" name="filter_date" class="form-control dtpicker input-sm" value="" placeholder="Filter by Date" autocomplete="off">
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="filter_supplier_id" name="supplier_id" class="form-control select2">
                                                    <option value="">Pilih Rekanan</option>
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
                                                <select id="filter_po_id" name="purchase_order_id" class="form-control select2">
                                                    <option value="">Pilih PO</option>
                                                    <?php
                                                    foreach ($arr_po as $key => $po) {
                                                    ?>
                                                        <option value="<?php echo $po['id']; ?>" data-client-id="<?= $po['supplier_id'] ?>" disabled><?php echo $po['no_po']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <select id="material_id" name="material_id" class="form-control select2"">
                                                    <option value="">Pilih Produk</option>
                                                    <?php
                                                    foreach ($arr_produk as $key => $pd) {
                                                    ?>
                                                        <option value="<?php echo $pd['id']; ?>" data-client-id="<?= $pd['supplier_id'] ?>" disabled><?php echo $pd['nama_produk']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </select>
                                            </div>
                                            <br />
                                            <br />
                                            <div class="col-sm-6">
                                                <div class="text-left">
                                                    <input type="hidden" id="val-receipt-id" name="">
                                                    <button type="submit" class="btn btn-default" style="width:100px; font-weight:bold; border-radius:10px;">PRINT</button>
                                                    <button type="button" id="btn_production" class="btn btn-success" style="background-color:#88b93c; border:1px solid black; border-radius:10px;">BUAT PENAGIHAN</button>
                                                </div>
                                            </div>
                                            <br />
                                            <br />
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="table-receipt" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>No.</th>
                                                    <th>Status Tagihan</th>
                                                    <th>Tanggal</th>
                                                    <th>Rekanan</th>
                                                    <th>No. Pesanan Pembelian</th>
                                                    <th>No. Surat Jalan</th>
                                                    <th>Surat Jalan</th>
                                                    <th>Produk</th>
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
                                                        <button type="submit" class="btn btn-success" id="btn-form-doc-surat-jalan" style="font-weight:bold; width;10%; border-radius:10px;"> KIRIM</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-weight:bold; width;10%; border-radius:10px;"> CLOSE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tagihan Pembelian -->
                                <div role="tabpanel" class="tab-pane" id="settings">
                                    <form action="<?php echo site_url('laporan/cetak_daftar_tagihan_pembelian');?>" method="GET" target="_blank">
                                        <div class="col-sm-3">
                                                <input type="text" id="filter_date_4" name="filter_date" class="form-control dtpicker input-sm" value="" placeholder="Filter by Date" autocomplete="off">
                                        </div>
                                        <div class="col-sm-3">
                                            <select id="filter_supplier_tagihan" name="supplier_id" class="form-control select2">
                                                <option value="">Pilih Rekanan</option>
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
                                                <button type="submit" class="btn btn-default" style="width:100px; font-weight:bold; border-radius:10px;"><i class="fa fa-print"></i> Print</button>
                                            </div>
                                        </div>
                                    </form>   
                                    <br /><br />
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="table-tagihan" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Verif. Dok.</th>
                                                    <th>Verif. File</th>
                                                    <th>Status Tagihan</th>
                                                    <th>Tgl. Invoice</th>
                                                    <th>No. Invoice</th>
                                                    <th>Rekanan</th>
                                                    <th>No. Pesanan</th>
                                                    <th>Total</th>
                                                    <th>Pembayaran</th>
                                                    <th>Sisa Tagihan</th>
                                                    <th>Upload Verif.</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="modal fade bd-example-modal-lg" id="modalDocVerifikasi" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <span class="modal-title">Upload Dokumen Verifikasi Pembelian</span>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" enctype="multipart/form-data" method="POST" style="padding: 0 10px 0 20px;">
                                                    <input type="hidden" name="id" id="id_doc_verifikasi">
                                                    <div class="form-group">
                                                        <label>Upload Dokumen</label>
                                                        <input type="file" id="file" name="file" class="form-control" required="" />
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success" id="btn-form-doc-surat-jalan" style="font-weight:bold; width;10%; border-radius:10px;"> KIRIM</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-weight:bold; width;10%; border-radius:10px;"> CLOSE</button>
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
    </div>


    <div class="modal fade bd-example-modal-lg" id="modalForm" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title">Verifikasi Dokumen</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-verif-dok" class="form-horizontal" action="<?= site_url('pembelian/verif_dok_penagihan_pembelian'); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="penagihan_pembelian_id">
                        <div>DIISI OLEH VERIFIKATOR :</div>
                        <hr />
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nama Rekanan<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="supplier_name" name="supplier_name" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nomor Kontrak / PO<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-5">
                                <input type="text" id="no_po" name="nomor_po" class="form-control input-sm">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" id="tanggal_po" name="tanggal_po" class="form-control input-sm dtpicker-single">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nama Barang / Jasa<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="nama_barang_jasa" name="nama_barang_jasa" class="form-control input-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nilai Kontrak / PO<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="nilai_kontrak" name="nilai_kontrak" class="form-control input-sm numberformat">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nilai Tagihan ini (DPP)<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="nilai_tagihan" name="nilai_tagihan" class="form-control input-sm numberformat">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">PPN</label>
                            <div class="col-sm-8">
                                <input type="text" id="ppn_tagihan" name="ppn" class="form-control input-sm numberformat">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">PPh 23</label>
                            <div class="col-sm-8">
                                <input type="text" id="pph_tagihan" name="pph" class="form-control input-sm numberformat">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Total Tagihan<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="total_tagihan" name="total_tagihan" class="form-control input-sm numberformat">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Tanggal Invoice<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="tanggal_invoice" name="tanggal_invoice" class="form-control input-sm dtpicker-single">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Tanggal Diterima Proyek<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="" name="tanggal_diterima_proyek" class="form-control input-sm dtpicker-single">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Tanggal Lolos Verifikasi<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="" name="tanggal_lolos_verifikasi" class="form-control input-sm dtpicker-single">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Tanggal Diterima Pusat</label>
                            <div class="col-sm-8">
                                <input type="text" id="" name="tanggal_diterima_office" class="form-control input-sm dtpicker-single" readonly="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Metode Pembayaran<span class="required" aria-required="true">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="metode_pembayaran" name="metode_pembayaran" class="form-control input-sm">
                            </div>
                        </div>
                        <hr />
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th width="5%">A.</th>
                                    <th>KELENGKAPAN DATA (Lengkap dan Benar)</th>
                                    <th align="center">ADA / TIDAK</th>
                                    <th width="50%">KETERANGAN</th>
                                    <!--<th>DOKUMEN</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Invoice</td>
                                    <td align="center"><input type="checkbox" name="invoice" value="1"></td>
                                    <td><input type="text" name="invoice_keterangan" id="invoice_keterangan" class="form-control input-sm"></td>
                                    <!--<td>
                                        <div class="custom-file">
                                            <input type="hidden" class="form-control" name="invoice_file" id="invoice_file">
                                            <input type="file" class="custom-file-input" data-target="invoice_file">
                                            <button type="button" class="btn btn-primary btn-block custom-file-select"><span class="fa fa-upload"></span></button>
                                            <button type="button" class="btn btn-danger btn-block custom-file-remove" style="display:none"><span class="fa fa-times"></span></button>
                                        </div>
                                    </td>-->
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Kwitansi</td>
                                    <td align="center"><input type="checkbox" name="kwitansi" value="1"></td>
                                    <td><input type="text" name="kwitansi_keterangan" id="kwitansi_keterangan" class="form-control input-sm"></td>
                                    <!--<td>
                                        <div class="custom-file">
                                            <input type="hidden" class="form-control" name="kwitansi_file" id="kwitansi_file">
                                            <input type="file" class="custom-file-input" data-target="kwitansi_file">
                                            <button type="button" class="btn btn-primary btn-block custom-file-select"><span class="fa fa-upload"></span></button>
                                            <button type="button" class="btn btn-danger btn-block custom-file-remove" style="display:none"><span class="fa fa-times"></span></button>
                                        </div>
                                    </td>-->
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Faktur Pajak</td>
                                    <td align="center"><input type="checkbox" name="faktur" value="1"></td>
                                    <td><input type="text" name="faktur_keterangan" id="faktur_keterangan" class="form-control input-sm"></td>
                                    <!--<td>
                                        <div class="custom-file">
                                            <input type="hidden" class="form-control" name="faktur_file" id="faktur_file">
                                            <input type="file" class="custom-file-input" data-target="faktur_file">
                                            <button type="button" class="btn btn-primary btn-block custom-file-select"><span class="fa fa-upload"></span></button>
                                            <button type="button" class="btn btn-danger btn-block custom-file-remove" style="display:none"><span class="fa fa-times"></span></button>
                                        </div>
                                    </td>-->
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Berita Acara Pembayaran (BAP)</td>
                                    <td align="center"><input type="checkbox" name="bap" value="1"></td>
                                    <td><input type="text" name="bap_keterangan" class="form-control input-sm"></td>
                                    <!--<td>
                                        <div class="custom-file">
                                            <input type="hidden" class="form-control" name="bap_file" id="bap_file">
                                            <input type="file" class="custom-file-input" data-target="bap_file">
                                            <button type="button" class="btn btn-primary btn-block custom-file-select"><span class="fa fa-upload"></span></button>
                                            <button type="button" class="btn btn-danger btn-block custom-file-remove" style="display:none"><span class="fa fa-times"></span></button>
                                        </div>
                                    </td>-->
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Berita Acara Serah Terima (BAST)</td>
                                    <td align="center"><input type="checkbox" name="bast" value="1"></td>
                                    <td><input type="text" name="bast_keterangan" id="bast_keterangan" class="form-control input-sm"></td>
                                    <!--<td>
                                        <div class="custom-file">
                                            <input type="hidden" class="form-control" name="bast_file" id="bast_file">
                                            <input type="file" class="custom-file-input" data-target="bast_file">
                                            <button type="button" class="btn btn-primary btn-block custom-file-select"><span class="fa fa-upload"></span></button>
                                            <button type="button" class="btn btn-danger btn-block custom-file-remove" style="display:none"><span class="fa fa-times"></span></button>
                                        </div>
                                    </td>-->
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>Surat Jalan</td>
                                    <td align="center"><input type="checkbox" name="surat_jalan" value="1"></td>
                                    <td><input type="text" name="surat_jalan_keterangan" class="form-control input-sm"></td>
                                    <!--<td>
                                        <div class="custom-file">
                                            <input type="hidden" class="form-control" name="surat_jalan_file" id="surat_jalan_file">
                                            <input type="file" class="custom-file-input" data-target="surat_jalan_file">
                                            <button type="button" class="btn btn-primary btn-block custom-file-select"><span class="fa fa-upload"></span></button>
                                            <button type="button" class="btn btn-danger btn-block custom-file-remove" style="display:none"><span class="fa fa-times"></span></button>
                                        </div>
                                    </td>-->
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <td>Copy Kontrak/ PO</td>
                                    <td align="center"><input type="checkbox" name="copy_po" value="1"></td>
                                    <td><input type="text" name="copy_po_keterangan" id="copy_po_keterangan" class="form-control input-sm"></td>
                                    <!--<td>
                                        <div class="custom-file">
                                            <input type="hidden" class="form-control" name="copy_po_file" id="copy_po_file">
                                            <input type="file" class="custom-file-input" data-target="copy_po_file">
                                            <button type="button" class="btn btn-primary btn-block custom-file-select"><span class="fa fa-upload"></span></button>
                                            <button type="button" class="btn btn-danger btn-block custom-file-remove" style="display:none"><span class="fa fa-times"></span></button>
                                        </div>
                                    </td>-->
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Catatan</label>
                            <div class="col-sm-9">
                                <textarea id="catatan" class="form-control" name="catatan" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm" id="btn-form" style="font-weight:bold; width;10%; border-radius:10px;"> BATAL</button>
                                <button type="submit" class="btn btn-success btn-sm" id="btn-form" style="font-weight:bold; width;10%; border-radius:10px;"> KIRIM</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="detailVerifForm" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title">Verifikasi Dokumen</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <table class="" width="100%" border="0">
                            <tr>
                                <th width="30%">DIISI OLEH VERIFIKATOR</th>
                                <th width="2%">:</th>
                                <td width="68%" id="verifikator_d">-</td>
                            </tr>
                        </table>
                        <hr style="margin-top:10px;" />
                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <th width="30%">Nama Rekanan</th>
                                <th width="2%">:</th>
                                <td width="68%" id="supplier_name_d">-</td>
                            </tr>
                            <tr>
                                <th>Nomor Kontrak / PO</th>
                                <th>:</th>
                                <td id="no_po_d"></td>
                            </tr>
                            <tr>
                                <th>Nama Barang / Jasa</th>
                                <th>:</th>
                                <td id="nama_barang_jasa_d"></td>
                            </tr>
                            <tr>
                                <th>Nilai Kontrak / PO</th>
                                <th>:</th>
                                <td id="nilai_kontrak_d"></td>
                            </tr>
                            <tr>
                                <th>Nilai Tagihan ini (DPP)</th>
                                <th>:</th>
                                <td id="nilai_tagihan_d"></td>
                            </tr>
                            <tr>
                                <th>PPN</th>
                                <th>:</th>
                                <td id="ppn_d" class="numberformat"></td>
                            </tr>
                            <tr>
                                <th>PPh 23</th>
                                <th>:</th>
                                <td id="pph_d" class="numberformat"></td>
                            </tr>
                            <tr>
                                <th>Total Tagihan</th>
                                <th>:</th>
                                <td id="total_tagihan_d" class="numberformat"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Invoice</th>
                                <th>:</th>
                                <td id="tanggal_invoice_d"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Diterima Proyek</th>
                                <th>:</th>
                                <td id="tanggal_diterima_proyek_d"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Lolos Verifikasi</th>
                                <th>:</th>
                                <td id="tanggal_lolos_verifikasi_d"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Diterima Pusat</th>
                                <th>:</th>
                                <td ></td>
                            </tr>
                            <tr>
                                <th>Metode Pembayaran</th>
                                <th>:</th>
                                <td id="metode_pembayaran_d"></td>
                            </tr>
                        </table>
                        <hr />
                        <table class="table table-bordered table-condensed text-center">
                            <thead>
                                <tr>
                                    <th width="5%">A.</th>
                                    <th>KELENGKAPAN DATA<br />(Lengkap dan Benar)</th>
                                    <th>ADA / TIDAK</th>
                                    <th width="25%">KETERANGAN</th>
                                    <!--<th width="25%">DOKUMEN</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td align="left">Invoice</td>
                                    <td align="center" id="invoice_d"></td>
                                    <td id="invoice_keterangan_d"></td>
                                    <!--<td id="lampiran_invoice"></td>-->
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td align="left">Kwitansi</td>
                                    <td align="center" id="kwitansi_d"></td>
                                    <td id="kwitansi_keterangan_d"></td>
                                    <!--<td id="lampiran_kwitansi"></td>-->
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td align="left">Faktur Pajak</td>
                                    <td align="center" id="faktur_d"></td>
                                    <td id="faktur_keterangan_d"></td>
                                    <!--<td id="lampiran_faktur"></td>-->
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td align="left">Berita Acara Pembayaran (BAP)</td>
                                    <td align="center" id="bap_d"></td>
                                    <td id="bap_keterangan_d"></td>
                                    <!--<td id="lampiran_bap"></td>-->
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td align="left">Berita Acara Serah Terima (BAST)</td>
                                    <td align="center" id="bast_d"></td>
                                    <td id="bast_keterangan_d"></td>
                                    <!--<td id="lampiran_bast"></td>-->
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td align="left">Surat Jalan</td>
                                    <td align="center" id="surat_jalan_d"></td>
                                    <td id="surat_jalan_keterangan_d"></td>
                                    <!--<td id="lampiran_surat_jalan"></td>-->
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <td align="left">Copy Kontrak/ PO</td>
                                    <td align="center" id="copy_po_d"></td>
                                    <td id="copy_po_keterangan_d"></td>
                                    <!--<td id="lampiran_copy_po"></td>-->
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label class="col-sm-2">Catatan :</label>
                            <div id="catatan_d" class="col-sm-9">

                            </div>
                        </div>
                    </form>
                    <form method="GET" target="_blank" action="<?php echo site_url('pembelian/print_verifikasi_penagihan_pembelian'); ?>">
                        <input type="hidden" name="id" id="verifikasi_penagihan_pembelian_id">
                        <div class="text-right">
                            <button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </form>
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

    <!-- Script Penawaran -->
    <script type="text/javascript">
    
    $('input#contract').number(true, 0, ',', '.');
    $('input.numberformat').number(true, 0, ',', '.');
    
    tinymce.init({
    selector: 'textarea#about_text',
    height: 200,
    menubar: false,
    });

    $('.dtpicker-single').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });

    $('.dtpicker-single').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
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

    var table = $('#guest-table').DataTable( {"bAutoWidth": false,
        ajax: {
            processing: true,
            serverSide: true,
            url: '<?php echo site_url('pembelian/table_penawaran_pembelian'); ?>',
            type: 'POST',
            data: function(d) {
                d.filter_date = $('#filter_date_2').val();
            }
        },
        "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
        columns: [{
                "data": "no"
            },
            {
                "data": "status"
            },
            {
                "data": "tanggal_penawaran"
            },
            {
                "data": "nomor_penawaran"
            },
            {
                "data": "supplier"
            },
            {
                "data": "jenis_pembelian"
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
        pageLength: 25,
    });

    $('#filter_date_2').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
        table.ajax.reload();
    });

    </script>
		
    <!-- Script Permintaan Bahan & Alat -->
    <script type="text/javascript">
    
    $('.filter_date_b').daterangepicker({
        autoUpdateInput: false,
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY'
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    $('.filter_date_b').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            table_request.ajax.reload();
    });

    var table_request = $('#table-request').DataTable( {"bAutoWidth": false,
        ajax: {
            processing: true,
            serverSide: true,
            url: '<?php echo site_url('pmm/request_materials/table');?>',
            type : 'POST',
            data: function ( d ) {
                d.schedule_id = $('#filter_schedule_id_b').val();
                d.supplier_id = $('#filter_supplier_id_b').val();
                d.status = $('#filter_status').val();
                d.filter_date = $('#filter_date_b').val();
            }
        },
        columns: [
            { "data": "no" },
            { "data": "status" },
            { "data": "request_date" },
            { "data": "request_no" },
            { "data": "subject" },
            { "data": "supplier_name" }, 
            { "data": "volume" },
            { "data": "actions" },
            { "data": "delete" }

        ],
        "columnDefs": [
            { "width": "5%", "targets": 0, "className": 'text-center'},
            { "targets": 6, "className": 'text-right'},
        ],
        responsive: true,
        pageLength: 25,
    });

    $('#filter_status').change(function(){
        table_request.ajax.reload();
    });
    $('#filter_supplier_id_b').change(function(){
        table_request.ajax.reload();
    });
    $('#filter_schedule_id_b').change(function(){
        table_request.ajax.reload();
    });



    function OpenFormRequest(id='')
    {   
        
        $('#modalRequest').modal('show');
        $('#id_Request').val('');
        $('#request_date').val('<?php echo date('d-m-Y');?>');
        $("#modalRequest form").trigger("reset");
        if(id !== ''){
            $('#id').val(id);
            getData(id);
        }
    }

    $('#modalRequest form').submit(function(event){
        $('#btn-form').button('loading');
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('pmm/request_materials/form_process'); ?>/"+Math.random(),
            dataType : 'json',
            data: $(this).serialize(),
            success : function(result){
                $('#btn-form').button('reset');
                if(result.output){
                    $("#modalRequest form").trigger("reset");
                    table_request.ajax.reload();

                    $('#modalRequest').modal('hide');
                }else if(result.err){
                    bootbox.alert(result.err);
                }
            }
        });

        event.preventDefault();
        
    });

    function getDataRequest(id)
    {
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('pmm/request_materials/get_data'); ?>",
            dataType : 'json',
            data: {id:id},
            success : function(result){
                if(result.output){
                    $('#id_Request').val(result.output.id);
                    $('#schedule_id_request').val(result.output.schedule_id);
                    $('#supplier_id').val(result.output.supplier_id);
                    $('#kategori_id').val(result.output.kategori_id);
                    $('#subject').val(result.output.subject);
                    $('#week').val(result.output.week);
                    $('#request_date').val(result.output.request_date);
                    // $('#status').val(result.output.status);
                }else if(result.err){
                    bootbox.alert(result.err);
                }
            }
        });
    }


    function DeleteDataRequest(id)
    {
        bootbox.confirm("Apakah anda yakin menghapus data ini ?", function(result){ 
            // console.log('This was logged in the callback: ' + result); 
            if(result){
                $.ajax({
                    type    : "POST",
                    url     : "<?php echo site_url('pmm/request_materials/delete'); ?>",
                    dataType : 'json',
                    data: {id:id},
                    success : function(result){
                        if(result.output){
                            table_request.ajax.reload();
                            bootbox.alert('<b>DELETED</b>');
                        }else if(result.err){
                            bootbox.alert(result.err);
                        }
                    }
                });
            }
        });
    }

    </script>
		
    <!-- Script Pesanan Pembelian -->
    <script type="text/javascript">
    
    var table_po = $('#table-po').DataTable( {"bAutoWidth": false,
        ajax: {
            processing: true,
            serverSide: true,
            url: '<?php echo site_url('pembelian/table_pesanan_pembelian'); ?>',
            type: 'POST',
            data: function(d) {
                d.filter_date = $('#filter_date_3').val();
            }
        },
        columns: [{
                "data": "no"
            },
            {
                "data": "status"
            },
            {
                "data": "date"
            },
            {
                "data": "supplier"
            },
            {
                "data": "no_po"
            },
            {
                "data": "subject"
            },
            {
                "data": "volume"
            },
            {
                "data": "presentase"
            },
            {
                "data": "receipt"
            },
            {
                "data": "total"
            },
            {
                "data": "total_receipt"
            },
            {
                "data": "actions"
            },
        ],
        "columnDefs": [
            { "width": "5%", "targets": 0, "className": 'text-center'},
            { "targets": [6, 7, 8, 9, 10], "className": 'text-right'},
        ],
        responsive: true,
        pageLength: 25,
    });

    $('#filter_date_3').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
        table_po.ajax.reload();
    });

    </script>
		
    <!-- Script Pengiriman Pembelian -->
    <script type="text/javascript">

    var table_receipt = $('#table-receipt').DataTable( {"bAutoWidth": false,
        ajax: {
            processing: true,
            serverSide: true,
            url: '<?php echo site_url('pmm/receipt_material/table_detail'); ?>',
            type: 'POST',
            data: function(d) {
                d.purchase_order_id = $('#filter_po_id').val();
                d.supplier_id = $('#filter_supplier_id').val();
                d.filter_date = $('#filter_date').val();
                d.material_id = $('#material_id').val();
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
                "data": "date_receipt"
            },
            {
                "data": "supplier_name"
            },
            {
                "data": "no_po"
            },
            {
                "data": "surat_jalan"
            },
            {
                "data": "surat_jalan_file"
            },
            {
                "data": "material_name"
            },
            {
                "data": "display_measure"
            },
            {
                "data": "display_volume"
            },
            {
                "data": "uploads_surat_jalan"
            }
        ],
        select: {
            style: 'multi'
        },
        responsive: true,
        pageLength: 10,
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
                "checkboxes": {
                    "selectRow": true
                }
            },
            { "width": "5%", "targets": [1,11], "className": 'text-center'},
            { "targets": 10, "className": 'text-right'},
        ],
    });

    $('#btn_production').click(function() {
        var data_receipt = table_receipt.rows({selected: true}).data();
        
        var send_data = '';
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

                window.location.href = '<?php echo site_url('pembelian/penagihan_pembelian/'); ?>' + send_data;
                }
                
            }
        });

    });

    $('#filter_date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
        table_receipt.ajax.reload();
    });

    function GetPO() {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pmm/receipt_material/get_po_by_supp'); ?>/" + Math.random(),
            dataType: 'json',
            data: {
                supplier_id: $('#filter_supplier_id').val(),
            },
            success: function(result) {
                if (result.data) {
                    $('#filter_po_id').empty();
                    $('#filter_po_id').select2({
                        data: result.data
                    });
                    $('#filter_po_id').trigger('change');
                } else if (result.err) {
                    bootbox.alert(result.err);
                }
            }
        });
    }

    $('#filter_supplier_id').on('select2:select', function(e) {
        var data = e.params.data;
        console.log(data);
        table_receipt.ajax.reload();

        $('#filter_po_id option[data-client-id]').prop('disabled', true);
        $('#filter_po_id option[data-client-id="' + data.id + '"]').prop('disabled', false);
        $('#filter_po_id').select2('destroy');
        $('#filter_po_id').select2();
    });

    $('#filter_po_id').change(function() {
        table_receipt.ajax.reload();
    });

    function SelectMatByPo() {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pmm/receipt_material/get_mat_pembelian'); ?>/" + Math.random(),
            dataType: 'json',
            data: {
                purchase_order_id: $('#filter_po_id').val(),
                material_id: $('#material_id').val(),
            },
            success: function(result) {
                if (result.data) {
                    $('#material_id').empty();
                    $('#material_id').select2({
                        data: result.data
                    });
                    $('#material_id').trigger('change');
                } else if (result.err) {
                    bootbox.alert(result.err);
                }
            }
        });
    }

    $('#filter_po_id').change(function(){

    $('#filter_po_id').val($(this).val());
        table_receipt.ajax.reload();
        SelectMatByPo();
    });

    $('#material_id').change(function() {
        table_receipt.ajax.reload();
    });
    
    </script>
		
    <!-- Script Tagihan Pembelian -->
    <script type="text/javascript">

    var table_tagihan = $('#table-tagihan').DataTable( {"bAutoWidth": false,
        ajax: {
            processing: true,
            serverSide: true,
            url: '<?php echo site_url('pembelian/table_penagihan_pembelian'); ?>',
            type: 'POST',
            data: function(d) {
                d.filter_date = $('#filter_date_4').val();
                d.supplier_id = $('#filter_supplier_tagihan').val();
            }
        },
        columns: [
            {
                "data": "no"
            },
            {
                "data": "verifikasi_dok"
            },
            {
                "data": "verifikasi_file"
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
                "data": "supplier"
            },
            {
                "data": "no_po"
            },
            {
                "data": "total"
            },
            {
                "data": "pembayaran"
            },
            {
                "data": "sisa_tagihan"
            },
            {
                "data": "document_verifikasi"
            },
        ],
        "columnDefs": [
            { "width": "5%", "targets": 0, "className": 'text-center'},
            { "targets": 7, "className": 'text-left'},
            { "targets": [8, 9, 10], "className": 'text-right'},
            { "width": "5%", "targets": 11, "className": 'text-center'},
        ],
        responsive: true,
        pageLength: 25,
    });
    
    $('#filter_date_4').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
        table_tagihan.ajax.reload();
    });

    $('#filter_supplier_tagihan').change(function() {
        table_tagihan.ajax.reload();
    });

    function VerifDok(id) {

        $('#modalForm').modal('show');
        $('#id').val('');
        $('#id').val(id);
        getData(id);
    }

    function VerifDokDetail(id) {

        $('#detailVerifForm').modal('show');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pembelian/get_verif_penagihan_pembelian'); ?>",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(result) {
                if (result.data) {
                    $('#supplier_name_d').text(result.data.supplier_name);
                    $('#no_po_d').text(result.data.nomor_po + ' - ' + result.data.tanggal_po);
                    $('#nama_barang_jasa_d').text(result.data.nama_barang_jasa);
                    $('#nilai_kontrak_d').text(result.data.nilai_kontrak);
                    $('#nilai_tagihan_d').text(result.data.nilai_tagihan);
                    $('#ppn_d').text(result.data.ppn);
                    $('#pph_d').text(result.data.pph);
                    $('#total_tagihan_d').text(result.data.total_tagihan);
                    $('#tanggal_invoice_d').text(result.data.tanggal_invoice);
                    $('#tanggal_diterima_proyek_d').text(result.data.tanggal_diterima_proyek);
                    $('#tanggal_lolos_verifikasi_d').text(result.data.tanggal_lolos_verifikasi);
                    $('#tanggal_diterima_office_d').text(result.data.tanggal_diterima_office);
                    $('#metode_pembayaran_d').text(result.data.metode_pembayaran);
                    $('#invoice_keterangan_d').text(result.data.invoice_keterangan);
                    $('#kwitansi_keterangan_d').text(result.data.kwitansi_keterangan);
                    $('#faktur_keterangan_d').text(result.data.faktur_keterangan);
                    $('#bap_keterangan_d').text(result.data.bap_keterangan);
                    $('#bast_keterangan_d').text(result.data.bast_keterangan);
                    $('#surat_jalan_keterangan_d').text(result.data.surat_jalan_keterangan);
                    $('#copy_po_keterangan_d').text(result.data.copy_po_keterangan);
                    $('#catatan_d').text(result.data.catatan);
                    $('#verifikator_d').text(result.data.verifikator);
                    $('#verifikasi_penagihan_pembelian_id').val(result.data.id);
                    if (result.data.invoice == 1) {
                        $("#invoice_d").html('<i class="fa fa-check"></i>');
                    } else {
                        $("#invoice_d").html('<i class="fa fa-close"></i>');
                    }
                    if (result.data.kwitansi == 1) {
                        $("#kwitansi_d").html('<i class="fa fa-check"></i>');
                    } else {
                        $("#kwitansi_d").html('<i class="fa fa-close"></i>');
                    }
                    if (result.data.faktur == 1) {
                        $("#faktur_d").html('<i class="fa fa-check"></i>');
                    } else {
                        $("#faktur_d").html('<i class="fa fa-close"></i>');
                    }
                    if (result.data.bap == 1) {
                        $("#bap_d").html('<i class="fa fa-check"></i>');
                    } else {
                        $("#bap_d").html('<i class="fa fa-close"></i>');
                    }
                    if (result.data.bast == 1) {
                        $("#bast_d").html('<i class="fa fa-check"></i>');
                    } else {
                        $("#bast_d").html('<i class="fa fa-close"></i>');
                    }
                    if (result.data.surat_jalan == 1) {
                        $("#surat_jalan_d").html('<i class="fa fa-check"></i>');
                    } else {
                        $("#surat_jalan_d").html('<i class="fa fa-close"></i>');
                    }
                    if (result.data.copy_po == 1) {
                        $("#copy_po_d").html('<i class="fa fa-check"></i>');
                    } else {
                        $("#copy_po_d").html('<i class="fa fa-close"></i>');
                    }


                    if (result.data.invoice_file) {
                        $('#lampiran_invoice').html('<a target="_blank" href="/' + result.data.invoice_file + '"><span class="fa fa-download"></span> Download</a>');
                    }

                    if (result.data.kwitansi_file) {
                        $('#lampiran_kwitansi').html('<a target="_blank" href="/' + result.data.kwitansi_file + '"><span class="fa fa-download"></span> Download</a>');
                    }

                    if (result.data.faktur_file) {
                        $('#lampiran_faktur').html('<a target="_blank" href="/' + result.data.faktur_file + '"><span class="fa fa-download"></span> Download</a>');
                    }

                    if (result.data.bap_file) {
                        $('#lampiran_bap').html('<a target="_blank" href="/' + result.data.bap_file + '"><span class="fa fa-download"></span> Download</a>');
                    }

                    if (result.data.bast_file) {
                        $('#lampiran_bast').html('<a target="_blank" href="/' + result.data.bast_file + '"><span class="fa fa-download"></span> Download</a>');
                    }

                    if (result.data.surat_jalan_file) {
                        $('#lampiran_surat_jalan').html('<a target="_blank" href="/' + result.data.surat_jalan_file + '"><span class="fa fa-download"></span> Download</a>');
                    }

                    if (result.data.copy_po_file) {
                        $('#lampiran_copy_po').html('<a target="_blank" href="/' + result.data.copy_po_file + '"><span class="fa fa-download"></span> Download</a>');
                    }
                } else if (result.err) {
                    bootbox.alert(result.err);
                }
            }
        });
    }

    function getData(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pembelian/get_penagihan_pembelian'); ?>",
            dataType: 'json',
            data: {
                id: id
            },
            success: function(result) {
                if (result.data) {
                    $('#penagihan_pembelian_id').val(result.data.id);
                    $('#supplier_name').val(result.data.supplier_name);
                    $('#metode_pembayaran').val(result.data.metode_pembayaran);
                    $('#no_po').val(result.data.no_po);
                    $('#tanggal_po').val(result.data.tanggal_po);
                    $('#nama_barang_jasa').val(result.data.nama_produk);
                    $('#nilai_kontrak').val(result.data.nilai_kontrak);
                    $('#nilai_tagihan').val(result.data.nilai_tagihan);
                    $('#tanggal_invoice').val(result.data.tanggal_invoice);
                    $('#ppn_tagihan').val(result.data.ppn);
                    $('#pph_tagihan').val(result.data.pph);
                    $('#total_tagihan').val(result.data.total);
                } else if (result.err) {
                    bootbox.alert(result.err);
                }
            }
        });
    }

    $('#form-verif-dok').submit(function(event) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pembelian/verif_dok_penagihan_pembelian'); ?>/" + Math.random(),
            dataType: 'json',
            data: $(this).serialize(),
            success: function(result) {
                $('#btn-form').button('reset');
                if (result.output) {
                    $("#form-verif-dok").trigger("reset");
                    table_tagihan.ajax.reload();
                    $('#modalForm').modal('hide');
                } else if (result.err) {
                    bootbox.alert(result.err);
                }
            }
        });

        event.preventDefault();

    });

    function UploadDoc(id) {

        $('#modalDoc').modal('show');
        $('#id_doc').val(id);
    }

    function EditNoPo(id, no_po, status, subject, date_po) {
        $('#modalEditPo').modal('show');
        $('#id_po').val(id);
        $('#no_po_edit').val(no_po);
        $('#change_status').val(status);
        $('#subject_po_edit').val(subject);
        $('#date_po_edit').val(date_po);
    }

    $('#modalDoc form').submit(function(event) {
        $('#btn-form-doc').button('loading');

        var form = $(this);
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pmm/purchase_order/form_document'); ?>/" + Math.random(),
            dataType: 'json',
            data: formdata ? formdata : form.serialize(),
            success: function(result) {
                $('#btn-form-doc').button('reset');
                if (result.output) {
                    $("#modalDoc form").trigger("reset");
                    table_po.ajax.reload();

                    $('#modalDoc').modal('hide');
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

    $('#modalEditPo form').submit(function(event) {
        $('#btn-no_po').button('loading');

        var form = $(this);
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pmm/purchase_order/edit_no_po'); ?>/" + Math.random(),
            dataType: 'json',
            data: formdata ? formdata : form.serialize(),
            success: function(result) {
                $('#btn-no_po').button('reset');
                if (result.output) {
                    $("#modalEditPo form").trigger("reset");
                    table_po.ajax.reload();

                    $('#modalEditPo').modal('hide');
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

    $(document).ready(function(e) {
        $('.custom-file-select').click(function(e) {
            $(this).closest('.custom-file').find('input[type="file"]').click();
        });

        $('.custom-file-input').change(function(e) {

            let target = $(this).data('target');
            let files = this.files;

            const reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onload = function() {
                let temp = reader.result.split('base64,');
                let param = files[0].name + '|' + temp[temp.length - 1];
                $('#' + target).val(param);
                $('#' + target).closest('.custom-file').find('.custom-file-select').hide();
                $('#' + target).closest('.custom-file').find('.custom-file-remove').show();
            };

            reader.onerror = error => console.error(error);
        });

        $('.custom-file-remove').click(function(e) {
            $(this).closest('.custom-file').find('input[type="hidden"]').val('');
            $(this).hide();
            $(this).closest('.custom-file').find('.custom-file-select').show();
        });
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
            url: "<?php echo site_url('pmm/receipt_material/form_document'); ?>/" + Math.random(),
            dataType: 'json',
            data: formdata ? formdata : form.serialize(),
            success: function(result) {
                $('#btn-form-doc-surat-jalan').button('reset');
                if (result.output) {
                    $("#modalDocSuratJalan form").trigger("reset");
                    table_receipt.ajax.reload();

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

    function UploadDocVerifikasi(id) {

    $('#modalDocVerifikasi').modal('show');
    $('#id_doc_verifikasi').val(id);
    }

    $('#modalDocVerifikasi form').submit(function(event) {
        $('#btn-form-doc-verifikasi').button('loading');

        var form = $(this);
        var formdata = false;
        if (window.FormData) {
            formdata = new FormData(form[0]);
        }

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pmm/receipt_material/form_document_verifikasi'); ?>/" + Math.random(),
            dataType: 'json',
            data: formdata ? formdata : form.serialize(),
            success: function(result) {
                $('#btn-form-doc-verifikasi').button('reset');
                if (result.output) {
                    $("#modalDocVerifikasi form").trigger("reset");
                    table_tagihan.ajax.reload();

                    $('#modalDocVerifikasi').modal('hide');
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