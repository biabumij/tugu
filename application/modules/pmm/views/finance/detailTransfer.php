<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>

    <style type="text/css">
        body{
			font-family: helvetica;
	  	}
        .table-center th, .table-center td{
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
                                <div class="">
                                    <h3 class="">Transfer Uang</h3>
                                </div>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <table class="table table-bordered table-striped table-condensed">
                                            <tr>
                                                <th width="30%">Transfer Dari</th>
                                                <th width="2%">:</th>
                                                <td width="68%"><?= $this->crud_global->GetField('pmm_coa',array('id'=>$detail["transfer_dari"]),'coa')?></td>
                                            </tr>
                                            <tr>
                                                <th>Setor Ke</th>
                                                <th>:</th>
                                                <td><?= $this->crud_global->GetField('pmm_coa',array('id'=>$detail["setor_ke"]),'coa')?></td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Transaksi</th>
                                                <th>:</th>
                                                <td><?= $detail["nomor_transaksi"]; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Transaksi</th>
                                                <th>:</th>
                                                <td> <?= date('d F Y',strtotime($detail["tanggal_transaksi"])) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jumlah</th>
                                                <th>:</th>
                                                <td> Rp. <?php echo number_format($detail['jumlah'],0,',','.');?></td>
                                            </tr>
                                            <tr>
                                                <th>Memo</th>
                                                <th>:</th>
                                                <td> <?= $detail['memo'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Lampiran</th>
                                                <th>:</th>
                                                <td> 
                                                    <?php
                                                    if(!empty($dataLampiran)){
                                                        foreach ($dataLampiran as $key => $lampiran) {
                                                            ?>
                                                            <div><a href="<?= base_url().'uploads/transfer/'.$lampiran['lampiran'];?>" target="_blank"><?= $lampiran['lampiran'];?></a></div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-sm-12 text-right">
                                        <a href="<?= base_url('admin/kas_&_bank') ?>" class="btn btn-info" style="border-radius:10px; font-weight:bold;">KEMBALI</a>
                                        <a target="_blank" href="<?= base_url('pmm/finance/cetakTransferCoa/'.$detail["id"]) ?>" class="btn btn-default" style="border-radius:10px; font-weight:bold;">CETAK</a>
                                        <?php
                                        if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6){
                                            ?>
                                            <a class="btn btn-default" style="border-radius:10px; font-weight:bold;" onclick="DeleteData('<?= site_url('pmm/finance/deleteTransferCoa/'.$detail['id']);?>')">HAPUS</a>
                                            <?php
                                         }
                                        ?>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
            
        </div>
    </div>

    <?php echo $this->Templates->Footer();?>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/jquery.number.min.js"></script>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/daterangepicker.css">
    <script src="<?php echo base_url();?>assets/back/theme/vendor/bootbox.min.js"></script>
    
    <script type="text/javascript">
        var form_control = '';
    </script>

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