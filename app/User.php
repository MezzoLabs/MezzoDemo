<?php

namespace App;

use App\Mezzo\Generated\ModelParents\MezzoUser;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use MezzoLabs\Mezzo\Core\Permission\HasPermissions;


/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
class User extends MezzoUser implements AuthenticatableContract, CanResetPasswordContract, AuthorizableContract
{
    use Authenticatable, CanResetPassword, Authorizable, HasPermissions;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    public $searchable = [
        'name', 'email'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tutorials()
    {
        return $this->hasMany(Tutorial::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function shoppingBasket()
    {
        return $this->hasOne(ShoppingBasket::class);
    }

    public function scopeBackend($query)
    {
        return $query->where('backend', '=', 1);
    }

    public function scopeFrontend($query)
    {
        return $query->where('backend', '=', 0);
    }

    public function isConfirmed()
    {
        return $this->confirmed;
    }

    public function address()
    {
        return $this->belongsTo(\App\Address::class);
    }

    public function likedCategories()
    {
        return $this->hasMany(LikedCategory::class);
    }

    public function likesCategory(Category $category)
    {
        foreach ($this->likedCategories as $likedCategory) {
            if ($likedCategory->category_name == str_slug($category->label) && $likedCategory->base_value > 0)
                return true;
        }

        return false;
    }

    /**
     * @param Category $category
     * @return int
     */
    public function relevanceOfCategory(Category $category) : float
    {
        foreach ($this->likedCategories as $likedCategory) {
            if ($likedCategory->category_name == str_slug($category->label))
                return $likedCategory->relevance();
        }

        return 0;
    }


}