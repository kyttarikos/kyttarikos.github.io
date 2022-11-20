<!DOCTYPE html>
<html>

<head>
    <title>ICT 9 Q1PTASK - INTEGRATED PTASK (Q1 Group 2)</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Montserrat"> <!-- custom fonts via Google Fonts API -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- meta viewport for compatibility -->

    <script src="index.js"></script>
    <link rel="stylesheet" href="main.css">
    <!-- CSS and JS to avoid longer PHP code -->
</head>

<body>
    <?php
      $disableSubmission = true; // single-variable handler to check if there are missing options
      $nameReq = "";
      $name = "";

      $q1_req = "";
      $q1 = "";
      $q2_req = "";
      $q2 = "";
      $q3_req = "";
      $q3 = "";
      $q4_req = "";
      $q4 = "";
      $q5_req = "";
      $q5 = "";

      $surveyData = "";
      $fieldRequired = "This field is required.";
// define all variables to empty strings for definition checks
      $disableButton = false;

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
          $disableSubmission = true;
        } else {
          $disableSubmission = false;
          $name = $_POST["name"];
        };

        if (empty($_POST["question1"])) {
          $disableSubmission = true;
        } else {
          $disableSubmission = false;
          $q1 = $_POST["question1"];
        };
        if (empty($_POST["question2"])) {
          $disableSubmission = true;
        } else {
          $disableSubmission = false;
          $q2 = $_POST["question2"];
        };
        // question 3, dependent to question 2
        if ($_POST["question2"] == "Yes, I have" && empty($_POST["question3"])) {
          $disableSubmission = true;
        } else {
          $disableSubmission = false;
          if ($_POST["question2"] == "No, I haven't") {
            $q3 = " ";
            $_POST["question3"] = " ";
          } else {
            $q3 = $_POST["question3"];
          }
        }
        if (empty($_POST["question4"])) {
          $disableSubmission = true;
        } else {
          $disableSubmission = false;
          $q4 = $_POST["question4"];
        };
        if (empty($_POST["question5"])) {
          $disableSubmission = true;
        } else {
          $disableSubmission = false;
          $q5 = $_POST["question5"];
        };
      };
if (empty($_POST["name"]) || empty($_POST["question1"]) || empty($_POST["question2"]) || empty($_POST["question3"]) || empty($_POST["question4"]) || empty($_POST["question5"])) {
  $disableSubmission = true;
}

?>
    <div class="formBorder" style="border-radius: 10px 10px 0 0;">
        <?php
