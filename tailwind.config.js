import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import { colors } from "laravel-mix/src/Log";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dark: {
                    main: "#1E1E1E",
                    second: "#212121",
                },
                yellow: {
                    main: "#FFC700",
                    second: "#FFEB00",
                },
            },
        },
    },

    plugins: [forms],
};
