app.factory('userProvider', ($http, $cookies) => {
    // eslint-disable-next-line arrow-body-style
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
    // const isLoggedIn = () => getUser().then( (response) => JSON.stringify(response) === '{}');
    return {
        getUser,
        setToken,
        getToken,
        setHeaderFromToken,
    };
});
