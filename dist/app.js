var app = angular.module("nqcl", ['ui.router', 'restangular', 'smart-table',
	'chart.js', 'angularMoment', 'ui.bootstrap', 'ngSanitize', 'angular-md5',
	'LocalStorageModule', 'froala'
]);
app.config(function(RestangularProvider) {
	RestangularProvider.setBaseUrl('http://localhost/skills-matrix');
	// RestangularProvider.setRequestSuffix('?format=json');
});

app.config(function(localStorageServiceProvider) {
	localStorageServiceProvider
		.setStorageType('sessionStorage')
		.setPrefix('skills-matrix');
});

app.run(['localStorageService', '$rootScope', '$state', '$stateParams',
	'Session',
	function(localStorageService, rootScope, state, stateParams, Session) {
		Session.checkIfLogged();
	}
]);
app.value('froalaConfig', {
	inlineMode: false,
	placeholder: 'Enter Text Here'
});

app.filter('split', function() {
	return function(input, splitChar) {

		// do some bounds checking here to ensure it has that index
		var choices = input.split(splitChar);
		return choices;
	}
});
;app.controller(
	"homeCtrl", ['$scope', '$filter', '$timeout', '$state', 'Restangular',
		function(scope, filter, timeout, state, Restangular) {

			scope.content = [];


		}
	]
);
;app.controller(
	"questionsCtrl", ['$scope', '$filter', '$timeout', '$state', 'Restangular',
		'$http',
		function(scope, filter, timeout, state, Restangular, http) {
			scope.answers = [];

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
				console.log(scope.answers);

				http.post('results_log', scope.answers).
				success(function(data, status, headers, config) {
					console.log(data)
				}).
				error(function(data, status, headers, config) {
					// called asynchronously if an error occurs
					// or server returns response with an error status.
				});
				// ResultsLog.post(scope.results).then(function(response) {
				//
				// 	var alert = {
				// 			type: 'success',
				// 			msg: response
				// 		}
				// 		// scope.alerts.push(alert);
				// 		// timeout(function() {
				// 		// 	state.go('articles.published')
				// 		// }, 1000);
				// });
			}
		}
	]);
;app.directive("mainHeader", function() {
  return {
    templateUrl: "app/partials/globals/header.html"
  }
});

app.directive("adminHeader", function() {
  return {
    templateUrl: "app/partials/admin/header.html"
  }
});
app.directive("secondaryHeader", function() {
  return {
    templateUrl: "app/partials/globals/secondary_header.html"
  }
});

// app.directive("carousel", function() {
//   return {
//     templateUrl: "app/partials/globals/carousel.html"
//   }
// });
app.directive('isActiveNav', ['$location', function($location) {
  return {
    restrict: 'A',
    link: function(scope, element) {
      scope.location = $location;
      scope.$watch('location.path()', function(currentPath) {

        if ('#' + currentPath == element[0].hash) {
          element.parent().addClass('active');
        } else {
          element.parent().removeClass('active');
        }
      });
    }
  };
}]);
;app.config(function($stateProvider, $urlRouterProvider) {
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
;app.factory('Session', ['localStorageService', '$rootScope', function(
  localStorageService, rootScope) {

  return {
    checkIfLogged: function checkIfLogged() {
      rootScope.user = [];
      user = localStorageService.get('user');
      if (user == null) {
        rootScope.user = null;
        status = 'Not Logged In';
      } else {
        rootScope.user = user;
        status = 'Logged In';
      }

    }
  }

}]);
;angular.module('templates-dist', ['../app/partials/admin/header.html', '../app/partials/admin/index.html', '../app/partials/admin/login.html', '../app/partials/globals/carousel.html', '../app/partials/globals/header.html', '../app/partials/globals/secondary_header.html', '../app/partials/home/index.html', '../app/partials/survey/index.html', '../app/partials/survey/questions.html']);

angular.module("../app/partials/admin/header.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("../app/partials/admin/header.html",
    "<nav id=\"admin\">\n" +
    "  <div class=\"container-fluid\">\n" +
    "    <!-- Brand and toggle get grouped for better mobile display -->\n" +
    "    <div class=\"navbar-header\">\n" +
    "      <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">\n" +
    "        <span class=\"sr-only\">Toggle navigation</span>\n" +
    "        <span class=\"icon-bar\"></span>\n" +
    "        <span class=\"icon-bar\"></span>\n" +
    "        <span class=\"icon-bar\"></span>\n" +
    "      </button>\n" +
    "    </div>\n" +
    "\n" +
    "    <!-- Collect the nav links, forms, and other content for toggling -->\n" +
    "    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">\n" +
    "      <ul>\n" +
    "        <li>\n" +
    "          <a is-active-nav ui-sref=\"home\" >Home</a>\n" +
    "        </li>\n" +
    "        <li>\n" +
    "          <a is-active-nav ui-sref=\"survey\" ><i class='fa fa-list-ul'></i>Survey</a>\n" +
    "        </li>\n" +
    "\n" +
    "\n" +
    "      </ul>\n" +
    "\n" +
    "      <ul class=\"navbar-right\">\n" +
    "        <li>\n" +
    "          <a>\n" +
    "            <i class='fa fa-user'></i>\n" +
    "            <span>{{user[0].f_name}}</span>\n" +
    "            <span>{{user[0].l_name}}</span>\n" +
    "          </a>\n" +
    "        </li>\n" +
    "        <li><a href=\"#\" is-active-nav ui-sref=\"login\"><i class='fa fa-sign-out'></i>Logout</a></li>\n" +
    "      </ul>\n" +
    "    </div><!-- /.navbar-collapse -->\n" +
    "  </div><!-- /.container-fluid -->\n" +
    "</nav>\n" +
    "");
}]);

