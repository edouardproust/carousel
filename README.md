# carousel

A lightweight library allowing to easily integrate a carousel to a PHP project. It uses javascript without framework.

✅ [**Live demo**](http://phpstack-749317-2526854.cloudwaysapps.com/)

![image](https://user-images.githubusercontent.com/45925914/176817156-0a8c9f76-611b-49cb-a5db-33effb0045dd.png)
![image](https://user-images.githubusercontent.com/45925914/176817142-3a8b020b-8c06-4f4d-9bb6-311b32631006.png)

The creation of a carousel is simplified by the signature of the object.

The options of the carousel are the following:
- slidesVisible : how many slides are visible inside the carousel viewport?
- slidesToScroll : how many slides should be scrolled when the user clicks on left or right arrows?
- infiniteScroll : should we go back to slide 1 when the last slide has been reached?

Here is how to create a new carousel:

```php
require 'src/Carousel.php';

$carousel = new Carousel(
    [
        new Slide(
            'Slide content 1',
            'Slide title 1',
            'image1.jpg',
            'http://www.link1.com'
        ),
        new Slide(
            'Slide content 2',
            'Slide title 2',
            'image2.jpg',
            'http://www.link2.com'
        )
    ], [
        'slidesVisible' => 2,
        'slidesToScroll' => 1,
        'infiniteScroll' => 1
    ]
);

$carousel->show();
```
