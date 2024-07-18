/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: "#CCDEFC",
                    100: "#AAC8FA",
                    200: "#80ADF7",
                    300: "#5592F5",
                    400: "#2B76F2",
                    500: "#005BF0",
                    600: "#004CC8",
                    700: "#003DA0",
                    800: "#002E78",
                    900: "#001E50",
                },
            },
        },
    },
    plugins: [],
};
