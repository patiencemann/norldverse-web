/** @type {import('tailwindcss').Config} */
const { colors: defaultColors } = require('tailwindcss/defaultTheme')

const colors = {
    ...defaultColors,
    ...{
        "deep-green": {
            "900": "#04293A",
            "800": "#111827"
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
        "colors": colors,
        borderRadius: {
            'd-lg': "20px"
        }
    },
    plugins: [require("flowbite/plugin")],
};
