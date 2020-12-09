<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\UsesUuid;

class OtpCode extends Model
{
    use UsesUuid;
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
