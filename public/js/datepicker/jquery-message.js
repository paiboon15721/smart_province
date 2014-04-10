// START FROM ajax-dynamic-content.js

var enableCache = true;
var jsCache = new Array();

var dynamicContent_ajaxObjects = new Array();

function ajax_showContent(divId,ajaxIndex,url)
{
	var targetObj = document.getElementById(divId);
	targetObj.innerHTML = dynamicContent_ajaxObjects[ajaxIndex].response;
	if(enableCache){
		jsCache[url] = 	dynamicContent_ajaxObjects[ajaxIndex].response;
	}
	dynamicContent_ajaxObjects[ajaxIndex] = false;
	
	ajax_parseJs(targetObj)
}

function ajax_loadContent(divId,url)
{
	if(enableCache && jsCache[url]){
		document.getElementById(divId).innerHTML = jsCache[url];
		return;
	}
	
	var ajaxIndex = dynamicContent_ajaxObjects.length;
	document.getElementById(divId).innerHTML = '<br><br><br><br><br><br><div align="center"><br>Now Loading....</div>';
	dynamicContent_ajaxObjects[ajaxIndex] = new sack();
	dynamicContent_ajaxObjects[ajaxIndex].requestFile = url;//Specifying which file to get
	dynamicContent_ajaxObjects[ajaxIndex].onCompletion = function(){ ajax_showContent(divId,ajaxIndex,url); };//Specify function that will be executed after file has been found
	dynamicContent_ajaxObjects[ajaxIndex].runAJAX();//Execute AJAX function	
	
	
}

function ajax_parseJs(obj)
{
	var scriptTags = obj.getElementsByTagName('SCRIPT');
	var string = '';
	var jsCode = '';
	for(var no=0;no<scriptTags.length;no++){	
		if(scriptTags[no].src){
	        var head = document.getElementsByTagName("head")[0];
	        var scriptObj = document.createElement("script");
	
	        scriptObj.setAttribute("type", "text/javascript");
	        scriptObj.setAttribute("src", scriptTags[no].src);  	
		}else{
			if(navigator.userAgent.indexOf('Opera')>=0){
				jsCode = jsCode + scriptTags[no].text + '\n';
			}
			else
				jsCode = jsCode + scriptTags[no].innerHTML;	
		}
		
	}

	if(jsCode)ajax_installScript(jsCode);
}

function ajax_installScript(script)
{		
    if (!script)
        return;		
    if (window.execScript){        	
    	window.execScript(script)
    }else if(window.jQuery && jQuery.browser.safari){//safari detection in jQuery
        window.setTimeout(script,0);
    }else{        	
        window.setTimeout( script, 0 );
    } 
}	
// END FROM ajax-dynamic-content.js	
	
