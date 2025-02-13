zEnith is an e-learning web application designed to give fun and easy-to-understand learning experiences.

Tech stacks used:
- Laravel
- Blade
- MySQL
- Pest

RoleCheckMiddleware usage:
Route::middleware('auth', 'role:student')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
