<!DOCTYPE html>
<html>
	<head>
	  <title>DAFTAR AKUN</title>
	  
	  <style type="text/css">
	  	body{
			font-family: helvetica;
	  	}

	  	table.minimalistBlack {
		  border: 0px solid #000000;
		  width: 100%;
		  text-align: left;
		}

		table.minimalistBlack td, table.minimalistBlack th {
		  border: 0px solid #000000;
		}

		table.minimalistBlack tr th {
		  font-weight: bold;
		  color: #000000;
		  text-align: center;
		}

		table tr.table-active{
            background-color: #b5b5b5;
        }
	  </style>

	</head>
	<body>
		<table width="98%" border="0" cellpadding="3">
			<tr>
				<td align="center">
					<div style="display: block;font-weight: bold;font-size: 11px;">DAFTAR AKUN</div>
				</td>
			</tr>
		</table>
		<br />
		<br />
		<br />
		<table class="minimalistBlack" cellpadding="3" width="98%">
			<tr class="table-active">
                <th width="5%">No.</th>
                <th width="45%" align="left">Nama Akun</th>
                <th width="25%" align="left">Kode Akun</th>
				<th width="25%" align="left">Kategori Akun</th>
            </tr>
            <?php
            
            $total = 0;
            $total_2 = 0;
            $no=1;
            if(!empty($data)){
            	foreach ($data as $key => $row) {

            		?>
            		<tr>
            			<td align="center"><?php echo $no;?></td>
            			<td><?php echo $row['coa'];?></td>
						<td><?php echo $row['coa_number'];?></td>
            			<td><?php echo $this->crud_global->GetField('pmm_coa_category',array('id'=>$row['coa_category']),'coa_category');?></td>
            		</tr>
            		<?php	
            		$no++;
			        	            		
            		
            	}
            }else {
            	?>
            	<tr>
            		<td width="100%" colspan="8" align="center">Tidak Ada Data</td>
            	</tr>
            	<?php
            }
            
            ?>	
           
          
		</table>

		
	</body>
</html>