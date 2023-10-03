<?php

namespace class;

require_once 'Sequence.class.php';

#DNA Sequence class
class DNASeq extends Sequence
{
    #Supported values of DNA
    const SUPPORTED_VALUES = 'AGCT';

    /**
     * Constructor of DNASeq class
     * @param $sequence - DNA Sequence
     */
    public function __construct(string $sequence = NULL)
    {
        parent::__construct('DNA', $sequence, self::SUPPORTED_VALUES);
    }

    /**
     * Method toString of DNASeq class
     */
    public function __toString(): string
    {
        return sprintf("%s; type='DNA'; valid_values=%s}",
            parent::__toString(),
            parent::getSupportedValues());
    }

    /**
     * Method trasncription to pass DNASeq to RNA
     * @return $objRNASeq - Object type RNASeq with RNA Sequence
     */
    public function transcription()
    {
        $RNASeq = str_replace('T', 'U', parent::getSequence());
        $objRNASeq = new RNASeq($RNASeq);

        return $objRNASeq;
    }
}

?>
