<?php

declare(strict_types=1);

/* For licensing terms, see /license.txt */

namespace Chamilo\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CQuizRelQuestion.
 *
 * @ORM\Table(
 *     name="c_quiz_rel_question",
 *     indexes={
 *         @ORM\Index(name="question", columns={"question_id"}),
 *         @ORM\Index(name="exercise", columns={"quiz_id"})
 *     }
 * )
 * @ORM\Entity
 */
class CQuizRelQuestion
{
    /**
     * @ORM\Column(name="iid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected int $iid;

    /**
     * @ORM\Column(name="question_order", type="integer", nullable=false)
     */
    protected int $questionOrder;

    /**
     * @ORM\ManyToOne(targetEntity="CQuizQuestion", inversedBy="relQuizzes", cascade={"persist"})
     * @ORM\JoinColumn(name="question_id", referencedColumnName="iid", onDelete="CASCADE")
     */
    #[Assert\NotBlank]
    protected CQuizQuestion $question;

    /**
     * @ORM\ManyToOne(targetEntity="CQuiz", inversedBy="questions", cascade={"persist"})
     * @ORM\JoinColumn(name="quiz_id", referencedColumnName="iid", onDelete="CASCADE")
     */
    #[Assert\NotBlank]
    protected CQuiz $quiz;

    public function setQuestionOrder(int $questionOrder): self
    {
        $this->questionOrder = $questionOrder;

        return $this;
    }

    public function getQuestion(): CQuizQuestion
    {
        return $this->question;
    }

    public function setQuestion(CQuizQuestion $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get questionOrder.
     *
     * @return int
     */
    public function getQuestionOrder()
    {
        return $this->questionOrder;
    }

    public function getQuiz(): CQuiz
    {
        return $this->quiz;
    }

    public function setQuiz(CQuiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }
}
