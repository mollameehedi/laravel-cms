<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Domain\CreateDomainRequest;
use App\Http\Requests\Admin\Domain\UpdateDomainRequest;
use App\Models\Domain;
use Illuminate\Http\Request;
use voku\helper\ASCII;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.domain.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.domain.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDomainRequest $request)
    {
        Domain::create($request->all());
        return redirect()->route('admin.domain.index')->with([
            'status'  => 'success',
            'message' => 'Domain Added Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $domain = Domain::findOrFail($id);
        return view('admin.domain.form',compact('domain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomainRequest $request,Domain $domain)
    {
        $domain->update($request->all());
        return redirect()->route('admin.domain.index')->with('success', 'Domain updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    #[NoReturn] public function search(Request $request):void
    {
        $columns = [
            'id',
            'id',
            'domain',
            'status',
            'action',
        ];

        $totalData = Domain::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        $search = $request->input('search.value');
        $domains = Domain::when(!empty($search), function ($query) use ($search) {
            $query->where('domain', 'like', "%{$search}%");
        })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $totalFiltered = Domain::when(!empty($search), function ($query) use ($search) {
            $query->where('domain', 'like', "%{$search}%");
        })
            ->count();
        $data = [];
        if ( ! empty($domains)) {
            foreach ($domains as $domain) {
                $show = route('admin.domain.edit', $domain->id);

                if ($domain->is_active) {
                    $status = 'checked';
                } else {
                    $status = '';
                }

                $nestedData['id']           = $domain->id;
                $nestedData['domain']          = $domain->domain;

                $nestedData['status'] = "<div class='form-check form-switch form-check-primary'>
                <input type='checkbox' class='form-check-input get_status' id='status_$domain->id' data-id='$domain->id' name='status' $status>
                <label class='form-check-label' for='status_$domain->id'>
                  <span class='switch-icon-left' style='margin-top:7px'><i data-feather='check'></i> </span>
                  <span class='switch-icon-right' style='margin-top:7px'><i data-feather='x'></i> </span>
                </label>
              </div>";

                $nestedData['edit'] = $show;
                $data[]             = $nestedData;

            }
        }
        $json_data = [
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data,
        ];
        echo json_encode($json_data);
        exit();
    }

    public function active(Request $request)
    {
        $domain = Domain::findOrFail($request->id);
        if ($domain->is_active) {
            $domain->is_active = false;
        } else {
            $domain->is_active = true;
        }
        $domain->save();
        return response([
            'status' => 'success',
            'message' => 'Domain status updated successfully',
        ]);
    }
}
