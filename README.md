# Teste Técnico GVD Soluções

## Estrutura Banco de Dados

- Tabela **users**

```sql
CREATE TABLE users (user_id INTEGER PRIMARY KEY, name TEXT, email TEXT NOT NULL UNIQUE, age INT);
```

### Execução

1. Abra o terminal na raiz do projeto.
2. Rode o comando `php -a`
3. Cole a variável PDO com o comando `$pdo = new PDO("sqlite:" . __DIR__ . "/database.sqlite");`
4. Execute `$pdo->exec("CREATE TABLE users (user_id INTEGER PRIMARY KEY, name TEXT, email TEXT NOT NULL UNIQUE, age INT);");`

## Visualização

Utilize o comando abaixo para iniciar o servidor embutido do PHP.

```PHP
php -S localhost:7070 -t public
```

Acesse (localhost:7070)[localhost:7070]
