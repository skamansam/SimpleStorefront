
app.controller('loginController', ($scope, $http, $state, userProvider) => {
    $scope.user = {
        username: null,
        password: null,
    };
    $scope.login = () => {
        $http.post('/login', {
            _username: $scope.user.username.toLowerCase().trim(),
            _password: $scope.user.password.trim(),
        }).then(() => {
            $http.post('/api/login_check', {
                _username: $scope.user.username.toLowerCase().trim(),
                _password: $scope.user.password.trim(),
            }).then((response) => {
                console.info(response);
                userProvider.setToken(response.data.token);
                $scope.$emit('userChanged');
                $state.go('allRecipes');
            });
        });
    };
});
