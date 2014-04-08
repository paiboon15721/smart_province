<?php

class Otop extends Eloquent {

    protected $table = 'tab_otop';
    public $timestamps = false;
    protected $primaryKey = 'otop_id';

    public function otopType() {
        return $this->belongsTo('OtopType', 'otop_type')->select('otop_type_id', 'otop_type_name');
    }

}
