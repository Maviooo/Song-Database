<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SongRepository::class)
 */
class Song
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    *  @ORM\Column(type="text", length=100)
    */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $artist;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="integer")
     */
    private $bpm;

    /**
     * @ORM\Column(type="text")
     */
    private $chords;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title;
    }

    public function getBody() {
        return $this->body;
    }
    public function setBody($body) {
        $this->body = $body;
    }

    public function getArtist() {
        return $this->artist;
    }
    public function setArtist($artist) {
        $this->artist = $artist;
    }

    public function getBpm() {
        return $this->bpm;
    }
    public function setBpm($bpm) {
        $this->bpm = $bpm;
    }

    public function getChords() {
        return $this->chords;
    }
    public function setChords($chords) {
        $this->chords = $chords;
    }
}
