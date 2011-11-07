<?php
/**
 * Brainstorm English language file
 */

$english = array(

	/**
	 * Menu items and titles
	 */
	'brainstorm' => "Brainstorm",
	'brainstorm:add' => "Add idea",
	'brainstorm:edit' => "Edit idea",
	'brainstorm:owner' => "%s's brainstorming",
	'brainstorm:friends' => "Friends' ideas",
	'brainstorm:everyone' => "All site ideas",
	'brainstorm:this' => "Bookmark this page",
	'bookmarks:this:group' => "Bookmark in %s",
	'brainstorm:bookmarklet' => "Get bookmarklet",
	'brainstorm:bookmarklet:group' => "Get group bookmarklet",
	'brainstorm:inbox' => "Bookmarks inbox",
	'brainstorm:morebookmarks' => "More bookmarks",
	'brainstorm:more' => "More",
	'brainstorm:with' => "Share with",
	'brainstorm:new' => "A new idea",
	'brainstorm:via' => "via bookmarks",
	'brainstorm:address' => "Address of the resource to bookmark",
	'brainstorm:none' => 'No idea',

	'brainstorm:delete:confirm' => "Are you sure you want to delete this resource?",

	'brainstorm:numbertodisplay' => 'Number of ideas to display',

	'brainstorm:shared' => "Bookmarked",
	'brainstorm:visit' => "Visit resource",
	'brainstorm:recent' => "Recent ideas",

	'river:create:object:idea' => '%s submited idea %s',
	'river:comment:object:idea' => '%s commented on a idea %s',
	'brainstorm:river:annotate' => 'a comment on this idea',
	'brainstorm:river:item' => 'an item',

	'item:object:idea' => 'Idea',

	'brainstorm:group' => 'Group brainstorming',
	'brainstorm:enablebookmarks' => 'Enable group bookmarks',
	'brainstorm:nogroup' => 'This group does not have any bookmarks yet',
	'brainstorm:more' => 'More bookmarks',

	'brainstorm:no_title' => 'No title',

	/**
	 * Widget and bookmarklet
	 */
	'brainstorm:widget:description' => "Display your latest bookmarks.",

	'brainstorm:bookmarklet:description' =>
			"The bookmarks bookmarklet allows you to share any resource you find on the web with your friends, or just bookmark it for yourself. To use it, simply drag the following button to your browser's links bar:",

	'brainstorm:bookmarklet:descriptionie' =>
			"If you are using Internet Explorer, you will need to right click on the bookmarklet icon, select 'add to favorites', and then the Links bar.",

	'brainstorm:bookmarklet:description:conclusion' =>
			"You can then save any page you visit by clicking it at any time.",

	/**
	 * Status messages
	 */

	'brainstorm:save:success' => "Your item was successfully bookmarked.",
	'brainstorm:delete:success' => "Your bookmarked item was successfully deleted.",

	/**
	 * Error messages
	 */

	'brainstorm:save:failed' => "Your bookmark could not be saved. Make sure you've entered a title and address and then try again.",
	'brainstorm:delete:failed' => "Your bookmark could not be deleted. Please try again.",
);

add_translation('en', $english);