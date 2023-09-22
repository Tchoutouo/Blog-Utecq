<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des articles') }}
        </h2>
    </x-slot>
    <style>
        .swal-footer{
            text-align: center;
        }
        .swal-modal {
            position: relative;
            bottom: 250px;
        }
        .swal-title {
            font-size: 20px;
        }
        .swal-text {
            font-size: 14px;
        }
        .swal-button--danger{
            background-color: green !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-welcome /> --}}
                <a href="{{ route('article.create') }}" class="">
                    <button type="button" class="btn btn-success mb-3 mt-3 ml-3" style="background-color: green !important" ><i class="fas fa-plus"></i> Nouveau</button>
                </a>
      
                <table id="exampleArticle" class="table table-striped table-bordered mt-2 border-2" style="width:100%;">
                    <thead>
                        <tr class="text-center">
                            <th>N°</th>
                            <th>Titre</th>
                            <th style="max-width: 500px; max-height: 4OOpx;">Contenu</th>
                            <th>Auteur</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($articles as $article)
                            
                            <tr>
                                <th scope="row">@php echo $i++;  @endphp</th>
                                <td>
                                    <a href="{{ route('article.show', $article->id)}}" > 
                                        {{ $article->titre }} 
                                        <br>
                                        @if ($article->status == true)
                                            <small class="bg-success">publié</small>
                                        @else
                                            <small class="bg-danger">non publié</small>
                                        @endif
                                    </a>
                                </td>
                                <td style="max-width: 600px;">@php echo substr($article->contenu, 0, 150); @endphp</td>
                                <td>{{ $auteur->name}}</td>
                                <td>
                                    <div class="col-4 text-center">
                                        {{-- <form action="{{ route('status.update', $article->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            @if ($article->status == true)
                                                <button type="submit" class="btn btn-secondary btn-xs" style="background-color: gray !important; font-size: 10px;">Désactiver<i class="fas fa-regular fa-signal-bars-slash text-white"></i></button> 
                                            @else
                                                <button type="submit" class="btn btn-success btn-md" style="background-color: green !important;">Activer<i class=" fas fa-regular fa-signal-bars-good text-white"></i></button> 
                                            @endif
                                        </form> --}}
                                        {{-- <form action="{{ route('status.update', $article->id)}}" method="POST">
                                            @csrf
                                            @method('PUT') --}}
                                            @if ($article->status == true)
                                                <a href="{{ route('status.update', $article->id)}}" onclick="confirmationChangeStatus(event)" class="btn btn-secondary btn-xs" style="background-color: gray !important; font-size: 10px;">Désactiver<i class="fas fa-regular fa-signal-bars-slash text-white"></i></a> 
                                            @else
                                                <a href="{{ route('status.update', $article->id)}}" onclick="confirmationChangeStatus(event)" class="btn btn-success btn-md" style="background-color: green !important;">Activer<i class=" fas fa-regular fa-signal-bars-good text-white"></i></a> 
                                            @endif
                                        {{-- </form> --}}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="row d-flex justify-content-center">

                                        <div class="col-4 text-center">
                                            <a href="{{ route('article.show', $article->id)}}"><i class="fas fa-eye fa-2x text-primary" ></i></a> 
                                        </div>

                                        <div class="col-4 text-center">
                                            <a href="{{ route('article.edit', $article->id)}}"><i class="fas fa-pencil-alt fa-2x text-dark ml-2 text-center"></i></a>
                                        </div>

                                        <div class="col-4 text-center">
                                            <form action="{{ route('posts.delete', $article->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('posts.delete', $article->id)}}" onclick="confirmationDelete(event)" ><i class="far fa-trash-alt fa-2x text-danger ml-3"></i></a> 
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="float-right mb-2"> {{ $articles->links() }} </div>
            </div>
        </div>
    </div>

    <script>
        
        function confirmationDelete(ev){

            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
                
            swal({
                title : "Etês-vous sûre de supprimer cet article ?",
                text : "Vous ne pourrez pas annuler cette suppression",
                icon : "warning",
                buttons : true,
                dangerMode : true,
            })
            .then((willCancel)=>{

                if(willCancel){
                    window.location.href = urlToRedirect;
                }
            });
        }

        function confirmationChangeStatus(ev){

            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
                
            swal({
                title : "Etês-vous sûre de vouloir changer le status de cet article ?",
                text : "Cette modification sera pris en compte une fois confirmer",
                // icon : "info",
                buttons : true,
                dangerMode : true,
            })
            .then((willCancel)=>{

                if(willCancel){
                    window.location.href = urlToRedirect;
                }
            });
        }
        
        // $(document).ready(function() {
        //     var table = $('#exampleArticle').DataTable( {
        //         lengthChange: false,
        //     } );
        // } );

    </script>
</x-app-layout>
