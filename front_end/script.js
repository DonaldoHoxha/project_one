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

