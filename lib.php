<?php

// Every file should have GPL and copyright in the header - we skip it in tutorials but you should not skip it for real.

// This line protects the file from being accessed by a URL directly.                                                               
defined('MOODLE_INTERNAL') || die();

// We will add callbacks here as we add features to our theme.








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
        // Safety fallback - maybe new installs etc.                                                                                
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    }                                                                                                                               
                                                                                                                                    
    return $scss;                                                                                                                   
}








function theme_boost_get_pre_scss($theme) {                                                                                         
    global $CFG;                                                                                                                    
                                                                                                                                    
    $scss = '';                                                                                                                     
    $configurable = [                                                                                                               
        // Config key => [variableName, ...].                                                                                       
        'brandcolor' => ['brand-primary'],                                                                                          
    ];                                                                                                                              
                                                                                                                                    
    // Prepend variables first.                                                                                                     
    foreach ($configurable as $configkey => $targets) {                                                                             
        $value = isset($theme->settings->{$configkey}) ? $theme->settings->{$configkey} : null;                                     
        if (empty($value)) {                                                                                                        
            continue;                                                                                                               
        }                                                                                                                           
        array_map(function($target) use (&$scss, $value) {                                                                          
            $scss .= '$' . $target . ': ' . $value . ";\n";                                                                         
        }, (array) $targets);                                                                                                       
    }                                                                                                                               
                                                                                                                                    
    // Prepend pre-scss.                                                                                                            
    if (!empty($theme->settings->scsspre)) {                                                                                        
        $scss .= $theme->settings->scsspre;                                                                                         
    }                                                                                                                               
                                                                                                                                    
    return $scss;                                                                                                                   
}






// Function to return the SCSS to prepend to our main SCSS for this theme.
// Note the function name starts with the component name because this is a global function and we don't want namespace clashes.
function first_theme_get_pre_scss($theme) {
    // Load the settings from the parent.                                                                                           
    $theme = theme_config::load('boost');                                                                                           
    // Call the parent themes get_pre_scss function.                                                                                
    return theme_boost_get_pre_scss($theme);                         
}






function theme_boost_get_extra_scss($theme) {                                                                                       
    return !empty($theme->settings->scss) ? $theme->settings->scss : '';                                                            
}





// Function to return the SCSS to append to our main SCSS for this theme.
// Note the function name starts with the component name because this is a global function and we don't want namespace clashes.
function first_theme_get_extra_scss($theme) {
    // Load the settings from the parent.                                                                                           
    $theme = theme_config::load('boost');                                                                                           
    // Call the parent themes get_extra_scss function.                                                                                
    return theme_boost_get_extra_scss($theme);                         
}



function first_theme_get_main_scss_content($theme) {                                                                                
    global $CFG;                                                                                                                    
                                                                                                                                    
    $scss = '';                                                                                                                     
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;                                                 
    $fs = get_file_storage();                                                                                                       
                                                                                                                                    
    $context = context_system::instance();                                                                                          
    if ($filename == 'default.scss') {                                                                                              
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.                      
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    } else if ($filename == 'plain.scss') {                                                                                         
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.                      
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');                                          
                                                                                                                                    
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'first_theme', 'preset', 0, '/', $filename))) {              
        // This preset file was fetched from the file area for first_theme and not theme_boost (see the line above).                
        $scss .= $presetfile->get_content();                                                                                        
    } else {                                                                                                                        
        // Safety fallback - maybe new installs etc.                                                                                
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
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.                      
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    } else if ($filename == 'plain.scss') {                                                                                         
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.                      
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');                                          
                                                                                                                                    
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'first_theme', 'preset', 0, '/', $filename))) {              
        // This preset file was fetched from the file area for first_theme and not theme_boost (see the line above).                
        $scss .= $presetfile->get_content();                                                                                        
    } else {                                                                                                                        
        // Safety fallback - maybe new installs etc.                                                                                
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    }                                                                                                                               
                                                                                                                                    
    // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.                                        
    $pre = file_get_contents($CFG->dirroot . '/theme/photo/scss/pre.scss');                                                         
    // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.                                    
    $post = file_get_contents($CFG->dirroot . '/theme/photo/scss/post.scss');                                                       
                                                                                                                                    
    // Combine them together.                                                                                                       
    return $pre . "\n" . $scss . "\n" . $post;                                                                                      
}








function first_theme_update_settings_images($settingname) {                                                                         
    global $CFG;                                                                                                                    
                                                                                                                                    
    // The setting name that was updated comes as a string like 's_first_theme_loginbackgroundimage'.                               
    // We split it on '_' characters.                                                                                               
    $parts = explode('_', $settingname);                                                                                            
    // And get the last one to get the setting name..                                                                               
    $settingname = end($parts);                                                                                                     
                                                                                                                                    
    // Admin settings are stored in system context.                                                                                 
    $syscontext = context_system::instance();                                                                                       
    // This is the component name the setting is stored in.                                                                         
    $component = 'first_theme';                                                                                                     
                                                                                                                                    
    // This is the value of the admin setting which is the filename of the uploaded file.                                           
    $filename = get_config($component, $settingname);                                                                               
    // We extract the file extension because we want to preserve it.                                                                
    $extension = substr($filename, strrpos($filename, '.') + 1);                                                                    
                                                                                                                                    
    // This is the path in the moodle internal file system.                                                                         
    $fullpath = "/{$syscontext->id}/{$component}/{$settingname}/0{$filename}";                                                      
    // Get an instance of the moodle file storage.                                                                                  
    $fs = get_file_storage();                                                                                                       
    // This is an efficient way to get a file if we know the exact path.                                                            
    if ($file = $fs->get_file_by_hash(sha1($fullpath))) {                                                                           
        // We got the stored file - copy it to dataroot.                                                                            
        // This location matches the searched for location in theme_config::resolve_image_location.                                 
        $pathname = $CFG->dataroot . '/pix_plugins/theme/photo/' . $settingname . '.' . $extension;                                 
                                                                                                                                    
        // This pattern matches any previous files with maybe different file extensions.                                            
        $pathpattern = $CFG->dataroot . '/pix_plugins/theme/photo/' . $settingname . '.*';                                          
                                                                                                                                    
        // Make sure this dir exists.                                                                                               
        @mkdir($CFG->dataroot . '/pix_plugins/theme/photo/', $CFG->directorypermissions, true);                                      
                                                                                                                                    
        // Delete any existing files for this setting.                                                                              
        foreach (glob($pathpattern) as $filename) {                                                                                 
            @unlink($filename);                                                                                                     
        }                                                                                                                           
                                                                                                                                    
        // Copy the current file to this location.                                                                                  
        $file->copy_content_to($pathname);                                                                                          
    }                                                                                                                               
                                                                                                                                    
    // Reset theme caches.                                                                                                          
    theme_reset_all_caches();                                                                                                       
}