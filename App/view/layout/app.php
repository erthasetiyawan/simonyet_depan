<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= config('app.appname') ?>
    </title>
    <?php self::css(); ?>
    <?php self::js(); ?>
    <script>const baseurl = (url) => { return '<?= url(); ?>' + url; }</script>
</head>

<body class="top-navigation">
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-fixed-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="<?= url(); ?>" class="navbar-brand">
                            <?= config('app.appname'); ?></a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">
                            <li class="<?= (isset($page) and $page == 'home') ? 'active' : null ?>">
                                <a href="<?= url(); ?>">Home</a>
                            </li>
                            <li class="<?= (isset($page) and $page == 'aset') ? 'active' : null ?>">
                                <a href="<?= url('app/aset/index'); ?>">Data Aset</a>
                            </li>
                            <li>
                                <a href="">Data Penyewa</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-top-links navbar-right">
                            <?php if(!empty(session('userid'))): ?>

                            <li class="dropdown">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                    <i class="fa fa-user"></i>
                                    <?= auth()->nama; ?> <span class="caret"></span>
                                </a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?= url('app/dashboard/index'); ?>">Dashboard</a></li>
                                    <li><a href="<?= url('app/auth/logout'); ?>">Logout</a></li>
                                </ul>
                            </li>
                            <?php else: ?>
                            <li>
                                <a href="<?= url('app/auth/login'); ?>">
                                    <i class="fa fa-sign-out"></i> Login
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="wrapper wrapper-content" style="margin-top: 50px">
                <div class="container-fluid">
                    <?php self::content(); ?>
                </div>
            </div>
            <div class="footer">
                <div class="pull-right">
                    <b><?= date('Y'); ?></b>
                </div>
                <div>
                    <strong>&copy;</strong>
                    <?= config('app.appfullname'); ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>