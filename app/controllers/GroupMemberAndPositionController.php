<?php

class GroupMemberAndPositionController extends BaseController {

    protected $layout = 'layouts.tablecloth';
    private $groupMemberAndPosition;

    function __construct() {
        $this->groupMemberAndPosition = new GroupMemberAndPositionClass();
    }

    public function displayMemberDirector() {
        return View::make('content.tablecloth.groupMemberAndPosition.memberDirector')
                        ->with('title', $this->groupMemberAndPosition->getMemberDirectorTitleForDisplay())
                        ->with('headers', $this->groupMemberAndPosition->getMemberDirectorHeaderForDisplay())
                        ->with('listOfData', $this->groupMemberAndPosition->getMemberDirectorDataForDisplay());
    }

    public function displayMemberSecurity() {
        return View::make('content.tablecloth.groupMemberAndPosition.memberSecurity')
                        ->with('title', $this->groupMemberAndPosition->getMemberSecurityTitleForDisplay())
                        ->with('headers', $this->groupMemberAndPosition->getMemberSecurityHeaderForDisplay())
                        ->with('listOfData', $this->groupMemberAndPosition->getMemberSecurityDataForDisplay());
    }

    public function displayMemberDevelop() {
        return View::make('content.tablecloth.groupMemberAndPosition.memberDevelop')
                        ->with('title', $this->groupMemberAndPosition->getMemberDevelopTitleForDisplay())
                        ->with('headers', $this->groupMemberAndPosition->getMemberDevelopHeaderForDisplay())
                        ->with('listOfData', $this->groupMemberAndPosition->getMemberDevelopDataForDisplay());
    }

    public function displayMemberEconomy() {
        return View::make('content.tablecloth.groupMemberAndPosition.memberEconomy')
                        ->with('title', $this->groupMemberAndPosition->getMemberEconomyTitleForDisplay())
                        ->with('headers', $this->groupMemberAndPosition->getMemberEconomyHeaderForDisplay())
                        ->with('listOfData', $this->groupMemberAndPosition->getMemberEconomyDataForDisplay());
    }

    public function displayMemberSocial() {
        return View::make('content.tablecloth.groupMemberAndPosition.memberSocial')
                        ->with('title', $this->groupMemberAndPosition->getMemberSocialTitleForDisplay())
                        ->with('headers', $this->groupMemberAndPosition->getMemberSocialHeaderForDisplay())
                        ->with('listOfData', $this->groupMemberAndPosition->getMemberSocialDataForDisplay());
    }

    public function displayMemberCulture() {
        return View::make('content.tablecloth.groupMemberAndPosition.memberCulture')
                        ->with('title', $this->groupMemberAndPosition->getMemberCultureTitleForDisplay())
                        ->with('headers', $this->groupMemberAndPosition->getMemberCultureHeaderForDisplay())
                        ->with('listOfData', $this->groupMemberAndPosition->getMemberCultureDataForDisplay());
    }

    public function displayMemberPerform() {
        return View::make('content.tablecloth.groupMemberAndPosition.memberPerform')
                        ->with('title', $this->groupMemberAndPosition->getMemberPerformTitleForDisplay())
                        ->with('headers', $this->groupMemberAndPosition->getMemberPerformHeaderForDisplay())
                        ->with('listOfData', $this->groupMemberAndPosition->getMemberPerformDataForDisplay());
    }

}
