<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DeadlineThemeController,
    HemisController,
    ReportController,
    TestAuthController,
    ThemeController,
    ProcessController,
    MudirController,
    StatisticController,
    ChatController,
    MixController,
    SifatController,
    TypeController};


Route::get('oauth-login-student',[\App\Http\Controllers\OAuth2Controller::class,'loginStudent'])->name('oauth-login-student');
Route::get('oauth-login-teacher',[\App\Http\Controllers\OAuth2Controller::class,'loginTeacher'])->name('oauth-login-teacher');
Route::get('login',[\App\Http\Controllers\OAuth2Controller::class,'login'])->name('login-page');

Route::get('callback/student',[\App\Http\Controllers\OAuth2Controller::class,'callStudent'])->name('call-student');
Route::get('callback/teacher',[\App\Http\Controllers\OAuth2Controller::class,'callTeacher'])->name('call-teacher');

//Route::resource('kafedras', KafedraController::class);

Route::prefix('test')->group(function (){
    Route::get('student', [TestAuthController::class, 'student']);
    Route::get('employee', [TestAuthController::class, 'employee']);
});

Route::middleware('auth')->group(function (){
    Route::get('/', [MixController::class, 'firstPage'])->name('first-page');
//    Route::get('login', [HemisController::class, 'login'])->name('login-student');
    Route::post('login-student-user', [HemisController::class, 'loginUser'])->name('login-student-user');
    Route::get('logout-student', [HemisController::class, 'logout'])->name('logout-student');
});

Route::middleware('hemis')->group(function () {
//    TODO: rollarni almashtirish.
    Route::get('insertRole', [MixController::class, 'insertRole'])->name('insertRole');
    Route::get('insertDepartment', [MixController::class, 'insertDepartment'])->name('insertDepartment');
//    TODO: Process files download
    Route::get('/process/{id}/download', [ProcessController::class, 'download'])->name('process.download');
    Route::middleware('without_mudir')->group(function (){
        Route::get('student-profile', [HemisController::class, 'profile'])->name('student-profile');
        Route::get('student-themes/{status}', [ThemeController::class, 'themes'])->name('student-themes');
        Route::get('get-theme/{id}', [ThemeController::class, 'getTheme'])->name('get-theme');
        Route::get('cancel-theme/{id}', [ThemeController::class, 'cancelTheme'])->name('cancel-theme');
        Route::get('cancel-confirm/{id}', [ThemeController::class, 'cancelConfirmTheme'])->name('cancel-confirm');
        Route::get('process', [ProcessController::class, 'student_index'])->name('process');
        Route::post('update-process', [ProcessController::class, 'update'])->name('update-process');
        Route::get('show-process/{id}', [ProcessController::class, 'showProcess'])->name('show-process');
        Route::post('send-message', [ChatController::class, 'create'])->name('send-message');
        Route::get('chat-student/{theme_id}',[ChatController::class, 'showChatForStudent'])->name('chat-student');
        Route::get('examples',[MixController::class, 'examples'])->name('examples');
    });

    Route::middleware('mudir')->group(function(){
        Route::resource('types', TypeController::class);
        Route::get('mudir-themes/{status}', [MudirController::class, 'themes'])->name('mudir-themes');
        Route::put("theme_update_for_department/{id}", [ThemeController::class, "theme_update_for_department"])->name("theme_update_for_department");
        Route::delete("theme_delete_for_department/{id}", [ThemeController::class, "theme_delete_for_department"])->name("theme_delete_for_department");
        Route::get('statistics-teacher', [StatisticController::class, 'teachers'])->name('statistics-teacher');
        Route::get('statistics-student', [StatisticController::class, 'students'])->name('statistics-student');
    });

    Route::middleware('teacher')->group(function(){
        Route::resource('themes', ThemeController::class);
        Route::get('chat/{id}', [ChatController::class, 'show'])->name('chat');
    });

    Route::middleware('sifat_bolimi')->group(function (){
        Route::resource('deadline_themes', DeadlineThemeController::class);
        Route::get('report/bmi', [ReportController::class, 'index'])->name('report.index');
        Route::get('sifat-bolimi/statistika',[SifatController::class,'statisticsAll'])->name('sifat-bolimi-statistika');
        Route::get('sifat-bolimi/statistika/print',[SifatController::class,'generateFile'])->name('sifat-bolimi-print');
    });


    Route::middleware('auth')->group(function (){
        Route::get('profile',[MixController::class,'profile'])->name('profile');
        Route::post('update-profile/{user}',[MixController::class,'updateProfile'])->name('update-profile');
        Route::post('update-password/{user}',[MixController::class,'updatePassword'])->name('update-password');
    });
});
//require_once __DIR__ . '/auth.php';


