# Teste

Este projeto segue uma arquitetura baseada em **DDD (Domain-Driven Design)**, utilizando princípios de **SOLID** e padrões de design (**Design Patterns**). Está preparado para rodar em um ambiente **Docker**.

## Estrutura do Projeto

- **APIs**: A lógica de APIs está organizada dentro da pasta `app/Domain`. Nesta pasta estão os serviços, repositórios e entidades, seguindo o padrão **DDD**, isolando a lógica de negócios da aplicação.
  
  **Localização**: `app/Domain`
  
- **Web Controllers**: Toda a lógica relacionada a requisições web e controladores HTTP pode ser encontrada em `app/Http/Controllers`. Esses controladores são responsáveis por interagir com o frontend ou outros consumidores da API.

  **Localização**: `app/Http/Controllers`

## Tecnologias e Ferramentas

- **PHP 7.x/8.x**
- **Laravel** como framework base
- **Docker** para ambiente de desenvolvimento
- **Composer** para gerenciar dependências
- **MySQL/PostgreSQL** ou outro banco de dados configurado via Docker
- **Nginx** para servir a aplicação via Docker

## Padrões e Arquitetura

Este projeto segue uma série de **princípios de arquitetura** e **boas práticas**, como:

- **DDD (Domain-Driven Design)**: A lógica de negócios é encapsulada dentro do domínio (`app/Domain`), mantendo uma separação clara entre as diferentes camadas da aplicação.
  
- **SOLID**: O projeto foi desenvolvido seguindo os princípios de **SOLID**, garantindo que o código seja fácil de manter, estender e testar.

- **Design Patterns**: Padrões de design como **Repository Pattern**, **Service Layer** e **Dependency Injection** são amplamente utilizados para manter o código limpo e modular.

## Pré-requisitos

Certifique-se de ter o **Docker** e o **Docker Compose** instalados em sua máquina. Se ainda não tiver instalado, consulte a [documentação oficial do Docker](https://docs.docker.com/get-docker/).

## Como Rodar o Projeto

### 1. Clonando o Repositório

No terminal, vá até o diretório onde deseja clonar o projeto e execute:

```bash
git clone https://github.com/gustavossouza/teste-back-end.git
cd teste-back-end
```

### 2. Subindo os Contêineres Docker

Para rodar a aplicação em contêineres Docker, siga os seguintes passos:

Inicie os contêineres:

```bash
docker-compose up -d
```

### 3. Instalar Dependências

Dentro do contêiner, execute:

```bash
composer install
```

### 4. Configurar o Ambiente

```bash
mv .env-example .env
```

### 5. Gerar a Chave da Aplicação

Execute o seguinte comando para gerar uma nova chave para a aplicação:

```bash
php artisan key:generate
```

### 6. Executar Migrações

Execute as migrações para preparar o banco de dados:

```bash
php artisan migrate
```

### 7. Acessar o Projeto

Agora, abra o navegador e acesse a aplicação em:

```bash
http://localhost
```

### Conclusão:

Esse arquivo **README.md** agora está formatado corretamente em **Markdown** e pronto para ser usado no seu repositório. Se precisar de mais alguma coisa, estou à disposição!
