<!DOCTYPE html>
<html>

    <head>
      <title>PEMBERITAHUAN PEMBAYARAN</title>
      <?= include 'lib.php'; ?>
      <style type="text/css">
        body{
			font-family: helvetica;
	  	}
        table.minimalistBlack {
          /*border: 1px solid #ededed;*/
          width: 100%;
          text-align: left;
        }
        table.minimalistBlack td, table.minimalistBlack th {
          border: 0.5px solid #ededed;
          padding: 5px 4px;
        }
        table.minimalistBlack tr td {
          /*font-size: 13px;*/
          /*text-align:center;*/
        }
        table.minimalistBlack tr th {
          /*font-size: 14px;*/
          font-weight: bold;
          padding: 10px;
        }
        table.minimalistBlack .table-akun{
            background-color: #e69500;
            color: #fff;
        }
        table.minimalistBlack .table-akun th{
            color: #fff;
        }

        table tr.table-active{
            background-color: #b5b5b5;
        }
        table tr.table-active2{
            background-color: #cac8c8;
        }
        table tr.table-active3{
            background-color: #eeeeee;
        }
        hr{
            margin-top:0;
            margin-bottom:30px;
        }
        h3{
            margin-top:0;
        }
      </style>

    </head>
    <body>
        <br />
        <br />
        <br />
        <table width="98%" border="0" cellpadding="0">
            <tr >
                <td align="center">
                    <div style=";font-weight: bold;font-size: 14px;border-bottom: 1px solid #000;border-top: 1px solid #000;text-transform: uppercase;">BUKTI PENGELUARAN <?= $biaya['bayar_dari'];?></div>
                </td>
            </tr>
        </table>
        <br /><br />
        <table width="98%" border="0" cellpadding="3">
            <tr>
                <th width="25%">Dibayar Kepada</th>
                <th width="2%">:</th>
                <th width="73%" align="left"><?= $biaya["penerima"] ?></th>
            </tr>
            <tr>
                <th>Nomor Transaksi</th>
                <th >:</th>
                <th align="left"><?= $biaya["nomor_transaksi"] ?></th>
            </tr>
            <tr>
                <th>Tanggal Transaksi</th>
                <th >:</th>
                <th align="left"><?= convertDateDBtoIndo($biaya["tanggal_transaksi"]); ?></th>
            </tr>
            <tr>
                <th>Akun Penarikan</th>
                <th >:</th>
                <th align="left"><?= $biaya["bayar_dari"] ?></th>
            </tr>
        </table>
        <br /><br />
        <table class="minimalistBlack" cellpadding="4" width="98%">
            <tr class="table-akun">
                <th width="10%">KODE AKUN</th>
                <th width="30%">NAMA AKUN</th>
                <th width="30%">DESKRIPSI</th>
                <th width="30%" align="right">JUMLAH</th>
            </tr>
            <?php
            $total = 0;
            if(!empty($detail)){
                foreach ($detail as $key => $row) {
                    ?>
                    <tr >
                        <td align="center"><?=  $row['coa_number'];?></td>
                        <td align="left"><?=  $row['akun'];?></td>
                        <td align="left"><?=  $row['deskripsi'];?></td>
                        <td align="right">Rp. <?= number_format($row['jumlah'],0,',','.'); ?></td>
                    </tr>
                    <?php
                    $total += $row['jumlah'];
                }
            }
            ?>
            <tr class="table-akun">
                <th></th>
                <th colspan="2" align="right">TOTAL</th>
                <th align="right">Rp. <?= number_format($total,0,',','.'); ?></th>
            </tr>
        </table>
        <br />
        <br />
        <table width="98%" border="0" cellpadding="3">
            <tr>
                <th width="25%">TERBILANG</th>
                <th width="2%">:</th>
                <th width="73%" align="left"><?= $this->filter->terbilang($total);?></th>
            </tr>
            <tr>
                <th>MEMO</th>
                <th >:</th>
                <th align="left"><?= $biaya["memo"] ?></th>
            </tr>
        </table>
        <br />
        <br />
        <table width="98%" border="0" cellpadding="50">
            <tr>
                <?php
                    $this->db->select('g.admin_group_name, a.admin_ttd, a.admin_name');
                    $this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
                    $this->db->where('a.admin_id',$biaya['admin']);
                    $admin = $this->db->get('tbl_admin a')->row_array();

                    $this->db->select('g.admin_group_name, a.admin_ttd, a.admin_name');
                    $this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
                    $this->db->where('a.admin_id',$biaya['keu']);
                    $keu = $this->db->get('tbl_admin a')->row_array();

                    $this->db->select('g.admin_group_name, a.admin_ttd, a.admin_name');
                    $this->db->join('tbl_admin_group g','a.admin_group_id = g.admin_group_id','left');
                    $this->db->where('a.admin_id',$biaya['unit_head']);
                    $unit_head = $this->db->get('tbl_admin a')->row_array();
                ?>
                <td width="100%">
                    <table width="100%" border="1" cellpadding="2">
                        <tr class="">
                            <td align="center">
                                Dibuat Oleh
                            </td>
                            <td align="center">
                                Diperiksa Oleh
                            </td>
                            <td align="center" >
                                Disetujui Oleh
                            </td>
                        </tr>
                        <tr class="">
                            <td align="center" height="75px">
                            
                            </td>
                            <td align="center">

                            </td>
                            <td align="center">
                            
                            </td>
                        </tr>
                        <tr class="">
                            <td align="center">
                                <?=  $admin['admin_name'];?>
                            </td>
                            <td align="center">
                                <?=  $keu['admin_name'];?>
                            </td>
                            <td align="center">
                                <?=  $unit_head['admin_name'];?>
                            </td>
                        </tr>
                        <tr class="">
                            <td align="center">
                                <?= $admin['admin_group_name']?>
                            </td>
                            <td align="center">
                                <?= $keu['admin_group_name']?>
                            </td>
                            <td align="center">
                                <?= $unit_head['admin_group_name']?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>