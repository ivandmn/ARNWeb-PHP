<?php

namespace class;

require_once 'Sequence.class.php';

#RNA Seq
class RNASeq extends Sequence
{
    #Supported values of RNA Sequence
    const SUPPORTED_VALUES = 'ACGU';
    #Values to transalte RNA to Protein
    const translation = [
        'UCA' => 'S',
        'UCC' => 'S',
        'UCG' => 'S',
        'UCU' => 'S',
        'UUC' => 'F',
        'UUU' => 'F',
        'UUA' => 'L',
        'UUG' => 'L',
        'UAC' => 'Y',
        'UAU' => 'Y',
        'UAA' => 'Stop',
        'UAG' => 'Stop',
        'UGC' => 'C',
        'UGU' => 'C',
        'UGA' => 'Stop',
        'UGG' => 'W',
        'CUA' => 'L',
        'CUC' => 'L',
        'CUG' => 'L',
        'CUU' => 'L',
        'CCA' => 'P',
        'CCC' => 'P',
        'CCG' => 'P',
        'CCU' => 'P',
        'CAC' => 'H',
        'CAU' => 'H',
        'CAA' => 'Q',
        'CAG' => 'Q',
        'CGA' => 'R',
        'CGC' => 'R',
        'CGG' => 'R',
        'CGU' => 'R',
        'AUA' => 'I',
        'AUC' => 'I',
        'AUU' => 'I',
        'AUG' => 'M',
        'ACA' => 'T',
        'ACC' => 'T',
        'ACG' => 'T',
        'ACU' => 'T',
        'AAC' => 'N',
        'AAU' => 'N',
        'AAA' => 'K',
        'AAG' => 'K',
        'AGC' => 'S',
        'AGU' => 'S',
        'AGA' => 'R',
        'AGG' => 'R',
        'GUA' => 'V',
        'GUC' => 'V',
        'GUG' => 'V',
        'GUU' => 'V',
        'GCA' => 'A',
        'GCC' => 'A',
        'GCG' => 'A',
        'GCU' => 'A',
        'GAC' => 'D',
        'GAU' => 'D',
        'GAA' => 'E',
        'GAG' => 'E',
        'GGA' => 'G',
        'GGC' => 'G',
        'GGG' => 'G',
        'GGU' => 'G'
    ];

    /**
     * Constructor of RNASeq class
     * @param $sequence - RNA Sequence
     */
    public function __construct(string $sequence = NULL)
    {
        parent::__construct('RNA', $sequence, self::SUPPORTED_VALUES);
    }

    /**
     * Method toString of RNASeq class
     */
    public function __toString(): string
    {
        return sprintf("%s; type='RNA'; valid_values=%s}",
            parent::__toString(),
            parent::getSupportedValues());
    }

    /**
     * Method trasncription to pass RNASeq to DNA
     * @return $objDNASeq  - Object type DNASeq with DNA Sequence
     */
    public function transcription()
    {
        $DNASeq = str_replace('U', 'T', parent::getSequence());
        $objDNASeq = new DNASeq($DNASeq);
        return $objDNASeq;
    }

    /**
     * Method translation to pass RNASeq to protein
     * @param $seqTranslation - Sequence to translate
     * @param $protein - 3 letters of RNA to save a protein
     * @return $proteinSequence - Return protein string
     */
    public function translation()
    {
        $seqTranslation = parent::getSequence();
        $proteinSequence = "";
        $protein = "";
        for ($a = 0; $a < strlen($seqTranslation); $a += 3) {
            $protein = substr($seqTranslation, $a, 3);
            $proteinSequence = $proteinSequence . self::translation[$protein];

        }
        return $proteinSequence;
    }

}

?>
