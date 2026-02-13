const canvas = document.getElementById('bg-canvas');
const ctx = canvas.getContext('2d');

let particles = [];
const mouse = { x: null, y: null, radius: 150 };

window.addEventListener('mousemove', (e) => {
    mouse.x = e.x;
    mouse.y = e.y;
});

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
window.addEventListener('resize', resizeCanvas);
resizeCanvas();

class Particle {
    constructor() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.size = Math.random() * 2 + 1;
        this.speedX = Math.random() * 1 - 0.5;
        this.speedY = Math.random() * 1 - 0.5;
    }
    update() {
        this.x += this.speedX;
        this.y += this.speedY;

        if (this.x > canvas.width) this.x = 0;
        else if (this.x < 0) this.x = canvas.width;
        if (this.y > canvas.height) this.y = 0;
        else if (this.y < 0) this.y = canvas.height;

        // Interação com o mouse
        let dx = mouse.x - this.x;
        let dy = mouse.y - this.y;
        let distance = Math.sqrt(dx * dx + dy * dy);
        if (distance < mouse.radius) {
            if (mouse.x > this.x && this.x > 10) this.x -= 2;
            if (mouse.x < this.x && this.x < canvas.width - 10) this.x += 2;
            if (mouse.y > this.y && this.y > 10) this.y -= 2;
            if (mouse.y < this.y && this.y < canvas.height - 10) this.y += 2;
        }
    }
    draw() {
        ctx.fillStyle = 'rgba(255, 102, 0, 0.8)'; // Cor laranja da sua marca
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fill();
    }
}

function init() {
    particles = [];
    for (let i = 0; i < 100; i++) {
        particles.push(new Particle());
    }
}

function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(p => {
        p.update();
        p.draw();
    });
    connect();
    requestAnimationFrame(animate);
}

function connect() {
    for (let a = 0; a < particles.length; a++) {
        for (let b = a; b < particles.length; b++) {
            let dx = particles[a].x - particles[b].x;
            let dy = particles[a].y - particles[b].y;
            let distance = Math.sqrt(dx * dx + dy * dy);

            if (distance < 150) {
                let opacity = 1 - (distance / 150);
                ctx.strokeStyle = `rgba(255, 102, 0, ${opacity * 0.2})`;
                ctx.lineWidth = 1;
                ctx.beginPath();
                ctx.moveTo(particles[a].x, particles[a].y);
                ctx.lineTo(particles[b].x, particles[b].y);
                ctx.stroke();
            }
        }
    }
}

init();
animate();

// parte que faz o bglh do botao funcionar pra decer e subir la ele

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

