<nav x-data="{ open: false }" class="backf relative   bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="backf max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class=" flex shad justify-between h-16">
            <div class=" flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center logorDev">
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"><img class="logoRandev" src="{{ asset('img/logo.png') }}" alt="Description de l'image">                        </a>
                    @elseif (Auth::user()->role === 'client')
                        <a href="{{ route('client.dashboard') }}"><img class="logoRandev" src="{{ asset('img/logo.png') }}" alt="Description de l'image">      </a>
                    @endif
                </div>
                <!-- Navigation Links -->
            </div>
            <div id="loadingOverlay"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                   background-color: rgba(0, 0, 0, 0.3); z-index: 9999; justify-content: center; align-items: center;">
           <img src="{{ asset('img/Loading5.gif') }}" alt="Chargement..." style="width: auto;
           height: 13em;position: relative;
          ">
       </div>
       <div class="relative">
        @php
            use Illuminate\Support\Facades\Auth;
            use App\Models\Notification;
    
            $unreadCount = Notification::where('user_id', Auth::id())
                                       ->where('is_read', false)
                                       ->count();
        @endphp
    
        <a href="{{ route('notifications.index') }}" class="relative flex items-center text-gray-700 hover:text-gray-900">
            <!-- Icône cloche avec badge -->
            <div class="relative flex" style="left:30em; top:1em">
                <div class="notifIcon">
              <span><i class="fas fa-bell text-xl"></i></span>
                </div>
               
                
                <div class="NotifCount">
                      <!-- Badge de notification -->
                @if($unreadCount > 0)
                    <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2
                             inline-flex items-center justify-center px-2 py-1
                             text-xs font-bold text-white bg-red-600 rounded-full shadow-md">
                        {{ $unreadCount }}
                    </span>
                @endif
            </div>
              
                
            </div>
        </a>
    </div>
    
    
            <!-- Settings Dropdown -->
            <div class=" hidden sm:flex sm:items-center sm:ml-6" style="">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="backf wid inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <!-- Affichage de l'image de l'employé -->
                             
                                @if (auth()->check())
                                @php
                                    $user = auth()->user();
                                @endphp
                                <div class="UsersStatus">
                                    {{-- <span>Bonjour, {{ $user->name }} !</span> --}}
                                    @if ($user->status === 'online')
                                        <span class="text-green-500">🟢 </span>
                                    @elseif ($user->status === 'offline')
                                        <span class="text-gray-500">⚫</span>
                                    @elseif ($user->status === 'busy')
                                        <span class="text-red-500">🔴 </span>
                                    @elseif ($user->status === 'away')
                                        <span class="text-yellow-500">🟡 </span>
                                    @endif
                                </div>
                            @endif
                            
                            <div>{{ Auth::user()->name }} </div>

                     
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Se deconnecter') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
.navig {
    margin-top: 5em;
}
.shad{
    box-shadow: 1px 6px 5px rgba(0, 0, 0, 0.3);
    z-index: 999;
}
.NotifCount{
    left: .6em;
    /* background: red; */
    border-radius: 2em;
    position: absolute;
    width: 1.3em;
    text-align: center;
    height: 1.4em;
    top: -.5em;
}
.backf{
    background-color: rgb(30 39 100);
    margin-right: 2em;
    padding: 0;
    color:#8a95a0;
    width: 103% ;
    /* z-index: 999; */
    /* position: relative;
    left: 14em; */
    
}
.logorDev{
    width: 19vw;
    left: 0px;
    height: 103%;
    background: #1a2035!important;
    position: absolute;
}
.logoRandev{
    width: 15em;
    height: auto;
}
.wid{
    width: 15em !important;
}
.UsersStatus{
    
}

</style>

<!-- Inclure le menu selon le rôle de l'utilisateur -->
@if (Auth::user()->role === 'admin')
    @include('layouts.menuAdmin')
@elseif (Auth::user()->role === 'client')
    @include('layouts.menuClient')
@endif

<script>
    // Empêche les retours en arrière dus au cache
    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            // Recharger la page complètement
            window.location.reload();
        }
    });

    
    //ceci est le code pour une lien de Chargement
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.logorDev a');
        const overlay = document.getElementById('loadingOverlay');

        links.forEach(link => {
            link.addEventListener('click', function (e) {
                // Montre le loader juste après le clic (et avant la redirection)
                overlay.style.display = 'flex';
            });
        });

        // Pour les boutons de formulaire comme "Déconnexion"
        const logoutBtn = document.querySelector('form button[type="submit"]');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function () {
                overlay.style.display = 'flex';
            });
        }
    });
</script>

{{-- <script>
    function updateUserStatus(status) {
        fetch("{{ route('update.status') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
            body: JSON.stringify({ status: status }),
        }).catch(error => console.error("Erreur mise à jour statut :", error));
    }

    // Forcer la mise à jour immédiate après la connexion
    updateUserStatus("online");

    // Rafraîchir le statut toutes les 2 secondes
    setInterval(() => {
        updateUserStatus("online");
    }, 2000);

    // Détecter quand l'utilisateur ferme la page (déconnexion)
    window.addEventListener("beforeunload", () => {
        updateUserStatus("offline");
    });
</script> --}}

