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
                        <li><i class="fa fa-sitemap" aria-hidden="true"></i><a href="<?php echo site_url('admin');?>">Dashboard</a></li>
                        <li><a>Edit Pages</a></li>
                    </ul>
                </div>
            </div>
            <div class="row animated fadeInUp">
                <div class="col-sm-12 col-lg-12">
                    <div class="panel">
                        <div class="panel-header">
                            <h3 class="section-subtitle">Edit Pages</h3>
                        </div>
                        <div class="panel-content">
                            <form id="inline-validation" method="POST" class="form-horizontal form-stripe form-submit" novalidate="novalidate" data-button="#btn-submit" action="<?php echo site_url('pages/edit');?>" data-redirect="<?php echo site_url('admin/pages');?>">
                                <input type="hidden" name="id" value="<?php echo $row[0]->pages_id;?>">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Pages<span class="required" aria-required="true">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="pages" name="pages" value="<?php echo $row[0]->pages;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Parent<span class="required" aria-required="true">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->m_pages->SelectParentPages($row[0]->parent_id);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Pages Template<span class="required" aria-required="true">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->m_pages->SelectPagesTemplate($row[0]->pages_template);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Element Input<span class="required" aria-required="true">*</span></label>
                                    <div class="col-sm-8">
                                        <?php echo $this->m_pages->SelectElementInput($row[0]->pages_id);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Status<span class="required" aria-required="true">*</span></label>
                                    <div class="col-sm-8">
                                        <?php $this->general->SelectStatus($row[0]->status);?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-9">
                                        <button type="submit" name="submit" class="btn btn-primary" id="btn-submit" data-loading-text="please wait..">Submit</button>
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

</body>
</html>
