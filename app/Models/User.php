<?php

namespace App\Models;

use App\Notifications\SendVerifyWithQueueNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'email_verified_at',
        'avatar',
        'phone',
        'telegram',
        'telegram_id',
        'birthday',
        'gender',
        'address',
        'password',
        'provider',
        'provider_id',
        'provider_token',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'user_id', 'id');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new SendVerifyWithQueueNotification());
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany('App\models\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendsOf()
    {
        return $this->belongsToMany('App\models\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendsOf()->wherePivot('accepted', true)->get());
    }

    public function friendsRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->paginate(20);
    }

    public function friendsRequestsCount(User $user)
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->count();
    }

    public function friendRequestsPending()
    {
        return $this->friendsOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendsRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendsOf()->attach($user->id);
    }

    public function deleteFriend(User $user)
    {
        $this->friendsOf()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendsRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true
        ]);
    }

    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

}












