<?php



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


}

