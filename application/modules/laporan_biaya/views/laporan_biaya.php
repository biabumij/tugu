<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>
</head>

<body>
<div class="wrap">
    
    <?php echo $this->Templates->PageHeader();?>

    <div class="page-body">
        <?php echo $this->Templates->LeftBar();?>
        <div class="content">
            <div class="content-header">
                <div class="leftside-content-header">
                    <ul class="breadcrumbs">
                        <li><a>Laporan Keuangan</a></li>
                        <li><a>Overhead</a></li>
                    </ul>
                </div>
            </div>
            <div class="row animated fadeInUp">
                <div class="col-sm-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-header">
                            <h3 class="section-subtitle">Overhead</h3>
                        </div>
                        <div class="panel-heading">
                            <h3 class="panel-title">Overhead</h3>
                            <a href="<?= base_url("laporan/cetak_overhead?filter_date=".$filter_date = date('d-m-Y',strtotime($start_date)).' - '.date('d-m-Y',strtotime($end_date))) ?>">Kembali</a>
                        </div>
                        <div class="panel-content">
                            <form action="<?= site_url('laporan/print_biaya');?>" target="_blank">
                                <div class="row">
                                   <div class="col-sm-3">
                                        <input type="text" id="filter_date" name="filter_date" class="form-control dtpicker input-sm" value="<?php echo $_GET['filter_date'];?>" placeholder="Per Tanggal" autocomplete="off">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-default" style="font-weight:bold; border-radius:10px;"><i class="fa fa-print"></i> Print</button>
                                    </div>
                                </div>    
                            </form>
                            
                            <br />
                            <div id="box-data">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

	<?php echo $this->Templates->Footer();?>

    <script src="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/back/theme/vendor/daterangepicker/daterangepicker.css">

    <script type="text/javascript">
        
        $('.dtpicker').daterangepicker({
            locale: {
              format: 'DD-MM-YYYY'
            },
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            showDropdowns: true,
        });

        $('.dtpicker').on('apply.daterangepicker', function(ev, picker) {
              $(this).val(picker.startDate.format('DD-MM-YYYY')+' - '+picker.endDate.format('DD-MM-YYYY'));
              showLaporan();
        });

        function showLaporan()
        {
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('laporan/ajax_laporan_biaya'); ?>/"+Math.random(),
                dataType : 'html',
                data: {
                    filter_date : $('#filter_date').val(),
                },
                success : function(result){
                    $('#box-data').html(result);
                }
            });
        }

        showLaporan();
        
    </script>

</body>
</html>
