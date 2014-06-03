<?php

/**
 * StickyPage class file.
 *
 * PHP Version 5.1
 * 
 * @package  Widget
 * @author   FBurhan <sefburhan@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://www.yiiframework.com/user/62626/
 */
class StickyPage extends CWidget {

    /**
     * @var array the data for  StickyPage Widget which contains message,x-axis,y-axis,angle(degree),footer,height,width,
     */
    public $data = array();

    /**
     * @var string the height of the StickyPage Container .
     */
    public $height = '400px';

    /**
     * @var string the witdth of the StickyPage for Container's witdth.
     */
    public $width = '400px;';

    /**
     * @var string the cssFile of the StickyPage for Css file.
     */
    public $cssFile;

    /**
     * @var string the jsFile of the StickyPage for Javascript file.
     */
    public $jsFile;

    public function init() {

        // Put togehther options for plugin
        $path = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.stickyPage.assets', -1, false));

        $this->jsFile = $path . '/jquery-stickypage.js';
        $this->cssFile = $path . '/jquery-stickypage.css';

        $cs = Yii::app()->clientScript;

        $cs->registerScriptFile($this->jsFile);
        $cs->registerCssFile($this->cssFile);

        $script = '
       (function($) {
           $("#sticky-notes").stickypage({width: "' . $this->width . '", height: "' . $this->height . '"});
       })(jQuery);
         ';
        $cs->registerScript('sticky-notes', $script);
    }

    /**
     * Run this widget.
     * This method registers necessary javascript and renders the needed HTML code.
     */
    public function run() {

        $sticker = '<ol id="sticky-notes" class="sticky-page">';
        foreach ($this->data as $contents) {
             $style=null;
             $style.=isset($contents['height']) ? "height:".$contents['height']." !important;": "height:150px" ." !important;";
             $style.=isset($contents['width']) ? "width:".$contents['width']." !important;": "width:100px" ." !important;";
             $sticker.='<li style='.$style.'   data-pos="';
             $sticker.=isset($contents['x']) ? $contents['x'].',' : "10px ,";
             $sticker.=isset($contents['y']) ? $contents['y'] .',' : "10px ,";
             $sticker.=isset($contents['degree']) ? $contents['degree'] .'">' : "-3deg".'">';
             $sticker.=isset($contents['message']) ? $contents['message'] : "This is default Message";
             $sticker.= isset($contents['footer']) ? "<time>".$contents['footer']."</time></li>" :'</li>';
        }
        $sticker.='</ol>';
        echo $sticker;
    }

}

?>
