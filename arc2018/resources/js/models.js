'use strict';

Backbone.sync = function(method, model, options) {
  if (typeof model.url != 'undefined') {
    var xhr = $.getJSON(model.url, options.success);
    console.log("sync retreived: " + model.url);
    model.trigger('request', model, xhr, options);
    return xhr;
  }
};

var SearchQuery = Backbone.Model.extend({
  defaults: {
    institutionSearch: true, //other option is FoR search
    institution: '',
    forCode: '',
    clusterRoundId : null,
    disciplineCode : '' //only used for 2010
  }
});

var Outcome = Backbone.Model.extend({
  defaults: {
    "FoRCode": "", //1111
    "Institution": "", //FLN
    "RoundCluster": null, //8
    "Score": null, //2
    "UoE": "", //PAH1111
    "ClusterCode" : ""
  },
  parse: function(resp) {
    var transformed = _.extend(resp);
    // transformed.id =  resp.Institution + resp.UoE;
    var institution = app.institutions.findWhere({
      'shortName': resp.Institution
    })
    if (institution){
      transformed.InstitutionFullName = institution.get('fullName');
    }
    var fieldOfResearch  = app.forCodes.findWhere({
      'code': resp.FoRCode
    })
    if (fieldOfResearch){
      transformed.FoRTitle = fieldOfResearch.get('name');
    }
    return transformed;
  }
});

var Outcomes = Backbone.Collection.extend({
  model: Outcome,
  url: app.config.RESULTS_DATA_URL,
  setupDefaults: function () {
    // setup a default entry for all combinations of institution and disciline with a score of 'Not Assessed'
     var defaultOutcomes = [];
     app.institutions.each(function(institution){
       app.disciplines.each(function(discipline){
         defaultOutcomes.push({
           "FoRCode": discipline.get('forCode'),
           "Institution": institution.get('shortName'),
           "Score": 'Not Assessed',
           "UoE": discipline.id,
           "RoundCluster": discipline.get('clusterRoundId'),
           "ClusterCode": discipline.get('clusterCode')
         })
       })
     })
     this.reset(defaultOutcomes, {parse: true, silent: true});
  },
  parse: function(resp) {
    if (_.isArray(resp)){
      _.each(resp, function(model){
        model.id = model.Institution + model.UoE
      })
    }
    return resp;
  }
});

var FoRCode = Backbone.Model.extend({
  defaults: {
    "code": "", //0101
    "name": "" //Pure Mathematics
  },
  parse: function(resp) {
    var transformed = {
        'code': resp.Key,
        'name': resp.Value,
        'label': resp.Key + ' - ' + resp.Value
      }
    return transformed;
  },
});

var FoRCodes = Backbone.Collection.extend({
  model: FoRCode,
  url: app.config.FOR_CODE_DATA_URL
});

var Instituion = Backbone.Model.extend({
  defaults: {
    shortName: "",
    fullName: ""
  },
  parse: function(resp) {
    var transformed = {
        'shortName': resp.Key,
        'fullName': resp.Value
      }
    return transformed;
  },
})

var Institutions = Backbone.Collection.extend({
  model: Instituion,
  url: app.config.INSTITUTIONS_DATA_URL
})

var Discipline = Backbone.Model.extend({
  defaults: {
    id: '',
    forCode: '',
    forName: '',
    clusterRoundId: '',
    clusterCode: '',
    label: ''
  },
  parse: function(resp) {
    var transformed = {
        'id': resp.Key,
        'forCode': resp.Value.FoRCode,
        'clusterRoundId': resp.Value.RoundCluster
    }
    var fieldOfResearch  = app.forCodes.findWhere({
      'code': resp.Value.FoRCode
    })
    if (fieldOfResearch){
      transformed.forName = fieldOfResearch.get('name');
    }
    var cluster  = app.clusters.findWhere({
      'id': resp.Value.RoundCluster
    })
    if (cluster){
      transformed.clusterCode = cluster.get('clusterCode');
    }
    transformed.label = transformed.forCode + ' - ' + transformed.forName + ' (' + transformed.clusterCode + ')';
    return transformed;
  },
})

var Disciplines = Backbone.Collection.extend({
  model: Discipline,
  url: app.config.DISCIPLINE_DATA_URL
})

var Cluster = Backbone.Model.extend({
  defaults: {
    id: '',
    clusterCode: ''
  },
  parse: function(resp) {
    var transformed = {
      'id' : resp.Key,
      'clusterCode' : resp.Value
    }
    return transformed;
  }
})

var Clusters = Backbone.Collection.extend({
  model: Cluster,
  url: app.config.CLUSTER_ROUND_DATA_URL
})
