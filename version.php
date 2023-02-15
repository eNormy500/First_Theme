<?php
// Każdy plik powinien mieć w nagłówku GPL i copyright - pomijamy to w tutorialach, ale naprawdę nie powinieneś tego pomijać.

// Ta linia chroni plik przed bezpośrednim dostępem z adresu URL.                                                              
defined('MOODLE_INTERNAL') || die();                                                                                                
                                                                                                                                    
// To jest wersja wtyczki.                                                                                              
$plugin->version = '2016102100';                                                                                                    
                                                                                                                                    
// To jest wersja Moodle, której wymaga ta wtyczka.                                                                              
$plugin->requires = '2016112900.00';                                                                                                   
                                                                                                                                    
// To jest nazwa komponentu wtyczki — zawsze zaczyna się od „theme_” dla motywów i powinna być taka sama jak nazwa folderu.                                                                  
$plugin->component = 'theme_first_theme';                                                                                                 
                                                                                                                                    
// To jest lista wtyczek, od których zależy ta wtyczka (i ich wersje).                                                          
$plugin->dependencies = [                                                                                                           
    'theme_boost' => '2016102100'                                                                                                   
];