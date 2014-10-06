<?php
/**
 * User: Damian
 * Date: 24/05/14
 * Time: 3:28 AM
 */

namespace damiandennis\scrollingblocks;

class SpinJsAsset extends AssetBundle
{

    public function init()
    {
        $this->setSourcePath(__DIR__ . '/../../../../bower/spin.js');
        $this->setupAssets('js', ['spin','jquery.spin']);
        parent::init();
    }
}
