app.config(($stateProvider, $locationProvider) => {
    // * * *
    // Auth pages
    // * * *

    // These pages are handled by overriding templates in FOSUserBundle
    const loginPane = {
        name: 'login',
        url: '/login',
        templateUrl: '/login_pane.html',
        controller: 'loginController',
        data: { pageTitle: 'Login' },
    };

    // * * *
    // End Auth pages
    // * * *


    // * * *
    // Recipe pages
    // Note: The .html template URLs correspond to the Directory
    // structure of the pug templates. Be sure to also create the corresponding
    // route entry in the ViewBundle/config/routing.yml file.
    // * * *

    // Recipe pages
    const allRecipes = {
        name: 'allRecipes',
        url: '/app/recipes',
        templateUrl: '/recipes/allRecipes.html',
        controller: 'allRecipesController',
        data: { pageTitle: 'All Recipes' },
    };

    const allIngredients = {
        name: 'ingredients',
        url: '/app/ingredients',
        templateUrl: '/ingredients/ingredients.html',
        controller: 'ingredientsController',
        data: { pageTitle: 'All Ingredients' },
    };

    // * * *
    // End Dashboard pages
    // * * *


    // * * *
    // Apply the states to make Angular aware of them
    // * * *

    // Dashboard home
    $stateProvider.state(loginPane);
    $stateProvider.state(allRecipes);
    $stateProvider.state(allIngredients);

    // General rules and setup.
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false,
    });
}).run(['$rootScope', '$state', '$stateParams', '$http', '$q', ($rootScope, $state, $stateParams) => {
    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;
}]);
