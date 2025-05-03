document.addEventListener('DOMContentLoaded', () => {
    // Funzione per cambiare tema senza localStorage
    const themeToggle = document.getElementById('themeToggle');

    // Imposta tema predefinito basato sulle preferenze del sistema
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.body.setAttribute('data-theme', 'dark');
    }

    // Toggle del tema senza localStorage
    themeToggle.addEventListener('click', () => {
        if (document.body.getAttribute('data-theme') === 'dark') {
            document.body.removeAttribute('data-theme');
        } else {
            document.body.setAttribute('data-theme', 'dark');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Aggiungi effetto di animazione per gli input
    const inputs = document.querySelectorAll('input');
    
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.parentElement.classList.remove('focused');
            }
        });
    });

    // Effetto pulsazione per i bottoni al passaggio del mouse
    const buttons = document.querySelectorAll('button');
    
    buttons.forEach(button => {
        button.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        button.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Animazione di entrata per la pagina
    const container = document.querySelector('.container');
    
    if (container) {
        setTimeout(() => {
            container.style.opacity = '1';
        }, 100);
    }

    // Effetto per i link social
    const socials = document.querySelectorAll('.social');
    
    socials.forEach(social => {
        social.addEventListener('mouseover', function() {
            this.style.transform = 'translateY(-3px) rotate(5deg)';
        });
        
        social.addEventListener('mouseout', function() {
            this.style.transform = 'translateY(0) rotate(0)';
        });
    });

    // Verifica form di registrazione
    const registerForm = document.querySelector('.sign-up-container form');
    
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const password = this.querySelector('input[name="password"]');
            const confirmPassword = this.querySelector('input[name="confirm-password"]');
            
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                alert('Le password non corrispondono!');
            }
        });
    }
});