app.factory('userProvider', ($http, $cookies) => {
    const getUser = () => $http.get('/api/user.json').then(response => response.data);
    const getToken = () => $cookies.get('jwt_token');

    const setHeaderFromToken = () => {
        const token = getToken();
        if (token) {
            $http.defaults.headers.common.Authorization = `Bearer ${token}`;
        }
        return token;
    };
    const setToken = (token) => {
        $cookies.put('jwt_token', token);
        setHeaderFromToken();
    };

    return {
        getUser,
        setToken,
        getToken,
        setHeaderFromToken,
    };
});
