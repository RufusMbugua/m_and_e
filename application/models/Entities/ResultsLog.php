<?php

namespace models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResultsLog
 *
 * @Table(name="results_log", indexes={@Index(name="results_assessee_idx", columns={"assessee_id"}), @Index(name="results_questions_idx", columns={"question_id"})})
 * @Entity
 */
class ResultsLog
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="response", type="string", length=45, nullable=true)
     */
    private $response;

    /**
     * @var \Assessees
     *
     * @ManyToOne(targetEntity="Assessees")
     * @JoinColumns({
     *   @JoinColumn(name="assessee_id", referencedColumnName="id")
     * })
     */
    private $assessee;

    /**
     * @var \Questions
     *
     * @ManyToOne(targetEntity="Questions")
     * @JoinColumns({
     *   @JoinColumn(name="question_id", referencedColumnName="id")
     * })
     */
    private $question;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set response
     *
     * @param string $response
     *
     * @return ResultsLog
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set assessee
     *
     * @param \Assessees $assessee
     *
     * @return ResultsLog
     */
    public function setAssessee(\Assessees $assessee = null)
    {
        $this->assessee = $assessee;

        return $this;
    }

    /**
     * Get assessee
     *
     * @return \Assessees
     */
    public function getAssessee()
    {
        return $this->assessee;
    }

    /**
     * Set question
     *
     * @param \Questions $question
     *
     * @return ResultsLog
     */
    public function setQuestion(\Questions $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Questions
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
