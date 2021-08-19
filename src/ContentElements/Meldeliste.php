<?php

namespace Schachbulle\ContaoTurnierbueroBundle\ContentElements;

class Meldeliste extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_turnierbuero-meldeliste';

	/**
	 * Generate the module
	 */
	protected function compile()
	{
	
		// Adresse aus Datenbank laden, wenn ID übergeben wurde
		if($this->turnierbuero_id)
		{
			$objTurnier = \Database::getInstance()->prepare("SELECT * FROM tl_turnierbuero WHERE id=?")
			                                      ->execute($this->turnierbuero_id);

			// Adresse gefunden
			if($objTurnier)
			{

				\System::loadLanguageFile('tl_content'); // Sprachdateien laden

				// Kopfspalten der Ausgabetabelle erstellen
				$meldungen = array();
				$kopfspalten = unserialize($this->turnierbuero_colsView);
				foreach($kopfspalten as $spalte)
				{
					$meldungen[0][] = $GLOBALS['TL_LANG']['tl_content']['turnierbuero_colsView_array'][$spalte];
				}

				// Meldungen auslesen
				$objMeldung = \Database::getInstance()->prepare("SELECT * FROM tl_turnierbuero_teilnehmer WHERE pid=? AND published=? ORDER BY reportingDate ASC")
				                                      ->execute($this->turnierbuero_id, 1);

				if($objMeldung->numRows)
				{
					$index = 1;
					while($objMeldung->next())
					{
						// Meldungen entsprechend Anzahl ausgeben
						for($x = 1; $x <= $objMeldung->number; $x++)
						{
							// Daten in der richtigen Spaltenreihenfolge zuordnen
							foreach($kopfspalten as $spalte)
							{
								switch($spalte)
								{
									case 'number':
										$value = $index; break;
									case 'firstname':
										$value = $objMeldung->firstname; break;
									case 'lastname':
										$value = $objMeldung->lastname; break;
									case 'reportingDate':
										$value = date('d.m.Y', $objMeldung->reportingDate); break;
									case 'zugaustausch':
										$value = $objMeldung->zugaustausch; break;
									default:
										$value = '- unbekannt -';
								}
								$meldungen[$index][] = $value;
							}
							$index++;
						}
					}
				}

				
				// Daten in das Template schreiben
				$this->Template->meldungen       = $meldungen;
			}
		}

		return;

	}

}