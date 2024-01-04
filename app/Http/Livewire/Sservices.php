<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class Sservices extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.sservices.view', [
            'employees' => Employee::where('ssocial','1')
            ->where('active','1')
            ->latest()			
			->paginate(20),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
    }
	
    private function resetInput()
    {		
		$this->name = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
        ]);

        Employee::create([ 
			'name' => $this-> name,
            'ssocial' => 1,
        ]);
        
        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Employee Successfully created.');
    }

    public function edit($id)
    {
        $record = Employee::findOrFail($id);
        $this->selected_id = $id; 
		$this->name = $record-> name;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
        
        ]);

        if ($this->selected_id) {
			$record = Employee::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
            'ssocial' => 1
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Employee Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Employee::where('id', $id)->delete();
        }
    }


}

