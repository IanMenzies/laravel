$(document).ready(function() {
    var consentIsSet = "unknown";
    var cookieBanner = "#cookieBanner";
    var consentString = "cookieConsent=";

    // Get consent from cookie
    var cookies = document.cookie.split(";");
    for (var i = 0; i < cookies.length; i++) {
        var c = cookies[i].trim();
        if (c.indexOf(consentString) == 0) {
            consentIsSet = c.substring(consentString.length, c.length);
        }
    }

    function denyConsent() {
        console.log("Consent denied");
        $(cookieBanner).text("You disallowed the use of cookies.");
        $(cookieBanner).fadeOut(5000);
        var d = new Date();
        var exdays = 30*12; //  1 year
        d.setTime(d.getTime()+(exdays*24*60*60*1000));
        var expires = "expires="+d.toGMTString();
        document.cookie = consentString + "false; " + expires + ";path=/";
        consentIsSet = "false";
    }

    // Set the cookie and run the consent code
    function setCookie() {
        if (consentIsSet == "true") return;

        console.log("Setting the cookie");
        $(cookieBanner).text("Thank you for accepting cookies.");
        $(cookieBanner).fadeOut(5000);
        var d = new Date();
        var exdays = 30*12; //  1 year
        d.setTime(d.getTime()+(exdays*24*60*60*1000));
        var expires = "expires="+d.toGMTString();
        document.cookie = "cookieConsent=true; " + expires +"; path=/";
        consentIsSet = "true";

        doConsent();
    }

    // Run the consent code
    function doConsent() {
        console.log("Consent was granted");
        // Currently only one function call, in the future there might be more
        analytics();
    }

    // Sample usage for doConsent(), which is adding Google Analytics data
    // Change to match your analytics code
    function analytics() {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-752819-15', 'cfenollosa.com');
        ga('send', 'pageview');

    }

    if (consentIsSet == "unknown") {    
        $(cookieBanner).fadeIn();
        // The two cases where consent is implicit: scrolling the window
        // or clicking a link

        // Don't set cookies on the "cookies page" on scroll
        var pageName = location.pathname.substr(location.pathname.lastIndexOf("/") + 1);

        if (pageName != "cookies.html") $(window).scroll(setCookie);
        $("a:not(.noconsent)").click(setCookie);
        $(".denyConsent").click(denyConsent);
        // allow re-enabling cookies
        $(".allowConsent").click(setCookie);
    } 
    else if (consentIsSet == "true") doConsent();

});


//Hide error messages after 5 seconds and remove div
$(document).ready(function() {
    setTimeout(function() {
            $('#errorMessages').delay(10000).fadeOut(400);
    });

    //if user clicks on message remove it
    $('#errorMessages').click(function() {
        $('#errorMessages').remove();
    });
});
