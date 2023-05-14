<?php

namespace App\Repositories;

use App\Interface\CURD;
use Illuminate\Container\Container as App;

abstract class baseCURD implements CURD
{

    private $app;
    private $modelClass;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->modelClass = $this->getModel();
    }

    abstract public function getModel();

    public function create(array $data): string | array
    {
        $newInstance = $this->app->make($this->modelClass);
        return $this->setInstance($newInstance, $data);
    }

    public function edit(int $id, array $data): string | array
    {
        $instance = $this->app->make($this->modelClass);
        return $this->setInstance($instance, $data);
    }

    public function delete(int $id): string
    {
        $instance = $this->app->make($this->modelClass)->find($id);
        if ($instance) {
            $instance->delete();
            return 'Delete Success';
        }
        return 'Delete failed , id not found.';
    }

    public function setInstance($instance, $data): string | array
    {
        return '';
    }
}
