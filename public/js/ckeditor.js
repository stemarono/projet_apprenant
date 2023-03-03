// on initialise CKEditor, ici la version baloon (chaque version a sa propre classe)
// BalloonEditor.create(document.querySelector("#editor"));

// on met l'information qui nous intéresse à l'intérieur de champ du formulaire
BalloonEditor
.create(document.querySelector("#editor"), {
    toolbar: ['heading', '|', 'bold', 'italic', '|', 'link', '|', 'bulletedList', 'numberedList'],
    heading: {
        options: [
        {
            model: 'paragraph',
            title: 'paragraphe',
            class: 'ck-heading_paragraph'
        },
        {
            model: 'heading1',
            title: 'Titre 1',
            class: 'ck-heading_heading1',
            view: 'h1'
        },
        {
            model: 'heading2',
            title: 'Titre 2',
            class: 'ck-heading_heading2',
            view: 'h2'
        },
        {
            model: 'heading3',
            title: 'Titre 3',
            class: 'ck-heading_heading3',
            view: 'h3'
        }
        ]
    }
})
.then(editor => {
    document.querySelector("#ajout-contact form").addEventListener("submit", function(e) {
        e.preventDefault();
        this.querySelector("#editor + input").value = editor.getData();
        this.submit();
    })
})