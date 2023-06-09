<?php

namespace App\Interface;

interface CURD
{

    public function create(array $data);

    public function edit(int $id, array $data);

    public function delete(int $id);
}
