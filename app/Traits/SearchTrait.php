<?php


namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait SearchTrait
{
    public function getQuery(Request $request, $search = false, $fields = 'name', $setting = false)
    {
        $string     = !empty($search) ? $search : $request->get('string');
        $cols    = $request->has('columns') ? $request->get('columns') : $fields;
        $columns = explode(',', $cols);

        $query = "{$columns[0]} like ? ". ($setting ? ' and setting_id = ' . $request->user()->setting_id . ' ' : '');
        $bindings = ["%{$string}%"];

        if (count($columns) > 1) {
            for ($i = 1; $i < count($columns); $i++) {
                $query .= "or {$columns[$i]} like ? " . ($setting ? ' and setting_id = ' . $request->user()->setting_id . ' ' : '');
                array_push($bindings, "%{$string}%");
            }
        }

        return array($query, $bindings);
    }
}
