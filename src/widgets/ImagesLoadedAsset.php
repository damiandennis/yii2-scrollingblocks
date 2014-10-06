<?php
/**
 * User: Damian
 * Date: 24/05/14
 * Time: 3:28 AM
 */

namespace damiandennis\scrollingblocks;

/**
 * Asset bundle for ColorInput Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class ImagesLoadedAsset extends AssetBundle
{

    public function init()
    {
        $this->setSourcePath(__DIR__ . '/../../../../bower/imagesloaded');
        $this->setupAssets('js', ['imagesloaded.pkgd']);
        parent::init();
    }
}
