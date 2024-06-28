const input = document.querySelector('.header__form-input');
const btn = document.querySelector('.header__form--submit');
const headerBtn = document.querySelector('.header__title');

headerBtn.addEventListener('click', ()=>{
    localStorage.removeItem('navIdSec1');
    localStorage.removeItem('navIdSec2');
})

document.addEventListener('DOMContentLoaded', ()=>{
    btn.style.pointerEvents = 'none';
    input.addEventListener('input', ()=>{
        if(input.value === ''){
            btn.style.pointerEvents = 'none';
            btn.style.boxShadow = '0 0 0 transparent';
        } else {
            btn.style.pointerEvents = ''; 
            btn.style.boxShadow = '0 0 0.5rem var(--color1)';
        }
    });
});

