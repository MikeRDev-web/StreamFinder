document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('.navbar__opt, .gender_btn');
    const platforms = document.querySelectorAll('.platforms__btn');

    const params = getSearchParams();
    const propertiesArray = Object.values(params);

    // delete filters
    const deleteBtn = document.querySelector('.deleteFilters');
    const deleteIcon = document.querySelector('.deleteFilters__ico');

    if (Object.keys(params).length > 0) {
        deleteBtn.style.display = 'flex';
    } 

    deleteBtn.addEventListener('mouseover', ()=>{
        if(deleteIcon.getAttribute('src') === 'src/resources/icons/delete.svg') {
            deleteIcon.setAttribute('src', 'src/resources/icons/deleteHover.svg');
        } 
    })

    deleteBtn.addEventListener('mouseleave', ()=>{
        if(deleteIcon.getAttribute('src') === 'src/resources/icons/deleteHover.svg') {
            deleteIcon.setAttribute('src', 'src/resources/icons/delete.svg');
        } 
    })


    applySelectedClass(elements, propertiesArray, 'navbar__opt-selected');
    applySelectedClass(platforms, propertiesArray, 'navbar__platforms-selected');
});

function getSearchParams() {
    const params = {};
    const searchParams = new URLSearchParams(window.location.search);
    
    searchParams.forEach((value, key) => {
        params[key] = value;
    });
    
    return params;
}

function applySelectedClass(elements, propertiesArray, className) {
    elements.forEach(btn => {
        const btnId = btn.getAttribute('data-nav-id');
        if (btnId && propertiesArray.includes(btnId)) {
            btn.classList.add(className);
        }
    });
}
