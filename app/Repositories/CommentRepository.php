<?php
 
namespace App\Repositories;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Repositories\ResourceRepository;



 
class CommentRepository extends ResourceRepository
{
     public function __construct(Comment $comment) {
        $this->model = $comment;
    }
    
    
}
