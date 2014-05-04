<?php

class TitleClass {

    public function getTitlePrintList() {
        return Title::lists('title_print', 'title_code');
    }

}
