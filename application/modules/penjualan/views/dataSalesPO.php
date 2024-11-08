<!doctype html>
<html lang="en" class="fixed">

<?php include 'lib.php'; ?>

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
                                <h3><b>DETAIL SALES ORDER <?php echo $this->pmm_model->GetStatus2($sales_po['status']);?></b></h3>
                                <div class="text-left">
                                        <a href="<?php echo site_url('admin/penjualan');?>">
                                        <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                                    </div>
                            </div>
                        </div>
                        <div class="panel-content">
                            <table class="table table-striped table-bordered" width="100%">
                                <tr>
                                    <th width="20%" align="left">Rekanan</th>
                                    <th width="80%" align="left"><label class="label label-default" style="font-size:14px;"><?= $client["nama"] ?></label></th>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th><textarea class="form-control" rows="5" readonly=""><?= $sales_po["client_address"] ?></textarea></th>
                                </tr>
                                <tr>
                                    <th>No. Penawaran</th>
                                    <th><a target="_blank" href="<?= base_url("penjualan/detailPenawaran/".$sales_po_detail['penawaran_id']) ?>"><?php echo $this->crud_global->GetField('pmm_penawaran_penjualan',array('id'=>$sales_po_detail['penawaran_id']),'nomor');?></a></th>   
                                </tr>
                            </table>
                            <table class="table table-striped table-bordered" width="100%">
                                <tr>
                                    <th width="20%" align="left">No. Sales Order</th>
                                    <th width="80%" align="left"><label class="label label-info" style="font-size:14px;"><?= $sales_po["contract_number"]; ?></label></th>
                                </tr>
                                <tr>
                                    <th>Jenis Pekerjaan</th>
                                    <th><?= $sales_po["jobs_type"]; ?></th>
                                </tr>
                                <tr>
                                    <th>Tanggal Kontrak</th>
                                    <th><?= date('d/m/Y',strtotime($sales_po["contract_date"]));?></th>
                                </tr>
                                <tr>
                                    <th>Memo</th>
                                    <th class="text-left" colspan="6"><?= $sales_po["memo"] ?></th>
                                </tr>
                                <tr>
                                    <th>Lampiran</th>
                                    <th>
                                        <?php foreach($lampiran as $l) : ?>                                    
                                        <a href="<?= base_url("uploads/sales_po/".$l["lampiran"]) ?>" target="_blank"><?= $l["lampiran"] ?><br></a></td>
                                        <?php endforeach; ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Dibuat Oleh</th>
                                    <th><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$sales_po['created_by']),'admin_name');?></th>
                                </tr>
                                <tr>
                                    <th>Dibuat Tanggal</th>
                                    <th><?= date('d/m/Y H:i:s',strtotime($sales_po['created_on']));?></th>
                                </tr>
                            </table>    
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="50px">No</th>
                                        <th class="text-center" >Produk</th>
                                        <th class="text-center" >Volume</th>
                                        <th class="text-center" width="100px">Satuan</th>
                                        <th class="text-center" >Harga Satuan</th>
                                        <th class="text-center" >Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subtotal = 0;
                                    $tax_pph = 0;
                                    $tax_ppn = 0;
                                    $tax_ppn11 = 0;
                                    $tax_pph22new = 0;
                                    $tax_pph22 = 0;
                                    $tax_0 = false;
                                    $total = 0;

                                    ?>
                                    <?php foreach($details as $no => $d) : ?>
                                        <?php
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no + 1;?></td>
                                            <td class="text-left"><?= $d["nama_produk"] ?></td>
                                            <td class="text-center"><?= number_format($d['qty'],2,',','.'); ?></td>
                                            <td class="text-center"><?= $d["measure"]; ?></td>
                                            <td class="text-right"><?= number_format($d['price'],0,',','.'); ?></td>
                                            <td class="text-right"><?= number_format($d['total'],0,',','.'); ?></td>
                                        </tr>

                                        <?php
                                        $subtotal += $d['total'];
                                        if($d['tax_id'] == 4){
                                            $tax_0 = true;
                                        }
                                        if($d['tax_id'] == 3){
                                            $tax_ppn += $d['tax'];
                                        }
                                        if($d['tax_id'] == 5){
                                            $tax_pph += $d['tax'];
                                        }
                                        if($d['tax_id'] == 6){
                                            $tax_ppn11 += $d['tax'];
                                        }
                                        if($d['tax_id'] == 7){
                                            $tax_pph22new += $d['tax'];
                                        }
                                        if($d['pajak_id'] == 7){
                                            $tax_pph22 += $d['pajak'];
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Sub Total</th>
                                        <th  class="text-right"><?= number_format($subtotal,0,',','.'); ?></th>
                                    </tr>
                                    <?php
                                    if($tax_ppn > 0){
                                        ?>
                                        <tr>
                                            <th colspan="5" class="text-right">Pajak (PPN 10%)</th>
                                            <th  class="text-right"><?= number_format($tax_ppn,0,',','.'); ?></th>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if($tax_0){
                                        ?>
                                        <tr>
                                            <th colspan="5" class="text-right">Pajak (PPN 0%)</th>
                                            <th  class="text-right"><?= number_format(0,0,',','.'); ?></th>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if($tax_pph > 0){
                                        ?>
                                        <tr>
                                            <th colspan="5" class="text-right">Pajak (PPh 23)</th>
                                            <th  class="text-right"><?= number_format($tax_pph,0,',','.'); ?></th>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if($tax_ppn11 > 0){
                                        ?>
                                        <tr>
                                            <th colspan="5" class="text-right">Pajak (PPN 11%)</th>
                                            <th  class="text-right"><?= number_format($tax_ppn11,0,',','.'); ?></th>
                                        </tr>
                                        <?php
                                    }

                                    if($tax_pph22new > 0){
                                        ?>
                                        <tr>
                                            <th colspan="5" class="text-right">Pajak (PPh 22)</th>
                                            <th  class="text-right"><?= number_format($tax_pph22new,0,',','.'); ?></th>
                                        </tr>
                                        <?php
                                    }

                                    if($tax_pph22 > 0){
                                        ?>
                                        <tr>
                                            <th colspan="5" class="text-right">Pajak (PPh 22)</th>
                                            <th  class="text-right"><?= number_format($tax_pph22,0,',','.'); ?></th>
                                        </tr>
                                        <?php
                                    }
                                    
                                    $total = $subtotal + $tax_ppn - $tax_pph + $tax_ppn11 - $tax_pph22new - $tax_pph22;
                                    ?>
                                    
                                    <tr>
                                        <th colspan="5" class="text-right">TOTAL</th>
                                        <th  class="text-right"><?= number_format($total,0,',','.'); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                            
                            <div class="text-right">
                                <a href="<?php echo site_url('admin/penjualan#profile'); ?>" class="btn btn-info" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;"> KEMBALI</a>

                                <?php if($sales_po["status"] === "DRAFT") : ?>
                                    <a href="<?= base_url("penjualan/cetak_sales_order_draft/".$sales_po["id"]) ?>" target="_blank" class="btn btn-default" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;"> PRINT (DRAFT)</a>
                                    
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4){
                                    ?>
                                        <a href="<?= site_url('penjualan/approvalSalesPO/' . $sales_po['id']); ?>" class="btn btn-success" style="margin-bottom:0px; width:150px; font-weight:bold; border-radius:10px;"> SETUJUI</a>
                                    <a href="<?= site_url('penjualan/rejectedSalesPO/' . $sales_po['id']); ?>" class="btn btn-danger" style="margin-bottom:0px; width:150px; font-weight:bold; border-radius:10px;"> TOLAK</a>
                                    <?php
                                    }
                                    ?>
                                    <?php endif;
                                ?>

                                <?php if($sales_po["status"] === "OPEN") : ?>
                                <a href="<?= base_url("penjualan/cetak_sales_order/".$sales_po["id"]) ?>" target="_blank" class="btn btn-default" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;"> PRINT</a>
                                
                                <a href="<?= base_url("pmm/productions/add?po_id=".$sales_po["id"]) ?>"  class="btn btn-default" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;"> KIRIM PRODUK</a>
                                
                                <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                    ?>
                                        <form class="form-approval" action="<?= base_url("penjualan/closed_sales_order/".$sales_po["id"]) ?>">
                                            <button type="submit" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> CLOSED</button>
                                            <a href="<?= site_url('penjualan/reject_sales_order/' . $sales_po["id"]); ?>" class="btn btn-default" style="width:150px; font-weight:bold; margin-bottom:10px; border-radius:10px;"> REJECT</a>      
                                        </form>
                                        				
                                    <?php
                                    }
                                    ?>
                                    <?php endif;
                                ?>
                            
                                <?php if($sales_po["status"] === "CLOSED") : ?>
                                <a href="<?= base_url("penjualan/cetak_sales_order/".$sales_po["id"]) ?>" target="_blank" class="btn btn-default" style="margin-bottom:0px; width:150px; font-weight:bold; border-radius:10px;"> PRINT</a>
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                    ?>
                                        <a class="btn btn-default" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;" href="<?= base_url("penjualan/open_sales_order/".$sales_po["id"]) ?>"> OPEN</a>
                                        <a href="<?= site_url('penjualan/reject_sales_order/' . $sales_po["id"]); ?>" class="btn btn-default" style="width:150px; font-weight:bold; margin-bottom:10px; border-radius:10px;"> REJECT</a>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1){
                                    ?>
                                        <a class="btn btn-default" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('penjualan/hapus_sales_po/'.$sales_po['id']);?>')"> HAPUS</a>
                                    <?php
                                    }
                                    ?>
                                <?php endif; ?>

                                <?php if($sales_po["status"] === "REJECT") : ?>
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1){
                                        ?>
                                        <a class="btn btn-default" style="margin-top:10px; width:150px; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('penjualan/hapus_sales_po/'.$sales_po['id']);?>')"> HAPUS</a>
                                                        
                                    <?php
                                    }
                                    ?>
                                <?php endif; ?>
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
        
        $('.form-approval').submit(function(e){
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

        function DeleteData(href)
        {
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
                        window.location.href = href;
                    }
                    
                }
            });
        }

    </script>
    

</body>
</html>
