<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Schedule;

class Usershift extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'usershifts';

    protected $fillable = ['users_id','schedule_id'];

    public function employees()
    {
  
      return $this->HasOne(Employee::class,'id','users_id');//relacion con usuarios
  
    }
    public function schedules()
    {
  
      return $this->HasOne(Schedule::class,'id','schedule_id');//relacion con usuarios
  
    }
	
}
