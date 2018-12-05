<?php
global $jwtheme_topclass;
$sections = $jwtheme_topclass['jwtheme_sections_order'];
if (!is_array($sections)) {
    $sections = jwtheme_get_enabled_sections();
}
if (empty($sections)) {
    $sections = jwtheme_get_all_sections();
}
foreach ($sections as $section_id => $name) {
    $section_id = str_replace("_", "-", $section_id);
    if (file_exists( dirname(__FILE__) . "/sections/{$section_id}.php")){
        get_template_part("sections/{$section_id}");
    }
}
?>