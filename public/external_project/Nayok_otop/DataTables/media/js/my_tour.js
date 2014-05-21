/* globals hopscotch: false */

/* ============ */
/* EXAMPLE TOUR */
/* ============ */
var tour = {
  id: 'hello-hopscotch',
  steps: [
     {
      target: 'menu',
      title: 'เมนูต่างๆ',
      content: 'เป็นเมนูที่ใช้เพื่อไปยังส่วนต่างๆ ของระบบ',
      placement: 'right',
      arrowOffset: 35,
      yOffset: 50
    },
    {
      target: 'image',
      title: 'รูปอัตลักษณ์ของหมู่บ้าน',
      content: 'รูปที่แสดงถึงจุดเด่นของหมู่บ้าน',
      placement: 'top',
      arrowOffset: 80,
      xOffset: 50
    },
    {
      target: 'image',
      title: 'รูปต่างๆ ของหมู่บ้าน',
      content: 'รูปต่างๆ ที่เกี่ยวกับหมู่บ้าน เช่น การเป็นอยู่, สถานที่ท่องเที่ยวและสถานที่สำคัญต่างๆ',
      placement: 'bottom',
      arrowOffset: 80,
      xOffset: 400
    },    
    {
      target: 'login',
      title: 'ระบบการบันทึกข้อมูลและการบริหาร',
      content: 'กดปุ่ม "อ่านบัตร" เพื่ออ่านบัตรและเข้าสู่ระบบ',
      placement: 'right',
      yOffset: 60,
      arrowOffset: 40,
      width : 350
    },
    {
      target: 'history',
      title: 'รายละเอียดของหมู่บ้าน',
      content: 'แสดงถึงรายละเอียดของหมู่บ้าน เช่น ประวัติของหมู่บ้านและสภาพทางภูมิศาสตร์',
      placement: 'bottom',
      arrowOffset: 80,
      xOffset: 100
    },
    {
      target: 'updates',
      title: 'ข่าวสาร',
      content: 'แสดงข่าวสารต่างๆ ภายในหมู่บ้าน รวมถึงการแจ้งข่าวต่างๆ เพื่อให้ประชาชนรับทราบ',
      placement: 'right',
      yOffset: 160,
      arrowOffset: 40,
      width : 350
    },
    {
      target: 'red_menu',
      title: 'ระบบข้อมูลหมู่บ้าน',
      content: 'เมนูแสดงข้อมูลต่างๆ เกี่ยวกับหมู่บ้าน',
      placement: 'left',
      yOffset: 160,
      arrowOffset: 35,
      xOffset: -20
    },
  	{
      target: 'purple_menu',
      title: 'ระบบบริการด้านต่างๆ',
      content: 'เมนูแสดงเกี่ยวกับระบบสำหรับบริการด้านต่างๆ ให้แก่ประชาชน เช่น ระบบบริการด้านการทะเบียนและบัตร, ระบบบริการชำระค่าสาธารณูปโภค, ระบบบริการชำระค่าธรรมเนียมอื่นๆ และระบบการให้บริการจ่ายภาษี ฯลฯ',
      placement: 'left',
      yOffset: 10,
      arrowOffset: 70,
      xOffset: -20
   	},
    {
      target: 'yellow_menu',
      title: 'ระบบงานทั่วไป',
      content: 'เมนูแสดงระบบงานต่างๆ ของหมู่บ้าน เช่น ระบบการประชุมทางไกล, ระบบแผนที่ GIS, ระบบรับแจ้งความ, ระบบแต่งตั้งและแบ่งหน้าที่, ระบบ CCTV ฯลฯ',
      placement: 'left',
      yOffset: 160,
      arrowOffset: 60,
      xOffset: -20
    },
    {
      target: 'green_menu',
      title: 'ระบบการบันทึกข้อมูลเพื่อการบริหาร',
      content: 'เมนูแสดงระบบการบันทึกข้อมูลเพื่อการบริหารของภายในหมู่บ้าน เช่น ระบบข้อมูลทะเบียนรายการบุคคล, ระบบการบันทึกการขึ้นทะเบียนเกษตรกร, ระบบบันทึกข้อมูล ศูนย์ข้อมูลและบริการหมู่บ้าน (ศขบ.) ฯลฯ',
      placement: 'left',
      yOffset: 5,
      arrowOffset: 60,
      xOffset: -20,
      width : 350
    },
    {
      target: 'startTourBtn',
      title: 'สิ้นสุดการแนะนำระบบ',
      content: '',
      placement: 'right',
	  yOffset: -25,
	  arrowOffset: 25,
	  width: 250
    }     
  ],
  showPrevButton: true,
  scrollTopMargin: 100
},

/* ========== */
/* TOUR SETUP */
/* ========== */
addClickListener = function(el, fn) {
  if (el.addEventListener) {
    el.addEventListener('click', fn, false);
  }
  else {
    el.attachEvent('onclick', fn);
  }
},

init = function() {
  var startBtnId = 'startTourBtn',
      calloutId = 'startTourCallout',
      mgr = hopscotch.getCalloutManager(),
      state = hopscotch.getState();
/*
  if (state && state.indexOf('hello-hopscotch:') === 0) {
    // Already started the tour at some point!
    hopscotch.startTour(tour);
  }
  else {
    // Looking at the page for the first(?) time.
    setTimeout(function() {
      mgr.createCallout({
        id: calloutId,
        target: startBtnId,
        placement: 'right',
        title: 'คลิ๊กที่นี่เพื่อดูวิธีการใช้งานระบบ',
        content: '',
        yOffset: -25,
        arrowOffset: 15,
        width: 250
      });
    }, 100);
  }
*/
  addClickListener(document.getElementById(startBtnId), function() {
    if (!hopscotch.isActive) {
      mgr.removeAllCallouts();
      hopscotch.startTour(tour);
    }
  });
};

init();

