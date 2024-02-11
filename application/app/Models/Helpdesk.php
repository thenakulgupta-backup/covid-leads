<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helpdesk extends Model
{
    protected $table='Helpdesk';
    public $timestamps = true; 
    protected $fillable = ['organisation_name','phone','organisation_type','state','location', 'remarks'];
}
?>
