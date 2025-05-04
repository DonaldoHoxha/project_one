// Slider functionality
function setupSlider(sliderId, prevBtnId, nextBtnId) {
    const slider = document.getElementById(sliderId);
    const prevBtn = document.getElementById(prevBtnId);
    const nextBtn = document.getElementById(nextBtnId);

    const slideWidth = 310; // Slide width + margin
    let position = 0;

    prevBtn.addEventListener('click', () => {
        if (position < 0) {
            position += slideWidth;
            slider.style.transform = `translateX(${position}px)`;
        }
    });

    nextBtn.addEventListener('click', () => {
        const maxPosition = -(slider.children.length * slideWidth - slider.parentElement.offsetWidth);
        if (position > maxPosition + slideWidth) {
            position -= slideWidth;
            slider.style.transform = `translateX(${position}px)`;
        }
    });
}

// Initialize sliders
document.addEventListener('DOMContentLoaded', () => {
    setupSlider('services-slider', 'prev-service', 'next-service');
    setupSlider('barbers-slider', 'prev-barber', 'next-barber');

    // Book appointment button
    document.querySelector('.cta-button').addEventListener('click', () => {
        alert('Stai per prenotare un appuntamento. Procedi con la selezione del servizio e del barbiere.');
    });
});