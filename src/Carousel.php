<?php

class Carousel {

    const JS_PATH = 'inc/Carousel.js';
    const CSS_PATH = 'inc/carousel.css';

    private $id;
    private $slides;
    private $o;
    
    /**
     * Constructor
     *
     * @param  Slide[] $slides Array of Slide objects (refe to Slide class for details on available properties)
     * @param  array{
     *    slidesVisible: int, 
     *    slidesToScroll: int, 
     *    infiniteScroll: int, 
     *    autoPlay: int
     * } $options Options for the carousel
     */
    public function __construct(
        array $slides, 
        array $options = [
            'slidesVisible' => 1,
            'slidesToScroll' => 1,
            'infiniteScroll' => 0,
            'autoPlay' => 0
        ]
    ) {
        $this->id = 'carousel'.uniqid();

        $this->slides = $slides;

        $this->o = $options;
        $this->o['infiniteScroll'] = $this->o['infiniteScroll'] ?? 'false' ?: (string)$this->o['infiniteScroll']; // conversion for js file
        $this->o['autoPlay'] = $this->o['autoPlay'] ?? 'false' ?: (string)$this->o['autoPlay']; // conversion for js file
    }
    
    /**
     * Show one carousel
     *
     * @param  bool $loadScripts Don't precise this parameter, as it is set by the 
     * Carousel::showAll() method only. | Default: true
     * @return void
     */
    public function show($loadScripts = true) {
        ?>
        <section id="<?= $this->id ?>" class="carousel">
            <div class="carousel-wrapper">
                <?php foreach($this->slides as $slide): ?>
                    <?php $slide->show() ?>
                <?php endforeach ?>
            </div>
            <div class="arrow left">
                <div class="arrow-line1 left"></div>
                <div class="arrow-line2 left"></div>
            </div>
            <div class="arrow right">
                <div class="arrow-line1 right"></div>
                <div class="arrow-line2 right"></div>
            </div>
        </section>
        <?php
        if($loadScripts) {
            $this->loadCss();
            $this->loadJs();
        }
        $this->initiateJsObject();
    }
    
    /**
     * Show several carousels at one
     *
     * @param  [Carousel] $carousels List of Carousel instances, spearated by comma.
     * @return void
     */
    public static function showAll(Carousel ...$carousels) {
        $i = 1;
        foreach($carousels as $carousel) {
            // load scripts only once, with the first carousel
            if($i === 1) {
                $carousel->show(true);
            } else {
                $carousel->show(false);
            }
            $i++;
        }
    }

    private function loadCss() {
        ?>
        <style>
            <?php require_once self::CSS_PATH ?>
        </style>
        <?php
    }

    private function loadJs() {
        ?>
        <script>
            <?php require_once self::JS_PATH ?>
        </script>
        <?php
    }

    private function initiateJsObject() {
        // prepare variables for js script
        $slidesIds = [];
        foreach($this->slides as $slide) {
            $slidesIds[] = $slide->getId();
        }
        $objectOptions = [];
        foreach($this->o as $optionName => $option) {
            $objectOptions[] = $optionName . ': ' . $option;
        }
        $objectOptions = implode(', ', $objectOptions);
        // add script to HTML
        ?>
        <script>
            new Carousel(
                "<?= $this->id ?>",
                ["<?= implode('", "', $slidesIds) ?>"],
                { <?= $objectOptions ?> }
            )
        </script>
        <?php
    }

}