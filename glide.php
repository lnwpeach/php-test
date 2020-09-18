<html>
    <head>
        <link rel="stylesheet" href="assets/glide/dist/css/glide.core.min.css">
        <link rel="stylesheet" href="assets/glide/dist/css/glide.theme.min.css">
    </head>
    <body>
        <div class="glide">
			<div class="glide__track" data-glide-el="track">
				<ul class="glide__slides">
				<li class="glide__slide">0/li>
				<li class="glide__slide">1</li>
				<li class="glide__slide">2</li>
				</ul>
			</div>
			<div class="glide__arrows" data-glide-el="controls">
				<button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
				<button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
			</div>
		</div>
    </body>
</html>

<script src="assets/glide/dist/glide.min.js"></script>
<script>
    var glide = new Glide('.glide', {
        type: 'slider',
        perView: 4,
        breakpoints: {
            800: {
            perView: 2
            },
            480: {
            perView: 1
            }
        }
    });

    glide.mount()
</script>