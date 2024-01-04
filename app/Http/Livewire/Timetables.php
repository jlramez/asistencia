<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Timetable;

class Timetables extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $users_id, $date, $in_time, $out_time;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.timetables.view', [
            'timetables' => Timetable::latest()
						->orWhere('users_id', 'LIKE', $keyWord)
						->orWhere('date', 'LIKE', $keyWord)
						->orWhere('in_time', 'LIKE', $keyWord)
						->orWhere('out_time', 'LIKE', $keyWord)
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
		$this->date = null;
		$this->in_time = null;
		$this->out_time = null;
    }

    public function store()
    {
        $this->validate([
		'users_id' => 'required',
		'date' => 'required',
		'in_time' => 'required',
		'out_time' => 'required',
        ]);

        Timetable::create([ 
			'users_id' => $this-> users_id,
			'date' => $this-> date,
			'in_time' => $this-> in_time,
			'out_time' => $this-> out_time
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Timetable Successfully created.');
    }

    public function edit($id)
    {
        $record = Timetable::findOrFail($id);
        $this->selected_id = $id; 
		$this->users_id = $record-> users_id;
		$this->date = $record-> date;
		$this->in_time = $record-> in_time;
		$this->out_time = $record-> out_time;
    }

    public function update()
    {
        $this->validate([
		'users_id' => 'required',
		'date' => 'required',
		'in_time' => 'required',
		'out_time' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Timetable::find($this->selected_id);
            $record->update([ 
			'users_id' => $this-> users_id,
			'date' => $this-> date,
			'in_time' => $this-> in_time,
			'out_time' => $this-> out_time
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Timetable Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Timetable::where('id', $id)->delete();
        }
    }
}