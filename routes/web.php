<?php

use App\Http\Controllers\ArchivedConceptController;
use App\Http\Controllers\ConceptController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\GeneratedQuestionController;
use App\Http\Controllers\MyDomainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::get('/test-groq', function () {
    $service = new App\Services\GroqService();
    try {
        $result = $service->generateInterviewQuestions('Test', 'Test explanation');
        return response()->json($result);
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
})->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/all-domains', [DomainController::class, 'index'])->name('all-domains');
    Route::get('/mes-domaines', [MyDomainController::class, 'index'])->name('mes-domaines');
    Route::get('/archived', [ArchivedConceptController::class, 'index'])->name('concepts.archived');
    Route::post('/archived/{concept}/restore', [ArchivedConceptController::class, 'restore'])->name('concepts.restore');
    Route::delete('/archived/{concept}/force', [ArchivedConceptController::class, 'forceDelete'])->name('concepts.forceDelete');

    Route::resource('domains', DomainController::class)->except(['index']);
    Route::resource('domains.concepts', ConceptController::class);
    Route::patch('concepts/{concept}/status', [ConceptController::class, 'updateStatus'])->name('concepts.updateStatus');
    Route::post('domains/{domain}/concepts/{concept}/questions', [GeneratedQuestionController::class, 'store'])->name('questions.store');
    Route::delete('questions/{generatedQuestion}', [GeneratedQuestionController::class, 'destroy'])->name('questions.destroy');
    Route::post('questions/{generatedQuestion}/restore', [GeneratedQuestionController::class, 'restore'])->name('questions.restore');
    Route::delete('questions/{generatedQuestion}/force', [GeneratedQuestionController::class, 'forceDelete'])->name('questions.forceDelete');
    Route::get('questions/history', [GeneratedQuestionController::class, 'history'])->name('questions.history');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';