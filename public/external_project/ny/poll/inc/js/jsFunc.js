// JavaScript Document
function closeWin(){
		var Browser = {	
			Version: function() {
			var version = 999; // we assume a sane browser
				if (navigator.appVersion.indexOf("MSIE") != -1)
					// bah, IE again, lets downgrade version number
					version = parseFloat(navigator.appVersion.split("MSIE")[1]);
					return version;
				}
		}
	
		if (Browser.Version() < 7) {
			window.opener = null;
			window.close();
		
		}else if (Browser.Version() >= 7){
			window.open('','_parent','');
			window.close();
		}else{
			window.open('', '_self', ''); 
			window.close();
		}
}