# ✂️ Xurupis — Plataforma de Agendamento para Barbearia

Plataforma web desenvolvida para gerenciamento completo de uma barbearia, permitindo que clientes agendem serviços online e barbeiros gerenciem sua agenda e serviços oferecidos.

---

## 📋 Sobre o Projeto

O sistema **Xurupis** é uma aplicação full-stack construída com Laravel 10, voltada para barbearias que desejam digitalizar seu processo de agendamento. A plataforma possui dois perfis de acesso distintos — **barbeiro** e **cliente** — cada um com seu próprio painel e funcionalidades.

---

## 🚀 Funcionalidades

### Cliente
- Cadastro e autenticação
- Agendamento de serviços com escolha de barbeiro, serviço, data e hora
- Visualização dos próprios agendamentos
- Validação de horários conforme funcionamento da barbearia

### Barbeiro
- Cadastro e autenticação
- Gerenciamento de serviços (criar, editar, visualizar, excluir)
- Visualização de todos os agendamentos recebidos
- Atualização de status dos agendamentos (Confirmado / Concluído / Cancelado)
- Agendamentos ordenados por status (confirmados primeiro, concluídos por último)

### Regras de Negócio
- Prevenção de conflito de horários (mesmo barbeiro, mesma data e hora)
- Validação de horário de funcionamento:
  - Segunda a Sexta: 09h às 20h
  - Sábado: 09h às 18h
  - Domingo: Fechado
- Agendamentos cancelados não são exibidos nas listagens

---

## 🛠️ Tecnologias

- **PHP 8.1+**
- **Laravel 10**
- **MySQL**
- **Blade** (template engine)
- **Bootstrap 5.3**

---

## ⚙️ Instalação

### Pré-requisitos
- PHP >= 8.1
- Composer
- MySQL
- Laragon (recomendado)

### Passo a passo

**1. Clone o repositório**
```bash
git clone https://github.com/jvsobroza/Plataforma-Agendamento-Barbearia.git
cd Plataforma-Agendamento-Barbearia
```

**2. Instale as dependências PHP**
```bash
composer install
```

**3. Crie o banco de dados `barbearia` pelo HeidiSQL ou pelo terminal:**
```sql
CREATE DATABASE barbearia;
```

**4. Execute as migrations**
```bash
php artisan migrate
```

**5. Inicie o servidor**
```bash
php artisan serve
```

Acesse em: `http://localhost:8000`

---

## 🗂️ Estrutura de Rotas

| Prefixo | Middleware | Acesso |
|---|---|---|
| `/barbeiro/*` | `CheckBarbeiro` | Somente barbeiros (`tipo = 1`) |
| `/cliente/*` | `CheckCliente` | Somente clientes (`tipo = 2`) |
| `/login`, `/register` | — | Público |

---

## 👤 Perfis de Usuário

| Campo | Barbeiro | Cliente |
|---|---|---|
| `tipo` | `1` | `2` |
| Dados extras | Telefone | Endereço |
| Painel | `/barbeiro` | `/cliente` |

---

## 📁 Estrutura Principal

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AgendamentoController.php
│   │   ├── BarbeiroController.php
│   │   ├── ClienteController.php
│   │   ├── ServicoController.php
│   │   └── UserController.php
│   ├── Middleware/
│   │   ├── CheckBarbeiro.php
│   │   └── CheckCliente.php
│   └── Requests/
│       ├── StoreAgendamentoRequest.php
│       └── UpdateAgendamentoRequest.php
├── Models/
│   ├── Agendamento.php
│   ├── Barbeiro.php
│   ├── Cliente.php
│   ├── Servico.php
│   └── User.php
resources/
└── views/
    ├── barbeiro/
    ├── cliente/
    ├── agendamento/
    └── servico/
```

---

## 🎨 Design

Interface com tema escuro, inspirada na identidade visual da barbearia:
- Paleta: `#121212` (fundo), `#c95c0a` (destaque laranja), `#1a1a1a` (cards)
- Tipografia espaçada com letras maiúsculas
- Badges de status com cores semânticas (laranja, verde, vermelho)

---

## 👨‍💻 Autor

Desenvolvido por **João Victor Sobroza Dal Ross** — 2026

---

## 📄 Licença

Este projeto está sob a licença [MIT](https://opensource.org/licenses/MIT).
