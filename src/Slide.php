<?php

require dirname(__DIR__, 1) . '/config.php';

class Slide
{

    const IMG_PATH = APP_PATH . 'img/slides/';
    const SHOW_DEFAULT_IMG = false;
    const DEFAULT_IMG_PATH = APP_PATH . 'img/slide-img-default.jpg';

    private $id;
    private $text;
    private $title;
    private $img;
    private $imgAlt;
    private $link;
    private $additionalClasses;

    public function __construct(
        string $text,
        ?string $title = null,
        ?string $img = null,
        ?string $link = null,
        ?string $imgAlt = null,
        ?string $additionalClasses = null
    ) {
        $this->id = 'slide' . uniqid();
        $this->text = $text;
        $this->title = $title;
        $this->img = $img;
        $this->link = $link;
        $this->imgAlt = $imgAlt;
        $this->additionalClasses = $additionalClasses;
    }

    // GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getImg()
    {
        if (null !== $this->img) {
            return self::IMG_PATH . $this->img;
        } elseif (self::SHOW_DEFAULT_IMG) {
            return self::DEFAULT_IMG_PATH;
        }
        return $this->img;
    }

    public function getImgAlt()
    {
        $img = $this->getImg();
        $imgStr = '';
        if (null !== $img) {
            $start = strrpos($img, '/') + 1;
            $end = strrpos($img, '.');
            $imgStr = substr($img, $start, $end - $start);
            $imgStr = str_replace(['-', '_', '/'], ' ', $imgStr);
            $imgStr = ucfirst($imgStr);
        }
        if (null === $this->imgAlt) {
            return $imgStr . ' - ' . $this->getTitle();
        }
        return $this->imgAlt;
    }

    public function getImgAltTag()
    {
        if (null !== $this->getImgAlt()) {
            return " alt='{$this->getImgAlt()}'";
        }
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getAdditionalClasses()
    {
        return $this->additionalClasses;
    }

    // METHODS

    public function show()
    {
?>
        <div class="slide" id="<?= $this->getId() ?>">
            <?php if (null !== $this->getLink()) : ?>
                <a href="<?= $this->getLink() ?>">
                <?php endif ?>
                <div class="slide-wrapper">

                    <?php if (null !== $this->getImg() || self::SHOW_DEFAULT_IMG) : ?>
                        <div class="slide-img-container">
                            <img class="slide-img <?= $this->getAdditionalClasses() ?>" src="<?= $this->getImg() ?>" <?= $this->getImgAltTag() ?>>
                        </div>
                    <?php endif ?>
                    <div class="content-container">
                        <?php if (null !== $this->getTitle()) : ?>
                            <h3 class="slide-title"><?= $this->getTitle() ?></h3>
                        <?php endif ?>
                        <p class="slide-text"><?= $this->getText() ?></p>
                    </div>
                </div>
                <?php if (null !== $this->link) : ?>
                </a>
            <?php endif ?>
        </div>
<?php
    }
}
