<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Game;
use App\Utils\Utilities;
/**
 * Pieces
 *
 * @ORM\Table(name="pieces", indexes={@ORM\Index(name="game", columns={"game"})})
 * @ORM\Entity
 */
class Pieces
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="color", type="integer", nullable=false)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="piece", type="string", length=1, nullable=false)
     */
    private $piece;

    /**
     * @var string
     *
     * @ORM\Column(name="coord", type="string", length=2, nullable=false)
     */
    private $coord;

    /**
     * @var \Game
     *
     * @ORM\ManyToOne(targetEntity="Game")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="game", referencedColumnName="id")
     * })
     */
    private $game;

    /**
     * @var int
     *
     * @ORM\Column(name="quit", type="integer", nullable=true)
     */
    private $quit;

    function __construct($game, $color, $piece, $coord, $doc){
        $this->id = Utilities::generateId(Pieces::class,'id', $doc);
        $this->game = $game;
        $this->color = $color;
        $this->piece = $piece;
        $this->coord = $coord;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getColor(): ?int
    {
        return $this->color;
    }

    public function setColor(int $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getPiece(): ?string
    {
        return $this->piece;
    }

    public function setPiece(string $piece): self
    {
        $this->piece = $piece;

        return $this;
    }

    public function getCoord(): ?string
    {
        return $this->coord;
    }

    public function setCoord(string $coord): self
    {
        $this->coord = $coord;

        return $this;
    }
    public function getQuit()
    {
        return $this->quit;
    }

    public function setQuit($q)
    {
        $this->quit = $q;
    }
    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

}
