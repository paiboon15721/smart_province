<?php

class CatmClass {
    private $catmId;
    private $catmNameEn;
    private $catmNameTh;
    
    public function __construct($catmId) {
        $catm = Catm::select('catm_name_en', 'catm_name_th')->find($catmId);
        $this->catmId = $catmId;
        $this->catmNameEn = $catm->catm_name_en;
        $this->catmNameTh = $catm->catm_name_th;
    }
    
    public function getCatmId() {
        return $this->catmId;
    }
    
    public function getCatmNameEn() {
        return $this->catmNameEn;
    }
    
    public function getCatmNameTh() {
        return $this->catmNameTh;
    }
}
