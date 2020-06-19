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
        <div class="ibox float-e-margins">
            <div class="ibox-title"></div>
            <div class="ibox-content"></div>
        </div>
    </div>
</div>