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
        'flexibleWidth' => '20%',
        'itemWidth' => '200',
        'offset' => 5,
        'fillEmptySpace' => true
    ];
    public $responsiveWidths = [];
    public $columns = null;
    public $min_width = null;

    public function init()
    {
        //$models = $this->dataProvider->getModels();
        parent::init();
        $id = $this->getId();
        if (isset($this->itemOptions['class'])) {
            $this->itemOptions['class'] .= ' item';
        } else {
            $this->itemOptions['class'] = 'item';
        }
        if (isset($this->options['class'])) {
            $this->options['class'] .= ' scroll-block-view clearfix';
        } else {
            $this->options['class'] = 'scroll-block-view clearfix';
        }
        if (!isset($this->options['id'])) {
            $this->options['id'] = $id;
        }
        $this->wallOptions['container'] = new JsExpression("$('#{$id}')");
        if ($this->columns) {
            $wallOptions['itemwidth'] = (100 / $this->columns).'%';
        }
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
        SpinJsAsset::register($view);
        ModernizrAsset::register($view);
        $id = $this->getId();
        $input = '#' . $id . ' .item';
        $pagination = $this->dataProvider->getPagination();
        $limit = $pagination->getLimit();
        $size = $pagination->getPageSize();
        $page = $pagination->getPage();
        $pageNumLabel = $pagination->pageParam;
        $pageSizelabel = $pagination->pageSizeParam;

        $data = JSON::encode([
            'id' => $id,
            'input' => $input,
            'wallOptions' => $this->wallOptions,
            'size' => $size,
            'limit' => $limit,
            'page' => $page,
            'pageNumLabel' => $pageNumLabel,
            'pageSizelabel' => $pageSizelabel,
            'responsiveWidths' => $this->responsiveWidths
        ]);
        $view->registerJs(
            "$(function() {
                yii.scrollingblocks.setup($data);
            });
            \n",
            View::POS_END
        );
    }
}
