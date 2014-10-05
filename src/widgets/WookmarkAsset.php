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
class WookmarkAsset extends AssetBundle
{

    public function init()
    {
        $this->setSourcePath(__DIR__ . '/../../../../bower-asset/wookmark-jquery');
        $this->setupAssets('js', ['jquery.wookmark']);
        parent::init();
    }
}
