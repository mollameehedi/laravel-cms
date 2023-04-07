<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryCreateRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = ('<div class="dropdown">
                    
                    <span role="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                    <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                  </svg>
                    </span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="">
                        <li>
                        <a class="dropdown-item badge bg-soft-danger p-2 text-danger" href="' . route('admin.category.destroy', $row->id) . '">
                            
                        <svg class="icon-32" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                        <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                        </svg>
                    Delete
                        </a>
                        </li>
                        <li>
                        <a class="dropdown-item badge bg-soft-info p-2 text-danger" href="' . route('admin.category.destroy', $row->id) . '">
                            
                        <svg class="icon-32" width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                        <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                        </svg>
                    Delete
                        </a>
                        </li>
                    </ul>
                </div>');
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.category.index');
    }
    // ->addColumn('action', function($row){
    //     $actionBtn = '<a href="'.route('admin.trash.users.restore_trash',$row->id).'"  class="btn btn-success" title="View Profle" style="color: #fff">
    //          <i class="fas fa-undo-alt"></i>
    //     </a>
    //     <a href="'.route('admin.trash.users.delete_trash',$row->id).'"  class="btn btn-danger" title="Delete User" style="color: #fff">
    //       <i class="fas fa-trash"></i>
    //     </a>';
    //     return $actionBtn;
    // })
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully');
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
        $category = Category::findOrFail($id);
        return view('admin.category.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
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

    public function search(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'id',
            2 => 'id',
            3 => 'name',
            4 => 'status',
            7 => 'action',
        ];

        $totalData = Category::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $categories = Category::when(!empty($search), function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        $totalFiltered = Category::when(!empty($search), function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })->count();

        $data = [];

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $status = $category->status == 1 ? 'checked' : '';

                $nestedData['responsive_id'] = '';
                $nestedData['id']           = $category->id;
                $nestedData['name']          = $category->name;
                $nestedData['status']      = "<div class='form-check form-switch form-check-primary'>
                <input type='checkbox' class='form-check-input get_required get_status' id='required_$category->id' data-id='$category->id' name='status' $status>
                <label class='form-check-label' for='required_$category->id'>
                  <span class='switch-icon-left' style='margin-top: 8px'><i data-feather='check'></i> </span>
                  <span class='switch-icon-right' style='margin-top: 8px'><i data-feather='x'></i> </span>
                </label>
              </div>";
                $nestedData['edit']          = route('admin.category.edit', $category->id);
                $data[]                      = $nestedData;
            }
        }

        $json_data = [
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
        ];

        return response()->json($json_data);
        exit();
    }

    public function active(Request $request)
    {
        $category = Category::findOrFail($request->id);
        if ($category->status == 1) {
            $category->status = 0;
        } else {
            $category->status = 1;
        }
        $category->save();
        return response([
            'status' => 'success',
            'message' => 'Category status updated successfully'
        ]);
    }
}
