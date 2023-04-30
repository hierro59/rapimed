<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetadataUsers;

class OperationServicesController extends Controller
{
    public static function CheckMetadata($id) {
        $getMetadata = MetadataUsers::where('customer_id', '=', $id)->get();
        if (count($getMetadata) >= 1) {
            if ($getMetadata[0]['address'] == 'Sin datos' OR $getMetadata[0]['city'] == 'Sin datos' OR $getMetadata[0]['state'] == 'Sin datos' OR $getMetadata[0]['phone'] == 'Sin teléfono') {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}
