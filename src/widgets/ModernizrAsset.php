<?php
/**
 * User: Damian
 * Date: 19/05/14
 * Time: 6:05 AM
 */

namespace damiandennis\scrollingblocks;

class ModernizrAsset extends AssetBundle
{

    public function init()
    {
        $this->setSourcePath(__DIR__ . '/../../../../components/modernizr');
        $this->setupAssets('js', ['modernizr']);
        parent::init();
    }
}