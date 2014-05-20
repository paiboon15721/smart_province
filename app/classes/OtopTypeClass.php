<?php

class OtopTypeClass {

    public function getOtopTypeList() {
        return OtopType::lists('otop_type_name', 'otop_type_id');
    }

}
