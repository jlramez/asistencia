<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Check extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'checks';

    protected $fillable = ['users_id','checktime','date','types_id'];
    public function employees()
    {
  
      return $this->HasOne(Employee::class,'id','users_id');//relacion con usuarios
  
    }
	
}
