app.controller(
  "questionsCtrl", ['$scope', '$filter', '$timeout', '$state', 'Restangular',
    '$http',
    function(scope, filter, timeout, state, Restangular, http) {
      scope.results = [];

      getQuestions()

      var Questions = Restangular.all('questions?format=json');

      var ResultsLog = Restangular.all('results_log?format=json');

      function getQuestions() {
        http.get('questions?format=json').
        success(function(data, status, headers, config) {
          scope.questions = data;
        }).
        error(function(data, status, headers, config) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
        });
      }

      scope.addAnswers = function addAnswers() {
        console.log(scope.results);
        ResultsLog.post(scope.results).then(function(response) {

          var alert = {
              type: 'success',
              msg: response
            }
            // scope.alerts.push(alert);
            // timeout(function() {
            // 	state.go('articles.published')
            // }, 1000);
        });
      }
    }
  ]);
