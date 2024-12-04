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
                                <h3><b>EDIT STOCK OPNAME</b></h3>
                            </div>
                            <div class="panel-content">
                                <form method="POST" action="<?php echo site_url('produksi/submit_sunting_stock_opname');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th width="50%" class="text-right">Tanggal</th>
                                            <td><input type="text" class="form-control dtpicker" name="date"  value="<?= $tanggal ?>" /></td>
                                        </tr>
                                        <tr>
                                            <th width="50%" class="text-right">Produk</th>
                                            <td class="text-center">
                                            <select id="material_id" name="material_id" class="form-control" required="">
                                                <option value="">Pilih Produk</option>
                                                <?php
                                                $this->db->where('status', 'PUBLISH');
                                                $materials = $this->db->select('*')->order_by('nama_produk','asc')->get_where('produk', array('status' => 'PUBLISH', 'kategori_produk' => 1, 'stock_opname' => 1))->result_array();
                                                foreach ($materials as $mat) {
                                                ?>
                                                    <option value="<?php echo $mat['id']; ?>" data-measure="<?php echo $mat['satuan'];?>"><?php echo $mat['nama_produk']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="50%" class="text-right">Volume</th>
                                            <td><input type="text" class="form-control text-left" name="volume" value="<?php echo number_format($row["volume"],2,',','.');?>"/></td>
                                        </tr>
                                        <tr>
                                            <th width="50%" class="text-right">Satuan</th>
                                            <td>
                                                <select id="measure" name="measure" class="form-control" required="">
                                                    <option value="">Pilih Satuan</option>
                                                    <?php
                                                    $this->db->where('status', 'PUBLISH');
                                                    $measures = $this->db->get('pmm_measures')->result_array();
                                                    foreach ($measures as $mes) {
                                                    ?>
                                                        <option value="<?php echo $mes['id']; ?>"><?php echo $mes['measure_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <!--<tr>
                                            <th width="50%" class="text-right">Nilai</th>
                                            <td><input type="text" class="form-control text-left" name="total"  value="<?php echo number_format($row["total"],0,',','.');?>" /></td>
                                        </tr>-->
                                        <tr>
                                            <th width="50%" class="text-right">Notes</th>
                                            <td><input type="text" class="form-control text-left" name="notes"  value="<?= $row["notes"] ?>" /></td>
                                        </tr>
                                    </table>
                                    <br />
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <a href="<?= site_url('admin/stock_opname');?>" class="btn btn-danger" style="margin-bottom:0px; font-weight:bold; border-radius:10px;">BATAL</a>
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

        $(document).ready(function(){
            $('#material_id').val(<?= $row['material_id'];?>).trigger('change');
            $('#measure').val(<?= $row['measure'];?>).trigger('change');
        });

    </script>


</body>
</html>
