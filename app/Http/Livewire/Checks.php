<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Check;
use App\Models\Timetable;
use App\Models\Usershift;
use App\Models\Schedule;

use Carbon\Carbon;

class Checks extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $users_id, $checktime;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.checks.view', [
            'checks' => Check::latest()
						->orWhere('users_id', 'LIKE', $keyWord)
						->orWhere('checktime', 'LIKE', $keyWord)
						->paginate(20),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->users_id = null;
		$this->checktime = null;
    }

    public function store()
    {
        $this->validate([
		'users_id' => 'required',
		'checktime' => 'required',
        ]);

        Check::create([ 
			'users_id' => $this-> users_id,
			'checktime' => $this-> checktime
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Check Successfully created.');
    }

    public function edit($id)
    {
        $record = Check::findOrFail($id);
        $this->selected_id = $id; 
		$this->users_id = $record-> users_id;
		$this->checktime = $record-> checktime;
    }

    public function update()
    {
        $this->validate([
		'users_id' => 'required',
		'checktime' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Check::find($this->selected_id);
            $record->update([ 
			'users_id' => $this-> users_id,
			'checktime' => $this-> checktime
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Check Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Check::where('id', $id)->delete();
        }
    }
    
    public function divide()
    {

      $checks=Check::all();
      $check_count=Check::all()->count();
      foreach ($checks as $row)
      {
            $date = Carbon::parse($row->checktime); //variable carbon
            $date_day=$date->toDateString(); //fecha
            $date_hour=$date->toTimeString();//hora
            $shift_employee=Usershift::where('users_id', $row->users_id)->first();
            $schedule=Schedule::find($shift_employee->schedule_id ?? '24');
            if (($date_hour>=$schedule->on) && ($date_hour<$schedule->out))
                {
                    $timetable=new timetable;
                    $timetable->users_id= $row->users_id;
                    $timetable->date= $row->date;
                    $timetable->in_time= $date_hour;
                    $timetable->out_time= NULL;
                    $timetable->save();
                }
         }
    
    }
    public function divide_out()
    {

      $checks=Check::all();
      $check_count=Check::all()->count();
      foreach ($checks as $row)
      {
            $date = Carbon::parse($row->checktime); //variable carbon
            $date_day=$date->toDateString(); //fecha
            $date_hour=$date->toTimeString();//hora
            $shift_employee=Usershift::where('users_id', $row->users_id)->first();
            $schedule=Schedule::find($shift_employee->schedule_id ?? '24');     
                if (($date_hour>=$schedule->out))
                {
                    $timetable=Timetable::where('users_id', $row->users_id)->where('date', $row->date)->where('out_time', null)->first();
                   if ($timetable)
                    {
                        $timetable->out_time= $date_hour;
                        $timetable->save();
                
                    }
                }
         }
    
    }
    public function calcule_date()
    {

      $checks=Check::all();
      $check_count=Check::all()->count();
      foreach ($checks as $row)
      {
            $date = Carbon::parse($row->checktime); //variable carbon
            $date_day=$date->toDateString(); //fecha
            $date_hour=$date->toTimeString();//hora
            $row->date= $date_day;
            $row->save();
            
       }
    
    }

}