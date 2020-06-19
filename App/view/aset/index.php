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
                <div id="range_slider"></div>
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

load_data_aset = (str = '', from = '', to = '', tarif = '') => {

    const data = [];

    var options = {
                    itemSelector: '.grid-item',
                    transitionDuration: '0.5s',
                    initLayout: false
                };

    var $grid = $('.grid').masonry(options);

    $.getJSON(baseurl('app/aset/json?q=' + str + '&from=' + from + '&to=' + to + '&tarif=' + tarif + ''), function(result) {

        data.push(result.data);

        let html = '';

        if (result.data.length > 0) {

            $.each(result.data, (key, val) => {

                html += '<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 animated fadeIn grid-item">' +
                            '<div class="aset">' +
                                '<img class="img-responsive" src="' + val.gambar + '">' +
                                '<div class="content">' +
                                    '<h1><a>' + val.nama + '</a></h1>' +
                                    '<p>' + val.deskripsi.substring(0, val.deskripsi.indexOf('.') + 1) + '</p>' +
                                '</div>' +
                                '<div class="info">'+
                                '<button class="btn btn-sm btn-default">Rp. '+ val.nilai_sewa.replace(/\B(?=(\d{3})+(?!\d))/g,".") +'</button>'+
                                '<button class="btn btn-sm btn-default"><i class="fa fa-tag"></i> '+ val.urai_tarif+'</button>'+
                                '</div>'+
                                '<div class="cart">'+
                                    '<a href="'+baseurl('app/aset/cart?id=' + val.id)+'" data-login="<?= session('usertoken'); ?>" class="btn btn-warning cartAct"><i class="fa fa-shopping-cart"></i> Pesan</a>'+
                                '</div>' +
                            '</div>' +
                        '</div>';

            });

        }else{

            html += '<div class="notfound">Tidak ada data untuk ditampilkan</div>';

        }

        $('#data_aset').html(html);

        $('.cartAct').on('click', function(e) {
            e.preventDefault();
            if ($(this).data('login') === '') {
                swal({
                    title: 'Warning',
                    text: 'Silahkan login untuk melanjutkan!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Lanjutkan!'
                }, function() {

                    window.location.href = baseurl('app/auth/login');
                })
            }
        })

        setTimeout(function() {
        
            $grid.masonry();

            $grid.masonry('destroy')

            $grid.masonry();

            $grid.masonry('reloadItems');

        }, 800);

        

    })

}

pencarian = () => {

    $('.btn-reset').hide();

    var pencarian = $('#pencarian');

    $('#pencarian').on('keyup keypress', function() {

        var value = $(this).val().trim();

        if (value === '') { $('.btn-reset').hide();}
        else{ $('.btn-reset').show(); }

    })

    $('.btn-reset').on('click', function(e) {

        $('#pencarian').val('');

        var range = $('#range_slider').attr('value').split(';');

        load_data_aset('', range[0], range[1], $('.kode_tarif').val());

        $(this).hide();

    })

    $('.btn-cari').on('click', function(e) {

        if (pencarian.val().trim() !== '') {
            var range = $('#range_slider').attr('value').split(';');
            load_data_aset($('#pencarian').val().trim(), range[0], range[1], $('.kode_tarif').val());
        }

    })

}

load_range_slider = () => {

    $("#range_slider").ionRangeSlider({
        min: <?= $min; ?>,
        max: <?= $max; ?>,
        type: 'double',
        prefix: "Rp. ",
        // maxPostfix: "+",
        prettify: true,
        hasGrid: true,
        onChange: function(data) {

            $('span.dari').html(data.fromNumber.toString().replace(/\B(?=(\d{3})+(?!\d))/g,"."));
            $('span.sampai').html(data.toNumber.toString().replace(/\B(?=(\d{3})+(?!\d))/g,"."));

        },
        onFinish: function(data) {

            load_data_aset($('#pencarian').val().trim(), data.fromNumber, data.toNumber, $('.kode_tarif').val());

        }
    });

}

load_cek_tarif = () => {

    var data_tarif = [];

    $('.tarif').on('change', function(e) {

        var cek = $(this);

        if (cek.is(':checked') === true) {

            var index = data_tarif.indexOf(cek.val());

            if(index > -1) {
                data_tarif.splice(index, 1);
            }else{
                data_tarif.push(cek.val());
            }
        }else{

            var index = data_tarif.indexOf(cek.val());

            if (index > -1) {
                data_tarif.splice(index, 1);
            }      

        }

        var tarif = data_tarif.join(',');

        $('.kode_tarif').val(tarif);

        var range = $('#range_slider').attr('value').split(';');

        load_data_aset($('#pencarian').val().trim(), range[0], range[1], tarif);

    })
}


load_data_aset();
pencarian();
load_range_slider();
load_cek_tarif();

</script>