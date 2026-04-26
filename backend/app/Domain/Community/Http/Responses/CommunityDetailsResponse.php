<?php
namespace App\Domain\Community\Http\Responses;

use App\Domain\Book\Http\Responses\BookResponse;
use App\Domain\Book\Models\Book;
use Core\Ressource;
use Illuminate\Support\Facades\URL;

class CommunityDetailsResponse extends Ressource
{
    protected function toArray(): array
    {
        return [
            'id'=>$this->model->id,
            'name' => $this->model->name,
            'details' => $this->model->details,
            'image_url' => URL::to('/') . $this->model->images[0]->url,
            'stats' => [
                'members_count' => $this->model->users()->count(),
                'balance'=>$this->model->balance,
                'total_books'=>2,
                'status'=>$this->model->status
            ],
            'books'=>[],
            'invitations'=>$this->model->invitations()->with('user')->where('status','PENDING')->get()->map(fn($i)=>[
                'id'=>$i->id,
                'status'=>$i->status,
                'user'=>[
                    'fullname'=>$i->user->fname . ' '. $i->user->lname,
                    'cover'=>$i->user->profilePicture()->first()
                ]
            ]),
            'suggestions'=>$this->model->suggestions()->where('status','SUBMITTED')->with('book')->get(),
            'books_for_suggestion'=>BookResponse::collection(Book::get()),
            'user_role'=>($this->model->created_by === auth()->id())? 'ADMIN' : 'USER'
        ];
    }
}
