<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Model\Enrollee;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;

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
        /**
         * @var Enrollee $existEnrollee
         */
        $existEnrollee = Enrollee::where('cookie', $request->cookie('userID'))->first();
        $registerEnrollee = $existEnrollee ? $existEnrollee->attributesToArray() : [
            'name' => '',
            'second_name' => '',
            'sex' => '',
            'group' => '',
            'email' => '',
            'points' => '',
            'dob' => '',
            'location' => '',
            'cookie' => '',
        ];
        $enrolleeID = $existEnrollee ? $existEnrollee->id : '';

        if ($registerEnrollee['dob']) {
            $date = new \DateTime($registerEnrollee['dob']);
            $registerEnrollee['dob'] = $date->format('d-m-Y');
        }

        if (!$request->isMethod('post')) {
            return view('section.registration', ['errors' => $errors, 'registerEnrollee' => $registerEnrollee]);
        }

        try {
            $this->validate($request, [
                'name' => 'required|between:2,20|string',
                'second_name' => 'required|between:2,20|string',
                'sex' => 'required',
                'group' => 'required|between:2,5|string',
                'email' => 'required|between:5,20|email|unique:enrollees,email,' . $enrolleeID,
                'points' => 'required|numeric|min:400|max:800',
                'dob' => 'required',
                'location' => 'required'
            ], ['required' => ':attribute является обязательным полем',
                'unique' => 'Такой :attribute уже существует',
                'numeric' => 'В поле :attribute должно быть число',
                'between' => 'Поле :attribute должно содержать от :min до :max символов',
                'min' => ':attribute не может быть меньше :min',
                'max' => ':attribute не может быть больше :max'
            ], ['name' => 'Имя',
                'second_name' => 'Фамилия',
                'sex' => 'Пол',
                'group' => 'Номер группы',
                'email' => 'email',
                'points' => 'Сумма баллов на ВНО',
                'dob' => 'Дата рождения',
                'location' => 'Проживание'
            ]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            $registerEnrollee = array_merge($registerEnrollee, $request->post());
            return view('section.registration', ['errors' => $errors, 'registerEnrollee' => $registerEnrollee]);
        }

        if (!$existEnrollee) {
            $userData = $request->ip() . $request->header('User-Agent') . serialize($request->post());
            $hash = md5($userData);

            $enrollee = new Enrollee();

            $enrollee->name = $request->input('name');
            $enrollee->second_name = $request->input('second_name');
            $enrollee->sex = $request->input('sex');
            $enrollee->group = $request->input('group');
            $enrollee->email = $request->input('email');
            $enrollee->points = $request->input('points');
            $enrollee->dob = $request->input('dob');
            $enrollee->location = $request->input('location');
            $enrollee->cookie = $hash;
            $enrollee->save();

            $date = new \DateTime();
            $cookie = new Cookie('userID', $hash, $date->modify('+10 year'));
            return response(view('section.registration', ['errors' => $errors, 'registerEnrollee' => $enrollee->attributesToArray()]))->withCookie($cookie);
        } else {
            $existEnrollee->update([
                'name' => $request->input('name'),
                'second_name' => $request->input('second_name'),
                'sex' => $request->input('sex'),
                'group' => $request->input('group'),
                'email' => $request->input('email'),
                'points' => $request->input('points'),
                'dob' => $request->input('dob'),
                'location' => $request->input('location'),
            ]);

            return view('section.registration', ['errors' => $errors, 'registerEnrollee' => $existEnrollee->attributesToArray()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $enrollees = Enrollee::where('points', 'LIKE', '%' . $request->input('query') . '%')
            ->orWhere('group', 'LIKE', '%' . $request->input('query') . '%')
            ->orWhere('second_name', 'LIKE', '%' . $request->input('query') . '%')
            ->orWhere('name', 'LIKE', '%' . $request->input('query') . '%')
            ->paginate(50);

        return view('section.list', ['enrollees' => $enrollees, 'searchQuery' => $request->input('query')]);
    }
}
