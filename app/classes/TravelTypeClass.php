<?php

class TravelTypeClass {

    public function getTravelTypeList() {
        return TravelType::lists('travel_type_name', 'travel_type');
    }

}