// START FROM ajax.js
function sack(file) {
	this.xmlhttp = null;

	this.resetData = function() {
		this.method = "POST";
  		this.queryStringSeparator = "?";
		this.argumentSeparator = "&";
		this.URLString = "";
		this.encodeURIString = true;
  		this.execute = false;
  		this.element = null;
		this.elementObj = null;
		this.requestFile = file;
		this.vars = new Object();
		this.responseStatus = new Array(2);
  	};

	this.resetFunctions = function() {
  		this.onLoading = function() { };
  		this.onLoaded = function() { };
  		this.onInteractive = function() { };
  		this.onCompletion = function() { };
  		this.onError = function() { };
		this.onFail = function() { };
	};

	this.reset = function() {
		this.resetFunctions();
		this.resetData();
	};

	this.createAJAX = function() {
		try {
			this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e1) {
			try {
				this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e2) {
				this.xmlhttp = null;
			}
		}

		if (! this.xmlhttp) {
			if (typeof XMLHttpRequest != "undefined") {
				this.xmlhttp = new XMLHttpRequest();
			} else {
				this.failed = true;
			}
		}
	};

	this.setVar = function(name, value){
		this.vars[name] = Array(value, false);
	};

	this.encVar = function(name, value, returnvars) {
		if (true == returnvars) {
			return Array(encodeURIComponent(name), encodeURIComponent(value));
		} else {
			this.vars[encodeURIComponent(name)] = Array(encodeURIComponent(value), true);
		}
	}

	this.processURLString = function(string, encode) {
		encoded = encodeURIComponent(this.argumentSeparator);
		regexp = new RegExp(this.argumentSeparator + "|" + encoded);
		varArray = string.split(regexp);
		for (i = 0; i < varArray.length; i++){
			urlVars = varArray[i].split("=");
			if (true == encode){
				this.encVar(urlVars[0], urlVars[1]);
			} else {
				this.setVar(urlVars[0], urlVars[1]);
			}
		}
	}

	this.createURLString = function(urlstring) {
		if (this.encodeURIString && this.URLString.length) {
			this.processURLString(this.URLString, true);
		}

		if (urlstring) {
			if (this.URLString.length) {
				this.URLString += this.argumentSeparator + urlstring;
			} else {
				this.URLString = urlstring;
			}
		}

		// prevents caching of URLString
		this.setVar("rndval", new Date().getTime());

		urlstringtemp = new Array();
		for (key in this.vars) {
			if (false == this.vars[key][1] && true == this.encodeURIString) {
				encoded = this.encVar(key, this.vars[key][0], true);
				delete this.vars[key];
				this.vars[encoded[0]] = Array(encoded[1], true);
				key = encoded[0];
			}

			urlstringtemp[urlstringtemp.length] = key + "=" + this.vars[key][0];
		}
		if (urlstring){
			this.URLString += this.argumentSeparator + urlstringtemp.join(this.argumentSeparator);
		} else {
			this.URLString += urlstringtemp.join(this.argumentSeparator);
		}
	}

	this.runResponse = function() {
		eval(this.response);
	}

	this.runAJAX = function(urlstring) {
		if (this.failed) {
			this.onFail();
		} else {
			this.createURLString(urlstring);
			if (this.element) {
				this.elementObj = document.getElementById(this.element);
			}
			if (this.xmlhttp) {
				var self = this;
				if (this.method == "GET") {
					totalurlstring = this.requestFile + this.queryStringSeparator + this.URLString;
					this.xmlhttp.open(this.method, totalurlstring, true);
				} else {
					this.xmlhttp.open(this.method, this.requestFile, true);
					try {
						this.xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
					} catch (e) { }
				}

				this.xmlhttp.onreadystatechange = function() {
					switch (self.xmlhttp.readyState) {
						case 1:
							self.onLoading();
							break;
						case 2:
							self.onLoaded();
							break;
						case 3:
							self.onInteractive();
							break;
						case 4:
							self.response = self.xmlhttp.responseText;
							self.responseXML = self.xmlhttp.responseXML;
							self.responseStatus[0] = self.xmlhttp.status;
							self.responseStatus[1] = self.xmlhttp.statusText;

							if (self.execute) {
								self.runResponse();
							}

							if (self.elementObj) {
								elemNodeName = self.elementObj.nodeName;
								elemNodeName.toLowerCase();
								if (elemNodeName == "input"
								|| elemNodeName == "select"
								|| elemNodeName == "option"
								|| elemNodeName == "textarea") {
									self.elementObj.value = self.response;
								} else {
									self.elementObj.innerHTML = self.response;
								}
							}
							if (self.responseStatus[0] == "200") {
								self.onCompletion();
							} else {
								self.onError();
							}

							self.URLString = "";
							break;
					}
				};

				this.xmlhttp.send(this.URLString);
			}
		}
	};

	this.reset();
	this.createAJAX();
}
// END 


