<?php

class GroupMemberController extends BaseController {

    //protected $layout = 'layouts.tablecloth';
    private $groupMember;
    private $title;
    private $career;
    private $groups;
    private $groupPosition;

    function __construct() {
        $this->groupMember = new GroupMemberClass();
        $this->title = new TitleClass();
        $this->career = new CareerClass();
        $this->groups = new GroupsClass();
        $this->groupPosition = new GroupPositionClass();
    }

    public function insertGet() {
        return View::make('groupMember.insert')
                        ->with('actionType', 'บันทึก')
                        ->with('menuName', $this->groupMember->getMenuNameForDisplay())
                        ->with('titlePrintList', $this->title->getTitlePrintList())
                        ->with('memberCareerList', $this->career->getCareerList())
                        ->with('backUrl', URL::to('groupMemberTable'));
    }

    public function insertPost() {
        $this->groupMember->setMemberPid(Input::get('memberPid'));
        $this->groupMember->setTitleId(Input::get('titleId'));
        $this->groupMember->setMemberName(Input::get('memberName'));
        $this->groupMember->setMemberMidname(Input::get('memberMidname'));
        $this->groupMember->setMemberSurname(Input::get('memberSurname'));
        $this->groupMember->setGender(Input::get('gender'));
        $this->groupMember->setMemberCareer(Input::get('memberCareer'));
        $this->groupMember->setMemberAddress(Input::get('memberAddress'));
        $this->groupMember->setMemberPhoneNumber1(Input::get('memberPhoneNumber1'));
        $this->groupMember->setMemberPhoneNumber2(Input::get('memberPhoneNumber2'));
        $this->groupMember->setMemberImage(Input::file('memberImage'));
        $this->groupMember->setAllInformation(Input::all());
        $v = $this->groupMember->validate();
        if ($v->fails()) {
            return Redirect::to('groupMemberTable/insert')
                            ->withErrors($v)
                            ->withInput();
        }
        switch ($this->groupMember->insertToDatabase()) {
            case 'startDateProblem' :
                Session::flash('error', 'กรุณาระบุ วัน/เดือน/ปี ที่เริ่มดำรงตำแหน่งให้ถูกต้อง');
                break;
            case 'endDateProblem' :
                Session::flash('error', 'กรุณาระบุ วัน/เดือน/ปี ที่หมดวาระดำรงตำแหน่งให้ถูกต้อง');
                break;
            case 'positionProblem' :
                Session::flash('error', 'กรุณาระบุตำแหน่งที่ไม่ซ้ำกัน');
                break;
            default :
                return Redirect::to('groupMemberTable/insert')
                                ->with('insertSuccess', true);
        }
        return Redirect::to('groupMemberTable/insert')
                        ->withErrors($v)
                        ->withInput();
    }

    public function updateGet($memberPid) {
        $this->groupMember->setMemberPid($memberPid);
        $groupMember = $this->groupMember->getGroupMember();
        $groupMemberPosition = $this->groupMember->getGroupMemberPosition();
        $groupsNameList = $this->groups->getGroupsNameList();
        $countGroupMemberPosition = count($groupMemberPosition);
        $groupPositionNameList = array();
        for ($i = 0; $i < $countGroupMemberPosition; $i++) {
            $groupPositionNameList[$i] = $this->groupPosition->getGroupPositionNameList($groupMemberPosition[$i]->group_id);
        }
        return View::make('groupMember.update')
                        ->with('actionType', 'บันทึก')
                        ->with('menuName', $this->groupMember->getMenuNameForDisplay())
                        ->with('titlePrintList', $this->title->getTitlePrintList())
                        ->with('memberCareerList', $this->career->getCareerList())
                        ->with('groupMember', $groupMember)
                        ->with('groupMemberPosition', $groupMemberPosition)
                        ->with('groupsNameList', $groupsNameList)
                        ->with('groupPositionNameList', $groupPositionNameList)
                        ->with('backUrl', URL::to('groupMemberTable'));
    }

