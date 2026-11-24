<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

#[Signature('cafe:admin-create')]
#[Description('Create an administrator account.')]
class CreateAdmin extends Command
{
    public function handle(): int
    {
        $name = $this->ask('Name');
        $username = $this->ask('Username');

        $validator = Validator::make(['username' => $username], [
            'username' => ['required', 'string', 'max:255', 'unique:admins,username'],
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first('username'));

            return self::FAILURE;
        }

        $password = $this->secret('Password');
        $passwordConfirmation = $this->secret('Confirm password');

        if ($password === null || $password !== $passwordConfirmation) {
            $this->error('The password confirmation does not match.');

            return self::FAILURE;
        }

        $admin = new Admin;
        $admin->nama = $name;
        $admin->username = $username;
        $admin->password = $password;
        $admin->save();

        $this->info('Administrator created successfully.');

        return self::SUCCESS;
    }
}
