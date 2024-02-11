<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tiffin extends Model
{
    protected $table='Tiffin';
    public $timestamps = true; 
    protected $fillable = ['organisation_name','phone','meal','state','location',
                            'current_status','important_info','isVerified','verifiedAt'];
}
?>
