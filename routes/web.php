<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TechStackController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\SkillCategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/projects', [App\Http\Controllers\HomeController::class, 'projects'])->name('frontend.projects.index');
Route::get('/projects/{project}', [App\Http\Controllers\HomeController::class, 'showProject'])->name('project.show');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/admin', function () {
    $contact = App\Models\Contact::first();
    $messageCount = App\Models\ContactMessage::count();
    $categories = App\Models\SkillCategory::all();
    return view('admin.index', compact('contact', 'messageCount', 'categories'));
})->middleware(['auth', 'verified'])->name('admin.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes for portfolio management
    Route::resource('admin/heros', HeroController::class);
    Route::resource('admin/key-metrics', App\Http\Controllers\Admin\KeyMetricController::class);
    Route::resource('admin/abouts', AboutController::class);
    Route::resource('admin/educations', EducationController::class)->names('admin.educations');
    Route::resource('admin/projects', ProjectController::class);
    Route::resource('admin/skills', SkillController::class);
    Route::resource('admin/skill-categories', SkillCategoryController::class);
    Route::resource('admin/tech-stacks', TechStackController::class);
    Route::resource('admin/experiences', ExperienceController::class);
    Route::post('/admin/contacts/update', [AdminContactController::class, 'update'])->name('admin.contacts.update');
    Route::resource('admin/certificates', CertificateController::class);
    Route::resource('admin/messages', App\Http\Controllers\Admin\ContactMessageController::class);
});

// Temporary test route without auth for debugging
Route::patch('/test-hero-update/{id}', [HeroController::class, 'update'])->name('test.hero.update');

require __DIR__.'/auth.php';
