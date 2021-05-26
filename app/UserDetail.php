<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'user_id','user_name', 'email', 'mobile','image','gender','address','address2','city','pin_code','state','country',
        'role_id','speciality','doctor_category','service','specialization','degree','experience_from','experience_to',
        'description','rating_option','consultation_fees','number_of_consultation','department_name','department_icon',
        'clinic_image_one','clinic_image_two','clinic_image_three','clinic_image_four','status',
    ];

}
