<?php

class MenuSettingController extends BaseController {

    protected $layout = 'layouts.main';
    private $menuSetting;

    function __construct() {
        $this->menuSetting = new MenuSettingClass;
    }

    public function index($menuId) {
        if ($menuId == 0) {
            return View::make('menuSetting.index')
                            ->with('renderMenuSetting', $this->menuSetting->getAllMenuForSetting());
        } else {
            $this->menuSetting->setMenuId($menuId);
            $this->menuSetting->setParentMenuIdForBack($menuId);
            return View::make('menuSetting.index')
                            ->with('renderMenuSetting', $this->menuSetting->getMenuForSetting());
        }
    }

    public function insertGet($parentMenuIdForBack, $parent) {
        $this->menuSetting->setParent($parent);
        $parentName = $this->menuSetting->getParentName();
        if ($parentName == FALSE) {
            $parentName = 'ใหญ่';
        } else {
            $parentName = 'ย่อยของ' . $parentName;
        }
        return View::make('menuSetting.insert')
                        ->with('parentMenuIdForBack', $parentMenuIdForBack)
                        ->with('parentName', $parentName)
                        ->with('parent', $parent)
                        ->with('countParent', $this->menuSetting->getCountParent());
    }

    public function insertPost($parentMenuIdForBack) {
        $this->menuSetting->setName(Input::get('name'));
        $this->menuSetting->setUrl(Input::get('url'));
        $this->menuSetting->setSortId(Input::get('sortId'));
        $this->menuSetting->setTarget(Input::get('target'));
        $this->menuSetting->setParent(Input::get('parent'));
        $v = $this->menuSetting->validate();
        if ($v->fails()) {
            return Redirect::to('menuSetting/' . $parentMenuIdForBack . '/insert/' . $this->menuSetting->getParent())
                            ->withErrors($v)
                            ->withInput();
        }
        $this->menuSetting->insertToDatabase();
        return Redirect::to('menuSetting/' . $parentMenuIdForBack . '/insert/' . $this->menuSetting->getParent())
                        ->with('insertSuccess', true);
    }

    public function updateGet($parentMenuIdForBack, $menuId) {
        $this->menuSetting->setMenuId($menuId);
        $menuSetting = $this->menuSetting->getMenuSetting();
        $this->menuSetting->setParent($menuSetting->menu_parent);
        return View::make('menuSetting.update')
                        ->with('parentMenuIdForBack', $parentMenuIdForBack)
                        ->with('menuSetting', $menuSetting)
                        ->with('countParent', $this->menuSetting->getCountParent());
    }

    public function updatePost($parentMenuIdForBack, $menuId) {
        $this->menuSetting->setMenuId($menuId);
        $this->menuSetting->setName(Input::get('name'));
        $this->menuSetting->setUrl(Input::get('url'));
        $this->menuSetting->setTarget(Input::get('target'));
        $this->menuSetting->setSortId(Input::get('sortId'));
        $v = $this->menuSetting->validate();
        if ($v->fails()) {
            return Redirect::to('menuSetting/' . $parentMenuIdForBack . '/update/' . $menuId)
                            ->withErrors($v)
                            ->withInput();
        }
        $this->menuSetting->updateToDatabase();
        return Redirect::to('menuSetting/' . $parentMenuIdForBack . '/update/' . $menuId)
                        ->with('updateSuccess', true);
    }

    public function deleteGet($parentMenuIdForBack, $menuId) {
        $this->menuSetting->setMenuId($menuId);
        if ($this->menuSetting->hasChild()) {
            return Redirect::to('menuSetting/' . $parentMenuIdForBack)
                            ->with('deleteFailed', true);
        } else {
            $this->menuSetting->deleteToDatabase($menuId);
            return Redirect::to('menuSetting/' . $parentMenuIdForBack)
                            ->with('deleteSuccess', true);
        }
    }

}
