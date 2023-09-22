<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accueil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form action="{{route('dashboard')}}" class="form-inline ml-auto" >

            <div class="input-group rounded m-auto w-50 mb-5">
                <input type="search" id="search" class="form-control text-center rounded " name="search" placeholder="Rechercher un article"/>
                {{-- <input type="search" value="{{request()->search}}" class="form-control text-center rounded " name="search" placeholder="Rechercher un article" aria-label="Search" aria-describedby="search-addon" /> --}}
                <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search text-primary"></i>
                </span>
            </div>
        </form>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                
                @forelse ($articles as $article)

                    <div class="card border-secondary mb-3">
                        <a href="{{route('articlecomment.show', $article->id)}}">
                            <div class="card-header bg-transparent border-secondary fw-bold fs-2" style="background-color: rgb(199, 199, 247) !important;">
                                Auteur: 
                                <span class="" style="background-color: green !important ">
                                    {{ $article->auteur}}
                                </span>
                                <P class="fs-6 text-right">Publié le {{$article->updated_at}}</P>
                            </div>
                            <div class="card-body">
                                <h2 class="card-title fw-bolder fs-4">Titre:  {{$article->titre}}</h2>
                                <p class="card-text">@php echo substr($article->contenu, 0, 500); @endphp</p>
                            </div>
                        </a>
                        <div class="card-footer bg-transparent border-secondary">
                            <form action="{{route('comment.store')}}" method="POST">
                                @csrf
                                <input type="text" name="article_id" value="{{$article->id}}" hidden>
                                <input type="text" name="user_id" value="{{$user_online->id}}" hidden>
                                <input type="text" name="user_created_id" value="{{$user_online->id}}" hidden>
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

                @empty

                    @if ($articles)
                        <p class="text-center fs-2 fw-bold"> Aucun resultat.</p>
                    @else
                        <p class="text-center fs-2 fw-bold"> Aucun article disponible.</p>
                    @endif

                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
