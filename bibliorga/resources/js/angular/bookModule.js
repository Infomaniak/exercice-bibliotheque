var bookModule = angular.module('book_module', []);

bookModule.controller('bookController', function ($scope) {
    $scope.showMyModal = function (book) {
        $scope.bookUpModalTitle = book.title;
        $scope.bookUpModalPublication = book.publication;
        $scope.bookUpModalRef = book.ref;
        $scope.bookUpModalQuantity = book.quantity;
        $scope.bookUpModalDescription = book.description;
        $scope.bookUpModalCover = book.cover_url;
        $scope.bookUpModalCatgId = book.category_id;
        $scope.bookUpModalFormAction = `/book/${book.id}`;
    }
});
