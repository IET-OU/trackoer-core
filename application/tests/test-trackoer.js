/*
 Unit tests using Buster.js
 N.D.Freear, 16 August 2012.

 See: views/tests/busterjs_unit.php

 See: http://busterjs.org/docs/browser-testing/
 See: http://busterjs.org/examples/strftime/strftime-test.js
*/


//setTimeout(function() {

if (typeof require == "function" && typeof module == "object") {
    buster = require("buster");
    //require("./strftime");
}

var assert = buster.assert;

buster.testCase("buster.js: Custom Google Analytics tests", {
    setUp: function () {
		//this.date = new Date(2009, 11, 5);

		//console.log($("a[rel='dct:source']").attr('href'));
		//console.log($("img[src*='/track/r/piwik/']").attr('src'));

		//console.log($("img[src*='__utm.gif']").attr('src'));
		//console.log(window._gat, window._gat._getTracker);
		//console.log(window._gat._getTrackerByName()._getAccount());
    }


    , "DOM: document": function() {
		assert.isObject(document);
	}

// Google Analytics.
	// https://developers.google.com/analytics/resources/articles/gaTrackingTroubleshooting#gaDebug
	// http://stackoverflow.com/questions/1954910/javascript-detect-if-google-analytics-is-loaded-yet
	, "Google Analytics: _gat._getTracker() exists": function() {
		//NO! assert.isString($("img[src*='__utm.gif']").attr('src'));
		assert.isFunction(window._gat._getTracker);
	}

	, "Google Analytics: _gat..._getAccount() string": function() {
		assert.isString(window._gat._getTrackerByName()._getAccount());
		//Fail - why? assert.equals(window._gat._getTrackerByName()._getAccount(), /UA-\d+-\d+/);  /* /UA-\d{4,10}-\d{1,2}/); */
	}

// Piwik.
	, "Piwik no-JS web-beacon redirect: ../track/r/piwik/.. (-> ../piwik.php?..)": function() {
		assert.isString( $("img[src*='/track/r/piwik/']").attr('src') );
	}

// RDFa.
	, "RDFa: rel=license": function() {
	    assert.isString($("a[rel='license']").attr('href'));
	}

	, "RDFa: rel=dct:source": function() {
	    assert.isString($("a[rel='dct:source']").attr('href'));
	}

	, "RDFa: rel=dct:identifier": function() {
	    assert.isString($("a[rel='dct:identifier']").attr('href'));
	}

// trackoer-page-url.js
	, "trackoer-page-url.js: trackoer.getPageUrl() exists": function() {
	    assert.isFunction(trackoer.getPageUrl);
	}

	, "trackoer-page-url.js: trackoer.getPageUrl() string": function() {
	    assert.isString(trackoer.getPageUrl());
	}
});

//} , 1000);
