<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

//map
Route::get('/', 'MapController@main');
Route::get('writeSession/{catmId}', 'HomeController@writeSession');

//ระบบที่จำเป็นต้องผ่านการเลือกหมู่บ้านก่อน
Route::group(array('before' => 'catm'), function() {
    //home
    Route::get('main', 'HomeController@main');
    Route::get('villageDirectors', 'HomeController@villageDirectors');
    Route::get('villageGeneralInformation', 'HomeController@villageGeneralInformation');
    Route::get('villageInformationSystem', 'HomeController@villageInformationSystem');
    Route::get('servicesSystem', 'HomeController@servicesSystem');
    Route::get('generalSystem', 'HomeController@generalSystem');
    Route::get('recordingSystem', 'HomeController@recordingSystem');
    Route::get('contactUs', 'HomeController@contactUs');
    Route::get('map', 'HomeController@map');
    Route::get('bypassLogin', 'HomeController@bypassLogin');
    Route::get('logout', 'HomeController@logout');

    //group member
    Route::get('exHeadman', 'GroupMemberController@displayExHeadman');
    Route::get('exSAO', 'GroupMemberController@displayExSAO');
    Route::get('exVillageCommittee', 'GroupMemberController@displayExVillageCommittee');
    Route::get('exFundVillageCommittee', 'GroupMemberController@displayExFundVillageCommittee');
    Route::get('exProjectVillageCommittee', 'GroupMemberController@displayExProjectVillageCommittee');
    Route::get('exFundWomenDelegate', 'GroupMemberController@displayExFundWomenDelegate');
    Route::get('exProjectPoorCommittee', 'GroupMemberController@displayExProjectPoorCommittee');
    Route::get('exFundQueen', 'GroupMemberController@displayExFundQueen');
    Route::get('exSavingsMenufacturingCommittee', 'GroupMemberController@displayExSavingsMenufacturingCommittee');
    Route::get('orgaPublicHealthUndertake', 'GroupMemberController@displayOrgaPublicHealthUndertake');
    Route::get('orgaSecurityUndertake', 'GroupMemberController@displayOrgaSecurityUndertake');
    Route::get('orgaDevCommunityUndertake', 'GroupMemberController@displayOrgaDevCommunityUndertake');
    Route::get('orgaLivestockUndertake', 'GroupMemberController@displayOrgaLivestockUndertake');
    Route::get('orga25Pineapple', 'GroupMemberController@displayOrga25Pineapple');
    Route::get('orgaRedCrossUndertake', 'GroupMemberController@displayOrgaRedCrossUndertake');
    Route::get('orgaMediateCivilDelegate', 'GroupMemberController@displayOrgaMediateCivilDelegate');
    Route::get('orgaFarmer', 'GroupMemberController@displayOrgaFarmer');
    Route::get('orgaSoilDocter', 'GroupMemberController@displayOrgaSoilDocter');
    Route::get('olderOlder', 'GroupMemberController@displayOlderOlder');
    Route::get('olderDisabled', 'GroupMemberController@displayOlderDisabled');
    Route::get('olderMiserable', 'GroupMemberController@displayOlderMiserable');

    //group member and position
    Route::get('memberDirector', 'GroupMemberAndPositionController@displayMemberDirector');
    Route::get('memberSecurity', 'GroupMemberAndPositionController@displayMemberSecurity');
    Route::get('memberDevelop', 'GroupMemberAndPositionController@displayMemberDevelop');
    Route::get('memberEconomy', 'GroupMemberAndPositionController@displayMemberEconomy');
    Route::get('memberSocial', 'GroupMemberAndPositionController@displayMemberSocial');
    Route::get('memberCulture', 'GroupMemberAndPositionController@displayMemberCulture');
    Route::get('memberPerform', 'GroupMemberAndPositionController@displayMemberPerform');

    //problem
    Route::get('problemEconomy', 'ProblemController@displayProblemEconomy');
    Route::get('problemSocial', 'ProblemController@displayProblemSocial');
    Route::get('problemEnvironment', 'ProblemController@displayProblemEnvironment');
    Route::get('problemManagement', 'ProblemController@displayProblemManagement');
    Route::get('problemStable', 'ProblemController@displayProblemStable');
    Route::get('problemFarmer', 'ProblemController@displayProblemFarmer');
    Route::get('problemSocialPerformance', 'ProblemController@displayProblemSocialPerformance');

    //otop
    Route::get('otop', 'OtopController@displayOtop');

    //travel
    Route::get('travel', 'TravelController@displayTravel');

    //meeting
    Route::get('meeting', 'MeetingController@displayMeeting');

    //plan
    Route::get('plan', 'PlanController@displayPlan');

    //groupPositionCareer
    Route::get('groupPositionCareer', 'GroupPositionCareerController@displayGroupPositionCareer');

    //activity
    Route::get('activity', 'ActivityController@displayActivity');

    //external_project
    Route::get('nayokStat', 'ExternalController@nayokStat');
    Route::get('login', 'ExternalController@login');
    Route::get('newsVoiceList', 'ExternalController@newsVoiceList');
    Route::get('pollIndex', 'ExternalController@pollIndex');
    Route::get('pollShowFinishPoll', 'ExternalController@pollShowFinishPoll');
    Route::get('eReport4', 'ExternalController@eReport4');

    //ระบบที่จำเป็นต้องผ่านการ login ก่อน
    Route::group(array('before' => 'login'), function() {
        //menu setting
        Route::get('menuSetting/{id}', 'MenuSettingController@index');
        Route::get('menuSetting/{parentMenuIdForBack}/insert/{id}', 'MenuSettingController@insertGet');
        Route::post('menuSetting/{parentMenuIdForBack}/insert', 'MenuSettingController@insertPost');
        Route::get('menuSetting/{parentMenuIdForBack}/update/{id}', 'MenuSettingController@updateGet');
        Route::post('menuSetting/{parentMenuIdForBack}/update/{id}', 'MenuSettingController@updatePost');
        Route::get('menuSetting/{parentMenuIdForBack}/delete/{id}', 'MenuSettingController@deleteGet');

        //group member
        Route::get('groupPositionNameList/{groupId}', 'GroupMemberController@displayGroupPositionNameList');
        Route::get('positionForm/{max}/{action}', 'GroupMemberController@displayPositionForm');
        Route::get('groupMemberTable', 'GroupMemberController@displayDatatable');
        Route::get('groupMemberTable/insert', 'GroupMemberController@insertGet');
        Route::post('groupMemberTable/insert', 'GroupMemberController@insertPost');
        Route::get('groupMemberTable/update/{id}', 'GroupMemberController@updateGet');
        Route::post('groupMemberTable/update/{id}', 'GroupMemberController@updatePost');
        Route::get('groupMemberTable/delete/{id}', 'GroupMemberController@deleteGet');
        Route::get('datasourceGroupMember', 'DatatableDatasourceController@datasourceGroupMember');

        //problem
        Route::get('problemTable', 'ProblemController@displayDatatable');
        Route::get('problemTable/insert', 'ProblemController@insertGet');
        Route::post('problemTable/insert', 'ProblemController@insertPost');
        Route::get('problemTable/update/{id}', 'ProblemController@updateGet');
        Route::post('problemTable/update/{id}', 'ProblemController@updatePost');
        Route::get('problemTable/delete/{id}', 'ProblemController@deleteGet');
        Route::get('datasourceProblem', 'DatatableDatasourceController@datasourceProblem');

        //otop
        Route::get('otopTable', 'OtopController@displayDatatable');
        Route::get('otopTable/insert', 'OtopController@insertGet');
        Route::post('otopTable/insert', 'OtopController@insertPost');
        Route::get('otopTable/update/{id}', 'OtopController@updateGet');
        Route::post('otopTable/update/{id}', 'OtopController@updatePost');
        Route::get('otopTable/delete/{id}', 'OtopController@deleteGet');
        Route::get('datasourceOtop', 'DatatableDatasourceController@datasourceOtop');

        //travel
        Route::get('travelTable', 'TravelController@displayDatatable');
        Route::get('travelTable/insert', 'TravelController@insertGet');
        Route::post('travelTable/insert', 'TravelController@insertPost');
        Route::get('travelTable/update/{id}', 'TravelController@updateGet');
        Route::post('travelTable/update/{id}', 'TravelController@updatePost');
        Route::get('travelTable/delete/{id}', 'TravelController@deleteGet');
        Route::get('datasourceTravel', 'DatatableDatasourceController@datasourceTravel');

        //meeting
        Route::get('meetingTable', 'MeetingController@displayDatatable');
        Route::get('meetingTable/insert', 'MeetingController@insertGet');
        Route::post('meetingTable/insert', 'MeetingController@insertPost');
        Route::get('meetingTable/update/{id}', 'MeetingController@updateGet');
        Route::post('meetingTable/update/{id}', 'MeetingController@updatePost');
        Route::get('meetingTable/delete/{id}', 'MeetingController@deleteGet');
        Route::get('datasourceMeeting', 'DatatableDatasourceController@datasourceMeeting');

        //plan
        Route::get('planTable', 'PlanController@displayDatatable');
        Route::get('planTable/insert', 'PlanController@insertGet');
        Route::post('planTable/insert', 'PlanController@insertPost');
        Route::get('planTable/update/{id}', 'PlanController@updateGet');
        Route::post('planTable/update/{id}', 'PlanController@updatePost');
        Route::get('planTable/delete/{id}', 'PlanController@deleteGet');
        Route::get('datasourcePlan', 'DatatableDatasourceController@datasourcePlan');

        //groupPositionCareer
        Route::get('groupPositionCareerTable', 'GroupPositionCareerController@displayDatatable');
        Route::get('groupPositionCareerTable/insert', 'GroupPositionCareerController@insertGet');
        Route::post('groupPositionCareerTable/insert', 'GroupPositionCareerController@insertPost');
        Route::get('groupPositionCareerTable/update/{id}', 'GroupPositionCareerController@updateGet');
        Route::post('groupPositionCareerTable/update/{id}', 'GroupPositionCareerController@updatePost');
        Route::get('groupPositionCareerTable/delete/{id}', 'GroupPositionCareerController@deleteGet');
        Route::get('datasourceGroupPositionCareer', 'DatatableDatasourceController@datasourceGroupPositionCareer');

        //activity
        Route::get('activityTable', 'ActivityController@displayDatatable');
        Route::get('activityTable/insert', 'ActivityController@insertGet');
        Route::post('activityTable/insert', 'ActivityController@insertPost');
        Route::get('activityTable/update/{id}', 'ActivityController@updateGet');
        Route::post('activityTable/update/{id}', 'ActivityController@updatePost');
        Route::get('activityTable/delete/{id}', 'ActivityController@deleteGet');
        Route::get('datasourceActivity', 'DatatableDatasourceController@datasourceActivity');

        //external_project
        Route::get('newsVoice', 'ExternalController@newsVoice');
        Route::get('eReportAssign', 'ExternalController@eReportAssign');
        Route::get('eReport1', 'ExternalController@eReport1');
        Route::get('eReport2', 'ExternalController@eReport2');
        Route::get('eReport3', 'ExternalController@eReport3');
        Route::get('pollMainMenu', 'ExternalController@pollMainMenu');
        Route::get('ors', 'ExternalController@ors');
    });
});
//validator
Validator::extend('dateValid', function($attribute, $date, $parameters) {
    $date = explode('/', $date);
    if (count($date) != 3) {
        return false;
    } elseif (is_numeric($date[0]) and is_numeric($date[1]) and is_numeric($date[2])) {
        $date[2] = $date[2] - 543;
        if (checkdate($date[1], $date[0], $date[2])) {
            return true;
        } else {
            return false;
        }
    }
});


Route::get('checkSession', function() {
    return $_SESSION['EMPID'];
});
/*
Event::listen('illuminate.query', function($sql) {
    var_dump($sql);
});
*/