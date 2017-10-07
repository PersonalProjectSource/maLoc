var app = angular.module('homepage', []);
app.controller('myCtrl', function($scope, $http) {
    $http.get("http://localhost:8000/api/")
        .then(function(response) {
            $scope.homepage = response.data;
            console.log($scope.homepage);
        });
});

app.controller('MenuCtrl', function($scope, $http) {
    $scope.pacman = 'je suis tout jaune';
    //$scope.menu = [['Accueil', 'http://www.google.fr'], ['Services', 'www.bfm.fr'], ['Nos produits', 'www.tf1.fr'], ['Contact', 'www.facebook.fr']];
    $scope.menu = { "item":
        {
            'label': 'Accueil',
            'link': 'http://www.google.fr'
        }
    };
    console.log($scope.menu);
});