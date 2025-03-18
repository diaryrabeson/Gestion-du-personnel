<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Messagerie avec {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h2 class="text-lg font-semibold mb-4">Messagerie avec {{ $user->name }}</h2>

                    <!-- Zone d'affichage des messages -->
                    <div id="messages" class="border p-3 mb-3" style="height: 300px; overflow-y: auto;">
                        @foreach ($messages as $message)
                            <div class="mb-2">
                                <strong>{{ $message->expediteur->name }} :</strong> 
                                {{ $message->contenu }}
                            </div>
                        @endforeach
                    </div>

                    <!-- Formulaire d'envoi de message -->
                    <form id="messageForm">
                        @csrf
                        <input type="hidden" name="expediteur_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="destinataire_id" value="{{ $user->id }}">

                        <!-- Champ de message -->
                        <input type="text" id="contenu" name="contenu" class="form-control" placeholder="Écrire un message..." required>

                        <!-- Bouton d'envoi -->
                        <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Script AJAX pour envoyer et recevoir les messages en temps réel -->
    <script>
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);
            let contenuInput = document.getElementById('contenu');

            fetch("{{ route('sendMessage') }}", {
                method: "POST",
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    let messageContainer = document.getElementById('messages');
                    let newMessage = document.createElement('div');
                    newMessage.classList.add('mb-2');
                    newMessage.innerHTML = `<strong>Moi :</strong> ${data.message.contenu}`;
                    messageContainer.appendChild(newMessage);
                    messageContainer.scrollTop = messageContainer.scrollHeight; // Scroll vers le bas
                    contenuInput.value = ""; // Réinitialiser le champ message
                }
            })
            .catch(error => console.error('Erreur:', error));
        });

        // Fonction pour charger les nouveaux messages toutes les 4 secondes
        function loadMessages() {
            let destinataire_id = "{{ $user->id }}";

            fetch(`/messages/get/${destinataire_id}`)
            .then(response => response.json())
            .then(data => {
                let messageContainer = document.getElementById('messages');
                messageContainer.innerHTML = ""; // On vide avant d'afficher les nouveaux messages

                data.forEach(message => {
                    let newMessage = document.createElement('div');
                    newMessage.classList.add('mb-2');
                    let senderName = (message.expediteur_id == {{ auth()->id() }}) ? 'Moi' : "{{ $user->name }}";
                    newMessage.innerHTML = `<strong>${senderName} :</strong> ${message.contenu}`;
                    messageContainer.appendChild(newMessage);
                });

                messageContainer.scrollTop = messageContainer.scrollHeight; // Scroll vers le bas
            })
            .catch(error => console.error('Erreur:', error));
        }

        // Rafraîchir les messages toutes les 4 secondes
        setInterval(loadMessages, 4000);
    </script>

</x-app-layout>



@push('scripts')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        // Gestion de l'envoi du message via AJAX
        $("#messageForm").on("submit", function (e) {
            e.preventDefault(); // Empêche le rechargement de la page

            // Récupération des données
            let destinataire_id = $("#recepteur_id").val();
            let contenu = $("#contenu").val();

            // Validation des champs
            if (!destinataire_id || !contenu.trim()) {
                alert("Veuillez sélectionner un destinataire et écrire un message.");
                return;
            }

            console.log("Données envoyées :", destinataire_id, contenu); // Vérification console

            $.ajax({
                url: "{{ route('sendMessage') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    destinataire_id: destinataire_id,
                    contenu: contenu
                },
                success: function (response) {
                    console.log("Réponse reçue :", response);
                    alert(response.status);
                    $("#contenu").val(""); // Effacer le champ après l'envoi
                },
                error: function (xhr) {
                    console.error("Erreur AJAX :", xhr);
                    alert("Erreur : " + (xhr.responseJSON?.status || "Problème inconnu"));
                }
            });
        });

        // Configuration de Pusher pour la réception des messages en temps réel
        Pusher.logToConsole = true;
        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
            encrypted: true
        });

        var channel = pusher.subscribe("chat-channel");
        channel.bind("message-sent", function (data) {
            console.log("Message reçu via Pusher:", data);  // Vérifie si le message est bien reçu
            $("#messages").append(
                `<div class="mb-2"><strong>${data.expediteur} à ${data.recepteur} :</strong> ${data.message}</div>`
            );
        });
    });
</script>
@endpush

