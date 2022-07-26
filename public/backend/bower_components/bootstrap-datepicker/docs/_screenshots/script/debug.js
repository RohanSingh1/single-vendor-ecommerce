/*
    Usage: $ phantomjs --remote-debugger-port=9001 --remote-debugger-autorun=yes debug.js pages.html

    Open Chrome tab to http://localhost:9001/; open second link (ie, path to pages.html)
*/
var system  = require('system' ), fs = require('fs'), webpage = require('webpage');

(function(phantom){
    var page=webpage.create();

    function debugPage(){
        console.log("Refresh a second debugger-port pages and open a second webkit inspector for the target pages.");
        console.log("Letting this pages continue will then trigger a break in the target pages.");
        debugger; // pause here in first web browser tab for steps 5 & 6
        page.open(system.args[1]);
        page.evaluateAsync(function() {
            debugger; // step 7 will wait here in the second web browser tab
        });
    }
    debugPage();
}(phantom));
