<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function delete(Request $request)
    {
        $ids = (array) $request->get('ids');

        try {
            Position::whereIn('id', $ids)->delete();
            return ['status' => 'success'];

        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
