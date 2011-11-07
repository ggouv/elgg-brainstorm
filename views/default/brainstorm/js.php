
// JS for Brainstorm plugin
elgg.provide('elgg.brainstorm');

elgg.brainstorm.init = function() {

	$('.idea-rate-button').click(function() {
		$('.brainstorm-vote-popup').fadeOut(); // hide all other popup

		ideaClass = $(this).attr('class');
		points = ideaClass.substr(ideaClass.length - 1);
		if ( points == 'e' ) points = '0';	
		popup = $('#vote-popup-' + $(this).parents('.elgg-item-idea').attr('id').split('-')[2] );
		
		popup.find('.elgg-button').removeClass('checked hidden');
		popup.find('.elgg-button[value='+points+']').addClass('checked');
		if ( points == '0' ) popup.find('.elgg-button:first').addClass('hidden');
		UserVoteLeft = $('#votesLeft strong').html();
		if ( UserVoteLeft == '2' && points == '0' || UserVoteLeft == '1' && points <= '1' || UserVoteLeft == '0' && points <= '2' ) popup.find('.elgg-button:last').addClass('hidden');
		if ( UserVoteLeft == '1' && points == '0' || UserVoteLeft == '0' && points <= '1' ) popup.find('.elgg-button[value=2]').addClass('hidden');
		if ( UserVoteLeft == '0' && points == '0' ) popup.find('.elgg-button[value=1]').addClass('hidden');

		$('.idea-rate-button').not(this).removeClass('elgg-state-active');
	});
	
	$('.elgg-form-brainstorm-vote-popup .elgg-button').click(function() {
		if ($.data(this, 'clicked') || $(this).hasClass('checked')) // Prevent double-click
			return false;
		else {
			$.data(this, 'clicked', true);
			thisVote = this;
			value = $(this).val();
			idea = $(this).parents('.brainstorm-vote-popup').attr('id').split('-')[2];
			ideaURL = $('#elgg-object-' + idea + ' .idea-content h3 a').attr('href');
			ideaTitle = $('#elgg-object-' + idea + ' .idea-content h3 a').html();
			
			$('#elgg-object-' + idea + ' .idea-points').html('<div class="elgg-ajax-loader"></div>');
			
			dataString = $(this).parents('form').serialize() + '&idea=' + idea + '&value=' + value + '&page_owner=' + elgg.get_page_owner_guid();
			elgg.action('brainstorm/rateidea', {
				data: dataString,
				success: function(json) {
					$('.brainstorm-vote-popup').fadeOut();
					
					if ( !json.output.errorRate ) {			
						$('#elgg-object-' + idea + ' .idea-points').html(json.output.sum);
						
						if ( value == '0' ) {
							$('#elgg-object-' + idea + ' .idea-rate-button').html('vote');
							$('.sidebar-idea-list #elgg-object-' + idea).fadeOut().remove()
						} else {
							$('#elgg-object-' + idea + ' .idea-rate-button').html(value);
							if ( !$('.sidebar-idea-list #elgg-object-' + idea).length ) {
								liStart = '<li class="elgg-item elgg-item-idea" id="elgg-object-'+idea+'">';
								h3 = '<h3><a href="'+ideaURL+'">'+ideaTitle+'</a></h3>';
								$('.sidebar-idea-list').prepend(liStart + '<div></div>' + h3 + '</li>');
							}
							$('.sidebar-idea-list #elgg-object-' + idea + ' > div').html(value).removeClass().addClass('mrs idea-value-'+value);							
						}
						
						if ( !json.output.userVoteLeft == '0' && value == '0' ) {
							$('#elgg-object-' + idea + ' .idea-rate-button').removeClass().addClass('idea-rate-button idea-value-vote');
						} else {
							$('#elgg-object-' + idea + ' .idea-rate-button').removeClass().addClass('idea-rate-button idea-value-'+value);
						}
						
						if ( json.output.userVoteLeft == '0' ) {
							$('.idea-value-vote').removeClass('idea-value-vote').addClass('idea-value-0');
							VoteString = "<strong>0</strong> " + elgg.echo('brainstorm:novoteleft');
						} else if ( json.output.userVoteLeft == '1' ) {
							$('.idea-value-0').removeClass('idea-value-0').addClass('idea-value-vote');
							VoteString = "<strong>1</strong> " + elgg.echo('brainstorm:onevoteleft');
						} else {
							$('.idea-value-0').removeClass('idea-value-0').addClass('idea-value-vote');
							VoteString = "<strong>" + json.output.userVoteLeft + "</strong> " + elgg.echo('brainstorm:votesleft');
						}
						$('#votesLeft').removeClass('zero').html(VoteString);
						if ( json.output.userVoteLeft == '0' ) $('#votesLeft').addClass('zero');
					}
					
					$.data(thisVote, 'clicked', false);
				},
				error: function(){ elgg.system_message(elgg.echo('brainstorm:idea:rate:error:ajax')); }
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

