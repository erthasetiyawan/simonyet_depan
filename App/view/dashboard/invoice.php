<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Invoice</h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
					<div id="print">
					<h1 class="text-center"><b>Invoice</b></h1>
					<table class="table table-bordered">
						<?php foreach($sewa as $val): ?>
						<tr>
							<td style="width: 15%">Nama</td>
							<td class="text-center" style="width: 1%">:</td>
							<td><?= auth()->nama; ?></td>
						</tr>
						<tr>
							<td style="width: 15%">Aset</td>
							<td class="text-center" style="width: 1%">:</td>
							<td><?= $val['nama_aset']; ?></td>
						</tr>
						<tr>
							<td style="width: 15%">Dari</td>
							<td class="text-center" style="width: 1%">:</td>
							<td><?= $val['tgl_mulai']; ?>, <?= $val['jam_mulai'] ?></td>
						</tr>
						<tr>
							<td style="width: 15%">Sampai</td>
							<td class="text-center" style="width: 1%">:</td>
							<td><?= $val['tgl_selesai']; ?>, <?= $val['jam_selesai'] ?></td>
						</tr>
						<tr>
							<td style="width: 15%">Tarif</td>
							<td class="text-center" style="width: 1%">:</td>
							<td><?= $val['tarif']; ?></td>
						</tr>
						<tr>
							<td style="width: 15%">Total</td>
							<td class="text-center" style="width: 1%">:</td>
							<td><?= number_format($val['total_harga_sewa'],0,',','.'); ?> (<?= Terbilang($val['total_harga_sewa']); ?>)</td>
						</tr>
						<?php endforeach; ?>
					</table>
					</div>
				</div>

				<button class="btn btn-info" type="button" onclick="printDiv()">
					<i class="fa fa-print"></i>
					Cetak
				</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function printDiv() 
	{

	  var divToPrint=document.getElementById('print');

	  var newWin=window.open('','Print-Window');

	  newWin.document.open();

	  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

	  newWin.document.close();

	  setTimeout(function(){newWin.close();},10);

	}
</script>