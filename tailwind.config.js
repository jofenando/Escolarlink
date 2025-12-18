import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}

content: [
    './vendor/diogogpinto/filament-auth-ui-enhancer/resources/**/*.blade.php',
    './vendor/awcodes/filament-table-repeater/resources/**/*.blade.php',
]