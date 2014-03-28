<?php

/**
 * Since Ver 0.1
 * 
 * Replace images with thumbnails and create a link to the actual image.
 */

Yii::import('application.extensions.phpQuery.phpQuery');

class Thumbnailer extends CWidget
{
	public $thumbsDir;
	public $thumbWidth;
	public $thumbHeight;
	
	public function init()
	{
		// Trim trailing slashes if exists
		$this->thumbsDir = rtrim($this->thumbsDir, '/');
		
		ob_start();
	}
	
	public function run()
	{
		$content = ob_get_clean();
		
		$formatted = phpQuery::newDocument($content);
		$imageNodes = pq('img');
		
		foreach ($imageNodes as $imNode)
		{
			$imNode = pq($imNode);
			$imPath = $imNode->attr('src');
			
			$thumbPath = $this->thumbsDir.'/'.basename($imPath);
			$thumbPath2 = dirname($imPath).'/thumbs/'.basename($imPath);
			
			// Create thumbnail if not exists
			if (!file_exists($thumbPath))
			{
				$imgObj = Yii::app()->simpleImage->load($imPath);
				
				if (!isset($this->thumbHeight))
				{
					$imgObj->resizeToWidth($this->thumbWidth);
				}
				else
				{
					$imgObj->resize($this->thumbWidth, $this->thumbHeight);
				}
				
				$imgObj->save($thumbPath);
			}
			
			$imNode->wrap('<a href="'.Yii::app()->request->baseUrl."/".$imPath.'" rel="gallery"></a>');
			$imNode->attr('src', Yii::app()->request->baseUrl."/".$thumbPath2);
		}
		
		echo $formatted;
	}
}
