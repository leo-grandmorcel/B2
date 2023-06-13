<?php

Class Song {
    public string  $artist;
    public string $title;
    public string $duration;
    public function __construct(string $artist, string $title, string $duration){
        $this->artist = $artist;
        $this->title = $title;
        $this->duration = $duration;
    }
    public function getArtist() : string {
        return $this->artist;
    }
    public function getTitle() : string {
        return $this->title;
    }
    public function getDuration() : string {
        return $this->duration;
    }
    public function setArtist(string $artist) : self {
        $this->artist = $artist;
        return $this;
    }
    public function setTitle(string $title) : self {
        $this->title = $title;
        return $this;
    }
    public function setDuration(string $duration) : self {
        $this->duration = $duration;
        return $this;
    }
}

Class Playlist{
    public $songs = [];
    public int $totalMedias;
    public function addMedia(Song $song) : self{
        $this->songs[] = $song;
        $this->totalMedias = count($this->songs);
        return $this;
    }
    public function __toString() : string{
        $playlistLength = 0;
        foreach ($this->songs as $song){
            $duration = explode(":",$song->getDuration());
            $playlistLength += intval($duration[0])*60 + intval($duration[1]);
        }
        $hours = floor($playlistLength/3600);
        $playlistLength = $playlistLength%3600;
        $playlistLength = $hours . "h " . floor($playlistLength/60) . "m " . $playlistLength%60 . "s";
        return "Songs added: ". $this->totalMedias. "\n Playlist length: ". $playlistLength;
    }
}

class App {
    public array $content = [];
    public function getContent() : array {
        return $this->content;
    }
    public function start() : self{
        $playlist = new Playlist();
        foreach ($this->readLine(true) as $line){
            $song = explode(";", $line);
            $playlist->addMedia(new Song($song[0], $song[1], $song[2]));
        }
        $this->write($playlist->__toString());
        return $this;
    }
    public function setContent(array $content) : self{
        $this->content = $content;
        return $this;
    }
    private function readLine(bool $asArray = false): array|bool|string
    {
        ob_start();

        echo implode("", $this->getContent());

        $data = ob_get_contents();
        if ($asArray) {
            $data = explode("\n", ob_get_contents());
        }

        ob_clean();

        return $data;
    }
    public function write(string $newLine){
        echo $newLine;
    }
}
