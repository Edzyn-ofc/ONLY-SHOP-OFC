document.addEventListener('DOMContentLoaded', function() {

    const menuButton = document.getElementById('menu-btn'); 
   
    const dropdownMenu = document.getElementById('dropdown-menu');
  
    menuButton.addEventListener('click', function() {
     
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function(event) {
        // Verifica se o clique NÃO foi no botão e NÃO foi dentro do menu
        if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
          
            if (!dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.add('hidden');
            }
        }
    });
});


//parte do bglh de pp
document.addEventListener('DOMContentLoaded', () => {
    // Efeito do Scroll
    const sections = document.querySelectorAll('.reveal-section');
    
    const options = {
        threshold: 0.3 // Dispara quando 30% da seção aparece
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                // Adiciona um efeito extra de zoom na imagem quando entra
                const img = entry.target.querySelector('img');
                if(img) img.style.transform = 'scale(1)';
            } else {
    
            
            }
        });
    }, options);

    sections.forEach(section => {
        observer.observe(section);
        // Inicializa imagens menores para o efeito de entrada
        const img = section.querySelector('img');
        if(img) img.style.transform = 'scale(0.9)';
    });



    // Efeito Parallax suave no Header
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 50) {
            header.style.padding = '10px 5%';
            header.style.backgroundColor = 'rgba(10, 10, 10, 0.95)';
        } else {
            header.style.padding = '15px 5%';
            header.style.backgroundColor = 'rgba(25, 40, 66, 0.8)';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const products = document.querySelectorAll('.product');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.toLowerCase(); // Texto digitado em minúsculo

        products.forEach(product => {
            // Pega o texto do <h3> (nome do produto)
            const productName = product.querySelector('h3').textContent.toLowerCase();
            
            // Se o nome contiver o que foi digitado, mostra. Se não, esconde.
            if (productName.includes(searchTerm)) {
                product.style.display = "block"; 
            } else {
                product.style.display = "none";
            }
        });
    });
});
function showDetails(id) {
            document.querySelectorAll('.info-box').forEach(box => box.classList.remove('active'));
            document.getElementById(id).classList.add('active');
        }



        function filterCategory(category) {
    const products = document.querySelectorAll('.product');
    const buttons = document.querySelectorAll('.filter-btn');

    // 1. Atualiza a aparência dos botões
    buttons.forEach(btn => {
        btn.classList.remove('active');
        if(btn.innerText.toLowerCase() === category.toLowerCase() || 
           (category === 'todos' && btn.innerText.toLowerCase() === 'todas')) {
            btn.classList.add('active');
        }
    });

    // 2. Filtra os produtos
    products.forEach(product => {
        const productCat = product.getAttribute('data-category'); // Puxa da sua DB
        
        if (category === 'todos' || productCat === category) {
            product.style.display = "block";
            product.style.animation = "fadeIn 0.5s ease"; // Opcional: efeito visual
        } else {
            product.style.display = "none";
        }
    });
}