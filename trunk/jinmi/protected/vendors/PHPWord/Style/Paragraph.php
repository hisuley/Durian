<?php
/**
 * PHPWord
 *
 * Copyright (c) 2011 PHPWord
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPWord
 * @package    PHPWord
 * @copyright  Copyright (c) 010 PHPWord
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    Beta 0.6.3, 08.07.2011
 */


/**
 * PHPWord_Style_Paragraph
 *
 * @category   PHPWord
 * @package    PHPWord_Style
 * @copyright  Copyright (c) 2011 PHPWord
 */
class PHPWord_Style_Paragraph {
	
	/**
	 * Paragraph alignment
	 * 
	 * @var string
	 */
	private $_align;
	
	/**
	 * Space before Paragraph
	 * 
	 * @var int
	 */
	private $_spaceBefore;
	
	/**
	 * Space after Paragraph
	 * 
	 * @var int
	 */
	private $_spaceAfter;
	
	/**
	 * Spacing between breaks
	 * 
	 * @var int
	 */
	private $_spacing;
	
	//2012-07-17 WL 添加文本缩进  参照 http://blog.csdn.net/yukirin_fans/article/details/7358382  
    /** 
     * 缩进 indentleft and indentright段落缩进值,单位为twips 
     *   
     * 缩进indentFirstLine and indentFirstChars  首行缩进twips数和字符数 
     *   
     * @var int           
     */ 
	private $_indentLeft;
	private $_indentRight;
	private $_indentFirstLine;
	private $_indentFirstLineChars; 
	// 缩进结束
	
	
	
	//添加段落样式属性 WL 2012-08-09
    /**
     * Background Shading for paragraphs
     *
     * @var string
     */
    private $_bgColor;
    
    /**
     * Border Top Size
     *
     * @var int
     */
    private $_borderTopSize;
    
    /**
     * Border Top Color
     *
     * @var string
     */
    private $_borderTopColor;
    
    /**
     * Border Left Size
     *
     * @var int
     */
    private $_borderLeftSize;
    
    /**
     * Border Left Color
     *
     * @var string
     */
    private $_borderLeftColor;
    
    /**
     * Border Right Size
     *
     * @var int
     */
    private $_borderRightSize;
    
    /**
     * Border Right Color
     *
     * @var string
     */
    private $_borderRightColor;
    
    /**
     * Border Bottom Size
     *
     * @var int
     */
    private $_borderBottomSize;
    
    /**
     * Border Bottom Color
     *
     * @var string
     */
    private $_borderBottomColor;
    
    /**
     * Border Default Color
     *
     * @var string
     */
    private $_defaultBorderColor;
	//添加结束
	
	
	
	/**
	 * New Paragraph Style
	 */
	public function __construct() {
		$this->_align                = null;
		$this->_spaceBefore          = null;
		$this->_spaceAfter           = null;
		$this->_spacing              = null;
		$this->_bgColor              = null;
		
		$this->_indentLeft           = null;
		$this->_indentRight          = null;
		$this->_identFirstLine       = null;
		$this->_indentFirstLineChars = null;
	}
	
	/**
	 * Set Style value
	 * 
	 * @param string $key
	 * @param mixed $value
	 */
	public function setStyleValue($key, $value) {
		if($key == '_spacing') {
			$value += 240; // because line height of 1 matches 240 twips
		}
		$this->$key = $value;
	}

	/**
	 * Get Paragraph Alignment
	 * 
	 * @return string
	 */
	public function getAlign() {
		return $this->_align;
	}

	/**
	 * Set Paragraph Alignment
	 * 
	 * @param string $pValue
	 * @return PHPWord_Style_Paragraph
	 */
	public function setAlign($pValue = null) {
		if(strtolower($pValue) == 'justify') {
			// justify becames both
			$pValue = 'both';
		}
		$this->_align = $pValue;
		return $this;
	}

	/**
	 * Get Space before Paragraph
	 * 
	 * @return string
	 */
	public function getSpaceBefore() {
		return $this->_spaceBefore;
	}

	/**
	 * Set Space before Paragraph
	 * 
	 * @param int $pValue
	 * @return PHPWord_Style_Paragraph
	 */
	public function setSpaceBefore($pValue = null) {
	   $this->_spaceBefore = $pValue;
	   return $this;
	}

	/**
	 * Get Space after Paragraph
	 * 
	 * @return string
	 */
	public function getSpaceAfter() {
		return $this->_spaceAfter;
	}

	/**
	 * Set Space after Paragraph
	 * 
	 * @param int $pValue
	 * @return PHPWord_Style_Paragraph
	 */
	public function setSpaceAfter($pValue = null) {
	   $this->_spaceAfter = $pValue;
	   return $this;
	}

