<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Move
 *
 * @ORM\Table(name="move", indexes={@ORM\Index(name="game", columns={"game"})})
 * @ORM\Entity
 */
class Move
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="num", type="integer", nullable=false)
     */
    private $num;

    /**
     * @var int
     *
     * @ORM\Column(name="color", type="integer", nullable=false)
     */
    private $color;

    /**
     * @var \Game
     *
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="game", referencedColumnName="id")
     * })
     */
    private $game;


}
