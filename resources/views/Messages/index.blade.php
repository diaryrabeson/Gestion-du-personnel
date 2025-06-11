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
                 <!-- Zone d'affichage des messages -->
                 <div id="messages" class="border p-3 mb-3" style="height: 300px; overflow-y: auto;">
                    @foreach ($messages as $message)
                        <div class="mb-2 p-2 rounded 
                            {{ $message->expediteur->id === auth()->id() ? 'message-mine' : 'message-other' }}">
                            <strong>
                                {{ $message->expediteur->id === auth()->id() ? 'Moi' : $message->expediteur->name }} :
                            </strong> 
                            {{ $message->contenu }}
                            @if ($message->file)
                                <br><a href="{{ asset('storage/' . $message->file) }}" target="_blank">Télécharger le fichier</a>
                            @endif
                        </div>
                    @endforeach
                </div>
                

                    <!-- Formulaire d'envoi de message -->
                    <form id="messageForm">
                        @csrf
                        <input type="hidden" name="expediteur_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="destinataire_id" value="{{ $user->id }}">
                        <div class="d-flex">
 <!-- Champ de message -->
                        <input type="text" id="contenu" name="contenu" class="form-control" placeholder="Écrire un message..." required>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input cursor-pointer" id="file" name="file">
                            <label class="custom-file-label cursor-pointer" for="file" data-browse=" ">
                                <i class="fa-solid fa-paperclip cursor-pointer"></i>
                            </label>
                        </div>
                        {{-- <input type="file" id="file" name="file" class="form-control-file ml-2" > --}}
                        <!-- Bouton d'envoi -->
                        {{-- <button type="submit" class="btn btn-primary mt-2">Envoyer</button> --}}


                        <button class="boutons">
                            <div class="svg-wrapper-1">
                              <div class="svg-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                  <path fill="none" d="M0 0h24v24H0z"></path>
                                  <path fill="currentColor" d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"></path>
                                </svg>
                              </div>
                            </div>
                            <span>Envoyer</span>
                          </button>

                        </div>
                       
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Script AJAX pour envoyer et recevoir les messages en temps réel -->
    {{-- <script>
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
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("file").addEventListener("change", function() {
        let fileName = this.files.length > 0 ? this.files[0].name : "";
        this.nextElementSibling.innerHTML = `<i class="fas fa-upload"></i> ${fileName}`;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    let messageForm = document.getElementById('messageForm');
    let messageInput = document.getElementById('contenu');
    let fileInput = document.getElementById('file');
    let fileLabel = document.querySelector('.custom-file-label'); // Récupère le label du fichier
    let messageContainer = document.getElementById('messages');

    function scrollToBottom() {
        messageContainer.scrollTop = messageContainer.scrollHeight;
    }

    function refreshMessages() {
        fetch(window.location.href) // Recharge uniquement la section des messages
        .then(response => response.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');
            let newMessages = doc.getElementById('messages');

            if (newMessages) {
                let oldHeight = messageContainer.scrollHeight;
                document.getElementById('messages').innerHTML = newMessages.innerHTML;

                if (messageContainer.scrollTop + messageContainer.clientHeight >= oldHeight - 50) {
                    scrollToBottom();
                }
            }
        })
        .catch(error => console.error('Erreur lors du rafraîchissement des messages:', error));
    }

    let observer = new MutationObserver(scrollToBottom);
    observer.observe(messageContainer, { childList: true });

    messageForm.addEventListener('submit', function (event) {
        event.preventDefault();

        let formData = new FormData(this);
        let originalPlaceholder = messageInput.placeholder;

        let messageText = messageInput.value.trim();
        if (messageText === "" && !formData.get("file")) {
            return;
        }

        messageInput.value = "";
        messageInput.placeholder = "Envoi...";
        messageInput.disabled = true;

        fetch("{{ route('sendMessage') }}", {
            method: "POST",
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            messageInput.placeholder = originalPlaceholder;
            messageInput.disabled = false;
            messageInput.focus();

            // 🔥 Effacer le champ fichier et réinitialiser le label 🔥
            fileInput.value = "";
            fileLabel.innerHTML = `<i class="fas fa-upload"></i>`; // Réinitialisation du texte

            setTimeout(scrollToBottom, 100);
        })
        .catch(error => {
            console.error('Erreur:', error);
            messageInput.placeholder = "Message envoyé";
            setTimeout(() => {
                messageInput.placeholder = originalPlaceholder;
                messageInput.disabled = false;
            }, 2000);
        });
    });

    fileInput.addEventListener("change", function() {
        let fileName = this.files.length > 0 ? this.files[0].name : "";
        fileLabel.innerHTML = `<i class="fas fa-upload"></i> ${fileName}`;
    });

    setInterval(refreshMessages, 4000);
    scrollToBottom();
});
    </script>

</x-app-layout>
<style>
    .fa-upload{
        color: white;
    font-size: 1.5em;
    cursor: pointer;
    }
    .custom-file{
    cursor: pointer;
    position: absolute;
    /* background-color: #ffffff; */
    height: 3em;
    width: 3.2em;
    text-align: center;
    padding-top: 12px;
    /* border-radius: 3em; */
    /* margin: .4em; */
    font-size: 1.2em;
    margin-top: .2em;
    }
    .custom-file-input{
        display: none;
    }
    .message-mine {
        background-color: #7c7cc9;
        color: white;
        padding: 10px;
        border-radius: 5px;
        width: 49%;
    margin-left: 30em;
    height: auto;
    }
    @media only screen and (max-width:768px){
        .message-mine{
            margin-left: 16em
        }
    }
    .message-other {
        width: 50%;
        height: auto;
        background-color: lightgray;
        padding: 10px;
        border-radius: 5px;
    }
.d-flex{
    display: flex;
    margin-top: 1em;
}
#contenu{
    padding-left: 4em;
    width: 80%;
    /* padding: 0.5em; */
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-right: 0.5em;
}
.boutons {
  font-family: inherit;
  font-size: 18px;
  background: linear-gradient(to bottom, #4dc7d9 0%,#66a6ff 100%);
  color: white;
  padding: 0.8em 1.2em;
  display: flex;
  align-items: center;
  justify-content: center;
  border: none;
  border-radius: 25px;
  box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
  transition: all 0.3s;
}

.boutons:hover {
  transform: translateY(-3px);
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);
}

.boutons:active {
  transform: scale(0.95);
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
}

.boutons span {
  display: block;
  margin-left: 0.4em;
  transition: all 0.3s;
}

.boutons svg {
  width: 18px;
  height: 18px;
  fill: white;
  transition: all 0.3s;
}

.boutons .svg-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.2);
  margin-right: 0.5em;
  transition: all 0.3s;
}

.boutons:hover .svg-wrapper {
  background-color: rgba(255, 255, 255, 0.5);
}

.boutons:hover svg {
  transform: rotate(45deg);
}


</style>

{{-- 
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
@endpush --}}

