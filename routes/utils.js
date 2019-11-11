module.exports = {
 formatExecPhpError: function(error) {
    return "API ERROR: Error during PHP execution ! Details :\n"+
            "Fatal: "+error.killed+"\n"+
            "Error code: "+error.code+"\n"+
            "Signal: "+error.signal+"\n"+
            "Command-line: "+error.cmd+"";
}
}