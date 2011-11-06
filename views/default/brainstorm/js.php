
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
			ideaURL = $('#elgg-object-' + idea + ' .idea-content h3 a').attr('href');
			ideaTitle = $('#elgg-object-' + idea + ' .idea-content h3 a').html();
			$('#elgg-object-' + idea + ' .idea-points').html('<div class="elgg-ajax-loader"></div>');
			value = $(this).val();
			dataString = $(this).parents('form').serialize() + '&idea=' + idea + '&value=' + value + '&page_owner=' + elgg.get_page_owner_guid();
			elgg.action('brainstorm/rateidea', {
				data: dataString,
				success: function(json) {
					$('.brainstorm-vote-popup').fadeOut(function(){
						$('#elgg-object-' + idea + ' .idea-points').html(json.output.sum);
						if (value == 0) {
							$('#elgg-object-' + idea + ' .idea-rate-button').html('vote');
							$('#vote-popup-' + idea + ' .rate-0').addClass('hidden');
							$('.sidebar-idea-list #elgg-object-' + idea).fadeOut().remove()
						} else {
							$('#elgg-object-' + idea + ' .idea-rate-button').html(value);
							$('#vote-popup-' + idea + ' .elgg-button').removeClass('hidden');
							if ( !$('.sidebar-idea-list #elgg-object-' + idea).length ) {
								liStart = '<li class="elgg-item elgg-item-idea" id="elgg-object-'+idea+'">';
								h3 = '<h3><a href="'+ideaURL+'">'+ideaTitle+'</a></h3>';
								$('.sidebar-idea-list').prepend(liStart + '<div></div>' + h3 + '</li>');
							}
							$('.sidebar-idea-list #elgg-object-' + idea + ' > div').html(value).removeClass().addClass('mrs idea-value-'+value);							
						}
						$('#elgg-object-' + idea + ' .idea-rate-button').removeClass().addClass('idea-rate-button idea-value-'+value);
						
						$('#votesLeft strong').html(json.output.userVoteLeft);
						
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

