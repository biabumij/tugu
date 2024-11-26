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
                                <h3><b>DETAIL BIAYA</b></h3>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <table class="table table-bordered table-striped table-condensed">
                                            <tr>
                                                <th width="30%">DIBAYAR KEPADA</th>
                                                <th width="2%">:</th>
                                                <td width="68%"> <?= $row["penerima"] ?></td>
                                            </tr>
                                            <tr>
                                                <th>NO. TRANSAKSI</th>
                                                <th>:</th>
                                                <td> <?= $row['nomor_transaksi'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>TGL. TRANSAKSI</th>
                                                <th>:</th>
                                                <td> <?= date('d F Y',strtotime($row["tanggal_transaksi"])) ?></td>
                                            </tr>
                                            <tr>
                                                <th>AKUN PERNARIKAN</th>
                                                <th>:</th>
                                                <td> <?= $this->crud_global->GetField('pmm_coa',array('id'=>$row["bayar_dari"]),'coa'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>DIBUAT OLEH</th>
                                                <th>:</th>
                                                <td><?php echo $this->crud_global->GetField('tbl_admin',array('admin_id'=>$row['created_by']),'admin_name');?></td>
                                            </tr>
                                            <tr>
                                                <th>DIBUAT TANGGAL</th>
                                                <th>:</th>
                                                <td><?= date('d/m/Y H:i:s',strtotime($row['created_on']));?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <table id="table-product" class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr >
                                            <th width="15%" class="text-center">KODE AKUN</th>
                                            <th width="30%" class="text-left">NAMA AKUN</th>
                                            <th width="30%" class="text-left">DESKRIPSI</th>
                                            <th width="25%" class="text-right">JUMLAH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        if(!empty($detail)){
                                            foreach ($detail as $key => $dt) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $dt['kode_akun'];?></td>
                                                    <td class="text-left"><?= $dt['akun'];?></td>
                                                    <td class="text-left"><?= $dt['deskripsi'];?></td>
                                                    <td class="text-right">Rp. <?php echo number_format($dt['jumlah'],0,',','.');?></td>    
                                                </tr>
                                                <?php
                                                $total += $dt['jumlah'];
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">TOTAL</th>
                                            <th class="text-right">Rp. <?php echo number_format($total,0,',','.');?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <br />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <table class="table  table-condensed">
                                            <tr>
                                                <th width="30%">Memo</th>
                                                <th width="2%">:</th>
                                                <td> <?= $row['memo'];?></td>
                                            </tr>
                                            <tr>
                                                <th>Lampiran</th>
                                                <th>:</th>
                                                <td> 
                                                    <?php
                                                    $lampiran = $this->db->get_where('pmm_lampiran_biaya',array('biaya_id'=>$row['id']))->result_array();
                                                    if(!empty($lampiran)){
                                                        foreach ($lampiran as $key => $lam) {
                                                            ?>
                                                            <a href="<?= base_url().'uploads/biaya/'.$lam['lampiran'];?>" target="_blank"><?= $lam['lampiran'];?></a><br />
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br /> <br />
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <a href="<?= base_url('admin/biaya_bua') ?>" class="btn btn-info" style="width:10%; font-weight:bold; border-radius:10px;"> KEMBALI</a>
										<?php
										if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4 || $this->session->userdata('admin_group_id') == 6){
                                        ?>
										<?php if($row["status"] === "UNPAID") : ?>
											<a href="<?= base_url("pmm/biaya/approvalBiaya/".$row["id"]) ?>" class="btn btn-success" style="width:10%; font-weight:bold; border-radius:10px;"> SETUJUI</a>
											<a href="<?= base_url("pmm/biaya/rejectedBiaya/".$row["id"]) ?>"class="btn btn-primary" style="width:10%; font-weight:bold; border-radius:10px;"> TOLAK</a>
										<?php endif; ?>
										<?php
                                        }
                                        ?>

                                        <?php if($row["status"] === "PAID") : ?>
                                            <a target="_blank" href="<?= base_url('pmm/biaya/cetakBiaya/'.$row["id"]) ?>" class="btn btn-default" style="width:10%; font-weight:bold; border-radius:10px;"><i class="fa fa-print"></i> PRINT</a>
                                            <?php
                                            if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3){
                                            ?>
                                            <a  href="<?= base_url('pmm/biaya/form/'.$row['id']) ?>" class="btn btn-default" style="width:10%; font-weight:bold; border-radius:10px;"><i class="fa fa-edit"></i> EDIT</a>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3){
                                            ?>
                                            <a class="btn btn-default" style="width:10%; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('pmm/biaya/delete/'.$row['id']);?>')"><i class="fa fa-close"></i> HAPUS</a>
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
    <script src="<?php echo base_url();?>assets/back/theme/vendor/bootbox.min.js"></script>
    <script type="text/javascript">
        
        $('.numberformat').number( true, 2,',','.' );
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
