<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeTable;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $time_tables = TimeTable::get();
        return view('home',compact('time_tables'));
    }

    public function schedule(Request $request){

        $data = TimeTable::where('clas',$request->classes)->first();
        return response()->json($data);
    }

    public function create(Request $request){

        $validated = $request->validate([
            'clas' => 'required|string|max:255',
            'no_of_days' => 'required|integer|min:1|max:7',
            'no_of_period' => 'required|integer|min:1',
            'clas_time' => 'required|date_format:h:i',
            'duration_class' => 'required|string',
            'no_of_breaks' => 'required|integer',
            'period_break1' => 'nullable|string',
            'duration_break1' => 'nullable|string',
            'period_break2' => 'nullable|string',
            'duration_break2' => 'nullable|string',
            'period_break3' => 'nullable|string',
            'duration_break3' => 'nullable|string',
        ]);

try{
       $save = TimeTable::create([
            'clas' => $request->input('clas'),
            'no_of_days' => $request->input('no_of_days'),
            'no_of_period' => $request->input('no_of_period'),
            'clas_time' => $request->input('clas_time'),
            'duration_class' => $request->input('duration_class'),
            'no_of_breaks' => $request->input('no_of_breaks'),
            'period_break1' => $request->input('period_break1'),
            'duration_break1' => $request->input('duration_break1'),
            'period_break2' => $request->input('period_break2'),
            'duration_break2' => $request->input('duration_break2'),
            'period_break3' => $request->input('period_break3'),
            'duration_break3' => $request->input('duration_break3'),
        ]);
     $latestRecord = TimeTable::latest()->first();

     $workingDays = [];

     $startDate = Carbon::now()->startOfWeek();

     for ($i = 0; $i < $latestRecord->no_of_days; $i++) {
        $workingDays[] = $startDate->copy()->addDays($i)->format('l');
    }

        return view('time_map',compact('latestRecord','workingDays'))->with('success', 'Time saved successfully!');
       //return response()->json(['message' => 'Time saved successfully!']);

    }catch (\Illuminate\Database\QueryException $e){
        return back()->with('danger','Something went wrong!');
    }
        
    }

}
