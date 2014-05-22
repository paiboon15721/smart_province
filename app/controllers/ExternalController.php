<?php

class ExternalController extends BaseController {

    protected $layout = 'layouts.tablecloth';

    public function newsVoice() {
        return Redirect::to('external_project/news_voice/send_news.php');
    }

}
