<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table='states';
    public $timestamps = true; 
    protected $fillable = ['state_code','state_name','state_type'];
}
?>
