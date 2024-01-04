<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Timetable extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'timetables';

    protected $fillable = ['users_id','date','in_time','out_time'];
    public function employees()
    {
  
      return $this->HasOne(Employee::class,'id','users_id');//relacion con usuarios
  
    }
	
}
