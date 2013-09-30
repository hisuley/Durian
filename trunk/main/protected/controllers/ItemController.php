<?php

/**
 * Item controller
 *
 * @author xstudio
 * @version 1.0
 * @date 09/11/13
 */
class ItemController extends Controller
{

    /**
     *
     */
    public function actionIndex()
    {
        Yii::app()->setTheme('front');
        
        
    }
    
    /**
     * activity modify
     */
    public function actionActivityEdit()
    {
        Yii::app()->setTheme('admin');

        if(isset($_GET['id']))
        {
            $item=new Item;

    		if(isset($_GET['id']))
	            $this->render('edit', array('data'=>$item->activityQuery($_GET['id'])));
		    elseif(isset($_POST['ItemForm']))
                $item->activityUpdate($_POST);
        }

    }
    
    /**
     * activity insert
     */
    public function actionActivityAdd()
    {
        Yii::app()->setTheme('admin');

        if(!empty($_POST))
        {
            $item=new Item;

    		if(($error=$item->validateParams($_POST['ItemForm']))===TRUE)
	            var_dump($item->activityAdd($_POST));
	        else 
			    echo $error;
        }
    }

    /**
     * activity query
     */
    public function actionActivityList()
    {
        Yii::app()->setTheme('admin');

        $item=new Item;
        
        $pages=NULL;

        $this->render('list', array(
            'items'=> $item->queryItemByLimit($pages),
            'pages'=>$pages
        ));
       
    }
}
