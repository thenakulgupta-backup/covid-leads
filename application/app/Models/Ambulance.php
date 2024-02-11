<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    protected $table='Ambulance';
    public $timestamps = true; 
    protected $fillable = ['organisation_name','phone','state','location',
                            'current_status','important_info','isVerified','verifiedAt'];
}
?>
