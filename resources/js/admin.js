acf.addAction('load_field/name=page__colour_scheme', field => {
    const wpBlockContent = document.querySelector('.wp-block-post-content');

    if (wpBlockContent) {
        wpBlockContent.dataset.accentColour = field.val();

        field.on('change', event => {
            wpBlockContent.dataset.accentColour = event.target.value;
        });
    }
});
