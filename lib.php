<?php

// Każdy plik powinien mieć w nagłówku GPL i copyright - pomijamy to w tutorialach, ale naprawdę nie powinieneś tego pomijać.

// Ta linia chroni plik przed bezpośrednim dostępem z adresu URL.                                                             
defined('MOODLE_INTERNAL') || die();

// Będziemy tutaj dodawać wywołania zwrotne w miarę dodawania funkcji do naszego motywu.








function theme_boost_get_main_scss_content($theme) {                                                                                
    global $CFG;                                                                                                                    
                                                                                                                                    
    $scss = '';                                                                                                                     
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;                                                 
    $fs = get_file_storage();                                                                                                       
                                                                                                                                    
    $context = context_system::instance();                                                                                          
    if ($filename == 'default.scss') {                                                                                              
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    } else if ($filename == 'plain.scss') {                                                                                         
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');                                          
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_boost', 'preset', 0, '/', $filename))) {              
        $scss .= $presetfile->get_content();                                                                                        
    } else {                                                                                                                        
        // Awaria bezpieczeństwa - być może nowe instalacje itp.                                                                               
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    }                                                                                                                               
                                                                                                                                    
    return $scss;                                                                                                                   
}








function theme_boost_get_pre_scss($theme) {                                                                                         
    global $CFG;                                                                                                                    
                                                                                                                                    
    $scss = '';                                                                                                                     
    $configurable = [                                                                                                               
        // Klucz konfiguracyjny => [nazwa_zmiennej, ...].                                                                                     
        'brandcolor' => ['brand-primary'],                                                                                          
    ];                                                                                                                              
                                                                                                                                    
    // Najpierw dołącz zmienne.                                                                                                     
    foreach ($configurable as $configkey => $targets) {                                                                             
        $value = isset($theme->settings->{$configkey}) ? $theme->settings->{$configkey} : null;                                     
        if (empty($value)) {                                                                                                        
            continue;                                                                                                               
        }                                                                                                                           
        array_map(function($target) use (&$scss, $value) {                                                                          
            $scss .= '$' . $target . ': ' . $value . ";\n";                                                                         
        }, (array) $targets);                                                                                                       
    }                                                                                                                               
                                                                                                                                    
    // Dodaj pre-scss.                                                                                                            
    if (!empty($theme->settings->scsspre)) {                                                                                        
        $scss .= $theme->settings->scsspre;                                                                                         
    }                                                                                                                               
                                                                                                                                    
    return $scss;                                                                                                                   
}






// Funkcja zwracająca SCSS do dołączenia do naszego głównego SCSS dla tego motywu. Zauważ, 
// że nazwa funkcji zaczyna się od nazwy komponentu, ponieważ jest to funkcja globalna i nie chcemy kolizji przestrzeni nazw.
function first_theme_get_pre_scss($theme) {
    // Załaduj ustawienia z rodzica.                                                                                          
    $theme = theme_config::load('boost');                                                                                           
    // Wywołaj funkcję get_pre_scss motywów nadrzędnych.                                                                              
    return theme_boost_get_pre_scss($theme);                         
}






function theme_boost_get_extra_scss($theme) {                                                                                       
    return !empty($theme->settings->scss) ? $theme->settings->scss : '';                                                            
}





// Funkcja zwracająca SCSS do dołączenia do naszego głównego SCSS dla tego motywu.
// Zauważ, że nazwa funkcji zaczyna się od nazwy komponentu, ponieważ jest to funkcja globalna i nie chcemy kolizji przestrzeni nazw.
function first_theme_get_extra_scss($theme) {
    // Załaduj ustawienia z rodzica.                                                                                           
    $theme = theme_config::load('boost');                                                                                           
    // Wywołaj funkcję get_extra_scss motywów nadrzędnych.                                                                               
    return theme_boost_get_extra_scss($theme);                         
}



function first_theme_get_main_scss_content($theme) {                                                                                
    global $CFG;                                                                                                                    
                                                                                                                                    
    $scss = '';                                                                                                                     
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;                                                 
    $fs = get_file_storage();                                                                                                       
                                                                                                                                    
    $context = context_system::instance();                                                                                          
    if ($filename == 'default.scss') {                                                                                              
        // Nadal ładujemy domyślne pliki predefiniowane bezpośrednio z motywu boost. Nie ma sensu ich powielać.                    
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    } else if ($filename == 'plain.scss') {                                                                                         
        // Nadal ładujemy domyślne pliki predefiniowane bezpośrednio z motywu boost. Nie ma sensu ich powielać.                     
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');                                          
                                                                                                                                    
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'first_theme', 'preset', 0, '/', $filename))) {              
        // Ten plik predefiniowany został pobrany z obszaru plików dla first_theme, a nie theme_boost (patrz wiersz powyżej).             
        $scss .= $presetfile->get_content();                                                                                        
    } else {                                                                                                                        
        // Awaria bezpieczeństwa - być może nowe instalacje itp.                                                                               
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    }                                                                                                                                       
                                                                                                                                    
    return $scss;                                                                                                                   
}






