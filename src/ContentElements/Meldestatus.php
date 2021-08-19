<?php

namespace Schachbulle\ContaoTurnierbueroBundle\ContentElements;

class Meldestatus extends \ContentElement
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

		// Turniere aus Datenbank laden, wenn Turniertyp übergeben wurde
		if($this->turnierbuero_typid)
		{
			$objTurnier = \Database::getInstance()->prepare("SELECT * FROM tl_turnierbuero WHERE tournamentType = ? AND published = ?")
			                                      ->execute($this->turnierbuero_typid, 1);

			// Turniere gefunden
			if($objTurnier->numRows)
			{

				\System::loadLanguageFile('tl_content'); // Sprachdateien laden

				// Kopfspalten der Ausgabetabelle erstellen
				$meldungen = array();
				$kopfspalten = unserialize($this->turnierbuero_typView);
				if(!is_array($kopfspalten)) return;
				
				foreach($kopfspalten as $spalte)
				{
					$meldungen[0][] = $GLOBALS['TL_LANG']['tl_content']['turnierbuero_typView_array'][$spalte];
				}

				$index = 1;
				while($objTurnier->next())
				{

					// Meldungen auslesen
					$objMeldung = \Database::getInstance()->prepare("SELECT * FROM tl_turnierbuero_teilnehmer WHERE pid = ? AND published = ?")
					                                      ->execute($objTurnier->id, 1);

					// Meldungen zählen
					$anzahl = 0;
					if($objMeldung->numRows)
					{
						while($objMeldung->next())
						{
							for($x = 1; $x <= $objMeldung->number; $x++)
							{
								$anzahl++;
							}
						}
					}

					// Turnier speichern
					foreach($kopfspalten as $spalte)
					{
						switch($spalte)
						{
							case 'name':
								$value = $objTurnier->title; break;
							case 'kennzeichen':
								$value = $objTurnier->kennzeichen; break;
							case 'soll':
								$value = $objTurnier->meldesoll; break;
							case 'ist':
								$value = $anzahl; break;
							case 'variante':
								$value = $objTurnier->thema ? $objTurnier->themaName : ''; break;
							case 'zugaustausch':
								$value = $objTurnier->zugaustausch; break;
							default:
								$value = '- unbekannt -';
						}
						$meldungen[$index][] = $value;
					}
					$index++;
				}

				// Daten in das Template schreiben
				$this->Template->meldungen       = $meldungen;
			}
		}

		return;

	}

}