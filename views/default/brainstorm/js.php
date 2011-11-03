
// JS for Brainstorm plugin
elgg.provide('elgg.brainstorm');

elgg.brainstorm.init = function() {
	$('.idea-left-column .idea-rate-button').click(function() {
		var position = $(this).position();
		//console.log(position);
	});
	
	$('.elgg-form-brainstorm-vote-popup').submit(function() { return false; });
	$("#vote-popup .elgg-button").click(function() {
		if ($(this).parent("form").beenSubmitted) // Prevent double-click
			return false;
		else {
			$(this).parent("form").beenSubmitted = true;
			dataString = $('.elgg-form-brainstorm-vote-popup').serialize();
			//console.log(dataString);
			/*elgg.action('brainstorm/rateidea', {
				data: dataString,
				success: function(json) {
					TheResponse = json['output'].split(',');
					if (TheResponse[2])*/
		}
	});
	
};
elgg.register_hook_handler('init', 'system', elgg.brainstorm.init);

/**
 * Reposition the vote-popup
 */
elgg.ui.votePopup = function(hook, type, params, options) {
	$('.brainstorm-vote-popup').fadeOut();
	$('.idea-rate-button').not('#elgg-object-' + params.target.attr('id').split('-')[2] + ' .idea-rate-button').removeClass('elgg-state-active');
	if (params.target.attr('class') == 'elgg-module-popup brainstorm-vote-popup') {
		options.my = 'left center';
		options.at = 'right center';
		options.offset = '13 0';
		return options;
	}
	return null;
};
elgg.register_hook_handler('getOptions', 'ui.popup', elgg.ui.votePopup);

