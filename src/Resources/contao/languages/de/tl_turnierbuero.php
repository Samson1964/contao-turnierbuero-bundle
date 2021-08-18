<?php 

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2014 Leo Feyer
 *
 */

// Listenansicht
$GLOBALS['TL_LANG']['tl_turnierbuero']['new'] = array('Neues Turnier', 'Neues Turnier anlegen');
$GLOBALS['TL_LANG']['tl_turnierbuero']['meldungen'] = array('Anmeldungen', 'Anmeldungen bearbeiten');

// Eingabemaske
$GLOBALS['TL_LANG']['tl_turnierbuero']['title_legend'] = 'Titel';
$GLOBALS['TL_LANG']['tl_turnierbuero']['title'] = array('Turniername', 'Name des Turnieres');
$GLOBALS['TL_LANG']['tl_turnierbuero']['kennzeichen'] = array('Turnierkennzeichen', 'Kennzeichen des Turnieres');
$GLOBALS['TL_LANG']['tl_turnierbuero']['tournamentType'] = array('Turniertyp', 'Turniertyp auswählen. Für Zusammenfassungen in Frontend-Tabellen wichtig.');

$GLOBALS['TL_LANG']['tl_turnierbuero']['meeting_legend'] = 'Termine';
$GLOBALS['TL_LANG']['tl_turnierbuero']['reportingDate'] = array('Meldedatum', 'Datum des Meldeschlusses');
$GLOBALS['TL_LANG']['tl_turnierbuero']['beginDate'] = array('Startdatum', 'Datum des Turnierbeginns');

$GLOBALS['TL_LANG']['tl_turnierbuero']['options_legend'] = 'Optionen';
$GLOBALS['TL_LANG']['tl_turnierbuero']['meldesoll'] = array('Spielersoll', 'Mindestanzahl benötigter Spieler');
$GLOBALS['TL_LANG']['tl_turnierbuero']['zugaustausch'] = array('Zugaustausch', 'Art des Zugaustausches');

$GLOBALS['TL_LANG']['tl_turnierbuero']['thema_legend'] = 'Thematurnier';
$GLOBALS['TL_LANG']['tl_turnierbuero']['thema'] = array('Thematurnier', 'Thematurnier aktivieren');
$GLOBALS['TL_LANG']['tl_turnierbuero']['themaName'] = array('Eröffnung', 'Themaname oder Eröffnung');

$GLOBALS['TL_LANG']['tl_turnierbuero']['closed_legend'] = 'Abgeschlossen';
$GLOBALS['TL_LANG']['tl_turnierbuero']['closed'] = array('Abgeschlossen', 'Turnier ist (ab)geschlossen. Keine Meldungen mehr möglich.');

$GLOBALS['TL_LANG']['tl_turnierbuero']['publish_legend'] = 'Veröffentlichung';
$GLOBALS['TL_LANG']['tl_turnierbuero']['published'] = array('Veröffentlicht', 'Turnier veröffentlicht');

// SELECT-Felder
$GLOBALS['TL_LANG']['tl_turnierbuero']['tournamentTypes'] = array
(
	'aufst'   => 'Aufstiegsturnier',
	'thema'   => 'Thematurnier',
	'allge'   => 'Allgemeines Kleinturnier',
	'einze'   => 'Qualifikationsturnier zur Einzelspielerliga (engine-frei)',
);

$GLOBALS['TL_LANG']['tl_turnierbuero']['zugaustauschTypes'] = array
(
	'Server'   => 'Server',
	'Post'     => 'Post',
	'egal'     => 'egal',
);
