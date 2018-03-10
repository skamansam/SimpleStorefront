
app.controller('loginController', ($scope, $http, $window) => {
    $scope.user = {
        username: null,
        password: null,
    };

    $scope.login = () => $http.post('/login', {
        _username: $scope.user.username.toLowerCase().trim(),
        _password: $scope.user.password.trim(),
    }).then(() => {
        $window.location.href = '/app/recipes';
    });
});
