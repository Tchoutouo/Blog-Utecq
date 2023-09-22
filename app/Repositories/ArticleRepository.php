<?php
 
namespace App\Repositories;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Repositories\ResourceRepository;



 
class ArticleRepository extends ResourceRepository
{
     public function __construct(Article $article) {
        $this->model = $article;
    }

    public function getallById($id)
    {
        return $this->model->with('comments.user')->where('id', $id)->first();
    }

    public function changeStatus(array $data, $id)
    {
        $article = Article::find($id);

        if($article['status']=== 1){
            
            $article['status']= 0;
        }else{

            $article['status']= 1;
        }

        $article->update([

            'titre' => $article->titre,
            'contenu' => $article->contenu,
            'auteur' => $article->auteur,
            'user_id' => $article->user_id,
            'status' => $article->status,
        ]);

        return $article;
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if ($article->comments()->exists()) {
            // La relation existe
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer un article qui a des commentaires.');

        } else {

            $article->delete();
        }
    }
}
