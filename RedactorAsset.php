<?php
/**
 * sjaakp/yii2-wysiwyg
 * ----------
 * Redactor wrapper for Yii2 framework
 * Version 1.0.0
 * Copyright (c) 2019
 * Sjaak Priester, Amsterdam
 * MIT License
 * https://github.com/sjaakp/yii2-wysiwyg
 * https://sjaakpriester.nl
 */

namespace sjaakp\wysiwyg;

use Yii;
use yii\web\AssetBundle;

/**
 * Class RedactorAsset
 * @package sjaakp\wysiwyg
 */
class RedactorAsset extends AssetBundle
{
    public $js = [
        'redactor.min.js'
    ];

    public $publishOptions = [
        'only' => [
            '*.min.js',
            '*.min.css',
            '_langs/*'
        ]
    ];

    public function init()    {
        parent::init();

        $this->sourcePath = Yii::$app->params['redactor'] ?? '@app/redactor';
    }
}
