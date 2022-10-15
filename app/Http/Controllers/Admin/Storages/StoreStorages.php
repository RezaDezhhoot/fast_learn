<?php

namespace App\Http\Controllers\Admin\Storages;

use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\StorageRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class StoreStorages extends BaseComponent
{
    public $storage, $name, $driver, $config , $status, $description, $header , $max_file_size , $file_types;


    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->storageRepository = app(StorageRepositoryInterface::class);
    }

    public function mount($action, $id = null)
    {
        $this->authorizing('show_storages');
        $this->set_mode($action);

        if ($this->mode == self::UPDATE_MODE) {
            $this->storage = $this->storageRepository->findOrFail($id);
            $this->name = $this->storage->name;
            $this->driver = $this->storage->driver;
            $this->config = (array)$this->storage->config;
            $this->status = $this->storage->status;
            $this->max_file_size = $this->storage->max_file_size;
            $this->file_types = $this->storage->file_types;
            $this->description = $this->storage->description;
            $this->header = $this->name;
        } elseif ($this->mode = self::CREATE_MODE) {
            $this->header = 'فضای دخیره سازی جدید';
        } else abort(404);

        $this->data['status'] = StorageEnum::getStatus();
        $this->data['drivers'] = array_filter(StorageEnum::getStorages(), function ($v, $k) {
            return $k != StorageEnum::PUBLIC;
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function deleteItem()
    {
        $this->authorizing('delete_storages');
        $this->storageRepository->destroy($this->storage->id);
        return redirect()->route('admin.storage');
    }

    public function store()
    {
        $this->authorizing('edit_storages');
        if ($this->mode == self::UPDATE_MODE) {
            $this->saveInDataBase($this->storage);
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->storageRepository::getNewObject());
            $this->resetData();
        }
    }

    private function saveInDataBase($model)
    {
        $this->name = trim($this->name);
        $fields = [
            'name' => ['required',Rule::notIn(StorageEnum::getStorages()), 'string', 'max:200', 'unique:storages,name,' . ($this->storage->id ?? 0)],
            'status' => ['required', 'string', 'in:' . implode(',', array_keys(StorageEnum::getStatus()))],
            'description' => ['nullable', 'string', 'max:250'],
            'max_file_size' => ['nullable','integer','min:1024'],
            'file_types' => ['nullable','string','max:4000']
        ];
        $messages = [
            'name' => 'عنوان',
            'status' => 'وضعیت',
            'description' => 'توضیحات',
            'max_file_size' => 'حداکثر حجم مجاز اپلود فایل',
            'file_types' => 'فرمت فایل های مجاز',
        ];
        if ($this->mode == self::CREATE_MODE) {
            $fields['driver'] = ['required', 'string', 'in:' . implode(',', array_keys($this->data['drivers']))];
            $messages['driver'] = 'درایور';
        }
        $this->validate($fields, [], $messages);
        $config = [];
        if ($this->driver == StorageEnum::PRIVATE) {
            if ($this->mode == self::CREATE_MODE) {
                $folder_name = uniqid('custom_storage_');
            } else $folder_name = $model->folder_name;

            $config = [
                'driver' => 'local',
                'root' => storage_path("app/$folder_name"),
                'url' => '',
                'visibility' => 'private',
                'throw' => false,
            ];
            $model->folder_name = $folder_name;
        } else {
            switch ($this->driver) {
                case StorageEnum::FTP:
                    $this->validate([
                        'config.root' => ['required', 'string', 'max:250'],
                        'config.host' => ['required', 'string', 'max:250'],
                        'config.username' => ['required', 'string', 'max:250'],
                        'config.password' => ['required', 'string', 'max:250'],
                        'config.port' => ['required', 'integer', 'between:0,999999999999999999'],
                        'config.ssl' => ['boolean']
                    ], [], []);
                    $config = [
                        'driver' => 'FTP',
                        'root' => trim($this->config['root']),
                        'host' => trim($this->config['host']),
                        'username' => trim($this->config['username']),
                        'password' => trim($this->config['password']),
                        'port' => $this->config['port'] ?? 21,
                        'ssl' => ($this->config['ssl'] ?? false) == 1,
                        'timeout' => 120,
                    ];
                    break;
                case StorageEnum::SFTP:
                    $this->validate([
                        'config.root' => ['required', 'string', 'max:1000'],
                        'config.privateKey' => ['nullable', 'string'],
                        'config.hostFingerprint' => ['nullable', 'string'],
                        'config.maxTries' => ['required', 'integer', 'between:0,999999999999999999'],
                        'config.port' => ['required', 'integer', 'between:0,999999999999999999'],
                        'config.passphrase' => ['nullable', 'string'],
                        'config.host' => ['required', 'string', 'max:1000'],
                        'config.username' => ['required', 'string', 'max:1000'],
                        'config.password' => ['required', 'string', 'max:1000'],
                        'config.useAgent' => ['boolean'],
                    ], [], []);
                    $config = [
                        'driver' => 'SFTP',
                        'host' => trim($this->config['host']),
                        'username' => trim($this->config['username']),
                        'password' => trim($this->config['password']),
                        'privateKey' =>  trim($this->config['privateKey']),
                        'hostFingerprint' => trim($this->config['hostFingerprint']),
                        'maxTries' => (int)($this->config['maxTries'] ?? 4),
                        'passphrase' => trim($this->config['passphrase']),
                        'port' =>  (int)($this->config['port'] ?? 22),
                        'root' =>  trim($this->config['root']),
                        'timeout' => 30,
                        'useAgent' => ($this->config['useAgent'] ?? false) == 1,
                    ];
                    break;
            }
        }
        if ($this->mode == self::CREATE_MODE) {
            $model->driver = $this->driver;
        }
        $model->name = $this->name;
        $model->config = $config;
        $model->status = $this->status;
        $model->file_types = $this->file_types;
        $model->max_file_size = $this->max_file_size;
        $model->description = $this->description;
        $model = $this->storageRepository->save($model);


        if ($this->status == StorageEnum::DELETED) {
            $model->delete();
        } else {
            if ($model->trashed()) {
                $model->restore();
            }
        }
        return $this->emitNotify('اظلاعات با موفقیت ذخیره شد');
    }

    public function resetData()
    {
        $this->reset(['config','name','driver','status','description','file_types','max_file_size']);
    }

    public function render()
    {
        return view('admin.storages.store-storages')->extends('admin.layouts.admin');
    }
}
