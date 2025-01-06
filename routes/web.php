<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\ActivityLogs\ListLog;
use App\Livewire\ActivityLogs\ShowLog;
use App\Livewire\Categories\CreateCategory;
use App\Livewire\Categories\EditCategory;
use App\Livewire\Categories\ListCategory;
use App\Livewire\Stock\CreateStock;
use App\Livewire\Stock\EditStock;
use App\Livewire\Stock\ListStock;
use App\Livewire\Stock\ShowStock;
use App\Livewire\StockPhone\CreatePhone;
use App\Livewire\StockPhone\EditPhone;
use App\Livewire\StockPhone\ListPhone;
use App\Livewire\StockPhone\ShowPhone;
use App\Livewire\Departement\ListDepartement;
use App\Livewire\Departement\CreateDepartement;
use App\Livewire\Departement\EditDepartement;
use App\Livewire\Societes\CreateSociete;
use App\Livewire\Societes\EditSociete;
use App\Livewire\Societes\ListSociete;
use App\Livewire\CategoryStock\ListCategorystock;
use App\Livewire\CategoryStock\EditCategorystock;
use App\Livewire\CategoryStock\CreateCategorystock;
use App\Livewire\DashboardHome;
use App\Livewire\Labels\CreateLabel;
use App\Livewire\Labels\EditLabel;
use App\Livewire\Labels\ListLabel;
use App\Livewire\Tickets\CreateTicket;
use App\Livewire\Tickets\EditTicket;
use App\Livewire\Tickets\ListTicket;
use App\Livewire\Tickets\ShowTicket;
use App\Livewire\Users\CreateUser;
use App\Livewire\Users\EditUser;
use App\Livewire\Users\ListUser;
use App\Livewire\Archive\ArchiveList;
use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Stock;
use App\Models\Phone;
use App\Models\Societe;
use App\Models\Departement;
use App\Models\CategoryStock;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('home');




Route::get('/stock/{id}/pdf', [ShowStock::class, 'generatePdf'])->name('stock.generate-pdf');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardHome::class)->name('dashboard');

    Route::middleware('can:manage,' . Category::class)
        ->prefix('categories')
        ->as('categories.')
        ->group(function () {
            Route::get('/', ListCategory::class)->name('index');
            Route::get('/create', CreateCategory::class)->name('create');
            Route::get('/{category}/edit', EditCategory::class)->name('edit');
        });
    // Route::middleware('can:manage,' . Stock::class)
    //     ->prefix('stock')
    //     ->as('stock.')
    //     ->group(function () {
    //         Route::get('/', ListStock::class)->name('index');
    //         Route::get('/create', CreateStock::class)->name('create');
    //         Route::get('/{stock}/edit', EditStock::class)->name('edit');
    //         Route::get('/{stock}/show', ShowStock::class)->name('show');
    //         Route::get('/{stock}/generate-barcode', [ShowStock::class, 'generateBarcode'])->name('generate-barcode');
    //     });
    Route::middleware('can:manage,' . Stock::class)
    ->prefix('stock')
    ->as('stock.')
    ->group(function () {
        Route::get('/', ListStock::class)->name('index');
        Route::get('/create', CreateStock::class)->name('create');
        Route::get('/{stock}/edit', EditStock::class)->name('edit');
        Route::get('/{stock}/show', ShowStock::class)->name('show');
        Route::get('/{stock}/generate-barcode', [ShowStock::class, 'generateQrCode'])->name('generate-barcode');
        Route::get('/stock/{id}/generate-word', [ListStock::class, 'generateWordDocument'])->name('generateWord');
        Route::post('/stocks/{id}/archive', [StockController::class, 'archiveStock'])->name('archive');
        Route::get('/archive', [ListStock::class, 'archivedStock'])->name('archived');

    });

    Route::middleware('can:manage,' . Stock::class)
    ->prefix('archive')
    ->as('archive.')
    ->group(function () {
        Route::get('/', ArchiveList::class)->name('index');
    });    
    
    Route::middleware('can:manage,' . Stock::class)
    ->prefix('phone')
    ->as('phone.')
    ->group(function () {
        Route::get('/', ListPhone::class)->name('index');
        Route::get('/create', CreatePhone::class)->name('create');
        Route::get('/{phone}/edit', EditPhone::class)->name('edit');
        Route::get('/{phone}/show', ShowPhone::class)->name('show');
        Route::get('/{phone}/generate-barcode', [ShowPhone::class, 'generateQrCode'])->name('generate-barcode');
        Route::get('/phone/{id}/generate-word', [ListPhone::class, 'generateWordDocument'])->name('generateWord');
    });    
    Route::middleware('can:manage,' . Stock::class)
        ->prefix('departement')
        ->as('departement.')
        ->group(function () {
            Route::get('/', ListDepartement::class)->name('index');
            Route::get('/create', CreateDepartement::class)->name('create');
            Route::get('/{departement}/edit', EditDepartement::class)->name('edit');
        });
    Route::middleware('can:manage,' . Stock::class)
        ->prefix('category_stock')
        ->as('category_stock.')
        ->group(function () {
            Route::get('/', ListCategorystock::class)->name('index');
            Route::get('/create', CreateCategorystock::class)->name('create');
            Route::get('/{categorystock}/edit', EditCategorystock::class)->name('edit');
        });
    Route::middleware('can:manage,' . Societe::class)
        ->prefix('societe')
        ->as('societe.')
        ->group(function () {
            Route::get('/', ListSociete::class)->name('index');
            Route::get('/create', CreateSociete::class)->name('create');
            Route::get('/{societe}/edit', EditSociete::class)->name('edit');
        });

    Route::middleware('can:manage,' . Label::class)
        ->prefix('labels')
        ->as('labels.')
        ->group(function () {
            Route::get('/', ListLabel::class)->name('index');
            Route::get('/create', CreateLabel::class)->name('create');
            Route::get('/{label}/edit', EditLabel::class)->name('edit');
        });

    Route::middleware('can:manage,' . User::class)
        ->prefix('users')
        ->as('users.')
        ->group(function () {
            Route::get('/', ListUser::class)->name('index');
            Route::get('/create', CreateUser::class)->name('create');
            Route::get('/{user}/edit', EditUser::class)->name('edit');
        });

    Route::prefix('tickets')->as('tickets.')->group(function () {
        Route::get('/', ListTicket::class)->name('index')
            ->can('viewAny', Ticket::class);

        Route::get('/create', CreateTicket::class)->name('create')
            ->can('create', Ticket::class);

        // Authorization handled in livewire components, because
        // route model binding doesn't work here through middleware
        // (ex. ->can('update', 'ticket'))
        Route::get('/{ticket}/show', ShowTicket::class)->name('show');
        Route::get('/{ticket}/edit', EditTicket::class)->name('edit');
    });

    Route::middleware('can:access logs')
        ->prefix('logs')
        ->as('logs.')
        ->group(function () {
            Route::get('/', ListLog::class)->name('index');
            Route::get('/{log}/show', ShowLog::class)->name('show');
        });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
