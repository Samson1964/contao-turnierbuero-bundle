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
 * Table tl_turnierbuero_teilnehmer
 */
$GLOBALS['TL_DCA']['tl_turnierbuero_teilnehmer'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_turnierbuero',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index',
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'disableGrouping'         => true,
			'fields'                  => array('lastname ASC', 'firstname ASC'),
			'headerFields'            => array('title', 'kennzeichen', 'tournamentType'),
			'panelLayout'             => 'filter;sort,search,limit',
			'child_record_callback'   => array('tl_turnierbuero_teilnehmer', 'listPersons'),
		),
		'global_operations' => array
		(
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
				'label'               => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'toggle' => array
			(
				'label'                => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['toggle'],
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
				'label'               => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'                     => '{name_legend},lastname,firstname,number,reportingDate,zugaustausch;{publish_legend},published'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_turnierbuero.title',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'number' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['number'],
			'exclude'                 => true,
			'default'                 => 1,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'tl_class'=>'clr w50', 'maxlength'=>3),
			'sql'                     => "varchar(3) NOT NULL default '1'"
		),
		'lastname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['lastname'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 255,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'firstname' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['firstname'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'mandatory'           => true,
				'maxlength'           => 255,
				'tl_class'            => 'w50'
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'reportingDate' => array
		(
			'label'                     => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['reportingDate'],
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array
			(
				'rgxp'                => 'date',
				'mandatory'           => false,
				'doNotCopy'           => false,
				'datepicker'          => true,
				'tl_class'            => 'w50 wizard'
			),
			'load_callback' => array
			(
				array('tl_turnierbuero_teilnehmer', 'loadDate')
			),
			'sql'                     => "int(10) unsigned NOT NULL default 0"
		),
		'zugaustausch' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['zugaustausch'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['zugaustauschTypes'],
			'eval'                    => array
			(
				'tl_class'            => 'w50',
				'includeBlankOption'  => true
			),
			'sql'                     => "varchar(6) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                     => &$GLOBALS['TL_LANG']['tl_turnierbuero_teilnehmer']['published'],
			'exclude'                   => true,
			'search'                    => false,
			'sorting'                   => false,
			'filter'                    => true,
			'default'                   => 1,
			'inputType'                 => 'checkbox',
			'eval'                      => array('tl_class' => 'w50','isBoolean' => true),
			'sql'                       => "char(1) NOT NULL default ''"
		),
	)
);

/**
 * Class tl_turnierbuero_teilnehmer
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005-2014
 * @author     Leo Feyer <https://contao.org>
 * @package    News
 */
class tl_turnierbuero_teilnehmer extends Backend
{

	var $nummer = 0;

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	/**
	 * Set the timestamp to 00:00:00 (see #26)
	 *
	 * @param integer $value
	 *
	 * @return integer
	 */
	public function loadDate($value)
	{
		return strtotime(date('Y-m-d', $value) . ' 00:00:00');
	}

	public function listPersons($arrRow)
	{
		$temp = '<div class="tl_content_left">'.$arrRow['lastname'].','.$arrRow['firstname'];

		return $temp.'</div>';
	}

}
