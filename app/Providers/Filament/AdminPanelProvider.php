<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin; // es importante que importemos esta línea para que pueda funcionar los permisos
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;
use ShuvroRoy\FilamentSpatieLaravelHealth\FilamentSpatieLaravelHealthPlugin;
/*importamos lo necesario para el uso de jobs monitor*/
use \Croustibat\FilamentJobsMonitor\FilamentJobsMonitorPlugin;
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->login()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
                // aquí puedes introducir los widgets que quieras en tu panel de usuario
            ])
            ->profile() // esto permite añadir a nuestro nombre de usuario un 
            // perfil que nos permite cambiar de usuario y de contraseña 
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            //->plugin(FilamentSpatieRolesPermissionsPlugin::make()) // con esta línea indicamos que se usan los permisos a través del pligun spatie 
            //pero esto tiene un problema y es que no puedes ocultar el panel que se crea de acceso a los mismos según los permisos 
            /*vamos a ver como se haría de manera tradicional*/
            ->plugins([
                \Awcodes\Curator\CuratorPlugin::make()
                    ->label('Media')
                    ->pluralLabel('Media')
                    ->navigationIcon('heroicon-o-photo')
                    ->navigationGroup('Content')
                    ->navigationSort(3)
                    ->navigationCountBadge()
                    //->registerNavigation(false) esta línea hace que no se te muestre en el aside panel
                    ->defaultListView('grid' || 'list')
                    
            ])

            ->plugin(FilamentSpatieLaravelBackupPlugin::make()) //para que se puedan usar todas las funcionalidades 
            //es necesario tener insataldo mysql, este paquete esta muy orientado a controlar la app cuando se encuentra en producccion

            ->plugin(FilamentSpatieLaravelHealthPlugin::make())

            ->plugins([
                FilamentJobsMonitorPlugin::make()
            ])
            //todo lo que metamos aqui tiene que ser antes del método Middleware
            ->authMiddleware([ 
                Authenticate::class,
            ]);
    }
}
