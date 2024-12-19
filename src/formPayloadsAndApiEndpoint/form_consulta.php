<?php 
if (!defined( 'ABSPATH')) exit;

$apiEndpoint = 'forms/credor-consulta';
$payload = [
  "nome" => $fields['nome'] ?? '',
  "telefone" => $fields['telefone'] ?? '',
  "no_proc_pagamento" => $fields['no_proc_pagamento'] ?? '',
  "tel_sms" => $fields['tel_sms'] ?? '',
  "primeiro_nome" => $fields['primeiro_nome'] ?? '',
  "requerido" => $fields['requerido'] ?? '',
  "tribunal" => $fields['tribunal'] ?? '',
  "opcoes" => [
      "id_em_relacao_ao_precatorio_voce_eh" => $map_relacao_precatorio[$fields['em_relacao_ao_precatorio_voce_e']] ?? 0,
  ],
];