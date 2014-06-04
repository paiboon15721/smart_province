@extends('contentLayouts.main')
@section('subTitle')
หน้าหลัก
@stop
@section('description')
หน้าหลัก
@stop
@section('keywords')
หน้าหลัก
@stop

@section('subContent')
<div class="post">
    <div class="row">
        <div class="feat-img span2">
            <img src="http://lorempixel.com/350/325/sports/1" title="featured image" alt="an image was here" />
        </div><!-- end featured image -->

        <div class="details span4">
            <h2>ข่าวประชาสัมพันธ์ของศูนย์</h2>
            <p>
                Lorem ipsum pariatur velit pariatur dolore aliqua voluptate sed Duis dolor ea cillum qui anim consequat quis sunt ex eu culpa veniam nisi nulla non dolor esse sit aliquip irure in amet reprehenderit quis voluptate occaecat in enim Duis.Aliqua voluptate sed Duis dolor ea cillum qui anim consequat quis sunt ex eu culpa veniam nisi nulla non dolor esse sit aliquip irure in amet reprehenderit quis voluptate occaecat in enim Duis.
            </p>
        </div> <!-- end details -->
        <a class="btn pull-right" href="#">อ่านต่อ..</a>
    </div><!-- end post row -->
</div><!-- end post -->

<div class="post">
    <div class="row">
        <div class="feat-img span2">
            <img src="http://lorempixel.com/350/325/sports/3" title="featured image" alt="an image was here" />
        </div><!-- end featured image -->

        <div class="details span4">
            <h2>ภาพกิจกรรมต่างๆ ของศูนย์</h2>
            <p>
                Lorem ipsum pariatur velit pariatur dolore aliqua voluptate sed Duis dolor ea cillum qui anim consequat quis sunt ex eu culpa veniam nisi nulla non dolor esse sit aliquip irure in amet reprehenderit quis voluptate occaecat in enim Duis.Aliqua voluptate sed Duis dolor ea cillum qui anim consequat quis sunt ex eu culpa veniam nisi nulla non dolor esse sit aliquip irure in amet reprehenderit quis voluptate occaecat in enim Duis.
            </p>
        </div> <!-- end details -->
        <a class="btn pull-right" href="#">อ่านต่อ..</a>
    </div><!-- end post row -->
</div><!-- end post -->

<div class="post">
    <div class="row">
        <div class="details span6">
            <h2>ลิงค์เว็บไซต์กระทรวงต่างๆ</h2>
            <div class="feat-img span3">
                <ul>
                    <li>{{HTML::link('#', 'สำนักนายกรัฐมนตรี')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงเทคโนโลยีสารสนเทศ')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงมหาดไทย')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงเกษตรกร')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงสหกรณ์')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงพานิช')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงการคลัง')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงวัฒนธรรม')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงกลาโหม')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงวิทยาศาสตร์')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงพลังงาน')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงอุตสาหกรรม')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงคมนาคม')}}</li>
                </ul>
            </div>
            <div class="details span3">
                <ul>
                    <li>{{HTML::link('#', 'สำนักนายกรัฐมนตรี')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงเทคโนโลยีสารสนเทศ')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงมหาดไทย')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงเกษตรกร')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงสหกรณ์')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงพานิช')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงการคลัง')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงวัฒนธรรม')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงกลาโหม')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงวิทยาศาสตร์')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงพลังงาน')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงอุตสาหกรรม')}}</li>
                    <li>{{HTML::link('#', 'กระทรวงคมนาคม')}}</li>
                </ul>
            </div>
        </div><!-- end widget -->
    </div><!-- end post row -->
</div><!-- end post -->
@stop