<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Facades\Voyager;

class ManualJournalsController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function store(Request $request)
    {
//        dd($request->request);
        $slug = $this->getSlug($request);

        if($request->get("employee_id") == null){
            return redirect()->route("voyager.{$slug}.create")->with(['message' => "you must choose employee", 'alert-type' => 'error']);
        }

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        $employee = Employee::with("el3ohad")->where("id", $request->request->get("employee_id"))->first();
        if ($request->get("type") == "pos"){
             $employee->el3ohad->money +=  $request->get("amount");
             $employee->el3ohad->save();
        }
        elseif ($request->get("type") == "neg"){
            $employee->el3ohad->money -=  $request->get("amount");
            $employee->el3ohad->save();
        }


        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        event(new BreadDataAdded($dataType, $data));

        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => __('voyager::generic.successfully_added_new')." {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }
}
