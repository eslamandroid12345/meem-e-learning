<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable implements JWTSubject
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'communication_code',
        'address',
        'birth_date',
        'phone',
        'gender',
        'image',
        'is_active',
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
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }

    public function image() : Attribute {
        return Attribute::make(
            get: function ($value) {
                if ($value !== null) {
                    return url($value);
                }
                return null;
            }
        );
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
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

    public function token()
    {
        return JWTAuth::fromUser($this);
    }

    public function addresses() {
        return $this->hasMany(UserAddress::class);
    }

    public function exams() {
        return $this->belongsToMany(Exam::class);
    }

    public function answers() {
        return $this->belongsToMany(Answer::class);
    }

    public function printRequests() {
        return $this->hasMany(PrintRequest::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function cart() {
        return $this->hasOne(Cart::class);
    }

    public function subscriptions() {
        return $this->hasMany(CourseUser::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class);
    }

    public function books() {
        return $this->belongsToMany(CourseBook::class, 'book_user');
    }

    public function booksUsers() {
        return $this->hasMany(BookUser::class);
    }

    public function watchedLectures(){
        return $this->hasMany(LectureStudent::class);
    }

    public function inquiries() {
        return $this->hasMany(CourseInquiry::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function devicetokens()
    {
        return $this->hasMany(DeviceToken::class,'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class,'user_id');
    }
}
