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
    public $delItem;

    public $filter = [];
    public $statuses = [];

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

    public $yearsZNI;

    public function mount()
    {
        $this->search = '';
        $this->sortField = 'zni';
        $this->sortDirection = 'desc';
        $this->showCreate = $this->showDelete = false;
        $this->newName = $this->newContent = $this->newInitiator = $this->newZNI = $this->newDateZNI = $this->newDOI = $this->newDateDOI = '';

        $this->initiators = ClusterData::getInitiatorsList();
        
        $this->delItem = array('zni'=>'','name'=>'','initiator'=>'','id'=>'');

        $this->yearsZNI = ClusterData::getYearsZNI();

        $this->filter = ['year'=>ClusterData::getMaxYearsZNI()->max_year,'status'=>0];

        $this->statuses = [0=>'Все',2=>'Выполненные',1=>'Невыполненные'];

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
        $this->resetValidation();
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

    //------------------------------------------------    
    //-------Удаление элемента------------------------
    //------------------------------------------------    
    public function delete(int $id)
    {
        $this->showDelete = true;
        $deleteItem = ClusterData::get($id);
        $this->delItem = array(
            'zni'=>$deleteItem->zni ?? '',
            'name'=>$deleteItem->name ?? '',
            'initiator'=>$deleteItem->initiator->name ?? '',
            'id'=>$deleteItem->id ?? '',
            );
    }

    public function cancelDelete()
    {
        $this->showDelete = false;
        $this->delItem = array('zni'=>'','name'=>'','initiator'=>'','id'=>'');
    }


    public function destroy()
    {
        ClusterData::destroy($this->delItem['id']);
        $this->cancelDelete();
    }


    public function render()
    {
        $data = array(
            'sortField'=> $this->sortField,
            'sortDirection'=> $this->sortDirection,
            'search'=> $this->search,
            'filter'=> $this->filter
        );

        $zni = ClusterData::indexWire($data);

        $zni = $zni->paginate(self::PER_PAGE);

        $this->yearsZNI = ClusterData::getYearsZNI();

        return view('livewire.dashboard',['zni'=>$zni]);
    }
}
