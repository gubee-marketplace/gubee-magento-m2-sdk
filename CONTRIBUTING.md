# Contributing

## Antes de abrir PR

- use uma branch por mudança
- mantenha commits pequenos e coerentes
- rode `composer cs`
- rode `composer test`

## Issues

Use os formulários do repositório:

- bug report para defeitos reproduzíveis
- feature request para novas capacidades

Inclua contexto suficiente para reprodução, impacto e comportamento esperado.

## Pull Requests

- descreva o problema resolvido
- explique a abordagem adotada
- aponte riscos, compatibilidade e gaps conhecidos
- mantenha a PR focada em um único objetivo

## Padrões locais

- PHP `^8.0`
- siga os scripts definidos em `composer.json`
- preserve compatibilidade pública do SDK quando possível

## Checklist rápido

- testes passando
- lint passando
- documentação atualizada quando necessário
- sem arquivos locais ou artefatos temporários no diff
