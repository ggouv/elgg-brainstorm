/*
 * Tab filter
 */
.UpDownArrow {
	background: transparent url('<?php echo elgg_get_site_url(); ?>/mod/elgg-brainstorm/graphics/UpDownArrow.png');
	float: right;
	height: 8px;
	margin: 6px 0 0 6px;
	width: 12px;
}
.up {
	background-position: 0 -8px;
}
.brainstorm-highlight {
	background-color: yellow;
}
#brainstorm-characters-remaining.loading {
	background: url('<?php echo elgg_get_site_url(); ?>/mod/elgg-brainstorm/graphics/ajax-loader.gif') no-repeat scroll 0 6px transparent;
	padding-left: 20px;
}
#brainstorm-search-response > span {
	margin-right: 5px;
	font-weight: bold;
	font-size: 1.2em;
}
#brainstorm-search-response > .elgg-list {
	margin-top: 10px;
}

/*
 * Object idea
 */
.elgg-item-idea {
	float: left;
	width: 100%;
	min-height: 80px;
}
.elgg-body > .elgg-item-idea {
	float: none;
}
.idea-left-column {
	float: left;
	position: relative;
}
.idea-content {
	margin-left: 60px;
}
.idea-points {
	font-size: 1.6em;
	font-weight: bold;
	text-align: center;
	border: 1px solid #DEDEDE;
	border-radius: 5px;
	width: 50px;
	padding: 10px 0;
}
.idea-points .elgg-ajax-loader {
	background-size: 24px 24px;
	margin: -3px 0;
	min-height: 24px !important;
}
.idea-rate-button {
	width: 50px;
	border: 1px solid #CCCCCC;
	color: #666666;
	border-radius: 5px 5px 5px 5px;
	cursor: pointer;
	font-size: 14px;
	font-weight: bold;
	padding: 2px 0;
	text-align: center;
	background-color: #DEDEDE;
	display: block;
}
.idea-rate-button:hover {
	background-color: #CCC;
	text-decoration: none;
}
div.idea-rate-button {
	cursor: default;
}
div.idea-rate-button:hover {
	background-color: #EEE;
}
.idea-value-0 {
	display: none;
}
.idea-value-1 {
	background-color: #FFC773;
}
.idea-value-2 {
	background-color: #FFB240;
}
.idea-value-3 {
	background-color: #FF9900;
}
.idea-status {
	background-color: #EEE;
}
.tag {
	border-radius: 8px;
	color: black;
	font-size: 11px;
	font-weight: normal;
	padding: 2px 6px;
}
.tag.planned {
	background-color: #FFED00;
}
.tag.under {
	background-color: #BBB;
}
.tag.started {
	background-color: #89C23C;
}
.tag.completed {
	background-color: #4690D6;
}
.tag.declined {
	background-color: red;
}

/*
 * Object vote-popup
 */
.brainstorm-vote-popup {
	display: none;
	position: absolute;
	z-index: 0;
	padding: 0px;
}
.brainstorm-vote-popup .triangle {
	border-style: solid;
	border-width: 10px 10px 10px 0;
	height: 0;
	position: absolute;
	width: 0;
    top: 6px;
}
.brainstorm-vote-popup .blanc {
	border-color: transparent white;
	left: -10px;
}
.brainstorm-vote-popup .gris {
	border-color: transparent #CCCCCC;
	left: -11px;
}
.brainstorm-vote-popup .elgg-button {
	width: 40px;
	float: left;
	border-radius: 5px 5px 5px 5px;
	cursor: pointer;
	font-weight: bold;
	padding: 2px 4px;
	color: #666;
	text-align: center;
	margin: 5px;
	box-shadow: none;
}
.brainstorm-vote-popup .elgg-button:hover {
	background-color: #4690D6;
	border-color: #4690D6;
}
.brainstorm-vote-popup .elgg-button.checked {
	background-color: #0054A7;
	border-color: #0054A7;
	color: white;
	cursor: default;
}

/*
 * Sidebar
 */
#votesLeft {
	background-color: #FF9900;
	color: white;
	font-size: 1.4em;
	font-weight: bold;
	margin: 0 -10px 10px;
	padding-bottom:5px;
}
#votesLeft.zero {
	background-color: #999;
}
#votesLeft strong {
	font-size: 2em;
}
.sidebar-idea-list {
	margin-top: 10px;
}
.sidebar-idea-list .elgg-item-idea {
	min-height: 0px;
}
.sidebar-idea-list .elgg-item-idea > div {
	color: #666666;
	float: left;
	font-weight: bold;
	padding: 2px 6px;
}
.sidebar-idea-list .elgg-item-idea > h3 {
	padding-top: 2px;
}
.sidebar-idea-list .elgg-item-idea > div.planned {
	border-bottom: 4px solid #FFED00;
}
.sidebar-idea-list .elgg-item-idea > div.under {
	border-bottom: 4px solid #BBB;
}
.sidebar-idea-list .elgg-item-idea > div.started {
	border-bottom: 4px solid #89C23C;
}
.sidebar-idea-list .elgg-item-idea > div.completed {
	border-bottom: 4px solid #4690D6;
}
.sidebar-idea-list .elgg-item-idea > div.declined {
	border-bottom: 4px solid red;
}
/*
 * Add form saveidea
 */
 
.elgg-form-brainstorm-saveidea .elgg-horizontal {
	display: block;
}
.elgg-form-brainstorm-saveidea .elgg-horizontal li {
	display: inline;
	padding-right: 10px;
}
