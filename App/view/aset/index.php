<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Filter Aset</h5>
            </div>
            <div class="ibox-content">
                <div class="input-group">
                    <input type="text" class="form-control" id="pencarian" placeholder="Cari Aset...">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-reset">
                            <i class="fa fa-times"></i>
                        </button>
                        <button class="btn btn-primary btn-cari">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
            <div class="ibox-content">
                <?php foreach($tarif as $value): ?>
                    <input class="tarif" type="checkbox" id="<?= $value['id']; ?>" name="tarif[]" value="<?= $value['id']; ?>"> <label for="<?= $value['id']; ?>"><?= $value['urai']; ?></label>&nbsp;&nbsp;
                <?php endforeach; ?>
                <input type="hidden" class="kode_tarif">
            </div>
            <div class="ibox-content">
                <div id="range_slider" style="width: 100% !important"></div>
                <div style="padding: 20px;padding-bottom:0;text-align: center;">
                    <label>Rp. <span class="dari"><?= number_format($min,0,',','.'); ?></span></label>
                    &nbsp;&nbsp;-&nbsp;&nbsp;
                    <label>Rp : <span class="sampai"><?= number_format($max,0,',','.'); ?></span></label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div id="data_aset" class="grid"></div>
    </div>
</div>

<script>
    var min = <?= $min; ?>;
    var max = <?= $max; ?>;
    var token = '<?= str_replace(["\n","\r"], '', session('usertoken')); ?>';
</script>
<script type="text/javascript" src="<?= url('assets/js/monyet.js?v='.sha1(microtime(true))) ?>"></script>