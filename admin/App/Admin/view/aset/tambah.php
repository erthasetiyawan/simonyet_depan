<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Form Tambah Aset</h5>
			</div>
			<div class="ibox-content">
				<form method="post" class="form-horizontal">
					<div class="form-group">
						<label>Nama Aset</label>
						<input type="text" class="form-control" placeholder="Nama Aset" name="nama" required="">
					</div>

					<div class="form-group">
						<label>Tarif</label>
						<select class="form-control" name="tarif" required="">
							<option value="">Pilih Tarif</option>
							<?php foreach($tarif as $val): ?>
								<option value="<?= $val['id']; ?>"><?= $val['urai']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Harga Sewa</label>
						<input type="text" class="form-control" name="harga_sewa" placeholder="Harga Sewa" id="harga_sewa" onkeyup="uang($(this))" required="">
					</div>

					<div class="form-group">
						<label>Gambar</label>
						<input type="text" class="form-control" name="gambar" placeholder="URL Gambar" required="">
					</div>

					<div class="form-group">
						<label>Deskripsi</label>
						<textarea type="text" class="form-control" name="deskripsi" rows="8" required="" placeholder="Deskripsi"></textarea>
					</div>

					<div class="hr-line-dashed"></div>

					<div class="form-group">
						<button class="btn btn-danger" type="reset">
							Cancel
						</button>
						<button class="btn btn-primary">
							Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	
	$('form').on('submit', function(e) {

		e.preventDefault();

		var form = $(this);

		$.ajax({
			url: baseurl + 'app/admin/aset/simpan',
			type: "post",
			dataType: "json",
			data: form.serializeArray(),
			success:function(res){
				if (res.status === 'success') {
					toastr.success(res.flash, "Information");
					setTimeout(function() {
						window.location.href = res.redirect;
					}, 1200);
				}else{
					toastr.error(res.flash, "Information");
				}
			}
		})

	})

</script>