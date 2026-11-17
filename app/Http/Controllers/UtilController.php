<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilController extends Controller
{
    public function loadWelcome()
    {
        return view('welcome');
    }

    public function fallback()
    {
        return view('utils.fallback');
    }

    public function loadHomepage()
    {
        //dados que no futuro estarão definidos no controller e vêm da base de dados
        $courseName = 'SD';

        //simulo que vou à base de dados e trago a lista de alunos
        $students = ['Licínia', 'Raquel', 'João', 'Leonel'];

        //array associativo
        //dados que serão carregados da base de dados
        $contactInfo = [
            'name' => 'Bruno',
            'contact' => 'Bruno@cesae.pt'
        ];

        // var_dump($contactInfo);
        // dd($contactInfo);

        $cesaeInfo = [
            'name'=> 'Cesae',
            'address' => 'Rua do cesae',
            'email' =>'cesae@cesae.pt'];

        return view('home', compact('courseName','students', 'contactInfo', 'cesaeInfo'));
    }
}
