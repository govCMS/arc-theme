<?php
/**
 * @file
 * Page layout template.
 */
?>
<!DOCTYPE html>
<!--[if IEMobile 7]>
<html class="iem7" <?php print $html_attributes; ?>><![endif]-->
<!--[if lte IE 6]>
<html class="lt-ie9 lt-ie8 lt-ie7" <?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]>
<html class="lt-ie9 lt-ie8" <?php print $html_ttributes; ?>><![endif]-->
<!--[if IE 8]>
<html class="lt-ie9" <?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!-->
<html <?php print $html_attributes . $rdf_namespaces; ?>><!--<![endif]-->
<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <!-- Special styles -->
  <link href="<?php print $path_to_arc; ?>/resources/css/scoped-twbs.min.css" rel="stylesheet">
  <link href="<?php print $path_to_arc; ?>/resources/css/wcag.css" rel="stylesheet">
  <link href="<?php print $path_to_arc; ?>/resources/css/main.css" rel="stylesheet">
  <!-- Special javascripts -->
  <script type="text/javascript" src="<?php print $path_to_arc; ?>/resources/js/vendor/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="<?php print $path_to_arc; ?>/resources/js/vendor/handlebars-v3.0.3.js"></script>
  <script type="text/javascript" src="<?php print $path_to_arc; ?>/resources/js/vendor/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php print $path_to_arc; ?>/resources/js/vendor/underscore-min.js"></script>
  <script type="text/javascript" src="<?php print $path_to_arc; ?>/resources/js/vendor/backbone-min.js"></script>
</head>
<body<?php print $attributes; ?>>
<?php print $page_top; ?>
<?php print $page; ?>
<?php print $page_bottom; ?>

