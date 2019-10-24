<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ DB, Validator };

class RoleController extends Controller
{

    public function create(Request $request) {
        $validate = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed submission, please try again!');

        $result = new Role;
        $result->name = trim($request->input('name'));
        $result->save();

        return $result
            ? back()->with('message', 'Success! Role created.')
            : back()->with('error', 'Unable to create Role.');
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed submission, please try again!');

        $result = Role::all()->find($id);
        $result->name = trim($request->input('name'));
        $result->update();

        return $result
            ? back()->with('message', 'Success! Role updated.')
            : back()->with('error', 'Unable to update Role');
    }

}
