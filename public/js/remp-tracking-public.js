(function(win, doc) {
    function mock(fn) {
        return function() {
            this._.push([fn, arguments])
        }
    }
    function load(url) {
        var script = doc.createElement("script");
        script.type = "text/javascript";
        script.async = true;
        script.src = url;
        doc.getElementsByTagName("head")[0].appendChild(script);
    }
    win.remplib = win.remplib || {};
    var mockFuncs = {
        "campaign": "init",
        "tracker": "init trackEvent trackPageview trackCommerce",
        "iota": "init"
    };

    Object.keys(mockFuncs).forEach(function (key) {
        if (!win.remplib[key]) {
            var fn, i, funcs = mockFuncs[key].split(" ");
            win.remplib[key] = {_: []};

            for (i = 0; i < funcs.length; i++) {
                fn = funcs[i];
                win.remplib[key][fn] = mock(fn);
            }
        }
    });
    
    // change URL to location of BEAM remplib.js
    load(remp_vars.remp_tracking_beam_url + "/assets/lib/js/remplib.js");
})(window, document);

// configuration
var rempConfig = {
    // UUIDv4 based REMP BEAM token of appropriate property
    // (see BEAM Admin -> Properties)
    token: remp_vars.remp_tracking_property_token,
    
    // optional, identification of logged user
    userId: !!remp_vars.user_id,
    
    // optional, flag whether user is currently subscribed to the displayed content 
    // userSubscribed: Boolean,
    
    // optional, controls where cookies (UTM parameters of visit) are stored
    cookieDomain: remp_vars.remp_cookie_domain,
            
    // required, Tracker API specific options          
    tracker: {
        // required, URL location of BEAM Tracker
        url: remp_vars.remp_tracking_tracking_url,
        
        // optional, article details if pageview is on the article
        article: {
            id: remp_vars.remp_post_id + "", // required, ID of article in your CMS
            author_id: remp_vars.remp_post_author, // optional, name of the author
            // category: String, // optional, category/section of the article
            // locked: Boolean, // optional, flag whether content was locked at the time of visit for this pageview
            // tags: [String, String, String] // optional, any tags associated with the article
        },
        
        // optional time spent measuring (default value `false`)
        // if enabled, tracks time spent on current page
        timeSpentEnabled: !!remp_vars.remp_tracking_timespan_enabled,
    },
};
console.log({ rempConfig });
remplib.tracker.init(rempConfig);