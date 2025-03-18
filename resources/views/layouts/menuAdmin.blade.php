<!-- resources/views/layouts/menu.blade.php -->
<style>
    .men{
        padding-top: 11px;
    }
.fonts{
    line-height: 1.5em;
    font-size: 24px;    

}
.menu {
    display: none; /* Masqué par défaut sur mobile */
}
.menu.active {
    display: block; /* Affiche le menu lorsqu'il est actif */
}
@media screen and (max-width: 1580px) {
   .d_flex{
    display: flex;
    flex-direction: row;
    justify-content: flex-start;    
    
   }
    .liens{
        /* background-color: rgba(0, 0, 0, 0.5); Bleu avec une transparence */
      
        transition: background-color 0.3s ease;
        border-radius: 10px;
        height: 73%;
    }
    .men:hover {
    background-color: rgba(59, 130, 246, 1); /* Bleu moins transparent au survol */
}

.men:active {
    background-color: rgba(29, 78, 216, 1); /* Un bleu plus foncé au clic */
}
    .navig {
        display: inline-block;
        background-color: #1a2035!important;
        margin-top: -.2em;
        /* padding: 12px 24px; */
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        /* background-color: rgb(70, 66, 66); Couleur de fond primaire */
        /* background-image: url('{{ asset('img/technologie4.jpg') }}'); Dégradé sur fond d'image */
        background-size: cover;
        background-position: center;
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background 0.3s, box-shadow 0.3s;
        width: 18%;
        height: 100%;
}

    .burgu{
        display: none;
        color: black;
        font-size: 3em;
        position: absolute;
        
    }

    .menu {
        display: block; /* Affiche le menu par défaut sur les écrans plus larges */
    }
}

@media screen and (max-width: 768px){

    .burgu{
        display: inline;
        color: black;
        font-size: 2em;
        position: absolute;
        
        left: 90vw;
        
    }
    .menu.active {
    height: 100px; /* Hauteur maximale lorsque le menu est actif (ajustez selon votre contenu) */
}
    .menu{
     display: none;
     width: 100%;
    overflow: hidden; /* Masquez le débordement */
    transition: max-height 0.3s ease; /* Animation fluide */
    text-justify: center;
    }

   
}



</style>




<!-- Bouton Hamburger -->
<div class="fixed top-5 left-5 z-20">
    <button id="menu-toggle" class="burgu text-black bg-blue-800 p-2 rounded">
        &#9776; <!-- Symbole hamburger -->
    </button>
</div>

<!-- Menu Vertical à gauche -->
<div class=" menu navig fixed top-24 left-0 bg-blue-800 text-white border-r border-gray-100 dark:border-gray-700 p-4 w-60 h-full">
    <ul class="liens space-y-4">
    <div class="d_flex men">
        <i class="fa-solid fa-address-card men fonts"></i>
        <li>
            <a href="{{ route('Conger.pending') }}" class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                Validation Congée
            </a>
        </li>
    </div>    
    <div class="d_flex men">
        <i class="fa-solid fa-circle-user men fonts"></i>
        <li>
        <a href="{{ route('employers.index') }}" class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                Employer
            </a>
        </li>
    </div>
    <div class="d_flex men">
        <i class="fa-solid fa-gear men fonts"></i>
        <li>
            <a href="{{ route('services.index') }}" class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                Service
            </a>
        </li>
    </div>

    <div class="d_flex men">
    <i class="fa-regular fa-file-lines men fonts"></i>
        <li>
            <a href="{{ route('TypeConger.index') }}" class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                TypeConger
            </a>
        </li>
    </div>
<div class="d_flex men">
        <i class="fa-solid fa-pen-nib men fonts"></i>
        <li>
            <a href="{{ route('presence.list') }}" class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                Pointage
            </a>
        </li>
    </div> 

    <div class="d_flex men">
    <i class="fa-solid fa-calendar-week men fonts"></i>
        <li>
            <a href="{{ route('supplementaires.index') }}" class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                Heure Supplementaire
            </a>
        </li>
    </div>    

    <div class="d_flex men">
        <i class="fa-solid fa-right-from-bracket men fonts"></i>
        <li>
            <a href="{{ route('logout') }}" class="men block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-blue-700">
                Se deconnecter
            </a>
        </li>
    </div>
    </ul>
</div>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const menu = document.querySelector('.menu');
        menu.classList.toggle('active'); // Ajoute ou enlève la classe active
    });
</script>