    public function updatePost($memberPid) {
        $this->groupMember->setMemberPid(Input::get('memberPid'));
        $this->groupMember->setTitleId(Input::get('titleId'));
        $this->groupMember->setMemberName(Input::get('memberName'));
        $this->groupMember->setMemberMidname(Input::get('memberMidname'));
        $this->groupMember->setMemberSurname(Input::get('memberSurname'));
        $this->groupMember->setGender(Input::get('gender'));
        $this->groupMember->setMemberCareer(Input::get('memberCareer'));
        $this->groupMember->setMemberAddress(Input::get('memberAddress'));
        $this->groupMember->setMemberPhoneNumber1(Input::get('memberPhoneNumber1'));
        $this->groupMember->setMemberPhoneNumber2(Input::get('memberPhoneNumber2'));
        $this->groupMember->setMemberImage(Input::file('memberImage'));
        $this->groupMember->setAllInformation(Input::all());
        $v = $this->groupMember->validate();
        if ($v->fails()) {
            return Redirect::to('groupMemberTable/update/' . $memberPid)
                            ->withErrors($v)
                            ->withInput();
        }
        switch ($this->groupMember->updateToDatabase()) {
            case 'startDateProblem' :
                Session::flash('error', 'กรุณาระบุ วัน/เดือน/ปี ที่เริ่มดำรงตำแหน่งให้ถูกต้อง');
                break;
            case 'endDateProblem' :
                Session::flash('error', 'กรุณาระบุ วัน/เดือน/ปี ที่หมดวาระดำรงตำแหน่งให้ถูกต้อง');
                break;
            case 'positionProblem' :
                Session::flash('error', 'กรุณาระบุตำแหน่งที่ไม่ซ้ำกัน');
                break;
            default :
                return Redirect::to('groupMemberTable/update/' . $memberPid)
                                ->with('updateSuccess', true);
        }
        return Redirect::to('groupMemberTable/update/' . $memberPid)
                        ->withErrors($v)
                        ->withInput();
    }

    public function deleteGet($memberPid) {
        $this->groupMember->setMemberPid($memberPid);
        $this->groupMember->deleteToDatabase();
        return Redirect::to('groupMemberTable')
                        ->with('deleteSuccess', true);
    }

    public function displayDatatable() {
        return View::make('groupMember.index')
                        ->with('datasourceUrl', URL::to('datasourceGroupMember'))
                        ->with('menuName', $this->groupMember->getMenuNameForDisplay())
                        ->with('url', 'groupMemberTable');
    }

    public function displayExHeadman() {
        return View::make('content.tablecloth.groupMember.exHeadman')
                        ->with('title', $this->groupMember->getExHeadmanTitleForDisplay())
                        ->with('headers', $this->groupMember->getExHeadmanHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getExHeadmanDataForDisplay());
    }

    public function displayExSAO() {
        return View::make('content.tablecloth.groupMember.exSAO')
                        ->with('title', $this->groupMember->getExSAOTitleForDisplay())
                        ->with('headers', $this->groupMember->getExSAOHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getExSAODataForDisplay());
    }

    public function displayExVillageCommittee() {
        return View::make('content.tablecloth.groupMember.exVillageCommittee')
                        ->with('title', $this->groupMember->getExVillageCommitteeTitleForDisplay())
                        ->with('headers', $this->groupMember->getExVillageCommitteeHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getExVillageCommitteeDataForDisplay());
    }

    public function displayExFundVillageCommittee() {
        return View::make('content.tablecloth.groupMember.exFundVillageCommittee')
                        ->with('title', $this->groupMember->getExFundVillageCommitteeTitleForDisplay())
                        ->with('headers', $this->groupMember->getExFundVillageCommitteeHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getExFundVillageCommitteeDataForDisplay());
    }

    public function displayExProjectVillageCommittee() {
        return View::make('content.tablecloth.groupMember.exProjectVillageCommittee')
                        ->with('title', $this->groupMember->getExProjectVillageCommitteeTitleForDisplay())
                        ->with('headers', $this->groupMember->getExProjectVillageCommitteeHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getExProjectVillageCommitteeDataForDisplay());
    }

    public function displayExFundWomenDelegate() {
        return View::make('content.tablecloth.groupMember.exFundWomenDelegate')
                        ->with('title', $this->groupMember->getExFundWomenDelegateTitleForDisplay())
                        ->with('headers', $this->groupMember->getExFundWomenDelegateHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getExFundWomenDelegateDataForDisplay());
    }

    public function displayExProjectPoorCommittee() {
        return View::make('content.tablecloth.groupMember.exProjectPoorCommittee')
                        ->with('title', $this->groupMember->getExProjectPoorCommitteeTitleForDisplay())
                        ->with('headers', $this->groupMember->getExProjectPoorCommitteeHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getExProjectPoorCommitteeDataForDisplay());
    }

    public function displayExFundQueen() {
        return View::make('content.tablecloth.groupMember.exFundQueen')
                        ->with('title', $this->groupMember->getExFundQueenTitleForDisplay())
                        ->with('headers', $this->groupMember->getExFundQueenHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getExFundQueenDataForDisplay());
    }

    public function displayExSavingsMenufacturingCommittee() {
        return View::make('content.tablecloth.groupMember.exSavingsMenufacturingCommittee')
                        ->with('title', $this->groupMember->getExSavingsMenufacturingCommitteeTitleForDisplay())
                        ->with('headers', $this->groupMember->getExSavingsMenufacturingCommitteeHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getExSavingsMenufacturingCommitteeDataForDisplay());
    }

