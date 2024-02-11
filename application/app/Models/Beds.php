<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beds extends Model
{
    protected $table='Beds';
    public $timestamps = true; 
    protected $fillable = ['organisation_name','phone','category','state','location',
                            'availability','current_status','important_info','isVerified','verifiedAt'];
}
?>