// starting page; switches 'main welcome survey' to 'thanks for answering' when submit event is called
if (!$disableSubmission) {
  $disableButton = true;
  echo '<h1 style="color:#45ff99">Thank you for answering our survey! <span class="required"><u>Please read the important info below.</u></span></h2>';
  echo "<h3 style='color:#45ff99'>Thank you for taking the time to answer! Please press <span class='required'><b><u>Copy summary to clipboard</u></b></span> to copy your answers and please send the copied text to the person who sent this survey to you; <span class='required'><b><u>YOUR SURVEY DATA WILL NOT BE SAVED BY THE WEBSITE.</u></b></span> Once again, thank you!<br><br>&nbsp;&nbsp;- ICT 9 Q1 Group 2</h3>";
  echo "<br>";
  echo '<button style="float:left;" type="button" onclick="cbCopy()" style="width:17vw;" id="copyButton">📋 Copy summary to clipboard</button>';
  echo "</div>";
  echo "<hr>";
  echo '<div class="formBorder">';
  echo '<h1>Summary:</h1>';
  // summary
if ($name == "" || $q2 == "" || $q3 == "" || $disableSubmission) {
  echo "<div class='formBorder'>";
  echo "<textarea rows='20' cols='60' id='surveyData' readonly>Not enough data! Submit the survey with your answers and we'll show you the summary.</textarea>";
} else {
  $data = "What is your name?\n-- " . $name . "\n\n1. What are the diseases you and your neighborhood experienced; affecting the respiratory system?\n-- " . $q1 . "\n\n2. Have you suffered from an injury before?\n-- " . $q2 . "\n\n3. What type of injuries did you suffer?\n-- " . $q3 . "\n\n4. In a situation, how would you manage an injury?\n-- " . $q4 . "\n\n5. What ways can you suggest to maintain a healthy and well-balanced lifestyle?\n-- " . $q5;
  
  $surveyData = $data;
  echo "<textarea rows='20' cols='60' id='surveyData' readonly>" . $data . "</textarea>";
  echo "<input type='hidden' id='surveyData' value='" . $surveyData . "'>"; // also dropped in a hidden input for clipboard copy to work
  echo "</div>";
  };
} else {
  // entrance
  echo '<h1>Community Health & Unintentional / Intentional Injuries</h1>';
  echo '<br>';
  echo '<p>We, as speakers and students of Q1 Group 2, are here to provide you a survey revolved around:</p>';
  echo '<ul>';
  echo '<li>community health;</li>';
  echo '<li>environmental health; and</li>';
  echo '<li>unintentional/intentional injuries.</li>';
  echo '</ul>';
  echo '<p>We appreciate you for taking the time to have a read and to fill out our survey! :)</p>';
  echo '<br>';
  echo "<p class='required'>All items have a * symbol, meaning it's all required to fill out.</p>";
}
?>
    </div>
    <hr>
    <div class='formBorder'>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <p>What is your name? <span class="required">*</span></p>
            <input type="text" name="name" placeholder="John Doe" <?php echo isset($_POST['name']) ? "value='{$_POST["name"]}' ready" : '' ?> required oninvalid="this.setCustomValidity('Please write your name.')" onchange="this.setCustomValidity('')">
            <!-- "'{$_POST["name"]}'  0" -:: to lock in answers when submitting the survey, disallowing the user to modify their answers as soon as the form is submitted (only temporary, a refresh or a new tab bypasses it somehow) -->
            <br>
            <br>
            <p>1. What are the diseases you and your neighborhood experienced; affecting the respiratory system? <span class="required">*</span>
            </p>
            <input type="text" name="question1" <?php echo isset($_POST['question1']) ? "value='{$_POST["question1"]}' readonly" : '' ?> required oninvalid="this.setCustomValidity('This question is required.')" onchange="this.setCustomValidity('')">
            <br>
            <br>
            <p>2. Have you suffered from an injury before? <span class="required">*</span> </p>

            <?php
              $radio1 = "";
              $radio2 = "";
              
              if (isset($_POST["question2"])) {
                if ($_POST["question2"] == "Yes, I have") {
                  $radio1 = "checked";
                  $radio2 = "disabled";
                } else {
                  $radio2 = "checked";
                  $radio1 = "disabled";
                }
              };
              // check which radio is selected, so that the unselected one will be unselectable in the summary page
            ?>

            

            <input type="radio" name="question2" value="Yes, I have" id="q2-yes" required <?php echo $radio1 ?>>
          Yes, I have&emsp;&emsp;

            <input type="radio" name="question2" value="No, I haven't" id="q2-no" <?php echo $radio2 ?>>
          No, I haven't
            <br>
            <br>
            <p>3. If your previous answer was " <b>Yes</b>", what type of injuries did you suffer? If your previous answer was " <b>No</b>", please type X. <span class="required">*</span>
            </p>
            <input type="text" name="question3" <?php echo isset($_POST['question3']) ? "value='{$_POST["question3"]}' readonly" : '' ?> required>
            <br>
            <br>
            <p>4. In a situation, how would you manage an injury? <span class="required">*</span>
            </p>
            <textarea name="question4" rows="10" cols="50" placeholder="The way to manage an injury is..." required  <?php echo isset($_POST['question4']) ? "readonly" : '' ?>><?php echo isset($_POST['question4']) ? "{$_POST['question4']}" : '' ?></textarea>
            <br>
            <br>
            <p>5. What ways can you suggest to maintain a healthy and well-balanced lifestyle? <span class="required">*</span>
            </p>
            <textarea name="question5" rows="10" cols="50" placeholder="I can suggest that..." required  <?php echo isset($_POST['question4']) ? "readonly" : '' ?>><?php echo isset($_POST['question5']) ? $_POST['question5'] : '' ?></textarea>
            <br>
            <br>
            <br>
            <input type="submit" name="submit" value="📥 Submit survey" <?php echo $disableButton ? 'disabled="disabled"' : '' ?>>
            <!--- $disableButton ? 'disabled="disabled"' -:: disables the Submit button whenever the form has been submitted --->
            <?php
?>
            <br>
            <br>
        </form>
    </div>
    <hr>
    <footer>
        <!--- footer --->
        <div class="footerBorder">
            <p>Made with PHP and 💖</p>
            <hr>
            <p>Made by ICT Q1 Group 2 of CDSI Grade 9 St. Stephen (SY 2022 - 2023)</p>
        </div>
    </footer>
</body>

</html>
