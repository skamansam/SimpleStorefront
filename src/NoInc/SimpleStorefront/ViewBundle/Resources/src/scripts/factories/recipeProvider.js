app.factory('recipeProvider', ($http) => {
    const getRecipes = () =>
        $http.get('/api/recipes.jsonld').then(response => response.data['hydra:member']);

    const getRecipeCount = () =>
        $http.get('/api/recipes?count_only=true').then(response => response.data);

    return {
        getRecipes,
        getRecipeCount,
    };
});
