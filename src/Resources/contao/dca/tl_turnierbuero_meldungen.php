<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package News
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Table tl_turnierbuero_meldungen
 */
$GLOBALS['TL_DCA']['tl_turnierbuero_meldungen'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id'    => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('registrationDate'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('registrationDate', 'accountNumber', 'lastname', 'firstname'),
			'showColumns'             => true,
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'turniere' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_turnierbuero']['turniere'],
				'href'                => 'table=tl_turnierbuero',
				'icon'                => 'bundles/contaoturnierbuero/images/turniere.png',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			),
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif',
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			),
			'toggle' => array
			(
				'label'                => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['toggle'],
				'attributes'           => 'onclick="Backend.getScrollOffset()"',
				'haste_ajax_operation' => array
				(
					'field'            => 'published',
					'options'          => array
					(
						array('value' => '', 'icon' => 'invisible.svg'),
						array('value' => '1', 'icon' => 'visible.svg'),
					),
				),
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{member_legend},accountNumber,firstname,lastname;{address_legend},street,postalcode,city,email,telefax;{registration_legend},registrationDate,registration1_mark,registration1_number,registration1_amount,registration2_mark,registration2_number,registration2_amount,registration3_mark,registration3_number,registration3_amount,registration4_mark,registration4_number,registration4_amount;{deposit_legend},depositDate,accountDebit;{misc_legend},qualification,miscellaneous;{publish_legend},published'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['tstamp'],
			'sorting'                 => true,
			'flag'                    => 8,
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'accountNumber' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['accountNumber'],
			'sorting'                 => true,
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 6,
				'rgxp'                => 'natural',
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(6) NOT NULL default ''"
		),
		'firstname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['firstname'],
			'exclude'                 => true,
			'sorting'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 40,
				'tl_class'            => 'w50 clr'
			),
			'sql'                     => "varchar(40) NOT NULL default ''"
		),
		'lastname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['lastname'],
			'exclude'                 => true,
			'sorting'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 40,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(40) NOT NULL default ''"
		),
		'street' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['street'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 40,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(40) NOT NULL default ''"
		),
		'postalcode' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['postalcode'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 10,
				'tl_class'            => 'w50 clr'
			),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'city' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['city'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 40,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(40) NOT NULL default ''"
		),
		'email' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero']['email'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 255,
				'rgxp'                => 'email',
				'decodeEntities'      => true,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'telefax' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero']['telefax'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'maxlength'           => 64,
				'rgxp'                => 'phone',
				'decodeEntities'      => true,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'registrationDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero']['registrationDate'],
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'rgxp'                => 'datim',
				'mandatory'           => false,
				'doNotCopy'           => true,
				'datepicker'          => true,
				'tl_class'            => 'w50 wizard'
			),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'registration1_mark' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration1_mark'],
			'exclude'                 => true,
			'sorting'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 20,
				'tl_class'            => 'w50 clr'
			),
			'sql'                     => "varchar(20) NOT NULL default ''"
		),
		'registration1_number' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration1_number'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 2,
				'rgxp'                => 'natural',
				'tl_class'            => 'w50'
			),
			'sql'                     => "int(2) unsigned NOT NULL default '0'"
		),
		'registration1_amount' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration1_amount'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 10,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'registration2_mark' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration2_mark'],
			'exclude'                 => true,
			'sorting'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 20,
				'tl_class'            => 'w50 clr'
			),
			'sql'                     => "varchar(20) NOT NULL default ''"
		),
		'registration2_number' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration2_number'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 2,
				'rgxp'                => 'natural',
				'tl_class'            => 'w50'
			),
			'sql'                     => "int(2) unsigned NOT NULL default '0'"
		),
		'registration2_amount' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration2_amount'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 10,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'registration3_mark' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration3_mark'],
			'exclude'                 => true,
			'sorting'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 20,
				'tl_class'            => 'w50 clr'
			),
			'sql'                     => "varchar(20) NOT NULL default ''"
		),
		'registration3_number' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration3_number'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 2,
				'rgxp'                => 'natural',
				'tl_class'            => 'w50'
			),
			'sql'                     => "int(2) unsigned NOT NULL default '0'"
		),
		'registration3_amount' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration3_amount'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 10,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'registration4_mark' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration4_mark'],
			'exclude'                 => true,
			'sorting'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 20,
				'tl_class'            => 'w50 clr'
			),
			'sql'                     => "varchar(20) NOT NULL default ''"
		),
		'registration4_number' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration4_number'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 2,
				'rgxp'                => 'natural',
				'tl_class'            => 'w50'
			),
			'sql'                     => "int(2) unsigned NOT NULL default '0'"
		),
		'registration4_amount' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['registration4_amount'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => false,
				'maxlength'           => 10,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'depositDate' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero']['depositDate'],
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'date', 'mandatory'=>false, 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default 0"
		),
		'accountDebit' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero']['accountDebit'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'inputType'               => 'checkbox',
			'eval'                    => array
			(
				'doNotCopy'           => true,
				'tl_class'            => 'w50 m12'
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'qualification' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['qualification'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 40,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(40) NOT NULL default ''"
		),
		'miscellaneous' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['miscellaneous'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array
			(
				'rows'                => 10,
				'tl_class'            => 'clr'
			),
			'sql'                     => "text NULL"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_meldungen']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'flag'                    => 1,
			'default'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array
			(
				'doNotCopy'           => true
			),
			'sql'                     => "char(1) NOT NULL default ''"
		),  
	)
);


/**
 * Class tl_turnierbuero_meldungen
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    News
 */
class tl_turnierbuero_meldungen extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

}
