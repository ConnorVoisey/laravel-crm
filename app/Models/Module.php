<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Module extends Model
{
    use HasFactory;
    public function getKeyType()
    {
        return 'string';
    }
    public static function build(string $name, string $label)
    {
        // create the table
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS module_$name (
    "id" uuid primary key default uuid_generate_v1mc(),
    "fields" json,
    "created_at" timestamptz default now(),
    "updated_at" timestamptz
);
SQL;
        DB::statement($sql);

        // create the entry in the module table
        $module = new Module();
        $module->name = $name;
        $module->label = $label;
        $module->save();
        return $module;
    }
    public static function findByName(string $name)
    {
        return Module::where('name', $name)->first();
    }
}
