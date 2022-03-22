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
            $DNASequence = ""; $RNASequence = ""; $enterDNA = ""; $validDNA = ""; $DNAError = true;
            if (isset($_POST['DNASubmit'])) {
                if ($_POST['DNASeq'] != "") {
                    $DNASequence = filter_var($_POST['DNASeq'], FILTER_SANITIZE_STRING);
                    if(filter_var($DNASequence,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[agctAGCT]+$/")))){
                        $DNAError = false;
                        $enterDNA = "";
                        $validDNA = "";
                    }
                    else{
                        $DNAError = true;
                        $validDNA = "DNA Sequence format not valid";
                        $RNASequence = "";
                    }
                }
                else {
                    $DNAError = true;
                    $enterDNA = "Please enter a DNA Sequence";
                    $RNASequence = "";
                }
        
            }

            $randomDNAlength; $randomDNASequenceText = "";
            if (isset($_POST['RandomDNA'])) {
                if ($_POST['RandomDNAInput'] != "") {
                    $randomDNAlength = $_POST['RandomDNAInput']; 
                    $randomDNASequenceText = Sequence::generateRandomSequence('AGCT',$randomDNAlength);
                    $DNASequence = $randomDNASequenceText;
                    $DNAError = false;
        
                }
                else{

                }
            }
            
            if($DNAError == false){
                 $DNASequence = strtoupper($DNASequence);
                 $objectDNASequence =  new DNASeq($DNASequence);
                 $objectRNASequence = $objectDNASequence->transcription();
                 $RNASequence = $objectRNASequence->getSequence();
                 echo '<style>#fieldsetRNAOutput { display:block;}</style>';
            }
            else{
                echo '<style>#fieldsetRNAOutput { display:none;}</style>';   
            }
        ?>
        <form method='POST' action="<?php echo \htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset id="fieldsetDNA">
                    <legend>DNA to RNA</legend>
                    <div id="DNAInput">
                        <label class = "DNAElements">DNA Sequence:</label>
                        <textarea class = "DNAElements" id="inputDNA" rows="8" cols="160" type="text" name="DNASeq" placeholder="Type DNA Sequence"><?php echo $randomDNASequenceText?></textarea>
                        <div class = "RanDNAInput">
                            <input type="number" min="1" name ="RandomDNAInput" id = "RandomDNAInput" placeholder="Type sequence length"></input>
                        </div>
                        <button class = "RanDNAInput" id="RandomDNA" name="RandomDNA">Generate Random DNA Sequence</button> 
                        <button id="DNASubmit" name="DNASubmit">Submit</button>
                    </div>
                    <a class = "DNAElements error"><?php echo $enterDNA?></a>
                    <a class = "DNAElements error" ><?php echo $validDNA?></a>
                </fieldset>
                <fieldset id="fieldsetRNAOutput">
                    <legend> Result </legend>
                    <textarea disabled rows="8" cols="160" class = "DNAElements"><?php echo $RNASequence?></textarea>
                </fieldset>
        </form>
    </body>
</html>