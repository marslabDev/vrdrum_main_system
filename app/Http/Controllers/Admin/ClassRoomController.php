<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClassRoomRequest;
use App\Http\Requests\StoreClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;
use App\Models\Branch;
use App\Models\ClassRoom;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClassRoomController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('class_room_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClassRoom::with(['branch', 'created_by'])->select(sprintf('%s.*', (new ClassRoom())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'class_room_show';
                $editGate = 'class_room_edit';
                $deleteGate = 'class_room_delete';
                $crudRoutePart = 'class-rooms';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('room_title', function ($row) {
                return $row->room_title ? $row->room_title : '';
            });
            $table->editColumn('is_available', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_available ? 'checked' : null) . '>';
            });
            $table->addColumn('branch_name', function ($row) {
                return $row->branch ? $row->branch->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'is_available', 'branch']);

            return $table->make(true);
        }

        return view('admin.classRooms.index');
    }

    public function create()
    {
        abort_if(Gate::denies('class_room_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branches = Branch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.classRooms.create', compact('branches'));
    }

    public function store(StoreClassRoomRequest $request)
    {
        $classRoom = ClassRoom::create($request->all());

        return redirect()->route('admin.class-rooms.index');
    }

    public function edit(ClassRoom $classRoom)
    {
        abort_if(Gate::denies('class_room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branches = Branch::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $classRoom->load('branch', 'created_by');

        return view('admin.classRooms.edit', compact('branches', 'classRoom'));
    }

    public function update(UpdateClassRoomRequest $request, ClassRoom $classRoom)
    {
        $classRoom->update($request->all());

        return redirect()->route('admin.class-rooms.index');
    }

    public function show(ClassRoom $classRoom)
    {
        abort_if(Gate::denies('class_room_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classRoom->load('branch', 'created_by');

        return view('admin.classRooms.show', compact('classRoom'));
    }

    public function destroy(ClassRoom $classRoom)
    {
        abort_if(Gate::denies('class_room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $classRoom->delete();

        return back();
    }

    public function massDestroy(MassDestroyClassRoomRequest $request)
    {
        ClassRoom::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
