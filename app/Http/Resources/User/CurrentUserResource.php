<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use app\Models\User;


/** @mixin App/Models/User */
class CurrentUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'login'=>$this->login,
            'subscribers'=>$this->subscriptionsCount(),
            'publications'=>$this->postsCount(),
            'avatar' => $this->avatar,
            'about' => $this->about,
            'isVerified' => $this->is_verified,
            'registeredAt' => $this->created_at->format('d/m/Y H:i')
        ];
    }
}
