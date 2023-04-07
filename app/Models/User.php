<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable  implements HasMedia, MustVerifyEmail
{
    use HasApiTokens, InteractsWithMedia, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'first_name',
        'last_name',
        'skype',
        'country',
        'status',
        'balance',
        'email',
        'password',
        'email_verified_at',
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
    public static function filter($id, $name, $email, $country, $status, $manager_id)
    {
        return User::where('role', 'Affiliate')
            ->when(!empty($id), function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->when(!empty($name), function ($query) use ($name) {
                return $query->where('first_name', 'like', '%' . $name . '%')->orWhere('last_name', 'like', '%' . $name . '%');
            })
            ->when(!empty($email), function ($query) use ($email) {
                return $query->where('email', 'like', '%' . $email . '%');
            })
            ->when(!empty($country), function ($query) use ($country) {
                return $query->where('country', 'like', '%' . $country . '%');
            })
            ->when(!empty($status), function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when(!empty($manager_id), function ($query) use ($manager_id) {
                return $query->where('manager_id', $manager_id);
            })->paginate(10);
    }
    public static function managerAffFilter($user_id, $name, $email, $status)
    {
        return User::where('role', 'Affiliate')
            ->when(!empty($user_id), function ($query) use ($user_id) {
                return $query->where('id', $user_id);
            })
            ->when(!empty($name), function ($query) use ($name) {
                return $query->where('first_name', 'like', '%' . $name . '%')->orWhere('last_name', 'like', '%' . $name . '%');
            })
            ->when(!empty($email), function ($query) use ($email) {
                return $query->where('email', 'like', '%' . $email . '%');
            })
            ->when(!empty($status), function ($query) use ($status) {
                return $query->where('status', $status);
            })->paginate(10);
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function users()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    public function refers()
    {
        return $this->hasMany(User::class, 'refer_id');
    }

    public function referFrom()
    {
        return $this->belongsTo(User::class, 'refer_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function coustomPayouts()
    {
        return $this->hasMany(CoustomPayout::class);
    }

    public function costomCountryPayouts()
    {
        return $this->hasMany(CostomCountryPayout::class);
    }

    public function caps()
    {
        return $this->hasMany(CoustomCap::class);
    }

    public function ratio()
    {
        return $this->hasMany(CostomRatio::class);
    }

    public function offeBlock()
    {
        return $this->hasOne(OfferBlock::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function applications()
    {
        return $this->hasMany(OfferApplication::class);
    }

    public function postbackLogs()
    {
        return $this->hasMany(PostbackLog::class);
    }

    public function postbackSendLogs()
    {
        return $this->hasMany(PostbackSendLog::class);
    }

    public function globalPostback()
    {
        return $this->hasOne(GlobalPostback::class);
    }

    public function paymentMethod()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function localPostbacks()
    {
        return $this->hasMany(LocalPostback::class);
    }
    public function topAffiliates()
    {
        return $this->hasMany(TopAffiliate::class);
    }
}
