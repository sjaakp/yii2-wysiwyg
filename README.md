Yii2-wysiwyg
------------

#### Redactor editor for Yii 2.x ####

[![Latest Stable Version](https://poser.pugx.org/sjaakp/yii2-wysiwyg/v/stable)](https://packagist.org/packages/sjaakp/yii2-wysiwyg)
[![Total Downloads](https://poser.pugx.org/sjaakp/yii2-wysiwyg/downloads)](https://packagist.org/packages/sjaakp/yii2-wysiwyg)
[![License](https://poser.pugx.org/sjaakp/yii2-wysiwyg/license)](https://packagist.org/packages/sjaakp/yii2-wysiwyg)

This is a wrapper for the excellent [Imperavi Redactor](http://imperavi.com/redactor/)
'What-you-see-is-what-you-get' editor for the
[Yii 2.0](https://yiiframework.com/ "Yii") PHP Framework. It automatically loads
any [Redactor plugin](https://imperavi.com/redactor/plugins/) needed.

A demonstration of **yii2-wysiwyg** is [here](https://sjaakpriester.nl/software/wysiwyg).

## Installation ##

The preferred way to install **yii2-wysiwyg** is through [Composer](https://getcomposer.org/). 
Either add the following to the require section of your `composer.json` file:

`"sjaakp/yii2-wysiwyg": "*"` 

Or run:

`composer require sjaakp/yii2-wysiwyg "*"` 

You can manually install **yii2-wysiwyg** by
 [downloading the source in ZIP-format](https://github.com/sjaakp/yii2-wysiwyg/archive/master.zip).

### Redactor files ###

[Redactor](http://imperavi.com/redactor/) is proprietry software and is not available
via Composer. You have to download it manually.
 
 **Yii2-wysiwyg** assumes that the Redactor files (that is, the complete contents of
 the `'redactor'` directory in the ZIP-file you get from Imperavi) live in `'@app/redactor'`.
 You can set another source path by setting parameter `'redactor'`
  in the application configuration file, usually called `web.php` or `main.php` 
  in the `config` directory, like so:
 
    $params = [
        'adminEmail' => ...,
        'redactor' => <path to Redactor files, or alias>
    ];
    
    $config = [
        // ...
        'params' => $params,
        // ...
    ]

The path can and will most likely be set as an alias.

## Using Wysiwyg ##

**Wysiwyg** is just an ordinary Yii 2 [InputWidget](https://yiiframework.com/doc/api/2.0/yii-widgets-inputwidget).
In a form, it can be used like this:

    <?php
        use sjaakp\wysiwyg\Wysiwyg;
    ?>

    <?php $form = ActiveForm::begin([
        // ... form options ...
    ]); ?>

        ... other fields ...
        
        <?= $form->field($model, 'story')->widget(Wysiwyg::class, [
            // ... Wysiwyg options ...
        ]) ?>
        
        ... more fields ...

    <?php ActiveForm::end(); ?>

Like any InputWidget, **Wysiwyg** can also be used outside a form. In that case, it should be 
associated with a `name` and a `value`:

    <?php
        use sjaakp\wysiwyg\Wysiwyg;
    ?>

    <?= Wysiwyg::widget([
        'name' => 'myWysiwyg',
        'value' => 'Initial text...',
        // ... other options ...
    ]) ?>

## Options ##

**Wysiwyg** has al the properties of an [InputWidget](https://yiiframework.com/doc/api/2.0/yii-widgets-inputwidget#$attribute-detail),
plus the following:

 - **redactorOptions** `array` the options for the Imperavi Redactor.Refer to the 
 [Imperavi Web page](http://imperavi.com/redactor/docs/) for possible options.
 There are lots of them!
- **includeCss** `bool` whether CSS files should be registered. Set this to false in case
 you include the CSS in the sites main file.

