<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plasma extends Model
{
    protected $table='Plasma';
    public $timestamps = true; 
    protected $fillable = ['organisation_name','phone','state','location',
                            'current_status','important_info','isVerified','verifiedAt'];
}
?>
