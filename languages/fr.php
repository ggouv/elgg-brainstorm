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
	'brainstorm:filter:completed' => "Terminées",
	
	'item:object:idea' => 'Idées',
	'river:create:object:idea' => "%s a soumis l'idée %s",
	'river:comment:object:idea' => "%s a commenté l'idée %s",
	'river:edit:object:idea' => "%s a édité l'idée %s",
	'brainstorm:river:annotate' => "un commentaire sur l'idée",
	'brainstorm:river:item' => 'un objet',
	
	'brainstorm' => "Remue-méninges",
	'brainstorm:add' => "Ajouter une idée",
	'brainstorm:edit' => "Éditer une ideé",
	'brainstorm:new' => "Une nouvelle idée",
	
	'brainstorm:all' => "Toutes les idées",
	'brainstorm:owner' => "Idées de %s",
	'brainstorm:friends' => "Idées des contacts",
	'brainstorm:idea:edit' => "Éditer cette ideé",
	'brainstorm:idea:add' => "Ajouter cette idée",
	
	'brainstorm:group:settings:title' => "Paramètres du brainstorm du groupe %s",
	'brainstorm:group_settings' => "Paramètres",
	'brainstorm:enablebrainstorm' => "Active le remue-méninges",
	'brainstorm:group' => 'Remue-méninges du groupe',
	'brainstorm:same_group' => "Dans le même groupe :",
	'brainstorm:view:all' => "Voir tout",
	
	/**
	 * Content
	 */
	'brainstorm:yourvotes' => "Vos votes :",
	'brainstorm:vote' => "Vote :",
	
	'brainstorm:status' => "Satut :",
	'brainstorm:state' => "État :",
	'brainstorm:status_info' => "Information sur le statut :",
	'brainstorm:open' => 'ouvert',
	'brainstorm:under review' => "en cours d'évaluation",
	'brainstorm:planned' => 'planifié',
	'brainstorm:started' => 'commencé',
	'brainstorm:completed' => 'terminé',
	'brainstorm:declined' => 'décliné',
	
	'brainstorm:none' => "Pas d'idée.",
	'brainstorm:novoteleft' => "vote restant.",
	'brainstorm:onevoteleft' => "vote restant.",
	'brainstorm:votesleft' => "votes restants.",
	
	'brainstorm:search' => "Cherchez ou soumettez une idée :",
	'brainstorm:charleft' => "caractères restants.",
	
	'brainstorm:search:result_vote_submit' => "Votez pour ces idées ou ",
	'brainstorm:search:result_novote_submit' => "Idées trouvées. Changez vos votes ou ",
	'brainstorm:search:result_novote_nosubmit' => "Des idées ont été trouvées mais vous n'avez plus de point. Changez vos votes si vous voulez soumettre une nouvelle idée.",
	'brainstorm:search:noresult_nosubmit' => "Aucune idée trouvée, cherchez autre chose. Vous devez changer vos votes si vous voulez soumettre une nouvelle idée.",
	'brainstorm:search:noresult_submit' => "Aucune idée trouvée. Cherchez autre chose ou ",
	'brainstorm:search:skip_words' => "une,sans,avec,des,dans,pour,car,que,qui,mais,est,donc,elle,elles,nous,vous,ils,son,ses,ici,oui,non,toi,ton", // write words you want to skip separate by coma. Automaticaly skip word less than 3 chars, don't write them.
	
	'brainstorm:add' => "soumettez une nouvelle idée",

	'brainstorm:settings:points' => "Nombre de points",
	'brainstorm:settings:question' => "Question",
	
	/**
	 * Widget and bookmarklet
	 */
	'brainstorm:widget:title' => "Remue-méninges",
	'brainstorm:widget:description' => "Afficher les idées les plus votées.",
	'brainstorm:more' => "Plus d'idées",
	'brainstorm:numbertodisplay' => "Nombre d'idées à afficher ",
	'brainstorm:typetodisplay' => "Afficher par ",

	/**
	 * Status messages
	 */
	'brainstorm:idea:rate:submitted' => "Votre vote a bien été pris en compte.",
	'brainstorm:idea:save:success' => "Votre idée a bien été enregistrée.",
	'brainstorm:idea:delete:success' => "Votre idée a bien été supprimée.",
	'brainstorm:idea:delete:failed' => "Une erreur s'est produite lors de la suppression de l'idée.",

	'brainstorm:idea:save:empty' => "Vous devez définir un titre et une description.",
	'brainstorm:idea:save:failed' => "Une erreur s'est produite lors de la sauvegarde de l'idée.",

	'brainstorm:group:settings:failed' => "Le groupe n'est pas défini ou vous n'êtes pas autorisé à éditer ce groupe.",
	'brainstorm:group:settings:save:success' => "Les paramètres ont été enregistrées.",
	'brainstorm:settings:brainstorm_submit_idea_without_point' => "Soumettre une idée sans avoir de point",
	'brainstorm:settings:brainstorm_submit_idea_without_point_string' => "Cochez si vous souhaitez que les membres du groupe puissent soumettre une idée sans avoir de point. Attention, cela offre la possibilité à un utilisateur de soumettre beaucoup d'idée sans gage de qualité.",
	
	/**
	 * Error messages
	 */
	'brainstorm:idea:rate:error:ajax' => "Erreur de connexion avec le serveur.",
	'brainstorm:unknown_idea' => "Idée inconnue.",
	'brainstorm:idea:rate:error:value' => "Erreur sur la valeur du vote.",
	'brainstorm:idea:rate:error' => "Votre vote n'a pas pu être pris en compte à cause d'une erreur sur le serveur.",
	'brainstorm:idea:rate:error:underzero' => "Le nombre de votes restant ne vous permet pas de voter pour cette idée.",
);

add_translation('fr', $french);
