app.factory('recipeProvider', ($http) => {
    const getRecipes = () =>
        $http.get('/api/recipes').then(response => response.data);

    const getRecipeCount = () =>
        $http.get('/api/recipes?count_only=true').then(response => response.data);

    return {
        getRecipes,
        getRecipeCount,
    };
});
