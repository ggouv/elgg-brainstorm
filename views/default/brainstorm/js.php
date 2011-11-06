
// JS for Brainstorm plugin
elgg.provide('elgg.brainstorm');

elgg.brainstorm.init = function() {

	$('.idea-rate-button').click(function() {
		$('.brainstorm-vote-popup').fadeOut(); // hide all other popup
		$('.idea-rate-button').not(this).removeClass('elgg-state-active');
	});
	
	//$('.elgg-form-brainstorm-vote-popup').submit(function() { return false; });
	$('.elgg-form-brainstorm-vote-popup .elgg-button').click(function() {
		if ($.data(this, 'clicked') || $(this).hasClass('checked')) // Prevent double-click
			return false;
		else {
			$.data(this, 'clicked', true);
			thisVote = this;
			idea = $(this).parents('.brainstorm-vote-popup').attr('id').split('-')[2];
			$('#elgg-object-' + idea + ' .idea-points').html('<div class="elgg-ajax-loader"></div>');
			value = $(this).val();
			dataString = $(this).parents('form').serialize() + '&idea=' + idea + '&value=' + value;
			elgg.action('brainstorm/rateidea', {
				data: dataString,
				success: function(json) {
					$('.brainstorm-vote-popup').fadeOut(function(){
						$('#elgg-object-' + idea + ' .idea-points').html(json.output.sum);
						if (value == 0) {
							$('#elgg-object-' + idea + ' .idea-rate-button').html('vote');
							$('#vote-popup-' + idea + ' .rate-0').addClass('hidden');
						} else {
							$('#elgg-object-' + idea + ' .idea-rate-button').html(value);
							$('#vote-popup-' + idea + ' .elgg-button').removeClass('hidden');
						}
						$('#elgg-object-' + idea + ' .idea-rate-button').removeClass().addClass('idea-rate-button idea-value-'+value);
						
						$('#vote-popup-' + idea + ' .elgg-button').removeClass('checked');
						$('#vote-popup-' + idea + ' .rate-' + value).addClass('checked');
					});
					$.data(thisVote, 'clicked', false);
				}
			});
		}
		
	});
	
};
elgg.register_hook_handler('init', 'system', elgg.brainstorm.init);

/**
 * Reposition the vote-popup
 */
elgg.ui.votePopup = function(hook, type, params, options) {
	if (params.target.attr('class') == 'elgg-module-popup brainstorm-vote-popup') {
		options.my = 'left center';
		options.at = 'right center';
		options.offset = '13 0';
		return options;
	}
	return null;
};
elgg.register_hook_handler('getOptions', 'ui.popup', elgg.ui.votePopup);

