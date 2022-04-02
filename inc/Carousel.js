class Carousel {

    /**
     * Constructor
     * @param {number} id Auto-generated random ID for this carousel
     * @param {array} slidesIds Array containing all the slides I
     * @param {Object} options Options to customize the carousel
     * @param {number} options.slidesVisible How many slides are visible at once on the viewport?
     * @param {number} options.slidesToScroll How many images are scrolled when clicking laft or right arrows?
     * @param {boolean} options.infiniteScroll Should the carousel stop scrolling when the last (or the first) image is reached?
     */
    constructor(id, slidesIds, options) {
        this.container = document.querySelector("#"+id)
        this.slidesIds = slidesIds
        this.o = options
        // check options
        if(this.o.slidesToScroll > this.o.slidesVisible) this.this.o.slidesToScroll = this.o.slidesVisible
        // selectors
        this.slides = []
        this.slidesIds.forEach(id => {
            this.slides.push(this.container.querySelector('#'+id))
        })
        this.wrapper = this.container.querySelector('.carousel-wrapper')
        this.arrowLeft = this.container.querySelector('.arrow.left')
        this.arrowRight = this.container.querySelector('.arrow.right')
        // update DOM & responsiveness
        this.slidesNr = this.slides.length
        this.ss = this.slidesToScroll // dynamic value for slidesToScroll
        this.sv = this.slidesVisible // dynamic value for slidesVisible
        this.smallScreenBreakpoint = 700
        this.midScreenBreakpoint = 1100 
        this.setCarouselBasedOnScreenSize()
        window.addEventListener('resize', this.setCarouselBasedOnScreenSize.bind(this))
        this.setAdditionalStyle()
        // scroll
        this.slideIndex = 0
        this.arrowRight.addEventListener('click', this.scrollRight.bind(this))
        this.arrowLeft.addEventListener('click', this.scrollLeft.bind(this))
        if(!this.o.infiniteScroll) {
            this.hideShowArrows(this.slideIndex)
        }
        // scroll autoplay
        this.autoPlay(4)
    }

    /**
     * Set caroussel dimensions (slides width and image height) depending on screen width
     */
    setCarouselBasedOnScreenSize() {
        if(window.innerWidth > this.midScreenBreakpoint) {
            this.ss = this.o.slidesToScroll
            this.sv = this.o.slidesVisible
        } else if(window.innerWidth <= this.midScreenBreakpoint && window.innerWidth > this.smallScreenBreakpoint) {
            this.ss = this.o.slidesToScroll <= 2 ? this.o.slidesToScroll : 2
            this.sv = this.o.slidesVisible <= 2 ? this.o.slidesVisible : 2
        } else {
            this.ss = 1
            this.sv = 1
        }
        this.scrollToIndex(this.slideIndex)
        this.setSlidesWidth()
        this.setSlidesImgHeight()
    }

    /**
     * Calculate slides width
     */
    setSlidesWidth() {
        const wrapperWidthPercent = this.slidesNr / this.sv * 100
        const slidesWidth = (wrapperWidthPercent / this.sv)
        this.container.querySelector('.carousel-wrapper').style.width = wrapperWidthPercent + '%'
        this.slides.forEach(slide => slide.style.width = slidesWidth + '%')
    }

    /**
     * Set image-container height based on its width
     * @param {number} heightOnWidthRatio Images height on Width (h/w) ratio, a a float number (ie. 0.75)
     */
    setSlidesImgHeight(heightOnWidthRatio = 0.65) {
        const slidesImgContainers = this.container.querySelectorAll('.slide-img-container')
        const slideWrapperWidth = this.container.querySelector('.slide-wrapper').offsetWidth
        slidesImgContainers.forEach(imgCont => {
            imgCont.style.height = (slideWrapperWidth * heightOnWidthRatio) + 'px'
        })
    }

    /**
     * Calculate slide index to scroll toward, when the user clicks on the right arrow
     */
    scrollRight() {
        if(!this.o.infiniteScroll || (this.o.infiniteScroll && this.slideIndex + this.ss < this.slidesNr)) {
            if(this.slideIndex + this.ss >= this.slidesNr - this.sv) {
                if(!this.rightBorderReachedOnce) {
                    this.scrollToIndex(this.slidesNr - this.sv)
                    this.slideIndex = this.slidesNr - this.sv
                    this.rightBorderReachedOnce = true
                } else {
                    this.rightBorderReachedOnce = false
                    this.scrollToIndex(0)
                    this.slideIndex = 0
                }
            } else {
                this.scrollToIndex(this.slideIndex + this.ss)
                this.slideIndex += this.ss
            }
        } else {
            this.rightBorderReachedOnce = false
            this.scrollToIndex(0)
            this.slideIndex = 0
        }
    }

    /**
     * Calculate slide index to scroll toward, when the user clicks on the left arrow
     */
    scrollLeft () {
        if(!this.o.infiniteScroll || (this.o.infiniteScroll && this.slideIndex > 0)) {
            if(this.slideIndex - this.ss < 0) {
                this.scrollToIndex(0)
                this.slideIndex = 0
            } else {
                this.scrollToIndex(this.slideIndex - this.ss)
                this.slideIndex -= this.ss
            }
        } else {
            this.scrollToIndex(this.slidesNr - this.sv)
            this.slideIndex = this.slidesNr - this.sv
        }
    }

    /**
     * Process scrolling (reach the slide's index provided as parameter)
     * @param {number} targetSlideIndex Index of the slide to scroll toward
     */
    scrollToIndex(targetSlideIndex) {
        /* if targetDiapoNr is positive (show next diapo), the px must be negative (wrapper must translate to the left)
           if targetDiapoNr is negative (show previous diapo), the px must be positive (wrapper must translate to the right) */
        const goalPosPx = this.slides[0].offsetWidth * -1 * targetSlideIndex
        // translate
        this.wrapper.style.transform = `translateX(${goalPosPx}px)`
        // hide/show arrows on conditions
        if(!this.o.infiniteScroll) {
            this.hideShowArrows(targetSlideIndex)
        }
    }

    /**
     * Hide or show arrows based on several conditions
     * @param {number} slideIndex Current slide index
     */
    hideShowArrows(slideIndex) {
        if(slideIndex <= 0) {
            this.arrowLeft.classList.add('hidden')
        } else {
            if(this.arrowLeft.classList.contains('hidden')) {
                this.arrowLeft.classList.remove('hidden')
            }
        }
        if(slideIndex + 1 >= this.slidesNr) {
            this.arrowRight.classList.add('hidden')
        } else {
            if(this.arrowRight.classList.contains('hidden')) {
                this.arrowRight.classList.remove('hidden')
            }
        }
        // add css transition to arrows after first run (on load)
        const arrows = this.container.querySelectorAll('.arrow')
        window.addEventListener('load', () => {
            document.querySelectorAll('.arrow').forEach(arrow => {
                arrow.style.transition = 'transform 0.3s, opacity 0.3s'
            })
        })
    }

    /**
     * Scroll automatically to le right, at a custom speed
     * @param {number} delay Delay in seconds between two automatic scrolls
     */
    autoPlay(delay) {
        let intervalId
        if(this.o.autoPlay) {
            intervalId = setInterval(() => {
                this.scrollRight()
            }, delay * 1000)
            if(this.arrowLeft !== undefined && this.arrowRight !== undefined) {
                this.autoPlayHandler = pauseAutoPlay.bind(this)
                this.arrowLeft.addEventListener('click', this.autoPlayHandler)
                this.arrowRight.addEventListener('click', this.autoPlayHandler)
            }
        }
        function pauseAutoPlay() {
            clearInterval(intervalId)
            this.arrowLeft.removeEventListener('click', this.autoPlayHandler)
            this.arrowRight.removeEventListener('click', this.autoPlayHandler)
            const tiemoutId = setTimeout(() => {
                this.autoPlay(delay)
            }, delay * 1000)
        }
    }

    setAdditionalStyle() {
        // Add an hover animation to slides that contain a link
        const slidesWrappers = this.container.querySelectorAll('.slide-wrapper')
        slidesWrappers.forEach(wrapper => {
            if(wrapper.parentElement.tagName === 'A') {
                wrapper.classList.add('link')
            }
        })
    }

}