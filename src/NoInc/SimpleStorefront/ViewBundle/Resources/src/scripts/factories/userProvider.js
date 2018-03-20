app.factory('userProvider', ($http, $cookies, $q, jwtHelper) => {
    const getToken = () => $cookies.get('jwt_token');

    const setHeaderFromToken = () => {
        const token = getToken();
        if (token) {
            $http.defaults.headers.common.Authorization = `Bearer ${token}`;
        }
        return token;
    };

    const getUserFromToken = () => {
        const token = getToken();
        if (token) {
            return jwtHelper.decodeToken(token);
        }
        return {};
    };

    /**
     * Get the user object from the jwt token. If force_api is true, get the user fro the user api service
     * @param {boolean} forceApi fetch the user data from the API instead of the jwt token
     * @returns {Promise} a promise to return a user object
     */
    const getUser = (forceApi) => {
        if (forceApi) {
            return $http.get('/api/user.json');
        }
        return $q.when(getUserFromToken());
    };


    const logout = () => {
        console.info('Logging Out!')
        $cookies.remove('jwt_token');
        return $http.get('/logout');
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
        logout,
    };
});
