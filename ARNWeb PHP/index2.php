<?php
    require_once 'class/Sequence.class.php';
    require_once 'class/DNA.class.php';
    require_once 'class/RNA.class.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Práctica PHP</title>
    <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
        <?php include_once "topNavBar.php";?>
        <?php
            $RNASequence = ""; $DNASequence = ""; $enterRNA = ""; $validRNA = ""; $RNAError = true;
            if (isset($_POST['RNASubmit'])) {
                if ($_POST['RNASeq'] != "") {
                    $RNASequence = filter_var($_POST['RNASeq'], FILTER_SANITIZE_STRING);
                    if(filter_var($RNASequence,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[agcuAGCU]+$/")))){
                        $RNAError = false;
                        $enterRNA = "";
                        $validRNA = "";
                    }
                    else{
                        $RNAError = true;
                        $validRNA = "RNA Sequence format not valid";
                        $DNASequence = "";
                    }
                }
                else {
                    $RNAError = true;
                    $enterRNA = "Please enter a RNA Sequence";
                    $DNASequence = "";
                }
        
            }

            $randomRNAlength; $randomRNAsequenceText = "";
            if (isset($_POST['RandomRNA'])) {
                if ($_POST['RandomRNAInput'] != "") {
                    $randomRNAlength = $_POST['RandomRNAInput']; 
                    $randomRNAsequenceText = Sequence::generateRandomSequence('AGCU',$randomRNAlength);
                    $RNASequence = $randomRNAsequenceText;
                    $RNAError = false;
                }
                else{

                }
            }
            
            if($RNAError == false){
                 $RNASequence = strtoupper($RNASequence);
                 $objectRNASequence =  new RNASeq($RNASequence);
                 $objectDNASequence = $objectRNASequence->transcription();
                 $DNASequence = $objectDNASequence->getSequence();
                 echo '<style>#fieldsetDNAOutput { display:block;}</style>';
            }
            else{
                echo '<style>#fieldsetDNAOutput { display:none;}</style>';   
            }
        ?>
        <form method='POST' action="<?php echo \htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset id="fieldsetRNA">
                    <legend>RNA to DNA</legend>
                    <div id="RNAInput">
                        <label class = "RNAElements">RNA Sequence:</label>
                        <textarea class = "RNAElements" id="inputRNA" rows="8" cols="160" type="text" name="RNASeq" placeholder="Type RNA Sequence"><?php echo $randomRNAsequenceText?></textarea>
                        <div class = "RanRNAInput">
                            <input type="number" min="1" name ="RandomRNAInput" id = "RandomRNAInput" placeholder="Type sequence length"></input>
                        </div>
                        <button class = "RanRNAInput" id="RandomRNA" name="RandomRNA">Generate Random RNA Sequence</button> 
                        <button id="RNASubmit" name="RNASubmit">Submit</button>
                    </div>
                    <a class = "RNAElements error"><?php echo $enterRNA?></a>
                    <a class = "RNAElements error" ><?php echo $validRNA?></a>
                </fieldset>
                <fieldset id="fieldsetDNAOutput">
                    <legend> Result </legend>
                    <textarea disabled rows="8" cols="160" class = "DNAElements"><?php echo $DNASequence?></textarea>
                </fieldset>
        </form>
    </body>
</html>