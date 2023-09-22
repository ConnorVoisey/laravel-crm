<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Field;
use App\Models\Module;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $contactModule = Module::build('contact', 'Contact');
        Field::insert([
            [
                'name' => 'first_name',
                'label' => 'First Name',
                'field_type' => 'text',
                'module_id' => $contactModule->id
            ], [
                'name' => 'last_name',
                'label' => 'Last Name',
                'field_type' => 'text',
                'module_id' => $contactModule->id
            ], [
                'name' => 'email',
                'label' => 'Email',
                'field_type' => 'email',
                'module_id' => $contactModule->id
            ]
        ]);
    }
}
