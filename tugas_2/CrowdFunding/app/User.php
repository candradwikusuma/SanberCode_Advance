<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Traits\UsesUuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable ,UsesUuid;

    protected function get_user_role_id(){
        $role= Role::where('name','user')->first();
        return $role->id;
    }

    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->role_id=$model->get_user_role_id();
        });

        static::created(function($model){
            $model->otp_generate();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','photo_profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class,'role_id','id');
    }
    public function otpCode()
    {
        return $this->hasOne(OtpCode::class,'user_id','id');
    }

    public function isAdmin(){
        if ($this->role_id === $this->get_user_role_id()) {
            return false;
        }
        else{
            return true;
        }
    }
    public function otp_generate(){
        do {
            $acak=mt_rand(100000,1000000);
            $cek_otp=OtpCode::where('otp',$acak)->first();
        } while ($cek_otp);
        
        $now=Carbon::now();

        //ini untuk menambah otp 
        $otp=OtpCode::updateOrCreate(
            ['user_id'=>$this->id],
            ['otp'=>$acak,'expired_date'=>$now->addMinutes(5)],
            
        );
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
