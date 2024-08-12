<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>

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
                            <h3 class="section-subtitle"><b>PERUSAHAAN</b></h3>
                            <div class="text-left">
                                <a href="<?php echo site_url('admin');?>">
                                <button style="color:white; background-color:#5bc0de; border:1px solid black; border-radius:10px; line-height:30px;"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                            </div>
                        </div>
                        <div class="panel-content">
                            <form id="inline-validation" method="POST" class="form-horizontal form-stripe form-submit" novalidate="novalidate" data-button="#btn-submit" action="<?php echo site_url('pmm/setting_production');?>" data-redirect="<?php echo site_url('admin/perusahaan');?>" enctype="multipart/form-data">
                                <?php
                                $sp = $this->db->get_where('pmm_setting_production',array('id'=>1))->row_array();
                                ?>
                                <input type="hidden" name="id" value="1"></input>
                                <!--<div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Perusahaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_pt" value="<?php echo $sp['nama_pt'];?>"></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Code Prefix</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="code_prefix" value="<?php echo $sp['code_prefix'];?>"></input>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Unit Bisnis</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="jenis_usaha" value="<?php echo $sp['jenis_usaha'];?>"></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Kop Surat</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="kop_surat" class="form-control" data-required="false" />
                                        <?php
                                        if(!empty($sp['kop_surat'])){
                                            ?>
                                        <small><a href="<?= base_url();?>uploads/kop_surat/<?= $sp['kop_surat'];?>" target="_blank">Lihat</a></small>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-10 col-sm-offset-2">
                                        <?php
                                        if(!empty($sp['kop_surat'])){
                                            ?>
                                            <img src="<?= base_url();?>uploads/kop_surat/<?= $sp['kop_surat'];?>" class="img-responsive">
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" name="submit" class="btn btn-success" style="width:100px; font-weight:bold; border-radius:10px;" id="btn-submit">KIRIM</button>
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

	<?php echo $this->Templates->Footer();?>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/jquery.number.min.js"></script>
    <script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $('input.numberformat').number( true, 2,',','.' );
    </script>



    
</body>
</html>
