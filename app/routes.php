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
Route::get('/', 'MapController@index');

//home
Route::get('writeSession/{catmId}', 'HomeController@writeSession');
Route::get('main', array('before' => 'catmId', 'uses' => 'HomeController@main'));
Route::get('villageDirectors', array('before' => 'catmId', 'uses' => 'HomeController@villageDirectors'));
Route::get('villageGeneralInformation', array('before' => 'catmId', 'uses' => 'HomeController@villageGeneralInformation'));
Route::get('villageInformationSystem', array('before' => 'catmId', 'uses' => 'HomeController@villageInformationSystem'));
Route::get('servicesSystem', array('before' => 'catmId', 'uses' => 'HomeController@servicesSystem'));
Route::get('generalSystem', array('before' => 'catmId', 'uses' => 'HomeController@generalSystem'));
Route::get('recordingSystem', array('before' => 'catmId', 'uses' => 'HomeController@recordingSystem'));
Route::get('contactUs', array('before' => 'catmId', 'uses' => 'HomeController@contactUs'));
Route::get('map', array('before' => 'catmId', 'uses' => 'HomeController@map'));


//menu setting
Route::get('menuSetting/{id}', array('before' => 'catmId', 'uses' => 'MenuSettingController@index'));
Route::get('menuSetting/{parentMenuIdForBack}/insert/{id}', array('before' => 'catmId', 'uses' => 'MenuSettingController@insertGet'));
Route::post('menuSetting/{parentMenuIdForBack}/insert', array('before' => 'catmId', 'uses' => 'MenuSettingController@insertPost'));
Route::get('menuSetting/{parentMenuIdForBack}/update/{id}', array('before' => 'catmId', 'uses' => 'MenuSettingController@updateGet'));
Route::post('menuSetting/{parentMenuIdForBack}/update/{id}', array('before' => 'catmId', 'uses' => 'MenuSettingController@updatePost'));
Route::get('menuSetting/{parentMenuIdForBack}/delete/{id}', array('before' => 'catmId', 'uses' => 'MenuSettingController@deleteGet'));

