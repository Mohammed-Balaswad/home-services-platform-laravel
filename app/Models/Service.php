<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'base_price',
        'image',
    ];

    /**
     * علاقات
     */

    // كل خدمة تنتمي إلى فئة واحدة (Category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // علاقة many-to-many مع الفنيين عبر جدول technician_services
    // مع جلب عمود السعر (price) من الـ pivot إن وُجد
    public function technicians()
    {
        return $this->belongsToMany(User::class, 'technician_services', 'service_id', 'technician_id')
                    ->withPivot('price')
                    ->withTimestamps();
    }


    // الحجوزات المرتبطة بهذه الخدمة
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * (اختياري) دالة مساعدة للحصول على السعر الموصى به
     * لو أردت: ترجع أقل سعر لفني يقدم هذه الخدمة أو ترجع base_price إذا لا يوجد
     */
    public function recommendedPrice()
    {
        $pivotPrice = $this->technicians()->min('technician_services.price');

        return $pivotPrice ? $pivotPrice : $this->base_price;
    }
}
