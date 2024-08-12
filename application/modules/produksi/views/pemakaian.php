<form action="<?php echo site_url('produksi/cetak_stock_opname'); ?>" target="_blank">
    <div class="col-sm-3">
        <input type="text" id="filter_date_pemakaian" name="filter_date" class="form-control dtpickerangepemakaian" autocomplete="off" placeholder="Filter By Date">
    </div>
    <!--<div class="col-sm-1">
        <button type="submit" class="btn btn-default" style="border-radius:10px; font-weight:bold;">PRINT</button>
    </div>-->
</form>
<?php
    if(in_array($this->session->userdata('admin_group_id'), array(1,2,3,4,5))){
    ?>
    <div class="col-sm-2">
    <button style="background-color:#88b93c; border:1px solid black; border-radius:10px; line-height:30px;"><a href="<?php echo site_url('produksi/form_pemakaian'); ?>"><b style="color:white;">BUAT PEMAKAIAN</b></a></button>
    </div>
    <?php
    }
    ?>
<br />
<br />
<div class="table-responsive">
    <table class="table table-striped table-hover table-center" id="table-pemakaian" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Jumlah Bahan</th>
                <th>Jumlah Solar</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>