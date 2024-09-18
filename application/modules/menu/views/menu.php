<?php
if($this->session->userdata('admin_group_id') == 1){
?>
<!doctype html>
<html lang="en" class="fixed">
<head>
    <?php echo $this->Templates->Header();?>
    <style type="text/css">
        body {
            font-family: helvetica;
        }
        
		.mytable thead th {
		  background-color:	#e69500;
		  color: #ffffff;
		  text-align: center;
		  vertical-align: middle;
		  padding: 5px;
		}
		
		.mytable tbody td {
		  padding: 5px;
		}
		
		.mytable tfoot td {
		  background-color:	#e69500;
		  color: #FFFFFF;
		  padding: 5px;
		}

        button {
			border: none;
			border-radius: 5px;
			padding: 5px;
			font-size: 12px;
			text-transform: uppercase;
			cursor: pointer;
			color: white;
			background-color: #2196f3;
			box-shadow: 0 0 4px #999;
			outline: none;
		}

		.ripple {
			background-position: center;
			transition: background 0.8s;
		}
		.ripple:hover {
			background: #47a7f5 radial-gradient(circle, transparent 1%, #47a7f5 1%) center/15000%;
		}
		.ripple:active {
			background-color: #6eb9f7;
			background-size: 100%;
			transition: background 0s;
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
                            <h3 class="section-subtitle" style="font-weight:bold; text-transform:uppercase;"><?php echo $row[0]->menu_name;?></h3>
                            <div class="text-left">
                                <a href="<?php echo site_url('admin');?>">
                                <button class="ripple"><b><i class="fa-solid fa-rotate-left"></i> KEMBALI</b></button></a>
                            </div>
                            <div class="panel-actions">
                                <ul>
                                    <li class="action"><span class="fa fa-refresh action" onclick="reload_table()" aria-hidden="true"></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-content">
                            <div class="leftside-content-header">
                                <ul class="nav nav-tabs ">
                                    <li class="active"><a href="#table" data-toggle="tab" aria-expanded="true" style="border-radius:10px; font-weight:bold;">TABLE</a></li>
                                    <li class=""><a href="#add" data-toggle="tab" aria-expanded="false" style="border-radius:10px; font-weight:bold;">ADD NEW</a></li>
                                </ul>
                                <br />
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="table">
                                        <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th>Menu</th>
                                                    <th>Parent</th>
                                                    <th width="15%">Status</th>
                                                    <th width="15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="add">
                                        <form id="inline-validation" method="POST" class="form-horizontal form-stripe form-submit" novalidate="novalidate" data-button="#btn-submit" action="<?php echo site_url('menu/add');?>" data-redirect="<?php echo site_url('admin/menu');?>">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Menu<span class="required" aria-required="true">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="menu" name="menu">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Parent<span class="required" aria-required="true">*</span></label>
                                                <div class="col-sm-8">
                                                    <?php echo $this->m_menu->SelectMenu();?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Icon</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="menu_icon" name="menu_icon" data-required="false">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">File Controller</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="file_cont" name="file_cont"  data-required="false">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Order<span class="required" aria-required="true">*</span></label>
                                                <div class="col-sm-8">
                                                    <?php echo $this->crud_global->OrderInput('tbl_menu');?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Order Group</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control"  name="order_group_id"  data-required="false">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Status<span class="required" aria-required="true">*</span></label>
                                                <div class="col-sm-8">
                                                    <?php $this->general->SelectStatus();?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-9">
                                                    <button type="submit" name="submit" class="btn btn-success" id="btn-submit" data-loading-text="please wait.." style="font-weight:bold; border-radius:10px;">KIRIM</button>
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
        </div>
        
    </div>
</div>

	<?php echo $this->Templates->Footer();?>
    <script src="https://kit.fontawesome.com/591a1bf2f6.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            load_table("<?php echo site_url($row[0]->menu_alias.'/table');?>");
        });
    </script>

</body>
</html>
<?php
}
?>
