<?php

namespace App\Http\Controllers;

use App\El3ohad;
use App\El3ohadBranch;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Facades\Voyager;

class TransferController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = $model->findOrFail($id);
        }

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        event(new BreadDataUpdated($dataType, $data));

        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
        }

        return $redirect->with([
            'message' => __('voyager::generic.successfully_updated') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
    }

    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());
        if ($data) {
            $this->calculate_el3ohad($request);
        }

        event(new BreadDataAdded($dataType, $data));

        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message' => __('voyager::generic.successfully_added_new') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    public function calculate_el3ohad(Request $request)
    {
        $from_employee = $request->request->get("from_employee");
        $to_employee = $request->request->get("to_employee");
        $from_branch = $request->request->get("from_branch");
        $to_branch = $request->request->get("to_branch");
        $money = $request->request->get("money");
        $employees = El3ohad::whereIn("employee_id", [$from_employee, $to_employee])->get();
        $branches = El3ohadBranch::whereIn("branch_id", [$from_branch, $to_branch])->get();

        foreach ($employees as $employee) {
            if ($employee->employee_id == $from_employee) {
                $employee->money -= $money;
            } elseif ($employee->employee_id == $to_employee) {
                $employee->money += $money;
            }
            $employee->save();
        }

        foreach ($branches as $branch) {
            if ($branch->branch_id == $from_branch) {
                $branch->money -= $money;
            } elseif ($branch->branch_id == $to_branch) {
                $branch->money += $money;
            }
            $branch->save();
        }
    }
}
