<?php


error_reporting(E_ALL);

$nama_folder = basename(__DIR__);

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {

	$folder_databases = realpath(dirname(dirname(dirname(__DIR__)))).''.DIRECTORY_SEPARATOR.''.'databases'.''.DIRECTORY_SEPARATOR.'';
	$folder_session = realpath(dirname(dirname(dirname(__DIR__)))).''.DIRECTORY_SEPARATOR.''.'databases'.''.DIRECTORY_SEPARATOR.''.'session'.''.DIRECTORY_SEPARATOR.'';  

    if (!file_exists($folder_databases)) {
		@mkdir($folder_databases, 0777);
	}

	if (!file_exists($folder_session)) {
		@mkdir($folder_session, 0777);
	}

	$direktori_session = realpath(dirname(dirname(dirname(__DIR__)))).''.DIRECTORY_SEPARATOR.''.'databases'.''.DIRECTORY_SEPARATOR.''.'session'.''.DIRECTORY_SEPARATOR.''.$nama_folder.''.DIRECTORY_SEPARATOR.'';

} else {

	$folder_session = realpath(dirname(dirname(__DIR__))).''.DIRECTORY_SEPARATOR.''.'databases'.''.DIRECTORY_SEPARATOR.''.'session'.''.DIRECTORY_SEPARATOR.'';

	if (!file_exists($folder_session)) {
		@mkdir($folder_session, 0777);
	}
	
	$direktori_session = realpath(dirname(dirname(__DIR__))).''.DIRECTORY_SEPARATOR.''.'databases'.''.DIRECTORY_SEPARATOR.''.'session'.''.DIRECTORY_SEPARATOR.''.$nama_folder.''.DIRECTORY_SEPARATOR.'';

}

if (!file_exists($direktori_session)) {
	@mkdir($direktori_session, 0777);
}

ini_set('session.save_path', $direktori_session);

require __DIR__ . '/Ez/Loader.php';

$loader = new Ez\Loader;

$loader->addNamespace('Ez', __DIR__ . '/Ez');
$loader->addNamespace('App', __DIR__ . '/App');
$loader->requireFile(__DIR__ . '/Ez/Function.php');

Ez\Env::file(__DIR__ . '/.env');
Ez\Config::load(__DIR__ . '/config');

date_default_timezone_set(config('app.time'));

Ez\ErrorHandler::register();

if (config('app.debug')) Ez\ErrorHandler::debug();

Ez\View::layout('App.view.layout.app');

Ez\View::registerCss([
	'assets/css/bootstrap.min.css',
	'assets/font-awesome/css/font-awesome.css',
	'assets/css/animate.css',
	'assets/css/style.css',
	'assets/css/plugins/iCheck/custom.css',
	'assets/css/plugins/sweetalert/sweetalert.css',
	'assets/css/plugins/toastr/toastr.min.css',
	'assets/css/plugins/dataTables/datatables.min.css',
	'assets/css/plugins/datapicker/datepicker3.css',
	'assets/css/plugins/jasny/jasny-bootstrap.min.css',
	'assets/css/plugins/dropzone/basic.css',
	'assets/css/plugins/dropzone/dropzone.css',
	'assets/css/app.css?v=' . sha1(microtime(true)) . ''
]);

Ez\View::registerJs([
	'assets/js/plugins/pace/pace.min.js',
	'assets/js/jquery-3.1.1.min.js',
	'assets/js/popper.min.js',
	'assets/js/bootstrap.min.js',
	'assets/js/plugins/metisMenu/jquery.metisMenu.js',
	'assets/js/plugins/slimscroll/jquery.slimscroll.min.js',
	'assets/js/plugins/iCheck/icheck.min.js',
	'assets/js/plugins/sweetalert/sweetalert.min.js',
	'assets/js/plugins/toastr/toastr.min.js',
	'assets/js/plugins/dataTables/datatables.min.js',
	'assets/js/plugins/dataTables/dataTables.bootstrap4.min.js',
	'assets/js/plugins/datapicker/bootstrap-datepicker.js',
	'assets/js/plugins/jasny/jasny-bootstrap.min.js',
	'assets/js/plugins/dropzone/dropzone.js',
	'assets/js/plugins/pdfjs/pdf.js',
	'assets/js/inspinia.js',
	'assets/js/app.js'
]);

$appconfig = (new Ez\Database)->table('pengaturan')->select()->one();

$appconfig = is_null($appconfig) ? [] : $appconfig;

Ez\Config::set('app', array_merge(config('app'),  $appconfig));


$logo = baseDir('assets/img/logo');

if (file_exists($logo)) {
	foreach(scandir($logo) as $img){
		if (!in_array($img, ['.', '..', 'default.png'])) {
			Ez\Config::set('logo', $img);
		}
	}
}

if (is_null(config('logo'))) {
	Ez\Config::set('logo', 'default.png');
}

(new Ez\Router)->start('app/base/index');