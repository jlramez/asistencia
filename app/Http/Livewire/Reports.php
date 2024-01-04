<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Check;
use App\Models\Employee;
use App\Models\Timetable;
use App\Models\Usershift;
use App\Models\Schedule;
use carbon\Carbon;
use Illuminate\Support\Arr;


class Reports extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $fecha_inicial, $fecha_final, $users_id;
    public function render()
    {
        $retardos=0;
        if($this->fecha_inicial && $this->fecha_final && $this->users_id) 
        {
            if ($this->users_id=="todos")
                {
                    $option=1;
                }
            else
                {
                    $option=2;
                }
           
            switch ($option) 
            {
                case 1:
                    $page='livewire.reports.full';
                   
                    $timetables=Timetable::distinct('users_id')->get();/// use this alone
                    $ttables = $timetables->unique('users_id');
                    $employees=Employee::distinct('id')->count();
                    foreach($ttables as $record)
                        {
                            $checks=Timetable::select('users_id')->where('date','>=', $this->fecha_inicial)
                            ->where('date', '<=', $this->fecha_final)
                            ->where('users_id', $record->users_id)->get();
                            $employee=Employee::Where('id',$record->users_id)->first();
                            $emp_id=$employee->id ?? 'sin dato';
                            $name=$employee->name ?? 'sin dato';
                            $id_shift=Usershift::select('id')->where('users_id', $record->users_id)->first();                          
                            $schedules=Schedule::where('id',$id_shift)->first();
                            $date=$schedules->on ?? '08:30:00';
                            $time=carbon::parse($date);
                            $time_t=$time->addMinutes(15); // add tolerance to the on  time 
                            $time_tt=$time_t->toTimeString();
                            $timetables_delays=Timetable::where('date','>=', $this->fecha_inicial)
                            ->where('date', '<=', $this->fecha_final)
                            ->where('users_id', $record->users_id)
                            ->where('in_time', '>',$time_tt)->count();
                            $array[]=(
                                        [   'emp_id' => $emp_id,
                                            'name' => $name,
                                            'delays'=> $timetables_delays,
                                            'absences' => $timetables_delays/3,
                                            'period' => $this->fecha_inicial.' - '.$this->fecha_final
                                        ]
                                    );                       
                        }                                     
                    break;
                case 2:
                    $page='livewire.reports.view';
                    $timetables=Timetable::where('date','>=', $this->fecha_inicial)
                    ->where('date', '<=', $this->fecha_final)
                    ->where('users_id', $this->users_id)->paginate(15);
                    //dd($timetables, $this->fecha_inicial, $this->fecha_final,$this->users_id);
                    $usershifts=Usershift::where('users_id', $this->users_id)->first();
                    $schedules=Schedule::find($usershifts->schedule_id);
                    $time=carbon::parse($schedules->on);
                    $time_t=$time->addMinutes(15); // add tolerance to the on  time 
                    $time_tt=$time_t->toTimeString();
                    $array=0;
                    foreach($timetables as $record)
                        {                           
                           $time=carbon::parse($schedules->on);
                           $time_t=$time->addMinutes(15); // add tolerance to the on  time 
                           $time_tt=$time_t->toTimeString();
                           $retardos=Timetable::where('date','>=', $this->fecha_inicial)
                           ->where('date', '<=', $this->fecha_final)
                           ->where('users_id', $record->users_id)
                           ->where('in_time', '>',$time_tt)->count();
                            /*if ($record->in_time>$time_tt)
                            {
                             $retardos=$retardos+1; 
                        
                            }*/
                        }    
                    /* default:
                        $timetables=Timetable::all();*/
            }   
            return view($page, [
                'checks' => Check::all(),
                'timetables' => $timetables,
                'employees' => Employee::where('ssocial','0')->orderBy('name', 'asc')->get(),
                'retardos' => $retardos,
                'delays' => 0,
                'array' => $array,
                

            
            ]);

        }
        else
            {
                return view('livewire.reports.view', [
                    'checks' => Check::all(),
                    'timetables' => Timetable::paginate(15),
                    'employees' => Employee::where('ssocial','0')->orderBy('name', 'asc')->get(),
                    'retardos' => $retardos,
                    'delays' => 0,
                    'array' => 0,   ///aqui falla con 'todos'
                   
                
                ]);  
            }
        
    
    }
}
