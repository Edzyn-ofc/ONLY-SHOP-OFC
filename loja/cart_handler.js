// Função para adicionar produto ao carrinho com verificação de login
function addToCart(productId) {
    // Fazer uma requisição para verificar se está logado
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + productId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar mensagem de sucesso
            showNotification('✓ Produto adicionado ao carrinho!', 'success');
        } else {
            // Se não está logado, redireciona
            if (data.redirect) {
                showNotification('❌ Você precisa estar logado para adicionar produtos ao carrinho', 'error');
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 2000);
            } else {
                showNotification('❌ ' + data.message, 'error');
            }
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        showNotification('❌ Erro ao processar a solicitação', 'error');
    });
}


function showNotification(message, type) {
    // Criar elemento de notificação
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
   
    notification.style.cssText = `
        position: fixed;
        top: 80px;
        right: 20px;
        padding: 15px 20px;
        background: ${type === 'success' ? '#4CAF50' : '#f44336'};
        color: white;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        z-index: 9999;
        animation: slideInRight 0.3s ease-out;
        font-weight: bold;
    `;
    
    document.body.appendChild(notification);
    
    // Remover após 3 segundos
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}


const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }

    @media (max-width: 480px) {
        .notification {
            top: 70px !important;
            right: 10px !important;
            left: 10px !important;
            max-width: calc(100% - 20px) !important;
        }
    }
`;
document.head.appendChild(style);
