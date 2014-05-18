<?php
/**
 * User: Damian
 * Date: 17/05/14
 * Time: 3:45 AM
 */

namespace damiandennis\scrollingblocks;

use Yii;
use yii\widgets\ListView;

class ScrollingBlocks extends ListView
{
    public $options = ['class' => 'scroll-block-view'];
    public $pager = false;
}
