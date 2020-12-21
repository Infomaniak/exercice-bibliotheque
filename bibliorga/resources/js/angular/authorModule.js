var authorModule = angular.module('author_module', []);

authorModule.controller('authorController', function ($scope) {
    $scope.showMyModal = function (author) {
        $scope.authorUpModalCover = author.profile_image;
        $scope.authorUpModalLastName = author.lastname;
        $scope.authorUpModalFirstName = author.firstname;
        $scope.authorUpModalBiography = author.biography;
        $scope.authorUpModalFormAction = `/author/${author.id}`;
    }
});
