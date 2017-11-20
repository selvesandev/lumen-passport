<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, SoftDeletes, HasApiTokens;

    const ADMIN_ROLE = 'ADMIN_USER';
    const BASIC_ROLE = 'BASIC_USER';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'firstName',
        'lastName',
        'middleName',
        'email',
        'password',
        'address',
        'zipCode',
        'username',
        'city',
        'state',
        'country',
        'phone',
        'mobile',
        'role',
        'isActive',
        'profileImage'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    public function login()
    {
        return $this->hasOne('App\Login', 'uid', 'id');
    }

    public function validateForPassportPasswordGrant($password)
    {
        $data = \Illuminate\Support\Facades\Request::all();
        $user = $this->where('email', $data['username'])->first();
        if (count($user) < 1)
            return false;

        $userId = $user->uid;
        $security = Login::where(['uid' => $userId])->first();
        if (count($security) < 1)
            return false;

        $userPassword = $security->password;

        return (Hash::check($password, $userPassword));
    }

}
