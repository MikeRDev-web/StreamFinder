document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.movieCard');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.display = 'flex';
            card.style.animation = 'cardAnimation 0.5s 1';
        }, index * 30); 
    });
});