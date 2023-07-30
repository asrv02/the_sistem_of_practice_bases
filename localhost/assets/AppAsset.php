<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css',
        'vendors/mdi/css/materialdesignicons.min.css',
        'vendors/base/vendor.bundle.base.css',
        'vendors/datatables.net-bs4/dataTables.bootstrap4.css',
        'css/style.css',
        'css/cool.css',
        'css/qwerty.css',



    ];
    public $js = [
        
        'vendors/base/vendor.bundle.base.js',
        'vendors/chart.js/Chart.min.js',
        'vendors/datatables.net/jquery.dataTables.js',
        'vendors/datatables.net-bs4/dataTables.bootstrap4.js',
        'js/off-canvas.js',
        'js/hoverable-collapse.js',
        'js/template.js',
        'js/dashboard.js',
        'js/data-table.js',
        'js/jquery.dataTables.js',
        'js/dataTables.bootstrap4.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
