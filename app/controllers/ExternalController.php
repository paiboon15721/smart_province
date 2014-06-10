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

    public function eReport1() {
        return Redirect::to('external_project/EReport/write_cookie.php?flg=1');
    }

    public function eReport2() {
        return Redirect::to('external_project/EReport/write_cookie.php?flg=2');
    }

    public function eReport3() {
        return $_SESSION['EMPID'];
        //return Redirect::to('external_project/EReport/write_cookie.php?flg=3');
    }

    public function eReport4() {
        return Redirect::to('external_project/EReport/write_cookie.php?flg=4');
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
        return Redirect::to("external_project/signin/signin.application?ACT_FLAG='" . asset('') . "write_session'&ACT_FLAG_CANCEL=");
    }

}
