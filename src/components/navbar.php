<?php
function setLink($term){
    $actualUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            
            $url_components = parse_url($actualUrl);
            
            $params = array();
            
            if (isset($url_components['query'])) {
                parse_str($url_components['query'], $params);
            }
            
            $params['platform'] = $term;
            
            $new_query = http_build_query($params);
            
            $new_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'] . '?' . $new_query;
            
            echo htmlspecialchars($new_url);
}

function setGenderLink($gender){
    $actualUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $url_components = parse_url($actualUrl);

    $params = array();

    if (isset($url_components['query'])) {
        parse_str($url_components['query'], $params);
    }
    
    $params['gender'] = $gender;
    
    $new_query = http_build_query($params);
    
    $new_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'] . '?' . $new_query;
    
    echo htmlspecialchars($new_url);
}

function setGenderType($type){
    $actualUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $url_components = parse_url($actualUrl);

    $params = array();

    if (isset($url_components['query'])) {
        parse_str($url_components['query'], $params);
    }
    
    $params['type'] = $type;
    
    $new_query = http_build_query($params);
    
    $new_url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'] . '?' . $new_query;
    
    echo htmlspecialchars($new_url);
}
?>


<nav class="navbar">
    <a href="index.php" class="deleteFilters">
    <img src="src/resources/icons/delete.svg" alt="eliminar" class="deleteFilters__ico">
    Borrar filtros
    </a>
    <a href="<?php setGenderType('movies')?>" class="navbar__opt" data-nav-id='movies'>
    <img src="src/resources/icons/movieIco.svg" alt="peliculas" class="navbar__opt-ico">
    Películas
    </a>
    <a href="<?php setGenderType('series')?>" class="navbar__opt" data-nav-id='series'>
    <img src="src/resources/icons/serieIco.svg" alt="peliculas" class="navbar__opt-ico">    
    Series
    </a>
    <div class="navbar__platfomrs">
        <p class="platformsTitle">Plataformas</p>
        <span class="platforms">
        <a href="<?php setLink('Amazon Prime')?>" class="platforms__btn" data-nav-id="Amazon Prime">
                <img src="src/resources/platformsIcon/amazon-prime-video.svg" alt="todas" class="platforms__btn-icon">
            </a>
            <a href="<?php setLink('Apple TV')?>" class="platforms__btn" data-nav-id ="Apple TV">
                <img src="src/resources/platformsIcon/apple-tv.svg" alt="todas" class="platforms__btn-icon">
            </a>
            <a href="<?php setLink('Disney+')?>" class="platforms__btn" data-nav-id ="Disney+">
                <img src="src/resources/platformsIcon/disney-plus.svg" alt="todas" class="platforms__btn-icon">
            </a>
            <a href="<?php setLink('Star+')?>" class="platforms__btn" data-nav-id ="Star+">
                <img src="src/resources/platformsIcon/starPlus.svg" alt="todas" class="platforms__btn-icon">
            </a>
            <a href="<?php setLink('Max')?>" class="platforms__btn" data-nav-id ="Max">
                <img src="src/resources/platformsIcon/hbo-max.svg" alt="todas" class="platforms__btn-icon">
            </a>
            <a href="<?php setLink('Paramount+')?>" class="platforms__btn" data-nav-id ="Paramount+">
                <img src="src/resources/platformsIcon/paramoutPlus.svg" alt="todas" class="platforms__btn-icon">
            </a>
            <a href="<?php setLink('Netflix')?>" class="platforms__btn" data-nav-id ="Netflix">
                <img src="src/resources/platformsIcon/netflix.svg" alt="todas" class="platforms__btn-icon">
            </a>
        </span>
    </div>
    <div class="navbar__genders">
        <p class="gendersTitle">Géneros</p>
        <div class="genders">
            <a href="<?php setGenderLink('Acción')?>" class="gender_btn" data-nav-id='Acción'>
            Acción
            </a>
            <a href="<?php setGenderLink('Aventura')?>" class="gender_btn" data-nav-id='Aventura'>
            Aventura
            </a>
            <a href="<?php setGenderLink('Comedia')?>" class="gender_btn" data-nav-id='Comedia'>
            Comedia
            </a>
            <a href="<?php setGenderLink('Drama')?>" class="gender_btn" data-nav-id='Drama'>
            Drama
            </a>
            <a href="<?php setGenderLink('Ciencia Ficción')?>" class="gender_btn" data-nav-id='Ciencia Ficción'>
            Ciencia Ficción
            </a>
            <a href="<?php setGenderLink('Fantasía')?>" class="gender_btn" data-nav-id='Fantasía'>
            Fantasía
            </a>
            <a href="<?php setGenderLink('Terror')?>" class="gender_btn" data-nav-id='Terror'>
            Terror
            </a>
            <a href="<?php setGenderLink('Romance')?>" class="gender_btn" data-nav-id='Romance'>
            Romance
            </a>
            <a href="<?php setGenderLink('Crimen')?>" class="gender_btn" data-nav-id='Crimen'>
            Crimen
            </a>
            <a href="<?php setGenderLink('Suspenso')?>" class="gender_btn" data-nav-id='Suspenso'>
            Suspenso
            </a>
        </div>
    </div>
</nav>