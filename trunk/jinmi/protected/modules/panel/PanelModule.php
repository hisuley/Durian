<?php
class PanelModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'panel.models.*',
			'panel.components.*',
			'application.extensions.EAjaxUpload.*',
		));

		//$this->layoutPath = Yii::getPathofAlias('webroot.themes.panel_bootstrap.views.layouts');
        if(!Yii::app()->user->isGuest && Yii::app()->user->role == 'finance'){
            $this->layout = 'main';
        }else{
            $this->layout = 'main';
        }

	}

	public function beforeControllerAction($controller, $action)
	{

		if(parent::beforeControllerAction($controller, $action))
		{
            if($controller->id == 'yutong' || $controller->id == 'orderSource' || $controller->id == 'agency' || $controller->id == 'address' || $controller->id == 'finance'){
                $this->layoutPath = Yii::getPathofAlias('webroot.themes.panel_bootstrap.views.layouts');
                Yii::app()->theme = 'panel_bootstrap';
            }
            if(!Yii::app()->user->isGuest && Yii::app()->user->role == 'finance'){
                $this->layoutPath = Yii::getPathofAlias('webroot.themes.panel_bootstrap.views.layouts');
                Yii::app()->theme = 'panel_bootstrap';
                $this->layout = 'finance';
            }elseif(!Yii::app()->user->isGuest && Yii::app()->user->role == 'purchase'){
                $this->layoutPath = Yii::getPathofAlias('webroot.themes.panel_bootstrap.views.layouts');
                Yii::app()->theme = 'panel_bootstrap';
                $this->layout = 'purchase';
            }
            if($controller->id != 'login'){
                $this->layoutPath = Yii::getPathofAlias('webroot.themes.panel_bootstrap.views.layouts');
                Yii::app()->theme = 'panel_bootstrap';
            }

			// this method is called before any module controller action is performed
			// you may place customized code here
            Yii::app()->errorHandler->errorAction = 'panel/default/error';
			return true;
		}
		else
			return false;
	}
}
