<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>
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
                            <h3 class="section-subtitle" style="font-weight:bold; text-transform:uppercase;"><?php echo $row[0]->menu_name;?></h3>
                            <div class="text-left">
                                <a href="<?php echo site_url('admin');?>">
                                <button style="color:white; background-color:#5bc0de; border:1px solid black; border-radius:10px; line-height:30px;"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                            </div>
                            <div class="panel-actions">
                                <ul>
                                    <li class="action"><span class="fa fa-refresh action" onclick="reload_table()" aria-hidden="true"></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-content">
                            <div class="leftside-content-header">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#table" data-toggle="tab" aria-expanded="true" style="border-radius:10px; font-weight:bold;">USERS</a></li>
                                </ul>
                                <br />
                                <div class="tab-content">
                                    <div class="tab-pane fade active in">
                                        <table class="data-table table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Jabatan</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
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
</div>

	<?php echo $this->Templates->Footer();?>

    <script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>
    
    <script type="text/javascript">
        $(document).ready(function() {
            load_table("<?php echo site_url('admin/users');?>");
        });
    </script>

</body>
</html>
