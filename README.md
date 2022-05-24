# Progetto Laravel con login

## Inizializzazione
1. Creare la cartella del progetto
1. Entrare dal terminale nella cartella
1. <code>composer create-project --prefer-dist laravel/laravel:^7.0 .</code>
1. Only for Laravel <= 7
    - <code>composer remove fzaninotto/faker</code>
    - <code>composer require fakerphp/faker</code>
1. Se volete usare la laravel-debugbar
    - <code>composer require barryvdh/laravel-debugbar --dev</code>
1. <code>composer require laravel/ui:^2.4</code>
1. <code>php artisan ui vue --auth</code>
1. (eventuali altre librerie per altre cose come: gestione ruoli, generazione slug)
1. Su package.json modificare:
    - **"bootstrap": "^4.0.0",** in **"bootstrap": "^5.1.3",** (o comunque la versione che si vuole usare)
    - **"popper.js": "^1.12",** in **"@popperjs/core": "^2.11.5",**
1. Su resorces/js/bootstrap.js commentare:
    - window.Popper = require('popper.js').default;
    - window.$ = window.jQuery = require('jquery');
1. <code>npm install</code>
1. <code>php artisan make:model --all Post</code>
1. Spostare il file app/Http/Controllers/HomeController.php nella cartella Admin
1. Nel file appena spostato:
    - modificare **namespace App\Http\Controllers;** in **namespace App\Http\Controllers\Admin;**
    - aggiungere una riga nuova con **use App\Http\Controllers\Controller;**
1. Cancellare il controller generato in app/Http/Controllers
1. <code>php artisan make:controller --model=Post Admin/PostController</code>
1. <code>composer dump-autoload</code>
1. Nel file **app/Providers/RouteServiceProvider.php** modificare:
    - **public const HOME = '/home';** in **public const HOME = '/admin';** (oppure quello che avete messo voi)
1. Se serve modificare il file **app/Http/Middleware/Authenticate.php**:
    - **return route('login');** con la route che volete voi


## Database
1. Creare il database da phpMyAdmin oppure da linea di comando o come volete
1. Nel file .env aggiornare i dati del database (quelli che iniziano con DB_) e giacchè anche APP_NAME col nome della vostra app
1. Aggiornare i file delle migrations
1. Aggiornare il file DatabaseSeeder.php aggiungendo <code>$this->call(ModelSeeder::class);</code> per ogni model di cui abbiamo il seeder
1. Aggiornare i file dei seeders
    - agiungere <code>use Faker\Generator as Faker;</code>
    - modificare <code>public function run()</code> a <code>public function run(Faker $faker)</code>
1. (slugs)
1. Nel model impostare la proprietà $fillable con le colonne che possono essere "mass assigned"

## Views
1. Organizzare la cartella resources/views con:
    - una sottocartella admin (con le sottocartelle per ciascun model risorsa) e spostare home.blade.php dentro admin
    - una sottocartella guests

## Avviare l'ambiente locale
1. <code>npm run watch</code>
1. <code>php artisan serve</code>

**CHIUDERE TUTTE LE TAB IN VISUAL STUDIO CODE**

**Relazioni**
1. Creare tutti i Model & Co. che ci servono (migration, seeder, controller, ...): <code>php artisan make:model --all ModelName</code>

***Relazioni one-to-many:***
Devono essere definite sia sulla migration che su ciascuno dei due model interessati:
- nella migration va specificata la foreign key:
    - create la colonna che conterrà la foreign key: <code>$table->unsignedBigInteger('model_id')</code>
    - definire la foreign key: <code>$table->foreign('model_id')->references('id')->on('tableNameOfModel')</code>
- nei models va definita un nuovo metodo:
    - ModelA:
        - public function modelbs () {
            return $this->hasMany('App\ModelB');
        }
    - ModelB (ha la chiave esterna):
        - public function modela () {
            return $this->belongsTo('App\ModelA');
        }

***Relazioni many-to-many:***
- create una migration per la tabella ponte (senza model) con nome tipo create_post_tag_table (i nomi dei models vanno inseriti al singolare e in ordine alfabetico)
- nella migration vanno specificate le due foreign keys:
    $table->unsignedBigInteger('post_id');
    $table->foreign('post_id')->references('id')->on('posts');

    $table->unsignedBigInteger('tag_id');
    $table->foreign('tag_id')->references('id')->on('tags');

    $table->primary(['post_id', 'tag_id']);

- nei models va definita un nuovo metodo:
    - Post:
        public function tags() {
            return $this->belongsToMany('App\Tag');
        }
    - Tag:
        public function posts() {
            return $this->belongsToMany('App\Post');
        }