DHTML_modalMessage = function()
{
	var url;								// url of modal message
	var htmlOfModalMessage;					// html of modal message
	
	var divs_transparentDiv;				// Transparent div covering page content
	var divs_content;						// Modal message div.
	var iframe;								// Iframe used in ie
	var layoutCss;							// Name of css file;
	var width;								// Width of message box
	var height;								// Height of message box
	
	var existingBodyOverFlowStyle;			// Existing body overflow css
	var dynContentObj;						// Reference to dynamic content object
	var cssClassOfMessageBox;				// Alternative css class of message box - in case you want a different appearance on one of them
	var shadowDivVisible;					// Shadow div visible ? 
	var shadowOffset; 						// X and Y offset of shadow(pixels from content box)
	var MSIE;
		
	this.url = '';							// Default url is blank
	this.htmlOfModalMessage = '';			// Default message is blank
	this.layoutCss = 'modal-message.css';	// Default CSS file
	this.height = 200;						// Default height of modal message
	this.width = 400;						// Default width of modal message
	this.cssClassOfMessageBox = false;		// Default alternative css class for the message box
	this.shadowDivVisible = true;			// Shadow div is visible by default
	this.shadowOffset = 5;					// Default shadow offset.
	this.MSIE = false;
	if(navigator.userAgent.indexOf('MSIE')>=0) this.MSIE = true;
	

}

