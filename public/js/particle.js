document.addEventListener('DOMContentLoaded', function () {
    $('.particle').particleground({
        dotColor: 'rgba(220, 220, 220, 0.92)',
        lineColor: 'rgba(255, 255, 255, 0.3)',
        minSpeedX: 0.1,
        maxSpeedX: 0.9,
        minSpeedY: 0.1,
        maxSpeedY: 0.9,
        lineWidth: 1,
        density: 5000, // One particle every n pixels
        curvedLines: false,
        proximity: 100, // How close two dots need to be before they join
        parallax: false,
        // parallaxMultiplier: 3, // Lower the number is more extreme parallax
        particleRadius: 25, // Dot size
    });
}, false);