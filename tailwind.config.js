/** @type {import('tailwindcss').Config} */
const { colors: defaultColors } = require('tailwindcss/defaultTheme')

const colors = {
    ...defaultColors,
    ...{
        "deep-green": {
            "900": "#04293A",
            "800": "#111827",
            "700": "#1e2a3b"
        },
        "deep-text": {
            "900": "#72acfe"
        }
    },
}

module.exports = {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {},
        fontFamily: {
            'anek': ['"Anek Telugu"', 'sans-serif']
        },
        "colors": colors
    },
    plugins: [require("flowbite/plugin")],
};
