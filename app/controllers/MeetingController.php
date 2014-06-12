<?php

class MeetingController extends BaseController {

    protected $layout = 'layouts.tablecloth';
    private $meeting;

    function __construct() {
        $this->meeting = new MeetingClass();
    }

    public function displayTravel() {
        return View::make('content.tablecloth.travel.travel')
                        ->with('title', $this->travel->getTravelTitleForDisplay())
                        ->with('headers', $this->travel->getTravelHeaderForDisplay())
                        ->with('listOfData', $this->travel->getTravelDataForDisplay());
    }

    public function insertGet() {
        return View::make('meeting.insert')
                        ->with('actionType', 'บันทึก')
                        ->with('menuName', $this->meeting->getMenuNameForDisplay())
                        ->with('backUrl', URL::to('meetingTable'));
    }

    public function insertPost() {
        $this->meeting->setMeetingName(Input::get('meetingName'));
        $this->meeting->setMeetingDate(Input::get('meetingDate'));
        $this->meeting->setMeetingImage(Input::file('meetingImage'));
        $v = $this->meeting->validate();
        if ($v->fails()) {
            return Redirect::to('meetingTable/insert')
                            ->withErrors($v)
                            ->withInput();
        }
        $this->meeting->insertToDatabase();
        return Redirect::to('meetingTable/insert')
                        ->with('insertSuccess', true);
    }

    public function updateGet($meetingId) {
        $this->meeting->setMeetingId($meetingId);
        $meeting = $this->meeting->getMeeting();
        return View::make('meeting.update')
                        ->with('actionType', 'แก้ไข')
                        ->with('menuName', $this->meeting->getMenuNameForDisplay())
                        ->with('meeting', $meeting)
                        ->with('backUrl', URL::to('meetingTable'));
    }

    public function updatePost($meetingId) {
        $this->meeting->setMeetingId($meetingId);
        $this->meeting->setMeetingName(Input::get('meetingName'));
        $this->meeting->setMeetingDate(Input::get('meetingDate'));
        $this->meeting->setMeetingImage(Input::file('meetingImage'));
        $v = $this->meeting->validate();
        if ($v->fails()) {
            return Redirect::to('meetingTable/update/' . $meetingId)
                            ->withErrors($v)
                            ->withInput();
        }
        $this->meeting->updateToDatabase();
        return Redirect::to('meetingTable/update/' . $meetingId)
                        ->with('updateSuccess', true);
    }

    public function deleteGet($meetingId) {
        $this->meeting->setMeetingId($meetingId);
        $this->meeting->deleteToDatabase();
        return Redirect::to('meetingTable')
                        ->with('deleteSuccess', true);
    }

    public function displayDatatable() {
        return View::make('meeting.index')
                        ->with('datasourceUrl', URL::to('datasourceMeeting'))
                        ->with('menuName', $this->meeting->getMenuNameForDisplay())
                        ->with('url', 'meetingTable');
    }

}
