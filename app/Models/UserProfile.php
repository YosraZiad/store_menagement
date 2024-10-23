<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $table = 'users_profiles';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'gender',
        'position',
        'address',
        'image',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    public static function addNew ($req) {
        $profile = new self();
        $profile->first_name   = $req->first_name ? $req->first_name : '';
        $profile->last_name    = $req->last_name ? $req->last_name : '';
        $profile->phone        = $req->phone ? $req->phone : '';
        $profile->gender       = $req->gender ? $req->gender : '';
        $profile->position     = $req->position ? $req->position : '';
        $profile->address      = $req->address ? json_encode($req->address) : json_encode([]);
        $profile->image        = $req->image ? $req->image : 'default.user.profile.png';
        return $profile;
    }

    public function setUserId($id){
        $this->user_id = $id;
        return $this;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
