<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tele_consultation extends Model
{
    protected $table='TeleConsultation';
    public $timestamps = true; 
    protected $fillable = ['doctor_name','phone','type','state','location', 'remarks'];
}
?>
