<?php

class OtopType extends Eloquent {

    protected $table = 'tab_otop_type';
    public $timestamps = false;
    protected $primaryKey = 'otop_type_id';

    public function otop() {
        return $this->hasMany('Otop', 'otop_type_id');
    }

}
