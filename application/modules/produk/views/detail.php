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
                            <div class="">
                                <h3 ><?= $row['nama_produk'];?></h3>
                                <h5 ><?= $row['kode_produk'];?></h5>
                            </div>
                        </div>
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-sm-8">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th width="30%">
                                                Satuan
                                            </th>        
                                            <td>
                                                <?= $this->crud_global->GetField('pmm_measures',array('id'=>$row['satuan']),'measure_name');?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Kategori Produk
                                            </th>        
                                            <td>
                                            <?= $this->crud_global->GetField('kategori_produk',array('id'=>$row['kategori_produk']),'nama_kategori_produk');?>
                                            </td>
                                        </tr>
                                        <?php if($row["kategori_alat"] === "1") : ?>                             
                                            <tr>
                                                <th>
                                                    Kategori Alat
                                                </th>        
                                                <td>
                                                <?= $this->crud_global->GetField('kategori_alat',array('id'=>$row['kategori_alat']),'nama_kategori_alat');?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($row["kategori_alat"] === "2") : ?>                             
                                            <tr>
                                                <th>
                                                    Kategori Alat
                                                </th>        
                                                <td>
                                                <?= $this->crud_global->GetField('kategori_alat',array('id'=>$row['kategori_alat']),'nama_kategori_alat');?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($row["kategori_alat"] === "3") : ?>                             
                                            <tr>
                                                <th>
                                                    Kategori Alat
                                                </th>        
                                                <td>
                                                <?= $this->crud_global->GetField('kategori_alat',array('id'=>$row['kategori_alat']),'nama_kategori_alat');?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($row["kategori_alat"] === "4") : ?>                             
                                            <tr>
                                                <th>
                                                    Kategori Alat
                                                </th>        
                                                <td>
                                                <?= $this->crud_global->GetField('kategori_alat',array('id'=>$row['kategori_alat']),'nama_kategori_alat');?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($row["kategori_alat"] === "5") : ?>                             
                                            <tr>
                                                <th>
                                                    Kategori Alat
                                                </th>        
                                                <td>
                                                <?= $this->crud_global->GetField('kategori_alat',array('id'=>$row['kategori_alat']),'nama_kategori_alat');?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($row["kategori_bahan"] === "1") : ?>                             
                                            <tr>
                                                <th>
                                                    Kategori Bahan
                                                </th>        
                                                <td>
                                                <?= $this->crud_global->GetField('kategori_bahan',array('id'=>$row['kategori_bahan']),'nama_kategori_bahan');?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($row["kategori_bahan"] === "2") : ?>                             
                                            <tr>
                                                <th>
                                                    Kategori Bahan
                                                </th>        
                                                <td>
                                                <?= $this->crud_global->GetField('kategori_bahan',array('id'=>$row['kategori_bahan']),'nama_kategori_bahan');?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($row["kategori_bahan"] === "3") : ?>                             
                                            <tr>
                                                <th>
                                                    Kategori Bahan
                                                </th>        
                                                <td>
                                                <?= $this->crud_global->GetField('kategori_bahan',array('id'=>$row['kategori_bahan']),'nama_kategori_bahan');?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($row["kategori_bahan"] === "4") : ?>                             
                                            <tr>
                                                <th>
                                                    Kategori Bahan
                                                </th>        
                                                <td>
                                                <?= $this->crud_global->GetField('kategori_bahan',array('id'=>$row['kategori_bahan']),'nama_kategori_bahan');?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                        <?php if($row["kategori_bahan"] === "5") : ?>                             
                                            <tr>
                                                <th>
                                                    Kategori Bahan
                                                </th>        
                                                <td>
                                                <?= $this->crud_global->GetField('kategori_bahan',array('id'=>$row['kategori_bahan']),'nama_kategori_bahan');?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>
                                <div class="col-sm-4">
                                    <?php

                                    if(!empty($row['jual'])){
                                        $coa_jual = $this->db->get_where('pmm_coa',array('id'=>$row['akun_jual']))->row_array();
                                        ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Jual</h3>
                                            </div>
                                            <div class="list-group">
                                                <div class="list-group-item">
                                                    <p class="list-group-item-text">
                                                        Harga Jual
                                                    </p>
                                                    <h4 class="list-group-item-heading">
                                                        Rp. <?= $this->filter->Rupiah($row['harga_jual']);?>
                                                    </h4>
                                                </div>
                                                <div class="list-group-item">
                                                    <p class="list-group-item-text">
                                                        Akun Jual
                                                    </p>
                                                    <h4 class="list-group-item-heading">
                                                        <?= '('.$coa_jual['coa_number'].') '.$coa_jual['coa'];?>
                                                    </h4>
                                                </div>
                                                <div class="list-group-item">
                                                    <p class="list-group-item-text">
                                                        Pajak Jual
                                                    </p>
                                                    <h4 class="list-group-item-heading">
                                                        <?= $this->crud_global->GetField('pmm_taxs',array('id'=>$row['pajak_jual']),'tax_name');?>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    if(!empty($row['beli'])){
                                        
                                        $coa_beli = $this->db->get_where('pmm_coa',array('id'=>$row['akun_beli']))->row_array();
                                        ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Beli</h3>
                                            </div>
                                            <div class="list-group">
                                                <div class="list-group-item">
                                                    <p class="list-group-item-text">
                                                        Harga Beli
                                                    </p>
                                                    <h4 class="list-group-item-heading">
                                                        Rp. <?= $this->filter->Rupiah($row['harga_beli']);?>
                                                    </h4>
                                                </div>
                                                <div class="list-group-item">
                                                    <p class="list-group-item-text">
                                                        Akun Beli
                                                    </p>
                                                    <h4 class="list-group-item-heading">
                                                        <?= '('.$coa_beli['coa_number'].') '.$coa_beli['coa'];?>
                                                    </h4>
                                                </div>
                                                <div class="list-group-item">
                                                    <p class="list-group-item-text">
                                                        Pajak Beli
                                                    </p>
                                                    <h4 class="list-group-item-heading">
                                                        <?= $this->crud_global->GetField('pmm_taxs',array('id'=>$row['pajak_beli']),'tax_name');?>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    
                                </div>
                                <br /><br />
                                <div class="col-sm-12 text-center">
                                    <a href="<?= base_url('admin/produk') ?>" class="btn btn-info" style="width:10%; font-weight:bold; border-radius:10px;">KEMBALI</a>
                                    <?php
                                    if($this->session->userdata('admin_group_id') == 1 || $this->session->userdata('admin_group_id') == 2 || $this->session->userdata('admin_group_id') == 3 || $this->session->userdata('admin_group_id') == 4){
                                        ?>
                                        <a  href="<?= base_url('produk/buat_baru/'.$row['id']) ?>" class="btn btn-default" style="width:10%; font-weight:bold; border-radius:10px;">EDIT</a>
                                        <!--<a class="btn btn-default" style="width:10%; font-weight:bold; border-radius:10px;" onclick="DeleteData('<?= site_url('produk/hapus/'.$row['id']);?>')">HAPUS</a>-->
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

        $('input.numberformat').number( true, 2,',','.' );
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
