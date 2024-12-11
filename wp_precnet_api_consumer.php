<?php 
/**
 * Plugin Name: Precnet Api Consumer
 * Description: Plugin to send elementor form to API
 * Plugin URI:  https://github.com/lucassdantas/wp_precnet_api_consumer.git
 * Version:     1.0.0
 * Author:      RD Exclusive
 * Author URI:  https://www.rdexclusive.com.br
 */

 
if (!defined( 'ABSPATH' ))   exit;
if(!function_exists('add_action')) die;
add_action('elementor_pro/forms/new_record', function($record, $ajax_handler) {
  require_once plugin_dir_path(__FILE__) . 'src/apiData.php';

  $form_name = $record->get_form_settings('form_name');
  if ('formulario_credor_precnet' !== $form_name) {
      return;
  }

  $raw_fields = $record->get('fields');
  $fields = [];
  foreach ($raw_fields as $id => $field) {
      $fields[$id] = $field['value'];
  }
  $payload = [
      "nome" => $fields['nome'] ?? '',
      "telefone" => $fields['telefone'] ?? '',
      "email" => $fields['email'] ?? '',
      "opcoes" => [
          "id_valor_precatorio" => (int) $fields['qual_o_valor_do_precatorio'] ?? 0,
          "id_em_relacao_ao_precatorio_voce_eh" => (int) $fields['em_relacao_ao_precatorio_voce_e'] ?? 0,
          "id_tipo_precatorio" => (int) $fields['seu_precatorio_e'] ?? 0,
          "id_previsao_vencimento" => (int) $fields['ano_recebimento'] ?? 0,
      ],
  ];

  $headers = [
      'Content-Type: application/json',
      'Authorization: Bearer ' . $token,
  ];

  $response = wp_remote_post($apiUrl, [
      'headers' => $headers,
      'body' => json_encode($payload),
  ]);

  if( is_wp_error( $response ) ) {
    $ajax_handler->data['output'] = $response->get_error_message();
} else {
    // A resposta está no corpo (body) da resposta
    $ajax_handler->data['output'] = wp_remote_retrieve_body( $response );
}
}, 10, 2);
