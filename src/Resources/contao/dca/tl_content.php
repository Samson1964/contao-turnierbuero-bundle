<?php

/**
 * Paletten
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['turnierbuero_meldeliste'] = '{type_legend},type,headline;{turnierbuero_legend},turnierbuero_id,turnierbuero_colsView;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guest,cssID;{invisible_legend:hide},invisible,start,stop';
$GLOBALS['TL_DCA']['tl_content']['palettes']['turnierbuero_meldestatus'] = '{type_legend},type,headline;{turnierbuero_legend},turnierbuero_typid,turnierbuero_typView;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guest,cssID;{invisible_legend:hide},invisible,start,stop';

/**
 * Felder
 */

// Turnierliste anzeigen
$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_id'] = array
(
	'label'                => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_id'],
	'exclude'              => true,
	'options_callback'     => array('tl_content_turnierbuero', 'getTurnierliste'),
	'inputType'            => 'select',
	'eval'                 => array
	(
		'mandatory'        => true,
		'multiple'         => false,
		'chosen'           => true,
		'submitOnChange'   => false,
		'tl_class'         => 'long'
	),
	'sql'                  => "int(10) unsigned NOT NULL default '0'"
);

// Turniertypliste anzeigen
$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_typid'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_typid'],
	'exclude'                 => true,
	'options_callback'        => array('tl_content_turnierbuero', 'getTurniertypliste'),
	'inputType'               => 'select',
	'eval'                    => array
	(
		'mandatory'           => true,
		'multiple'            => false,
		'chosen'              => true,
		'submitOnChange'      => false,
		'tl_class'            => 'long'
	),
	'sql'                     => "varchar(5) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_colsView'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_colsView'],
	'exclude'                 => true,
	'filter'                  => true,
	'inputType'               => 'checkboxWizard',
	'options'                 => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_colsView_array'],
	'default'                 => is_array($GLOBALS['TL_LANG']['tl_content']['turnierbuero_colsView_array']) ? array_keys($GLOBALS['TL_LANG']['tl_content']['turnierbuero_colsView_array']) : '',
	'eval'                    => array
	(
		'multiple'            => true,
		'tl_class'            => 'w50'
	),
	'sql'                     => 'blob NULL'
);

$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_typView'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_typView'],
	'exclude'                 => true,
	'filter'                  => true,
	'inputType'               => 'checkboxWizard',
	'options'                 => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_typView_array'],
	'default'                 => is_array($GLOBALS['TL_LANG']['tl_content']['turnierbuero_typView_array']) ? array_keys($GLOBALS['TL_LANG']['tl_content']['turnierbuero_typView_array']) : '',
	'eval'                    => array
	(
		'multiple'            => true,
		'tl_class'            => 'w50'
	),
	'sql'                     => 'blob NULL'
);

/*****************************************
 * Klasse tl_content_turnierbuero
 *****************************************/

class tl_content_turnierbuero extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function getTurnierliste(DataContainer $dc)
	{
		$array = array();
		$objTurnier = \Database::getInstance()->prepare("SELECT * FROM tl_turnierbuero ORDER BY reportingDate DESC")
		                                      ->execute();
		while($objTurnier->next())
		{
			if($objTurnier->published)
			{
				$array[$objTurnier->id] = $objTurnier->title.' (Meldeschluß: '.date('d.m.Y', $objTurnier->reportingDate).')';
			}
		}
		return $array;

	}

	public function getTurniertypliste(DataContainer $dc)
	{
		$array = array();
		$typen = array();
		$objTurnier = \Database::getInstance()->prepare("SELECT * FROM tl_turnierbuero")
		                                      ->execute();

		\System::loadLanguageFile('tl_turnierbuero'); // Spracharray laden, um Turniertypen anzeigen

		while($objTurnier->next())
		{
			if($objTurnier->published)
			{
				// Turnieranzahl für jeden Turniertyp zählen
				if(isset($typen[$objTurnier->tournamentType])) $typen[$objTurnier->tournamentType]++;
				else $typen[$objTurnier->tournamentType] = 1;
			}
		}

		// Liste erstellen
		foreach($typen as $key => $value)
		{
			$string = $value == 1 ? 'Turnier' : 'Turniere';
			if($key) $array[$key] = $GLOBALS['TL_LANG']['tl_turnierbuero']['tournamentTypes'][$key].' ('.$value.' '.$string.')';
		}

		return $array;

	}

}
