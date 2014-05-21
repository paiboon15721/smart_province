$(document).ready(function(){

    $("#btn_print").click(function(){
        var mybrowser=navigator.userAgent;  
        if(mybrowser.indexOf('MSIE')>0){  
            document.execCommand('print', false, null);
        }else{  
            window.print();
        }
    });
    
    $('#btn_close').click(function(){
        //window.close();
        parent.$.fancybox.close();
    });
   
    if (parent.document.getElementById("pop_data")){
        displayPopDetail(parent.$("#pop_data").val());
    }else{
        displayHouseDetail(parent.$("#house_data").val());
    }
    function displayHouseDetail(data){
    //alert(data);
        if (data != ""){
            var arr_data = data.split("|");
            var i=0;
            var hid = arr_data[i++];
            var htype = arr_data[i++];
            var address = arr_data[i++];
            var ccaattmm = arr_data[i++];
            var cc = ccaattmm.substr(0,2);
            var aa = ccaattmm.substr(0,4);
            var tt = ccaattmm.substr(0,6);
            var mm = ccaattmm.substr(6,2);
            var link='';
         
            $("#hid").text(hid);
            $("#htype").text(htype);
            $("#address").text(address);
            
            //$('#map').load('http://nakhonnayok.ecarteis.com/public/poi?cc=xx&aa=xxxx&tt=xxxxxx&mm=xx&hid=xx&cate=44');
            link = 'http://nakhonnayok.ecarteis.com/public/poi?cc='+cc+'&aa='+aa+'&tt='+tt+'&mm='+mm+'&hid='+hid.replace(/-/g,"")+'&cate=44';
            
            //$('#map').html(link);
            /*$.ajax({  
                    url: link,
                    dataType: 'text',
                    cache:false,
                    async:false,
                    contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                    success:function(data){
                        alert(data);
                        //$('#map').html(data);
                        $("#map").attr('src',+data); //change url
                    },
                    error :function(data){
                        alert(data);
                      
                    }
                });*/
                
                $("#map").attr('src',link);
                
            /*$('#map').load(link, function(response, status, xhr) {
           
                if (status == "success") {
                    alert('success');
                }
                if (status == "error") {
                    //$('#map').html('<img src="images/banna.png"/>');
                    //$('#map').html('<a href="'+link+'">map</a>');
                    $("#map").attr('src',+link);
                    alert("Error: "+xhr.status+": "+xhr.statusText);
                }
            });
            */
            
        }
    }
    
    function displayPopDetail(data){
        if (data != ""){
            var arr_data = data.split("|");
            var i=2;
            var pid = arr_data[i++];
            var title = arr_data[i++];
            var fname = arr_data[i++];
            var lname = arr_data[i++];
            var name = title+fname+" "+lname;
            var dob = arr_data[i++];
            var age = arr_data[i++];
            var nat = arr_data[i++];
            var own_st = arr_data[i++];
            var pop_st = arr_data[i++];
            var sex = arr_data[i++];

            var datemi = arr_data[i++];
            var faname = arr_data[i++];
            var fnat = arr_data[i++];
            var maname = arr_data[i++];
            var mnat = arr_data[i++];
            var hid = arr_data[i++];    
            var hno = arr_data[i++];
            var ccaattmm = arr_data[i++];
            var thanon = arr_data[i++];
            var trok = arr_data[i++];
            var soi1 = arr_data[i++];
            var soi2 = arr_data[i++];
            var cc = arr_data[i++];
            var aa = arr_data[i++];
            var tt = arr_data[i++];
            var mm = arr_data[i++];
            
            
           /* cc = "จังหวัดนครนายก";
            aa = "อำเภอบ้านนา";
            tt = "ตำบลอาษา";
            */
            
            own_st = strOwnSt(own_st);
            pop_st = strPopSt(pop_st);
            sex = strSex(sex);
            pid = formatPid(pid);
            hid = formatHid(hid);
            dob = displayDate(dob);
            datemi = displayDate(datemi);
            
            var address = strAddr(hno, ccaattmm,thanon,trok,soi1,soi2,cc,aa,tt,mm);
            
            //address = address + "ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ทดสอบ ";
            $("#pid").text(pid);
            $("#name").text(name);
            $("#sex").text(sex);
            $("#dob").text(dob);
            age = age + ' ' + 'ปี';
            $("#age").text(age);
            
            $("#nat").text(nat);
            $("#pop_st").text(pop_st);
            $("#hid").text(hid);
            $("#address").text(address);
            $("#own_st").text(own_st);
            $("#datemi").text(datemi);
            $("#faname").text(faname);
            $("#fnat").text(fnat);
            $("#maname").text(maname);
            $("#mnat").text(mnat);
            
            
        }
    }
});