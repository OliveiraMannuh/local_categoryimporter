# Moodle Bulk Category Import Plugin | Plugin Importar Categorias

Um plugin para importação em massa de categorias no Moodle através de arquivos CSV.

## Funcionalidades

- Importação de múltiplas categorias e subcategorias via arquivo CSV
- Suporte à estrutura hierárquica de categorias
- Validação de dados antes da importação
- Interface amigável para upload de arquivos
- Mapeamento automático de categorias pai/filho
- Suporte a caracteres especiais e acentuação
- Tradução completa para Português do Brasil (pt_BR)

## Traduções
Português do Brasil (pt_BR)
O plugin possui tradução completa para o português do Brasil, incluindo:

Interface administrativa
Mensagens de erro e sucesso
Logs do sistema
Tooltips e ajudas contextuais
Documentação integrada

A tradução foi realizada seguindo os padrões oficiais do Moodle para o português do Brasil e está disponível por padrão na instalação. O pacote de idiomas é mantido pela comunidade brasileira do Moodle e é atualizado regularmente.


## Requisitos

### Requisitos do Sistema
- Moodle 3.9 ou superior
- PHP 7.4 ou superior
- Extensão PHP ZIP habilitada
- Permissões de escrita na pasta moodledata

### Permissões Necessárias
O usuário deve ter as seguintes capacidades no Moodle:
- moodle/category:manage
- moodle/course:create
- moodle/backup:backupcourse
- moodle/restore:restorecourse

## Instalação

1. Faça o download do plugin
2. Acesse como administrador o seu Moodle
3. Vá para Administração do site > Plugins > Instalar plugins
4. Faça upload do arquivo ZIP do plugin
5. Siga as instruções de instalação

## Formato do Arquivo CSV

O arquivo CSV deve seguir o seguinte formato:

```csv
name,description,idnumber,category_path
Categoria 0,Categoria inicial,CAT003,Departamentos/TI
Categoria 1,,CAT003,Departamentos/TI
Subcategoria 1,,,Departamentos/TI/Desenvolvimento
```

- name: Nome da categoria
- description: Descrição da categoria (opcional)
- idnumber: Um código de identificação para a categoria (opcional)
- category_path: Raiz do caminho da categoria

## Uso

1. Acesse Administração do site > Plugins → Plugins locais → Importar Categorias
2. Faça upload do arquivo CSV
3. Confirme a importação

## Solução de Problemas

### Erros Comuns

1. Arquivo CSV mal formatado
   - Verifique a codificação do arquivo (deve ser UTF-8)
   - Confirme se os campos estão corretamente delimitados

2. Problemas de Permissão
   - Verifique se o usuário tem todas as permissões necessárias
   - Confirme as permissões de escrita no sistema de arquivos

3. Categorias Duplicadas
   - Verifique se os IDs são únicos
   - Confirme se não há nomes duplicados no mesmo nível

## Suporte

Para suporte técnico ou relatar problemas:
- Abra uma issue no repositório do GitHub
- Contate o suporte através do fórum do Moodle
- Consulte a documentação oficial do plugin

## Licença

Este plugin é distribuído sob a licença GPL v3.0.

## Contribuição

Contribuições são bem-vindas! Por favor:
1. Faça fork do repositório
2. Crie uma branch para sua feature
3. Envie um pull request

## Changelog

### v1.0.0 (2024-02-06)
- Lançamento inicial
- Suporte básico à importação de categorias
- Interface administrativa