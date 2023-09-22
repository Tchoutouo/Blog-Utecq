<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un article') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container m-auto">
                    <form action=" {{route('article.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                            <label class="fw-bolder">Titre<span class="text-danger">*</span></label>
                            <input type="text" name="titre" class="form-control rounded-2" placeholder="Titre de l'article">
                        </div>
                        <div class="form-group mt-3">
                            <label class="fw-bolder">Contenu<span class="text-danger">*</span></label>
                            <textarea name="contenu" id="" cols="30" rows="10" placeholder="Veuillez saisir le contenu de votre article" style="width: 100%" class="rounded-2"></textarea>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bolder">Auteur</label>
                                    <input type="text" name="auteur" class="form-control rounded-2" value="{{$user_online->name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputStatus">Publication</label><span class=" text-danger">*</span>
                                    <select id="inputStatus" name="status"  class="form-control custom-select">
                                        <option value ="1" >Publié l'article</option>
                                        <option value ="0">Ne pas publié l'article</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <input type="text" name="user_id" class="form-control" value="{{$user_online->id}}" hidden>
                        <input type="text" name="user_created_id" class="form-control" value="{{$user_online->id}}" hidden>
                        <input type="text" name="user_updated_id" class="form-control" value="{{$user_online->id}}" hidden>
                        <div class="form-group text-center mt-5 mb-3">
                            <a href="{{route('article.index')}}" class="btn btn-secondary">Annuler</a>
                            <button class="btn btn-success" type="submit" style="background-color: green !important">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
