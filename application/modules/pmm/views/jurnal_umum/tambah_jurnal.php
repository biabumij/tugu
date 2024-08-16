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
                                <div>
                                    <h3><b>BUAT JURNAL UMUM</b></h3>
                                    
                                </div>
                            </div>
                            <div class="panel-content">
                                <form method="POST" action="<?php echo site_url('pmm/jurnal_umum/submit_jurnal');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label>Tanggal Transaksi<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control dtpicker" name="tanggal_transaksi" required="">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Nomor Transaksi<span class="required" aria-required="true">*</span></label>
                                            <input type="text" class="form-control" name="nomor_transaksi" required="">
                                        </div>
                                    </div>
                                    <br />
                                    <div class="table-responsive">
                                        <table id="table-product" class="table table-bordered table-striped table-condensed table-center">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Akun Biaya</th>
                                                    <th>Deskripsi</th>
                                                    <th>Debet</th>
                                                    <th>Kredit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>
                                                        <select  class="form-control form-select2"  name="product_1" required="">
                                                            <option value="">Pilih Akun</option>
                                                            <?php
                                                            if(!empty($akun)){
                                                                foreach ($akun as $row) {
                                                                    ?>
                                                                    <option value="<?php echo $row['id'];?>"><?php echo $row['coa_number'].' - '.$row['coa']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="deskripsi_1">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control numberformat jumlah jumlah_input" onKeyup="getJumlah(this)" name="debit_1" id="jumlah_1" value="0">
                                                    </td>
                                                    <td>
                                                    <input type="text" class="form-control numberformat kredit kredit_input" onKeyup="getKredit(this)" name="kredit_1" id="kredit_1" value="0">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>    
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-primary" onclick="tambahData()" style="font-weight:bold; border-radius:10px;">
                                                <i class="fa fa-plus"></i> TAMBAH DATA
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Memo</label>
                                                <textarea class="form-control" name="memo" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Lampiran</label>
                                                <input type="file" class="form-control" name="files[]"  multiple="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-8 form-horizontal">
                                            <div class="form-group">
                                                <h4 class="col-sm-7 control-label">Total Debit</h4>
                                                <div class="col-sm-5 text-right">
                                                    <h4 class="numberformat" id="total_id">0,00</h4>
                                                    <input type="hidden" id="total-val" name="total" value="0">
                                                    <input type="hidden" id="total_product" name="jumlah_debit">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h4 class="col-sm-7 control-label">Total Kredit</h4>
                                                <div class="col-sm-5 text-right">
                                                    <h4 class="numberformat" id="total_kredit">0,00</h4>
                                                    <!-- <input type="hidden" id="total-val" name="total" value="0"> -->
                                                    <input type="hidden" id="kredit_total" name="jumlah_kredit">
                                                </div>
                                            </div>
                                            <input type="hidden" name="total_product" id="total-product" value="1">
                                        </div>
                                    </div>
                                    <br /><br />
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <a href="<?php echo site_url('admin/jurnal_umum');?>" class="btn btn-danger" style="margin-bottom:0; font-weight:bold; border-radius:10px;">BATAL</a>
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
        $('input.numberformat').number( true, 0,',','.' );
        $('.dtpicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns : false,
            locale: {
              format: 'DD-MM-YYYY'
            },
            //minDate: new Date()+0,
			//maxDate: new Date()+1,
            //minDate: moment().add(-10, 'd').toDate(),
			//maxDate: moment().add(+0, 'd').toDate(),
            //minDate: moment().startOf('month').toDate(),
			//maxDate: moment().endOf('month').toDate(),
        });
        
        $('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
              $(this).val(picker.startDate.format('DD-MM-YYYY'));
              // table.ajax.reload();
        });

        function tambahData()
        {
            var number = parseInt($('#total-product').val()) + 1;

            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('pmm/jurnal_umum/add_akun'); ?>/"+Math.random(),
                data: {no:number},
                success : function(result){
                    $('#table-product tbody').append(result);
                    $('#total-product').val(parseInt(number));
                }
            });
        }

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


        function getJumlah(th){
            let input_jumlah = 0;
            $( ".jumlah_input" ).each(function() {
                input_jumlah += parseInt( $(this).val());
                $('#total_id').html(input_jumlah).number( true, 0,',','.' );
                $('#total_product').val(input_jumlah);
            });
        }

        function getKredit(th){
            let input_jumlah = 0;
            $( ".kredit_input" ).each(function() {
                input_jumlah += parseInt( $(this).val());
                $('#total_kredit').html(input_jumlah).number( true, 0,',','.' );
                $('#kredit_total').val(input_jumlah);
            });
        }
    </script>


</body>
</html>
