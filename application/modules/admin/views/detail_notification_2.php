<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>

    <style type="text/css">
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
                                <h3>Butuh Persetujuan Ka. Plant</h3>
                                <div class="text-left">
                                    <a href="<?php echo site_url('admin');?>">
                                    <button style="color:white; background-color:#5bc0de; border:1px solid black; border-radius:10px; line-height:30px;"><b>KEMBALI KE DASHBOARD</b></button></a>
                                </div>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <table class="table table-bordered table-striped table-condensed">
                                            <tr style='background-color:#cccccc; font-weight:bold;'>
                                                <th class="text-center" width="5%">No.</th>
                                                <td class="text-left">Kategori Persetujuan</td>
                                                <td class="text-left">Nomor Dokumen</td>
                                                <td class="text-left">Dibuat Oleh</td>
                                                <td class="text-left">Dibuat Tanggal</td>
                                            </tr>
                                            <?php
                                            $permintaan = $this->db->select('*')
                                            ->from('pmm_request_materials')
                                            ->where("status = 'WAITING'")
                                            ->order_by('created_on','desc')
                                            ->get()->result_array();
                                            ?>

                                            <?php foreach ($permintaan as $x): ?>
                                            <tr>
                                                <th class="text-center" width="5%"><?php echo $no++;?></th>
                                                <th class="text-left"><?= $x['kategori_persetujuan']; ?></th>
                                                <th class="text-left"><?= $x['request_no'] = '<a href="'.site_url('pmm/request_materials/manage/'.$x['id']).'" target="_blank">'.$x['request_no'].'</a>';?></th>
                                                <th class="text-left"><?= $x['created_by'] = $this->crud_global->GetField('tbl_admin',array('admin_id'=>$x['created_by']),'admin_name'); ?></th>
                                                <th class="text-left"><?= $x['created_on'] = date('d/m/Y H:i:s',strtotime($x['created_on'])); ?></th>
                                            </tr>
                                            <?php endforeach; ?>
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
    
    <script type="text/javascript">
        var form_control = '';
    </script>
    <?php echo $this->Templates->Footer();?>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/jquery.number.min.js"></script>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/bootbox.min.js"></script>
    
</body>
</html>
