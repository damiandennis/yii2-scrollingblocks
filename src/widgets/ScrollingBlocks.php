<?php
/**
 * User: Damian
 * Date: 17/05/14
 * Time: 3:45 AM
 */

namespace damiandennis\scrollingblocks;

use Yii;
use yii\web\View;
use yii\widgets\ListView;
use yii\helpers\Json;
use yii\web\JsExpression;

class ScrollingBlocks extends ListView
{
    public $layout = "{items}";
    public $wallOptions = [
        'autoResize' => true,
        'align' => 'left',
        'flexibleWidth' => true,
        'itemWidth' => '33%',
        'offset' => 0,
    ];
    private $models;

    public function init()
    {
        $models = $this->dataProvider->getModels();
        parent::init();
        $id = $this->getId();
        if (isset($this->itemOptions['class'])) {
            $this->itemOptions['class'] .= ' item';
        }
        else {
            $this->itemOptions['class'] = 'item';
        }
        if (isset($this->options['class'])) {
            $this->options['class'] .= ' scroll-block-view clearfix';
        }
        else {
            $this->options['class'] = 'scroll-block-view clearfix';
        }
        if (!isset($this->options['id'])) {
            $this->options['id'] = $id;
        }
        $this->wallOptions['container'] = new JsExpression("$('#{$id}')");
        $this->registerPluginAssets();
    }

    /**
     * Registers the needed assets
     */
    public function registerPluginAssets()
    {
        $view = $this->getView();
        WookmarkAsset::register($view);
        ScrollingBlocksAsset::register($view);
        ImagesLoadedAsset::register($view);
        $id = $this->getId();
        $input = '#' . $id . ' .item';
        $pagination = $this->dataProvider->getPagination();
        $limit = $pagination->getLimit();
        $size = $pagination->getPageSize();
        $page = $pagination->getPage();
        $pageNumLabel = $pagination->pageParam;
        $pageSizelabel = $pagination->pageSizeParam;

        $data = JSON::encode(array(
            'id' => $id,
            'input' => $input,
            'wallOptions' => $this->wallOptions,
            'size' => $size,
            'limit' => $limit,
            'page' => $page,
            'pageNumLabel' => $pageNumLabel,
            'pageSizelabel' => $pageSizelabel
        ));
        $view->registerJs("
            $(function() {
                yii.scrollingblocks.setup($data);
            });
            \n",
            View::POS_END
        );
    }

}
