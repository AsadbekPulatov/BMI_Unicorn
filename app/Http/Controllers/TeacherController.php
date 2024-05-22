<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Type;
use App\Models\User;
use App\Services\EmployeeService;
use App\Services\KafedraService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $types = Type::all();
        $user = Auth::user();
        $user_data = json_decode($user->data);
        $kafedra = KafedraService::getKafedraForMudir($user_data->employee_id_number);
        $teachers = EmployeeService::getEmployeesInKafedra($kafedra);
        $new_teachers = [];
        foreach($teachers as $item)
        foreach($item as $teacher){
            foreach ($types as $type){
                $new_teachers[$teacher->employee_id_number]['data'] = $teacher;
                $new_teachers[$teacher->employee_id_number]['count'][$type->id] = 0;
            }
        }
        $plans = Plan::all();
        foreach ($plans as $plan){
            foreach ($types as $type) {
                if (isset($new_teachers[$plan->user_id]))
                    if ($type->id == $plan->type_id)
                    $new_teachers[$plan->user_id]['count'][$type->id] += $plan->limit;
            }
        }
        $teachers = $new_teachers;
        return view('admin.plans.teacher',compact('teachers', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'password_confirmation'=>'required|same:password',
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'teacher',
            'mudir_id'=>auth()->user()->id,
        ]);
        return redirect()->route('teachers.index')->with('msg','Bajarildi');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'password_confirmation'=>'required|same:password',
        ]);
        User::find($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        return redirect()->route('teachers.index')->with('msg','Yangilandi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('teachers.index')->with('msg','O`chirildi');
    }
}
