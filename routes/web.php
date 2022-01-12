<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('guest-page.landing-page');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Dashboard
Route::prefix('/dashboard')->group(function(){
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});
//Position
Route::prefix('/position')->group(function(){
    Route::get('/', [App\Http\Controllers\PositionController::class, 'index'])->name('position.index');
    Route::post('/add', [App\Http\Controllers\PositionController::class, 'store'])->name('position.store');
    Route::put('/update/{id}', [App\Http\Controllers\PositionController::class, 'update'])->name('position.update');
    Route::delete('/delete/{id}', [App\Http\Controllers\PositionController::class, 'destroy'])->name('position.destroy');

    //Set Background Qualification for Position
    Route::get('/{id}', [App\Http\Controllers\SetQualificationController::class, 'index'])->name('setQualifcation.index');
    Route::post('/set-background/{id}', [App\Http\Controllers\SetQualificationController::class, 'store'])->name('setQualifcation.store');
    //Set Skills Qualification for Position
    Route::get('/set-skills/{id}', [App\Http\Controllers\SetSkillsController::class, 'index'])->name('setSkills.index');
    Route::post('/add-skills/{id}', [App\Http\Controllers\SetSkillsController::class, 'store'])->name('setSkills.store');


    //Qualification Show
    Route::get('/show-background/{id}', [App\Http\Controllers\SetQualificationController::class, 'show'])->name('setQualifcation.show');
    Route::get('/show-skills/{id}', [App\Http\Controllers\SetSkillsController::class, 'show'])->name('setSkills.show');
});

//Qualification
Route::prefix('/qualification')->group(function(){
    Route::get('/', [App\Http\Controllers\QualificationController::class, 'index'])->name('qualification.index');
    Route::post('/add', [App\Http\Controllers\QualificationController::class, 'store'])->name('qualification.store');
    Route::get('/edit/{id}', [App\Http\Controllers\QualificationController::class, 'edit'])->name('qualification.edit');
    Route::put('/update/{id}', [App\Http\Controllers\QualificationController::class, 'update'])->name('qualification.update');
    Route::delete('/delete/{id}', [App\Http\Controllers\QualificationController::class, 'destroy'])->name('qualification.destroy');
});

//Skills
Route::prefix('/skills')->group(function(){
    Route::get('/', [App\Http\Controllers\SkillController::class, 'index'])->name('skill.index');
    Route::post('/add', [App\Http\Controllers\SkillController::class, 'store'])->name('skill.store');
    Route::put('/update/{id}', [App\Http\Controllers\SkillController::class, 'update'])->name('skill.update');
    Route::delete('/delete/{id}', [App\Http\Controllers\SkillController::class, 'destroy'])->name('skill.delete');
    Route::get('/show/{id}', [App\Http\Controllers\SkillController::class, 'show'])->name('skill.show');

    //Set Questions
    Route::post('/add/question', [App\Http\Controllers\AddQuestionController::class, 'store'])->name('seQuestion.store');
    Route::get('/edit/question/{id}', [App\Http\Controllers\AddQuestionController::class, 'edit'])->name('seQuestion.edit');
    Route::put('/update/question/{id}', [App\Http\Controllers\AddQuestionController::class, 'update'])->name('seQuestion.update');
    Route::delete('/delete/question/{id}', [App\Http\Controllers\AddQuestionController::class, 'destroy'])->name('seQuestion.destroy');
});

//Interview
Route::prefix('/interview')->group(function(){
    Route::get('/',  [App\Http\Controllers\InterviewController::class, 'index'])->name('interview.index');
    Route::post('/add',  [App\Http\Controllers\InterviewController::class, 'store'])->name('interview.store');
    Route::put('/update/{id}',  [App\Http\Controllers\InterviewController::class, 'update'])->name('interview.update');
    Route::delete('/delete/{id}',  [App\Http\Controllers\InterviewController::class, 'destroy'])->name('interview.delete');

    //Set Interview Schedule
    Route::get('/schedule/{id}',  [App\Http\Controllers\SetScheduleController::class, 'show'])->name('setSchedule.show');
    Route::get('/set-schedule/{id}',  [App\Http\Controllers\SetScheduleController::class, 'create'])->name('setSchedule.create');
});

//Registration
Route::prefix('/registration')->group(function(){
    Route::get('/', [App\Http\Controllers\RegistrationController::class, 'index'])->name('register.index');
    Route::post('/store', [App\Http\Controllers\RegistrationController::class, 'store'])->name('register.store');
    Route::get('/show-positions/{id}', [App\Http\Controllers\RegistrationController::class, 'showPositions'])->name('register.show-positions');
    Route::put('/select-position/{id}', [App\Http\Controllers\RegistrationController::class, 'selectPosition'])->name('register.select-position');
});

//Applicant Qualification
Route::get('/add-qualification/{id}/{reg_id}', [App\Http\Controllers\ApplicantQualification::class, 'index'])->name('applicant.qualification');
Route::get('/send-qualification/{id}/{reg_id}', [App\Http\Controllers\ApplicantQualification::class, 'store'])->name('applicant.qualification.result');

//Applicant Exams
Route::get('/skills-test/{id}/{reg_id}', [App\Http\Controllers\SkillsTest::class, 'index'])->name('applicant.skillstest');
Route::post('/skills-test/store/{id}/{reg_id}', [App\Http\Controllers\SkillsTest::class, 'store'])->name('applicant.skillstest.store');

//Schedule