//group member
Route::get('exHeadman', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayExHeadman'));
Route::get('exSAO', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayExSAO'));
Route::get('exVillageCommittee', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayExVillageCommittee'));
Route::get('exFundVillageCommittee', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayExFundVillageCommittee'));
Route::get('exProjectVillageCommittee', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayExProjectVillageCommittee'));
Route::get('exFundWomenDelegate', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayExFundWomenDelegate'));
Route::get('exProjectPoorCommittee', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayExProjectPoorCommittee'));
Route::get('exFundQueen', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayExFundQueen'));
Route::get('exSavingsMenufacturingCommittee', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayExSavingsMenufacturingCommittee'));
Route::get('orgaPublicHealthUndertake', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOrgaPublicHealthUndertake'));
Route::get('orgaSecurityUndertake', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOrgaSecurityUndertake'));
Route::get('orgaDevCommunityUndertake', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOrgaDevCommunityUndertake'));
Route::get('orgaLivestockUndertake', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOrgaLivestockUndertake'));
Route::get('orga25Pineapple', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOrga25Pineapple'));
Route::get('orgaRedCrossUndertake', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOrgaRedCrossUndertake'));
Route::get('orgaMediateCivilDelegate', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOrgaMediateCivilDelegate'));
Route::get('orgaFarmer', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOrgaFarmer'));
Route::get('orgaSoilDocter', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOrgaSoilDocter'));
Route::get('olderOlder', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOlderOlder'));
Route::get('olderDisabled', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOlderDisabled'));
Route::get('olderMiserable', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayOlderMiserable'));

Route::get('groupPositionNameList/{groupId}', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayGroupPositionNameList'));
Route::get('positionForm/{max}/{action}', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayPositionForm'));
Route::get('groupMemberTable', array('before' => 'catmId', 'uses' => 'GroupMemberController@displayDatatable'));
Route::get('groupMemberTable/insert', array('before' => 'catmId', 'uses' => 'GroupMemberController@insertGet'));
Route::post('groupMemberTable/insert', array('before' => 'catmId', 'uses' => 'GroupMemberController@insertPost'));
Route::get('groupMemberTable/update/{id}', array('before' => 'catmId', 'uses' => 'GroupMemberController@updateGet'));
Route::post('groupMemberTable/update/{id}', array('before' => 'catmId', 'uses' => 'GroupMemberController@updatePost'));
Route::get('groupMemberTable/delete/{id}', array('before' => 'catmId', 'uses' => 'GroupMemberController@deleteGet'));
Route::get('datasourceGroupMember', array('before' => 'catmId', 'uses' => 'DatatableDatasourceController@datasourceGroupMember'));

//group member and position
Route::get('memberDirector', array('before' => 'catmId', 'uses' => 'GroupMemberAndPositionController@displayMemberDirector'));
Route::get('memberSecurity', array('before' => 'catmId', 'uses' => 'GroupMemberAndPositionController@displayMemberSecurity'));
Route::get('memberDevelop', array('before' => 'catmId', 'uses' => 'GroupMemberAndPositionController@displayMemberDevelop'));
Route::get('memberEconomy', array('before' => 'catmId', 'uses' => 'GroupMemberAndPositionController@displayMemberEconomy'));
Route::get('memberSocial', array('before' => 'catmId', 'uses' => 'GroupMemberAndPositionController@displayMemberSocial'));
Route::get('memberCulture', array('before' => 'catmId', 'uses' => 'GroupMemberAndPositionController@displayMemberCulture'));
Route::get('memberPerform', array('before' => 'catmId', 'uses' => 'GroupMemberAndPositionController@displayMemberPerform'));

//problem
Route::get('problemEconomy', array('before' => 'catmId', 'uses' => 'ProblemController@displayProblemEconomy'));
Route::get('problemSocial', array('before' => 'catmId', 'uses' => 'ProblemController@displayProblemSocial'));
Route::get('problemEnvironment', array('before' => 'catmId', 'uses' => 'ProblemController@displayProblemEnvironment'));
Route::get('problemManagement', array('before' => 'catmId', 'uses' => 'ProblemController@displayProblemManagement'));
Route::get('problemStable', array('before' => 'catmId', 'uses' => 'ProblemController@displayProblemStable'));
Route::get('problemFarmer', array('before' => 'catmId', 'uses' => 'ProblemController@displayProblemFarmer'));
Route::get('problemSocialPerformance', array('before' => 'catmId', 'uses' => 'ProblemController@displayProblemSocialPerformance'));
Route::get('problemTable', array('before' => 'catmId', 'uses' => 'ProblemController@displayDatatable'));
Route::get('problemTable/insert', array('before' => 'catmId', 'uses' => 'ProblemController@insertGet'));
Route::post('problemTable/insert', array('before' => 'catmId', 'uses' => 'ProblemController@insertPost'));
Route::get('problemTable/update/{id}', array('before' => 'catmId', 'uses' => 'ProblemController@updateGet'));
Route::post('problemTable/update/{id}', array('before' => 'catmId', 'uses' => 'ProblemController@updatePost'));
Route::get('problemTable/delete/{id}', array('before' => 'catmId', 'uses' => 'ProblemController@deleteGet'));
Route::get('datasourceProblem', array('before' => 'catmId', 'uses' => 'DatatableDatasourceController@datasourceProblem'));

//otop
Route::get('otop', array('before' => 'catmId', 'uses' => 'OtopController@displayOtop'));

//travel
Route::get('travel', array('before' => 'catmId', 'uses' => 'TravelController@displayTravel'));
//test
Route::get('test', 'GroupMemberController@test');
/*
Route::get('dev', function() {
    GroupMember::with('title')->get();
});

Event::listen('illuminate.query', function($sql) {
    var_dump($sql);
});
*/