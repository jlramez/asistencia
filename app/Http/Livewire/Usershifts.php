<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Usershift;

class Usershifts extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $users_id, $schedule_id;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.usershifts.view', [
            'usershifts' => Usershift::latest()
						->orWhere('users_id', 'LIKE', $keyWord)
						->orWhere('schedule_id', 'LIKE', $keyWord)
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
		$this->schedule_id = null;
    }

    public function store()
    {
        $this->validate([
		'users_id' => 'required',
		'schedule_id' => 'required',
        ]);

        Usershift::create([ 
			'users_id' => $this-> users_id,
			'schedule_id' => $this-> schedule_id
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Usershift Successfully created.');
    }

    public function edit($id)
    {
        $record = Usershift::findOrFail($id);
        $this->selected_id = $id; 
		$this->users_id = $record-> users_id;
		$this->schedule_id = $record-> schedule_id;
    }

    public function update()
    {
        $this->validate([
		'users_id' => 'required',
		'schedule_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Usershift::find($this->selected_id);
            $record->update([ 
			'users_id' => $this-> users_id,
			'schedule_id' => $this-> schedule_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Usershift Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Usershift::where('id', $id)->delete();
        }
    }
}