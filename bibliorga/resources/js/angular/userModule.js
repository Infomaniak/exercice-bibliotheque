var userModule = angular.module('user_module', []);

userModule.controller('userController', function ($scope) {
    $scope.showMyModal = function (user) {
        $scope.userUpModalCover = user.profile_image;
        $scope.userUpModalLastName = user.lastname;
        $scope.userUpModalFirstName = user.firstname;
        $scope.userUpModalEmail = user.email;
        $scope.userUpModalRole = user.role;
        $scope.userUpModalFormAction = `/users/${user.id}`;
        console.log('clicked');
        console.log(user);
    }
});
