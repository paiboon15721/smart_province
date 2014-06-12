<?php

class HomeController extends BaseController {

    protected $layout = 'layouts.main';
    private $menuSetting;
    private $imageSlideSetting;

    function __construct() {
        $this->menuSetting = new MenuSettingClass;
        $this->imageSlideSetting = new ImageSlideSettingClass();
    }

    public function logout() {
        unset($_SESSION['EMPID']);
        unset($_SESSION['EMPNAME']);
        unset($_SESSION['EMPADD']);
        unset($_SESSION['START']);
        unset($_SESSION['EXPIRE']);
        unset($_SESSION['catm_login']);
        return Redirect::to('main');
    }

    public function bypassLogin() {
        $empId = '3740300044869';
        $fName = 'นายนรพงษ์ หัวรักกิจ';
        $address = '194/20 ซอยนพเก้า แขวงวงศ์สว่าง เขตบางซื่อ กรุงเทพมหานคร';
        $writeSuccess = $this->write_session($empId, $fName, $address);
        if ($writeSuccess) {
            return Redirect::to('main');
        } else {
            return Redirect::to('main')
                            ->with('loginError', true);
        }
    }

    public function write_session($empId, $fName, $address) {
        $emp = Emp::find($empId);
        if ($emp->exists()) {
            $_SESSION['EMPID'] = $empId;
            $_SESSION['EMPNAME'] = rawurldecode($fName);
            $_SESSION['EMPADD'] = rawurldecode($address);
            $_SESSION['START'] = time();
            $_SESSION['EXPIRE'] = $_SESSION['START'] + 1800;
            $_SESSION['catm_login'] = $emp->ccaattmm;
            return true;
        } else {
            return false;
        }
    }

    public function writeSession($catm) {
        $catm = Catm::select('catm_id', 'catm_name_th', 'catm_name_en')->find($catm);
        Session::put('catmNameEn', $catm->catm_name_en);
        $_SESSION['catm_menu'] = $catm->catm_id;
        $_SESSION['catm_description'] = $catm->catm_name_th;
        return Redirect::to('main');
    }

    public function main() {
        Session::put('thisPage', 'main');
        return View::make('content.main')
                        ->with('listOfData', $this->imageSlideSetting->getImageSlideSettingDataForDisplay());
    }

    public function map() {
        Session::put('thisPage', 'map');
        return View::make('content.map')
                        ->with('thisPage', 'map')
                        ->with('listOfData', $this->imageSlideSetting->getImageSlideSettingDataForDisplay());
    }

    public function contactUs() {
        Session::put('thisPage', 'contactUs');
        return View::make('content.contactUs')
                        ->with('thisPage', 'contactUs')
                        ->with('listOfData', $this->imageSlideSetting->getImageSlideSettingDataForDisplay());
    }

    public function villageInformationSystem() {
        Session::put('thisPage', 'villageInformationSystem');
        $this->menuSetting->setMenuId(20);
        $this->menuSetting->setMenuColour('red');
        return View::make('content.menu')
                        ->with('title', 'ระบบข้อมูลหมู่บ้าน')
                        ->with('menu', $this->menuSetting->getMenuForDisplay())
                        ->with('listOfData', $this->imageSlideSetting->getImageSlideSettingDataForDisplay());
    }

    public function servicesSystem() {
        Session::put('thisPage', 'servicesSystem');
        $this->menuSetting->setMenuId(21);
        $this->menuSetting->setMenuColour('purple');
        return View::make('content.menu')
                        ->with('title', 'ระบบงานบริการด้านต่างๆ')
                        ->with('menu', $this->menuSetting->getMenuForDisplay())
                        ->with('listOfData', $this->imageSlideSetting->getImageSlideSettingDataForDisplay());
    }

    public function generalSystem() {
        Session::put('thisPage', 'generalSystem');
        $this->menuSetting->setMenuId(22);
        $this->menuSetting->setMenuColour('yellow');
        return View::make('content.menu')
                        ->with('title', 'ระบบงานทั่วไป')
                        ->with('menu', $this->menuSetting->getMenuForDisplay())
                        ->with('listOfData', $this->imageSlideSetting->getImageSlideSettingDataForDisplay());
    }

    public function recordingSystem() {
        Session::put('thisPage', 'recordingSystem');
        $this->menuSetting->setMenuId(23);
        $this->menuSetting->setMenuColour('green');
        return View::make('content.menu')
                        ->with('title', 'ระบบการบันทึกเพื่อการบริหาร')
                        ->with('menu', $this->menuSetting->getMenuForDisplay())
                        ->with('listOfData', $this->imageSlideSetting->getImageSlideSettingDataForDisplay());
    }

    public function villageGeneralInformation() {
        Session::put('thisPage', 'villageGeneralInformation');
        $catm = new CatmClass($_SESSION['catm_menu']);
        $catmNameEn = $catm->getCatmNameEn();
        Session::put('catmNameEn', $catmNameEn);
        return View::make('villageGeneralInformation.' . $catmNameEn)
                        ->with('listOfData', $this->imageSlideSetting->getImageSlideSettingDataForDisplay());
    }

    public function villageDirectors() {
        Session::put('thisPage', 'villageDirectors');
        return View::make('content.villageDirectors')
                        ->with('listOfData', $this->imageSlideSetting->getImageSlideSettingDataForDisplay());
    }

}
