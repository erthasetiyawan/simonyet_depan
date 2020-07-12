<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?= $title; ?></h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style="width: 3%">No</th>
								<th style="width: 15%">Nama</th>
								<th style="width: 20%">Aset</th>
								<th style="width: 5%">Tarif</th>
								<th style="width: 10%">Total</th>
								<th style="width: 10%">Dari</th>
								<th style="width: 10%">Sampai</th>
								<th style="width: 5%">Approve</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0; foreach($data as $val): $no++; ?>
							<tr>
								<td class="text-center"><?= $no; ?></td>
								<td><?= $val['nama_pengguna']; ?></td>
								<td><?= $val['nama_aset']; ?></td>
								<td><?= $val['tarif']; ?></td>
								<td class="text-right"><?= number_format($val['total_harga_sewa'],0,',','.'); ?></td>
								<td><?= $val['tgl_mulai']; ?>, <?= $val['jam_mulai']; ?></td>
								<td><?= $val['tgl_selesai']; ?>, <?= $val['jam_selesai']; ?></td>
								<td class="text-center"><?= ($val['status'] == 0) ? '<a href="'.url('app/admin/sewa/approve?id=' . $val['id']).'" class="btn btn-xs btn-danger xlink">Tidak</a>' : '<a href="'.url('app/admin/sewa/unapprove?id=' . $val['id']).'" class="btn btn-xs btn-primary xlink">Ya</a>'; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.table').DataTable({
		pageLength: 25,
		responsive: true,
	})
</script>