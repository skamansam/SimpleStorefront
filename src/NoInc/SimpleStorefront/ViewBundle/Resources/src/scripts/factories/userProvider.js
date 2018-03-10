app.factory('userProvider', ($http, $cookies) => {
    // eslint-disable-next-line arrow-body-style
    const getUser = () => {
        return $http.get('/current_user').then(response => response.data);
    };
    const setToken = (token) => {
        $http.defaults.headers.common.Authorization = `Bearer ${token}`;
        $cookies.put('jwt_token', token);
    };
    const getToken = () => $cookies.get('jwt_token');
    return {
        getUser,
        setToken,
        getToken,
    };
});
