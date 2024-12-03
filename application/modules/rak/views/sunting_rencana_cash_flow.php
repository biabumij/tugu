<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>

    <style type="text/css">
        body{
			font-family: helvetica;
	  	}
        .form-approval {
            display: inline-block;
        }
		
		.mytable thead th {
		  /*background-color: #D3D3D3;
		  border: solid 1px #000000;*/
		  color: #000000;
		  text-align: center;
		  vertical-align: middle;
		  padding : 10px;
		}
		
		.mytable tbody td {
		  padding: 5px;
		}
		
		.mytable tfoot th {
		  padding: 5px;
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
                                <h3><b>RENCANA KERJA CASH FLOW</b></h3>
                            </div>
                            <div class="panel-content">
                                <form method="POST" action="<?php echo site_url('rak/submit_sunting_rencana_cash_flow');?>" id="form-po" enctype="multipart/form-data" autocomplete="off">
                                    <input type="hidden" name="id" value="<?= $rak["id"] ?>">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th width="200px">Tanggal</th>
                                            <td><input type="text" class="form-control dtpicker" name="tanggal_rencana_kerja"  value="<?= $tanggal ?>" /></td>
                                        </tr>
                                        <tr>
                                            <th width="100px">Lampiran</th>
                                            <td>:  
                                                <?php foreach($lampiran as $l) : ?>                                    
                                                <a href="<?= base_url("uploads/rencana_cash_flow/".$l["lampiran"]) ?>" target="_blank">Lihat bukti  <?= $l["lampiran"] ?> <br></a></td>
                                                <?php endforeach; ?>
                                        </tr>
                                    </table>
                                    <table class="mytable table-bordered table-hover table-striped" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">NO.</th>
                                                <th width="50%">URAIAN</th>
                                                <th width="45%">NILAI</th>       
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1.</td>
                                                <td class="text-left">Biaya Bahan</td>
                                                <td class="text-right"><input type="text" id="biaya_bahan" name="biaya_bahan" class="form-control rupiahformat text-right" value="<?= $rak['biaya_bahan'] ?>" required="" autocomplete="off"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2.</td>
                                                <td class="text-left">Biaya Alat</td>
                                                <td class="text-right"><input type="text" id="biaya_alat" name="biaya_alat" class="form-control rupiahformat text-right" value="<?= $rak['biaya_alat'] ?>" required="" autocomplete="off"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">3.</td>
                                                <td class="text-left">Biaya Bank</td>
                                                <td class="text-right"><input type="text" id="biaya_bank" name="biaya_bank" class="form-control rupiahformat text-right" value="<?= $rak['biaya_bank'] ?>" required="" autocomplete="off"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">4.</td>
                                                <td class="text-left">Overhead</td>
                                                <td class="text-right"><input type="text" id="overhead" name="overhead" class="form-control rupiahformat text-right" value="<?= $rak['overhead'] ?>" required="" autocomplete="off"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">5.</td>
                                                <td class="text-left">Termin</td>
                                                <td class="text-right"><input type="text" id="termin" name="termin" class="form-control rupiahformat text-right" value="<?= $rak['termin'] ?>" required="" autocomplete="off"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">6.</td>
                                                <td class="text-left">Pajak Keluaran</td>
                                                <td class="text-right"><input type="text" id="pajak_keluaran" name="pajak_keluaran" class="form-control rupiahformat text-right" value="<?= $rak['pajak_keluaran'] ?>" required="" autocomplete="off"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">7.</td>
                                                <td class="text-left">Pajak Masukan</td>
                                                <td class="text-right"><input type="text" id="pajak_masukan" name="pajak_masukan" class="form-control rupiahformat text-right" value="<?= $rak['pajak_masukan'] ?>" required="" autocomplete="off"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">8.</td>
                                                <td class="text-left">Penerimaan Pinjaman</td>
                                                <td class="text-right"><input type="text" id="penerimaan" name="penerimaan" class="form-control rupiahformat text-right" value="<?= $rak['penerimaan'] ?>" required="" autocomplete="off"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">9.</td>
                                                <td class="text-left">Pengembalian Pinjaman</td>
                                                <td class="text-right"><input type="text" id="pengembalian" name="pengembalian" class="form-control rupiahformat text-right" value="<?= $rak['pengembalian'] ?>" required="" autocomplete="off"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">10.</td>
                                                <td class="text-left">PPh 22</td>
                                                <td class="text-right"><input type="text" id="pph" name="pph" class="form-control rupiahformat text-right" value="<?= $rak['pph'] ?>" required="" autocomplete="off"></td>
                                            </tr>
                                        </tbody>
                                    </table>
									<br />
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <a href="<?= site_url('admin/rencana_cash_flow');?>" class="btn btn-danger" style="margin-bottom:0px; font-weight:bold; border-radius:10px;">BATAL</a>
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

    </script>


</body>
</html>
