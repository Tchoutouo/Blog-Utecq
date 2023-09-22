<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details d\'un article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card border-dark mb-3" >
                    <div class="card-header fw-bolder">Auteur: <span style="background-color: green !important "> {{$auteur->name}} </span></div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Titre:  {{$article->titre}}</h5>
                        <p class="card-text">{{$article->contenu}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
