<?php

class HomeController extends BaseController {

    protected $layout = 'layouts.main';
    private $menuSetting;

    function __construct() {
        $this->menuSetting = new MenuSettingClass;
    }

    public function bypassLogin() {
        $empId = '3740300044869';
        $fName = 'นายนรพงษ์ หัวรักกิจ';
        $address = '194/20 ซอยนพเก้า แขวงวงศ์สว่าง เขตบางซื่อ กรุงเทพมหานคร';
        $this->write_session($empId, $fName, $address);
    }

    public function write_session($empId, $fName, $address) {
        return Redirect::to('main');
        $emp = Emp::find($empId);
        if ($emp->exists()) {

            Session::put('EMPID', $empId);
            Session::put('EMPNAME', rawurldecode($fName));
            Session::put('EMPADD', rawurldecode($address));
            Session::put('START', time());
            Session::put('EXPIRE', time() + 1800);
            Session::put('catm_login', $emp->ccaattmm);

            $_SESSION['EMPID'] = $empId;
            $_SESSION['EMPNAME'] = rawurldecode($fName);
            $_SESSION['EMPADD'] = rawurldecode($address);
            $_SESSION['START'] = time();
            $_SESSION['EXPIRE'] = $_SESSION['START'] + 1800;
            $_SESSION['catm_login'] = $emp->ccaattmm;
            return Redirect::to('main');
        } else {
            return Redirect::to('main');
        }
    }

    public function writeSession($catm) {
        $catm = Catm::select('catm_id', 'catm_name_th', 'catm_name_en')->find($catm);
        Session::put('catmId', $catm->catm_id);
        Session::put('catmNameEn', $catm->catm_name_en);
        Session::put('catmNameTh', $catm->catm_name_th);
        $_SESSION['catm_menu'] = $catm->catm_id;
        $_SESSION['catm_description'] = $catm->catm_name_th;
        return Redirect::to('main');
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
        Session::put('catmNameEn', $catmNameEn);
        return View::make('villageGeneralInformation.' . $catmNameEn);
    }

    public function villageDirectors() {
        Session::put('thisPage', 'villageDirectors');
        return View::make('content.villageDirectors');
    }

}
