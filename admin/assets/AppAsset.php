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
		//'href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900"',
		'require/css/fonts.min.css',
        'require/css/bootstrap.min.css',
		'require/css/atlantis.css'
    ];
    public $js = [
		//require/js/pages/waves/js		
		//'require/js/jquery/jquery.min.js',
		//'require/js/core/jquery.3.2.1.min.js',
		'require/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js',
		'require/js/core/popper.min.js',
		
		'require/js/core/bootstrap.min.js',
		'require/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js',
		'require/js/atlantis.min.js'
		
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
