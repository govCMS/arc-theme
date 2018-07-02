'use strict';
/* Views */
var SearchQueryView = Backbone.View.extend({
  initialize: function(args) {
    this.institutionList = args.institutionList;
    this.forCodeList = args.forCodeList;
    this.listenTo(this.model, "change:institution change:forCode change:institutionSearch", this.render, this);
    this.listenTo(this.model, "change:institution change:forCode change:institutionSearch", this.filterResults, this);
    this.template = Handlebars.compile(jQuery("#searchQuery-template").html());
    Handlebars.registerPartial('institutionSelector', jQuery('#institutionSelector-template').html());
    Handlebars.registerPartial('forCodeSelector', jQuery('#forCodeSelector-template').html());
    Handlebars.registerHelper('option', function(value, label, selectedValue) {
    var selectedProperty = value == selectedValue ? 'selected="selected"' : '';
      return new Handlebars.SafeString('<option value="' + value + '"' +  selectedProperty + '>' + label + "</option>");
    });
  },
  events: {
    'change input[name="options"]:radio': 'optionChange',
    'change select#institutionSelector': 'changeInstitution',
    'change select#forCodeSelector': 'changeFoRCode'
  },
  render: function() {
    var html = [];
    var context = {};
    context.searchQuery = this.model.toJSON();
    if (this.institutionList) {
      context.institutionList = this.institutionList.toJSON();
      context.institutionList.unshift(JSON.parse('{"shortName":"","fullName":"   Select an institution   "}'));
    }
    if (this.forCodeList) {
      context.forCodeList = this.forCodeList.toJSON();
      context.forCodeList.unshift(JSON.parse('{"id":"","forCode":"","clusterRoundId":null,"forName":"","clusterCode":"","label":"   Select a field of research   "}'));
    }
    html.push(this.template(context));
    this.$el.html(html);
    if (this.model.get('institutionSearch')){
      app.fieldOfResearchOutcomesView.hide();
      app.institutionOutcomesView.render();
    }
    else{
      app.institutionOutcomesView.hide();
      app.fieldOfResearchOutcomesView.render();
    }
    return this;
  },
  optionChange: function(event) {
    this.model.set('institutionSearch', event.target.id === 'institutionSearchOption'); //, {silent: true})
    if (this.model.get('institutionSearch')){
      app.router.navigate("/Institution/"+ this.model.get('institution'), {trigger: true});
    }
    else{
      if(this.model.has('disciplineCode')){
          app.router.navigate("/FoR/"+ this.model.get('disciplineCode'), {trigger: true});
      }
      else {
        app.router.navigate("/FoR/"+ this.model.get('forCode'), {trigger: true});
      }
    }
  },
  changeInstitution: function(){
    this.model.set('institution', jQuery('select#institutionSelector').val());
    app.router.navigate("/Institution/"+ this.model.get('institution'), {trigger: true});
  },
  changeFoRCode: function () {
    this.model.set('forCode', jQuery('select#forCodeSelector').val());
    app.router.navigate("/FoR/"+ this.model.get('forCode'), {trigger: true});
  },
  filterResults: function(){
    if (this.model.get('institutionSearch')) {
      var filter = {
        "Institution": this.model.get('institution')
      }
      var filteredOutcomes = app.allOutcomes.where(filter);
      app.institutionOutcomes.reset(filteredOutcomes);
    } else {
      var filter = {
        "FoRCode": this.model.get('forCode')
      }
      if(this.model.has('clusterRoundId')){
          filter.RoundCluster = this.model.get('clusterRoundId');
      }
      var filteredOutcomes = app.allOutcomes.where(filter);
      app.fieldOfResearchOutcomes.reset(filteredOutcomes);
    }
  }
})

var FieldOfResearchOutcomesView = Backbone.View.extend({
  initialize: function() {
    this.listenTo(this.collection, "reset", this.render, this);
    this.template = Handlebars.compile(jQuery("#field-of-research-outcome-template").html());
  },
  render: function() {
    var html = [];
    var context = {};
    if (this.collection.length > 0){
      var discipline = app.disciplines.findWhere({
        'id' : app.searchQuery.get('disciplineCode')
      });
      if (discipline){
        context.disciplineLabel = discipline.get('label');
      }
      context.institutions = this.collection.toJSON();
    }
    html.push(this.template(context));
    this.$el.html(html);
    return this;
  },
  hide: function(){
    this.$el.html('');
  }
});

var InstitutionOutcomesView = Backbone.View.extend({
  initialize: function() {
    this.listenTo(this.collection, "reset", this.render, this);
    this.template = Handlebars.compile(jQuery("#institution-outcome-template").html());
  },
  render: function() {
    var html = [];
    var context = {};
    if (this.collection.length > 0){
      var institution = app.institutions.findWhere({
        'shortName': app.searchQuery.get('institution')
      })
      if (institution){
        context.institutionFullName = institution.get('fullName');
      }
      context.fieldsOfResearch = this.collection.toJSON();
    }
    html.push(this.template(context));
    this.$el.html(html);
    return this;
  },
  hide: function(){
    this.$el.html('');
  },
  log: function() {
    console.log("this.collection: " + this.collection);
  }
});
