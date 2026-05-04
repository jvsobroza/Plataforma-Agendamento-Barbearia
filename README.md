# ✂️ Xurupis — Plataforma de Agendamento para Barbearia

Plataforma web desenvolvida para gerenciamento completo de uma barbearia, permitindo que clientes agendem serviços online e barbeiros gerenciem sua agenda, serviços e performance financeira.

---

## 📋 Sobre o Projeto

O sistema **Xurupis** é uma aplicação full-stack construída com Laravel 10. A plataforma possui dois perfis de acesso distintos — **barbeiro** e **cliente** — focando na facilidade de agendamento e no controle administrativo robusto para o profissional.

---

## 🚀 Funcionalidades

### Cliente
- Cadastro e autenticação.
- Agendamento de serviços com escolha de barbeiro, serviço, data e hora.
- Visualização do histórico de agendamentos.
- Validação de horários conforme funcionamento da barbearia.

### Barbeiro
- Painel administrativo com gerenciamento de serviços (CRUD).
- Controle de agenda: Atualização de status (Confirmado / Concluído / Cancelado).
- **Módulo de Relatórios**: Geração de documentos PDF profissionais.
- **Inteligência de Negócio**: Visualização de faturamento total, serviços mais populares e evolução mensal de agendamentos.

### Regras de Negócio
- Prevenção de conflito de horários (mesmo barbeiro, mesma data e hora).
- Validação de horário de funcionamento:
  - Segunda a Sexta: 09h às 20h
  - Sábado: 09h às 18h
  - Domingo: Fechado
- Ordenação inteligente: agendamentos ativos e confirmados aparecem no topo da listagem.

---

## 📊 Módulo de Relatórios

O sistema conta com uma funcionalidade de exportação para PDF (DomPDF) que inclui:
- **Resumo Financeiro**: Cálculo automático de faturamento baseado em agendamentos concluídos e confirmados.
- **Ranking de Serviços**: Identificação dos serviços mais realizados por volume.
- **Análise Temporal**: Agrupamento de produtividade por mês e ano.
- **Design Profissional**: Relatório formatado com status coloridos e layout administrativo limpo.

---

## 🛠️ Tecnologias

- **PHP 8.1+**
- **Laravel 10**
- **MySQL**
- **DomPDF** (Geração de relatórios)
- **Blade** (Template Engine)
- **Bootstrap 5.3**

---

## ⚙️ Instalação

### Pré-requisitos
- PHP >= 8.1
- Composer
- MySQL

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
│   └── Middleware/
│       ├── CheckBarbeiro.php
│       └── CheckCliente.php
├── Models/
│   ├── Agendamento.php
│   ├── Barbeiro.php
│   ├── Cliente.php
│   ├── Servico.php
│   └── User.php
resources/
└── views/
    ├── barbeiro/
    │    └── relatorios/
    │       └── relatorio.blade.php  # Template do PDF
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
