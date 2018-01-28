</php session_start();?>
<!Doctype html>
<html lang="en">
<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">    
  <!-- Bootstrap JS -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->
  <!-- Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
  <!-- Anguular/maybe ajax??? CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
  <!-- Angular animate -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.js"></script>

  <!-- Linking css files -->
  <link href="test.js" rel="stylesheet" type="text/javascript">








<script type="text/javascript">

var testApp = angular.module('testApp', []);
testApp.controller('testCont', ['$scope', '$http', function ($scope, $http) {
    $scope.submit = function(){
        var FD = new FormData(); 
        var userName = $('#userName').val();
        var password = $('#password').val();
        FD.append('userName', userName);
        FD.append('password', password);
        $http({
            method: 'post',
            url: 'function.php?insert=true',
            data: FD,
            headers: {'Content-Type': undefined},
        })
            .then(function(response, header, status, config) {
                alert('');
                response.data;
                $scope.response = response.data;
                console.log(response.data);
            });
        
  }
// testApp.controller('testCont', ['$scope', '$http', function ($scope, $http) {  
    $scope.getter = function(){
        $http({
            method: 'get',
            url: 'function.php?shower=true',
            // data: FD,
            headers: {'Content-Type': undefined},
        })
            .then(function(response, data, header, status, config) {
                // $scope.response = response.data;
                console.log(response.data);
                console.log(response);                
                $scope.userNames = response.data;
            });
    };
}]);


</script>
</head



<?php
// if(isset($_POST['userName'])){
//     $userName = $_POST['userName']; 
// }
?>





<body>

    <div ng-app="testApp">
        <div ng-controller="testCont">
            <form method="POST">
                <input type="text" name="userName" placeholder="Username" id="userName">
                <input type="text" name="password" placeholder="Password" id="password">
                <input type="submit" name="submit" id="submit" ng-click="submit()" value="Submit">

                        <input type="button" id="getter" ng-click="getter()" value="lol">
                        <!-- <div ng-bind="userNames"></div> -->
                            <div ng-repeat="record in userNames">
                            <td>{{record.id}}</td>                            
                            <td>{{record.userName}}</td>
                </div>
            </form>    
        </div>
        
    </div><!-- Test app -->
</body>

</div><!-- totalContainer -->
</html>