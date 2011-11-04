/*
 * Object idea
 */
.elgg-item-idea {
	float: left;
	width: 100%;
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
.idea-rate-button.value-1 {
	background-color: #FFC773;
}
.idea-rate-button.value-2 {
	background-color: #FFB240;
}
.idea-rate-button.value-3 {
	background-color: #FF9900;
}


/*
 * Object vote-popup
 */
.brainstorm-vote-popup {
	display: none;
	position: absolute;
	z-index: 0;
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
	margin-right: 5px;
	box-shadow: none;
}
.brainstorm-vote-popup .elgg-button:last-child {
	margin-right: 0px;
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
	padding: 10px;
}

#votesLeft strong {
	font-size: 2em;
}