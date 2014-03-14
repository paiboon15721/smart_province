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
			window.location = e.key;
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
			window.location = key;
		});

		$statelist.find('span.sel').unbind('mouseover').bind('mouseover', function(e) {
			var key = $(this).attr('key');
			$(this).closest('div').css("font-weight", "bold");
			$map.mapster('highlight', key, true);
		});

		$statelist.find('span.sel').unbind('mouseout').bind('mouseout', function(e) {
			var key = $(this).attr('key');
			$(this).closest('div').css("font-weight", "normal");
			$map.mapster('highlight', false);
		});
		// return the list to mapster so it can bind to it
		return $statelist.find('input[type="checkbox"]').unbind('click').click(function(e) {
			var selected = $(this).is(':checked');
			$map.mapster('set', selected, $(this).attr('name'));
			styleCheckbox(selected, $(this));
			window.location = this.name;
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