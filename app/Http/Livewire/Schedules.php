<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Schedule;

class Schedules extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $descripcion, $on, $out, $tolerance, $active;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.schedules.view', [
            'schedules' => Schedule::latest()
						->orWhere('descripcion', 'LIKE', $keyWord)
						->orWhere('on', 'LIKE', $keyWord)
						->orWhere('out', 'LIKE', $keyWord)
						->orWhere('tolerance', 'LIKE', $keyWord)
						->orWhere('active', 'LIKE', $keyWord)
						->paginate(20),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->descripcion = null;
		$this->on = null;
		$this->out = null;
		$this->tolerance = null;
		$this->active = null;
    }

    public function store()
    {
        $this->validate([
		'descripcion' => 'required',
		'on' => 'required',
		'out' => 'required',
		'tolerance' => 'required',
		'active' => 'required',
        ]);

        Schedule::create([ 
			'descripcion' => $this-> descripcion,
			'on' => $this-> on,
			'out' => $this-> out,
			'tolerance' => $this-> tolerance,
			'active' => $this-> active
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Schedule Successfully created.');
    }

    public function edit($id)
    {
        $record = Schedule::findOrFail($id);
        $this->selected_id = $id; 
		$this->descripcion = $record-> descripcion;
		$this->on = $record-> on;
		$this->out = $record-> out;
		$this->tolerance = $record-> tolerance;
		$this->active = $record-> active;
    }

    public function update()
    {
        $this->validate([
		'descripcion' => 'required',
		'on' => 'required',
		'out' => 'required',
		'tolerance' => 'required',
		'active' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Schedule::find($this->selected_id);
            $record->update([ 
			'descripcion' => $this-> descripcion,
			'on' => $this-> on,
			'out' => $this-> out,
			'tolerance' => $this-> tolerance,
			'active' => $this-> active
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Schedule Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Schedule::where('id', $id)->delete();
        }
    }
}