	/**
	 * Get Spacing between breaks
	 * 
	 * @return int
	 */
	public function getSpacing() {
		return $this->_spacing;
	}

	/**
	 * Set Spacing between breaks
	 * 
	 * @param int $pValue
	 * @return PHPWord_Style_Paragraph
	 */
	public function setSpacing($pValue = null) {
	   $this->_spacing = $pValue;
	   return $this;
	}

	//获取左缩进值
	public function getIndentLeft() {
	   return $this->_indentLeft;
	}
	
	//设置左缩进值
	 public function setIndentLeft($pValue = null) {
	    $this->_indentLeft = $pValue;
		return $this;
	}
	
	//获取右缩进值
	public function getIndentRight() {
	    return $this->_indentRight;
	}
	
	//设置右缩进值
	public function setIndentRight($pValue = null) {
	    $this->_indentRight = $pValue;
		return $this;
	}
	
	//首行缩进值相关方法
	 public function setIndentFirstLine($pValue = null) {
	     $this->_indentFirstLine = $pValue;
		 return $this;
	}
	
	public function getIndentFirstLine()  {
	    return $this->_indentFirstLine;
	}
	
	 public function setIndentFirstLineChars($pValue = null) {
	    $this->_indentFirstLineChars = $pValue; 
		return $this;
	}
	
	public function getIndentFirstLineChars() {
	    return $this->_indentFirstLineChars;
	}
	
	
	//添加段落属性获取和设置的方法
	
   /**
     * Get the background color of the paragraph
     *
     * @return string
     */
    public function getBgColor ()
    {
        return $this->_bgColor;
    }

    /**
     * Set the paragraph's background color
     *
     * @param string $pValue            
     * @return PHPWord_Style_Paragraph
     */
    public function setBgColor ($pValue = null)
    {
        $this->_bgColor = $pValue;
        return $this;
    }

    public function setBorderSize ($pValue = null)
    {
        $this->_borderTopSize = $pValue;
        $this->_borderLeftSize = $pValue;
        $this->_borderRightSize = $pValue;
        $this->_borderBottomSize = $pValue;
    }

    public function getBorderSize ()
    {
        $t = $this->getBorderTopSize();
        $l = $this->getBorderLeftSize();
        $r = $this->getBorderRightSize();
        $b = $this->getBorderBottomSize();
        
        return array (
            $t, 
            $l, 
            $r, 
            $b 
        );
    }

    public function setBorderColor ($pValue = null)
    {
        $this->_borderTopColor = $pValue;
        $this->_borderLeftColor = $pValue;
        $this->_borderRightColor = $pValue;
        $this->_borderBottomColor = $pValue;
    }

    public function getBorderColor ()
    {
        $t = $this->getBorderTopColor();
        $l = $this->getBorderLeftColor();
        $r = $this->getBorderRightColor();
        $b = $this->getBorderBottomColor();
        
        return array (
            $t, 
            $l, 
            $r, 
            $b 
        );
    }

    public function setBorderTopSize ($pValue = null)
    {
        $this->_borderTopSize = $pValue;
    }

    public function getBorderTopSize ()
    {
        return $this->_borderTopSize;
    }

    public function setBorderTopColor ($pValue = null)
    {
        $this->_borderTopColor = $pValue;
    }

    public function getBorderTopColor ()
    {
        return $this->_borderTopColor;
    }

    public function setBorderLeftSize ($pValue = null)
    {
        $this->_borderLeftSize = $pValue;
    }

    public function getBorderLeftSize ()
    {
        return $this->_borderLeftSize;
    }

    public function setBorderLeftColor ($pValue = null)
    {
        $this->_borderLeftColor = $pValue;
    }

    public function getBorderLeftColor ()
    {
        return $this->_borderLeftColor;
    }

    public function setBorderRightSize ($pValue = null)
    {
        $this->_borderRightSize = $pValue;
    }

    public function getBorderRightSize ()
    {
        return $this->_borderRightSize;
    }

    public function setBorderRightColor ($pValue = null)
    {
        $this->_borderRightColor = $pValue;
    }

    public function getBorderRightColor ()
    {
        return $this->_borderRightColor;
    }

    public function setBorderBottomSize ($pValue = null)
    {
        $this->_borderBottomSize = $pValue;
    }

    public function getBorderBottomSize ()
    {
        return $this->_borderBottomSize;
    }

    public function setBorderBottomColor ($pValue = null)
    {
        $this->_borderBottomColor = $pValue;
    }

    public function getBorderBottomColor ()
    {
        return $this->_borderBottomColor;
    }

    public function getDefaultBorderColor ()
    {
        return $this->_defaultBorderColor;
    }
	
	//添加结束
}
?>