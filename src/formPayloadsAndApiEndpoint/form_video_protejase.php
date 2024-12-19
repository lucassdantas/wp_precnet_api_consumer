<?php 
if (!defined( 'ABSPATH')) exit;

$apiEndpoint = 'forms/credor-video-protecao';
$payload = [
  "nome" => $fields['nome'] ?? '',
  "telefone" => $fields['telefone'] ?? '',
  "email" => $fields['email'] ?? '',
  "no_proc_pagamento" => $fields['no_proc_pagamento'] ?? '',
  "tel_sms" => $fields['tel_sms'] ?? '',
  "opcoes" => [
      "id_em_relacao_ao_precatorio_voce_eh" => $map_relacao_precatorio[$fields['em_relacao_ao_precatorio_voce_e']] ?? 0,
  ],
];
