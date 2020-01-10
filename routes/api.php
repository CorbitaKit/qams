<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->group(function(){

	/*=============================================
	=            LDAP Route                      =
	=============================================*/

	Route::get('search-ldap-user/{key}','LDAPController');

	/*=============================================
	=            End LDAP Route                   =
	=============================================*/



	/*=============================================
	=            Role Route                      =
	=============================================*/

	Route::get('/get-roles','RoleController');



	/*=============================================
	=            End Role Route                   =
	=============================================*/


	/*=============================================
	=            Employee Route                   =
	=============================================*/

	Route::post('/submit-employee-data',"EmployeeController@create");

	Route::get('/get-employees',"EmployeeController@getEmployees");

	Route::get('/get-employee/{id}',"EmployeeController@getEmployee");

	Route::get('/get-employee-loggedin/{id}',"EmployeeController@getEmployeeLoggedIn");

	Route::get('/get-employee-accounts/{id}',"EmployeeController@getEmployeeAccounts");

	Route::post('/update-employee-data/{id}',"EmployeeController@update");

	Route::delete('/delete-employee/{id}',"EmployeeController@destroy");

	Route::get('/check-if-added/{email}',"EmployeeController@checkEmployeeIfAdded");

	/*=============================================
	=            End Employee Route               =
	=============================================*/


	/*=============================================
	=            Category Route                   =
	=============================================*/

	Route::get('/get-categories',"CategoryController@get");

	Route::post('/submit-category',"CategoryController@create");

	Route::delete('/delete-category/{id}',"CategoryController@destroy");

	Route::post('/update-category/{id}','CategoryController@update');

	Route::get('/get-category/{id}','CategoryController@getCategory');

	Route::get('/get-categories-by-account-type/{account_type}','CategoryController@getCategoriesByAccountType');
	/*=============================================
	=            End Category Route               =
	=============================================*/


	/*=============================================
	=            Parameter Route                  =
	=============================================*/

	Route::get('/get-parameters',"ParameterController@get");

	Route::post('/submit-parameter',"ParameterController@create");

	Route::delete('/delete-parameter/{id}',"ParameterController@destroy");

	Route::post('/update-parameter/{id}','ParameterController@update');

	Route::get('/get-parameter-by-category-and-account-type/{category_id}/{account_type_id}','ParameterController@getParameterByCategoryAndAccountType');

	/*=============================================
	=            End Parameter Route              =
	=============================================*/


	/*=============================================
	=            Account type Route               =
	=============================================*/

	Route::get('/get-account-types','AccountTypeController@get');

	Route::get('/get-account-type/{id}','AccountTypeController@getAccountType');

	Route::post('/create-account-type','AccountTypeController@create');

	Route::post('/update-account-type/{id}','AccountTypeController@update');

	Route::delete('/delete-account-type/{id}','AccountTypeController@destroy');
	/*=============================================
	=            End Account Type Route           =
	=============================================*/


	/*=============================================
	=            Account Route                    =
	=============================================*/


	Route::get('/get-accounts','AccountController@get');

	Route::get('/get-account/{id}','AccountController@getAccount');

	Route::get('/get-custom-account/{id}','AccountController@getCustomAccount');
	
	/*=============================================
	=           End Account Route                =
	=============================================*/



	/*=============================================
	=            Scorecard Route                  =
	=============================================*/


	Route::post('/create-scorecard','ScoreCardController@create');

	Route::get('/get-scorecard-name/{account_id}/{account_type_id}','ScoreCardController@getName');

	Route::get('/get-scorecards','ScoreCardController@get');

	Route::get('/get-scorecard/{id}','ScoreCardController@getScorecard');
	Route::get('/set-scorecard-status/{id}/{status}','ScoreCardController@setScorecardStatus');

	Route::delete('/delete-scorecard/{id}','ScoreCardController@destroy');

	Route::post('/update-scorecard','ScoreCardController@update');

	/*=============================================
	=            End Scorecard Route              =
	=============================================*/



	/*=============================================
	=            Scorecard body Route             =
	=============================================*/

	Route::get('/get-scorecard-body/{id}','ScorecardBodyController@getScorecardBody');
	Route::get('/get-scorecard-body-parameters/{cat_id}/{scorecard_id}','ScorecardBodyController@getScorecardBodyParameter');





	/*=============================================
	=           End Scorecard body Route          =
	=============================================*/




	/*=============================================
	=            ZTP Route                        =
	=============================================*/


	Route::get('/get-ztps','ZTPController@get');

	Route::post('/submit-ztp-data','ZTPController@create');

	Route::delete('/delete-ztp/{ztp_id}','ZTPController@destroy');

	/*=============================================
	=            End ZTP Route                    =
	=============================================*/
});

