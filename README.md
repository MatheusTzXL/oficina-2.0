# Oficina 2.0 🚗🛠️

Sistema simples de orçamentos para oficina mecânica, desenvolvido como prova de conceito para a Codificar.

---

## 📌 Objetivo

Ajudar oficinas mecânicas a organizarem seus pedidos de orçamento de forma digital, substituindo o papel por um sistema web moderno e prático.

---

## 🛠️ Tecnologias Utilizadas

-   **Back-end:** Laravel 12.x (PHP)
-   **Front-end:** Vue.js 3 + Vite
-   **Estilo:** TailwindCSS
-   **Banco de dados:** MySQL (via XAMPP)
-   **Outros:** Laravel Vite Plugin

---

## ✅ Funcionalidades

-   Cadastro, edição, visualização e exclusão de orçamentos (CRUD)
-   Filtros por:
    -   Intervalo de datas
    -   Nome do cliente
    -   Nome do vendedor
-   Paginação de resultados
-   Validações com `FormRequest`
-   Mensagens de sucesso e erro amigáveis
-   API separada para consumo com Vue.js

---

## 🧩 Estrutura do Projeto

-   `app/Http/Controllers/` – Controladores do Laravel (Web e API)
-   `resources/js/` – Aplicação Vue.js
-   `resources/views/` – Blade layouts e fallback
-   `routes/web.php` – Rotas para acesso via navegador
-   `routes/api.php` – Rotas da API RESTful

---

## 🚀 Como rodar o projeto localmente

### 1. Clone o repositório

````bash
git clone https://github.com/MatheusTzXL/oficina-2.0.git
cd oficina-2.0

### 2. Instale as dependências PHP
```bash
composer install

### 3. Instale as dependências Node.js
```bash
npm install

### 4. Configure o ambiente
```bash
cp .env.example .env

### 5. Gere a chave do Laravel
```bash
php artisan key:generate

### 6. Rode as migrations
```bash
php artisan migrate

### 7. Rode os servidores
```bash
php artisan serve
npm run dev

---

## 📂 Observações

O projeto foi desenvolvido com foco na clareza do código e boas práticas.

O design é limpo, moderno e responsivo.

Toda a API está pronta para ser consumida por qualquer front-end moderno.

Foi utilizado RouteServiceProvider para organização das rotas.

---

## 👤 Desenvolvedor

Matheus Ferreira

---

## 📃 Licença

Este projeto é de uso exclusivo para fins de teste técnico.
````
