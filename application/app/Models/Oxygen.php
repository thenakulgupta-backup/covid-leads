<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oxygen extends Model
{
    protected $table='Oxygen';
    public $timestamps = true; 
    protected $fillable = ['organisation_name','phone','category','state','location',
                            'current_status','important_info','isVerified','verifiedAt'];
}
?>
