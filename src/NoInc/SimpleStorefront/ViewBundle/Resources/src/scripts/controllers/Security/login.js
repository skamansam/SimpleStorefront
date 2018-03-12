
app.controller('loginController', ($scope, $http, $state, userProvider) => {
    $scope.user = {
        username: null,
        password: null,
    };
    $scope.login = () => {
        $http.post('/login', {
            _username: $scope.user.username.toLowerCase().trim(),
            _password: $scope.user.password.trim(),
        }).then((response) => {
            $http.post('/api/login_check', {
                _username: $scope.user.username.toLowerCase().trim(),
                _password: $scope.user.password.trim(),
            }).then((response2) => {
                userProvider.setToken(response2.data.token);
                $state.go('allRecipes');
            });
        });
    };
});