DHTML_modalMessage.prototype = {
	// {{{ setSource(urlOfSource)
    /**
     *	Set source of the modal dialog box
     * 	
     *
     * @public	
     */		
	setSource : function(urlOfSource)
	{
		this.url = urlOfSource;
		
	}	
	// }}}	
	,
	// {{{ setHtmlContent(newHtmlContent)
    /**
     *	Setting static HTML content for the modal dialog box.
     * 	
     *	@param String newHtmlContent = Static HTML content of box
     *
     * @public	
     */		
	setHtmlContent : function(newHtmlContent)
	{
		this.htmlOfModalMessage = newHtmlContent;
		
	}
	// }}}		
	,
	// {{{ setSize(width,height)
    /**
     *	Set the size of the modal dialog box
     * 	
     *	@param int width = width of box
     *	@param int height = height of box
     *
     * @public	
     */		
	setSize : function(width,height)
	{
		if(width)this.width = width;
		if(height)this.height = height;		
	}
	// }}}		
	,		
	// {{{ setCssClassMessageBox(newCssClass)
    /**
     *	Assign the message box to a new css class.(in case you wants a different appearance on one of them)
     * 	
     *	@param String newCssClass = Name of new css class (Pass false if you want to change back to default)
     *
     * @public	
     */		
	setCssClassMessageBox : function(newCssClass)
	{
		this.cssClassOfMessageBox = newCssClass;
		if(this.divs_content){
			if(this.cssClassOfMessageBox)
				this.divs_content.className=this.cssClassOfMessageBox;
			else
				this.divs_content.className='modalDialog_contentDiv';	
		}
					
	}
	// }}}		
	,	
	// {{{ setShadowOffset(newShadowOffset)
    /**
     *	Specify the size of shadow
     * 	
     *	@param Int newShadowOffset = Offset of shadow div(in pixels from message box - x and y)
     *
     * @public	
     */		
	setShadowOffset : function(newShadowOffset)
	{
		this.shadowOffset = newShadowOffset
					
	}
	// }}}		
	,	
	// {{{ display()
    /**
     *	Display the modal dialog box
     * 	
     *
     * @public	
     */		
	display : function()
	{
		if(!this.divs_transparentDiv){
			this.__createDivs();
		}	
		
		// Redisplaying divs
		this.divs_transparentDiv.style.display='block';
		this.divs_content.style.display='block';
		this.divs_shadow.style.display='block';		
		if(this.MSIE)this.iframe.style.display='block';	
		this.__resizeDivs();
		
		/* Call the __resizeDivs method twice in case the css file has changed. The first execution of this method may not catch these changes */
		window.refToThisModalBoxObj = this;		
		setTimeout('window.refToThisModalBoxObj.__resizeDivs()',150);
		
		this.__insertContent();	// Calling method which inserts content into the message div.
	}
	// }}}		
	,
	// {{{ ()
    /**
     *	Display the modal dialog box
     * 	
     *
     * @public	
     */		
	setShadowDivVisible : function(visible)
	{
		this.shadowDivVisible = visible;
	}
	// }}}	
	,
	// {{{ close()
    /**
     *	Close the modal dialog box
     * 	
     *
     * @public	
     */		
	close : function()
	{
		//document.documentElement.style.overflow = '';	// Setting the CSS overflow attribute of the <html> tag back to default.
		
		/* Hiding divs */
		this.divs_transparentDiv.style.display='none';
		this.divs_content.style.display='none';
		this.divs_shadow.style.display='none';
		if(this.MSIE)this.iframe.style.display='none';
		
	}	
	// }}}	
	,
	// {{{ __addEvent()
    /**
     *	Add event
     * 	
     *
     * @private	
     */		
	addEvent : function(whichObject,eventType,functionName,suffix)
	{ 
	  if(!suffix)suffix = '';
	  if(whichObject.attachEvent){ 
	    whichObject['e'+eventType+functionName+suffix] = functionName; 
	    whichObject[eventType+functionName+suffix] = function(){whichObject['e'+eventType+functionName+suffix]( window.event );} 
	    whichObject.attachEvent( 'on'+eventType, whichObject[eventType+functionName+suffix] ); 
	  } else 
	    whichObject.addEventListener(eventType,functionName,false); 	    
	} 
	// }}}	
	,
	// {{{ __createDivs()
    /**
     *	Create the divs for the modal dialog box
     * 	
     *
     * @private	
     */		
	__createDivs : function()
	{
		// Creating transparent div
		this.divs_transparentDiv = document.createElement('DIV');
		this.divs_transparentDiv.className='modalDialog_transparentDivs';
		this.divs_transparentDiv.style.left = '0px';
		this.divs_transparentDiv.style.top = '0px';
		
		document.body.appendChild(this.divs_transparentDiv);
		// Creating content div
		this.divs_content = document.createElement('DIV');
		this.divs_content.className = 'modalDialog_contentDiv';
		this.divs_content.id = 'DHTMLSuite_modalBox_contentDiv';
		this.divs_content.style.zIndex = 100000;
		
		if(this.MSIE){
			this.iframe = document.createElement('<IFRAME src="about:blank" frameborder=0>');
			this.iframe.style.zIndex = 90000;
			this.iframe.style.position = 'absolute';
			document.body.appendChild(this.iframe);	
		}
			
		document.body.appendChild(this.divs_content);
		// Creating shadow div
		this.divs_shadow = document.createElement('DIV');
		this.divs_shadow.className = 'modalDialog_contentDiv_shadow';
		this.divs_shadow.style.zIndex = 95000;
		document.body.appendChild(this.divs_shadow);
		window.refToModMessage = this;
		this.addEvent(window,'scroll',function(e){ window.refToModMessage.__repositionTransparentDiv() });
		this.addEvent(window,'resize',function(e){ window.refToModMessage.__repositionTransparentDiv() });
		

	}
	// }}}
	,
	// {{{ __getBrowserSize()
    /**
     *	Get browser size
     * 	
     *
     * @private	
     */		
	__getBrowserSize : function()
	{
    	var bodyWidth = document.documentElement.clientWidth;
    	var bodyHeight = document.documentElement.clientHeight;
    	
		var bodyWidth, bodyHeight; 
		if (self.innerHeight){ // all except Explorer 
		 
		   bodyWidth = self.innerWidth; 
		   bodyHeight = self.innerHeight; 
		}  else if (document.documentElement && document.documentElement.clientHeight) {
		   // Explorer 6 Strict Mode 		 
		   bodyWidth = document.documentElement.clientWidth; 
		   bodyHeight = document.documentElement.clientHeight; 
		} else if (document.body) {// other Explorers 		 
		   bodyWidth = document.body.clientWidth; 
		   bodyHeight = document.body.clientHeight; 
		} 
		return [bodyWidth,bodyHeight];		
		
	}
	// }}}	
	,
	// {{{ __resizeDivs()
    /**
     *	Resize the message divs
     * 	
     *
     * @private	
     */	
    __resizeDivs : function()
    {
    	
    	var topOffset = Math.max(document.body.scrollTop,document.documentElement.scrollTop);

		if(this.cssClassOfMessageBox)
			this.divs_content.className=this.cssClassOfMessageBox;
		else
			this.divs_content.className='modalDialog_contentDiv';	
			    	
    	if(!this.divs_transparentDiv)return;
    	
    	// Preserve scroll position
    	var st = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
    	var sl = Math.max(document.body.scrollLeft,document.documentElement.scrollLeft);
    	
    	window.scrollTo(sl,st);
    	setTimeout('window.scrollTo(' + sl + ',' + st + ');',10);

    	this.__repositionTransparentDiv();
    	

		var brSize = this.__getBrowserSize();
		var bodyWidth = brSize[0];
		var bodyHeight = brSize[1];
    	
    	// Setting width and height of content div
      	this.divs_content.style.width = this.width + 'px';
    	this.divs_content.style.height= this.height + 'px';  	
    	
    	// Creating temporary width variables since the actual width of the content div could be larger than this.width and this.height(i.e. padding and border)
    	var tmpWidth = this.divs_content.offsetWidth;	
    	var tmpHeight = this.divs_content.offsetHeight;
    	
    	
    	// Setting width and height of left transparent div
		
    	this.divs_content.style.left = Math.ceil((bodyWidth - tmpWidth) / 2) + 'px';;
    	this.divs_content.style.top = (Math.ceil((bodyHeight - tmpHeight) / 2) +  topOffset) + 'px';
    	
 		if(this.MSIE){
 			this.iframe.style.left = this.divs_content.style.left;
 			this.iframe.style.top = this.divs_content.style.top;
 			this.iframe.style.width = this.divs_content.style.width;
 			this.iframe.style.height = this.divs_content.style.height;
 		}
 		
    	this.divs_shadow.style.left = (this.divs_content.style.left.replace('px','')/1 + this.shadowOffset) + 'px';
    	this.divs_shadow.style.top = (this.divs_content.style.top.replace('px','')/1 + this.shadowOffset) + 'px';
    	this.divs_shadow.style.height = tmpHeight + 'px';
    	this.divs_shadow.style.width = tmpWidth + 'px';
    	
    	
    	
    	if(!this.shadowDivVisible)this.divs_shadow.style.display='none';	// Hiding shadow if it has been disabled
    	
    	
    }
    // }}}	
    ,
	// {{{ __insertContent()
    /**
     *	Insert content into the content div
     * 	
     *
     * @private	
     */	    
    __repositionTransparentDiv : function()
    {
    	this.divs_transparentDiv.style.top = Math.max(document.body.scrollTop,document.documentElement.scrollTop) + 'px';
    	this.divs_transparentDiv.style.left = Math.max(document.body.scrollLeft,document.documentElement.scrollLeft) + 'px';
		var brSize = this.__getBrowserSize();
		var bodyWidth = brSize[0];
		var bodyHeight = brSize[1];
    	this.divs_transparentDiv.style.width = bodyWidth + 'px';
    	this.divs_transparentDiv.style.height = bodyHeight + 'px';		
		   	
    }
	// }}}	
	,
	// {{{ __insertContent()
    /**
     *	Insert content into the content div
     * 	
     *
     * @private	
     */	
    __insertContent : function()
    {
		if(this.url){	// url specified - load content dynamically
			ajax_loadContent('DHTMLSuite_modalBox_contentDiv',this.url);
		}else{	// no url set, put static content inside the message box
			this.divs_content.innerHTML = this.htmlOfModalMessage;	
		}
    }		
}
