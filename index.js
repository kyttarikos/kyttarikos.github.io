function cbCopy() {
    var rawSurveyData = document.getElementById("surveyData");
    var copyButton = document.getElementById("copyButton");

    // alert(rawSurveyData.value) // testing
    rawSurveyData.select();
    if (!navigator.clipboard) { // new copy to clipboard not working for some devices; workaround if-else
        document.execCommand("copy");
    } else {
        navigator.clipboard.writeText(rawSurveyData.value);
    };
    copyButton.innerHTML = "✅ Copied!";
    setTimeout(function() {
        copyButton.innerHTML = "📋 Copy summary to clipboard";
    }, 3000); // change button name to "Copied" for 3.00 seconds
};