function first_theme_get_main_scss_content($theme) {                                                                                
    global $CFG;                                                                                                                    
                                                                                                                                    
    $scss = '';                                                                                                                     
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;                                                 
    $fs = get_file_storage();                                                                                                       
                                                                                                                                    
    $context = context_system::instance();                                                                                          
    if ($filename == 'default.scss') {                                                                                              
        // Nadal ładujemy domyślne pliki predefiniowane bezpośrednio z motywu boost. Nie ma sensu ich powielać.                    
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    } else if ($filename == 'plain.scss') {                                                                                         
        // Nadal ładujemy domyślne pliki predefiniowane bezpośrednio z motywu boost. Nie ma sensu ich powielać.                     
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');                                          
                                                                                                                                    
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'first_theme', 'preset', 0, '/', $filename))) {              
        // Ten plik predefiniowany został pobrany z obszaru plików dla first_theme, a nie theme_boost (patrz wiersz powyżej).               
        $scss .= $presetfile->get_content();                                                                                        
    } else {                                                                                                                        
        // Awaria bezpieczeństwa - być może nowe instalacje itp.                                                                              
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    }                                                                                                                               
                                                                                                                                    
    // Pre CSS - to jest ładowane PO dowolnym prescss z ustawienia, ale przed głównym scss.                                       
    $pre = file_get_contents($CFG->dirroot . '/theme/photo/scss/pre.scss');                                                         
    // Post CSS - jest ładowany PO głównym scss, ale przed dodatkowym scss z ustawienia.                                   
    $post = file_get_contents($CFG->dirroot . '/theme/photo/scss/post.scss');                                                       
                                                                                                                                    
    // Połącz je razem.                                                                                                       
    return $pre . "\n" . $scss . "\n" . $post;                                                                                      
}








function first_theme_update_settings_images($settingname) {                                                                         
    global $CFG;                                                                                                                    
                                                                                                                                    
    // Nazwa ustawienia, która została zaktualizowana, ma postać ciągu, takiego jak „s_first_theme_loginbackgroundimage”. Podzieliliśmy to na znaki „_”.                                                                                            
    $parts = explode('_', $settingname);                                                                                            
    // I pobierz ostatni, aby uzyskać nazwę ustawienia..                                                                             
    $settingname = end($parts);                                                                                                     
                                                                                                                                    
    // Ustawienia administratora są przechowywane w kontekście systemowym.                                                                               
    $syscontext = context_system::instance();                                                                                       
    // To jest nazwa komponentu, w którym przechowywane jest ustawienie.                                                                        
    $component = 'first_theme';                                                                                                     
                                                                                                                                    
    // To jest wartość ustawienia administratora, która jest nazwą przesyłanego pliku.                                         
    $filename = get_config($component, $settingname);                                                                               
    // Wyodrębniamy rozszerzenie pliku, ponieważ chcemy je zachować.                                                               
    $extension = substr($filename, strrpos($filename, '.') + 1);                                                                    
                                                                                                                                    
    // To jest ścieżka w wewnętrznym systemie plików Moodle.                                                                        
    $fullpath = "/{$syscontext->id}/{$component}/{$settingname}/0{$filename}";                                                      
    // Pobierz instancję magazynu plików moodle.                                                                                  
    $fs = get_file_storage();                                                                                                       
    // Jest to skuteczny sposób na pobranie pliku, jeśli znamy dokładną ścieżkę.                                                            
    if ($file = $fs->get_file_by_hash(sha1($fullpath))) {                                                                           
        // Mamy zapisany plik - skopiuj go do dataroot. Ta lokalizacja odpowiada wyszukiwanej lokalizacji w theme_config::resolve_image_location.                                 
        $pathname = $CFG->dataroot . '/pix_plugins/theme/photo/' . $settingname . '.' . $extension;                                 
                                                                                                                                    
        // Ten wzorzec pasuje do wszystkich poprzednich plików z być może innymi rozszerzeniami.                                           
        $pathpattern = $CFG->dataroot . '/pix_plugins/theme/photo/' . $settingname . '.*';                                          
                                                                                                                                    
        // Upewnij się, że ten katalog istnieje.                                                                                               
        @mkdir($CFG->dataroot . '/pix_plugins/theme/photo/', $CFG->directorypermissions, true);                                      
                                                                                                                                    
        // Usuń wszystkie istniejące pliki dla tego ustawienia.                                                                              
        foreach (glob($pathpattern) as $filename) {                                                                                 
            @unlink($filename);                                                                                                     
        }                                                                                                                           
                                                                                                                                    
        // Skopiuj bieżący plik do tej lokalizacji.                                                                                 
        $file->copy_content_to($pathname);                                                                                          
    }                                                                                                                               
                                                                                                                                    
    // Zresetuj pamięć podręczną motywu.                                                                                                          
    theme_reset_all_caches();                                                                                                       
}