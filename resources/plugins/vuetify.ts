import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/styles';
import { ThemeDefinition, createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

const globalTheme: ThemeDefinition = {
    dark: false,
    colors: {
        primary: '#009D94',
        secondary: '#001438',
        tertiary: '#DFDFDF',

        background: '#F8FDFF',
        'dark-background': '#001F25',
        outline: '#6F7977',

        'primary-light': '#CCE8E3',

        error: '#BA1A1A',
        success: '#D8FFE1',
        warning: '#FFDAD6',

        'chip-activate': '#D8FFE1',
        'chip-pause': '#FFE8CD',
        'chip-finalize': '#A9D0F5',
        'chip-cancel': '#FFDAD6',
        'chip-schedule': '#b3dadf',

        'light-blue': '#CDE5FF',

        'blue-gray-500': '#EEF4F6',
        'blue-gray-800': '#46617A',
        'blue-gray-900': '#001A42',

        'gray-300': '#A8A8AC',
        'gray-500': '#6F7977',
        'gray-800': '#2D363E',

        'graph-blue': '#3C9AD6',
        'graph-green': '#8DC243',
        'graph-yellow': '#FAEC57',
        'graph-red': '#F03F33',
        'graph-orange': '#F57E1E',
        'graph-purple': '#6875B7',
    },
};

export const vuetify = createVuetify({
    components,
    theme: {
        defaultTheme: 'globalTheme',
        themes: {
            globalTheme,
        },
    },
    directives,
});
