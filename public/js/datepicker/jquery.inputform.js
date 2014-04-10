(function($) {
	 var defaults = {
//		perform_number: true,
//		child_only: true,
		decimals: 0
	};
var decimals = defaults.decimals;
var keycode_delete = new Array(8,46);
var keycode_numberonly = new Array(48,49,50,51,52,53,54,55,56,57);
var keycode_none = new Array(20,16,17,91,92,18,32,93,13,38,39,40,37,35,34,33,36,45,19,145,144,113,118,119,120,121,122,123);
	
    $.fn.numberonly = function(options) {
		 var defaults = {
            perform_number: false,
			child_only: false,
			next_focus: true,
			Right_Click: true,
			max_length: 11,
			decimals: 2
        };
		var options = $.extend(defaults, options);	// extend ค่าจากภายนอกเข้ามา ถ้าเป็นชื่อเดียวกันจะถูก overwrite
		if(options.Right_Click){ this.Right_Click(); }
		if(options.child_only){ this.child_only(); }
		if(options.perform_number){ this.perform_number(); }
		if(options.next_focus){ this.next_focus(); }
		return this.each(function(i) {	//	loop ตาม selectors
			if($(this).val()==''){$(this).val(number_format(0, options.decimals));}
			$(this).focus(function(){
				var this_value = $(this).val();
				var this_read = $(this).attr('readonly');
				if(this_read==false && this_value==0){$(this).val(0);}
				if(this_read==false) onfocus_format($(this));
			}).keypress(function(key){
				var number_keycode = key.keyCode;
				fn_key_numberonly = $.merge( [46], keycode_numberonly);
				index_arr_search = $.inArray(number_keycode , fn_key_numberonly);
					if(index_arr_search == -1) return false;
			}).keydown(function(key){
				var number_keycode = key.keyCode;
				var this_value = $(this).val();
				var this_split = this_value.split(".");
				if( this_value.indexOf(".")!=-1 ){
					if(this_split[0].length == options.max_length && ( number_keycode!=8 && number_keycode!=46) ) return false;
					if( number_keycode==110 || number_keycode==190 || number_keycode==222 ) return false;	//	chk dot > 1
				}else{
					if(this_value.length == options.max_length && ( number_keycode!=8 && number_keycode!=46) ) return false;
				}
				if(key.ctrlKey && number_keycode==86) alert('กรุณากรอกโดยการพิมพ์เข้าเท่านั้น');
			}).blur(function(){
				var this_value = $(this).val()*1;
				var this_read = $(this).attr('readonly');
				if(	this_value=='' || this_value=='.') $(this).val(number_format(0, options.decimals));
				if(this_read==false) $(this).val(number_format(this_value, options.decimals));
				//$(this).val(this_value.toFixed(2));
			}).keyup(function(){
				var this_value = $(this).val();
				if( this_value=='.') $(this).val('0.');			
			}).css("text-align","right");
        });
    }

	$.fn.child_only = function(options) {
		return this.attr('readonly','readonly').addClass('input_readonly').each(function(i) {	//	loop ตาม selectors
			$(this).each(function(){
				var this_id = $(this).attr('id');
				var find_child = $('input[parent='+this_id+']').length;
				if(find_child==0){ $(this).removeAttr('readonly').removeClass('input_readonly');}
			});
        });
    }

	$.fn.Right_Click = function(options) {
		return this.each(function(i) {	//	loop ตาม selectors
			$(this).bind('contextmenu', function() {
				return false;
			});
		});
	}

	$.fn.next_focus = function(options) {
		return this.each(function(index) {	//	loop ตาม selectors
			$(this).keyup(function(key){
				var number_keycode = key.keyCode;
				if(number_keycode==13){ 
					$('input:gt('+index+')').each(function(){
						var this_play = $(this).css('display');
						var this_read = $(this).attr('readonly');
						var this_type = $(this).attr('type');
						if(this_play!='none' && this_read==false && this_type=='text'){
							$(this).focus();
							return false;
						}
					});
				}
			});
		});
	}

var keycode_numberonly_keyup = new Array(48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105);
    $.fn.perform_number = function(options) {
		return this.each(function() {	//	loop ตาม selectors
			$(this).keyup(function(key){
				var this_value = $(this).val();
				if( this_value=='.') $(this).val('0.');
				var this_parent = $(this).attr('parent');
				var this_group = $(this).attr('group');
				var this_level = $(this).attr('level');
				var number_keycode = key.keyCode;
				var fn_key_numberonly = $.merge( [8,46], keycode_numberonly_keyup );
				index_arr_search = $.inArray(number_keycode , fn_key_numberonly);
					if(index_arr_search != -1 ){ 
						if( this_value=='' ){ $(this).val(0); }
						sum_parent(this_parent, this_group, this_level);
					}
			}).blur(function(){
				var this_value = $(this).val();
				var this_parent = $(this).attr('parent');
				var this_group = $(this).attr('group');
				var this_level = $(this).attr('level');
				if(	this_value=='' || this_value=='.') $(this).val(0);
				if(	this_value!='') sum_parent(this_parent, this_group, this_level);
			});
        });
    }

var keycode_numberonly_keyup = new Array(48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105);
    $.fn.calculate_target_number = function(options) {
		 var defaults = {
			this_obj: this,
			target_obj: '',
			perform: '+',
			decimals: 2
        };
		var options = $.extend(defaults, options);	// extend ค่าจากภายนอกเข้ามา ถ้าเป็นชื่อเดียวกันจะถูก overwrite
		return this.each(function() {	//	loop ตาม selectors
			$(this).keyup(function(key){
				var this_value = $(this).val();
				if( this_value=='.') $(this).val('0.');
				var number_keycode = key.keyCode;
				var fn_key_numberonly = $.merge( [8,46], keycode_numberonly_keyup );
				index_arr_search = $.inArray(number_keycode , fn_key_numberonly);
					if(index_arr_search != -1 ){ 
						if( this_value=='' ){ $(this).val(0); }
						$(options.this_obj).each(function(i){
							var this_val = $(this).val().split(",").join("");
							if(i==0){
								sum_value = this_val;
							}else{
								sum_value = parseFloat(sum_value)+parseFloat(options.perform+this_val);
							}
						});
						$(options.target_obj).val(number_format(sum_value, options.decimals));
					}
			}).blur(function(){
				$(options.this_obj).each(function(i){
					var this_val = $(this).val().split(",").join("");
					if(i==0){
						sum_value = this_val;
					}else{
						sum_value = parseFloat(sum_value)+parseFloat(options.perform+this_val);
					}
				});
				$(options.target_obj).val(number_format(sum_value, options.decimals));
			}).ready(function(){
				$(options.this_obj).each(function(i){
					var this_val = $(this).val().split(",").join("");
					if(i==0){
						sum_value = this_val;
					}else{
						sum_value = parseFloat(sum_value)+parseFloat(options.perform+this_val);
					}
				});
				$(options.target_obj).val(number_format(sum_value, options.decimals));
			});
        });
    }

	function sum_parent(parent_id, group_id, level_id){
		var sum_all = new String;
		if(level_id==1)return false;
		$('input[group='+group_id+'][level='+level_id+'][parent='+parent_id+']').each(function(index, value){
			var this_value = value.value;
			sum_all += '+'+this_value.split(",").join("");
		});
		//var this_length = $('input[group='+group_id+'][level='+level_id+']').length;
		//var avg_value = (sum_value/this_length).toFixed(2);
		var sum_value = eval(sum_all).toFixed(decimals);
		$('input[id='+parent_id+']').val(number_format(sum_value, decimals));
		var this_parent = $('input[id='+parent_id+']').attr('parent');
		sum_parent(this_parent, group_id, level_id-1);
	}	//	end fn sum_parent

	function number_format (value, decimals) {
	 var point = '.';
	 var type = 'i';
	
	 var number = $.trim(String(value));
	 //var number = charAt(value);
	 //return false;
	 var number_zero = '';
	 if(number == '.') {
	  alert("1");
	 }
	 number = number.split(",").join("");
	 
	 for(i=0; i<number.length; i++) {
	  if(number.charAt(i) == point) {
	   type = 'f';
	  }
	 }
	 //alert(number);
	 if(type == 'f') {
	  for(i=0; i<number.length; i++) {
	   if(number.charAt(i) == 'e') {
		e_number = (number.substring(i+1, number.length)).split(".").join("");
		if(parseFloat(e_number) < 0) {
		 this_number = (number.substring(0, i)).split(".").join("");
		 e_sign = (this_number == (this_number = Math.abs(parseFloat(this_number))));
		 real_number = "0.";
		 real_number = (((e_sign)?'':'-') + real_number);
		 for(j=1; j<Math.abs(parseFloat(e_number)); j++) {
		  real_number += '0';
		 }
		 real_number += this_number;
		 number = real_number;
		}
	   }
	  }
	  decimal = number.split(".");
	 }
	 
	 if(decimals == 0) {
	  number = Math.round(parseFloat(number));
	 }
	 
	 sign = (number == (number = Math.abs(number)));
	 number = Math.floor(number*100+0.50000000001);
	 number = Math.floor(number/100).toString();
	 for (var i = 0; i < Math.floor((number.length-(1+i))/3); i++)
	  number = number.substring(0,number.length-(4*i+3))+','+number.substring(number.length-(4*i+3));
	 number = (((sign)?'':'-') + number);
	 
	 /*
	 if(number == '-0') {
	  number = '0';
	 }
	 */
	 
	 //number = number.toString();
	 if(type == 'i' && decimals > 0) {
	  number += '.';
	  for(j=1; j<=decimals; j++) {
	   number += '0';
	  }
	 } else if(type == 'f' && decimals > 0) {
	  if(decimal[1].length == decimals) {
	   number += '.'+decimal[1];
	  } else if(decimal[1].length < decimals) {
	   number += '.'+decimal[1];
	   for(j=1; j<=decimals-decimal[1].length; j++) {
		number += '0';
	   }
	  } else if(decimal[1].length > decimals) {
	   //decimal_val() = eval(decimal[1]/Math.pow(10, decimal[1].length))+0.00000000001;
	   decimal_value = decimal[1].toString();
	   number_string = decimal_value.substring(0, (decimals)+1);
	   number_eval = parseFloat(number_string)/Math.pow(10, decimals-1);
	   number_eval = Math.round(number_eval);
	   if(number_eval == Math.pow(10, decimals)) {
		number_eval = 0;
	   }
	   if(number_eval.toString().length == 1) {
		number_eval = '0'+number_eval.toString();
	   }
	   if(number_eval.toString().length < decimals) {
		number_zero += '.'+number_eval.toString();
		for(j=1; j<=decimals-number_eval.toString().length; j++) {
		 number_zero += '0';
		}
		number += number_zero;
	   } else {
		number += '.'+number_eval.toString();
	   }
	  }
	 }
	 //objNumber.val(number)
	 return number;
	}	//	end fn number_format2

	function onfocus_format(objNumber) {
	 objNumber.val(objNumber.val().split(",").join(""));
	 objNumber.select();
	}	//	end fn onfocus_format
	
/*	trim แบบ javascript นะจ้ะ มะได้ใช้ เก็บไว้ดูเล่นจ้ะ
	function trim (str) {
		str = this != window? this : str;
		return str.replace(/^\s+/g, '').replace(/\s+$/g, '');
	}
*/
})(jQuery);