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
                                <h3><b>DETAIL PESANAN PEMBELIAN <?php echo $this->pmm_model->GetStatus($data['status']);?></b></h3>
                                <div class="text-left">
                                    <a href="<?php echo site_url('admin/pembelian');?>">
                                    <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                            </div>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form id="form-po" class="form-horizontal">
                                        <table class="table table-striped table-bordered" width="100%">
                                            <tr>
                                                <th width="20%" align="left">Rekanan</th>
                                                <th width="80%" align="left"><label class="label label-default" style="font-size:14px;"><?php echo $supplier_name;?></label></th>
                                                <input type="hidden" id="supplier_id" name="supplier_id" class="form-control" value="<?php echo $data['supplier_id'];?>">
                                                <input type="hidden" class="form-control" id="date_pkp" value="<?php echo date('d-m-Y',strtotime('10-02-2021'));?>" readonly="">
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <th style="font-weight:normal;"><textarea id="address_supplier"  class="form-control" rows="5" readonly=""><?php echo $address_supplier;?></textarea></th>
                                            </tr>
                                            <tr>
                                                <th>NPWP</th>
                                                <th style="font-weight:normal;"><?php echo $npwp_supplier;?></th>
                                            </tr>
                                            <?php foreach ($details_pnw as $x): ?>
                                            <tr>
                                                <th>No. Penawaran</th>
                                                <th style="font-weight:normal;"><a target="_blank" href="<?= base_url("pembelian/penawaran_pembelian_detail/".$x['penawaran_id']) ?>"><?php echo $this->crud_global->GetField('pmm_penawaran_pembelian',array('id'=>$x['penawaran_id']),'nomor_penawaran');?></a></th>   
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php foreach ($details_req as $x): ?>
                                            <tr>
                                                <th>No. Permintaan Bahan & Alat</th>
                                                <th style="font-weight:normal;"><a target="_blank" href="<?= base_url("pmm/request_materials/manage/".$x['request_material_id']) ?>"><?php echo $this->crud_global->GetField('pmm_request_materials',array('id'=>$x['request_material_id']),'request_no');?></a></th>   
                                            </tr>
                                            <?php endforeach; ?>
                                        </table>
                                        <table class="table table-striped table-bordered" width="100%">
                                            <tr>
                                                <th width="20%" align="left">No. Pesanan Pembelian</th>
                                                <th width="80%" align="left"><label class="label label-success" style="font-size:14px;font-weight:bold;"><?php echo $data['no_po'];?></label></th>
                                            </tr>
                                            <tr>
                                                <th>Subjek</th>
                                                <th style="font-weight:normal;"><input type="text" class="form-control text-left" id="subject" value="<?php echo $data['subject'];?>" readonly=""></th>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pesanan Pembelian</th>
                                                <th style="font-weight:normal;"><input type="text" id="date_po" class="form-control dtpicker" value="<?php echo date('d-m-Y',strtotime($data['date_po']));?>" readonly=""></th>
                                            </tr>
                                            <tr>
                                                <th>Memo</th>
                                                <th style="font-weight:normal;" class="text-left" colspan="6"><?php echo $data['memo'];?></th>
                                            </tr>
                                            <tr>
                                                <th>Lampiran</th>
                                                <th style="font-weight:normal;"><a href="<?= base_url("uploads/purchase_order/".$data["document_po"]) ?>" target="_blank"><?php echo $data['document_po'];?></a></th>
                                            </tr>
                                            <tr>
                                                <th>Dibuat Oleh</th>
                                                <th style="font-weight:normal;"><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$data['created_by']),'admin_name');?></th>
                                            </tr>
                                            <tr>
                                                <th>Dibuat Tanggal</th>
                                                <th style="font-weight:normal;"><?= date('d/m/Y H:i:s',strtotime($data['created_on']));?></th>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <br />
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="guest-table">
                                    <thead>
                                        <tr>
                                            <th width="50px" class="text-center">No</th>
                                            <th class="text-center">Produk</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Volume</th>
                                            <th class="text-center">Harga Satuan</th>
                                            <th class="text-center">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $subtotal = 0;
                                       $total = 0;
                                       $tax_0 = 0;
									   $tax_ppn = 0;
									   $tax_pph = 0;
                                       $tax_ppn11 = 0;
                                       foreach ($details as $no => $dt) {
                                            $nilai = $dt['total'] * $dt['price'];
                                           ?>  
                                           <tr>
                                               <td class="text-center"><?= $no + 1;?></td>
                                               <td class="text-left"><?php echo $this->crud_global->GetField('produk',array('id'=>$dt['material_id']),'nama_produk');?></td>
                                               <td class="text-center"><?php echo $dt['measure'];?></td>
                                               <td class="text-center"><?php echo number_format($dt['total'],2,',','.');?></td>
                                               <td class="text-right"><?php echo number_format($dt['price'],0,',','.');?></td>
                                               <td class="text-right"><?php echo number_format($nilai,0,',','.');?></td>
                                               <input type="hidden" id="total-<?php echo $no;?>" value="<?php echo $subtotal;?>" >
                                           </tr>

                                           <?php
                                           $subtotal += $dt['total'] * $dt['price'];
                                           if($dt['tax_id'] == 4){
                                               $tax_0 = true;
                                           }
                                           if($dt['tax_id'] == 3){
                                               $tax_ppn += $dt['tax'];
                                           }
                                           if($dt['tax_id'] == 5){
                                               $tax_pph += $dt['tax'];
                                           }
                                           if($dt['tax_id'] == 6){
                                               $tax_ppn11 += $dt['tax'];
                                           }
                                           if($dt['pajak_id'] == 4){
                                               $pajak_0 = true;
                                           }
                                           if($dt['pajak_id'] == 3){
                                               $pajak_ppn += $dt['pajak'];
                                           }
                                           if($dt['pajak_id'] == 5){
                                               $pajak_pph += $dt['pajak'];
                                           }
                                           if($dt['pajak_id'] == 6){
                                               $pajak_ppn11 += $dt['pajak'];
                                           }
                                           
                                       }
                                       ?>
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
                                    ?>
                                    <?php
                                    if($pajak_ppn > 0){
                                        ?>
                                        <tr>
                                            <th colspan="5" class="text-right">Pajak (PPN 10%)</th>
                                            <th  class="text-right"><?= number_format($pajak_ppn,0,',','.'); ?></th>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if($pajak_0){
                                        ?>
                                        <tr>
                                            <th colspan="5" class="text-right">Pajak (PPN 0%)</th>
                                            <th  class="text-right"><?= number_format(0,0,',','.'); ?></th>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if($pajak_pph > 0){
                                        ?>
                                        <tr>
                                            <th colspan="5" class="text-right">Pajak (PPh 23)</th>
                                            <th  class="text-right"><?= number_format($pajak_pph,0,',','.'); ?></th>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if($pajak_ppn11 > 0){
                                        ?>
                                        <tr>
                                            <th colspan="5" class="text-right">Pajak (PPN 11%)</th>
                                            <th  class="text-right"><?= number_format($pajak_ppn11,0,',','.'); ?></th>
                                        </tr>
                                        <?php
                                    }
                                    $total = $subtotal + ($tax_ppn - $tax_pph + $tax_ppn11) + ($pajak_ppn - $pajak_pph + $pajak_ppn11);
                                    ?>
                                    
                                    <tr>
                                        <th colspan="5" class="text-right">TOTAL</th>
                                        <th  class="text-right"><?= number_format($total,0,',','.'); ?></th>
                                    </tr>
                                </tfoot>
                            </div>
                            </table>
                                
                            <div class="text-right">
                                <a href="<?php echo site_url('admin/pembelian');?>" class="btn btn-info" style="width:150px; font-weight:bold; border-radius:10px;"> KEMBALI</a>
                                
                                <?php
                                if($data['status'] == 'WAITING'){
                                    ?>
                                    <a href="<?= site_url('pmm/purchase_order/get_pdf_draft/'.$id);?>" target="_blank" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> PRINT (DRAFT)</a>
                                    
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3){
                                        ?>
                                        <a onclick="CreatePO()" class="btn btn-success" style="width:150px; font-weight:bold; border-radius:10px;"> SETUJUI</a>
                                        <a onclick="ProcessForm('<?php echo site_url('pmm/purchase_order/process/'.$id.'/2');?>')" class="btn btn-danger check-btn" style="width:150px; font-weight:bold; border-radius:10px;"> TOLAK</a>
                                        <?php
                                    }
                                }
                                ?>

                                <?php
                                if($data['status'] == 'PUBLISH'){
                                    ?>
                                    <a href="<?= site_url('pmm/purchase_order/get_pdf/'.$id);?>" target="_blank" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> PRINT</a>
                                    
                                    <a href="<?= site_url('pmm/receipt_material/manage/'.$id);?>" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> TERIMA PRODUK</a>
                                    
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                        ?>
                                        <form class="form-check" action="<?= base_url("pembelian/closed_po/".$id) ?>">
                                            <button type="submit" class="btn btn-default" style="width:150px; font-weight:bold; margin-bottom:10px; border-radius:10px;"> CLOSED</button>
                                            <a href="<?= site_url('pembelian/reject_po/' . $id); ?>" class="btn btn-default" style="width:150px; font-weight:bold; margin-bottom:10px; border-radius:10px;"> REJECT</a>
                                        </form>	
                                        <?php
                                    }
                                }
                                ?>
                                <input type="hidden" id="purchase_order_id" value="<?php echo $id;?>">
                                
                            
                                <?php if($data["status"] === "CLOSED") : ?>
                                    <a href="<?= site_url('pmm/purchase_order/get_pdf/'.$id);?>" target="_blank" class="btn btn-default" style="width:150px; font-weight:bold; border-radius:10px;"> PRINT</a>
                                    
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 5){
                                        ?>
                                        <form class="form-check" action="<?= site_url("pmm/purchase_order/open_pesanan_pembelian/".$id);?>">
                                            <button type="submit" class="btn btn-default" style="width:150px; font-weight:bold; margin-bottom:10px; border-radius:10px;"> PUBLISH</button>
                                            <a href="<?= site_url('pembelian/reject_po/' . $id); ?>" class="btn btn-default" style="width:150px; font-weight:bold; margin-bottom:10px; border-radius:10px;"> REJECT</a>        
                                        </form>	
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1){
                                        ?>
                                        <form class="form-check" action="<?= site_url("pmm/purchase_order/delete/".$id);?>">
                                            <button type="submit" class="btn btn-default" style="width:150px; font-weight:bold; margin-bottom:10px; border-radius:10px;"> HAPUS</button>        
                                        </form>
                                        <?php
                                    }
                                    ?>
                                <?php endif; ?>

                                <?php if($data["status"] === "REJECTED") : ?>                             
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1){
                                        ?>
                                        <form class="form-check" action="<?= site_url("pmm/purchase_order/delete/".$id);?>">
                                            <button type="submit" class="btn btn-default" style="width:150px; font-weight:bold; margin-bottom:10px; border-radius:10px;"> HAPUS</button>        
                                        </form>	
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

    <script type="text/javascript">
        

        $('#pph_val').number(true,0,',','.');
        $('.dtpicker').daterangepicker({
                singleDatePicker: true,
                locale: {
              format: 'DD-MM-YYYY'
            }
            });
        $('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
              $(this).val(picker.startDate.format('DD-MM-YYYY'));
              // table.ajax.reload();
        });

        function ProcessForm(url){
            bootbox.confirm("Apakah anda yakin untuk proses data ini ?", function(result){ 
                if(result){
                    window.location.href = url;
                }
            });
        }

        function CreatePO(){
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
                        $('#btn-po').button('loading');
                        var arr = {
                            date_po : $('#date_po').val(),
                            subject : $('#subject').val(),
                            date_pkp : $('#date_pkp').val(),
                            supplier_id : $('#supplier_id').val(),
                            total : $('#total').val(),
                            ppn : $('#ppn').val(),
                            pph : $('#pph').val(),
                            pph : $('#ppn11').val(),
                            id : $('#purchase_order_id').val()
                        }
                        if($('#date_po').val() == '' || $('#subject').val() == '' || $('#date_pkp').val() == '' || $('#supplier').val() == ''){
                            bootbox.alert('Opps !! Please fill the field first !!');
                        }else {

                            $.ajax({
                                type    : "POST",
                                url     : "<?php echo site_url('pmm/purchase_order/approve_po'); ?>",
                                dataType : 'json',
                                data: arr,
                                success : function(result){
                                    if(result.output){
                                        // table.ajax.reload();
                                        // bootbox.alert('<b>DELETED</b>');
                                        window.location.href = result.url;
                                    }else if(result.err){
                                        bootbox.alert(result.err);
                                    }
                                    $('#btn-po').button('reset');
                                }
                            });
                        }
                    }
                }
            });
        }

        $('#supplier').change(function(){
            var npwp = $('option:selected', this).attr('data-npwp');
            var address = $('option:selected', this).attr('data-address');
            $('#npwp_supplier').val(npwp);
            $('#address_supplier').val(address);
            console.log(npwp);
        });

        $('.ppn-get').change(function(){
            
            
            var ppn_val = $('#ppn_val').val();
            var ppn = ppn_val;
            var pph = $('#pph_val').val();
            var val = $(this).val();
            var total = $('#total-'+val).val();
            var subtotal = $('#total').val();
            var total_fix = $('#total-fix').val();
            if ($(this).is(':checked')) {

                if(total > 0){
                    ppn = (total * 10) / 100;
                    ppn = parseInt(ppn_val) + parseInt(ppn);
                }
                $('#ppn_val').val(ppn);
                $('#ppn').number(ppn, 2,',','.' );
                total_all = parseInt(total_fix) + parseInt(ppn) - parseInt(pph);
                $('#total').val(total_all);
                $('#total-text').number(total_all, 2,',','.' );

            }else {
                if(total > 0){
                    ppn = (total * 10) / 100;
                    total_all = parseInt(subtotal) - parseInt(ppn) - parseInt(pph);
                    ppn = parseInt(ppn_val) - parseInt(ppn);

                }

                
                $('#ppn_val').val(ppn);
                $('#ppn').number(ppn, 2,',','.' );
                
                $('#total').val(total_all);
                $('#total-text').number(total_all, 2,',','.' );


            }
        });
        $('.pph-get').keyup(function(){
            
            var val = $(this).val();
            var data_val = $(this).attr('data-val');
            var pph_val = $('#pph_val').val();
            var total = $('#total-'+data_val).val();
            var ppn = $('#ppn_val').val();
            var total_fix = $('#total-fix').val();
            var subtotal = $('#total').val();
            // console.log(val);
            countPPH();
        });


        function countPPH()
        {   
            var total_pph = 0;
            $('.pph-get').each(function(key,val){
                var no = key + 1;
                var subtotal = $('#total-'+no).val();
                var val = $(val).val();
                var pph = (subtotal * val) / 100;
                total_pph += pph;
                
            });
            var total = $('#total-fix').val();
            var ppn = $('#ppn_val').val();
            $('#pph_val').val(total_pph);
            $('#pph').number(total_pph, 2,',','.' );
            total_all = (parseInt(total)  - parseInt(total_pph)) + parseInt(ppn);
            
            $('#total').val(total_all);
            $('#total-text').number(total_all, 2,',','.' );
        }

        $('.form-check').submit(function(e){
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


    </script>

</body>
</html>
