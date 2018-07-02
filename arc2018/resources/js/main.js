'use strict';
/* main application */
var app = (function() {
  var _config, _initialize, _startRouter;

  _config = {
    APPLICATION_ROOT: ''
  };

  _initialize = function() {
    /* Create models. */
    app.institutions = new Institutions();
    app.institutions.comparator = 'fullName';
    app.disciplines = new Disciplines();
    app.disciplines.comparator = 'forCode';
    app.allOutcomes = new Outcomes();
    app.institutionOutcomes = new Backbone.Collection();
    app.institutionOutcomes.comparator = 'FoRCode'
    app.fieldOfResearchOutcomes = new Backbone.Collection();
    app.fieldOfResearchOutcomes.comparator = 'InstitutionFullName'
    app.searchQuery = new SearchQuery();

    /* Create view. */
    app.searchQueryView = new SearchQueryView({
      model: app.searchQuery,
      institutionList: app.institutions,
      forCodeList: app.disciplines,
      el: "#searchQuery"
    });
    app.fieldOfResearchOutcomesView = new FieldOfResearchOutcomesView({
      collection: app.fieldOfResearchOutcomes,
      el: "#fieldOfResearchOutcomes"
    });
    app.institutionOutcomesView = new InstitutionOutcomesView({
      collection: app.institutionOutcomes,
      el: "#institutionOutcomes"
    });

    /* Initialize router. */
    var Router = Backbone.Router.extend({
      routes: {
        "Institution/(:inst)": "setInstitution",
        "FoR/(:code)": "setFieldOfResearch",
      },
      setInstitution: function(inst){
        app.searchQuery.set({
          'institutionSearch' : true,
          'institution'       : inst
          });
      },
      setFieldOfResearch: function (code) {
        var discipline  = app.disciplines.findWhere({
          'id': code
        })
        if (discipline){
          app.searchQuery.set({
            'institutionSearch': false,
            'forCode': discipline.get('forCode'),
            'disciplineCode': code,
            'clusterRoundId': discipline.get('clusterRoundId')
          });
        }
        else {
          app.searchQuery.set({
            'institutionSearch': false,
            'forCode': null,
            'disciplineCode': null,
            'clusterRoundId': null
          });
        }
      },
    });
    app.router = new Router();
    Handlebars.registerHelper('eq', function (value, test, options) {
      if (value === test) {
        return options.fn(this);
      } else {
        return options.inverse(this);
      }
    });
  };

  _startRouter = function() {
    app.searchQueryView.render();
    Backbone.history.start({
      pushState: false,
      root: app.config.APPLICATION_ROOT
    });
  };

  return {
    config: _config,
    init: _initialize,
    start: _startRouter
  };
}());
