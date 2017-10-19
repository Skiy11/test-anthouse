<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Model\Enrollee;

class IndexController extends Controller
{
    public function getEnrolleesList()
    {
        $enrollees = Enrollee::orderBy('points', 'desc')->paginate(50);
        return view('section.list', ['enrollees' => $enrollees]);
    }

    public function registration(Request $request)
    {
        $errors = [];
        if ($request->isMethod('post')) {
            try {
                $this->validate($request, [
                    'name'       => 'required|between:2,20|string',
                    'secondName' => 'required|between:2,20|string',
                    'sex'        => 'required',
                    'group'      => 'required|between:2,5|string',
                    'email'      => 'required|unique:enrollees,email|between:5,20|email',
                    'points'     => 'required|numeric|min:400|max:800',
                    'dob'        => 'required',
                    'location'   => 'required'
                ], ['required'   => ':attribute является обязательным полем',
                    'unique'     => 'Такой :attribute уже существует',
                    'numeric'    => 'В поле :attribute должно быть число',
                    'between'    => 'Поле :attribute должно содержать от :min до :max символов',
                    'min'        => ':attribute не может быть меньше :min',
                    'max'        => ':attribute не может быть больше :max'
                ], ['name'       => 'Имя',
                    'secondName' => 'Фамилия',
                    'sex'        => 'Пол',
                    'group'      => 'Номер группы',
                    'email'      => 'email',
                    'points'     => 'Сумма баллов на ВНО',
                    'dob'        => 'Дата рождения',
                    'location'   => 'Проживание'
                ]);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

            }
        }

        $enrollee = new Enrollee();

        $enrollee->name = $request->input('name');
        $enrollee->second_name = $request->input('secondName');
        $enrollee->sex = $request->input('sex');
        $enrollee->group = $request->input('group');
        $enrollee->email = $request->input('email');
        $enrollee->points = $request->input('points');
        $enrollee->dob = $request->input('dob');
        $enrollee->location = $request->input('location');
        $enrollee->save();

        return view('section.registration', ['errors' => $errors]);
    }
}
