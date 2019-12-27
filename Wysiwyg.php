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
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * Class Wysiwyg
 * @package sjaakp\wysiwyg
 */
class Wysiwyg extends InputWidget
{
    /**
     * @var array the options for the Imperavi Redactor.
     * Refer to the [Imperavi Web page](http://imperavi.com/redactor/docs/) for possible options.
     * There are lots of them!
     */
    public $redactorOptions = [];

    /**
     * @var bool whether CSS files should be registered. Set this to false if
     * you include the CSS in the sites main file.
     */
    public $includeCss = true;

    /**
     * Renders the widget.
     */
    public function run()
    {
        $view = $this->getView();
        $asset = RedactorAsset::register($view);

        if ($this->includeCss) $asset->css[] = 'redactor.min.css';

        if (!isset($this->redactorOptions['lang']) || empty($this->redactorOptions['lang'])) {
            $this->redactorOptions['lang'] = strtolower(substr(Yii::$app->language, 0, 2));
        }

        $asset->js[] = '_langs/' . $this->redactorOptions['lang'] . '.js';

        // plugins with CSS file (Redactor v. 3.3.2)
        $withCss = [ 'clips', 'filemanager', 'handle', 'inlinestyle', 'variable' ];

        $plugins = $this->redactorOptions['plugins'] ?? [];

        foreach ($plugins as $plugin) {
            $asset->js[] = "_plugins/$plugin/$plugin.min.js";
            if ($this->includeCss && in_array($plugin, $withCss))    {
                $asset->css[] = "_plugins/$plugin/$plugin.min.css";
            }
        }

        $view->registerCss('.wysiwyg{height: auto;}');  // neutralize height setting of class 'form-control'

        $id = $this->options['id'];

        $opts = empty($this->redactorOptions) ? '' : Json::encode($this->redactorOptions);
        $view->registerJs("\$R('#$id textarea',$opts);");

        $ta = is_null($this->model) ? Html::textarea($this->name, $this->value)
            : Html::activeTextarea($this->model, $this->attribute);

        Html::addCssClass($this->options, 'wysiwyg');

        echo Html::tag('div', $ta, $this->options);
    }
}
