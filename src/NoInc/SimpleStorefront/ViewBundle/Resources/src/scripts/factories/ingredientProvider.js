app.factory('ingredientProvider', ($http) => {
    const getIngredients = () =>
        $http.get('/api/ingredients.jsonld').then(response => response.data['hydra:member']);

    const purchaseIngredient = (id, count) =>
        $http.put(`/api/ingredients/${id}`, { stock: count }).then(response => response.data);

    return {
        getIngredients,
        purchaseIngredient,
    };
});
