<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Locked;

use Illuminate\Support\Str;

use App\Data\ClusterData;

class DashboardItem extends Component
{

    use WithFileUploads;

    #[Locked]
    public $modelId;

    public $model;
    
    #[Rule('required', message: 'Не может быть пустым')]
    public $modelName;

    #[Rule('required', message: 'Не может быть пустым')]
    public $modelContent;
    
    #[Rule('required', message: 'Не может быть пустым')]
    public $modelInitiator; 
    
    #[Rule('date', message: 'Неправильная дата')]
    public $modelDateZNI;

    #[Rule('numeric', message: 'Номер должен состоять из цифр')]
    public $modelDOI;

    #[Rule('date', message: 'Неправильная дата')]
    public $modelDateDOI;

    public $showEdit;

    public $initiators;

    public $showAddFile, $showDelFile;
    
    public $addFile, $delFile;
    public $files;

    public function mount($id, $edit=1)
    {
        $this->model = ClusterData::get($id);
        $this->modelId = $id;
        $this->showEdit = empty($edit) ? false : true;

        $this->showAddFile = $this->showDelFile = false;
        $this->addFile = '';
        $this->delFile = array('id'=>null,'name'=>null, 'url'=>null);

        $this->modelName = $this->model->name;
        $this->modelContent = $this->model->content;
        $this->modelInitiator = $this->model->initiator->name;
        $this->modelDateZNI = $this->model->dateZni;
        $this->modelDOI = $this->model->doi ?? null;
        $this->modelDateDOI = $this->model->dateDoi ?? null;

        $this->initiators = ClusterData::getInitiatorsList();
        $this->files = ClusterData::getFileList($this->modelId);


    }

    public function updateData()
    {
        $this->model = ClusterData::get($this->modelId);
        $this->modelName = $this->model->name;
        $this->modelContent = $this->model->content;
        $this->modelInitiator = $this->model->initiator->name;
        $this->modelDateZNI = $this->model->dateZni;
        $this->modelDOI = $this->model->doi;
        $this->modelDateDOI = $this->model->dateDoi;

        $this->initiators = ClusterData::getInitiatorsList();
        $this->files = ClusterData::getFileList($this->modelId);
    }

    public function editItem()
    {
        $this->showEdit = true;
    }

    public function cancelEdit()
    {
        $this->showEdit = false;
        $this->resetValidation();
    }

    public function store()
    {
        
        $this->validate();
        $data = array(
            'name'=>$this->modelName,
            'content'=>$this->modelContent,
            'initiator'=>$this->modelInitiator,
            'dateZni'=>$this->modelDateZNI,
            'doi'=>$this->modelDOI,
            'dateDoi'=>$this->modelDateDOI
        );
        ClusterData::update($this->modelId,$data);
        $this->cancelEdit();
        $this->updateData();
    }

    public function executed()
    {
        ClusterData::executed($this->modelId);
        $this->updateData();
    }

    /*------------------------------------
    -----------FILES----------------------
    ---------------------------------------*/
    public function openAddFile()
    {
        $this->showAddFile = true;
        $this->cancelEdit();

    }

    public function cancelAddFile()
    {
        $this->showAddFile = false;
    }

    public function saveFile()
    {

        if (!empty($this->addFile)) {
            $patch = ''.$this->model->zni;
            $baseName = $this->addFile->getClientOriginalName();
            $filename = Str::random(3).'_'.$this->addFile->getClientOriginalName();
            $url = $patch.'/'.$filename;
            $this->addFile->storeAs($patch,$filename,'public');

        }

        $data = array(
            'name'=>$baseName,
            'url'=>$url,
            'author_id'=>null,
            'cluster_id'=>$this->modelId,
            );
            ClusterData::saveFile($data);        

        $this->cancelAddFile();
        $this->updateData();
    }

    public function showDeleteFile($fileId)
    {
        $this->delFile = ClusterData::getFileArray($fileId);
        $this->showDelFile = true;
    }

    public function deleteUserFile($fileId)
    {
        if (!empty($fileId)) ClusterData::deleteFile($fileId);
        $this->updateData();
        $this->cancelDelFile();
    }

    public function cancelDelFile() {

        $this->delFileUser = array('id'=>null,'name'=>null, 'url'=>null);
        $this->showDelFile = false;
    }

    public function render()
    {
        return view('livewire.dashboard-item');
    }
}
