<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>แผนที่จังหวัดนครนายก</title>
<?php 
//css include
//echo css_asset('main_smart_province.css'); 
echo css_asset('menu.css'); 
//js include
	echo js_asset('jquery-1.6.1.min.js');
	echo js_asset('menu/redist/when.js');
	echo js_asset('menu/core.js');
	echo js_asset('menu/graphics.js');
	echo js_asset('menu/mapimage.js');
	echo js_asset('menu/mapdata.js');
	echo js_asset('menu/areadata.js');
	echo js_asset('menu/areacorners.js');
	echo js_asset('menu/scale.js');
	echo js_asset('menu/tooltip.js');
	echo js_asset('menu/nakhonnayokJs.js');
?>
	</head>

	<body>
		<div id="map" style="width:1000px;">
			<div style="width:800px; border:0; overflow: hidden; float:left;">
				<!--<img id="map_image" src="<?php echo $mapPath; ?>" usemap="#map" >-->
				 <?php echo image_asset('menu.png',null,array('id'=>"map_image",'usemap'=>"#map")); ?>
			</div>
			<div style="padding-top: 14px;">
				<div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 572px; overflow-y: scroll;  background-color:#b0c4de;"></div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {

				var $statelist, $map, default_options = {
					fillOpacity : 0.2,
					render_highlight : {
						fillColor : '2aff00',
						stroke : true
					},
					render_select : {
						fillColor : 'ff000c',
						stroke : false
					},
					mouseoutDelay : 0,
					fadeInterval : 50,
					isSelectable : true,
					singleSelect : false,
					mapKey : 'state',
					mapValue : 'full',
					listKey : 'name',
					listSelectedAttribute : 'checked',
					sortList : "asc",
					onGetList : addCheckBoxes,
					onClick : function(e) {
						styleCheckbox(e.selected, e.listTarget);
						if (!utils.isScrolledIntoView(e.listTarget, false, $statelist)) {
							utils.centerOn($statelist, e.listTarget);
						}
						window.location = linkAction(e.key);
						return true;
					},
					showToolTip : false,
					toolTipClose : ["area-mouseout"]
				};

				function styleCheckbox(selected, $checkbox) {
					var nowWeight = selected ? "bold" : "normal";
					$checkbox.closest('div').css("font-weight", nowWeight);
				}

				function addCheckBoxes(items) {
					var item, selected;
					$statelist.children().remove();
					for (var i = 0; i < items.length; i++) {
						selected = items[i].isSelected();
						item = $('<div><input type="checkbox" name="' + items[i].key + '"' + ( selected ? "checked" : "") + '><span style="cursor:pointer;"  class="sel" key="' + items[i].key + '">' + items[i].value + '</span></div>');

						$statelist.append(item);
					}
					$statelist.find('span.sel').unbind('click').bind('click', function(e) {
						var key = $(this).attr('key');
						$map.mapster('set', true, key);
						styleCheckbox(true, $(this));
						window.location = linkAction(key);
					});

					$statelist.find('span.sel').unbind('mouseover').bind('mouseover', function(e) {
						var key = $(this).attr('key');
						$(this).closest('div').css("font-weight", "bold");
						$map.mapster('highlight',key,true);
					});

					$statelist.find('span.sel').unbind('mouseout').bind('mouseout', function(e) {
						var key = $(this).attr('key');
						$(this).closest('div').css("font-weight", "normal");
						$map.mapster('highlight',false);
					});
					// return the list to mapster so it can bind to it
					return $statelist.find('input[type="checkbox"]').unbind('click').click(function(e) {
						var selected = $(this).is(':checked');
						$map.mapster('set', selected, $(this).attr('name'));
						styleCheckbox(selected, $(this));
						 window.location = linkAction(this.name);
					});
				}

				$statelist = $('#statelist');
				$map = $('#map_image');


				$map.mapster(default_options);

			});

			// Utility functions
			// If you are copying code you probably won't need these.

			var utils = {};
			// Tells if an element is completely visible. if the 2nd parm is true, it only looks at the top.

			utils.isScrolledIntoView = function(elem, topOnly, container) {
				var useWindow = false, docViewTop, docViewBottom, elemTop, elemBottom;

				if (!container) {
					container = window;
					useWindow = true;
				}

				if (useWindow) {
					docViewTop = $(container).scrollTop();
					elemTop = elem.offset().top;
				} else {
					docViewTop = 0;
					elemTop = elem.position().top;
				}
				docViewBottom = docViewTop + $(container).height();
				elemBottom = elemTop + elem.height();

				if (topOnly) {
					return elemTop >= docViewTop && elemTop <= docViewBottom;
				} else {
					return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
				}
			};

			utils.centerOn = function($container, $element) {
				$container.animate({
					scrollTop : $element.position().top - ($container.height() / 2)
				}, 'slow');
			};

		</script>
		<div id="someid"></div>
			<map id="image_map" name="map">
						<area href="#" state="KK" full="หมู่เกาะกา" shape="poly" coords="483,180,488,180,493,181,499,183,503,187,508,190,511,190,514,191,518,194,523,200,525,203,528,211,530,214,533,218,536,220,536,223,537,230,540,232,541,239,544,243,544,247,544,252,546,258,546,262,543,267,543,269,537,273,531,273,529,273,522,273,519,274,516,275,510,277,508,278,504,279,496,279,490,280,484,280,477,279,473,278,470,275,469,272,464,270,462,270,457,270,453,272,452,276,454,283,453,287,453,290,454,294,454,296,453,301,453,303,453,307,453,309,452,312,448,315,446,318,443,318,438,318,435,319,430,323,428,325,423,331,419,334,416,335,413,337,406,341,402,342,399,346,394,351,390,353,388,355,387,363,387,366,388,371,391,374,392,376,395,378,396,386,398,392,403,399,406,403,408,408,410,411,411,415,410,418,408,419,405,421,404,425,401,428,397,427,394,426,390,427,388,429,381,428,378,425,373,424,369,424,365,425,361,427,358,429,353,428,347,428,341,428,338,430,334,430,329,431,323,434,321,435,317,430,313,428,310,425,309,421,305,417,304,412,305,407,306,404,307,398,311,395,314,395,318,392,321,390,322,387,322,381,322,375,320,372,320,369,320,366,320,360,322,357,326,354,333,351,334,344,336,339,340,335,344,332,349,332,352,329,361,327,368,327,376,325,379,324,384,321,388,313,394,305,395,301,397,296,401,292,402,289,406,287,408,283,408,281,413,281,420,278,422,273,423,270,426,266,427,260,423,256,420,249,415,244,414,240,410,238,405,235,404,234,408,229,408,223,412,217,413,213,413,210,414,208,420,206,424,206,430,206,432,208,433,210,434,212,438,214,441,212,443,210,447,207,454,204,464,200,471,199,475,196,479,192,480,191,481,184,481,181" />
						<!-- อ หมู่เกาะกา -->
						<area href="#" state="WT" full="หมู่บ้านวังตูม" shape="poly" coords="306,212,309,204,313,200,320,199,325,199,327,196,327,193,326,189,324,187,324,182,322,178,322,173,326,171,328,168,328,163,328,160,326,155,327,152,329,149,332,148,334,150,336,152,338,151,339,149,339,147,338,144,340,144,343,140,345,138,344,133,342,132,338,129,338,125,338,122,345,122,347,122,349,121,351,119,355,118,356,115,355,111,355,109,359,107,361,103,363,102,365,101,368,97,370,94,372,93,376,93,378,94,379,96,380,98,380,101,385,102,387,102,390,102,394,102,396,102,398,102,399,104,400,106,400,110,402,113,406,114,409,117,412,119,414,121,417,124,421,128,424,129,426,132,429,133,433,136,437,136,439,140,442,142,445,143,450,143,451,147,454,151,456,154,459,156,463,160,463,163,467,166,470,169,474,174,476,176,478,179,481,179,483,181,481,187,480,190,478,193,477,194,474,196,472,199,469,199,463,200,461,202,456,203,452,204,449,206,446,208,445,210,443,211,439,213,437,212,433,208,432,207,428,207,422,207,419,207,413,210,413,212,413,214,413,216,411,219,411,221,408,226,408,230,406,236,408,237,412,238,415,239,416,245,417,248,420,251,421,253,422,256,424,258,426,261,426,264,425,268,423,271,423,275,421,278,417,279,414,281,412,281,408,281,407,285,405,289,403,293,401,293,399,298,395,302,394,306,389,311,386,316,386,319,383,322,380,322,377,325,373,326,370,326,364,327,361,327,354,329,349,331,346,332,344,332,338,340,334,348,333,349,329,353,323,355,321,358,319,362,319,368,320,374,322,378,322,383,321,389,320,392,318,394,314,397,310,397,307,400,307,404,306,407,305,411,305,417,307,422,309,423,311,426,314,427,319,430,319,434,320,435,321,445,320,448,320,457,314,458,311,463,306,463,302,462,299,462,296,462,293,459,288,458,283,460,279,459,278,456,275,451,274,448,272,445,271,443,268,439,266,437,261,434,259,433,253,429,252,426,251,422,252,419,254,412,255,409,255,404,253,401,251,397,246,395,243,392,242,389,241,386,239,382,237,379,236,377,232,374,230,371,227,369,225,366,222,362,220,361,228,359,232,357,237,354,241,353,243,353,243,351,243,349,242,345,242,342,242,339,242,338,242,336,244,333,246,328,252,326,256,326,258,324,263,321,267,318,268,316,269,312,269,309,268,304,268,301,266,298,264,296,263,291,263,286,265,283,267,281,270,278,273,276,275,274,277,273,281,271,283,269,284,262,285,259,285,256,285,250,285,246,284,244,284,243,282,238,282,230,282,227,283,224,284,222,287,220,289,216,294,215,297,214,299,214,300,214" />
						<!-- ต หมู่บ้านวังตูม -->
						<area href="#" state="J" full="หมู่บ้านเจ๊ก" shape="poly" coords="170,247,166,248,165,251,165,252,161,253,160,253,156,252,155,251,151,249,148,246,144,246,142,245,139,245,136,247,134,250,134,253,133,257,133,260,135,264,136,267,136,270,135,274,135,277,134,282,133,285,133,289,133,293,134,294,137,294,143,293,146,293,153,294,157,299,159,301,160,305,162,308,165,309,167,313,167,318,168,321,169,327,172,329,174,333,177,335,180,338,187,341,191,347,194,350,197,352,200,356,201,359,204,362,209,366,210,369,211,369,214,367,218,365,222,363,225,362,228,359,235,357,236,355,241,353,244,353,242,347,242,342,243,337,243,332,246,329,249,328,254,328,260,325,265,321,267,318,269,315,269,310,269,307,269,303,268,300,266,295,265,293,264,288,264,286,266,283,270,278,275,274,278,273,282,271,282,267,284,262,285,257,285,251,285,249,284,244,284,241,283,235,281,228,285,224,287,220,289,219,288,215,288,212,286,208,285,202,283,199,281,195,275,193,270,193,264,192,263,190,262,186,258,187,252,186,250,186,243,186,237,187,233,187,230,185,228,183,227,179,224,176,222,170,221,169,220,166,219,163,216,162,213,162,211,163,210,166,212,168,212,171,212,174,212,177,213,182,215,187,215,189,215,196,215,198,215,203,213,205,212,208,212,212,209,215,206,222,205,224,203,226,201,229,197,231,194,232,191,234,188,239,188,241,188,243,185,244,181,244,174,245,171,246" />
						<!-- ต หมู่บ้านเจ๊ก -->
						<area href="#" state="KW" full="หมู่เกาะวัด" shape="poly" coords="297,463,296,468,290,469,287,469,280,470,277,473,276,476,277,481,277,486,274,491,269,490,262,491,256,491,249,492,237,491,237,488,226,488,221,487,216,488,204,487,199,489,191,490,182,490,170,490,164,490,155,491,147,491,143,493,137,493,129,493,121,494,114,494,107,495,108,482,108,473,108,459,109,449,108,439,108,432,109,383,109,372,109,366,109,358,110,350,110,343,110,339,110,334,110,331,108,325,109,320,109,312,109,308,108,305,129,296,134,294,137,294,143,294,147,293,151,293,154,295,158,297,158,300,161,304,164,308,165,311,166,314,168,322,169,327,172,328,174,329,175,334,179,337,180,339,183,339,188,342,191,347,192,351,195,353,198,354,198,356,202,363,207,367,211,368,217,367,219,364,223,363,228,370,234,374,238,376,240,380,241,386,241,387,242,391,244,394,248,395,252,398,253,401,254,406,255,409,254,414,254,417,253,420,253,426,255,429,256,430,260,431,264,434,271,439,272,443,274,447,275,451,277,455,279,459,284,460,287,458,290,458,293,459,296,461" />
						<!-- ต หมู่เกาะวัด -->
						<area href="#" state="KK" full="หมู่เกาะกา" shape="rect" coords="544,379,757,424" href="#" /><!-- หมู่เกาะกา -->
						<area href="#" state="WT" full="หมู่บ้านวังตูม" shape="rect" coords="544,325,738,376" href="#" /><!-- หมู่บ้านวังตูม -->
						<area href="#" state="J" full="หมู่บ้านเจ๊ก" shape="rect" coords="544,274,703,319" href="#" /><!-- หมู่บ้านเจ๊ก -->
						<area href="#" state="KW" full="หมู่เกาะวัด" shape="rect" coords="544,433,757,478" href="#" /><!-- หมู่เกาะวัด -->
			</map>
	</body>
</html>