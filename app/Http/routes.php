<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function() {
    return redirect('activity');
});

Route::group(['middleware' => ['web']], function() {
    Route::get('/login', ['uses' => 'AuthController@getLogin', 'as' => 'login']);
    Route::get('/logout', ['uses' => 'AuthController@getLogout', 'as' => 'logout']);
    Route::post('/login', ['uses' => 'AuthController@postLogin']);

    Route::group(['middleware' => ['auth','roles']], function() {

        Route::group(['roles'=> [ '0' , '2' ] ], function(){
            Route::resource('activity', 'ActivityController',
                ['except'=> ['index','detail'] ] );
            Route::resource('issue', 'IssueController',
                ['except'=>['index','detail'] ] );
            Route::resource('presence', 'PresenceController',
                ['except'=>['index','detail'] ] );
            Route::resource('schedule', 'ScheduleController');
            Route::resource('schedule', 'ScheduleController', ['except'=> 'index']);

//          unused routes?
            Route::resource('privilege', 'PrivilegeController');
        });

        Route::group(['roles' => [0,1,2,3] ], function(){
            Route::get('/questionnaire/{quetionnaire}/answer', ['uses' => 'QuestionnaireController@viewQuestionnaire', 'as' => 'questionnaire.answer.view']);
            Route::post('/questionnaire/{quetionnaire}/answer', ['uses' => 'QuestionnaireController@answerQuestionnaire', 'as' => 'questionnaire.answer']);

            Route::resource('class', 'ClassController' , ['only' => 'index']);
            Route::resource('schedule', 'ScheduleController', ['only'=> 'index']);

            Route::resource('questionnaire', 'QuestionnaireController', ['only' => 'index']);

            Route::get('/role/switch/{role}', 'AuthController@change');
        });

        Route::group(['roles' => [0,1,2] ], function(){
            Route::post('/question/{question}/option', ['uses' => 'QuestionController@addOption', 'as' => 'question.option.add']);
            Route::delete('/question/{question}/option', ['uses' => 'QuestionController@deleteOption', 'as' => 'question.option.destroy']);

            Route::get('/questionnaire/{questionnaire}/question', ['uses' => 'QuestionnaireController@viewQuestionnaire', 'as' => 'questionnaire.question.view']);
            Route::post('/questionnaire/{questionnaire}/question', ['uses' => 'QuestionnaireController@addQuestion', 'as' => 'questionnaire.question.add']);
            Route::delete('/questionnaire/{questionnaire}/question/{question}/', ['uses' => 'QuestionnaireController@deleteQuestion', 'as' => 'questionnaire.question.destroy']);

            Route::get('/questionnaire/{questionnaire}/result', ['uses' => 'QuestionnaireController@viewQuestionnaireResult', 'as' => 'questionnaire.result']);

            Route::resource('activity', 'ActivityController', ['only'=>['index','detail']]);
            Route::resource('issue', 'IssueController', ['only'=>['index','detail']]);
            Route::resource('presence', 'PresenceController', ['only'=>['index','detail']]);
            Route::resource('class', 'ClassController' , ['except' => 'index']);
            Route::resource('question', 'QuestionController');
            Route::resource('questionnaire', 'QuestionnaireController', ['except' => 'index']);
            Route::resource('schedule', 'ScheduleController');
            Route::resource('assistant', 'AssistantController');
            Route::resource('teacher', 'TeacherController');
            Route::resource('student', 'StudentController');
            Route::resource('subject', 'SubjectController');
        });

        Route::group(['roles'=>[0]], function(){
//            user account management
            Route::get('/class/{class}/student', ['uses' => 'ClassController@viewStudents', 'as' => 'class.student.view']);
            Route::post('/class/{class}/student', ['uses' => 'ClassController@addStudents', 'as' => 'class.student.add']);
            Route::delete('/class/{class}/student/{student}/', ['uses' => 'ClassController@deleteStudents', 'as' => 'class.student.destroy']);

            Route::get('/class/{class}/assistant', ['uses' => 'ClassController@viewAssistants', 'as' => 'class.assistant.view']);
            Route::post('/class/{class}/assistant', ['uses' => 'ClassController@addAssistants', 'as' => 'class.assistant.add']);
            Route::delete('/class/{class}/assistant/{assistant}/', ['uses' => 'ClassController@deleteAssistants', 'as' => 'class.assistant.destroy']);

            Route::get('/class/{class}/teacher', ['uses' => 'ClassController@viewTeachers', 'as' => 'class.teacher.view']);
            Route::post('/class/{class}/teacher', ['uses' => 'ClassController@addTeachers', 'as' => 'class.teacher.add']);
            Route::delete('/class/{class}/teacher/{teacher}/', ['uses' => 'ClassController@deleteTeachers', 'as' => 'class.teacher.destroy']);

            Route::resource('user', 'UserController');
            Route::get('role','RoleController@index');

        });


        Route::group(['roles'=> [0,3]], function(){
            Route::resource('mark','MarkController', ['only'=>'index']);
        });

        Route::group(['roles'=> [0,1,2]], function(){
            Route::resource('mark','MarkController');
        });
    });
});