.elgg-item-idea {
	float: left;
	width: 100%;
}
.idea-left-column {
	float: left;
	position: relative;
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
.idea-left-column .idea-rate-button {
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
.idea-left-column .idea-rate-button:hover {
	background-color: #CCC;
	text-decoration: none;
}
.idea-content {
	margin-left: 60px;
}


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
.brainstorm-vote-popup li {
	width: 40px;
	float: left;
	border-radius: 5px 5px 5px 5px;
	cursor: pointer;
	font-weight: bold;
	padding: 2px 4px;
	color: #666;
	background-color: #EBEBEB;
	text-align: center;
	margin-left: 5px;
}
.brainstorm-vote-popup li:first-child {
	margin-left: 0px;
}
.brainstorm-vote-popup li:hover {
	background-color: #4690D6;
}
.brainstorm-vote-popup input[type="radio"] {
	display: none;
}
.brainstorm-vote-popup label {
	cursor: pointer;
}

#votesLeft {
	background-color: orange;
	color: white;
	font-size: 1.4em;
	font-weight: bold;
	padding: 10px;
}

#votesLeft strong {
	font-size: 2em;
}