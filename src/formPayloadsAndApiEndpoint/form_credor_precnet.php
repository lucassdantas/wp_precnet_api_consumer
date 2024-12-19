<?php 
if (!defined( 'ABSPATH')) exit;

$apiEndpoint = 'forms/credor';
$payload = [
  "nome" => $fields['nome'] ?? '',
  "telefone" => $fields['telefone'] ?? '',
  "email" => $fields['email'] ?? '',
  "opcoes" => [
      "id_valor_precatorio" => $map_valor_precatorio[$fields['qual_o_valor_do_precatorio']] ?? 0,
      "id_em_relacao_ao_precatorio_voce_eh" => $map_relacao_precatorio[$fields['em_relacao_ao_precatorio_voce_e']] ?? 0,
      "id_tipo_precatorio" => $map_tipo_precatorio[$fields['seu_precatorio_e']] ?? 0,
      "id_previsao_vencimento" => $map_ano_recebimento[$fields['ano_recebimento']] ?? 0,
  ],
];
