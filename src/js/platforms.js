//platforms availables

const platforms = [
    {
        platformName: 'Amazon Prime',
        platformIcon: 'amazon-prime-video.svg'
    },
    {
        platformName: 'Apple TV',
        platformIcon: 'apple-tv.svg'
    },
    {
        platformName: 'Disney+',
        platformIcon: 'disney-plus.svg'
    }, 
    {
        platformName: 'Max',
        platformIcon: 'hbo-max.svg'
    },
    {
        platformName: 'Netflix',
        platformIcon: 'netflix.svg'
    },
    {
        platformName: 'Paramount+',
        platformIcon: 'paramoutPlus.svg'
    },
    {
        platformName: 'Star+',
        platformIcon: 'starPlus.svg'
    }
];


document.addEventListener('DOMContentLoaded', ()=>{
    const platformsIcons = document.querySelectorAll('.platform__icon');
    platformsIcons.forEach(icon => {
        const iconData = icon.getAttribute('data-platform-id');
        const iconFinder = platforms.find(platform => platform.platformName === iconData);
        if(iconFinder){
            icon.setAttribute('src', `src/resources/platformsIcon/${iconFinder.platformIcon}`);
        } else {
            icon.setAttribute('src', 'src/resources/icons/load.svg');
        }
    });
})