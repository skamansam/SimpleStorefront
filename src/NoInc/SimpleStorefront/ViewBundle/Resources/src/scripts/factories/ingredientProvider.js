app.factory('ingredientProvider', ($http) => {
    const getIngredients = () =>
        $http.get('/api/ingredients.jsonld').then(response => response.data['hydra:member']);

    const purchaseIngredient = name =>
        $http.put(`/api/ingredients/${name}`).then(response => response.data);

    return {
        getIngredients,
        purchaseIngredient,
    };
});