angular.module("../app/partials/admin/index.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("../app/partials/admin/index.html",
    "<!-- Here we are -->\n" +
    "<!-- <admin-header>\n" +
    "\n" +
    "\n" +
    "</admin-header> -->\n" +
    "\n" +
    "<section ui-view=\"detail\">\n" +
    "\n" +
    "</section>\n" +
    "");
}]);

angular.module("../app/partials/admin/login.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("../app/partials/admin/login.html",
    "<form id=\"login-form\">\n" +
    "\n" +
    "  <div class=\"form-group\">\n" +
    "    <label for=\"exampleInputEmail1\">Email address</label>\n" +
    "    <input type=\"email\" ng-model=\"user.email\" class=\"form-control\" name=\"mail_address\" required=\"required\" placeholder=\"Email\" />\n" +
    "  </div>\n" +
    "  <div class=\"form-group\">\n" +
    "    <label for=\"exampleInputEmail1\">Password</label>\n" +
    "    <input type=\"password\" ng-model=\"user.password\" class=\"form-control\" name=\"password\" required=\"required\" placeholder=\"Password\"\n" +
    "    />\n" +
    "  </div>\n" +
    "  <input type=\"submit\" class=\"btn\" name=\"sender\" value=\"SUBMIT\" ng-click=\"login()\"/>\n" +
    "\n" +
    "  <p><center><a href=\"#\">Forgot your password?</a></center></p>\n" +
    "</form>\n" +
    "");
}]);

angular.module("../app/partials/globals/carousel.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("../app/partials/globals/carousel.html",
    "");
}]);

