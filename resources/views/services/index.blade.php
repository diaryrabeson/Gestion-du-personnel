

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listes des services') }}
        </h2>
    </x-slot>
<style>
.add{
    background-color: rgb(79, 187, 79)  ;
 height: 2em;   
 text-align: center;
 padding-top: 0.2em;
 font-weight: bold;
 color: white;
 border-radius: 0.5em;

}
.flex1{
    display:flex;
    justify-content : space-between;
    
}

</style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex1">
                <div>
                    <h3 class="text-xl">Liste des Services</h3>
</div>
                    <!-- Button to add a new service -->
                    <div class="add mb-4">
                        <a href="{{ route('services.create') }}" class="  bg-blue-500  px-4 py-2 rounded">
                            Ajouter une service 
                        </a>
                    </div>
                    </div>
                    <!-- List of Services -->
                    <ul>
                        @foreach($services as $service)
                            <li class="flex justify-between items-center mb-2">
                                <span>{{ $service->nomService }} - {{ $service->Description }}</span>
                                
                                <!-- Action Buttons for each service -->
                                <div>
                                    <!-- Edit button with service ID -->
                                    <a href="{{ route('services.edit', ['id_service' => $service->id_service]) }}" class="bg-yellow-300 text-black px-3 py-1 rounded mr-2">
                                    Edit</a>
                                    <!-- Delete form for each service -->
                                    <form action="{{ route('services.destroy', ['id_service' => $service->id_service]) }}" method="POST" style="display:inline;">
                                    @csrf
                                     @method('DELETE')
                                    <button type="submit" class="bg-red-300 text-black px-3 py-1 rounded">
                                    Delete
                                    </button>
</form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
