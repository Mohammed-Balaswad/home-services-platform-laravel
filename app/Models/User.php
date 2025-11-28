<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Booking;
use App\Models\Review;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'role', // client / technician / admin
    'location',
    'bio',
    'image',
    'rating_avg',
];


    /**
     * Hidden attributes when serializing the model.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*----------------------------------------
     | //?  Relationships
     ----------------------------------------*/

    //  العميل عنده حجوزات كثيرة
    public function clientBookings()
    {
        return $this->hasMany(Booking::class, 'client_id');
    }

    //  الفني عنده حجوزات كثيرة 
    public function technicianBookings()
    {
        return $this->hasMany(Booking::class, 'technician_id');
    }

    //  الفني يقدّم خدمات (many-to-many)
    public function services()
    {
        return $this->belongsToMany(Service::class, 'technician_services', 'technician_id', 'service_id')
                    ->withPivot('price')
                    ->withTimestamps();
    }
    

    //  الفني الواحد عنده عدة مواعيد متاحة
    public function schedules()
    {
    return $this->hasMany(Schedule::class, 'technician_id');
    }

    //  المستخدم عنده تقييمات 
    public function reviews()
{
    return $this->hasManyThrough(
        Review::class,
        Booking::class,
        'technician_id',   
        'booking_id',      
        'id',              
        'id'               
    );
}


    //  المستخدم يستقبل إشعارات
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    

}
