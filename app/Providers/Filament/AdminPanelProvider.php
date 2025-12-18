<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
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
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Filament\Navigation\MenuItem;
use Illuminate\Support\Facades\Auth;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use App\Providers\Filament\App\Models\User;
use Filament\Models\Contracts\FilamentUser;
use App\Filament\Pages\App\Profile;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Filament\Pages\Settings;
use App\Filament\Resources\UserResource;
use App\Models\User as ModelsUser;
use BezhanSalleh\FilamentShield\Resources\RoleResource;
use DiogoGPinto\AuthUIEnhancer\AuthUIEnhancerPlugin;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Joaopaulolndev\FilamentGeneralSettings\FilamentGeneralSettingsPlugin;
use Joaopaulolndev\FilamentGeneralSettings\Pages\GeneralSettingsPage;


class AdminPanelProvider extends PanelProvider
{
   
    public function panel(Panel $panel): Panel
    {
        return $panel
             

            ->sidebarCollapsibleOnDesktop()
            ->collapsedSidebarWidth('6rem')
            ->breadcrumbs(false)
            ->default('app')            
            ->id('app')
            ->path('app')
            ->login()
            ->brandLogo(asset('images/logo_azul.png'))
            ->darkModeBrandLogo(asset('images/logon-blanco.png'))
            ->brandLogoHeight('3.5rem')
            ->favicon(asset('images/favicon.ico'))
            ->colors([
                'primary' => Color::Indigo,
            ])
            
            
            /* ->navigationItems([
                NavigationItem::make(label: 'Usuarios')
                ->icon(icon: 'heroicon-o-pencil-square')
                ->group(group:'Usuarios & Roles')
                ->sort(sort:2)
                ->url(fn (): string => UserResource::getUrl())
                ->isActiveWhen(fn () => request()->routeIs('app/users'))
                ->visible(fn() => Auth::user()->id === 1),
                NavigationItem::make(label: 'Roles')
                ->icon(icon: 'heroicon-o-pencil-square')
                ->group(group:'Usuarios & Roles')
                ->sort(sort:2)
                ->url(fn (): string => RoleResource::getUrl())
                ->isActiveWhen(fn () => request()->routeIs('app/shield/roles'))
                ->visible(fn() => Auth::user()->id === 1),
                
            ]) */
            
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
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
            ->authMiddleware([
                Authenticate::class,
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn() => Auth::user()->name)
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle'),                             
            ])
        
            ->plugins([
                FilamentBackgroundsPlugin::make()->showAttribution(false)->remember(10)
                ->imageProvider(MyImages::make()->directory('images\swisnl\filament-backgrounds\triangles')),
                
                FilamentGeneralSettingsPlugin::make()
                ->canAccess(fn() => Auth::user()->id === 1)
                ->setSort(5)
                ->setIcon('heroicon-o-cog')
                ->setNavigationGroup('AJUSTES')
                ->setTitle('Ajustes Generales')
                ->setNavigationLabel('Ajustes Generales'),

                FilamentShieldPlugin::make(),
                /* \Filament\SpatieLaravelTranslatablePlugin::make()->defaultLocales(['en', 'ar']), */
                /* \TomatoPHP\FilamentMenus\FilamentMenusPlugin::make(), */

                \Hasnayeen\Themes\ThemesPlugin::make()->canViewThemesPage(fn () => Auth::user()->id === 1),

                FilamentEditProfilePlugin::make()
                ->setTitle('Editar perfil')
                ->setIcon('heroicon-o-user')
                ->shouldRegisterNavigation(false)                   
                ->shouldShowBrowserSessionsForm(false)
                ->shouldShowDeleteAccountForm(false)
                ->shouldShowAvatarForm(
                    value: true,
                    directory: 'avatars', // image will be stored in 'storage/app/public/avatars
                    rules: 'mimes:jpeg,png|max:1024' //only accept jpeg and png files with a maximum size of 1MB
                )
                ->customProfileComponents([
                    \App\Livewire\InfoUserProfile::class,
                    /* \App\Filament\Resources\UserResource::class, */
                ]),
            ])
            
            

            ;
    }

   
}