angular.module("../app/partials/globals/header.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("../app/partials/globals/header.html",
    "<div id=\"logo\">\n" +
    "  <img src=\"app/images/logo/MOH.png\"/>\n" +
    "  <img src=\"app/images//logo/NQCL_logo.png\" style=\"float:right\"/>\n" +
    "</div>\n" +
    "\n" +
    "<nav id=\"main\">\n" +
    "  <div class=\"container-fluid\">\n" +
    "    <!-- Brand and toggle get grouped for better mobile display -->\n" +
    "    <div class=\"navbar-header\">\n" +
    "      <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\">\n" +
    "        <span class=\"sr-only\">Toggle navigation</span>\n" +
    "        <span class=\"icon-bar\"></span>\n" +
    "        <span class=\"icon-bar\"></span>\n" +
    "        <span class=\"icon-bar\"></span>\n" +
    "      </button>\n" +
    "    </div>\n" +
    "\n" +
    "    <!-- Collect the nav links, forms, and other content for toggling -->\n" +
    "    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">\n" +
    "      <ul>\n" +
    "        <li>\n" +
    "          <a is-active-nav ui-sref=\"home\" >Home</a>\n" +
    "        </li>\n" +
    "        <li>\n" +
    "          <a is-active-nav ui-sref=\"about\" >About NQCL</a>\n" +
    "        </li>\n" +
    "        <li>\n" +
    "          <a is-active-nav ui-sref=\"services\" >Our Services</a>\n" +
    "        </li>\n" +
    "\n" +
    "        <li>\n" +
    "          <a is-active-nav ui-sref=\"news\" >News and Events</a>\n" +
    "        </li>\n" +
    "        <li>\n" +
    "          <a is-active-nav ui-sref=\"downloads\">Downloads</a>\n" +
    "        </li>\n" +
    "        <li>\n" +
    "          <a is-active-nav ui-sref=\"contact\">Contact Us</a>\n" +
    "        </li>\n" +
    "\n" +
    "      </ul>\n" +
    "\n" +
    "      <ul class=\"navbar-right\">\n" +
    "        <li><a href=\"#\" is-active-nav ui-sref=\"login\"><i></i>Login</a></li>\n" +
    "        <li class=\"dropdown\">\n" +
    "          <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">Dropdown <span class=\"caret\"></span></a>\n" +
    "          <ul class=\"dropdown-menu\" role=\"menu\">\n" +
    "            <li><a href=\"#\">Action</a></li>\n" +
    "            <li><a href=\"#\">Another action</a></li>\n" +
    "            <li><a href=\"#\">Something else here</a></li>\n" +
    "            <li class=\"divider\"></li>\n" +
    "            <li><a href=\"#\">Separated link</a></li>\n" +
    "          </ul>\n" +
    "        </li>\n" +
    "      </ul>\n" +
    "    </div><!-- /.navbar-collapse -->\n" +
    "  </div><!-- /.container-fluid -->\n" +
    "</nav>\n" +
    "");
}]);

angular.module("../app/partials/globals/secondary_header.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("../app/partials/globals/secondary_header.html",
    "<nav id=\"secondary\">\n" +
    "  <div class=\"container-fluid\">\n" +
    "    <!-- Collect the nav links, forms, and other content for toggling -->\n" +
    "    <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">\n" +
    "      <ul>\n" +
    "        <li ng-repeat=\"item in article_menu\">\n" +
    "          <a is-active-nav ui-sref=\"{{item.ui_sref}}\" ><i class=\"{{item.icon_class}}\"></i>{{item.name}}</a>\n" +
    "        </li>\n" +
    "      </ul>\n" +
    "    </div><!-- /.navbar-collapse -->\n" +
    "  </div><!-- /.container-fluid -->\n" +
    "</nav>\n" +
    "");
}]);

angular.module("../app/partials/home/index.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("../app/partials/home/index.html",
    "<h3>Skills Matrix</h3>\n" +
    "");
}]);

angular.module("../app/partials/survey/index.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("../app/partials/survey/index.html",
    "<div ui-view=\"questions\"></div>\n" +
    "<div ui-view=\"categories\"></div>\n" +
    "");
}]);

angular.module("../app/partials/survey/questions.html", []).run(["$templateCache", function($templateCache) {
  $templateCache.put("../app/partials/survey/questions.html",
    "<div class=\"row\">\n" +
    "  <table>\n" +
    "    <thead>\n" +
    "      <tr>\n" +
    "        <th>Category</th>\n" +
    "        <th>Sub Category</th>\n" +
    "        <th>Question</th>\n" +
    "        <th>Options</th>\n" +
    "      </tr>\n" +
    "    </thead>\n" +
    "    <tbody>\n" +
    "      <tr ng-repeat=\"question in questions\">\n" +
    "        <td>{{question.subCategory.category.name}}</td>\n" +
    "        <td>{{question.subCategory.name}}</td>\n" +
    "        <td >{{question.description}}</td>\n" +
    "        <td>\n" +
    "          <span ng-repeat=\"choice in question.options | split:' '\">\n" +
    "            <input type=\"radio\" ng-model=\"answers[question.id].response\" value=\"{{choice}}\" name=\"{{question.id}}\">{{choice}}\n" +
    "          </span>\n" +
    "        </td>\n" +
    "\n" +
    "\n" +
    "      </tr>\n" +
    "    </tbody>\n" +
    "    <tfooter>\n" +
    "\n" +
    "\n" +
    "    </tfooter>\n" +
    "\n" +
    "  </table>\n" +
    "  <a href=\"\" class=\"btn btn-add\" ng-click=\"addAnswers()\">Submit Answers</a>\n" +
    "</div>\n" +
    "");
}]);
