<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Models\Type;
use App\Services\TypeService;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    private $typeServ;

    public function __construct(TypeService $typeServ) {
        $this->typeServ = $typeServ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('types.index-types', [
            'types' => $this->typeServ->getAll(new Type())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('types.create-type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        $this->typeServ->saveToStore(new Type(), $request->all());
        return redirect(route('types.index'))->with('status', __('type.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('types.edit-type', ['type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        $type->update($request->all());
        return redirect(route('types.index'))->with('status', __('type.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->back()->with('status', __('type.destroy'));
    }
}
