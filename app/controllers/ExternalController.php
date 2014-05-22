<?php

class ExternalController extends BaseController {

    protected $layout = 'layouts.tablecloth';

    public function newsVoice() {
        return Redirect::to('external_project/news_voice/send_news.php');
    }

    public function newsVoiceList() {
        return Redirect::to('external_project/news_voice/news.php');
    }

    public function eReportAssign() {
        return Redirect::to('external_project/EReport/assign.php');
    }

    public function eReport($flag) {
        return Redirect::to('external_project/EReport/write_cookie.php?flg=' . $flag);
    }

    public function pollIndex() {
        return Redirect::to('external_project/poll/index.php');
    }

    public function pollMainMenu() {
        return Redirect::to('external_project/poll/mainmenu.php');
    }

    public function pollShowFinishPoll() {
        return Redirect::to('external_project/poll/showfinishPoll.php');
    }

    public function ors() {
        return Redirect::to('external_project/ors/search_pop.php');
    }

    public function nayokStat() {
        return Redirect::to('external_project/Nayok_stat/chk_stat.php');
    }

    public function login() {
        return Redirect::to("signin/signin.application?ACT_FLAG='" . $this->pathLoadPage . "/write_session'&ACT_FLAG_CANCEL=");
    }

}
