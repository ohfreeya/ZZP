<?php

namespace App\Services;

use App\Repositories\ResetPasswordRepository;
use App\Repositories\UserRepository;

class AccountService
{
    public function __construct(
        private ResetPasswordRepository $resetPasswordRepository,
        private UserRepository $userRepository
    ) {
        $this->resetPasswordRepository = $resetPasswordRepository;
        $this->userRepository = $userRepository;
    }

    public function create($model, $data)
    {
        if ($model === 'user') {
            return $this->userRepository->create($data);
        }
        if ($model === 'reset_password') {
            return $this->resetPasswordRepository->create($data);
        }
    }

    public function update($id,  $data)
    {
        return $this->userRepository->update($id, $data);
    }

    // exists -> update, not exists -> create google
    public function updateOrCreate($compareField, $data)
    {
        $user = $this->userRepository->updateOrCreate($compareField, $data);
        return $user;
    }

    public function getData($model, $value)
    {
        if($model === 'user') {
            $fieldName = 'email';
            $user = $this->userRepository->getDataFromSingleField($fieldName, $value);
        }
        if($model === 'reset_password') {
            $fieldName = 'token';
            $user = $this->resetPasswordRepository->getDataFromSingleField($fieldName, $value);
        }
        return $user;
    }
}