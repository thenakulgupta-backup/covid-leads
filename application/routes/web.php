<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(array('namespace' => 'App\Http\Controllers'), function() {

    Route::get('/', function () {
        return view('index');
    });


    // API
    Route::get('api/', function () {
        $data = csv_to_array();
        for ($i=0;$i<count($data);$i++) {
            if (isset($data[$i][""])) {
                unset($data[$i][""]);
            }
            $data[$i]["organisation_name"] = empty($data[$i]["NAME"])? (empty($data[$i]["organisation_name"])?"Unknown":$data[$i]["organisation_name"]):$data[$i]["NAME"];
            unset($data[$i]["NAME"]);
            $data[$i]["category"] = $data[$i]["CATEGORY"];
            unset($data[$i]["CATEGORY"]);
            $data[$i]["availability"] = $data[$i]["No. of BEDS"];
            unset($data[$i]["No. of BEDS"]);
            $state = getStateCodeByName(trim($data[$i]["STATE"]));
            $data[$i]["state"] = $state?$state:$data[$i]["STATE"];
            unset($data[$i]["STATE"]);
            $data[$i]["location"] = $data[$i]["LOCATION"];
            unset($data[$i]["LOCATION"]);
            $data[$i]["phone"] = $data[$i]["NUMBER"];
            unset($data[$i]["NUMBER"]);
            $data[$i]["isVerified"] = in_array(trim(strtolower($data[$i]["Verified"])), array("yes","yee"));
            unset($data[$i]["Verified"]);
        }
        return view('welcome');
    });

    Route::get("api/states/import", function(){return importStatesToDB();});
    Route::post("api/states", "Data@getAllStates");
    Route::post("api/getDetails/{state}/{mode}", "Data@getDetails");
    Route::post("api/submitData/{state}/{mode}", "Data@submitData");
    Route::post("api/getFormData/{mode}", "Data@getFormData");
});
