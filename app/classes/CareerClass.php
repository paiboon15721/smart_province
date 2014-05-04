<?php

class CareerClass {

    public function getCareerList() {
        return Career::lists('occu_desc', 'occu_code');
    }

}
