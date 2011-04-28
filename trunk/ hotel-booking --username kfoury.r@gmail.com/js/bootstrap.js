$(document).ready(function() {

	$("#countrySelect select").change(function() {
		if ($(this).attr('value') == '') {
			$("#locationSelect").hide();
			return;
		}
		$.get('/actions/listLocations.php', 'countryid='+$(this).attr('value'), function(data) {
			$("#locationSelect .rightitem").html(data);
			$("#locationSelect").show();
		});
	});
	
	$("#searchDestination").focus(function() {
		if ($(this).attr('value') == $(this).attr('originalValue')) {
			$(this).attr('value','');
			$(this).removeClass('defaultValue');
		}
	});
	
	var cache = {}, lastXhr;
	$( "#searchDestination" ).autocomplete({
		minLength: 2,
		source: function( request, response ) {
			var term = request.term;
			if ( term in cache ) {
				response( cache[ term ] );
				return;
			}

			lastXhr = $.getJSON( "/ajax/searchLocation.php", request, function( data, status, xhr ) {
				cache[ term ] = data;
				if ( xhr === lastXhr ) {
					response( data );
				}
			});
		},
		select: function( event, ui ) {
			$("#locationid").attr('value',ui.item.id);
		}
	});
	
	$(".datepicker").datepicker({ minDate: 0, maxDate: "+1Y", dateFormat: "yy-mm-dd" });

	$(".button").hover(function() {
		$(this).attr('style', 'background-color: #cae5fc');
	}, function() {
		$(this).attr('style', 'background-color: white');
	});
	
	$(".searchresult_row").hover(function() {
		$(this).attr('style', 'background-color: #b4dbfd');
	}, function() {
		$(this).attr('style', 'background-color: #dff0ff');
	});
});