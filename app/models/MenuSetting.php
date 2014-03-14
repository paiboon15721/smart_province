<?php

class MenuSetting extends Eloquent {

    protected $table = 'tab_menu_setting';
    //protected $fillable = array('menu_name_th','menu_url','menu_sort_id');
    public $timestamps = false;
    protected $primaryKey = 'menu_id';
}
