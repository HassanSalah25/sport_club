<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeesRequest;
use App\Http\Requests\UpdateEmployeesRequest;
use App\Models\JoinAndLeave;
use App\Models\Levels;
use App\Models\Sports;
use App\Models\SportsAndLevelTrainer;
use App\Models\SportsAndLevelTrainerArchive;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('is_trainer', '1')
            ->orderBy('created_at', 'DESC')->paginate(10);
        return view('Dashboard.Trainers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sports = Sports::get();
        return view('Dashboard.Trainers.create', compact('sports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeesRequest $request)
    {
//        dd($request->all());
        $fileNamePath = "";
        if ($request->hasFile('image')) {
            $objFile = $request->image;
            $fileName = time() . $objFile->getClientOriginalName();
            $pathFile = public_path("storage/trainer/images");
            $objFile->move($pathFile, $fileName);
            $fileNamePath = "storage/trainer/images" . '/' . $fileName;
        }

        $admin = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "phone2" => $request->phone2,
            "address" => $request->address,
            "is_trainer" => '1',
            "password" => bcrypt("$request->password"),
            "birth_day" => $request->birth_day,
            "national_id" => $request->national_id,
            "degree" => $request->degree,
            "military_status" => $request->military_status,
            "image" => $fileNamePath,

            "personal_image" => $request->personal_image,
            "national_image" => $request->national_image,
            "birth_certificate" => $request->birth_certificate,
            "degree_certificate" => $request->degree_certificate,
            "army_certificate" => $request->army_certificate,
            "feish" => $request->feish,

        ]);

        if ($request->date_of_join != []) {

            for ($x = 0; $x < count($request->date_of_join); $x++) {
                JoinAndLeave::create([
                    'user_id' => $admin->id,
                    'date_of_join' => $request->date_of_join[$x],
                    'date_of_leave' => $request->date_of_leave[$x],
                    'reason_of_leave' => $request->reason_of_leave[$x],
                ]);
            }
        }
        if ($request->level_id) {
            for ($x = 0; $x < count($request->level_id); $x++) {
                SportsAndLevelTrainer::create([
                    'user_id' => $admin->id,
                    'sport_id' => $request->sport_id,
                    'level_id' => $request->level_id[$x],
                ]);
            }
        }


        return redirect()->route('trainer.index')->with('message', 'تم اضافه المدرب بنجاح ');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getTrainers(Request $request)
    {
        //
        $sport_request = $request->sport_id;
        $level_request = $request->level_id;
        $trainers = User::whereHas('sport_and_level_trainer', function ($query) use ($sport_request,$level_request) {

            $query->where('sport_id', $sport_request)->where('level_id',$level_request);


        })->get();

        $selected = '';
        $option = '';
        $option .= "
      <option value='' >اختر لعبة </option> ";
        foreach ($trainers as $trainer) {
            /*
            if ($request->sport_id) {
                if ($request->sport_id == $sport->id)
                    $selected = 'selected';

            }*/
            $option .= "
      <option value=$trainer->id $selected > $trainer->name </option> ";
            $selected = ' ';
        }

        return \Response::json(['data' => $option]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sports = Sports::get();

        $user = User::find($id);
        return view('Dashboard.Trainers.edit', compact('user', 'sports'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeesRequest $request, $id)
    {
//        dd($request->all());
        $admin = User::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->phone2 = $request->phone2;
        $admin->address = $request->address;
        $admin->birth_day = $request->birth_day;
        $admin->national_id = $request->national_id;
        $admin->degree = $request->degree;
        $admin->military_status = $request->military_status;

        $admin->personal_image = $request->personal_image;
        $admin->national_image = $request->national_image;
        $admin->birth_certificate = $request->birth_certificate;
        $admin->degree_certificate = $request->degree_certificate;
        $admin->army_certificate = $request->army_certificate;
        $admin->feish = $request->feish;

        $fileNamePath = "";
        if ($request->hasFile('image')) {
            File::delete($admin->image);

            $objFile = $request->image;
            $fileName = time() . $objFile->getClientOriginalName();
            $pathFile = public_path("storage/trainer/images");
            $objFile->move($pathFile, $fileName);
            $fileNamePath = "storage/trainer/images" . '/' . $fileName;
            $admin->image = $fileNamePath;

        }
        JoinAndLeave::where('user_id', $admin->id)->delete();
        if ($request->date_of_join != []) {
            for ($x = 0; $x < count($request->date_of_join); $x++) {
                if ($request->date_of_join[$x] != null) {

                    JoinAndLeave::create([
                        'user_id' => $admin->id,
                        'date_of_join' => $request->date_of_join[$x],
                        'date_of_leave' => $request->date_of_leave[$x],
                        'reason_of_leave' => $request->reason_of_leave[$x],
                    ]);
                }

            }
        }

        if ($request->level_id != []) {
            SportsAndLevelTrainer::where('user_id', $admin->id)->delete();

            for ($x = 0; $x < count($request->level_id); $x++) {
                SportsAndLevelTrainer::create([
                    'user_id' => $admin->id,
                    'sport_id' => $request->sport_id,
                    'level_id' => $request->level_id[$x],
                ]);
                SportsAndLevelTrainerArchive::create([
                    'user_id' => $admin->id,
                    'sport_id' => $request->sport_id,
                    'level_id' => $request->level_id[$x],
                ]);
            }
        }
        $admin->save();

        return redirect()->route('trainer.index')->with('message', 'تم تعديل المدرب بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $admin = User::find($id);
        $admin->delete();
        return redirect()->route('trainer.index')->with('error', 'تم حذف المدرب بنجاح ');


    }
}
