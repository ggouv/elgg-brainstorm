<?php
/**
 * Idea view
 *
 * @package Brainstorm
 */

$full = elgg_extract('full_view', $vars, FALSE);
$idea = elgg_extract('entity', $vars, FALSE);

if (!$idea) {
	return;
}

$owner = $idea->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'small');
$container = $idea->getContainerEntity();
$categories = elgg_view('output/categories', $vars);

$description = elgg_view('output/longtext', array('value' => $idea->description, 'class' => 'pbl'));

$owner_link = elgg_view('output/url', array(
	'href' => "brainstorm/owner/$owner->username",
	'text' => $owner->name,
));
$author_text = elgg_echo('byline', array($owner_link));

$tags = elgg_view('output/tags', array('tags' => $idea->tags));
$date = elgg_view_friendly_time($idea->time_created);

$comments_count = $idea->countComments();
//only display if there are commments
if ($comments_count != 0) {
	$text = elgg_echo("comments") . " ($comments_count)";
	$comments_link = elgg_view('output/url', array(
		'href' => $idea->getURL() . '#comments',
		'text' => $text,
	));
} else {
	$comments_link = '';
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'brainstorm',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$subtitle = "$author_text $date $categories $comments_link";

$params = array(
	'entity' => $idea,
	'title' => false,
	'metadata' => $metadata,
	'subtitle' => $subtitle,
	'tags' => $tags,
);
$params = $params + $vars;
$list_body = elgg_view('object/elements/summary', $params);

$vote = "<div class='idea-points mbs pam'>35</div>" .
	elgg_view('input/button', array('name' => 'vote-button', 'value' => 'vote'));

// do not show the metadata and controls in widget view
if (elgg_in_context('widgets')) {
	$metadata = '';
}

if ($full && !elgg_in_context('gallery')) {
	$header = elgg_view_title($idea->title);

	$idea_info = elgg_view_image_block($owner_icon, $list_body);

	echo <<<HTML
<div class="idea-left-column mts">$vote</div>
<div class="idea-content">
	$header
	$idea_info
	$description
</div>
HTML;

} elseif (elgg_in_context('gallery')) {
	echo <<<HTML
<div class="idea-gallery-item">
	<h3>$idea->title</h3>
	<p class='subtitle'>$owner_link $date</p>
</div>
HTML;
} else {
	// brief view
	$header = elgg_view_title($idea->title);

	$content = elgg_get_excerpt($idea->description, '300');

	$params = array(
		'text' => $idea->title,
		'href' => $idea->getURL(),
	);
	$title_link = elgg_view('output/url', $params);

	/*$params = array(
		'entity' => $idea,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'tags' => $tags,
		'content' => $content,
	);
	$params = $params + $vars;
	$body = elgg_view('object/elements/summary', $params);*/
	
	echo <<<HTML
<div class="idea-left-column mts mbs">$vote</div>
<div class="idea-content mts">
	<h3>$title_link</h3>
	$content
	$list_body
</div>
HTML;

}
/*

<div class="elgg-image-block clearfix">
	<div class="elgg-image">
		<div class="elgg-avatar elgg-avatar-tiny">
			<span class="elgg-icon elgg-icon-hover-menu "></span>
			<ul class="elgg-menu elgg-menu-hover">
				<li>
					<a href="http://localhost/~mama/ggouv/ggouv/profile/manu">
						<span class="elgg-heading-basic">
							manu
						</span>
						@manu
					</a>
				</li>
				<li>
					<ul class="elgg-menu elgg-menu-hover-actions">
						<li class="elgg-menu-item-avatar-edit">
							<a href="http://localhost/~mama/ggouv/ggouv/avatar/edit/manu">
								Edit avatar
							</a>
						</li>
						<li class="elgg-menu-item-profile-edit">
							<a href="http://localhost/~mama/ggouv/ggouv/profile/manu/edit">
								Edit profile
							</a>
						</li>
					</ul>
				</li>
				<li>
					<ul class="elgg-menu elgg-menu-hover-admin">
						<li class="elgg-menu-item-logbrowser">
							<a href="http://localhost/~mama/ggouv/ggouv/admin/utilities/logbrowser?user_guid=36">
								Explore log
							</a>
						</li>
					</ul>
				</li>
			</ul>
			<a href="http://localhost/~mama/ggouv/ggouv/profile/manu"
				<img style="background: url(http://localhost/~mama/ggouv/ggouv/avatar/view/manu/tiny/1317186807) no-repeat;" title="manu" alt="manu" src="http://localhost/~mama/ggouv/ggouv/_graphics/spacer.gif">
			</a>
		</div>
	</div>
	<div class="elgg-body">
		<ul class="elgg-menu elgg-menu-entity elgg-menu-hz elgg-menu-entity-default">
			<li class="elgg-menu-item-access">
				<span class="elgg-access elgg-access-group-closed">
					Public
				</span>
			</li>
			<li class="elgg-menu-item-etherpadfs">
				<a></a>
			</li>
			<li class="elgg-menu-item-edit">
				<a title="Edit this" href="http://localhost/~mama/ggouv/ggouv/idea/edit/89">
					Edit
				</a>
			</li>
			<li class="elgg-menu-item-delete">
				<a class="elgg-requires-confirmation" rel="Are you sure you want to delete this item?" title="Delete this" href="http://localhost/~mama/ggouv/ggouv/action/idea/delete?guid=89&amp;__elgg_ts=1320236179&amp;__elgg_token=4aca37922378513439f0a8bd2d56cda2">
					<span class="elgg-icon elgg-icon-delete "></span>
				</a>
			</li>
			<li class="elgg-menu-item-likes">
				<a title="Like this" href="http://localhost/~mama/ggouv/ggouv/action/likes/add?guid=89&amp;__elgg_ts=1320236179&amp;__elgg_token=4aca37922378513439f0a8bd2d56cda2">
					<span class="elgg-icon elgg-icon-thumbs-up "></span>
				</a>
			</li>
		</ul>
		<h3>
			<a href="http://localhost/~mama/ggouv/ggouv/view/89">
				au iauieauieaie
			</a>
		</h3>
		<div class="elgg-subtext">
			By <a href="http://localhost/~mama/ggouv/ggouv/bookmarks/owner/manu">manu</a> <acronym title="2 November 2011 @ 4:55am">4 hours ago</acronym>  
			<a href="http://localhost/~mama/ggouv/ggouv/view/89#comments">Comments (1)</a>
		</div>
		<div class="elgg-content">aui e</div>
	</div>
</div>
*/