<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5><?= $title; ?></h5>
				<div class="ibox-tools">
					<a href="<?= url('app/admin/aset/tambah'); ?>" class="btn btn-primary btn-xs">
						<i class="fa fa-plus"></i>
						Tambah
					</a>
				</div>
			</div>
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style="width: 3%">No</th>
								<th style="width: 15%">Nama</th>
								<th style="width: 20%">Deskripsi</th>
								<th style="width: 8%">Nilai Sewa</th>
								<th style="width: 5%">Tarif</th>
								<th style="width: 10%">Gambar</th>
								<th style="width: 7%"></th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0; foreach($data as $val): $no++; ?>
							<tr>
								<td class="text-center"><?= $no; ?></td>
								<td><?= $val['nama']; ?></td>
								<td><?= substr($val['deskripsi'],0,200); ?></td>
								<td class="text-right"><?= number_format($val['nilai_sewa'],0,',','.'); ?></td>
								<td class="text-center"><?= $val['nama_tarif']; ?></td>
								<td class="text-center"><img style="width: 150px" src="<?= $val['gambar']; ?>" class="img-responsive"></td>
								<td class="text-center">
									<a href="<?= url('app/admin/aset/edit?id=' . $val['id']); ?>" class="btn btn-xs btn-warning">
										<i class="fa fa-edit"></i>
										Ubah
									</a>
									<a href="<?= url('app/admin/aset/hapus?id=' . $val['id']); ?>" class="btn btn-xs btn-danger xlink">
										<i class="fa fa-trash"></i>
										Hapus
									</a>
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

<script type="text/javascript">
	$('.table').DataTable({
		pageLength: 25,
		responsive: true,
	})
</script>