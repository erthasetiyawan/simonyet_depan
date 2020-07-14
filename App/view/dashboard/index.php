<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?= $title; ?></h5>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th style="width: 3%">No</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Aset</th>
								<th>Durasi</th>
								<th>Dari</th>
								<th>Sampai</th>
								<th>Tarif</th>
								<th>Approve</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0; foreach($data as $val): $no++; ?>
							<tr>
								<td class="text-center"><?= $no; ?></td>
								<td><?= $val['nama']; ?></td>
								<td><?= $val['email']; ?></td>
								<td><?= $val['nama_aset']; ?></td>
								<td class="text-center"><?= $val['durasi']; ?></td>
								<td class="text-center"><?= tgl_indo($val['tgl_mulai']); ?>, <?= date('H:i', strtotime($val['jam_mulai'])); ?></td>
								<td class="text-center"><?= tgl_indo($val['tgl_selesai']); ?>, <?= date('H:i', strtotime($val['jam_selesai'])); ?></td>
								<td><?= $val['tarif']; ?></td>
								<td class="text-center">
									<?= ($val['status'] == 1) ? "<label class='label label-primary'>Ya</label>" : "<label class='label label-danger'>Belum</label>"; ?>
									<?php if($val['status'] == 1): ?>
										<a target="_blank" href="<?= url('app/dashboard/invoice?token=' . $val['id']); ?>" class="btn btn-xs btn-info">
											<i class="fa fa-print"></i>
											Cetak Invoice
										</a>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>