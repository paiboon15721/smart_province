<?php

class MenuSettingClass {

    private $menuSettingForRender;
    private $menuColour = 'red';
    private $menuId;
    private $name;
    private $url;
    private $sortId;
    private $target;
    private $parent;
    private $parentMenuIdForBack;
    private $rules = array(
        'name' => 'required',
        'sortId' => 'required'
    );

    public function validate() {
        $validationData = array(
            'name' => $this->name,
            'sortId' => $this->sortId
        );
        return Validator::make($validationData, $this->rules);
    }

    public function setParentMenuIdForBack($value) {
        $this->parentMenuIdForBack = $value;
    }

    public function getParentForBack() {
        return $this->parentMenuIdForBack;
    }

    public function setMenuColour($value) {
        $this->menuColour = $value;
    }

    public function getMenuSetting() {
        return MenuSetting::find($this->menuId);
    }

    public function setMenuId($value) {
        $this->menuId = $value;
    }

    public function getMenuId() {
        return $this->menuId;
    }

    public function setTarget($value) {
        $this->target = $value;
    }

    public function getTarget() {
        return $this->target;
    }

    public function setParent($value) {
        $this->parent = $value;
    }

    public function getParent() {
        return $this->parent;
    }

    public function setName($value) {
        $this->name = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function setUrl($value) {
        $this->url = $value;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setSortId($value) {
        $this->sortId = $value;
    }

    public function getSortId() {
        return $this->sortId;
    }

    public function getCountParent() {
        $countParent = MenuSetting::select('menu_id')->where('menu_parent', '=', $this->parent)->count();
        return $countParent;
    }

    public function getParentName() {
        $parentName = MenuSetting::select('menu_name_th')->where('menu_id', '=', $this->parent)->get();
        $countParent = count($parentName);
        if ($countParent == 0) {
            return FALSE;
        }
        return $parentName[0]->menu_name_th;
    }

    public function getAllMenuForSetting($parentValue = 0, $menuSize = 7) {
        $menuSize--;
        $child = MenuSetting::select('menu_id', 'menu_name_th')
                ->where('menu_parent', '=', $parentValue)
                ->orderBy('menu_sort_id', 'asc')
                ->get();
        $countChild = count($child);
        if ($countChild > 0) {
            //ปุ่มเพิ่มเมนูในระดับเดียวกัน
            $this->menuSettingForRender .= '<ol><a href=' . url('menuSetting/0/insert/' . $parentValue) . '><img src=' . asset('images/main/add_icon.gif') . ' /> เพิ่มเมนูในระดับเดียวกัน</a>';
            foreach ($child as $childValues) {
                $this->menuSettingForRender .= '<li><font size=' . $menuSize . '>' . $childValues->menu_name_th . '</font> ';
                //ปุ่มแก้ไข
                $this->menuSettingForRender .= '<a href=' . url('menuSetting/0/update/' . $childValues->menu_id) . '><img src=' . asset('images/main/add_icon.gif') . ' /> แก้ไข</a> ';
                //ปุ่มลบ
                $this->menuSettingForRender .= '<a href=' . url('menuSetting/0/delete/' . $childValues->menu_id) . '><img src=' . asset('images/main/add_icon.gif') . ' /> ลบ</a>';
                $this->getAllMenuForSetting($childValues->menu_id, $menuSize);
                $this->menuSettingForRender .= '</li>';
            }
            $this->menuSettingForRender .= '</ol>';
        } else {
            //ปุ่มเพิ่มเมนูย่อย
            $this->menuSettingForRender .= "<br /><a href=" . url('menuSetting/0/insert/' . $parentValue) . "><img src=" . asset('images/main/add_icon.gif') . " /> เพิ่มเมนูย่อย</a>";
        }
        return $this->menuSettingForRender;
    }

    public function getMenuForSetting($onFristTime = TRUE, $menuSize = 6) {
        $menuSize--;
        if ($onFristTime) {
            $parentName = $this->getMenuSetting()->menu_name_th;
            $this->menuSettingForRender .= "<font size='6'>" . $parentName . "</font>";
        }
        $child = MenuSetting::select('menu_id', 'menu_name_th')
                ->where('menu_parent', '=', $this->menuId)
                ->orderBy('menu_sort_id', 'asc')
                ->get();
        $countChild = count($child);
        if ($countChild > 0) {
            //ปุ่มเพิ่มเมนูในระดับเดียวกัน
            $this->menuSettingForRender .= '<ol><a href=' . url('menuSetting/' . $this->parentMenuIdForBack . '/insert/' . $this->menuId) . '><img src=' . asset('images/main/add_icon.gif') . ' /> เพิ่มเมนูในระดับเดียวกัน</a>';
            foreach ($child as $childValues) {
                $this->menuId = $childValues->menu_id;
                $this->menuSettingForRender .= '<li><font size=' . $menuSize . '>' . $childValues->menu_name_th . '</font> ';
                //ปุ่มแก้ไข
                $this->menuSettingForRender .= '<a href=' . url('menuSetting/' . $this->parentMenuIdForBack . '/update/' . $childValues->menu_id) . '><img src=' . asset('images/main/add_icon.gif') . ' /> แก้ไข</a> ';
                //ปุ่มลบ
                $this->menuSettingForRender .= '<a href=' . url('menuSetting/' . $this->parentMenuIdForBack . '/delete/' . $childValues->menu_id) . " onclick=\"return confirm('ยืนยันการลบข้อมูล?')\" ><img src=" . asset('images/main/add_icon.gif') . ' /> ลบ</a>';
                $this->getMenuForSetting(FALSE, $menuSize);
                $this->menuSettingForRender .= '</li>';
            }
            $this->menuSettingForRender .= '</ol>';
        } else {
            //ปุ่มเพิ่มเมนูย่อย
            $this->menuSettingForRender .= "<br /><a href=" . url('menuSetting/' . $this->parentMenuIdForBack . '/insert/' . $this->menuId) . "><img src=" . asset('images/main/add_icon.gif') . " /> เพิ่มเมนูย่อย</a>";
        }
        return $this->menuSettingForRender;
    }

    public function getMenuForDisplay($onFristTime = TRUE, $onParentMenu = TRUE) {
        if ($onFristTime) {
            $parentName = $this->getMenuSetting()->menu_name_th;
            $this->menuSettingForRender .= "<h1 class='title' style='border-bottom: 1px solid #3B3B3B; padding-bottom: 10px'>" . $parentName . "</h1>";
            $this->menuSettingForRender .= "<div id='" . $this->menuColour . '_menu' . "' class='container'>";
        }
        $child = MenuSetting::select('menu_id', 'menu_name_th', 'menu_url', 'menu_target')
                ->where('menu_parent', '=', $this->menuId)
                ->orderBy('menu_sort_id', 'asc')
                ->get();
        $countChild = count($child);
        if ($countChild > 0) {
            if (!$onParentMenu) {
                $this->menuSettingForRender .= "<ol>";
            }
            foreach ($child as $childValues) {
                $this->menuId = $childValues->menu_id;
                if ($onParentMenu) {
                    $this->menuSettingForRender .= "<h2 class='" . 'acc_' . $this->menuColour . "'><a href='#'>" . $childValues->menu_name_th . "</a></h2>";
                    $this->menuSettingForRender .= "<div class='acc_container'>";
                } else {
                    if ($childValues->menu_url == '') {
                        $this->menuSettingForRender .= "<li>" . $childValues->menu_name_th;
                    } else {
                        if ($childValues->menu_target == 0) {
                            $attributesList = array('target' => '_blank');
                        } else {
                            $attributesList = array('class' => 'fancybox fancybox.iframe');
                        }
                        $this->menuSettingForRender .= '<li>' . HTML::link($childValues->menu_url, $childValues->menu_name_th, $attributes = $attributesList) . '</li>';
                    }
                }
                $this->getMenuForDisplay(FALSE, FALSE);
                if ($onParentMenu) {
                    $this->menuSettingForRender .= '</div>';
                } else {
                    $this->menuSettingForRender .= "</li>";
                }
            }
            if (!$onParentMenu) {
                $this->menuSettingForRender .= "</ol>";
            } else {
                $this->menuSettingForRender .= '</div>';
            }
        }
        return $this->menuSettingForRender;
    }

    public function insertToDatabase() {
        DB::update('UPDATE tab_menu_setting SET menu_sort_id = menu_sort_id + 1 WHERE menu_sort_id >= ? AND menu_parent = ?', array($this->sortId, $this->parent));
        $menuSetting = new MenuSetting;
        $menuSetting->menu_name_th = $this->name;
        $menuSetting->menu_sort_id = $this->sortId;
        $menuSetting->menu_url = $this->url;
        $menuSetting->menu_target = $this->target;
        $menuSetting->menu_parent = $this->parent;
        $menuSetting->save();
    }

    public function updateToDatabase() {
        $menuSetting = MenuSetting::find($this->menuId);
        $currentSortId = $menuSetting->menu_sort_id;
        $newSortId = $this->sortId;
        if ($currentSortId < $newSortId) {
            DB::update('UPDATE tab_menu_setting SET menu_sort_id = menu_sort_id - 1 WHERE menu_sort_id >= ? AND menu_sort_id <= ? AND menu_parent = ?', array($currentSortId, $newSortId, $menuSetting->menu_parent));
        } else if ($currentSortId > $newSortId) {
            DB::update('UPDATE tab_menu_setting SET menu_sort_id = menu_sort_id + 1 WHERE menu_sort_id >= ? AND menu_sort_id <= ? AND menu_parent = ?', array($newSortId, $currentSortId, $menuSetting->menu_parent));
        }
        $menuSetting->menu_name_th = $this->name;
        $menuSetting->menu_sort_id = $this->sortId;
        $menuSetting->menu_url = $this->url;
        $menuSetting->menu_target = $this->target;
        $menuSetting->save();
    }

    public function deleteToDatabase() {
        $menuSetting = MenuSetting::find($this->menuId);
        DB::update('UPDATE tab_menu_setting SET menu_sort_id = menu_sort_id - 1 WHERE menu_sort_id >= ? AND menu_parent = ?', array($menuSetting->menu_sort_id, $menuSetting->menu_parent));
        $menuSetting->delete();
    }

    public function hasChild() {
        $countChild = MenuSetting::select('menu_id')->where('menu_parent', '=', $this->menuId)->count();
        if ($countChild > 0) {
            return true;
        } else {
            return false;
        }
    }

}
