<?php
/**
 * User: Damian
 * Date: 19/05/14
 * Time: 6:05 AM
 */

namespace damiandennis\scrollingblocks;

/**
 * Asset bundle for ColorInput Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class ScrollingBlocksAsset extends AssetBundle
{

    public function init()
    {
        $this->setSourcePath(__DIR__ . '/../../assets');
        $this->setupAssets('css', ['css/yii2-scrollingblocks']);
        $this->setupAssets('js', ['js/yii2-scrollingblocks']);
        parent::init();
    }
}
