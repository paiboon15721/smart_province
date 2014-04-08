@extends('contentLayouts.index')

@section('subTitle')
ตั้งค่าเมนู
@stop
@section('subDescription')
ตั้งค่าเมนู
@stop
@section('subKeywords')
ตั้งค่าเมนู
@stop

@section('subScript&css')
{{HTML::style('css/dataTables/jquery-ui-1.8.14.custom.css')}}
{{HTML::style('css/dataTables/demo_table_jui.css')}}
{{HTML::style('css/dataTables/TableTools_JUI.css')}}
{{HTML::script('js/dataTables/jquery.dataTables.min.js')}}
{{HTML::script('js/dataTables/TableTools.js')}}
@stop

@section('subContent')
<div id="welcome" class="post">
	test
</div>
@stop


@section('subContent1')
<div id="welcome" class="post">
	{{ Datatable::table()
	->addColumn('menu_id', 'menu_name_th','menu_name_en')
	->setOptions('bJQueryUI', true)
	->setUrl(route('getDatatables.menuSetting'))
	->render('menuSetting.dataTables') }}
</div>

  /* public function getDatatables() {
        return Datatable::collection(MenuSetting::all())
        ->showColumns('menu_id', 'menu_name_th','menu_name_en')
        //->searchColumns('menu_name_th')
        //->orderColumns('menu_id', 'menu_name_th')
        ->make();
    }*/
@stop