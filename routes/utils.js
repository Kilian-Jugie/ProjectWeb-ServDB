module.exports = {
 formatExecPhpError: function(error) {
    return "API ERROR: Error during PHP execution ! Details : <br>"+
            "Fatal: "+error.killed+"<br>"+
            "Error code: "+error.code+"<br>"+
            "Signal: "+error.signal+"<br>"+
            "Command-line: "+error.cmd+"<br>";
}
}