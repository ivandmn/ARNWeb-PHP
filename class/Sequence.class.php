<?php
namespace class;

class Sequence
{

    private $sequenceType;
    private $sequence;
    private $supportedValues;

    /**
     * Constructor Sequence
     * @param $sequenceType - Type of sequence (ADN, ARN, Amino Acids)
     * @param $sequence - Sequence
     * @param $supportedValues - The values that sequence admits.
     */
    public function __construct(string $sequenceType = NULL, string $sequence = NULL, string $supportedValues = NULL)
    {
        $this->sequenceType = $sequenceType;
        $this->sequence = $sequence;
        $this->supportedValues = $supportedValues;
    }

    /**
     * Function to generate random sequence
     * @param $acceptedValues - Values that sequence admits.
     * @param $lenght - Length of sequence
     */
    public static function generateRandomSequence(string $acceptedValues, int $length): string
    {
        $seq = "";

        for ($i = 0; $i < $length; $i++) {
            $randomNumber = mt_rand(0, strlen($acceptedValues) - 1);
            $randomChar = $acceptedValues[$randomNumber];
            $seq .= $randomChar;
        }

        return $seq;
    }
    //Getters and Setters

    /**
     * Get the value of sequenceType
     */
    public function getSequenceType(): string
    {
        return $this->sequenceType;
    }

    /**
     * Set the value of sequenceType
     */
    public function setSequenceType(string $sequenceType)
    {
        $this->sequenceType = $sequenceType;
    }

    /**
     * Get the value of sequence
     */
    public function getSequence(): string
    {
        return $this->sequence;
    }

    /**
     * Set the value of sequence
     */
    public function setSequence(string $sequence)
    {
        $this->sequence = $sequence;
    }

    /**
     * Get the value of supportedValues
     */
    public function getSupportedValues(): string
    {
        return $this->supportedValues;
    }

    /**
     * Set the value of supportedValues
     */
    public function setSupportedValues(string $supportedValues)
    {
        $this->supportedValues = $supportedValues;
    }

    //To String
    public function __toString(): string
    {
        return sprintf("Sequence: {id=%s; elements=%s}",
            $this->sequenceType,
            $this->sequence,
            $this->supportedValues);
    }
}

?>
