<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>

    <style type="text/css">
        body{
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
                                <h3><b>DETAIL JURNAL UMUM</b></h3>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <table class="table table-bordered table-striped table-condensed">
                                            <tr>
                                                <th width="30%">NO. TRANSAKSI</th>
                                                <th width="2%">:</th>
                                                <td width="68%"> <?= $detail["nomor_transaksi"] ?></td>
                                            </tr>
                                            <tr>
                                                <th>TGL. TRANSAKSI</th>
                                                <th>:</th>
                                                <td> <?= date('d F Y',strtotime($detail["tanggal_transaksi"])) ?></td>
                                            </tr>
                                            <tr>
                                                <th>DIBUAT OLEH</th>
                                                <th>:</th>
                                                <td><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$detail['created_by']),'admin_name');?></td>
                                            </tr>
                                            <tr>
                                                <th>DIBUAT TANGGAL</th>
                                                <th>:</th>
                                                <td><?= date('d/m/Y H:i:s',strtotime($detail['created_on']));?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="table-product" class="table table-bordered table-striped table-condensed table-center">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="5%">NO.</th>
                                                <th class="text-left">AKUN BIAYA</th>
                                                <th class="text-left">DESKRIPSI</th>
                                                <th class="text-right">DEBIT</th>
                                                <th class="text-right">KREDIT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no=1; 
                                            $debit = 0;
                                            $kredit = 0;
                                            ?>
                                            <?php foreach($detailBiaya as $d) : ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-left">(<?= $d["coa_number"]; ?>) - <?= $d["coa"]; ?></td>
                                                <td class="text-left"><?= $d["deskripsi"]; ?></td>
                                                <td class="text-right">Rp. <?php echo number_format($d['debit'],0,',','.');?></td>
                                                <td class="text-right">Rp. <?php echo number_format($d['kredit'],0,',','.');?></td>
                                            </tr>
                                            <?php
                                            $debit += $d['debit'];
                                            $kredit += $d['kredit']; 
                                            endforeach;
                                             ?>
                                        </tbody>
                                        <tfoot style="text-align: right;">
                                            <tr>
                                                <th colspan="3" class="text-right">TOTAL</th>
                                                <th class="text-right">Rp. <?php echo number_format($debit,0,',','.');?></th>
                                                <th class="text-right">Rp. <?php echo number_format($kredit,0,',','.');?></th>
                                            </tr>
                                        </tfoot>
                                    </table>    
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <table class="table  table-condensed">
                                            <tr>
                                                <th width="30%">Memo</th>
                                                <th width="2%">:</th>
                                                <td> <?= $detail['memo'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Lampiran</th>
                                                <th>:</th>
                                                <td> 
                                                    <?php
                                                    $lampiran = $this->db->get_where('pmm_lampiran_jurnal',array('jurnal_id'=>$detail['id']))->result_array();
                                                    if(!empty($lampiran)){
                                                        foreach ($lampiran as $key => $lam) {
                                                            ?>
                                                            <a href="<?= base_url().'uploads/jurnal_umum/'.$lam['lampiran'];?>" target="_blank"><?= $lam['lampiran'];?></a><br />
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br /><br />
                                <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <a href="<?= base_url('admin/jurnal_umum') ?>" class="btn btn-info" style="width:10%; font-weight:bold; border-radius:10px;"> KEMBALI</a>
                                            <?php
                                            if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6){
                                            ?>
                                            <?php if($detail["status"] === "UNPAID") : ?>
                                                <a href="<?= base_url("pmm/Jurnal_umum/approvalJurnal/".$detail["id"]) ?>" class="btn btn-success"><i class="fa fa-check" style="width:10%; font-weight:bold; border-radius:10px;"></i> APPROVE</a>
                                                <a href="<?= base_url("pmm/Jurnal_umum/rejectedJurnal/".$detail["id"]) ?>"class="btn btn-primary"><i class="fa fa-close" style="width:10%; font-weight:bold; border-radius:10px;"></i> REJECT</a>
                                            <?php endif; ?>
                                            <?php
                                            }
                                            ?>

                                            <?php if($detail["status"] === "PAID") : ?>
                                                <a target="_blank" href="<?= base_url('pmm/jurnal_umum/cetakJurnal/'.$detail["id"]) ?>" class="btn btn-default" style="width:10%; font-weight:bold; border-radius:10px;"> PRINT</a>
                                                <?php
                                                if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3){
                                                ?>
                                                <a  href="<?= base_url('pmm/jurnal_umum/form/'.$detail['id']) ?>" class="btn btn-default" style="width:10%; font-weight:bold; border-radius:10px;"> EDIT</a>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3){
                                                ?>
                                                <a class="btn btn-default" style="width:10%; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('pmm/jurnal_umum/delete/'.$detail['id']);?>')"> HAPUS</a>
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
