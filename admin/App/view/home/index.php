<style type="text/css">
    .text-right{
        text-align: right;
    }
</style>

<?php if(count($widget)): ?>
<div class="row">
    <?php foreach($widget as $key => $val): ?>
    <div class="col-lg-<?= $val['column']; ?>">
        <div class="widget style1 <?= $val['class']; ?>">
            <div class="row">
                <div class="col-md-4 text-center">
                    <i class="<?= $val['icon']; ?>"></i>
                </div>
                <div class="col-md-8 text-right">
                    <span> <?= $val['label']; ?> </span>
                    <h2 class="font-bold"><?= $val['data']; ?></h2>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>