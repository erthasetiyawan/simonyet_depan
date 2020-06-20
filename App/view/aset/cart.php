<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    <?= $data['nama']; ?>
                </h5>
            </div>
                <img class="img-responsive" src="<?= $data['gambar']; ?>">
            <div class="ibox-content">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="false">Deskripsi</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="true">Tarif Sewa</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="true">Harga Sewa</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <p>
                                	<?= str_replace(["\n\r", "\n"], "<br/>", $data['deskripsi']); ?>
                                </p>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                            	<b><?= $data['urai_tarif']; ?></b>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                Rp. <?= number_format($data['nilai_sewa'],0, ',', '.'); ?> <b><i>(<?= Terbilang($data['nilai_sewa']); ?>)</i></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <?= form_open('form'); ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title"></div>
            <div class="ibox-content">
                
                <?= form_text('Nama', 'nama', auth()->nama); ?>

                <?= form_email('Email', 'email', auth()->email); ?>

                <?= form_text('Telp. (Mobile)', 'telp', auth()->notelepon); ?>

            </div>

            <div class="ibox-content">
                <?= form_text('Tanggal Mulai Sewa', 'tgl_mulai', date('Y-m-d'), '', 'required readonly style="cursor:pointer"'); ?>

                <?= form_text('Jam Mulai Sewa', 'jam_mulai', '', '', 'required readonly style="cursor:pointer"'); ?>

                <?= form_line(); ?>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label id="durasi">Durasi</label>
                        <div class="input-group">
                            <input type="number" placeholder="Durasi" class="form-control durasi" id="durasi" name="durasi" value="0" required="" min="1">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><b>Jam</b></button>
                            </span>
                        </div>
                    </div>
                </div>

                <?= form_line(); ?>

                <?= form_text('Tanggal Selesai Sewa', 'tgl_selesai', date('Y-m-d'), '', 'required readonly style="cursor:pointer"'); ?>

                <?= form_text('Jam Selesai Sewa', 'jam_selesai', '', '', 'required readonly style="cursor:pointer"'); ?>
            </div>
            <div class="ibox-content">
                <?= form_area('Keterangan', 'keterangan'); ?>

                <?= form_line(); ?>

                <?= form_button('Simpan','simpan'); ?>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>


<script type="text/javascript">
    $(() => {

        $('.tgl_mulai').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });

        $('.jam_mulai').clockpicker({
            align: 'left',
            donetext: 'Done'
        });
        
    })
</script>