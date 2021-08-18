<?php

/**
 * Paletten
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['turnierbuero_meldeliste'] = '{type_legend},type,headline;{turnierbuero_legend},turnierbuero_id,turnierbuero_colsView;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guest,cssID;{invisible_legend:hide},invisible,start,stop';

/**
 * Felder
 */

// Adressenliste anzeigen
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

//// Funktion (wird vor dem Namen angezeigt)
//$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_funktion'] = array
//(
//	'label'                => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_funktion'],
//	'exclude'              => true,
//	'search'               => true,
//	'inputType'            => 'text',
//	'eval'                 => array('maxlength'=>255, 'tl_class'=>'w50 clr'),
//	'sql'                  => "varchar(255) NOT NULL default ''"
//);
//
//// Zusatztext (wird zwischen der Funktion und dem Namen angezeigt)
//$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_zusatz'] = array
//(
//	'label'                => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_zusatz'],
//	'exclude'              => true,
//	'search'               => true,
//	'inputType'            => 'text',
//	'eval'                 => array('maxlength'=>255, 'tl_class'=>'w50', 'allowHtml'=>true),
//	'sql'                  => "varchar(255) NOT NULL default ''"
//);
//
//// Zeigt das Standardfoto aus tl_turnierbueron an
//$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_bildvorschau'] = array
//(
//	'exclude'              => true,
//	'input_field_callback' => array('tl_content_turnierbuero', 'getThumbnail'),
//); 
//
//// Alternatives Foto aktivieren
//$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_addImage'] = array
//(
//	'label'                => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_addImage'],
//	'exclude'              => true,
//	'filter'               => true,
//	'default'              => true,
//	'inputType'            => 'checkbox',
//	'eval'                 => array
//	(
//		'submitOnChange'   => true,
//		'tl_class'         => 'w50'
//	),
//	'sql'                  => "char(1) NOT NULL default '1'"
//);
//
//// Alternatives Foto aktivieren
//$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_altformat'] = array
//(
//	'label'                => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_altformat'],
//	'exclude'              => true,
//	'filter'               => true,
//	'default'              => false,
//	'inputType'            => 'checkbox',
//	'eval'                 => array
//	(
//		'submitOnChange'   => true,
//		'tl_class'         => 'w50'
//	),
//	'sql'                  => "char(1) NOT NULL default ''"
//);
//
//// Nur bestimmte Adressen aktivieren einschalten
//$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_selectmails'] = array
//(
//	'label'                => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_selectmails'],
//	'exclude'              => true,
//	'filter'               => true,
//	'inputType'            => 'checkbox',
//	'eval'                 => array
//	(
//		'submitOnChange'   => true,
//		'tl_class'         => 'clr w50'
//	),
//	'sql'                  => "char(1) NOT NULL default ''"
//);
//
//// Anzuzeigende Adressen auswählen
//$GLOBALS['TL_DCA']['tl_content']['fields']['turnierbuero_mails'] = array
//(
//	'label'                => &$GLOBALS['TL_LANG']['tl_content']['turnierbuero_mails'],
//	'exclude'              => true,
//	'inputType'            => 'checkboxWizard',
//	'options_callback'     => array('tl_content_turnierbuero', 'getMails'),
//	'eval'                 => array
//	(
//		'tl_class'         => 'w50', 
//		'multiple'         => true
//	),
//	'sql'                  => "varchar(64) NOT NULL default ''"
//);

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
				$array[$objTurnier->id] = $objTurnier->title.' (Meldeschluß: '.$objTurnier->reportingDate.')';
			}
		}
		return $array;

	}

}
