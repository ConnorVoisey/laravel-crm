<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Field;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $moduleName)
    {
        $validated = $request->all();
        $module = Module::findByName($moduleName);
        if ($module === null) throw new UnprocessableEntityHttpException('no module with that name');
        $moduleId = $module->id;

        $fields = Field::where('module_id', $moduleId)->get();
        $input = [];
        $errors = [];
        foreach ($fields as $field) {
            $val = $validated[$field->name];
            if ($val === null) {
                $errors[$field->name] = 'missing field';
                continue;
            }
            $input[$field->name] = $val;
        }
        if (count($errors) > 0) return new UnprocessableEntityHttpException(json_encode($errors));
        $res = DB::table("module_$moduleName")->insert(['fields' => json_encode($input)]);
        return $res;
    }

    /**
     * Display the specified resource.
     */
    public function show(Entity $entity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entity $entity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entity $entity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entity $entity)
    {
        //
    }
}
