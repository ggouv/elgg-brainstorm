
// JS for Brainstorm plugin
elgg.provide('elgg.brainstorm');

elgg.brainstorm.init = function() {
	$('.idea-left-column .idea-rate-button').click(function() {
		var position = $(this).position();
		console.log(position);
	});
};
elgg.register_hook_handler('init', 'system', elgg.brainstorm.init);

/**
 * Reposition the vote-popup
 */
elgg.ui.votePopup = function(hook, type, params, options) {
	if (params.target.attr('id') == 'vote-popup') {
		options.my = 'left center';
		options.at = 'right center';
		options.offset = '13 0';
		return options;
	}
	return null;
};
elgg.register_hook_handler('getOptions', 'ui.popup', elgg.ui.votePopup);