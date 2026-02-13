# 🤝 Guia de Contribuição

Obrigado por estar interessado em contribuir para o **ONLY SHOP**! 💖

Este documento fornece diretrizes e instruções para contribuir com o projeto.

---

## 📋 Código de Conduta

Este projeto e todos os participantes estão sujeitos ao nosso [Código de Conduta](CODE_OF_CONDUCT.md). Ao participar, você concorda em seguir este código.

---

## ❓ Como Posso Contribuir?

### 🐛 Reportar Bugs

Antes de criar um relatório de bug, verifique a [lista de issues](https://github.com/seu-usuario/only-shop/issues) pois você pode descobrir que o bug já foi reportado. Se o bug não foi reportado, crie uma nova issue com as seguintes informações:

**Descreva o bug de forma clara:**
- Um título descritivo
- Descrição exata do comportamento observado
- Comportamento esperado
- Screenshots/vídeos se possível
- Seu ambiente (OS, navegador, PHP, MySQL)

### 🎯 Sugerir Melhorias

Se você tem ideias para melhorias:

1. Use um **título claro e descritivo**
2. Forneça uma **descrição detalhada** da sugestão
3. Liste **exemplos** de como a funcionalidade funcionaria
4. Explique **por que isso seria útil**

### 💻 Submeter Pull Requests

1. **Fork o repositório**
   ```bash
   git clone https://github.com/seu-usuario/only-shop.git
   ```

2. **Crie uma branch para sua feature**
   ```bash
   git checkout -b feature/descricao-da-feature
   # ou
   git checkout -b fix/descricao-do-bug
   ```

3. **Faça seus commits**
   ```bash
   git add .
   git commit -m "Descrição clara do que foi feito"
   ```

4. **Push para a branch**
   ```bash
   git push origin feature/descricao-da-feature
   ```

5. **Abra um Pull Request**
   - Título claro
   - Descrição do que foi mudado
   - Referência a issues relacionadas (#123)
   - Screenshots se aplicável

---

## 📝 Padrões de Código

### PHP
- Siga **PSR-12** para código
- Use nomes descritivos para variáveis e funções
- Adicione comentários em código complexo
- Use prepared statements sempre

```php
// ✅ Bom
function getUserById($userId) {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

// ❌ Ruim
function get($id) {
    $resultado = $pdo->query("SELECT * FROM usuarios WHERE id = $id");
}
```

### CSS
- Use variáveis CSS para cores
- Mobile-first approach
- Nomes descritivos para classes

```css
/* ✅ Bom */
.btn-primary {
    background: var(--primary-color);
    padding: 12px 24px;
}

/* ❌ Ruim */
.btn {
    background: #667eea;
    padding: 12px 24px;
}
```

### JavaScript
- Use `const` por padrão
- Nomes descritivos para funções
- Evite variáveis globais

```js
// ✅ Bom
const handleFormSubmit = (event) => {
    event.preventDefault();
    // ...
};

// ❌ Ruim
function submit(e) {
    e.preventDefault();
    // ...
}
```

---

## 🧪 Testes

Antes de submeter seu PR:

1. **Teste localmente**
   ```bash
   # Inicie o XAMPP
   # Acesse http://localhost/loja
   ```

2. **Verifique responsividade**
   - DevTools (F12)
   - Teste em: 360px, 480px, 768px, 1024px, 1920px

3. **Teste todas as funcionalidades**
   - Login/Logout
   - Edição de perfil
   - Upload de foto
   - Recuperação de senha
   - Adicionar ao carrinho

4. **Verifique segurança**
   - Não há SQL injection
   - Senhas foram hashadas
   - Validação de entrada

---

## 🔄 Processo de Review

1. Um mantenedor revisará seu PR
2. Pode pedir mudanças
3. Após aprovação, será merged
4. Você receberá crédito na release notes

---

## 📚 Documentação

Ao adicionar uma funcionalidade:

1. Atualize o `README.md`
2. Adicione comentários no código
3. Crie/atualize documentação técnica
4. Adicione exemplos de uso

---

## 🚀 Branches

- `main` - Versão estável (não commit direto)
- `develop` - Próxima versão em desenvolvimento
- `feature/*` - Novas funcionalidades
- `fix/*` - Correções de bugs
- `docs/*` - Apenas documentação

---

## 📝 Commits

**Formato recomendado:**
```
[tipo]: descrição breve

Descrição detalhada se necessário.

Closes #123
```

**Tipos:**
- `feat` - Nova funcionalidade
- `fix` - Correção de bug
- `docs` - Mudança em documentação
- `style` - Formatação (não muda funcionalidade)
- `refactor` - Refatoração de código
- `test` - Adicionar/atualizar testes
- `chore` - Build, deps, tooling

**Exemplos:**
```
feat: adiciona autenticação 2FA
fix: corrige upload de foto em celulares
docs: atualiza README com instruções
style: formata código em profile.php
```

---

## 🎓 Fazendo Primeira Contribuição?

1. Procure por issues com `good first issue`
2. Leia o código existente
3. Não tenha medo de fazer perguntas
4. Comece pequeno

---

## 💬 Dúvidas?

- Abra uma [Discussion](https://github.com/seu-usuario/only-shop/discussions)
- Envie um email para: seu-email@example.com
- Procure por issues relacionadas

---

## 📋 Checklist antes de PR

- [ ] Código segue o padrão do projeto
- [ ] Testes locais passaram
- [ ] Responsividade verificada
- [ ] README atualizado
- [ ] Sem console.log ou var_dump
- [ ] Commits com mensagens claras
- [ ] Nenhum conflito com main

---

## 🏆 Contribuidores

Todos os contribuidores serão creditados no `CONTRIBUTORS.md` e README!

Obrigado por contribuir! 🙏

---

<div align="center">

**Happy Contributing!** 🚀

[⬆ Voltar ao topo](#-guia-de-contribuição)

</div>
