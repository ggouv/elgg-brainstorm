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
	'brainstorm:settings' => "Settings",
	
	'brainstorm:all' => "All ideas",
	'brainstorm:owner' => "%s's ideas",
	'brainstorm:friends' => "Friends ideas",
	'brainstorm:idea:edit' => "Edit this idea",
	'brainstorm:idea:add' => "Add an idea",
	
	'brainstorm:group:settings:title' => "Settings of %s's brainstorm",
	'brainstorm:group_settings' => "Settings",
	'brainstorm:enablebrainstorm' => "Enable brainstorm",
	'brainstorm:group' => 'Group brainstorm',
	'brainstorm:same_group' => "In the same group:",
	'brainstorm:view:all' => "See all",
	
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
	
	'brainstorm:search:result_vote_submit' => "Ideas found. Vote or ",
	'brainstorm:search:result_novote_submit' => "Idea found. Change your votes or ",
	'brainstorm:search:result_novote_nosubmit' => "Ideas found. No point left, change your votes if you want to submit a new idea.",
	'brainstorm:search:noresult_nosubmit' => "No idea found, search again. You should change your votes if you want to submit a new idea.",
	'brainstorm:search:noresult_submit' => "No idea found. Search again or ",
	'brainstorm:search:skip_words' => "the,and,for,are,but,not,you,all,any,can,her,was,one,our,out,day,get,has,him,his,how,man,new,now,old,see,two,way,who,boy,did,its,let,put,say,she,too,use,dad,mom", // write words you want to skip separate by coma. Automaticaly skip word less than 3 chars, don't write them.

	'brainstorm:add' => "submit a new idea",
	
	'brainstorm:settings:points' => "Number of points",
	'brainstorm:settings:question' => "Question",
	'brainstorm:settings:brainstorm_submit_idea_without_point' => "Submit idea without point",
	'brainstorm:settings:brainstorm_submit_idea_without_point_string' => "Check if you want to offer possibility to group members to submit idea without point. Be carefull of flooding.",
	 
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
	
	'brainstorm:group:settings:failed' => "There is no group or you don't have acces to edit this group.",
	'brainstorm:group:settings:save:success' => "Settings of brainstorm's group succesfully saved.",

	/**
	 * Error messages
	 */
	'brainstorm:idea:rate:error:ajax' => "Connexion error with server.",
	'brainstorm:unknown_idea' => "Unknown idea.",
	'brainstorm:idea:rate:error:value' => "Mistake on the value for rating this idea.",
	'brainstorm:idea:rate:error' => "This idea could not be rated cause internal server problem.",
	'brainstorm:idea:rate:error:underzero' => "Your votes left cannot permit to rate an idea.",
);

add_translation('en', $english);
