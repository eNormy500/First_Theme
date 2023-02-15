<?php

// Każdy plik powinien mieć w nagłówku GPL i copyright - pomijamy to w tutorialach, ale naprawdę nie powinieneś tego pomijać.

// Ta linia chroni plik przed bezpośrednim dostępem z adresu URL.                                                              
defined('MOODLE_INTERNAL') || die();                                                                                                
                                                                                                                                    
// Jest to używane do wydajności, nie musimy wiedzieć o tych ustawieniach na każdej stronie w Moodle, tylko wtedy, gdy patrzymy na strony ustawień administratora.                             
if ($ADMIN->fulltree) {                                                                                                             
                                                                                                                                    
    // Boost zapewnia ładną stronę ustawień, która dzieli ustawienia na osobne zakładki. Chcemy to tutaj wykorzystać.                       
    $settings = new theme_boost_admin_settingspage_tabs('themesettingphoto', get_string('configtitle', 'first_theme'));             
                                                                                                                                    
    // Każda strona to karta — pierwsza to zakładka „Ogólne”.                                                                       
    $page = new admin_settingpage('first_theme_general', get_string('generalsettings', 'first_theme'));                             
                                                                                                                                    
    // Zreplikuj ustawienie wstępne z boost.                                                                                     
    $name = 'first_theme/preset';                                                                                                   
    $title = get_string('preset', 'first_theme');                                                                                   
    $description = get_string('preset_desc', 'first_theme');                                                                        
    $default = 'default.scss';                                                                                                      
                                                                                                                                    
    // Wymieniamy pliki w naszym własnym obszarze plików, aby dodać je do listy rozwijanej.
    // Dostarczymy własną funkcję do ładowania wszystkich ustawień wstępnych z właściwych ścieżek.                                   
    $context = context_system::instance();                                                                                          
    $fs = get_file_storage();                                                                                                       
    $files = $fs->get_area_files($context->id, 'first_theme', 'preset', 0, 'itemid, filepath, filename', false);                    
                                                                                                                                    
    $choices = [];                                                                                                                  
    foreach ($files as $file) {                                                                                                     
        $choices[$file->get_filename()] = $file->get_filename();                                                                    
    }                                                                                                                               
    // To są wbudowane ustawienia wstępne z Boost.                                                                                   
    $choices['default.scss'] = 'default.scss';                                                                                      
    $choices['plain.scss'] = 'plain.scss';                                                                                          
                                                                                                                                    
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);                                     
    $setting->set_updatedcallback('theme_reset_all_caches');                                                                        
    $page->add($setting);                                                                                                           
                                                                                                                                    
    // Ustawienia plików predefiniowanych.                                                                                                      
    $name = 'first_theme/presetfiles';                                                                                              
    $title = get_string('presetfiles','first_theme');                                                                               
    $description = get_string('presetfiles_desc', 'first_theme');                                                                   
                                                                                                                                    
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,                                         
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));                                                               
    $page->add($setting);     

    // Zmienna $brand-color. Używamy pustej wartości domyślnej, ponieważ domyślny kolor powinien pochodzić z ustawienia wstępnego.                                      
    $name = 'first_theme/brandcolor';                                                                                               
    $title = get_string('brandcolor', 'first_theme');                                                                               
    $description = get_string('brandcolor_desc', 'first_theme');                                                                    
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');                                               
    $setting->set_updatedcallback('theme_reset_all_caches');                                                                        
    $page->add($setting);                                                                                                           
                                                                                                                                    
    // Musisz dodać stronę po zdefiniowaniu wszystkich ustawień!                                                                     
    $settings->add($page);                                                                                                          
                                                                                                                                    
    // Zaawansowane ustawienia.                                                                                                          
    $page = new admin_settingpage('first_theme_advanced', get_string('advancedsettings', 'first_theme'));                           
                                                                                                                                    
    // Surowy SCSS do umieszczenia przed treścią.                                                                                     
    $setting = new admin_setting_configtextarea('first_theme/scsspre',                                                              
        get_string('rawscsspre', 'first_theme'), get_string('rawscsspre_desc', 'first_theme'), '', PARAM_RAW);                      
    $setting->set_updatedcallback('theme_reset_all_caches');                                                                        
    $page->add($setting);                                                                                                           
                                                                                                                                    
    // Surowy SCSS do dołączenia po treści.                                                                                     
    $setting = new admin_setting_configtextarea('first_theme/scss', get_string('rawscss', 'first_theme'),                           
        get_string('rawscss_desc', 'first_theme'), '', PARAM_RAW);                                                                  
    $setting->set_updatedcallback('theme_reset_all_caches');                                                                        
    $page->add($setting);                                                                                                           
                                                                                                                                    
    $settings->add($page);                                                                                                          
}







// Ustawienie tła strony logowania.
     // Używamy zmiennych dla czytelności.                                                                                           
    $name = 'first_theme/loginbackgroundimage';                                                                                     
    $title = get_string('loginbackgroundimage', 'first_theme');                                                                     
    $description = get_string('loginbackgroundimage_desc', 'first_theme');                                                          
    // Spowoduje to utworzenie nowego ustawienia.                                                                                               
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackgroundimage');                             
    // Oznacza to, że pamięć podręczna motywu zostanie automatycznie wyczyszczona po zmianie tego ustawienia.                                    
    $setting->set_updatedcallback('theme_reset_all_caches');                                                                        
    // Zawsze musimy dodać ustawienie do strony, aby odniosło ono jakikolwiek skutek.                                                      
    $page->add($setting);






    // Ustawienie tła strony logowania. Używamy zmiennych dla czytelności.                                                                                           
    $name = 'first_theme/loginbackgroundimage';                                                                                     
    $title = get_string('loginbackgroundimage', 'first_theme');                                                                     
    $description = get_string('loginbackgroundimage_desc', 'first_theme');                                                          
    // Spowoduje to utworzenie nowego ustawienia.                                                                                                
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackgroundimage');                             
    // Ta funkcja skopiuje obraz do lokalizacji data_root, z której może być obsługiwany.                                         
    $setting->set_updatedcallback('first_theme_update_settings_images');                                                            
    // Zawsze musimy dodać ustawienie do strony, aby odniosło ono jakikolwiek skutek.                                                      
    $page->add($setting);