<script id="searchQuery-template" type="text/x-handlebars-template">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-default {{#if searchQuery.institutionSearch}}active{{/if}}" aria-pressed="true">
          <input type="radio" name="options" id="institutionSearchOption" autocomplete="off" checked>List by Institution
        </label>
        <label class="btn btn-default {{#unless searchQuery.institutionSearch}}active{{/unless}}" aria-pressed="false">
          <input type="radio" name="options" id="forCodeSearchOption" autocomplete="off"> List by Fields of Research (FoR) code
        </label>
      </div>
    </div>
  </div>
  <div style="height:3em;"></div>
  <div class="row">
    <div class="form-group col-md-8 col-md-offset-2">
      {{#if searchQuery.institutionSearch}}
      <label for="institutionSelector">Institution</label>
      {{> institutionSelector institutions=institutionList}} {{else}}
      <label for="forCodeSelector">Fields of Research</label>
      {{> forCodeSelector forCodes=forCodeList}} {{/if}}
    </div>
  </div>
</script>
<script id="institutionSelector-template" type="text/x-handlebars-template">
  <select id="institutionSelector" class="form-control">
    {{#each institutions}}
    {{option ShortName FullName ../searchQuery.institution}}
    {{/each}}
  </select>
</script>
<script id="forCodeSelector-template" type="text/x-handlebars-template">
  <select id="forCodeSelector" class="form-control">
    {{#each forCodes}}
    {{option id label ../searchQuery.forCode}}
    {{/each}}
  </select>
</script>
<script id="field-of-research-outcome-template" type="text/x-handlebars-template">
  <div class="row">
    {{#if institutions}}
    <div class="col-md-8 col-md-offset-2">
      <h2>{{fieldOfResearch.FoRCode}} - {{fieldOfResearch.FoRTitle}}</h2>
      <table
        title="ERA ratings for {{fieldOfResearch.FoRTitle}}"
        summary="Table of ERA ratings for the {{fieldOfResearch.FoRCode}} - {{fieldOfResearch.FoRTitle}} Fields of Research code, listed by institution."
        class="table table-bordered">
        <thead>
        <tr>
          <th class="col-sm-9">
            Institution
          </th>
          <th class="col-sm-3">
            <a class="footnote-ref" aria-label="2010 Rating - click for footnote" href="#era2010note">2010 Rating</a>
          </th>
        </tr>
        </thead>
        <tbody id="outcomes-table-body">
        {{#each institutions}}
        {{#each institution.fieldsOfResearch}}
        <tr>
          <td><a href="#/Institution/{{../institution.shortName}}">{{../institution/fullName}}</a></td>
          {{#each outcomes.era2010}}
          <td data-year="2010" data-rating="{{rating}}" aria-label="ERA 2010 rating: {{rating}}">{{rating}}</td>
          {{/each}}
        </tr>
        {{/each}}
        {{/each}}
        </tbody>
      </table>
    </div>
    {{> footnotes}}
    {{else}}
    <div class="col-md-8 col-md-offset-2">
      <h3 class="text-center">Please select a Fields of Research code from the list above</h3>
    </div>
    {{/if}}


</script>
<script id="institution-outcome-template" type="text/x-handlebars-template">
  <div class="row">
    {{#if institution.fieldsOfResearch}}
    <div class="col-md-8 col-md-offset-2">
      <h2>{{institution.name}}</h2>
      <table
        title="ERA ratings for {{institution.name}}"
        summary="Table of ERA ratings for {{institution.name}}, listed by Fields of Research code."
        class="table table-striped table-bordered">
        <thead>
        <tr>
          <th class="col-sm-1">
            FoR
          </th>
          <th class="col-sm-8">
            Title
          </th>
          <th class="col-sm-3">
            <a class="footnote-ref" aria-label="2010 Rating - click for footnote" href="#era2010note">2010 Rating</a>
          </th>
        </tr>
        </thead>
        <tbody id="outcomes-table-body">
        {{#each institution.fieldsOfResearch}}
        <tr {{#eq code.length 2}}class="anzsrcDivisionCode"{{else}}class="anzsrcGroupCode"{{/eq}}>
        <td><a href="#/FoR/{{code}}">{{code}}</a></td>
        <td><a href="#/FoR/{{code}}">{{name}}</a></td>
        {{#each outcomes.era2010}}
        <td data-year="2010" data-rating="{{rating}}" aria-label="ERA 2010 rating: {{rating}}">{{rating}}</td>
        {{/each}}
        </tr>
        {{/each}}
        </tbody>
      </table>
    </div>
    {{> footnotes}}
    {{else}}
    <div class="col-md-8 col-md-offset-2">
      <h3 class="text-center">Please select an institution from the list above</h3>
    </div>
    {{/if}}
  </div>
</script>
<script id="footnote-partial" type="text/x-handlebars-template">
  <div class="row">
    <div id="footnotes" class="col-md-8 col-md-offset-2" role="contentinfo">
      <ol>
        <li id="era2010note">In ERA 2010 committees had different fields of research codes assigned to them compared with
          ERA 2012 and ERA 2015. Where a code was split and rated twice in two different committees the
          higher rating was chosen for the above table </li>
      </ol>
    </div>
  </div>
</script>
<script>
  jQuery( document ).ready(function() {
    var jq1_11_2 = jQuery.noConflict(true);
    (function($) {
      //ensure that the trim function exists
      if (!String.prototype.trim) {
        String.prototype.trim = function () {
          return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
        };
      }

      function getOutcomes() {
        return $.getJSON('<?php print $path_to_arc; ?>/resources/data/outcomes.json').then( function (outcomes, status, jqXHR) {
          //todo handle failure
          return outcomes;
        });
      }

      /**
       * Example:
       * {
     *      "InstitutionCode":02,
     *      "ShortName":"ANU",
     *      "FullName":"Australian National University"
     * }
       **/
      function getInstitutionNames() {
        return $.getJSON('<?php print $path_to_arc; ?>/resources/data/2010_Institutions.json').then( function (institutionNames, status, jqXHR) {
            //todo handle failure
            return institutionNames;
          },
          function (data, status, jqXHR) {
            console.log("get 2015_Institutions.json failed");
          });
      }

      /**
       * {
     *      "FoRCode":0405,
     *      "FoRTitle":"Oceanography"
     * },
       */
      function getFieldOfResearchNames() {
        return $.getJSON('<?php print $path_to_arc; ?>/resources/data/2015_ForCodes.json').then( function (fieldOfResearchNames, status, jqXHR) {
            //todo handle failure
            return fieldOfResearchNames;
          },
          function (data, status, jqXHR) {
            console.log("get 2015_ForCodes.json failed");
          });
      }

      $(document).ready(function(){
        setupHandlebars();

        var searchQuery = {
          institutionSearch: true, //other option is FoR search
          institution: '',
          forCode: ''
        };

        $.when(getOutcomes(), getInstitutionNames(), getFieldOfResearchNames() ).done(function( outcomes, institutionLookup, fieldOfResearchLookup ){

          var RouterConfig = Backbone.Router.extend({
            routes: {
              "Institution/(:inst)": "setInstitution",
              "FoR/(:code)": "setFieldOfResearch",
            },
            setInstitution: function(inst){
              searchQuery.institutionSearch = true;
              searchQuery.institution = inst;
              renderSearchQueryUI(searchQuery, institutionLookup, fieldOfResearchLookup);
              showInstitutionOutcomes(searchQuery.institution, outcomes, institutionLookup, fieldOfResearchLookup);
            },
            setFieldOfResearch: function (code) {
              searchQuery.institutionSearch = false;
              searchQuery.forCode = code;
              renderSearchQueryUI(searchQuery, institutionLookup, fieldOfResearchLookup);
              showFieldOfResearchOutcomes(searchQuery.forCode, outcomes, institutionLookup, fieldOfResearchLookup);
            },
          });

          var router = new RouterConfig();
          router.on("route", function () {
            $("html,body").scrollTop(0);
          });
          Backbone.history.start();
          renderSearchQueryUI(searchQuery, institutionLookup, fieldOfResearchLookup);

          //register search query events
          $("#searchQuery").on('change', 'input[name="options"]:radio', function(event) {
            searchQuery.institutionSearch = (event.target.id === 'institutionSearchOption');
            renderSearchQueryUI(searchQuery, institutionLookup, fieldOfResearchLookup);
            if (searchQuery.institutionSearch) {
              router.navigate("/Institution/" + (searchQuery.institution || ''), {trigger: true});
            }
            else {
              router.navigate("/FoR/" + (searchQuery.forCode || ''), {trigger: true});
            }

          });
          $('#searchQuery').on('change', 'select#institutionSelector', function(event) {
            searchQuery.institution = $('select#institutionSelector').val();
            router.navigate("/Institution/"+ searchQuery.institution, {trigger: true});
          });
          $('#searchQuery').on('change', 'select#forCodeSelector', function(event) {
            searchQuery.forCode=  $('select#forCodeSelector').val();
            router.navigate("/FoR/"+ searchQuery.forCode, {trigger: true});
          });

        });

      });

      function renderSearchQueryUI(searchQuery, institutionLookup, fieldOfResearchLookup){
        var searchQueryTemplate = Handlebars.compile($("#searchQuery-template").html());
        var institutionOptions = institutionLookup.slice();
        institutionOptions.unshift({ShortName:"",FullName:"   Select an institution   "});
        var forOptions = _.map(fieldOfResearchLookup, function(item) {return {id: item.FoRCode, label: item.FoRCode + ' - ' + item.FoRTitle};});
        forOptions.unshift({id:'', label:'Select a Fields of Research code'});
        $("#searchQuery").html(searchQueryTemplate({'searchQuery': searchQuery, 'institutionList': institutionOptions, 'forCodeList': forOptions}));
      }

      function showInstitutionOutcomes(institutionShortName, outcomes, institutionLookup, fieldOfResearchLookup){
        var html = [];
        var institutionOutcomeTemplate = Handlebars.compile($("#institution-outcome-template").html());
        var institutionOutcomes = [];
        var institution = _.find(institutionLookup, function(institution) {return institution.ShortName === institutionShortName} );
        if (institution){
          institutionOutcomes = _.find(outcomes.institutions, function(institutionOutcomes) {return institutionOutcomes.institution.code === institution.InstitutionCode;} );
          var institution = _.find(institutionLookup, function(institution) {return institution.InstitutionCode === institutionOutcomes.institution.code});
          institutionOutcomes.institution.name = institution.FullName;
          _.each(fieldOfResearchLookup, function(field) {
            var institutionFieldOfResearch = _.find(institutionOutcomes.institution.fieldsOfResearch, function(institutionField) {return institutionField.code.trim() === field.FoRCode})
            if (institutionFieldOfResearch){
              institutionFieldOfResearch.name = field.FoRTitle;
            }
            else {
              console.log("Could not find matching Fields of Research code outcome")
            }
          });
        }
        html.push(institutionOutcomeTemplate(institutionOutcomes));
        $('#outcomes').html(html);
      }

      function showFieldOfResearchOutcomes(fieldOfResearchCode, outcomes, institutionLookup, fieldOfResearchLookup){
        var html = [];
        var forOutcomeTemplate = Handlebars.compile($("#field-of-research-outcome-template").html());
        var filteredOutcomes = [];
        var fieldOfResearch = _.find(fieldOfResearchLookup, function(fieldOfResearch) {return fieldOfResearch.FoRCode === fieldOfResearchCode} );
        if (fieldOfResearch){
          var filteredOutcomes = _.map(outcomes.institutions, function(item){
            var picked = _.pick(item.institution.fieldsOfResearch, function(value, key, object){
              return value.code === fieldOfResearchCode;
            });
            var result = {institution: { code: item.institution.code } };
            result.institution.fieldsOfResearch = picked;
            return result;
          });
          // fill in the institution names
          _.each(filteredOutcomes, function(outcome) {
            var institution = _.findWhere(institutionLookup, {InstitutionCode: outcome.institution.code})
            outcome.institution.shortName = institution.ShortName;
            outcome.institution.fullName = institution.FullName;
          });
          //sort by full name
          filteredOutcomes = _.sortBy(filteredOutcomes, function(o){ return o.institution.fullName.toLowerCase(); });
        }
        html.push(forOutcomeTemplate({fieldOfResearch: fieldOfResearch, institutions: filteredOutcomes}));
        $('#outcomes').html(html);
      }

      function setupHandlebars(){
        Handlebars.registerPartial('institutionSelector', $('#institutionSelector-template').html());
        Handlebars.registerPartial('forCodeSelector', $('#forCodeSelector-template').html());
        Handlebars.registerPartial('footnotes', $('#footnote-partial').html());
        Handlebars.registerHelper('option', function(value, label, selectedValue) {
          var selectedProperty = value == selectedValue ? 'selected="selected"' : '';
          return new Handlebars.SafeString('<option value="' + value + '"' +  selectedProperty + '>' + label + "</option>");
        });
        Handlebars.registerHelper("debug", function(optionalValue) {
          console.log("Current Context");
          console.log("====================");
          console.log(this);

          if (optionalValue) {
            console.log("Value");
            console.log("====================");
            console.log(optionalValue);
          }
        });
        Handlebars.registerHelper('eq', function (value, test, options) {
          if (value === test) {
            return options.fn(this);
          } else {
            return options.inverse(this);
          }
        });

        $('#theme-selector').on('change', function(event){
          var selectedTheme = $('#theme-selector').val();
          $("#outcomes table").removeClass (function (index, css) {
            return (css.match (/\w*-theme/g) || []).join(' ');
          });
          $("#outcomes table").addClass(selectedTheme);
        })
      }
    })(jq1_11_2);
  });
</script>

</body>
</html>
