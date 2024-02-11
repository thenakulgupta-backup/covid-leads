<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meds extends Model
{
    protected $table='Meds';
    public $timestamps = true; 
    protected $fillable = ['organisation_name','phone','medicine_name','state','location',
                            'current_status','important_info','isVerified','verifiedAt'];
}
?>
