<?php

/**
 *
 * 
 */
Yii::app()->setTheme('admin');
class AdminController extends Controller
{
    
    public function actionViewActivity()
    {
        var_dump($this);
        //$this->render('test');
    }
    /**
     * Item add
     */
    public function actionActivityAdd()
    {
        $item=new Item();
		print_r($_POST);

		//var_dump(empty($_FILES['file']['name'][0]));
		//print_r($_FILES);
		if(($error=$item->validateParams($_POST['ItemForm']))===TRUE)
	        var_dump($item->activityAdd($_POST));
	    else 
			echo $error;
        //
        //print_r($_POST);
    }

    public function actionActivityEdit()
    {
        $item=new Item;
		//print_r($_FILES);
	//	var_dump($_FILES['file']['error']);
		print_r($item->activityQuery($_GET['id']));
		if(isset($_GET['id']))
	        $this->render('edit', array('data'=>$item->activityQuery($_GET['id'])));
		elseif(isset($_POST['ItemForm']))
		{
			//print_r($_POST['ItemForm']);
			$item->activityUpdate($_POST);
		}
    }

    public function actionActivityList()
    {
        $item=new Item;
        
        $pages=NULL;

        $this->render('list', array(
            'items'=> $item->queryItemByLimit($pages),
            'pages'=>$pages
        ));
       
    }

}
