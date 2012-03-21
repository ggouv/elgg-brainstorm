<?php
/**
 * Brainstorm English language file
 */

$english = array(

	/**
	 * Menu items and titles
	 */
	
	'brainstorm:filter:top' => "Top",
	'brainstorm:filter:hot' => "Hot",
	'brainstorm:filter:new' => "New",
	'brainstorm:filter:accepted' => "Accepted",
	'brainstorm:filter:completed' => "Completed",
	
	'item:object:idea' => 'Idea',
	'river:create:object:idea' => '%s submited idea %s',
	'river:comment:object:idea' => '%s commented on a idea %s',
	'river:edit:object:idea' => '%s edited idea %s',
	'brainstorm:river:annotate' => 'a comment on this idea',
	'brainstorm:river:item' => 'an item',
	
	'brainstorm' => "Brainstorm",
	'brainstorm:add' => "Add idea",
	'brainstorm:edit' => "Edit idea",
	'brainstorm:new' => "A new idea",
	
	'brainstorm:owner' => "%s's brainstorming",
	'brainstorm:idea:edit' => "Edit this idea",
	'brainstorm:idea:add' => "Add an idea",
	
	'brainstorm:enablebrainstorm' => "Enable brainstorm.",
	'brainstorm:group' => 'Group brainstorming',
	'brainstorm:same_group' => "In the same group:",
	
	/**
	 * Content
	 */
	'brainstorm:yourvotes' => "Your votes:",
	'brainstorm:vote' => "Vote:",
	
	'brainstorm:status' => "Satus:",
	'brainstorm:state' => "State:",
	'brainstorm:status_info' => "Information about status:",
	'brainstorm:open' => 'open',
	'brainstorm:under review' => 'under review',
	'brainstorm:planned' => 'planned',
	'brainstorm:started' => 'started',
	'brainstorm:completed' => 'completed',
	'brainstorm:declined' => 'declined',
	
	'brainstorm:none' => "No idea.",
	'brainstorm:novoteleft' => "vote left.",
	'brainstorm:onevoteleft' => "vote left.",
	'brainstorm:votesleft' => "votes left.",
	
	'brainstorm:search' => "Search or submit an idea:",
	'brainstorm:charleft' => "char left.",
	'brainstorm:search:find' => "Ideas found. Vote or ",
	'brainstorm:search:none' => "No idea found. Search again or ",
	'brainstorm:add' => "submit a new idea",
	 
	/**
	 * Widget and bookmarklet
	 */
	'brainstorm:widget:title' => "Brainstorm",
	'brainstorm:widget:description' => "Display ratest ideas.",
	'brainstorm:more' => "More ideas",
	'brainstorm:numbertodisplay' => "Number of ideas to display",
	'brainstorm:typetodisplay' => "Display by",

	/**
	 * Status messages
	 */
	'brainstorm:idea:rate:submitted' => "Idea successfully rated.",
	'brainstorm:idea:save:success' => "Your idea was successfully saved.",
	'brainstorm:idea:delete:success' => "Your idea was successfully deleted.",
	'brainstorm:idea:delete:failed' => "An error occurred while deleting idea.",

	'brainstorm:idea:save:empty' => "You need to set a title and description of the idea.",
	'brainstorm:idea:save:failed' => "An error occurred while saving idea.",

	/**
	 * Error messages
	 */
	'brainstorm:idea:rate:error:ajax' => "Connexion error with server.",
	'brainstorm:unknown_idea' => "Unknown idea.",
	'brainstorm:idea:rate:error:value' => "Mistake on the value for rating this idea.",
	'brainstorm:idea:rate:error' => "This idea could not be rated cause internal server problem.",
	'brainstorm:idea:rate:error:underzero' => "Your votes left cannot premit to rate an idea.",
);

add_translation('en', $english);
