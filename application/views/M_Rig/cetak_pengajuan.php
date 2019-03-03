
	
	<h4 style="text-align: center">TANDA TERIMA TAGIHAN</h4>
	<h4 style="text-align: center">PT. Solusi Balad Lumampah ( Dalam PKPU )</h4>
	<h4 style="text-align: center">Dan Aom Juang Wibowo Sastra Ningrat ( Dalam PKPU )</h4>


	<?php foreach($cetak->result() as $row) { ?>
        <h4 style="text-align: center">ID_<?php echo $row->id;?></h4>
        <h4 style="text-align: center">No. Urut <?php echo $row->numbering;?></h4>
	<?php } ?>
<div style="padding-top: 64px;"></div>
<table style="border:1px solid black;margin-left:auto;margin-right:auto;">
	<thead>
		<tr>
			<td style="border:1px solid black">No</td>
			<td style="border:1px solid black" width="200px">Nama Dokumen</td>
			<td style="border:1px solid black">Checklist</td>
			<td style="border:1px solid black">Keterangan</td>
		</tr>
	</thead>

	<tbody>

		<?php

			foreach($cetak->result() as $row) {
	            $arr[] = array('BILYET K',$row->bilyet_k,$row->bilyet_k_detail);
	            $arr[] = array('BILYET S',$row->bilyet_s,urlencode($row->bilyet_s_detail));
	            $arr[] = array('KTP',$row->ktp,$row->ktp_detail);
	            $arr[] = array('FAMILY CARD',$row->family_card,$row->family_card_detail);
	            $arr[] = array('RECEIPT',$row->receipt,$row->receipt_detail);
	            $arr[] = array('PASSPORT',$row->passport,$row->passport_detail);
	            $arr[] = array('SURAT KUASA',$row->power_of_attorney,$row->power_of_attorney_detail);
	            $arr[] = array('LETTER BILL',$row->letter_bill,$row->letter_bill_detail);
	        }


		?>
		 
	
		<?php $no=0; $num=0; foreach($arr as $key => $value) { $num++; ?>
			
				<tr>
					<td style="border:1px solid black"><?php echo $num;?></td>
					<td style="border:1px solid black"><?php echo $arr[$no][0]?></td>
					<td style="border:1px solid black"><?php echo $arr[$no][1] == 1 ? '<center><img width="20" src="'.base_url().'assets/img/check.png"></center>' : ''; ?></td>
					<td style="border:1px solid black"><?php echo $arr[$no][2]?></td>
					
				</tr>
		<?php $no++; } ?>
	</tbody>

</table>