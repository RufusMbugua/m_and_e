app.config(function($stateProvider, $urlRouterProvider) {
  //
  // For any unmatched url, redirect to /state1
  $urlRouterProvider.otherwise("/");

  // Now set up the states
  $stateProvider
    .state('home', {
      url: '/',
      templateUrl: 'app/partials/home/index.html',
      controller: 'homeCtrl'
    })
    .state('survey', {
      url: '/survey',
      views: {
        '': {
          templateUrl: 'app/partials/survey/index.html'
        },
        'questions@survey': {
          templateUrl: 'app/partials/survey/questions.html',
          controller: 'questionsCtrl'
        }

      }
    })
    .state('articles', {
      url: '/articles',
      views: {
        // Main
        '': {
          templateUrl: 'app/partials/articles/index.html',
          controller: 'contentCtrl'
        }
      }
    })
    .state('articles.add', {
      url: '/add',
      controller: 'contentCtrl',
      templateUrl: 'app/partials/articles/articles.add.html'
    })
    .state('articles.published', {
      url: '/published',
      views: {
        '': {
          templateUrl: 'app/partials/articles/articles.published.html',
          controller: 'contentCtrl'
        },
        'list@articles.published': {
          templateUrl: 'app/partials/articles/articles.list.html',
          controller: 'contentCtrl'
        },
        'detail@articles.published': {
          templateUrl: 'app/partials/articles/articles.items.html',
          controller: 'contentCtrl'
        }
      }
    });
});
