<?php
/**
 * Created by Kimi Tourism.
 * User: suley
 * Date: 1/7/14
 * Time: 3:14 PM
 */

class CommonHelper extends CWidget{
    public static function findActionInMenu($menus, $actionName){
        foreach($menus as &$menu){
            if(in_array(strtolower($actionName), $menu['actions']))
                $menu['active'] = true;
            else
                $menu['active'] = false;
            $menu['count'] = false;
            if($menu['is_countable']){
                switch($menu['id']){
                    default:
                        $menu['count'] = 0;
                        break;
                }
            }
        }
        return $menus;
    }

    /**
     * @param $menus
     * @param $currentAction
     * @return string
     */
    public static function makeLeftMenu($menus, $currentAction){
        if(!empty($menus) && !empty($currentAction) && is_array($menus)){
            $menus = self::findActionInMenu($menus, $currentAction);
            $menusBox = '<ul class="nav nav-pills nav-stacked">';
            foreach($menus as $menu){
                $menusBox .= '<li';
                if($menu['active'])
                    $menusBox .=  ' class="active"';
                $menusBox .= '><a href="'.$menu['link'].'">'.$menu['label'];
                if($menu['is_countable'])
                    $menusBox .=  '<span class="badge">'.$menu['count'].'</span>';
                $menusBox .=  '</a></li>';
            }
            $menusBox .= '</ul>';
            return $menusBox;
        }else{
            Yii::log('Making Left menu failed, due to empty of parameters', 'info', 'portal');
            return '';
        }

    }

} 