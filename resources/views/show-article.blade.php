<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de l\'article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="card border-secondary mb-3">

                    <div class="card-header bg-transparent border-secondary fw-bold fs-2">
                        Auteur: <span style="background-color: green !important "> {{$article->auteur}}</span>
                    </div>
                    <div class="card-body">
                        <h2 class="card-title fw-bolder fs-4">Titre:  {{$article->titre}}</h2>
                        <p class="card-text">{{$article->contenu}}</p>
                    </div>

                    <div class="card-footer bg-transparent border-secondary">
                        {{-- COMMENTAIRE --}}
                        <div class="border-2">
                            @foreach ($comments as $comment)

                                @if ($comment->user->name == $user_online->name)
                                    <div class="card mt-2 ml-2 mb-3" style="max-width: 60rem; background-color:rgb(153, 247, 150); position:relative; right: -200px;">
                                        <div class="card-header">Par:<span class="text-primary">
                                            @php
                                                echo "Moi";
                                            @endphp
                                        </span></div>
                                        <div class="card-body">
                                            <p class="card-text">{{$comment->message}}</p>
                                            <div class="d-flex justify-content-end mt-3">
                                                <small class="float-right">{{$comment->created_at}}</small>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card text-bg-light mt-2 ml-2 mb-3" style="max-width: 60rem;">
                                        <div class="card-header">Par:<span class="text-success">
                                                {{$comment->user->name}}
                                        </span></div>
                                        <div class="card-body">
                                            <p class="card-text">{{$comment->message}}</p>
                                            <div class="d-flex justify-content-end mt-3">
                                                <small class="float-right">{{$comment->created_at}}</small>
                                            </div>
                                        </div>
                                    </div>

                                @endif

                            @endforeach
                        </div>
                        {{-- FIN COMMENTAIRE --}}

                        <form action="{{route('comment.store')}}" method="POST" >
                            @csrf
                            <input type="text" name="article_id" value="{{$article->id}}"hidden>
                            <input type="text" name="user_id"  value="{{$user_online->id}}" hidden>
                            <input type="text" name="user_created_id"  value="{{$user_online->id}}" hidden>
                            <div class="row">
                                <label class="fw-bold">Laissez un commentaire</label>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" name="message" class="form-control rounded-3" placeholder="Ecrire un commentaire"> 
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary" style="background-color: blue !important">Envoyer</button>  
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
