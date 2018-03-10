
app.controller('loginController', ($scope, $http, $state, userProvider) => {
    $scope.user = {
        username: null,
        password: null,
    };
    $scope.login = () => {
        $http.post('/api/login_check', {
            _username: $scope.user.username.toLowerCase().trim(),
            _password: $scope.user.password.trim(),
        }).then((response) => {
            userProvider.setToken(response.data.token);
            $state.go('allRecipes');
        });
    };
});
