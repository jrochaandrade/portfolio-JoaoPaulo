images.forEach((image) => {
    image.addEventListener('click', () => {
        image.classList.toggle('enlarged');
        slider.classList.add('divEnlarged');
        slides.classList.add('divEnlarged');

        image.addEventListener('mouseleave', () => {
            image.classList.remove('enlarged');
            slider.classList.remove('divEnlarged');
            slides.classList.remove('divEnlarged');
        });
    });

    let count = 1;

    document.getElementById('radio1').checked = true;

    /* Passar imagens slider */
    setInterval(() => {
        /* nextImage() */
    }, 2000);

    function nextImage() {
        count++;
        if (count > 4) {
            count = 1;
        }

        document.getElementById('radio' + count).checked = true;
    }
});
