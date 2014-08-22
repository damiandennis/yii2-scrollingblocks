Scrolling Blocks
===============

This is a pinterest style layout using the wookmark jquery plugin with infinite scrolling and responsive capabilities built in.

Install via composer:

```sh
php composer.phar --prefer-dist --stability=dev damiandennis/yii2-scrollingblocks
```

To use the widget:

```php
namespace damiandennis\scrollingblocks;

echo ScrollingBlocks::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'wallOptions' => [
      'itemWidth' => 200,
      'offset' => 5,
      'autoResize' => true,
      'flexibleWidth' => '20%', //This can be determined by the responsive widths below.
    ],
    'responsiveWidths' => [
      '(max-width: 520px)'=>'100%',
      '(min-width: 521px) and (max-width: 655px)'=>'50%',
      '(min-width: 656px) and (max-width: 1000px)'=>'33%',
      '(min-width: 1001px) and (max-width: 1199px)'=>'25%',
      '(min-width: 1200px)'=>'20%',
    ]
]);
```

