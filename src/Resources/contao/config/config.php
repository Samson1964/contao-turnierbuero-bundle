<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2013 Leo Feyer
 *
 * @package   bdf
 * @author    Frank Hoppe
 * @license   GNU/LGPL
 * @copyright Frank Hoppe 2014
 */

$GLOBALS['BE_MOD']['content']['turnierbuero'] = array
(
	'tables'         => array('tl_turnierbuero', 'tl_turnierbuero_teilnehmer', 'tl_turnierbuero_meldungen'),
);

/**
 * Inhaltselemente
 */
 
$GLOBALS['TL_CTE']['chess']['turnierbuero_meldeliste'] = 'Schachbulle\ContaoTurnierbueroBundle\ContentElements\Meldeliste';
$GLOBALS['TL_CTE']['chess']['turnierbuero_meldestatus'] = 'Schachbulle\ContaoTurnierbueroBundle\ContentElements\Meldestatus';
