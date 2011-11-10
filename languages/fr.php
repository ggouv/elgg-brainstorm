<?php
/**
 * Brainstorm French language file
 */

$french = array(

	/**
	 * Menu items and titles
	 */
	
	'brainstorm:filter:top' => "Top",
	'brainstorm:filter:hot' => "Hot",
	'brainstorm:filter:new' => "Nouvelles",
	'brainstorm:filter:accepted' => "Acceptées",
	'brainstorm:filter:completed' => "Completées",
	
	'item:object:idea' => 'Idée',
	'river:create:object:idea' => "%s a soumis l'idée %s",
	'river:comment:object:idea' => "%s a commenté l'idée %s",
	'brainstorm:river:annotate' => "un commentaire sur l'idée",
	'brainstorm:river:item' => 'un objet',
	
	'brainstorm' => "Remue-méninges",
	'brainstorm:add' => "Ajouter une idée",
	'brainstorm:edit' => "Éditer une ideé",
	'brainstorm:new' => "Une nouvelle idée",
	
	'brainstorm:owner' => "Remue-méninges de %s",
	'brainstorm:idea:edit' => "Éditer cette ideé",
	'brainstorm:idea:add' => "Ajouter cette idée",
	
	'brainstorm:enablebrainstorm' => "Active le remue méninge.",
	'brainstorm:group' => 'Remue-méninges du groupe',
	
	/**
	 * Content
	 */
	'brainstorm:yourvotes' => "Vos votes :",
	'brainstorm:vote' => "Vote :",
	
	'brainstorm:none' => "Pas d'idée.",
	'brainstorm:novoteleft' => "vote restant.",
	'brainstorm:onevoteleft' => "vote restant.",
	'brainstorm:votesleft' => "votes restants.",
	
	'brainstorm:search' => "Cherchez ou soumettez une idée :",
	'brainstorm:charleft' => "caractères restants.",
	'brainstorm:search:find' => "Votez pour ces idées ou ",
	'brainstorm:search:none' => "Aucune idée trouvée. Cherchez autre chose ou ",
	'brainstorm:add' => "soumettez une nouvelle idée",
	 
	/**
	 * Widget and bookmarklet
	 */
	'brainstorm:widget:title' => "Remue méninge.",
	'brainstorm:widget:description' => "Afficher les idées les plus votées.",
	'brainstorm:more' => "Plus d'idées",
	'brainstorm:numbertodisplay' => "Nombre d'idées à afficher :",

	/**
	 * Status messages
	 */
	'brainstorm:idea:rate:submitted' => "Votre vote a bien été pris en compte.",
	'brainstorm:save:success' => "Votre idée a bien été enregistrée.",
	'brainstorm:delete:success' => "Votre idée a bien été supprimée.",
	/**
	 * Error messages
	 */
	'brainstorm:idea:rate:error:ajax' => "Erreur de connexion avec le serveur.",
	'brainstorm:unknown_idea' => "Idée inconnue.",
	'brainstorm:idea:rate:error:value' => "Erreur sur la valeur du vote.",
	'brainstorm:idea:rate:error' => "Votre n'a pu être pris en compte à cause d'une erreur avec le serveur.",
	'brainstorm:idea:rate:error:underzero' => "Le nombre de votes restant ne vous permette pas de voter cette idée.",
);

add_translation('fr', $french);