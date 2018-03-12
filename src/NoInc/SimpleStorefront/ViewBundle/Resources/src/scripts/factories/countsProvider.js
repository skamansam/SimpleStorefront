app.factory('countsProvider', ($http) => {
    const getCounts = () =>
        $http.get('/api/counts.json').then(response => response.data);
    return {
        getCounts,
    };
});
