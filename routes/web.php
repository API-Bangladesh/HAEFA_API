<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
// route default start
$router->get('/', function () use ($router) {
    echo "<center> Welcome </center>";
});

$router->get('/version', function () use ($router) {
    return $router->app->version();
});
// route default end

// user route start
Route::group(['prefix' => 'api'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::get('genders', 'PatientController@genders'); //genders get
    Route::get('marital-status', 'PatientController@maritalStatus'); //marital status get
    Route::get('district', 'PatientController@district');//district get
    Route::get('self-type', 'PatientController@SelfType'); //self type get
    Route::get('union', 'PatientController@Union'); //self type get
    Route::post('patient-reg-create', 'PatientController@patientRegCreate'); //patient post
    Route::post('patient-show', 'PatientController@patientIdWiseInformation'); //patient post
    Route::put('patient-photo', 'PatientController@patientPhoto'); //patient post
    Route::get('patient-allInfo', 'PatientController@patientAllInfo'); //patient post
    Route::post('registration-code-check', 'PatientController@registrationCodeCheck');

    //patient search
    Route::post('search-patient-info', 'SearchPatientController@searchPatientAllInfo');
    // Route::get('patient-search', 'SearchPatientController@searchPatient');
    Route::post('search-patient-info-without-station', 'SearchPatientController@searchPatientAllInfoWithoutStation');

    //station 1
    Route::get('patient-blood-group', 'Station1Controller@Blood');
    Route::post('patient-height-width-create', 'Station1Controller@patientHeightWidthCreate');

    //station 2
    Route::post('patient-blood-pressure-create', 'Station2Controller@patientMDataBPCreate');

    //station 3
    Route::post('patient-glucose-hemoglobin-create', 'Station3Controller@patientGlucoseHbCreate');

    //Station 4A route start
    //Chief Complaints 
    Route::get('complaints-list-day','Station4AController@complaintsListDay'); //Complain days get
    Route::get('complaints-list','Station4AController@complaintsList'); //Matched complaints by cc code
    Route::post('patient-s4-create','Station4AController@patientS4Create'); //Save chief complain
    
    //Patient H/O Present Illness  
    Route::get('patient-ho-present-illness','Station4AController@presentIllness'); //present illness get 
    //Patient H/O Past Illness  
    Route::get('patient-ho-past-illness','Station4AController@pastIllness'); //past illness get
    // Patient H/O Family Illness
    Route::get('patient-ho-family-illness','Station4AController@familyIllness'); //get family illness
    //Social History
    Route::get('social-history','Station4AController@socialHistory'); //get family illness
    //General Examination
    //Current medication taken
    Route::get('current-medication-token','Station4AController@currentMedicationTaken'); //get current medication taken
    //Patient mental health
    Route::get('patient-mental-health','Station4AController@patientMentalHealth'); //patient mental health
    //Child Vaccination
    Route::get('child-vaccination','Station4AController@childVaccination'); //Adult vaccination
    //Adult vaccination
    Route::get('adult-vaccination','Station4AController@adultVaccination'); //Adult vaccination
    //Station 4A route end

    //Station 4B route start
    //Menstrual History
    Route::get('patient-s4b-mens-contraception','Station4BController@patientS4bMensContraception'); //get contraception method
    Route::get('patient-s4b-during-menstruation','Station4BController@patientS4bDuringMenstruation'); // get What product you use During the menstruation
    Route::get('patient-s4b-how-often','Station4BController@patientS4bHowOften');
    Route::post('patient-s4b-create','Station4BController@patientS4bCreate'); //station 4b save
    //Station 4B route end

    //Station 4C route start
    Route::get('provisional-diagonisis','Station4CController@provisionalDiagonisis'); //get provisional diagnosis
    Route::get('investigations','Station4CController@investigations'); //get investigations
    Route::get('treatment-suggestins','Station4CController@treatmentSuggestins'); //get investigations
    Route::get('frequency-hours','Station4CController@frequencyHours'); //get frequency hours
    Route::get('referral-section','Station4CController@referralSection'); //get referral section
    Route::get('health-center','Station4CController@healthCenter'); //get health center
    Route::get('advice-data','Station4CController@Advice'); //get Advice
    Route::get('special-instruction','Station4CController@specialInstruction'); //get special instruction
    Route::post('patient-s4c-create','Station4CController@patientS4cCreate'); //save 4c
    //Station 4C route end 

    //station 4D start
    Route::post('cra-non-lab-create','Station4DController@patientConRisk');

    //station 4D End

     //station 4E start
    Route::get('get-prescription-id','Station4EController@getPrescriptionCreation');
    Route::post('cra-lab-create','Station4EController@patientConRisk');

     //station 4E End
    //Prescription Preview start

    Route::post('prescription-preview','PrescriptionPreviewController@patientPrescriptionPreview');
    Route::get('prescription-preview-all-data','PrescriptionPreviewController@patientPrescriptionPreviewAllData');

    //Prescription Preview End

     //Prescription Preview start

     Route::post('prescription','PrescriptionController@prescription');

     //Prescription Preview End


    
});

Route::group(['middleware' => 'auth'], function ($router) {
    Route::group(['prefix' => 'api'], function ($router) {
        //user logout
        Route::post('logout', 'AuthController@logout');
        //user refresh
        Route::post('refresh', 'AuthController@refresh');
        //user profile
        Route::post('user-profile', 'AuthController@me');
        //post router start
        Route::get('post-data', 'PostController@index'); //post get
        Route::post('post/create', 'PostController@store'); //post create
        Route::put('post/edit/{id}', 'PostController@edit'); //post edit
        Route::patch('post/update/{id}', 'PostController@update'); //post update
        Route::delete('post/delete/{id}', 'PostController@destroy'); //post delete
        //post route end
        //patient route start
        // Route::get('patient-ref-data', 'PatientController@index'); //patient get
        Route::post('patient/create', 'PatientController@store'); //patient create
        //patient route end
    });
});


