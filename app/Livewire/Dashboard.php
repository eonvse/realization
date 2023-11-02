<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

use App\Data\ClusterData;

class Dashboard extends Component
{
    
    const PER_PAGE=20;

    public $search, $sortField, $sortDirection;
    public $showCreate, $showDelete;

    public $initiators;
    
    #[Rule('required', message: 'Не может быть пустым')]
    public $newName;

    #[Rule('required', message: 'Не может быть пустым')]
    public $newContent;
    
    #[Rule('required', message: 'Не может быть пустым')]
    public $newInitiator; 
    
    #[Rule('numeric', message: 'Номер должен состоять из цифр')]
    public $newZNI;

    #[Rule('date', message: 'Неправильная дата')]
    public $newDateZNI;

    #[Rule('numeric', message: 'Номер должен состоять из цифр')]
    public $newDOI;

    #[Rule('date', message: 'Неправильная дата')]
    public $newDateDOI;

    public function mount()
    {
        $this->search = '';
        $this->sortField = 'zni';
        $this->sortDirection = 'desc';
        $this->showCreate = $this->showDelete = false;
        $this->newName = $this->newContent = $this->newInitiator = $this->newZNI = $this->newDateZNI = $this->newDOI = $this->newDateDOI = '';

        $this->initiators = ClusterData::getInitiatorsList();

    }

    public function sortBy($field)
    {

        $this->sortDirection = $this->sortField === $field
                            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
                            : 'asc';

        $this->sortField = $field;
        
    }

    public function create()
    {
        $this->showCreate = true;
    }

    public function cancelCreate()
    {
        $this->showCreate = false;
        $this->newName = $this->newContent = $this->newInitiator = $this->newZNI = $this->newDateZNI = $this->newDOI = $this->newDateDOI = '';
    }

    public function store()
    {
        $this->validate();
        $data = array(
            'name'=>$this->newName,
            'content'=>$this->newContent,
            'initiator'=>$this->newInitiator,
            'zni'=>$this->newZNI,
            'dateZni'=>$this->newDateZNI,
            'doi'=>$this->newDOI,
            'dateDoi'=>$this->newDateDOI
        );
        ClusterData::create($data);
        $this->cancelCreate();
        $this->initiators = ClusterData::getInitiatorsList();
    }

    public function render()
    {
        $data = array(
            'sortField'=> $this->sortField,
            'sortDirection'=> $this->sortDirection,
            'search'=> $this->search
        );

        $zni = ClusterData::indexWire($data);

        $zni = $zni->paginate(self::PER_PAGE);
        return view('livewire.dashboard',['zni'=>$zni]);
    }
}
