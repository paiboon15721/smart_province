<?php

class ImageSlideSettingController extends BaseController {

    protected $layout = 'imageSlideSetting.index';
    private $imageSlideSetting;

    function __construct() {
        $this->imageSlideSetting = new ImageSlideSettingClass();
    }

    public function insertGet() {
        return View::make('imageSlideSetting.insert')
                        ->with('actionType', 'บันทึก')
                        ->with('menuName', $this->imageSlideSetting->getMenuNameForDisplay())
                        ->with('backUrl', URL::to('imageSlideSettingTable'));
    }

    public function insertPost() {
        $this->imageSlideSetting->setImageSlideImage(Input::file('imageSlideImage'));
        $v = $this->imageSlideSetting->validate();
        if ($v->fails()) {
            return Redirect::to('imageSlideSettingTable/insert')
                            ->withErrors($v)
                            ->withInput();
        }
        $this->imageSlideSetting->insertToDatabase();
        return Redirect::to('imageSlideSettingTable/insert')
                        ->with('insertSuccess', true);
    }

    public function updateGet($imageSlideId) {
        $this->imageSlideSetting->setImageSlideId($imageSlideId);
        $imageSlideSetting = $this->imageSlideSetting->getImageSlideSetting();
        return View::make('imageSlideSetting.update')
                        ->with('actionType', 'แก้ไข')
                        ->with('menuName', $this->imageSlideSetting->getMenuNameForDisplay())
                        ->with('imageSlideSetting', $imageSlideSetting)
                        ->with('backUrl', URL::to('imageSlideSettingTable'));
    }

    public function updatePost($imageSlideId) {
        $this->imageSlideSetting->setImageSlideId($imageSlideId);
        $this->imageSlideSetting->setImageSlideImage(Input::file('imageSlideImage'));
        $v = $this->imageSlideSetting->validate();
        if ($v->fails()) {
            return Redirect::to('imageSlideSettingTable/update/' . $imageSlideId)
                            ->withErrors($v)
                            ->withInput();
        }
        $this->imageSlideSetting->updateToDatabase();
        return Redirect::to('imageSlideSettingTable/update/' . $imageSlideId)
                        ->with('updateSuccess', true);
    }

    public function deleteGet($imageSlideId) {
        $this->imageSlideSetting->setImageSlideId($imageSlideId);
        $this->imageSlideSetting->deleteToDatabase();
        return Redirect::to('imageSlideSettingTable')
                        ->with('deleteSuccess', true);
    }

    public function displayTablecloth() {
        return View::make('imageSlideSetting.index')
                        ->with('listOfData', $this->imageSlideSetting->getImageSlideSettingDataForDisplay())
                        ->with('menuName', $this->imageSlideSetting->getMenuNameForDisplay())
                        ->with('url', 'imageSlideSettingTable');
    }

}
