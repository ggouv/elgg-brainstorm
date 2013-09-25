
// JS for Brainstorm plugin
elgg.provide('elgg.brainstorm');

elgg.brainstorm.init = function() {
	var timeout;

	$("#brainstorm-textarea").keypress(function(e) {
		if ( $(this).val().length > 140 && e.which != 8 || e.which == 13) return false;
		elgg.brainstorm.textCounter(this, $("#brainstorm-characters-remaining span"), 140);
		var search_input = $(this).val();
		var search_container = $('#brainstorm-search-response');

		if (search_input.length > 3) {
			if (timeout) {
				clearTimeout(timeout);
				timeout = null;
			}

			timeout = setTimeout(function() {
				search_input = $("#brainstorm-textarea").val();
				if (search_input.length > 3) { // @todo check why need to do it again ?
					$.ajax({
						type: "GET",
						url: elgg.config.wwwroot + 'mod/elgg-brainstorm/views/default/brainstorm/search.php',
						data: 'group=' + elgg.get_page_owner_guid() + '&keyword=' + $("#brainstorm-textarea").val() + '&point=' + $('#votesLeft strong').text(),
						beforeSend:  function() {
							$('#brainstorm-characters-remaining').addClass('loading');
						},
						success: function(response) {
							clearTimeout(timeout);
							$('.elgg-page .elgg-menu-filter-default, .brainstorm-list').hide();
							if ( search_container.is(':hidden') ) {
								search_container.css('opacity', 0).html(response).fadeTo('slow', 1);
							} else {
								search_container.html(response);
							}
							$('#brainstorm-characters-remaining').removeClass("loading");
							rateButton();
							$('body').click('click', function() {$('.brainstorm-vote-popup').fadeOut();});
						}
					});
				}
			}, 500);
		} else if ( $('.brainstorm-list').css('opacity') != '1' || $('.brainstorm-list').is(":hidden") ) {
			search_container.hide().html('');
			$('.elgg-page .elgg-menu-filter-default, .brainstorm-list').css('opacity', 0).fadeTo('slow', 1);
		}
	});

	var rateButton = function() {
		$('.idea-rate-button').click(function() {
			$('.brainstorm-vote-popup').fadeOut(); // hide all other popup

			var ideaClass = $(this).attr('class');
			var points = ideaClass.substr(ideaClass.length - 1);
			if ( points == 'e' ) points = '0';
			var popup = $('#vote-popup-' + $(this).parents('.elgg-item-idea').attr('id').split('-')[2] );

			popup.find('.elgg-button').removeClass('checked hidden');
			popup.find('.elgg-button[value='+points+']').addClass('checked');
			if ( points == '0' ) popup.find('.elgg-button:first').addClass('hidden');
			var UserVoteLeft = $('#votesLeft strong').text();
			if ( UserVoteLeft == '2' && points == '0' || UserVoteLeft == '1' && points <= '1' || UserVoteLeft <= '0' && points <= '2' ) popup.find('.elgg-button:last').addClass('hidden');
			if ( UserVoteLeft == '1' && points == '0' || UserVoteLeft <= '0' && points <= '1' ) popup.find('.elgg-button[value=2]').addClass('hidden');
			if ( UserVoteLeft == '0' && points <= '0' ) popup.find('.elgg-button[value=1]').addClass('hidden');

			$('.idea-rate-button').not(this).removeClass('elgg-state-active');
		});
	}
	rateButton();

	$('.elgg-form-brainstorm-vote-popup .elgg-button').live('click', function() {
		if ($.data(this, 'clicked') || $(this).hasClass('checked')) // Prevent double-click
			return false;
		else {
			$.data(this, 'clicked', true);
			var thisVote = this,
				value = $(this).val(),
				idea = $(this).parents('.brainstorm-vote-popup').attr('id').split('-')[2],
				ideaURL = $('#elgg-object-' + idea + ' .idea-content h3 a').attr('href'),
				ideaTitle = $('#elgg-object-' + idea + ' .idea-content h3 a').html();
			if ( ideaTitle == null ) ideaTitle = $('.elgg-body h2').html();

			var old_points = $('#elgg-object-' + idea + ' .idea-points').text();
			$('#elgg-object-' + idea + ' .idea-points').html('<div class="elgg-ajax-loader"></div>');

			elgg.action('brainstorm/rateidea', {
				data: $(this).parents('form').serialize() + '&idea=' + idea + '&value=' + value + '&group_guid=' + elgg.get_page_owner_guid(),
				success: function(json) {
					$('.brainstorm-vote-popup').fadeOut();

					if ( !json.output.errorRate ) {
						var ideaRateButton = $('#elgg-object-' + idea + ' .idea-rate-button'),
							sidebarIdea = $('.sidebar-idea-list #elgg-object-' + idea);

						$('#elgg-object-' + idea + ' .idea-points').html(json.output.sum);

						if ( value == '0' ) {
							ideaRateButton.html('vote');
							sidebarIdea.fadeOut().remove()
						} else {
							ideaRateButton.html(value);
							if ( !sidebarIdea.length ) {
								$('.sidebar-idea-list').prepend(
									$('<li>', {id: 'elgg-object-'+idea, 'class': 'elgg-item elgg-item-idea'}).append(
										$('<div>', {'class': 'mrs idea-value-'+value}).html(value),
										$('<h3>').append($('<a>', {href: ideaURL}).html(ideaTitle))
									)
								);
							} else {
								sidebarIdea.children('div').html(value)
									.attr('class', function(){return $(this)[0].className.replace(/idea-value-.* \b/g, 'idea-value-'+value+' ')});
							}
						}

						if ( !json.output.userPointsLeft == '0' && value == '0' ) {
							ideaRateButton.removeClass().addClass('idea-rate-button idea-value-vote');
						} else {
							ideaRateButton.removeClass().addClass('idea-rate-button idea-value-'+value);
						}

						if ( json.output.userPointsLeft == '0' ) {
							$('.idea-value-vote').removeClass('idea-value-vote').addClass('idea-value-0');
							var VoteString = "<strong>0</strong> " + elgg.echo('brainstorm:novoteleft');
						} else if ( json.output.userPointsLeft == '1' ) {
							$('.idea-value-0').removeClass('idea-value-0').addClass('idea-value-vote');
							var VoteString = "<strong>1</strong> " + elgg.echo('brainstorm:onevoteleft');
						} else {
							$('.idea-value-0').removeClass('idea-value-0').addClass('idea-value-vote');
							var VoteString = "<strong>" + json.output.userPointsLeft + "</strong> " + elgg.echo('brainstorm:votesleft');
						}
						$('#votesLeft').removeClass('zero').html(VoteString);
						if ( json.output.userPointsLeft == '0' ) $('#votesLeft').addClass('zero');
					} else {
						$('#elgg-object-' + idea + ' .idea-points').html(old_points);
					}

					$.data(thisVote, 'clicked', false);
				},
				error: function(){
					elgg.system_message(elgg.echo('brainstorm:idea:rate:error:ajax'));
					$('#elgg-object-' + idea + ' .idea-points').html(old_points);
				}
			});
		}

	});

};
elgg.register_hook_handler('init', 'system', elgg.brainstorm.init);

/**
 * Update the number of characters left with every keystroke
 *
 * @param {Object}  textarea
 * @param {Object}  status
 * @param {integer} limit
 * @return void
 */
elgg.brainstorm.textCounter = function(textarea, status, limit) {

	var remaining_chars = limit - $(textarea).val().length;
	status.html(remaining_chars);

	if (remaining_chars < 0) {
		status.parent().css("color", "#D40D12");
	} else {
		status.parent().css("color", "");
	}
}


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
	return options;
};
elgg.register_hook_handler('getOptions', 'ui.popup', elgg.ui.votePopup);