    public function displayOrgaPublicHealthUndertake() {
        return View::make('content.tablecloth.groupMember.orgaPublicHealthUndertake')
                        ->with('title', $this->groupMember->getOrgaPublicHealthUndertakeTitleForDisplay())
                        ->with('headers', $this->groupMember->getOrgaPublicHealthUndertakeHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOrgaPublicHealthUndertakeDataForDisplay());
    }

    public function displayOrgaSecurityUndertake() {
        return View::make('content.tablecloth.groupMember.orgaSecurityUndertake')
                        ->with('title', $this->groupMember->getOrgaSecurityUndertakeTitleForDisplay())
                        ->with('headers', $this->groupMember->getOrgaSecurityUndertakeHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOrgaSecurityUndertakeDataForDisplay());
    }

    public function displayOrgaDevCommunityUndertake() {
        return View::make('content.tablecloth.groupMember.orgaDevCommunityUndertake')
                        ->with('title', $this->groupMember->getOrgaDevCommunityUndertakeTitleForDisplay())
                        ->with('headers', $this->groupMember->getOrgaDevCommunityUndertakeHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOrgaDevCommunityUndertakeDataForDisplay());
    }

    public function displayOrgaLivestockUndertake() {
        return View::make('content.tablecloth.groupMember.orgaLivestockUndertake')
                        ->with('title', $this->groupMember->getOrgaLivestockUndertakeTitleForDisplay())
                        ->with('headers', $this->groupMember->getOrgaLivestockUndertakeHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOrgaLivestockUndertakeDataForDisplay());
    }

    public function displayOrga25Pineapple() {
        return View::make('content.tablecloth.groupMember.orga25Pineapple')
                        ->with('title', $this->groupMember->getOrga25PineappleTitleForDisplay())
                        ->with('headers', $this->groupMember->getOrga25PineappleHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOrga25PineappleDataForDisplay());
    }

    public function displayOrgaRedCrossUndertake() {
        return View::make('content.tablecloth.groupMember.orgaRedCrossUndertake')
                        ->with('title', $this->groupMember->getOrgaRedCrossUndertakeTitleForDisplay())
                        ->with('headers', $this->groupMember->getOrgaRedCrossUndertakeHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOrgaRedCrossUndertakeDataForDisplay());
    }

    public function displayOrgaMediateCivilDelegate() {
        return View::make('content.tablecloth.groupMember.orgaMediateCivilDelegate')
                        ->with('title', $this->groupMember->getOrgaMediateCivilDelegateTitleForDisplay())
                        ->with('headers', $this->groupMember->getOrgaMediateCivilDelegateHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOrgaMediateCivilDelegateDataForDisplay());
    }

    public function displayOrgaFarmer() {
        return View::make('content.tablecloth.groupMember.orgaFarmer')
                        ->with('title', $this->groupMember->getOrgaFarmerTitleForDisplay())
                        ->with('headers', $this->groupMember->getOrgaFarmerHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOrgaFarmerDataForDisplay());
    }

    public function displayOrgaSoilDocter() {
        return View::make('content.tablecloth.groupMember.orgaSoilDocter')
                        ->with('title', $this->groupMember->getOrgaSoilDocterTitleForDisplay())
                        ->with('headers', $this->groupMember->getOrgaSoilDocterHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOrgaSoilDocterDataForDisplay());
    }

    public function displayOlderOlder() {
        return View::make('content.tablecloth.groupMember.olderOlder')
                        ->with('title', $this->groupMember->getOlderOlderTitleForDisplay())
                        ->with('headers', $this->groupMember->getOlderOlderHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOlderOlderDataForDisplay());
    }

    public function displayOlderDisabled() {
        return View::make('content.tablecloth.groupMember.olderDisabled')
                        ->with('title', $this->groupMember->getOlderDisabledTitleForDisplay())
                        ->with('headers', $this->groupMember->getOlderDisabledHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOlderDisabledDataForDisplay());
    }

    public function displayOlderMiserable() {
        return View::make('content.tablecloth.groupMember.olderMiserable')
                        ->with('title', $this->groupMember->getOlderMiserableTitleForDisplay())
                        ->with('headers', $this->groupMember->getOlderMiserableHeaderForDisplay())
                        ->with('listOfData', $this->groupMember->getOlderMiserableDataForDisplay());
    }

    public function displayGroupPositionNameList($groupId) {
        $groupPosition = $this->groupPosition->getGroupPositionNameList($groupId);
        foreach ($groupPosition as $key => $value) {
            echo "<option value='$key'>$value</option>";
        }
    }

    public function displayPositionForm($max, $action) {
        return View::make('groupMember.position')
                        ->with('groupsNameList', $this->groups->getGroupsNameList())
                        ->with('groupPositionNameList', $this->groupPosition->getGroupPositionNameList(1))
                        ->with('action', $action)
                        ->with('max', $max);
    }

}
