<?php
interface MediaPlayer {
  public function play($mediaType, $fileName);
}

interface AdvancedMediaPlayer {
  public function playVlc($fileName);
  public function playMp4($fileName);
}

class VlcPlayer implements AdvancedMediaPlayer {
  public function playVlc($fileName) {
    echo "Playing vlc file. Name: " . $fileName . "\n";
  }

  public function playMp4($fileName) {
    var_dump("play mp4 : "$fileName);
  }
}

class Mp4Player implements AdvancedMediaPlayer {
  public function playVlc($fileName) {
    var_dump("play vlc : "$fileName);
  }

  public function playMp4($fileName) {
    echo "Playing mp4 file. Name: " . $fileName . "\n";
  }
}

class MediaAdapter implements MediaPlayer {
  private $advancedMusicPlayer;

  public function __construct($audioType) {
    switch($audioType) {
      case 'vlc':
        $this->advancedMusicPlayer = new VlcPlayer();
        break;
      case 'mp4':
        $this->advancedMusicPlayer = new Mp4Player();
        break;
      default:
        throw new Exception("Invalid audio type");
    }
  }

  public function play($audioType, $fileName) {
    switch($audioType) {
      case 'vlc':
        $this->advancedMusicPlayer->playVlc($fileName);
        break;
      case 'mp4':
        $this->advancedMusicPlayer->playMp4($fileName);
        break;
      default:
        throw new Exception("Invalid audio type");
    }
  }
}

class AudioPlayer implements MediaPlayer {
  private $mediaAdapter;

  public function play($audioType, $fileName) {
    switch($audioType) {
      case 'mp3':
        echo "Playing mp3 file. Name: " . $fileName . "\n";
        break;
      case 'vlc':
      case 'mp4':
        $this->mediaAdapter = new MediaAdapter($audioType);
        $this->mediaAdapter->play($audioType, $fileName);
        break;
      default:
        throw new Exception("Invalid audio type");
    }
  }
}

$audioPlayer = new AudioPlayer();

$audioPlayer->play('mp3', 'song.mp3');
$audioPlayer->play('vlc', 'song.vlc');
$audioPlayer->play('mp4', 'song.mp4');
