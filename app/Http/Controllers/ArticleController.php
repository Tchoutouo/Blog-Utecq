<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ArticleRepository;
use App\Repositories\CommentRepository;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Builder;





class ArticleController extends Controller
{
    protected $articleRepository;
    protected $commentRepository;


    public function __construct(ArticleRepository $articleRepository, CommentRepository $commentRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->commentRepository = $commentRepository;

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $auteur = Auth::user();
        $articles = Article::orderBy('created_at', 'desc')->where('user_id',$auteur->id)->paginate(5);
        // $articles = Paginator::useBootstrapFive();
        $user = User::all();
        return view('article.index', compact('articles','user','auteur'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user_online = Auth::user();
        return view('article.create',compact('user_online'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //
        // dd($request->all());
        $request->validate([
            'titre'=> 'required',
            'contenu' => 'required',
            // 'auteur' => 'required',
        ]);

        $result= $this->articleRepository->store($request->all());

        if(isset($result)){

            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Article enregistrer avec success.');

            return redirect('liste_article');

        }else{

            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addError('Echèc de l\'enregistrement.');
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        
        $article = $this->articleRepository->getById($id);
        $user_id = $article->user_created_id;
        $auteur = User::find($user_id);
        return view('article.show', compact('article','auteur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $article = $this->articleRepository->getById($id);
        $user_online = Auth::user();

        return view('article.edit',compact('user_online','article'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'titre'=> 'required',
            'contenu' => 'required',
            // 'auteur' => 'required',
        ]);

        $result = $this->articleRepository->update($id,$request->all());

        if(isset($result)){

            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Article a été modifier avec success.');

            return redirect('liste_article');

        }else{
            
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addError('Echèc de la modification.');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $article = $this->articleRepository->getById($id);

        if ($article->comments()->exists()) {
            // La relation existe
            flash()->addError('Vous ne pouvez pas supprimer un article qui a des commentaires.');
            
            return redirect('liste_article');

        } else {
            // La relation n'existe pas
            $result = $this->articleRepository->destroy($id);

            if($result){

                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])->addError('Echèc de la suppression !');

            }else{

                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])->addSuccess('Article supprimé avec success !');

            }

            return  redirect ('liste_article');

        }

    }

    // public function indexAccueil()
    // {
    //     $articles = Article::orderBY('created_at','desc')->where('status', 1)->get();
    //     $user = User::all();
    //     $user_online = Auth::user();

    //     return view('/dashboard', compact('articles','user','user_online'));   
    // }
    /**
     * dashboard listing articles.
     */
    public function indexAccueil(Request $request)
    {
        $user_online = Auth::user();
        $articles = Article::query();

        if($search = $request->search)
        {
            
            $articles->where(fn(Builder $query) => $query
                    ->orwhere('titre', 'LIKE', '%' . $search. '%')
                    ->orwhere('auteur', 'LIKE', '%' . $search. '%')
                    ->orWhere('contenu', 'LIKE', '%' . $search. '%')
                    ->orWhere('updated_at', 'LIKE', '%' . $search. '%')

            );        
        }
       

        return view('/dashboard', [
            'articles'=> $articles->orderBY('created_at','desc')->where('status', 1)->get(),
            'user_online'=>$user_online]
        );   
    }

    /**
     * show welcome page.
     */
    // public function homepage()
    // {
    //     $articles = Article::orderBy('created_at', 'desc')->where('status', 1)->get();
    //     $user = User::all();

    //     return view('welcome', compact('articles','user'));   
    // }
    public function homepage(Request $request)
    {
        $user_online = Auth::user();
        $articles = Article::query();

        if($search = $request->search)
        {
            
            $articles->where(fn(Builder $query) => $query
                    ->orwhere('titre', 'LIKE', '%' . $search. '%')
                    ->orwhere('auteur', 'LIKE', '%' . $search. '%')
                    ->orWhere('contenu', 'LIKE', '%' . $search. '%')
                    ->orWhere('updated_at', 'LIKE', '%' . $search. '%')

            );        
        }
       

        return view('welcome', [
            'articles'=> $articles->orderBY('created_at','desc')->where('status', 1)->get(),
            'user_online'=>$user_online]
        );   
    }
    /**
     * store a newly comment in storage.
     */
    public function storeComment(Request $request)
    {
        $request->validate([
            'message'=>'required',
            'user_created_id'=>'required',
            'user_id'=> 'required',
        ]);
        // dd($request->all());

        $result = $this->commentRepository->store($request->all());

        if(isset($result)){

            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Votre commentaire a été envoyé.');

            // return  redirect ('dashboard');
        }else{
            
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addWarning('Votre commentaire n\'a pas été envoyer.');
        }
        
        return redirect()->back();
    }

    /**
     * display the specified article resource in storage.
     */
    public function showArticleComment(string $id)
    {
        // $article = $this->articleRepository->getById($id);
        $article = $this->articleRepository->getallById($id);
        // dd($article);
        $comments = $article->comments;
        // foreach($comments as $comment)
        // {
        //     echo $comment->user->name;
        //     dd($comment);
        // }
        // $user = User::($);
        
        // dd($comments);
        $articles = Article::all();
        $user_online = Auth::user();
            // dd($user_online);
        return view('/show-article', compact('article','user_online','comments'));
        
    }

    /**
     * Update the status to article specified resource in storage.
     */
    public function changeStatusArticle(Request $request, string $id)
    {

        $result = $this->articleRepository->changeStatus($request->all(), $id);

        if($result){

            flash()->options([
                'timeout' => 3000, // 2 seconds
                'position' => 'top-right',
            ])->addSuccess('Status modifié avec success.');

            flash()->options([
                'timeout' => 10000, // 3 seconds
                'position' => 'top-center',
            ])->addInfo('Veuillez verifié si votre acticle est bien présent ou non au niveau de l\'accueil.');

            return redirect ('liste_article');

        }else{
            
            flash()->addWarning('Echèc de la modification du status.');
        }
        
    }
    

}
