// eslint-disable-next-line
const app = angular.module('noincSimpleStorefront', ['ui.router', 'ngMaterial', 'ngCookies', 'angular-jwt', 'ngAnimate'])
    .config(($mdThemingProvider, $interpolateProvider) => {
        $mdThemingProvider.theme('default')
            .primaryPalette('purple', {
                default: '400',
                'hue-1': 'A200', // use shade A200 for the <code>md-hue-1</code> class
                'hue-2': '600', // use shade 600 for the <code>md-hue-2</code> class
                'hue-3': 'A700', // use shade A100 for the <code>md-hue-3</code> class
            })
            .accentPalette('red', {
                default: 'A700', // use shade 200 for default, and keep all other shades the same
            });

        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    });
