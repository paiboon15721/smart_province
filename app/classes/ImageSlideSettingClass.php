<?php

class ImageSlideSettingClass {

    private $imageSlideId;
    private $imageSlideImage;
    private $rules = array(
        'imageSlideImage' => 'required'
    );

    public function validate() {
        $validationData = array(
            'imageSlideImage' => $this->imageSlideImage
        );
        return Validator::make($validationData, $this->rules);
    }

    public function setImageSlideId($value) {
        $this->imageSlideId = $value;
    }

    public function setImageSlideImage($value) {
        $this->imageSlideImage = $value;
    }

    private $fieldForDisplay = array();
    private static $MENU_ID = 262;
    private static $IMAGE_SLIDE_SETTING_FIELD = array('image_id', 'image');

    private function getDataForDisplay() {
        return ImageSlideSetting::select($this->fieldForDisplay)
                        ->where('catm', '=', $_SESSION['catm_menu'])
                        ->get();
    }

    public function getImageSlideSettingDataForDisplay() {
        $this->fieldForDisplay = self::$IMAGE_SLIDE_SETTING_FIELD;
        return $this->getDataForDisplay();
    }

    public function getMenuNameForDisplay() {
        $menuName = MenuSetting::select('menu_name_th')
                ->where('menu_id', '=', self::$MENU_ID)
                ->first();
        return str_replace('ระบบ', '', $menuName['menu_name_th']);
    }

    public function getImageSlideSetting() {
        return ImageSlideSetting::find($this->imageSlideId);
    }

    public function insertToDatabase() {
        $imageSlideSetting = new ImageSlideSetting;
        $imageSlideSetting->catm = $_SESSION['catm_menu'];
        if (input::hasFile('imageSlideImage')) {
            $file = Input::file('imageSlideImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->imageSlideImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $file->move(public_path() . '/data', $this->imageSlideImage);
        }
        $imageSlideSetting->image = $this->imageSlideImage;
        $imageSlideSetting->save();
    }

    public function updateToDatabase() {
        $imageSlideSetting = ImageSlideSetting::find($this->imageSlideId);
        if (input::hasFile('imageSlideImage')) {
            $oldImageName = $imageSlideSetting->image;
            $file = Input::file('imageSlideImage');
            $ext = $file->guessClientExtension();
            $filename = $file->getClientOriginalName();
            $this->imageSlideImage = md5(date('YmdHis') . $filename) . '.' . $ext;
            $file->move(public_path() . '/data', $this->imageSlideImage);
            if (is_file(public_path() . '/data/' . $oldImageName)) {
                unlink(public_path() . '/data/' . $oldImageName);
            }
            $imageSlideSetting->image = $this->imageSlideImage;
        }
        $imageSlideSetting->save();
    }

    public function deleteToDatabase() {
        $imageSlideSetting = ImageSlideSetting::find($this->imageSlideId);
        if (is_file(public_path() . '/data/' . $imageSlideSetting->image)) {
            unlink(public_path() . '/data/' . $imageSlideSetting->image);
        }
        $imageSlideSetting->delete();
    }

}
