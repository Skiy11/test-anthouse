<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Model\Enrollee;

class IndexController extends Controller
{
    /**
     * Get list enrollees in view
     *
     * @return \Illuminate\View\View
     */
    public function getEnrolleesList()
    {
        $enrollees = Enrollee::orderBy('points', 'desc')->paginate(50);
        return view('section.list', ['enrollees' => $enrollees]);
    }

    /**
     * Sorting table with enrollees
     *
     * @param string $field
     * @param string $sort
     * @return \Illuminate\View\View
     */
    public function getEnrolleesSortingList($field, $sort)
    {
        $sortFields = ['name', 'second_name', 'points', 'group'];
        $sortOrders = ['asc', 'desc'];

        if (array_search($sort, $sortOrders) !== false && array_search($field, $sortFields) !== false) {
            $enrollees = Enrollee::orderBy($field, $sort)->paginate(50);
            $getSort = $sort == 'desc' ? 'asc' : 'desc';
            return view('section.list', ['enrollees' => $enrollees, 'getSort' => $getSort]);
        }
    }

    /**
     * Registrate new enrollee
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $enrollees = Enrollee::where('points', 'LIKE', '%' . $request->input('search') . '%')
            ->orWhere('group', 'LIKE', '%' . $request->input('search') . '%')
            ->orWhere('second_name', 'LIKE', '%' . $request->input('search') . '%')
            ->orWhere('name', 'LIKE', '%' . $request->input('search') . '%')
            ->paginate(50);

        return view('section.list', ['enrollees' => $enrollees, 'searchQuery' => $request->input('search')]);
    }
}
