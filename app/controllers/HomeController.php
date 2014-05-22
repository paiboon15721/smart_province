<?php

class HomeController extends BaseController {

    protected $layout = 'layouts.main';
    private $menuSetting;

    function __construct() {
        $this->menuSetting = new MenuSettingClass;
    }

    public function writeSession($catm) {
        $catm = Catm::select('catm_id', 'catm_name_th')->find($catm);
        Session::put('catmId', $catm->catm_id);
        Session::put('catmNameTh', $catm->catm_name_th);
        $_SESSION['catm_menu'] = $catm->catm_id;
        $_SESSION['catm_description'] = $catm->catm_name_th;
        return Redirect::to('villageGeneralInformation');
    }

    public function main() {
        Session::put('thisPage', 'main');
        return View::make('content.main');
    }

    public function map() {
        Session::put('thisPage', 'map');
        return View::make('content.map')
                        ->with('thisPage', 'map');
    }

    public function contactUs() {
        Session::put('thisPage', 'contactUs');
        return View::make('content.contactUs')
                        ->with('thisPage', 'contactUs');
    }

    public function villageInformationSystem() {
        Session::put('thisPage', 'villageInformationSystem');
        $this->menuSetting->setMenuId(20);
        $this->menuSetting->setMenuColour('red');
        return View::make('content.menu')
                        ->with('title', 'ระบบข้อมูลหมู่บ้าน')
                        ->with('menu', $this->menuSetting->getMenuForDisplay());
    }

    public function servicesSystem() {
        Session::put('thisPage', 'servicesSystem');
        $this->menuSetting->setMenuId(21);
        $this->menuSetting->setMenuColour('purple');
        return View::make('content.menu')
                        ->with('title', 'ระบบงานบริการด้านต่างๆ')
                        ->with('menu', $this->menuSetting->getMenuForDisplay());
    }

    public function generalSystem() {
        Session::put('thisPage', 'generalSystem');
        $this->menuSetting->setMenuId(22);
        $this->menuSetting->setMenuColour('yellow');
        return View::make('content.menu')
                        ->with('title', 'ระบบงานทั่วไป')
                        ->with('menu', $this->menuSetting->getMenuForDisplay());
    }

    public function recordingSystem() {
        Session::put('thisPage', 'recordingSystem');
        $this->menuSetting->setMenuId(23);
        $this->menuSetting->setMenuColour('green');
        return View::make('content.menu')
                        ->with('title', 'ระบบการบันทึกเพื่อการบริหาร')
                        ->with('menu', $this->menuSetting->getMenuForDisplay());
    }

    public function villageGeneralInformation() {
        Session::put('thisPage', 'villageGeneralInformation');
        $catm = new CatmClass(Session::get('catmId'));
        $catmNameEn = $catm->getCatmNameEn();
        return View::make('villageGeneralInformation.' . $catmNameEn)
                        ->with('catmNameEn', $catmNameEn);
    }

    public function villageDirectors() {
        Session::put('thisPage', 'villageDirectors');
        return View::make('content.villageDirectors');
    }

    public function test() {
        return Redirect::to('http://google.com');
    }

}
