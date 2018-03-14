app.factory('ingredientProvider', ($http) => {
    const getIngredients = () =>
        $http.get('/api/ingredients').then(response => response.data);

    return {
        getIngredients,
    };
});
