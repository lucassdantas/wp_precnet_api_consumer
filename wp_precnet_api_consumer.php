<?php 
/**
 * Plugin Name: Precnet Api Consumer
 * Description: Plugin to send elementor form to API
 * Plugin URI:  https://github.com/lucassdantas/wp_precnet_api_consumer.git
 * Version:     1.0.0
 * Author:      RD Exclusive
 * Author URI:  https://www.rdexclusive.com.br
 */

if (!defined('ABSPATH')) exit;
if (!function_exists('add_action')) die;

add_action('elementor_pro/forms/new_record', function ($record, $ajax_handler) {
    require_once plugin_dir_path(__FILE__) . 'src/apiData.php';
    require_once plugin_dir_path(__FILE__) . 'src/formOptionsData.php';
    $headers = [
      'Content-Type' => 'application/json',
      "Authorization" => $token,
    ];
    $raw_fields = $record->get('fields');
    $fields = [];
    $form_name = $record->get_form_settings('form_name');
    
    foreach ($raw_fields as $id => $field) {$fields[$id] = $field['value'];}
    
    if ('formulario_credor_precnet' == $form_name) require_once plugin_dir_path(__FILE__) . 'src/formPayloadsAndApiEndpoint/form_credor_precnet.php';
    if ('formulario_video_protejase'== $form_name) require_once plugin_dir_path(__FILE__) . 'src/formPayloadsAndApiEndpoint/form_video_protejase.php';
    if ('formulario_consulta'       == $form_name) require_once plugin_dir_path(__FILE__) . 'src/formPayloadsAndApiEndpoint/form_consulta.php';

    $response = wp_remote_post($apiUrl.$apiEndpoint, [
        'headers' => $headers,
        'body' => json_encode($payload),
    ]);

    if (is_wp_error($response)) $ajax_handler->data['output'] = $response->get_error_message(); 
    else $ajax_handler->data['output'] = wp_remote_retrieve_body($response);
}, 10, 2);
